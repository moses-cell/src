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

	$sql = "Select tm.code, tm.title, tc.category, tm.total_days, tm.total_hours, tm.max_sit, tm.eligibility, tm.enable_module, tm.id";
	//$sql.= "p.ppc_status, p.ppc_submit_date, p.ppc_pm_by, p.ppc_appr_by, si.username ";
	$table = "training_module tm left join training_category tc on tm.category = tc.id ";
	

	
	 if ((strpos($_SERVER['HTTP_REFERER'], 'l-hr-training-module.php') !== false) && $_SESSION['HR Admin'] == 'Yes') {
		$condition = array() ;
    } elseif ((strpos($_SERVER['HTTP_REFERER'], 'l-hr-training-module-enable.php') !== false) && $_SESSION['HR Admin'] == 'Yes') {
		$condition = "tm.enable_module = '1'";
    } elseif ((strpos($_SERVER['HTTP_REFERER'], 'l-hr-training-module-disable.php') !== false) && $_SESSION['HR Admin'] == 'Yes') {
		$condition = "tm.enable_module != '1'";
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
				    if ($_SESSION['HR Admin'] == 'Yes') { 	
				    	$edit = '<a href="f-hr-training-module.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit training module" style="width:16px;height:16px;" title="Edit Training Module"></a>';
  					} 
  					if ($row['enable_module'] == '1') {	
  					  	$schedule = '<a href="f-hr-training-schedule.php?parent=' . $code .'">' . '<img src="assets/img/schedule.png" alt="schedule training module" style="width:16px;height:16px;" title="New Training Schedule"></a>';
  					  	
  					} 
  					if ($_SESSION['Rail Depoh Admin'] == 'Yes')  {

						$schedule = '<a href="f-depoh-training-schedule.php?parent=' . $code .'">' . '<img src="assets/img/schedule.png" alt="schedule training module" style="width:16px;height:16px;" title="New Training Schedule"></a>';
					} elseif ($_SESSION['Bus Depoh Admin'] == 'Yes')  {

						$schedule = '<a href="f-depoh-training-schedule.php?parent=' . $code .'">' . '<img src="assets/img/schedule.png" alt="schedule training module" style="width:16px;height:16px;" title="New Training Schedule"></a>';
					} 

  					return $schedule . '&nbsp;&nbsp;'. $edit;
				}	
			),
	    array( 'db' => 'code', 'dt' => 1, 'tbl_field' => 'code' ),
	    array( 'db' => 'title',  'dt' => 2, 'tbl_field' => 'title' ),
	    array( 'db' => 'category',   'dt' => 3, 'tbl_field' => 'tc.category' ),
	    array( 'db' => 'total_days',   'dt' => 4, 'tbl_field' => 'total_days' ),
	    array( 'db' => 'total_hours',   'dt' => 5, 'tbl_field' => 'total_hours' ),
	    array( 'db' => 'max_sit',   'dt' => 6, 'tbl_field' => 'max_sit' ),
	    array( 'db' => 'eligibility',   'dt' => 7, 'tbl_field' => 'eligibility' ),
	    array( 'db' => 'id',     'dt' => 8, 'tbl_field' => 'id', 
				'formatter' => function( $d, $row ) {
				    $glib = new globalLibrary;
				    $code = $glib->encrypt_decrypt('encrypt',$d, 'id');
				    $schedule = ''; 
				    $edit = '';  
				    
				    if ($_SESSION['HR Admin'] == 'Yes') { 	
				    	$edit = '<a href="f-hr-training-module.php?id=' . $code .'">' .			  
  							'<img src="assets/img/edit.png" alt="edit training module" style="width:16px;height:16px;" title="Edit Training Module"></a>';
  					}
  					if ($row['enable_module'] == '1') {	
  					  	$schedule = '<a href="f-hr-training-schedule.php?parent=' . $code .'">' . '<img src="assets/img/schedule.png" alt="schedule training module" style="width:16px;height:16px;" title="New Training Schedule"></a>';
  					  	
  					} 
  					if ($_SESSION['Rail Depoh Admin'] == 'Yes')  {

						$schedule = '<a href="f-depoh-training-schedule.php?parent=' . $code .'">' . '<img src="assets/img/schedule.png" alt="schedule training module" style="width:16px;height:16px;" title="New Training Schedule"></a>';
					} elseif ($_SESSION['Bus Depoh Admin'] == 'Yes')  {

						$schedule = '<a href="f-depoh-training-schedule.php?parent=' . $code .'">' . '<img src="assets/img/schedule.png" alt="schedule training module" style="width:16px;height:16px;" title="New Training Schedule"></a>';
					} 
  					return $schedule . '&nbsp;&nbsp;'. $edit;
				}	
			),
	);

	$dt = new c_datatable();

	echo json_encode(
		$dt->simple( $_GET,  $table, $primaryKey, $columns, $sql, $condition, $button )
	);



?>