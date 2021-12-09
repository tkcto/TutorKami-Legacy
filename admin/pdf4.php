<?php
date_default_timezone_set("Asia/Kuala_Lumpur");

require_once('classes/config.php.inc');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
	$queryTCBI = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='83'");
	$resTCBI = $queryTCBI->num_rows;
	if($resTCBI > 0){
		if($rowTCBI = $queryTCBI->fetch_assoc()){ 
			$Content = htmlspecialchars_decode($rowTCBI['pmt_pagedetail']);
		}
	}else{
		$Content = "";
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
		<th align="right"></th>
	</tr>
</table>
</htmlpageheader>

			'.$Content.'
			
';


$filename = "Group Tuition(BM).pdf";
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
  $mpdf->SetTitle('Terms Of Accepting Group Tuition | tutorkami.com');
  $mpdf->WriteHTML($html);
  $mpdf->Output($filename, 'D');
} catch(\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}

?>