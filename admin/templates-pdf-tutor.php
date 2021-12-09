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

    $last       = $_GET['last'];

$qPay = " SELECT * FROM tk_payment_history WHERE ph_id='".$_GET['last']."'  ";
$resPay = $conn->query($qPay); 
if($resPay->num_rows > 0){
    $rPay = $resPay->fetch_assoc();


    $pad_length = 2;
    $pad_char = 0;
    
    if( $rPay['ph_receipt'] == 'trial paid' ){
        $thisCycle = 'T';
    }else{
        $thisCycle = str_pad($rPay['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT);
    }

    $cycle = $rPay['ph_job_id'].$thisCycle;

    $date = date("d/m/Y", strtotime($rPay['ph_date']));
    
    $tutor = $rPay['tutor'];
    $hours = $rPay['hour'];
    
    if( $rPay['description'] != '' ){
        
        if( $rPay['ph_receipt'] == 'trial paid' ){
            $desc = $rPay['description'].' (Trial Session)';
        }else{
            $desc = $rPay['description'].' (Cycle #'.$rPay['ph_receipt'].')';
        }
    }else{
        if( $rPay['ph_receipt'] == 'trial paid' ){
            $desc = 'hours of tuition classes (Trial Session)';
        }else{
            $desc = 'hours of tuition classes (Cycle #'.$rPay['ph_receipt'].')';
        }
    }
    
	    
	$qeJob = " SELECT * FROM tk_job WHERE j_id='".$rPay['ph_job_id']."'  ";
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
		
	}

    if( $rPay['ph_rf'] != '' ){
        if( $rPay['ph_rf'] == '0.00' || $rPay['ph_rf'] == '0' ){
            $checkbox   = '';
            $rf = '';
        }else{
		    if( $rPay['description_rf'] != '' ){
		        $checkbox   = $rPay['description_rf'];
		    }else{
		        $checkbox   = 'Registration fees';
		    }
		    $rf = number_format(($rPay['ph_rf']), 2);
        }
    }else{
        $checkbox   = '';
        $rf = '';
    }
/*
	if( $rPay['ph_rf'] != '0.00'){
		
		$checkbox   = 'Registration fees';
		$rf = $rPay['ph_rf'];
		
	}else{
		$checkbox   = '';
		$rf = $rPay['ph_rf'];
	}	
*/
	
	$total = number_format(($rPay['ph_amount'] + $rf), 2);
	//$amount = number_format(($rPay['ph_amount'] - $rPay['ph_rf']), 2);   

	$thisamount     = $rPay['ph_amount'];
	$thisamount2  = str_replace(",", "", $thisamount);
	$thisamount3 = $thisamount2 - $rf;
	$amount = number_format(($thisamount3), 2);
	$amount2 = number_format(($rPay['ph_amount']), 2);
	
	     
	     
	$queryJob = " SELECT * FROM tk_job WHERE j_id='".$rPay['ph_job_id']."'  ";
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
				$qUserD = ucwords($rowQueryUserD['ud_first_name']);
			}
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


<table cellspacing="20">
  <tr>
    <td> <font style="font-size:30pt; color:#272264; font-family:Bebas Neue; line-height:18px;"><b>PAYMENT VOUCHER</b></font> </td>
    <td align="right"><img src="https://www.tutorkami.com/images/logo.png" alt="Snow" ></td>
  </tr>
</table>

<br/>
<hr style="border: 5px solid #DDDDDD;">
<br/><br/>
<table cellspacing="20">
  <tr>
  <td>  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;FROM</b></font>         </td>
  <td style="padding-left: 20px;">  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;PAID TO</b></font>       </td>
  <td>  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;PV NO</b></font>  </td>
  <td align="right">  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>PV'.$cycle.'</b></font>     </td>
  </tr>

  <tr>
  <td>  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>TK Edu Sdn Bhd</b></font>  </td>
  <td style="padding-left: 20px;">  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$tutor.'</b></font>       </td>
  <td>  <br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;PAYMENT DATE</b></font>    </td>
  <td align="right">  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$date.'</b></font>      </td>
  </tr>
  
  <tr>
  <td>  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>(1161349-W)</b></font>     </td>
  <td style="padding-left: 20px;">  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b></b></font>    </td>
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
    <td> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Job '.$rPay['ph_job_id'].' - '.$hours.' '.$desc.'</b></font> </td>
    <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$amount2.'</b></font> </td>
  </tr>
</table>
';

if($checkbox != ''){
    $html .= '
        <table cellspacing="20">
          <tr>
            <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$checkbox.'</b></font> </td>
            <td align="right"> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$rf.'</b></font> </td>
          </tr>
        </table>
    ';
}

if($rPay['ph_remarks'] != ''){
    $html .= '
        <table cellspacing="20">
          <tr>
            <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$rPay['ph_remarks'].'</b></font> </td>
            <td align="right"> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b></b></font> </td>
          </tr>
        </table>
    ';
}

$html .= '
<table cellspacing="20">
  <tr>
';
$html .= '
  </tr>
  <tr>
    <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>&nbsp;</b></font> </td>
    <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:15pt; color:#f1592a; font-family:Bebas Neue; line-height:18px;"><b>TOTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RM '.$total.'</b></font> </td>
  </tr>
</table>

<br/><br/><br/><br/>



<table>
    <tr>
        <td> 
            <img border="0" src="../images/signature/ShikinPV.jpeg" width="200" height="100"><br/>
            ______________________________________________
            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Prepared by :</b></font>
            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Nur Ashikin Muzapa</b></font>
            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Finance Manager TutorKami.com</b></font>
        </td>
        <td  style="padding-right: -80px;">  
            <img border="0" src="../images/signature/ShikinPV2.jpg" width="200" height="100"><br/>
            ______________________________________________
            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Received by</b></font>
            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>&nbsp;</b></font>
            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>&nbsp;</b></font>
        </td>
    </tr>
</table>






</body>
</html>







';
	$filename = "PV".$job."".$cycle." ".$tutor.".pdf";
	
	try {
		require_once("../pdf/mpdf-library/vendor/autoload.php");

// <img border="0" src="../images/signature/06-09-2020_21-39-1_1579981.png" width="200" height="100">


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
	$mpdf->SetTitle('Generate PV | tutorkami.com');
	$mpdf->WriteHTML($html);
	//$mpdf->Output($filename, 'D');
	$mpdf->Output($filename, 'I');
	} catch(\Mpdf\MpdfException $e) {
		echo $e->getMessage();
	}

		
		


/*
}else{
    echo 'Error';
}   
*/

   
?>