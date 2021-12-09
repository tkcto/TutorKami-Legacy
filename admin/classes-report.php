<?php
date_default_timezone_set("Asia/Kuala_Lumpur");


$HOSTNAME = "localhost";
$DB_USER = "tutorka1_live";
$DB_PASS= "_+11pj,oow.L";
$DBNAME = "tutorka1_tutorkami_db";

$conn = new mysqli($HOSTNAME, $DB_USER, $DB_PASS, $DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if(isset($_GET['report'])) {
   
	$qClasses = $conn->query(" SELECT * FROM tk_classes_record WHERE cr_id='$_GET[report]' ");
	$rClasses = $qClasses->num_rows;
	if($rClasses > 0){
		if($roClasses = $qClasses->fetch_assoc()){ 
			$secID =  $roClasses['cr_cl_id'];
			$noClass =  $roClasses['cr_classes'];
			
			$qClasses2 = $conn->query(" SELECT * FROM tk_classes WHERE cl_id='$secID' ");
			$rClasses2 = $qClasses2->num_rows;
			if($rClasses2 > 0){
				if($roClasses2 = $qClasses2->fetch_assoc()){ 
					$displayID =  $roClasses2['cl_display_id'];
					$tutorid =  $roClasses2['cl_tutor_id'];
					$studentname =  $roClasses2['cl_student'];
					$subject =  $roClasses2['cl_subject'];
					
					$userDetails = $conn->query(" SELECT * FROM tk_user WHERE u_id='$tutorid' ");
					$ruserDetails = $userDetails->num_rows;
					if($ruserDetails > 0){
						if($rouserDetails = $userDetails->fetch_assoc()){ 
							$tutorname =  $rouserDetails['u_displayname'];
						}
					}
					
					
					
					
				}
				
			}
			
			
		}
	}
	
$html = '
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #f1592a;
  color: white;
}


    @page {
      size: auto;
      sheet-size: A4;
      header: myHTMLHeader1;
    }
	
#info {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  width: 100%;
  font-size: 12px;
}
#info td, #info th {
  padding: 8px;
}
#info th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;

}
	
</style>

<htmlpageheader name="myHTMLHeader1">



<table id="info" width="100%" border="0">

<tr valign="top">
<td bgcolor="" width="8%"><b>ID</b></td>
<td bgcolor="" width="35%" > <b>:</b> '.$displayID.'</td>
<td bgcolor="" width="15%"><b>Tutor&#39;s Name</b></td>
<td bgcolor="" width="35%" > <b>:</b> '.$tutorname.'</td>
</tr>
<tr valign="top">
<td bgcolor="" width="8%"><b>Cycle</b></td>
<td bgcolor="" width="35%" > <b>:</b> '.$noClass.'</td>
<td bgcolor="" width="15%"><b>Student&#39;s Name</b></td>
<td bgcolor="" width="35%" > <b>:</b> '.$studentname.'</td>
</tr>

<tr valign="top">
<td bgcolor="" width="8%"><b>Subject</b></td>
<td bgcolor="" width="35%" > <b>:</b> '.$subject.'</td>
</tr>


</table>



<table id="customers">
  <tr>
    <th>Date</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Duration</th>
    <th>Tutors Remarks</th>
    <th>Parent Verification</th>
    <th>Parent Remarks</th>
  </tr>
