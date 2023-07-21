<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_dashboard.php';

	class c_dashboard extends ds_dashboard {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function _get_yearly_training_schedule($year) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);	
			$data = $this->get_yearly_training_schedule($year);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_training_schedule($date_start, $date_end) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);	
			$data = $this->get_training_schedule($date_start, $date_end);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_my_training_register($date_start, $date_end, $staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_my_training_register($date_start, $date_end, $staff_no);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_monthly_training_register($date_start, $date_end) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_monthly_training_register($date_start, $date_end);
			
			$this->process_complete();
			
			return $data;

		}
		
		public function _get_yearly_training_register($year) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_yearly_training_register($year);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_my_internal_training_register($date_start, $date_end, $staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_my_internal_training_register($date_start, $date_end, $staff_no);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_internal_training_register($date_start, $date_end) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_internal_training_register($date_start, $date_end);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_my_external_training_register($date_start, $date_end, $staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_my_external_training_register($date_start, $date_end, $staff_no);
			
			$this->process_complete();
			
			return $data;

		}

		public function _get_external_training_register($date_start, $date_end) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_external_training_register($date_start, $date_end);
			
			$this->process_complete();
			
			return $data;

		}

		public function _get_my_incoming_training($date_start, $date_end, $staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_my_incoming_training($date_start, $date_end, $staff_no);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_incoming_schedule($date_start, $date_end) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_incoming_schedule($date_start, $date_end);
			
			$this->process_complete();
			
			return $data;


		}


		public function _get_my_training_report($year, $staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_my_training_report($year, $staff_no);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_all_training_report($year) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_all_training_report($year);
			
			$this->process_complete();
			
			return $data;


		}
	}
?>