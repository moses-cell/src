$(document).ready(function(){

	$('#tyear').val(new Date().getFullYear());
	
	populate_emp_training();

	$('#add_training').click(function() {
		form_data = new FormData($('#trainer_training')[0]);

		if (validate_training(form_data) == false) {
			jump_to_error_field();
			warning('Validation Failed', 'Please correct all the errors before trainer training history can be saved');
			return;
		}

		id = getUrlVars()['id'];
		emp = getUrlVars()['emp'];
		form_data.append('form_process' , 'training');
		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-hr-trainer-profile.php', //Your form processing file URL
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
								redirect_delay('f-hr-trainer-profile.php?id=' + data.id + '#training');
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

function validate_training(form_data) {
	$('.error_field').remove();

	form = 'trainer_employment';

	y = new Date().getFullYear();

	validateElement('number',form,'tyear', 'Please enter training year start year (1990 - ' + y + ')' , 1900, new Date().getFullYear());
	validateElement('text',form,'program', 'Please enter training program name');
	validateElement('text',form,'organiser', 'Please enter training organiser');
	

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function populate_emp_training() {
	var trainingResult = $.parseJSON($('#trainingdata').val());
	$.each(trainingResult.Data, function( key, value ) { 
		$('#tyear').val(value['training_year']);
		$('#program').val(value['program']);
		$('#organiser').val(value['organiser']);
		
	})
}