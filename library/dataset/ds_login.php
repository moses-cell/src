<?php
	

	require_once 'ds_global.php';


	class ds_login extends global_base {

		private $data;
		//private $param;
		private $table;

		public function __construct() {
			parent::__construct();
			$this->table = "apps_user";

		}

		public function get_tablename () {
			return $this->table;
		}

		public function valid_user($user) {


		}

		public function login($username, $password) {
			//$this->sql = 'SELECT * FROM '. $this->table . ' WHERE user_name=:user_name and password=:password; ';
			$this->param = [
				"user_name" => $username, 
			];
			
			
			$this->data  = $this->db_select($this->table, $this->param, $this->sql, $this->log_param, "", true, false );

			return $this->data;
		}

		public function change_password($staff_no, $password) {
			$this->param = [
				"user_name" => $staff_no, 
				"modified_date" => $this->current_datetime(),
				"modified_by" => $staff_no,
				"change_password" => '0',
				"password" => $password,
			];

			$key = "user_name = :user_name";

			$data  = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
			return $this->rows;


		}

		public function register_user_staff($staff_no, $password, $staff_name) {
			$this->param = [
				"user_name" => $staff_no, 
				"full_name" => $staff_name, 
				"modified_date" => $this->current_datetime(),
				"created_date" => $this->current_datetime(),
				"created_by" => $staff_no,
				"modified_by" => $staff_no,
				"change_password" => '1',
				"password" => $password,
				"type"=>'internal',
				"trainer" => 'n'
			];

			$data  = $this->db_insert($this->table, $this->param, $this->log_param, true, false);
			return $this->rows;;


		}

		public function register_user_external($username, $password, $fullname) {
			$this->param = [
				"user_name" => $username, 
				"full_name" => $fullname, 
				"modified_date" => $this->current_datetime(),
				"created_date" => $this->current_datetime(),
				"created_by" => $_SESSION['full_name'],
				"modified_by" => $_SESSION['full_name'],
				"change_password" => '1',
				"password" => $password,
				"type"=>'external',
				"trainer" => 'n'
			];

			$data  = $this->db_insert($this->table, $this->param, $this->log_param, true, false);
			return $this->rows;


		}

		public function is_trainer($staff_no) {

			$this->param = [
				"staff_no" => $staff_no, 	
			];

			$this->data  = $this->db_select("trainer_profile", $this->param, "", $this->log_param);
			
			return $this->data;

		}

		public function update_trainer_login($username, $trainer_id) {

			$this->param = [
				"user_name" => $username, 
				'trainer' => 'y',
				"modified_date" => $this->current_datetime(),
				'trainer_id' => $trainer_id ,
			];
			
			$key = 'user_name =:user_name';
				
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);


			if ($this->rows > 0) {
				
				return true;
			}
			else {
				
				return false;
			}


		}

		public function check_user_exist($username) {
			$this->param = [
				"user_name" => $username, 
			];
			
			
			$this->data  = $this->db_select($this->table, $this->param, $this->sql, $this->log_param, "",true, false );

			//echo count($this->data);
			return $this->data;
		}

		protected function reset_password($username, $password) {
			$this->param = [
				"user_name" => $username, 
				"modified_date" => $this->current_datetime(),
				"modified_by" => 'System - Password Reset',
				"change_password" => '1',
				"password" => $password,
			];

			$key = "user_name = :user_name";

			$data  = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
			return $this->rows;


		}

	}


?>