<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_login.php';
	require_once dirname(dirname(__FILE__)) . '/global.php';

	date_default_timezone_set("Asia/Kuala_Lumpur");

	class c_login extends ds_login {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function _login ($username, $password) {
			
			$this->db_connect();
			$functionName = __FUNCTION__;
				
			$_SESSION['full_name'] = $username;
			$this->set_log_param($this->className,$functionName, __LINE__);
				

			
			$data = $this->login($username, $password);
			$this->process_complete();

			return $data;
			
		}


		public function _change_password($staff_no, $password) {

			$this->db_connect();
			$functionName = __FUNCTION__;
			$this->set_log_param($this->className,$functionName, __LINE__);

			$row = $this->change_password($staff_no, $password);
			$this->process_complete();
			return $row;

		}

		public function _is_trainer($staff_no) {
			
			$this->db_connect();
			$functionName = __FUNCTION__;
			$this->set_log_param($this->className,$functionName, __LINE__);
				
			$data = $this->is_trainer($staff_no);
			$this->process_complete();
			return $data;

		}

		public function _register_user_staff($staff_no, $password, $staff_name) {

			$this->db_connect();
			$functionName = __FUNCTION__;
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->register_user_staff($staff_no, $password, $staff_name);
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _register_user_external($username, $password, $fullname) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->register_user_external($username, $password, $fullname);
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _update_trainer_login($username, $trainer_id) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->update_trainer_login($username, $trainer_id);
			

			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _reset_password($username, $password) {

			$this->db_connect();
			$functionName = __FUNCTION__;
			$this->set_log_param($this->className,$functionName, __LINE__);

			$row = $this->reset_password($username, $password);
			$this->process_complete();
			return $row;

		}

		public function _check_user_exist($username) {

			$this->db_connect();
			$functionName = __FUNCTION__;
			$this->set_log_param($this->className,$functionName, __LINE__);
				
			$data = $this->check_user_exist($username);
			//echo count($data);
			$this->process_complete();
			
			return $data;
		}

	}

?>