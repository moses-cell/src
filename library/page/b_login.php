<?php

	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_login.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_staff.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_external_participant.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_adm-setting.php';


	$username = $_POST['username'];
	$password = $_POST['password'];


	session_start();
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$glib = new globalLibrary;

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		$c_login = new c_login;
		$c_staff = new c_staff;
		
		$data = $c_login->_login($username, $password);
		
		$_SESSION['expired'] = time() + 1800;


		if (count($data) == 1) {

			$id = ($data[0]['user_name']);
			$fullname = ($data[0]['full_name']);
			$trainer = $data[0]['trainer'];
			$trainer_id = $data[0]['trainer_id'];
			$user_type = $data[0]['type'];
			$external_participant = $data[0]['external_participant'];

			$hash = 'DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaGIo3';

			if ($user_type == 'internal') {
				$pwd = sha1($hash.$password);
				$password = $data[0]['password'];
			} else {
				$pwd = $glib->encrypt_decrypt('decrypt',$data[0]['password'], 'password');

			}
			
			 			
			if ($pwd != $password) {
				
				session_destroy();
				$form_data['errors'] = 'Error login';
				$form_data['success'] = false;
				$form_data['msg'] = '1';
				echo json_encode($form_data);
				return;

			}

			if ($data[0]['change_password'] == '1') {
				session_destroy();
				$id = $glib->encrypt_decrypt('encrypt',$username,'id');

				$form_data['key'] = $id;
				$form_data['change_password'] = true;
				$form_data['success'] = true;
				echo json_encode($form_data);
				return;

			}
			$user_key = $glib->encrypt_decrypt('encrypt',$data[0]['user_name'],'id');
			

			if ($user_type == 'internal') {


				$data = $c_staff->_get_staff_info($username);
				//print_r ($data);
				if (count($data) > 0) {

					if ($data[0]['status'] == 'Active' || $data[0]['status'] == 'ACTIVE') {
						$_SESSION['position'] = $data[0]['position']; 
						$_SESSION['job_grade'] = $data[0]['grade']; 
						$_SESSION['staff_no'] = $data[0]['staff_no']; 
						$_SESSION['trainer'] = $trainer;
						$_SESSION['trainer_id'] = $trainer_id;
						$_SESSION['user_type'] = $user_type;
						$_SESSION['full_name'] = $fullname;

					} else {
						session_destroy();
						$form_data['errors'] = 'Error login';
						$form_data['success'] = false;
						$form_data['msg'] = '2';
						echo json_encode($form_data);
						return;
					}

				} else {
					session_destroy();
					$form_data['errors'] = 'Error login';
					$form_data['success'] = false;
					$form_data['msg'] = '3';
					echo json_encode($form_data);
					return;

				}

			} else { //External
				$_SESSION['staff_no'] = '';
				$_SESSION['username'] = $username;
				$_SESSION['position'] = "External User"; 
				$_SESSION['job_grade'] = "-"; 
				$_SESSION['full_name'] = $fullname;
				$_SESSION['user_type'] = $user_type;
				
				$c_setting = new c_adm_setting();
				$c_external = new c_external_participant();
				$data_trainer = false;

				if ($trainer == 'y') {
					$_SESSION['trainer'] = $trainer;
					$_SESSION['trainer_id'] = $trainer_id;
					
					$setting_data = $c_setting->_get_external_trainer_setting();
					$start = 0;
					$end  = 0;

					if (count($setting_data) > 0 ) {
						
						foreach ($setting_data as $row) {
							if ($row['setting_key'] == 'trainer_can_login_before_training')
								$start = $row['setting_value'];
							
							if ($row['setting_key'] == 'trainer_can_login_after_training')
								$end = $row['setting_value'];	
						}
								
					}
					
					$data_trainer = $c_external->_get_external_trainer_schedule($trainer_id, $start, $end);
				}

				if ($data_trainer ==  false ) {

					$_SESSION['external_participant'] = 'y';

					$setting_data = $c_setting->_get_external_participant_setting();
					$start = 0;
					$end  = 0;

					if (count($setting_data) > 0 ) {
						foreach ($setting_data as $row) {
							if ($row['setting_key'] == 'external_can_login_before_training')
								$start = $row['setting_value'];
							
							if ($row['setting_key'] == 'external_can_login_after_training')
								$end = $row['setting_value'];	
						}

					}

					$data_external = $c_external->_get_external_participant_schedule($username, $start, $end);
					if ($data_external == false) {

						$form_data['success'] = false;
						$form_data['external'] = true;
						$form_data['start'] = $start;
						$form_data['end'] = $end;
						echo json_encode($form_data);
						return;
					}
						
				} 

			}


					
			$form_data['change_password'] = false;		
			$form_data['session'] = $user_key;
			$form_data['success'] = true;
			$form_data['msg'] = '4';
			$form_data['usertype'] = $_SESSION['user_type'];

			$_SESSION['id'] = $id;
			$_SESSION['full_name'] = $fullname;
			$_SESSION['expired'] = time() + 1800;
			$_SESSION['session'] = $user_key;
			$_SESSION['pg'] = $user_key;

					
			echo json_encode($form_data);
			//echo 'sss';
			return;
			
					
		} else {
			

			$data = $c_staff->_get_staff_info($username);
			if (count($data) > 0) {

				if ($username != $password) {
					session_destroy();
					$form_data['errors'] = 'Error login';
					$form_data['success'] = false;
					echo json_encode($form_data);
					return;
				}

				$staff_name = $data[0]['staff_name'];
				$encryt_password = $glib->encrypt_decrypt('encrypt',$password,'password');
				if( $c_login->_register_user_staff($username, $encryt_password, $staff_name)) {
					$data = $c_login->_is_trainer($username);
					if (count($data) == 1) {
						if($c_login->_update_trainer_login($staff_no, $data[0]['id']) == false) {
							$form_data['success'] = false;
							echo json_encode($form_data);
							return;
						}
					}
				} else {
					$form_data['success'] = false;
					echo json_encode($form_data);
					return;
				}

				session_destroy();
				$id = $glib->encrypt_decrypt('encrypt',$username,'id');

				$form_data['key'] = $id;
				$form_data['change_password'] = true;
				$form_data['success'] = true;
				echo json_encode($form_data);
				return;

			} else {
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;
			}

		}
				


	}


	return;
?>