<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_calender.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_staff.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';


	date_default_timezone_set("Asia/Kuala_Lumpur");

	$c_staff = new c_staff();
	$rec = $c_staff->_get_staff_info($_SESSION['staff_no']);

    if (count($rec) > 0) {
    	$data = $rec[0];
    } else {
		$calendar = array();
	    $calendarData = array(
			"success" => 1,	
	    	"result"=>$calendar
	    );
			
		echo json_encode($calendarData);
		exit;
	}

	if (!isset($_SERVER['HTTP_REFERER'])) {
		//echo $_SERVER['HTTP_REFERER'];
		$calendar = array();
	    $calendarData = array(
			"success" => 1,	
	    	"result"=>$calendar
	    );
			
		echo json_encode($calendarData);
		exit;
	}

	



	//echo $_SERVER['HTTP_REFERER'];
	$condition = "(status != 'Cancel' and status != 'Reject') ";

	$sql = "Select ts.*, ta.id, ta.fullname, ta.secretary_email, ta.staff_request, ta.status  from training_application ta inner join training_schedule ts on (ta.sch_id = ts.id) ";

	if ((strpos($_SERVER['HTTP_REFERER'], 'l-c-staff-training-schedule-unit.php') !== false) && $_SESSION['Unit Secretary'] == 'Yes') {
		$condition .= " and (secretary_email = '". $data['email']  ."') ";
	} elseif ((strpos($_SERVER['HTTP_REFERER'], 'l-c-staff-training-schedule-depoh.php') !== false) && $_SESSION['Bus Depoh Admin'] == 'Yes') {
		$condition .= " and (depoh_admin_email = '". $data['email']  ."') ";
	} elseif ((strpos($_SERVER['HTTP_REFERER'], 'l-c-staff-training-schedule-depoh.php') !== false) && $_SESSION['Rail Depoh Admin'] == 'Yes') {
		$condition .= " and (depoh_admin_email = '". $data['email']  ."') ";
	} elseif ((strpos($_SERVER['HTTP_REFERER'], 'l-c-staff-training-schedule.php') !== false) ) {
		$condition .= " and (appr_no = '". $data['staff_no']  ."' or super_no = '" . $data['staff_no'] . "') ";
	} else {
		$calendar = array();
	    $calendarData = array(
			"success" => 1,	
	    	"result"=>$calendar
	    );
			
		echo json_encode($calendarData);
		exit;
	}


	/*if ($_SESSION['HR Admin'] == 'Yes')
		$condition .= "";
	elseif ($_SESSION['Rail Depoh Admin'] == 'Yes') {
		$condition .= " and ts.created_by  = '". $_SESSION['full_name']  . "'";
	} elseif ($_SESSION['Bus Depoh Admin'] == 'Yes') {
		$condition .= " and ts.created_by  = '". $_SESSION['full_name']  . "'";
		
	} elseif ($_SESSION['Unit Secretary'] == 'Yes') {
		$condition .= " and ts.created_by  = '". $_SESSION['full_name']  . "'";
		
	} else {
		$result =  [
		    'draw' => 1,
		    'recordsTotal' => 0,
		    'recordsFiltered' => 0,
		    'data' => array(),
		];
		echo json_encode ($result);
		return;
	}*/


	if (isset($_GET['from'])) {
		$from = $_GET['from'];
		$from = date('Y-m-d', $from/1000);
	}	
	if (isset($_GET['to'])) {
		$to = $_GET['to'];
		$to = date('Y-m-d', $to/1000);
	}	

	if (isset($_GET['cat'])) {
		$cat = $_GET['cat'];
		if ($cat != '') {
			$condition .= "and category = '" . $cat . "'";
		}
	}	

	//echo $condition . 'xxx';

	$calender = new c_calender();
	$data = $calender->get_data('', 'ts.date_start', $from, 'ts.date_end', $to, $sql, $condition);

	$calendar = array();
	$glib = new globalLibrary;

	$text_color = array("event-important","event-warning","event-info","event-inverse","event-success","event-special","event-submit");
	$i = 0;
				    
	foreach ($data as $row) {
			
		$to2 = date('Y-m-d', strtotime($to . ' - 1 day'));
		if ($from == $to2) {
			$start = strtotime($from . ' ' . $row['time_start']) * 1000;
			$end = strtotime($to2 . ' ' . $row['time_end']) * 1000;	
		} else {
			$start = strtotime($row['date_start'] . ' ' . $row['time_start']) * 1000;
			$end = strtotime($row['date_end'] . ' ' . $row['time_end']) * 1000;	
		}

		$class = $text_color[$i];

		$i++;
        if ($i >= count($text_color) - 1)
        	$i = 0;

		if ($row['staff_request'] == '1') {
			$url = ''; //future planning 
		}

		$code = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
		$calendar[] = array(
        	'id' =>$row['id'],
        	'title' => $row['fullname'] . ' (' . $row['title'] . ')',
        	'url' => 'f-training-application-details.php?id=' . $code,
			"class" => $class,
        	'start' => "$start",
        	'end' => "$end",
        	'start_date' =>  date( 'd/m/Y', strtotime($row['date_start'])),
        	'end_date' => date( 'd/m/Y', strtotime($row['date_end'])),
    	);
	}

	$calendarData = array(
		"success" => 1,	
    	"result"=>$calendar);
	
	echo json_encode($calendarData);
	exit;

?>