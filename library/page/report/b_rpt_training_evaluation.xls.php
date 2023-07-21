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
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Objective is clearly defined and achieved');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Topics covered is relevant to the job');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Training materials is facilitative & sufficient');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
		 	

		 	$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Duration for the course is sufficient');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Meets my training needs to perform better');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 

			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Appropriate attire, well prepared, knowledgeable and confident');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Able to relate knowledge with actual work situation');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Able to stimulate interest and participation');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Demonstrate how to apply the knowledge in workplace');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Provide opportunity to practice during the training session');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Provide opportunity to clarify my doubts');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Training management (e.g.; notifications , reminders, registration, signage and etc)');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Training environment is condusive to my learning');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Training Aids is adequate');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Training room layout is effectively arranged');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("40"); 
			
			$col++;
			$xlSheet->setCellValue($glib->number_to_alphabet($col) .$lrow, 'Comment');
			$xlSheet->getColumnDimension($glib->number_to_alphabet($col))->setWidth("50"); 

			
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
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section1[3]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section1[4]);
				
				$section2 = explode(',',$row['s2']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[0]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[1]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[2]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[3]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[4]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section2[5]);

				$section3 = explode(',',$row['s3']);

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section3[0]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section3[1]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section3[2]);
				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $section3[3]);
				

				$col++;
				$xlSheet->setCellValue($glib->number_to_alphabet($col).$lrow, $row['comments']);
				

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