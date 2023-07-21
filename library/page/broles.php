<?php

	//require 'bsession.php';
	
	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/croles.php';
	require_once dirname(dirname(__FILE__)) .'/class/croles_menu.php';


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
	$roles = $_POST['rolesname'];

	$croles = new croles;
	$croles_menu = new croles_menu;

	if ($croles->session() == false)
		return false;

	if ($croles->check_roles($roles)) {



	} else {
		echo 'register_roles';
    	if ($croles->register_roles($roles)) {
			foreach($_POST as $key => $val) {
				if ($key != 'rolesname') {

			    }
			    //echo $key . '-->' . $val;

			}    		
    	}
	}


	$form_data['errors'] = $roles;
	$form_data['success'] = false;
	echo json_encode($form_data);

	return;
?>