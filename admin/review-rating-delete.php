<?PHP
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$dbCon = new mysqli($servername, $username, $password, $dbname);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}
*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
$rr_create_date = date('Y-m-d h:i:s');

if( $_POST['id'] != '' ) {
    
    
    
    $sql = " DELETE FROM tk_review_rating WHERE rr_id='".$_POST['id']."' ";

	if ($conn->query($sql) === TRUE) {
	    echo 'success delete';
	}else{
	    echo 'x success delete';
	}




}else{
    echo 'Error : delete';
}
?>