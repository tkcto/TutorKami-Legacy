<?php function numtowords($num){ 
$decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            );
$ones = array( 
            0 => " ",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            ); 
$tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
            ); 
$hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
            ); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
        $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
        $rettxt .= $tens[substr($i,0,1)]; 
        $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        $rettxt .= " ".$tens[substr($i,1,1)]; 
        $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
    } 

} 
$rettxt = $rettxt." only";

if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
        $rettxt .= $decones[$decnum]; 
    }
    elseif($decnum < 100){ 
        $rettxt .= $tens[substr($decnum,0,1)]; 
        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    }
    $rettxt = $rettxt." centavo/s"; 
} 
return $rettxt;} ?>

<?php
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");


    $json_url = 'https://script.googleusercontent.com/macros/echo?user_content_key=AgcClU718zABx8W_ShQyieQSwLMXfju-NRebz4DRYBureBjUGdtXvL6Z9yzeHcVa-WB7m_ipR0erkG8x1oziQDc72a5phWt0m5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnI5gbfiTVnU7A908nnLntL233QnryashgWzc_TN9cFNG2GmaB-PGipstgj6JiDyEf9veWPraiRQB&lib=MYf4g5hIgD2zXTO9OIyoHII9LPg1umDcO';

    $json = file_get_contents($json_url);


    
$data = json_decode($json, true);
$entries = $data['user'];
if( !empty($_GET['date']) ){
foreach ($entries as $entry) {

    $date = date("d/m/Y", strtotime($entry['date']));
    $job = $entry['job'];
    $tutor = $entry['tutor'];
    $amount = $entry['amount'];
    $amountWord = numtowords($amount);

$queryJob = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
$resultQueryJob = $conn->query($queryJob); 
if($resultQueryJob->num_rows > 0){ 
	$rowQueryJob = $resultQueryJob->fetch_assoc();
	$qJobId = $rowQueryJob['j_email'];
	$qJobPhone = $rowQueryJob['j_telephone'];
	
	$queryUser = " SELECT * FROM tk_user WHERE u_email='".$qJobId."'  ";
    $resultQueryUser = $conn->query($queryUser); 
    if($resultQueryUser->num_rows > 0){ 
	    $rowQueryUser = $resultQueryUser->fetch_assoc();
    	$qUser = $rowQueryUser['u_id'];
    	
    	$queryUserD = " SELECT * FROM tk_user_details WHERE ud_u_id='".$qUser."'  ";
    	$resultQueryUserD = $conn->query($queryUserD); 
    	if($resultQueryUserD->num_rows > 0){ 
	        $rowQueryUserD = $resultQueryUserD->fetch_assoc();
        	$qUserD = $rowQueryUserD['ud_first_name'];
    	
    	}
    	
	    
    }
}
    
$timestamp = strtotime($_GET['date']);
$new_date = date("d/m/Y", $timestamp);
     
     $date2 = date("d/m/Y", strtotime($_GET['date']));
    //if($date == '15/01/2019'){

    if($date == $new_date){
        //echo $date.' - '.$job.' - '.$tutor.' - '.$amount.'<br/>';
	
$html = '
<style>
    @page {
      size: auto;
      sheet-size: A4;
      header: myHTMLHeader1;
    }
	
* {
  box-sizing: border-box;
}

body {
  font-size: 12px;
  font-family: "Times New Roman", Times, serif;
}

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}



.gallery-text {
    float: left;
    width: 48%;
    margin: 1%;
}
.gallery-text p {
    word-break: break-all;
}

</style>



<div class="row" style="margin-top:-100px">
  <div class="column">
    <img src="https://www.tutorkami.com/images/logo.png" alt="Snow" style="width:100%">
  </div>
  <div class="column" style="margin-left:30%">
	<br/>
		<p align="right">
		OFFICIAL RECEIPT <br/> Receipt No: R578513
		</p>
  </div>
</div>
<br/>


<p align="left">
    27-2, Jalan Selasih U12/J, Seksyen U12, Taman Cahaya Alam, Shah Alam 40170 Selangor
	<br/><br/>
	Email: finance@tutorkami.com

</p>





<div class="row" style="margin-left:20%;">
  <div class="column">
  </div>
  <div class="column" style="margin-left:30%">
		<div id="gallery-text">
			<div class="gallery-text" style="margin-top:-15px;">
				<p>Date </p>
			</div>
			<div class="gallery-text" style="margin-top:-2px;">
				<p>'.$date.'</p>
			</div>  
		</div>
  </div>
</div>


<p align="left">
    Received from: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$qUserD.', '.$qJobPhone.'
	<br/><br/>
	Ringgit Malaysia '.$amountWord.'
	

</p>


<div class="row" style="margin-left:20%;">
  <div class="column">
  </div>
  <div class="column" style="margin-left:30%">
		<div id="gallery-text">
			<div class="gallery-text" style="margin-top:-15px;">
				<p>RM </p>
			</div>
			<div class="gallery-text" style="margin-top:-2px;">
				<p>'.$amount.'</p>
			</div>  
		</div>
  </div>
</div>


<p align="left">
    Payment for: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$date.' - '.$job.' - '.$tutor.' - '.$amount.'
	<br/><br/>
	Issued by: Finance Manager (019-3613956)

</p>



<p align="center">
    <br/><br/><br/>
    THANK YOU

	<br/><br/>
	TutorKami is a company under TK Edu Sdn Bhd (1161349-W) <br/>
	Note: This receipt is computer generated and no signature is required

</p>














';
//$filename = $rowUser['u_displayid']."_tutorkami.pdf";
$filename = "resit_tutorkami.pdf";
try {
  require_once("../pdf/mpdf-library/vendor/autoload.php");

  $mpdf = new \Mpdf\Mpdf([
  	'mode' => 'c',
  	'margin_top' => 35,
  	'margin_bottom' => 17,
  	'margin_header' => 10,
	'default_font_size' => 8,
	'default_font' => 'Times New Roman'
  ]);

  $mpdf->showImageErrors = true;
  $mpdf->mirrorMargins = 1;
  $mpdf->SetTitle('Google | tutorkami.com');
  $mpdf->WriteHTML($html);
  $mpdf->Output($filename, 'I');
} catch(\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}
		
		
		
        break;
    }
    
}

}else{
    echo 'Please Insert Date';
}   


   
?>

