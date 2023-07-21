<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_adm-setting.php';

	class c_adm_setting extends ds_adm_setting {

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

		public function _get_record_by_key($key) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_record_by_key($key);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_email_setting() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_email_setting();
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_external_participant_setting() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_external_participant_setting();
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_external_trainer_setting() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_external_trainer_setting();
			
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

		public function _delete_record ($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->delete_record($id);
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _get_staff_info_by_email ($email) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_staff_info_by_email ($email);

			$this->close_connection();
			return $data;

		}

	}




?>