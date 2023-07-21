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

	echo '<p>sch_training-first-reminder start'. '</p>';

	$c_setting = new c_adm_setting();
	$setting_data = $c_setting->_get_record_by_key('training_first_reminder');
	if (count($setting_data) <= 0 ) {
		echo '<p>No setting found for training_first_reminder ' . '</p>' ;
		echo '<p>sch_training-first-reminder stop'. '</p>';
		return;
	}


	$dt = date('Y-m-d');
	$dt = date('Y-m-d', strtotime($dt. ' + ' . $setting_data[0]['setting_value'] . ' days'));
	

	$sch = $c_training->_get_training_schedule_by_date($dt);
	if (count($sch) <= 0) {
		echo '<p>No training on ' . date('d-m-Y',strtotime($dt)) . '</p>' ;
		echo '<p>sch_training-first-reminder stop'. '</p>';
		return;
	}

	foreach ($sch as $training_sch) {

		$tbl = '';
		$i = 0; 

		$rec = $c_training->_get_approve_participant_list($training_sch['id']);
		if (count($rec) <= 0) {
			echo '<p>No participant registered for  ' . $training_sch['title'] . ' on ' .  date('d-m-Y',strtotime($dt)) . '</p>' ;
		} else {
			
			$tbl = '<table style="margin-left: 150px; max-width:850px; border-collapse: collapse;"  class="tbl_detail">';
            $tbl .= '<tr style="background: lightgray;">
                    <td width="50px">No</td>
                    <td width="250px">Name</td>
                    <td width="100px">Staff Id</td>
                    <td width="200px">Department</td>    
                </tr>';
                 
			foreach ($rec as $training_data) {
            	$i++;
				$tbl .= "<tr>";
					
				$tbl .= "<td>". $i."</td>";
				$tbl .= "<td>". strtoupper($training_data['fullname'])."</td>";
				$tbl .= "<td>". strtoupper($training_data['staff_no'])."</td>";
				$tbl .= "<td>". strtoupper($training_data['department'])."</td>";
				$tbl .= "</tr>";

			}
			$tbl .= '</table>';

			$mailer = new email_process();
			$mailer->training_reminder($training_sch, $rec, $tbl);

		}
	}
	
	echo '<p>sch_training-first-reminder stop'. '</p>';

?>