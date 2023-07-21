<?php
	require_once 'ds_global.php';

	
	class ds_report extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct($table) {
			parent::__construct();
			$this->table = $table;
			$this->className = __CLASS__;
		}

		protected function get_tablename () {
			return $this->table;
		}

		protected function get_all_record($sql) {

			$this->param = array();

			$key = "";
			
			$this->sql = $sql;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param, $this->sql, $this->log_param, $key, false, false);

			return $data;
		}

		protected function get_training_category() {

			$this->param = array();

			$this->sql = "Select id as 'Category Id', category as 'Category', status as 'Status' from " . $this->table;


			$key = "";
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param, $this->sql, $this->log_param, $key, false, false);

			return $data;
		}

		protected function get_training_provider() {

			$this->param = array();

			$this->sql = "Select id as 'Provider Id', provider_name as 'Training Provider', details as 'Training Provider Details', status as 'Status' from " . $this->table;


			$key = "";
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param, $this->sql, $this->log_param, $key, false, false);
		

			return $data;
		}

		protected function get_training_location() {

			$this->param = array();

			$this->sql = "Select tl.training_provider_id as 'Training Provider Id',   tp.provider_name as 'Training Provider', tl.id as 'Location Id', tl.main_location as 'Main Location', tl.sub_location as 'Sub Location', tl.details as 'Training Location Details', tl.status as 'Status' from training_location tl left join training_provider tp on tl.training_provider_id = tp.id";


			$key = "";
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param, $this->sql, $this->log_param, $key, false, false);
		

			return $data;
		}

		
	}


?>