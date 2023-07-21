<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(__FILE__) . '/shared/b_global_parameter.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-training-category.php';


	$glib = new globalLibrary();
	$prov = new c_adm_training_category();

	//$param = new b_global_parameter();
	//$training_provider = $param->select_option_training_provider();
	

	if (isset($_GET['id'])) {

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$_SESSION['page_id'] = $_GET['id'];
		$rec = $prov->_get_record($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	} else {
		$_SESSION['page_id'] = '';
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>