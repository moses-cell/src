<?php	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_external_participant.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_mailer.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_login.php';


	$glib = new globalLibrary();
	$c_ep = new c_external_participant();
	$hr_ta = new c_training_application();

	if (isset($_POST['form_process'])) {

		$_SESSION['full_name'] = $_POST['editor_name'];

		if (isset($_POST['pageid'])) {
			$id = $glib->encrypt_decrypt('decrypt', $_POST['pageid'], 'id');
			$_POST['id'] = $id;
		} else {
			$form_data['success'] = false;
			$form_data['errors'] = 'Unable to register staff in the training';

		}

		if($_POST['form_process'] == 'Save') {

			$mailer = new email_process();

			if ($_POST['pageid'] != '')
				$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
			else
				$_POST['id'] = '';
			
			$ta = new c_training_application();
			$ep_data = $c_ep->_get_external_participant($_POST['email']);
			$training_data = $ta->_get_training_schedule($_POST['id']);

			//echo $_POST['staff_no'];

			if (count($ep_data) <= 0) {
				if($c_ep->_register_external_participant() == false) {
					$c_ep->error_generator(18,true);
					return;
				}
			} else {
				if($c_ep->_update_external_participant() == false) {
					$c_ep->error_generator(19,true);
					return;
				}

			}

			$ep_data = $c_ep->_get_external_participant($_POST['email']);
			if (count($ep_data) <= 0) {
				$ta->error_generator(15, true);
				return;
			} 


			if (count($training_data) <= 0) {
				$ta->error_generator(2, true);
				return;
			} 



			$user = new c_login();
			if (count($user->_check_user_exist($_POST['email'])) <= 0) {
				$password = $glib->password_generator(10,1,"lower_case,upper_case,numbers,special_symbols");
				$encryp_password = $glib->encrypt_decrypt('encrypt', $password[0], 'password');
				if ($user->_register_user_external($_POST['email'], $encryp_password, $_POST['name']) == false) {
					$hr_tp->error_generator(21, true);	
					return;
				} else {
					$mailer->external_user_registration($_POST['email'], $_POST['name'], $password[0]);
				}

			}


			$ep_data = $ep_data[0];
			$training_data = $training_data[0];


			if (count($ta->_get_external_participant_training_registered($training_data, $ep_data)) > 0) {
				$ta->error_generator(22, true);
				return;
			}



			if ($ta->_create_training_for_external_participant($training_data, $ep_data) == false) {
				$ta->error_generator(6, true);
				return;
			} else {
				$mailer->notify_external_training_register($training_data, $ep_data);
			}

			$form_data['success'] = true;
			echo json_encode($form_data);
			return;


		} else {
			$form_data['success'] = false;
			$form_data['errors'] = 'Unable to register external participant in the training';

		}





	} else {
		$form_data['success'] = false;
		$form_data['errors'] = 'Unable to register external participant in the training';

	}

	echo json_encode($form_data);
	return;	

?>