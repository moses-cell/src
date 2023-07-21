<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-emp-roles.php';


	$glib = new globalLibrary();


	

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {
		$_SESSION['full_name'] = $_POST['editor_name'];

		$c_emp = new c_adm_emp_roles();

		if ($c_emp->_save_record()) {
			
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while saving Employee Roles";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;
	}

	if ($_POST['form_process'] == 'delete') {

		$glib = new globalLibrary();
		$id = $glib->encrypt_decrypt('decrypt', $_POST['id'], 'id');
		
		$c_emp = new c_adm_emp_roles();

		if ($c_emp->_delete_record($id)) {
			
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while deleting Employee Roles";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;
	}



?>