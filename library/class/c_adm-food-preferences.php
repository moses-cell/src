<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_adm-food-preferences.php';

	class c_adm_food_preferences extends ds_adm_food_preferences {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function _get_record($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_record($id);
			
			$this->process_complete();
			
			return $data;


		}

		
		public function _save_record () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->save_record();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		

	}




?>