<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';

	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
	
	$table = 'userlog';
	$primaryKey = 'id';

	//$glib = new globalLibrary;
	//$year = $glib->encrypt_decrypt('decrypt',$_GET['y'], 'year');

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'ur.user_name';

	$sql = "Select ur.*, ei.staff_name";
	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "user_roles ur inner join emp_info ei on ei.staff_no = ur.user_name";
	$condition = array();
	/* ($_SESSION['Admin'] == 'Yes') {
		$condition = ['ur.roles' => 'Admin', 
			'or ur.roles' => 'HR Admin',
		];

	} elseif ($_SESSION['HR Admin'] == 'Yes') {
		$condition = [
			"ur.roles" => "in ('HR Admin', 'Unit Secretary', 'Rail Depoh Admin', 'Bus Depoh Admin')", 
			
		];

	}*/
	

	$columns = array(
	    array( 	'db' => 'user_name', 'dt' => 0, 'tbl_field' => 'ur.user_name' ),
	    array( 	'db' => 'staff_name',  'dt' => 1, 'tbl_field' => 'ei.staff_name' ),
	    array( 	'db' => 'roles',  'dt' => 2, 'tbl_field' => 'ur.roles' 	),
	    array( 	'db' => 'id',     'dt' => 3, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
					$edit = "";
					$delete = "";

					if ($_SESSION['staff_no'] != $row['user_name']) {
						if ($_SESSION['Admin'] == 'Yes') {
								if ($row['roles'] == 'Admin' || $row['roles'] == 'HR Admin') {
									$edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" '. "title='Edit Record' onClick='editDialog(\"f-adm-emp-roles.php?id=" . $code .  "\")' />";
									$delete = '<img src="assets/img/delete.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" title="Delete Record" '. "onClick='deleterecord(\"" . $code .  "\")' />";
								}
							} elseif ($_SESSION['HR Admin'] == 'Yes') {

								if (($row['roles'] == 'Unit Secretary') || ($row['roles'] == 'HR Admin') || ($row['roles'] == 'Rail Depoh Admin') || ($row['roles'] == 'Bus Depoh Admin')) {
									$edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" '. "title='Edit Record' onClick='editDialog(\"f-adm-emp-roles.php?id=" . $code .  "\")' />";
									$delete = '<img src="assets/img/delete.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" title="Delete Record" '. "onClick='deleterecord(\"" . $code .  "\")' />";
								}
							}	
					}
							        	
				    
  					
  					return $edit . '&nbsp;' . $delete;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>