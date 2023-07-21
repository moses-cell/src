<?php
	require dirname(__FILE__) . '/config.php';

	date_default_timezone_set("Asia/Kuala_Lumpur");

	class dataprovider {
	
		public $conn;
		public $rows;
		public $sql;
		public $dbtype;
		public $last_id;
		public $condition;

		private $username;
		private $password;
		private $servername;
		private $dbname;
		
		
		public function __construct() {

			//echo 'Init';
			$setting = new config;
			$this->username = $setting->get_username();
			$this->password = $setting->get_password();
			$this->servername = $setting->get_servername();
			$this->dbname = $setting->get_database();
			$this->dbtype = $setting->get_dbtype();


			
		}

		public function init() {
		//	$this->username = parent::get_username();
		//	$this->password = parent::get_password();
		//	$this->servername = parent::get_servername();
		//	$this->dbname = parent::get_database();


		}
		public function db_connection() {		

			
			try {
				if ($this->dbtype == 'mysql') {
					$this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname, $this->username, $this->password);
				} elseif ($this->dbtype = 'mssql') {
					$this->conn = new PDO("sqlsrv:server=".$this->servername.";database=".$this->dbname, $this->username, $this->password);
				}

				return true;
			} catch(PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
				return false;
			}
						
		}

		function db_connection_test_data () {

				$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
				return true;
				// Check connection
			if ($this->conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}	
			
		}

		public function db_select ($table, $param, $query = '', $log_param = [], $condition = '', $log = true, $bol_dev = false) {
				
			if ($table != '') {
				$data = '';
				$delim = '';
				
				if ($condition == '') {
					foreach ($param as $key => $value) {
					
						$data = "$data $delim $key=:$key ";		
							
						$delim = ' and  ';
					}

					if ($query == '') {
						if ($data == '')
							$this->sql = "SELECT * FROM $table";
						else 
							$this->sql = "SELECT * FROM $table WHERE $data"; 
					} else {
						if ($data == '')
							$this->sql = $query;
						else 
							$this->sql = $query . " WHERE $data"; 
					}

				} else {
					if ($query == '') 
						$this->sql = "SELECT * FROM $table ";	
					else 	
						$this->sql = $query;			
				}


			} else 
				$this->sql = $query;



			if ($condition != '') {
				$this->sql .= " WHERE " .$condition; 
			}	


			if ($this->get_order_by() != '')
				$this->sql .=  " ". $this->get_order_by() . "; "; 
			else
				$this->sql .= ";";

			if ($bol_dev) {
				echo $this->sql;
				print_r($param);
			}

			//echo $this->sql;
			//print_r($param);

            $result = $this->conn->prepare($this->sql);

            $result->execute($param);
            $this->data = $result->fetchAll(PDO::FETCH_ASSOC);
            //$result->closeCursor();
			//$this->rows = $result->rowCount();
			$this->rows = count($this->data);


			if ($log)
				$this->update_log_process($log_param, 'select');

			//	print_r($this->data);
			//return $result;
			return $this->data;


		}
	
		function db_insert($table, $param, $log_param = [], $bol_id = false, $bol_dev = false  ) {
			
			$colums = '';
			$data = '';
			$delim = '';
			$dev = '';
			$col_dev = '';
			$col_data = '';


			foreach ($param as $key => $value)
			{
				
				$colums = $colums . $delim . $key;				
				$data = $data . $delim . ":" . $key;

				if ($bol_dev) {
					$col_dev = $col_dev . $delim . $key;
					$col_data = $col_data . $delim . "'" . $value ."' ";
				}
				$delim = ', ';

			}
							
			$this->sql = "INSERT INTO $table ($colums) values($data);";
			if ($bol_dev) 
				echo "INSERT INTO $table ($col_dev) values($col_data);";
			//echo $this->sql;
			//echo $dev;
			//print_r($param);
			try {

				//$param = $this->array_change_value_case($param,CASE_UPPER);
				$result = $this->conn->prepare($this->sql);
	            $result->execute($param);
				$this->rows = $result->rowCount();

				if ($this->rows >= 1) {
					if ($bol_id)
						$this->last_id = $this->conn->lastinsertid();

					if (empty($log_param)) {
						return true;
					}
					$this->update_log_process($log_param, 'insert');
				}
				//echo $this->rows;
				return true;

			} catch (Exception $e)  {
				//echo 'error';
				//echo $e->getMessage();
				//print_r( $result);
				$this->update_log_process($log_param, 'update', true,$e->getMessage());
				$this->rows = -1;
				return false;
			}	
            
			
		}

		function db_update($table, $param, $key_param, $log_param = [], $bol_dev = false,  $extended_field_update = '') {
			
			$colums = '';
			$data = '';
			$delim = '';
			$col_dev = '';
			$col_data = '';

			foreach ($param as $key => $value){				
				$colums = $colums . $delim . $key . '=:' . $key;								
				
				if ($bol_dev) {
					$col_dev = $col_dev . $delim . $key . "= '" . $value . "' ";
				}

				$delim = ', ';
			}
					
			if ($extended_field_update == '') {
				$this->sql = "UPDATE $table SET $colums WHERE $key_param;";
				if ($bol_dev) {
					echo "UPDATE $table SET $col_dev WHERE $key_param;";
					print_r($param);
				}
			}
			else {
				$this->sql = "UPDATE $table SET $colums ,  $extended_field_update  WHERE $key_param;";
				if ($bol_dev) {
					echo "UPDATE $table SET $col_dev ,  $extended_field_update  WHERE $key_param;";
					print_r($param);
				}
			}
			
			try {
				$result = $this->conn->prepare($this->sql);
				//$param = $this->array_change_value_case($param,CASE_UPPER);
	            $result->execute($param);
				$this->rows = $result->rowCount();
				
				if ($this->rows >= 1) {
					if (empty($log_param)) {
						return $result;
					}
					$this->update_log_process($log_param, 'update');
				}
				
				return $result;

			} catch (Exception $e)  {
				$this->update_log_process($log_param, 'update', true,$e->getMessage());
				$this->rows = -1;
				return $result;
				echo 'sss';

				//die();
			}	
            
			
		}

		function db_delete($table, $param, $key_param, $log_param = [] ) {
			
			$this->sql = "Delete from $table WHERE $key_param;";
			//echo $this->sql;
			//print_r($param);
			try {
				$result = $this->conn->prepare($this->sql);
	            $result->execute($param);
				$this->rows = $result->rowCount();
				if ($this->rows >= 1) {
					if (empty($log_param)) {
						return $true;
					}
					$this->update_log_process($log_param, 'delete');
				}
				
				return true;

			} catch (Exception $e)  {
				$this->update_log_process($log_param, 'update', true,$e->getMessage());
				return false;
				//die();
			}	
            
			
		}

		function db_data_compare_select ($table, $param, $query = '', $condition = '') {

			if ($table != '') {
				$data = '';
				$delim = '';
				
				if ($condition == '') {
					foreach ($param as $key => $value) {
						
						$data = "$data $delim $key=:$key ";				
						$delim = ' and  ';
					}
					$this->sql = "SELECT * FROM $table WHERE $data;"; 

				} else {
					$this->sql = "SELECT * FROM $table ";					
				}


			} else 
				$this->sql = $query;


			if ($condition != '') {
				$this->sql .= " WHERE " .$condition; 
			}	

            $result = $this->conn->prepare($this->sql);
            $result->execute($param);

            $this->data = $result->fetchAll(PDO::FETCH_ASSOC);

			$this->rows = count($this->data);

			return $this->data;

		}


		function db_data_compare($data, $param, $bol = false) {

			/*foreach ($data as $row) {
				foreach ($param as $key => $value){		

					if ($value != $row[$key]) 
						return false;
				}
			}

			return true;*/

			foreach ($param as $key => $value){	
				
				if ($bol) {
					if ($value != $data[$key]) 
						return false;

				} else {
					if ($value != $data[$key]) 
						return false;

				}			
			}
			
			return true;
		}

		function mysql_update($sql) {
			
			$this->mysql_connection();
			if (mysqli_query($this->conn, $sql)) {
				
				$this->mysql_close_connection();
				return true;
			} else {
				$this->mysql_close_connection();
				return false;
			}
			
		}
		
		function mysql_delete($sql) {
			
			$this->mysql_connection();
			if (mysqli_query($this->conn, $sql)) {
				
				$this->mysql_close_connection();
				return true;
			} else {
				$this->mysql_close_connection();
				return false;
			}
			
		}
		
		public function db_closeCursor($obj) {
			$obj->closeCursor();
		}
		
		public function db_beginTransaction() {
				$this->conn->beginTransaction();
		}
		
		public function db_commit() {
			$this->conn->commit();	
		}
		
		public function db_close_connection () {
			$this->conn = null;
		}

		public function db_rollback() {
				$this->conn->rollBack();
		}

		public function update_log_process($param, $process, $bolError = false, $err_msg = '') {

			$colums = '';
			$data = '';
			$delim = '';

			$param = array_merge($param, ['obj_process' => $process]);
			$param = array_merge($param, ['obj_datetime' => date('Y-m-d H:i:s')]);

			if ($process != 'process') {
				$param = array_merge($param, ['obj_sql' => $this->get_sql()]);
				$param = array_merge($param, ['obj_parameter' => print_r($this->get_param(), true)]);				
			}

			if ($bolError) {
				$param = array_merge($param, ['obj_error' => $err_msg]);				
			}

			foreach ($param as $key => $value)
			{
				
				$colums = $colums . $delim . $key;				
				$data = $data . $delim . ":" . $key;
				
				$delim = ', ';
			}
							
			$this->sql = "INSERT INTO userlog ($colums) values($data);";
			//echo $this->sql;
			//print_r($this->get_param(), true);
			//print_r($param);
			//die();
			try {
				$result = $this->conn->prepare($this->sql);
	            $result->execute($param);
				$this->rows = $result->rowCount();


				return true;

			} catch (Exception $e)  {
				echo $e->getMessage();
				echo 'error';
				return false;
				//die();
			}	

		}

		public function db2_rollback() {
			$this->conn->rollBack();
		}


	
	}

?>