  <?php
	require_once 'ds_global.php';

	
	class ds_hr_training_schedule extends global_base {

		private $data;
		private $table;
		private $className;

		protected function __construct() {
			parent::__construct();
			$this->table = "training_schedule";
			$this->className = __CLASS__;
		}

		protected function get_tablename () {
			return $this->table;
		}

		protected function training_schedule_info($id) {

			$this->param = [
				"id" => $id,
				];
			
			$this->sql = "";

			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_select($this->table, $this->param,$this->sql,$this->log_param);

			return $data;
		}


		protected function save_training_schedule () {


			$data = $this->training_schedule_info($_POST['id']);

			$this->param = [
				"code" =>  $this->array_change_value_case($_POST['coursecode'],CASE_UPPER),
				"title" => $this->array_change_value_case($_POST['title'],CASE_UPPER),
				"description" => $this->array_change_value_case($_POST['description'],CASE_UPPER),
				"category" => $this->validate_value('trainingcategory','text',null),
				"provider" => $this->validate_value('trainingprovider', 'number', null),
				"total_days" => $this->validate_value('tdays','number','0'),
				"cost" => $this->validate_value('cost','number','0'),
				"total_hours" => $this->validate_value('thours','number','0'),
				"eligibility" => $this->validate_value('eligibility', 'checkbox', null, 'array_implode' ),
				"max_sit" => $this->validate_value('max_sit','number','0'),
				"remarks" => $_POST['remarks'],
				"eval" => 1,
				"super_eval" => $this->validate_value('super_eval','number','0'),
				"trainer_eval" => $this->validate_value('trainer_eval','number','0'),
				"date_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy'),
				"date_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy'),
				"time_start" => $this->validate_value('stime','time',null, 'hh:mm p'),
				"time_end" => $this->validate_value('etime','time',null, 'hh:mm p'),
				"date_modified" => date('Y-m-d H:i:s'),
				"location" => $this->validate_value('traininglocation','number',null),
				"approval" => $this->validate_value('aprroval_process','text','1'),
				"audience" => $this->validate_value('target_audience', 'checkbox', null, 'array_implode' ),
				"filename" => $this->validate_value('filename','',null,'','','',"filename"),
				"enable_schedule" => $this->validate_value('enable_process', 'checkbox', '0','','1','1' ),
				"bonding" => $this->validate_value('bonding', 'checkbox', '0','','1','1' ),
				"trainer_id" => $this->validate_value('trainer','number','0'),

			];

			//print_r($this->param);
			//die();

			if ($this->validate_value('id','') != '')
				$this->param = array_merge($this->param, ['id' => $_POST['id']]);

			$key = "id =:id ";	

			if(count($data) > 0){
				
				$param_compare = [
					"date_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy'),
					"date_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy'),
					"time_start" => $this->validate_value('stime','time',null, 'hh:mm p'),
					"time_end" => $this->validate_value('etime','time',null, 'hh:mm p'),
				];
				if ($this->db_data_compare($data[0],$param_compare) == false ) {
					$_POST['date_change'] = '1';
					//echo 'date_change';
				}

				$param_compare = [
					"trainer_id" => $this->validate_value('trainer','number',null),
				];
				if ($this->db_data_compare($data[0],$param_compare) == false ) {
					$_POST['trainer_change'] = '1';
					$_POST['previous_trainer'] = $data[0]['trainer_id'];
					//echo 'trainer_change';
				}

				if ($this->db_data_compare($data[0],$this->param)) {
					//echo 'sss';
					$this->rows = 1;
				} else {
					$this->param = array_merge($this->param, ['modified_by' => $this->validate_value('editor_name','text',null)]);
					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
				}
					
			} else {
				$this->param = array_merge($this->param, ['created_by' => $this->validate_value('editor_name','text',null)]);
				$this->param = array_merge($this->param, ['module_id' => $this->validate_value('module_id','text',null)]);
				$this->param = array_merge($this->param, ['request_id' => $this->validate_value('request_id','text',null)]);

				
				$this->set_log_param($this->className,__FUNCTION__, __LINE__);
				$data = $this->db_insert($this->table, $this->param, $this->log_param, true, false );
				$_POST['id'] = $this->last_id;


			}
			//echo $this->rows;
			return $this->rows;





		}

		protected function cancel_training_schedule () {


			$data = $this->training_schedule_info($_POST['id']);

			if (isset($_POST['description'])) {
				$this->param = [
					"code" => $_POST['coursecode'],
					"title" => $_POST['title'],
					"description" => $_POST['description'],
					"category" => $_POST['trainingcategory'],
					"provider" => $this->validate_value('trainingprovider', 'number', null),
					"total_days" => $this->validate_value('tdays','number','0'),
					"cost" => $this->validate_value('cost','number','0'),
					"total_hours" => $this->validate_value('thours','number','0'),
					"eligibility" => $this->validate_value('eligibility', 'checkbox', null, 'array_implode' ),
					"max_sit" => $this->validate_value('max_sit','number','0'),
					"remarks" => $_POST['remarks'],
					"eval" => 1,
					"super_eval" => $this->validate_value('super_eval','number','0'),
					"trainer_eval" => $this->validate_value('trainer_eval','number','0'),
					"date_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy'),
					"date_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy'),
					"time_start" => $this->validate_value('stime','time',null, 'hh:mm p'),
					"time_end" => $this->validate_value('etime','time',null, 'hh:mm p'),
					"date_modified" => date('Y-m-d H:i:s'),
					"location" => $this->validate_value('traininglocation','number',null),
					"approval" => $this->validate_value('aprroval_process','text','1'),
					"audience" => $this->validate_value('target_audience', 'checkbox', null, 'array_implode' ),
					"filename" => $this->validate_value('filename','',null,'','','',"filename"),
					"enable_schedule" => $this->validate_value('enable_process', 'text', null ),
					"bonding" => $this->validate_value('bonding', 'checkbox', '0','','1','1' ),
					"trainer_id" => $this->validate_value('trainer','number','0'),

				];
			} else {
				$this->param = [
					"date_modified" => date('Y-m-d H:i:s'),
					"enable_schedule" => $this->validate_value('enable_process', 'text', null ),			
				];
			}

			

			if ($this->validate_value('id','') != '')
				$this->param = array_merge($this->param, ['id' => $_POST['id']]);

			$key = "id =:id ";	


			if(count($data) > 0){
				
				
				$param_compare = [
					"date_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy'),
					"date_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy'),
					"time_start" => $this->validate_value('stime','time',null, 'hh:mm p'),
					"time_end" => $this->validate_value('etime','time',null, 'hh:mm p'),
				];
				if ($this->db_data_compare($data[0],$param_compare) == false ) {
					$_POST['date_change'] = '1';
					//echo 'date_change';
				}

				$param_compare = [
					"trainer_id" => $this->validate_value('trainer','number',null),
				];
				if ($this->db_data_compare($data[0],$param_compare) == false ) {
					$_POST['trainer_change'] = '1';
					$_POST['previous_trainer'] = $data[0]['trainer_id'];
					//echo 'trainer_change';
				}

				if ($this->db_data_compare($data[0],$this->param)) {
					//echo 'sss';
					$this->rows = 1;
				} else {
					$this->param = array_merge($this->param, ['modified_by' => $this->validate_value('editor_name','text',null)]);
					$this->set_log_param($this->className,__FUNCTION__, __LINE__);
					$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false);
				}
					
			} 
			
			//echo $this->rows;
			return $this->rows;

		}


		protected function update_participant_training_date() {

			$this->param = [
				"trainer_id" => $this->validate_value('trainer','number',null),
				"sch_id" => $_POST['id'],
				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $this->validate_value('editor_name','text', null),
				"eval" => 1,
				"super_eval" => $this->validate_value('super_eval','number','0'),
				"trainer_eval" => $this->validate_value('trainer_eval','number','0'),
				"date_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy'),
				"date_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy'),
				"time_start" => $this->validate_value('stime','time',null, 'hh:mm p'),
				"time_end" => $this->validate_value('etime','time',null, 'hh:mm p'),
				"dt_start" => $this->validate_value('sdate','date',null, 'dd-mm-yyyy') . ' ' . $this->validate_value('stime','time',null, 'hh:mm p'),
				"dt_end" => $this->validate_value('edate','date',null, 'dd-mm-yyyy') . ' ' . $this->validate_value('etime','time',null, 'hh:mm p'),
			];

			$key = "sch_id =:sch_id";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update('training_application', $this->param, $key, $this->log_param, false);
			return $this->rows;


		}

		protected function hr_cancel_participant($bol_TrainingCancel) {

			$status = "Training Cancel Due To Schedule Disable";
			if ($bol_TrainingCancel)
				$status = "Training Cancel Due To Schedule Cancel";

			$this->param = [
				"status" => "Cancel",
				"cancel_status" => $status,
				"sch_id" => $_POST['id'],
				"date_modified" => date('Y-m-d H:i:s'),
				"modified_by" => $this->validate_value('editor_name','text', null),
				
			];

			$key = "sch_id =:sch_id and status != 'Cancel'";
			$this->set_log_param($this->className,__FUNCTION__, __LINE__);
			$data = $this->db_update('training_application', $this->param, $key, $this->log_param);
			return $this->rows;


		}

	


		protected function update_filename() {
						
			$this->param = [
				"id" => $_POST['id'],
				"filename" => $_POST['filename'],
			];

			$key = 'id = :id';
			$data = $this->db_update($this->table, $this->param, $key, $this->log_param, false );
			return $this->rows;

		}

	}


?>