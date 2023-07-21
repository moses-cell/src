<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_hr-training-module.php';

	class c_hr_training_module extends ds_hr_training_module {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function _get_training_module($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_module($id);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_duplicate_training_module($course_code) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_duplicate_training_module($course_code);
			
			$this->process_complete();
			
			return $data;


		}

		public function _save_training_module () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->save_training_module();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _update_filename() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->update_filename();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

	}




?>