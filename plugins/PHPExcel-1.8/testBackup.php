<?PHP
// https://www.studentstutorial.com/php/php-multi-excel
require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
/*
            $test = " SELECT * FROM tk_user_details 
            WHERE conduct_online_text !='' ";
            $resultTest = $conn->query($test);
            if ($resultTest->num_rows > 0) {
                while($rowTest = $resultTest->fetch_assoc()){
                    
                    echo $rowTest["ud_u_id"].'<br>';
			 
			 
                                
                              
                }
            }
*/
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';

$Filename = mysqli_query($conn," SELECT * FROM tk_sales_main WHERE id = '".$_GET['id']."' ");
$rowFilename = mysqli_fetch_array($Filename);
$thisFilename = $rowFilename['name'].' '.$rowFilename['year'];

$query= mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' GROUP BY tab_name ORDER BY tab_name ASC ");
$num = mysqli_num_rows($query); 
while($row = mysqli_fetch_array($query)) {
    $TotalUser[] = $row['tab_name']; // modified
}

$styleTitle = array(
    'font'  => array(
        'bold'  => true,
        //'size'  => 11,
        //'name'  => 'Verdana'
    ));

$styleSum = array(
    /*
    'font'  => array(
        'bold'  => true,
    ),
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )*/
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'ffffff'),
        //'size'  => 12,
        //'name'  => 'Verdana'
    )
);
    

$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'ffffff'),
        //'size'  => 12,
        //'name'  => 'Verdana'
    ));
    
$objPHPExcel = new PHPExcel();

