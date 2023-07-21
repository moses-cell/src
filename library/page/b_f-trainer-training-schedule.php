<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_adm-setting.php';


	$glib = new globalLibrary();
	$hr_sc = new c_training_application();
	$add_participan = '';

	$btn_notify = '';

	if (isset($_GET['id'])) {

		$tfoot = "";
		$thead = "";
		$tbody = "";

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$_SESSION['page_id'] = $_GET['id'];
		$_SESSION['sch_id'] = $id;
		$_SESSION['module_id'] = "";
		$rec = $hr_sc->_get_training_schedule($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);

		if (count($rec) > 0) {
			$training_data = $rec[0];

			$sDate = strtotime($training_data['date_start']);
			$eDate = strtotime($training_data['date_end']);
			$dt = strtotime(date('Y/m/d'));

			if (($sDate <= $dt) && ($eDate >= $dt ))  {
				$add_participan = '<button class="btn btn-prasarana mb-4 mt-2" type="button" id="add_participan">Add New Participant</button>';
			}

			$add_participan = '';
			if (($sDate == $dt))  {
				$add_participan = '<button class="btn btn-prasarana mb-4 mt-2" type="button" id="add_participan">Add New Participant</button>';
			}

			if ($eDate <= $dt) {
				$btn_notify = '<button class="btn btn-prasarana mb-4 mt-2" type="button" id="training_complete">Training Completion Notice</button>';
			}

			$begin = strtotime($training_data['date_start']);
			$end = strtotime($training_data['date_end']);

			while (($begin) <= ($end)) {
			//for ($i=1; $i <= $training_data['total_days']; $i++) {
				$thead .= '<th width="80px">' . date('d/m/Y', $sDate) . '</th>';

				$newDate = $sDate;
				$sDate = strtotime("+1 day", $newDate);
				$tfoot = $thead;

				$tmp_begin = $begin;
				$begin = strtotime("+1 days", ($begin));
			}		

			$rec = $hr_sc->_get_trainer_participant_list($id);

			$c_setting = new c_adm_setting();
			$setting_data = $c_setting->_get_record_by_key('trainer_can_update_attendance_after_training');

			$days = 0;
			if (count($setting_data) > 0) {
				$setting_data = $setting_data[0];
				$days = $setting_data['setting_value'];
			} 
			

			$class = "odd";

			foreach ($rec as $row) {

				$sDate = strtotime($training_data['date_start']);
				$eDate = strtotime($training_data['date_end']);
				$dt = strtotime(date('Y/m/d'));

				//echo date('d/m/Y', $eDate) . $days . '<br>';
				//echo date('Y-m-d', strtotime(date('Y-m-d', $eDate). ' + ' . $days . ' days')). '<br>';
				$lastdate = strtotime(date('Y-m-d', $eDate). ' + ' . $days . ' days');
				//echo date('d/m/Y', $lastdate);
				//die();

				$staff_no = $glib->encrypt_decrypt('encrypt',$row['staff_no'], 'id');
				$id =  $glib->encrypt_decrypt('encrypt',$row['id'], 'id');

				$tbody .= "<tr>";
				if ($sDate == $dt) {
					$add_participan = '1';
					if ($row['participant_type'] == '1') {
						if ($row['trainer_cancel'] == '1') {
							//$tbody .= "<td>". '<button class="btn btn-prasarana reinstate" type="button" value="' . $row['staff_no'] .'">Reinstate Participant</button>'."</td>";
							$tbody .= "<td></td>";

						} elseif ($row['trainer_created'] == '1') {
							$tbody .= "<td>". '<button class="btn btn-prasarana cancel" type="button" value="' . $id .'">Cancel Participant</button>'."</td>";
						} else {
							$tbody .= "<td>". '<button class="btn btn-prasarana replace" type="button" value="' . $staff_no .'">Replace Participant</button>'."</td>";
						}
					} else
						$tbody .= "<td></td>";
				} else {
					$add_participan = '';
				}
				

				$tbody .= "<td>". $row['fullname']."</td>";
				$tbody .= "<td>". $row['department']."</td>";
				$tbody .= "<td>". $row['position']."</td>";
				$attendance = $row['attendance'];
				$attendance_array = explode (',', $attendance);

				$begin = strtotime($training_data['date_start']);
				$end = strtotime($training_data['date_end']);
				
				$i = 1;
				while (($begin) <= ($end)) {
				//for ($i=1; $i <= $training_data['total_days']; $i++) {

					$check = '';
					if (isset($attendance_array[$i -1])) {
						if ($attendance_array[$i -1] == '1') {
							$check = 'checked';
						}
					}
					

					$training_id = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
					$training_day = $glib->encrypt_decrypt('encrypt',$i, 'id');
					$val = 'id='.$training_id . '&day=' . $training_day;
				
					if ($dt < $sDate) {
						
						$tbody .= "<td>". "<div class='text-center'><input class='form-check-input attendance_check'  type='checkbox' id='attendace_" . $row['id'] ."_" . $i. "' name='attendace_" . $row['id'] ."_" . $i. "' value='" .$val ."' title='Click for attendance' ". $check . "  disabled/></div></td>";
					} elseif ($dt > $lastdate) {
						
						$tbody .= "<td>". "<div class='text-center'><input class='form-check-input attendance_check'  type='checkbox' id='attendace_" . $row['id'] ."_" . $i. "' name='attendace_" . $row['id'] ."_" . $i. "' value='" .$val ."' title='Click for attendance' ". $check . "  disabled/></div></td>";
					} elseif ($dt > $lastdate) {

						$tbody .= "<td>". "<div class='text-center'><input class='form-check-input attendance_check'  type='checkbox' id='attendace_" . $row['id'] ."_" . $i. "' name='attendace_" . $row['id'] ."_" . $i. "' value='" .$val ."' title='Click for attendance' ". $check . "  disabled/></div></td>";
					} else {
						
						$tbody .= "<td>". "<div class='text-center'><input class='form-check-input attendance_check'  type='checkbox' id='attendace_" . $row['id'] ."_" . $i. "' name='attendace_" . $row['id'] ."_" . $i. "' value='" .$val ."' title='Click for attendance' ". $check . " /></div></td>";

					}
					//die();

					$newDate = $sDate;
					$sDate = strtotime("+1 day", $newDate);

					$tmp_begin = $begin;
					$begin = strtotime("+1 days", ($begin));
					$i++;
					
				}	

				$tbody .= "</tr>";

				if ($class = "odd")
					$class = 'even';
				else
					$class = 'odd';
			}
			

		}
	}

?>