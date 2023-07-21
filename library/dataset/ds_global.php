<?php
/*	require_once dirname(dirname(__FILE__)) . '/dataprovider.php';

	class global_base extends dataprovider {

		protected $param;
		protected $log_param;

		public function __construct() {
			parent::__construct();
			$this->db_connection();
			$this->db_beginTransaction();

			//echo "global_base";
		}

		public function set_param($key, $value) {

			if (!(is_array($this->param))) {
				$this->param = array();
			} 

			$this->param[$key] = $value;

		}

		public function set_log_param ($className, $functionName, $lineCode) {


			$this->log_param = [
				'user_name' => $_SESSION['full_name'],
				'obj_class' => $className,
				'obj_function' => $functionName,
				'obj_line' => $lineCode
			];


		}

		public function session() {
			$s = new php_session();
			if ($s->is_expired() == false) {
				$form_data = [];
				$form_data['errors'] = "";
				$form_data['session'] = "expired";
				$form_data['success'] = false;
				echo json_encode($form_data);
				return false;
			}
			return true;
		}

		public function validate_value ($fieldname, $default, $type = '') {

			if($type == '') {
				if (isset($_POST[$fieldname])) {
					if (trim($_POST[$fieldname]) == '')
						return $default;

					return $_POST[$fieldname];
				}
				else
					return $default;

			} elseif ($type == 'date') {
				if (isset($_POST[$fieldname])) {
					if (trim($_POST[$fieldname]) == '')
						return null;

					return $this->format_dbdate($_POST[$fieldname]);
				}
				else
					return null;
			} elseif ($type == 'time') {
				if (isset($_POST[$fieldname])) {
					if (trim($_POST[$fieldname]) == '')
						return null;

					return $_POST[$fieldname];
				}
				else
					return null;
			}
		} 

		public function db_connect() {
			$this->db_connection();
			$this->db_beginTransaction();
		}

		public function begin_transaction(){
			$this->db_beginTransaction();	
		}

		public function commit() {
			$this->db_commit();
		}

		public function update_log($param) {
			$result = $this->db_insert("userlog", $param);
			return $this->rows;
		}

		public function get_sql() {
			return $this->sql;
		}

		public function get_param() {
			return $this->param;
		}

		public function close_connection() {
			$this->db_close_connection();
		}

		public function process_complete() {
			$this->db_commit();
			$this->db_close_connection();
		}

		public function rollback() {
			$this0->db_rollback();
		}

		public function format_dbdate($dt) {

			$parts = explode('-',$dt);
			$dt = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
			return $dt;

		}


	}
*/

	require_once dirname(dirname(__FILE__)) . '/dataprovider.php';

	//require_once '../class/csession.php';

	class global_base extends dataprovider {

		protected $param;
		protected $log_param;
		protected $order_by;

		public function __construct() {
			parent::__construct();
			//$this->data = new dataprovider;
			//$this->data->init();
			$this->db_connection();
			$this->db_beginTransaction();
			$this->order_by = "";

		}

		public function set_log_param ($className, $functionName, $lineCode) {
			$this->log_param = [
				'user_name' => $_SESSION['full_name'],
				'obj_class' => $className,
				'obj_function' => $functionName,
				'obj_line' => $lineCode
			];


		}

		public function session() {
			$s = new php_session();
			if ($s->is_expired() == false) {
				$form_data = [];
				$form_data['errors'] = "";
				$form_data['session'] = "expired";
				$form_data['success'] = false;
				echo json_encode($form_data);
				return false;
			}
			return true;
		}

		public function get_active_process() {

			$this->param = [
				"start_date" => date('Y-m-d'),
				"end_date" => date('Y-m-d'),
				];

			//$this->param = [];
			
			$this->sql = "Select * from pm_process where start_date <= :start_date and end_date >= :end_date order by id desc";
			//$this->sql = "Select * from pm_process order by id desc limit 1";
			$data = $this->db_select("", $this->param,$this->sql,$this->log_param);

			return $data;
		}

		public function check_default($post_value, $type, $default = null, $format = '', $value_search = '', $value_set = '', $fieldname = '') {


			if (is_array($post_value) == false) {
				if (trim($post_value) == '')
					return $default;
			} 

			if($type == '') {				
				
				return $post_value;

			} elseif ($type == 'number') {
				
				if (is_numeric($post_value))
					return $post_value;
				else
					return $default;

			} elseif ($type == 'text') {
				
				return $post_value;

			} elseif ($type == 'date') {

				return $this->format_dbdate($post_value, $format);

			} elseif ($type == 'time') {
				
				return $this->format_dbtime($post_value, $format);

			} elseif ($type == 'checkbox') {
				//if ($format == '')
				//echo $post_value;
				return $this->checkbox_validate($post_value, $default, $format, $value_search, $value_set, $fieldname);
			}
				
			return $post_value;
		}


		public function validate_value ($fieldname, $type='', $default=null, $format = '', $value_search = '', $value_set = '') {

			//echo ($fieldname . '=' . $_POST[$fieldname]); 
			//print_r($_POST[$fieldname]);
			//echo  '</br>';

			if (isset($_POST[$fieldname]) == false)
				return $default;
			else 
				return $this->check_default($_POST[$fieldname], $type, $default, $format, $value_search, $value_set, $fieldname );

			
		} 

		public function validate_value_array ($array, $index, $type='', $default=null, $format = '', $value_search = '', $value_set = '') {

			//echo ($fieldname . '=' . $_POST[$fieldname]); 
			//print_r($_POST[$fieldname]);
			//echo  '</br>';

			if (isset($array[$index]) == false)
				return $default;
			else 
				return $this->check_default($array[$index], $type, $default, $format, $value_search, $value_set);

			
		} 

		function merge_param($fieldname, $fieldvalue, $fieldtype) {

			if ($this->check_default($fieldvalue, $fieldtype) != 'NULL')
				$this->param = array_merge($this->param, [$fieldname => $fieldvalue]);	
		}

		function create_log($process, $type, $comment, $row_id) {

			$this->set_log_param("global_base",__FUNCTION__, __LINE__);
			$this->param = [
				"log_process" => $process,
				"log_table" => $type,
				"log_desc" => $comment,
				"log_id" => $row_id,
				"log_datetime" => date('Y-m-d H:i:s'),
				"log_staff_name" => $_POST['staff_name'],
				];


				$data = $this->db_insert("log", $this->param, $this->log_param);
		}

		public function current_datetime() {
			return date('Y-m-d H:i:s');
		}

		public function db_connect() {
			$this->db_connection();
			$this->db_beginTransaction();
		}

		public function begin_transaction(){
			$this->db_beginTransaction();	
		}

		public function commit() {
			$this->db_commit();
		}

		public function update_log($param) {
			$result = $this->db_insert("userlog", $param);
			return $this->rows;
		}

		public function get_sql() {
			return $this->sql;
		}


		public function set_order_by ($order_by) {
			$this->order_by = $order_by;
		}


		public function get_order_by () {
			return $this->order_by;
		}


		public function get_param() {
			return $this->param;
		}

		public function close_connection() {
			$this->db_close_connection();
		}

		public function process_complete() {
			$this->db_commit();
			$this->db_close_connection();
		}

		public function rollback() {
			$this->db_rollback();
		}

		public function get_last_id () {
			return $this->last_id;
		}

		public function format_dbdate($dt, $format) {

			//echo $dt;
			//echo $format;

			if ($format == 'dd-mm-yyyy') {
				$parts = explode('-',$dt);
				$dt = $parts[2] . '-' . $parts[1] . '-' . $parts[0];

			} elseif ($format == 'dd/mm/yyyy') {
				$parts = explode('/',$dt);
				$dt = $parts[2] . '-' . $parts[1] . '-' . $parts[0];

			}

			return $dt;

		}

		public function format_dbtime($dt, $format) {

			if ($format == 'hh:mm p') {
				$parts = explode(':',$dt);

				$dt = date('H:i:s',strtotime($dt));

			} 

			return $dt;

		}

		public function checkbox_validate($post_value, $default, $format, $value_search, $value_set, $fieldname = '') {

			if ($format == 'array') {
				if (array_search($value_search, $post_value) !== false)
					return $value_set;
				else
					return $default;
			} elseif ($format == 'array_implode') {
				if (is_array($post_value)) {
					
					return implode(', ', $post_value);
				}
				else
					return $post_value;
			} else {
				if ($post_value == $value_search) {
					return $value_set;
				}
				else
					return $default;
			}

		}

		public function error_generator($err_no, $bol_json = false) {

			$err = "";
			if ($err_no == 1) {
				$err = 'Error TAS001 - Staff record not found in the system.';
			} elseif ($err_no == 2) {
				$err = 'Error TAS002 - Training schedule record not found in the system.';
			} elseif ($err_no == 3) {
				$err = 'Error TAS003 - You are not authorize to apply for this training.';
			} elseif ($err_no == 4) {
				$err = 'Error TAS004 - This training is not for your job grade.';
			} elseif ($err_no == 5) {
				$err = 'Error TAS005 - You have training registered for the selected date';
			} elseif ($err_no == 6) {
				$err = 'Error TAS006 - There is an error while trying to create record for your training application';
			} elseif ($err_no == 7) {
				$err = 'Error TAS007 - Internal trainer staff no already registered in the system';
			} elseif ($err_no == 8) {
				$err = 'Error TAS008 - External trainer email already registered in the system';
			} elseif ($err_no == 9) {
				$err = 'Error TAS009 - There is an error while saving Trainer Profile';
			} elseif ($err_no == 10) {
				$err = 'Error TAS010 - There is an error while update internal trainer login information';
			} elseif ($err_no == 11) {
				$err = 'Error TAS011 - Trainer profile record is saved but there is an error while updating trainer picture';
			} elseif ($err_no == 12) {
				$err = 'Error TAS012 - Trainer employement history must be saved after employement profile being save';
			} elseif ($err_no == 13) {
				$err = 'Error TAS013 - There is an error while saving Trainer Employement';
			} elseif ($err_no == 14) {
				$err = 'Error TAS014 - Error occur while deleting Trainer Employement record';
			} elseif ($err_no == 15) {
				$err = 'Error TAS015 - Unable to continue process requested. Please contact HR Administrator for clarification';
			} elseif ($err_no == 16) {
				$err = 'Error TAS016 - Unable to process training application approval.';
			} elseif ($err_no == 17) {
				$err = 'Error TAS017 - Unable to process training application cancellation.';
			} elseif ($err_no == 18) {
				$err = 'Error TAS018 - Unable to register external participant';
			} elseif ($err_no == 19) {
				$err = 'Error TAS019 - Unable to update external participant information';
			} elseif ($err_no == 20) {
				$err = 'Error TAS020 - External participant information not found';
			} elseif ($err_no == 21) {
				$err = 'Error TAS021 - There is an error while registering external participant login information';
			} elseif ($err_no == 22) {
				$err = 'Error TAS022 - The participant alreay registered a training for the selected date.';
			} elseif ($err_no == 23) {
				$err = 'Error TAS023 - Staff no already registered for the selected date.';
			} elseif ($err_no == 24) {
				$err = 'Error TAS024  - There is an error while updating staff information';
			} elseif ($err_no == 25) {
				$err = 'Error TAS025  - There is an error while updating supervisor assessment';
			} elseif ($err_no == 26) {
				$err = 'Error TAS026  - There is an error while submitting course evaluation';
			} elseif ($err_no == 27) {
				$err = 'Error TAS027  - Training registered record not found in the system.';
			} elseif ($err_no == 28) {
				$err = 'Error TAS028  - Training application had reached maximum number of participant.';
			}


			if ($bol_json) {
				$form_data['errors'] = $err;	
				$form_data['success'] = false;
				echo json_encode($form_data);
			} else {
				return $err;
			}
 
		}

		function array_change_value_case($input, $ucase) {

			//echo $input;

			$case = $ucase;
			$narray = array();
			if (!is_array($input)) {
				return ($case == CASE_UPPER ? strtoupper($input) : strtolower($input));//$narray;
			}
			foreach ($input as $key => $value) {
				if (is_array($value)) {
					$narray[$key] = array_change_value_case($value, $case);
					continue;
				}
				$narray[$key] = ($case == CASE_UPPER ? strtoupper($value) : strtolower($value));
			}
			return $narray;
		}

	}



?>