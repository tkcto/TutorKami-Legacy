<?php
//https://codepen.io/g13nn/pen/VLZEgE

require_once('classes/config.php.inc');

require_once('classes/template-email.class.php');
$instNews = new template;


// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if($_POST["actualEmail"]){


    $date       = $_POST['date'];
    
$dateInput = explode('/',$_POST['date']);
$newdate = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
    
    
    
    $job        = $_POST['jobID'];//'6996';
    $tutor      = $_POST['tutor'];
	$amount     = number_format($_POST['amount'], 2); //float with 2 decimal places: .00
	$hours      = $_POST['hours']; 
 
    $emailDummy = 'tkfinance.malaysia@gmail.com';
    
    
	$qeJob2 = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
	$resQueryJob2 = $conn->query($qeJob2); 
	if($resQueryJob2->num_rows > 0){
	    $rQJob2 = $resQueryJob2->fetch_assoc();
	    if( $rQJob2['cycle'] == '' || $rQJob2['cycle'] == NULL ){
	        //echo "Empty Cycle";
	        //exit();
	    }
	}
    

	if($_POST['checkbox'] == 'true'){
		
		$checkbox   = 'Registration fees';
		if($_POST['rfAmount'] != ''){
			$rf = number_format($_POST['rfAmount'], 2);
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
	
	

$queryClasses = " SELECT * FROM tk_classes WHERE cl_display_id='".$_POST["jobID"]."'  ";
$resultClasses = $conn->query($queryClasses); 
if($resultClasses->num_rows > 0){ 
    //$cycle = 'xx';
    

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
	}

	$qCycle = " SELECT * FROM tk_payment_history WHERE ph_user_id='".$thisParent."' ORDER BY ph_id DESC  ";
	$resCycle = $conn->query($qCycle); 
	if($resCycle->num_rows > 0){
	    $rQCycle = $resCycle->fetch_assoc();
	    $cycle = (((int)$rQCycle['ph_receipt']) + 1);
    }else{
        $cycle = '1';
    }
	
        $last_id = 'no test';

    
    
    
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


	$qCycle = " SELECT * FROM tk_payment_history WHERE ph_user_id='".$thisParent."' ORDER BY ph_id DESC  ";
	$resCycle = $conn->query($qCycle); 
	if($resCycle->num_rows > 0){
	    $rQCycle = $resCycle->fetch_assoc();
	    $cycle = (((int)$rQCycle['ph_receipt']) + 1);
    }else{
        $cycle = '1';
    }
	
    $last_id = 'no test';


    
	}
}
	/**************************************************************/

	
	/**************************************************************/

	

    $pad_length = 2;
    $pad_char = 0;

    $thisCycle = str_pad($cycle, $pad_length, $pad_char, STR_PAD_LEFT);


	
	
	
	
	
	
   
    $Sub     = array(
        $_POST['actualEmail']
    );

    $subject = 'Receipt ';
    $footer = 'bi';


