<?php
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_report.php';
	require_once dirname(dirname(dirname(dirname(__FILE__)))).'/vendor/autoload.php';
	

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use \PhpOffice\PhpSpreadsheet\IOFactory;

	class xlsReport_Intern_Monthly_Allowance extends c_report {

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
		    $xlSheet->mergeCells('A1:O1');

			foreach (range('B', 'O') as $letter) {            
            	$xlSheet->getColumnDimension($letter)->setWidth("20"); 

			}
			//$xlSheet->getColumnDimension('A:O')->setWidth("30"); 

			$xlSheet->setCellValue('A3', 'No.');
			$xlSheet->mergeCells('A3:A5');
			$xlSheet->getColumnDimension('A')->setWidth("10"); 

			$xlSheet->setCellValue('B3', 'Student Name');
			$xlSheet->mergeCells('B3:B5');
			$xlSheet->getColumnDimension('B')->setWidth("35"); 

			$xlSheet->setCellValue('C3', 'I/C Number');
			$xlSheet->mergeCells('C3:C5');

			$xlSheet->setCellValue('D3', 'Start Date');
			$xlSheet->mergeCells('D3:D5');

			$xlSheet->setCellValue('E3', 'End Date');
			$xlSheet->mergeCells('E3:E5');

			$xlSheet->setCellValue('F3', 'Department');
			$xlSheet->mergeCells('F3:F5');

			$xlSheet->setCellValue('G3', 'Bank');
			$xlSheet->mergeCells('G3:G5');

			$xlSheet->setCellValue('H3', 'Account No');
			$xlSheet->mergeCells('H3:H5');

			$xlSheet->setCellValue('I3', 'Total Paid MC Taken During Internship');
			$xlSheet->mergeCells('I3:I5');
 							
			$xlSheet->setCellValue('J3', 'AL/EL/MC/OTHERS (refer att list)');
			$xlSheet->mergeCells('J3:L3');

			$xlSheet->setCellValue('J4', 'Paid Leave');
			$xlSheet->mergeCells('J4:K4');

			$xlSheet->setCellValue('L4', 'Unpaid Leave');

			$xlSheet->setCellValue('J5', 'MC');
			$xlSheet->setCellValue('K5', 'SV/CL/RL');
			$xlSheet->setCellValue('l5', 'MC/EL');
			
			$xlSheet->setCellValue('M3', 'Calendar Working Days');
			$xlSheet->mergeCells('M3:M4');

			$xlSheet->setCellValue('N3', 'Actual Attendance');
			$xlSheet->mergeCells('N3:N4');

			$xlSheet->setCellValue('O3', 'Total Amount');
			$xlSheet->mergeCells('O3:O5');

			$dateObj   = DateTime::createFromFormat('!m', $this->param_report['m']);
			$monthName = $dateObj->format('F'); // March
			$xlSheet->setCellValue('M5', $monthName);
			$xlSheet->setCellValue('N5', $monthName);
			
			$xlSheet->getStyle('A3:O5')->getAlignment()->setHorizontal('center');
			$xlSheet->getStyle('A3:O5')->getAlignment()->setVertical('center');
			$xlSheet->getStyle('A3:O5')->getAlignment()->setWrapText(true);
			$xlSheet->getStyle('A3:O5')->getFont()->setBold(true);
		 
		 	$lrow = 6;
			foreach ($data as $row) {
				$xlSheet->setCellValue('A'. $lrow, $lrow - 5);
				$xlSheet->setCellValue('B'. $lrow, $row['student_name']);
				$xlSheet->setCellValueExplicit('C'. $lrow, $row['ic_no'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$xlSheet->setCellValue('D'. $lrow, $row['date_start']);
				$xlSheet->setCellValue('E'. $lrow, $row['date_end']);
				$xlSheet->setCellValue('F'. $lrow, $row['department']);
				$xlSheet->setCellValue('G'. $lrow, $row['bank_name']);
				$xlSheet->setCellValue('H'. $lrow, "=TEXT(" . $row['acc_no'] . ",0)");
				//$xlSheet->setCellValueExplicit('H'. $lrow, "'" . $row['acc_no'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$xlSheet->setCellValue('I'. $lrow, $row['mc_allowance']);
				$xlSheet->setCellValue('J'. $lrow, $row['mc_leave_taken']  - ($row['total_unpaid_leave'] - $row['unpaid_leave']));
				$xlSheet->setCellValue('K'. $lrow, $row['leave_taken'] );
				$xlSheet->setCellValue('L'. $lrow, $row['total_unpaid_leave']);
				$xlSheet->setCellValue('M'. $lrow, $row['working_day']);
				$xlSheet->setCellValue('N'. $lrow, $row['attendance']);
				$xlSheet->setCellValue('O'. $lrow,   $row['allowance']);

				$lrow++;

			}

			$styleArray1 = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                	]
            	]
        	];

    		$xlSheet ->getStyle('A3'.':'.'O'.($lrow-1))->applyFromArray($styleArray1);

			$lrow++;

			$glib->last_date_of_month($this->param_report['m'],$this->param_report['y']);
			$xlSheet->setCellValue('C'. $lrow, 'End Date');
			$xlSheet->setCellValue('D'. $lrow, $glib->last_date_of_month($this->param_report['m'],$this->param_report['y']));
			$xlSheet->mergeCells('D'.$lrow .':E'.$lrow);
			$xlSheet->getStyle('D'. $lrow .':E'. $lrow)->getAlignment()->setHorizontal('center');

			$styleArray = array(
		    	'font'  => array(
		        'bold'  => true,
		        'color' => array('rgb' => 'FF0000'),
		    ));
		        //'size'  => 15,
        		//'name'  => 'Verdana'

			$xlSheet->getStyle('D'.$lrow)->applyFromArray($styleArray);

			$lrow++;
			$xlSheet->setCellValue('A'. $lrow, 'Leave Entitlement and Allowance Deduction');
			$xlSheet->getStyle('A'.$lrow)->getFont()->setBold(true);
			$xlSheet->getStyle('A'.$lrow)->getFont()->setUnderline(true);

			$lrow++;
			$xlSheet->setCellValue('A'. $lrow, 'a. Medical Leave (MC) –max 3 days throughout the practical training duration.');

			$lrow++;
			$xlSheet->setCellValue('A'. $lrow, 'b. Appointment with supervisor - 1 day per month. Application must be submitted and supported with relevant document.');

			$lrow++;
			$xlSheet->setCellValue('A'. $lrow, 'c. Emergency Leave (Death Related) –1 day (Condition: only for immediate family - parents, sibling and grandparents).  Allowance will be deducted if more than 1 day EL taken.');

			$lrow++;
			$xlSheet->setCellValue('A'. $lrow, 'd. Emergency Leave (others) – not allowed. In the event EL is taken, allowance will be deducted.');
			
			
			$lrow = $lrow + 2;
			$xlSheet->setCellValue('A'. $lrow, 'Prepared by:');
			$xlSheet->mergeCells('A'. $lrow .':B'. $lrow);
			$xlSheet->getStyle('A'. $lrow .':B'. $lrow)->getAlignment()->setHorizontal('center');

			
			$xlSheet->setCellValue('E'. $lrow, 'Verified by:');
			$xlSheet->mergeCells('E'. $lrow .':F'. $lrow);
			$xlSheet->getStyle('E'. $lrow .':F'. $lrow)->getAlignment()->setHorizontal('center');

			
			$xlSheet->setCellValue('J'. $lrow, 'Approved by:');
			$xlSheet->mergeCells('J'. $lrow .':M'. $lrow);
			$xlSheet->getStyle('J'. $lrow .':M'. $lrow)->getAlignment()->setHorizontal('center');

			$lrow = $lrow + 4;
			$xlSheet->setCellValue('A'. $lrow, 'Shaifful Fizal Abdul Majid');
			$xlSheet->mergeCells('A'. $lrow .':B'. $lrow);
			$xlSheet->getStyle('A'. $lrow .':B'. $lrow)->getAlignment()->setHorizontal('center');

			
			$xlSheet->setCellValue('E'. $lrow, 'Rohana Abdul Rahim');
			$xlSheet->mergeCells('E'. $lrow .':F'. $lrow);
			$xlSheet->getStyle('E'. $lrow .':F'. $lrow)->getAlignment()->setHorizontal('center');

			
			$xlSheet->setCellValue('J'. $lrow, 'Jalilah Md Jali');
			$xlSheet->mergeCells('J'. $lrow .':M'. $lrow);
			$xlSheet->getStyle('J'. $lrow .':M'. $lrow)->getAlignment()->setHorizontal('center');

			$lrow++;
			$xlSheet->setCellValue('A'. $lrow, 'Associate');
			$xlSheet->mergeCells('A'. $lrow .':B'. $lrow);
			$xlSheet->getStyle('A'. $lrow .':B'. $lrow)->getAlignment()->setHorizontal('center');

			
			$xlSheet->setCellValue('E'. $lrow, 'Assistant Vice President');
			$xlSheet->mergeCells('E'. $lrow .':F'. $lrow);
			$xlSheet->getStyle('E'. $lrow .':F'. $lrow)->getAlignment()->setHorizontal('center');

			
			$xlSheet->setCellValue('J'. $lrow, 'Head, Human Capital Operations 1');
			$xlSheet->mergeCells('J'. $lrow .':M'. $lrow);
			$xlSheet->getStyle('J'. $lrow .':M'. $lrow)->getAlignment()->setHorizontal('center');

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