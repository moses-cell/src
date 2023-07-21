<?php

	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_staff.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_datatable.php';
	

	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    if (strpos($_SERVER['PHP_SELF'], 'l-my-staff-unit.php') !== false) {

    	$button = '<button class="btn btn-prasarana" type="button" id="add">Add Staff To My Unit</button>';
    	return;
    } else if (strpos($_SERVER['PHP_SELF'], 'l-my-staff-depoh.php') !== false) {

    	$button = '<button class="btn btn-prasarana" type="button" id="add">Add Staff To My Depoh</button>';
    	return;
    }
   

	$table = 'userlog';
	$primaryKey = 'id';


	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'a.staff_no';

	$sql = "Select a.staff_no, a.staff_name, a.position, a.personal_area, a.division, a.department, a.section, a.unit,a.grade, a.status, a.appr_name, a.super_name, ";
	$sql.= "b.staff_name as sec_name, c.staff_name as depoh_name ";

	$table = "emp_info a ";
	$table .= "left join emp_info b on (b.email = a.secretary_email and b.email != '') left join emp_info c on (c.email = a.depoh_admin_email and c.email != '')";


	$sql = "Select a.staff_no, a.staff_name, a.position, a.personal_area, a.division, a.department, a.section, a.unit,a.grade, a.status, a.appr_name, a.super_name,  a.secretary_email as sec_name, a.depoh_admin_email as depoh_name";

	$table = "emp_info a "; 
	

	//print_r($_SESSION);
	if (str_contains(strtoupper($_SERVER['HTTP_REFERER']), strtoupper('l-my-staff-approver.php'))) {
		$condition = ['a.appr_no'=> $_SESSION['staff_no']];
	} elseif (str_contains(strtoupper($_SERVER['HTTP_REFERER']), strtoupper('l-my-staff-supervisor.php'))) {
		$condition = ['a.super_no'=> $_SESSION['staff_no']];
	} elseif (str_contains(strtoupper($_SERVER['HTTP_REFERER']), strtoupper('l-my-staff-unit.php'))) {

			$staff =  new c_staff();
			$staff_data = $staff->_get_staff_info($_SESSION['staff_no']);
			if (count($staff_data) <= 0) {
				$condition = ['a.secretary_email'=> 'not_authorize@prasarana.com.my'];
			} else {
				$condition = ['a.secretary_email'=> $staff_data[0]['email']];
			}


			
	} elseif (str_contains(strtoupper($_SERVER['HTTP_REFERER']), strtoupper('l-my-staff-depoh.php'))) {

			$staff =  new c_staff();
			$staff_data = $staff->_get_staff_info($_SESSION['staff_no']);
			if (count($staff_data) <= 0) {
				$condition = ['a.depoh_admin_email'=> 'not_authorize@prasarana.com.my'];
			} else {
				$condition = ['a.depoh_admin_email'=> $staff_data[0]['email']];
			}


			
	} else {
		$result =  [
		    'draw' => 1,
		    'recordsTotal' => 0,
		    'recordsFiltered' => 0,
		    'data' => array(),
		];
		echo json_encode ($result);
		return;
	}

	//echo $sql;
	//print_r( $condition);

	$columns = array(
		array( 	'db' => 'staff_no',     'dt' => 0, 'tbl_field' => 'a.staff_no', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" '. "onClick='editDialog(\"f-hr-staff-profile.php?id=" . $code .  "\")' />";
				    $edit = '<a href="f-my-staff-profile.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit staff profile" style="width:16px;height:16px;" title="Edit Staff Profile"></a>';
  					
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
	    /*array( 	'db' => 'sec_name',  'dt' => 12, 'tbl_field' => 'b.staff_name'),
	    array( 	'db' => 'depoh_name',  'dt' => 13, 'tbl_field' => 'c.staff_name'),*/
	    array( 	'db' => 'sec_name',  'dt' => 12, 'tbl_field' => 'a.secretary_email'),
	    array( 	'db' => 'depoh_name',  'dt' => 13, 'tbl_field' => 'a.depoh_admin_email'),
	    array( 	'db' => 'status',     'dt' => 14, 'tbl_field' => 'a.status'),
	    array( 	'db' => 'staff_no',     'dt' => 15, 'tbl_field' => 'a.staff_no', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<img src="assets/img/edit.png" alt="edit" class="editdialog" style="cursor:pointer; width:16px;height:16px;" '. "onClick='editDialog(\"f-hr-staff-profile.php?id=" . $code .  "\")' />";
				    $edit = '<a href="f-my-staff-profile.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit staff profile" style="width:16px;height:16px;" title="Edit Staff Profile"></a>';
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, '', false )
	);



?>