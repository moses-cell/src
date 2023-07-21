<?php
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';

	$tfoot = "";
	$thead = "";
	$tbody = "";

	$appsbutton = '';
	$staff_request = '';

	if (isset($_GET['id'])) { //To view applied training
		$hr_sc = new c_training_application();

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');

		$_SESSION['page_id'] = $_GET['id'];
		$_SESSION['module_id'] = "";
		$rec = $hr_sc->_get_training_applied($id);
		$result = ['Data'=>$rec];

		//print_r($rec);
		$data = json_encode($result,JSON_HEX_APOS);


	} elseif (isset($_GET['sch'])) { //To apply schedule training application

		$hr_tm = new c_training_application();

		$id = $glib->encrypt_decrypt('decrypt', $_GET['sch'], 'id');
		$_SESSION['page_id'] = '';
		$_SESSION['sch_id'] = $id;
		$rec = $hr_tm->_get_training_schedule($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	}  else {
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}

	if (count($rec) > 0) {

		$sdate = $rec[0]['date_start'];
		$staff_no = $rec[0]['staff_no'];
		$appr_no = $rec[0]['appr_no'];
		$status = $rec[0]['status'];
		$cancel_status = $rec[0]['cancel_status'];
		$staff_request = $rec[0]['staff_request'];
		$training_provider = $rec[0]['training_provider'];
	} else
		return;


	if (isset($_GET['id']) ) {


		if ($appr_no == $_SESSION['staff_no'] && $status == 'Submit for Approval' ) {
			$appsbutton = '<button class="btn btn-prasarana" type="button" id="approve">Approve</button>';
			$appsbutton .= '<button class="btn btn-prasarana" type="button" id="reject">Reject</button>';

		} elseif ($appr_no == $_SESSION['staff_no'] && $cancel_status == 'Submit for Cancellation' ) {
			$appsbutton = '<button class="btn btn-prasarana" type="button" id="approve_cancel">Approve Cancellation</button>';
			$appsbutton .= '<button class="btn btn-prasarana" type="button" id="reject_cancel">Reject Cancellation</button>';

		} elseif ($staff_no == $_SESSION['staff_no']) {
			
			$sdt = strtotime($sdate);
			$today = strtotime(date('Y-m-d'));
			
			if ($today >= $sdt ) 
				$appsbutton = '';
			else
				$appsbutton = '<button class="btn btn-prasarana" type="button" id="cancel">Cancel Application </button>';
		} elseif ($_SESSION['HR Admin'] == 'Yes' && $status == 'Submit to HR' ) {
			$appsbutton = '<button class="btn btn-prasarana" type="button" id="approve_bonding">Approve with Bonding</button>';
			$appsbutton .= '<button class="btn btn-prasarana" type="button" id="approve_no_bonding">Approve without Bonding</button>';

			$appsbutton = '<button class="btn btn-prasarana" type="button" id="approve_hr">Approve</button>';
			$appsbutton .= '<button class="btn btn-prasarana" type="button" id="reject_hr">Reject</button>';

			if ($training_provider != '') {
				$appsbutton .= '<button class="btn btn-provider" type="button" id="add_provider">Add New Training Provider</button>';

			}

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