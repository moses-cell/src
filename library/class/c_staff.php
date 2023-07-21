<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_staff.php';
	require_once dirname(dirname(__FILE__)) . '/global.php';

	date_default_timezone_set("Asia/Kuala_Lumpur");

	class c_staff extends ds_staff {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function _get_staff_info($staff_no) {
			
			$functionName = __FUNCTION__;
			
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
				
			$data = $this->get_staff_info($staff_no);
			//print_r($data);
			$this->process_complete();
			return $data;

		}

		public function _save_record() {
			
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

		public function _trainer_update_staff_info() {
			
			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->trainer_update_staff_info();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;


		}

		

		

	}

?>