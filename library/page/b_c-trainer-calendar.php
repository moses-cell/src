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

	$condition = "ts.trainer_id = '" . $_SESSION['trainer_id'] . "' and ts.enable_schedule = '1'";

	if (isset($_GET['cat'])) {
		$cat = $_GET['cat'];
		if ($cat != '') {
			$condition .= "and ts.category = '" . $cat . "'";
		}
	}	

	$sql = "Select ts.* from training_schedule ts  ";
	//echo $condition . 'xxx';
	//echo $sql;

	$calender = new c_calender();
	$data = $calender->get_data('', 'ts.date_start', $from, 'ts.date_end', $to, $sql, $condition);

	$calendar = array();
	$glib = new globalLibrary;
				    
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

		
		$class = 'event-important';

		$calendar[] = array(
        	'id' =>$row['id'],
        	'title' => $row['title'] ,
        	'url' => 'f-trainer-training-schedule.php?id=' . $code,
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