';
 
	$queryClasses = $conn->query(" SELECT * FROM tk_classes_record WHERE cr_id='$_GET[report]' ");
	$resClasses = $queryClasses->num_rows;
	if($resClasses > 0){
		if($rowClasses = $queryClasses->fetch_assoc()){ 
			$cr_cl_id =  $rowClasses['cr_cl_id'];
			$newDate = date("d/m/Y", strtotime($rowClasses['cr_date']));
 if (strpos($rowClasses['cr_start_time'], 'PM') !== false) {
    $startTime = str_replace("PM"," PM",$rowClasses['cr_start_time']);
 } else {
    $startTime = str_replace("AM"," AM",$rowClasses['cr_start_time']);
 }

 if (strpos($rowClasses['cr_end_time'], 'PM') !== false) {
    $endTime = str_replace("PM"," PM",$rowClasses['cr_end_time']);
 } else {
    $endTime = str_replace("AM"," AM",$rowClasses['cr_end_time']);
 }
 
if( $rowClasses["cr_parent_verification"] =='' ){
    $parentVer = '';
}else if( $rowClasses["cr_parent_verification"]=='done' ){
    $parentVer = '<font color=green>Correct</font>';
}else if( $rowClasses["cr_parent_verification"]=='notdone' ){
    $parentVer = '<font color=red>Incorrect</font>';
}else{
    $parentVer = '';
}
			
			

$html .= '



  <tr>
    <td>'.$newDate.'</td>
    <td>'.$startTime.'</td>
    <td>'.$endTime.'</td>
    <td>'.$rowClasses['cr_duration'].'</td>
    <td>'.$rowClasses['cr_tutor_report'].'</td>
    <td>'.$parentVer.'</td>
    <td>'.$rowClasses['cr_parent_remark'].'</td>
  </tr>
';

			//$queryClasses2 = $conn->query(" SELECT * FROM tk_classes_record WHERE cr_id <='$_GET[report]' AND cr_status!='Tutor Paid' AND cr_cl_id='$cr_cl_id' ORDER BY cr_id DESC ");
			//$queryClasses2 = $conn->query(" SELECT * FROM tk_classes_record WHERE (cr_status !='yes') AND cr_cl_id='$cr_cl_id' ORDER BY cr_id DESC ");
			//$queryClasses2 = $conn->query(" SELECT * FROM tk_classes_record WHERE (cr_status !='yes' AND cr_status !='Tutor Paid') AND cr_id <= '$_GET[report]' AND cr_cl_id='$cr_cl_id' ORDER BY cr_id DESC ");
			//$queryClasses2 = $conn->query(" SELECT * FROM tk_classes_record WHERE cr_status IN('yes','new','new cycle') AND cr_id <= '$_GET[report]' AND cr_cl_id='$cr_cl_id' ORDER BY cr_id DESC ");
			//IN('Four','Seven')
			$queryClasses2 = $conn->query(" SELECT * FROM tk_classes_record WHERE cr_id < '$_GET[report]' AND cr_cl_id='$cr_cl_id' ORDER BY cr_id DESC ");
			
			$resClasses2 = $queryClasses2->num_rows;
			if($resClasses2 > 0){
			    while($rowClasses2 = $queryClasses2->fetch_assoc()){ 
			        if($rowClasses2['cr_status'] == 'Tutor Paid' ){		            
			        break;
			        }
			        $newDate2 = date("d/m/Y", strtotime($rowClasses2['cr_date']));
 if (strpos($rowClasses2['cr_start_time'], 'PM') !== false) {
    $startTime2 = str_replace("PM"," PM",$rowClasses2['cr_start_time']);
 } else {
    $startTime2 = str_replace("AM"," AM",$rowClasses2['cr_start_time']);
 }

 if (strpos($rowClasses2['cr_end_time'], 'PM') !== false) {
    $endTime2 = str_replace("PM"," PM",$rowClasses2['cr_end_time']);
 } else {
    $endTime2 = str_replace("AM"," AM",$rowClasses2['cr_end_time']);
 }
 
if( $rowClasses2["cr_parent_verification"] == '' ){
    $parentVer2 = '';
}else if( $rowClasses2["cr_parent_verification"] == 'done' ){
    $parentVer2 = '<font color=green>Correct</font>';
}else if( $rowClasses2["cr_parent_verification"] == 'notdone' ){
    $parentVer2 = '<font color=red>Incorrect</font>';
}else{
    $parentVer2 = '';
}

$html .= '

  <tr>
    <td>'.$newDate2.'</td>
    <td>'.$startTime2.'</td>
    <td>'.$endTime2.'</td>
    <td>'.$rowClasses2['cr_duration'].'</td>
    <td>'.$rowClasses2['cr_tutor_report'].'</td>
    <td>'.$parentVer2.'</td>
    <td>'.$rowClasses2['cr_parent_remark'].'</td>
  </tr>
';	

			    }
			}
		}
	}
/*	
$html .= '

  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
    <td>Germany</td>
    <td>Germany</td>
    <td>Germany</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Berglunds snabbköp</td>
    <td>Christina Berglund</td>
    <td>Sweden</td>
    <td>Germany</td>
    <td>Germany</td>
    <td>Germany</td>
    <td>Germany</td>
  </tr>
  
</table>
';
*/

$html .= '</table>';

$filename = "classes-report_tutorkami.pdf";
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
  $mpdf->SetTitle('Classes Report | tutorkami.com');
  $mpdf->WriteHTML($html);
  $mpdf->Output($filename, 'I');
} catch(\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}
  
    
}
?>