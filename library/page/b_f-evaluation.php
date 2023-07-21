<?php
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)). '/class/c_hr-training-schedule.php';



	$_SESSION['page_id'] = '';
	$_SESSION['eval_id'] = '';
	$data = '';
	$button = '';
	$disable = '';
	if (isset($_GET['id'])) {

		$id = $glib->encrypt_decrypt('decrypt', $_GET['id'], 'id');

		$training = new c_training_application();
		$training_data = $training->_get_training_applied($id);


		if (count($training_data) > 0) {

			$result = ['Data'=>$training_data];
			$data = json_encode($result,JSON_HEX_APOS);
			$_SESSION['page_id'] = $_GET['id'];
			$button = '<button class="btn btn-prasarana btnsave" type="button" id="submit">Submit Evaluation</button> <button class="btn btn-prasarana btnclose" type="button" id="close">Close</button>';

			if (strpos($_SERVER['PHP_SELF'], 'f-supervisor-assessment.php') !== false) {
				if ($training_data[0]['super_eval'] != '1') {
					$button = '<button class="btn btn-prasarana btnclose" type="button" id="close">Close</button>';
					$result = ['Data'=>array()];
					$data = json_encode($result,JSON_HEX_APOS);
				}

			} elseif (strpos($_SERVER['PHP_SELF'], 'f-course-evaluation.php') !== false) {
				if ($training_data[0]['eval'] != '1') {
					$button = '<button class="btn btn-prasarana btnclose" type="button" id="close">Close</button>';
					$result = ['Data'=>array()];
					$data = json_encode($result,JSON_HEX_APOS);
				}
				
			} elseif (strpos($_SERVER['PHP_SELF'], 'f-trainer-assessment.php') !== false) {
				if ($training_data[0]['trainer_eval'] != '1') {
					$button = '<button class="btn btn-prasarana btnclose" type="button" id="close">Close</button>';
					$result = ['Data'=>array()];
					$data = json_encode($result,JSON_HEX_APOS);
				}
			}

		} else {
			$button = '<button class="btn btn-prasarana btnclose" type="button" id="close">Close</button>';

		}

	
	} else {
		if (strpos($_SERVER['PHP_SELF'], 'f-supervisor-assessment.php') !== false) {

			if (isset($_GET['eval'])) {
				require_once dirname(dirname(__FILE__)). '/class/c_super_assessment.php';
				$id = $glib->encrypt_decrypt('decrypt', $_GET['eval'], 'id');
				$training = new c_super_assessment();
				$training_data = $training->_get_super_assessment_by_id($id);
				$result = ['Data'=>$training_data];
				//print_r($result);
				$data = json_encode($result,JSON_HEX_APOS);
				$_SESSION['page_id'] = "";
				$_SESSION['eval_id'] = $_GET['eval'];
				$button = '<button class="btn btn-prasarana btnclose" type="button" id="close">Close</button>';
				$disable = 'disabled';
				
			} else 
	 			header('location:'.'dashboard.php');
			

		} elseif (strpos($_SERVER['PHP_SELF'], 'f-course-evaluation.php') !== false) {
			
			if (isset($_GET['eval'])) {
				require_once dirname(dirname(__FILE__)). '/class/c_course_evaluation.php';
				
				$id = $glib->encrypt_decrypt('decrypt', $_GET['eval'], 'id');
				
				$training = new c_course_evaluation();
				$training_data = $training->_get_course_evaluation_by_id($id);
				$result = ['Data'=>$training_data];
				//print_r($result);
				$data = json_encode($result,JSON_HEX_APOS);
				$_SESSION['page_id'] = "";
				$_SESSION['eval_id'] = $_GET['eval'];
				$button = '<button class="btn btn-prasarana btnclose" type="button" id="close">Close</button>';
				$disable = 'disabled';

			} else 
	 			header('location:'.'dashboard.php');

		} elseif (strpos($_SERVER['PHP_SELF'], 'f-trainer-assessment.php') !== false) {
			
			if (isset($_GET['eval'])) {
				require_once dirname(dirname(__FILE__)). '/class/c_trainer_assessment.php';
				
				$id = $glib->encrypt_decrypt('decrypt', $_GET['eval'], 'id');
				$training = new c_trainer_assessment();
				$training_data = $training->_get_trainer_assessment_by_id($id);
				$result = ['Data'=>$training_data];
				//print_r($result);
				$data = json_encode($result,JSON_HEX_APOS);
				$_SESSION['page_id'] = "";
				$_SESSION['eval_id'] = $_GET['eval'];
				$button = '<button class="btn btn-prasarana btnclose" type="button" id="close">Close</button>';
				$disable = 'disabled';
			} else 
	 			header('location:'.'dashboard.php');

		}

	}



	if (!isset($_GET['id']) && !(isset($_GET['eval'])))
		header('location:'.'dashboard.php');

?>