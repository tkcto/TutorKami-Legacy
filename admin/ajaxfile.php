<?php
require_once('classes/dbCon.php');


$requestData= $_REQUEST;

$columns = array(
    0 =>'j_id',
    1 => 'j_create_date',
    2=> 'jlt_title',
    3=> 'jt_subject',
    4=> 'j_area',
    5=> 'city_name',
    6=> 'j_status',
    7=> 'j_payment_status',
    8=> 'aj_j_id',
    9=> 'j_deadline'
);


$sql = "SELECT * FROM tk_job";


if( isset($_POST['j_email']) || isset($_POST['j_rate']) || isset($_POST['j_hired_tutor_email']) || isset($_POST['j_telephone']) || isset($_POST['j_date']) || isset($_POST['j_jl_id']) || isset($_POST['j_state_id']) || isset($_POST['newCity']) || isset($_POST['j_status']) || isset($_POST['j_payment_status']) || isset($_POST['j_deadline']) || isset($_POST['j_start_date']) || isset($_POST['j_end_date']) || isset($_POST['sort_by']) || isset($_POST['j_creator_email']) ){
 $sql .= ' WHERE j_id IS NOT NULL ';
}

if( isset($_POST['j_email']) && $_POST['j_email'] != ''){
 $sql .= '
 AND j_email = "'.$_POST['j_email'].'"
 ';
}
if( isset($_POST['j_rate']) && $_POST['j_rate'] != ''){
 $sql .= '
 AND j_rate LIKE "'.$_POST['j_rate'].'%"
 ';
}
if( isset($_POST['j_hired_tutor_email']) && $_POST['j_hired_tutor_email'] != ''){
 $sql .= '
 AND j_hired_tutor_email = "'.$_POST['j_hired_tutor_email'].'"
 ';
}
if( isset($_POST['j_telephone']) && $_POST['j_telephone'] != ''){
 $sql .= '
 AND j_telephone = "'.$_POST['j_telephone'].'"
 ';
}
if( isset($_POST['j_date']) && $_POST['j_date'] != ''){
 $sql .= '
 AND j_create_date = "'.$_POST['j_date'].'"
 ';
}
if( isset($_POST['j_jl_id']) && $_POST['j_jl_id'] != ''){
 $sql .= '
 AND j_jl_id = "'.$_POST['j_jl_id'].'"
 ';
}
if( isset($_POST['j_state_id']) && $_POST['j_state_id'] != ''){
	if($_POST['j_state_id'] =="Unselected"){
		$sql .= ' AND state = "0" OR city = "0" ';
	}else{
        $sql .= ' AND state = "'.$_POST['j_state_id'].'" ';
	}
}
if( isset($_POST['newCity']) && $_POST['newCity'] != ''){
 $sql .= '
 AND city = "'.$_POST['newCity'].'"
 ';
}
if( isset($_POST['j_status']) && $_POST['j_status'] != ''){
 $sql .= '
 AND j_status = "'.$_POST['j_status'].'"
 ';
}
if( isset($_POST['j_payment_status']) && $_POST['j_payment_status'] != ''){
	if($_POST['j_payment_status'] =="paid"){
		$sql .= '
		AND j_payment_status = "'.$_POST['j_payment_status'].'"
		';
	}else{
		$sql.=" AND j_payment_status = 'pending' ";
	}
}
if( isset($_POST['j_deadline']) && $_POST['j_deadline'] != ''){
 $sql .= '
 AND j_deadline = "'.$_POST['j_deadline'].'"
 ';
}
if( isset($_POST['j_start_date']) && $_POST['j_start_date'] != ''){
 $sql .= '
 AND j_start_date = "'.$_POST['j_start_date'].'"
 ';
}
if( isset($_POST['j_end_date']) && $_POST['j_end_date'] != ''){
 $sql .= '
 AND j_end_date = "'.$_POST['j_end_date'].'"
 ';
}
if( isset($_POST['j_creator_email']) && $_POST['j_creator_email'] != ''){
 $sql .= '
 AND j_creator_email = "'.$_POST['j_creator_email'].'"
 ';
}

if( isset($_POST['sort_by']) && $_POST['sort_by'] =="12"){
 $sql .= '
 AND (j_deadline IS NULL OR j_deadline = "0000-00-00")
 ';
}

