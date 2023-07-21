<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_hr-training-schedule.php';

	class c_hr_training_schedule extends ds_hr_training_schedule {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function get_training_schedule($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->training_schedule_info($id);
			
			$this->process_complete();
			
			return $data;


		}

		

		public function _save_training_schedule () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->save_training_schedule();
			//echo $data;
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _cancel_training_schedule () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->cancel_training_schedule();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _update_participant_training_date() {
			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->update_participant_training_date();
			if ($data >= 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _hr_cancel_participant($bol_TrainingCancel = false) {
			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->hr_cancel_participant($bol_TrainingCancel);
			if ($data >= 0)	{
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