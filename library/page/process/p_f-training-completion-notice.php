<?php

	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_staff.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_training-application.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_mailer.php';


	$glib = new globalLibrary();
	$hr_sc = new c_training_application();
	$add_participan = '';

	$tbody = '';
	$lst = '';


	if (isset($_POST['process'])) {
		if ($_POST['process'] == 'send_notice') {
			$id = $glib->encrypt_decrypt('decrypt', $_POST['id'], 'id');
			$rec = $hr_sc->_get_trainer_participant_list_result($id);

			$mailer = new email_process();
			$mailer->training_completion_notice($_POST['content'], $rec);

			$form_data['success'] = true;	
			
			echo json_encode($form_data);
			return;

		}	
		
	} 

	$form_data['errors'] = "There is an error while sending email for Training Completion Notice";	
	$form_data['success'] = false;
	
	echo json_encode($form_data);
	return;

?>