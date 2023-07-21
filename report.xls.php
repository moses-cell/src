<?php

    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
	include dirname(__FILE__)."/library/page/report/b_download.xls.php";
	//include dirname(__FILE__)."/library/page/report/b_rpt_intern_monthly_allowance.xls.php";
	//include dirname(__FILE__)."/library/page/report/b_rpt_tna.xls.php";


	ini_set('memory_limit', -1);
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Asia/Kuala_Lumpur');

    if (isset($_SESSION)) {
    	if ($_SESSION['user_type'] == 'internal') {

    		if (isset($_SERVER['HTTP_REFERER']))
    			$page = $_SERVER['HTTP_REFERER'];
    		else {
	   			include 'not-authorize.php';
	   			return;
    		}
    			//header('location:not-authorize.php');

    		if (strpos($page, 'l-p-training-category.php') !== false) {
    			$rpt = new xlsDownload('training_category');
    		} elseif (strpos($page, 'l-p-training-provider.php') !== false) {
    			$rpt = new xlsDownload('training_provider');
    		} elseif (strpos($page, 'l-p-training-location.php') !== false) {
    			$rpt = new xlsDownload('training_location');
    		} elseif (strpos($page, 'l-p-food-preferences.php') !== false) {
    			$rpt = new xlsDownload('food_preferences');
    		} elseif (strpos($page, 'l-p-emp-grade.php') !== false) {
    			$rpt = new xlsDownload('emp_grade');
    		} elseif (strpos($page, 'l-adm-staff-roles.php') !== false) {
    			$rpt = new xlsDownload('emp_roles');
    		} elseif (strpos($page, 'l-hr-training-module.php') !== false) {
    			$rpt = new xlsDownload('training_module');
    		} elseif (strpos($page, 'l-hr-training-module-enable.php') !== false) {
    			$rpt = new xlsDownload('training_module', '1');
    		} elseif (strpos($page, 'l-hr-training-module-disable.php') !== false) {
    			$rpt = new xlsDownload('training_module', '0');
    		} elseif (strpos($page, 'l-hr-staff-profile.php') !== false) {
    			$rpt = new xlsDownload('staff_profile');
    		} elseif (strpos($page, 'l-hr-training-calendar.php') !== false) {
    			$rpt = new xlsDownload('hr_training_calendar');
    		} elseif (strpos($page, 'l-hr-training.php') !== false) {
    			$rpt = new xlsDownload('training_schedule');
    		} elseif (strpos($page, 'l-hr-training-completed.php') !== false) {
    			$rpt = new xlsDownload('training_schedule_complete');
    		} elseif (strpos($page, 'l-hr-training-cancel.php') !== false) {
    			$rpt = new xlsDownload('training_schedule_cancel');
    		} elseif (strpos($page, 'l-hr-bonding.php') !== false) {
    			$rpt = new xlsDownload('staff_bonding');
    		} elseif (strpos($page, 'l-db-rpt-year-schedule.php') !== false) {
    			$rpt = new xlsDownload('training_schedule');
    		} elseif (strpos($page, 'l-db-rpt-month-schedule.php') !== false) {
    			$rpt = new xlsDownload('training_schedule');    			
    		} elseif (strpos($page, 'l-db-rpt-year-participant.php') !== false) {
    			$rpt = new xlsDownload('training_application_all_staff');
    		} elseif (strpos($page, 'l-db-rpt-month-participant.php') !== false) {
    			$rpt = new xlsDownload('training_application_all_staff');
    		} elseif (strpos($page, 'l-db-rpt-internal-participant.php') !== false) {
    			$rpt = new xlsDownload('training_application_internal_participant');
    		} elseif (strpos($page, 'l-db-rpt-external-participant.php') !== false) {
    			$rpt = new xlsDownload('training_application_external_participant');
    		} elseif (strpos($page, 'l-active-dept.php') !== false) {
    			$rpt = new xlsDownload('training_application_active_dept');
    		} elseif (strpos($page, 'l-active-name.php') !== false) {
    			$rpt = new xlsDownload('training_application_active_name');
    		} elseif (strpos($page, 'l-active-external.php') !== false) {
    			$rpt = new xlsDownload('training_application_active_external');
    		} elseif (strpos($page, 'l-inactive-completed.php') !== false) {
    			$rpt = new xlsDownload('training_application_inactive_completed');
    		} elseif (strpos($page, 'l-inactive-cancel.php') !== false) {
    			$rpt = new xlsDownload('training_application_inactive_cancel');
    		} elseif (strpos($page, 'l-inactive-reject.php') !== false) {
    			$rpt = new xlsDownload('training_application_inactive_reject');
    		} elseif (strpos($page, 'l-inactive-external.php') !== false) {
    			$rpt = new xlsDownload('training_application_inactive_external');
    		} elseif (strpos($page, 'f-report-intern-allowance.php') !== false) {

				include dirname(__FILE__)."/library/page/report/b_rpt_intern_monthly_allowance.xls.php";
    			$param = array();
    			$url = $_SERVER['QUERY_STRING'];
				parse_str($url, $param);
				
    			$rpt = new xlsReport_Intern_Monthly_Allowance('intern-monthly_report', $param);

    		} elseif (strpos($page, 'training-analysis.php') !== false) {
	
				include dirname(__FILE__)."/library/page/report/b_rpt_tna.xls.php";
    			$param = array();
				$rpt = new xlsReport_Training_Analysis('tna_report', $param);

    		} elseif (strpos($page, 'f-trainer-training-schedule.php') !== false) {
 
				include dirname(__FILE__)."/library/page/report/b_rpt_training_attendance.xls.php";
				$param = array();
    			$rpt = new xlsReport_Training_Attendance('training_participant', $param);

    		} elseif (strpos($page, 'f-hr-training-schedule.php') !== false) {
 
				include dirname(__FILE__)."/library/page/report/b_rpt_training_attendance.xls.php";
				$param = array();
    			$rpt = new xlsReport_Training_Attendance('training_participant', $param);

    		} elseif (strpos($page, 'f-trainer-training-schedule.php') !== false) {
 
				include dirname(__FILE__)."/library/page/report/b_rpt_training_attendance.xls.php";
				$param = array();
    			$rpt = new xlsReport_Training_Attendance('training_participant', $param);

    		} elseif (strpos($page, 'l-trainer-complete-assessment.php') !== false) {
 
				include dirname(__FILE__)."/library/page/report/b_rpt_trainer_assessment.xls.php";
				$param = array();
    			$rpt = new xlsReport_Trainer_Assessment('trainer_assessment', $param);

    		} elseif (strpos($page, 'l-completed-trainer-assessment.php') !== false) {
 
				include dirname(__FILE__)."/library/page/report/b_rpt_trainer_assessment.xls.php";
				$param = array();
    			$rpt = new xlsReport_Trainer_Assessment('trainer_assessment', $param);

    		} elseif (strpos($page, 'l-completed-trainer-assessment.php') !== false) {
 
				include dirname(__FILE__)."/library/page/report/b_rpt_trainer_assessment.xls.php";
				$param = array();
    			$rpt = new xlsReport_Trainer_Assessment('trainer_assessment', $param);

    		} elseif (strpos($page, 'l-completed-evaluation.php') !== false) {
 
				include dirname(__FILE__)."/library/page/report/b_rpt_training_evaluation.xls.php";
				$param = array();
    			$rpt = new xlsReport_Training_Evaluation('training_evaluation', $param);

    		} elseif (strpos($page, 'l-completed-supervisor-assessment.php') !== false) {
 
				include dirname(__FILE__)."/library/page/report/b_rpt_supervisor_assessment.xls.php";
				$param = array();
    			$rpt = new xlsReport_Training_Evaluation('supervisor_assessment', $param);

    		} else {
	    		include 'not-authorize.php';
	   			return;
	    	}

	    	$rpt->generate_report();
    		return;
    	}
    	else {
    		
    		if ($_SESSION['trainer'] == 'y') {
    			if (isset($_SERVER['HTTP_REFERER']))
	    			$page = $_SERVER['HTTP_REFERER'];
	    		else {
		   			include 'not-authorize.php';
		   			return;
	    		}
	    		
    			if (strpos($page, 'f-trainer-training-schedule.php') !== false) {

 					include dirname(__FILE__)."/library/page/report/b_rpt_training_attendance.xls.php";
					$param = array();
	    			$rpt = new xlsReport_Training_Attendance('training_participant', $param);
	    			$rpt->generate_report();
    				return;
	    		} else {
		    		include 'not-authorize.php';
		   			return;
		    	}
    		} else {
	    		header('location:l-my-task.php');
    			return;

    		}

    	}
    }

	

	header('location:login.php');

?>