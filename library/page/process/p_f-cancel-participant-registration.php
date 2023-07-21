<?php

	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_training-application.php';


	$glib = new globalLibrary();
	$hr_tm = new c_training_application();

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else {
		$form_data['errors'] = "Unable to cancel participant registration";	
		$form_data['success'] = false;
	}

	if (isset($_POST['form_process'])) {
		$form_process = $_POST['form_process'];
	} else {
		$form_data['errors'] = "Unable to cancel participant registration";	
		$form_data['success'] = false;

	}

	if (isset($_POST['reason'])) {
		$reason = $_POST['reason'];
	} else {
		$form_data['errors'] = "Unable to cancel participant registration";	
		$form_data['success'] = false;

	}

	if ($form_process == 'Cancel_Participant') {
		$data = $hr_tm->_get_participant_attendance($id);
		if (count($data) > 0) {

			if ($hr_tm->_cancel_participant_registration($id, $reason) == false) {
				$form_data['errors'] = "Unable to update participant attendance";	
				$form_data['success'] = false;	
			} else {
				$form_data['success'] = true;
			}

		} else {
			$form_data['errors'] = "Unable to cancel participant registration";	
			$form_data['success'] = false;
		}	
	} else {
		$form_data['errors'] = "Unable to cancel participant registration" . $form_process;	
		$form_data['success'] = false;
	}
	

	echo json_encode($form_data);
	return;

?>