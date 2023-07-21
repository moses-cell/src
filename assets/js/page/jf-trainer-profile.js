$(document).ready(function(){

	DateElement(true, getCurrentYear()-60, getCurrentYear(), 'dob', '','')

	$('.close_btn').click(function() {
		location.href = 'l-hr-trainer-profile.php'
	})

	$('#HRSectionGroup').show();

	$('#profile_tab').click(function() {
		$('#working_tab').removeClass('tab-link-active');
		$('#academic_tab').removeClass('tab-link-active');
		$('#profile_tab').addClass('tab-link-active');
		$('#training_tab').removeClass('tab-link-active');
		$('#profile_form').show();
		$('#working_form').hide();
		$('#academic_form').hide();
		$('#training_form').hide();

	})

	$('#working_tab').click(function() {

		if ($('#pageid').val() == '') {
			danger ('Trainer Profile', 'Please save trainer profile before move to other tabs');
			return; 
		}

		$('#working_tab').addClass('tab-link-active');
		$('#academic_tab').removeClass('tab-link-active');
		$('#profile_tab').removeClass('tab-link-active');
		$('#training_tab').removeClass('tab-link-active');
		$('#profile_form').hide();
		$('#working_form').show();
		$('#academic_form').hide();
		$('#training_form').hide();

        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();

	})

	$('#academic_tab').click(function() {
		if ($('#pageid').val() == '') {
			danger ('Trainer Profile', 'Please save trainer profile before move to other tabs');
			return; 
		}
		$('#working_tab').removeClass('tab-link-active');
		$('#academic_tab').addClass('tab-link-active');
		$('#profile_tab').removeClass('tab-link-active');
		$('#training_tab').removeClass('tab-link-active');
		$('#profile_form').hide();
		$('#working_form').hide();
		$('#academic_form').show();
		$('#training_form').hide();

        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();

	})

	$('#training_tab').click(function() {
		if ($('#pageid').val() == '') {
			danger ('Trainer Profile', 'Please save trainer profile before move to other tabs');
			return; 
		}
		$('#working_tab').removeClass('tab-link-active');
		$('#academic_tab').removeClass('tab-link-active');
		$('#profile_tab').removeClass('tab-link-active');
		$('#training_tab').addClass('tab-link-active');
		$('#profile_form').hide();
		$('#working_form').hide();
		$('#academic_form').hide();
		$('#training_form').show();

        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();


	})


	var hash = $(location).attr('hash');
	if (hash == '#profile') {
		$('#profile_tab').trigger('click')
	} else if (hash == '#working') {
		$('#working_tab').trigger('click')
	} else if (hash == '#academic') {
		$('#academic_tab').trigger('click')
	} else if (hash == '#training') {
		$('#training_tab').trigger('click')
	}

	$('#uploadpic').click(function() {
		$('#pic').click();
	})

	$('#pic').change(function() {
	    trainerpic.src=URL.createObjectURL(event.target.files[0])
	})

	trainer_type()

	$('[name="trainer_type"]').change(function() {
		trainer_type();
	})

})

function trainer_type() {
	if($('#internal').is(':checked')) {
		$('#staff_no').prop('disabled', false);
		$('#fullname').prop('readonly', true);
		$('#email').prop('readonly', true);
	}
	if($('#external').is(':checked')) {
		$('#staff_no').prop('disabled', true);
		$('#staff_no').val("");
		$('#fullname').prop('readonly', false);
		$('#fullname').val("");
		$('#email').prop('readonly', false);
		$('#email').val("");
	} 
}


function upload() {
    $('#pic').click();

}


