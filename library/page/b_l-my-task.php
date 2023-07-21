<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(dirname(__FILE__)). '/class/c_training-application.php';


	$glib = new globalLibrary();
	$hr_sc = new c_training_application();

	$pending_approval = '';
	$pending_evaluation = '';
	$pending_assessment = '';
	$pending_trainer_assessment = '';
	$tbody = '';
	//print_r ($_SESSION);

	if ($_SESSION['user_type'] == 'internal') {

		$rec = $hr_sc->_get_pending_approval($_SESSION['staff_no']);

		if (count($rec) > 0) {

			$class = "odd";

			foreach ($rec as $row) {

				$code = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
				$edit = '<a href="f-training-application-details.php?id=' . $code .'">' .			  
	  					'<img src="assets/img/edit.png" alt="View Training Application" style="width:16px;height:16px;" title="View Training Application"></a>';

				$tbody .= "<tr>";
				$tbody .= "<td>". $edit."</td>";
				$tbody .= "<td>". $row['staff_no']."</td>";
				$tbody .= "<td>". $row['fullname']."</td>";
				$tbody .= "<td>". $row['training_title']."</td>";

				$sDate = strtotime($row['date_start']);
				$tbody .= "<td>". date('d/m/Y',$sDate)."</td>";

				$eDate = strtotime($row['date_end']);
				$tbody .= "<td>". date('d/m/Y',$eDate)."</td>";
			
				$tbody .= "<td>". $row['total_days']."</td>";
				$tbody .= "<td>". $edit."</td>";

				$tbody .= "</tr>";

				if ($class = "odd")
					$class = 'even';
				else
					$class = 'odd';
			}
			
			$pending_approval = $tbody;

		}

		$pending_evaluation = '';
		$tbody = '';
		$rec = $hr_sc->_get_pending_evaluation($_SESSION['staff_no']);

		if (count($rec) > 0) {

			$class = "odd";

			foreach ($rec as $row) {

				$code = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
				$edit = '';

				$edit = '<a href="f-course-evaluation.php?id=' . $code .'">' .			  
		  			'<img src="assets/img/edit.png" alt="Training Evaluation" style="width:16px;height:16px;" title="Training Evaluation"></a>';	
				$tbody .= "<tr>";
				$tbody .= "<td>". $edit."</td>";
				$tbody .= "<td>". $row['staff_no']."</td>";
				$tbody .= "<td>". $row['fullname']."</td>";
				$tbody .= "<td>". $row['training_title']."</td>";

				$sDate = strtotime($row['date_start']);
				$tbody .= "<td>". date('d/m/Y',$sDate)."</td>";

				$eDate = strtotime($row['date_end']);
				$tbody .= "<td>". date('d/m/Y',$eDate)."</td>";
			
				$tbody .= "<td>". 'Training Evaluation'."</td>";
				

				$tbody .= "<td>". $edit."</td>";

				$tbody .= "</tr>";

				if ($class = "odd")
					$class = 'even';
				else
					$class = 'odd';
			}
			
			$pending_evaluation = $tbody;

		}

		$pending_assessment = '';
		$tbody = '';
		$rec = $hr_sc->_get_pending_assessment($_SESSION['staff_no']);

		if (count($rec) > 0) {

			$class = "odd";

			foreach ($rec as $row) {

				$code = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
				$edit = '';
				$edit = '<a href="f-supervisor-assessment.php?id=' . $code .'">' .			  
  						'<img src="assets/img/edit.png" alt="Supervisor Assessment" style="width:16px;height:16px;" title="Supervisor Assessment"></a>';	

				$tbody .= "<tr>";
				$tbody .= "<td>". $edit."</td>";
				$tbody .= "<td>". $row['staff_no']."</td>";
				$tbody .= "<td>". $row['fullname']."</td>";
				$tbody .= "<td>". $row['training_title']."</td>";

				$sDate = strtotime($row['date_start']);
				$tbody .= "<td>". date('d/m/Y',$sDate)."</td>";

				$eDate = strtotime($row['date_end']);
				$tbody .= "<td>". date('d/m/Y',$eDate)."</td>";
			
				$tbody .= "<td>". 'Supervisor Assessment '."</td>";
				
				

				$tbody .= "<td>". $edit."</td>";

				$tbody .= "</tr>";

				if ($class = "odd")
					$class = 'even';
				else
					$class = 'odd';
			}
			
			$pending_assessment = $tbody;

		}

		if (isset($_SESSION['trainer_id'])) {
			$pending_trainer_assessment = '';
			$tbody = '';
			$rec = $hr_sc->_get_pending_trainer_assessment($_SESSION['trainer_id']);

			$i = 1;
			if (count($rec) > 0) {

				$class = "odd";

				foreach ($rec as $row) {

					$code = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
					$edit = '';
					$edit = '<a href="f-trainer-assessment.php?id=' . $code .'">' .			  
	  						'<img src="assets/img/edit.png" alt="Trainer Assessment" style="width:16px;height:16px;" title="Trainer Assessment"></a>';	

					$tbody .= "<tr>";
					$tbody .= "<td>". $edit."</td>";
					$tbody .= "<td>". $row['staff_no']."</td>";
					$tbody .= "<td>". $row['fullname']."</td>";
					$tbody .= "<td>". $row['training_title']."</td>";

					$sDate = strtotime($row['date_start']);
					$tbody .= "<td>". date('d/m/Y',$sDate)."</td>";

					$eDate = strtotime($row['date_end']);
					$tbody .= "<td>". date('d/m/Y',$eDate)."</td>";
				
					$tbody .= "<td>Trainer Assessment </td>";
					
					

					$tbody .= "<td>". $edit."</td>";

					$tbody .= "</tr>";

					if ($class = "odd")
						$class = 'even';
					else
						$class = 'odd';

					$i++;
				}
				
				$pending_trainer_assessment = $tbody;

			}

		}
	
	} elseif ($_SESSION['user_type'] == 'external') {

		$pending_evaluation = '';
		$tbody = '';
		$rec = $hr_sc->_get_external_pending_evaluation($_SESSION['username']);

		if (count($rec) > 0) {

			$class = "odd";

			foreach ($rec as $row) {

				$code = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
				$edit = '';

				$edit = '<a href="f-course-evaluation.php?id=' . $code .'">' .			  
		  			'<img src="assets/img/edit.png" alt="Training Evaluation" style="width:16px;height:16px;" title="Training Evaluation"></a>';	
				$tbody .= "<tr>";
				$tbody .= "<td>". $edit."</td>";
				$tbody .= "<td>". $row['staff_no']."</td>";
				$tbody .= "<td>". $row['fullname']."</td>";
				$tbody .= "<td>". $row['training_title']."</td>";

				$sDate = strtotime($row['date_start']);
				$tbody .= "<td>". date('d/m/Y',$sDate)."</td>";

				$eDate = strtotime($row['date_end']);
				$tbody .= "<td>". date('d/m/Y',$eDate)."</td>";
			
				$tbody .= "<td>". 'Training Evaluation'."</td>";
				

				$tbody .= "<td>". $edit."</td>";

				$tbody .= "</tr>";

				if ($class = "odd")
					$class = 'even';
				else
					$class = 'odd';
			}
			
			$pending_evaluation = $tbody;

		}

		if (isset($_SESSION['trainer_id'])) {
			$pending_trainer_assessment = '';
			$tbody = '';
			$rec = $hr_sc->_get_pending_trainer_assessment($_SESSION['trainer_id']);

			$i = 1;
			if (count($rec) > 0) {

				$class = "odd";

				foreach ($rec as $row) {

					$code = $glib->encrypt_decrypt('encrypt',$row['id'], 'id');
					$edit = '';
					$edit = '<a href="f-trainer-assessment.php?id=' . $code .'">' .			  
	  						'<img src="assets/img/edit.png" alt="Trainer Assessment" style="width:16px;height:16px;" title="Trainer Assessment"></a>';	

					$tbody .= "<tr>";
					$tbody .= "<td>". $edit."</td>";
					$tbody .= "<td>". $row['staff_no']."</td>";
					$tbody .= "<td>". $row['fullname']."</td>";
					$tbody .= "<td>". $row['training_title']."</td>";

					$sDate = strtotime($row['date_start']);
					$tbody .= "<td>". date('d/m/Y',$sDate)."</td>";

					$eDate = strtotime($row['date_end']);
					$tbody .= "<td>". date('d/m/Y',$eDate)."</td>";
				
					$tbody .= "<td>Trainer Assessment</td>";
					
					

					$tbody .= "<td>". $edit."</td>";

					$tbody .= "</tr>";

					if ($class = "odd")
						$class = 'even';
					else
						$class = 'odd';

					$i++;
				}
				
				$pending_trainer_assessment = $tbody;

			}

		}
	
	} 

	//$pending_assessment = '';
	//$pending_approval = '';
	//$pending_evaluation = '';
	//$pending_assessment = '';

	$tbody = '';
?>