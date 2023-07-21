<?php 
	require_once dirname(__FILE__)."/library/global.php";
	
	session_start();
    session_destroy();
	
	header('location:'.FORCE_LOGIN);	

?>


