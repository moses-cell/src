<?php
	
	require_once 'ds_global.php';

	
	class roles extends global_base {

		private $data;
		private $table;

		public function __construct() {
			parent::__construct();
			//$this->db_connection();
			//$this->db_beginTransaction();
			$this->table = "roles";

		}

		public function get_tablename () {
			return $this->table;
		}

		public function check_role($roles_name) {

			$this->param = array("roles_name" => $roles_name);
			
			$result = $this->db_select($this->table, $this->param,'',$this->log_param);
			$this->data = $result->fetchAll();
			$this->db_closeCursor($result);
			$this->rows = count($this->data);
			$this->commit();
			return $this->rows;
		}

		public function insert_role($roles_name) {

			$this->param = [
				"roles_name" => $roles_name,
				"roles_status" => 'Active',
				"roles_createdby" => $_SESSION['full_name'],
				"roles_created" => date('Y-m-d H:i:s'),
				"roles_modifiedby" => $_SESSION['full_name'],
				"roles_modified" => date('Y-m-d H:i:s')
				];
			
			$result = $this->db_insert($this->table, $this->param, $this->log_param);
			$this->commit();
			return $this->rows;

			//return $this->data;
		}

	}


?>