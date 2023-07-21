<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_super_assessment.php';

	$glib = new globalLibrary();

	$_SESSION['full_name'] = $_POST['editor_name'];

	if (!isset($_POST['form_process'])) {
		$ta->error_generator(15, true);	
		return;		
	}


	if (isset($_POST['form_process'])) {

		if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {

			if ($_POST['pageid'] != '')
				$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
			else
				$_POST['id'] = '';



			if ($_POST['evalid'] != '')
				$_POST['evalid'] = $glib->encrypt_decrypt('decrypt', $_POST['evalid'],'id' );
			else
				$_POST['evalid'] = '';
		

			$ta = new c_super_assessment();
			if ($ta->_submit_super_assessment() == false) {
				$ta->error_generator(25, true);
				return;
			}

			$form_data['success'] = true;
			$form_data['process'] = $_POST['form_process'];
			echo json_encode($form_data);
			return;
		}

	}






?>