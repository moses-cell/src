<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/PHPMailer/PHPMailer.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/PHPMailer/SMTP.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/PHPMailer/Exception.php';
	require_once dirname(dirname(dirname(__FILE__))) . '/class/c_adm-setting.php';


	class email_process {

		private $className;
		private $dev_mode;
		private $port;
		private $host;
		private $username;
		private $password;
		private $smtp_auth;
		private $url;
		private $mail;
		private $hr_email;

		public function __construct() {
			$this->className = __CLASS__;	
			$this->dev_mode = false;
			$this->smtp_auth = true;
			$this->port = '2525';
			$this->host = "smtp.mailtrap.io";
			$this->username = "e33e20ee2d0910";
			$this->password = "29b5dbf9f9e844";
			$this->url = 'http://azmir.com/prasarana3';

			$this->get_email_setting ();

			$this->mail = new PHPMailer\PHPMailer\PHPMailer;
			$this->mail->IsSMTP();
			$this->mail->Host = $this->host;
			$this->mail->Port = $this->port;
			// optional
			// used only when SMTP requires authentication  
			$this->mail->SMTPAuth = $this->smtp_auth;
			$this->mail->Username = $this->username;
			$this->mail->Password = $this->password;


		}

		private function get_email_setting () {

			$c_setting = new c_adm_setting();
			$data = $c_setting->_get_email_setting();
			$this->smtp_auth = true;

			if (count($data) > 0) {

				foreach ($data as $row) {

					if ($row['setting_key'] == 'smtp_mail_port_no') {
						$this->port = $row['setting_value'];

					} elseif ($row['setting_key'] == 'smtp_mail_server') {
						$this->host = $row['setting_value'];

					} elseif ($row['setting_key'] == 'smtp_username') {
						$this->username = $row['setting_value'];

					} elseif ($row['setting_key'] == 'smtp_password') {
						$this->password = $row['setting_value'];

					} elseif ($row['setting_key'] == 'hr_email_group') {
						$this->hr_email = $row['setting_value'];

					} elseif ($row['setting_key'] == 'smtp_require_authentication') {
						if ($row['setting_value'] == '1')
							$this->smtp_auth = true;
						else
							$this->smtp_auth = false;
					} elseif ($row['setting_key'] == 'server_url') {
						$this->url = $row['setting_value'];

					} 

				} 
				
			}

		}

		public function external_user_registration($email_address, $fullname, $password)
		{

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$mail->addAddress($email_address, $fullname);
				

				$mail->Subject  = 'User registration for Prasarana Training Application';
				$mail->Body     = 'Dear ' . $fullname . ', <br><br><br>'. 'You had been registered to access to Prasarana Training Application System. Below is the your credential for system login' . '<br><br><br>' .  'User name : ' . $email_address . '<br><br>' . 'Password : ' .$password .'<br><br>' . 'Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System<br><br><br>Thank you.';
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
			} catch (Exception $e) {
				return false;
			}	

			return false;			
		}

		public function request_training_approval($training_data, $staff_data)
		{
			if ($staff_data['appr_email'] == '') 
				return true;

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$mail->addAddress($staff_data['appr_email'], ucwords(strtolower($staff_data['appr_name'])));
				

				$mail->Subject  = 'Training Application for ' . ucwords(strtolower($staff_data['staff_name'])) . ' Request for Approval';
				$mail->Body     = 'Dear ' . ucwords(strtolower($staff_data['appr_name'])) . ', <br><br><br>'. ucwords(strtolower($staff_data['staff_name'])) . ' had requested you to approve the training application request as per below details. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				  
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}

		public function supervisor_eval_reminder($training_data)
		{
			if ($training_data['super_email'] == '') 
				return true;

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$mail->addAddress($training_data['super_email'], ucwords(strtolower($training_data['super_name'])));
				

				$mail->Subject  = 'Pending Supervisor Assessment: Training Application for ' . ucwords(strtolower($training_data['fullname']));
				$mail->Body     = 'Dear ' . ucwords(strtolower($training_data['super_name'])) . ', <br><br><br>'.'You had pending supervisor Assessment for the training application request as per below details. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['training_title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				  
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}

		public function training_completion_notice($content, $staff_data)
		{
			if (count($staff_data) <= 0) 
				return true;

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else {
					foreach ($staff_data as $row) {
						$mail->addAddress($row['appr_email'], ucwords(strtolower($row['appr_name'])));
						$mail->addAddress($row['super_email'], ucwords(strtolower($row['super_name'])));
					}
					
				}
				
				$mail->Subject  = 'Training Completion Notice';
				$mail->Body     = $content;
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				  
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}

		public function training_reminder($sch, $staff_data, $tbl)
		{
			if (count($staff_data) <= 0) 
				return true;

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else {
					foreach ($staff_data as $row) {
						$mail->addAddress($row['appr_email'], ucwords(strtolower($row['appr_name'])));
						$mail->addAddress($row['super_email'], ucwords(strtolower($row['super_name'])));
					}
					
				}
				
				$body = '<div id="email_body" style="max-width:1000px; ">
	            		<style type="text/css">
	                		.tbl_detail tr td  {
	                    		border: 1px solid;
	                    		padding: 10px;
	                    		border-collapse: collapse !important;
	                   
	                		}

			                td, td {
			                    padding: 10px;
			                    border-collapse: collapse;
			                }
	            		</style>
	            		<p style="margin-left:150px; margin-top:50px; font-size:18px; line-height: 40px; max-width: 850px;">
	            			Salam Hormat,
	            		</p>

	            		<p style="margin-left:150px; margin-top:50px; font-size:18px; line-height: 40px; max-width: 850px;">
	            			We are pleased to inform that the following staff have been scheduled to attend the course as follows:
	            		</p>';

					$body .= "<table style='margin-left: 150px; max-width:850px'  border='0'>
			                <tr>
			                    <td width='150px'>Subject</td><td width='30px'>:</td><td>".$sch['title']."</td>
			                </tr>
			                <tr>
			                    <td width='150px'>Date</td><td width='30px'>:</td><td>". date('d-m-Y', strtotime($sch['date_start'])) . " - " . date('d-m-Y',strtotime($sch['date_end']))."</td>
			                </tr>
			                <tr>
			                    <td width='150px'>Time</td><td width='30px'>:</td><td>".$sch['time_start'] . " - ". $sch['time_end']."</td>
			                </tr>
			                <tr>
			                    <td width='150px'>Trainer Name</td><td width='30px'>:</td><td>".$sch['trainer_name']."</td>
			                </tr>
			                <tr>
			                    <td width='150px'>Venue</td><td width='30px'>:</td><td>".$sch['main_location']."</td>
			                </tr>
			            </table>";

			        $body .= "<br><br>" . $tbl;
			        $body .= '<p style="margin-left:150px; margin-top:50px; font-size:18px; line-height: 40px; max-width: 850px;">
	            			All participants are expected to be ready in class 10 minutes before course commencement. As such, your punctuality is highly appreciated.
	            		</p>

	            		<p style="margin-left:150px; margin-top:50px; font-size:18px; line-height: 40px; max-width: 850px;">
	            			Kindly be reminded that all participants are also required to adhere to all safety aspects and precaution during the course.
	            		</p>';

	            	$body .= '</div>';



				$mail->Subject  = 'Training Schedule Reminder';
				$mail->Body     = $body;
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				  
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}

		public function notify_external_training_register($training_data, $ep_data)
		{

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$mail->addAddress($ep_data['email'], ucwords(strtolower($ep_data['name'])));
				

				$mail->Subject  = 'Training - ' . $training_data['title'] . 'has been Registered';
				$mail->Body     = 'Dear ' . ucwords(strtolower($ep_data['name'])) . ', <br><br><br>'. 'New training had been registered for you.' . '<br><br>'. 'The training details as per details below. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}


		public function approved_training_request($training_data, $staff_data)
		{

			if ($staff_data['email'] == '')
				return true;

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$mail->addAddress($staff_data['email'], ucwords(strtolower($staff_data['staff_name'])));
				
				if ($_POST['form_process'] == "Submit to HR") {
					$mail->Subject  = 'Your Training Application Request has been Submitted to HR for Approval ';
					$mail->Body     = 'Dear ' . ucwords(strtolower($staff_data['staff_name'])) . ', <br><br><br>'. ucwords(strtolower($staff_data['appr_name'])) . ' had approved your request for the training application as per below details. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';
				} else {
					$mail->Subject  = 'Your Training Application Request has been Approved ';
					$mail->Body     = 'Dear ' . ucwords(strtolower($staff_data['staff_name'])) . ', <br><br><br>'. ucwords(strtolower($_SESSION['full_name'])) . ' had approved your request for the training application as per below details. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';					
				}


				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}


		public function send_training_request_to_HR($training_data, $staff_data)
		{

			if ($staff_data['email'] == '')
				return true;

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else {
					$email_add = explode(";",$this->hr_email);

					foreach ($email_add as $email) {
						$mail->addAddress($email);
					}
					
				}
				
				$mail->Subject  = 'Training Application Request has been Submitted to HR Admin for Approval ';
				$mail->Body     = 'Dear HR Admin Team, <br><br><br>'. ucwords(strtolower($staff_data['appr_name'])) . ' had approved ' . ucwords(strtolower($staff_data['staff_name'])) . ' training application as per below details. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';


				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}


		public function reject_training_request($training_data, $staff_data)
		{

			try {

				$this->mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {
					
				}
				else 
					$this->mail->addAddress($staff_data['email'], ucwords(strtolower($staff_data['staff_name'])));
				

				$this->mail->Subject  = 'Your Training Application Request has been Rejected ';
				$this->mail->Body     = 'Dear ' . ucwords(strtolower($staff_data['staff_name'])) . ', <br><br><br>'. ucwords(strtolower($_SESSION['full_name'])) . ' had rejected your request for the training application as per below details. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';
				$this->mail->IsHTML(true);
				

				if(!$this->mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}

		public function cancel_training_request($training_data, $staff_data)
		{

			try {

				$this->mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {
					
				}
				else 
					$this->mail->addAddress($staff_data['email'], ucwords(strtolower($staff_data['staff_name'])));
				

				$this->mail->Subject  = 'Your Training Application Request has been Cancel ';
				$this->mail->Body     = 'Dear ' . ucwords(strtolower($staff_data['staff_name'])) . ', <br><br><br>'. ucwords(strtolower($staff_data['appr_name'])) . ' had approved your request to cancel the training application as per below details. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';
				$this->mail->IsHTML(true);
				

				if(!$this->mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}

		public function reject_cancel_training_request($training_data, $staff_data)
		{

			try {

				$this->mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$this->mail->addAddress($staff_data['email'], ucwords(strtolower($staff_data['staff_name'])));
				

				$this->mail->Subject  = 'Your Training Application Request for Cancellation has been Rejected ';
				$this->mail->Body     = 'Dear ' . ucwords(strtolower($staff_data['staff_name'])) . ', <br><br><br>'. ucwords(strtolower($staff_data['appr_name'])) . ' had rejected your request to cancel the training application as per details below. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';
				$this->mail->IsHTML(true);
				

				if(!$this->mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}


		public function request_training_cancellation($training_data, $staff_data)
		{

			try {

				$this->mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$this->mail->addAddress($staff_data['appr_email'], ucwords(strtolower($staff_data['appr_name'])));
				

				$this->mail->Subject  = 'Training Application for ' . ucwords(strtolower($staff_data['staff_name'])) . ' Request for Cancellation Approval';
				$this->mail->Body     = 'Dear ' . ucwords(strtolower($staff_data['appr_name'])) . ', <br><br><br>'. ucwords(strtolower($staff_data['staff_name'])) . ' had requested you to approve the cancellation of training application request as per below details. <br><br><br>' .  'Title : ' . ucwords(strtolower($training_data['title'])) . '<br>Start Date : ' .date('d/m/Y', strtotime($training_data['date_start'])) .'<br>Date End :' .date('d/m/Y', strtotime($training_data['date_end'])) . '<br><br>Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System for more details.<br><br><br>Thank you.';
				$this->mail->IsHTML(true);
				

				if(!$this->mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
				//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 	return false;
			 	//echo $e->getMessage(); //Boring error messages from anything else!
			}	

			return false;			
		}

		public function reset_external_user_password($email_address, $fullname, $password)
		{

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$mail->addAddress($email_address, $fullname);
				

				$mail->Subject  = 'Password Rest for Prasarana Training Application';
				$mail->Body     = 'Dear ' . $fullname . ', <br><br><br>'. 'You had requested to reset your password for Prasarana Training Application System. Below is the your credential for system login' . '<br><br><br>' .  'User name : ' . $email_address . '<br><br>' . 'Password : ' .$password .'<br><br>' . 'Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System<br><br><br>Thank you.';
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
			} catch (Exception $e) {
				return false;
			}	

			return false;			
		}

		public function reset_user_password($email_address, $fullname, $password)
		{

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$mail->addAddress($email_address, $fullname);
				

				$mail->Subject  = 'Password Rest for Prasarana Training Application';
				$mail->Body     = 'Dear ' . $fullname . ', <br><br><br>'. 'You had requested to reset your password for Prasarana Training Application System. Below is the your credential for system login' . '<br><br><br>' .  'User name : ' . $email_address . '<br><br>' . 'Password : ' .$password .'<br><br>' . 'Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System<br><br><br>Thank you.';
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
			} catch (Exception $e) {
				return false;
			}	

			return false;			
		}

		public function reset_user_password_secretary($email_address, $fullname, $staff_no, $password)
		{

			try {

				$mail = new PHPMailer\PHPMailer\PHPMailer;

				$mail->IsSMTP();
				$mail->Host = $this->host;
				$mail->Port = $this->port;
				// optional
				// used only when SMTP requires authentication  
				$mail->SMTPAuth = $this->smtp_auth;
				$mail->Username = $this->username;
				$mail->Password = $this->password;

				$mail->setFrom('training.admin@prasarana.com.my',"Training Admin");
				
				if ($this->dev_mode) {

				}
				else 
					$mail->addAddress($email_address, $fullname);
				

				$mail->Subject  = 'Password Rest for Prasarana Training Application';
				$mail->Body     = 'Dear Secretary / Unit Admin, <br><br><br>'. 'Staff in your unit had requested to reset their password for Prasarana Training Application System. Below is the credential details for system login' . '<br><br><br>' .  'Staff name : ' . $fullname . '<br>User name : ' . $staff_no . '<br><br>' . 'Password : ' .$password .'<br><br>' . 'Click <a href="' . $this->url . '">here</a> here to login to Prasarana Training Application System<br><br><br>Thank you.';
				$mail->IsHTML(true);
				

				if(!$mail->send()) {
				    return false;
				} else {
				    return true;
				}
			} catch (phpmailerException $e) {
				return false;
			} catch (Exception $e) {
				return false;
			}	

			return false;			
		}

	}

?>

