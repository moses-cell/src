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
	$primaryKey = 'ta.staff_no';
	$title = '';
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

	if (isset($_GET['title'])) {
		if ($_GET['title'] != '') {
			$title = $_GET['title'];
		}
	}	

	$sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location, te.assessment_date, te.id as eval_id, te.training_result, te.recommendation, tpl.trainer_name, ";
	$sql .= "tl.details as location_detail, tc.category as training_category, ts.title as training_title, ts.date_start, ts.date_end   ";
	$table .= "training_application ta ";
	$table .= "inner join trainer_eval te on ta.id = te.app_id ";
	$table .= "inner join training_schedule ts on ta.sch_id = ts.id ";
	$table .= "inner join trainer_profile tpl on tpl.id = ts.trainer_id ";
	$table .= "left join training_provider tp on ts.provider = tp.id ";
	$table .= "left join training_location tl on ts.location = tl.id ";
	$table .= "left join training_category tc on ts.category = tc.id ";


	$condition = " ta.trainer_eval > 2";

	if ($from == '' && $to == '') 
		$condition = "ta.trainer_eval > 2";
	else {
		if ($title != '') {
			$condition = "ta.trainer_eval > 2 and ts.title = '" . $title . "' and (ts.date_start between '" . $from ."' and '" . $to . "')";	
		} else {
			$condition = "ta.trainer_eval > 2";
		}
	}
	
	$_SESSION['condition'] = $condition;

	$columns = array(
		array( 	'db' => 'eval_id',     'dt' => 0, 'tbl_field' => 'eval_id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-trainer-assessment.php?eval=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view trainer assessment" style="width:16px;height:16px;" title="View Trainer Assessment"></a>';
  					
  					return $edit;
				}	
			),
	    array( 	'db' => 'staff_no', 'dt' => 1, 'tbl_field' => 'ta.staff_no' ),
	    array( 	'db' => 'fullname',  'dt' => 2, 'tbl_field' => 'ta.fullname' ),
	    array( 	'db' => 'training_title',  'dt' => 3, 'tbl_field' => 'ts.title'),
	    array( 	'db' => 'date_start',  'dt' => 4, 'tbl_field' => 'ts.date_start',
			'formatter' => function($d, $row ) {
				$sDate = strtotime($d);
				return date('d/m/Y',$sDate);
			}),
	    array( 	'db' => 'date_end',  'dt' => 5, 'tbl_field' => 'ts.date_end',
			'formatter' => function($d, $row ) {
				$eDate = strtotime($d);
				return date('d/m/Y',$eDate);
			}),
	    array( 	'db' => 'trainer_name',  'dt' => 6, 'tbl_field' => 'tpl.trainer_name'),
	  	array( 	'db' => 'assessment_date',  'dt' => 7, 'tbl_field' => 'assessment_date',
			'formatter' => function($d, $row ) {
				$eDate = strtotime($d);
				return date('d/m/Y',$eDate);
			}),
	  	array( 	'db' => 'training_result',  'dt' => 8, 'tbl_field' => 'training_result'),
	  	array( 	'db' => 'recommendation',  'dt' => 9, 'tbl_field' => 'recommendation'),
	  	array( 	'db' => 'eval_id',     'dt' => 10, 'tbl_field' => 'te.id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-trainer-assessment.php?eval=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view trainer assessment" style="width:16px;height:16px;" title="View Trainer Assessment"></a>';
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>