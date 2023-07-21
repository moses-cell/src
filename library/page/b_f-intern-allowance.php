<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_intern.php';


	$glib = new globalLibrary();
	$c_emp = new c_intern();


	if (isset($_GET['id'])) {

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$_SESSION['page_id'] = $_GET['id'];


		$rec = $c_emp->_get_allowance($id);
		$intern = array();
		if (count($rec) > 0) {
			$intern = $c_emp->_get_record($rec[0]['intern_id']);
		}

		

		$intern_allowance = $c_emp->_get_record_intern_allowance_details($rec[0]['intern_id']);
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

		$result = ['Data'=>$rec, 'Intern'=>$intern, 'history' => $tbl];

		$data = json_encode($result,JSON_HEX_APOS);


	} else {
		$_SESSION['page_id'] = '';
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>