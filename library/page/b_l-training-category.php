<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';

	if (strpos($_SERVER['PHP_SELF'], 'l-p-training-category.php') !== false) {
		
		$button = '';	
		//print_r($_SESSION);
		//die();
		if ($_SESSION['HR Admin'] == 'Yes' || $_SESSION['Admin'] == 'Yes') {
			$button = '<button class="btn btn-prasarana" type="button" id="new">New Training Category</button>';
			$button .= '<button class="btn btn-prasarana" type="button" id="excel">Export to Excel</button>';
			//$button .= '<button class="btn btn-prasarana" type="button" id="pdf">Export to PDF</button>';
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
	$table = "training_category";
	$condition = array();


	$columns = array(
	    array( 	'db' => 'id', 'dt' => 0, 'tbl_field' => 'id'),
	    array( 	'db' => 'category',  'dt' => 1, 'tbl_field' => 'category' ),
	    array( 	'db' => 'status',  'dt' => 2, 'tbl_field' => 'status',
	    		'formatter' => function ($d, $row) {
	    			if ($d == '1')
	    				return 'Enable';
	    			else
	    				return 'Disable';
	    		} 
	    	),
	    array( 	'db' => 'id',     'dt' => 3, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<img src="assets/img/edit.png" alt="edit" title="Edit Training Category" class="editdialog" style="cursor:pointer; width:24px;height:24px;" '. "onClick='editDialog(\"f-adm-training-category.php?id=" . $code .  "\")' />";
				    
  					if ($_SESSION['HR Admin'] == 'Yes' || $_SESSION['Admin'] == 'Yes') {
  						return $edit; 
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