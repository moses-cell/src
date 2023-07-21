$(document).ready(function(){

	populate_data();
	intern_name = '';
	select_name_click = false;

    $('#InternSectionGroup').show();

	
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

	$('.name_select').keyup(function() {
		id = 'intern_list';
		width = $(this).innerWidth();
		select_name_click = false;

		if ($('#month').val() == '') {
			warning ('Process Error','Please select month and year before select student name');
			$('#month').focus();
			return false;
		}

		if ($('#year').val() == '') {
			warning ('Process Error','Please select month and year before select student name');
			$('#year').focus();
			return false;
		}

		if ($(this).val().length >= 1) {
			$.ajax({
				type: "POST",
				url: "library/page/b_global_parameter.php",
				data:'intern_name='+$(this).val(),
				success: function(data){
					$("#"+id).show();
					$("#"+id).html(data);
					$("#intern_list").width(width);
					$("#"+id).css("background","#FFF");
				}
			});
		}
	}).focusout(function() {
		id = this.id;
		setTimeout(function () {
			if (select_name_click == false) {
				
				if ($('#'+id).val() != intern_name) {
					$('#student_name').val('');
					$('#ic_no').val('');
					resetData();
				} 
			}	

			$('.intern_list').hide()
		},250);

	}).siblings().on('click','li', function() {
		select_name_click = true;
		id = $(this).parent().parent().attr('id');
		$('#student_name').val($(this).html());
		$('#ic_no').val(this.id);
		resetData();
		$('.intern_list').hide()

	})

	$('#year').on('change', function() {
		resetData();
	})

	$('#month').on('change', function() {
		resetData();
	})
	

	$('#close').click(function(e) {
		window.parent.CloseDialog();
	})

	$('.leave_calculate').on('blur', function() {

		calculate();



	})


	$('#verify').click(function() {

		form_data = new FormData($('form')[0]);
		form_data.append('form_process' , 'Verify');

		if (validateVerify(form_data) == false) {
			jump_to_error_field();
			warning('Validation Failed', 'Please correct all the errors before infernship allowance form can be saved');
			return;
		}

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-intern-allowance.php', //Your form processing file URL
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
					$('#email').val(data.data[0]['email']);
					$('#department').val(data.data[0]['department']);
					$('#bank_name').val(data.data[0]['bank_name']);
					$('#acc_no').val(data.data[0]['acc_no']);
					$('#mc').val(data.data[0]['mc_allowance']);
					$('#monthly_allowance').val(data.data[0]['monthly_allowance']);
					$('#sdate').val(data.data[0]['date_start']);
					$('#edate').val(data.data[0]['date_end']); 
					$('#allowance_history').html(data.history);
					$('#total_mc_leave').val(data.mc)
					$('#intern_id').val(data.data[0]['id'])

					//success ('Success', 'Record successfully saved');
					//redirect_delay('l-hr-intern-profile.php');
				}
							
			},
			error	: function (jqXHR, ajaxOptions, thrownError) {
				$("#loading-overlay").hide();
				danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
				console.log('There is unknown error occurs. Please contact administrator for system verification');
				console.log(jqXHR.status);
				console.log(jqXHR.responseText);
				console.log(thrownError);
			}
			
        });



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
            url     : 'library/page/process/p_f-intern-allowance.php', //Your form processing file URL
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
			}
			
        });

	})

})




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

		$('#month').val(value['month']);
		$('#year').val(value['year']);
		$('#mc_leave_taken').val(value['mc_leave_taken']);
		$('#total_leave_taken').val(value['leave_taken']);
		$('#total_mc_leave').val(value['total_mc_leave_taken'] -  value['mc_leave_taken'])
		$('#unpaid_leave_taken').val(value['unpaid_leave']);
		$('#total_unpaid_leave').val(value['total_unpaid_leave']);
		$('#working_day').val(value['working_day']);
		$('#actual_work_day').val(value['leave_taken']);
		$('#allowance_paid').val(value['allowance']);
		$('#add_deduction').val(value['add_deduction'])
		

		
	})

	$.each(result.Intern, function( key, value ) { 
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
	

		$('#save').hide();
		$('#verify').hide();
		$('#month').attr('disabled',true);
		$('#year').attr('disabled',true);	
		$('input').attr('readonly',true);
	})

	$('#allowance_history').html(result.history);

	DateElement(false, getCurrentYear()-1, getCurrentYear()+1, 'sdate', 'edate','tdays')
	calculate()
}


function validateVerify(form_data) {
	$('.error_field').remove();

	form = 'data_form';
	validateElement('text',form,'ic_no', 'Please enter IC No');
	validateElement('text',form,'student_name', 'Please enter student name');
	validateElement('select',form,'month', 'Please select month');
	validateElement('select',form,'year', 'Please select year');
	
	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;
}


