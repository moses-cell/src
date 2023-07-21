<?php
	require_once 'ds_global.php';

	
	class ds_assessment extends global_base {

		private $data;
		private $table;
		private $className;

		public function __construct($table) {
			parent::__construct();
			$this->table = $table;
			$this->className = __CLASS__;
		}

		protected function get_tablename () {
			return $this->table;
		}

		protected function get_super_assessment_by_id($id) {

			$this->sql = "select ta.*, ts.*, tp.provider_name, tl.main_location, tl.sub_location, te.*, ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, t.trainer_name ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "inner join super_eval te on ta.id = te.app_id ";
			$this->sql .= "inner join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "inner join training_category tc on ts.category = tc.id ";
			$this->sql .= "left join trainer_profile t on ts.trainer_id = t.id ";

			$key = "te.id = '". $id ."'";
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param, $this->sql, $this->log_param, $key, false, false);

			return $data;
		}

		protected function get_trainer_assessment_by_id($id) {

			$this->sql = "select ta.*, ts.*, tp.provider_name, tl.main_location, tl.sub_location, te.*, ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, t.trainer_name ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "inner join trainer_eval te on ta.id = te.app_id ";
			$this->sql .= "inner join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "inner join training_category tc on ts.category = tc.id ";
			$this->sql .= "left join trainer_profile t on ts.trainer_id = t.id ";

			$key = "ta.staff_no = '". $_SESSION['staff_no']. "' and ta.trainer_eval > 2";
			$key = "te.id = '". $id ."'";
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param, $this->sql, $this->log_param, $key, false, false);

			return $data;
		}

		protected function get_course_evaluation_by_id($id) {


			$this->sql = "select ta.*, ts.*, tp.provider_name, tl.main_location, tl.sub_location, te.*, ";
			$this->sql .= "tl.details as location_detail, tc.category as training_category, t.trainer_name ";
			$this->sql .= "from training_application ta ";
			$this->sql .= "inner join eval te on ta.id = te.app_id ";
			$this->sql .= "inner join training_schedule ts on ta.sch_id = ts.id ";
			$this->sql .= "left join training_provider tp on ts.provider = tp.id ";
			$this->sql .= "left join training_location tl on ts.location = tl.id ";
			$this->sql .= "inner join training_category tc on ts.category = tc.id ";
			$this->sql .= "left join trainer_profile t on ts.trainer_id = t.id ";

			$key = "ta.staff_no = '". $_SESSION['staff_no']. "' and ta.eval > 2";
			$key = "te.id = '". $id ."'";
			
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select("", $this->param, $this->sql, $this->log_param, $key, false, false);

			return $data;
		}


		protected function submit_super_assessment () {

			$data = array();
			if ($_POST['evalid'] != '') {
				$data = $this->get_super_assessment_by_id($_POST['evalid']);
			}

			$this->param = [
				"app_id" => $_POST['id'],
				"sch_id" => $_POST['sch_id'],
				"super_comment" => $this->validate_value('super_comment','', null),	
				"super_name" => $_POST['super_name'],
				"super_no" => $_POST['super_no'],
				"super_email" => $_POST['super_email'],
				"appr_name" => $_POST['appr_name'],
				"appr_no" => $_POST['appr_no'],
				"appr_email" => $_POST['appr_email'],
				"s1_total" => $_POST['s1total'],
				"s2_total" => $_POST['s2total'],
				"s3_total" => $_POST['s3total'],
				"overall_total" => $_POST['overall'],
				"assessment_date" => date('Y-m-d'),
				"created_by" => $_POST['editor_name'],
				"eval_status" => $_POST['eval_status'],
				"retrain" => $_POST['retrain'],
				"s1" => $_POST['s1'],
				"s2" => $_POST['s2'],
				"s3" => $_POST['s3'],
				"trainer_name" => $_POST['trainer_name'],

			];

			if ($_POST['evalid'] != '') {
				$key = "id = '" .$_POST['evalid'] . "'";	
			}


			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			}
			return $this->rows;

		}

		protected function submit_course_evaluation () {

			$data = array();
			if ($_POST['evalid'] != '') {
				$data = $this->get_course_evaluation_by_id($_POST['evalid']);
			}

			$this->param = [
				"app_id" => $_POST['id'],
				"comments" => $this->validate_value('comment','', null),	
				"s1_total" => $_POST['s1total'],
				"s2_total" => $_POST['s2total'],
				"s3_total" => $_POST['s3total'],
				"overall_total" => $_POST['overall'],
				"assessment_date" => date('Y-m-d'),
				"created_by" => $_POST['editor_name'],
				"s1" => $_POST['s1'],
				"s2" => $_POST['s2'],
				"s3" => $_POST['s3'],
				"sch_id" => $_POST['sch_id'],
				"trainer_name" => $_POST['trainer_name'],

			];

			if ($_POST['evalid'] != '') {
				$key = "id = '" .$_POST['evalid'] . "'";	
			}


			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			}
			return $this->rows;

		}

		protected function submit_trainer_assessment () {

			$data = array();
			if ($_POST['evalid'] != '') {
				$data = $this->get_super_assessment_by_id($_POST['evalid']);
			}

			$this->param = [
				"app_id" => $_POST['id'],
				"sch_id" => $_POST['sch_id'],
				"comments" => $this->validate_value('comment','', null),	
				"s1_total" => $_POST['s1total'],
				"assessment_date" => date('Y-m-d'),
				"created_by" => $_POST['editor_name'],
				"s1" => $_POST['s1'],
				"result_type" => $_POST['result_type'],
				"theory" => $_POST['theory'],
				"practical" => $_POST['practical'],
				"recommendation" => $_POST['recommendation'],
			];

			if ($_POST['result_type'] == 'Qualified Module') {
				$this->param = array_merge($this->param, ["theory_result" => $_POST['theory_result']]);
				$this->param = array_merge($this->param, ["practical_result" => $_POST['practical_result']]);
				$this->param = array_merge($this->param, ["training_result" => $_POST['training_result_qualified']]);

			} elseif ($_POST['result_type'] == 'Refresher Module') {
				$this->param = array_merge($this->param, ["training_result" => $_POST['training_result_refresher']]);

			}


			if ($_POST['evalid'] != '') {
				$key = "id = '" .$_POST['evalid'] . "'";	
			}


			if(count($data) > 0){
				if ($this->db_data_compare($data[0],$this->param)) {
					$this->row = 1;
				}
				else {

					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
				}
					
			} else {
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, false, false );

			}
			return $this->rows;

		}


		protected function update_training_application($col) {
			
			$this->param = [
				$col => '3',
			];

			$key = "id = '" .$_POST['id'] . "'";	
			
			$data = $this->db_update('training_application', $this->param, $key, $this->log_param, false);
			return $this->rows;


		}


	}


?>