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
	$primaryKey = 'ia.id';

	$sql = "select ia.*, ip.student_name, ip.ic_no, ip.department  ";
	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "intern_allowance ia inner join intern_info ip  on ia.intern_id = ip.id";
	$condition = array();
	$order_by = "ia.year desc, ia.month desc ";

	$columns = array(
		array( 	'db' => 'id',     'dt' => 0, 'tbl_field' => 'ia.id', 
			'formatter' => function( $d, $row ) {
			    $glib = new globalLibrary;
			    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
			     $edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='editDialog(\"f-hr-intern-allowance.php?id=" . $code .  "\")' />";
  					
  					return $edit;
			}	
		),
	    array( 	'db' => 'student_name', 'dt' => 1, 'tbl_field' => 'student_name' ),
	    array( 	'db' => 'ic_no',  'dt' => 2, 'tbl_field' => 'ic_no' ),
	    array( 	'db' => 'department',  'dt' => 3, 'tbl_field' => 'department'),
	    array( 	'db' => 'month',  'dt' => 4, 'tbl_field' => 'ia.month'),
	    array( 	'db' => 'year',  'dt' => 5, 'tbl_field' => 'ia.year'),
	    array( 	'db' => 'working_day',  'dt' => 6, 'tbl_field' => 'ia.working_day'),
	    array( 	'db' => 'attendance',  'dt' => 7, 'tbl_field' => 'ia.attendance'),
	    array( 	'db' => 'allowance',  'dt' => 8, 'tbl_field' => 'ia.allowance'),
	    array( 	'db' => 'id',     'dt' => 9, 'tbl_field' => 'ia.id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				   	$edit = '<a href="f-hr-intern-profile.php?id=' . $code .'">' .			  
  					$edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='editDialog(\"f-hr-intern-allowance.php?id=" . $code .  "\")' />";
  					
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $order_by )
	);



?>