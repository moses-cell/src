<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-setting.php';


	$glib = new globalLibrary();


	$_SESSION['full_name'] = $_POST['editor_name'];

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {


		$c_emp = new c_adm_setting();

		$_POST['id'] = '';

		if ($_POST['page_id'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['page_id'],'id' );
		else
			$_POST['id'] = '';


		if ($c_emp->_save_record()) {
			
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while saving Training Setting";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;
	}


?>