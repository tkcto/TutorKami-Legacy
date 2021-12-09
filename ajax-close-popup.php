<?PHP
require_once('includes/head.php'); 
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMSG = "";

if (empty($_POST["value"])) {
    $errorMSG = "Error";
} else {
    $value = $_POST["value"];
    //$sql = " INSERT INTO tk_term_popup (tp_id) VALUES ('John', 'Doe', 'john@example.com') ";
    //$conn->query($sql); 
    
    //$sql = " UPDATE tk_term_popup SET ud_tutor_experience_month='month' WHERE ud_u_id='".$rowTest['ud_u_id']."' ";
}

if(empty($errorMSG)){
	//$msg = $value;
	
    $sql = " INSERT INTO tk_term_popup (tp_id) VALUES ($value) ";
    $conn->query($sql); 
	
	
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
}


echo json_encode(['code'=>404, 'msg'=>$errorMSG]);


?>