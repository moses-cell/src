<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/page/shared/b_session.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';
	

	$table = 'userlog';
	$primaryKey = 'id';

	//$glib = new globalLibrary;
	//$year = $glib->encrypt_decrypt('decrypt',$_GET['y'], 'year');

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'ts.id';

	$sql = "Select ts.code, ts.title, tc.category, ts.total_days, ts.total_hours, ts.max_sit, ts.eligibility, ts.code, ts.date_start, ts.date_end, ts.id, ts.enable_schedule ";

	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "training_schedule ts left join training_category tc on ts.category = tc.id ";

	$condition = "staff_request != '1' and enable_schedule != '1' and enable_schedule != '2'";
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
	    array( 'db' => 'category',   'dt' => 7, 'tbl_field' => 'category' ),
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
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition,  $order_by )
	);



?>