<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/page/shared/b_session.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';
	

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$from =  '';
	$to = '';
	$primaryKey = 'ts.id';
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$condition = "";
	$_SESSION['condition'] = '';

	if (isset($_GET['sdt'])) {
		if ($_GET['sdt'] != '') {
			$from = $_GET['sdt'];
			$from = date('Y-m-d', $from/1000);
			$_SESSION['from'] = $from;
		}
	}	
	if (isset($_GET['edt'])) {
		if ($_GET['edt'] != '') {
			$to = $_GET['edt'];
			$to = date('Y-m-d', $to/1000);
			$_SESSION['to'] = $to;
		}
	}	
	$_SESSION['from'] = $from;
	$_SESSION['to'] = $to;
	$primaryKey = 'ts.id';


	$sql = "Select ts.code, ts.title, tc.category, ts.total_days, ts.total_hours, ts.max_sit, ts.eligibility, ts.code, ts.date_start, ts.date_end, ts.id, ts.enable_schedule ";

	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "training_schedule ts left join training_category tc on ts.category = tc.id ";


	if ($from =='' && $to == '') {
		$condition = "staff_request != '1' and enable_schedule = '2' ";
	} elseif ($from == $to) {
		$condition = "staff_request != '1' and enable_schedule = '2' and ((ts.date_start"  . " between '" . $from ."' and '" . $to . "') or (date_end"  . " between '" . $from ."' and '" . $to . "'))";
	} elseif ($to == '' ) {
		$condition = "staff_request != '1' and enable_schedule = '2' and ts.date_start >= '" . $from . "' ";
	} elseif ($from == '' ) {
		$condition = "staff_request != '1' and enable_schedule = '2' and ts.date_end <= '" . $to . "' ";
	} else {
		$condition = "staff_request != '1' and enable_schedule = '2' and ((ts.date_start"  . " between '" . $from ."' and '" . $to . "') or (date_end"  . " between '" . $from ."' and '" . $to . "'))";
	}

	$_SESSION['condition'] = "staff_request != '1' and enable_schedule = '2' ";
	
	$order_by = 'ts.date_start desc';

	if ($_SESSION['HR Admin'] == 'Yes')
		$condition .= "";
	elseif ($_SESSION['Rail Depoh Admin'] == 'Yes') {
		$condition .= " and ts.created_by  = '". $_SESSION['full_name']  . "'";
	} elseif ($_SESSION['Bus Depoh Admin'] == 'Yes') {
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
	}

	$columns = array(
		array( 'db' => 'id',     'dt' => 0, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-hr-training-schedule.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit training schedule" style="width:16px;height:16px;"></a>';
  					if ($_SESSION['Rail Depoh Admin'] == 'Yes' || $_SESSION['Bus Depoh Admin'] == 'Yes') {
  						$edit = '<a href="f-depoh-training-schedule.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit training schedule" style="width:16px;height:16px;"></a>';
  					}
  					return $edit ;
				}	
		),
	   	array( 'db' => 'code', 'dt' => 1, 'tbl_field' => 'code' ),
	    array( 'db' => 'title',  'dt' => 2, 'tbl_field' => 'title' ),
	    array( 'db' => 'date_start',     'dt' => 3, 'tbl_field' => 'date_start', 
	        'formatter' => function( $d, $row ) {
	        	if ($d != '')
	            	return date( 'd/m/Y', strtotime($d));
	           	else
	           		return '';
	        }
	    ),
	    array( 'db' => 'date_end',     'dt' => 4, 'tbl_field' => 'date_end', 
	        'formatter' => function( $d, $row ) {
	            if ($d != '')
	            	return date( 'd/m/Y', strtotime($d));
	           	else
	           		return '';
	        }
	    ),
	    array( 'db' => 'total_days',   'dt' => 5, 'tbl_field' => 'total_days' ),
	    array( 'db' => 'total_hours',   'dt' => 6, 'tbl_field' => 'total_hours' ),
	    array( 'db' => 'category',   'dt' => 7, 'tbl_field' => 'tc.category' ),
	    array( 'db' => 'max_sit',   'dt' => 8, 'tbl_field' => 'max_sit' ),
	    array( 'db' => 'eligibility',   'dt' => 9, 'tbl_field' => 'eligibility' ),
	    array( 'db' => 'enable_schedule',   'dt' => 10, 'tbl_field' => 'enable_schedule' ),
	    array( 'db' => 'id',     'dt' => 11, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-hr-training-schedule.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit training schedule" style="width:16px;height:16px;"></a>';
  					if ($_SESSION['Rail Depoh Admin'] == 'Yes' || $_SESSION['Bus Depoh Admin'] == 'Yes') {
  						$edit = '<a href="f-depoh-training-schedule.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit training schedule" style="width:16px;height:16px;"></a>';
  					}
  					return $edit ;
				}	
		),
	);

	
	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition,  $order_by, false )
	);



?>