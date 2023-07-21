<?php

	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_global_parameter.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';


	class b_global_parameter {


		public function select_option_training_provider() {

			$param = new c_global_parameter();
			$data = $param->get_training_provider();
			$select = "<option value=''>Please select</option>";
			$select .= "<option value='new'>New Training Provider</option>";
			foreach($data as $row){
				if ($row['status'] == '0')
					$select .= "<option value='".$row['id']."' disabled>".$row['provider_name']."</option>";
				else	
					$select .= "<option value='".$row['id']."'>".$row['provider_name']."</option>";
			}
			return $select;
		}

		public function json_training_provider() {

			$param = new c_global_parameter();
			$data = $param->get_training_provider();

			$finaldata = [["label" => "Please select", "value"=> ""], ["label"=>"New Training Provider", "value"=>"new"]];
			/*$select = "<option value=''>Please select</option>";
			$select .= "<option value='new'>New Training Provider</option>";*/
			foreach($data as $row){
			//	$select .= "<option value='".$row['id']."'>".$row['provider_name']."</option>";
				array_push($finaldata, ["label"=> $row['provider_name'] , "value" => $row['id'], "status" =>$row['status'] ]);
			}
			return $finaldata;
		}

		public function select_option_training_category($isDisable) {

			$param = new c_global_parameter();
			$data = $param->get_training_category();

			/*if ($isInternal) {
				
				$select .= "<option value='1'>Soft Skills</option>";
				$select .= "<option value='2'>Functional Training</option>";
				$select .= "<option value='3'>Technical Rail</option>";
				$select .= "<option value='4'>Technical Bus</option>";
			} else {
				$select = "<option value=''>Please select</option>";
				$select .= "<option value='1'>Soft Skills</option>";
				$select .= "<option value='2'>Functional Training</option>";
			}*/
			
			$select = "<option value=''>Please select</option>";
			$disable = '';

			if ($isDisable) {
				foreach($data as $row) {
					$select .= "<option value='".$row['id']."'>".$row['category']."</option>";
				}

			} else {

				foreach($data as $row){

					if ($row['status'] == '1')
						$select .= "<option value='".$row['id']."'>".$row['category']."</option>";
					else
						$disable .= "<option value='".$row['id']."' disabled>".$row['category']." (Disabled)</option>";
				}
			}

			return $select . $disable;
		}

		public function select_option_month() {
			
			$select = "<option value=''>Please select</option>";
			$select .= "<option value='1'>January</option>";
			$select .= "<option value='2'>February</option>";
			$select .= "<option value='3'>March</option>";
			$select .= "<option value='4'>April</option>";
			$select .= "<option value='5'>May</option>";
			$select .= "<option value='6'>June</option>";
			$select .= "<option value='7'>July</option>";
			$select .= "<option value='8'>August</option>";
			$select .= "<option value='9'>September</option>";
			$select .= "<option value='10'>October</option>";
			$select .= "<option value='11'>November</option>";
			$select .= "<option value='12'>December</option>";
			
			return $select;
		}

		public function select_option_year() {
			
			$select = "<option value=''>Please select</option>";

			for ($i = date('Y'); $i >= 2000; $i--) {
				$select .= "<option value='". $i ."'>" . $i . "</option>";
			}
			
			return $select;
		}


		public function select_option_department() {

			$param = new c_global_parameter();
			$data = $param->get_distinct_department();
			$glib = new globalLibrary;

			$select = "<option value=''>Please select</option>";
			foreach($data as $row){


				$dept = $glib->encrypt_decrypt('encrypt', $row['department'],'id');

				$select .= "<option value='".$dept."'>".$row['department']."</option>";
			}
			return $select;
		}

		public function list_staff_name($staff_name) {

			$select = '';
			$param = new c_global_parameter();
			$data = $param->get_staff_info($staff_name);
			if (count($data) > 0) {

				$select = '<ul id="staff_list" class="parameter-list">';
				foreach($data as $row){
					$select .= "<li class='staff_list_item' id='" . $row['staff_no'] . "' email='" . $row['email'] . "' >".$row['staff_name']."</li>";
				}
				$select .= '</ul>';
			}
			
			
			
			return $select;
		}

		public function list_division($division) {

			$select = '';
			$param = new c_global_parameter();
			$data = $param->get_division_info($division);
			if (count($data) > 0) {

				$select = '<ul id="_division_list" class="parameter-list">';
				$select .= "<li class='_division_list_item' id='' value='' >Please Select</li>";
				foreach($data as $row){
					$select .= "<li class='_division_list_item' id='" . $row['division'] . "' value='" . $row['division'] . "' >".$row['division']."</li>";
				}
				$select .= '</ul>';
			}
			
			
			
			return $select;
		}

		public function list_department($department, $division) {

			$select = '';
			$param = new c_global_parameter();
			$data = $param->get_department_info($department, $division);
			if (count($data) > 0) {

				$select = '<ul id="_department_list" class="parameter-list">';
				$select .= "<li class='_department_list_item' id='' value='' >Please Select</li>";
				foreach($data as $row){
					$select .= "<li class='_department_list_item' id='" . $row['department'] . "' value='" . $row['department'] . "' >".$row['department']."</li>";
				}
				$select .= '</ul>';
			}
			
			
			
			return $select;
		}

		public function list_training_title($sdate, $edate) {

			$select = '';
			$param = new c_global_parameter();
			$data = $param->get_training_title($sdate, $edate);
			$select = "<option value=''>Please select</option>";
			//print_r($data);
			if (count($data) > 0) {

				$select = "<option value=''>Please select</option>";
				foreach($data as $row){
					$select .=  "<option value='". $row['title']."'>". $row['title']."</option>";;
				}
				
				$form_data['success'] = true;
				$form_data['trainingtitle'] = $select;
			} else {
				$form_data['success'] = false;
				$form_data['errors'] = 'Training title not found for selected date';
			}
			
			
			
			return $form_data;
		}


		public function list_section($section, $department, $division) {

			$select = '';
			$param = new c_global_parameter();
			$data = $param->get_section_info($section, $department, $division);
			if (count($data) > 0) {

				$select = '<ul id="_section_list" class="parameter-list">';
				$select .= "<li class='_section_list_item' id='' value='' >Please Select</li>";
				foreach($data as $row){
					$select .= "<li class='_section_list_item' id='" . $row['section'] . "' value='" . $row['section'] . "' >".$row['section']."</li>";
				}
				$select .= '</ul>';
			}
			
			
			
			return $select;
		}

		public function list_unit($unit, $section, $department, $division) {

			$select = '';
			$param = new c_global_parameter();
			$data = $param->get_unit_info($unit,$section, $department, $division);
			if (count($data) > 0) {

				$select = '<ul id="_unit_list" class="parameter-list">';
				$select .= "<li class='_unit_list_item' id='' value='' >Please Select</li>";
				foreach($data as $row){
					$select .= "<li class='_unit_list_item' id='" . $row['unit'] . "' value='" . $row['unit'] . "' >".$row['unit']."</li>";
				}
				$select .= '</ul>';
			}
			
			
			
			return $select;
		}

		public function list_intern_name($student_name) {

			$select = '';
			$param = new c_global_parameter();
			$data = $param->get_intern_info($student_name);
			if (count($data) > 0) {

				$select = '<ul id="staff_list" class="parameter-list">';
				foreach($data as $row){

					$name = $row['student_name'];
					$ic = $row['ic_no'];
					$dept = $row['department'];
					$bank = $row['bank_name'];
					$acc = $row['acc_no'];
					$sdate = date('d-m-Y', strtotime($row['date_start']));
					$edate = date('d-m-Y', strtotime($row['date_end']));
					$daily_allowance = $row['monthly_allowance'];
					$mc = $row['mc_allowance'];
					$email = $row['email'];

					$select .= "<li class='staff_list_item' id='" . $ic . "' email='" . $email . "' dept='" . $dept . "' bank='" . $bank . "' acc='" . $acc . "'  sdate='" . $sdate . "'  edate='" . $edate . "'  allowance='" . $daily_allowance . "'  mc='" . $mc . "'>".$name."</li>";
				}
				$select .= '</ul>';
			}
			
			
			
			return $select;
		}

		public function select_option_food_preferences() {

			$param = new c_global_parameter();
			$data = $param->get_food_preferences();
			$select = "<option value=''>Please select</option>";
			foreach($data as $row){
				$select .= "<option value='".$row['id']."'>".$row['meal_type']."</option>";
			}
			return $select;
		}

		public function select_option_trainer() {

			$param = new c_global_parameter();
			$data = $param->get_trainer();
			$select = "<option value=''>Please select</option>";
			foreach($data as $row){
				if ($row['status'] == '0')
					$select .= "<option value='".$row['id']."' disabled>".$row['trainer_name']." (DISABLED)</option>";
				else
					$select .= "<option value='".$row['id']."'>".$row['trainer_name']."</option>";
			}
			return $select;
		}

		public function select_option_depoh_admin_name() {

			$param = new c_global_parameter();
			$data = $param->get_depoh_admin();
			$select = "<option value=''>Please select</option>";
			foreach($data as $row){
				$select .= "<option value='".$row['email']."' staff_no='" . $row['staff_no'] ."'>".$row['staff_name']."</option>";
			}
			return $select;
		}

		public function select_option_sec_name() {

			$param = new c_global_parameter();
			$data = $param->get_sec();
			$select = "<option value=''>Please select</option>";
			foreach($data as $row){
				$select .= "<option value='".$row['email']."' staff_no='" . $row['staff_no'] ."'>".$row['staff_name']."</option>";
			}
			return $select;
		}


		public function select_option_training_main_location_by_provider_id($prov_id) {

			$param = new c_global_parameter();
			$glib =  new globalLibrary();
			$data = $param->get_training_main_location_by_provider_id($prov_id);
			
			$select = "<option value=''>Please select</option>";
			$select .= "<option value='new'>New Main Location</option>";
			foreach($data as $row){
				//$id = $glib->encrypt_decrypt('encrypt',$row['id'],'id');
				$select .= "<option value='".$row['main_location']."' >".$row['main_location']."</option>";
			}
			return $select;
		}

		public function select_option_training_location_by_provider_id($prov_id, $id = '') {

			$param = new c_global_parameter();
			$select = "<option value=''>Please select</option>";
			$select .= "<option value='new training location'>New Training Provider Location</option>";
			$select .= "<option value='new public location'>New public Location</option>";

			if ($prov_id <> "new") {
				$data = $param->get_training_location_by_provider_id($prov_id);
				
				if (count($data) > 0) {
					$select .= "<option value='' disabled>Training Provider Location</option>";
				}
				foreach($data as $row){

					if ($id == $row['id'])
						$selected = 'selected';
					else
						$selected = '';

					if ($row['sub_location'] == "") {
						$select .= "<option value='".$row['id']."' " . $selected ." >".$row['main_location']."</option>";
					} else {
						$select .= "<option value='".$row['id']."' " . $selected .">".$row['main_location']. " - " . $row['sub_location'] . "</option>";
					}
					
				}

			}

			$data = $param->get_training_location_by_provider_id('0');
			if (count($data) > 0) {
				$select .= "<option value='' disabled>Public Training Location</option>";
			}
			foreach($data as $row){

				if ($id == $row['id'])
					$selected = 'selected';
				else
					$selected = '';

				if ($row['sub_location'] == "") {
					$select .= "<option value='".$row['id']."' " . $selected .">".$row['main_location']."</option>";
				} else {
					$select .= "<option value='".$row['id']."' " . $selected .">".$row['main_location']. " - " . $row['sub_location'] . "</option>";
				}
			}
			return $select;
		}

		public function json_training_location_by_provider_id($prov_id) {

			$param = new c_global_parameter();
			
			$finaldata = [
				["label" => "Please select", "value"=> "", "details"=>""], 
				["label"=>"New Training Provider Location", "value"=>"new training location", "details"=>""] , 
				["label"=>"New public Location", "value"=>"new public location", "details"=>""]
			];

			if ($prov_id <> "new") {
				$data = $param->get_training_location_by_provider_id($prov_id);
				if (count($data) > 0) {
					/*array_push($finaldata, 
						["label"=> "Training Provider Location", 
						"value" => "",
						"details" => ""]
					);*/

					foreach($data as $row){

						if ($row['sub_location'] == "") {
							array_push($finaldata, 
								["label"=> $row['main_location'], 
								"value" => $row['id'],
								"details" => $row['details'],
								"status" => $row['status']]
							);
							
						} else {
							array_push($finaldata, 
								["label"=> $row['main_location']. " - " . $row['sub_location'], 
								"value" => $row['id'],
								"details" => $row['details'],
								"status" => $row['status']]
							);
						}
						
					}
				}
			}

			$data = $param->get_training_location_by_provider_id('0');
			if (count($data) > 0) {
				/*array_push($finaldata, 
					["label"=> "Public Training Location", 
					"value" => "",
					"details" => ""]
				);*/

				foreach($data as $row){
					if ($row['sub_location'] == "") {
						array_push($finaldata, 
							["label"=> $row['main_location'], 
							"value" => $row['id'],
							"details" => $row['details'],
							"status" => $row['status']]
						);
							
					} else {
						array_push($finaldata, 
							["label"=> $row['main_location']. " - " . $row['sub_location'], 
							"value" => $row['id'],
							"details" => $row['details'],
							"status" => $row['status']]
						);
					}
						
				}
			}
			
			return ($finaldata);
		}


		public function _get_training_location_detail_by_id($id) {

			$param = new c_global_parameter();
			$data = $param->get_training_location_detail_by_id($id);

			return $data;
			

		}

		public function checkbox_position_by_division_for_tna($year, $division) {

			$param = new c_global_parameter();
			$data = $param->get_position_by_division_for_tna($year, $division);
			$checkbox = '';
			$disable = "";
			$bol_disable = false;

			if ($bol_disable)
				$disable = "disabled";

			if (count($data) > 0) {
				$form_data['success'] = true;
				$form_data['count'] = count($data);

				foreach($data as $row){
					$checkbox .='<div class="form-check form-switch form-check-inline position" style="height:45px;"><input type="checkbox" class="form-check-input " id="' . $row['position'] .'" name="position[]" value="'.$row['position'] .'"  '  . $disable .'><label class="form-check-label" for="' . $row['position'] . ' ">' . $row['position'] . '</label></div>';
				}

				$form_data['div'] = $checkbox;

			} else {
				$form_data['success'] = true;
			}

			
			
			return $form_data;
		}

		public function checkbox_target_audience($bol_disable = false) {

			$param = new c_global_parameter();
			$data = $param->get_target_audience();
			$checkbox = '';
			$disable = "";

			

			foreach($data as $row){
				$disable = "";

				if ($bol_disable) {
					$disable = "disabled";
				}

				if ($row['status'] == '0') {
					$disable = "disabled";
				}
			


				$checkbox .='<div class="form-check form-switch form-check-inline target_audience"><input type="checkbox" class="form-check-input " id="' . $row['grade'] .'" name="target_audience[]" value="'.$row['grade'] .'"  '  . $disable .'><label class="form-check-label" for="' . $row['grade'] . ' ">' . $row['grade'] . '</label></div>';
			}

			if ($bol_disable) {
				$disable = "disabled";
			}

			$checkbox .='<div class="form-check form-switch form-check-inline target_audience"><input type="checkbox" class="form-check-input " id="' . 'ta_AllStaff'. '" ' .  $disable  .' name="target_audience[]" value="All Staff"><label class="form-check-label" for="' . 'ta_AllStaff' .' ">' . 'All Staff' . '</label></div>';
			return $checkbox;
		}

		public function checkbox_training_evaluation($bol_disable , $isTrainer, $isExternal ) {

			$checkbox = '';
			$disable = "";

			if ($bol_disable)
				$disable = "disabled";

			$checkbox = '<div class="form-check form-switch "><input type="checkbox" class="form-check-input " id="eval" name="eval" value="1" checked disabled><label class="form-check-label" for="eval">Training Evaluation</label></div>';
                    

			$checkbox .= '<div class="form-check form-switch "><input type="checkbox" class="form-check-input" id="trainer_eval" name="trainer_eval" value="1" ' . $disable .  '><label class="form-check-label" for="trainer_eval">Student Evaluation by Trainer</label></div>';


			$checkbox .= '<div class="form-check form-switch "><input type="checkbox" class="form-check-input" id="super_eval" name="super_eval" value="1" ' . $disable .  '><label class="form-check-label" for="super_eval">Post Training Evaluation by Supervisor</label></div>';


			if ($isTrainer) {
				$checkbox = '<div class="form-check form-switch "><input type="checkbox" class="form-check-input" id="trainer_eval" name="trainer_eval" value="1" ' . $disable .  '><label class="form-check-label" for="trainer_eval_rail">Student Evaluation by Trainer</label></div>';
			}

			if ($isExternal) {
				$checkbox = '<div class="form-check form-switch "><input type="checkbox" class="form-check-input " id="eval" name="eval" value="1" checked disabled><label class="form-check-label" for="eval">Training Evaluation</label></div>';
			}
			
			return $checkbox;
		}



		public function checkbox_who_can_apply($bol_disable = false) {
			$checkbox = '';
			$disable = "";

			if ($bol_disable)
				$disable = "disabled";

			$checkbox = '<div class="form-check form-switch form-check-inline"><input type="checkbox" class="form-check-input " id="hradmin" name="eligibility[]" value="HR Admin" ' . $disable .'><label class="form-check-label" for="hradmin">HR Admin</label></div>';

            $checkbox .= '<div class="form-check form-switch form-check-inline"><input type="checkbox" class="form-check-input " id="unit_secretary" name="eligibility[]" value="Unit Secretary" '. $disable .'><label class="form-check-label" for="unit_secretary">Unit Secretary</label></div>';

            $checkbox .= '<div class="form-check form-switch form-check-inline"><input type="checkbox" class="form-check-input " id="busdepohadmin" name="eligibility[]" value="Bus Depoh Admin" '. $disable .'><label class="form-check-label" for="busdepohadmin">Bus Depoh Admin</label></div>';

            $checkbox .= '<div class="form-check form-switch form-check-inline"><input type="checkbox" class="form-check-input " id="raildepohadmin" name="eligibility[]" value="Rail Depoh Admin" '. $disable .'><label class="form-check-label" for="raildepohadmin">Rail Depoh Admin</label></div>';

            $checkbox .= '<div class="form-check form-switch form-check-inline"><input type="checkbox" class="form-check-input " id="el_AllStaff" name="eligibility[]" value="All Staff" '. $disable .'><label class="form-check-label" for="el_AllStaff">All Staff</label></div>';

            return $checkbox;
		}


		




	}
	


?>