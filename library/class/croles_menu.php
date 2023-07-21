<?php

	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) .'/dataset/ds_roles_menu.php';
	require_once dirname(__FILE__) .'/csession.php';
	//session_start();

	class croles_menu extends roles_menu {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function check_roles($roles_name) {
			$functionName = __FUNCTION__;

			$this->roles_param = [
					'user_name' => $_SESSION['id'],
					'obj_class' => $this->className,
					'obj_function' => $functionName,
					'obj_line' => __LINE__
				];

			$data = $this->check_role($roles_name);
			if (count($data) == 1) {
				$this->commit();
				return true;
			}
			else {
				/*$param = [
					'user_name' => $_SESSION['id'],
					'obj_process' => 'select',
					'obj_datetime' => date('Y-m-d H:i:s'),
					'obj_class' => $this->className,
					'obj_function' => $functionName,
					'obj_sql' => $this->get_sql(),
					'obj_parameter' => print_r($this->get_param(), true)
				];
				
				$data = $this->update_log($param);

				if ($data == 1)
					return $this->commit();
				else
					$this->rollback();
				*/
				$this->commit();
				return false;
			}

		}

		public function register_roles_menu ($roles_name, $menu_name) {
			
			$functionName = __FUNCTION__;
			//echo 'cancel';
			//die();
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			/*$this->log_param = [
					'user_name' => $_SESSION['id'],
					'obj_class' => $this->className,
					'obj_function' => $functionName,
					'obj_line' => __LINE__
			];*/

			$data = $this->insert_role_menu($roles_name);

			if ($data == 1) {
				return true;
			} else {
				return false;
			}		
		}
	}

?>