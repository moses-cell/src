<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_adm-setting.php';


	$glib = new globalLibrary();
	$hr_sc = new c_training_application();
	$add_participan = '';

	$tbody = '';
	$lst = '';

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

		if (count($rec) > 0) {
			$training_data = $rec[0];

			$traininig_title = $training_data['title'];
			$sDate = strtotime($training_data['date_start']);
			$eDate = strtotime($training_data['date_end']);
			$dt = strtotime(date('Y/m/d'));

			$training_date = date('d-m-Y', $sDate) . ' to ' . date('d-m-Y', $eDate);
			$trainer_name = ucwords(strtolower($_SESSION['full_name']));

			$rec = $hr_sc->_get_trainer_participant_list_result($id);

			$i = 0;
			$j = 0;
			foreach ($rec as $row) {
				
				//print_r($row);
				//die();
				if ($row['total_attend'] > 0) {
					$i++;
					$tbody .= "<tr>";
					
					$tbody .= "<td>". $i."</td>";
					$tbody .= "<td>". strtoupper($row['fullname'])."</td>";
					$tbody .= "<td>". strtoupper($row['staff_no'])."</td>";
					$tbody .= "<td>". strtoupper($row['department'])."</td>";
					$tbody .= "<td>". strtoupper($row['training_result'])."</td>";
					

					$tbody .= "</tr>";
				} else {
					$j++;
					if ($j == 1) {
						$lst = '<p style="margin-left:0px; margin-top:20px;  line-height: 40px; max-width: 850px;">However, we wish to inform that the following staffs did not attend the training as scheduled:</p><p style="margin-left:50px; margin-top:-20px; font-size:18px; line-height: 40px; max-width: 850px;">';
					}
					$lst .= $j . '. ' . $row['fullname'] . '<br>';

				}
				
			}

			if ($j > 0) 
				$lst .= '</p>';		

		}
	}

?>