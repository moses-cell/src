<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_training-application.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_staff.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_mailer.php';

	$glib = new globalLibrary();
	$mailer = new email_process();

	$_SESSION['full_name'] = $_POST['editor_name'];

	if (!isset($_POST['form_process'])) {
		$ta->error_generator(15, true);	
		return;		
	}
	
	$ta = new c_training_application();
	$staff = new c_staff();

	if (isset($_POST['form_process'])) {

		if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {


			if ($_POST['pageid'] != '')
				$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
			else
				$_POST['id'] = '';
						
			$sch_id = $glib->encrypt_decrypt('decrypt', $_POST['sch_id'],'id' );
			$staff_no = $glib->encrypt_decrypt('decrypt', $_POST['staff_no'],'id' );

			$staff_data = $staff->_get_staff_info($staff_no);
			$training_data = $ta->_get_training_schedule($sch_id);
			//$training_data = $ta->_get_training_schedule($_POST['sch_id']);
			//$staff_data = $staff->_get_staff_info($_POST['staff_no']);

			if (count($staff_data) <= 0) {
				$ta->error_generator(1, true);	
				return;
			} 

			if (count($training_data) <= 0) {
				$ta->error_generator(2, true);
				return;
			} 


			$staff_data = $staff_data[0];
			$training_data = $training_data[0];

			$participant = $ta->_get_training_participant_list($sch_id);
			$total_particpant = count($participant);

			if ($total_particpant >= $training_data['max_sit']) {
				$ta->error_generator(28, true);
				return;
			} 



			//print_r($staff_data);
			
			if ($glib->who_can_apply ($training_data['eligibility'], $_SESSION) == false) {
				$ta->error_generator(3, true);
				return;
			} 

			if ($glib->target_audience ($training_data['audience'], $staff_data) == false) {
				$ta->error_generator(4, true);
				return;
			} 

			if (count($ta->_get_training_registered($training_data, $staff_data)) > 0) {
				$ta->error_generator(5, true);
				return;
			}


			if ($training_data['approval'] == '1') {
				
				if ($ta->_submit_staff_training_for_approval($training_data, $staff_data) == false) {
					$ta->error_generator(6, true);
					return;
				} else {
					$mailer->request_training_approval($training_data, $staff_data);
				}
			} else {

				if ($ta->_auto_approve_staff_training($training_data, $staff_data) == false) {
					$ta->error_generator(4, true);
					return;
				}
			}

			$form_data['success'] = true;
			echo json_encode($form_data);
			return;

		}

	} 


	if ($_POST['pageid'] != '')
		$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
	else
		$_POST['id'] = '';


	//echo $_POST['staff_no'];
	$sch_id = $_POST['sch_id'];
//	if ($_POST['form_process'] == 'Request Cancel' ) 
		$staff_no = $_POST['staff_no'];
//	else
//		$staff_no = $glib->encrypt_decrypt('decrypt', $_POST['staff_no'],'id' );
			

	$staff_data = $staff->_get_staff_info($staff_no);
	$training_data = $ta->get_training_info($_POST['id']);

	//$sch_data = $ta->_get_training_schedule($sch_id);

			
	if (count($staff_data) <= 0) {
		$ta->error_generator(1, true);	
		return;
	} 

	if (count($training_data) <= 0) {
		$ta->error_generator(27, true);
		return;
	} 



	$staff_data = $staff_data[0];
	$training_data = $training_data[0];
	//$sch_data = $sch_data[0];

	$sch_data = $ta->_get_training_schedule($training_data['sch_id']);
	if (count($sch_data) <= 0) {
		$ta->error_generator(2, true);
		return;
	} 

	$sch_data = $sch_data[0];


	if ($_POST['form_process'] == 'Approve' ) {

		if ($_POST['is_request'] == '1') {
			$_POST['form_process'] = "Submit to HR";
		}

		if ($ta->_approve_decision() == false ) {
			$ta->error_generator(16, true);
			return;
		}

		$mailer->approved_training_request($sch_data, $staff_data);
		$form_data['success'] = true;
		$form_data['process'] = 'Approve';
		$mailer->send_training_request_to_HR($sch_data, $staff_data);
		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'Approve Bonding' ) {

		if ($_POST['is_request'] == '1') {
			$_POST['form_process'] = "Approve";
		}

		if ($ta->_approve_decision(true) == false ) {
			$ta->error_generator(16, true);
			return;
		}

		$mailer->approved_training_request($sch_data, $staff_data);
		$form_data['success'] = true;
		$form_data['process'] = 'Approve';
		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'Approve HR' ) {

		if ($_POST['is_request'] == '1') {
			$_POST['form_process'] = "Approve";
		}

		if ($ta->_approve_decision(false, true) == false ) {
			$ta->error_generator(16, true);
			return;
		}

		$mailer->approved_training_request($sch_data, $staff_data);
		$form_data['success'] = true;
		$form_data['process'] = 'Approve';
		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'Approve Without Bonding' ) {

		if ($_POST['is_request'] == '1') {
			$_POST['form_process'] = "Approve";
		}

		if ($ta->_approve_decision() == false ) {
			$ta->error_generator(16, true);
			return;
		}

		$mailer->approved_training_request($sch_data, $staff_data);
		$form_data['success'] = true;
		$form_data['process'] = 'Approve';
		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'Reject' ) {

		if ($ta->_approve_decision() == false ) {
			$ta->error_generator(16, true);
			return;
		}

		$mailer->reject_training_request($sch_data, $staff_data);
		$form_data['success'] = true;
		$form_data['process'] = $_POST['form_process'];
		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'Cancel' ) {

		if ($ta->_approve_decision_cancel() == false ) {
			$ta->error_generator(16, true);
			return;
		}

		$mailer->cancel_training_request($sch_data, $staff_data);
		$form_data['success'] = true;
		$form_data['process'] = $_POST['form_process'];
		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'Reject Cancel' ) {

		$_POST['form_process'] = 'Approve';
		if ($ta->_reject_cancel_decision() == false ) {
			$ta->error_generator(16, true);
			return;
		}

		$_POST['form_process'] = 'Reject Cancel';
		$mailer->reject_cancel_training_request($sch_data, $staff_data);
		$form_data['success'] = true;
		$form_data['process'] = $_POST['form_process'];
		echo json_encode($form_data);
		return;

	}


	if ($_POST['form_process'] == 'Request Cancel' ) {

		if (isset($sch_data['id'])) {

			if ($training_data['status'] == 'Submit for Approval') {
				if ($ta->_auto_training_cancellation() == false ) {
					$ta->error_generator(17, true);
					return;
				}
			} else {
				if ($sch_data['approval'] == '1') {
					if ($ta->_submit_for_cancellation() == false ) {
						$ta->error_generator(17, true);
						return;
					}

					$mailer->request_training_cancellation($sch_data, $staff_data);

				} else {
					if ($ta->_auto_training_cancellation() == false ) {
						$ta->error_generator(17, true);
						return;
					}
				}
			}

			

			$form_data['success'] = true;
			$form_data['process'] = $_POST['form_process'];
			echo json_encode($form_data);
			return;
		} else {
			$ta->error_generator(17, true);
			return;
		}

		

	}






?>