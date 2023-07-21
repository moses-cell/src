<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_data_upload.php';

	class c_data_upload extends ds_data_upload {

		private $className;
		private $upload_type;
		private $cell;
		private $bol_match;
		private $xldata;
		private $staff_profile;
		private $training_module;
		private $training_schedule;

		public function __construct($upload_type, $cellIterator) {

			$this->className = __CLASS__;	
			$this->upload_type = $upload_type;
			$this->bol_match = false;
			$this->read_xls_first_col($cellIterator);
			parent::__construct();

		}

		public function read_xls_first_col($cellIterator) {

			$this->cell = [];
			foreach ($cellIterator as $cell) {
			    $this->cell[] = $cell->getValue();
			}
			


			if ($this->upload_type == 'Staff Profile')
				$this->compare_data($this->get_staff_profile_template_title());
			elseif ($this->upload_type == 'Training Module')
				$this->compare_data($this->get_training_module_template_title());
			elseif ($this->upload_type == 'Training Schedule')
				$this->compare_data($this->get_training_schedule_template_title());

			//die();
		}

		private function compare_data($upload_column) {

			for ($i =0; $i < count($upload_column); $i++) {

				if (isset($this->cell[$i])) {
					//echo $i;
					//echo $this->cell[$i].'xx';
					//echo $upload_column[$i] . 'yy';
					if ($this->cell[$i] != $upload_column[$i]) {
						//echo 'not same';
						return;
					}
				} else {
					return;
				}

			}

			$this->bol_match = true;
			return; 
		}

		public function get_match_status() {
			return $this->bol_match;
		}

		protected function get_record($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_record_info($id);
			
			$this->process_complete();
			
			return $data;


		}

		public function _save_record ($cellIterator) {

			$functionName = __FUNCTION__;
			$data = 0;

			$this->xldata = [];
			foreach ($cellIterator as $cell) {
			    $this->xldata[] = $cell->getFormattedValue();
			}
			
			if($this->xldata[0] == '')
				return true;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);

			if ($this->upload_type == 'Staff Profile') {
				$data = $this->upload_staff_profile($this->xldata);
				if ($data > 0) {
					$data = $this->upload_staff_login($this->xldata);
				}
			}
			elseif ($this->upload_type == 'Training Module')
				$data = $this->upload_training_module($this->xldata);
			elseif ($this->upload_type == 'Training Schedule')
				$data = $this->upload_training_schedule($this->xldata);
			
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		private function get_staff_profile_template_title() {
			
			$this->staff_profile = ["Employee no","Complete name","Email Address","Job Grade", "Position","Personnel area","Group","Division","Department","Section","Unit","Personnel subarea","Employee subgroup","Employment status", "Organizational unit","Depoh Admin Staff No","Admin Depoh Email","Secretaty/Admin Staff No","Secretaty/Admin Email Address", "Approver Staff No","Approver Email Address","Approver Name","Supervisor Staff No","Supervisor Email Address","Supervisor Name"];	

			return $this->staff_profile;
		}

		private function get_training_module_template_title() {
			
			$this->training_module = ["Course Code","Training Title","Training Description","Category","Total Days","Total Hours","Maximum Participant","Who Can Apply","Remarks","Provider","Supervisor Assessment","Trainer Assessment","Target Audience","Cost Per Head","Staff Bonding"];	

			return $this->training_module;
		}

		private function get_training_schedule_template_title() {

		//	$this->training_schedule = ["Course Code","Training Title","Training Description","Category","Total Days","Total Hours","Maximum Participant","Who Can Apply","Remarks","Provider","Location","Start Date","End Date","Start Time","End Time","Trainer Id","Approval"];

			$this->training_schedule = ["Course Code","Category","Total Days","Total Hours","Remarks","Provider","Location","Start Date","End Date","Start Time","End Time","Trainer Id"];

			return $this->training_schedule;
		}


	}




?>