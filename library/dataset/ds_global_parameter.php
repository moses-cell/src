<?php
	
	require_once 'ds_global.php';

	
	class ds_global_parameter extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->className = __CLASS__;

		}

		public function set_tablename ($table_name) {
			$this->table = $table_name;

		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_parameter_data ($sql = "", $param = array(), $order_by = "") {

			$this->param = $param;
			
			$this->sql = $sql;

			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, '', false,false);

			return $data;

		}


	}

?>