/*

    $message  = '
Dear '.$qUserD.'<br/><br/>

Attached is your receipt.<br/><br/>


Thank you.<br/>
Best Regards,<br/>
Finance Manager<br/>
<a href="https://www.tutorkami.com" target="_blank">www.tutorkami.com</a>
<br/>




<html>
<head>

    <title>Grid Master Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    
    <style type="text/css">
    
        .ReadMsgBody { width: 100%; background-color: #F1F1F1; }
        .ExternalClass { width: 100%; background-color: #F1F1F1; }
        body { width: 100%; background-color: #f6f6f6; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; font-family: Arial, Times, serif }
        table { border-collapse: collapse !important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        *[class*="mobileOn"] { display: none !important; max-height: none !important; }
        
        

        
        @-ms-viewport{ width: device-width; }
        
        @media only screen and (max-width: 639px){
        .wrapper{ width:100%;  padding: 0 !important; }
        }    
        @media only screen and (max-width: 480px){ 
        .centerClass{ margin:0 auto !important; } 
        .imgClass{width:100% !important; height:auto;}    
        .wrapper{ width:320px;  padding: 0 !important; }      
        .container{ width:300px;  padding: 0 !important; }
        .mobile{ width:300px; display:block; padding: 0 !important; text-align:center; }
        .mobile50{ width:300px; padding: 0 !important; text-align:center; }
        *[class="mobileOff"] { width: 0px !important; display: none !important; }
        *[class*="mobileOn"] { display: block !important; max-height: none !important; }
        }
    
    </style>
    
	

</head>
<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0" yahoo="fix" style="background-color:#; font-family:Arial,serif;margin:0;padding:0;min-width: 100%; -webkit-text-size-adjust:none;-ms-text-size-adjust:none;">




<center>
    <table width="600" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td width="100%" valign="top" align="center">
      

<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
				  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="50%" class="mobile" style="font-size:32pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        <b>RECEIPT</b>
                    </td>
                    <td width="50%" class="mobile" style="font-size:32pt; color:#272264; font-family:Bebas Neue; line-height:10px;"align="right">
                            <img width="" height="50" src="https://www.tutorkami.com/images/logo.png">
                    </td>
                </tr>
            </table>
			
                  
        </td>
    </tr>
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>                        
</table> 
<hr style="border: 3px solid #DDDDDD;">


 
<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        <font style="border-left: 6px solid #272264; height: 32px;"></font>  &nbsp;<b>FROM</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        <font style="border-left: 6px solid #272264; height: 32px;"></font> &nbsp;<b>BILL TO</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        <font style="border-left: 6px solid #272264; height: 32px;"></font> &nbsp;<b>RECEIPT NO</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;" align="right">
                        &nbsp;<b>R'.$job.''.$thisCycle.'</b>
                    </td>                    
                </tr>
            </table>
			
                  
        </td>
    </tr>
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>                        
</table>  

<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        <b>TK EDU Sdn Bhd</b> 
                    </td>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        <b>'.$qUserD.'</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        <font style="border-left: 6px solid #272264; height: 32px;"></font> &nbsp;<b>RECEIPT DATE</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;" align="right">
                        <b>'.$date.'</b>
                    </td>                    
                </tr>
            </table>
			
                  
        </td>
    </tr>                      
</table> 
<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        <b>(1161349-W) </b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        <b>('.$qJobPhone.')</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        &nbsp;
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                         &nbsp;
                    </td>                    
                </tr>
            </table>
			
                  
        </td>
    </tr>
                     
</table> 
<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        <b>Contact No :</b> 
                    </td>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        &nbsp;
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        &nbsp;
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                         &nbsp;
                    </td>                    
                </tr>
            </table>
			
                  
        </td>
    </tr>
</table> 
<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        <b>019-3613956</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        &nbsp;
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        &nbsp;
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                         &nbsp;
                    </td>                    
                </tr>
            </table>
			
                  
        </td>
    </tr>
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>                        
</table> 


<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
				  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="50%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;">
                        <font style="border-left: 6px solid #272264; height: 32px;"></font>&nbsp;<b>DESCRIPTION</b>
                    </td>
                    <td width="50%" class="mobile" style="font-size:12pt; color:#272264; font-family:Bebas Neue; line-height:10px;" align="right">
                        <b>AMOUNT</b> &nbsp;<font style="border-left: 6px solid #272264; height: 32px;"></font>
                    </td>
                </tr>
            </table>
			
                  
        </td>
    </tr>
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>                        
</table> 

<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
				  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        <b>'.$tutor.' '.$hours.' hours of classes</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;" align="right">
                        <b>'.$amount.'</b> 
                    </td>
                </tr>
            </table>
			
                  
        </td>
    </tr>
                     
</table> 
';

if($checkbox != ''){
    
$message  .= '
<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
				  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;">
                        <b>'.$checkbox.'</b>
                    </td>
                    <td width="25%" class="mobile" style="font-size:10pt; color:#595959; font-family:Century Gothic; line-height:10px;" align="right">
                        <b>'.$rf.'</b> 
                    </td>
                </tr>
            </table>
			
                  
        </td>
    </tr>
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>                        
</table> 
';    

}


$message  .= '
<table width="100%" >
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>
    <tr>
        <td align="center">
                  
				  
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                <tr>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#595959; font-family:Bebas Neue; line-height:10px;">
                        
                    </td>
                    <td width="25%" class="mobile" style="font-size:12pt; color:#f1592a; font-family:Bebas Neue; line-height:10px;" align="right">
                        <b>TOTAL &emsp;RM '.$total.'</b> 
                    </td>
                </tr>
            </table>
			
                  
        </td>
    </tr>
    <tr>
        <td height="10" style="font-size:10px; line-height:10px;"> </td>
    </tr>                        
</table> 

<br/><br/>
<hr style="border: 3px solid #DDDDDD;">
            
            </td>
        </tr>
    </table>
</center>
    
</body>
</html>
        
        ';
*/
        
//https://codepen.io/palashbasak/pen/jBRyvV https://www.bootdey.com/snippets/view/Invoice-receipt#preview http://www.phpkida.com/demos/html-invoice-email-template-free-download/index.html
    $message  = '
Dear '.$qUserD.'<br/><br/>

Attached is your receipt.<br/><br/>


