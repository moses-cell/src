<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_hr-trainer-profile.php';
	require_once dirname(dirname(dirname(__FILE__))) .'/class/c_login.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_mailer.php';


	$glib = new globalLibrary();
	$mailer = new email_process();
	$hr_tp = new c_hr_trainer_profile();


	$_SESSION['full_name'] = $_POST['editor_name'];


	if ($_POST['form_process'] == 'profile' ) {

		$_POST['id'] = '';

		$path = dirname(dirname(dirname(dirname(__FILE__)))) . '/uploads/';

		if ($_POST['pageid'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
		else
			$_POST['id'] = '';


		if ($_POST['trainer_type'] == 'internal') {
			if ($_POST['id'] == '' ) {
				if (count($hr_tp->_get_internal_trainer($_POST['staff_no'])) > 0 ) {
					$hr_tp->error_generator(7, true);	
					return;
				} 
			} 

			if ($hr_tp->_save_record()) {
				$form_data['success'] = true;
				$form_data['id'] = $glib->encrypt_decrypt('encrypt', $_POST['id'],'id' );
				$user = new c_login();
				if (count($user->_check_user_exist($_POST['staff_no'])) > 0) {
					
					if ($user->_update_trainer_login($_POST['staff_no'], $_POST['id'])) {
						$form_data['success'] = true;
					} else {
						$hr_tp->error_generator(10, true);	
						return;
					}
				} else {
					
					$encryp_password = $glib->encrypt_decrypt('encrypt', $_POST['staff_no'], 'password');
					if ($user->_register_user_staff($_POST['staff_no'], $encryp_password, $_POST['fullname'])) {
						if ($user->_update_trainer_login($_POST['staff_no'], $_POST['id'])) {
							$form_data['success'] = true;
						} else {
							$hr_tp->error_generator(10, true);	
							return;
						}
					} else {
						$hr_tp->error_generator(10, true);	
						return;
					}
				}					//$form_data['errors'] = "test";	
			} else {
				$hr_tp->error_generator(9, true);
				return;
			}
		}


		if ($_POST['trainer_type'] == 'external') {

			if ($_POST['id'] == '' ) {
				if (count($hr_tp->_get_external_trainer($_POST['email'])) > 0 ) {
					$hr_tp->error_generator(8, true);	
					return;
				}	
			}
		
			if ($hr_tp->_save_record()) {
				$form_data['success'] = true;
				$form_data['id'] = $glib->encrypt_decrypt('encrypt', $_POST['id'],'id' );
				$user = new c_login();
				if (count($user->_check_user_exist($_POST['email'])) == 1) {
					if ($user->_update_trainer_login($_POST['email'], $_POST['id'])) {
						$form_data['success'] = true;
					} else {
						$hr_tp->error_generator(10, true);	
						return;
					}
				} else { //user not yet registered in the system
					$password = $glib->password_generator(10,1,"lower_case,upper_case,numbers,special_symbols");
					$encryp_password = $glib->encrypt_decrypt('encrypt', $password[0], 'password');
					if ($user->_register_user_external($_POST['email'], $encryp_password, $_POST['fullname'])) {
						if ($user->_update_trainer_login($_POST['email'], $_POST['id'])) {
							$mailer->external_user_registration($_POST['email'], $_POST['fullname'], $password[0]);
							$form_data['success'] = true;
						} else {
							$hr_tp->error_generator(10, true);	
							return;
						}
					} else {
						$hr_tp->error_generator(10, true);	
						return;
					}
				}
				//$form_data['errors'] = "test";	

			} else {
				$hr_tp->error_generator(9, true);
				return;
			}
			
		}

		


		$fname = $_FILES['pic']['name'];
		if ($fname != '') {
			
		
			$folder = $path;
		
			if (is_dir($folder) == false) {
		    	mkdir($folder, 0777, true);
			} 
		
			$folder_template = $folder . 'trainer/';
			if (is_dir($folder_template) == false) {
		    	mkdir($folder_template, 0777, true);
			} 

			$targetFolder = $folder_template . $_POST['id'] . '/';
			if (is_dir($targetFolder) == false) {
		    	mkdir($targetFolder, 0777, true);
			}			
			$targetPath = $targetFolder . $_FILES['pic']['name'];
			move_uploaded_file($_FILES['pic']['tmp_name'], $targetPath);
				    	
			if ($fname != '') {

				$targetFolder = 'uploads/trainer/' . $_POST['id'] .'/';
			   	$_POST['filename']  = $targetFolder . $_FILES['pic']['name'];
			   	if ($hr_tp->_update_filename() == false) {
			   		$hr_tp->error_generator(11, true);
					return;
			   	}

			}
		}

		$form_data['success'] = true;
		$form_data['id'] = $glib->encrypt_decrypt('encrypt', $_POST['id'],'id' );

		echo json_encode($form_data);
		return;
	
	} elseif  ($_POST['form_process'] == 'working' ) {



		if ($_POST['profileid'] != '')
			$_POST['profile_id'] = $glib->encrypt_decrypt('decrypt', $_POST['profileid'],'id' );
		else {
			$hr_tp->error_generator(12, true);
			return;
		}

		$_POST['id']  = "";
		if ($_POST['empid'] != '') {
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['empid'],'id' );
		}
		else
			$_POST['id'] = '';


		
		if ($hr_tp->_save_record_employment()) {
			$form_data['success'] = true;
			$form_data['id'] = $glib->encrypt_decrypt('encrypt', $_POST['profile_id'],'id' );;
			echo json_encode($form_data);
			return;	

		} else {
			$hr_tp->error_generator(13, true);
			return;
		}
	} elseif  ($_POST['form_process'] == 'delete-working' ) {


		if ($_POST['id'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['id'],'id' );
		else {
			$hr_tp->error_generator(14, true);
			return;
		}



		
		if ($hr_tp->_delete_record_employment()) {
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;	

		} else {
			$hr_tp->error_generator(14, true);
			return;
		}
	} elseif  ($_POST['form_process'] == 'academic' ) {

		if ($_POST['profileid'] != '')
			$_POST['profile_id'] = $glib->encrypt_decrypt('decrypt', $_POST['profileid'],'id' );
		else {
			$hr_tp->error_generator(12, true);
			return;
		}

		$_POST['id']  = "";
		if ($_POST['academicid'] != '') {
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['academicid'],'id' );
		}
		else
			$_POST['id'] = '';


		
		if ($hr_tp->_save_record_academic()) {
			$form_data['success'] = true;
			$form_data['id'] = $glib->encrypt_decrypt('encrypt', $_POST['profile_id'],'id' );;
			echo json_encode($form_data);
			return;	

		} else {
			$hr_tp->error_generator(13, true);
			return;
		}
	} elseif  ($_POST['form_process'] == 'delete-academic' ) {


		if ($_POST['id'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['id'],'id' );
		else {
			$hr_tp->error_generator(14, true);
			return;
		}



		
		if ($hr_tp->_delete_record_academic()) {
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;	

		} else {
			$hr_tp->error_generator(14, true);
			return;
		}
	} elseif  ($_POST['form_process'] == 'training' ) {

		if ($_POST['profileid'] != '')
			$_POST['profile_id'] = $glib->encrypt_decrypt('decrypt', $_POST['profileid'],'id' );
		else {
			$hr_tp->error_generator(12, true);
			return;
		}

		$_POST['id']  = "";
		if ($_POST['trainingid'] != '') {
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['trainingid'],'id' );
		}
		else
			$_POST['id'] = '';


		
		if ($hr_tp->_save_record_training()) {
			$form_data['success'] = true;
			$form_data['id'] = $glib->encrypt_decrypt('encrypt', $_POST['profile_id'],'id' );
			echo json_encode($form_data);
			return;	

		} else {
			$hr_tp->error_generator(13, true);
			return;
		}
	} elseif  ($_POST['form_process'] == 'delete-training' ) {


		if ($_POST['id'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['id'],'id' );
		else {
			$hr_tp->error_generator(14, true);
			return;
		}



		
		if ($hr_tp->_delete_record_training()) {
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;	

		} else {
			$hr_tp->error_generator(14, true);
			return;
		}
	}


?>