<?php
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_report.php';
	require_once dirname(dirname(dirname(dirname(__FILE__)))).'/vendor/autoload.php';


	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use \PhpOffice\PhpSpreadsheet\IOFactory;

	$objPHPExcel = new Spreadsheet();
	$glib = new globalLibrary();
	$rpt = new c_report('');
	
	$sql = "Select tl.training_provider_id as 'Training Provider Id',   tp.provider_name as 'Training Provider', tl.id as 'Location Id', tl.main_location as 'Main Location', tl.sub_location as 'Sub Location', tl.details as 'Training Location Details', tl.status as 'Status' from training_location tl left join training_provider tp on tl.training_provider_id = tp.id";
	$data = $rpt->_get_all_record($sql);


	$xlsTitle = "Prasarna Printis Training Location";
	$xlsWSTitle = "Training Location";

	$objPHPExcel	->getProperties()->setCreator($_SESSION['full_name'])
			 		->setLastModifiedBy($_SESSION['full_name'])
					->setTitle($xlsTitle)
					->setSubject($xlsTitle)
					->setDescription($xlsTitle)
					->setKeywords($xlsTitle)
					->setCategory($xlsTitle);


	$objPHPExcel->setActiveSheetIndex(0);
	
	$objPHPExcel->getActiveSheet()->setCellValue($glib->number_to_alphabet(1).'1', $xlsTitle);
	$objPHPExcel->getActiveSheet()->getColumnDimension($glib->number_to_alphabet(1))->setWidth("30");   
 
 	$colName = $data[0];
	$col = 1;
	foreach ($colName as $key=>$value){
		$objPHPExcel->setActiveSheetIndex(0)
	    	->setCellValue($glib->number_to_alphabet($col).'2', $key);
		$objPHPExcel->getActiveSheet()->getColumnDimension($glib->number_to_alphabet($col))->setWidth("30");   
 
		$col++;
	}  

 	
	if (count($data) > 0) {
		$row_num = 3;
		foreach ($data as $row) {
			$col = 1;
					
			foreach ($row as $key=>$value){
						
				if (is_null($value)) {
					$objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($glib->number_to_alphabet($col).$row_num, '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				} else {
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValueExplicit($glib->number_to_alphabet($col).$row_num, $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				}	
			    $col++;
			}  
					
			$row_num++;
				
		}

			
	}

 	$objPHPExcel->getActiveSheet()->setTitle($xlsWSTitle);

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'. $xlsTitle . ' - ' .date('Y-m-d h:i:s').'.xlsx"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter = IOFactory::createWriter($objPHPExcel, "Xlsx");

	$objWriter->save('php://output');
	exit;
?>