<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-emp-roles.php';

	$glib = new globalLibrary();
	$c_emp = new c_adm_emp_roles();

	if (isset($_GET['id'])) {
		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$rec = $c_emp->get_record($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	} elseif(isset($_POST['validate_staff_no'])) { 
		$data = $c_emp->_get_staff_info_by_staff_no($_POST['staff_no']);
	//	echo 'ggg';
		if (count($data) >0) {

			if ($_SESSION['staff_no'] == $data[0]['staff_no'] ) {
				$form_data['errors'] = "You are not authorize to update your roles";	
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;
			}

			$form_data['name'] = $data[0]['staff_name'];
			$form_data['staff_no'] = $data[0]['staff_no'];
			$form_data['email'] = $data[0]['email'];
			//$form_data['roles'] = $data[0]['roles'];
			$form_data['success'] = true;

			//print_r($form_data);

			//echo $data[0]['staff_name'];
			$data = $c_emp->_get_record_by_username($data[0]['staff_no']);
			//print_r($data);
			if (count($data) > 0) {
				//echo $data[0]['roles'];
				if ($_SESSION['Admin'] == 'Yes') {
					if ($data[0]['roles'] == 'Admin') 
						$form_data['roles'] = $data[0]['roles'];
					elseif ($data[0]['roles'] == 'HR Admin') 
						$form_data['roles'] = $data[0]['roles'];
					else {
						//echo $data[0]['roles'];
						$form_data['errors'] = "The staff no had been register under different roles that you don't have access to overide.";	
						$form_data['success'] = false;
					}
				} elseif ($_SESSION['HR Admin'] == 'Yes') {
					if ($data[0]['roles'] == 'Admin') {
						$form_data['errors'] = "The staff no had been register under different roles that you don't have access to overide.";	
						$form_data['success'] = false;
					} 
				} 
			}

			//print_r($form_data);

			

		} else 	{
			$form_data['errors'] = "Staff No not found";	
			$form_data['success'] = false;
		}
		//print_r($form_data);
		echo json_encode($form_data);
		return;


		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);


	} else {
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>