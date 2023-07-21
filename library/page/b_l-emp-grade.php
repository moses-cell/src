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
	$primaryKey = 'grade';

	$sql = "Select grade, description, status";
	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "emp_grade";
	$condition = array();


	$columns = array(
	    array( 	'db' => 'grade', 'dt' => 0, 'tbl_field' => 'grade' ),
	    array( 	'db' => 'description',  'dt' => 1, 'tbl_field' => 'description' ),
	    array( 	'db' => 'status',  'dt' => 2, 'tbl_field' => 'status',
	    		'formatter' => function ($d, $row) {
	    			if ($d == '1')
	    				return 'Enable';
	    			else
	    				return 'Disable';
	    		} 
	    	),
	    array( 	'db' => 'grade',     'dt' => 3, 'tbl_field' => 'grade', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='editDialog(\"f-adm-emp-grade.php?id=" . $code .  "\")' />";
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>