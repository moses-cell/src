//DateElement(false, getCurrentYear()-10, getCurrentYear()+10, 'sdate', 'edate','tdays')

$(document).ready(function(){

	populate_data();

   	$('#StaffSectionGroup').show();


	$('#close').click(function(e) {
		location.href = "l-hr-training-calendar.php";
	})


	$('#openfile').click(function() {
		if ($('#filename').val() == '') {
			warning('File Attachment', 'No file attach');			
		} else {
			//location.href = $('#filename').val();
			window.open($('#filename').val(),'_blank');
		}
	})



	$('#save').click(function() {
		
		form_data = new FormData($('form')[0]);
		form_data.append('form_process' , 'Save');		

		supervisor = $('#super_eval').val();
		if ($('#appr_no').val() == '') {
			
			warning('Validation Failed', 'Please update your profile before you can apply for this training application');
	        url = 'f-update-my-profile.php?id='+$('#staff_no').val() + '&pageid=' + $('#sch_id').val() + '&super='+ supervisor;
	        openDialog(url, 'max', 'max', 'Update Profile', false, true)
	        return;

		} else if ($('#secretary_email').val() == '') {
			warning('Validation Failed', 'Please update your profile before you can apply for this training application');
	        url = 'f-update-my-profile.php?id='+$('#staff_no').val() + '&pageid=' + $('#sch_id').val() + '&super='+ supervisor;
	        openDialog(url, 'max', 'max', 'Update Profile', false, true)
	        return;

		} else if (supervisor == '1' && $('#super_no').val() == '' ) {
			warning('Validation Failed', 'Please update your profile before you can apply for this training application');
	        url = 'f-update-my-profile.php?id='+$('#staff_no').val() + '&pageid=' + $('#sch_id').val() + '&super='+ supervisor;
	        openDialog(url, 'max', 'max', 'Update Profile', false, true)
	        return;

		}
		setting = $('#setting').val();
		if (validateElement('date',form_data,'sdate', '',setting,'','','dd-mm-yyyy') ) {
			warning('Validation Failed', 'Training Application must be ' + (setting ) + ' days before the training date');
			return;
		}
						
		


		var res; //= confirm('Are you sure you want to apply for this training');
		$.confirm({
			title: 'Training Application',
			content: 'Are you sure you want to apply for this training',
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						submit_training();
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

		

		//console.log(form_data);
	})



})

function submit_training() {
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
									success ('Success', 'Training application successfully submit for approval.');
									redirect_delay('l-c-my-training.php');

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

function populate_data() {

	var result = $.parseJSON($('#data').val());

	$.each(result.Data, function( key, value ) { 
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
		checkbox_check('trainer_eval', '1', value['trainer_eval'])
		checkbox_check('super_eval', '1', value['super_eval'])
		checkbox_check('bonding', '1', value['bonding'])

		chk = $('[name="eligibility[]"')
		chk.each (function(index, obj){
			checkbox_check(obj.id, obj.value, value['eligibility'], true)
		})



		chk = $('[name="target_audience[]"')
		chk.each (function(index, obj){
			checkbox_check(obj.id, obj.value, value['audience'], true)
		})
		
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


