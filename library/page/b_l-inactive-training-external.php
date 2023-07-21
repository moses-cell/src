<?php

	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_datatable.php';
	
	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

	$table = 'userlog';
	$primaryKey = 'id';

	//$glib = new globalLibrary;
	//$year = $glib->encrypt_decrypt('decrypt',$_GET['y'], 'year');

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'staff_no';
	$from = '';
	$to = '';
	//echo $_SERVER['QUERY_STRING'];

	if (isset($_GET['sdt'])) {
		if ($_GET['sdt'] != '') {
			$from = $_GET['sdt'];
			$from = date('Y-m-d', $from/1000);
		}
	}	
	
	if (isset($_GET['edt'])) {

		if ($_GET['edt'] != '') {
			$to = $_GET['edt'];
			$to = date('Y-m-d', $to/1000);
		}
	}	

	$_SESSION['from'] = $from;
	$_SESSION['to'] = $to;

	$sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request,  ";
	$sql .= "tl.details as location_detail, tc.category as training_category, ts.title as training_title, ts.training_provider  ";
	$table .= "training_application ta ";
	$table .= "left join training_schedule ts on ta.sch_id = ts.id ";
	$table .= "left join training_provider tp on ts.provider = tp.id ";
	$table .= "left join training_location tl on ts.location = tl.id ";
	$table .= "left join training_category tc on ts.category = tc.id ";

	$key = "(ta.staff_no =:appr_no and (ta.status = 'Submit for Approval' or ta.status = 'Approve') and ta.eval > 1)";

	$condition = "(ta.status = 'Submit for Approval' or ta.status = 'Approve') and ts.date_end < '" . date('Y-m-d') . "' and participant_type = 2";

	if ($from == '' && $to == '') {
		$main_condition = "(ta.status = 'Approve') and ts.date_end < '" . date('Y-m-d') . "' and participant_type = 2 ";
	
	} elseif ($from == $to) {
		$main_condition = "(ta.status = 'Approve' )  and participant_type = 2 and ((ts.date_start"  . " between '" . $from ."' and '" . $to . "') or (ts.date_end"  . " between '" . $from ."' and '" . $to . "')) ";
	} elseif ($to == '' ) {
		$main_condition = "(ta.status = 'Approve' )  and participant_type = 2 and ts.date_start between '" . $from . "' and '" . date('Y-m-' . date('d') -1) . "' ";
	} elseif ($from == '' ) {
		$main_condition = "(ta.status = 'Approve' )  and participant_type = 2 and ts.date_end < '" . $to . "' ";
	} else {
		$main_condition = "(ta.status = 'Approve')  and participant_type = 2 and ((ts.date_start"  . " between '" . $from ."' and '" . $to . "') or (ts.date_end"  . " between '" . $from ."' and '" . $to . "'))";
	}

	$_SESSION['condition'] = $main_condition;
	//echo $condition;

	$columns = array(
		array( 	'db' => 'id',     'dt' => 0, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-training-application-details.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view training evaluation" style="width:16px;height:16px;" title="View Training Details"></a>';
  					
  					return $edit;
				}	
			),
	    array( 	'db' => 'company', 'dt' => 1, 'tbl_field' => 'company' ), 
	    array( 	'db' => 'department', 'dt' => 2, 'tbl_field' => 'department' ), 
	    array( 	'db' => 'fullname', 'dt' => 3, 'tbl_field' => 'fullname' ), 
	    array( 	'db' => 'training_title', 'dt' => 4, 'tbl_field' => 'ts.title ' ),    
	    array( 	'db' => 'date_start',  'dt' => 5, 'tbl_field' => 'ts.date_start',
			'formatter' => function($d, $row ) {
				$sDate = strtotime($d);
				return date('d/m/Y',$sDate);
			}),
	    array( 	'db' => 'date_end',  'dt' => 6, 'tbl_field' => 'ts.date_end',
			'formatter' => function($d, $row ) {
				$eDate = strtotime($d);
				return date('d/m/Y',$eDate);
			}),
   	    array( 	'db' => 'provider_name',  'dt' => 7, 'tbl_field' => 'provider_name',
   	    	'formatter' => function($d, $row) {
	    			if ($row['staff_request'] == '1') {
	    				return $row['training_provider'];
	    			} else
	    				return $d;
	    		}

   		),
	    
	    array( 	'db' => 'id',     'dt' => 8, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-training-application-details.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view training details" style="width:16px;height:16px;" title="View Training Training"></a>';
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $main_condition, $button )
	);



?>