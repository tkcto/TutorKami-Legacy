<?php
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*
if( !empty($_GET['date']) && !empty($_GET['job']) && !empty($_GET['tutor']) && !empty($_GET['amount']) ){
*/ 

/*

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
  font-size: 11px;
  font-family: Courier;
}

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}

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
.right {
  text-align: center;
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
    27-2, Jalan Selasih U12/J,  
	<br/>Seksyen U12, Taman Cahaya Alam,<br/>Shah Alam 40170 Selangor
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
				<p class="right" style="margin-right:-20px">'.$date.'</p>
			</div>  
		</div>
  </div>
</div>

<p align="left">
    Received from: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$qUserD.', '.$qJobPhone.'
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
				<p class="right" style="margin-right:-50px" >'.number_format(($amount + $rf), 2).'</p>
			</div>  
		</div>
  </div>
</div>


<p align="left">
    Payment for: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$tutor .'&#39;s '.$hours.' hours of classes '.$checkbox.'
	<br/><br/>
	Issued by: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Finance Manager (019-3613956)

</p>

<p align="center">
    <br/><br/><br/>
    THANK YOU

	<br/><br/>
	TutorKami is a company under TK Edu Sdn Bhd (1161349-W) <br/>
	Note: This receipt is computer generated and no signature is required

</p>

';
*/

    $last       = $_GET['last'];
    $date       = $_GET['date'];
    $job        = $_GET['jobID'];//'6996';
    $tutor      = $_GET['tutor'];
	$amount     = number_format($_GET['amount'], 2); //float with 2 decimal places: .00
	$hours      = $_GET['hours']; 


$queryClasses = " SELECT * FROM tk_classes WHERE cl_display_id='".$_GET["jobID"]."'  ";
$resultClasses = $conn->query($queryClasses); 
if($resultClasses->num_rows > 0){ 
    //$cycle = 'xx';
    

	$qCycle = " SELECT * FROM tk_payment_history WHERE ph_id='".$last."'  ";
	$resCycle = $conn->query($qCycle); 
	if($resCycle->num_rows > 0){
	    $rQCycle = $resCycle->fetch_assoc();
	    $cycle = $rQCycle['ph_receipt'];
	    
    $pad_length = 2;
    $pad_char = 0;

    $thisCycle = str_pad($cycle, $pad_length, $pad_char, STR_PAD_LEFT);
	    
	    
	    
    }
    
    
    
}else{

    
	$qeJob = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
	$resQueryJob = $conn->query($qeJob); 
	if($resQueryJob->num_rows > 0){
	    $rQJob = $resQueryJob->fetch_assoc();
	   
	
		$qParent = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_email']."'  ";
		$rParent = $conn->query($qParent); 
		if($rParent->num_rows > 0){ 
			$rowParent = $rParent->fetch_assoc();
			$thisParent = $rowParent['u_id'];
		}	
		$qTutor = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_hired_tutor_email']."'  ";
		$rTutor = $conn->query($qTutor); 
		if($rTutor->num_rows > 0){ 
			$rowTutor = $rTutor->fetch_assoc();
			$thisutor = $rowTutor['u_id'];
		}
		$qSubject = " SELECT * FROM tk_job_translation WHERE jt_j_id='".$job."'  ";
		$rSubject = $conn->query($qSubject); 
		if($rSubject->num_rows > 0){ 
			$rowSubject = $rSubject->fetch_assoc();
			$thisSubject = $rowSubject['jt_subject'];
		}
		
	$qCycle = " SELECT * FROM tk_payment_history WHERE ph_id='".$last."'  ";
	$resCycle = $conn->query($qCycle); 
	if($resCycle->num_rows > 0){
	    $rQCycle = $resCycle->fetch_assoc();
	    $cycle = $rQCycle['ph_receipt'];
	    

    $pad_length = 2;
    $pad_char = 0;

    $thisCycle = str_pad($cycle, $pad_length, $pad_char, STR_PAD_LEFT);
	    
    }
		
		

    
	}
}
	

	if($_GET['checkbox'] == 'true'){
		
		$checkbox   = 'Registration fees';
		if($_GET['rfAmount'] != ''){
			$rf = number_format($_GET['rfAmount'], 2);
		}else{
			$rf = number_format('50', 2);   
		}
		
	}else{
		$checkbox   = '';
		$rf = number_format('0', 2); 
	}
	
	$total = number_format(($amount + $rf), 2);

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
			$u_displayid = $rowQueryUser['u_displayid'];
    	
			$queryUserD = " SELECT * FROM tk_user_details WHERE ud_u_id='".$qUser."'  ";
			$resultQueryUserD = $conn->query($queryUserD); 
			if($resultQueryUserD->num_rows > 0){ 
				$rowQueryUserD = $resultQueryUserD->fetch_assoc();
				$qUserD = $rowQueryUserD['ud_first_name'];
			}
		}
	}
	
	
	




