<?php
	
	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(__FILE__) . '/shared/b_session.php';
	require_once dirname(__FILE__) . '/shared/b_global_parameter.php';
	require_once dirname(dirname(__FILE__)). '/class/c_dashboard.php';

	$glib = new globalLibrary();
	$c_dashboard = new c_dashboard();

	

	if (isset($_POST['form_process'])) {

		if ($_POST['form_process'] == 'schedule') {

			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_training_schedule(date('Y-m-').'1', date('Y-m-'). $date->format('d'));
			
			$total = 0;
			if (count($data) > 0)
				$total = $data[0]['total_schedule'];

			
			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'admin_schedule') {

			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_yearly_training_schedule(date('Y'));
			
			$total = 0;
			if (count($data) > 0)
				$total = $data[0]['total_schedule'];

			
			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'register') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_my_training_register(date('Y-m-').'1', date('Y-m-'). $date->format('d'), $_SESSION['staff_no']);
			
			$total = 0;
			if (count($data) > 0) 
				$total = $data[0]['total_register'];


			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'monthly_register') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_monthly_training_register(date('Y-m-').'1', date('Y-m-'). $date->format('d'));
			
			$total = 0;
			if (count($data) > 0) 
				$total = $data[0]['total_register'];


			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'yearly_register') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_yearly_training_register(date('Y'));
			
			$total = 0;
			if (count($data) > 0) 
				$total = $data[0]['total_register'];


			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'internal') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_my_internal_training_register(date('Y-m-').'1', date('Y-m-'). $date->format('d'), $_SESSION['staff_no']);
			
			$total = 0;
			if (count($data) > 0)
				$total = $data[0]['total_register'];


			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'monthly_internal') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_internal_training_register(date('Y-m-').'1', date('Y-m-'). $date->format('d'));
			
			$total = 0;
			if (count($data) > 0)
				$total = $data[0]['total_register'];


			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'external') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_my_external_training_register(date('Y-m-').'1', date('Y-m-'). $date->format('d'), $_SESSION['staff_no']);
			
			
			$total = 0;
			if (count($data) > 0)
				$total = $data[0]['total_register'];

			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'monthly_external') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_external_training_register(date('Y-m-').'1', date('Y-m-'). $date->format('d'));
			
			
			$total = 0;
			if (count($data) > 0)
				$total = $data[0]['total_register'];

			$form_data['process'] = $total;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'incoming_training') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_my_incoming_training(date('Y-m-').'1', date('Y-m-'). $date->format('d'), $_SESSION['staff_no']);
			
			$text_color = array("text-danger","text-success","text-primary","text-info","text-warning","text-muted");

			$training = '';
			$i = 0;
			if (count($data) > 0) {

				$training = '';

				foreach ($data as $row) {
					$training .= '<div class="activity-item d-flex">';
                    $training .= '<div class="activite-label">' . date('d/m/Y',strtotime($row['date_start'])) . '</div>';
                    $training .= '<i class="bi bi-circle-fill activity-badge ' . $text_color[$i] . ' align-self-start"></i>';
                    $training .= '<div class="activity-content">' . $row['title'] . '</div>';
                    $training .= '</div>';

                    $i++;
                    if ($i >= count($text_color) - 1)
                    	$i = 0;
				}

			}


			$form_data['process'] = $training;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'incoming_schedule') {
			
			$date = new DateTime('now');
			$date->modify('last day of this month');
			$data = $c_dashboard->_get_incoming_schedule(date('Y-m-').'1', date('Y-m-'). $date->format('d'));
			
			$text_color = array("text-danger","text-success","text-primary","text-info","text-warning","text-muted");

			$training = '';
			$i = 0;
			if (count($data) > 0) {

				$training = '';

				foreach ($data as $row) {
					$training .= '<div class="activity-item d-flex">';
                    $training .= '<div class="activite-label">' . date('d/m/Y',strtotime($row['date_start'])) . '</div>';
                    $training .= '<i class="bi bi-circle-fill activity-badge ' . $text_color[$i] . ' align-self-start"></i>';
                    $training .= '<div class="activity-content">' . $row['title'] . '</div>';
                    $training .= '</div>';

                    $i++;
                    if ($i >= count($text_color) - 1)
                    	$i = 0;
				}

			}


			$form_data['process'] = $training;	
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'yearly_training') {
			
			
			$data = $c_dashboard->_get_my_training_report(date('Y'), $_SESSION['staff_no']);
			
			$text_color = array("text-danger","text-success","text-primary","text-info","text-warning","text-muted");

			$training = array(0,0,0,0,0,0,0,0,0,0,0,0);
			$i = 0;
			if (count($data) > 0) {

				foreach ($data as $row) {
					
					$m = (int) $row['month'];

					$training[$m -1] = $row['total_month'];
				}
			

			}

    		
    		$val = [5, 1, 2, 10, 10, 5, 4, 2 ,3 ,5,3,1];
			//$data = ["labels" => $month, "data" => $val];

			$form_data['labels'] = 	array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
			$form_data['data'] = $training;
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}

		if ($_POST['form_process'] == 'yearly_training_all') {
			
			
			$data = $c_dashboard->_get_all_training_report(date('Y'));
			
			$text_color = array("text-danger","text-success","text-primary","text-info","text-warning","text-muted");

			$training = array(0,0,0,0,0,0,0,0,0,0,0,0);
			$i = 0;
			if (count($data) > 0) {

				foreach ($data as $row) {
					
					$m = (int) $row['month'];

					$training[$m -1] = $row['total_month'];
				}
			

			}

    		
    		$val = [5, 1, 2, 10, 10, 5, 4, 2 ,3 ,5,3,1];
			//$data = ["labels" => $month, "data" => $val];

			$form_data['labels'] = 	array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
			$form_data['data'] = $training;
			$form_data['success'] = true;
			echo json_encode($form_data);
			return;
		}


		$form_data['process'] = "0";	
		$form_data['success'] = true;
		echo json_encode($form_data);

	} else {
		if (isset($_SESSION['user_type'])) {

			if ($_SESSION['user_type'] == 'external') 
				header('location:l-my-task.php');

		} else {
			header('location:l-my-task.php');
		}
	}

	


?>