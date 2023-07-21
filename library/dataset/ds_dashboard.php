<?php
	require_once 'ds_global.php';

	
	class ds_dashboard extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "";
			$this->className = __CLASS__;
		}


		protected function get_training_schedule($date_start, $date_end) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
			];
			
			$this->sql = "Select count(code) as total_schedule from training_schedule where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and enable_schedule = 1";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false, false);

			return $data;
		}

		protected function get_yearly_training_schedule($year) {

			$this->param = [
				"year" => $year,
			];

			$this->sql = "Select count(code) as total_schedule from training_schedule where DATE_FORMAT(date_start,'%Y') = :year ";
			$this->sql .= "and enable_schedule = 1";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false, false);

			return $data;
		}

		protected function get_my_training_register($date_start, $date_end, $staff_no) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
				"staff_no" => $staff_no,
			];
			
			$this->sql = "Select count(staff_no) as total_register from training_application where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and status in ('Approve', 'Submit for Approval', 'Submit to HR') and staff_no = :staff_no;" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		/*protected function get_yearly_training_register($year) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
				"staff_no" => $staff_no,
			];
			
			$this->sql = "Select count(staff_no) as total_register from training_application where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and status in ('Approve', 'Submit for Approval', 'Submit to HR') and staff_no = :staff_no;" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}*/

		protected function get_yearly_training_register($year) {

			$this->param = [
				"year" => $year,
				
			];
			
			$this->sql = "Select count(staff_no) as total_register from training_application where DATE_FORMAT(date_start,'%Y') = :year ";
			$this->sql .= "and status in ('Approve', 'Submit for Approval', 'Submit to HR') and participant_type ='1' " ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		protected function get_monthly_training_register($date_start, $date_end) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
			];
			
			$this->sql = "Select count(staff_no) as total_register from training_application where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and status in ('Approve', 'Submit for Approval', 'Submit to HR') and participant_type = 1" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);
			
			return $data;
		}

		protected function get_internal_training_register($date_start, $date_end) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
			];
			
			$this->sql = "Select count(staff_no) as total_register from training_application where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and status in ('Approve', 'Submit for Approval', 'Submit to HR') and (staff_request != '1' or staff_request is null)  and participant_type = 1" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		protected function get_my_internal_training_register($date_start, $date_end, $staff_no) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
				"staff_no" => $staff_no,
			];
			
			$this->sql = "Select count(staff_no) as total_register from training_application where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and status in ('Approve', 'Submit for Approval', 'Submit to HR') and (staff_request != '1' or staff_request is null)  and staff_no = :staff_no" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		protected function get_my_external_training_register($date_start, $date_end, $staff_no) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
				"staff_no" => $staff_no,
			];
			
			$this->sql = "Select count(staff_no) as total_register from training_application where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and status in ('Approve', 'Submit for Approval', 'Submit to HR') and staff_request = '1' and staff_no = :staff_no" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		protected function get_external_training_register($date_start, $date_end) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
			];
			
			$this->sql = "Select count(staff_no) as total_register from training_application where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and status in ('Approve', 'Submit for Approval', 'Submit to HR') and staff_request = '1' and  participant_type = 1" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		protected function get_my_incoming_training($date_start, $date_end, $staff_no) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
				"staff_no" => $staff_no,
			];
			
			$this->sql = "Select ta.*, ts.title from training_application ta inner join training_schedule ts ";
			$this->sql .= "on ta.sch_id = ts.id where ((ta.date_start between :date_start and :date_end) or ";
			$this->sql .= "(ta.date_end between :date_start and :date_end)) and ta.status in ('Approve', 'Submit for Approval', 'Submit to HR')  and ta.staff_no = :staff_no order by ta.date_start desc" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false, false);

			return $data;
		}

		protected function get_incoming_schedule($date_start, $date_end) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
			];
			
			$this->sql = "Select * from training_schedule  ";
			$this->sql .= "where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and enable_schedule = '1' ";
			$this->sql .= "and (staff_request != '1' or staff_request is null )order by date_start desc" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		protected function get_montly_training_schedule($date_start, $date_end) {

			$this->param = [
				"date_start" => $date_start,
				"date_end" => $date_end,
			];
			
			$this->sql = "Select * from training_schedule  ";
			$this->sql .= "where ((date_start between :date_start and :date_end) or ";
			$this->sql .= "(date_end between :date_start and :date_end)) and enable_schedule = '1' ";
			$this->sql .= "and (staff_request != '1' or staff_request is null )order by date_start asc" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		protected function get_my_training_report($year, $staff_no) {

			$this->param = array();	
			
			$this->sql = "select count(id) as total_month,DATE_FORMAT(date_start,'%m') as month from training_application ";
			$this->sql .= "where status in ('Approve', 'Submit for Approval', 'Submit to HR') ";
			$this->sql .= "and staff_no = '". $staff_no ."' and DATE_FORMAT(date_start,'%Y') = '". $year ."' GROUP BY DATE_FORMAT(date_start,'%Y-%m') order by DATE_FORMAT(date_start,'%m');" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}

		protected function get_all_training_report($year) {

			$this->param = array();	
			
			$this->sql = "select count(id) as total_month,DATE_FORMAT(date_start,'%m') as month from training_application ";
			$this->sql .= "where status in ('Approve', 'Submit for Approval', 'Submit to HR') ";
			$this->sql .= "and DATE_FORMAT(date_start,'%Y') = '". $year ."' GROUP BY DATE_FORMAT(date_start,'%Y-%m') order by DATE_FORMAT(date_start,'%m');" ;
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, "", false,false);

			return $data;
		}


	}


?>