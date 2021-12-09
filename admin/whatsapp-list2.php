<?php
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$requestData= $_REQUEST;
 
 
$columns = array(
    0 =>'JobID',
    1 => 'ApplyID',
    2=> 'action'/*,
    3=> 'status',
    4=> 'date'*/
);


    $allAdmin = array();
    $queryAdmin = " SELECT * FROM tk_user WHERE u_role = '2' "; 
    $resultAdmin = $conn->query($queryAdmin); 
    if($resultAdmin->num_rows > 0){ 
        while($rowAdmin = $resultAdmin->fetch_assoc()){ 
            $allAdmin[] = $rowAdmin['u_id'];
        }     
    }

$sql = "SELECT * FROM tk_review_rating
INNER JOIN tk_user ON tk_review_rating.rr_tutor_id = tk_user.u_id
";
 
$searchKeyWord = htmlspecialchars($requestData['search']['value']);
if( !empty($searchKeyWord) ) {

	$sql.=" WHERE rr_status = 'approved' AND rr_parent_id IN ( '" . implode( "', '" , $allAdmin ) . "' ) GROUP BY rr_tutor_id ";
    //$sql.=" AND j_id = '".$searchKeyWord."' ";
 
}else{
	$sql.=" WHERE rr_status = 'approved' AND rr_parent_id IN ( '" . implode( "', '" , $allAdmin ) . "' ) GROUP BY rr_tutor_id ";
}

	$query=mysqli_query($conn, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

    $sql.=" ORDER BY rr_id ASC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql);
 
 
$data = array();
while( $row=mysqli_fetch_array($query) ) {
	
 /*
$link_address = 'https://www.tutorkami.com/';
 
$action = '<button onClick="reply_click(this.id)" type="button" class="btn btn-success btn-xs" id="'.$row['j_id'].'">'.$row['j_id'].'</button>';
*/


/*
		//$queryAppply = " SELECT * FROM tk_applied_job WHERE aj_date >= '2020-01-01 00:00:00' GROUP BY aj_j_id "; 
		$queryAppply = " SELECT * FROM tk_applied_job 
		INNER JOIN tk_job ON tk_applied_job.aj_j_id = tk_job.j_id
		WHERE aj_u_id='".$row['rr_tutor_id']."' GROUP BY aj_j_id "; 
		$resultAppply = $conn->query($queryAppply); 
		if ($resultAppply->num_rows > 0) {
			while($jAppply = $resultAppply->fetch_assoc()){
				$data[] = [ 'JobID'=>$jAppply['j_id'],'ApplyID'=>$row['rr_tutor_id'],'action'=>$row['rr_parent_id']  ];
			}
				
			
		}*/

/*
		$queryAppply = " SELECT * FROM tk_job 
		LEFT JOIN tk_applied_job ON tk_job.j_id = tk_applied_job.aj_j_id
		WHERE aj_u_id='".$row['rr_tutor_id']."' GROUP BY tk_job.j_id "; 
		$resultAppply = $conn->query($queryAppply); 
		if ($resultAppply->num_rows > 0) {
			while($jAppply = $resultAppply->fetch_assoc()){
				$data[] = [ 'JobID'=>$jAppply['j_id'],'ApplyID'=>$row['rr_tutor_id'],'action'=>$row['rr_parent_id']  ];
			}
				
			
		}
*/
		$queryAppply = " SELECT * FROM tk_applied_job 
		WHERE aj_u_id='".$row['rr_tutor_id']."' GROUP BY aj_j_id "; 
		$resultAppply = $conn->query($queryAppply); 
		if ($resultAppply->num_rows > 0) {
			while($jAppply = $resultAppply->fetch_assoc()){
				$data[] = [ 'JobID'=>$jAppply['aj_j_id'],'ApplyID'=>$jAppply['aj_u_id'],'action'=>$jAppply['aj_id']  ];
			}
				
			
		}



/*
			$allLink = array();
			$allLink = [];
			$allLink2 = array();
			$allLink2 = [];
			
							$purataRatingT = 0;
							$numRowRatingT = 0;
							$purataT = '';
							$queryRatingT = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$row['rr_tutor_id']."' AND rr_status = 'approved' AND rr_parent_id IN ( '" . implode( "', '" , $allAdmin ) . "' ) "; 
							$resultRatingT = $conn->query($queryRatingT); 
							if($resultRatingT->num_rows > 0){ 
								while($rowRatingT = $resultRatingT->fetch_assoc()){  
									   $purataRatingT+=  $rowRatingT['rr_rating'];
									   $numRowRatingT++;
								} 
								$purataT = ($purataRatingT / $numRowRatingT);
								if($purataT >= 0.5){
									$sendTutorProfile = 'https://www.tutorkami.com/tutor_profile?did='.$row['u_displayid'];
									$allLink[] = $sendTutorProfile;
									$allLink2[] = $row['u_id'];
								}
							}
							if( !empty($allLink) && !empty($allLink2) ) {
								$parentPhoneNo = '0122372526';
								$headerTitle = rawurlencode('This is an automatic message sent from TutorKami.com as you have given us permission to auto send you tutor’s profiles. Please do not reply to this what’s app message. If you don’t want to receive this message anymore, please inform our Coordinator. Thank you.');
										
									$linkValue = " https://wa.me/6".$parentPhoneNo."?text=".$headerTitle.'%0A%0A'; foreach($allLink as $linkProfileTutor){ $linkValue .= $linkProfileTutor.'%0A%0A'; }
									$action = '<a href="'.$linkValue.'" target="_blank">Link</a>';
									$data[] = [ 'JobID'=>$row['rr_id'],'ApplyID'=>$row['rr_tutor_id'],'action'=>$action  ];
										
							}

*/
//$data[] = [ 'JobID'=>$row['rr_id'],'ApplyID'=>$row['rr_tutor_id'],'action'=>$row['rr_parent_id']  ];


}
 
 
 
$json_data = array(
    "draw"            => intval( $requestData['draw'] ),
    "recordsTotal"    => intval( $totalData ),
    "recordsFiltered" => intval( $totalFiltered ),
    "data"            => $data
);
 
echo json_encode($json_data);


?>