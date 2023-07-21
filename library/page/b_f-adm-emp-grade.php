<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(__FILE__) . '/shared/b_global_parameter.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-emp-grade.php';


	$glib = new globalLibrary();
	$c_emp = new c_adm_emp_grade();

	$param = new b_global_parameter();
	$training_provider = $param->select_option_training_provider();
	
	$_SESSION['page_id'] = '';

	if (isset($_GET['id'])) {

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$rec = $c_emp->get_record($id);
		$result = ['Data'=>$rec];

		if (count($rec) > 0) {
			$data = $rec[0];
			$_SESSION['page_id'] = $glib->encrypt_decrypt('encrypt',$data['id'],'id');	
		}
		
		$data = json_encode($result,JSON_HEX_APOS);


	} else {
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>