<?php
	require_once 'ds_global.php';

	
	class ds_data_upload extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}


		private function get_record($fieldname, $fieldvalue, $condition = '') {
			
			$this->param = [
				$fieldname => $fieldvalue,		
			];
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			
			$data = $this->db_select($this->table, $this->param,'',$this->log_param, $condition, false, false);
			return $data;
		}

		protected function upload_staff_profile($xldata) {

			$this->table = "emp_info";

			$data = $this->get_record("staff_no",$xldata[0]);

			$this->param = [
				"staff_no" => $this->validate_value_array ($xldata, 0, 'text', '') ,
				"staff_name" => $this->validate_value_array ($xldata, 1, 'text', '') ,
				"email" => $this->validate_value_array ($xldata, 2, 'text', null) ,
				"grade" => $this->validate_value_array ($xldata, 3, 'text', '') ,
				"position" => $this->validate_value_array ($xldata, 4, 'text', '') ,
				"personal_area" => $this->validate_value_array ($xldata, 5, 'text', '') ,
				"org_group" => $this->validate_value_array ($xldata, 6, 'text', '') ,
				"division" => $this->validate_value_array ($xldata, 7, 'text', '') ,
				"department" => $this->validate_value_array ($xldata, 8, 'text', '') ,
				"section" => $this->validate_value_array ($xldata, 9, 'text', '') ,
				"unit" => $this->validate_value_array ($xldata, 10, 'text', '') ,
				"personal_subarea" => $this->validate_value_array ($xldata, 11, 'text', '') ,
				"employee_subgroup" => $this->validate_value_array ($xldata, 12, 'text', '') ,
				"organization_unit" => $this->validate_value_array ($xldata, 14, 'text', '') ,		
				"depoh_admin_staff_no" => $this->validate_value_array ($xldata, 15, 'text', '') ,
				"depoh_admin_email" => $this->validate_value_array ($xldata, 16, 'text', '') ,
				"secretary_staff_no" => $this->validate_value_array ($xldata, 17, 'text', '') ,
				"secretary_email" => $this->validate_value_array ($xldata, 18, 'text', '') ,
				"appr_no" => $this->validate_value_array ($xldata, 19, 'text', '') ,
				"appr_email" => $this->validate_value_array ($xldata, 20, 'text', '') ,
				"appr_name" => $this->validate_value_array ($xldata, 21, 'text', '') ,
				"super_no" => $this->validate_value_array ($xldata, 22, 'text', '') ,
				"super_email" => $this->validate_value_array ($xldata, 23, 'text', '') ,
				"super_name" => $this->validate_value_array ($xldata, 24, 'text', '') ,
				"username" => $this->validate_value_array ($xldata, 0, 'text', '') ,
				"upload_by"=>$_SESSION['full_name'],
				"date_upload" => date('Y-m-d H:i:s')

			];
			
			$this->param = $this->array_change_value_case($this->param,CASE_UPPER);
			//"status" => $this->validate_value_array ($xldata, 13, 'text', '') ,
			$this->param = array_merge($this->param, ["status" => $this->validate_value_array ($xldata, 13, 'text', '')]);
			//print_r($this->param);
			$key = "staff_no =:staff_no";

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->rows = 1;
				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
					if ($this->rows < 0 ) {
						$this->db_update($this->table, $this->param, $key, $this->log_param, false);
					}
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );
				if ($this->rows < 0 ) {
					$this->db_insert($this->table, $this->param, $this->log_param, false, false );
				}
			}
			return $this->rows;
		}


		protected function upload_staff_login($xldata) {

			$this->table = "apps_user";

			$data = $this->get_record("user_name",$xldata[0]);
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
			$password = substr( str_shuffle( $chars ), 0, 12 );

			$this->param = [
				"user_name" => $this->validate_value_array ($xldata, 0, 'text', '') ,
				"full_name" => $this->validate_value_array ($xldata, 1, 'text', '') ,
				"password" => sha1($password),
				"modified_date" => $this->current_datetime(),
				"created_date" => $this->current_datetime(),
				"created_by" => "Data Upload",
				"modified_by" => "Data Upload",
				"type"=>'internal',
				"trainer" => 'n'


			];
			
			//$this->param = $this->array_change_value_case($this->param,CASE_UPPER);
			//print_r($this->param);
			$key = "user_name =:user_name";

			if(count($data) > 0){
				$this->rows = 1;					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );
				if ($this->rows < 0 ) {
					$this->db_insert($this->table, $this->param, $this->log_param, false, false );
				}
			}
			return $this->rows;
		}


		protected function upload_training_module($xldata) {

			$this->table = "training_module";

			$data = array();
			//$data = $this->get_record("staff_no",$xldata[0]);	
			$this->param = [
				"code" => $this->array_change_value_case($this->validate_value_array ($xldata, 0, 'text', ''),CASE_UPPER) ,
				"title" => $this->array_change_value_case($this->validate_value_array ($xldata, 1, 'text', ''),CASE_UPPER) ,
				"description" => $this->array_change_value_case($this->validate_value_array ($xldata, 2, 'text', ''),CASE_UPPER) ,
				"category" => $this->validate_value_array ($xldata, 3, 'text', '') ,
				"total_days" => $this->validate_value_array ($xldata, 4, 'text', '') ,
				"total_hours" => $this->validate_value_array ($xldata, 5, 'text', '') ,
				"max_sit" => $this->validate_value_array ($xldata, 6, 'text', '') ,
				"eligibility" => $this->validate_value_array ($xldata, 7, 'text', '') ,
				"remarks" => $this->validate_value_array ($xldata, 8, 'text', '') ,
				"provider" => $this->validate_value_array ($xldata, 9, 'text', '') ,
				"super_eval" => $this->validate_value_array ($xldata, 10, 'text', '') ,
				"trainer_eval" => $this->validate_value_array ($xldata, 11, 'text', '') ,
				"audience" => $this->validate_value_array ($xldata, 12, 'text', '') ,
				"cost" => $this->validate_value_array ($xldata, 13, 'text', '') ,
				"bonding" => $this->validate_value_array ($xldata, 14, 'text', '') ,
				"eval"=>1,
				"created_by"=>$_SESSION['full_name'],
				"date_upload" => date('Y-m-d H:i:s'),
				"enable_module" => '0',

			];
			
			//print_r($this->param);
			$key = "staff_no =:staff_no";

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->rows = 1;
				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			}
			return $this->rows;
		}

		protected function upload_trainer_login($xldata) {

			$this->table = "apps_user";

			$data = $this->get_record("user_name",$xldata[0]);
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
			$password = substr( str_shuffle( $chars ), 0, 12 );

			$this->param = [
				"user_name" => $this->validate_value_array ($xldata, 0, 'text', '') ,
				"full_name" => $this->validate_value_array ($xldata, 1, 'text', '') ,
				"password" => sha1($password),
				"modified_date" => $this->current_datetime(),
				"created_date" => $this->current_datetime(),
				"created_by" => "Data Upload",
				"modified_by" => "Data Upload",
				"type"=>'internal',
				"trainer" => 'y',
				'trainer_id' => $trainer_id ,


			];
			
			//$this->param = $this->array_change_value_case($this->param,CASE_UPPER);
			//print_r($this->param);
			$key = "user_name =:user_name";

			if(count($data) > 0){
				$this->param = [
					"trainer" => 'y',
					'trainer_id' => $trainer_id ,
			];
				$this->rows = 1;					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );
				if ($this->rows < 0 ) {
					$this->db_insert($this->table, $this->param, $this->log_param, false, false );
				}
			}
			return $this->rows;
		}

		private function get_training_module($fieldname, $fieldvalue) {
			$this->param = [
				$fieldname => $fieldvalue,
				"enable_module" => '1',		
			];
			
			$condition = '';
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			
			$data = $this->db_select("training_module", $this->param,'',$this->log_param, $condition, true, false);
			return $data;
		}

		protected function upload_training_schedule($xldata) {

			$this->table = "training_schedule";

			//print_r($xldata);

			$data = array();
			$data = $this->get_training_module("code",$xldata[0]);	
			if (count($data) <= 0) {
				$this->rows = -1;
				return $this->rows;
			}

			$data = $data[0];
			$this->param = [
				"code" => $this->array_change_value_case($this->validate_value_array ($xldata, 0, 'text', ''),CASE_UPPER) ,
				"title" => $this->array_change_value_case($data['title'],CASE_UPPER) ,
				"description" => $this->array_change_value_case($data['description'],CASE_UPPER) ,
				"category" => $this->validate_value_array ($xldata, 1, 'text', '') ,
				"total_days" => $this->validate_value_array ($xldata, 2, 'text', '') ,
				"total_hours" => $this->validate_value_array ($xldata, 3, 'text', '') ,
				"max_sit" => $data['max_sit'] ,
				"eligibility" => $data['eligibility'] ,
				"remarks" => $this->array_change_value_case($this->validate_value_array ($xldata, 4, 'text', ''),CASE_UPPER) ,
				"super_eval" => $data['super_eval'] ,
				"trainer_eval" => $data['trainer_eval'] ,
				"audience" => $data['audience'] ,
				"cost" => $data['cost'] ,
				"bonding" =>  $data['bonding'],
				"provider" => $this->validate_value_array ($xldata, 5, 'text', '') ,
				"location" => $this->validate_value_array ($xldata, 6, 'text', '') ,
				"date_start" => $this->validate_value_array ($xldata, 7, 'date',null, 'dd-mm-yyyy') ,
				"date_end" => $this->validate_value_array ($xldata, 8, 'date',null, 'dd-mm-yyyy') ,
				"time_start" => $this->validate_value_array ($xldata, 9, 'text', '') ,
				"time_end" => $this->validate_value_array ($xldata, 10, 'text', '') ,
				"trainer_id" => $this->validate_value_array ($xldata, 11, 'text', null) ,
				"approval" => $this->validate_value_array ($xldata, 12, 'text', null) ,
				"eval"=> 1,
				"created_by"=> $_SESSION['full_name'],
				"date_upload" => date('Y-m-d H:i:s'),
				"enable_schedule" => '1',
				"filename" => $data['filename'],

			];
			
			//print_r($this->param);
			//die();
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			if ($this->rows < 0 ) {
				$this->db_insert($this->table, $this->param, $this->log_param, false, false );
			}

			return $this->rows;
		}		



	}


?>