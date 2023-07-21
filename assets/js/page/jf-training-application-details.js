
$(document).ready(function(){

	populate_data();


    $('#account-nav').show();

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
		location.href = 'dashboard.php';
	})


	$('#openfile').click(function() {
		if ($('#filename').val() == '') {
			warning('File Attachment', 'No file attach');			
		} else {
			//location.href = $('#filename').val();
			window.open($('#filename').val(),'_blank');
		}
	})



	$('#approve').click(function() {
		
		$.confirm({
			title: 'Training Application',
			content: 'Are you sure you want to approve this training application',
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						//cancel_participant(this.$target.attr('value'));
						form_data = new FormData($('#applicant_dataform')[0]);
						form_data.append('form_process' , 'Approve');
						process_request(form_data);
						//save_training();
			        }
			    },
				cancel: {
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
			}
		});

	})	

	$('#reject').click(function() {
		
		//form_data = new FormData($('#applicant_dataform')[0]);
		//form_data.append('form_process' , 'Reject');		
		$.confirm({
			title: 'Training Application',
			content: 'Are you sure you want to reject this training application',
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						//cancel_participant(this.$target.attr('value'));
						form_data = new FormData($('#applicant_dataform')[0]);
						form_data.append('form_process' , 'Reject');
						process_request(form_data);
						//save_training();
			        }
			    },
				cancel: {
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
			}
		});
		//res = confirm('Are you sure you want to reject this training application');
		//if (res) {
		//	process_request(form_data);
		//}

	})

	$('#cancel').click(function() {
		
		//form_data = new FormData($('#applicant_dataform')[0]);
		//form_data.append('form_process' , 'Request Cancel');		
		$.confirm({
			title: 'Training Application',
			content: 'Are you sure you want to cancel this training application',
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						//cancel_participant(this.$target.attr('value'));
						form_data = new FormData($('#applicant_dataform')[0]);
						form_data.append('form_process' , 'Request Cancel');
						process_request(form_data);
						//save_training();
			        }
			    },
				cancel: {
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
			}
		});
		//res = confirm('Are you sure you want to cancel this training application');
		//if (res) {
		//	process_request(form_data);
		//}

	})	

	$('#approve_cancel').click(function() {
		
		//form_data = new FormData($('#applicant_dataform')[0]);
		//form_data.append('form_process' , 'Cancel');		
		$.confirm({
			title: 'Training Application',
			content: 'Are you sure you want to approve cancellation this training application',
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						//cancel_participant(this.$target.attr('value'));
						form_data = new FormData($('#applicant_dataform')[0]);
						form_data.append('form_process' , 'Cancel');
						process_request(form_data);
						//save_training();
			        }
			    },
				cancel: {
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
			}
		});
		//res = confirm('Are you sure you want to approve cancellation this training application');
		//if (res) {
		//	process_request(form_data);
		//}

	})	

	$('#reject_cancel').click(function() {
		
		$.confirm({
			title: 'Training Application',
			content: 'Are you sure you want to reject cancellation this training application.',
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						//cancel_participant(this.$target.attr('value'));
						form_data = new FormData($('#applicant_dataform')[0]);
						form_data.append('form_process' , 'Reject Cancel');
						process_request(form_data);
						//save_training();
			        }
			    },
				cancel: {
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
			}
		});

	})	
	

	$('#approve_hr').click(function() {
		$('.error_field').remove();
		validateElement('select','','trainingcategory', 'Please select training category');
		if ($('.error_field').length > 0) {
			warning('Training Application', 'Please fix the er before submitting the application')
			$('#training_tab').trigger('click');
			return false;
		}

		if ($('#bonding').is(':checked')) {
			approve_hr('Are you sure you want to approve this training application with staff bonding.', 'Approve HR')		
		} else {
			approve_hr('Are you sure you want to approve this training application without staff bonding.', 'Approve HR')					
		}

	})	

	$('#approve_bonding').click(function() {
		confirm_process('Are you sure you want to approve this training application with staff bonding.', 'Approve Bonding')		

	})	

	$('#approve_no_bonding').click(function() {
		confirm_process('Are you sure you want to approve this training application without staff bonding.', 'Approve Without Bonding')		
	})	

	$('#reject_hr').click(function() {
		confirm_process('Are you sure you want to reject this training application.', 'Reject')		
	})	

	$('#add_provider').click(function() {
		url = 'f-adm-training-provider.php';
        openDialog(url, 510, 600, 'Admin Parameter - Training Provider');

	})
})


function approve_hr(message, action_process) {
	$.confirm({
			title: 'Training Application',
			content: message,
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						//cancel_participant(this.$target.attr('value'));
						form_data = new FormData($('#applicant_dataform')[0]);
						form_data.append('form_process' , action_process);
						form_data.append('coursecode', $('#coursecode').val());
						form_data.append('trainingcategory', $('#trainingcategory').val());

						if ($('#bonding').is(':checked')) {
							form_data.append('bonding', '1');
						}
						
						process_request(form_data);
						//save_training();
			        }
			    },
				cancel: {
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
			}
		});

}

function confirm_process(message, action_process) {
	$.confirm({
			title: 'Training Application',
			content: message,
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						//cancel_participant(this.$target.attr('value'));
						form_data = new FormData($('#applicant_dataform')[0]);
						form_data.append('form_process' , action_process);
						process_request(form_data);
						//save_training();
			        }
			    },
				cancel: {
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
			}
		});

}

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
		$('#subgroup').val(value['employee_subgroup']);
		$('#status').val(value['status']);
		$('#appr_no').val(value['appr_no']);
		$('#appr_name').val(value['appr_name']);
		$('#appr_email').val(value['appr_email']);
		$('#personal_area').val(value['personal_area'])


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


		if (value['filename'] !== null ) {
			$('#filename').val(value['filename']);	
			if ($('#filename').val() != '') {
				var fname = $('#filename').val().split('/');			
				$('#fileattached').val(fname[fname.length-1]);
			}	
		}
		

		checkbox_check('bonding', '1', value['bonding'])
		checkbox_check('eval', '1', value['eval'])
		checkbox_check('trainer_eval', '1', value['trainer_eval'])
		checkbox_check('super_eval', '1', value['super_eval'])
		checkbox_check('staff_request', '1', value['staff_request'])

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
		$('#is_request').val(value['staff_request'])

		if (value['staff_request'] == '1') {
			if (value['provider_name'] == '') {
				$('#trainingprovider').val('New Training Provider');
				$('#newtrainingprovider').val(value['training_provider']);
			} else if (value['provider_name'] == null) {
				$('#trainingprovider').val('New Training Provider');
				$('#newtrainingprovider').val(value['training_provider']);
			}

			if (value['main_location'] == '') {
				$('#traininglocation').val('New Training Location');
				$('#newmaintraininglocation').val(value['training_location']);
			} else if (value['main_location'] == null) {
				$('#traininglocation').val('New Training Location');
				$('#newmaintraininglocation').val(value['training_location']);
			}
		}

		
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
		validateElement('text',form,'sdate', 'Please enter training start date');
		validateElement('text',form,'edate', 'Please enter training end date');

		validateElement('select',form,'trainingprovider', 'Please select training provider');
		validateElement('select',form,'traininglocation', 'Please select training location');

	}

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}


