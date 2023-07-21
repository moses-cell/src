<?php
	require_once 'ds_global.php';

	
	class ds_hr_training_module extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "training_module";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}

		protected function get_training_module($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}

		protected function get_duplicate_training_module($course_code) {

			$this->param = [
				"code" => $course_code,
				"enable_module" => 1,
			];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, false, true);

			return $data;
		}

		protected function save_training_module () {


			$data = $this->get_training_module($_POST['id']);

			$this->param = [
				"code" => $_POST['coursecode'],
				"title" => $_POST['title'],
				"description" => $_POST['description'],
				"category" => $_POST['trainingcategory'],
				"provider" => $_POST['trainingprovider'],
				"total_days" => $this->validate_value('tdays','','0'),
				"cost" => $this->validate_value('cost','','0'),
				"total_hours" => $this->validate_value('thours','','0'),
				"eligibility" => $this->validate_value('eligibility', 'checkbox', null, 'array_implode' ),
				"audience" => $this->validate_value('target_audience', 'checkbox', null, 'array_implode' ),
				"enable_module" => $this->validate_value('enable_process', 'checkbox', '0','','1','1' ),
				"bonding" => $this->validate_value('bonding', 'checkbox', '0','','1','1' ),
				"max_sit" => $this->validate_value('max_sit','','0'),
				"remarks" => $_POST['remarks'],
				"eval" => 1,
				"super_eval" => $this->validate_value('super_eval','','0'),
				"trainer_eval" => $this->validate_value('trainer_eval','','0'),
				"filename" => $this->validate_value('filename','',null,'','','',"filename"),
				"date_modified" => date('Y-m-d H:i:s'),



			];

			$key = "id = '" . $_POST['id'] . "'"  ;	

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					
					$this->rows = 1;
				}
				else {
					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param,false);
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, true, false );
				$_POST['id'] = $this->last_id;

			}
			return $this->rows;





		}

		public function update_filename() {
						
			$this->param = [
				"id" => $_POST['id'],
				"filename" => $_POST['filename'],
			];

			$key = 'id = :id';
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param );
			return $this->rows;

		}



	}


?>