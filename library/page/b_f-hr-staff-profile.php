<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_staff.php';
	require_once dirname(__FILE__). '/b_global_parameter.php';


	$glib = new globalLibrary();
	$c_staff = new c_staff();
	$button_register = '';
	$trainingid = '';

	if (isset($_GET['id'])) {
		
		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$_SESSION['page_id'] = $_GET['id'];
		
		$rec = $c_staff->_get_staff_info($id);
		$result = ['Data'=>$rec];

		if (isset($_GET['pageid'])) {
			$button_register = '<button class="btn btn-prasarana" type="button" id="register">Register Staff</button>';
			$trainingid = $_GET['pageid'];
		}

		$data = json_encode($result,JSON_HEX_APOS);


	}  else {
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);

	}

	

?>