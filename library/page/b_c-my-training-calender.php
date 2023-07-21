<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';	
	require_once dirname(dirname(__FILE__)) . '/class/c_calender.php';


	date_default_timezone_set("Asia/Kuala_Lumpur");
	$condition = "";

	if (isset($_GET['from'])) {
		$from = $_GET['from'];
		$from = date('Y-m-d', $from/1000);
	}	
	if (isset($_GET['to'])) {
		$to = $_GET['to'];
		$to = date('Y-m-d', $to/1000);
	}	

	//echo $from . '--' .$to;


	if ($_SESSION['user_type'] == 'external') {
		$condition = "email = '" . $_SESSION['username'] . "' and ta.status = 'Approve' ";
	} else {
		$condition = "staff_no = '" . $_SESSION['staff_no'] . "' and (ta.status in ('Approve'))"; // ,'Submit for Approval','Submit to HR')) ";
	}
	
	

	if (isset($_GET['cat'])) {
		$cat = $_GET['cat'];
		if ($cat != '') {
			$condition .= "and ts.category = '" . $cat . "'";
		}
	}	

	$sql = "Select ta.*, ts.title, ts.date_start, ts.date_end from training_application ta inner join training_schedule ts on ta.sch_id = ts.id ";
	//echo $sql . 'xxx';


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

		
		
		$code = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');

		if ($row['status'] == 'Submit for Approval') {
			$class = 'event-submit';
		}
		else
			$class = 'event-important';

		$class = $text_color[$i];

		$i++;
        if ($i >= count($text_color) - 1)
        	$i = 0;

		if ($row['cancel_status'] == 'Submit for Cancellation') 
			$status = 'Submit for Cancellation';
		else
			$status = $row['status'];

		$calendar[] = array(
        	'id' =>$row['id'],
        	'title' => $row['title'], // . ' (' . $status . ')' ,
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