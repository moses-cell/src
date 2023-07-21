<?php
	require_once 'ds_global.php';

	
	class ds_adm_training_category extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "training_category";
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
				"category" => trim($name),
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}


		protected function save_record () {


			$data = $this->get_record($_POST['id']);

						
			$this->param = [
				"category" => $_POST['category'],
				"status" => $this->validate_value('enable', 'checkbox', '0','','1','1'),
				"modified_date" => date('Y-m-d H:i:s'),
			];

			
			

			$key = "id = '" . $_POST['id'] . "' ";	

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param);
					$this->param = array_merge($this->param, ["modified_by" => $_POST['editor_name']]);
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$this->param = array_merge($this->param, ["created_by" => $_POST['editor_name']]);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, true, false );

			}
			return $this->rows;





		}

		



	}


?>