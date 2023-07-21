<?php
	require_once dirname(__FILE__) .'/dataprovider.php';

	define('WEB_TITLE', 'Prasarana Integrated Training Information System');
	define('APP_NAME', 'Training Application');
	define('WEB_URL', 'http://lprasarana.com/');
	define('FORCE_LOGIN', 'login.php');
	define('NO_ACCESS', 'no_access.php');
	define('LIB_PATH', dirname(__FILE__).'/');
	define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
	define ('SITE_PATH', ROOT_PATH . '/prasarana3');

	// Prevents javascript XSS attacks aimed to steal the session ID
    ini_set('session.cookie_httponly', 1);

    // Prevent Session ID from being passed through  URLs
    ini_set('session.use_only_cookies', 1);
	
	// Uses a secure connection (HTTPS) 
    ini_set('session.cookie_secure', 1); 


	define('DATA_COLOR', 'danger'); //Tip 1: You can change the color of the sidebar using: data-color="rose | purple | azure | green | orange | danger | black"
	define('DATA_BACKGROUND_COLOR', 'white');

	class globalLibrary {
		
		public function encrypt_decrypt($action, $string, $key) 
		{
			//echo 'ddd';
			try {
				if ($action == 'encrypt') {
					$plaintext = $string;
					$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
					$iv = openssl_random_pseudo_bytes($ivlen);
					$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
					$hmac =hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
					$ciphertext =  base64_encode($iv.$hmac.$ciphertext_raw);// base64_encode(str_replace(array('+', '/'), array('-', '_'),  ( )));
					$ciphertext = str_replace( array('+', '/'), array('-', '_'), $ciphertext);
					return $ciphertext;
				}
				elseif ($action == 'decrypt') {
					//decrypt later....
					//echo $string;
					//echo $key;
					$c = base64_decode(str_replace(array('-', '_'), array('+', '/'), $string)); //base64_decode($ciphertext);
					$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
					$iv = substr($c, 0, $ivlen);
					$hmac = substr($c, $ivlen, $sha2len=32);
					$ciphertext_raw = substr($c, $ivlen+$sha2len);
					$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
					$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
					if (hash_equals($hmac, $calcmac)) {//PHP 5.6+ timing attack safe comparison {
						//echo $original_plaintext; 
						return $original_plaintext;
					}
				}
			}  catch (Exception $e) {
					die('not valid cipher');
					header('location:'.FORCE_LOGIN);
					//echo 'erro'. $e->getMessage();
				}
		}	

		public function is_valid($param) {
			//print_r($param);

			try {
				$sql = 'SELECT * FROM apps_user  ';
				$condition = 'user_name=:user_name';
				$data = new dataprovider;
				$data->db_connection();
				$data->db_beginTransaction();

				$result = $data->db_select('apps_user', $param, $sql, $condition);
				if ($data->rows == 1) {
					$data->db_close_connection();
					return true;
				}
				else {
					$data->db_close_connection();
					return false;
				}
			} catch (Exception $e) {
				header('location:'.FORCE_LOGIN);
			}

		}

		public function who_can_apply ($training_roles, $staff_data) {

			$roles_name = explode(",", $training_roles);
			for ($i=0; $i < count($roles_name) ; $i++) { 
				
				$roles = $roles_name[$i];
				if (trim($roles) == 'HR Admin' && $staff_data['HR Admin'] == 'Yes' ) {
					$i = count($roles_name) + 1;
					return true;
				} elseif (trim($roles) == 'Unit Secretary' && $staff_data['Unit Secretary'] == 'Yes' ) {
					$i = count($roles_name) + 1;
					return true;
				} elseif (trim($roles) == 'Rail Depoh Admin' && $staff_data['Rail Depoh Admin'] == 'Yes' ) {
					$i = count($roles_name) + 1;
					return true;
				}  elseif (trim($roles) == 'Bus Depoh Admin' && $staff_data['Bus Depoh Admin'] == 'Yes' ) {
					$i = count($roles_name) + 1;
					return true;
				}  elseif (trim($roles) == 'All Staff' ) {
					$i = count($roles_name) + 1;
					return true;
				}  

			}

			return false;
		}

		public function target_audience ($target_audience, $staff_data) {

			$audience_list = explode(",", $target_audience);
			for ($i=0; $i < count($audience_list) ; $i++) { 
				
				$audience = $audience_list[$i];
				if (trim($audience) == $staff_data['grade']) {
					$i = count($audience_list) + 1;
					return true;
				} elseif(trim($audience) == 'All Staff') {
					$i = count($audience_list) + 1;
					return true;
				}

			}

			return false;
		}

		public function password_generator($length,$count, $characters) {
 
			// $length - the length of the generated password
			// $count - number of passwords to be generated
			// $characters - types of characters to be used in the password
			 
			// define variables used within the function   
		    $symbols = array();
		    $passwords = array();
		    $used_symbols = '';
		    $pass = '';
			 
			// an array of different character types   
		    $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
		    $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $symbols["numbers"] = '1234567890';
		    $symbols["special_symbols"] = '!?~@#-_+<>[]{}';
			 
		    $characters = explode(",",$characters); // get characters types to be used for the passsword
		    foreach ($characters as $key=>$value) {
		        $used_symbols .= $symbols[$value]; // build a string with all characters
		    }
		    $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
			     
		    for ($p = 0; $p < $count; $p++) {
		        $pass = '';
		        for ($i = 0; $i < $length; $i++) {
		            $n = rand(0, $symbols_length); // get a random character from the string with all characters
		            $pass .= $used_symbols[$n]; // add the character to the password string
		        }
		        $passwords[] = $pass;
		    }
			     
		    return $passwords; // return the generated password
		}
			 
		
		public function number_to_alphabet($number) {
		    $number = intval($number);
		    if ($number <= 0) {
		        return '';
		    }
		    $alphabet = '';
		    while($number != 0) {
		        $p = ($number - 1) % 26;
		        $number = intval(($number - $p) / 26);
		        $alphabet = chr(65 + $p) . $alphabet;
		    }
		    return $alphabet;
		}

		public function alphabet_to_number($string) {
		    $string = strtoupper($string);
		    $length = strlen($string);
		    $number = 0;
		    $level = 1;
		    while ($length >= $level ) {
		        $char = $string[$length - $level];
		        $c = ord($char) - 64;        
		        $number += $c * (26 ** ($level-1));
		        $level++;
		    }
		    return $number;
		}

		public function last_date_of_month($month, $year) {
		   
		   $date = strtotime(date("$year-$month-1"));
   			//print_r($date);
			// Last date of current month.
			$lastdate = strtotime(date("Y-m-t", $date ));
			$date = date("d/F/Y", $lastdate);
			return $date;
		}
	
	}


?>