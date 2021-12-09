<?php
if(!isset($_POST)) {
	header('location:a-fadhli-test.php');
	exit();
}
?>

<?php
$name         = $_POST['name'];
$email        = $_POST['email'];
$address      = $_POST['address'];
$picture_link = $_POST['picture_link'];


$myCanvas = $_POST['myCanvas'];
?>
<?php

$html = '
<style>
    @page {
      size: auto;
      sheet-size: A4;
      header: myHTMLHeader1;
      footer: myHTMLFooter1;
    }
</style>

<htmlpageheader name="myHTMLHeader1">
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 15pt; color: #000088;"><tr>
<td width="8%"><img src="images/logo.png" height="60" /></td>
<td width="59%"><div align="left">Mitrajit\'s Tech Blog</div><div align="left" style="font-size:14.5px;">Generate PDF</div></td>
<td width="33%" style="text-align: right;">&nbsp;</td>
</tr></table>
<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 11pt;">
	<tr>
		<th align="right">Dated : '.date("d-m-Y H:i:s").'</th>
	</tr>
</table>
</htmlpageheader>
<htmlpagefooter name="myHTMLFooter1">
    <table width="100%" style="border-top: 1px solid #000000;font-size:11px;">
        <tr>
            <th align="left">&copy; Mitrajit\'s Tech Blog</th>
            <td align="right">Printed on : {DATE d-m-Y} | Page {PAGENO} of {nb}</td>
        </tr>
    </table>
</htmlpagefooter>

<u>TERMS OF ACCEPTING HOME TUITION JOB</u>
<br/><br/>

<ol>
  <li> TutorKami will handle the collection of all payments from parent/student/tuition center (hereinafter called ‘the Client’) on behalf of you.
  </li><br/>
  <li> If Client decides to discontinue with you after the FIRST lesson (because they feel you are incompetent or unsuitable), the lesson will be deemed <u>a free trial session</u>. <b>You will not receive any payment</b>. No commission will be charged on you in return.
  </li><br/>
  <li> Your payment will be transferred to you once you have completed 1 cycle of classes. One (1) cycle is the total hours of lessons that is scheduled to be done in 4 weeks. For example, if Client requests for 1.5 hours of class per week, then 1 cycle is 6 hours. If Client request for 3 hours per week, then 1 cycle = 12 hours of class.
  </li><br/>
  <li> Payment amounts are based on the agreed rates (as stated in ‘Job Details’). Please record the dates & times of all the classes you have done every week and send it via What’s App or email it to us before your payment can be made.
  </li><br/>
  <li> You also agree that <b>we will take a commission</b> from your first payment for getting you this job. Commission amount is as stated in ‘Job Details’.
  </li><br/>
  <li> All payments will be made by our Finance Manager (019-361 3956). If matters regarding payment is made or dealt by a staff other than the one mentioned here, please report it to our GM, Mr. Hambal (019-220 8594). This is to ensure your payment is taken care by the right person, so it will be done correctly & promptly.
  </li><br/>
  <li>Milk</li>
  <li>Milk</li>
  <li>Milk</li>
  <li>aaa '.$myCanvas.'</li>
</ol> 

<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 11pt;">
	<tr>
    <th rowspan="3">'.($picture_link != "" ? '<img src="'.$picture_link.'" style="padding:3px; border:2px solid #ccc; border-radious:5px; margin-right:5px;">' : '').'</th>
    <th align="left">Name : '.$name.'</th>
  </tr>
	<tr><th align="left">Email : '.$email.'</th></tr>
  <tr><th align="left">Address : '.$address.'</th></tr>
</table>
<pagebreak/>';


$filename = "xyz.pdf";
try {
  require_once("pdf/mpdf-library/vendor/autoload.php");

  $mpdf = new \Mpdf\Mpdf([
  	'mode' => 'c',
  	'margin_top' => 35,
  	'margin_bottom' => 17,
  	'margin_header' => 10,
  	'margin_footer' => 10,
  ]);

  $mpdf->showImageErrors = true;
  $mpdf->mirrorMargins = 1;
  $mpdf->SetTitle('Generate PDF file using PHP and MPDF | Mitrajit\'s Tech Blog');
  $mpdf->WriteHTML($html);
  $mpdf->Output($filename, 'I');
} catch(\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}
?>