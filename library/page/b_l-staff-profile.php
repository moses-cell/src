<?php

	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_datatable.php';
	
	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (strpos($_SERVER['PHP_SELF'], 'l-hr-staff-profile.php') !== false) {

    	$button = '<button class="btn btn-prasarana" type="button" id="import">Upload Staff Profile</button><button class="btn btn-prasarana" type="button" id="excel">Export to Excel</button>';

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
	$primaryKey = 'a.staff_no';

	/*$sql = "Select a.staff_no, a.staff_name, a.position, a.personal_area, a.division, a.department, a.section, a.unit,a.grade, a.status, a.appr_name, a.super_name, ";
	$sql.= "b.staff_name as sec_name, c.staff_name as depoh_name ";*/

	$sql = "Select a.staff_no, a.staff_name, a.position, a.personal_area, a.division, a.department, a.section, a.unit,a.grade, a.status, a.appr_name, a.super_name,  a.secretary_email as sec_name, a.depoh_admin_email as depoh_name";

	$table = "emp_info a "; 
	/*$table = "emp_info a ";
	$table .= "left join emp_info b on (b.email = a.secretary_email and a.secretary_email != '') left join emp_info c on (c.email = a.depoh_admin_email and a.depoh_admin_email != '')";*/
	$condition = array();


	$columns = array(
		array( 	'db' => 'staff_no',     'dt' => 0, 'tbl_field' => 'a.staff_no', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" '. "onClick='editDialog(\"f-hr-staff-profile.php?id=" . $code .  "\")' />";
				    $edit = '<a href="f-hr-staff-profile.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit training module" style="width:16px;height:16px;" title="Edit Training Module"></a>';
  					
  					return $edit;
				}	
			),
	    array( 	'db' => 'staff_no', 'dt' => 1, 'tbl_field' => 'a.staff_no' ),
	    array( 	'db' => 'staff_name',  'dt' => 2, 'tbl_field' => 'a.staff_name' ),
	    array( 	'db' => 'position',  'dt' => 3, 'tbl_field' => 'a.position'),
	    array( 	'db' => 'personal_area',  'dt' => 4, 'tbl_field' => 'a.personal_area'),
	    array( 	'db' => 'division',  'dt' => 5, 'tbl_field' => 'a.division'),
	    array( 	'db' => 'department',  'dt' => 6, 'tbl_field' => 'a.department'),
	    array( 	'db' => 'section',  'dt' => 7, 'tbl_field' => 'a.section'),
	    array( 	'db' => 'unit',  'dt' => 8, 'tbl_field' => 'a.unit'),
		array( 	'db' => 'grade',     'dt' => 9, 'tbl_field' => 'a.grade'), 
		array( 	'db' => 'appr_name',  'dt' => 10, 'tbl_field' => 'a.appr_name'),
	    array( 	'db' => 'super_name',  'dt' => 11, 'tbl_field' => 'a.super_name'),
	    array( 	'db' => 'sec_name',  'dt' => 12, 'tbl_field' => 'a.secretary_email'),
	    array( 	'db' => 'depoh_name',  'dt' => 13, 'tbl_field' => 'a.depoh_admin_email'),
	    /*array( 	'db' => 'sec_name',  'dt' => 12, 'tbl_field' => 'b.staff_name'),
	    array( 	'db' => 'depoh_name',  'dt' => 13, 'tbl_field' => 'c.staff_name'),*/
	    array( 	'db' => 'status',     'dt' => 14, 'tbl_field' => 'a.status'),
	    array( 	'db' => 'staff_no',     'dt' => 15, 'tbl_field' => 'a.staff_no', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" '. "onClick='editDialog(\"f-hr-staff-profile.php?id=" . $code .  "\")' />";
				    $edit = '<a href="f-hr-staff-profile.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit training module" style="width:16px;height:16px;" title="Edit Training Module"></a>';
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, '', false )
	);



?>