<?php

    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";

	
    if (isset($_SESSION)) {
    	if ($_SESSION['user_type'] == 'internal') {

    		if (isset($_SERVER['HTTP_REFERER']))
    			$page = $_SERVER['HTTP_REFERER'];
    		else {
	   			include 'not-authorize.php';
	   			return;
    		}
    			//header('location:not-authorize.php');

    		if (strpos($page, 'f-upload-staff-profile.php') !== false) {
    			header('location:template/staff_details_template.xlsx');
    		}

    		if (strpos($page, 'f-upload-training-module.php') !== false) {
    			header('location:template/training_module_template.xlsx');
    		}

    		if (strpos($page, 'f-upload-training-schedule.php') !== false) {
    			header('location:template/training_schedule_template.xlsx');
    		}



    		return;
    	}
    	else {
    		header('location:l-my-task.php');
    		return;
    	}
    }

	

	header('location:login.php');

?>