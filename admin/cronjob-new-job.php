<?php
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");


$todayDate = date('d/m/y');
$chgDate = explode('/', $todayDate); 

$dayDate   = $chgDate[0];
$monthDate = $chgDate[1];
$yearDate  = $chgDate[2];

/*echo 'Tarikh '.$todayDate.'<br>';
echo 'Hari '.$dayDate.'<br>';
echo 'Bulan '.$monthDate.'<br>';
echo 'Tahun '.$yearDate.'<br>';*/

// Hari ke 3 = 03 setiap bulan
if( $dayDate == '03' ){
    //$monthDate = '01';
    $num_padded = sprintf("%02d", ($monthDate - 1));
    if($num_padded == '00' ){
        $previousMonth = '12/'.($yearDate-1);
        //echo $previousMonth;
            $SalesFile = " SELECT * FROM tk_sales_sub WHERE no1 LIKE '%$previousMonth%' AND no11 LIKE '%NJ%' AND row_no != '999999' AND row_no != '0'  ";
            $resultSalesFile = $conn->query($SalesFile);
            if ($resultSalesFile->num_rows > 0) {
            	while($rowSalesFile = $resultSalesFile->fetch_assoc()){
            	    
                    $NewJobs = "INSERT INTO tk_new_jobs SET nj_year = '".$rowSalesFile['main_id']."', nj_name = '".$rowSalesFile['tab_name']."', nj_month = '".$rowSalesFile['month']."', nj_job = '".$rowSalesFile['no2']."' ";
                    $exe = $conn->query($NewJobs);
            	    
            	}
            }
    }else{
        $previousMonth = $num_padded.'/'.$yearDate;
        //echo $previousMonth;
            $SalesFile = " SELECT * FROM tk_sales_sub WHERE no1 LIKE '%$previousMonth%' AND no11 LIKE '%NJ%' AND row_no != '999999' AND row_no != '0'  ";
            $resultSalesFile = $conn->query($SalesFile);
            if ($resultSalesFile->num_rows > 0) {
            	while($rowSalesFile = $resultSalesFile->fetch_assoc()){
            	    
                    $NewJobs = "INSERT INTO tk_new_jobs SET nj_year = '".$rowSalesFile['main_id']."', nj_name = '".$rowSalesFile['tab_name']."', nj_month = '".$rowSalesFile['month']."', nj_job = '".$rowSalesFile['no2']."' ";
                    $exe = $conn->query($NewJobs);
            	    
            	}
            }
    }
}
$conn -> close();
?>