$(document).ready(function() {
	
	staff_no = '';


	$('#staff_no').on('focusin', function(){
		staff_no = $('#staff_no').val();
	})

	$('#staff_no').on('focusout', function(){

		if ($('#staff_no').val() == '')
			return;

		if (staff_no != $('#staff_no').val() ) {
			get_staff_info();
		}
		
	})

	$('#close_dialog').click(function(e) {
		//CloseDialog();
		window.parent.HideModalWindow()
		//window.parent.CloseDialog();
		//window.opener.location.reload();
	})


	$('#save').click(function() {

		form_data = $("#new_participant").serializeArray();
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
            url     : 'library/page/process/p_f-trainer-new-participant.php', //Your form processing file URL
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
								//window.parent.redirect_dialog();
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

function validateSave(form_data) {
	$('.error_field').remove();

	validateElement('text','new_participant','staff_no', 'Please enter staff no');
	validateElement('text','new_participant','staff_name', 'Please enter staff name');

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function get_staff_info() {

	form_data = new FormData($('#new_participant')[0]);
	form_data.append('form_process' , 'new participant');	
	
	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/process/p_f-trainer-new-participant.php', //Your form processing file URL
        data    : form_data, 
        dataType: 'json',
        contentType: false,
       	cache: false,
   		processData:false,  
        success	: function(data) {
			if (!data.success) { //If fails
				//alert(data.errors);
				danger ('Process Error', data.errors) 
				$('#staff_no').val('');
			} else {

				//var result = $.parseJSON($(data.staff_info)); 
				$.each(data.staff_info, function( key, value ) { 
					$('#staff_name').val(value['staff_name']);
					$('#email').val(value['email']);
				})
			}
							
		},
		error	: function (xhr, ajaxOptions, thrownError) {
			danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
			console.log(xhr.status);
			console.log(xhr.responseText);
			console.log(thrownError);
			console.log('There is unknown error occurs. Please contact administrator for system verification');
			console.log(xhr.responseText);
		}
			
   	});

}


