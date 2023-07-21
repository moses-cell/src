<?php
die('sjjj');
	require_once dirname(dirname(__FILE__)) .'/class/c_session.php';

	
	function session() {
		$s = new php_session();
		if ($s->is_expired() == false) {
			$form_data = [];
			$form_data['errors'] = "Your session had expired";
			$form_data['session'] = "expired";
			$form_data['success'] = false;
			echo json_encode($form_data);
			return false;
		}
		return true;
	}

?>