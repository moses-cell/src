 $(document).ready(function(){

	populate_data();

	$('#close').click(function(e) {
		//CloseDialog();
		window.parent.CloseDialog();
		//window.opener.reload;
		//window.opener.location.reload();
	})

	
	$('#save').click(function() {
		
		form_data = $("#data_form").serializeArray();
		if (validateSave(form_data) == false) {
			jump_to_error_field();
			warning('Validation Failed', 'Please correct all the errors before food preferences form can be saved');
			return;
		}


		form_data.push({name: 'form_process' , value: 'Save'});

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-adm-food-preferences.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
            beforeSend: function(){
		    	window.scrollTo(0, 0);
            	$("#loading-overlay").show();
        	},
            success	: function(data) {
            				$("#loading-overlay").hide();
							if (!data.success) { //If fails
								danger ('Process Error', data.errors) 
							} else {
								success ('Success', 'Record successfully saved');
								//redirect_delay('l-hr-training-module.php');
								window.parent.redirect_dialog();
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

	$.each(result.Data, function( key, value ) { 
		$('#meal').val(value['meal_type']);
		$('#desc').val(value['description']);


		
		
	})
}


function validateSave(form_data) {
	$('.error_field').remove();

	validateElement('text','data_form','meal', 'Please enter food preferences');
	validateElement('text','data_form','desc', 'Please enter description');

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}





