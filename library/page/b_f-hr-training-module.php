<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_hr-training-module.php';


	$glib = new globalLibrary();
	$hr_tm = new c_hr_training_module();


	if (isset($_GET['id'])) {

		$_SESSION['page_id'] = '';	
		if (isset($_GET['id']))
			$_SESSION['page_id'] = $_GET['id'];


		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$rec = $hr_tm->_get_training_module($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	} else {
		$rec = array();

		$_SESSION['page_id'] = '';
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>