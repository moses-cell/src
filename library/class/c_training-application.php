<?php

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_training-application.php';

	class c_training_application extends ds_training_application {

		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
		}

		public function _get_training_schedule($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_schedule($id);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_training_schedule_by_date($date) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_schedule_by_date($date);
			
			$this->process_complete();
			
			return $data;


		}


		public function _get_training_history($sdate, $staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_history($sdate, $staff_no);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_training_participant_list($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_participant_list($id);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_pending_approval($staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_pending_approval($staff_no);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_pending_evaluation($staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_pending_evaluation($staff_no);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_external_pending_evaluation($username) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_external_pending_evaluation($username);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_pending_assessment($staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_pending_assessment($staff_no);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_supervisor_pending_assessment($date) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_supervisor_pending_assessment($date);
			
			$this->process_complete();
			
			return $data;


		}

		

		public function _get_pending_trainer_assessment($trainer_id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_pending_trainer_assessment($trainer_id);
			
			$this->process_complete();
			
			return $data;


		}


		public function _get_training_applied($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_applied($id);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_training_registered($training_data, $staff_data) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_registered($training_data, $staff_data);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_external_participant_training_registered($training_data, $ep_data) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_external_participant_training_registered($training_data, $ep_data);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_training_registered_by_staff_schedule_id($staff_no, $schedule_id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_training_registered_by_staff_schedule_id($staff_no, $schedule_id);
			
			$this->process_complete();
			
			return $data;


		}

		public function _get_participant_list($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_participant_list($id);
			
			$this->process_complete();
			
			return $data;
		}

		public function _get_approve_participant_list($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_approve_participant_list($id);
			
			$this->process_complete();
			
			return $data;
		}

		public function _get_trainer_participant_list($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_trainer_participant_list($id);
			
			$this->process_complete();
			
			return $data;
		}

		public function _get_trainer_participant_list_result($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_trainer_participant_list_result($id);
			
			$this->process_complete();
			
			return $data;
		}

		public function _get_participant_list_unit($id, $secretary_email) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_participant_list_unit($id, $secretary_email);
			
			$this->process_complete();
			
			return $data;
		}

		public function _get_participant_list_depoh($id, $depoh_admin_staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_participant_list_depoh($id, $depoh_admin_staff_no);
			
			$this->process_complete();
			
			return $data;
		}

		public function _submit_staff_training_for_approval($training_data, $staff_data) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->submit_staff_training_for_approval($training_data, $staff_data);
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _submit_staff_external_training($staff_data) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->create_training_schedule();
			if ($data > 0) {
				
				$_POST['sch_id'] = $this->last_id;

				$data = $this->submit_staff_external_training($staff_data);
				if ($data > 0) {
					$_POST['id'] = $this->last_id;
					$this->process_complete();
					return true;
				}
				
			}

			//$data = $this->submit_staff_training_for_approval($staff_data);
			
			/*if ($data > 0)	{
				$this->process_complete();
				return true;
			} */

			$this->close_connection();
			return false;

		}

		public function _submit_and_cancel_staff_training_by_trainer($training_data, $staff_data, $staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->submit_staff_training_by_trainer($training_data, $staff_data, $staff_no);
			
			if ($data > 0)	{
			
				$data = $this->cancel_staff_training_by_trainer($training_data, $staff_data, $staff_no);

				if ($data > 0)	{
					$this->process_complete();
					return true;
				}
			} 

			$this->close_connection();
			return false;

		}

		public function _create_training_for_external_participant($training_data, $ep_data) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->create_training_for_external_participant($training_data, $ep_data);
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _approve_decision($isBonding = false, $updateOtherInfo = false) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			


			$data = $this->approve_decision();
			
			if ($data > 0)	{

				if ($isBonding) {
					$data = $this->update_bonding();
				}

				if ($updateOtherInfo) {
					$data = $this->update_other_info();
				}

				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		

		public function _reject_cancel_decision() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->reject_cancel_decision();
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _approve_decision_cancel() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->approve_decision_cancel();
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _submit_for_cancellation() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->submit_for_cancellation();
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _auto_training_cancellation() {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->auto_training_cancellation();
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _auto_approve_staff_training($training_data, $staff_data) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->auto_staff_training_for_approval($training_data, $staff_data);
			
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;


		}

		/*public function _get_staff_info($staff_no) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_staff_info($staff_no);
			
			$this->process_complete();
			
			return $data;


		}*/

		/*public function _save_training_schedule () {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->save_training_schedule();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}*/

		public function _get_participant_attendance($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->get_participant_attendance($id);
			
			$this->process_complete();
			
			return $data;



		}

		public function _update_participant_attendance ($id, $attendance, $total) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->update_participant_attendance ($id, $attendance, $total);
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _trainer_cancel_participant_registration ($id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->trainer_cancel_participant_registration ($id);
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _cancel_participant_registration ($id,$reason) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->cancel_participant_registration ($id, $reason);
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}

		public function _trainer_reinstate_participant_registration($staff_no, $replace_staff_no, $sch_id) {

			$functionName = __FUNCTION__;

			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->trainer_reinstate_participant_registration($staff_no, $replace_staff_no, $sch_id);
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 
			$this->close_connection();
			return false;

		}


		public function _update_filename() {

			$functionName = __FUNCTION__;
			$this->db_connect();
			$this->set_log_param($this->className,$functionName, __LINE__);
			
			$data = $this->update_filename();
			if ($data > 0)	{
				$this->process_complete();
				return true;
			} 

			$this->close_connection();
			return false;

		}



	}




?>