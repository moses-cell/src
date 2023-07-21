<?php

	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_training-application.php';


	$glib = new globalLibrary();
	$hr_tm = new c_training_application();



	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		$form_data['errors'] = "Unable to cancel participant";	
		$form_data['success'] = false;
	}

	if (isset($_GET['key'])) {
		$key = $_GET['key'];
	} else {
		$form_data['errors'] = "Unable to cancel participant";	
		$form_data['success'] = false;

	}




	$sch_id = $glib->encrypt_decrypt('decrypt', $id, 'id');
	$id = $glib->encrypt_decrypt('decrypt', $key, 'id');

	$data = $hr_tm->_get_participant_attendance($id);
	if (count($data) > 0) {

		$staff_no = $data[0]['staff_no'];
		$trainer_created = $data[0]['trainer_created'];


		if ($trainer_created == '1') {

			if ($hr_tm->_trainer_reinstate_participant_registration($data[0]['replace_staff_no'], $staff_no, $sch_id) == false) {
				$form_data['errors'] = "Unable to update participant attendance";	
				$form_data['success'] = false;	
			} else {
				if ($hr_tm->_trainer_cancel_participant_registration($id) == false) {
					$form_data['errors'] = "Unable to update participant attendance";
					$form_data['success'] = false;
				} else {
					$form_data['success'] = true;
				}
			}
		} else {
			$form_data['errors'] = "Unable to update participant attendance";	
			$form_data['success'] = false;	
		}
		

	} else {
		$form_data['errors'] = "Unable to cancel participant registration";	
		$form_data['success'] = false;
	}
	
	
	

	echo json_encode($form_data);
	return;

?>