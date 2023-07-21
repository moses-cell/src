<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_hr-trainer-profile.php';
	

	class c_hr_trainer_profile extends ds_hr_trainer_profile {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}


		public function _save_record() {

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

		public function _save_record_employment() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->save_record_employment();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

			
		}

		public function _save_record_academic() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->save_record_academic();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

			
		}

		public function _save_record_training() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->save_record_training();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

			
		}

		public function _delete_record_employment() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->delete_record_employment();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

			
		}

		public function _delete_record_academic() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->delete_record_academic();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

			
		}

		public function _delete_record_training() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			$data = $this->delete_record_training();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

			
		}

		public function _get_record_by_id($id) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_record_by_id($id);

			$this->process_complete();
			
			return $data;
		}

		public function _get_record_by_staff_no($staff_no) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_record_by_staff_no($staff_no);

			$this->process_complete();
			
			return $data;
		}

		public function _get_record_by_email($email) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_record_by_email($email);

			$this->process_complete();
			
			return $data;
		}


		public function _get_emp_record_by_id($id) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_emp_record_by_id($id);

			$this->process_complete();
			
			return $data;
		}

		public function _get_academic_record_by_id($id) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_academic_record_by_id($id);

			$this->process_complete();
			
			return $data;
		}

		public function _get_training_record_by_id($id) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_training_record_by_id($id);

			$this->process_complete();
			
			return $data;
		}


		public function _get_internal_trainer($staff_no) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_internal_trainer($staff_no);

			$this->process_complete();
			
			return $data;
		}

		public function _get_external_trainer($email) {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_external_trainer($email);

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