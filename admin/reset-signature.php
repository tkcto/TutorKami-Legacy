<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_POST['dataReset'])){
	$dataReset = $_POST['dataReset'];
	if( !empty($dataReset["id"]) ){

							if( $_SESSION['tk']['u_id'] == '2' ){
								$thisUser = '[C1]';
							}else if( $_SESSION['tk']['u_id'] == '3' ){
								$thisUser = '[FM]';
							}else if( $_SESSION['tk']['u_id'] == '4' ){
								$thisUser = '[C2]';
							}else if( $_SESSION['tk']['u_id'] == '5' ){
								$thisUser = '[C3]';
							}else if( $_SESSION['tk']['u_id'] == '6' ){
								$thisUser = '[MM]';
							}else if( $_SESSION['tk']['u_id'] == '1581040' ){
								$thisUser = '[MM]';
							}else if( $_SESSION['tk']['u_id'] == '8' ){
								$thisUser = '[CTO]';
							}else if( $_SESSION['tk']['u_id'] == '1579926' ){
								$thisUser = '[AHN]';
							}else{
								$thisUser = '[NOT SET]';
							}
        
				$rateComment2 = date('d/m/Y').' -'.$thisUser.' Updated Profile (untick 3)';
				$queryUser = "SELECT * FROM tk_user WHERE u_displayid = '".$dataReset['id']."' "; 
				$resultyUser = $conn->query($queryUser); 
				if($resultyUser->num_rows > 0){ 
					$rowUser = $resultyUser->fetch_assoc();
					$signature_img = $rowUser['signature_img'];
					//echo $signature_img;
					if( $signature_img != NULL || $signature_img != '' ){
					    
					    unlink('../images/signature/'.$signature_img.'.png');
                        $sqlUpdate = "UPDATE tk_user SET signature_img = '' WHERE u_id = '".$rowUser['u_id']."'";
                        
            				$sqlInternalRating = " SELECT ri_tutor, ri_signed, ri_comments FROM tk_review_rating_internal WHERE ri_tutor = '".$rowUser['u_id']."' "; 
            				$resultInternalRating = $conn->query($sqlInternalRating); 
            				if($resultInternalRating->num_rows > 0){ 
            					$rowInternalRating = $resultInternalRating->fetch_assoc();
            					$newComment = $rateComment2.'\n'.$rowInternalRating['ri_comments'];
    										
            					if( $rowInternalRating['ri_signed'] != 'false' ){
            					    $allotSql = " UPDATE tk_review_rating_internal SET ri_signed = 'false', ri_comments = '".$newComment."' WHERE ri_tutor = '".$rowUser['u_id']."' ";
            					    $conn->query($allotSql);
            					}
            				}else{
            				    $allotSql = " INSERT INTO tk_review_rating_internal SET ri_tutor = '".$rowUser['u_id']."', ri_signed = 'false', ri_comments = '".$rateComment2."' ";
            				    $conn->query($allotSql);
            				}                        
                        
                        if ( ($conn->query($sqlUpdate) === TRUE) ) {
                            echo "Success";
                        } else {
                            echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
                        }
					    
					}else{
					    echo 'Empty Signature';
					}
				}else{
				    echo 'Error !';
				}
        
     
	}
}


if(isset($_POST['dataResetProof2'])){
	$dataResetProof2 = $_POST['dataResetProof2'];
	if( !empty($dataResetProof2["id"]) ){

				$queryUser = "SELECT * FROM tk_user WHERE u_displayid = '".$dataResetProof2['id']."' "; 
				$resultyUser = $conn->query($queryUser); 
				if($resultyUser->num_rows > 0){ 
					$rowUser = $resultyUser->fetch_assoc();
					$signature_img = $rowUser['signature_img2'];
					if( $signature_img != NULL || $signature_img != '' ){
					    
					    unlink('../images/signature/'.$signature_img.'.png');
                        $sqlUpdate = "UPDATE tk_user SET signature_img2 = '' WHERE u_id = '".$rowUser['u_id']."'";
                        if ( ($conn->query($sqlUpdate) === TRUE) ) {
                            echo "Success";
                        } else {
                            echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
                        } 
					    
					}else{
					    echo 'Empty Signature';
					}
				}else{
				    echo 'Error !';
				}
        
     
	}
}




$conn->close();
?>