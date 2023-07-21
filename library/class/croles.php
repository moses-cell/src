<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) .'/dataset/ds_roles.php';
	require_once dirname(__FILE__) .'/csession.php';
	//session_start();

	class croles extends roles {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function check_roles($roles_name) {
			$functionName = __FUNCTION__;

			$this->set_log_param($this->className,$functionName, __LINE__);
/*			$this->log_param = [
					'user_name' => $_SESSION['id'],
					'obj_class' => $this->className,
					'obj_function' => $functionName,
					'obj_line' => __LINE__
				];*/

			$data = $this->check_role($roles_name);
			if ($data == 1) {
				return true;
			}
			else {
				return false;
			}

		}

		public function register_roles ($roles_name) {
			
			$functionName = __FUNCTION__;
			//echo 'cancel';
			//die();
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
/*			$this->log_param = [
					'user_name' => $_SESSION['id'],
					'obj_class' => $this->className,
					'obj_function' => $functionName,
					'obj_line' => __LINE__
			];*/

			$data = $this->insert_role($roles_name);
			if ($data == 1) {
				return true;
			} else {
				return false;
			}

		}
	}

?>