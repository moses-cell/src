<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_assessment.php';

	class c_trainer_assessment extends ds_assessment {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct('trainer_eval');
		}

		public function _get_trainer_assessment_by_id($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_trainer_assessment_by_id($id);
			
			$this->process_complete();
			
			return $data;


		}

		public function _submit_trainer_assessment() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->submit_trainer_assessment();
			
			if ($data > 0)	{
				
				$data = $this->update_training_application('trainer_eval');
				if ($data > 0)	{
					$this->process_complete();
					return true;
				} else {
					$this->rollback();
					$this->close_connection();
					return false;
				}
			} 

			$this->close_connection();
			return false;

		}


	}





?>