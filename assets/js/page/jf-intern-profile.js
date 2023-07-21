$(document).ready(function(){

	populate_data();
    $('#InternSectionGroup').show();

    DateElement(true, getCurrentYear()-1, getCurrentYear()+1,'sdate')
    DateElement(true, getCurrentYear()-1, getCurrentYear()+1,'edate','', '', 'sdate', true, true, 'dd-mm-yyyy')


	/*$('#edate').on('blur', function() {
		$('#edate').val(new Date(Convert_to_Date($('#sdate').val(),'dd-mm-yyyy').toDateString()));
	})*/

	$('#sdate').on('change', function() {
		if($('#edate').val() == '')
			return;
		else {
			dateformat = 'dd-mm-yyyy';
			sdate = dateToCompare = Convert_to_Date($('#sdate').val(), dateformat);
			edate = dateToCompare = Convert_to_Date($('#edate').val(), dateformat);
			if (edate < sdate ) {
				$('#edate').val('');
			}
		}
	})

	$('#training_tab').click(function() {
		
		$('#participant_tab').removeClass('tab-link-active');
		$('#training_tab').addClass('tab-link-active');
		$('#participant_list').hide();
		$('#training_form').show();

	})

	$('#participant_tab').click(function() {
		
		$('#participant_tab').addClass('tab-link-active');
		$('#training_tab').removeClass('tab-link-active');
		$('#participant_list').show();
		$('#training_form').hide();

	})

	$('#internal_participant').click(function() {
    
		student_eval = $('#eval').val();
		trainer_eval = $('#trainer_eval').val();
		super_eval = $('#super_eval').val();

		var selected = '';
		var delim = '';
		$('.target_audience input:checked').each(function() {
		    selected = selected + delim +  $(this).val();
		    delim = ',';
		});
		//alert(selected);
        url = 'f-hr-new-participant.php?id=' + $('#pageid').val() + '&eval=' + student_eval + '&trainer=' + trainer_eval + '&super=' + super_eval + '&target=' + selected;
        openDialog(url, 'max', 'max', 'Add New Participant')
    })

    $('#external_participant').click(function() {
    
        url = 'f-hr-external-participant.php?id=' + $('#pageid').val();
        openDialog(url, 650, 850, 'Add External Participant')
    })

	var hash = $(location).attr('hash');
	if (hash == '#training') {
		$('#training_tab').trigger('click')
	} else if (hash == '#participant') {
		$('#participant_tab').trigger('click')
	} 


	$('#enable_process').change(function() {
		if ($(this).is(':checked') == false) {
			danger ('Warning', 'This will automatically cancel all registered participant') 
		} 
	})




	//$('#provider').hide();
	$('#newtrainingprovider').prop('disabled',true);
	
	//$('#location').hide();
	$('#newmaintraininglocation').prop('disabled',true);
	$('#newsubtraininglocation').prop('disabled',true);
	$('#locationdetails').prop('readonly', true);

	

	$('#close').click(function(e) {
		location.href = "l-hr-intern-profile.php";
	})




	$('#save').click(function() {

		form_data = new FormData($('form')[0]);

		if (validateSave(form_data) == false) {
			jump_to_error_field();
			warning('Validation Failed', 'Please correct all the errors before infernship form can be saved');
			return;
		}

		form_data.append('form_process' , 'Save');		

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-intern-profile.php', //Your form processing file URL
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
					redirect_delay('l-hr-intern-profile.php');
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

function save_training() {

		form_data = new FormData($('form')[0]);

/*		if ($('#training_status').val() == '1' && $('#enable_process').is('checked') == false) {
			danger ('Warning', 'This will automatically cancel all registered participant') 
	
		}
*/
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
            url     : 'library/page/process/p_f-hr-training-schedule.php', //Your form processing file URL
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
								redirect_delay('l-hr-training.php');

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
		$('#ic_no').val(value['ic_no']);
		$('#email').val(value['email']);
		$('#student_name').val(value['student_name']);
		$('#sdate').val(value['date_start']);
		$('#edate').val(value['date_end']);
		$('#department').val(value['department']);
		$('#bank_name').val(value['bank_name']);
		$('#acc_no').val(value['acc_no']);
		$('#monthly_allowance').val(value['monthly_allowance']);
		$('#mc').val(value['mc_allowance']);
		$('#division').val(value['division']);
		$('#section').val(value['section']);
		$('#qualification').val(value['qualification']);
		$('#contact_no').val(value['contact_no']);


		
	})

	//DateElement(false, getCurrentYear()-1, getCurrentYear()+1, 'sdate', 'edate','tdays')

}


function validateSave(form_data) {
	$('.error_field').remove();

	form = 'data_form';
	validateElement('text',form,'ic_no', 'Please enter IC No');
	validateElement('text',form,'student_name', 'Please enter student name');
	validateElement('text',form,'department', 'Please enter department');
	validateElement('text',form,'division', 'Please enter division');
	validateElement('text',form,'section', 'Please enter section');
	validateElement('text',form,'qualification', 'Please enter qualification');

	validateElement('date',form,'sdate', 'Please enter internship start date');
	validateElement('date',form,'edate', 'Please enter internship end date');

	validateElement('text',form,'bank_name', 'Please select bank name');
	validateElement('text',form,'acc_no', 'Please select bank account number');
	
	validateElement('number',form, 'monthly_allowance', 'Please enter monthly allowance (minimum 0)',0);
	validateElement('number',form, 'mc', 'Please enter Medical Leave allowance (minimum 0)',0);
	

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}


