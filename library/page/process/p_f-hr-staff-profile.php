<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_staff.php';


	$glib = new globalLibrary();
	$c_staff = new c_staff();



	if ($_POST['form_process'] == 'Save' ) {
		$_SESSION['full_name'] = $_POST['editor_name'];


		$_POST['id'] = '';
		$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );

		
		if ($c_staff->_save_record()) {
			
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while saving Staff Profile";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'new staff' ) {

		$rec = $c_staff->_get_staff_info($_POST['staff_no']);
		if (count($rec) > 0) {
			$form_data['success'] = true;
			$form_data['staff_info'] = $rec;
		} else {
			$form_data['success'] = false;
			$form_data['errors'] = 'Staff no not found in registered staff records';

		}
		
		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'Update Staff' ) {
		$_SESSION['full_name'] = $_POST['editor_name'];


		$_POST['id'] = $_POST['staff_no'];
		
		if ($c_staff->_save_record()) {
			
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while saving Staff Profile";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;

	}

?>