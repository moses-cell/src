<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-training-category.php';


	$glib = new globalLibrary();


	$_SESSION['full_name'] = $_POST['editor_name'];

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {


		$_POST['id'] = '';

		if ($_POST['page_id'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['page_id'],'id' );
		else
			$_POST['id'] = '';

		$prov = new c_adm_training_category();

		$data = $prov->_get_record_by_name($_POST['category']);
		if (count($data) > 0) {
			if ($data[0]['id'] != $_POST['id']) {
				$form_data['errors'] = "Training Category already exists";	
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;
			}
		}


		if ($prov->_save_record()) {
			
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while saving Training Category";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;
	}


?>