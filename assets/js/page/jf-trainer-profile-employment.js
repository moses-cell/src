$(document).ready(function(){

	$('#syear').val(new Date().getFullYear());
	$('#eyear').val(new Date().getFullYear());

	populate_emp_data();

	$('#add_working').click(function() {
		form_data = new FormData($('#trainer_employment')[0]);

		if (validateworking(form_data) == false) {
			jump_to_error_field();
			warning('Validation Failed', 'Please correct all the errors before trainer profile can be saved');
			return;
		}

		id = getUrlVars()['id'];
		emp = getUrlVars()['emp'];
		form_data.append('form_process' , 'working');
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
								redirect_delay('f-hr-trainer-profile.php?id=' + data.id + '#working');
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

function validateworking(form_data) {
	$('.error_field').remove();

	form = 'trainer_employment';

	y = new Date().getFullYear();

	validateElement('number',form,'syear', 'Please enter employment start year (1990 - ' + y + ')' , 1900, new Date().getFullYear());
	validateElement('number',form,'eyear', 'Please enter employment end year >= ' + $('#syear').val(), $('#syear').val(), new Date().getFullYear());
	validateElement('text',form,'designation', 'Please enter designation');
	validateElement('text',form,'dept', 'Please enter division / department');
	validateElement('select',form,'jd', 'Please select jobs description');
	

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function populate_emp_data() {
	var empResult = $.parseJSON($('#empdata').val());
	$.each(empResult.Data, function( key, value ) { 
		$('#syear').val(value['syear']);
		$('#eyear').val(value['eyear']);
		$('#designation').val(value['designation']);
		$('#dept').val(value['department']);
		$('#jd').val(value['job_description']);
		
	})
}