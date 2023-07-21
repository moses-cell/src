<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';

	if (isset($_POST['form_process'])) {

		$_SESSION['year'] = $_POST['year'];
		$_SESSION['division'] = $_POST['division'];

		if (isset($_SESSION['department']))
			unset($_SESSION['department']);

		if (isset($_SESSION['section']))
			unset($_SESSION['section']);

		if (isset($_SESSION['unit']))
			unset($_SESSION['unit']);

		if (isset($_SESSION['trainingcategory']))
			unset($_SESSION['trainingcategory']);

		if (isset($_SESSION['position']))
			unset($_SESSION['position_tna']);

		if (isset($_SESSION['position']))
			unset($_SESSION['position_array']);



		if (isset($_POST['department']))
			$_SESSION['department'] = $_POST['department'];

		if (isset($_POST['section']))
			$_SESSION['section'] = $_POST['section'];

		if (isset($_POST['unit']))
			$_SESSION['unit'] = $_POST['unit'];

		if (isset($_POST['trainingcategory']))
			$_SESSION['trainingcategory'] = $_POST['trainingcategory'];

		if (isset($_POST['position']))
			$_SESSION['position_tna'] = implode(",",$_POST['position']);

		if (isset($_POST['position']))
			$_SESSION['position_array'] = $_POST['position'];


		$form_data['success'] = true;		
		echo json_encode($form_data,JSON_HEX_APOS);


	} else {

		$form_data['success'] = false;		
		echo json_encode($form_data,JSON_HEX_APOS);

	}
	return;


?>