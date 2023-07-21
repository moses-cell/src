<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(__FILE__) . '/shared/b_global_parameter.php';

	if (isset($_POST['staff_name'])) {
		$isInternal = true;
		$param = new b_global_parameter();
		$data = $param->list_staff_name($_POST['staff_name']);
		echo $data;
		return;	
	}

	if (isset($_POST['intern_name'])) {
		$isInternal = true;
		$param = new b_global_parameter();
		$data = $param->list_intern_name($_POST['intern_name']);
		echo $data;
		return;	
	}

	if (isset($_POST['get_department'])) {
		$isInternal = true;
		$param = new b_global_parameter();
		$data = $param->list_department($_POST['department'],$_POST['division']);
		echo $data;
		return;	
	}

	if (isset($_POST['get_training_title'])) {
		$isInternal = true;
		$param = new b_global_parameter();
		$form_data = $param->list_training_title($_POST['sdate'],$_POST['edate']);
		$data = json_encode($form_data,JSON_HEX_APOS);
		print_r($data);
		return;	
	}



	if (isset($_POST['get_division'])) {
		$isInternal = true;
		$param = new b_global_parameter();
		$data = $param->list_division($_POST['division']);
		echo $data;
		return;	
	}

	if (isset($_POST['get_section'])) {
		$isInternal = true;
		$param = new b_global_parameter();
		$data = $param->list_section($_POST['section'],$_POST['department'],$_POST['division']);
		echo $data;
		return;	
	}

	if (isset($_POST['get_unit'])) {
		$isInternal = true;
		$param = new b_global_parameter();
		$data = $param->list_unit($_POST['unit'],$_POST['section'],$_POST['department'],$_POST['division']);
		echo $data;
		return;	
	}

	if (isset($_POST['get_position_tna_division'])) {
		
		$param = new b_global_parameter();
		$form_data = $param->checkbox_position_by_division_for_tna($_POST['year'],$_POST['division']);
		
		$data = json_encode($form_data,JSON_HEX_APOS);
		print_r($data);
		//echo $data;
		return;	
	}

	
	function _select_option_training_category($isDisable = false) {
		$param = new b_global_parameter();
		$data = $param->select_option_training_category($isDisable);
		return $data;

	}

	function _select_option_month() {
		$param = new b_global_parameter();
		$data = $param->select_option_month();
		return $data;

	}

	function _select_option_year() {
		$param = new b_global_parameter();
		$data = $param->select_option_year();
		return $data;

	}


	function _select_option_department() {
		$param = new b_global_parameter();
		$data = $param->select_option_department();
		return $data;

	}

	function _select_option_food_preferences() {
		$param = new b_global_parameter();
		$data = $param->select_option_food_preferences();
		return $data;

	}

	function _select_option_trainer() {
		$param = new b_global_parameter();
		$data = $param->select_option_trainer();
		return $data;

	}

	function _select_option_sec_name() {
		$param = new b_global_parameter();
		$data = $param->select_option_sec_name();
		return $data;

	}

	function _select_option_depoh_admin_name() {
		$param = new b_global_parameter();
		$data = $param->select_option_depoh_admin_name();
		return $data;

	}

	function _select_option_training_provider() {
		$param = new b_global_parameter();
		$data = $param->select_option_training_provider();
		return $data;

	}

	function _json_training_provider() {
		$param = new b_global_parameter();
		$data = $param->json_training_provider();
		$data = json_encode($data,JSON_HEX_APOS);
		print_r($data);
		//return $data;

	}

	function _checkbox_target_audience($bol_disable = false) {

		$param = new b_global_parameter();
		$data = $param->checkbox_target_audience($bol_disable);
		echo $data;
	}

	function _checkbox_training_evaluation ($bol_disable=false, $isTrainer = false, $isExternal = false) {
		$param = new b_global_parameter();
		$data = $param->checkbox_training_evaluation($bol_disable, $isTrainer, $isExternal);
		echo $data;
	}

	function _checkbox_who_can_apply ($bol_disable=false) {
		$param = new b_global_parameter();
		$data = $param->checkbox_who_can_apply($bol_disable);
		echo $data;
	}

	function _radio_roles_registration() {
		
		$data = '';

		if ($_SESSION['Admin'] == 'Yes') {
			$data = '<div class="form-check-inline">
                <input class="form-check-input" type="radio" name="roles" id="roles_admin" value="Admin" checked>
                <label class="form-check-label" for="roles_admin">Admin</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="roles" id="roles_hr_admin" value="HR Admin">
                <label class="form-check-label" for="roles_hr_admin">HR Admin</label>
            </div>';
		} elseif ($_SESSION['HR Admin'] == 'Yes') {
			$data = '<div class="form-check-inline">
                <input class="form-check-input" type="radio" name="roles" id="roles_hr_admin" value="HR Admin">
                <label class="form-check-label" for="roles_hr_admin">HR Admin</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="roles" id="roles_secretary" value="Unit Secretary">
                <label class="form-check-label" for="roles_secretary">Unit Secretary</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="roles" id="roles_bus_admin" value="Bus Depoh Admin">
                <label class="form-check-label" for="roles_bus_admin">Bus Depoh Admin</label>
            </div>
             <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="roles" id="roles_rail_admin" value="Rail Depoh Admin">
                <label class="form-check-label" for="roles_rail_admin">Rail Depoh Admin</label>
            </div>';
		}



		return $data;
	}


	function get_current_month_year() {

		$m = date('F');
		$y = date('Y');

		return $m . ' ' . $y;

	}

	function get_current_year() {

		
		$y = date('Y');

		return  $y;




	}
?>