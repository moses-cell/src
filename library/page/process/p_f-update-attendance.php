<?php

	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_training-application.php';


	$glib = new globalLibrary();
	$hr_tm = new c_training_application();

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		$form_data['errors'] = "Unable to update participant attendance";	
		$form_data['success'] = false;
	}

	if (isset($_GET['day'])) {
		$day = $_GET['day'];
	} else {
		$form_data['errors'] = "Unable to update participant attendance";	
		$form_data['success'] = false;

	}

	if (isset($_GET['checked'])) {
		$status = $_GET['checked'];
	} else {
		$form_data['errors'] = "Unable to update participant attendance";	
		$form_data['success'] = false;

	}


	$id = $glib->encrypt_decrypt('decrypt', $id, 'id');
	$day = $glib->encrypt_decrypt('decrypt', $day, 'id');

	$data = $hr_tm->_get_participant_attendance($id);
	if (count($data) > 0) {

		$total = '0';
		//echo $data[0]['total_attend'] . 'xxxyyddd';
		$total = $data[0]['total_attend'];
		$total_day = $data[0]['total_days'];

		$attendance = $data[0]['attendance'];
		if ($attendance == '') {
			for ($i = 0; $i<$total_day; $i++) 
				$attendance_array[$i] = '0';
		} else {
			$attendance_array = explode(',',$attendance);
		}

		if (count($attendance_array) < $total_day) {
			for ($i = 0; $i<$total_day; $i++)  {
				if (isset($attendance_array[$i]) == false)
					$attendance_array[$i] = '0';
			}
		}
		
		//echo $total . 'xxxyy';
		if (!is_numeric($total))
			$total = 0;


		//echo $total . 'xxx';
		//echo $status;
		if ($status == '1') {
			$attendance_array[$day -1] = '1';
			$total = $total + 1;
		}
		else {
			$attendance_array[$day -1] = '0';
			$total = $total - 1;

			if ($total < 0)
				$total = 0;
		}

		$total = 0;
		//print_r($attendance_array);
		$attendance = implode(',',$attendance_array);
		for ($i = 1; $i <= $total_day; $i++) {
			if ($attendance_array[$i-1] == '1') {
				$total = $total + 1;
			}
		}
		//print_r($attendance_array);
		//echo ($attendance);
		//echo $total;
		//print_r($data);

//		return;
		if ($hr_tm->_update_participant_attendance($id, $attendance, $total) == false) {
			$form_data['errors'] = "Unable to update participant attendance";	
			$form_data['success'] = false;	
		} else {
			$form_data['success'] = true;
		}

	} else {
		$form_data['errors'] = "Unable to update participant attendance";	
		$form_data['success'] = false;
	}
	
	
	

	echo json_encode($form_data);
	return;

?>