<?php
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/class/b_session.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_parameter.php';
	require_once dirname(dirname(__FILE__)). '/class/c_datatable.php';


	if(isset($_POST['process'])) { 
		
		if (session() == false)
			return;

		$param = new c_parameter("country");


		if ($_POST['process'] == 'save_country') {
			$_SESSION['id'] = $_POST['username'];
			
			if ($_POST['id'] != '') {
				$glib = new globalLibrary;
				$id = $glib->encrypt_decrypt('decrypt', $_POST['id'] , 'country');
				$_POST['id'] = $id;
			}

			$ret = $param->update_country();
			if ( $ret == -1) {
				$form_data['errors'] = "Country record exist.";	
				$form_data['success'] = false;
				echo json_encode($form_data);
				return;
			} else {
				$form_data['success'] = true;
				echo json_encode($form_data);
				return;
			}

		} elseif ($_POST['process'] == 'get_country') {
			
			$glib = new globalLibrary;
			$id = $glib->encrypt_decrypt('decrypt',$_POST['id'], 'country');

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

			$sql = "Select country_code, country_name, id ";
			$condition = array();
			$table = 'country';
			$primaryKey = 'country_code';


			$columns = array(
			    array( 'db' => 'country_code', 'dt' => 0, 'tbl_field' => 'country_code' ),
			    array( 'db' => 'country_name',  'dt' => 1, 'tbl_field' => 'country_name' ),
			    array( 
			    	'db' => 'id',     
			    	'dt' => 2, 
			    	'tbl_field' => 'id',
			    	'formatter' => function( $d, $row ) {
			        	$glib = new globalLibrary;
			        	$id = $glib->encrypt_decrypt('encrypt', $d , 'country');
			        	return '<a href="f-country.php?id='.$id .'">View Data</a>';
			        } 
			    ),
			);

			$dt = new c_datatable();

			echo json_encode(
				$dt->simple( $_POST,  $table, $primaryKey, $columns, $sql, $condition, $button )
			);


		}

	} else {

		//print_r($_SESSION['role']);
		//die();
		$doc_id = '';
		$readonly = '';

		if ($_SESSION['rolesAdmin'] != 'Yes') {
			$s->no_access();
		}
		
		if (isset($_GET['id'])) {
			$doc_id = $_GET['id'];
			$readonly = 'READONLY';
		}

		$setting = '';
	}
?>