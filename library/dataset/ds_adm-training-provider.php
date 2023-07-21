<?php
	require_once 'ds_global.php';

	
	class ds_adm_training_provider extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "training_provider";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_record($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}

		protected function get_record_by_name($name) {

			$this->param = [
				"provider_name" => trim($name),
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}


		public function save_record ($bol_provider_form = true) {


			$data = $this->get_record($_POST['id']);

			if ($bol_provider_form) {
				
				$this->param = [
						"provider_name" => $_POST['provider_name'],
						"details" => $this->validate_value('details',''),	
						"status" => $this->validate_value('enable', 'checkbox', '0','','1','1'),
						"date_modified" => date('Y-m-d H:i:s'),
					];

			} else {

				$this->param = [
						"provider_name" => $_POST['newtrainingprovider'],
						"details" => "",	
						"status" => "1",
						"date_modified" => date('Y-m-d H:i:s'),
					];
			}
			

			$key = "id = '" . $_POST['id'] . "' ";	

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param);
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, true, false );

			}
			return $this->rows;





		}

		



	}


?>