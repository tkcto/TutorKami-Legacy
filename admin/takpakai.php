<?PHP
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

require_once '../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
require_once '../plugins/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

$_GET['id'] = 1;

$thisFilename = date("dmy_His");

$query= mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' GROUP BY tab_name ORDER BY tab_name ASC ");
$num = mysqli_num_rows($query); 
while($row = mysqli_fetch_array($query)) {
    $TotalUser[] = $row['tab_name']; 
}

$styleTitle = array( 'font'  => array( 'bold'  => true, ));
$styleSum   = array( 'font'  => array( 'bold'  => true, 'color' => array('rgb' => 'ffffff'), ));
$styleArray = array( 'font'  => array( 'bold'  => true, 'color' => array('rgb' => 'ffffff'), ));
    
$objPHPExcel = new PHPExcel();

$loopUser = 0;
foreach($TotalUser as $data){
     $ThisJan  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Jan' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountJan = mysqli_num_rows($ThisJan);
     $ThisFeb  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Feb' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountFeb = mysqli_num_rows($ThisFeb);
     $ThisMar  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Mar' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountMar = mysqli_num_rows($ThisMar);
     $ThisApr  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Apr' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountApr = mysqli_num_rows($ThisApr);
     $ThisMay  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'May' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountMay = mysqli_num_rows($ThisMay);
     $ThisJun  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Jun' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountJun = mysqli_num_rows($ThisJun);
     $ThisJul  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Jul' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountJul = mysqli_num_rows($ThisJul);
     $ThisAug  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Aug' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountAug = mysqli_num_rows($ThisAug);
     $ThisSep  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Sep' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountSep = mysqli_num_rows($ThisSep);
     $ThisOct  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Oct' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountOct = mysqli_num_rows($ThisOct);
     $ThisNov  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Nov' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountNov = mysqli_num_rows($ThisNov);
     $ThisDec  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."' AND row_no != '0' AND month = 'Dec' ORDER BY FIELD(row_no, '999999') DESC, cf ASC, row_no ASC ");
        $rowCountDec = mysqli_num_rows($ThisDec);
     
