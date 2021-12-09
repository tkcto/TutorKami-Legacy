<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

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

if(isset($_POST['dataUpdate'])){
	$dataUpdate = $_POST['dataUpdate'];
	if( !empty($dataUpdate["idBI"]) && !empty($dataUpdate["idBM"]) ){

    $myeditor = htmlspecialchars($dataUpdate['myeditor'], ENT_QUOTES);
    $myeditor2 = htmlspecialchars($dataUpdate['myeditor2'], ENT_QUOTES);        

    $historyBI = htmlspecialchars($dataUpdate['historyBI'], ENT_QUOTES);
    $historyBM = htmlspecialchars($dataUpdate['historyBM'], ENT_QUOTES);    
    
    
	    $sqlInsert = "INSERT INTO tk_history_terms (ht_pmt_id, ht_pmt_pagedetail, ht_date, ht_pmt_pagedetai_BM, ht_time) VALUES 
	    ('".$dataUpdate['idBI']."', '".$historyBI."', '".date('d/m/Y')."', '".$historyBM."', '".date('H:i')."')";
    
	    $sqlBI = "UPDATE tk_page_manage_translation SET pmt_pagedetail = '".$myeditor."', pmt_lastupdated = '".date('d/m/Y')."', pmt_noti = 'TRUE', pmt_time = '".date('H:i')."' WHERE pmt_id = '".$dataUpdate['idBI']."'";
	    $sqlBM = "UPDATE tk_page_manage_translation SET pmt_pagedetail = '".$myeditor2."', pmt_lastupdated = '".date('d/m/Y')."', pmt_noti = 'TRUE', pmt_time = '".date('H:i')."' WHERE pmt_id = '".$dataUpdate['idBM']."'";

        if ( ($conn->query($sqlInsert) === TRUE) && ($conn->query($sqlBI) === TRUE) && ($conn->query($sqlBM) === TRUE)  ) {
            /* HERE - RATING FUNCTION */

            $queryTerms = " SELECT pmt_id, pmt_lastupdated, pmt_time FROM tk_page_manage_translation WHERE pmt_id='76' "; 
			$resultTerms = $conn->query($queryTerms); 
			if($resultTerms->num_rows > 0){
			    $rowTerms = $resultTerms->fetch_assoc();
            		$a = explode('/',$rowTerms['pmt_lastupdated']);
            		$dateFormat2 = (int)($a[2].$a[1].$a[0]);
    				$timeSaveTerms = $rowTerms['pmt_time'];
			}
			
            $rateComment = date('d/m/Y').' -System Updated Terms (tick 3)';
            $rateComment2 = date('d/m/Y').' -System Updated Terms (untick 3)';
            $queryUser = " SELECT u_id, u_role, signature_img FROM tk_user WHERE u_role='3' AND signature_img !='' "; 
			$resultUser = $conn->query($queryUser); 
			if($resultUser->num_rows > 0){
				while($rowUser = $resultUser->fetch_assoc()){
				    //userID = $rowUser['u_id'];
				    $getSig = $rowUser['signature_img'];
				    $getSig = strtok($getSig, '_');
				    $getSig = str_replace('-', '/', $getSig);
				
				    $b = explode('/',$getSig);
				    $dateFormat = (int)($b[2].$b[1].$b[0]);
				    
    				$getTime = getBetween($rowUser['signature_img'],"_","_");
    				if(strlen($getTime) == '7'){
    					$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
    				}else{
    					$getTime = str_replace("-",":",$getTime).':00';
    				}
    				
    				
                    if($dateFormat2 > $dateFormat){
                        // yellow HERE
                        $sqlInternalRating = "SELECT ri_tutor, ri_signed, ri_comments FROM tk_review_rating_internal WHERE ri_tutor = '".$rowUser['u_id']."' ";
                        $resultInternalRating = $conn->query($sqlInternalRating);
                        if($resultInternalRating->num_rows > 0){
                            $rowInternalRating = $resultInternalRating->fetch_assoc();
                            $newComment = $rateComment2.'\n'.$rowInternalRating['ri_comments'];
                            
                            if( $rowInternalRating['ri_signed'] != 'false' ){
                                $allotSql = " UPDATE tk_review_rating_internal SET ri_signed = 'false', ri_comments = '".$newComment."' WHERE ri_tutor = '".$rowUser['u_id']."' ";
                                if ($conn->query($allotSql)){} else {}                                
                            }

                        }else{
                            $allotSql = " INSERT INTO tk_review_rating_internal SET ri_tutor = '".$rowUser['u_id']."', ri_signed = 'false', ri_comments = '".$rateComment2."' ";
                            if ($conn->query($allotSql)){} else {}
                        }
                    }else if($dateFormat2 < $dateFormat){
                        //green
                    }else if($dateFormat2 = $dateFormat){
                        if($timeSaveTerms >= $getTime){
                            // yellow HERE
                            $sqlInternalRating = "SELECT ri_tutor, ri_signed, ri_comments FROM tk_review_rating_internal WHERE ri_tutor = '".$rowUser['u_id']."' ";
                            $resultInternalRating = $conn->query($sqlInternalRating);
                            if($resultInternalRating->num_rows > 0){
                                $rowInternalRating = $resultInternalRating->fetch_assoc();
                                $newComment = $rateComment2.'\n'.$rowInternalRating['ri_comments'];
                                
                                if( $rowInternalRating['ri_signed'] != 'false' ){
                                    $allotSql = " UPDATE tk_review_rating_internal SET ri_signed = 'false', ri_comments = '".$newComment."' WHERE ri_tutor = '".$rowUser['u_id']."' ";
                                    if ($conn->query($allotSql)){} else {}                                    
                                }

                            }else{
                                $allotSql = " INSERT INTO tk_review_rating_internal SET ri_tutor = '".$rowUser['u_id']."', ri_signed = 'false', ri_comments = '".$rateComment2."' ";
                                if ($conn->query($allotSql)){} else {}
                            }
                        }else{
                           //green
                        }
                    }else{}
				}
			}

            /* HERE - RATING FUNCTION */       
            echo "Success! Record Has Been Saved";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }      
     
	}
}
$conn->close();
?>