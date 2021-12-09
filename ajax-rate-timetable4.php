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



if(empty($_POST["name"])){
    echo'Empty description';
    exit();
}else if(empty($_POST["day"])){
    echo'Empty Day';
    exit();
}else if(empty($_POST["tutor"])){
    echo'Error : Tutor';
    exit();
}else{
    //$tutor     = $connect->real_escape_string($_POST["tutor"]);
    $tutor     = $_POST["tutor"];
    function getValue($key) {
        foreach ($_POST["name"] as $key2 => $value2) {
            if($key == $key2){
                return $value2;
            }
        }
    }

    foreach ($_POST["day"] as $key => $value) {
        $thisval = getValue($key);
        $sqlTT = " INSERT INTO tk_timetable (tt_tutor, tt_day, tt_time, tt_date) VALUES ( '".$tutor."', '".$value."', '".$thisval."', '".date('Y-m-d H:i:s')."' ) ";
        $connect->query($sqlTT);
    }
    echo json_encode('Updated');
    	
    	
}

?>