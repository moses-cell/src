<?php
	
	require_once 'ds_global.php';

	
	class training_info extends global_base {

		private $data;
		private $table;

		public function __construct() {
			parent::__construct();
			//$this->db_connection();
			//$this->db_beginTransaction();
			$this->table = "training_info";

		}

		public function get_tablename () {
			return $this->table;
		}

		public function check_training() {

			$this->param = array("roles_name" => $roles_name);
			
			$result = $this->db_select($this->table, $this->param,'',$this->log_param);
			$this->data = $result->fetchAll();
			$this->db_closeCursor($result);
			$this->rows = count($this->data);
			$this->commit();
			return $this->rows;
		}

		public function insert_training() {

			$this->param = [
				"ti_title" => $_POST['title'],
				"ti_status" => 'Active',
				"ti_createdby" => $_SESSION['full_name'],
				"ti_created" => date('Y-m-d H:i:s'),
				"ti_modifiedby" => $_SESSION['full_name'],
				"ti_modified" => date('Y-m-d H:i:s')
				];
			
			$result = $this->db_insert($this->table, $this->param, $this->log_param);
			$this->commit();
			return $this->rows;

			//return $this->data;
		}

	}


?>