<?php
	

	require_once 'ds_global.php';


	class ds_external_participant extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "external_participant";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_external_participant($email) {

			$this->param = [
				"email" => $email, 	
			];

			$this->data  = $this->db_select($this->table, $this->param, "", $this->log_param);
			return $this->data;

		}

		public function register_external_participant() {

			//$data = $this->get_training_info($_POST['id']);

			$this->param = [
				"email" => $_POST['email'],
				"name" => $_POST['name'],
				"company" => $_POST['company'],
				"department" => $_POST['department'],
				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $this->validate_value('editor_name','text', null),
				"created_by" => $this->validate_value('editor_name','text', null)
			];

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_insert($this->table, $this->param, $this->log_param, true, false );

			return $this->rows;
		}

		public function update_external_participant() {

			$data = $this->get_external_participant($_POST['email']);

			$this->param = [
				"email" => $_POST['email'],
				"name" => $_POST['name'],
				"company" => $_POST['company'],
				"department" => $_POST['department'],
				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $this->validate_value('editor_name','text', null),
			];

			$key = "email =:email";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);

			return $this->rows;
		}
		
		public function get_external_trainer_schedule($trainer_id, $start, $end) {

			$this->param = array();
			$this->table = "";

			//$this->sql = "Select * from training_schedule where trainer_id = '$trainer_id' and ((date_start between '$sdt' and '$edt') or (date_end between '$sdt' and '$edt') or ('$sdt' between date_start and date_end) or ('$edt' between date_start and date_end)) ";

			$date = date('Y-m-d');
			$start = $start * -1;

			$this->sql = "Select * from training_schedule where trainer_id = '2' and ('$date' BETWEEN DATE_ADD(date_start,INTERVAL $start  DAY) and DATE_ADD(date_end,INTERVAL $end DAY) )"; 

			$data  = $this->db_select($this->table, $this->param, $this->sql, $this->log_param,"",false,false);
			
			//echo count($data);
			return $data;

		}

		public function get_external_participant_schedule($email, $start, $end) {

			$this->param = array();
			$this->table = "";

			//$this->sql = "Select * from training_schedule where trainer_id = '$trainer_id' and ((date_start between '$sdt' and '$edt') or (date_end between '$sdt' and '$edt') or ('$sdt' between date_start and date_end) or ('$edt' between date_start and date_end)) ";

			$date = date('Y-m-d');
			$start = $start * -1;

			$this->sql = "Select * from training_application where email = '$email' and ('$date' BETWEEN DATE_ADD(date_start,INTERVAL $start  DAY) and DATE_ADD(date_end,INTERVAL $end DAY) )"; 

			$data  = $this->db_select($this->table, $this->param, $this->sql, $this->log_param,"",false, false);
			
			//echo count($data);
			return $data;

		}


		


	}


?>