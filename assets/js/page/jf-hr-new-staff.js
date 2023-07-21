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


	$('#sec_name').on('change', function() {
		$('#sec_email').val(this.value);
		$('#sec_staff_no').val($('option:selected', this).attr('staff_no'));

	})

	$('#depoh_name').on('change', function() {
		$('#depoh_email').val(this.value);
		$('#depoh_staff_no').val($('option:selected', this).attr('staff_no'));
	})


	$('.name_select').keyup(function() {
		if (this.id == 'super_name') {
			id = 'super_list';
			width = $(this).innerWidth();
			//super_name = $('#super_name').val();
		} else {
			id = 'appr_list';
			width = $(this).innerWidth();
			//appr_name = $('#appr_name').val();
		}
		select_name_click = false;
		if ($(this).val().length >= 1) {
			$.ajax({
				type: "POST",
				url: "library/page/b_global_parameter.php",
				data:'staff_name='+$(this).val(),
				success: function(data){
					$("#"+id).show();
					$("#"+id).html(data);
					$("#staff_list").width(width);
					$("#"+id).css("background","#FFF");
				}
			});
		}
	}).focusout(function() {
		id = this.id;
		setTimeout(function () {
			if (select_name_click == false) {
				if (id == 'super_name') {
					//alert($('#'+id).val());
					//alert(super_name);
					if ($('#'+id).val() != super_name) {
						$('#super_name').val('');
						$('#super_no').val('');
						$('#super_email').val('');							
					} 
				} else {
					if ($('#'+id).val() != appr_name) {
						$('#appr_name').val('');
						$('#appr_no').val('');
						$('#appr_email').val('');	
					}
				}	
			}	

			$('.staff_list').hide()
		},250);

	}).siblings().on('click','li', function() {
		select_name_click = true;
		id = $(this).parent().parent().attr('id');
		if (id == 'super_list') {
			$('#super_name').val($(this).html());
			$('#super_no').val(this.id);
			$('#super_email').val($(this).attr('email'));
		}
		if (id == 'appr_list') {
			$('#appr_name').val($(this).html());
			$('#appr_no').val(this.id);
			$('#appr_email').val($(this).attr('email'));
		}
		$('.staff_list').hide()

	})


	$('#close_dialog').click(function(e) {
		//CloseDialog();
		window.parent.HideModalWindow()
		//window.parent.CloseDialog();
		//window.opener.location.reload();
	})


	$('#save').click(function() {

		form_data = $("#new_staff").serializeArray();
		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before training module can be saved');
			return;
		}


		form_data.push({name: 'form_process' , value: 'Update Staff'});

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-hr-staff-profile.php', //Your form processing file URL
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

function validateSave(form_data) {
	$('.error_field').remove();

	validateElement('text','new_participant','staff_no', 'Please enter staff no');
	validateElement('text','new_participant','staff_name', 'Please enter staff name');

	validateElement('text','new_participant','appr_name', 'Please enter Approver Name');
	validateElement('text','new_participant','appr_no', 'Please enter Approver Name');
	validateElement('email','new_participant','appr_email', 'Please enter Approver Name');

	var pageURL = $(location).attr("href");
	if( pageURL.match( /super=1/ig ) !== null ) {
		validateElement('text','new_participant','super_name', 'Please enter Supervisor Name');
		validateElement('text','new_participant','super_no', 'Please enter Supervisor Name');
		validateElement('email','new_participant','super_email', 'Please enter Supervisor Name');

	}
	
	validateElement('select','new_participant','sec_name', 'Please select Secretary / Administrator Name');	

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function get_staff_info() {

	form_data = new FormData($('#new_staff')[0]);
	form_data.append('form_process' , 'new staff');	
	
	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/process/p_f-hr-staff-profile.php', //Your form processing file URL
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
					$('#appr_no').val(value['appr_no']);
					$('#appr_name').val(value['appr_name']);
					$('#appr_email').val(value['appr_email']);
					$('#super_no').val(value['super_no']);
					$('#super_name').val(value['super_name']);
					$('#super_email').val(value['super_email']);
					$('#sec_name').val(value['secretary_email']);
					$('#sec_email').val(value['secretary_email']);
					$('#depoh_name').val(value['depoh_admin_email']);
					$('#depoh_email').val(value['depoh_admin_email']);
			
					$('#sec_staff_no').val(value['secretary_staff_no']);
					$('#depoh_staff_no').val(value['depoh_admin_staff_no']);

					if ( $("#sec_name option[value='" + value['secretary_email']+ "']").length == 0 ){
						$('#sec_name').val('');
						$('#sec_email').val('');
						$('#sec_staff_no').val('');
					}

					if ( $("#depoh_name option[value='" + value['depoh_admin_email']+ "']").length == 0 ){
						$('#depoh_name').val('');
						$('#depoh_email').val('');
						$('#depoh_staff_no').val('');
					}

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