$html = '

<!DOCTYPE html>
<html>
<head>
<style>
table, td, th {
  border: 0px solid black;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th {
  text-align: left;
}
</style>
</head>
<body>

<br/><br/>
<table cellspacing="20">
  <tr>
    <td> <font style="font-size:40pt; color:#272264; font-family:Bebas Neue; line-height:18px;"><b>RECEIPT</b></font> </td>
    <td align="right"><img src="https://www.tutorkami.com/images/logo.png" alt="Snow" ></td>
  </tr>
</table>

<br/>
<hr style="border: 5px solid #DDDDDD;">
<br/><br/>
<table cellspacing="20">
  <tr>
  <td>  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;FROM</b></font>         </td>
  <td style="padding-left: 20px;">  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;BILL TO</b></font>       </td>
  <td>  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;RECEIPT NO</b></font>  </td>
  <td align="right">  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>R'.$job.''.$thisCycle.'</b></font>     </td>
  </tr>

  <tr>
  <td>  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>TK Edu Sdn Bhd</b></font>  </td>
  <td style="padding-left: 20px;">  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$qUserD.'</b></font>       </td>
  <td>  <br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;RECEIPT DATE</b></font>    </td>
  <td align="right">  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$date.'</b></font>      </td>
  </tr>
  
  <tr>
  <td>  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>(1161349-W)</b></font>     </td>
  <td style="padding-left: 20px;">  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>('.$qJobPhone.')</b></font>    </td>
  <td></td>
  <td></td>
  </tr>
  <tr>
  <td>    <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Contact No :</b></font>  </td>
  <td></td>
  <td></td>
  <td></td>
  </tr>
  <tr>
  <td>    <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>019-3613956</b></font> </td>
  <td></td>
  <td></td>
  <td></td>
</tr>
</table>

<br/>

<table cellspacing="20">
  <tr>
    <td> <br/><br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;DESCRIPTION</b></font>  </td>
    <td align="right"> <br/><br/><font style="border-right: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>AMOUNT&nbsp;</b></font>  </td>
  </tr>
  <tr>
    <td> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$tutor.' '.$hours.' hours of classes</b></font> </td>
    <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$amount.'</b></font> </td>
  </tr>
</table>


<table cellspacing="20">
  <tr>
';

if($checkbox != ''){
    
$html .= '

    <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$checkbox.'</b></font> </td>
    <td align="right"> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$rf.'</b></font> </td>
';
}

    
$html .= '
  </tr>
  <tr>
    <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>&nbsp;</b></font> </td>
    <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:15pt; color:#f1592a; font-family:Bebas Neue; line-height:18px;"><b>TOTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RM '.$total.'</b></font> </td>
  </tr>
</table>

<br/><br/>
<hr style="border: 5px solid #DDDDDD;">
<br/><br/>




</body>
</html>







';


	$filename = "Receipt-".$tutor."-".$date.".pdf";
	
	try {
		require_once("../pdf/mpdf-library/vendor/autoload.php");




		$mpdf = new \Mpdf\Mpdf([
			//'mode' => 'c',
			'margin_top' => 35,
			'margin_bottom' => 17,
			'margin_header' => 10,
			'default_font_size' => 8,
			'default_font' => 'Times New Roman',
			

    'mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'L'
			
	]);

	$mpdf->showImageErrors = true;
	$mpdf->mirrorMargins = 1;
	$mpdf->SetTitle('Generate Receipt | tutorkami.com');
	$mpdf->WriteHTML($html);
	$mpdf->Output($filename, 'D');
	//$mpdf->Output($filename, 'I');
	} catch(\Mpdf\MpdfException $e) {
		echo $e->getMessage();
	}

		
		


/*
}else{
    echo 'Error';
}   
*/

   
?>