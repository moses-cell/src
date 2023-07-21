$(document).ready(function(){

	if ($('#SecSectionGroup').length)
	    $('#SecSectionGroup').show();
	else  {
		$('#HRSectionGroup').show();
		$('#HRTrainingRequest-nav').addClass('show');
	}


    $('#training_tab').click(function() {
		$('#training_tab').addClass('tab-link-active');
		$('#requester_tab').removeClass('tab-link-active');
		
		$('#training_form').show();
		$('#requester_form').hide();
		

	})

	$('#requester_tab').click(function() {

		$('#requester_tab').addClass('tab-link-active');
		$('#training_tab').removeClass('tab-link-active');
		
		$('#training_form').hide();
		$('#requester_form').show();

	})


	var hash = $(location).attr('hash');
	if (hash == '#application') {
		$('#training_tab').trigger('click')
	} else if (hash == '#profile') {
		$('#requester_tab').trigger('click')
	} else if (hash == '#histiry') {
		$('#history_tab').trigger('click')
	}


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
		location.href = "l-my-training-request.php";
	})

	$('#admin_close').click(function(e) {
		location.href = "l-hr-training-request.php";
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
            url     : 'library/page/process/p_f-training-request.php', //Your form processing file URL
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
								redirect_delay('l-my-training-request.php');

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

	$('#add_provider').click(function() {
		url = 'f-adm-training-provider.php';
        openDialog(url, 510, 600, 'Admin Parameter - Training Provider');

	})


	$('#process').click(function() {
		hr_admin_process('In Progress')
	})

	$('#reject').click(function() {
		hr_admin_process('Reject')
	})

	$('#completed').click(function() {
		location.href = 'f-hr-training-schedule.php?request=' + $('#pageid').val();
	})

})



function hr_admin_process(process) {
		form_data = new FormData($('form')[0]);

		//a = $('#pageid').prop('disabled',false).val().prop('disabled',true);
		//alert($('#pageid').val());

		form_data.append('form_process' , process);
		form_data.append('pageid' , $('#pageid').val());
		form_data.append('editor_name' , $('#editor_name').val());
		
		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-training-request.php', //Your form processing file URL
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
								success ('Success', 'Training Request updated to ' + process);
								redirect_delay('l-hr-training-request.php');

							}
							
						},
			error	: function (jqXHR, ajaxOptions, thrownError) {
							$("#loading-overlay").hide();
							danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
							console.log( jqXHR.status);
							console.log( jqXHR.responseText);
							console.log(thrownError);
							console.log('There is unknown error occurs. Please contact administrator for system verification');
							console.log( jqXHR.responseText);
						}
			
        	});



}

function populate_data() {

	var result = $.parseJSON($('#data').val());
	var provider = $.parseJSON($('#provider_list').val());

	$.each(result.Data, function( key, value ) { 

		$('#staff_no').val(value['staff_no']);
		$('#staff_name').val(value['fullname']);
		$('#email').val(value['email']);
		$('#email2').val(value['email2']);
		$('#division').val(value['division']);
		$('#department').val (value['department']);
		$('#unit').val(value['unit']);
		$('#staff_position').val(value['position']);
		$('#personal_area').val(value['personal_area']);
		$('#subarea').val(value['personal_subarea']);
		$('#grade').val(value['grade']);
		$('#group').val(value['org_group']);
		$('#subgroup').val(value['employee_subgroup']);
		$('#appr_no').val(value['appr_no']);
		$('#appr_name').val(value['appr_name']);
		$('#appr_email').val(value['appr_email']);
		$('#personal_area').val(value['personal_area'])

		$('#coursecode').val(value['code']);
		$('#title').val(value['title']);
		$('#description').val(value['description']);
		$('#trainingprovidername').val(value['provider']);
		$('#trainingprovider').val(value['provider_id']);
		$('#newtrainingprovider').val(value['new_training_provider']);
		$('#tdays').val(value['total_days']);
		$('#thours').val(value['total_hours']);
		$('#cost').val(value['cost']);
		$('select[name=trainingcategory]').val(value['category']);
		$('#participant').val(value['participant'])

		$('#remarks').val(value['remarks']);


		$('#filename').val(value['filename']);	
		if ($('#filename').val() != '') {
			var fname = $('#filename').val().split('/');			
			$('#fileattached').val(fname[fname.length-1]);
		}	

		

		chk = $('[name="target_audience[]"')
		chk.each (function(index, obj){
			checkbox_check(obj.id, obj.value, value['audience'], true)
		})
		
		if ($("#newtrainingprovider").val() != '') {
			$('#newtrainingprovider').prop('disabled',false);
		}

		$('input').prop('disabled', true)
		$('textarea').prop('disabled', true)
		$('select').prop('disabled', true)
	})
}




function validateSave(form_data) {
	$('.error_field').remove();

	form = 'data_form';

	validateElement('text',form,'title', 'Please enter course title');

	validateElement('select',form,'trainingcategory', 'Please select training category');
	validateElement('check', form, 'target_audience[]', 'Please select at least one target audience');
	validateElement('number',form, 'participant', 'Please enter number of participant (minimum 1)',1);


	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

