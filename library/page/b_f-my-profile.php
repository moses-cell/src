<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_staff.php';


	$glib = new globalLibrary();
	$c_staff = new c_staff();
	$button_register = '';

	$id = $_SESSION['staff_no'];

		
	$_SESSION['page_id'] = $glib->encrypt_decrypt('encrypt', $id, 'id');
		
	$rec = $c_staff->_get_staff_info($id);
	$result = ['Data'=>$rec];

	$data = json_encode($result,JSON_HEX_APOS);



	

?>