<?php
	require_once 'ds_global.php';

	
	class ds_training_request extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "training_request";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_training_request($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}


		public function save_training_request ($staff_data) {


			$data = $this->get_training_request($_POST['id']);

			$this->param = [
				"code" => $_POST['coursecode'],
				"title" => $_POST['title'],
				"description" => $_POST['description'],
				"category" => $_POST['trainingcategory'],
				"total_days" => $this->validate_value('tdays','','0'),
				"cost" => $this->validate_value('cost','','0'),
				"total_hours" => $this->validate_value('thours','','0'),
				"audience" => $this->validate_value('target_audience', 'checkbox', null, 'array_implode' ),
				"filename" => $this->validate_value('filename','',null,'','','',"filename"),
				"date_modified" => date('Y-m-d H:i:s'),
				"staff_no" => $staff_data['staff_no'],
				"email" => $staff_data['email'],
				"appr_no" => $staff_data['appr_no'],
				"appr_email" => $staff_data['appr_email'],
				"appr_name" => $staff_data['appr_name'],
				"division" => $staff_data['division'],
				"department" => $staff_data['department'],
				"unit" => $staff_data['unit'],
				"position" => $staff_data['position'],
				"personal_area" => $staff_data['personal_area'],
				"personal_subarea" => $staff_data['personal_subarea'],
				"org_group" => $staff_data['org_group'],
				"section" => $staff_data['section'],
				"organization_unit" => $staff_data['organization_unit'],
				"employee_subgroup" => $staff_data['employee_subgroup'],
				"depoh_admin_email" => $staff_data['depoh_admin_email'],
				"super_no" => $staff_data['super_no'],
				"super_name" => $staff_data['super_name'],
				"super_email" => $staff_data['super_email'],
				"fullname" => $staff_data['staff_name'],
				"created_by" => $staff_data['staff_name'],
				"status" => 'Submit',
				"provider_id" => $_POST['trainingprovider'],
				"provider" => $_POST['trainingprovidername'],
				"new_training_provider" => $this->validate_value('newtrainingprovider', 'text', '' ),
				
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

		public function training_request_in_progress() {
						
			$this->param = [
				"id" => $_POST['id'],
				"status" => 'In Progress',
				"date_modified" => date('Y-m-d  H:i:s'),
				"modified_by" => $_POST['editor_name'],

			];

			$key = 'id = :id';
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param );
			return $this->rows;

		}

		public function training_request_reject() {
						
			$this->param = [
				"id" => $_POST['id'],
				"status" => 'Reject',
				"date_modified" => date('Y-m-d  H:i:s'),
				"modified_by" => $_POST['editor_name'],

			];

			$key = 'id = :id';
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param );
			return $this->rows;

		}

		public function training_request_complete($request_id,$sch_id) {
						
			$this->param = [
				"id" => $request_id,
				"status" => 'Complete',
				"sch_id" => $sch_id,
				"date_modified" => date('Y-m-d  H:i:s'),
				"modified_by" => $_POST['editor_name'],

			];

			$key = 'id = :id';
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false );
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