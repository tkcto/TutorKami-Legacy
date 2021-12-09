<?php
//Include the database configuration file
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if(!empty($_POST["state_id"])){
    //Fetch all cities data
    $queryCities = $conn->query("SELECT city_id, city_name, city_st_id FROM tk_cities WHERE city_st_id = ".$_POST['state_id']." ORDER BY city_name ASC");

    //Count total number of rows
    $rowCount = $queryCities->num_rows;
    
    //Cities option list
    if($rowCount > 0){
        echo '<option disabled="" selected=""></option>';
        while($row = $queryCities->fetch_assoc()){ 
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        //echo '<option value="dummySelect">Cities Not Available</option>';
    }
}
?>