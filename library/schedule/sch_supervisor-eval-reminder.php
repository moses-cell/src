<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/page/shared/b_session.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_staff.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-setting.php';
	require_once dirname(dirname(__FILE__)) . '/page/shared/b_mailer.php';


	$glib = new globalLibrary();
	$c_training = new c_training_application();
	$add_participan = '';

	$tbody = '';
	$lst = '';

	echo '<p>sch_supervisor-eval-reminder start'. '</p>';

	$c_setting = new c_adm_setting();
	$setting_data = $c_setting->_get_record_by_key('supervisor_assessment_reminder');
	if (count($setting_data) <= 0 ) {
		echo '<p>No setting found for supervisor_assessment_reminder ' . '</p>' ;
		echo '<p>sch_supervisor-eval-reminder stop'. '</p>';
		return;
	}


	$dt = date('Y-m-d');
	$dt = date('Y-m-d', strtotime($dt. ' - ' . $setting_data[0]['setting_value'] . ' days'));
	
	//echo $dt;
	$eval = $c_training->_get_supervisor_pending_assessment($dt);
	//print_r($eval);
	//die();

	if (count($eval) <= 0) {
		echo '<p>No pending supervisor assessment on ' . date('d-m-Y',strtotime($dt)) . '</p>' ;
		echo '<p>sch_supervisor-eval-reminder stop'. '</p>';
		return;
	}

	foreach ($eval as $rec) {

		$tbl = '';
		$i = 0; 
		
		$mailer = new email_process();
		$mailer->supervisor_eval_reminder($rec);

	}
	
	echo '<p>sch_supervisor-eval-reminder stop'. '</p>';

?>