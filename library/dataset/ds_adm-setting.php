<?php
	require_once 'ds_global.php';

	
	class ds_adm_setting extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "training_setting";
			$this->className = __CLASS__;
		}

		protected function get_tablename () {
			return $this->table;
		}

		protected function get_record($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}

		protected function get_record_by_key($key) {

			$this->param = [
				"setting_key" => $key,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}

		protected function get_email_setting() {

			$this->sql = "";
			$condition = "setting_key in ('hr_email_group','smtp_mail_server','smtp_mail_port_no','smtp_require_authentication','smtp_username','smtp_password','server_url')";

			//$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$this->log_param = array();
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $condition, false);

			return $data;
		}

		protected function get_external_participant_setting() {

			$this->sql = "";
			$condition = "setting_key in ('external_can_login_before_training', 'external_can_login_after_training')";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $condition);

			return $data;
		}

		protected function get_external_trainer_setting() {

			$this->sql = "";
			$condition = "setting_key in ('trainer_can_login_before_training', 'trainer_can_login_after_training')";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $condition);

			return $data;
		}


		protected function save_record () {


			$data = $this->get_record($_POST['id']);

			$this->param = [
				"setting_value" => $_POST['setting_value'],
				"id" => $_POST['id'],			

			];

			$key = "id =:id ";	

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