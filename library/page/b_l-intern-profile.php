<?php

	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_datatable.php';
	
	$table = 'userlog';
	$primaryKey = 'id';

	//$glib = new globalLibrary;
	//$year = $glib->encrypt_decrypt('decrypt',$_GET['y'], 'year');

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'ic_no';

	$sql = "Select * ";
	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "intern_info ";
	$condition = array();
	$order_by = "date_start desc ";

	$columns = array(
		array( 	'db' => 'id',     'dt' => 0, 'tbl_field' => 'id', 
			'formatter' => function( $d, $row ) {
			    $glib = new globalLibrary;
			    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
			     $edit = '<a href="f-hr-intern-profile.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view intern profile" style="width:16px;height:16px;" title="View Intern Profile"></a>';
  					
  					return $edit;
			}	
		),
	    array( 	'db' => 'student_name', 'dt' => 1, 'tbl_field' => 'student_name' ),
	    array( 	'db' => 'ic_no',  'dt' => 2, 'tbl_field' => 'ic_no' ),
	    array( 	'db' => 'department',  'dt' => 3, 'tbl_field' => 'department'),
	    array( 	'db' => 'date_start',  'dt' => 4, 'tbl_field' => 'date_start',
			'formatter' => function( $d, $row ) {
	            if ($d != '')
	            	return date( 'd/m/Y', strtotime($d));
	           	else
	           		return '';
	        }
	    ),
	    array( 	'db' => 'date_end',  'dt' => 5, 'tbl_field' => 'date_end',
			'formatter' => function( $d, $row ) {
	            if ($d != '')
	            	return date( 'd/m/Y', strtotime($d));
	           	else
	           		return '';
	        }
	    ),
	    array( 	'db' => 'id',     'dt' => 6, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				   	$edit = '<a href="f-hr-intern-profile.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view intern profile" style="width:16px;height:16px;" title="View Intern Profile"></a>';
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $order_by )
	);



?>