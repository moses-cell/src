<?php

	require_once '../global.php';
	require_once SITE_PATH .'/library/class/c_datatable.php';
	


	$glib = new globalLibrary;

	if (isset($_GET['id']))  {

		$id = $glib->encrypt_decrypt('decrypt',$_GET['id'], 'id');

		$button = '';
		$table = '';
		$sql = '';
		$condition = '';
		$primaryKey = 'id';

		$sql = "Select *";
		$table = "trainer_employment";
		$condition = array("profile_id" => $id);


		$columns = array(
		    array( 	'db' => 'syear', 'dt' => 0, 'tbl_field' => 'syear' ),
		    array( 	'db' => 'eyear',  'dt' => 1, 'tbl_field' => 'eyear' ),
		    array( 	'db' => 'designation',  'dt' => 2, 'tbl_field' => 'designation' ),
		    array( 	'db' => 'department',  'dt' => 3, 'tbl_field' => 'department'),
		    array( 	'db' => 'job_description',  'dt' => 4, 'tbl_field' => 'job_description'),		    
		    array( 	'db' => 'id',     'dt' => 5, 'tbl_field' => 'id', 
					'formatter' => function( $d, $row ) {
					    $glib = new globalLibrary;
					    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
					    //$code = $d;
					    $id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
					    $id =   $glib->encrypt_decrypt('encrypt',$id, 'id');  	
					    $edit = '<a href="f-hr-trainer-profile.php?id=' . $id .  '&emp=' . $code .'#working">'.
  							'<img src="assets/img/edit.png" alt="edit trainer employment" style="width:16px;height:16px;" title="Edit Trainer Employement"></a>';
  						$delete = '<img src="assets/img/delete.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" title="Delete Trainer Employement" '. "onClick='deleterecord(\"" . $code .  "\")' />";
	  					
	  					return $edit .'&nbsp;'.$delete;
					}	
				),
		);

		$dt = new c_datatable();

		echo json_encode(
			$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
		);

	} 


?>