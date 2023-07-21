<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_training-request.php';

	class c_training_request extends ds_training_request {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function _get_training_request($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_request($id);
			
			$this->process_complete();
			
			return $data;


		}

		public function _save_training_request ($staff) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->save_training_request($staff);
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _training_request_in_progress () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->training_request_in_progress();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _training_request_reject () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->training_request_reject();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _training_request_complete ($request_id,$sch_id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->training_request_complete($request_id,$sch_id);
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