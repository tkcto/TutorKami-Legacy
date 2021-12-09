<?PHP

require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

$er == '';

if( (isset($_POST['cl_id']) && $_POST['cl_id'] != '') && (isset($_POST['queryParentID']) && $_POST['queryParentID'] != '') && (isset($_POST['value']) && $_POST['value'] != '') ) {
    if( $_POST['value'] == 'true' ){
        
        $update = " UPDATE tk_classes SET cl_wa ='Yes' WHERE cl_id = '".$_POST["cl_id"]."' ";
        $conn->query($update);
        if( $conn->query($query) ) {
            echo 'success';
        }else{
            echo 'Error';
        }
        
    }else{
        
        $update = " UPDATE tk_classes SET cl_wa ='No' WHERE cl_id = '".$_POST["cl_id"]."' ";
        $conn->query($update);
        if( $conn->query($query) ) {
            echo 'success';
        }else{
            echo 'Error';
        }

    }
}else{
    echo 'Error !';
}

?>





