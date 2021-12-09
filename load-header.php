<?PHP
require_once('includes/head.php'); 

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if( (isset($_POST['val']) && $_POST['val'] != '')  ) {
    

    $allAdmin = array();
    $queryAdmin = " SELECT * FROM tk_user WHERE u_role = '2' "; 
    $resultAdmin = $conn->query($queryAdmin); 
    if($resultAdmin->num_rows > 0){ 
        while($rowAdmin = $resultAdmin->fetch_assoc()){ 
            $allAdmin[] = $rowAdmin['u_id'];
        }     
    }
    

    $allLink = array();
    $allLink = [];

    $queryRatingT = " SELECT rr_tutor_id, rr_status, rr_parent_id, AVG(rr_rating) FROM tk_review_rating WHERE rr_status = 'approved' AND rr_parent_id IN ( '" . implode( "', '" , $allAdmin ) . "' ) GROUP BY rr_tutor_id  "; 
    $resultRatingT = $conn->query($queryRatingT); 
    if($resultRatingT->num_rows > 0){ 
        while($rowRatingT = $resultRatingT->fetch_assoc()){
            if($rowRatingT['AVG(rr_rating)'] >= 4){
                $allLink[] = $rowRatingT['rr_tutor_id'];
            }
        } 
    }
    
    if( !empty($allLink) ) {
        //echo count($allLink);
        //echo implode(", ",$allLink);
        $sqlUser = "SELECT * FROM tk_applied_job 
        INNER JOIN tk_job ON tk_applied_job.aj_j_id = tk_job.j_id
        WHERE aj_u_id IN ( '" . implode( "', '" , $allLink ) . "' ) AND j_status='open' GROUP BY aj_j_id ";
        $resultUser = $conn->query($sqlUser); 
        if($resultUser->num_rows > 0){ 
            echo $resultUser->num_rows;
        }else{
            echo '';
        }
    }else{
        echo '';
    }   
    
}
?>