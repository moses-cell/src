<?php
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_report.php';
	require_once dirname(dirname(dirname(dirname(__FILE__)))).'/vendor/autoload.php';
	

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use \PhpOffice\PhpSpreadsheet\IOFactory;

	class xlsReport_Training_Analysis extends c_report {

		public function __construct($type, $param) {
			$this->className = __CLASS__;	
			parent::__construct($type, $param);
			
		}

		public function generate_report() {

			$objPHPExcel = new Spreadsheet();
			$glib = new globalLibrary();
			
			$data = $this->_get_all_record($this->sql);
			$dept = $this->_get_tna_department();


			
			$xlsTitle = $this->title; 
			$xlsWSTitle = $this->WSTitle; 

			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->getActiveSheet()->setCellValue($glib->number_to_alphabet(1).'1', $xlsTitle);
			$objPHPExcel->getActiveSheet()->getColumnDimension($glib->number_to_alphabet(1))->setWidth("30"); 

			$xlSheet = $objPHPExcel->setActiveSheetIndex(0);  
		 	$styleArray = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size'  => 14,
        		'name'  => 'Arial'
		    ));
		    $xlSheet->getStyle('A1')->applyFromArray($styleArray);
		    $xlSheet->mergeCells('A1:C1');

			foreach (range('B', 'AC') as $letter) {            
            	$xlSheet->getColumnDimension($letter)->setWidth("35"); 

			}
			//$xlSheet->getColumnDimension('A:O')->setWidth("30"); 

			$xlSheet->setCellValue('A3', 'No.');
			$xlSheet->getColumnDimension('A')->setWidth("10"); 

			$xlSheet->setCellValue('B3', 'Course Code');
			$xlSheet->getColumnDimension('B')->setWidth("35"); 

			$xlSheet->setCellValue('C3', 'Course Name');
			$xlSheet->getColumnDimension('C')->setWidth("50");

			$xlSheet->setCellValue('D3', 'Duration');

			$xlSheet->setCellValue('E3', 'Total Pax per Session');

			$xlSheet->setCellValue('F3', 'Training Plan Y' . $_SESSION['year']);
			$xlSheet->mergeCells('F3:H3');

			$xlSheet->setCellValue('F4', 'Ideal Plan Session (TNA)');
			$xlSheet->setCellValue('G4', 'Plan Session MTP');
			$xlSheet->setCellValue('H4', 'Total Attendance ' . $_SESSION['year']);
			


			$xlSheet->setCellValue('I3', 'Training Plan Y' . $_SESSION['year'] + 1 );
			$xlSheet->mergeCells('I3:J3');

			$xlSheet->setCellValue('I4', 'Plan Session Y' . $_SESSION['year'] + 1);
			$xlSheet->setCellValue('J4', 'Total Attendees ' . $_SESSION['year'] + 1);

			$xlSheet->setCellValue('K3', 'No of Dept / Position');							
			$lrow = 5;
		 
			if (count($dept) > 0) {
				$arr_dept = array();
				$col = 11;
				foreach ($dept as $row) {
					
					$alpha = $glib->number_to_alphabet($col);
					$arr_dept[$alpha] = $row['department'];
					$xlSheet->getStyle($alpha .'4:'. $alpha .'4')->getAlignment()->setHorizontal('center');
					$xlSheet->setCellValue($alpha .'4', $row['department']);
					if (isset($_SESSION['position_tna'])) {
						$alpha_start = $alpha;
						foreach ($_SESSION['position_array'] as $pos) {
							$alpha = $glib->number_to_alphabet($col);
							$xlSheet->getStyle($alpha .'5:'. $alpha .'5')->getAlignment()->setHorizontal('center');
							$xlSheet->setCellValue($alpha .'5', $pos);
							$lrow = 6;
							$col++;
						}
						$xlSheet->mergeCells($alpha_start.'4:' . $alpha . '4');
						$xlSheet->getStyle($alpha_start . '5:' . $alpha . '5')->getAlignment()->setHorizontal('center');
						$xlSheet->getStyle($alpha_start.'5:' . $alpha . '5')->getAlignment()->setWrapText(true);
						$xlSheet->getStyle($alpha_start.'5:' . $alpha . '5')->getFont()->setBold(true);
						$xlSheet->getStyle($alpha_start.'5:' . $alpha . '5')->getAlignment()->setVertical('center');
					} else {
						$col++;
						$lrow = 5;
					}
				}
				
				$col--;
				$xlSheet->mergeCells('K3:' . $glib->number_to_alphabet($col) . '3');

				$col++;
				$alpha = $glib->number_to_alphabet($col);
				$xlSheet->getStyle($alpha .'3:'. $alpha .'3')->getAlignment()->setHorizontal('center');
				$xlSheet->setCellValue($alpha .'3', "Total Competent Personnel");


				$xlSheet->getStyle('A3:' . $glib->number_to_alphabet($col) . '4')->getAlignment()->setHorizontal('center');
				$xlSheet->getStyle('A3:' . $glib->number_to_alphabet($col) . '4')->getAlignment()->setVertical('center');
				$xlSheet->getStyle('A3:' . $glib->number_to_alphabet($col) . '4')->getAlignment()->setWrapText(true);
				$xlSheet->getStyle('A3:' . $glib->number_to_alphabet($col) . '4')->getFont()->setBold(true);

				$styleArray1 = [
	            'borders' => [
	                'allBorders' => [
	                    'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
	                	]
	            	]
	        	];

	        	if (isset($_SESSION['position_tna'])) {
	    			$xlSheet ->getStyle('A3'.':'.$glib->number_to_alphabet($col).'5')->applyFromArray($styleArray1);
	    			$xlSheet->mergeCells('A3:A5');
	    			$xlSheet->mergeCells('B3:B5');
	    			$xlSheet->mergeCells('C3:C5');
	    			$xlSheet->mergeCells('D3:D5');
	    			$xlSheet->mergeCells('E3:E5');
	    			$xlSheet->mergeCells('F4:F5');
	    			$xlSheet->mergeCells('G4:G5');
	    			$xlSheet->mergeCells('H4:H5');
	    			$xlSheet->mergeCells('I4:I5');
	    			$xlSheet->mergeCells('J4:J5');
	    			$xlSheet->mergeCells($alpha . '3:' . $alpha . '5');			
	        	}
	    		else {
	    			$xlSheet ->getStyle('A3'.':'.$glib->number_to_alphabet($col).'4')->applyFromArray($styleArray1);
	    			$xlSheet->mergeCells('A3:A4');
					$xlSheet->mergeCells('B3:B4');
					$xlSheet->mergeCells('C3:C4');
					$xlSheet->mergeCells('D3:D4');
					$xlSheet->mergeCells('E3:E4');
					$xlSheet->mergeCells($alpha . '3:' . $alpha . '4');	


	    		}
	    		//print_r($arr_dept);
			} else {

			}

		 	$lCount = 1;
		 	$sRow = $lrow;
			foreach ($data as $row) {
				$xlSheet->setCellValue('A'. $lrow, $lCount);
				$xlSheet->setCellValue('B'. $lrow, $row['code']);
				$xlSheet->setCellValueExplicit('C'. $lrow, $row['title'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$xlSheet->setCellValue('D'. $lrow, $row['total_days']);
				$xlSheet->setCellValue('E'. $lrow, $row['max_sit']);
				
				$details = $this->tna_report_department($row['code']);
				$col = 10;
				//echo $lrow;
				if (count($details) > 0) {
					$total = 0;
					foreach ($details as $dept_row) {

						$index = array_search($dept_row['department'], $arr_dept);
						//echo $index . $lrow;

						if (isset($_SESSION['position_tna'])) {
							if ($index != '') {

								$index_pos = array_search($dept_row['position'], $_SESSION['position_array']);
								$index_nos = $glib->alphabet_to_number($index);
								$index = $glib->number_to_alphabet($index_nos + $index_pos);

								$xlSheet->setCellValue($index. $lrow, $dept_row['total']);
								$total = $total + $dept_row['total'];
							}
						} else {
							if ($index != '') {
								$xlSheet->setCellValue($index. $lrow, $dept_row['total']);
								$total = $total + $dept_row['total'];
							}
						}
						

						
					}

					$xlSheet->setCellValue('H'. $lrow, $total);

				}
				$lrow++;
				$lCount++;

			}

			$xlSheet->setCellValue('A'. $lrow, "TOTAL");
			$xlSheet->mergeCells('A'. $lrow .":C" . $lrow );
			$xlSheet->getStyle('A' . $lrow.':C'. $lrow)->getAlignment()->setHorizontal('center');

			if (isset($arr_dept)) {
				if (count($arr_dept) > 0) {
					foreach ($arr_dept as $key=>$value) {
						if (isset($_SESSION['position_tna'])) {
							$pos = count($_SESSION['position_array']);
							for ($i = 0; $i <= $pos; $i++) {
								$index = $glib->number_to_alphabet($glib->alphabet_to_number($key) + $i); 
								//echo $key . '</br>';
								$xlSheet->setCellValue($index. $lrow, "=sum(" . $index . $sRow . ':' . $index . ($lrow -1) . ")" );
							}
							
						} else {
							$xlSheet->setCellValue($key. $lrow, "=sum(" . $key . $sRow . ':' . $key . ($lrow -1) . ")" );
						}		
					}
					$xlSheet ->getStyle('A' .$sRow .':'. $alpha.$lrow)->applyFromArray($styleArray1);
	
				}
			}
			

			


			$lrow++;

			

			$styleArray = array(
		    	'font'  => array(
		        'bold'  => true,
		        'color' => array('rgb' => 'FF0000'),
		    ));


			$xlSheet->getStyle('D'.$lrow)->applyFromArray($styleArray);

			
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