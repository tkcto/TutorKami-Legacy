
<?php
require_once('includes/head.php');

date_default_timezone_set("Asia/Kuala_Lumpur");

if (!isset($_SESSION['auth'])) {
  header('Location: login.php');
  exit();
}
$user_id = $_SESSION['auth']['user_id'];
$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);
$pix = $getUserDetails->data[0]->signature_img2;
$salutation = $getUserDetails->data[0]->salutation;
$firstname = $getUserDetails->data[0]->ud_first_name;
$fullname = ucwords($salutation.' '.$firstname);
$pixAll = $pix.".png";
$first = strtok($pix, '_');
if ($getUserDetails->data[0]->signature_img2 != '') {

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
if($getLan == "/my/"){	
	$queryTCBM = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='81'");
	$resTCBM = $queryTCBM->num_rows;
	if($resTCBM > 0){
		if($rowTCBM = $queryTCBM->fetch_assoc()){ 
			$Content = htmlspecialchars_decode($rowTCBM['pmt_pagedetail']);
		}
	}else{
		$Content = "";
	}
}else{
	$queryTCBI = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='80'");
	$resTCBI = $queryTCBI->num_rows;
	if($resTCBI > 0){
		if($rowTCBI = $queryTCBI->fetch_assoc()){ 
			$Content = htmlspecialchars_decode($rowTCBI['pmt_pagedetail']);
		}
	}else{
		$Content = "";
	}
}



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
		<th align="right"><img src="images/logo.png" height="60" /></th>
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
                <td><img src="images/signature/'.$pixAll.'" height="25%" width="35%" /></td>
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


$filename = $getUserDetails->data[0]->u_displayid."_tutorkami.pdf";
try {
  require_once("pdf/mpdf-library/vendor/autoload.php");

  $mpdf = new \Mpdf\Mpdf([
  	'mode' => 'c',
  	'margin_top' => 35,
  	'margin_bottom' => 17,
  	'margin_header' => 10,
	'default_font_size' => 10,
	'default_font' => 'Times New Roman'
  ]);

  $mpdf->showImageErrors = true;
  $mpdf->mirrorMargins = 1;
  $mpdf->SetTitle('Additional terms: Group Tuition | tutorkami.com');
  $mpdf->WriteHTML($html);
  $mpdf->Output($filename, 'I');
} catch(\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}
	
} else {
	header('clients-terms-group.php');
	exit();
}
?>