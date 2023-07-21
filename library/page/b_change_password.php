<?php

	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_login.php';

	date_default_timezone_set("Asia/Kuala_Lumpur");
	$glib = new globalLibrary;

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		session_start();
	
		$username = $_POST['username'];
		$password = $_POST['password'];
		$new_password = $_POST['new_password'];


		$c_login = new c_login;
		$data = $c_login->_login($username, $password);
	
		if (count($data) == 1) {

			$id = ($data[0]['user_name']);
			$fullname = ($data[0]['full_name']);

			if ($data[0]['type'] == 'internal') {
				session_destroy();
				$form_data['errors'] = 'Internal';
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;
			}

			$pwd = $glib->encrypt_decrypt('decrypt',$data[0]['password'], 'password');
			if ($pwd != $password) {

				session_destroy();
				$form_data['errors'] = 'Error login';
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;

			}

			$pwd = $glib->encrypt_decrypt('encrypt', $new_password, 'password');
			$row = $c_login->_change_password($username, $pwd);
			if ($row > 0) {
				session_destroy();
				$form_data['success'] = true;
				echo json_encode($form_data);
				return;
			} else {
				session_destroy();
				$form_data['errors'] = 'fail change password';
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;

			}
		
		} else {
			session_destroy();
			$form_data['errors'] = 'Error login';
			$form_data['success'] = false;
			echo json_encode($form_data);
			return;
		}

	} else {

		$id = $_GET['key'];
		$id = $glib->encrypt_decrypt('decrypt',$id,'id');

	}


	return;
?>