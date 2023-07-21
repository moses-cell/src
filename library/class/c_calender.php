<?php 

	
	require_once dirname(dirname(__FILE__)). '/dataset/ds_calender.php';
	

	class c_calender extends ds_calender {

		private $sql_details;
		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
			$this->db_connect();
		}


		public function get_data ( $table, $sd_fname, $sd_val, $ed_fname, $ed_val, $sql ='', $condition = '') {

			//echo $condition;
			if ($table != '') {
				$this->sql = 'Select * from ' . $table;
			} else {
				$this->sql = $sql;
			} 

			$ed_val = date('Y-m-d', strtotime($ed_val . ' - 1 day'));

			if ($sd_val == $ed_val ) {
				//$this->sql .= " where ((" . $sd_fname . " <= '" . $sd_val ."' and " . $ed_fname . " >='" . $ed_val . "'))";
				$this->sql .= " where ((" . $sd_fname . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "'))";
			} else {
				$this->sql .= " where ((" . $sd_fname . " between '" . $sd_val ."' and '" . $ed_val . "') or (" . $ed_fname . " between '" . $sd_val ."' and '" . $ed_val . "'))";
			}

			if ($condition != '') {
				$this->sql .= " and " . $condition . " order by " . $sd_fname ;
			}

			//echo $this->sql;

			$result = $this->conn->prepare($this->sql);

            $result->execute();
            $this->data = $result->fetchAll(PDO::FETCH_ASSOC);

            $this->rows = count($this->data);
            //print_r($this->rows);
            return $this->data;
		}


	}

?>