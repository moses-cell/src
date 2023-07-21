<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';
	
	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = '';

	$glib = new globalLibrary;


	if (!isset($_GET['id'])) {
		$primaryKey = 'id';

		$sql = "Select trainer_name, email, tel, internal_trainer, id  ";
		$table = "trainer_profile";
		$condition = array();


		$columns = array(
		    array( 'db' => 'id',     'dt' => 0, 'tbl_field' => 'id', 
					'formatter' => function( $d, $row ) {
					    $glib = new globalLibrary;
					    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
					    $schedule = '';    	
					    $edit = '<a href="f-hr-trainer-profile.php?id=' . $code .'">' .			  
	  							'<img src="assets/img/edit.png" alt="edit trainer profile" style="width:16px;height:16px;" title="Edit Trainer Profile"></a>';
	  					
	  					return $edit   ;
					}	
				),
		    array( 'db' => 'id', 'dt' => 1, 'tbl_field' => 'id' ),
		    array( 'db' => 'trainer_name', 'dt' => 2, 'tbl_field' => 'trainer_name' ),
		    array( 'db' => 'email',  'dt' => 3, 'tbl_field' => 'email' ),
		    array( 'db' => 'tel',   'dt' => 4, 'tbl_field' => 'tel' ),
		    array( 'db' => 'id',     'dt' => 5, 'tbl_field' => 'id', 
					'formatter' => function( $d, $row ) {
					    $glib = new globalLibrary;
					    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
					    $schedule = '';    	
					    $edit = '<a href="f-hr-trainer-profile.php?id=' . $code .'">' .			  
	  							'<img src="assets/img/edit.png" alt="edit trainer profile" style="width:16px;height:16px;" title="Edit Trainer Profile"></a>';
	  					
	  					return $edit   ;
					}	
				),
		);

	} else {
		
		$id = $glib->encrypt_decrypt('decrypt',$_GET['id'], 'id');

		if (isset($_GET['employment'])) {

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
	  						$delete = '<img src="assets/img/delete.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" title="Delete Trainer Employement" '. "onClick='delete_employment_record(\"" . $code .  "\")' />";
		  					
		  					return $edit .'&nbsp;'.$delete;
						}	
					),
			);

		} elseif (isset($_GET['academic'])) {

			$primaryKey = 'id';

			$sql = "Select *";
			$table = "trainer_academic";
			$condition = array("profile_id" => $id);


			$columns = array(
			    array( 	'db' => 'grad_year', 'dt' => 0, 'tbl_field' => 'grad_year' ),
			    array( 	'db' => 'qualification',  'dt' => 1, 'tbl_field' => 'qualification' ),
			    array( 	'db' => 'major',  'dt' => 2, 'tbl_field' => 'major' ),
			    array( 	'db' => 'institution',  'dt' => 3, 'tbl_field' => 'institution'),	    
			    array( 	'db' => 'id',     'dt' => 4, 'tbl_field' => 'id', 
						'formatter' => function( $d, $row ) {
						    $glib = new globalLibrary;
						    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
						    //$code = $d;
						    $id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
						    $id =   $glib->encrypt_decrypt('encrypt',$id, 'id');  	
						    $edit = '<a href="f-hr-trainer-profile.php?id=' . $id .  '&aca=' . $code .'#academic">'.
	  							'<img src="assets/img/edit.png" alt="edit trainer academic" style="width:16px;height:16px;" title="Edit Trainer Academic"></a>';
	  						$delete = '<img src="assets/img/delete.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" title="Delete Trainer Academic" '. "onClick='delete_academic_record(\"" . $code .  "\")' />";
		  					
		  					return $edit .'&nbsp;'.$delete;
						}	
					),
			);

	
		} elseif (isset($_GET['training'])) {

			$primaryKey = 'id';

			$sql = "Select *";
			$table = "trainer_training";
			$condition = array("profile_id" => $id);


			$columns = array(
			    array( 	'db' => 'training_year', 'dt' => 0, 'tbl_field' => 'training_year' ),
			    array( 	'db' => 'program',  'dt' => 1, 'tbl_field' => 'program' ),
			    array( 	'db' => 'organiser',  'dt' => 2, 'tbl_field' => 'organiser' ),	    
			    array( 	'db' => 'id',     'dt' => 3, 'tbl_field' => 'id', 
						'formatter' => function( $d, $row ) {
						    $glib = new globalLibrary;
						    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
						    //$code = $d;
						    $id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
						    $id =   $glib->encrypt_decrypt('encrypt',$id, 'id');  	
						    $edit = '<a href="f-hr-trainer-profile.php?id=' . $id .  '&training=' . $code .'#training">'.
	  							'<img src="assets/img/edit.png" alt="edit trainer academic" style="width:16px;height:16px;" title="Edit Trainer Training"></a>';
	  						$delete = '<img src="assets/img/delete.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" title="Delete Trainer Training" '. "onClick='delete_training_record(\"" . $code .  "\")' />";
		  					
		  					return $edit .'&nbsp;'.$delete;
						}	
					),
			);

	
		}
	} 

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>