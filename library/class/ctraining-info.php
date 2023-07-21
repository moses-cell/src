<?php


	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) .'/dataset/ds_training-info.php';
	require_once dirname(__FILE__) .'/csession.php';
	//session_start();

	class ctraining_info extends training_info {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function check_roles($roles_name) {
			$functionName = __FUNCTION__;

			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->check_role($roles_name);
			if ($data == 1) {
				return true;
			}
			else {
				return false;
			}

		}

		public function insert_training_info () {
			
			$functionName = __FUNCTION__;
			//echo 'cancel';
			//die();
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->insert_training();
			if ($data == 1) {
				return true;
			} else {
				return false;
			}

		}
	}

?>