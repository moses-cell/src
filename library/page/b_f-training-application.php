<?php
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)). '/class/c_staff.php';
	require_once dirname(dirname(__FILE__)). '/class/c_adm-setting.php';

	$form_button = '';
	$super_no = '';
	$appr_no = '';
	$secretary_email = '';
	$depoh_admin_email = '';
	$staff_no = '';
	$setting = 0;

	if (isset($_GET['sch'])) { //To apply schedule training application

		$hr_tm = new c_training_application();
		$c_staff = new c_staff();

		$id = $glib->encrypt_decrypt('decrypt', $_GET['sch'], 'id');
		$staff_data = $c_staff->_get_staff_info($_SESSION['staff_no']);
		
		$staff_no = $glib->encrypt_decrypt('encrypt', $_SESSION['staff_no'], 'id');

		//echo $id;

		$_SESSION['page_id'] = '';
		$_SESSION['sch_id'] = $_GET['sch'];
		$rec = $hr_tm->_get_training_schedule($id);
		//print_r($rec);
		$result = ['Data'=>$rec];

		$data = json_encode($result,JSON_HEX_APOS);

		$form_button = '';

		$form_button = '<div class="text-start mb-4">';
		$form_button .= '<button class="btn btn-prasarana" type="button" id="close">Close Document</button>';
		$form_button .= '<button class="btn btn-prasarana" type="button" id="save">Apply Training</button>';
	    $form_button .= '</div>';

		// <button class="btn btn-prasarana" type="button" id="close">Close Document</button>
        //<button class="btn btn-prasarana" type="button" id='save'>Apply Training</button>



		if (count($rec) > 0) {
			$row = $rec[0];
			$sdt = strtotime($row['date_start']);
			$today = strtotime(date('Y-m-d'));

			if ($today >= $sdt ) {
				$form_button = '';	
			}
		}

		if (count($staff_data) > 0) {
			$row = $staff_data[0];
			$super_no = $row['super_no'];
			$appr_no = $row['appr_no'];
			$secretary_email = $row['secretary_email'];
			$depoh_admin_email = $row['depoh_admin_email'];
			
		}

		$c_setting = new c_adm_setting();
		$setting_data = $c_setting->_get_record_by_key('internal_min_request_day');
		
		if (count($setting_data) > 0)
			$setting = $setting_data[0]['setting_value'];


		if (is_numeric($setting) == false)
			$setting = 0;

	} else {
		$rec = array();
		$result = ['Data'=>$rec];
		$data = json_encode($result,JSON_HEX_APOS);
	}



?>