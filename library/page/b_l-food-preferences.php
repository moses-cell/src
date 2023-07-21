<?php

	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(dirname(__FILE__)) .'/page/shared/b_session.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_datatable.php';
	
	$table = '';
	$primaryKey = '';

	//$glib = new globalLibrary;
	//$year = $glib->encrypt_decrypt('decrypt',$_GET['y'], 'year');

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'id';

	$sql = "Select *";
	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "food_preferences";
	$condition = array();


	$columns = array(
	    array( 	'db' => 'id', 'dt' => 0, 'tbl_field' => 'id' ),
	    array( 	'db' => 'meal_type',  'dt' => 1, 'tbl_field' => 'meal_type' ),
	    array( 	'db' => 'description',  'dt' => 2, 'tbl_field' => 'description'),
	    array( 	'db' => 'id',     'dt' => 3, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='editDialog(\"f-adm-food-preferences.php?id=" . $code .  "\")' />";
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>