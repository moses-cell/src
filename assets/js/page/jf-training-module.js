$(document).ready(function(){

	var provider = $.parseJSON($('#provider_list').val());

	$( "#trainingprovidername" ).autocomplete({
		source: provider,
		minLength: 0,
		select :  function (event, ui) {
			$(this).val(ui.item.label); // display the selected text
			$('#trainingprovider').val(ui.item.value); // save selected id to hidden input
			//$(this).focusout();
			return false;
		}, change: function( event, ui ) {
			$( "#trainingprovider" ).val( ui.item? ui.item.value : "" );
			if ($(this).val() == "") {
				$( "#trainingprovider" ).val("");
				$( this ).val("");
			}				
		}, close : function( event, ui ) {
			if ($(this).val() == "") {
				$( "#trainingprovider" ).val("");
			} 
			if ($('#trainingprovider').val() == "") {
				$( this ).val("");
			}

			if ($('#trainingprovider').val() == 'new') {
				$('#newtrainingprovider').prop('disabled',false);
			} else {
				$('#newtrainingprovider').val();
				$('#newtrainingprovider').prop('disabled',true);
			}

		}, response: function(event, ui) {
			if (!ui.content.length) {
				var noResult = { value:"",label:"No results found", disabled: true };
				ui.content.push(noResult);
			} 
		}, focus: function (event, ui) {
		    event.preventDefault();
		    $(this).val(ui.item.label);
		    $("#trainingprovider").val(ui.item.value);
		}
	}).focus(function(){
		$(this).autocomplete("search","");
	}).click (function() {
		$(this).autocomplete("search","");
	})


	//addTooltip ();
    $('#HRSectionGroup').show();
   	$('#newtrainingprovider').prop('disabled',true);

	populate_data();

	/*$('#trainingprovidername').change(function() {
		if ($('#trainingprovider').val() == 'new') {
			$('#newtrainingprovider').prop('disabled',false);

		}
		else {
			$('#newtrainingprovider').val();
			$('#newtrainingprovider').prop('disabled',true);

		}
	})*/	

	$('.fileupload').bind('change', function() {
	  //this.files[0].size gets the size of your file.
		//2097152 = 2MB	  
	  	if (this.files[0].size > (1024*1024*2))  {
	  		alert('Please attach file below 2MB')
	  		this.value = "";
	  	}

	  	var ext = this.files[0].name.split('.').pop().toLowerCase();
	  	var fileExtension = ['jpeg', 'jpg', 'png', 'pjp', 'pjpeg', 'jfif', 'pdf', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx' ];
	  	if ($.inArray(ext, fileExtension) == -1) {
	  		alert('Please upload allowable file type only');
			this.value = "";
	  		return false;
	  	}
		
	});

	$('#openfile').click(function() {
		if ($('#filename').val() == '') {
			warning('File Attachment', 'No file attach');			
		} else {
			//location.href = $('#filename').val();
			window.open($('#filename').val(),'_blank');
		}
	})


	$('[name="eligibility[]"]').change(function(e) {

		if (e.currentTarget.id != 'el_AllStaff') {
			$('#el_AllStaff').prop('checked',false)
		} else {

			if ($('#el_AllStaff').is(':checked')) {
				var $chk = $('[name="eligibility[]"]:checked');
				$chk.each(function(index, value){
					if(value.id != 'el_AllStaff') {
						$('#' + value.id).prop('checked',false)
					}
	    			// Do stuff here with this
				});
			}  
		} 

	});

	$('[name="target_audience[]"').change(function(e) {
		if (e.currentTarget.id != 'ta_AllStaff') {
			$('#ta_AllStaff').prop('checked',false)
		} else {
			if ($('#ta_AllStaff').is(':checked')) {
				var $chk = $('[name="target_audience[]"]:checked');
				$chk.each(function(index, value){
					if(value.id != 'ta_AllStaff') {
						$('#' + value.id).prop('checked',false)
					}
	    			// Do stuff here with this
				});
			}  
		}
	})		

    // Initialize Textarea
	//$('textarea.auto-size').textareaAutoSize();

	$('.btnclose').click(function(e) {
		location.href = "l-hr-training-module.php";
	})

	$('.btnsave').click(function() {
		form_data = new FormData($('form')[0]);

		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before training module can be saved');
			return;
		}

		form_data.append('form_process' , 'Save');
		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-hr-training-module.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
            contentType: false,
         	cache: false,
   			processData:false,  
            beforeSend: function(){
		    	window.scrollTo(0, 0);
            	$("#loading-overlay").show();
        	},
            success	: function(data) {
            				$("#loading-overlay").hide();
							if (!data.success) { //If fails
								//alert(data.errors);
								danger ('Process Error', data.errors) 
							} else {
								success ('Success', 'Record successfully saved');
								redirect_delay('l-hr-training-module.php');

							}
							
						},
			error	: function (xhr, ajaxOptions, thrownError) {
							$("#loading-overlay").hide();
							danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
							console.log(xhr.status);
							console.log(xhr.responseText);
							console.log(thrownError);
							console.log('There is unknown error occurs. Please contact administrator for system verification');
							console.log(xhr.responseText);
						}
			
        	});


		//console.log(form_data);
	})



})



