<?php
	
	require_once dirname(dirname(dirname(__FILE__))) . '/global.php';
	require_once dirname(dirname(__FILE__)) . '/shared/b_session.php';
	require_once dirname(dirname(dirname(__FILE__))). '/class/c_report.php';	
	require_once dirname(dirname(dirname(dirname(__FILE__)))).'/vendor/autoload.php';
	

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use \PhpOffice\PhpSpreadsheet\IOFactory;

	class xlsReport_Training_Evaluation extends c_report {

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

		    $col = 1;
		    $lrow = 4;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) . $lrow, 'Course Code');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("10"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) . $lrow, 'Course Name');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("45"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) . $lrow, 'Start Date');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("10"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'End Date');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("10"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Assessment Date');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("10"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Trainer Name');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("10"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Employee No');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("10"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Employee Name');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("30"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Division');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("30"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Department');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("30"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Section');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("30"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Knowledge Level');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Ability to Apply Knowledge');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Self Enhancement');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
		 	

		 	$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Perform Inspection and Maintenance Preparation');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Perform Job According Work Procedure and Using Correct Tools');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Practice 5S in Daily Task');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Always Communicate');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Teamwork');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Self Assertion');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Safety Concern');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Overall Assessment');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
						
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Comment');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("50"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Evaluator Name');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Evaluator Email');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'HOD Name');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'HOD Email');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Status');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40");

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Retrain Status');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
		 	$lrow = 5;
			foreach ($data as $row) {

				$col = 0;

				$sDate = strtotime($row['date_start']);
				$eDate = strtotime($row['date_end']);
				$assDate = strtotime($row['assessment_date']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['code']);
				
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['title']);
				
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, date('d/m/Y', $sDate));
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, date('d/m/Y', $eDate));
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, date('d/m/Y', $assDate));

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['trainer_name']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['staff_no']);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['fullname']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['division']);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['department']);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['section']);

				$section1 = explode(',',$row['s1']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section1[0]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section1[1]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section1[2]);
				
				$section2 = explode(',',$row['s2']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[0]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[1]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[2]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[3]);
				

				$section3 = explode(',',$row['s3']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section3[0]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section3[1]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section3[2]);
				
				
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['overall_total']);


				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['super_comment']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['super_name']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['super_email']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['appr_name']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['appr_email']);
				
				if ($row['retrain'] == '1') {
					$col++;
					$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, 'Staff are QUALIFIED to perform related job');
					$col++;
					$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, 'Staff NOT REQUIRED to re-train');
				} else {
					$col++;
					$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, 'Staff are NOT QUALIFIED to perform related job');
					$col++;
					$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, 'Staff REQUIRED to re-train');
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