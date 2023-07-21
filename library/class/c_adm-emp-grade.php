<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_adm-emp-grade.php';

	class c_adm_emp_grade extends ds_adm_emp_grade {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function get_record($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_record_info($id);
			
			$this->process_complete();
			
			return $data;


		}

		

		public function save_record () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->insert_record();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

	}




?>