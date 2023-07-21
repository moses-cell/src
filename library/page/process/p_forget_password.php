<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))) .'/class/c_login.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_mailer.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_staff.php';



	$_SESSION['full_name'] = 'System - Forget password';
	$glib = new globalLibrary();
	$mailer = new email_process();


	if ($_POST['form_process'] == 'reset_password' ) {


		$user = new c_login();
		$data = $user->_check_user_exist($_POST['username']);
		if (count($data) >= 0) {
			// Generate Random Password

			if ($data[0]['type'] == 'internal') {
				$form_data['success'] = true;
				$form_data['status'] = 'internal';
				echo json_encode($form_data);
				return;
			}

			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
			$password = substr( str_shuffle( $chars ), 0, 12 );


			$encryp_password = $glib->encrypt_decrypt('encrypt', $password, 'password');
			//echo $encryp_password;
			if ($user->_reset_password($_POST['username'], $encryp_password)) {	

				$data = $data[0];
				if ($data['type'] == 'internal') {
					$staff = new c_staff();
					$data = $staff->_get_staff_info($_POST['username']);
					
					if (count($data) > 0) {
						$data = $data[0];
						
						if ($data['email'] == '' && $data['email2'] == '')  {
							
							$mailer->reset_user_password_secretary($data['secretary_email'], $data['staff_name'], $data['staff_no'],$password);
							$form_data['success'] = true;
							$form_data['status'] = 'Check Secretary Email';
						} else {
							if ($data['email'] == '') {
								$mailer->reset_user_password($data['email2'], $data['staff_name'], $password);
								$form_data['success'] = true;
								$form_data['status'] = 'Check External Email';	
							} else {
								$mailer->reset_user_password($data['email'], $data['staff_name'], $password);
								$form_data['success'] = true;
								$form_data['status'] = 'Check Internal Email';	
							}
							
						}
					} else {
						$form_data['success'] = false;
					}

				} else {
					$mailer->reset_external_user_password($data['user_name'], $data['full_name'], $password);
					$form_data['status'] = 'External User';
					$form_data['success'] = true;
				}										
			} else {
				$form_data['success'] = false;
			}
		} else {
			$form_data['success'] = false;
		}

	} else {
		$form_data['success'] = false;
	}

	echo json_encode($form_data);

?>