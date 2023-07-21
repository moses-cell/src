<?php

	class config {
	
		private $servername;
		private $username;
		private $password;
		private $dbname;
		private $dbtype;
		
		public function __construct() {
			
			$env = 'dev';

			$this->servername = "127.0.0.1";
			$this->username = "sa"; //"root";
			$this->password = "password@123"; //"password";
			$this->dbname = "tams";
			$this->dbtype = "mssql";

			if ($env == 'production') {
				$this->servername = "sddmysqldb.mysql.database.azure.com";
				$this->username = "printisuser"; //"root";
				$this->password = "sox4.sloppy"; //"password";*/
				$this->dbname = "printis";
				$this->dbtype = "mysql";
				//echo 'construct';
			} elseif ($env == 'dev') {
				$this->servername = "localhost";
                $this->username = "sam";
                $this->password = "Sam@1998";
				$this->dbtype = "mysql";
				$this->dbname = "printis-dev";
			} elseif ($env == 'azmir') {
				$this->servername = "localhost";
				$this->username = "root"; //"root";
				$this->password = "password"; //"password";*/
				$this->dbname = "tams";
				$this->dbtype = "mysql";
			}		
		}

		public function get_servername () {
			//return "localhost";
			return $this->servername;
		}

		public function get_username () {
			return $this->username; //"root";
		}

		public function get_password () {
			return $this->password; //"password";
		}

		public function get_database () {
			return $this->dbname; //"tams";
		}

		public function get_dbtype () {
			return $this->dbtype; //"tams";
		}
		/*
		
		
		
		
		public function __construct() {
			$this->servername = "rm-zf8dqc97h4qnbgf8x.mysql.kualalumpur.rds.aliyuncs.com";
			$this->username = "mdec_ppc";
			$this->password = "frSj9zHNZjBm";
			$this->dbname = "ppc";
		}*/
		

			
		/*public function __construct() {
			$this->servername = "rm-zf8s46263gcy1z3b7.mysql.kualalumpur.rds.aliyuncs.com";
			$this->username = "azmir_zakaria";
			$this->password = "J_kk&c^8383t6t^";
			$this->dbname = "ppc";
			
			
		}*/
		
		
	}
	
	
?>