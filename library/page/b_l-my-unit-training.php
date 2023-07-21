<?php

	require_once dirname(dirname(__FILE__)) .'/global.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_datatable.php';
	require_once dirname(dirname(__FILE__)) .'/class/c_staff.php';
	
	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $c_staff = new c_staff();
    $rec = $c_staff->_get_staff_info($_SESSION['staff_no']);

    if (count($rec) > 0) {
    	$data = $rec[0];
    	$email = $data['email'];
    } else {
    	$result =  [
		    'draw' => 1,
		    'recordsTotal' => 0,
		    'recordsFiltered' => 0,
		    'data' => array(),
		];
		echo json_encode ($result);
		return;
    }


	$table = 'userlog';
	$primaryKey = 'id';

	//$glib = new globalLibrary;
	//$year = $glib->encrypt_decrypt('decrypt',$_GET['y'], 'year');

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'staff_no';


	$sql = "select ta.*, tp.provider_name, tl.main_location, tl.sub_location, ts.staff_request,  ";
	$sql .= "tl.details as location_detail, tc.category as training_category, ts.title as training_title, ts.bonding, ts.training_provider  ";
	$table .= "training_application ta ";
	$table .= "left join training_schedule ts on ta.sch_id = ts.id ";
	$table .= "left join training_provider tp on ts.provider = tp.id ";
	$table .= "left join training_location tl on ts.location = tl.id ";
	$table .= "left join training_category tc on ts.category = tc.id ";

	$key = "(ta.staff_no =:appr_no and (ta.status = 'Submit for Approval' or ta.status = 'Approve') and ta.eval > 1)";

	$condition = "ta.secretary_email = '". $email. "'";



	$columns = array(
		array( 	'db' => 'id',     'dt' => 0, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-training-application-details.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view training evaluation" style="width:16px;height:16px;" title="View Training Details"></a>';
  					
  					return $edit;
				}	
			),
	    array( 	'db' => 'staff_no', 'dt' => 1, 'tbl_field' => 'staff_no' ),
	    array( 	'db' => 'fullname', 'dt' => 2, 'tbl_field' => 'fullname' ),
	    array( 	'db' => 'training_title', 'dt' => 3, 'tbl_field' => 'ts.title ' ),    
	    array( 	'db' => 'date_start',  'dt' => 4, 'tbl_field' => 'ts.date_start',
			'formatter' => function($d, $row ) {
				$sDate = strtotime($d);
				return date('d/m/Y',$sDate);
			}),
	    array( 	'db' => 'date_end',  'dt' => 5, 'tbl_field' => 'ts.date_end',
			'formatter' => function($d, $row ) {
				$eDate = strtotime($d);
				return date('d/m/Y',$eDate);
			}),
   	    array( 	'db' => 'provider_name',  'dt' => 6, 'tbl_field' => 'provider_name',
   	    	'formatter' => function($d, $row) {
	    			if ($row['staff_request'] == '1') {
	    				return $row['training_provider'];
	    			} else
	    				return $d;
	    		}

   		),
	    array( 	'db' => 'status',  'dt' => 7, 'tbl_field' => 'ta.status' ),
	    array( 	'db' => 'bonding',  'dt' => 8, 'tbl_field' => 'bonding',
	    		'formatter' => function($d, $row) {
	    			if ($d == '1') {
	    				return 'Yes';
	    			} else
	    				return 'No';
	    		}
			),
	    array( 	'db' => 'total_attend',  'dt' => 9, 'tbl_field' => 'total_attend',
	    		'formatter' => function($d, $row) {
	    			return $d . '/' . $row['total_days'];
	    		}

			),
	    array( 	'db' => 'id',     'dt' => 10, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				        	
				    $edit = '<a href="f-training-application-details.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="view training details" style="width:16px;height:16px;" title="View Training Training"></a>';
  					
  					return $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button, false )
	);



?>