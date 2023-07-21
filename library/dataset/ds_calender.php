<?php
	
	require_once 'ds_global.php';

	
	class ds_calender extends global_base {

		private $data;
		private $table;

		public function __construct() {
			parent::__construct();
			//$this->db_connection();
			//$this->db_beginTransaction();
			$this->table = "";

		}

	}

?>