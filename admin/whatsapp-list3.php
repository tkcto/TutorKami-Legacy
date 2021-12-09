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
 
$sql = "SELECT * FROM tk_applied_job
INNER JOIN tk_job ON tk_applied_job.aj_j_id = tk_job.j_id
LEFT JOIN tk_user ON tk_applied_job.aj_u_id = tk_user.u_id
";
// INNER JOIN tk_job ON tk_applied_job.aj_j_id = tk_job.j_id
$searchKeyWord = htmlspecialchars($requestData['search']['value']);
if( !empty($searchKeyWord) ) {
	$sql.=" WHERE j_status = 'open'  ";
	$sql.=" AND j_id = '".$searchKeyWord."' ";
	$sql.=" OR u_displayid = '".$searchKeyWord."' ";
	$sql.=" GROUP BY aj_j_id   ";
	//$sql.=" WHERE j_id = '7635' GROUP BY j_id ";
    //$sql.=" AND j_id = '".$searchKeyWord."' ";
 
}else{
	$sql.=" WHERE j_status = 'open'  ";
	$sql.=" GROUP BY aj_j_id   ";
	//$sql.=" WHERE j_id = '7635' GROUP BY j_id ";
}

	$query=mysqli_query($conn, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

    $sql.=" ORDER BY aj_j_id DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql);
 
    $allAdmin = array();
    $queryAdmin = " SELECT * FROM tk_user WHERE u_role = '2' "; 
    $resultAdmin = $conn->query($queryAdmin); 
    if($resultAdmin->num_rows > 0){ 
        while($rowAdmin = $resultAdmin->fetch_assoc()){ 
            $allAdmin[] = $rowAdmin['u_id'];
        }     
    }
	
	
	
$data = array();
while( $row=mysqli_fetch_array($query) ) {	
 
 	$arrUser = array();
	$arrUser = [];
	$queryAppply = " SELECT * FROM tk_applied_job WHERE aj_j_id = '".$row['aj_j_id']."' "; 
	$resultAppply = $conn->query($queryAppply); 
	if ($resultAppply->num_rows > 0) {
		while( $jAppply = $resultAppply->fetch_assoc() ){
			$arrUser[] = $jAppply['aj_u_id'];
		}
		
		if( !empty($arrUser) ) {

							$purataRatingT = 0;
							$numRowRatingT = 0;
							$purataT = '';
							$allLink = array();
							$allLink = [];
							$allLink2 = array();
							$allLink2 = [];
							
							$queryRatingT = " SELECT rr_tutor_id, rr_status, rr_parent_id, AVG(rr_rating) FROM tk_review_rating WHERE rr_tutor_id IN ( '" . implode( "', '" , $arrUser ) . "' ) AND rr_status = 'approved' AND rr_parent_id IN ( '" . implode( "', '" , $allAdmin ) . "' ) GROUP BY rr_tutor_id  "; 
							$resultRatingT = $conn->query($queryRatingT); 
							if($resultRatingT->num_rows > 0){ 
								while($rowRatingT = $resultRatingT->fetch_assoc()){
									if($rowRatingT['AVG(rr_rating)'] >= 4){
										$allLink[] = $rowRatingT['rr_tutor_id'];
									}
								} 
							}
								if( !empty($allLink) ) {
									
									$ApplyID = '';
									$queryUser = " SELECT * FROM tk_user WHERE u_id IN ( '" . implode( "', '" , $allLink ) . "' ) "; 
									$resultUser = $conn->query($queryUser); 
									if($resultUser->num_rows > 0){ 
										while($rowUser = $resultUser->fetch_assoc()){
											$ApplyID .= ' <a target="_blank" href="https://www.tutorkami.com/admin/manage_user?action=edit&u_id='.$rowUser['u_displayid'].'" class="btn btn-success btn-xs" role="button" aria-pressed="true" >'.$rowUser['u_displayid'].'</a> ';

										} 
									}
									//$ApplyID = implode(',',$allLink);
									$recordJob = $row['j_id'].'*** ';
									
									$queryDisabled = " SELECT * FROM tk_send_wa WHERE wa_job_id = '".$row['j_id']."' "; 
									$resultDisabled = $conn->query($queryDisabled); 
									if($resultDisabled->num_rows > 0){ 
										$action = '<button disabled onClick="reply_click(this.id)" type="button" class="btn btn-send btn-xs" id="'.$recordJob.''.implode(',',$allLink).'"> SEND </button>';
									}else{
										$action = '<button onClick="reply_click(this.id)" type="button" class="btn btn-send btn-xs" id="'.$recordJob.''.implode(',',$allLink).'"> SEND </button>';
									}
									
								}else{
									$ApplyID = '';
									$queryUser = " SELECT * FROM tk_user WHERE u_id IN ( '" . implode( "', '" , $arrUser ) . "' ) "; 
									$resultUser = $conn->query($queryUser); 
									if($resultUser->num_rows > 0){ 
										while($rowUser = $resultUser->fetch_assoc()){
											$ApplyID .= ' <a target="_blank" href="https://www.tutorkami.com/admin/manage_user?action=edit&u_id='.$rowUser['u_displayid'].'" class="btn btn-default btn-xs" role="button" aria-pressed="true" >'.$rowUser['u_displayid'].'</a> ';

										} 
									}
									//$ApplyID = implode(',',$arrUser);
									$action = '';
								}
								$recordJob = ' <a target="_blank" href="https://www.tutorkami.com/admin/job-edit?j='.$row['j_id'].'" class="btn btn-info btn-xs" role="button" aria-pressed="true" >'.$row['j_id'].'</a> ';
								$data[] = [ 'JobID'=>$recordJob,'ApplyID'=>$ApplyID,'action'=>$action  ];
			
		}
					
	}
 
 


}
 
 
 
$json_data = array(
    "draw"            => intval( $requestData['draw'] ),
    "recordsTotal"    => intval( $totalData ),  // totalData
    "recordsFiltered" => intval( $totalFiltered ), // totalFiltered
    "data"            => $data
);
 
echo json_encode($json_data);


?>