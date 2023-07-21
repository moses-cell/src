<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_intern.php';


	$glib = new globalLibrary();


	$_SESSION['full_name'] = $_POST['editor_name'];

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {

		$_POST['id'] = '';
		if ($_POST['pageid'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
		else
			$_POST['id'] = '';

		$c_intern = new c_intern();

		$data = $c_intern->_get_record_check_duplicate($_POST['ic_no'], $_POST['sdate'], $_POST['sdate']);
		if (count($data) > 0) {
			if ($_POST['id'] == '') {
				$form_data['errors'] = "Intern Profile for the selected date range already registered.";	
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;
			} elseif ($_POST['id'] != $data[0]['id']) {
				$form_data['errors'] = "Intern Profile for the selected date range already registered.";	
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;
			} 
		}


		if ($c_intern->_save_record()) {
			
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while saving Intern Profile";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;
	}


?>