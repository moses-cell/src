  <?php	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_staff.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_mailer.php';


	$glib = new globalLibrary();
	$c_staff = new c_staff();
	$hr_ta = new c_training_application();


	if (isset($_POST['form_process'])) {

		//echo $_POST['form_process'];

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

			if (isset($_POST['key'])) {
				$staff_no = $glib->encrypt_decrypt('decrypt', $_POST['key'], 'id');
			} else {
				$form_data['success'] = false;
				$form_data['errors'] = 'Unable to register staff in the training';
				return;
			}

			$ta = new c_training_application();
			if ($c_staff->_trainer_update_staff_info() == false) {
				$ta->error_generator(24, true);
				return;
			}


			$staff_data = $c_staff->_get_staff_info($_POST['staff_no']);
			$training_data = $ta->_get_training_schedule($_POST['id']);


			if (count($staff_data) <= 0) {
				$ta->error_generator(1, true);	
				return;
			} 

			if (count($training_data) <= 0) {
				$ta->error_generator(2, true);
				return;
			} 

			$staff_data = $staff_data[0];
			$training_data = $training_data[0];

			//print_r($staff_data);
			
			/*if ($glib->who_can_apply ($training_data['eligibility'], $_SESSION) == false) {
				$ta->error_generator(3, true);
				return;
			} */

			if ($glib->target_audience ($training_data['audience'], $staff_data) == false) {
				$ta->error_generator(4, true);
				return;
			} 

			if (count($ta->_get_training_registered($training_data, $staff_data)) > 0) {
				$ta->error_generator(5, true);
				return;
			}


			//if ($training_data['approval'] == '1') {
				if ($ta->_submit_and_cancel_staff_training_by_trainer($training_data, $staff_data, $staff_no) == false) {
					$ta->error_generator(6, true);
					return;
				} else {


				}
			//}

			$form_data['success'] = true;
			echo json_encode($form_data);
			return;


		} elseif($_POST['form_process'] == 'new participant') {
		
			$rec = $hr_ta->_get_training_registered_by_staff_schedule_id($_POST['staff_no'], $_POST['id']);
			if (count($rec) > 0) {
				$form_data['success'] = false;
				$form_data['errors'] = 'Staff no already registered in the training.';

			} else {
				$c_staff = new c_staff();
				$rec = $c_staff->_get_staff_info($_POST['staff_no']);
				if (count($rec) > 0) {
					$form_data['success'] = true;
					$form_data['staff_info'] = $rec;
				} else {
					$form_data['success'] = false;
					$form_data['errors'] = 'Staff no not found in registered staff records';

				}

			}

		} else {
			$form_data['success'] = false;
			$form_data['errors'] = 'Unable to register staff in the training';

		}





	} else {
		$form_data['success'] = false;
		$form_data['errors'] = 'Unable to register staff in the training';

	}

	echo json_encode($form_data);
	return;	

?>