<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-request.php';


	$glib = new globalLibrary();
	$hr_tm = new c_training_request();

	$form_button = '<div class="text-end mb-4">';
	$form_button .= '<button class="btn btn-prasarana btnclose" type="button" id="close">Close Document</button>';
	$form_button .= '<button class="btn btn-prasarana btnsave " type="button" id="save">Submit Training Request</button>';
    $form_button .= '</div>';

    $admin_button = "";
    $disable = "";
	if (isset($_GET['id'])) {

		$_SESSION['page_id'] = '';	
		if (isset($_GET['id']))
			$_SESSION['page_id'] = $_GET['id'];


		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');
		$rec = $hr_tm->_get_training_request($id);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);

		if ($_SESSION['HR Admin'] == 'Yes') {
			if (count($rec) > 0) {
				$admin_button = '<div class="text-start">';
				$admin_button .= '<button class="btn btn-prasarana" type="button" id="admin_close">Close Document</button>';
			    
			    if($rec[0]['status'] == 'Submit') {
			    	$admin_button .= '<button class="btn btn-prasarana" type="button" id="process">In Progress</button>';
			    	$admin_button .= '<button class="btn btn-prasarana" type="button" id="reject">Reject Training Request</button>';
			    } elseif($rec[0]['status'] == 'In Progress') {
			    	$admin_button .= '<button class="btn btn-prasarana" type="button" id="completed">Create Training Schedule</button>';
			    	$admin_button .= '<button class="btn btn-prasarana" type="button" id="reject">Reject Training Request</button>';
			    }
			    if($rec[0]['new_training_provider'] != '') {
			    	$admin_button .= '<button class="btn btn-provider" type="button" id="add_provider">Add New Training Provider</button>';
			    } 
			    $admin_button .= '</div>';
			} 
			$form_button = "";
	    } elseif ($_SESSION['Unit Secretary'] == 'Yes' ) {
			$form_button = '<div class="text-end mb-4">';
			$form_button .= '<button class="btn btn-prasarana btnclose" type="button" id="close">Close Document</button>';
		    $form_button .= '</div>';
		} else {
			$form_button = '<div class="text-end mb-4">';
			$form_button .= '<button class="btn btn-prasarana btnclose" type="button" id="close">Close Document</button>';
		    $form_button .= '</div>';
		}
		

	} else {
		$rec = array();

		$_SESSION['page_id'] = '';
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>