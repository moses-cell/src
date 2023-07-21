<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';

	if (strpos($_SERVER['PHP_SELF'], 'l-p-training-location.php') !== false) {
		$button = '';	
		//print_r($_SESSION);
		//die();
		if ($_SESSION['HR Admin'] == 'Yes' || $_SESSION['Admin'] == 'Yes') {
			$button = '<button class="btn btn-prasarana" type="button" id="newlocation">New Public Training Location</button>';
			$button .= '<button class="btn btn-prasarana" type="button" id="excel">Export to Excel</button>';
		}

		return;
	}
	


	$glib = new globalLibrary;
	$public_loc = $glib->encrypt_decrypt('encrypt','0', 'id');


	if (isset($_GET['prov_id']))  {

		$id = $glib->encrypt_decrypt('decrypt',$_GET['prov_id'], 'id');

		$button = '';
		$table = '';
		$sql = '';
		$condition = '';
		$primaryKey = 'id';

		$sql = "Select *";
		//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
		$table = "training_location";
		$condition = array("training_provider_id" => $id);


		$columns = array(
		    array( 	'db' => 'main_location', 'dt' => 0, 'tbl_field' => 'main_location' ),
		    array( 	'db' => 'sub_location',  'dt' => 1, 'tbl_field' => 'sub_location' ),
		    array( 	'db' => 'details',  'dt' => 2, 'tbl_field' => 'details' ),
		    array( 	'db' => 'status',  'dt' => 3, 'tbl_field' => 'status',
		    		'formatter' => function ($d, $row) {
		    			if ($d == '1')
		    				return 'Enable';
		    			else
		    				return 'Disable';
		    		} 
		    	),
		    array( 	'db' => 'id',     'dt' => 4, 'tbl_field' => 'id', 
					'formatter' => function( $d, $row ) {
					    $glib = new globalLibrary;
					    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
					    //$code = $d;
					    $id = $glib->encrypt_decrypt('decrypt', $_GET['prov_id'], 'id');
					    $id =   $glib->encrypt_decrypt('encrypt',$id, 'id');  	

						$edit = '<a href="f-adm-training-location.php?id=' . $code ."&prov_id=" . $id . '">' .	  
  						'<img src="assets/img/edit.png" alt="edit training location" style="width:16px;height:16px;" title="Edit Training Location"></a>';

					    //$edit = '<img src="assets/img/edit.png" alt="edit" title="Edit Training Provider" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='f-adm-training-location.php?id=" . $code .  "&prov_id=" . $id ."' />";
					    
	  					
	  					return $edit;
					}	
				),
		);

		$dt = new c_datatable();

		echo json_encode(
			$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
		);

	} else {

		$button = '';
		$table = '';
		$sql = '';
		$condition = '';
		$primaryKey = 'tl.id';

		$sql = "Select tl.*, tp.provider_name ";
		//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
		$table = "training_location tl left join training_provider tp on tl.training_provider_id = tp.id";
		$condition = array();


		$columns = array(
			array( 	'db' => 'training_provider_id',  'dt' => 0, 'tbl_field' => 'tl.training_provider_id' ),
		    array( 	'db' => 'provider_name', 'dt' => 1, 'tbl_field' => 'tp.provider_name',
		    		'formatter' => function ($d, $row) {
		    			if ($d == '')
		    				return 'Public';
		    			else
		    				return $d ;
		    		} 
		    	),
		    array( 	'db' => 'id', 'dt' => 2, 'tbl_field' => 'tl.id',),
		    array( 	'db' => 'main_location', 'dt' => 3, 'tbl_field' => 'tl.main_location',),
		    array( 	'db' => 'sub_location',  'dt' => 4, 'tbl_field' => 'tl.sub_location' ),
		    array( 	'db' => 'details',  'dt' => 5, 'tbl_field' => 'tl.details' ),
		    array( 	'db' => 'status',  'dt' => 6, 'tbl_field' => 'tl.status',
		    		'formatter' => function ($d, $row) {
		    			if ($d == '1')
		    				return 'Enable';
		    			else
		    				return 'Disable';
		    		} 
		    	),
		    array( 	'db' => 'id',     'dt' => 7, 'tbl_field' => 'tl.id', 
					'formatter' => function( $d, $row ) {
					    $glib = new globalLibrary;
					    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
					    //$code = $d;
					    //$id = $glib->encrypt_decrypt('encrypt', $row['training_provider_id'], 'id');
					    $id =   $glib->encrypt_decrypt('encrypt',$row['training_provider_id'], 'id'); 
					    //$id = $row['training_provider_id']; 	
					    $edit = '<img src="assets/img/edit.png" alt="edit" title="Edit Training Location" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='editDialog(\"f-adm-training-location.php?id=" . $code .  "&prov_id=" . $id ."\")' />";
					    
	  					
	  					if ($_SESSION['HR Admin'] == 'Yes' || $_SESSION['Admin'] == 'Yes') {
  							return $edit . '&nbsp;&nbsp;';
	  					}
	  					else 
	  						return ''; 
					}	
				),
		);

		$dt = new c_datatable();
		
		echo json_encode(
			$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
		);


	}



?>