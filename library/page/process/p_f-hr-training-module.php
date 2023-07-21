<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_hr-training-module.php';


	$glib = new globalLibrary();

	$_SESSION['full_name'] = $_POST['editor_name'];

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {

		$_POST['id'] = '';

		if ($_POST['trainingprovider'] == 'new') {

			$_POST['provider_name'] = $_POST['newtrainingprovider'];

			require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-training-provider.php';
			$prov = new c_adm_training_provider();

			if ($prov->_save_record(false)) {
				$_POST['trainingprovider'] = $prov->last_id;

			} else {
				$form_data['errors'] = "There is an error while saving Training Provider";	
				$form_data['success'] = false;

			}
		}

		$path = dirname(dirname(dirname(dirname(__FILE__)))) . '/uploads/';


		if ($_POST['pageid'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
		else
			$_POST['id'] = '';


		$hr_tm = new c_hr_training_module();

		if (isset($_POST['enable_process'])) {
			$module_data = $hr_tm->_get_duplicate_training_module($_POST['coursecode']);

			if (count($module_data) > 0) {
				if ($_POST['id'] == '') {
					$form_data['errors'] = "The Course Code for the Training Module is already enabled. Please disable the exisiting training module before you can enable a new training module with the same Course Code.";	
					$form_data['success'] = false;

					echo json_encode($form_data);
					return;
				} elseif ($_POST['id'] != $module_data[0]['id']) {
					$form_data['errors'] = "The Course Code for the Training Module is already enabled. Please disable the exisiting training module before you can enable a new training module with the same Course Code.";	
					$form_data['success'] = false;

					echo json_encode($form_data);
					return;
				}
			}
		}


		if ($hr_tm->_save_training_module()) {
			
			$form_data['success'] = true;
			//$form_data['errors'] = "test";	

		} else {
			$form_data['errors'] = "There is an error while saving Training Module";	
			$form_data['success'] = false;

		}


		$fname = $_FILES['fileupload']['name'];
		if ($fname != '') {
			
		
			$folder = $path;
		
			if (is_dir($folder) == false) {
		    	mkdir($folder, 0777, true);
			} 
		
			$folder_template = $folder . 'module/';
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

				$targetFolder = 'uploads/module/' . $_POST['id'] .'/';
			   	$_POST['filename']  = $targetFolder . $_FILES['fileupload']['name'];
			   	if ($hr_tm->_update_filename() == false) {
			   		$form_data['errors'] = "Traning Module record is saved but there is an error while updating file attachment";	
					$form_data['success'] = false;
					return;
			   	}

			}
		}




		echo json_encode($form_data);
		return;
	}


?>