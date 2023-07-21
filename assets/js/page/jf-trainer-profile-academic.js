$(document).ready(function(){

	$('#ayear').val(new Date().getFullYear());
	
	populate_emp_academic();

	$('#add_academic').click(function() {
		form_data = new FormData($('#trainer_academic')[0]);

		if (validateacademic(form_data) == false) {
			jump_to_error_field();
			warning('Validation Failed', 'Please correct all the errors before trainer profile can be saved');
			return;
		}

		id = getUrlVars()['id'];
		emp = getUrlVars()['emp'];
		form_data.append('form_process' , 'academic');
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
								redirect_delay('f-hr-trainer-profile.php?id=' + data.id + '#academic');
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

function validateacademic(form_data) {
	$('.error_field').remove();

	form = 'trainer_employment';

	y = new Date().getFullYear();

	validateElement('number',form,'ayear', 'Please enter graduation year start year (1990 - ' + y + ')' , 1900, new Date().getFullYear());
	validateElement('text',form,'qualification', 'Please enter academic qualification');
	validateElement('text',form,'institution', 'Please enter institution');
	validateElement('text',form,'major', 'Please enter graduation major');
	

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function populate_emp_academic() {
	var empResult = $.parseJSON($('#academicdata').val());
	$.each(empResult.Data, function( key, value ) { 
		$('#ayear').val(value['grad_year']);
		$('#qualification').val(value['qualification']);
		$('#major').val(value['major']);
		$('#institution').val(value['institution']);
		
	})
}