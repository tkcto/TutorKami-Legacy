<?php
/* Database connection start */
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$connect = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($connect->connect_error) {
    die("connection failed : " . $connect->connect_error);
} else {
    // echo "Successfully Connected";
}
/* Database connection end */
date_default_timezone_set("Asia/Kuala_Lumpur");
if( !empty($_POST['displayid']) && !empty($_POST['dataURL']) ){

	$displayid = $_POST['displayid'];               
	$base64data = $_POST['dataURL'];     
	//echo $displayid." - ".$base64data;

	$sql = "SELECT * FROM tk_user WHERE u_displayid = '$displayid'";
	$result = $connect->query($sql);
 
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id = $row['u_id'];
		$text =  date("d-m-Y")."_".date("H-i")."-1_".$id;
		$sql = "UPDATE tk_user SET signature_img = '$text' WHERE u_id = {$id}";
		
		define('UPLOAD_DIR', 'images/signature/');
		$img = $base64data;
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $text . '.png';
		$success = file_put_contents($file, $data);



		if($connect->query($sql) === TRUE) {
			/* HERE - RATING FUNCTION */

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

			$queryProof1 = "SELECT pmt_id, pmt_lastupdated, pmt_time FROM tk_page_manage_translation WHERE pmt_id='76' "; 
			$resultProof1 = $connect->query($queryProof1); 
			if($resultProof1->num_rows > 0){
				$rowProof1 = $resultProof1->fetch_assoc();
				$timeSaveTerms = $rowProof1['pmt_time'];
				
				$getSig = $text;
				$getSig = strtok($getSig, '_');
				$getSig = str_replace('-', '/', $getSig);
				
				$getTime = getBetween($text,"_","_");
				if(strlen($getTime) == '7'){
					$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
				}else{
					$getTime = str_replace("-",":",$getTime).':00';
				}
				
				$b = explode('/',$getSig);
				$dateFormat = (int)($b[2].$b[1].$b[0]);
				
				$a = explode('/',$rowProof1['pmt_lastupdated']);
				$dateFormat2 = (int)($a[2].$a[1].$a[0]);
				
				$rateComment = date('d/m/Y').' -System Signature Form (3)';
			
				if($dateFormat2 > $dateFormat){
				}else if($dateFormat2 < $dateFormat){
					//green
					if( $row['u_role'] == '3' ){
						$sqlInternalRating = " SELECT ri_tutor, ri_signed, ri_comments FROM tk_review_rating_internal WHERE ri_tutor = '".$row['u_id']."' ";
						$resultInternalRating = $connect->query($sqlInternalRating);
						if($resultInternalRating->num_rows > 0){
							$rowInternalRating = $resultInternalRating->fetch_assoc();
							$newComment = $rateComment.'\n'.$rowInternalRating['ri_comments'];
							
							if( $rowInternalRating['ri_signed'] != 'true' ){
    							$allotSql = " UPDATE tk_review_rating_internal SET ri_signed = 'true', ri_comments = '".$newComment."' WHERE ri_tutor = '".$row['u_id']."' ";
    							if($connect->query($allotSql) === TRUE) {}							    
							}

						}else{
							$allotSql = " INSERT INTO tk_review_rating_internal SET ri_tutor = '".$row['u_id']."', ri_signed = 'true', ri_comments = '".$rateComment."' ";
							if($connect->query($allotSql) === TRUE) {}					
						}					
					}
				}else if($dateFormat2 = $dateFormat){
					if($timeSaveTerms >= $getTime){
					}else{
						//green
						if( $row['u_role'] == '3' ){
							$sqlInternalRating = " SELECT ri_tutor, ri_signed, ri_comments FROM tk_review_rating_internal WHERE ri_tutor = '".$row['u_id']."' ";
							$resultInternalRating = $connect->query($sqlInternalRating);
							if($resultInternalRating->num_rows > 0){
								$rowInternalRating = $resultInternalRating->fetch_assoc();
								$newComment = $rateComment.'\n'.$rowInternalRating['ri_comments'];
								
								if( $rowInternalRating['ri_signed'] != 'true' ){
    								$allotSql = " UPDATE tk_review_rating_internal SET ri_signed = 'true', ri_comments = '".$newComment."' WHERE ri_tutor = '".$row['u_id']."' ";
    								if($connect->query($allotSql) === TRUE) {}								    
								}

							}else{
								$allotSql = " INSERT INTO tk_review_rating_internal SET ri_tutor = '".$row['u_id']."', ri_signed = 'true', ri_comments = '".$rateComment."' ";
								if($connect->query($allotSql) === TRUE) {}					
							}					
						}
					}
				}else{}
			}

			/* HERE - RATING FUNCTION */
			echo "Succcessfully Updated";
		} else {
			echo "Erorr while updating record : ". $connect->error;
		}
	} 
	$connect->close();
}
?>