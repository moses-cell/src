 $(document).ready(function(){

	populate_data();

	$('#email').on('keydown', function() {
		$('#staff_no').val('');
		$('#name').val('');
	})

	$('#close').click(function(e) {
		//CloseDialog();
		window.parent.CloseDialog();
		//window.opener.reload;
		//window.opener.location.reload();
	})

	$('#verify').click(function(e) {
		
		$('.error_field').remove();
		$('#email').val('');
		$('#name').val('');
		validateElement('text','data_form','staff_no', 'Please enter employee no');
		if ($('.error_field').length > 0) {
			return false;
		}
		form_data = $("#data_form").serializeArray();

		form_data.push({name: 'validate_staff_no' , value: '1'});
		//form_data.push({name: 'email' , value: $('#email').val()});

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/b_f-adm-emp-roles.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
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
								$('#name').val(data.name);
								$('#staff_no').val(data.staff_no);
								$('#email').val(data.email);
								radio_check('roles_admin', 'Admin', data.roles);
								radio_check('roles_hr_admin', 'HR Admin', data.roles)
								radio_check('roles_secretary', 'Unit Secretary', data.roles)
								radio_check('roles_bus_admin', 'Bus Depoh Admin', data.roles)
								radio_check('roles_rail_admin', 'Rail Depoh Admin', data.roles)


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

	$('#save').click(function() {
		
		form_data = $("#data_form").serializeArray();
		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before training module can be saved');
			return;
		}


		form_data.push({name: 'form_process' , value: 'Save'});

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-adm-emp-roles.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
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
		$('#email').val(value['email']);
		$('#name').val(value['staff_name']);
		$('#staff_no').val(value['user_name']);

		radio_check('roles_admin', 'Admin', value['roles']);
		radio_check('roles_hr_admin', 'HR Admin', value['roles'])
		radio_check('roles_secretary', 'Unit Secretary', value['roles'])
		radio_check('roles_bus_admin', 'Bus Depoh Admin', value['roles'])
		radio_check('roles_rail_admin', 'Rail Depoh Admin', value['roles'])

		$('#staff_no').attr('readonly',true);
		$('#verify').hide();
		
	})
}


function validateSave(form_data) {
	$('.error_field').remove();

	validateElement('text','data_form','email', 'Please enter employee email');
	validateElement('text','data_form','staff_no', 'Please click verify to displya staff no');
	validateElement('text','data_form','name', 'Please lick verify to displya staff name');
	validateElement('radio','data_form','roles', 'Please select employee roles');

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}







