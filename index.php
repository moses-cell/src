<?php
	
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";

	
    if (isset($_SESSION)) {
    	if ($_SESSION['user_type'] == 'internal') {
    		header('location:dashboard.php');
    		return;
    	}
    	else {
    		header('location:l-my-task.php');
    		return;
    	}
    }

	

	header('location:login.php');

?>