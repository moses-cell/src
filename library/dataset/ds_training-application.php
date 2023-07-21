<?php
	require_once 'ds_global.php';

	
	class ds_training_application extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct() {
			parent::__construct();
			$this->table = "training_application";
			$this->className = __CLASS__;
		}

		public function get_tablename () {
			return $this->table;
		}

		public function get_training_info($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "";
			//$key = "staff_no =:staff_no ";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, "");

			return $data;
		}


		protected function get_training_registered($training_data, $staff_data) {

			$this->param = array();

			$dt_start = $training_data['date_start'] . " " . $training_data['time_start'];
			$dt_end = $training_data['date_end'] . " " . $training_data['time_end'];

			$this->sql = "SELECT * FROM training_application where ";
			$this->sql .= "((dt_start between '" . $dt_start ."' and '" . $dt_end . "') ";
			$this->sql .= "or (dt_end between '" . $dt_start ."' and '" . $dt_end . "') ";
			$this->sql .= "or ('" . $dt_start ."' between dt_start and dt_end ) ";
			$this->sql .= "or ('" . $dt_end ."' between dt_start and dt_end ) ) ";
			$this->sql .= "and staff_no = '". $staff_data['staff_no']. "' ";
			$this->sql .= "and (status = 'Submit for Approval' or status = 'Approve')";

			$key = "";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		public function get_external_participant_training_registered($training_data, $ep_data) {

			$this->param = array();

			$dt_start = $training_data['date_start'] . " " . $training_data['time_start'];
			$dt_end = $training_data['date_end'] . " " . $training_data['time_end'];

			$this->sql = "SELECT * FROM training_application where ";
			$this->sql .= "((dt_start between '" . $dt_start ."' and '" . $dt_end . "') ";
			$this->sql .= "or (dt_end between '" . $dt_start ."' and '" . $dt_end . "')) ";
			$this->sql .= "and email = '". $ep_data['email']. "' ";
			$this->sql .= "and (status = 'Approve')";

			$key = "";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_participant_list($id) {

			$this->param = ['id' => $id];

			$this->sql = '';

			$key = "sch_id =:id and status in ('Approve', 'Submit for Approval', 'Submit for Cancellation')";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_approve_participant_list($id) {

			$this->param = ['id' => $id];

			$this->sql = '';

			$key = "sch_id =:id and status in ('Approve', 'Submit for Cancellation')";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_trainer_participant_list($id) {

			$this->param = ['id' => $id];

			$this->sql = '';

			$key = "sch_id =:id and status in ('Approve')";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_trainer_participant_list_result($id) {

			$this->param = ['id' => $id];

			$this->sql = "Select  te.*, ta.* from training_application ta left join ";
			$this->sql .= "trainer_eval te on ta.id = te.app_id ";


			$key = "ta.sch_id =:id and ta.status in ('Approve')";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_participant_list_unit($id, $staff_no) {

			$this->sql = "Select ta.*, ts.date_start, ts.date_end from training_application ta inner join ";
			$this->sql .= "training_schedule ts on ta.sch_id = ts.id inner join emp_info ei on ei.email = ta.secretary_email ";

			$this->param = [
				'sch_id' => $id,
				'staff_no' => $staff_no,
			];


			$key = "sch_id =:sch_id and ei.staff_no=:staff_no and ta.status in ('Approve', 'Submit for Approval', 'Submit for Cancellation')";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select('', $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_participant_list_depoh($id, $staff_no) {

			$this->sql = "Select ta.*, ts.date_start, ts.date_end from training_application ta inner join ";
			$this->sql .= "training_schedule ts on ta.sch_id = ts.id inner join emp_info ei on ei.email = ta.depoh_admin_email ";

			$this->param = [
				'sch_id' => $id,
				'staff_no' => $staff_no,
			];


			$key = "sch_id =:sch_id and ei.staff_no=:staff_no and ta.status in ('Approve', 'Submit for Approval', 'Submit for Cancellation')";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select('', $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		public function get_training_registered_by_staff_schedule_id($staff_no, $schedule_id) {

			$this->param = [
				'sch_id' => $schedule_id,
				'staff_no' => $staff_no,
			];

			$this->sql = '';

			$key = "sch_id =:sch_id and staff_no =:staff_no and status in ('Approve', 'Submit for Approval')";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_training_participant_list($schedule_id) {

			$this->param = [
				'sch_id' => $schedule_id,
			];

			$this->sql = '';

			$key = "sch_id =:sch_id and status in ('Approve', 'Submit for Approval')";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_training_schedule($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "select ts.*, tp.provider_name, tl.main_location, tl.sub_location, ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, t.trainer_name ";
			$this->sql .= "from training_schedule ts ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "left join training_category tc on ts.category = tc.id ";
			$this->sql .= "left join trainer_profile t on ts.trainer_id = t.id ";

			$key = "ts.id =:id ";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}

		protected function get_training_schedule_by_date($date) {

			$this->param = [
				"date_start" => $date,
				];
			
			$this->sql = "select ts.*, tp.provider_name, tl.main_location, tl.sub_location, ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, t.trainer_name ";
			$this->sql .= "from training_schedule ts ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "left join training_category tc on ts.category = tc.id ";
			$this->sql .= "left join trainer_profile t on ts.trainer_id = t.id ";

			$key = "ts.date_start =:date_start ";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}


		public function get_training_history($sdate, $staff_no) {


			$this->param = [
				"staff_no" => $staff_no,
				"date_start" => $sdate,
				];
			
			$this->sql = "select ta.*, ts.*, tp.provider_name, tl.main_location, tl.sub_location,  ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "left join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "left join training_category tc on ts.category = tc.id ";

			$key = "ta.staff_no =:staff_no and ta.date_start <:date_start";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key);

			//print_r($data);
			return $data;
		}

		protected function get_pending_approval($staff_no) {


			$this->param = [
				"appr_no" => $staff_no,
				];
			
			$this->sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location,  ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, ts.title as training_title  ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "left join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "left join training_category tc on ts.category = tc.id ";

			$key = 'ta.staff_no =:appr_no';
			$key = "ta.appr_no =:appr_no and (ta.status = 'Submit for Approval' or ta.cancel_status = 'Submit for Cancellation')";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, true, false);

			//print_r($data);
			return $data;
		}

		protected function get_pending_evaluation($staff_no) {


			$this->param = [
				"staff_no" => $staff_no,
				];
			
			$this->sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location,  ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, ts.title as training_title  ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "left join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "left join training_category tc on ts.category = tc.id ";

			$key = 'ta.staff_no =:appr_no';
			$key = "(ta.staff_no =:appr_no and (ta.status = 'Submit for Approval' or ta.status = 'Approve') and ta.eval = 1) and ta.date_end <= '". date('Y-m-d') . "' and ta.total_attend > 0 ";
			$key = "(ta.staff_no =:staff_no and (ta.status = 'Submit for Approval' or ta.status = 'Approve') and ta.eval = 1) and ta.date_end <= '". date('Y-m-d') . "' and ta.total_attend > 0 "; 
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			//print_r($data);
			return $data;
		}

		protected function get_external_pending_evaluation($username) {


			$this->param = [
				"user_name" => $username,
				];
			
			$this->sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location,  ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, ts.title as training_title  ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "left join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "left join training_category tc on ts.category = tc.id ";

			$key = 'ta.staff_no =:appr_no';
			$key = "(ta.email =:user_name and ta.status = 'Approve' and ta.eval = 1) and ta.date_end <= '". date('Y-m-d') . "' and ta.total_attend > 0";
			//$key = "(ta.email =:user_name and ta.status = 'Approve' and ta.eval = 1)"; 
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			//print_r($data);
			return $data;
		}

		protected function get_pending_assessment($staff_no) {

			$this->param = [
				"super_no" => $staff_no,
				];
			
			$this->sql = "select ta.*, ts.title as training_title ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "inner join training_schedule ts on ta.sch_id = ts.id ";
			

			$key = 'ta.staff_no =:super_no';
			$key = "(ta.super_no =:super_no and (ta.status = 'Approve' ) and (ta.super_eval = 1)) and ta.date_end < '". date('Y-m-d') . "' and ta.total_attend > 0 ";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			//print_r($data);
			return $data;
		}

		protected function get_supervisor_pending_assessment($date) {

			$this->param = [
				"date_end" => $date,
				];
			
			$this->sql = "select ta.*, ts.title as training_title ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "inner join training_schedule ts on ta.sch_id = ts.id ";
			

			$key = 'ta.staff_no =:super_no';
			$key = "(ta.status = 'Approve' ) and (ta.super_eval = 1) and ta.date_end =:date_end and ta.total_attend > 0";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			//print_r($data);
			return $data;
		}


		protected function get_pending_trainer_assessment($trainer_id) {


			$this->param = [
				"trainer_id" => $trainer_id,
				];
			
			$this->sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location,  ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, ts.title as training_title  ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "left join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "left join training_category tc on ts.category = tc.id ";

			$key = 'ta.staff_no =:appr_no';
			$key = "(ts.trainer_id =:trainer_id and (ta.status = 'Approve' or ta.status = 'Submit for Approval') and (ta.trainer_eval = 1 and ta.total_attend > 0))";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			//print_r($data);
			return $data;
		}

		protected function get_training_applied($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "select  ts.*, ta.*, tp.provider_name, tl.main_location, tl.sub_location,  ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, t.trainer_name, ts.title ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "inner join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "inner join training_category tc on ts.category = tc.id ";
			$this->sql .= "left join trainer_profile t on ts.trainer_id = t.id ";

			$key = "ta.id =:id ";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param, $key, false, false);

			return $data;
		}


		/*public function get_staff_info($staff_no) {

			$this->param = [
				"staff_no" => $staff_no,
				];
			
			$this->sql = "";
			//$key = "staff_no =:staff_no ";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("emp_info", $this->param,$this->sql,$this->log_param, "");

			return $data;
		}*/

		public function get_staff_access_role($staff_no) {

			$this->param = [
				"staff_no" => $staff_no,
				];
			
			$this->sql = "";
			//$key = "staff_no =:staff_no ";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("emp_info", $this->param,$this->sql,$this->log_param, "");

			return $data;
		}

		protected function submit_staff_training_for_approval ($training_data, $staff_data) {

			//$data = $this->get_training_info($_POST['id']);

			$this->param = [
				"staff_no" => $staff_data['staff_no'],
				"email" => $staff_data['email'],
				"email2" => $staff_data['email2'],
				"trainer_id" => $training_data['trainer_id'],
				"sch_id" => $training_data['id'],
				"participant_type" => '1',
				"date_modified" => date('Y-m-d H:i:s'),
				"appr_no" => $staff_data['appr_no'],
				"appr_email" => $staff_data['appr_email'],
				"appr_name" => $staff_data['appr_name'],
				"status" => "Submit for Approval",
				"modified_by" => $this->validate_value('editor_name','text', null),
				"eval" => $training_data['eval'],
				"super_eval" => $training_data['super_eval'],
				"trainer_eval" => $training_data['trainer_eval'], 
				"date_start" => $training_data['date_start'],
				"date_end" => $training_data['date_end'],
				"time_start" => $training_data['time_start'],
				"time_end" => $training_data['time_end'],
				"approval" => $training_data['approval'],
				"dt_start" => $training_data['date_start'] . ' ' . $training_data['time_start'],
				"dt_end" => $training_data['date_end'] . ' ' . $training_data['time_end'],
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
				"total_days" => $training_data['total_days'],
				"total_hours" => $training_data['total_hours'],
				"total_attend" => 0,
				"attendance" => $this->attendance($training_data['total_days']),
				"fullname" => $staff_data['staff_name'],
				"super_no" => $staff_data['super_no'],
				"super_name" => $staff_data['super_name'],
				"super_email" => $staff_data['super_email'],
				"secretary_email" => $staff_data['secretary_email'],
				"depoh_admin_email" => $staff_data['depoh_admin_email'],


			];

			$this->param = array_merge($this->param, ["created_by" => $this->validate_value('editor_name','text', null) ]);
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			return $this->rows;

		}


		protected function auto_staff_training_for_approval ($training_data, $staff_data) {

			//$data = $this->get_training_info($_POST['id']);

			$this->param = [
				"staff_no" => $staff_data['staff_no'],
				"email" => $staff_data['email'],
				"email2" => $staff_data['email2'],
				"trainer_id" => $training_data['trainer_id'],
				"sch_id" => $training_data['id'],
				"participant_type" => '1',
				"date_modified" => date('Y-m-d H:i:s'),
				"appr_no" => $staff_data['appr_no'],
				"appr_email" => $staff_data['appr_email'],
				"appr_name" => $staff_data['appr_name'],
				"status" => "Approve",
				"modified_by" => $this->validate_value('editor_name','text', null),
				"eval" => $training_data['eval'],
				"super_eval" => $training_data['super_eval'],
				"trainer_eval" => $training_data['trainer_eval'], 
				"date_start" => $training_data['date_start'],
				"date_end" => $training_data['date_end'],
				"time_start" => $training_data['time_start'],
				"time_end" => $training_data['time_end'],
				"approval" => $training_data['approval'],
				"dt_start" => $training_data['date_start'] . ' ' . $training_data['time_start'],
				"dt_end" => $training_data['date_end'] . ' ' . $training_data['time_end'],
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
				"total_days" => $training_data['total_days'],
				"total_hours" => $training_data['total_hours'],
				"total_attend" => 0,
				"attendance" => $this->attendance($training_data['total_days']),
				"fullname" => $staff_data['staff_name'],
				"super_no" => $staff_data['super_no'],
				"super_name" => $staff_data['super_name'],
				"super_email" => $staff_data['super_email'],
				"secretary_email" => $staff_data['secretary_email'],
				"depoh_admin_email" => $staff_data['depoh_admin_email'],


			];

			$this->param = array_merge($this->param, ["created_by" => $this->validate_value('editor_name','text', null) ]);
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			/*if ($this->validate_value('id','') != '')
				$this->param = array_merge($this->param, ['id' => $_POST['id']]);

			$key = "id =:id ";	

			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->rows = 1;
				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param);
				}
					
			} else {

				$this->param = array_merge($this->param, ["created_by" => $this->validate_value('editor_name','text', null) ]);
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			}*/
			return $this->rows;

		}

		protected function create_training_schedule() {
			$this->param = [
				"code" => $_POST['coursecode'],
				"title" => $_POST['title'],
				"description" => $_POST['description'],
				"category" => $_POST['trainingcategory'],
				"total_days" => $this->validate_value('tdays','number','0'),
				"cost" => $this->validate_value('cost','number','0'),
				"total_hours" => $this->validate_value('thours','number','0'),
				"remarks" => $_POST['remarks'],
				"eval" => 1,
				"date_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy'),
				"date_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy'),
				"time_start" => $this->validate_value('stime','time',null, 'hh:mm p'),
				"time_end" => $this->validate_value('etime','time',null, 'hh:mm p'),
				"date_modified" => date('Y-m-d H:i:s'),
				"approval" => 1,
				"filename" => $this->validate_value('filename','',null,'','','',"filename"),
				"enable_schedule" => '0',
				"bonding" => '0',
				"staff_request" => '1',	
				"created_by" => $this->validate_value('editor_name','text', null) ,

			];	

			if ($_POST['trainingprovidername'] == 'New Training Provider') {
				$this->param = array_merge($this->param, ["training_provider" => $this->validate_value('newtrainingprovider','text', null) ]);
			} else {
				$this->param = array_merge($this->param, ["provider" => $this->validate_value('trainingprovider','text', null) ]);
			}

			if ($_POST['traininglocationname'] == 'New Training Provider Location') {
				$this->param = array_merge($this->param, ["training_location" => $this->validate_value('newmaintraininglocation','text', null) ]);

			} elseif ($_POST['traininglocationname'] == 'New public Location') {
				$this->param = array_merge($this->param, ["training_location" => $this->validate_value('newmaintraininglocation','text', null) ]);

			} else {
				$this->param = array_merge($this->param, ["location" => $this->validate_value('traininglocation','text', null) ]);
			}

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_insert('training_schedule', $this->param, $this->log_param, true, false );

			return $this->rows;
		}


		protected function submit_staff_external_training ($staff_data) {

			//$data = $this->get_training_info($_POST['id']);

			$this->param = [
				"staff_no" => $staff_data['staff_no'],
				"email" => $staff_data['email'],
				"email2" => $staff_data['email2'],
				"sch_id" => $_POST['sch_id'],
				"participant_type" => '1',
				"date_modified" => date('Y-m-d H:i:s'),
				"appr_no" => $staff_data['appr_no'],
				"appr_email" => $staff_data['appr_email'],
				"appr_name" => $staff_data['appr_name'],
				"status" => "Submit for Approval",
				"modified_by" => $this->validate_value('editor_name','text', null),
				"eval" => '1', 
				"date_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy'),
				"date_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy'),
				"time_start" => $this->validate_value('stime','time',null, 'hh:mm p'),
				"time_end" => $this->validate_value('etime','time',null, 'hh:mm p'),
				"approval" => '1',
				"dt_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy') . ' ' . $this->validate_value('stime','time',null, 'hh:mm p'),
				"dt_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy') . ' ' . $this->validate_value('etime','time',null, 'hh:mm p'),
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
				"total_attend" => 0,
				"total_days" => $this->validate_value('tdays','number','0'),
				"total_hours" => $this->validate_value('thours','number','0'),
				"fullname" => $staff_data['staff_name'],
				"super_no" => $staff_data['super_no'],
				"super_name" => $staff_data['super_name'],
				"super_email" => $staff_data['super_email'],
				"secretary_email" => $staff_data['secretary_email'],
				"depoh_admin_email" => $staff_data['depoh_admin_email'],
				"staff_request" => '1',


			];

			$this->param = array_merge($this->param, ["created_by" => $this->validate_value('editor_name','text', null) ]);
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_insert($this->table, $this->param, $this->log_param, true, false );

			return $this->rows;

		}



		public function submit_staff_training_by_trainer ($training_data, $staff_data, $staff_no) {

			//$data = $this->get_training_info($_POST['id']);

			$this->param = [
				"staff_no" => $staff_data['staff_no'],
				"email" => $staff_data['email'],
				"email2" => $staff_data['email2'],
				"trainer_id" => $training_data['trainer_id'],
				"sch_id" => $training_data['id'],
				"participant_type" => '1',
				"date_modified" => date('Y-m-d H:i:s'),
				"appr_no" => $staff_data['appr_no'],
				"appr_email" => $staff_data['appr_email'],
				"appr_name" => $staff_data['appr_name'],
				"status" => "Approve",
				"modified_by" => $this->validate_value('editor_name','text', null),
				"eval" => $training_data['eval'],
				"super_eval" => $training_data['super_eval'],
				"trainer_eval" => $training_data['trainer_eval'], 
				"date_start" => $training_data['date_start'],
				"date_end" => $training_data['date_end'],
				"time_start" => $training_data['time_start'],
				"time_end" => $training_data['time_end'],
				"approval" => $training_data['approval'],
				"dt_start" => $training_data['date_start'] . ' ' . $training_data['time_start'],
				"dt_end" => $training_data['date_end'] . ' ' . $training_data['time_end'],
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
				"total_days" => $training_data['total_days'],
				"total_hours" => $training_data['total_hours'],
				"total_attend" => 0,
				"attendance" => $this->attendance($training_data['total_days']),
				"fullname" => $staff_data['staff_name'],
				"super_no" => $staff_data['super_no'],
				"super_name" => $staff_data['super_name'],
				"super_email" => $staff_data['super_email'],
				"secretary_email" => $staff_data['secretary_email'],
				"depoh_admin_email" => $staff_data['depoh_admin_email'],
				"trainer_created" => '1',
				"replace_staff_no" => $staff_no,


			];

			$this->param = array_merge($this->param, ["created_by" => $this->validate_value('editor_name','text', null) ]);
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			return $this->rows;

		}


		public function create_training_for_external_participant ($training_data, $ep_data) {

			//$data = $this->get_training_info($_POST['id']);

			$this->param = [
				"email" => $ep_data['email'],
				"trainer_id" => $training_data['trainer_id'],
				"trainer_id" => $training_data['trainer_id'],
				"sch_id" => $training_data['id'],
				"participant_type" => '2',
				"date_modified" => date('Y-m-d H:i:s'),
				"status" => "Approve",
				"modified_by" => $this->validate_value('editor_name','text', null),
				"eval" => 1,
				"super_eval" => 0,
				"trainer_eval" => $this->validate_value('trainer_eval','number','1'),
				"date_start" => $training_data['date_start'],
				"date_end" => $training_data['date_end'],
				"time_start" => $training_data['time_start'],
				"time_end" => $training_data['time_end'],
				"approval" => '0',
				"dt_start" => $training_data['date_start'] . ' ' . $training_data['time_start'],
				"dt_end" => $training_data['date_end'] . ' ' . $training_data['time_end'],
				"department" => $ep_data['department'],
				"total_days" => $training_data['total_days'],
				"total_hours" => $training_data['total_hours'],
				"total_attend" => 0,
				"attendance" => $this->attendance($training_data['total_days']),
				"fullname" => $ep_data['name'],
				"company" => $ep_data['company'],
				"created_by" => $this->validate_value('editor_name','text', null),

			];

			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			
			return $this->rows;

		}

		protected function cancel_staff_training_by_trainer($training_data, $staff_data, $staff_no) {

			$this->param = [
				"trainer_cancel" => '1',
				"total_attend" => 0,
				'status' => 'Cancel',
				'cancel_status' => 'Cancel',
				"replace_staff_no" => $staff_data['staff_no'],
				"sch_id" => $training_data['id'],
				"staff_no" => $staff_no,
			];
			
			$this->sql = "";

			$key = "staff_no = :staff_no and sch_id = :sch_id and status != 'Cancel' ";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$this->db_update($this->table, $this->param, $key, $this->log_param, false );

			return $this->rows;

		}


		public function approve_decision () {

			$this->param = [
				"date_modified" => date('Y-m-d H:i:s'),
				"status" => $_POST['form_process'],
				"modified_by" => $this->validate_value('editor_name','text', null),
				'id' => $_POST['id'],
			];


			$key = "id =:id ";	
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);

			return $this->rows;

		}

		public function update_bonding () {

			$this->param = [
				"date_modified" => date('Y-m-d H:i:s'),
				"bonding" => '1',
				"modified_by" => $this->validate_value('editor_name','text', null),
				'id' => $_POST['sch_id'],
			];


			$key = "id =:id and staff_request = '1'";	
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update('training_schedule', $this->param, $key, $this->log_param, false);

			return $this->rows;

		}

		public function update_other_info () {

			$this->param = [
				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $this->validate_value('editor_name','text', null),
				'id' => $_POST['sch_id'],
				"code" => $_POST['coursecode'],
				"category" => $_POST['trainingcategory'],
				"bonding" => $this->validate_value('bonding', 'checkbox', '0','','1','1' ),
			];



			//print_r($this->param);
			//die();
			$key = "id =:id and staff_request = '1'";	
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update('training_schedule', $this->param, $key, $this->log_param, false);

			return $this->rows;

		}


		protected function reject_cancel_decision () {

			$this->param = [
				"date_modified" => date('Y-m-d H:i:s'),
				"status" => 'Approve',
				"cancel_status" => 'Reject',
				"modified_by" => $this->validate_value('editor_name','text', null),
				'id' => $_POST['id'],
			];

			$key = "id =:id ";	
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);

			return $this->rows;

		}

		protected function approve_decision_cancel () {

			$this->param = [
				"date_modified" => date('Y-m-d H:i:s'),
				"status" => 'Cancel',
				"cancel_status" => 'Approve',
				"modified_by" => $this->validate_value('editor_name','text', null),
				'id' => $_POST['id'],
			];

			$key = "id =:id ";	
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);

			return $this->rows;

		}

		public function submit_for_cancellation () {

			$this->param = [
				"date_modified" => date('Y-m-d H:i:s'),
				"cancel_status" => 'Submit for Cancellation',
				"modified_by" => $this->validate_value('editor_name','text', null),
				'id' => $_POST['id'],
			];

			$key = "id =:id ";	
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);

			return $this->rows;

		}

		protected function auto_training_cancellation () {

			$this->param = [
				"date_modified" => date('Y-m-d H:i:s'),
				"cancel_status" => 'Auto Approve Cancellation',
				"status" => 'Cancel',
				"modified_by" => $this->validate_value('editor_name','text', null),
				'id' => $_POST['id'],
			];

			$key = "id =:id ";	
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);

			return $this->rows;

		}



		public function update_filename() {
						
			$this->param = [
				"id" => $_POST['sch_id'],
				"filename" => $_POST['filename'],
			];

			$key = 'id = :id';
			$data = $this->db_update('training_schedule', $this->param, $key, $this->log_param );
			return $this->rows;

		}

		private function attendance($totaldays) {

			$delim = '';
			$attend = '';
			for ($i = 1; $i <=$totaldays; $i++) {
				$attend .= $delim . '0';
				$delim = ','; 

			}

			return $attend;


		}

		public function get_participant_attendance($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}

		protected function update_participant_attendance($id, $attendance, $total) {

			$this->param = [
				"id" => $id,
				"total_attend" => $total,
				"attendance" => $attendance,
				];
			
			$this->sql = "";

			$key = 'id = :id';
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$this->db_update($this->table, $this->param, $key, $this->log_param, false );

			return $this->rows;

		}

		protected function trainer_cancel_participant_registration($id) {

			$this->param = [
				"id" => $id,
				"trainer_cancel" => '1',
				"total_attend" => 0,
				'status' => 'Cancel',
				'cancel_status' => 'Cancel',
			];
			
			$this->sql = "";

			$key = 'id = :id';
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$this->db_update($this->table, $this->param, $key, $this->log_param, false );

			return $this->rows;

			
		}

		protected function cancel_participant_registration($id, $reason) {

			$this->param = [
				"id" => $id,
				"trainer_cancel" => '1',
				"total_attend" => 0,
				'status' => 'Cancel',
				'cancel_status' => $reason,
			];
			
			$this->sql = "";

			$key = 'id = :id';
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$this->db_update($this->table, $this->param, $key, $this->log_param, false );

			return $this->rows;

			
		}

		protected function trainer_reinstate_participant_registration($staff_no, $replace_staff_no, $sch_id) {
			$this->param = [
				"staff_no" => $staff_no,
				"trainer_cancel" => '0',
				"total_attend" => '0',
				'cancel_status' => NULL,
				'sch_id' => $sch_id,
				'replace_staff_no' => NULL,
				'status' => 'Approve',
			];
			
			$this->sql = "";
			//$extended_field_update = "status = original_status";

			$key = 'staff_no = :staff_no and sch_id =:sch_id and replace_staff_no ="'. $replace_staff_no.'"';
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$this->db_update($this->table, $this->param, $key, $this->log_param, false); //, $extended_field_update );

			return $this->rows;

			return $data;
		}

	}


?>