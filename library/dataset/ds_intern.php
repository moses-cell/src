<?php
	require_once 'ds_global.php';

	
	class ds_intern extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "intern_info";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
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

		protected function get_record_check_duplicate($ic, $sdate, $edate) {

			$this->param = [
				"ic_no" => $ic,
				"date_start" => $this->format_dbdate($sdate, 'dd-mm-yyyy'),
				"date_end" => $this->format_dbdate($edate, 'dd-mm-yyyy'),
			];
			
			$this->sql = "";
			$condition = "ic_no =:ic_no and ((date_start between :date_start and :date_end) or ";
			$condition .= "(date_end between :date_start and :date_end))";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $condition, false, false);

			return $data;
		}

		protected function get_record_internship_period($ic, $sdate, $edate) {

			$this->param = [
				"ic_no" => $ic,
				"date_start" => $this->format_dbdate($sdate, 'dd-mm-yyyy'),
				"date_end" => $this->format_dbdate($edate, 'dd-mm-yyyy'),
			];
			
			$this->sql = "";
			$condition = "ic_no =:ic_no and (( :date_start  between date_start and date_end) or ";
			$condition .= "(:date_end  between date_start and date_end))";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $condition, false, false);

			return $data;
		}

		protected function get_record_intern_allowance_for_month($intern_id, $month, $year) {

			$this->param = [
				"intern_id" => $intern_id,
				"month" => $month,
				"year" => $year,
			];
			
			$this->sql = "";
			$condition = "intern_id =:intern_id and month =:month and year =:year";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("intern_allowance", $this->param,$this->sql,$this->log_param, $condition, false, false);

			return $data;
		}

		protected function get_record_intern_allowance_details($intern_id) {

			$this->param = [
				"intern_id" => $intern_id,
			];
			
			$this->sql = "";
			$condition = "intern_id =:intern_id";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("intern_allowance", $this->param,$this->sql,$this->log_param, $condition, false, false);

			return $data;
		}

		protected function save_record () {


			$data = $this->get_record_check_duplicate($_POST['ic_no'], $_POST['sdate'], $_POST['sdate']);

			$this->param = [
				"email" => $this->validate_value('email','text', null),
				"student_name" => $this->validate_value('student_name','text',null),	
				"ic_no" => $this->validate_value('ic_no','text',null),	
				"division" => $this->validate_value('division','text',null),
				"section" => $this->validate_value('section','text',null),
				"qualification" => $this->validate_value('qualification','text',null),
				"contact_no" => $this->validate_value('contact_no','text',null),
				"department" => $this->validate_value('department','text',null),	
				"bank_name" => $this->validate_value('bank_name','text',null),
				"acc_no" => $this->validate_value('acc_no','text',null),
				"monthly_allowance" => $this->validate_value('monthly_allowance','number','0'),
				"mc_allowance" => $this->validate_value('mc','number','0'),	
				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $this->validate_value('editor_name','text',null),
				"date_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy'),
				"date_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy'),

			];

			$key = "id =:id ";	

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
				}
				else {
					$this->param = array_merge($this->param, ['id' => $_POST['id']]);
					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param);
				}
					
			} else {
				$this->param = array_merge($this->param, ['created_by' => $this->validate_value('editor_name','text',null)]);
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			}
			return $this->rows;

		}

		protected function get_allowance ($id) {
			$this->param = [
				"id" => $id,
			];
			
			$this->sql = "";
			$condition = "id =:id";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("intern_allowance", $this->param,$this->sql,$this->log_param, $condition, false, false);

			return $data;
		}

		protected function save_allowance () {


			$data = $this->get_allowance($_POST['id']);

			$mc_leave_taken = $this->validate_value('mc_leave_taken','number',0);
			$total_mc_leave = $this->validate_value('total_mc_leave','number',0);
			$unpaid_leave_taken = $this->validate_value('unpaid_leave_taken','number',0);
			$total_leave_taken = $this->validate_value('total_leave_taken','number',0);

			$this->param = [
				"month" => $this->validate_value('month','text', null),
				"intern_id" => $this->validate_value('intern_id','text',null),	
				"year" => $this->validate_value('year','text',null),	
				"mc_leave_taken" => $this->validate_value('mc_leave_taken','number',0),	
				"total_mc_leave_taken" => $total_mc_leave + $mc_leave_taken,
				"leave_taken" => $this->validate_value('total_leave_taken','text',null),
				"unpaid_leave" => $this->validate_value('unpaid_leave_taken','number','0'),
				"total_unpaid_leave" => $this->validate_value('total_unpaid_leave','number','0'),
				"working_day" => $this->validate_value('working_day','number','0'),
				"attendance" => $this->validate_value('actual_work_day','number','0'),
				"add_deduction" => $this->validate_value('add_deduction','number','0'),
				"allowance" => $this->validate_value('allowance_paid','number','0'),
				"daily_allowance" => $this->validate_value('daily_allowance','number','0'),
				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $this->validate_value('editor_name','text',null),
				

			];

			$key = "id =:id ";	

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
				}
				else {
					$this->param = array_merge($this->param, ['id' => $_POST['id']]);
					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update("intern_allowance", $this->param, $key, $this->log_param);
				}
					
			} else {
				$this->param = array_merge($this->param, ['created_by' => $this->validate_value('editor_name','text',null)]);
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert("intern_allowance", $this->param, $this->log_param, false, false );

			}
			return $this->rows;

		}

	}


?>