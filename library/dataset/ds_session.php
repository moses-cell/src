<?php
	require_once 'ds_global.php';


	class session extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			//$this->db_connection();
			//$this->db_beginTransaction();
			$this->table = "admin";

		}

		public function get_tablename () {
			return $this->table;
		}

		public function check_admin($username) {

			$this->param = array("user_name" => $username);
			
			$this->data = $this->db_select($this->table, $this->param,'',$this->log_param, "", false);
			$this->process_complete();
			$this->rows = count($this->data);
			
			return $this->rows;
		}

		public function check_valid_user($username) {

			$this->param = array("user_name" => $username);
			
			$this->data = $this->db_select('apps_user', $this->param,'',$this->log_param, "", false);
			$this->process_complete();
			$this->rows = count($this->data);
			
			return $this->rows;

		}

		function check_user_roles($username) {

			$this->db_connect();

			$this->param = array("user_name" => $username);
			
			$this->data = $this->db_select('user_roles', $this->param,'',$this->log_param, "", false);
			$this->process_complete();
			$this->rows = count($this->data);
			
			return $this->data;
		}

	}


?>