$query=mysqli_query($dbCon, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

$searchKeyWord = htmlspecialchars($requestData['search']['value']);
if( !empty($searchKeyWord) ) {
    $sql.=" WHERE j_id LIKE '".$searchKeyWord."%' ";
    $sql.=" OR j_create_date LIKE '".$searchKeyWord."%' ";
    $sql.=" OR jlt_title LIKE '".$searchKeyWord."%' ";
    $sql.=" OR jt_subject LIKE '".$searchKeyWord."%' ";
    $sql.=" OR j_area LIKE '".$searchKeyWord."%' ";
    $sql.=" OR city_name LIKE '".$searchKeyWord."%' ";
    $sql.=" OR j_status LIKE '".$searchKeyWord."%' ";
    $sql.=" OR j_payment_status LIKE '".$searchKeyWord."%' ";
    $sql.=" OR j_deadline LIKE '".$searchKeyWord."%' ";
    $query=mysqli_query($dbCon, $sql);
    $totalFiltered = mysqli_num_rows($query);

}

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($dbCon, $sql);


$data = array();
while( $row=mysqli_fetch_array($query) ) {
    
     if( $row["j_create_date"] =='' ){
    	 $createDate = $row["j_create_date"];
     }else if( $row["j_create_date"]=='0000-00-00 00:00:00' ){
    	 $createDate = '';
     }else if( (date("Y", strtotime($row['j_create_date'])))=='1970' ){
    	 $createDate = '';
     }else{
        $day = date('d', strtotime($row['j_create_date']));
        $month = date('m', strtotime($row['j_create_date']));
        $year = date('Y', strtotime($row['j_create_date']));
        $year = substr( $year, -2);
    	
    	$createDate = $day.'/'.$month.'/'.$year;
     }
     
    $thisLevel = '';
    $Level = " SELECT jlt_jl_id, jlt_title FROM tk_job_level_translation WHERE jlt_jl_id = '".$row["j_jl_id"]."' ";
    $resLevel = $dbCon->query($Level); 
    if($resLevel->num_rows > 0){
        $rLevel = $resLevel->fetch_assoc();
        $thisLevel = $rLevel["jlt_title"];
    }
    
    $thisSubject = '';
    $Subject = " SELECT jt_j_id, jt_subject FROM tk_job_translation WHERE jt_j_id = '".$row["j_id"]."' ";
    $resSubject = $dbCon->query($Subject); 
    if($resSubject->num_rows > 0){
        $rSubject = $resSubject->fetch_assoc();
        //$thisSubject = htmlspecialchars(htmlentities($rSubject["jt_subject"]), ENT_QUOTES); 
        $thisSubject = $rSubject["jt_subject"];
    }
    
    $thisArea = $row["j_area"];
   
    $thisState = '';
    $State = " SELECT st_id, st_name FROM tk_states WHERE st_id = '".$row["state"]."' ";
    $resState = $dbCon->query($State); 
    if($resState->num_rows > 0){
        $rState = $resState->fetch_assoc();
        $thisState = $rState["st_name"];
    }

    $thisCity = '';
    $thisCityState = '';
    $City = " SELECT city_id, city_name FROM tk_cities WHERE city_id = '".$row["city"]."' ";
    $resCity = $dbCon->query($City); 
    if($resCity->num_rows > 0){
        $rCity = $resCity->fetch_assoc();
        $thisCity = $rCity["city_name"];
    }
                
    $thisStatus = $row["j_status"];
/*
    if($row["j_payment_status"] == 'pending'){
        $thisPStatus = 'Unpaid';
    }else{
        $thisPStatus = $row["j_payment_status"];
    }
*/
    $thisPStatus = $row["j_payment_status"];

    $thisApplied = 'no';
    $Applied = " SELECT * FROM tk_applied_job WHERE aj_j_id = '".$row["j_id"]."' ";
    $resApplied = $dbCon->query($Applied); 
    if($resApplied->num_rows > 0){
        $rApplied = $resApplied->fetch_assoc();
        $thisApplied = 'yes';
    }
    
    if( $row["j_deadline"] =='' ){
        $thisDeadline = $row["j_deadline"];
    }else if( $row["j_deadline"]=='0000-00-00' ){
        $thisDeadline = '';
    }else{
        $thisDeadline = date("d/m/Y", strtotime($row['j_deadline']));
    }
    
    $data[] = ['id'=>$row['j_id'],'createDate'=>$createDate,'Level'=>$thisLevel,'Subject'=>$thisSubject,'Area'=>$thisArea,'City'=>$thisCity,'State'=>$thisState,'Status'=>$thisStatus,'PaymentStatus'=>$thisPStatus,'Applied'=>$thisApplied,'Deadline'=>$thisDeadline];
}



$json_data = array(
    "draw"            => intval( $requestData['draw'] ),
    "recordsTotal"    => intval( $totalData ),
    "recordsFiltered" => intval( $totalFiltered ),
    "data"            => $data
);

echo json_encode($json_data);