<?php
	require_once 'ds_global.php';

	
	class ds_adm_emp_grade extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "emp_grade";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_record_info($id) {

			$this->param = [
				"grade" => $id,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}


		public function insert_record () {


			$data = $this->get_record_info($_POST['grade']);

			$this->param = [
				"grade" => $_POST['grade'],
				"description" => $this->validate_value('desc',''),	
				"status" => $this->validate_value('enable', 'checkbox', '0','','1','1'),
				"date_modified" => date('Y-m-d H:i:s'),


			];

			$key = "grade =:grade ";	

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
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			}
			return $this->rows;





		}



	}


?>