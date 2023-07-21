<?php

	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(__FILE__) .'/b_session.php'
	require_once dirname(dirname(__FILE__)) .'/class/c_parameter.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_datatable.php';


	if(isset($_POST['process'])) { 
		
		if (session() == false)
			return;

		$param = new c_parameter("state");  //Set Table Name for list


		if ($_POST['process'] == 'save_state') {
			$_SESSION['id'] = $_POST['username'];
			
			if ($_POST['id'] != '') {
				$glib = new globalLibrary;
				$id = $glib->encrypt_decrypt('decrypt', $_POST['id'] , 'state');
				$_POST['id'] = $id;
			}

			$param->set_param("country_code", $_POST['country']);
			$param->set_param("state_code", $_POST['statecode']);

			$ret = $param->check_param();
			
			$param->set_param("state_name", $_POST['state']);
			$ret = $param->process_param($ret);

			if ( $ret == -1) {
				$form_data['errors'] = "State record exist.";	
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;
			} else {
				$form_data['success'] = true;
				echo json_encode($form_data);
				return;
			}

		} elseif ($_POST['process'] == 'get_state') {
			
			$glib = new globalLibrary;
			$id = $glib->encrypt_decrypt('decrypt',$_POST['id'], 'state');

			$data = $param->get_record_by_id($id);

			if (count($data) == 1 ) {
				$form_data['success'] = true;
				$form_data['data'] = $data; 
				//print_r($form_data);
				echo json_encode($form_data, JSON_HEX_APOS);
				return;
			} else {
				$form_data['success'] = false;
				$form_data['errors'] = "Error retrieving country record. Please contact your IT Administrator";
				echo json_encode($form_data);
				return;

			}

		} else {

			$button = '';
			$table = '';
			$sql = '';
			$condition = '';
			$primaryKey = 'user_name';

			$sql = "Select c.country_code, c.country_name, s.state_code, s.state_name, s.id ";
			$condition = array();
			$table = 'state s inner join country c on s.country_code = c.country_code';
			$primaryKey = 'c.country_code';


			$columns = array(
			    array( 'db' => 'country_code', 'dt' => 0, 'tbl_field' => 'c.country_code' ),
			    array( 'db' => 'country_name',  'dt' => 1, 'tbl_field' => 'c.country_name' ),
			    array( 'db' => 'state_code', 'dt' => 2, 'tbl_field' => 's.state_code' ),
			    array( 'db' => 'state_name',  'dt' => 3, 'tbl_field' => 's.state_name' ),
			    array( 
			    	'db' => 'id',     
			    	'dt' => 4, 
			    	'tbl_field' => 's.id',
			    	'formatter' => function( $d, $row ) {
			        	$glib = new globalLibrary;
			        	$id = $glib->encrypt_decrypt('encrypt', $d , 'state');
			        	return '<a href="f-state.php?id='.$id .'">View Data</a>';
			        } 
			    ),
			);

			$dt = new c_datatable();

			echo json_encode(
				$dt->simple( $_POST,  $table, $primaryKey, $columns, $sql, $condition, $button )
			);


		}

	} else {

		$doc_id = '';
		$readonly = '';

		if ($_SESSION['rolesAdmin'] != 'Yes') {
			$s->no_access();
		}
		
		if (isset($_GET['id'])) {
			$doc_id = $_GET['id'];
			$readonly = 'READONLY';
		}

		$pCountry = new c_parameter("Country");  //Set Table Name for list

		$sCountry = $pCountry->get_all_records(true);

		$setting = '';
	}
?>