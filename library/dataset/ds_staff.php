<?php
	

	require_once 'ds_global.php';


	class ds_staff extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "emp_info";
			$this->className = __CLASS__;

		}


		public function get_tablename () {
			return $this->table;
		}

		public function valid_user($user) {


		}

		protected function get_staff_info($staff_no) {

			$this->param = [
				"staff_no" => $staff_no, 	
			];

			$this->data  = $this->db_select($this->table, $this->param, "", $this->log_param, "", false, false);
			return $this->data;

		}

		protected function save_record() {


			$this->param = [

				"meal_type" => $this->validate_value('meal','', 1),
				"email2" => $this->validate_value('email2','', null),	
				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $_POST['editor_name'],
				"appr_name" => $this->validate_value('appr_name','', null),	
				"appr_no" => $this->validate_value('appr_no','', null),	
				"appr_email" => $this->validate_value('appr_email','', null),	
				"super_name" => $this->validate_value('super_name','', null),	
				"super_no" => $this->validate_value('super_no','', null),	
				"super_email" => $this->validate_value('super_email','', null),	
				"secretary_email" => $this->validate_value('sec_email','', null),
				"secretary_staff_no" => $this->validate_value('sec_staff_no','', null),	
				"depoh_admin_email" => $this->validate_value('depoh_email','', null),
				"depoh_admin_staff_no" => $this->validate_value('depoh_staff_no','', null),	
				"ic_no" => $this->validate_value('ic','', null),
				"tel" => $this->validate_value('tel','', null),	

			];

			$key = "staff_no = '" .$_POST['id'] . "'";	

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
		
			return $this->rows;
		}

		protected function trainer_update_staff_info() {


			$this->param = [

				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $_POST['editor_name'],
				"appr_name" => $this->validate_value('appr_name','', null),	
				"appr_no" => $this->validate_value('appr_no','', null),	
				"appr_email" => $this->validate_value('appr_email','', null),	
				"super_name" => $this->validate_value('super_name','', null),	
				"super_no" => $this->validate_value('super_no','', null),	
				"super_email" => $this->validate_value('super_email','', null),	
				"secretary_email" => $this->validate_value('sec_email','', null),	
				"depoh_admin_email" => $this->validate_value('depoh_email','', null),
				"secretary_staff_no" => $this->validate_value('sec_staff_no','', null),
				"depoh_admin_staff_no" => $this->validate_value('depoh_staff_no','', null),

			];

			$key = "staff_no = '" .$_POST['staff_no'] . "'";	

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
		
			return $this->rows;
		}


		

		


	}


?>