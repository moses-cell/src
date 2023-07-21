<?php
	require_once 'ds_global.php';

	
	class ds_adm_food_preferences extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "food_preferences";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_record($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,"",$this->log_param, '', false, false);

			return $data;
		}


		protected function save_record () {


			$data = $this->get_record($_POST['id']);

			$this->param = [
				"meal_type" => $_POST['meal'],
				"description" => $this->validate_value('desc','', null),	
				"date_modified" => date('Y-m-d H:i:s'),
			];

			$key = "id = '" .$_POST['id'] . "'";	

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
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



	}


?>