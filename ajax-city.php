<?php
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if( isset($_POST['state_id']) && $_POST['state_id'] != ''){
    
    
    $queryCity = " SELECT * FROM tk_cities WHERE city_st_id = '".$_POST['state_id']."' ORDER BY city_name ASC "; 
    $resultCity = $conn->query($queryCity); 
    if($resultCity->num_rows > 0){ 
        echo '<option value="">Select City</option>';
        while($rowCity = $resultCity->fetch_assoc()){
            echo '<option value="'. $rowCity['city_id'] .'" >'. $rowCity['city_name'] .'</option>';
        }
    }
    
    
}else{
     echo '<option value="" >Please Select City</option>';
}
?>
