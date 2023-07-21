<?php
	require_once 'ds_global.php';

	
	class ds_adm_training_location extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "training_location";
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

		public function get_record_provider_id($id) {

			$this->param = [
				"training_provider_id" => $id,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}




		public function save_record ($bol_location_form = true) {


			$data = $this->get_record($_POST['id']);

			if ($bol_location_form) {
				$this->param = [
					"main_location" => $_POST['main_location'],
					"sub_location" => $this->validate_value('sub_location', ''),
					"details" => $this->validate_value('details',''),	
					"status" => $this->validate_value('enable', 'checkbox', '0','','1','1'),
					"training_provider_id" => $_POST['provider_id'],
					"date_modified" => date('Y-m-d H:i:s'),
				];	
			} else {
				$this->param = [
					"main_location" => $_POST['newmaintraininglocation'],
					"sub_location" => $this->validate_value('newsubtraininglocation', ''),
					"details" => $this->validate_value('locationdetails',''),	
					"status" => "1",
					"training_provider_id" => $_POST['provider_id'],
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