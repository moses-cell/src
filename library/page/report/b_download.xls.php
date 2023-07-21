<?php
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_report.php';
	require_once dirname(dirname(dirname(dirname(__FILE__)))).'/vendor/autoload.php';

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use \PhpOffice\PhpSpreadsheet\IOFactory;

	class xlsDownload extends c_report  {

		public function __construct($type, $param = "") {
			$this->className = __CLASS__;	
			parent::__construct($type, $param);
			
		}

		public function generate_report() {

			$objPHPExcel = new Spreadsheet();
			$glib = new globalLibrary();
			//$rpt = new c_report('');
			//$sql = "Select id as 'Category Id', category as 'Category', status as 'Status' from training_category";
			
			$data = $this->_get_all_record($this->sql);


			$xlsTitle = $this->title; //"Prasarna Printis Training Category";
			$xlsWSTitle = $this->WSTitle; //"Training Category";

			$objPHPExcel	->getProperties()->setCreator($_SESSION['full_name'])
					 		->setLastModifiedBy($_SESSION['full_name'])
							->setTitle($xlsTitle)
							->setSubject($xlsTitle)
							->setDescription($xlsTitle)
							->setKeywords($xlsTitle)
							->setCategory($xlsTitle);


			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->getActiveSheet()->setCellValue($glib->number_to_alphabet(1).'1', $xlsTitle . $this->subtitle);
			$objPHPExcel->getActiveSheet()->getColumnDimension($glib->number_to_alphabet(1))->setWidth("30");   
		 
		 	//
			$col = 1;	
			$row_num = 3; 	
			if (count($data) > 0) {
				$colName = $data[0];
				foreach ($colName as $key=>$value){
					$objPHPExcel->setActiveSheetIndex(0)
				    	->setCellValue($glib->number_to_alphabet($col).'2', $key);
					$objPHPExcel->getActiveSheet()->getColumnDimension($glib->number_to_alphabet($col))->setWidth("30");   
			 
					$col++;
				}  

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

					
			} else {
				$objPHPExcel->setActiveSheetIndex(0)
		                        ->setCellValue($glib->number_to_alphabet($col).$row_num, 'No Record Found', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
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

		}

	} 


?>