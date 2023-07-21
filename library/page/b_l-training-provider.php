<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';

	if (strpos($_SERVER['PHP_SELF'], 'l-p-training-provider.php') !== false) {
		
		$button = '';	
		//print_r($_SESSION);
		//die();
		if ($_SESSION['HR Admin'] == 'Yes' || $_SESSION['Admin'] == 'Yes') {
			$button = '<button class="btn btn-prasarana" type="button" id="new">New Training Provider</button>';
			//$button .= '<button class="btn btn-prasarana" type="button" id="newlocation">New Public Training Location</button>';
			$button .= '<button class="btn btn-prasarana" type="button" id="excel">Export to Excel</button>';
		}

		return;
	}

	

	$table = 'userlog';
	$primaryKey = 'id';

	//$glib = new globalLibrary;
	//$year = $glib->encrypt_decrypt('decrypt',$_GET['y'], 'year');

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'id';

	$sql = "Select *";
	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "training_provider";
	$condition = array();


	$columns = array(
		array( 	'db' => 'id', 'dt' => 0, 'tbl_field' => 'id',),
	    array( 	'db' => 'provider_name', 'dt' => 1, 'tbl_field' => 'provider_name',),
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
				        	
				    $edit = '<img src="assets/img/edit.png" alt="edit" title="Edit Training Provider" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='editDialog(\"f-adm-training-provider.php?id=" . $code .  "\")' />";
				    $location = '<img src="assets/img/location.png" alt="edit" title="View Provider Location" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='editDialogLocation(\"f-adm-training-location.php?prov_id=" . $code .  "\")' />";
  					if ($_SESSION['HR Admin'] == 'Yes' || $_SESSION['Admin'] == 'Yes') {
  						return $edit . '&nbsp;&nbsp;' . $location;
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



?>