$loopUser = 0;
foreach($TotalUser as $data){
     //$ThisUser  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."'  ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'), row_no ASC ");
     $ThisUser  = mysqli_query($conn," SELECT * FROM tk_sales_sub WHERE main_id = '".$_GET['id']."' AND tab_name = '".$data."'  ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'), FIELD(row_no, '999999') DESC ");
     
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
    $i=2;
    $current = '';
    $previous = '';
    $Firtdata=1;
    $last = false;
    while($rowAisyah= mysqli_fetch_array($ThisUser)) {
        
    	$Date      = $rowAisyah['no1'];
    	$Job       = $rowAisyah['no2'];
    	$Tutor     = $rowAisyah['no3'];
    	$Amount    = $rowAisyah['no4'];
    	$Rate      = $rowAisyah['no8'];
    	$Note      = $rowAisyah['no5'];
    	
    	$DateTutor = $rowAisyah['no6'];
    	$PaidTutor = $rowAisyah['no7'];
    	$GP        = $rowAisyah['no9'];
    	$Hour      = $rowAisyah['no10'];
    	$NoteTutor = $rowAisyah['no11'];

    	$current = $rowAisyah['month'];
    	$last = $rowAisyah;
    	
    	if( $current == $previous ){
        	$objPHPExcel->getActiveSheet()->setCellValue("A$i",$Date);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$i",$Job);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$i",$Tutor);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$i",$Amount);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$i",$Rate);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$Note);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$i",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$i",$DateTutor);
        	$objPHPExcel->getActiveSheet()->setCellValue("I$i",$PaidTutor);
        	$objPHPExcel->getActiveSheet()->setCellValue("J$i",$GP);
        	$objPHPExcel->getActiveSheet()->setCellValue("K$i",$Hour);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$i",$NoteTutor);    	    
        	
    	        $SumAmount = mysqli_query($conn," SELECT SUM(no4) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAisyah['main_id']."' AND tab_name = '".$rowAisyah['tab_name']."' AND month = '".$rowAisyah['month']."'  "); 
    	        $rowSumAmount = mysqli_fetch_assoc($SumAmount); 
    	        $sumSumAmount = $rowSumAmount['value_sum'];    	    
        	
    	        $SumRate = mysqli_query($conn," SELECT SUM(no8) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAisyah['main_id']."' AND tab_name = '".$rowAisyah['tab_name']."' AND month = '".$rowAisyah['month']."'  "); 
    	        $rowSumRate = mysqli_fetch_assoc($SumRate); 
    	        $sumSumRate = $rowSumRate['value_sum']; 	    
        	
    	        $SumPaidTutor = mysqli_query($conn," SELECT SUM(no7) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAisyah['main_id']."' AND tab_name = '".$rowAisyah['tab_name']."' AND month = '".$rowAisyah['month']."'  "); 
    	        $rowSumPaidTutor = mysqli_fetch_assoc($SumPaidTutor); 
    	        $sumSumPaidTutor = $rowSumPaidTutor['value_sum'];  	    
        	
    	        $SumGP = mysqli_query($conn," SELECT SUM(no9) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAisyah['main_id']."' AND tab_name = '".$rowAisyah['tab_name']."' AND month = '".$rowAisyah['month']."'  "); 
    	        $rowSumGP = mysqli_fetch_assoc($SumGP); 
    	        $sumSumGP = $rowSumGP['value_sum'];  	    
        	
    	        $SumHour = mysqli_query($conn," SELECT SUM(no10) AS value_sum FROM tk_sales_sub WHERE main_id = '".$rowAisyah['main_id']."' AND tab_name = '".$rowAisyah['tab_name']."' AND month = '".$rowAisyah['month']."'  "); 
    	        $rowSumHour = mysqli_fetch_assoc($SumHour); 
    	        $sumSumHour = $rowSumHour['value_sum'];
        	
    	}else{
    	    $i++;$i++;
    	    $xx = $i - 1;
    	    $zz = $i - 2;
    	    
    	    if($Firtdata > 2){


    	        $objPHPExcel->getActiveSheet()->getCell("A$zz")->setValue('TOTAL');
    	        $objPHPExcel->getActiveSheet()->getCell("D$zz")->setValue($sumSumAmount);
    	        $objPHPExcel->getActiveSheet()->getCell("E$zz")->setValue($sumSumRate);
    	        $objPHPExcel->getActiveSheet()->getCell("I$zz")->setValue($sumSumPaidTutor);
    	        $objPHPExcel->getActiveSheet()->getCell("J$zz")->setValue($sumSumGP);
    	        $objPHPExcel->getActiveSheet()->getCell("K$zz")->setValue($sumSumHour);
    	        
    	        $objPHPExcel->getActiveSheet()->getStyle("A$zz:K$zz")->applyFromArray($styleSum);
    	        $objPHPExcel->getActiveSheet()->getStyle("A$zz:L$zz")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    	    }
    	    
    	    
    	    $objPHPExcel->getActiveSheet()->getCell("A$xx")->setValue($current);
    	    $objPHPExcel->getActiveSheet()->getStyle("A$xx")->applyFromArray($styleArray);
    	    $objPHPExcel->getActiveSheet()->getStyle("A$xx:L$xx")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('217346');
    	    
        	$objPHPExcel->getActiveSheet()->setCellValue("A$i",$Date);
        	$objPHPExcel->getActiveSheet()->setCellValue("B$i",$Job);
        	$objPHPExcel->getActiveSheet()->setCellValue("C$i",$Tutor);
        	$objPHPExcel->getActiveSheet()->setCellValue("D$i",$Amount);
        	$objPHPExcel->getActiveSheet()->setCellValue("E$i",$Rate);
        	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$Note);
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("G$i",'');
        	
        	$objPHPExcel->getActiveSheet()->setCellValue("H$i",$DateTutor);
        	$objPHPExcel->getActiveSheet()->setCellValue("I$i",$PaidTutor);
        	$objPHPExcel->getActiveSheet()->setCellValue("J$i",$GP);
        	$objPHPExcel->getActiveSheet()->setCellValue("K$i",$Hour);
        	$objPHPExcel->getActiveSheet()->setCellValue("L$i",$NoteTutor);
    	}
    	
    	
    $i++;
    $Firtdata++;
    $previous = $current;
    }
    
    if ( $last !== false ){
       $objPHPExcel->getActiveSheet()->getCell("A$i")->setValue('TOTAL');
       $objPHPExcel->getActiveSheet()->getCell("D$i")->setValue($sumSumAmount);
       $objPHPExcel->getActiveSheet()->getCell("E$i")->setValue($sumSumRate);
       $objPHPExcel->getActiveSheet()->getCell("I$i")->setValue($sumSumPaidTutor);
       $objPHPExcel->getActiveSheet()->getCell("J$i")->setValue($sumSumGP);
       $objPHPExcel->getActiveSheet()->getCell("K$i")->setValue($sumSumHour);
       
       $objPHPExcel->getActiveSheet()->getStyle("A$i:K$i")->applyFromArray($styleSum);
       $objPHPExcel->getActiveSheet()->getStyle("A$i:L$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    }
    
    
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
    
    /*
    if ( $last !== false ){
       $objPHPExcel->getActiveSheet()->getCell("B$i")->setValue('TOTAL');
       $objPHPExcel->getActiveSheet()->getCell("C$i")->setValue($sumSumAmount);
       
       $objPHPExcel->getActiveSheet()->getStyle("A$i:D$i")->applyFromArray($styleSum);
       $objPHPExcel->getActiveSheet()->getStyle("A$i:D$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a6a6a6');
    }*/
    $objPHPExcel->getActiveSheet()->setTitle('Summary');
    $objPHPExcel->createSheet();
// END Summary







/* Redirect output to a client’s web browser (Excel5)*/
header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="sales.xls"');
header('Content-Disposition: attachment;filename="'.$thisFilename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');


?>