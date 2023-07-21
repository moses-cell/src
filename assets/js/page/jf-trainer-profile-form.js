$(document).ready(function(){


	staff_no = '';
	email = '';
	populate_profile_data();


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

	$('#email').on('focusin', function(){
		email = $('#email').val();
	})
	$('#email').on('focusout', function(){

		if ($('#email').val() == '')
			return;

		if (email != $('#email').val() ) {
			get_external_trainer_info();
		}
		
	})


	$('#save_trainer').click(function() {
		form_data = new FormData($('#trainer_profile')[0]);

		if (validateProfile(form_data) == false) {
			jump_to_error_field();
			warning('Validation Failed', 'Please correct all the errors before trainer profile can be saved');
			return;
		}

		form_data.append('form_process' , 'profile');
		form_data.append('trainer_type' , $('input[name="trainer_type"]:checked').val());

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
								redirect_delay('f-hr-trainer-profile.php?id=' + data.id);
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

function validateProfile(form_data) {
	$('.error_field').remove();

	form = 'trainer_profile';

	if($('#internal').is(':checked')) {
		validateElement('text',form,'staff_no', 'Please enter staff no');
	}

	validateElement('text',form,'fullname', 'Please enter trainer name');
	validateElement('text',form,'DOB', 'Please enter trainer date of birth');
	validateElement('text',form,'email', 'Please enter trainer email');
	validateElement('text',form,'ic', 'Please enter trainer Identification number');
	validateElement('select',form,'maritalstatus', 'Please select trainer marital status');
	validateElement('text',form,'address', 'Please enter trainer address');
	validateElement('text',form,'phone', 'Please enter trainer telephone number');

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function populate_profile_data() {

	var result = $.parseJSON($('#data').val());

	$.each(result.Data, function( key, value ) { 
		
		radio_check('internal', 'internal' , value['internal_trainer'].toLowerCase())
		radio_check('external', 'external' , value['internal_trainer'].toLowerCase())
		checkbox_check('disable_trainer', '0' , value['status'])
		trainer_type();
		$('#internal').prop('disabled', true);
		$('#external').prop('disabled', true);

		$('#staff_no').val(value['staff_no']);
		$('#staff_no').prop('readonly', true);
		$('#fullname').val(value['trainer_name']);
		$('#email').val(value['email']);
		//$('select[name=trainingprovider]').val(value['provider'])

		$('#ic').val(value['ic']);
		
		$('#phone').val(value['tel']);
		$('#address').val(value['add1']);
		$('select[name=maritalstatus]').val(value['marital_status']);
		$('#picture').val('');

		if (value['picture'] === undefined) 
			trainerpic.src = 'assets/img/avatar.png';
		else if (value['picture'] == null) 
			trainerpic.src= 'assets/img/avatar.png';	
		else if (value['picture'] == '') 
			trainerpic.src = 'assets/img/avatar.png';
		else {
			trainerpic.src= (value['picture']);
			$('#picture').val(value['picture']);
		}
		
		$('#dob').val(formatdate(value['dob'], 1, 'date-only'));
		$('#fullname').prop('readonly', true);
		$('#email').prop('readonly', true);



		
	})

	
}

function get_staff_info() {

	form_data = new FormData($('#trainer_profile')[0]);
	
	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/b_f-hr-trainer-profile.php?staff_no', //Your form processing file URL
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
					$('#fullname').val(value['staff_name']);
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

function get_external_trainer_info() {
	
	form_data = new FormData($('#trainer_profile')[0]);

	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/b_f-hr-trainer-profile.php?email=' + $('#email').val(), //Your form processing file URL
        data    : form_data,
        dataType: 'json',
        contentType: false,
       	cache: false,
   		processData:false,  
        success	: function(data) {
			if (!data.success) { //If fails
				//alert(data.errors);
				danger ('Process Error', data.errors);
				$('#email').val('');
			} else {
				return;
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