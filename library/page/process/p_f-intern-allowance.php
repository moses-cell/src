<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_intern.php';


	$glib = new globalLibrary();


	$_SESSION['full_name'] = $_POST['editor_name'];

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {

		$_POST['id'] = '';
		if ($_POST['pageid'] != '')
			$_POST['id'] = $glib->encrypt_decrypt('decrypt', $_POST['pageid'],'id' );
		else
			$_POST['id'] = '';

		$c_intern = new c_intern();
	
		if ($c_intern->_save_allowance()) {
			
			$form_data['success'] = true;

		} else {
			$form_data['errors'] = "There is an error while saving Intern Profile";	
			$form_data['success'] = false;

		}
		echo json_encode($form_data);
		return;
	}

	if ($_POST['form_process'] == 'Verify') {

		$c_intern = new c_intern();
		$sdate = '1-'.$_POST['month'] . '-'.$_POST['year'];
		
		$date = new DateTime(date('Y-m-d', strtotime($_POST['year'] . '-' . $_POST['month'] . '-1')));
		$date->modify('last day of this month');
		$edate = $date->format('d') .'-' . $_POST['month'] . '-'.$_POST['year'];

		$data = $c_intern->_get_record_internship_period($_POST['ic_no'], $sdate, $edate);
		if (count($data) <= 0) {
			$form_data['errors'] = "Internship Student information not available for selected month and year allowance";	
			$form_data['success'] = false;
			echo json_encode($form_data);
			return;
	
		}

		$_POST['intern_id'] = $data[0]['id'];

		$intern_allowance = $c_intern->_get_record_intern_allowance_for_month($_POST['intern_id'],$_POST['month'],$_POST['year']);

		if (count($intern_allowance) > 0) {
			$form_data['errors'] = "Internship Student allowance for selected month and year allowance already available";	
			$form_data['success'] = false;
			echo json_encode($form_data);
			return;
	
		}

		$intern_allowance = $c_intern->_get_record_intern_allowance_details($_POST['intern_id']);
		$mc = 0;
		$tbl = '';

		if (count($intern_allowance) > 0) {
			$mc = 0;
			$tbl = '';
			foreach  ($intern_allowance as $row) {
				$mc = $mc + $row['mc_leave_taken'];
				$tbl .= '<tr>';
				$tbl .= '<td>' . $row['month'] . '</td>';
				$tbl .= '<td>' . $row['year'] . '</td>';
				$tbl .= '<td>' . $row['mc_leave_taken'] . '</td>';
				$tbl .= '<td>' . $row['allowance'] . '</td>';
				$tbl .= '</tr>';
			}
	
		}


		$form_data['data'] = $data;
		$form_data['mc'] = $mc;
		$form_data['history'] = $tbl;
		$form_data['success'] = true;
		echo json_encode($form_data);
		return;
		//print_r($_POST);


	}
?>