function populate_data() {

	var result = $.parseJSON($('#data').val());
	var provider = $.parseJSON($('#provider_list').val());

	$.each(result.Data, function( key, value ) { 
		$('#coursecode').val(value['code']);
		$('#title').val(value['title']);
		$('#description').val(value['description']);
		//$('select[name=trainingprovider]').val(value['provider']);
		//$('#trainingprovider').trigger('change');
		$('#trainingprovider').val(value['provider']);

		trainingProvider = get_data(value['provider'],provider);
		if (trainingProvider !== null)
			$('#trainingprovidername').val (trainingProvider['label']);
		$('#tdays').val(value['total_days']);
		$('#thours').val(value['total_hours']);
		$('#cost').val(value['cost']);
		$('select[name=trainingcategory]').val(value['category']);
		;

		$('#max_sit').val(value['max_sit']);
		$('#remarks').val(value['remarks']);


		$('#filename').val(value['filename']);	
		if ($('#filename').val() != '') {
			var fname = $('#filename').val().split('/');			
			$('#fileattached').val(fname[fname.length-1]);
		}	

		checkbox_check('eval', '1', value['eval'])
		checkbox_check('trainer_eval', '1', value['trainer_eval'])
		checkbox_check('super_eval', '1', value['super_eval'])
		

		chk = $('[name="eligibility[]"')
		chk.each (function(index, obj){
			checkbox_check(obj.id, obj.value, value['eligibility'], true)
		})



		chk = $('[name="target_audience[]"')
		chk.each (function(index, obj){
			checkbox_check(obj.id, obj.value, value['audience'], true)
		})
		
		checkbox_check('enable_process', '1', value['enable_module'])
		checkbox_check('bonding', '1', value['bonding'])


		
	})
}




function validateSave(form_data) {
	$('.error_field').remove();

	form = 'data_form';

	validateElement('text',form,'coursecode', 'Please enter course code');
	validateElement('text',form,'title', 'Please enter course title');

	if ($('#enable_process').is(':checked')) {
		validateElement('select',form,'trainingcategory', 'Please select training category');
		validateElement('select',form,'trainingprovider', 'Please select training provider');
		validateElement('number',form,'tdays', 'Please enter training total number of days (minimum 1 day)',1);
		validateElement('number',form, 'thours', 'Please enter training total number of hours (minimum 1 day)',1);
		validateElement('number',form, 'max_sit', 'Please enter maximum sit (minimum 1 day)',1);
		validateElement('check', form, 'eligibility[]', 'Please select at least one who can apply');
		validateElement('check', form, 'target_audience[]', 'Please select at least one target audience');
		validateElement('number',form, 'cost', 'Please enter cost per head (minimum 0)',0);
	}

	if ($('#trainingprovider').val() == 'new') {
		validateElement('text',form,'newtrainingprovider', 'Please enter new training provider');
	}

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

