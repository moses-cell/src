<?php 

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_external_participant.php';
	require_once dirname(dirname(__FILE__)) . '/global.php';

	date_default_timezone_set("Asia/Kuala_Lumpur");

	class c_external_participant extends ds_external_participant {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function _get_external_participant($email) {
			
			$functionName = __FUNCTION__;
			
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
				
			$data = $this->get_external_participant($email);
			$this->process_complete();
			return $data;

		}

		public function _register_external_participant() {
			
			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->register_external_participant();
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;



		}

		public function _update_external_participant() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->update_external_participant();
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _get_external_trainer_schedule($trainer_id, $start, $end) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_external_trainer_schedule($trainer_id, $start, $end);
			
			if (count($data) > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;


		}

		public function _get_external_participant_schedule($email, $start, $end) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_external_participant_schedule($email, $start, $end);
			
			if (count($data) > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;


		}
		

	}


?>