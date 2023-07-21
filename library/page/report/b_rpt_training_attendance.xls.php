<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_report.php';	
	require_once dirname(dirname(dirname(dirname(__FILE__)))).'/vendor/autoload.php';
	

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use \PhpOffice\PhpSpreadsheet\IOFactory;

	class xlsReport_Training_Attendance extends c_report {

		public function __construct($type, $param) {
			$this->className = __CLASS__;	
			parent::__construct($type, $param);
			
		}

		public function generate_report() {
			
			$objPHPExcel = new Spreadsheet();
			$glib = new globalLibrary();
			
			$data = $this->_get_all_record($this->sql);
			
			$xlsTitle = $this->title; 
			$xlsWSTitle = $this->WSTitle; 

			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->getActiveSheet()->setCellValue($glib->number_to_alphabet(1).'1', $xlsTitle);
			$objPHPExcel->getActiveSheet()->getColumnDimension($glib->number_to_alphabet(1))->setWidth("30"); 

			$xlSheet = $objPHPExcel->setActiveSheetIndex(0);  
		 	$styleArray = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size'  => 12,
        		'name'  => 'Arial'
		    ));
		    $xlSheet->getStyle('A1')->applyFromArray($styleArray);
		    //$xlSheet->mergeCells('A1:K1');

			$xlSheet->setCellValue('A8', 'No.');
			$xlSheet->getColumnDimension('A')->setWidth("10"); 

			$xlSheet->setCellValue('B8', 'Staff ID');
			$xlSheet->getColumnDimension('B')->setWidth("25"); 

			$xlSheet->setCellValue('C8', 'Student Name');
			$xlSheet->getColumnDimension('C')->setWidth("45"); 

			$xlSheet->setCellValue('D8', 'Department');
			$xlSheet->getColumnDimension('D')->setWidth("40"); 

			$xlSheet->setCellValue('E8', 'Designation');
			$xlSheet->getColumnDimension('E')->setWidth("40"); 

		 
		 	$lrow = 9;
			foreach ($data as $row) {

				if ($lrow == 9) {

					$sDate = strtotime($row['date_start']);
					$eDate = strtotime($row['date_end']);

					$xlSheet->setCellValue('A3', 'Course Code : ' . $row['code']);
					$xlSheet->setCellValue('A4', 'Course Title : ' . $row['title']);
					$xlSheet->setCellValue('A5', 'Trainer Name : ' . $row['trainer_name']);
					$xlSheet->setCellValue('A6', 'Training Provider : ' . $row['provider_name']);

					$xlSheet->setCellValue('D4', 'Start Date : ' . date('d/m/Y', $sDate));
					$xlSheet->setCellValue('D5', 'End Date : ' . date('d/m/Y', $eDate));
					$xlSheet->setCellValue('D6', 'Training Location : ' . $row['main_location']);

					if ($row['sub_location'] != '') {
						$xlSheet->setCellValue('D6', 'Training Location : ' . $row['main_location'] . ' (' . $row['sub_location'] . ')');						
					}


					$xlSheet->setCellValue('F7', 'Attendance Date');
					for ($i=1; $i <= $row['total_days']; $i++) {
						$alpha = $glib->number_to_alphabet(5+$i);
						$xlSheet->setCellValue($alpha. '8', date('d/m/Y', $sDate));
						$xlSheet->getColumnDimension($alpha)->setWidth("15"); 
						$newDate = $sDate;
						$sDate = strtotime("+1 day", $newDate);

					}	
					$xlSheet->mergeCells('F7:' . $alpha . '7');
					$xlSheet->getStyle('F7:'.$alpha. '8')->getAlignment()->setHorizontal('center');

					$xlSheet->mergeCells('A1:' . $alpha . '1');
					$xlSheet->getStyle('A1:'.$alpha. '1')->getAlignment()->setHorizontal('center');

					$styleArray = array(
				    	'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				    ));
				    $xlSheet->getStyle('A7:'.$alpha .'8')->applyFromArray($styleArray);
				}

				$xlSheet->setCellValue('A'. $lrow, $lrow - 8);
				//$xlSheet->setCellValue('B'. $lrow, $row['staff_no'] );
				$xlSheet->setCellValueExplicit('B'. $lrow, $row['staff_no'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$xlSheet->setCellValue('C'. $lrow, $row['fullname']);
				$xlSheet->setCellValue('D'. $lrow, $row['department']);
				$xlSheet->setCellValue('E'. $lrow, $row['position']);

				$attendance = $row['attendance'];
				$attendance_array = explode (',', $attendance);

				for ($i=1; $i <= $row['total_days']; $i++) {

					$check = false;

					if (is_array($attendance_array)) {
						if (isset($attendance_array[$i -1])) {
							if ($attendance_array[$i -1] == '1') {
								$check = true;
							}
						}				
					}

					if ($check) {
						$alpha = $glib->number_to_alphabet(5+$i);
						$xlSheet->setCellValue($alpha. $lrow, 'Yes');
						$xlSheet->getStyle($alpha. $lrow . ':'. $alpha. $lrow)->getAlignment()->setHorizontal('center');
					}
					
					
				}



				$lrow++;

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