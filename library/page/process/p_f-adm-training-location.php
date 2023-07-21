<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-training-location.php';


	$glib = new globalLibrary();


	$_SESSION['full_name'] = $_POST['editor_name'];

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {

		$_POST['id'] = '';

		if ($_POST['page_id'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['page_id'],'id' );
		else
			$_POST['id'] = '';

		if ($_POST['provider_id'] != '')
			$_POST['provider_id'] = $glib->encrypt_decrypt('decrypt', $_POST['provider_id'],'id' );
		else {
			$form_data['errors'] = "There is an error while saving Provider Training Location";	
			$form_data['success'] = false;
			return;
		}

		if ($_POST['main_location'] == 'new') {
			$_POST['main_location'] = $_POST['new_main_location'];	
		}

		$prov = new c_adm_training_location();

		if ($prov->_save_record()) {
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while saving Training Module";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;
	}


?>