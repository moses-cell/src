$(document).ready(function(){
	
	
	$('#close').click(function(e) {
		window.parent.CloseDialog();
	})

	$('#report').click(function() {

		generate_report();
	})
})

function generate_report() {
	
		
		form_data = new FormData($('form')[0]);

		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before staff profile can be uploaded');
			return;
		}

		m = $('#month').val();
		y = $('#year').val();
		location.href = 'report.xls.php?m=' + m + '&y='+y;

}






function validateSave(form_data) {
	$('.error_field').remove();

	form = 'data_form';

	validateElement('select',form,'month', 'Please select month');
	validateElement('select',form,'year', 'Please select year');
	

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

