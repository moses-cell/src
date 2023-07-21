<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_intern.php';


	$glib = new globalLibrary();
	$c_emp = new c_intern();


	if (isset($_GET['id'])) {

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$_SESSION['page_id'] = $_GET['id'];
		$rec = $c_emp->_get_record($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	} else {
		$_SESSION['page_id'] = '';
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>