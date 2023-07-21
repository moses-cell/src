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
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before training module can be saved');
			return;
		}


		form_data.push({name: 'form_process' , value: 'Save'});

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-adm-emp-grade.php', //Your form processing file URL
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
		$('#grade').val(value['grade']);
		$('#desc').val(value['description']);

		checkbox_check('enable', '1', value['status'])
		
		$('#grade').attr('readonly', true);
		
	})
}


function validateSave(form_data) {
	$('.error_field').remove();

	validateElement('text','data_form','grade', 'Please enter employee grade');
	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

function validate() {

	$('.error_field').remove();
	fieldname = '';

	var cloneIndex = $(".kpi_info").length;
	if (cloneIndex < 5) {
		$('#processbutton').after('<div id="errorprocessbutton" style="padding-top: 35px;padding-right: 15px;" class="error_field">Minimum KPI entry is 5</div>');
	} 

	if ($('#WeightageTotal').val() > 100 ) {
		$('#Weightage').after('<div id="errorWeightage" class="error_field">Total Weightage must be 100%</div>');
	} else if ($('#WeightageTotal').val() < 100 ) {
		$('#Weightage').after('<div id="errorWeightage" class="error_field">Total Weightage must be 100%</div>');
	} 

	validateElement('textarea', 'ppc' ,'TrainingExpectation', 'Please enter Training Requirement')

	for (i = 1; i <= cloneIndex; i++) {

		validateElement('number', 'ppc', 'Weightage' + i, 'KPI weightage must be between 5% to 30%', 5 , 30 );
		validateElement('textarea', 'ppc' ,'PerformanceObjectives' + i, 'Please enter Performance Objective');
		validateElement('textarea', 'ppc' ,'KPI' + i, 'Please enter Key Performance Index');
		validateElement('textarea', 'ppc' ,'KPIM' + i, 'Please enter Key Performance Indicator / Measure');
		validateElement('textarea', 'ppc' ,'TST' + i, 'Please enter Tracking Source / Tool');
		validateElement('textarea', 'ppc' ,'ActionPlan' + i, 'Please enter Action Plan');
		validateElement('textarea', 'ppc' ,'Rank1_' + i, 'Please enter Rank 1');
		validateElement('textarea', 'ppc' ,'Rank2_' + i, 'Please enter Rank 2');
		validateElement('textarea', 'ppc' ,'Rank3_' + i, 'Please enter Rank 3');
		validateElement('textarea', 'ppc' ,'Rank4_' + i, 'Please enter Rank 4');
		validateElement('textarea', 'ppc' ,'Rank5_' + i, 'Please enter Rank 5');
		validateElement('radio', 'ppc' ,'kpi_type' + i, 'Please select KPI Type');
		validateElement('select', 'ppc' ,'KPIInfo' + i, 'Please select KPI Information');


	}



	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;

}



