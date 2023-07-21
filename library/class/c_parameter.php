<?php

	//require_once $_SERVER['DOCUMENT_ROOT'].'/mp/library/dataset/ds_mpstaff.php';

	require_once dirname(dirname(__FILE__)) .'/dataset/ds_parameter.php';

	class c_parameter extends ds_parameter {

		private $className;
		
		public function __construct($table_name) {
			$this->className = __CLASS__;	
			parent::__construct($table_name);
		}


		public function get_record_by_id($id) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_record_info($id);
			$this->process_complete();
			
			return $data;
		}

		public function get_all_records($b_select = false) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_record_info();
			$this->process_complete();
			

			if ($b_select) {
				$select = '';
				if ($this->get_tablename() == 'Country') {
					foreach($data as $row){
						$select .= "<option value='".$row['country_code']."'>".$row['country_name']."</option>";
					}
				}
				return $select;
			}
			return $data;

		}

		public function update_country() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);			
			$result = $this->check_country_exist();
			
			if ($result == -1) {
				return -1;
			} elseif ($result == 0) {
				$data = $this->insert_new_country();
				$this->process_complete();
				if ($data == 1) {
					return 1;
				} else 
					return 0;
			} else {//($result == 1) {
				$data = $this->update_new_country();
				$this->process_complete();
				if ($data == 1) {
					return 1;
				} else 
					return 0;

			} 

			if ($result > 0)	{
				//$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}


		public function update_param() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);			
			$result = $this->check_param_exist();
			
			if ($result == -1) {
				return -1;
			} elseif ($result == 0) {
				$data = $this->insert_new_param();
				$this->process_complete();
				if ($data == 1) {
					return 1;
				} else 
					return 0;
			} else {//($result == 1) {
				$data = $this->update_new_param();
				$this->process_complete();
				if ($data == 1) {
					return 1;
				} else 
					return 0;

			} 

			if ($result > 0)	{
				//$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function check_param() {
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);			
			$result = $this->check_param_exist();

			return $result;
		}


		public function process_param($result) {

			if ($result == -1) {
				return -1;
			} elseif ($result == 0) {
				$data = $this->insert_new_param();
				$this->process_complete();
				if ($data == 1) {
					return 1;
				} else 
					return 0;
			} else {//($result == 1) {
				$data = $this->update_new_param();
				$this->process_complete();
				if ($data == 1) {
					return 1;
				} else 
					return 0;

			} 

			if ($result > 0)	{
				//$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

	}


?>