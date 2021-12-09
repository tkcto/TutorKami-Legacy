<?php

date_default_timezone_set("Asia/Kuala_Lumpur");


    $json_url = 'https://script.googleusercontent.com/macros/echo?user_content_key=1BBScDq1Ck5tMVEBrvhkpQ7sZeao8vechkMxPEaTQJjgx7ssnVSPxHr-YaMIoKrXJY_meYeVjMFhyUyLPf0L73wHFZbIICXTm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnGAXeH36Eb4oZ9eApsUqZO6CM-Zv4ddTYIHBH1iDq98ipRNrDQH7HmoosO5XOfgajEW-dnclfdIe&lib=M-Kh6XKUQwC9rXqFu4aesQo9LPg1umDcO';

    $json = file_get_contents($json_url);
//echo $json.'<br/>';
/*
foreach($json->user as $record){
    echo $record->id;
    echo $record->name;
}
    */

    
$data = json_decode($json, true);
$entries = $data['user'];

foreach ($entries as $entry) {
    //$date = $entry['date'];
    $date = date("d/m/Y", strtotime($entry['date']));
    $job = $entry['job'];
    $tutor = $entry['tutor'];
    $amount = $entry['amount'];
    
    //echo date('d/m/Y',strtotime($date));
    //echo date("d/m/Y", strtotime($date)).'<br/>';
    //echo $date.' - '.$job.' - '.$tutor.' - '.$amount.'<br/>';
     //break;
    if($date == '28/11/2019'){
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
    Received from: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Puan Syakima, 0122500402
	<br/><br/>
	Ringgit Malaysia Tiga Ratus Tiga Puluh Sahaja 

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
   

   /*

$html = '
<style>
    @page {
      size: auto;
      sheet-size: A4;
      header: myHTMLHeader1;
    }
</style>

<htmlpageheader name="myHTMLHeader1">
<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 11pt;">
	<tr>
		<th align="right"><img src="https://www.tutorkami.com/images/logo.png" height="60" /></th>
	</tr>
</table>
</htmlpageheader>

			'.$Content.'
			
<p align="right">I have read and agreed to all the terms above</p>


<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 11pt;">
    <thead>
        <tr>
            <th style="width: 65%; padding:0;"> </th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td style="width: 65%; padding:0;"></td>
                <td><img src="https://www.tutorkami.com/images/logo.png" height="25%" width="35%" /></td>
            </tr>
            <tr>
                <td style="padding:0;"></td>
                <td><p>Name : '.$fullname.'</p></td>
            </tr>
            <tr>
                <td style="padding:0;"></td>
                <td><p>Date : '.$first.'</p></td>
            </tr>

    </tbody>
</table>

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
}*/


   
?>


