<?PHP

require_once('includes/head.php'); 
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if( isset($_POST['state']) ){
    if( $_POST['state'] != '' ){
        $_SESSION['getNegeri'] = $_POST['state'];
    }else{
        unset($_SESSION['getNegeri']);
    }
}

if( isset($_POST['gender']) ){
    if( $_POST['gender'] != '' ){
        $_SESSION['getJantina'] = $_POST['gender'];
    }else{
        unset($_SESSION['getJantina']);
    }
}

if( isset($_POST['occupation']) ){
    if( $_POST['occupation'] != '' ){
        $_SESSION['getKerja'] = $_POST['occupation'];
    }else{
        unset($_SESSION['getKerja']);
    }
}

if( isset($_POST['race']) ){
    if( $_POST['race'] != '' ){
        $_SESSION['getBangsa'] = $_POST['race'];
    }else{
        unset($_SESSION['getBangsa']);
    }
}

if( isset($_POST['ConductOnline']) ){
    if( $_POST['ConductOnline'] != '' ){
        $_SESSION['ConductOnline'] = $_POST['ConductOnline'];
    }else{
        unset($_SESSION['ConductOnline']);
    }
}

?>