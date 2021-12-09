<?php
require_once('includes/head.php');

date_default_timezone_set("Asia/Kuala_Lumpur");


//$user_id = $_SESSION['auth']['user_id'];
/*$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}*/

function getBetween($string, $start = "", $end = ""){
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return '';
    }
}

if( isset($_GET["user"]) ) {

	
	$queryUser = $conDB->query(" SELECT * FROM tk_user LEFT JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id WHERE u_displayid='".$_GET["user"]."' ");
	$resUser = $queryUser->num_rows;
	if($resUser > 0){
		if($rowUser = $queryUser->fetch_assoc()){ 
			$pix = $rowUser['signature_img2'];
			$firstname = $rowUser['ud_first_name']; 
			$fullname = $firstname." ".$rowUser['ud_last_name'];
			$pixAll = $pix.".png";
			$first = strtok($pix, '_');
			if ( $rowUser['signature_img2'] != '' ) {

    		$getSig = str_replace('/', '-', $first);
    		$dateConvert = strtotime($getSig); 

    		//$dateFormat = date('Y-m-d', $dateConvert);
    		
    		$b = explode('-',$first);
    		$dateFormat = ($b[2].'-'.$b[1].'-'.$b[0]);
    		
        $getTime = getBetween($rowUser['signature_img2'],"_","_");
		//$getTime =  str_replace("-",":",substr($getTime, 0, -2)).':00';
		if(strlen($getTime) == '7'){
		    $getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
		}else{
		    $getTime = str_replace("-",":",$getTime).':00';
		}
     	    
                            //$queryProof1 = " SELECT * FROM ".DB_PREFIX."_history_terms WHERE ht_pmt_id='82' AND DATE_FORMAT(STR_TO_DATE(ht_date,'%d/%m/%Y'), '%Y-%m-%d') <= '".$dateFormat."' ORDER BY ht_id DESC"; 
                            $queryProof1 = " SELECT * FROM ".DB_PREFIX."_history_terms WHERE ht_pmt_id='82' AND DATE_FORMAT(STR_TO_DATE(ht_date,'%d/%m/%Y'), '%Y-%m-%d') <= '".$dateFormat."' AND ht_time <= '".$getTime."' ORDER BY ht_id DESC"; 
                            $resultProof1 = $conDB->query($queryProof1); 
                            if($resultProof1->num_rows > 0){ 
                                $rowProof1 = $resultProof1->fetch_assoc();
                                    
                               
                                $Content = htmlspecialchars_decode($rowProof1['ht_pmt_pagedetail']);

                        		
     
                        		


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
                <td><img src="https://www.tutorkami.com/images/signature/'.$pixAll.'" height="25%" width="35%" /></td>
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
$filename = $rowUser['u_displayid']."_tutorkami.pdf";
try {
  require_once("../pdf/mpdf-library/vendor/autoload.php");

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
  $mpdf->SetTitle('Group Tuition | tutorkami.com');
  $mpdf->WriteHTML($html);
  $mpdf->Output($filename, 'I');
} catch(\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}

                            }
			}
		}
	}
}
?>