function validateSave(form_data) {
	$('.error_field').remove();

	form = 'data_form';
	validateElement('text',form,'ic_no', 'Please enter IC No');
	validateElement('text',form,'student_name', 'Please enter student name');
	validateElement('select',form,'month', 'Please select month');

	validateElement('year',form,'year', 'Please select year');
//	validateElement('date',form,'edate', 'Please enter internship end date');

	validateElement('text',form,'bank_name', 'Please select bank name');
	validateElement('text',form,'acc_no', 'Please select bank account number');
	
	validateElement('number',form, 'monthly_allowance', 'Please enter monthly allowance (minimum 0)',0);
	validateElement('number',form, 'daily_allowance', 'Please enter daily allowance (minimum 0)',0);
	validateElement('number',form, 'mc', 'Please enter Medical Leave allowance (minimum 0)',0);
	
	validateElement('number',form, 'mc_leave_taken', 'Please enter Medical Leave taken (minimum 0)',0);
	validateElement('number',form, 'add_deduction', 'Please enter Addition Working Days Deduction (minimum 0)',0);
	validateElement('number',form, 'total_leave_taken', 'Please enter Total Leave taken (minimum 0)',0);
	validateElement('number',form, 'unpaid_leave_taken', 'Please enter Total Unpaid Leave taken (minimum 0)',0);
	validateElement('number',form, 'total_unpaid_leave', 'Total Unpaid Leave must be minimum 0',0);
	validateElement('number',form, 'working_day', 'Please enter Total Working Calendar Days (minimum 0)',0);
	validateElement('number',form, 'allowance_paid', 'Total Allowance Paid must be minimum 0',0);



	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function resetData() {
	$('#department').val('');
	$('#bank_name').val('');
	$('#acc_no').val('');
	$('#mc').val($(this).attr(''));
	$('#monthly_allowance').val('');
	$('#sdate').val('');
	$('#edate').val('');
	$('#allowance_history').html('');
	$('#email').val('');
	$('.leave_calculate').trigger('blur');
}


function calculate() {
		mc_taken = 0;
		total_leave_taken = 0;
		unpaid_leave_taken = 0;

		mc = $('#mc').val();
		total_mc_taken = $('#total_mc_leave').val();

		/*if (isNaN(mc))
			mc = 0;
		if (isNaN(total_mc_taken))
			total_mc_taken = 0;*/

		mc = is_number_value(mc);
		total_mc_taken = is_number_value(total_mc_taken);

		//$(this).val(is_number_value($(this).val()))

		mc_taken = is_number_value($('#mc_leave_taken').val());
		unpaid_leave_taken = is_number_value($('#unpaid_leave_taken').val());

		if (parseFloat(mc_taken).toFixed(1) == 0) {
			total_mc = 0.0;
		} else {
			
			if (parseFloat(total_mc_taken).toFixed(1) > parseFloat(mc).toFixed(1))
				total_mc = 	 parseFloat(mc_taken).toFixed(1);
			else
				total_mc = (parseFloat(mc_taken).toFixed(1)*1) + (parseFloat(total_mc_taken).toFixed(1)*1) - (parseFloat(mc).toFixed(1)*1);
					
			if (total_mc < 0)
				total_mc = 0.0;	
		}
		

		total_unpaid = (parseFloat(total_mc).toFixed(1) * 1) + (parseFloat(unpaid_leave_taken).toFixed(1) *1);
		if (total_unpaid < 0.0)
			total_unpaid = 0.0;
		$('#total_unpaid_leave').val(parseFloat(total_unpaid).toFixed(1));

		calendar_day = $('#working_day').val();
		calendar_day = is_number_value(calendar_day);

		total_leave_taken = is_number_value($('#total_leave_taken').val())
		add_deduct = is_number_value($('#add_deduction').val())

		actual_work_day = (calendar_day) - (unpaid_leave_taken) - (mc_taken) - (total_leave_taken) - (add_deduct);
		if (actual_work_day < 0) 
			actual_work_day = 0;

		$('#actual_work_day').val(parseFloat(actual_work_day).toFixed(1));

		monthly_allowance = $('#monthly_allowance').val();
		monthly_allowance = is_number_value(monthly_allowance);


		daily_allowance = monthly_allowance / calendar_day;
		daily_allowance = is_number_value(daily_allowance);
		//daily_allowance = is_number_value(total_mc_taken);
		$('#daily_allowance').val(daily_allowance.toFixed(2))
		daily_allowance = $('#daily_allowance').val();

		allowance_paid = (monthly_allowance / calendar_day) * (calendar_day - total_unpaid - add_deduct);
		$('#allowance_paid').val(allowance_paid.toFixed(2));


}