<?php
	
	require_once 'ds_global.php';

	
	class ds_parameter extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct($table_name) {
			parent::__construct();
			//$this->db_connection();
			//$this->db_beginTransaction();
			$this->table = $table_name;
			$this->className = __CLASS__;

		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_record_info($id = '') {

			$this->param = array();
			if ($id != '') {
				$this->param = [
					"id" => $id,
				];							
			}
			
			$data = $this->db_select($this->table, $this->param,'',$this->log_param);
			return $data;
		}


		public function check_country_exist() {

			$this->param = [
				//"country_code" => $_POST['countrycode'],
				"country_name" => $_POST['country']
			];
				
			//$this->condition = "country= :country"; 
			$data = $this->db_select($this->table, $this->param, '', $this->log_param, $this->condition, true);

			if ($this->rows == 0) {
				if ($_POST['id'] != '')
					return 1;
				else
					return 0;
			}
			elseif ($this->rows == 1) {
				if ($_POST['id'] == '') {
					return -1;
				} elseif ($_POST['id'] == $data[0]['id']) {
					return 1;
				} else {
					return -1;
				}
			} else 
				return -1;
			
		}

		public function insert_new_country() {

			$this->param = [
				"country_code" => $_POST['countrycode'],
				"country_name" => $_POST['country']
			];
				
			$data = $this->db_insert($this->table, $this->param, $this->log_param );

			return $this->rows;

		}

		public function update_new_country() {

			$this->param = [
				"country_code" => $_POST['countrycode'],
				"country_name" => $_POST['country'],
			];
			$key = "id = '".$_POST['id'] ."'";
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param );
			return $this->rows;
		}



		public function check_param_exist() {
				
			//$this->condition = "country= :country"; 
			$data = $this->db_select($this->table, $this->param, '', $this->log_param, $this->condition, true);

			if ($this->rows == 0) {
				if ($_POST['id'] != '')
					return 1;
				else
					return 0;
			}
			elseif ($this->rows == 1) {
				if ($_POST['id'] == '') {
					return -1;
				} elseif ($_POST['id'] == $data[0]['id']) {
					return 1;
				} else {
					return -1;
				}
			} else 
				return -1;
			
		}

		public function insert_new_param() {

			$data = $this->db_insert($this->table, $this->param, $this->log_param );

			return $this->rows;

		}

		public function update_new_param() {

			
			$key = "id = '".$_POST['id'] ."'";
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param );
			return $this->rows;
		}

	}


?>