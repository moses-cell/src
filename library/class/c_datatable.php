<?php 

	require_once dirname(dirname(__FILE__)) . '/dataset/ds_datatable.php';


	class c_datatable extends ds_datatable {

		private $sql_details;
		private $className;
		
		public function __construct() {
			$this->className = __CLASS__;	
			parent::__construct();
			$this->db_connect();
		}

		/**
		 * Create the data output array for the DataTables rows
		 *
		 *  @param  array $columns Column information array
		 *  @param  array $data    Data from the SQL get
		 *  @return array          Formatted data in a row based format
		 */
		private function data_output ( $columns, $data )
		{
			//echo __FUNCTION__;
			$out = array();

			for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
				$row = array();

				for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
					$column = $columns[$j];

					// Is there a formatter?
					if ( isset( $column['formatter'] ) ) {
	                    if(empty($column['db'])){
	                        $row[ $column['dt'] ] = $column['formatter']( $data[$i] );
	                    }
	                    else{
	                        $row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );
	                    }
					}
					else {
	                    if(!empty($column['db'])){
	                        $row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ];
	                    }
	                    else{
	                        $row[ $column['dt'] ] = "";
	                    }
					}
				}

				$out[] = $row;
			}

			return $out;
		}


		/**
		 * Database connection
		 *
		 * Obtain an PHP PDO connection from a connection details array
		 *
		 *  @param  array $conn SQL connection details. The array should have
		 *    the following properties
		 *     * host - host name
		 *     * db   - database name
		 *     * user - user name
		 *     * pass - user password
		 *  @return resource PDO connection
		 */
		private function db (  )
		{
			//echo __FUNCTION__;
			
			//print_r($this->sql_details . 'rrr');

			if ( is_array( $this->sql_details ) ) {
				return $this->sql_connect( $this->sql_details );
			}

			return null;
		}


		/**
		 * Paging
		 *
		 * Construct the LIMIT clause for server-side processing SQL query
		 *
		 *  @param  array $request Data sent to server by DataTables
		 *  @param  array $columns Column information array
		 *  @return string SQL limit clause
		 */
		private function limit ( $request, $columns )
		{
			//echo __FUNCTION__;
			$limit = '';


			if ( isset($request['start']) && $request['length'] != -1 ) {

				if ($this->dbtype == 'mssql') {
					$limit = "OFFSET ".intval($request['start'])." ROWS FETCH NEXT ".intval($request['length']) . " ROWS ONLY ";
				} elseif ($this->dbtype == 'mysql') {
					$limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
				}

			}


			//echo $limit .'ddd';
			return $limit;
		}


		/**
		 * Ordering
		 *
		 * Construct the ORDER BY clause for server-side processing SQL query
		 *
		 *  @param  array $request Data sent to server by DataTables
		 *  @param  array $columns Column information array
		 *  @return string SQL order by clause
		 */
		private function order ( $request, $columns, $order_by )
		{
			//echo __FUNCTION__;

			$order = '';

			//print_r($request['order']);
			if ( isset($request['order']) && count($request['order']) ) {
				$orderBy = array();
				$dtColumns = $this->pluck( $columns, 'dt' );
				//print_r($dtColumns);
				for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
					// Convert the column index into the column data property
					$columnIdx = intval($request['order'][$i]['column']);

					$requestColumn = $request['columns'][$columnIdx];
					//print_r( $requestColumn['data']);
					//print_r($dtColumns );					
					$columnIdx = array_search( $requestColumn['data'], $dtColumns );
					//echo "xx".$columnIdx."xx";
					$column = $columns[ $columnIdx ];
					//echo $requestColumn['orderable'];

					if ( $requestColumn['orderable'] == 'true' ) {
						//print_r($request['order']);
						$dir = $request['order'][$i]['dir'] === 'asc' ?
							'ASC' :
							'DESC';

						$orderBy[] = ''.$column['tbl_field'].' '.$dir;
					}
				}

				if ( count( $orderBy ) ) {
					$order = 'ORDER BY '.implode(', ', $orderBy);
				}
			} 

			if ($order == '') {

				if ($order_by != '') {

					$order = 'ORDER BY ' . $order_by;
					//echo $order;
				}
			}
		//echo $order;
			//echo $order .'ddd';
			return $order;
		}


		/**
		 * Searching / Filtering
		 *
		 * Construct the WHERE clause for server-side processing SQL query.
		 *
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here performance on large
		 * databases would be very poor
		 *
		 *  @param  array $request Data sent to server by DataTables
		 *  @param  array $columns Column information array
		 *  @param  array $bindings Array of values for PDO bindings, used in the
		 *    sql_exec() function
		 *  @return string SQL where clause
		 */
		private function filter ( $request, $columns, &$bindings, $condition )
		{
			//echo __FUNCTION__;
			$globalSearch = array();
			$columnSearch = array();
			$dtColumns = self::pluck( $columns, 'dt' );

			//print_r($bindings);
			//print_r($dtColumns);
			//die();
			if ( isset($request['search']) && $request['search']['value'] != '' ) {
				$str = $request['search']['value'];

				for ( $i=0, $ien=count($request['columns'])  ; $i<$ien ; $i++ ) {
					$requestColumn = $request['columns'][$i];
					//echo "<br /> xxx = " . $requestColumn['data'] ."<br />";
					$columnIdx = array_search( $requestColumn['data'], $dtColumns );
					$column = $columns[ $columnIdx ];

					if ( $requestColumn['searchable'] == 'true' ) {
						if(!empty($column['tbl_field'])){

							if (empty($column['sub_query'])) {
								$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
								$globalSearch[] = "".$column['tbl_field']." LIKE ".$binding;
							}
						}
					}
				}
			}

			// Individual column filtering
			if ( isset( $request['columns'] ) ) {
				for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
					$requestColumn = $request['columns'][$i];
					$columnIdx = array_search( $requestColumn['data'], $dtColumns );
					$column = $columns[ $columnIdx ];

					$str = $requestColumn['search']['value'];

					if ( $requestColumn['searchable'] == 'true' &&
					 $str != '' ) {
						if(!empty($column['tbl_field'])){
							if (empty($column['sub_query'])) {
								$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
								$columnSearch[] = "".$column['tbl_field']." LIKE ".$binding;
							}
						}
					}
				}
			}

			// Combine the filters into a single string
			$where = '';

			if ( count( $globalSearch ) ) {
				$where = '('.implode(' OR ', $globalSearch).')';
			}

			if ( count( $columnSearch ) ) {
				$where = $where === '' ?
					implode(' AND ', $columnSearch) :
					$where .' AND '. implode(' AND ', $columnSearch);
			}

			if ( $where !== '' ) {
				$where = 'WHERE '.$where;
			}

			//echo ($condition);
			$cond = '';
			if (is_array($condition)) {
				foreach ($condition as $key => $value) {

					$binding = $this->bind( $bindings, $value, PDO::PARAM_STR);
					$cond .= $key . "= " . $binding . " ";	
					//echo $cond;				
				}
			} else  {
				$cond = $condition;
			}
			

			if ($cond !== '') {
				if ( $where !== '' ) {
					$where = $where . ' AND (' . $cond . ') ';
				} else {
					$where = 'WHERE  (' . $cond . ') ';
				}
				
			}

			//echo $where . 'dddd';
			return $where;
		}


		/**
		 * Searching / Filtering using having for sub query
		 *
		 * Construct the WHERE clause for server-side processing SQL query.
		 *
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here performance on large
		 * databases would be very poor
		 *
		 *  @param  array $request Data sent to server by DataTables
		 *  @param  array $columns Column information array
		 *  @param  array $bindings Array of values for PDO bindings, used in the
		 *    sql_exec() function
		 *  @return string SQL where clause
		 */
		private function filter_having ( $request, $columns, &$bindings, $condition )
		{
			//echo __FUNCTION__;
			$globalSearch = array();
			$columnSearch = array();
			$dtColumns = self::pluck( $columns, 'dt' );

			//print_r($bindings);
			//print_r($dtColumns);
			//die();
			if ( isset($request['search']) && $request['search']['value'] != '' ) {
				$str = $request['search']['value'];
				//echo $str;
				for ( $i=0, $ien=count($request['columns'])  ; $i<$ien ; $i++ ) {
					$requestColumn = $request['columns'][$i];
					//echo "<br /> xxx = " . $requestColumn['data'] ."<br />";
					$columnIdx = array_search( $requestColumn['data'], $dtColumns );
					$column = $columns[ $columnIdx ];

					if ( $requestColumn['searchable'] == 'true' ) {
						if(!empty($column['tbl_field'])){

							if (!empty($column['sub_query'])) {
								//$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
								$globalSearch[] = "".$column['tbl_field']." LIKE ". "'%".$str."%'";
							}
						}
					}
				}
			}

			// Individual column filtering
			if ( isset( $request['columns'] ) ) {
				for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
					$requestColumn = $request['columns'][$i];
					$columnIdx = array_search( $requestColumn['data'], $dtColumns );
					$column = $columns[ $columnIdx ];

					$str = $requestColumn['search']['value'];

					if ( $requestColumn['searchable'] == 'true' &&
					 $str != '' ) {
						if(!empty($column['tbl_field'])){
							if (!empty($column['sub_query'])) {
								//$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
								$columnSearch[] = "".$column['tbl_field']." LIKE " ."'%".$str."%'";
							}
						}
					}
				}
			}

			// Combine the filters into a single string
			$where = '';

			if ( count( $globalSearch ) ) {
				$where = '('.implode(' OR ', $globalSearch).')';
			}

			if ( count( $columnSearch ) ) {
				$where = $where === '' ?
					implode(' AND ', $columnSearch) :
					$where .' AND '. implode(' AND ', $columnSearch);
			}

			if ( $where !== '' ) {
				$where = 'HAVING '.$where;
			}

			//echo ($condition);
			$cond = '';
			if (is_array($condition)) {
				foreach ($condition as $key => $value) {

					$binding = $this->bind( $bindings, $value, PDO::PARAM_STR);
					$cond .= $key . "= " . $binding . " ";	
					//echo $cond;				
				}
			} else  {
				$cond = $condition;
			}
			

			//echo $where . 'dddd';
			return $where;
		}

		/**
		 * Perform the SQL queries needed for an server-side processing requested,
		 * utilising the helper functions of this class, limit(), order() and
		 * filter() among others. The returned array is ready to be encoded as JSON
		 * in response to an SSP request, or can be modified if needed before
		 * sending back to the client.
		 *
		 *  @param  array $request Data sent to server by DataTables
		 *  @param  array|PDO $conn PDO connection resource or connection parameters array
		 *  @param  string $table SQL table to query
		 *  @param  string $primaryKey Primary key of the table
		 *  @param  array $columns Column information array
		 *  @return array          Server-side processing response array
		 */
		public function simple ( $request,  $table, $primaryKey, $columns, $sql, $condition, $order_by = '', $dev = false )
		{
			//	echo __FUNCTION__;
			$bindings = array();
			//$db = $this->db();

			// Build the SQL query string from the request
			$limit = $this->limit( $request, $columns );
			$order = $this->order( $request, $columns, $order_by );
			$where = $this->filter( $request, $columns, $bindings, $condition );
			//$having = $this->filter_having( $request, $columns, $bindings, $condition );

			
			if ($dev) {
				echo "$sql from $table 
					 $where 
					 $order
					 $limit";
				print_r($bindings);
			}
			$data = $this->sql_exec( $this->conn, $bindings,
				"$sql from $table 
				 $where
				 $order
				 $limit"
			);


			$resFilterLength = $this->sql_exec( $this->conn, $bindings,
				"SELECT COUNT({$primaryKey})
				 FROM   $table 
				 $where  "
			);
			$recordsFiltered = $resFilterLength[0][0];

			$resTotalLength = $this->sql_exec( $this->conn, $bindings,
				"SELECT COUNT({$primaryKey})
				 FROM   $table
				 $where  "
			);
			$recordsTotal = $resTotalLength[0][0];

			/*
			 * Output
			 */
			/*print_r (array(
				"draw"            => isset ( $request['draw'] ) ?
					intval( $request['draw'] ) :
					0,
				"recordsTotal"    => intval( $recordsTotal ),
				"recordsFiltered" => intval( $recordsFiltered ),
				"data"            => $this->data_output( $columns, $data ),
			));
			print_r(array(
				"draw"            => isset ( $request['draw'] ) ?
					intval( $request['draw'] ) :
					0,
				"recordsTotal"    => intval( $recordsTotal ),
				"recordsFiltered" => intval( $recordsFiltered ),
				"data"            => $this->data_output( $columns, $data ),
			));*/
			return array(
				"draw"            => isset ( $request['draw'] ) ?
					intval( $request['draw'] ) :
					0,
				"recordsTotal"    => intval( $recordsTotal ),
				"recordsFiltered" => intval( $recordsFiltered ),
				"data"            => $this->data_output( $columns, $data ),
			);


		}


		/**
		 * The difference between this method and the `simple` one, is that you can
		 * apply additional `where` conditions to the SQL queries. These can be in
		 * one of two forms:
		 *
		 * * 'Result condition' - This is applied to the result set, but not the
		 *   overall paging information query - i.e. it will not effect the number
		 *   of records that a user sees they can have access to. This should be
		 *   used when you want apply a filtering condition that the user has sent.
		 * * 'All condition' - This is applied to all queries that are made and
		 *   reduces the number of records that the user can access. This should be
		 *   used in conditions where you don't want the user to ever have access to
		 *   particular records (for example, restricting by a login id).
		 *
		 *  @param  array $request Data sent to server by DataTables
		 *  @param  array|PDO $conn PDO connection resource or connection parameters array
		 *  @param  string $table SQL table to query
		 *  @param  string $primaryKey Primary key of the table
		 *  @param  array $columns Column information array
		 *  @param  string $whereResult WHERE condition to apply to the result set
		 *  @param  string $whereAll WHERE condition to apply to all queries
		 *  @return array          Server-side processing response array
		 */
		public function complex ( $request, $table, $primaryKey, $columns, $whereResult=null, $whereAll=null, $sql = '' )
		{
			//	echo __FUNCTION__;
			//echo "complex <br />";
			$bindings = array();
			$db = $this->db(  );
			$localWhereResult = array();
			$localWhereAll = array();
			$whereAllSql = '';

			// Build the SQL query string from the request
			$limit = $this->limit( $request, $columns );
			$order = $this->order( $request, $columns );
			$where = $this->filter( $request, $columns, $bindings );

			$whereResult = $this->_flatten( $whereResult );
			$whereAll = $this->_flatten( $whereAll );

			/*if ( $whereResult ) {
				$where = $where ?
					$where .' AND '.$whereResult :
					'WHERE '.$whereResult;
			}*/

			if ( $whereAll ) {
				$where = $where ?
					$where .' AND '.$whereAll :
					'WHERE '.$whereAll;

				$whereAllSql = 'WHERE '.$whereAll;
			}

			// Main query to actually get the data
			$data = $this->sql_exec( $db, $bindings,
				"SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`
				 FROM `$table`
				 $where
				 $order
				 $limit"
			);

			// Data set length after filtering
			$resFilterLength = $this->sql_exec( $db, $bindings,
				"SELECT COUNT(`{$primaryKey}`)
				 FROM   `$table`
				 $where"
			);
			$recordsFiltered = $resFilterLength[0][0];

			// Total data set length
			$resTotalLength = $this->sql_exec( $db, $bindings,
				"SELECT COUNT(`{$primaryKey}`)
				 FROM   `$table` ".
				$whereAllSql
			);
			$recordsTotal = $resTotalLength[0][0];

			/*
			 * Output
			 */
			return array(
				"draw"            => isset ( $request['draw'] ) ?
					intval( $request['draw'] ) :
					0,
				"recordsTotal"    => intval( $recordsTotal ),
				"recordsFiltered" => intval( $recordsFiltered ),
				"data"            => $this->data_output( $columns, $data )
			);
		}


		/**
		 * Connect to the database
		 *
		 * @param  array $sql_details SQL server connection details array, with the
		 *   properties:
		 *     * host - host name
		 *     * db   - database name
		 *     * user - user name
		 *     * pass - user password
		 * @return resource Database connection handle
		 */
		private function sql_connect ( $sql_details )
		{
			//echo __FUNCTION__;
			try {
				$db = @new PDO(
					"sqlsrv:server={$this->sql_details['host']};database={$this->sql_details['db']}",
					$this->sql_details['user'],
					$this->sql_details['pass'],
					array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )
				);
			}
			catch (PDOException $e) {
				$this->fatal(
					"An error occurred while connecting to the database. ".
					"The error reported by the server was: ".$e->getMessage()
				);
			}

			return $db;
		}


		/**
		 * Execute an SQL query on the database
		 *
		 * @param  resource $db  Database handler
		 * @param  array    $bindings Array of PDO binding values from bind() to be
		 *   used for safely escaping strings. Note that this can be given as the
		 *   SQL query string if no bindings are required.
		 * @param  string   $sql SQL query to execute.
		 * @return array         Result from the query (all rows)
		 */
		private function sql_exec ( $db, $bindings, $sql=null )
		{
			//echo __FUNCTION__;
			//echo "sql_exce binding ";
			//print_r($bindings);
			//echo "<br />";
			
			//echo "<br /> sql exec sql = " . $sql . "<br />";
			// Argument shifting
			
			if ( $sql === null ) {
				$sql = $bindings;
			}

			
			$stmt = $db->prepare( $sql );
			//echo $sql;


			// Bind parameters
			if ( is_array( $bindings ) ) {
				for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) {
					$binding = $bindings[$i];
					if ($binding['type'] == '') {
						$stmt->bindValue( $binding['key'], $binding['val']);
					} else {
						$stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );	
					}
					
				}
			}
			
			// Execute
			try {
				$stmt->execute();
			}
			catch (PDOException $e) {
				print_r($stmt);
				echo "Error";
				$this->fatal( "An SQL error occurred: ".$e->getMessage() );
			}

			// Return all
			return $stmt->fetchAll( PDO::FETCH_BOTH );
		}


		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * Internal methods
		 */

		/**
		 * Throw a fatal error.
		 *
		 * This writes out an error message in a JSON string which DataTables will
		 * see and show to the user in the browser.
		 *
		 * @param  string $msg Message to send to the client
		 */
		private function fatal ( $msg )
		{
			//	echo __FUNCTION__;
			echo json_encode( array( 
				"error" => $msg
			) );

			exit(0);
		}

		/**
		 * Create a PDO binding key which can be used for escaping variables safely
		 * when executing a query with sql_exec()
		 *
		 * @param  array &$a    Array of bindings
		 * @param  *      $val  Value to bind
		 * @param  int    $type PDO field type
		 * @return string       Bound key to be used in the SQL where this parameter
		 *   would be used.
		 */
		private function bind ( &$a, $val, $type )
		{
			//	echo __FUNCTION__;
			$key = ':binding_'.count( $a );

			$a[] = array(
				'key' => $key,
				'val' => $val,
				'type' => $type
			);

			//echo "bind <br />";
			//print_r($a);
			//echo "<br />";
			return $key;
		}


		/**
		 * Pull a particular property from each assoc. array in a numeric array, 
		 * returning and array of the property values from each item.
		 *
		 *  @param  array  $a    Array to get data from
		 *  @param  string $prop Property to read
		 *  @return array        Array of property values
		 */
		private function pluck ( $a, $prop )
		{
			//	echo __FUNCTION__;
			$out = array();

			for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
	            if(empty($a[$i][$prop])){
	                continue;
				}
				//removing the $out array index confuses the filter method in doing proper binding,
				//adding it ensures that the array data are mapped correctly
				$out[$i] = $a[$i][$prop];
			}
			
			//echo "pluck = ";
			//print_r( $out);
			//echo "<br />";
			//die();
			//	echo __FUNCTION__ . "<br />";
			return $out;
		}


		/**
		 * Return a string from an array or a string
		 *
		 * @param  array|string $a Array to join
		 * @param  string $join Glue for the concatenation
		 * @return string Joined string
		 */
		private function _flatten ( $a, $join = ' AND ' )
		{
				//echo __FUNCTION__;
			//echo "flatten <br />";
			if ( ! $a ) {
				return '';
			}
			else if ( $a && is_array($a) ) {
				return implode( $join, $a );
			}
			return $a;
		}
	}

?>