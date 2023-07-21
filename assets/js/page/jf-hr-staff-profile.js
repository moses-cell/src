
$(document).ready(function(){

	populate_data();
	appr_name = '';
	super_name = '';
	select_name_click = false;
	$('#register').hide();

	var pageURL = $(location).attr("href");
	if( pageURL.match( /f-my-profile/ig ) !== null )
		$('#StaffSectionGroup').show();
	else if( pageURL.match( /f-hr-staff-profile/ig ) !== null )
    	$('#HRSectionGroup').show();

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




	$('#sec_name').on('change', function() {
		$('#sec_email').val(this.value);
		$('#sec_staff_no').val($('option:selected', this).attr('staff_no'));
	})

	$('#depoh_name').on('change', function() {
		$('#depoh_email').val(this.value);
		$('#depoh_staff_no').val($('option:selected', this).attr('staff_no'));
	})


	if ($('#sec_name').val() == '') {
		$('#sec_email').val('');
		$('#sec_staff_no').val('');
	}

	if ($('#depoh_name').val() == '') {
		$('#depoh_email').val('');
		$('#depoh_staff_no').val('');
	}

	if ($('option:selected', $('#sec_name')).attr('value') == '') {
		$('#sec_email').val('');
		$('#sec_staff_no').val('');
	}

	if ($('option:selected', $('#depoh_name')).attr('value') == '') {
		$('#depoh_email').val('');
		$('#depoh_staff_no').val('');
	}



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


/*	$('.staff_list').on('click','li',function() {
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

*/
	var hash = $(location).attr('hash');
	if (hash == '#application') {
		$('#training_tab').trigger('click')
	} else if (hash == '#participant') {
		$('#participant_tab').trigger('click')
	} 

	$('#close').click(function(e) {
		var pageURL = $(location).attr("href");
		if( pageURL.match( /f-my-profile/ig ) !== null )
			location.href = "dashboard.php";
		else if( pageURL.match( /f-hr-staff-profile/ig ) !== null )
			location.href = "l-hr-staff-profile.php";
		else if( pageURL.match( /f-hr-update-staff-profile/ig ) !== null )
			history.back(-1);
		else
			window.parent.HideModalWindow();

	})


	$('#save').click(function() {
		
		form_data = new FormData($('form')[0]);
		if (validateSave(form_data) == false) {
			jump_to_error_field();
			warning('Validation Failed', 'Please correct all the errors before record can be saved');
			return;
		}

		form_data.append('form_process' , 'Save');
		form_data.append('depoh_name' , $('#depoh_name option:selected').text());	
		form_data.append('sec_name' , $('#sec_name option:selected').text());		

		$.ajax({ //Process the form using $.ajax()
	        type    : 'POST', //Method type
	        url     : 'library/page/process/p_f-hr-staff-profile.php', //Your form processing file URL
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
					danger ('Process Error', data.errors) 
				} else {
					success ('Success', 'Staff Profile sucessfully updated.');
					var pageURL = $(location).attr("href");
					if( pageURL.match( /f-my-profile/ig ) !== null )
						redirect_delay('dashboard.php');
					else if( pageURL.match( /f-hr-staff-profile/ig ) !== null )
						redirect_delay("l-hr-staff-profile.php")
					else if( pageURL.match( /f-hr-update-staff-profile/ig ) !== null )
						$('#register').show();//redirect_delay(document.referrer)
					else {
						setTimeout(function() {
					  		window.parent.HideModalWindow();
						}, 4000);
						 //window.parent.HideModalWindow();
					}
 
					//redirect_delay('l-c-my-training.php');
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



	$("#register").click(function(){

        postform = new Array();

        postform.push ({name: 'form_process' , value: "Save"});
        postform.push ({name: 'pageid' , value: $('#trainingid').val()});
        postform.push ({name: 'editor_name' , value: $('#editor_name').val()});
        postform.push ({name: 'staff_no' , value: $('#pageid').val()});

        $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-hr-new-participant.php', //Your form processing file URL
            data    : postform, //Forms name
            dataType: 'json',
            beforeSend: function(){
                window.scrollTo(0, 0);
                $("#loading-overlay").show();
            },
            success : function(data) {
                $("#loading-overlay").hide();
                if (!data.success) { //If fails
                    danger ('Process Error', data.errors) 
                } else {
                    success ('Success', 'Training successfully register / submit for approval');
                }
            },
            error   : function (xhr, ajaxOptions, thrownError) {
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




})



function populate_data() {

	var result = $.parseJSON($('#data').val());

	$.each(result.Data, function( key, value ) { 
		$('#staff_no').val(value['staff_no']);
		$('#staff_name').val(value['staff_name']);
		$('#email').val(value['email']);
		$('#email2').val(value['email2']);
		$('#division').val(value['division']);
		$('#department').val (value['department']);
		$('#section').val(value['section']);
		$('#unit').val(value['unit']);
		$('#staff_position').val(value['position']);
		$('#personal_area').val(value['personal_area']);
		$('#subarea').val(value['personal_subarea']);
		$('#grade').val(value['grade']);
		$('#subgroup').val(value['employee_subgroup']);
		$('#status').val(value['status']);
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
		$('#group').val(value['org_group']);
		$('#personal_area').val(value['personal_area'])
		$('#meal').val(value['meal_type'])

		$('#ic').val(value['ic_no'])
		$('#tel').val(value['tel'])


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


function validateSave(form_data) {
	$('.error_field').remove();
	//return false;
	form = 'data_form';

	/*if ($('#email').val() == '') {
		validateElement('email',form,'email2', 'Please enter valid email');
	} else if ($('#email2').val() != '') {
		validateElement('email',form,'email2', 'Please enter valid email');
	}*/

	validateElement('text',form,'appr_name', 'Please enter Approver Name');
	validateElement('text',form,'appr_no', 'Please enter Approver Name');
	validateElement('email',form,'appr_email', 'Please enter Approver Name');

	var pageURL = $(location).attr("href");
	if( pageURL.match( /super=1/ig ) !== null ) {
		validateElement('text',form,'super_name', 'Please enter Supervisor Name');
		validateElement('text',form,'super_no', 'Please enter Supervisor Name');
		validateElement('email',form,'super_email', 'Please enter Supervisor Name');

	}

	
	validateElement('select',form,'sec_name', 'Please select Secretary / Administrator Name/Email');
	validateElement('select',form,'sec_staff_no', 'Please select Secretary / Administrator Staff No');	
	//validateElement('select',form,'depoh_name', 'Please select Depoh Admin Name');
	validateElement('select',form,'meal', 'Please select prefered meal type');

	
	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}