Thank you.<br/>
Best Regards,<br/>
Finance Manager<br/>
<a href="https://www.tutorkami.com" target="_blank">www.tutorkami.com</a>
<br/>




<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  border: 0px solid black;
} 

th,td {
  border: 0px solid black;
}

table.d {
  table-layout: fixed;
  width: 100%;  
}

.right {
    float: right;
}
.left {
    float: left;
}

.font {
   font-family: "Times New Roman", Times, serif;
   color: #272264;
   font-weight: bold;
}
.total {
   font-family: "Times New Roman", Times, serif;
   color: #f1592a;
   font-weight: bold;
}
.desc {
   font-family: "century Gothic", century Gothic;
   color: #595959;
   font-weight: bold;
}

.vl {
  border-left: 3px solid #272264;
}







/* 
  ##Device = Desktops
  ##Screen = 1281px to higher resolution desktops
*/
@media (min-width: 1281px) {
	.phoneContent {display:none;}
	.deskContent {display:block;}
}

/* 
  ##Device = Laptops, Desktops
  ##Screen = B/w 1025px to 1280px
*/
@media (min-width: 1025px) and (max-width: 1280px) {
	.phoneContent {display:none;}
	.deskContent {display:block;}
}

/* 
  ##Device = Tablets, Ipads (portrait)
  ##Screen = B/w 768px to 1024px
*/
@media (min-width: 768px) and (max-width: 1024px) {
	.phoneContent {display:none;}
	.deskContent {display:block;}
}

/* 
  ##Device = Tablets, Ipads (landscape)
  ##Screen = B/w 768px to 1024px
*/
@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
}

/* 
  ##Device = Low Resolution Tablets, Mobiles (Landscape)
  ##Screen = B/w 481px to 767px
*/
@media (min-width: 481px) and (max-width: 767px) {
	.phoneContent {display:block;}
	.deskContent {display:none;}
}

/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/
@media (min-width: 320px) and (max-width: 480px) {
	.phoneContent {display:block;}
	.deskContent {display:none;}
}






</style>
</head>
<body style="max-width:680px">

<div class="deskContent"> </div>
<div class="phoneContent">
</div>

<center></center>
<table class="d">
  <tr>
    <td>  <font size="6" style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;RECEIPT</font></td>
    <td><img src="https://www.tutorkami.com/images/logo.png" height="40" alt="Facebook" align="right"  ></td>
  </tr>
</table>

<hr style="border: 2px solid #DDDDDD;">

<table class="d">
  <tr>
    <td> <font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;FROM</font></td>
    <td align="right"><font style="font-family: Times, serif;color: #272264;font-weight: bold;border-right: 3px solid #272264;">BILL TO &nbsp;</font></td>
  </tr>
  
  <tr>
    <td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">TK EDU Sdn Bhd</font></td>
    <td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$qUserD.'</font></td>   
  </tr>
  <tr>
    <td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">(1161349-W)</font></td>
    <td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">('.$qJobPhone.')</font></td>
  </tr>
  <tr>
    <td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">Contact no :</font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">019-3613956</font></td>
    <td>&nbsp;</td>
  </tr>

  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
  
  <tr>
    <td> <font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;RECEIPT NO</font></td>
    <td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">R'.$job.''.$thisCycle.'</font></td>
  </tr>
  <tr>
    <td>  <font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;RECEIPT DATE</font></td>
    <td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$date.'</font></td>
  </tr>  
  
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
 
  <tr>
    <td> <font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;DESCRIPTION</font></td>
    <td align="right"><font style="font-family: Times, serif;color: #272264;font-weight: bold;border-right: 3px solid #272264;">AMOUNT &nbsp;</font></td>
  </tr>
  <tr>
    <td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$tutor.' '.$hours.' hours of classes</font></td>
    <td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$amount.'</font></td>
  </tr>  
';  

if($checkbox != ''){
$message  .= '  
  <tr>
    <td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$checkbox.'</font></td>
    <td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$rf.'</font></td>
  </tr>  
';  
}
$message  .= '  
  <tr>
    <td><font style="font-family: Times, serif;color: #f1592a;font-weight: bold;">TOTAL</font></td>
    <td align="right"><font style="font-family: Times, serif;color: #f1592a;font-weight: bold;">RM '.$total.'</font></td>
  </tr>
  
</table>
<br/>

<table class="d">
</table>


<hr style="border: 2px solid #DDDDDD;">












</body>
</html>













        ';
        

        
        

        

        

        $m       = $instNews->sendEmailTemplate('', $Sub, $subject, $message, $footer);
        
        
        if ($m) {
            echo 'Mail been sent successfully!';
        } else {
            echo 'Mail cannot be sent!';
        }


 
   
   
   
}
?>
