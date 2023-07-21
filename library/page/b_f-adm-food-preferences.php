<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(__FILE__) . '/shared/b_global_parameter.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-food-preferences.php';


	$glib = new globalLibrary();
	$c_emp = new c_adm_food_preferences();
	$_SESSION['page_id'] = '';	
	
	if (isset($_GET['id'])) {

		
		if (isset($_GET['id']))
			$_SESSION['page_id'] = $_GET['id'];

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$rec = $c_emp->get_record($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	} else {
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>