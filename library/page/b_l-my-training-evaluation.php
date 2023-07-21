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


	$sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location, te.assessment_date, te.id as eval_id, ";
	$sql .= "tl.details as location_detail, tc.category as training_category, ts.title as training_title  ";
	$table .= "training_application ta ";
	$table .= "inner join eval te on ta.id = te.app_id ";
	$table .= "left join training_schedule ts on ta.sch_id = ts.id ";
	$table .= "left join training_provider tp on ts.provider = tp.id ";
	$table .= "left join training_location tl on ts.location = tl.id ";
	$table .= "left join training_category tc on ts.category = tc.id ";

	$key = "(ta.staff_no =:appr_no and (ta.status = 'Submit for Approval' or ta.status = 'Approve') and ta.eval > 1)";

	$condition = "ta.staff_no = '". $_SESSION['staff_no']. "' and ta.eval > 2";



	$columns = array(
		array( 	'db' => 'eval_id',     'dt' => 0, 'tbl_field' => 'eval_id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-course-evaluation.php?eval=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view training evaluation" style="width:16px;height:16px;" title="View Training Evaluation"></a>';
  					
  					return $edit;
				}	
			),
	    array( 	'db' => 'staff_no', 'dt' => 1, 'tbl_field' => 'staff_no' ),
	    array( 	'db' => 'fullname',  'dt' => 2, 'tbl_field' => 'fullname' ),
	    array( 	'db' => 'training_title',  'dt' => 3, 'tbl_field' => 'training_title'),
	    array( 	'db' => 'date_start',  'dt' => 4, 'tbl_field' => 'date_start',
			'formatter' => function($d, $row ) {
				$sDate = strtotime($d);
				return date('d/m/Y',$sDate);
			}),
	    array( 	'db' => 'date_end',  'dt' => 5, 'tbl_field' => 'date_end',
			'formatter' => function($d, $row ) {
				$eDate = strtotime($d);
				return date('d/m/Y',$eDate);
			}),
	    array( 	'db' => 'assessment_date',  'dt' => 6, 'tbl_field' => 'assessment_date',
			'formatter' => function($d, $row ) {
				$eDate = strtotime($d);
				return date('d/m/Y',$eDate);
			}),
	    array( 	'db' => 'eval_id',     'dt' => 7, 'tbl_field' => 'eval_id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-course-evaluation.php?eval=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view training evaluation" style="width:16px;height:16px;" title="View Training Evaluation"></a>';
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>