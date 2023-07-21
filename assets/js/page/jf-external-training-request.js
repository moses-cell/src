
$(document).ready(function(){



	populate_data();


    $('#StaffSectionGroup').show();

    $('#training_tab').click(function() {
		$('#training_tab').addClass('tab-link-active');
		$('#applicant_tab').removeClass('tab-link-active');
		$('#history_tab').removeClass('tab-link-active');
		$('#history_form').hide();
		$('#training_form').show();
		$('#applicant_form').hide();
		

	})

	$('#applicant_tab').click(function() {

		$('#applicant_tab').addClass('tab-link-active');
		$('#training_tab').removeClass('tab-link-active');
		$('#history_tab').removeClass('tab-link-active');
		$('#history_form').hide();
		$('#training_form').hide();
		$('#applicant_form').show();

	})

	$('#history_tab').click(function() {

		$('#history_tab').addClass('tab-link-active');
		$('#applicant_tab').removeClass('tab-link-active');
		$('#training_tab').removeClass('tab-link-active');
		$('#training_form').hide();
		$('#applicant_form').hide();
		$('#history_form').show();

	})

	var hash = $(location).attr('hash');
	if (hash == '#application') {
		$('#training_tab').trigger('click')
	} else if (hash == '#profile') {
		$('#applicant_tab').trigger('click')
	} else if (hash == '#histiry') {
		$('#history_tab').trigger('click')
	}

	$('#close').click(function(e) {
		location.href = "l-c-my-training.php";
	})


	var provider = $.parseJSON($('#provider_list').val());
	var provider_id;

	$( "#trainingprovidername" ).autocomplete({
		source: $.parseJSON($('#provider_list').val()),
		minLength: 0,
		select :  function (event, ui) {
			$(this).val(ui.item.label); // display the selected text
			$('#trainingprovider').val(ui.item.value); // save selected id to hidden input
			//$(this).focusout();
			return false;
		}, change: function( event, ui ) {
			$("#trainingprovider" ).val( ui.item? ui.item.value : "" );
			
			
			if ($(this).val() == "") {
				$( "#trainingprovider" ).val("");
				$( this ).val("");
			}				
		}, close : function( event, ui ) {
			populate_location();
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

			if (provider_id != $('#trainingprovider').val()) {
				$('#traininglocationname').val('');
				$('#traininglocation').val('');
				$('#locationdetails').val('');	
			}
			provider_id = $('#trainingprovider').val();			


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

	if (!RegExp.escape) {
	  RegExp.escape = function(value) {
	    return value.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
	  };
	}

	$( "#traininglocationname" ).autocomplete({
		source:  function( request, response ) {

			data = $('#location_list').val();
			finaldata = $.parseJSON(data)
			
			if (!request.term.length)
				response(finaldata);
			else {
				var regex = new RegExp(RegExp.escape(request.term), "i");
			    var recs = $.grep(finaldata, function(obj) {
			      return regex.test(obj.label)
			    });

			    response($.map(recs, function(item) {
			      return {
			        label: item.label,
			        value: item.value,
			        details: item.details,
			      }
			    }));
			}

		},
		minLength: 0,
		select :  function (event, ui) {
			$(this).val(ui.item.label); // display the selected text
			$('#locationdetails').val(ui.item.details)
			//$(this).focusout();
			return false;
		}, change: function( event, ui ) {
			$( "#traininglocation" ).val( ui.item? ui.item.value : "" );
			$( "#locationdetails" ).val( ui.item? ui.item.details : "" );
			if ($(this).val() == "") {
				$( "#traininglocation" ).val("");
				$('#locationdetails').val("");
				$( this ).val("");
			}				
		}, close : function( event, ui ) {
			if ($(this).val() == "") {
				$( "#traininglocation" ).val("");
				$('#locationdetails').val("");
			} 
			if ($('#traininglocation').val() == "") {
				$( this ).val("");
				$('#locationdetails').val("");
			}

			if ($('#traininglocation').val() == 'new training location') {
	//			$('#location').show();
				$('#newmaintraininglocation').prop('disabled',false);
				$('#newsubtraininglocation').prop('disabled',false);
				$('#locationdetails').val();
				$('#locationdetails').prop('readonly', true);	
			}
			else if ($('#traininglocation').val() == 'new public location') {
				//$('#location').show();
				$('#newmaintraininglocation').prop('disabled',false);
				$('#newsubtraininglocation').prop('disabled',false);
				$('#locationdetails').val();
				$('#locationdetails').prop('readonly', true);	
			}
			else {
				//$('#location').hide();
				//populate_location_details($('#traininglocation').val());
				$('#newmaintraininglocation').prop('disabled',true);
				$('#newsubtraininglocation').prop('disabled',true);	
				$('#newmaintraininglocation').val();
				$('#newsubtraininglocation').val();
				
				$('#locationdetails').val();
				$('#locationdetails').prop('readonly', true);
			}

		}, response: function(event, ui) {
			if (!ui.content.length) {
				var noResult = { value:"",label:"No results found", disabled: true };
				ui.content.push(noResult);
			} 
		}, focus: function (event, ui) {
		    event.preventDefault();
		    $(this).val(ui.item.label);
		    $("#traininglocation").val(ui.item.value);
		    $("#locationdetails").val(ui.item.details);
		}
	}).focus(function(){
		//location = $.parseJSON($('#location_list').val())
		$('#traininglocationname').autocomplete("search",'');
	}).click (function() {
		//location = $.parseJSON($('#location_list').val())
		$('#traininglocationname').autocomplete("search",'');
	})

	$('#newtrainingprovider').prop('disabled',true);
	
	//$('#location').hide();
	$('#newmaintraininglocation').prop('disabled',true);
	$('#newsubtraininglocation').prop('disabled',true);
	$('#locationdetails').prop('readonly', true);


	$('#openfile').click(function() {
		if ($('#filename').val() == '') {
			warning('File Attachment', 'No file attach');			
		} else {
			//location.href = $('#filename').val();
			window.open($('#filename').val(),'_blank');
		}
	})

	$('.datetime').timepicker({
		minuteStep: 10,
        appendWidgetTo: 'body',
        showSeconds: false,
        showMeridian: true,
        defaultTime: false,
        showInputs: true,
        disableFocus: true,
        explicitMode : true
    })

	$('#approve').click(function() {
		
		form_data = new FormData($('#applicant_dataform')[0]);
		form_data.append('form_process' , 'Approve');		

		res = confirm('Are you sure you want to reject this training application');
		if (res) {
			process_request(form_data);
		}

	})	

	$('#reject').click(function() {
		
		form_data = new FormData($('#applicant_dataform')[0]);
		form_data.append('form_process' , 'Reject');		

		res = confirm('Are you sure you want to approve this training application');
		if (res) {
			process_request(form_data);
		}

	})

	$('#cancel').click(function() {
		
		form_data = new FormData($('#applicant_dataform')[0]);
		form_data.append('form_process' , 'Request Cancel');		

		res = confirm('Are you sure you want to cancel this training application');
		if (res) {
			process_request(form_data);
		}

	})	

	$('#approve_cancel').click(function() {
		
		form_data = new FormData($('#applicant_dataform')[0]);
		form_data.append('form_process' , 'Cancel');		

		res = confirm('Are you sure you want to approve cancellation this training application');
		if (res) {
			process_request(form_data);
		}

	})	

	$('#reject_cancel').click(function() {
		
		form_data = new FormData($('#applicant_dataform')[0]);
		form_data.append('form_process' , 'Reject Cancel');		

		res = confirm('Are you sure you want to reject cancellation this training application');
		if (res) {
			process_request(form_data);
		}

	})	
	

	$('#submit').click(function() {
		
		form_data = new FormData($('form')[0]);

		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before training schedule can be saved');
			return;
		}

		form_data.append('form_process' , 'Save');		

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-external-training-request.php', //Your form processing file URL
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
								redirect_delay('dashboard.php');

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

	$('#newtrainingprovider').blur(function() {
		trainingProvider = get_data_id($(this).val(),provider);

		if (trainingProvider !== null ) {
			if (trainingProvider['value'].length > 0 ) {
				$('#trainingprovider').val(trainingProvider['value']);
				$('#trainingprovidername').val (trainingProvider['label']);	
				populate_location(trainingProvider['value'])	
				$('#newtrainingprovider').val('');
				$('#newtrainingprovider').prop('disabled',true);	
			}
		}
	})


})


function process_request (form_data) {

		
	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/process/p_f-training-application.php', //Your form processing file URL
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
				if (data.process == 'Approve') {
					success ('Success', 'Training application successfully approved.');
					redirect_delay('l-my-task.php');

				}
				if (data.process == 'Reject') {
					success ('Success', 'Training application successfully rejected.');
					redirect_delay('l-my-task.php');

				} 

				if (data.process == 'Request Cancel') {
					success ('Success', 'Training application successfully submitted for cancellation.');
					redirect_delay('l-my-task.php');

				} 

				if (data.process == 'Cancel') {
					success ('Success', 'Training application successfully approved for cancellation.');
					redirect_delay('l-my-task.php');

				} 

				if (data.process == 'Reject Cancel') {
					success ('Success', 'Training application successfully rejected for cancellation.');
					redirect_delay('l-my-task.php');

				} 
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

}

		//console.log(form_data);


function populate_data() {

	var result = $.parseJSON($('#data').val());

	$.each(result.Data, function( key, value ) { 

		$('#staff_no').val(value['staff_no']);
		$('#staff_name').val(value['staff_name']);
		$('#email').val(value['email']);
		$('#email2').val(value['email2']);
		$('#division').val(value['division']);
		$('#department').val (value['department']);
		$('#unit').val(value['unit']);
		$('#staff_position').val(value['position']);
		$('#personal_area').val(value['personal_area']);
		$('#subarea').val(value['personal_subarea']);
		$('#grade').val(value['grade']);
		$('#subgroup').val(value['employee_subgroup']);
		$('#status').val(value['status']);
		$('#appr_no').val(value['appr_no']);
		$('#appr_name').val(value['appr_name']);
		$('#appr_email').val(value['appr_email']);
		$('#personal_area').val(value['personal_area'])


		id = getUrlVars()['id'];
		if (id !== undefined) {
			$('#coursecode').val(value['code']);
			$('#title').val(value['title']);
			$('#description').val(value['description']);
			//$('select[name=trainingprovider]').val(value['provider'])
			$('#trainingprovider').val(value['provider_name']);
			if (value['sub_location'] == '') {
				$('#traininglocation').val(value['main_location']);
			} else if(value['sub_location'] == null) {
				$('#traininglocation').val(value['main_location']);
			} else {
				$('#traininglocation').val(value['main_location'] + ' - ' + value['sub_location']);
			}
			$('#locationdetails').val (value['location_detail']);
			

			$('#sdate').val(formatdate(value['date_start'], 1, 'date-only'));
			$('#edate').val(formatdate(value['date_end'], 1, 'date-only'));	
			$('#stime').val(formattime(value['time_start']));
			$('#etime').val(formattime(value['time_end']));	

			$('#tdays').val(value['total_days']);
			$('#thours').val(value['total_hours']);
			$('#trainingcategory').val(value['training_category']);
			;

			$('#max_sit').val(value['max_sit']);
			$('#remarks').val(value['remarks']);


			$('#filename').val(value['filename']);	
			if ($('#filename').val() != '') {
				var fname = $('#filename').val().split('/');			
				$('#fileattached').val(fname[fname.length-1]);
			}	

			checkbox_check('eval', '1', value['eval'])
			checkbox_check('post_eval', '1', value['post_eval'])
			checkbox_check('super_eval', '1', value['super_eval'])

			chk = $('[name="eligibility[]"')
			chk.each (function(index, obj){
				checkbox_check(obj.id, obj.value, value['eligibility'], true)
			})



			chk = $('[name="target_audience[]"')
			chk.each (function(index, obj){
				checkbox_check(obj.id, obj.value, value['audience'], true)
			})

			$('#app_status').html('Status : ' + value['status']);
			$('#sch_id').val(value['sch_id']);
		}
		
	})
	DateElement(false, getCurrentYear()-1, getCurrentYear()+1, 'sdate', 'edate','tdays')

}


function validateSave(form_data) {
	$('.error_field').remove();

	form = 'data_form';
	setting = $('#setting').val();

	//validateElement('text',form,'coursecode', 'Please enter course code');
	validateElement('text',form,'title', 'Please enter course title');
	validateElement('text', form, 'reviewupload', 'Please include attachment')
	validateElement('textarea', form, 'description', 'Please enter training description')

	validateElement('select',form,'trainingcategory', 'Please select training category');
	validateElement('number',form,'tdays', 'Please enter training total number of days (minimum 1 day)',1);
	validateElement('number',form, 'thours', 'Please enter training total number of hours (minimum 1 day)',1);
	validateElement('date',form,'sdate', 'Please enter training start date minimum ' + (setting ) + ' days before the training date',setting,'','','dd-mm-yyyy');
	validateElement('date',form,'edate', 'Please enter training end date');
	validateElement('text',form,'stime', 'Please enter training start time');
	validateElement('text',form,'etime', 'Please enter training end time');

	validateElement('text',form,'trainingprovidername', 'Please enter training provider');
	validateElement('text',form,'traininglocationname', 'Please enter training location');
	validateElement('number',form, 'cost', 'Please enter cost per head (minimum 0)',0);

	if ($('#trainingprovidername').val() == 'New Training Provider') {
		validateElement('text',form,'newtrainingprovider', 'Please enter new training provider name');
	}

	if ($('#traininglocationname').val() == 'New Training Provider Location') {
		validateElement('text',form,'newmaintraininglocation', 'Please enter new main location');
	}

	if ($('#traininglocationname').val() == 'New public Location') {
		validateElement('text',form,'newmaintraininglocation', 'Please enter new main location');
	}



	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function populate_location (location) {

	form_data = {
		'get_provider_location' : '1', 
		'trainingprovider' : $('#trainingprovider').val(),
		'editor_name' : $('#editor_name').val(),
		'id' : location,
	}

	//var final_data;
	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/process/p_f-hr-training-schedule.php', //Your form processing file URL
        data    : form_data, //Forms name
        success	: 
        	function(data) {
        		if (location == '')
            		$('#location_list').val(data);
            	else {
            		$('#location_list').val(data);
            		data = $.parseJSON(data);
            		$.each(data, function(index, value) {

            			if(value['value'] == location) {
            				$('#traininglocationname').val(value['label']);
            				$('#traininglocation').val(value['value']);
            				$('#locationdetails').val(value['details']);
            			}
            			//return false;


            		})


            	}
            	//final_data = data;
            	//$('#location_list').val($.parseJSON(data))
            	//return data;
            	//return $.parseJSON(data)
			},	
    });

    //return final_data;
}

function populate_location_details (id) {

	form_data = {
		'get_location_details' : '1', 
		'traininglocation' : id,
		'editor_name' : $('#editor_name').val()
	}

	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/process/p_f-hr-training-schedule.php', //Your form processing file URL
        data    : form_data, //Forms name
        success	: 
        	function(data) {
            	$('#locationdetails').html(data);
            	//return data;
			},	
    });
}

