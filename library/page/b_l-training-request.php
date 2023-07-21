<?php

	require_once dirname(dirname(__FILE__)) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/page/shared/b_session.php';
	require_once dirname(dirname(__FILE__)) . '/class/c_datatable.php';

	
	
	$table = 'userlog';
	$primaryKey = 'id';

	//$glib = new globalLibrary;
	//$year = $glib->encrypt_decrypt('decrypt',$_GET['y'], 'year');

	$button = '';
	$table = '';
	$sql = '';
	$condition = '';
	$primaryKey = 'code';

	$sql = "Select tm.code, tm.title, tc.category, tm.total_days, tm.total_hours, tm.audience,  tm.id, tm.status, tm.provider, tm.new_training_provider ";
	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "training_request tm left join training_category tc on tm.category = tc.id ";
	
    if ((strpos($_SERVER['HTTP_REFERER'], 'l-hr-training-request-in-progress') !== false) && $_SESSION['HR Admin'] == 'Yes') {
		$condition = "tm.status = 'In Progress'" ;
    } elseif ((strpos($_SERVER['HTTP_REFERER'], 'l-hr-training-request-complete') !== false) && $_SESSION['HR Admin'] == 'Yes') {
		$condition = "tm.status = 'Complete'" ;
    } elseif ((strpos($_SERVER['HTTP_REFERER'], 'l-hr-training-request-reject') !== false) && $_SESSION['HR Admin'] == 'Yes') {
		$condition = "tm.status = 'Reject'" ;
    } elseif ((strpos($_SERVER['HTTP_REFERER'], 'l-hr-training-request') !== false) && $_SESSION['HR Admin'] == 'Yes') {
		$condition = "tm.status = 'Submit'" ;
    } elseif ($_SESSION['Unit Secretary'] == 'Yes' ) {
		$condition = "tm.staff_no = '". $_SESSION['staff_no'] . "'";
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
	


	$columns = array(
	    array( 'db' => 'id',     'dt' => 0, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				    $schedule = '';    	
				    $edit = '';  
				    
				    $edit = '<a href="f-training-request.php?id=' . $code .'">' .			  
  						'<img src="assets/img/edit.png" alt="edit training module" style="width:16px;height:16px;" title="Edit Training Request"></a>';
  
  					
  					if ($_SESSION['HR Admin'] == 'Yes')  {

						$edit = '<a href="f-training-request.php?id=' . $code .'">' . '<img src="assets/img/edit.png" alt=" Training Request" style="width:16px;height:16px;" title="Training Request"></a>';
					} 

  					return  $edit;
				}	
			),
	    array( 'db' => 'code', 'dt' => 1, 'tbl_field' => 'code' ),
	    array( 'db' => 'title',  'dt' => 2, 'tbl_field' => 'title' ),
	    array( 'db' => 'provider',   'dt' => 3, 'tbl_field' => 'provider', 
	    		'formatter' => function( $d, $row ) {
				    
  					if ($row['new_training_provider'] != '')  {
  						return $row['new_training_provider'];
					} 

  					return  $d;
				}
	    	),
	    array( 'db' => 'category',   'dt' => 4, 'tbl_field' => 'category' ),
	    array( 'db' => 'total_days',   'dt' => 5, 'tbl_field' => 'total_days' ),
	    array( 'db' => 'total_hours',   'dt' => 6, 'tbl_field' => 'total_hours' ),
	    array( 'db' => 'audience',   'dt' => 7, 'tbl_field' => 'audience' ),
	    array( 'db' => 'status',   'dt' => 8, 'tbl_field' => 'status' ),
	    array( 'db' => 'id',     'dt' => 9, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				    $schedule = ''; 
				    $edit = '';  
				    
				     $edit = '<a href="f-training-request.php?id=' . $code .'">' .			  
  						'<img src="assets/img/edit.png" alt="edit training module" style="width:16px;height:16px;" title="Edit Training Request"></a>';
  					
  					if ($_SESSION['HR Admin'] == 'Yes')  {

						$edit = '<a href="f-training-request.php?id=' . $code .'">' . '<img src="assets/img/edit.png" alt=" Training Request" style="width:16px;height:16px;" title="Training Request"></a>';
					} 

  					return  $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>