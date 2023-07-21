<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(__FILE__) . '/shared/b_global_parameter.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-training-provider.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-training-location.php';


	$glib = new globalLibrary();
	$gparam = new b_global_parameter();
	$prov_training = new c_adm_training_provider();
	$prov = new c_adm_training_location();

	
	$_SESSION['page_id'] = "";	
	$_SESSION['provider_id'] = "";

	if (isset($_GET['prov_id'])) {

		//echo '1x';
		$training_provider = ' - Public Location';
		$_SESSION['provider_id'] = $_GET['prov_id'];
		$id = $glib->encrypt_decrypt('decrypt', $_GET['prov_id'], 'id');
		if ($id <> '0') {
			$rec = $prov_training->_get_record($id);
			$training_provider  = " - " . $rec[0]['provider_name'];			
		} 

		//echo '2x';
		$main_location = $gparam->select_option_training_main_location_by_provider_id($id);
		//print_r($main_location);
		//echo  $_GET['id'];
		if (isset($_GET['id'])) {
			$_SESSION['page_id'] = $_GET['id'];
			$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
			$rec = $prov->_get_record($id);
		} else {
			$rec = array();
		}
		
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);


	} else {

		$training_provider = ' - Public Location';
		$id = $glib->encrypt_decrypt('encrypt', '0', 'id');

		header('location:'. 'f-adm-training-location.php?prov_id='.$id);
		/*$_SESSION['page_id'] = '';
		$_SESSION['provider_id'] = $id;
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);*/
	}



?>