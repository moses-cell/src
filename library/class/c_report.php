<?php

	
	require_once dirname(dirname(__FILE__)) . '/dataset/ds_report.php';

	class c_report extends ds_report {

		private $className;
		private $type;
		protected $title;
		protected $WSTitle;
		protected $subtitle;
		public $param_report;

		public function __construct($table_name, $param) {

			$this->className = __CLASS__;	
			parent::__construct($table_name);

			$this->type = $table_name;
			$this->param_report = $param;
			$this->subtitle = '';

			$this->set_report_details();
		}

		public function _get_all_record($sql = '') {

			$functionName = __FUNCTION__;

			//echo $sql;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_all_record($sql);
			
			$this->process_complete();
			
			return $data;

		}

		private function set_report_details() {

			if ($this->type == 'training_category') {
				$this->title = 'Prasarana Printis Training Category';
				$this->WSTitle = 'Training Category';
				$this->sql = "Select id as 'Category Id', category as 'Category', status as 'Status' from training_category";

			} elseif ($this->type == 'training_provider') {
				$this->title = 'Prasarana Printis Training Provider';
				$this->WSTitle = 'Training Provider';
				$this->sql = "Select id as 'Provider Id', provider_name as 'Training Provider', details as 'Training Provider Details', status as 'Status' from training_provider";

			} elseif ($this->type == 'training_location') {
				$this->title = 'Prasarana Printis Training Location';
				$this->WSTitle = 'Training Location';
				$this->sql = "Select tl.training_provider_id as 'Training Provider Id',   tp.provider_name as 'Training Provider', tl.id as 'Location Id', tl.main_location as 'Main Location', tl.sub_location as 'Sub Location', tl.details as 'Training Location Details', tl.status as 'Status' from training_location tl left join training_provider tp on tl.training_provider_id = tp.id";

			} elseif ($this->type == 'food_preferences') {
				$this->title = 'Prasarana Printis Food Preferences';
				$this->WSTitle = 'Training Provider';
				$this->sql = "Select id as 'Food Preferences Id', meal_type as 'Meal Type', description as 'Food Preferences Details' from food_preferences";

			} elseif ($this->type == 'emp_grade') {
				$this->title = 'Prasarana Printis Job Grade';
				$this->WSTitle = 'Training Provider';
				$this->sql = "Select grade as 'Job Grade', description as 'Job Grade Description', status as 'Status' from emp_grade";

			} elseif ($this->type == 'emp_roles') {
				$this->title = 'Prasarana Printis Staff Roles';
				$this->WSTitle = 'Staff Roles';
				$this->sql = "Select ur.id as 'Roles Id', ei.staff_name as 'Staff Name', user_name as 'Username', roles as 'User Roles' from user_roles ur inner join emp_info ei on ei.staff_no = ur.user_name";

			} elseif ($this->type == 'intern-monthly_report') {

				$dateObj   = DateTime::createFromFormat('!m', $this->param_report['m']);
				$monthName = $dateObj->format('F'); // March

				$this->title = 'Monthly Allowance ('. $monthName . ' '. $this->param_report['y']. ') for interns posted under Prasarana Malaysia Berhad';
				$this->WSTitle = 'Working ' .$monthName . $this->param_report['y'];
				$this->sql = "Select * from intern_info ii inner join intern_allowance ia  on ii.id = ia.intern_id";
				$this->sql .= " where month = '" . $this->param_report['m'] . "' and year = '" . $this->param_report['y'] . "'";
			
			} elseif ($this->type == 'training_module') {

				$this->title = 'Prasarana Printis Training Module';
				$this->WSTitle = 'Training Module';
				$this->sql = "Select tm.id 'Training Id', tm.code 'Training Code', tm.title 'Training Title', tc.category 'Training Category', tm.total_days 'Days', tm.total_hours 'Hours', tm.max_sit 'Max Capacity', tm.eligibility 'Who Can Apply', tm.enable_module 'Status (1=Enable; 0=Disable)', tp.provider_name 'Training Provider', tm.audience 'Target Audience', tm.cost 'Cost Per Head', bonding 'Staff Bonding (1=Yes; 0=No)' from training_module tm left join training_category tc on tm.category = tc.id left join training_provider tp on tp.id = tm.provider ";

				if ($this->param_report == '1') {
					$this->sql .= "where tm.enable_module = '1'";
					$this->subtitle = ' Enable';
				} elseif ($this->param_report == '0') {
					$this->sql .= "where tm.enable_module = '0'";
					$this->subtitle = ' Disable';
				}
			
			} elseif ($this->type == 'training_module_enablexx') {

				$this->title = 'Prasarana Printis Training Module Enable';
				$this->WSTitle = 'Training Module';
				$this->sql = "Select tm.id 'Training Id', tm.code 'Training Code', tm.title 'Training Title', tc.category 'Training Category', tm.total_days 'Days', tm.total_hours 'Hours', tm.max_sit 'Max Capacity', tm.eligibility 'Who Can Apply', tm.enable_module 'Status (1=Enable; 0=Disable)', tp.provider_name 'Training Provider', tm.audience 'Target Audience', tm.cost 'Cost Per Head', bonding 'Staff Bonding (1=Yes; 0=No)' from training_module tm left join training_category tc on tm.category = tc.id left join training_provider tp on tp.id = tm.provider where tm.enable_module = '1'";
			
			} elseif ($this->type == 'training_module_disablexx') {

				$this->title = 'Prasarana Printis Training Module Disable';
				$this->WSTitle = 'Training Module';
				$this->sql = "Select tm.id 'Training Id', tm.code 'Training Code', tm.title 'Training Title', tc.category 'Training Category', tm.total_days 'Days', tm.total_hours 'Hours', tm.max_sit 'Max Capacity', tm.eligibility 'Who Can Apply', tm.enable_module 'Status (1=Enable; 0=Disable)', tp.provider_name 'Training Provider', tm.audience 'Target Audience', tm.cost 'Cost Per Head', bonding 'Staff Bonding (1=Yes; 0=No)' from training_module tm left join training_category tc on tm.category = tc.id left join training_provider tp on tp.id = tm.provider  where tm.enable_module = '0'";
			
			} elseif ($this->type == 'staff_profile') {

				$this->title = 'Prasarana Printis Staff Profile';
				$this->WSTitle = 'Staff Profile';
				$this->sql = "Select staff_no 'Employee no', staff_name 'Complete name', email 'Email Address', grade 'Job Grade', position 'Position', personal_area 'Personnel area', org_group 'Group' , division 'Division' , department 'Department', section 'Section', unit 'Unit', personal_subarea 'Personnel subarea', employee_subgroup 'Employee subgroup', status 'Employment status', organization_unit 'Organizational unit' , depoh_admin_email 'Admin Depoh Email', secretary_email 'Secretaty/Admin Email Address', appr_no 'Approver Staff No', appr_email 'Approver Email Address', appr_name 'Approver Name', super_no 'Supervisor Staff No', super_email 'Supervisor Email Address', super_name 'Supervisor Name' from emp_info";

			} elseif ($this->type == 'hr_training_calendar') {

				$this->title = 'Prasarana Printis Training Calendar';		
				$this->WSTitle = 'Training Calendar';
				$this->sql = "Select ts.id 'Training Id', ts.code 'Training Code', ts.title 'Training Title', tc.category 'Training Category', ts.total_days 'Days', ts.total_hours 'Hours', ts.max_sit 'Max Capacity', ts.eligibility 'Who Can Apply', ts.enable_schedule 'Status (1=Enable; 0=Disable)', tp.provider_name 'Training Provider', tl.main_location 'Main Location', tl.sub_location 'Sub Location', ts.audience 'Target Audience', ts.cost 'Cost Per Head', bonding 'Staff Bonding (1=Yes; 0=No)', ts.date_start 'Date Start', ts.date_end 'Date End', ts.time_start 'Time Start', ts.time_end 'Time End' from training_schedule ts left join training_category tc on ts.category = tc.id left join training_provider tp on tp.id = ts.provider left join training_location tl on tl.id = ts.location ";

				$sd_fname = 'date_start';
				$ed_fname = 'date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];

				//print_r($_SESSION);

				$ed_val = date('Y-m-d', strtotime($ed_val . ' - 1 day'));
				$this->subtitle = ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
 
				if ($sd_val == $ed_val ) {
					$this->sql .= " where ((" . $sd_fname . " <= '" . $sd_val ."' and " . $ed_fname . " >='" . $ed_val . "'))";

				} else {
					$this->sql .= " where ((" . $sd_fname . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "'))";
				}

				if ($condition != '') {
					$this->sql .= " and " . $condition . " order by " . $sd_fname ;
				}

				//echo $this->sql;
				//die();
			
			} elseif ($this->type == 'training_schedule') {

				$this->title = 'Prasarana Printis Training Schedule';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = ' - Active Training Schedule';


				$this->sql = "Select ts.id 'Training Id', ts.code 'Training Code', ts.title 'Training Title', tc.category 'Training Category', ts.total_days 'Days', ts.total_hours 'Hours', ts.max_sit 'Max Capacity', ts.eligibility 'Who Can Apply', ts.enable_schedule 'Status (1=Enable; 0=Disable)', tp.provider_name 'Training Provider', tl.main_location 'Main Location', tl.sub_location 'Sub Location', ts.audience 'Target Audience', ts.cost 'Cost Per Head', bonding 'Staff Bonding (1=Yes; 0=No)', ts.date_start 'Date Start', ts.date_end 'Date End', ts.time_start 'Time Start', ts.time_end 'Time End' from training_schedule ts left join training_category tc on ts.category = tc.id left join training_provider tp on tp.id = ts.provider left join training_location tl on tl.id = ts.location ";

				$sd_fname = 'date_start';
				$ed_fname = 'date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
				
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} else {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') {
					$this->sql .= "where (" . $ed_fname  . ">= '" . $sd_val. "' ) ";

				} elseif ($sd_val == $ed_val) {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "'))";

				} elseif ($ed_val == '' ) {
					$this->sql .= "where (" . $ed_fname . ">= '" . $sd_val . "' ) ";

				} elseif ($sd_val == '' ) {
					$this->sql .= "((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname  . " between '" . $sd_val ."' and '" . $ed_val . "'))";
				} else {
					$this->sql .= "where ((" . $sd_fname . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "'))";
				}

				if ($condition != '') {
					$this->sql .= " and " . $condition . " order by " . $sd_fname ;
				}
				
				
			} elseif ($this->type == 'training_schedule_complete') {

				$this->title = 'Prasarana Printis Training Schedule';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = ' - Complete Training Schedule';


				$this->sql = "Select ts.id 'Training Id', ts.code 'Training Code', ts.title 'Training Title', tc.category 'Training Category', ts.total_days 'Days', ts.total_hours 'Hours', ts.max_sit 'Max Capacity', ts.eligibility 'Who Can Apply', ts.enable_schedule 'Status (1=Enable; 0=Disable)', tp.provider_name 'Training Provider', tl.main_location 'Main Location', tl.sub_location 'Sub Location', ts.audience 'Target Audience', ts.cost 'Cost Per Head', bonding 'Staff Bonding (1=Yes; 0=No)', ts.date_start 'Date Start', ts.date_end 'Date End', ts.time_start 'Time Start', ts.time_end 'Time End' from training_schedule ts left join training_category tc on ts.category = tc.id left join training_provider tp on tp.id = ts.provider left join training_location tl on tl.id = ts.location ";

				$sd_fname = 'date_start';
				$ed_fname = 'date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$today = $_SESSION['today'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($today)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} else {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->sql .= "where (" . $ed_fname . " <=  '" . $ed_val . "' ) ";

				} elseif ($sd_val == $ed_val) {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) and " . $ed_fname ." <= '" . $today . "' ";

				} elseif ($ed_val == '' ) {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) and " . $ed_fname ." <= '" . $today . "' ";

				} elseif ($sd_val == '' ) {
					$this->sql .= "where (" . $ed_fname .   " <= '" . $ed_val . "' ) ";

				} else {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) and " . $ed_fname ." <= '" . $today . "' ";
				}

				if ($condition != '') {
					$this->sql .= " and " . $condition . " order by " . $sd_fname ;
				}
				
	
				
			} elseif ($this->type == 'training_schedule_cancel') {
				$this->training_schedule_cancel();				
				
			} elseif ($this->type == 'staff_bonding') {
				$this->staff_bonding();
			
			} elseif ($this->type == 'training_application_all_staff') {
				$this->training_application_all_staff();
			
			} elseif ($this->type == 'training_application_internal_participant') {
				$this->training_application_internal_participant();
			
			} elseif ($this->type == 'training_application_external_participant') {
				$this->training_application_external_participant();
			
			} elseif ($this->type == 'tna_report') {
				$this->tna_report();

			} elseif ($this->type == 'training_participant') {
				$this->training_participant();

			} elseif ($this->type == 'training_application_active_dept') {
				$this->training_application_active();
			
			} elseif ($this->type == 'training_application_active_name') {
				$this->training_application_active();
			
			} elseif ($this->type == 'training_application_active_external') {
				$this->training_application_active_external();
			
			} elseif ($this->type == 'training_application_inactive_completed') {
				$this->training_application_inactive_completed();
			
			} elseif ($this->type == 'training_application_inactive_cancel') {
				$this->training_application_inactive_cancel();
			
			} elseif ($this->type == 'training_application_inactive_reject') {
				$this->training_application_inactive_reject();
			
			} elseif ($this->type == 'training_application_inactive_external') {
				$this->training_application_inactive_external();
			
			} elseif ($this->type == 'trainer_assessment') {
				$this->trainer_assessment();
			
			} elseif ($this->type == 'supervisor_assessment') {
				$this->supervisor_assessment();
			
			} elseif ($this->type == 'training_evaluation') {
				$this->training_evaluation();
			
			} 


			return;
		}  

		private function training_schedule_cancel() {

			$this->title = 'Prasarana Printis Training Schedule';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = ' - Cancel Training Schedule';


				$this->sql = "Select ts.id 'Training Id', ts.code 'Training Code', ts.title 'Training Title', tc.category 'Training Category', ts.total_days 'Days', ts.total_hours 'Hours', ts.max_sit 'Max Capacity', ts.eligibility 'Who Can Apply', ts.enable_schedule 'Status (1=Enable; 0=Disable)', tp.provider_name 'Training Provider', tl.main_location 'Main Location', tl.sub_location 'Sub Location', ts.audience 'Target Audience', ts.cost 'Cost Per Head', bonding 'Staff Bonding (1=Yes; 0=No)', ts.date_start 'Date Start', ts.date_end 'Date End', ts.time_start 'Time Start', ts.time_end 'Time End' from training_schedule ts left join training_category tc on ts.category = tc.id left join training_provider tp on tp.id = ts.provider left join training_location tl on tl.id = ts.location ";

				$sd_fname = 'date_start';
				$ed_fname = 'date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$today = $_SESSION['today'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->sql .= "where " . $condition;
					$condition = '';
					$this->subtitle = '';

				} elseif ($sd_val == $ed_val) {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) ";

				} elseif ($ed_val == '' ) {
					$this->sql .= "where " . $sd_fname  . " >= '" . $sd_val ."' ";

				} elseif ($sd_val == '' ) {
					$this->sql .= "where (" . $ed_fname .   " <= '" . $ed_val . "' ) ";

				} else {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) ";
				}

				if ($condition != '') {
					$this->sql .= " and " . $condition . " order by " . $sd_fname ;
				}
				
		}


		private function staff_bonding() {

				$this->title = 'Prasarana Printis Staff Bonding';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';


				$this->sql = "select ta.fullname 'Staff Name', ta.staff_no 'Staff ID', ta.position 'Position', ta.division 'Division', ta.department 'Department', ts.total_hours 'Total Hours', ts.code 'Course Code', ts.title 'Course Name', ts.date_start 'Training Date (Start)', ts.date_end 'Training Date (End)', concat(ta.total_attend, '/', ta.total_days) 'Attendance'   from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";

					 //tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.bonding, ts.training_provider 

				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->sql .= "where " . $condition;
					$condition = '';
					$this->subtitle = '';

				} elseif ($sd_val == $ed_val) {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) ";

				} elseif ($ed_val == '' ) {
					$this->sql .= "where " . $sd_fname  . " >= '" . $sd_val ."' ";

				} elseif ($sd_val == '' ) {
					$this->sql .= "where (" . $ed_fname .   " <= '" . $ed_val . "' ) ";

				} else {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) ";
				}

				if ($condition != '') {
					$this->sql .= " and " . $condition . " order by " . $sd_fname ;
				}

				//die($this->sql);
				
		}

		private function training_application_all_staff() {

				$this->title = 'Prasarana Printis Staff Training Application';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';


				$this->sql = "select ta.fullname 'Staff Name', ta.staff_no 'Staff ID', ta.position 'Position', ta.division 'Division', ta.department 'Department', ts.total_hours 'Total Hours', ts.code 'Course Code', ts.title 'Course Name', ts.date_start 'Training Date (Start)', ts.date_end 'Training Date (End)', concat(ta.total_attend, '/', ta.total_days) 'Attendance'   from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";

					 //tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.bonding, ts.training_provider 

				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->sql .= "where " . $condition;
					$condition = '';
					$this->subtitle = '';

				} elseif ($sd_val == $ed_val) {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) ";

				} elseif ($ed_val == '' ) {
					$this->sql .= "where " . $sd_fname  . " >= '" . $sd_val ."' ";

				} elseif ($sd_val == '' ) {
					$this->sql .= "where (" . $ed_fname .   " <= '" . $ed_val . "' ) ";

				} else {
					$this->sql .= "where ((" . $sd_fname  . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "')) ";
				}

				if ($condition != '') {
					$this->sql .= " and " . $condition . " order by " . $sd_fname ;
				}

				//die($this->sql);
				
		}

		private function training_application_internal_participant() {

				$this->title = 'Prasarana Printis Internal Training Application';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';

				$this->sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.code, ts.title as training_title, ts.bonding, ts.training_provider from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";


				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 				
 				$this->sql .= "where " . $condition;
		}

		private function training_application_external_participant() {

				$this->title = 'Prasarana Printis External Training Application';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';

				$this->sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.code, ts.title as training_title, ts.bonding, ts.training_provider from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";


				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];

				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 				
 				$this->sql .= "where " . $condition;
		}

		private function training_application_active() {

				$this->title = 'Prasarana Printis Staff Training Application (Active Training)';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';


				$this->sql = "select ta.fullname 'Staff Name', ta.staff_no 'Staff ID', ta.position 'Position', ta.division 'Division', ta.department 'Department', ts.total_hours 'Total Hours', ts.code 'Course Code', ts.title 'Course Name', ts.date_start 'Training Date (Start)', ts.date_end 'Training Date (End)', concat(ta.total_attend, '/', ta.total_days) 'Attendance'   from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";

					 //tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.bonding, ts.training_provider 

				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->subtitle = '';
				} 

				$this->sql .= " where " . $condition . " order by " . $sd_fname ;
				//die($this->sql);
				
		}

		private function training_application_active_external() {

				$this->title = 'Prasarana Printis External Participant Training Application (Active Training)';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';


				$this->sql = "select ta.fullname 'Participant Name', ta.company 'Company', ta.department 'Department', ts.total_hours 'Total Hours', ts.code 'Course Code', ts.title 'Course Name', ts.date_start 'Training Date (Start)', ts.date_end 'Training Date (End)', concat(ta.total_attend, '/', ta.total_days) 'Attendance'   from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";

					 //tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.bonding, ts.training_provider 

				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->subtitle = '';
				} 

				$this->sql .= " where " . $condition . " order by " . $sd_fname ;
				//die($this->sql);
				
		}

		private function training_participant() {

			$this->title = 'TRAINING ATTENDANCE';

			$this->WSTitle = 'Attendance List';

			$this->sql = "Select ta.staff_no, ta.fullname, ta.department, ta.position, ta.attendance, ts.*, tp.trainer_name, tap.provider_name, tas.main_location, tas.sub_location from training_application ta inner join training_schedule ts on ta.sch_id = ts.id left join  trainer_profile tp on ts.trainer_id = tp.id left join training_provider tap on tap.id = ts.provider left join training_location tas on tas.id = ts.location where  sch_id = '" . $_SESSION['sch_id'] . "' and ta.status in ('Approve')";


		}

		private function tna_report() {

			$group_by = '';
			$this->title = 'MASTER TNA SUMMARY '. $_SESSION['year']. ') ';

			$this->WSTitle = 'TNA Form';


			$this->sql = "Select count(code) total, code, title, max_sit, total_days from training_schedule where enable_schedule = '1'  ";

			if (isset($_SESSION['trainingcategory'])) {
				if ($_SESSION['trainingcategory'] != '')
					$this->sql .= "and category = '" . $_SESSION['trainingcategory'] . "' ";
			}

			$group_by = 'group by code, title;';

			$this->sql .= $group_by;
			//echo $this->sql;
			
		}

		public function _get_tna_department($sql = '') {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$sql = "Select distinct department from training_application where (year(date_start) = '" . $_SESSION['year'] . "' or year(date_end) = '" . $_SESSION['year'] . "') and division = '" .  $_SESSION['division'] . "' ";

			if (isset($_SESSION['department'])) {
				if ($_SESSION['department'] != '')
					$sql .= "and department = '" . $_SESSION['department'] . "' ";
			}

			if (isset($_POST['section'])) {
				if ($_SESSION['section'] != '')
					$sql .= "and section = '" . $_SESSION['section'] . "' ";
			}

			if (isset($_POST['unit'])) {
				if ($_SESSION['unit'] != '')
					$sql .= "and unit = '" . $_SESSION['unit'] . "' ";
			}			


			$data = $this->get_all_record($sql);
			
			$this->process_complete();
			
			return $data;

		}

		
		public function tna_report_department($code) {

			$group_by = '';

			if (isset($_SESSION['position_tna'])) {
				$this->sql = "Select  count(ta.staff_no) total, ta.department, ta.position from training_application ta inner join training_schedule ts on ts.id = ta.sch_id where ts.enable_schedule = '1' and code = '" . $code ."' and (YEAR (ts.date_start) = '" . $_SESSION['year']. "' or year(ts.date_end) = '". $_SESSION['year'] . "') and ta.status = 'Approve' and division = '". $_SESSION['division'] ."' ";

					$group_by = 'group by ta.department, ta.position;';
			} else {

				$this->sql = "Select  count(ta.staff_no) total, ta.department from training_application ta inner join training_schedule ts on ts.id = ta.sch_id where ts.enable_schedule = '1' and code = '" . $code ."' and (YEAR (ts.date_start) = '" . $_SESSION['year']. "' or year(ts.date_end) = '". $_SESSION['year'] . "') and ta.status = 'Approve' and division = '". $_SESSION['division'] ."' ";

					$group_by = 'group by ta.department;';
			}


			if (isset($_SESSION['department'])) {
				if ($_SESSION['department'] != '')
					$this->sql .= "and department = '" . $_SESSION['department'] . "' ";
			}

			if (isset($_POST['section'])) {
				if ($_SESSION['section'] != '')
					$this->sql .= "and section = '" . $_SESSION['section'] . "' ";
			}

			if (isset($_POST['unit'])) {
				if ($_SESSION['unit'] != '')
					$this->sql .= "and unit = '" . $_SESSION['unit'] . "' ";
			}
			

		if (isset($_POST['unit']))
			$_SESSION['unit'] = $_POST['unit'];

			$this->sql .= $group_by;
			//echo $this->sql;
			//die();
			$data = $this->_get_all_record($this->sql);
			return $data;
		}

		private function training_application_inactive_completed() {

				$this->title = 'Prasarana Printis Staff Training Application (Completed In-Active Training)';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';


				$this->sql = "select ta.fullname 'Staff Name', ta.staff_no 'Staff ID', ta.position 'Position', ta.division 'Division', ta.department 'Department', ts.total_hours 'Total Hours', ts.code 'Course Code', ts.title 'Course Name', ts.date_start 'Training Date (Start)', ts.date_end 'Training Date (End)', concat(ta.total_attend, '/', ta.total_days) 'Attendance'   from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";

					 //tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.bonding, ts.training_provider 

				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->subtitle = '';
				} 

				$this->sql .= " where " . $condition . " order by " . $sd_fname ;
				//die($this->sql);
				
		}

		private function training_application_inactive_cancel() {

				$this->title = 'Prasarana Printis Staff Training Application (Canceled In-Active Training)';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';


				$this->sql = "select ta.fullname 'Staff Name', ta.staff_no 'Staff ID', ta.position 'Position', ta.division 'Division', ta.department 'Department', ts.total_hours 'Total Hours', ts.code 'Course Code', ts.title 'Course Name', ts.date_start 'Training Date (Start)', ts.date_end 'Training Date (End)', ta.cancel_status 'Remarks'   from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";

					 //tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.bonding, ts.training_provider 

				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->subtitle = '';
				} 

				$this->sql .= " where " . $condition . " order by " . $sd_fname ;
				//die($this->sql);
				
		}

		private function training_application_inactive_reject() {

				$this->title = 'Prasarana Printis Staff Training Application (Rejected In-Active Training)';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';


				$this->sql = "select ta.fullname 'Staff Name', ta.staff_no 'Staff ID', ta.position 'Position', ta.division 'Division', ta.department 'Department', ts.total_hours 'Total Hours', ts.code 'Course Code', ts.title 'Course Name', ts.date_start 'Training Date (Start)', ts.date_end 'Training Date (End)'   from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";

					 //tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.bonding, ts.training_provider 

				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->subtitle = '';
				} 

				$this->sql .= " where " . $condition . " order by " . $sd_fname ;
				//die($this->sql);
				
		}

		private function training_application_inactive_external() {

				$this->title = 'Prasarana Printis External Participant Training Application (In-Active Training)';		
				$this->WSTitle = 'Training Schedule ';
				$this->subtitle = '';


				$this->sql = "select ta.fullname 'Participant Name', ta.company 'Company', ta.department 'Department', ts.total_hours 'Total Hours', ts.code 'Course Code', ts.title 'Course Name', ts.date_start 'Training Date (Start)', ts.date_end 'Training Date (End)', concat(ta.total_attend, '/', ta.total_days) 'Attendance'   from training_application ta left join training_schedule ts on ta.sch_id = ts.id left join training_provider tp on ts.provider = tp.id left join training_location tl on ts.location = tl.id left join training_category tc on ts.category = tc.id ";

					 //tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request, tl.details as location_detail, tc.category as training_category, ts.bonding, ts.training_provider 

				$sd_fname = 'ts.date_start';
				$ed_fname = 'ts.date_end';
				$sd_val = $_SESSION['from'];
				$ed_val = $_SESSION['to'];
				$condition = $_SESSION['condition'];
			
				if ($ed_val == '') {
					$this->subtitle .= ' (From: ' . date('d-m-Y', strtotime($sd_val)) . ')';
				} elseif($sd_val == '') {
					$this->subtitle .= ' (Before: ' . date('d-m-Y', strtotime($ed_val)) . ')';
				} elseif ($ed_val != '' && $sd_val != '') {
					$this->subtitle .= ' (' . date('d-m-Y', strtotime($sd_val)) . ' To ' . date('d-m-Y', strtotime($ed_val)) . ')';
				}
 
				if ($sd_val =='' && $ed_val == '') { 
					$this->subtitle = '';
				} 

				$this->sql .= " where " . $condition . " order by " . $sd_fname ;
				//die($this->sql);
				
		}

		private function trainer_assessment () {

			$this->title = 'Prasarana Printis Trainer Assessment (Complete Assessment)';		
			$this->WSTitle = 'Trainer Assessment ';
			$this->subtitle = '';

			$this->sql = "select ta.*,  te.assessment_date, te.*, tpl.trainer_name,  tc.category as training_category, ts.code, ts.title, ts.date_start, ts.date_end from training_application ta inner join trainer_eval te on ta.id = te.app_id inner join training_schedule ts on ta.sch_id = ts.id inner join trainer_profile tpl on tpl.id = ts.trainer_id left join training_category tc on ts.category = tc.id 
				WHERE  " . $_SESSION['condition'];  

		} 

		private function training_evaluation() {

			$this->title = 'Prasarana Printis Training Evaluation (Complete Evaluation)';		
			$this->WSTitle = 'Training Evaluation ';
			$this->subtitle = '';

			$this->sql = "select ta.*,  te.assessment_date, te.*, tpl.trainer_name,  tc.category as training_category, ts.code, ts.title, ts.date_start, ts.date_end from training_application ta inner join eval te on ta.id = te.app_id inner join training_schedule ts on ta.sch_id = ts.id left join trainer_profile tpl on tpl.id = ts.trainer_id left join training_category tc on ts.category = tc.id 
				WHERE  " . $_SESSION['condition'];  


		}

		private function supervisor_assessment() {

			$this->title = 'Prasarana Printis Supervisor Assessment (Complete Assessment)';		
			$this->WSTitle = 'Supervisor Assessment';
			$this->subtitle = '';

			$this->sql = "select ta.*,  te.assessment_date, te.*, tpl.trainer_name,  tc.category as training_category, ts.code, ts.title, ts.date_start, ts.date_end from training_application ta inner join super_eval te on ta.id = te.app_id inner join training_schedule ts on ta.sch_id = ts.id left join trainer_profile tpl on tpl.id = ts.trainer_id left join training_category tc on ts.category = tc.id 
				WHERE  " . $_SESSION['condition'];  
		}
		
	}




?>