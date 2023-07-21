<?php
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_global_parameter.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_training-application.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_staff.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_mailer.php';

	$glib = new globalLibrary();

	$_SESSION['full_name'] = $_POST['editor_name'];
	$ta = new c_training_application();
	$staff = new c_staff();
	$mailer = new email_process();


	if (isset($_POST['form_process'])) {

		if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {


			$path = dirname(dirname(dirname(dirname(__FILE__)))) . '/uploads/';
			$_POST['id'] = '';

			$staff_no = $_SESSION['staff_no'];

			$training_data = [
				'date_start' => $ta->format_dbdate($_POST['sdate'],'dd-mm-yyyy'),
				'date_end' => $ta->format_dbdate($_POST['edate'],'dd-mm-yyyy'),
				'time_start' => $ta->format_dbtime($_POST['stime'],'hh:mm p'),
				'time_end' => $ta->format_dbtime($_POST['etime'],'hh:mm p'),
				'title' => $_POST['title'],
			];
			
			$staff_data = $staff->_get_staff_info($staff_no);
			if (count($staff_data) <= 0) {
				$ta->error_generator(1, true);	
				return;
			} else 
				$staff_data = $staff_data[0];

			if (count($ta->_get_training_registered($training_data, $staff_data)) > 0) {
				$ta->error_generator(5, true);
				return;
			}



			if ($ta->_submit_staff_external_training( $staff_data) == false) {
					$ta->error_generator(6, true);
					return;
			} 
			
			
				
			$fname = $_FILES['fileupload']['name'];
			if ($fname != '') {
				
				$folder = $path;
			
				if (is_dir($folder) == false) {
			    	mkdir($folder, 0777, true);
				} 
			
				$folder_template = $folder . 'external/';
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

					$targetFolder = 'uploads/external/' . $_POST['id'] .'/';
				   	$_POST['filename']  = $targetFolder . $_FILES['fileupload']['name'];
				   	if ($ta->_update_filename() == false) {
				   		$form_data['errors'] = "Traning Module record is saved but there is an error while updating file attachment";	
						$form_data['success'] = false;
						return;
				   	}

				}
			}

			$mailer->request_training_approval($training_data, $staff_data);
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;


		}

	}

?>