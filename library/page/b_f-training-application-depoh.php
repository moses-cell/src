<?php
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';

	$bol_cancel_participant = '1';

	if (isset($_GET['sch'])) { //To apply schedule training application
		$form_button = '';

		$add_participan = '<button class="btn btn-prasarana mb-4 mt-2" type="button" id="add_participant">Add Participant</button>&nbsp';
		


		if (count($rec) > 0) {
			$row = $rec[0];
			
			if ($row['enable_schedule'] == 1) {

				$sdt = strtotime($row['date_start']);
				$today = strtotime(date('Y-m-d'));

				if ($today >= $sdt ) {
					$form_button = '';	
					$add_participan = '';	
					$bol_cancel_participant = '';				
				}

			}

		}



		$tfoot = "";
		$thead = "";
		$tbody = "";

		$id = $glib->encrypt_decrypt('decrypt', $_GET['sch'], 'id');

		$hr_sc = new c_training_application();
		$rec = $hr_sc->_get_participant_list_depoh($id, $_SESSION['staff_no']);
		$class = "odd";
		foreach ($rec as $row) {
			
			$sDate = strtotime($row['date_start']);
			$dt = strtotime(date('Y/m/d'));

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
				//$add_participan = '';
			}
			if ($sDate > $dt) {
				$tbody .= "<td>". '<button class="btn btn-prasarana cancel_participant" type="button" value="' . $row['id'] .'">Cancel Participant</button>'."</td>";
			}
			$tbody .= "<td>". $row['fullname']."</td>";
			//$tbody .= "<td>". $row['division']."</td>";
			$tbody .= "<td>". $row['department']."</td>";
			//$tbody .= "<td>". $row['unit']."</td>";
			$tbody .= "<td>". $row['position']."</td>";
			$tbody .= "<td>". $row['status']."</td>";
			$tbody .= "</tr>";

			if ($class = "odd")
				$class = 'even';
			else
				$class = 'odd';

		}



	}


?>