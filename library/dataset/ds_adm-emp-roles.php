<?php
	require_once 'ds_global.php';

	
	class ds_adm_emp_roles extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "user_roles";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_record($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "Select ur.*, ei.staff_name, ei.email from user_roles ur inner join emp_info ei on ei.staff_no = ur.user_name where ur.id = :id";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param);

			return $data;
		}

		public function get_record_by_username($username) {

			$this->param = [
				"user_name" => $username,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, '', true, false);

			return $data;
		}

		public function save_record () {


			$data = $this->get_record_by_username($_POST['staff_no']);

			$this->param = [
				"user_name" => $_POST['staff_no'],
				"roles" => $this->validate_value('roles','', null),	
				

			];

			$key = "user_name =:user_name ";	

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
				}
				else {

					$this->param = array_merge($this->param, ["date_modified" => date('Y-m-d H:i:s')]);
					$this->param = array_merge($this->param, ["modified_by" => $_POST['editor_name']]);

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param);
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$this->param = array_merge($this->param, ["created_by" => $_POST['editor_name']]);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			}
			return $this->rows;





		}

		function get_staff_info_by_email($email) {

			$this->param = [
				"email" => $email,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select('emp_info', $this->param,$this->sql,$this->log_param);

			return $data;	
		}

		function get_staff_info_by_staff_no($staff_no) {


			$this->param = [
				"staff_no" => $staff_no,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select('emp_info', $this->param,$this->sql,$this->log_param, '', true, false);

			return $data;	
		}

		function delete_record($id) {

			$this->param = [
				"id" => $id,
				];
			
			$key = "id = :id";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_delete($this->table, $this->param, $key, $this->log_param);

			return $data;	
		}


	}


?>