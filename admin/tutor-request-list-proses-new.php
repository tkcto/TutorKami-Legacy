<?php

$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if($_POST['insert']){
	/*$dataId = $_POST['insert'][0];
	$dataStatus = $_POST['insert'][6];
	$dataManagedBy  = $_POST['insert'][8];
	
	$queryUpdate = "UPDATE tk_tutor_request SET tr_status = '$dataStatus', tr_managed_by = '$dataManagedBy' WHERE tr_id = '$dataId' ";
	$statementUpdate = $connect->prepare($queryUpdate);
	$statementUpdate->execute();*/
	
	
}else{
    
        $requestData= $_REQUEST;
         
         
        $columns = array(
            0 =>'Name',
            1 => 'Location',
            2=> 'Phone',
            3=> 'Subject',
            4=> 'Comment',
            5=> 'Requested',
            6=> 'Managed'
        );
         
        $sql = "SELECT tr_id,tr_name, tr_location, tr_phone_number, tr_subject, tr_additional_comment, tr_status, tr_create_date, tr_managed_by FROM tk_tutor_request";
        $query=mysqli_query($conn, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;
         
        $searchKeyWord = htmlspecialchars($requestData['search']['value']);
        if( !empty($searchKeyWord) ) {
            $sql.=" WHERE tr_name LIKE '".$searchKeyWord."%' ";
            $sql.=" OR tr_location LIKE '".$searchKeyWord."%' ";
            $sql.=" OR tr_phone_number LIKE '".$searchKeyWord."%' ";
            $sql.=" OR tr_subject LIKE '%".$searchKeyWord."%' ";
            $sql.=" OR tr_additional_comment LIKE '%".$searchKeyWord."%' ";
            $sql.=" OR tr_status LIKE '%".$searchKeyWord."%' ";
            $sql.=" OR tr_create_date LIKE '%".$searchKeyWord."%' ";
            $sql.=" OR tr_managed_by LIKE '%".$searchKeyWord."%' ";
            
            $query=mysqli_query($conn, $sql);
            $totalFiltered = mysqli_num_rows($query);
         
        }
            $sql.=" ORDER BY tr_id DESC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
            $query=mysqli_query($conn, $sql);
         
         
        $data = array();
        while( $row=mysqli_fetch_array($query) ) {
        /*
         if ($row['checkbox'] == 'true') { 
             $thisCheckBox = "checked='checked'"; 
             $thisInfo = '<span tooltip="Entry with validated tutors available" tooltip-position="left"> <i style="font-size:20px;" class="glyphicon glyphicon-question-sign"></i> </span>';
         }else{
             $thisCheckBox = '';
             $thisInfo = '';
         }
        
         $action = '
            <center>
                <button type="button" class="btn btn-primary btn-md btnSelect"> Update</button>
                <button type="button" class="btn btn-primary btn-md btnDelete"> Delete</button>
                <div class="checkbox checkbox-success"><input '.$thisCheckBox.'  onclick="clickCheckbox(this.value)" value="'.$row['id'].'" type="checkbox"><label for="checkbox3"></label></div>
                <div class="checkbox checkbox-success">'.$thisInfo.'</div> 
            </center> 
         ';
         
         */
          $dateRequested = date("d/m/Y H:i:s", strtotime($row['tr_create_date']));
            
            $data[] = [ 'id'=>$row['tr_id'],'Name'=>$row['tr_name'],'Location'=>$row['tr_location'],'Phone'=>$row['tr_phone_number'],'Subject'=>$row['tr_subject'],'Comment'=>$row['tr_additional_comment'],'Status'=>$row['tr_status'],'Requested'=>$dateRequested,'Managed'=>$row['tr_managed_by']  ];
        }
         
         
         
        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );
         
        echo json_encode($json_data);
    
    
    
}








?>
