$(document).ready(function() {

	ref = document.referrer;
	if (ref.indexOf('l-my-task.php') > 0) {
		$('#account-nav').addClass('show');
	} else if (ref.indexOf('l-my-trainer-assessment.php') > 0) {
		$('#StaffSectionGroup').show();
		$('#StaffAssessmentGroup-nav').addClass('show');
	} else if (ref.indexOf('l-trainer-assessment.php') > 0) {
		$('#TrainerSectionGroup').show();
	}


	populate_data();

	$('input[type="radio"]').change(function() {

		check_group = $(this).attr('group');
		total = 0;
		count = 0;
		main_total = 0;
		main_count = 0;
		name = "";
		var group = '';
		$('input[type="radio"]').each(function(index) {

			var id = this.id;
			if (group == '') {
				group = $(this).attr('group');
			}
			if (group != $(this).attr('group')) {				
				$('#'+group+'total').val((total/count));
				group = $(this).attr('group');
				total = 0;
				count = 0;
			}
			if ($('#' + id).is(':checked')) {
		    	total = total + parseInt($('#' + id).val())
		    	main_total = main_total + parseInt($('#' + id).val())
		    }
		    if (name != this.name) {
		    	count++;
		    	name = this.name;	
		    	main_count++;

		    }

		})

		$('#'+group+'total').val((total/count));
		
	})

	$('#result_type').change(function() {
		if ($(this).val() == 'Qualified Module') {
			$('.refresher').hide()
			$('.qualifying').show()
		}
		else if ($(this).val() == 'Refresher Module') {
			$('.qualifying').hide()
			$('.refresher').show()
		}
		else {
			$('.refresher').hide()
			$('.qualifying').hide()
		}

	})

	$('#result_type').trigger('change');

	$('#submit').click(function() {
		
		form_data = new FormData($('form')[0]);

		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please fill up all the information before submit your evaluation.');
			return;
		}

		
		form_data.append('form_process' , 'Save');	
		var group = '';
		var group_check = '';
		var delim = '';
		$('input[type="radio"]').each(function(index) {

			var id = this.id;
			if (group == '') {
				group = $(this).attr('group');
			}
			if (group != $(this).attr('group')) {
				form_data.append(group , group_check);	
				group = $(this).attr('group');			
				group_check = '';
				delim = '';
			}
			if ($('#' + id).is(':checked')) {
		    	group_check = group_check + delim + $('#' + id).val()
		    	delim = ',';
		    }
		    

		})
		form_data.append(group , group_check);

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-trainer-assessment.php', //Your form processing file URL
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
								success ('Success', 'Record successfully submitted');
								redirect_delay('l-my-task.php');

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

	$('#close').click(function() {
		history.back(-1);
	})





})

function populate_data() {

	var result = $.parseJSON($('#data').val());

	$.each(result.Data, function( key, value ) { 
		$('#coursecode').val(value['code']);
		$('#title').val(value['title']);
		$('#trainer_name').val(value['trainer_name']);

		$('#sdate').val(formatdate(value['date_start'], 1, 'date-only'));
		$('#edate').val(formatdate(value['date_end'], 1, 'date-only'));	
		$('#staff_no').val(value['staff_no']);
		$('#staff_name').val(value['fullname']);
		$('#division').val(value['division']);
		$('#department').val(value['department']);
		$('#section').val(value['section']);

		$('#appr_name').val(value['appr_name']);
		$('#appr_email').val(value['appr_email']);
		$('#sch_id').val(value['sch_id']);
		$('#appr_no').val(value['appr_no']);
		$('#super_no').val(value['super_no']);

		if (value['s1'] !== undefined) {
			$('#comment').val(value['comments']);

			s1 = value['s1'].split(',');
			$.each( s1, function( key, value ) {
				seq = key + 1;
				id = 's1q' + seq + "_" + value
				$('#' + id ).prop('checked', true)
				
			});

			$('#result_type').val(value['result_type']);
			$('#result_type').trigger('change');
			$('#theory').val(value['theory'])
			$('#practical').val(value['practical'])
			$('#theory_result').val(value['theory_result'])
			$('#practical_result').val(value['practical_result'])
			radio_check('theory_result_pass', 'Pass', value['theory_result']);
			radio_check('theory_result_fail', 'Fail', value['theory_result']);
			radio_check('practical_result_pass', 'Pass', value['practical_result']);
			radio_check('practical_result_fail', 'Fail', value['practical_result']);
			radio_check('training_result_pass', 'Pass', value['training_result']);
			radio_check('training_result_fail', 'Fail', value['training_result']);

			radio_check('training_result_poor', 'POOR - (70 AND BELOW)', value['training_result']);
			radio_check('training_result_average', 'AVERAGE - (71 - 80)', value['training_result']);
			radio_check('training_result_good', 'GOOD - (81-90)', value['training_result']);
			radio_check('training_result_excellent', 'EXCELLENT - (91- 100)', value['training_result']);

			$('#recommendation').val(value['recommendation']);

			//$('#comment').val()
			
		}

	
		
	})
}


function validateSave(form_data) {
	$('.error_field').remove();

	form = 'dataform';
	
	validateElement('radio',form,'s1q1', 'Please select one of the assessment value','','','_s1q1');
	validateElement('radio',form,'s1q2', 'Please select one of the assessment value','','','_s1q2');
	validateElement('radio',form,'s1q3', 'Please select one of the assessment value','','','_s1q3');
	validateElement('radio',form,'s1q4', 'Please select one of the assessment value','','','_s1q4');
	validateElement('radio',form,'s1q5', 'Please select one of the assessment value','','','_s1q5');
	validateElement('radio',form,'s1q6', 'Please select one of the assessment value','','','_s1q6');
	
	

	validateElement('radio',form,'s3q1', 'Please select one of the assessment value','','','_s3q1');
	validateElement('radio',form,'s3q2', 'Please select one of the assessment value','','','_s3q2');
	validateElement('radio',form,'s3q3', 'Please select one of the assessment value','','','_s3q3');
	

	validateElement('textarea',form,'comment', 'Please enter  comment');
	validateElement('number',form,'theory', 'Please enter valid number for theory %','0','','theory_percent');
	validateElement('number',form,'practical', 'Please enter valid number for practical %','0','','practical_percent');
	validateElement('select',form,'result_type','Please select result type')
	validateElement('select',form,'recommendation','Please select recommendation')

	if ($('#result_type').val() == 'Qualified Module') {
		validateElement('radio',form,'theory_result', 'Please select teory result either PASS/FAIL');
		validateElement('radio',form,'practical_result', 'Please select practical result either PASS/FAIL');
		validateElement('radio',form,'training_result_qualified', 'Please select training result either PASS/FAIL');

	} 

	if ($('#result_type').val() == 'Refresher Module') {
		validateElement('radio',form,'training_result_refresher', 'Please select training result');

	}



	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}