<?php
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_data_upload.php';
	require_once dirname(dirname(dirname(dirname(__FILE__))))	.'/vendor/autoload.php';


	$glib = new globalLibrary();

	set_time_limit(0);
	//echo ini_get('max_execution_time'); //after your
	//die(); 

	ini_set('memory_limit', -1);
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$_SESSION['full_name'] = $_POST['editor_name'];
	$bol_upload = false;
	$folder_process = '';
	if (isset($_POST['form_process'])) {
		if ($_POST['form_process'] == 'Staff Profile' ) {
			$folder_process = 'staff_profile/';	
			$bol_upload = true;
		} elseif ($_POST['form_process'] == 'Training Module' ) {
			$folder_process = 'training_module/';	
			$bol_upload = true;
		} elseif ($_POST['form_process'] == 'Training Schedule' ) {
			$folder_process = 'training_schedule/';	
			$bol_upload = true;
		}
	}

	if ($bol_upload) {

		$path = dirname(dirname(dirname(dirname(__FILE__)))) . '/uploads/';
		$fname = $_FILES['fileupload']['name'];
		if ($fname != '') {
			
			$folder = $path;
		
			if (is_dir($folder) == false) {
		    	mkdir($folder, 0777, true);
			} 
		
			$folder_template = $folder . $folder_process;
			if (is_dir($folder_template) == false) {
		    	mkdir($folder_template, 0777, true);
			} 
					
			$targetPath = $folder_template . $_FILES['fileupload']['name'];
			move_uploaded_file($_FILES['fileupload']['tmp_name'], $targetPath);


			$Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
   	        $xlSheet = $Reader->load($targetPath);
	        $xl = $xlSheet->getActiveSheet();

    	    $xlSheet = $xl->toArray();
    	    
    	    $lrow = count($xlSheet);
    	    $lastColumn = $xl->getHighestColumn();


    	    $row_num = 0;
    	    foreach($xl->getRowIterator() as $row) {
			    $cellIterator = $row->getCellIterator();
			    $cellIterator->setIterateOnlyExistingCells(false);

			    if ($row_num == 0) {
			    	$c_upload = new c_data_upload($_POST['form_process'],$cellIterator);
			    	
			    	if ($c_upload->get_match_status() == false) {
			    		$form_data['success'] = false;
			    		$form_data['errors'] = "Please use the provided template from this system and keep the first row as it is";	
			    		echo json_encode($form_data);
						return;
			    	}
			    } elseif ($row_num > 1) {
			    	if ($c_upload->_save_record($cellIterator) == false) {
			    		$form_data['success'] = false;

			    		if ($c_upload->rows == -1) {
			    			$form_data['errors'] = "Unable to upload record for row " . $row_num +1 . ' - Course Code Not found in Training Module';
			    		} else {
			    			$form_data['errors'] = "Unable to upload record row " . $row_num +1;

			    		}	
			    		echo json_encode($form_data);
						return;
			    	}
			    }
			   
            	$row_num++;         
			}

    	   $form_data['success'] = true;
				    	
		}

		echo json_encode($form_data);
		return;
	}


?>