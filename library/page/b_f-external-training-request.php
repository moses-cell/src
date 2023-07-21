<?php
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)). '/class/c_staff.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-setting.php';

	$tfoot = "";
	$thead = "";
	$tbody = "";

	$appsbutton = '';
	$form_button = '';
	$setting = 0;

	if (isset($_GET['id'])) { //To view applied training
		$hr_sc = new c_training_application();

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$_SESSION['page_id'] = $_GET['id'];
		$_SESSION['module_id'] = "";
		$rec = $hr_sc->_get_training_applied($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	} else {

		$c_setting = new c_adm_setting();
		$setting_data = $c_setting->_get_record_by_key('external_min_request_day');
		
		if (count($setting_data) > 0)
			$setting = $setting_data[0]['setting_value'];


		if (is_numeric($setting) == false)
			$setting = 0;

		$staff = new c_staff();
		$staff_data = $staff->_get_staff_info($_SESSION['staff_no']);
		$rec = array();
		$result = ['Data'=>$staff_data];
		$data = json_encode($result,JSON_HEX_APOS);
		$form_button = '<div class="text-end mb-4">';
		$form_button .= '<button class="btn btn-prasarana" type="button" id="close">Close Document</button>';
		$form_button .= '<button class="btn btn-prasarana" type="button" id="submit">Submit Training Request</button>';
    	$form_button .= '</div>';

	
	}

	if (count($rec) > 0) {

		$sdate = $rec[0]['date_start'];
		$staff_no = $rec[0]['staff_no'];
		$appr_no = $rec[0]['appr_no'];
		$status = $rec[0]['status'];
	} else
		return;


	if (isset($_GET['id']) ) {
		
		if ($appr_no == $_SESSION['staff_no'] && $status == 'Submit for Approval' ) {
			$appsbutton = '<button class="btn btn-prasarana" type="button" id="approve">Approve</button>';
			$appsbutton .= '<button class="btn btn-prasarana" type="button" id="reject">Reject</button>';

		} elseif ($appr_no == $_SESSION['staff_no'] && $status == 'Submit for Cancellation' ) {
			$appsbutton = '<button class="btn btn-prasarana" type="button" id="approve_cancel">Approve Cancellation</button>';
			$appsbutton .= '<button class="btn btn-prasarana" type="button" id="reject_cancel">Reject Cancellation</button>';

		} elseif ($staff_no == $_SESSION['staff_no']) {
			$appsbutton = '<button class="btn btn-prasarana" type="button" id="cancel">Cancel Application </button>';
		}

	} 


	if (isset($_GET['id'])) {
		$glib = new globalLibrary();
		$hr_sc = new c_training_application();


		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		
		

		$rec = $hr_sc->_get_training_history($sdate, $staff_no);
		//$result = ['Data'=>$rec];

		//$data = json_encode($result,JSON_HEX_APOS);

		if (count($rec) > 0) {
			$class = "odd";

			foreach ($rec as $row) {

				$tbody .= "<tr>";
				$tbody .= "<td>". $row['title']."</td>";
				$tbody .= "<td>". $row['department']."</td>";
				$tbody .= "<td>". $row['position']."</td>";
				$tbody .= "<td>". date('d/m/Y', strtotime($row['date_start']))."</td>";
				$tbody .= "<td>". date('d/m/Y', strtotime($row['date_end']))."</td>";
				$tbody .= "<td>". $row['status']."</td>";
				$tbody .= "<td>". $row['total_attend']. '/' . $row['total_days'] . "</td>";
				
				$tbody .= "</tr>";

				if ($class = "odd")
					$class = 'even';
				else
					$class = 'odd';
			}
			

		}
	}


?>