$objPHPExcel->getActiveSheet()->freezePane('D2');
$objPHPExcel->getActiveSheet()->getColumnDimension('A:B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);


    // START Aisyah
    $objPHPExcel->setActiveSheetIndex($loopUser);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Date');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Job');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tutor');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Received');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Rate');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Note');
    
    $objPHPExcel->getActiveSheet()->setCellValue('G1', '');
    
    $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Date Tutor Paid');
    $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Paid to Tutor');
    $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Gross Profit');
    $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Hour');
    $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Note');
    	    $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleTitle);
    	    
    $newLineJan = $newLineFeb = $newLineMar = $newLineApr = $newLineMay = $newLineJun = $newLineJul = $newLineAug = $newLineSep = $newLineOct = $newLineNov = $newLineDec = 1;
    
    $Jan=4;
    $xx = $Jan - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Jan');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    	
    $previousValue = '';
    while($rowJan = mysqli_fetch_array($ThisJan)) {
    	    if( $rowJan['row_no'] != '999999' ){
    	        if( $newLineJan == 1){
        	        $Jan++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Jan")->setValue('');    	  
        	        $newLineJan++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Jan",$rowJan['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Jan",$rowJan['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Jan",$rowJan['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Jan",sprintf("%0.2f",$rowJan['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        	$objPHPExcel->getActiveSheet()->setCellValue("E$Jan",$rowJan['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Jan",$rowJan['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Jan",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Jan",$rowJan['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Jan",sprintf("%0.2f",$rowJan['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    $totalGP = $rowJan['no4'] - $rowJan['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Jan",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowJan['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Jan",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Jan",sprintf("%0.2f",$rowJan['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowJan['no4'] - $rowJan['no7'];
        	
        	if( $rowJan['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jan",sprintf("%0.2f",$rowJan['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jan",'');
        	    }
        	    
        	}else{
            	if( $rowJan['no6'] == '' && $rowJan['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Jan",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Jan",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Jan",$rowJan['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Jan",$rowJan['no11']);    	    
        	$Jan++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor;*/  

    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
				
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJan['main_id']."' AND tab_name = '".$rowJan['tab_name']."' AND month = '".$rowJan['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
	$previousValue = $rowJan['id'];			
    }
    	        $objPHPExcel->getActiveSheet()->getCell("A$Jan")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Jan",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Jan",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Jan",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jan",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Jan",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Jan:K$Jan")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Jan:L$Jan")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Feb = $Jan + 3;
    $xx = $Feb - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Feb');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowFeb = mysqli_fetch_array($ThisFeb)) {
    	    if( $rowFeb['row_no'] != '999999' ){
    	        if( $newLineFeb == 1){
        	        $Feb++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Feb")->setValue('');    	  
        	        $newLineFeb++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Feb",$rowFeb['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Feb",$rowFeb['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Feb",$rowFeb['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Feb",sprintf("%0.2f",$rowFeb['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Feb",$rowFeb['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Feb",$rowFeb['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Feb",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Feb",$rowFeb['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Feb",sprintf("%0.2f",$rowFeb['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowFeb['no4'] - $rowFeb['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Feb",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowFeb['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Feb",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Feb",sprintf("%0.2f",$rowFeb['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowFeb['no4'] - $rowFeb['no7'];
        	
        	if( $rowFeb['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Feb",sprintf("%0.2f",$rowFeb['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Feb",'');
        	    }
        	    
        	}else{
            	if( $rowFeb['no6'] == '' && $rowFeb['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Feb",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Feb",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Feb",$rowFeb['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Feb",$rowFeb['no11']);    	    
        	$Feb++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor;*/
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowFeb['main_id']."' AND tab_name = '".$rowFeb['tab_name']."' AND month = '".$rowFeb['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowFeb['id'];	
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Feb")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Feb",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Feb",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Feb",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Feb",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Feb",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Feb:K$Feb")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Feb:L$Feb")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Mar = $Feb + 3;
    $xx = $Mar - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Mar');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowMar = mysqli_fetch_array($ThisMar)) {
    	    if( $rowMar['row_no'] != '999999' ){
    	        if( $newLineMar == 1){
        	        $Mar++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Mar")->setValue('');    	  
        	        $newLineMar++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Mar",$rowMar['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Mar",$rowMar['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Mar",$rowMar['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Mar",sprintf("%0.2f",$rowMar['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Mar",$rowMar['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Mar",$rowMar['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Mar",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Mar",$rowMar['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Mar",sprintf("%0.2f",$rowMar['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowMar['no4'] - $rowMar['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Mar",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowMar['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Mar",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Mar",sprintf("%0.2f",$rowMar['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowMar['no4'] - $rowMar['no7'];
        	
        	if( $rowMar['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Mar",sprintf("%0.2f",$rowMar['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Mar",'');
        	    }
        	    
        	}else{
            	if( $rowMar['no6'] == '' && $rowMar['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Mar",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Mar",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Mar",$rowMar['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Mar",$rowMar['no11']);    	    
        	$Mar++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor;*/
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMar['main_id']."' AND tab_name = '".$rowMar['tab_name']."' AND month = '".$rowMar['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowMar['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Mar")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Mar",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Mar",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Mar",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Mar",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Mar",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Mar:K$Mar")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Mar:L$Mar")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;

    	        

    $Apr = $Mar + 3;
    $xx = $Apr - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Apr');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowApr = mysqli_fetch_array($ThisApr)) {
    	    if( $rowApr['row_no'] != '999999' ){
    	        if( $newLineApr == 1){
        	        $Apr++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Apr")->setValue('');    	  
        	        $newLineApr++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Apr",$rowApr['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Apr",$rowApr['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Apr",$rowApr['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Apr",sprintf("%0.2f",$rowApr['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Apr",$rowApr['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Apr",$rowApr['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Apr",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Apr",$rowApr['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Apr",sprintf("%0.2f",$rowApr['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowApr['no4'] - $rowApr['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Apr",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowApr['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Apr",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Apr",sprintf("%0.2f",$rowApr['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowApr['no4'] - $rowApr['no7'];
        	
        	if( $rowApr['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Apr",sprintf("%0.2f",$rowApr['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Apr",'');
        	    }
        	    
        	}else{
            	if( $rowApr['no6'] == '' && $rowApr['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Apr",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Apr",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Apr",$rowApr['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Apr",$rowApr['no11']);    	    
        	$Apr++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor; */
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowApr['main_id']."' AND tab_name = '".$rowApr['tab_name']."' AND month = '".$rowApr['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowApr['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Apr")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Apr",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Apr",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Apr",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Apr",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Apr",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Apr:K$Apr")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Apr:L$Apr")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $May = $Apr + 3;
    $xx = $May - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('May');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowMay = mysqli_fetch_array($ThisMay)) {
    	    if( $rowMay['row_no'] != '999999' ){
    	        if( $newLineMay == 1){
        	        $May++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$May")->setValue('');    	  
        	        $newLineMay++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$May",$rowMay['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$May",$rowMay['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$May",$rowMay['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$May",sprintf("%0.2f",$rowMay['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$May",$rowMay['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$May",$rowMay['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$May",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$May",$rowMay['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$May",sprintf("%0.2f",$rowMay['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowMay['no4'] - $rowMay['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$May",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowMay['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$May",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$May",sprintf("%0.2f",$rowMay['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowMay['no4'] - $rowMay['no7'];
        	
        	if( $rowMay['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$May",sprintf("%0.2f",$rowMay['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$May",'');
        	    }
        	    
        	}else{
            	if( $rowMay['no6'] == '' && $rowMay['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$May",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$May",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$May",$rowMay['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$May",$rowMay['no11']);    	    
        	$May++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor; */
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowMay['main_id']."' AND tab_name = '".$rowMay['tab_name']."' AND month = '".$rowMay['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowMay['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$May")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$May",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$May",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$May",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$May",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$May",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$May:K$May")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$May:L$May")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Jun = $May + 3;
    $xx = $Jun - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Jun');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowJun = mysqli_fetch_array($ThisJun)) {
    	    if( $rowJun['row_no'] != '999999' ){
    	        if( $newLineJun == 1){
        	        $Jun++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Jun")->setValue('');    	  
        	        $newLineJun++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Jun",$rowJun['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Jun",$rowJun['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Jun",$rowJun['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Jun",sprintf("%0.2f",$rowJun['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Jun",$rowJun['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Jun",$rowJun['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Jun",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Jun",$rowJun['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Jun",sprintf("%0.2f",$rowJun['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowJun['no4'] - $rowJun['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Jun",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowJun['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Jun",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Jun",sprintf("%0.2f",$rowJun['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowJun['no4'] - $rowJun['no7'];
        	
        	if( $rowJun['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jun",sprintf("%0.2f",$rowJun['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jun",'');
        	    }
        	    
        	}else{
            	if( $rowJun['no6'] == '' && $rowJun['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Jun",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Jun",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Jun",$rowJun['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Jun",$rowJun['no11']);    	    
        	$Jun++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor; */
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJun['main_id']."' AND tab_name = '".$rowJun['tab_name']."' AND month = '".$rowJun['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowJun['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Jun")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Jun",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Jun",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Jun",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jun",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Jun",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Jun:K$Jun")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Jun:L$Jun")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Jul = $Jun + 3;
    $xx = $Jul - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Jul');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowJul = mysqli_fetch_array($ThisJul)) {
    	    if( $rowJul['row_no'] != '999999' ){
    	        if( $newLineJul == 1){
        	        $Jul++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Jul")->setValue('');    	  
        	        $newLineJul++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Jul",$rowJul['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Jul",$rowJul['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Jul",$rowJul['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Jul",sprintf("%0.2f",$rowJul['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Jul",$rowJul['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Jul",$rowJul['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Jul",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Jul",$rowJul['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Jul",sprintf("%0.2f",$rowJul['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowJul['no4'] - $rowJul['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Jul",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowJul['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Jul",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Jul",sprintf("%0.2f",$rowJul['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowJul['no4'] - $rowJul['no7'];
        	
        	if( $rowJul['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jul",sprintf("%0.2f",$rowJul['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jul",'');
        	    }
        	    
        	}else{
            	if( $rowJul['no6'] == '' && $rowJul['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Jul",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Jul",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Jul",$rowJul['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Jul",$rowJul['no11']);    	    
        	$Jul++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor; */
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowJul['main_id']."' AND tab_name = '".$rowJul['tab_name']."' AND month = '".$rowJul['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowJul['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Jul")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Jul",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Jul",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Jul",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jul",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Jul",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Jul:K$Jul")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Jul:L$Jul")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Aug = $Jul + 3;
    $xx = $Aug - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Aug');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowAug = mysqli_fetch_array($ThisAug)) {
    	    if( $rowAug['row_no'] != '999999' ){
    	        if( $newLineAug == 1){
        	        $Aug++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Aug")->setValue('');    	  
        	        $newLineAug++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Aug",$rowAug['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Aug",$rowAug['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Aug",$rowAug['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Aug",sprintf("%0.2f",$rowAug['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Aug",$rowAug['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Aug",$rowAug['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Aug",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Aug",$rowAug['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Aug",sprintf("%0.2f",$rowAug['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowAug['no4'] - $rowAug['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Aug",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowAug['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Aug",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Aug",sprintf("%0.2f",$rowAug['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowAug['no4'] - $rowAug['no7'];
        	
        	if( $rowAug['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Aug",sprintf("%0.2f",$rowAug['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Jul",'');
        	    }
        	    
        	}else{
            	if( $rowAug['no6'] == '' && $rowAug['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Aug",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Aug",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Aug",$rowAug['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Aug",$rowAug['no11']);    	    
        	$Aug++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor; */
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAug['main_id']."' AND tab_name = '".$rowAug['tab_name']."' AND month = '".$rowAug['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowAug['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Aug")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Aug",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Aug",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Aug",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Aug",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Aug",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Aug:K$Aug")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Aug:L$Aug")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Sep = $Aug + 3;
    $xx = $Sep - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Sep');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowSep = mysqli_fetch_array($ThisSep)) {
    	    if( $rowSep['row_no'] != '999999' ){
    	        if( $newLineSep == 1){
        	        $Sep++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Sep")->setValue('');    	  
        	        $newLineSep++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Sep",$rowSep['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Sep",$rowSep['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Sep",$rowSep['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Sep",sprintf("%0.2f",$rowSep['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Sep",$rowSep['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Sep",$rowSep['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Sep",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Sep",$rowSep['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Sep",sprintf("%0.2f",$rowSep['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowSep['no4'] - $rowSep['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Sep",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowSep['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Sep",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Sep",sprintf("%0.2f",$rowSep['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowSep['no4'] - $rowSep['no7'];
        	
        	if( $rowSep['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Sep",sprintf("%0.2f",$rowSep['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Sep",'');
        	    }
        	    
        	}else{
            	if( $rowSep['no6'] == '' && $rowSep['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Sep",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Sep",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Sep",$rowSep['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Sep",$rowSep['no11']);    	    
        	$Sep++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor;*/
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowSep['main_id']."' AND tab_name = '".$rowSep['tab_name']."' AND month = '".$rowSep['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowSep['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Sep")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Sep",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Sep",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Sep",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Sep",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Sep",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Sep:K$Sep")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Sep:L$Sep")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Oct = $Sep + 3;
    $xx = $Oct - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Oct');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowOct = mysqli_fetch_array($ThisOct)) {
    	    if( $rowOct['row_no'] != '999999' ){
    	        if( $newLineOct == 1){
        	        $Oct++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Oct")->setValue('');    	  
        	        $newLineOct++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Oct",$rowOct['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Oct",$rowOct['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Oct",$rowOct['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Oct",sprintf("%0.2f",$rowOct['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Oct",$rowOct['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Oct",$rowOct['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Oct",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Oct",$rowOct['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Oct",sprintf("%0.2f",$rowOct['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowOct['no4'] - $rowOct['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Oct",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowOct['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Oct",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Oct",sprintf("%0.2f",$rowOct['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowOct['no4'] - $rowOct['no7'];
        	
        	if( $rowOct['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Oct",sprintf("%0.2f",$rowOct['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Oct",'');
        	    }
        	    
        	}else{
            	if( $rowOct['no6'] == '' && $rowOct['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Oct",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Oct",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
			$objPHPExcel->getActiveSheet()->setCellValue("K$Oct",$rowOct['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Oct",$rowOct['no11']);    	    
        	$Oct++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor; */
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowOct['main_id']."' AND tab_name = '".$rowOct['tab_name']."' AND month = '".$rowOct['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowOct['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Oct")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Oct",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Oct",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Oct",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Oct",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Oct",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Oct:K$Oct")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Oct:L$Oct")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Nov = $Oct + 3;
    $xx = $Nov - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Nov');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowNov = mysqli_fetch_array($ThisNov)) {
    	    if( $rowNov['row_no'] != '999999' ){
    	        if( $newLineNov == 1){
        	        $Nov++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Nov")->setValue('');    	  
        	        $newLineNov++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Nov",$rowNov['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Nov",$rowNov['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Nov",$rowNov['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Nov",sprintf("%0.2f",$rowNov['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Nov",$rowNov['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Nov",$rowNov['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Nov",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Nov",$rowNov['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Nov",sprintf("%0.2f",$rowNov['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowNov['no4'] - $rowNov['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Nov",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowNov['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Nov",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Nov",sprintf("%0.2f",$rowNov['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowNov['no4'] - $rowNov['no7'];
        	
        	if( $rowNov['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Nov",sprintf("%0.2f",$rowNov['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Nov",'');
        	    }
        	    
        	}else{
            	if( $rowNov['no6'] == '' && $rowNov['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Nov",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Nov",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Nov",$rowNov['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Nov",$rowNov['no11']);    	    
        	$Nov++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor; */
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowNov['main_id']."' AND tab_name = '".$rowNov['tab_name']."' AND month = '".$rowNov['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowNov['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Nov")->setValue('TOTAL'); 
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Nov",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Nov",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Nov",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Nov",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Nov",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Nov:K$Nov")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Nov:L$Nov")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;
    	        
    	        

    $Dec = $Nov + 3;
    $xx = $Dec - 1;
    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue('Dec');
    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    
    $previousValue = '';
	while($rowDec = mysqli_fetch_array($ThisDec)) {
    	    if( $rowDec['row_no'] != '999999' ){
    	        if( $newLineDec == 1){
        	        $Dec++;
        	        $objPHPExcel->getActiveSheet()->getCell("A$Dec")->setValue('');    	  
        	        $newLineDec++;          
    	        }
    	    }
        	$objPHPExcel->getActiveSheet()->setCellValue("A$Dec",$rowDec['no1']);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$Dec",$rowDec['no2']);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$Dec",$rowDec['no3']);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$Dec",sprintf("%0.2f",$rowDec['no4']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$Dec",$rowDec['no8']);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$Dec",$rowDec['no5']);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$Dec",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$Dec",$rowDec['no6']);
/*
        	$objPHPExcel->getActiveSheet()->setCellValue("I$Dec",sprintf("%0.2f",$rowDec['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	$totalGP = $rowDec['no4'] - $rowDec['no7'];
        	$objPHPExcel->getActiveSheet()->setCellValue("J$Dec",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
*/
        	if( $rowDec['no7'] == '' ){
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Dec",'');
        	}else{
        	    $objPHPExcel->getActiveSheet()->setCellValue("I$Dec",sprintf("%0.2f",$rowDec['no7']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	}
        	
        	$totalGP = $rowDec['no4'] - $rowDec['no7'];
        	
        	if( $rowDec['no3'] == 'R.F' ){
        	    
        	    $sqlPre  = mysqli_query($conn," SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ");
        	    $rowPre = mysqli_fetch_array($sqlPre);
        	    if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Dec",sprintf("%0.2f",$rowDec['no9']),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        	    }else{
        	        $objPHPExcel->getActiveSheet()->setCellValue("J$Dec",'');
        	    }
        	    
        	}else{
            	if( $rowDec['no6'] == '' && $rowDec['no7'] == '' ){
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Dec",'');
            	}else{
            	    $objPHPExcel->getActiveSheet()->setCellValue("J$Dec",sprintf("%0.2f",$totalGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            	}        	    
        	}
			
        	$objPHPExcel->getActiveSheet()->setCellValue("K$Dec",$rowDec['no10']);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$Dec",$rowDec['no11']);    	    
        	$Dec++;
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        /*$SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $sumSumAmount - $sumSumPaidTutor; */
    	        $no4 = 0;
    	        $no7 = 0;
    	        $rf = 0;
    	        $Total = 0;
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."' AND no7 != '' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."' AND no3 = 'R.F' AND row_no != '0' ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$sqlSum2  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."' AND row_no != '0' ");
					$rowSum3 = mysqli_fetch_array($sqlSum2);
					if( $rowSum3['no6'] != '' && $rowSum3['no7'] != '' ){
						$rf += $rowSum['no4'];
					}
					
    	        }
    	        $sqlSum  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."' AND no7 != '' AND row_no != '0'  ");
    	        while($rowSum = mysqli_fetch_array($sqlSum)) {
					$no7 = number_format((float)$rowSum['total'], 2, '.', '');  
    	        }
				$sumSumGP =  (($no4 - $no7) + $rf);
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowDec['main_id']."' AND tab_name = '".$rowDec['tab_name']."' AND month = '".$rowDec['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
    $previousValue = $rowDec['id'];
	}
    	        $objPHPExcel->getActiveSheet()->getCell("A$Dec")->setValue('TOTAL');    	        
    	        $objPHPExcel->getActiveSheet()->setCellValue("D$Dec",sprintf("%0.2f",$sumSumAmount),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("E$Dec",sprintf("%0.2f",$sumSumRate),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("I$Dec",sprintf("%0.2f",$sumSumPaidTutor),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("J$Dec",sprintf("%0.2f",$sumSumGP),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        $objPHPExcel->getActiveSheet()->setCellValue("K$Dec",sprintf("%0.2f",$sumSumHour),true)->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Dec:K$Dec")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$Dec:L$Dec")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	        $sumSumAmount = $sumSumRate = $sumSumPaidTutor = $sumSumGP = $sumSumHour = 0;

    
    $objPHPExcel->getActiveSheet()->setTitle($data);
    $objPHPExcel->createSheet();
    // END Aisyah

     
     $loopUser++;
}




// START Expenses
$Expenses  = mysqli_query($conn," SELECT * FROM tk_sales_expenses WHERE main_id = '".$_GET['id']."' ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'), id ASC ");

$objPHPExcel->getActiveSheet()->freezePane('D2');
$objPHPExcel->getActiveSheet()->getColumnDimension('A:B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);

    $objPHPExcel->setActiveSheetIndex($loopUser);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Date');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Item');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Amount');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Note');
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleTitle);
    $i=2;
    $current = '';
    $previous = '';
    $Firtdata=1;
    $last = false;
    while($row= mysqli_fetch_array($Expenses)) {
    	$Date   = $row['date'];
    	$Item   = $row['item'];
    	$Amount = $row['amount'];
    	$Note   = $row['note'];

    	$current = $row['month'];
    	$last    = $row;
    	
    	if( $current == $previous ){
        	$objPHPExcel->getActiveSheet()->setCellValue("A$i",$Date);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$i",$Item);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$i",$Amount);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$i",$Note);  	    
    	        $SumAmount = mysqli_query($conn," SELECT SUM(amount) AS value_sum FROM tk_sales_expenses WHERE main_id = '".$row['main_id']."' AND month = '".$row['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
    	}else{
    	    $i++;$i++;
    	    $xx = $i - 1;
    	    $zz = $i - 2;
    	    if($Firtdata > 2){
    	        $objPHPExcel->getActiveSheet()->getCell("B$zz")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->getCell("C$zz")->setValue($sumSumAmount);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$zz:D$zz")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$zz:D$zz")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	    }
    	    
    	    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue($current);
    	    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    	    $objPHPExcel->getActiveSheet()->getStyle("A$xx:D$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    	    
        	$objPHPExcel->getActiveSheet()->setCellValue("A$i",$Date);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$i",$Item);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$i",$Amount);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$i",$Note);
    	}
    $i++;
    $Firtdata++;
    $previous = $current;
    }
    if ( $last !== false ){
       $objPHPExcel->getActiveSheet()->getCell("B$i")->setValue('TOTAL');
       $objPHPExcel->getActiveSheet()->getCell("C$i")->setValue($sumSumAmount);
       
       $objPHPExcel->getActiveSheet()->getStyle("A$i:D$i")->applyFromArray($styleSum);
       $objPHPExcel->getActiveSheet()->getStyle("A$i:D$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    }
    $objPHPExcel->getActiveSheet()->setTitle('Expenses');
    $objPHPExcel->createSheet();
    // END Expenses




// START Summary
$Summary  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' GROUP BY tab_name ORDER BY tab_name ASC ");
$num = mysqli_num_rows($Summary); 

$objPHPExcel->getActiveSheet()->freezePane('D2');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);

    $objPHPExcel->setActiveSheetIndex($loopUser+1);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', '');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'TKC');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Revenue');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'TTP');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Refund');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', 'GP');
    $objPHPExcel->getActiveSheet()->setCellValue('G1', '%');
    $objPHPExcel->getActiveSheet()->setCellValue('H1', 'New Jobs');
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleTitle);
    $i=2;
    $Feb=$num+4;
    $Mar=$Feb+7;
    $Apr=$Mar+7;
    $May=$Apr+7;

    $Jun=$May+7;
    $Jul=$Jun+7;
    $Aug=$Jul+7;
    $Sep=$Aug+7;
    $Oct=$Sep+7;
    $Nov=$Oct+7;
    $Dec=$Nov+7;
    
    $sumRevenue = 0;
    
    $sumTTP = 0;
    $totalRefund = 0;
    $Before = 0;
    $Refund = 0;    
    
    $GP = 0;   
    $BPercen = 0; 
    $Percen = 0;   
    
    $NJobs = 0;

    $sumRevenueTotal = 0;
    $sumTTPTotal = 0;
    $totalRefundTotal = 0;
    $BeforeTotal = 0;
    $RefundTotal = 0;    
    $GPTotal = 0;   
    $BPercenTotal = 0; 
    $PercenTotal = 0;   
    $NJobsTotal = 0;

    while($row= mysqli_fetch_array($Summary)) {
    	$tab_name = $row['tab_name'];
// START Jan
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jan' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jan' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jan' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jan' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$i",'Jan');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$i",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$i",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$i",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$i",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$i",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$i",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jan' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jan' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jan' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jan' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
        
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jan' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $i + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Jan
    	
// START Feb
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Feb' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Feb' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Feb' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Feb' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Feb",'Feb');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Feb",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Feb",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Feb",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Feb",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Feb",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Feb",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Feb",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Feb' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Feb' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Feb' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Feb' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
        
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Feb' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Feb + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Feb
    	
// START Mar
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Mar' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Mar' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Mar' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Mar' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Mar",'Mar');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Mar",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Mar",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Mar",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Mar",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Mar",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Mar",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Mar",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Mar' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Mar' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Mar' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Mar' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Mar' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Mar + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Mar
    	
// START Apr
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Apr' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Apr' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Apr' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Apr' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Apr",'Apr');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Apr",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Apr",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Apr",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Apr",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Apr",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Apr",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Apr",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Apr' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Apr' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Apr' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Apr' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Apr' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Apr + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Apr
    	
// START May
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'May' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'May' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'May' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'May' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$May",'May');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$May",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$May",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$May",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$May",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$May",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$May",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$May",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'May' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'May' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'May' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'May' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'May' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $May + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END May
    	
// START Jun
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jun' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jun' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jun' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jun' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Jun",'Jun');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Jun",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Jun",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Jun",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Jun",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Jun",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Jun",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Jun",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jun' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jun' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jun' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jun' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jun' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Jun + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Jun
    	
// START Jul
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jul' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jul' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jul' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Jul' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Jul",'Jul');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Jul",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Jul",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Jul",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Jul",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Jul",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Jul",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Jul",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jul' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jul' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jul' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jul' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Jul' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Jul + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Jul
    	
// START Aug
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Aug' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Aug' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Aug' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Aug' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Aug",'Aug');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Aug",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Aug",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Aug",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Aug",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Aug",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Aug",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Aug",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Aug' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Aug' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Aug' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Aug' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Aug' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Aug + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Aug
    	
// START Sep
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Sep' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Sep' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Sep' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Sep' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Sep",'Sep');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Sep",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Sep",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Sep",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Sep",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Sep",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Sep",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Sep",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Sep' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Sep' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Sep' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Sep' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Sep' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Sep + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Sep
    	
// START Oct
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Oct' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Oct' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Oct' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Oct' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Oct",'Oct');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Oct",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Oct",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Oct",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Oct",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Oct",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Oct",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Oct",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Oct' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Oct' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Oct' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Oct' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Oct' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Oct + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Oct
    	
// START Nov
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Nov' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Nov' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Nov' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Nov' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Nov",'Nov');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Nov",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Nov",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Nov",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Nov",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Nov",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Nov",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Nov",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Nov' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Nov' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Nov' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Nov' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Nov' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Nov + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Nov
    	
// START Dec
    	$Revenue  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Dec' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($Revenue)) {
    	    $sumRevenue = number_format((float)$rowT['total'], 2, '.', '');
    	}


    	$TTP  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Dec' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTP)) {
    	    $Before = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$Refund  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Dec' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($Refund)) {
    	    $Refund = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefund = $Before - $Refund;
    	$sumTTP = number_format((float)$totalRefund, 2, '.', '');    	


        $GP = number_format((float)($sumRevenue - $Before), 2, '.', '');


        $BPercen = $sumRevenue - $Before;
        $BPercen = (($BPercen / $sumRevenue) * 100);
        $Percen = number_format((float)$BPercen, 2, '.', '').'%';
        if( $Percen == 'nan%' ){
            $Percen = '0%';
        }

    	$Jobs  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$tab_name."' AND month = 'Dec' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobs = mysqli_num_rows($Jobs); 


    	$objPHPExcel->getActiveSheet()->setCellValue("A$Dec",'Dec');
    	$objPHPExcel->getActiveSheet()->setCellValue("B$Dec",$tab_name);
    	$objPHPExcel->getActiveSheet()->setCellValue("C$Dec",$sumRevenue);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$Dec",$sumTTP);  
    	$objPHPExcel->getActiveSheet()->setCellValue("E$Dec",$Refund);   
    	$objPHPExcel->getActiveSheet()->setCellValue("F$Dec",$GP);   
    	$objPHPExcel->getActiveSheet()->setCellValue("G$Dec",$Percen);  
    	$objPHPExcel->getActiveSheet()->setCellValue("H$Dec",$NJobs);  

    	$RevenueTotal  = mysqli_query($conn," SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Dec' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($RevenueTotal)) {
    	    $sumRevenueTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
    	$TTPTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Dec' AND row_no != '0' ");
    	while($rowT= mysqli_fetch_array($TTPTotal)) {
    	    $BeforeTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Dec' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	$totalRefundTotal = $BeforeTotal - $RefundTotal;
    	$sumTTPTotal = number_format((float)$totalRefundTotal, 2, '.', '');   
    	
    	$RefundTotal  = mysqli_query($conn," SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Dec' AND row_no != '0' AND no11 LIKE '%rts%' ");
    	while($rowT= mysqli_fetch_array($RefundTotal)) {
    	    $RefundTotal = number_format((float)$rowT['total'], 2, '.', '');
    	}
    	
        $GPTotal = number_format((float)($sumRevenueTotal - $BeforeTotal), 2, '.', '');

        $BPercenTotal = $sumRevenueTotal - $BeforeTotal;
        $BPercenTotal = (($BPercenTotal / $sumRevenueTotal) * 100);
        $PercenTotal = number_format((float)$BPercenTotal, 2, '.', '').'%';
        if( $PercenTotal == 'nan%' ){
            $PercenTotal = '0%';
        }
		
    	$JobsTotal  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND month = 'Dec' AND row_no != '0' AND no11 LIKE '%New%' ");
    	$NJobsTotal = mysqli_num_rows($JobsTotal); 
    	
    	$t = $Dec + 1;
    	$objPHPExcel->getActiveSheet()->getStyle("A$t")->applyFromArray($styleArray);
    	$objPHPExcel->getActiveSheet()->setCellValue("A$t",'TOTAL');
    	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$sumRevenueTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$sumTTPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$RefundTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$GPTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$PercenTotal);
    	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$NJobsTotal);
// END Dec
    	
    	
    $i++; $Feb++; $Mar++; $Apr++; $May++; $Jun++; $Jul++; $Aug++; $Sep++; $Oct++; $Nov++; $Dec++;
    }

    $objPHPExcel->getActiveSheet()->setTitle('Summary');
    $objPHPExcel->createSheet();
// END Summary

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$thisFilename.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    

?>