<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	//require_once dirname(__FILE__) . '/shared/b_global_parameter.php';
	require_once dirname(dirname(__FILE__)). '/class/c_hr-training-module.php';
	require_once dirname(dirname(__FILE__)). '/class/c_hr-training-schedule.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-request.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-setting.php';


	$glib = new globalLibrary();

	//$param = new b_global_parameter();
	//$training_provider = $param->select_option_training_provider();
	//$target_audience = $param->checkbox_target_audience();
	$add_participan = '';
	$bol_cancel_participant = '1';

	$tfoot = "";
	$thead = "";
	$tbody = "";
	$form_button = '';

	$form_button = '<div class="text-end mb-4">';
	$form_button .= '<button class="btn btn-prasarana" type="button" id="save">Save Training Schedule</button>';
	$form_button .= '<button class="btn btn-prasarana" type="button" id="close">Close Document</button>';
    $form_button .= '</div>';
    $disable = '';
    $bol_disable = false;

	if (isset($_GET['id'])) {
		$hr_sc = new c_hr_training_schedule();

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$_SESSION['page_id'] = $_GET['id'];
		$_SESSION['sch_id'] = $id;
		$_SESSION['module_id'] = "";
		$_SESSION['request_id'] = '';
		$rec = $hr_sc->get_training_schedule($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);

		$add_participan = '<button class="btn btn-prasarana mb-4 mt-2" type="button" id="internal_participant">Add Internal Participant</button>&nbsp';
		$add_participan .= '<button class="btn btn-prasarana mb-4 mt-2" type="button" id="external_participant">Add External Participant</button>&nbsp';

		$btn_export = '<button class="btn btn-prasarana mb-4 mt-2" type="button" id="excel">Export Participant List</button>';

		$add_participan .= $btn_export;

		$form_button_start = '<div class="text-end mb-4">';
		$form_button_save = '<button class="btn btn-prasarana" type="button" id="save">Save Training Schedule</button>';
		$form_button_cancel = '<button class="btn btn-prasarana" type="button" id="cancel">Cancel Training Schedule</button>';
		$form_button_close = '<button class="btn btn-prasarana" type="button" id="close">Close Document</button>';

	    $form_button_end = '</div>';

		if (count($rec) > 0) {
			$row = $rec[0];
			if ($row['enable_schedule'] == 1) {

				$form_button = $form_button_start . $form_button_save;		

				$sdt = strtotime($row['date_start']);
				$today = strtotime(date('Y-m-d'));

				if ($today >= $sdt ) {
					$form_button = $form_button_start . $form_button_cancel;
					$add_participan = $btn_export;	
					$disable = 'disabled';
					$bol_cancel_participant = '';		
				} else {
					$form_button .=  $form_button_cancel;
				}

			}

			$form_button .= $form_button_close . $form_button_end;

			if ($_SESSION['Rail Depoh Admin'] == 'Yes' || $_SESSION['Bus Depoh Admin'] == 'Yes') {

				$add_participan = '<button class="btn btn-prasarana mb-4 mt-2" type="button" id="internal_participant">Add Internal Participant</button>&nbsp';
				$bol_cancel_participant = '';
				if ($row['created_by'] != $_SESSION['full_name']) {
						$form_button = '';
						$disable = 'disabled';
						$bol_disable = true;
				}
			}

			if ($row['enable_schedule'] == 2) {
				$add_participan = '';
				$bol_cancel_participant = '';
				$form_button = $form_button_start . $form_button_close . $form_button_end;
				$disable = 'disabled';
				$bol_disable = true;
			}
		}


	} elseif (isset($_GET['parent'])) {

		$hr_tm = new c_hr_training_module();

		$id = $glib->encrypt_decrypt('decrypt', $_GET['parent'], 'id');
		$_SESSION['page_id'] = '';
		$_SESSION['module_id'] = $id;
		$_SESSION['request_id'] = '';
		$rec = $hr_tm->_get_training_module($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	} elseif (isset($_GET['request'])) {

		$hr_tm = new c_training_request();

		$id = $glib->encrypt_decrypt('decrypt', $_GET['request'], 'id');
		$_SESSION['page_id'] = '';
		$_SESSION['module_id'] = '';
		$_SESSION['request_id'] = $id;
		$rec = $hr_tm->_get_training_request($id);
		$result = ['Type'=>'Training Request','Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	}  else {
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}

	
	if (isset($_GET['id'])) { //Get Participant List
		require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';
		$glib = new globalLibrary();
		$hr_sc = new c_training_application();


		$c_setting = new c_adm_setting();
		$setting_data = $c_setting->_get_record_by_key('hr_update_attendance_after_end_days');
		if (count($setting_data) > 0)
			$setting = $setting_data[0]['setting_value'];
		else
			$setting = 7;
		
		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$rec = $hr_sc->_get_training_schedule($id);
		//$result = ['Data'=>$rec];

		//$data = json_encode($result,JSON_HEX_APOS);

		if (count($rec) > 0) {
			$training_data = $rec[0];
			$sDate = strtotime($training_data['date_start']);
			$eDate = strtotime($training_data['date_end']);
			$eDate = strtotime("+" . $setting . " day", $eDate);

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
			$rec = $hr_sc->_get_participant_list($id);
			$class = "odd";

			foreach ($rec as $row) {

				$sDate = strtotime($training_data['date_start']);

				$dt = strtotime(date('Y/m/d'));

				$tbody .= "<tr>";
				if ($sDate > $dt) {
					$tbody .= "<td>". '<button class="btn btn-prasarana cancel_participant" type="button" value="' . $row['id'] .'">Cancel Participant</button>'."</td>";
				}

				$tbody .= "<td>". $row['fullname']."</td>";
				$tbody .= "<td>". $row['department']."</td>";
				$tbody .= "<td>". $row['position']."</td>";
				$tbody .= "<td>". $row['status']."</td>";
				$attendance = $row['attendance'];
				$attendance_array = explode (',', $attendance);

				$begin = new DateTime( "2015-07-03" );
				$end   = new DateTime( "2015-07-09" );

				$begin = strtotime($training_data['date_start']);
				$end = strtotime($training_data['date_end']);
				
				$i = 1;
				while (($begin) <= ($end)) {
				//for ($i=1; $i <= $training_data['total_days']; $i++) {

					$check = '';
					if (is_array($attendance_array) ){
						if (isset($attendance_array[$i -1])) {
							if ($attendance_array[$i -1] == '1') {
								$check = 'checked';
							}
						}	
					}
					

					$training_id = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
					$training_day = $glib->encrypt_decrypt('encrypt',$i, 'id');
					$val = 'id='.$training_id . '&day=' . $training_day;
				
					if ($dt < $sDate) {
						$tbody .= "<td>". "<div class='text-center'><input class='form-check-input attendance_check'  type='checkbox' id='attendace_" . $row['id'] ."_" . $i. "' name='attendace_" . $row['id'] ."_" . $i. "' value='" .$val ."' title='Click for attendance' ". $check . "  disabled /></div></td>";
					} elseif ($dt > $eDate) {
						$tbody .= "<td>". "<div class='text-center'><input class='form-check-input attendance_check'  type='checkbox' id='attendace_" . $row['id'] ."_" . $i. "' name='attendace_" . $row['id'] ."_" . $i. "' value='" .$val ."' title='Click for attendance' ". $check . " disabled /></div></td>";
					} else {

						$tbody .= "<td>". "<div class='text-center'><input class='form-check-input attendance_check'  type='checkbox' id='attendace_" . $row['id'] ."_" . $i. "' name='attendace_" . $row['id'] ."_" . $i. "' value='" .$val ."' title='Click for attendance' ". $check . "  /></div></td>";
					}


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