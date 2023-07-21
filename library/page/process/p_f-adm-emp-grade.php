<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_adm-emp-grade.php';


	$glib = new globalLibrary();


	$_SESSION['full_name'] = $_POST['editor_name'];

	if ($_POST['form_process'] == 'Save' || $_POST['form_process'] ==  'Submit') {


		$c_emp = new c_adm_emp_grade();

		$_POST['id'] = '';
		if (isset($_POST['pageid'])) {
			if ($_POST['pageid'] != '') {
				$id = $glib->encrypt_decrypt('decrypt', $_POST['pageid'], 'id');
				$_POST['id'] = $id;
			} 

		}

		//echo $id;
		$data = $c_emp->get_record_info($_POST['grade']);
		if (count($data) > 0) {
			if ($_POST['pageid'] == '') {
			
				$form_data['errors'] = "The Employee Grade record already exist";	
				$form_data['success'] = false;				
			
			} elseif ($_POST['id'] != $data[0]['id']) {

					$form_data['errors'] = "The Employee Grade record already exist";	
					$form_data['success'] = false;		

			} else {
			
				if ($c_emp->save_record()) {
					$form_data['success'] = true;
				} else {
					$form_data['errors'] = "There is an error while saving Employee Grade";	
					$form_data['success'] = false;
				}		
			}
		}
		else {
			if ($c_emp->save_record()) {
				
				$form_data['success'] = true;

			} else {
				$form_data['errors'] = "There is an error while saving Employee Grade";	
				$form_data['success'] = false;

			}			
		}
		echo json_encode($form_data);
		return;
	}


?>