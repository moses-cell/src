<?php

	//require 'bsession.php';
	

	require_once '../global.php';
	require_once '../class/ctraining-info.php';

	/*$s = new php_session();
	if ($s->is_expired() == false) {
		$form_data = [];
		$form_data['errors'] = "";
		$form_data['session'] = "expired";
		$form_data['success'] = false;
		echo json_encode($form_data);
		return;
	}*/

	//return;
	

	$cti = new ctraining_info;

	if ($cti->session() == false)
		return false;

	if ($cti->insert_training_info()) {

		$form_data['success'] = true;
		echo json_encode($form_data);


	} else {
		$form_data['errors'] = 'error';
		$form_data['success'] = false;
		echo json_encode($form_data);

	}



	return;
?>