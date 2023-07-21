<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';

	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
	
	$table = 'userlog';
	$primaryKey = 'id';


	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'id';

	$sql = "Select * ";
	$table = "training_setting";
	$condition = array();
	

	$columns = array(
	    array( 	'db' => 'setting_key', 'dt' => 0, 'tbl_field' => 'setting_key' ),
	    array( 	'db' => 'setting_value',  'dt' => 1, 'tbl_field' => 'setting_value' ),
	    array( 	'db' => 'description',  'dt' => 2, 'tbl_field' => 'description' 	),
	    array( 	'db' => 'id',     'dt' => 3, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
					$edit = "";
					$delete = "";

					if ($_SESSION['Admin'] == 'Yes') {

						$edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" '. "title='Edit Record' onClick='editDialog(\"f-adm-setting.php?id=" . $code .  "\")' />";
						
					}
							        	
				    
  					
  					return $edit . '&nbsp;';
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>