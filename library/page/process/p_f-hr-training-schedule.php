<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_global_parameter.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_hr-training-schedule.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_training-request.php';


	$glib = new globalLibrary();

	$_SESSION['full_name'] = $_POST['editor_name'];

	if (isset($_POST['form_process'])) {
		

		$_POST['id'] = '';

		if ($_POST['pageid'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
		else
			$_POST['id'] = '';

		if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {

			$_POST['id'] = '';

			if ($_POST['trainingprovider'] == 'new') {

				require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-training-provider.php';
				$prov = new c_adm_training_provider();

				if ($prov->_save_record(false)) {
					$_POST['trainingprovider'] = $prov->last_id;

				} else {
					$form_data['errors'] = "There is an error while saving Training Provider";	
					$form_data['success'] = false;
					echo json_encode($form_data);
					return;

				}
			}

			if ($_POST['traininglocation'] == 'new training location') {

				require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-training-location.php';
				$loc = new c_adm_training_location();

				$_POST['provider_id'] = $_POST['trainingprovider'];
				if ($loc->_save_record(false)) {
					$_POST['traininglocation'] = $loc->last_id;

				} else {
					$form_data['errors'] = "There is an error while saving Training Location";	
					$form_data['success'] = false;
					echo json_encode($form_data);
					return;

				}
			}

			if ($_POST['traininglocation'] == 'new public location') {

				require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-training-location.php';
				$loc = new c_adm_training_location();

				$_POST['provider_id'] = "0";
				if ($loc->_save_record(false)) {
					$_POST['traininglocation'] = $loc->last_id;

				} else {
					$form_data['errors'] = "There is an error while saving Training Location";	
					$form_data['success'] = false;
					echo json_encode($form_data);
					return;
				}
			}


			$hr_tm = new c_hr_training_schedule();

			$path = dirname(dirname(dirname(dirname(__FILE__)))) . '/uploads/';
			$_POST['id'] = '';

			if ($_POST['pageid'] != '')
				$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
			else
				$_POST['id'] = '';



			if ($hr_tm->_save_training_schedule()) {

				if (!isset($_POST['enable_process'])) {
					$hr_tm->_hr_cancel_participant();
				} else {
					$hr_tm->_update_participant_training_date();
					if (isset($_POST['date_change'])) {
						//$hr_tm->_notify_participant_training_info_update()
					}

					if (isset($_POST['trainer_change'])) {
						//$hr_tm->_notify_previous_trainer()
					}

				}
				


				if ($_POST['request_id'] != '') {
					if (isset($_POST['enable_process'])) {
						$tr = new c_training_request();
						$tr_data = $tr->get_training_request($_POST['request_id']);

						if (count($tr_data) > 0) {
							if ($tr_data[0]['status'] != 'complete') {
								$tr->_training_request_complete($_POST['request_id'],$_POST['id']);
							}
						}
					}
				}


				$form_data['success'] = true;

			} else {
				$form_data['errors'] = "There is an error while saving Training Schedule";	
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
			
				$folder_template = $folder . 'schedule/';
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

					$targetFolder = 'uploads/schedule/' . $_POST['id'] .'/';
				   	$_POST['filename']  = $targetFolder . $_FILES['fileupload']['name'];

				   	if ($hr_tm->_update_filename() == false) {
				   		$form_data['errors'] = "Traning Module record is saved but there is an error while updating file attachment";	
						$form_data['success'] = false;
						
				   	}

				}
				
			}

			$form_data['id'] = $glib->encrypt_decrypt('encrypt', $_POST['id'], 'id');
			echo json_encode($form_data);
			return;
		
		} elseif ($_POST['form_process'] == 'Cancel' ) {

			//print_r($_POST);
			//die();

			$hr_tm = new c_hr_training_schedule();
			$_POST['enable_process'] = 2;
			
			if ($hr_tm->_cancel_training_schedule()) {
				$hr_tm->_hr_cancel_participant(true);
				$form_data['success'] = true;
				echo json_encode($form_data);
				return;
			}

		} 


	} elseif (isset($_POST['get_provider_location'])) {

		$param = new b_global_parameter();

		$_SESSION['full_name'] = $_POST['editor_name'];
		$id = "";
		if (isset($_POST['id']))
			$id = $_POST['id'];

		//$location = $param->select_option_training_location_by_provider_id($_POST['trainingprovider'], $id);
		//echo $location;

		$data = $param->json_training_location_by_provider_id($_POST['trainingprovider'], $id);
		
		$data = json_encode($data,JSON_HEX_APOS);
		echo ($data);
		//return $location;

	} elseif (isset($_POST['get_location_details'])) {

		$param = new b_global_parameter();

		$_SESSION['full_name'] = $_POST['editor_name'];

			
		$data = $param->_get_training_location_detail_by_id($_POST['traininglocation']);
		if (count($data) > 0)
			echo $data[0]['details'];
		else
			echo "";
		//return $location;

	}


?>