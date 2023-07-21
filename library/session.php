<?php

	require_once dirname(__FILE__)."/class/c_session.php";
	
	$s = new php_session();
	
	$path = $_SERVER['REQUEST_URI'];

	$s->is_valid();
	if ($s->is_expired() == false) {
		if (stripos($_SERVER['REQUEST_URI'], '/page/b_'))
			return false;
		else
			$s->redirect();
	}

		
	$s->check_session();	
	$s->get_roles();
	$glib = new globalLibrary();

	
	function check_user_access($user_roles) {
		
		$roles = explode (', ', $user_roles);

		foreach ($roles as $role) {

			if ($_SESSION[$role] == 'Yes')
				return true;
		}

		return false;
	}
	
	
	
?>