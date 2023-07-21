<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_training-request.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_staff.php';


	$glib = new globalLibrary();

	$_SESSION['full_name'] = $_POST['editor_name'];

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {

		$_POST['id'] = '';

		$path = dirname(dirname(dirname(dirname(__FILE__)))) . '/uploads/';



		if ($_POST['pageid'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
		else
			$_POST['id'] = '';

		$c_staff = new c_staff();
		$rec = $c_staff->_get_staff_info($_SESSION['staff_no']);
		if (count($rec) <= 0) {
			$form_data['errors'] = "There is an error while saving Training Request";	
			$form_data['success'] = false;
			echo json_encode($form_data);
			return;
		}

		$staff = $rec[0];
		$tr = new c_training_request();

		if ($tr->_save_training_request($staff)) {
			
			$form_data['success'] = true;
			//$form_data['errors'] = "test";	

		} else {
			$form_data['errors'] = "There is an error while saving Training Request";	
			$form_data['success'] = false;
			echo json_encode($form_data);
			return;

		}


		$fname = $_FILES['fileupload']['name'];
		if ($fname != '') {
			
		
			$folder = $path;
		
			if (is_dir($folder) == false) {
		    	mkdir($folder, 0777, true);
			} 
		
			$folder_template = $folder . 'request/';
			if (is_dir($folder_template) == false) {
		    	mkdir($folder_template, 0777, true);
			} 

			$targetFolder = $folder_template . $_POST['id'] . '/';
			if (is_dir($targetFolder) == false) {
		    	mkdir($targetFolder, 0777, true);
			}			
			$targetPath = $targetFolder . $_FILES['fileupload']['name'];
			move_uploaded_file($_FILES['fileupload']['tmp_name'], $targetPath);
				    	
			if ($fname != '') {

				$targetFolder = 'uploads/request/' . $_POST['id'] .'/';
			   	$_POST['filename']  = $targetFolder . $_FILES['fileupload']['name'];
			   	if ($tr->_update_filename() == false) {
			   		$form_data['errors'] = "Traning Module record is saved but there is an error while updating file attachment";	
					$form_data['success'] = false;
					return;
			   	}

			}
		}




		echo json_encode($form_data);
		return;
	}

	if ($_POST['form_process'] == 'In Progress' ) {



		if ($_POST['pageid'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
		else {
			$form_data['errors'] = "Traning Request record not found";	
			$form_data['success'] = false;
			echo json_encode($form_data);
			return;
		}

		$tr = new c_training_request();

		if ($tr->_training_request_in_progress()) {
			
			$form_data['success'] = true;
			//$form_data['errors'] = "test";	

		} else {
			$form_data['errors'] = "There is an error while updating Training Request";	
			$form_data['success'] = false;

		}

		echo json_encode($form_data);
		return;

	}

	if ($_POST['form_process'] == 'Reject' ) {



		if ($_POST['pageid'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
		else {
			$form_data['errors'] = "Traning Request record not found";	
			$form_data['success'] = false;
			echo json_encode($form_data);
			return;
		}

		$tr = new c_training_request();

		if ($tr->_training_request_reject()) {
			
			$form_data['success'] = true;
			//$form_data['errors'] = "test";	

		} else {
			$form_data['errors'] = "There is an error while updating Training Request";	
			$form_data['success'] = false;

		}

		echo json_encode($form_data);
		return;

	}

?>