<?php
	
	require_once 'ds_global.php';

	
	class ds_hr_trainer_profile extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			//$this->db_connection();
			//$this->db_beginTransaction();
			$this->table = 'trainer_profile';
			$this->className = __CLASS__;

		}

		public function get_tablename () {
			return $this->table;
		}

		public function check_trainer_exist() {

			$this->param = [
				"email" => $_POST['email'],
				"ic" => $_POST['ic'],
			];

			$condition = 'email=:email or ic=:ic ';
			if ($_POST['id'] != '') {
				$this->param = array_merge($this->param, ['id' => $_POST['id']]);
				$condition .= 'or id=:id ';
			}

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			
			$data = $this->db_select($this->table, $this->param,'',$this->log_param, $condition);
			return $data;
		}

		public function get_record_by_id($id = '') {

			$this->param = [
				"id" => $id,
			];							
			
			$data = $this->db_select($this->table, $this->param,'',$this->log_param);
			return $data;
		}

		public function get_record_by_staff_no($staff_no = '') {

			$this->param = [
				"staff_no" => $staff_no,
			];							
			
			$data = $this->db_select($this->table, $this->param,'',$this->log_param);
			return $data;
		}

		public function get_record_by_email($email = '') {

			$this->param = [
				"email" => $email,
			];							
			
			$data = $this->db_select($this->table, $this->param,'',$this->log_param);
			return $data;
		}

		public function get_emp_record_by_id($id) {

			$this->param = [
					"id" => $id,
				];							
			
			
			$data = $this->db_select("trainer_employment", $this->param,'',$this->log_param);
			return $data;
				
		}

		public function get_academic_record_by_id($id) {

			$this->param = [
					"id" => $id,
				];							
			
			
			$data = $this->db_select("trainer_academic", $this->param,'',$this->log_param);
			return $data;
				
		}

		public function get_training_record_by_id($id) {

			$this->param = [
					"id" => $id,
				];							
			
			
			$data = $this->db_select("trainer_training", $this->param,'',$this->log_param);
			return $data;
				
		}

		public function get_internal_trainer($staff_no) {

			$this->param = [
					"staff_no" => $staff_no,
				];							
			
			
			$data = $this->db_select($this->table, $this->param,'',$this->log_param);
			return $data;
		}

		public function get_external_trainer($email) {

			$this->param = [
					"email" => $email,
				];							
			
			
			$data = $this->db_select($this->table, $this->param,'',$this->log_param);
			return $data;
		}

		public function save_record() {

			$data = $this->get_record_by_id($_POST['id']);

			$parts = explode('-',$_POST['dob']);
			$dob = $parts[2] . '-' . $parts[1] . '-' . $parts[0];

			$this->param = [
				"trainer_name" => $_POST['fullname'],
				"email" => $_POST['email'],
				"tel" => $_POST['phone'],
				"add1" => $_POST['address'],
				"dob" => $this->validate_value('dob','date',null, 'dd-mm-yyyy'), 
				"ic" => $_POST['ic'],
				/*"designation" => $_POST['designation'],
				"grade" => $_POST['grade'],
				"department" => $_POST['department'],
				"emp_status" => $_POST['employmentstatus'],*/
				"marital_status" => $_POST['maritalstatus'],
				"staff_no" => $this->validate_value('staff_no','text',null),
				"picture" => $_POST['picture'],
				"internal_trainer" => $_POST['trainer_type'],
				"status" => $this->validate_value('disable_trainer','checkbox',null,'','0','0'), 
				
			];

			$key = "id =:id ";	

			if ($this->validate_value('id','') != '')
				$this->param = array_merge($this->param, ['id' => $_POST['id']]);


			if(count($data) > 0){
			
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->rows = 1;

				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false, false);
				}
					
			} else {
				
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, true, false );
				$_POST['id'] = $this->last_id;

			}

			return $this->rows;

		}


		public function save_record_employment() {

			$data = $this->get_emp_record_by_id($_POST['id']);


			$this->param = [
				"syear" => $_POST['syear'],
				"eyear" => $_POST['eyear'],
				"profile_id" => $_POST['profile_id'],
				"designation" => $_POST['designation'],
				"department" => $_POST['dept'],
				"job_description" => $_POST['jd'],
				
			];

			
			$key = "id =:id ";	

			if ($this->validate_value('id','') != '')
				$this->param = array_merge($this->param, ['id' => $_POST['id']]);


			if(count($data) > 0){
			
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->rows = 1;

				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update("trainer_employment", $this->param, $key, $this->log_param, false);
				}
					
			} else {
				
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert("trainer_employment", $this->param, $this->log_param, true, false );
				$_POST['id'] = $this->last_id;

			}

			return $this->rows;

		}


		function delete_record_employment() {

			$this->param = [
				"id" => $_POST['id'],
				];
			
			$key = "id = :id";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_delete("trainer_employment", $this->param, $key, $this->log_param);

			return $data;	
		}


		public function save_record_academic() {

			$data = $this->get_academic_record_by_id($_POST['id']);


			$this->param = [
				"grad_year" => $_POST['ayear'],
				"qualification" => $_POST['qualification'],
				"profile_id" => $_POST['profile_id'],
				"major" => $_POST['major'],
				"institution" => $_POST['institution'],
				
			];

			
			$key = "id =:id ";	

			if ($this->validate_value('id','') != '')
				$this->param = array_merge($this->param, ['id' => $_POST['id']]);


			if(count($data) > 0){
			
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->rows = 1;

				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update("trainer_academic", $this->param, $key, $this->log_param, false);
				}
					
			} else {
				
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert("trainer_academic", $this->param, $this->log_param, true, false );
				$_POST['id'] = $this->last_id;

			}

			return $this->rows;

		}


		function delete_record_academic() {

			$this->param = [
				"id" => $_POST['id'],
			];
			
			$key = "id = :id";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_delete("trainer_academic", $this->param, $key, $this->log_param);

			return $data;	
		}

		public function save_record_training() {

			$data = $this->get_training_record_by_id($_POST['id']);


			$this->param = [
				"training_year" => $_POST['tyear'],
				"program" => $_POST['program'],
				"profile_id" => $_POST['profile_id'],
				"organiser" => $_POST['organiser'],
				
			];

			
			$key = "id =:id ";	

			if ($this->validate_value('id','') != '')
				$this->param = array_merge($this->param, ['id' => $_POST['id']]);


			if(count($data) > 0){
			
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->rows = 1;

				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update("trainer_training", $this->param, $key, $this->log_param, false);
				}
					
			} else {
				
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert("trainer_training", $this->param, $this->log_param, true, false );
				$_POST['id'] = $this->last_id;

			}

			return $this->rows;

		}

		function delete_record_training() {

			$this->param = [
				"id" => $_POST['id'],
			];
			
			$key = "id = :id";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_delete("trainer_training", $this->param, $key, $this->log_param);

			return $data;	
		}


/*		public function update_new_country() {

			$this->param = [
				"country_code" => $_POST['countrycode'],
				"country_name" => $_POST['country'],
			];
			$key = "id = '".$_POST['id'] ."'";
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param );
			return $this->rows;
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
*/
		public function update_filename() {
						
			$this->param = [
				"id" => $_POST['id'],
				"picture" => $_POST['filename'],
			];

			$key = 'id = :id';
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param );
			return $this->rows;

		}

	}


?>