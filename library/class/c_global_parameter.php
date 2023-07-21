<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_global_parameter.php';

	class c_global_parameter extends ds_global_parameter {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}


		function get_training_provider() {

			$this->set_tablename('training_provider');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by provider_name asc");
			$data = $this->get_parameter_data();
			$this->process_complete();
			
			return $data;


		}


		function get_training_category() {

			$this->set_tablename('training_category');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by category asc");
			$data = $this->get_parameter_data();
			$this->process_complete();
			
			return $data;


		}

		function get_distinct_department() {

			$this->set_tablename('emp_info');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by department asc");
			$sql = "Select distinct department from emp_info ";
			$data = $this->get_parameter_data($sql, array(), "order by department asc");
			$this->process_complete();
			
			return $data;


		}



		function get_food_preferences() {

			$this->set_tablename('food_preferences');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by meal_type");
			$data = $this->get_parameter_data();
			$this->process_complete();
			
			return $data;


		}

		function get_trainer() {

			$this->set_tablename('trainer_profile');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by trainer_name asc");
			$data = $this->get_parameter_data();
			$this->process_complete();
			
			return $data;


		}

		function get_depoh_admin() {

			$this->set_tablename('');

			$this->sql = "Select ur.*, ei.staff_name, ei.email, ei.staff_no from user_roles ur inner join emp_info ei on ei.staff_no = ur.user_name where ur.roles in ('Rail Depoh Admin', 'Bus Depoh Admin') ";


			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by ei.staff_name asc");
			$data = $this->get_parameter_data($this->sql);
			$this->process_complete();
			
			return $data;


		}

		function get_staff_info($staff_name) {

			$this->set_tablename('');

			$this->sql = "Select ei.staff_name, ei.email, ei.staff_no from emp_info ei where ei.staff_name like '%". $staff_name ."%'; ";
			//echo $this->sql;
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by ei.staff_name asc");
			$data = $this->get_parameter_data($this->sql);

			$this->process_complete();
			
			return $data;


		}

		function get_division_info($division) {

			$this->set_tablename('');

			$this->sql = "Select distinct ei.division from emp_info ei ";

			if ($division != '')
				$this->sql .= "where ei.division like '%". $division ."%'; ";

			//echo $this->sql;
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by ei.division asc");
			$data = $this->get_parameter_data($this->sql);

			$this->process_complete();
			
			return $data;
		}

		function get_department_info($department, $division) {

			$this->set_tablename('');

			$this->sql = "Select distinct ei.department from emp_info ei where division='" . $division ."' " ;

			if ($department != '')
				$this->sql .= "and ei.department like '%". $department ."%'; ";

			//echo $this->sql;
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by ei.department asc");
			$data = $this->get_parameter_data($this->sql);

			$this->process_complete();
			
			return $data;
		}

		function get_training_title($sdate, $edate) {

			$this->set_tablename('');

			$this->sql = "Select distinct  title from training_schedule where date_start between '" . $this->validate_value('sdate','date',null, 'dd-mm-yyyy') ."' and '" . $this->validate_value('edate','date',null, 'dd-mm-yyyy') . "';";



			
			//echo $this->sql;
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by title asc");
			$data = $this->get_parameter_data($this->sql);

			$this->process_complete();
			
			return $data;
		}

		/*function get_department_info($department, $division) {

			$this->set_tablename('');

			$this->sql = "Select distinct ei.department from emp_info ei where division='" . $division ."' " ;

			if ($department != '')
				$this->sql .= "and ei.department like '%". $department ."%'; ";

			//echo $this->sql;
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by ei.department asc");
			$data = $this->get_parameter_data($this->sql);

			$this->process_complete();
			
			return $data;
		}*/


		function get_section_info($section, $department, $division) {

			$this->set_tablename('');

			$this->sql = "Select distinct ei.section from emp_info ei where division='" . $division ."' and department ='" . $department . "' " ;

			if ($department != '')
				$this->sql .= "and ei.section like '%". $section ."%'; ";

			//echo $this->sql;
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by ei.section asc");
			$data = $this->get_parameter_data($this->sql);

			$this->process_complete();
			
			return $data;
		}

		function get_unit_info($unit, $section, $department, $division) {

			$this->set_tablename('');

			$this->sql = "Select distinct ei.unit from emp_info ei where division='" . $division ."' and department ='" . $department . "' and section = '" .$section . "' " ;

			if ($department != '')
				$this->sql .= "and ei.unit like '%". $unit ."%'; ";

			//echo $this->sql;
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by ei.unit asc");
			$data = $this->get_parameter_data($this->sql);

			$this->process_complete();
			
			return $data;
		}

		function get_intern_info($student_name) {

			$this->set_tablename('');

			$this->sql = "Select * from intern_info where student_name like '%". $student_name ."%'; ";
			//echo $this->sql;
			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by student_name asc");
			$data = $this->get_parameter_data($this->sql);

			$this->process_complete();
			
			return $data;


		}

		function get_sec() {

			$this->set_tablename('');

			$this->sql = "Select ur.*, ei.staff_name, ei.email, ei.staff_no from user_roles ur inner join emp_info ei on ei.staff_no = ur.user_name where ur.roles in ('Unit Secretary') ";

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$this->set_order_by ("order by ei.staff_name asc");
			$data = $this->get_parameter_data($this->sql);
			$this->process_complete();
			
			return $data;


		}

		function get_training_main_location_by_provider_id($prov_id) {

			$this->set_tablename('training_location');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$sql = "Select distinct training_provider_id, main_location from training_location ";
			$param = ["training_provider_id" => $prov_id];
			$data = $this->get_parameter_data($sql, $param);
			$this->process_complete();
			
			return $data;


		}

		function get_training_location_by_provider_id($prov_id) {

			$this->set_tablename('training_location');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$param = ["training_provider_id" => $prov_id];
			$data = $this->get_parameter_data("", $param);
			$this->process_complete();
			
			return $data;


		}

		function get_training_location_detail_by_id($id) {

			$this->set_tablename('training_location');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$param = ["id" => $id];
			$data = $this->get_parameter_data("", $param);
			$this->process_complete();
			
			return $data;


		}

		function get_position_by_division_for_tna($year, $division) {

			$this->set_tablename('training_application');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$param = array();
			$this->sql = "SELECT distinct position FROM training_application where (year(date_start) = " . $year . " or year(date_end) = " . $year . ") and division = '" .$division . "'";
			$data = $this->get_parameter_data($this->sql, $param);
			$this->process_complete();
			

			return $data;


		}

		function get_target_audience() {

			$this->set_tablename('emp_grade');

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			$data = $this->get_parameter_data();
			$this->process_complete();
			
			return $data;


		}

	}


?>