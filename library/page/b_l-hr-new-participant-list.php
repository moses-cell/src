<?php

	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_datatable.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_staff.php';
	
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
	$primaryKey = 'a.staff_no';

	$eval = '';
	$trainer = '';
	$super = '';

	if (isset($_GET['eval'])) {
		$eval = $_GET['eval'];
	} 
	if (isset($_GET['trainer'])) {
		$trainer = $_GET['trainer'];
	} 
	if (isset($_GET['super'])) {
		$super = $_GET['super'];
	} 

	$condition = array();

	if (isset($_GET['target'])) {
		if ($_GET['target'] != 'All Staff') {
			$condition = '';
			$target = explode(',',$_GET['target']);
			$delim = '';
			$val = '';
			$end_delim = '';
			for ($i=0; $i < count($target) ; $i++) { 
				$condition = $condition . $delim . " grade ='" . $target[$i]  . "'";
				$delim = " or ";

			}
			

		}
	}

	//print_r($condition);

	$sql = "Select a.staff_no, a.staff_name, a.position, a.personal_area, a.division, a.department, a.section, a.unit, a.grade, a.status, a.appr_name, a.super_name, ";
	//$sql.= "(Select b.staff_name from emp_info b where b.email = a.secretary_email) as sec_name, (Select c.staff_name from emp_info c where c.email = a.depoh_admin_email) as depoh_name ";
	$sql.= "b.staff_name as sec_name, c.staff_name as depoh_name ";

	$table = "emp_info a ";
	$table .= "left join emp_info b on (b.email = a.secretary_email and a.secretary_email != '') left join emp_info c on (c.email = a.depoh_admin_email and a.depoh_admin_email != '')";

	$sql = "Select a.staff_no, a.staff_name, a.position, a.personal_area, a.division, a.department, a.section, a.unit,a.grade, a.status, a.appr_name, a.super_name,  a.secretary_email as sec_name, a.depoh_admin_email as depoh_name";

	$table = "emp_info a "; 
	

	//print_r($_SESSION);

	//$glib = new globalLibrary();
	$c_staff = new c_staff();


	$staff_data = $c_staff->_get_staff_info($_SESSION['staff_no']);

    if ($_SESSION['HR Admin'] == 'Yes') {
		$condition = array();
    } elseif ($_SESSION['Unit Secretary'] == 'Yes') {
    	if (count($staff_data) <= 0) {
			$condition = ['a.secretary_email'=> 'not_authorize@prasarana.com.my'];
		} else {
  		    	$condition = "a.secretary_email = '" . $staff_data[0]['email']. "'";
    	}

	} elseif ($_SESSION['Rail Depoh Admin'] == 'Yes') {
    	if (count($staff_data) <= 0) {
			$condition = ['a.depoh_admin_email'=> 'not_authorize@prasarana.com.my'];
		} else {
  		    	$condition = "a.depoh_admin_email = '" . $staff_data[0]['email']. "'";
    	}
		
	} elseif ($_SESSION['Bus Depoh Admin'] == 'Yes') {
    	if (count($staff_data) <= 0) {
			$condition = ['a.depoh_admin_email'=> 'not_authorize@prasarana.com.my'];
		} else {
  		    	$condition = "a.depoh_admin_email = '" . $staff_data[0]['email']. "'";
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





	$columns = array(
		array( 	'db' => 'staff_no',     'dt' => 0, 'tbl_field' => 'a.staff_no', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');

				    $eval = '';
					$trainer = '';
					$super = '';

					if (isset($_GET['eval'])) {
						$eval = $_GET['eval'];
					} 
					if (isset($_GET['trainer'])) {
						$trainer = $_GET['trainer'];
					} 
					if (isset($_GET['super'])) {
						$super = $_GET['super'];
					} 
				        	
				    $update_profile = '<button class="btn btn-prasarana mb-4 mt-2 update_profile" type="button" super="'.$super .'" value="'. $code .'">Update Profile</button>&nbsp';

				    $add_participan = '<button class="btn btn-prasarana mb-4 mt-2 add_participant" type="button" id="add_participant_'.$d .'" value="'. $code .'">Add Staff</button>&nbsp';

  					if ($row['appr_name'] == '') {
  						$button = $update_profile;
  					} elseif ($row['sec_name'] == '') {
  						$button = $update_profile;
  					} elseif ($super == '1' && $row['super_name'] == '') {
  						$button = $update_profile; ;
  					} else {
	  					$button = $add_participan;
  					}
  					return $button;
				}	
			),
	    array( 	'db' => 'staff_no', 'dt' => 1, 'tbl_field' => 'a.staff_no' ),
	    array( 	'db' => 'staff_name',  'dt' => 2, 'tbl_field' => 'a.staff_name' ),
	    array( 	'db' => 'department',  'dt' => 3, 'tbl_field' => 'a.department'),
	    array( 	'db' => 'position',  'dt' => 4, 'tbl_field' => 'a.position'),
	    array( 	'db' => 'appr_name',  'dt' => 5, 'tbl_field' => 'a.appr_name'),
	    array( 	'db' => 'super_name',  'dt' => 6, 'tbl_field' => 'a.super_name'),
	    array( 	'db' => 'sec_name',  'dt' => 7, 'tbl_field' => 'a.secretary_email'),
	    array( 	'db' => 'depoh_name',  'dt' => 8, 'tbl_field' => 'a.depoh_admin_email'),
	    /*array( 	'db' => 'sec_name',  'dt' => 7, 'tbl_field' => 'b.staff_name'),
	    array( 	'db' => 'depoh_name',  'dt' => 8, 'tbl_field' => 'c.staff_name'),*/
	    array( 	'db' => 'staff_no',     'dt' => 9, 'tbl_field' => 'a.staff_no', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $eval = '';
					$trainer = '';
					$super = '';

					if (isset($_GET['eval'])) {
						$eval = $_GET['eval'];
					} 
					if (isset($_GET['trainer'])) {
						$trainer = $_GET['trainer'];
					} 
					if (isset($_GET['super'])) {
						$super = $_GET['super'];
					} 
				        	
				    $update_profile = '<button class="btn btn-prasarana mb-4 mt-2 update_profile" type="button" super="'.$super .'" value="'. $code .'">Update Profile</button>&nbsp';

				    $add_participan = '<button class="btn btn-prasarana mb-4 mt-2 add_participant" type="button" id="add_participant_'.$d .'" value="'. $code .'">Add Staff</button>&nbsp';

  					if ($row['appr_name'] == '') {
  						$button = $update_profile;
  					} elseif ($row['sec_name'] == '') {
  						$button = $update_profile;
  					} elseif ($super == '1' && $row['super_name'] == '') {
  						$button = $update_profile; 
  					} else {
	  					$button = $add_participan;
  					}
  					return $button;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button,false )
	);



?>