<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_session.php';

	date_default_timezone_set("Asia/Kuala_Lumpur");


	class php_session extends session {
		
		public function __construct() {
			parent::__construct();
			$this->className = __CLASS__;
			if (session_status() == PHP_SESSION_NONE) {
        		session_start();
    		}
		}

		public function is_valid() {
			
			$functionName = __FUNCTION__;

			if (!isset($_SESSION['pg'])){
				$this->redirect();		

			} else {

				$glib = new globalLibrary();
				$id = $glib->encrypt_decrypt('decrypt',$_SESSION['pg'],'id');
				
				$this->set_log_param($this->className,$functionName, __LINE__);
				//$data = $this->check_valid_user($id);

				if ($this->check_valid_user($id) != 1) {
					$this->redirect();
				}
			}
		}
		
		public function check_session() {
			if(!isset($_SESSION['id'])) {
				$this->redirect();
			}			
		}
		
		public function is_expired() {
			$exp_time = intval($_SESSION['expired']);
		
			if (time() < $exp_time) {
				$_SESSION['expired'] = time() + 1800;
				
				return true;
			} else {
				return false;				
			}			
		}
		
		public function get_roles() {

			$rows = $this->check_user_roles($_SESSION['staff_no']);

			$_SESSION['HR Admin'] = 'No';
			$_SESSION['Admin'] = 'No';
			$_SESSION['Unit Secretary'] = 'No';
			$_SESSION['Rail Depoh Admin'] = 'No';
			$_SESSION['Bus Depoh Admin'] = 'No';

			//print_r($rows);
			foreach ($rows as $row) {
				$_SESSION[$row['roles']] = 'Yes';
			}

			if ($_SESSION['HR Admin'] == 'Yes') {
				$_SESSION['roles'] = '(HR Admin)';
			} elseif ($_SESSION['Admin'] == 'Yes') {
				$_SESSION['roles'] = '(System Admin)';
			} elseif ($_SESSION['Unit Secretary'] == 'Yes') {
				$_SESSION['roles'] = '(Unit Secretary/Administrator)';
			} elseif ($_SESSION['Rail Depoh Admin'] == 'Yes') {
				$_SESSION['roles'] = '(Rail Admin)';
			} elseif ($_SESSION['Bus Depoh Admin'] == 'Yes') {
				$_SESSION['roles'] = '(Bus Admin)';
			} else {
				$_SESSION['roles'] = '';
			}

			//print_r($_SESSION);
		}

		public function redirect() {
			header('location:'.FORCE_LOGIN);	
		}

		public function no_access() {
			header('location:'.NO_ACCESS);	
		}
		
	}


?>