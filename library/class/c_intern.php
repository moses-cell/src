<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_intern.php';

	class c_intern extends ds_intern {

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

		public function _get_record_check_duplicate($ic, $sdate, $edate) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_record_check_duplicate($ic, $sdate, $edate);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_record_internship_period($ic, $sdate, $edate) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_record_internship_period($ic, $sdate, $edate);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_record_intern_allowance_for_month($intern_id, $month, $year) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_record_intern_allowance_for_month($intern_id, $month, $year);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_record_intern_allowance_details($intern_id) {
			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_record_intern_allowance_details($intern_id);
			
			$this->process_complete();
			
			return $data;

		}

		public function _get_allowance($id) {
			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_allowance($id);
			
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

		public function _save_allowance () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->save_allowance();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

	}




?>