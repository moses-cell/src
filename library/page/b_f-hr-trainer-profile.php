<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_hr-trainer-profile.php';


	$glib = new globalLibrary();
	$hr_tm = new c_hr_trainer_profile();
	$empdata = "";
	$trainingdata = "";
	$academicdata = "";

	$rec = array();
	$result = ['Data'=>$rec];
	$data = json_encode($result,JSON_HEX_APOS);
	$empdata = json_encode($result,JSON_HEX_APOS);
	$academicdata = json_encode($result,JSON_HEX_APOS);
	$trainingdata = json_encode($result,JSON_HEX_APOS);

	$_SESSION['academic_id'] = '';
	$_SESSION['emp_id'] = '';
	$_SESSION['training_id'] = '';

	if (isset($_GET['id'])) {

		$_SESSION['page_id'] = '';	
		if (isset($_GET['id']))
			$_SESSION['page_id'] = $_GET['id'];


		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$rec = $hr_tm->_get_record_by_id($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


		if (isset($_GET['emp'])) {
			$_SESSION['emp_id'] = $_GET['emp'];
			$id = $glib->encrypt_decrypt('decrypt', $_GET['emp'], 'id');
			$rec = $hr_tm->_get_emp_record_by_id($id);
			$result = ['Data'=>$rec];

			$empdata = json_encode($result,JSON_HEX_APOS);

		} elseif (isset($_GET['aca'])) {
			

			$_SESSION['academic_id'] = $_GET['aca'];
			$id = $glib->encrypt_decrypt('decrypt', $_GET['aca'], 'id');
			$rec = $hr_tm->_get_academic_record_by_id($id);
			$result = ['Data'=>$rec];

			$academicdata = json_encode($result,JSON_HEX_APOS);

		} elseif (isset($_GET['training'])) {

			$_SESSION['training_id'] = $_GET['training'];
			$id = $glib->encrypt_decrypt('decrypt', $_GET['training'], 'id');
			$rec = $hr_tm->_get_training_record_by_id($id);

			//print_r($rec);

			$result = ['Data'=>$rec];

			$trainingdata = json_encode($result,JSON_HEX_APOS);
		}


		

	} elseif (isset($_GET['staff_no'])) {

		require_once dirname(dirname(__FILE__)). '/class/c_staff.php';

		$rec = $hr_tm->_get_record_by_staff_no($_POST['staff_no']);
		if (count($rec) > 0) {
			$form_data['success'] = false;
			$form_data['errors'] = 'Staff no already registered as a trainer.';

		} else {
			$c_staff = new c_staff();
			$rec = $c_staff->_get_staff_info($_POST['staff_no']);
			if (count($rec) > 0) {
				$form_data['success'] = true;
				$form_data['staff_info'] = $rec;
			} else {
				$form_data['success'] = false;
				$form_data['errors'] = 'Staff no not found in registered staff records';

			}

		}


		echo json_encode($form_data);
		return;	


	} elseif (isset($_GET['email'])) {


		$rec = $hr_tm->_get_record_by_email($_POST['email']);
		if (count($rec) > 0) {
			$form_data['success'] = false;
			$form_data['errors'] = 'Email address already registered as a trainer.';

		} else {
			$form_data['success'] = true;
		}


		echo json_encode($form_data);
		return;	


	} else {
		$_SESSION['page_id'] = '';
		
	}



?>