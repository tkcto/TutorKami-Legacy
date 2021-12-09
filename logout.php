<?php 

require_once('includes/head.php');

$page = '';

if ($_SESSION['auth']['user_role'] == '4') {

	$page = 'client_login.php';

} else {

	$page = 'tutor-login.php';

}



if( isset($_SESSION['auth']) && count($_SESSION['auth']) > 0 ){

    /*START fadhli | update bila waktu logout.. guna column sedia ada( u_modified_date ) */
    //$updateLastActivity = "UPDATE ".DB_PREFIX."_user SET u_modified_date = '".date('Y-m-d H:i:s')."' WHERE u_id='".$_SESSION['auth']['user_id']."'";
    //$execute = $this->db->query($updateLastActivity);
$dbConnection = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
} 
$dataUser = "UPDATE ".DB_PREFIX."_user SET u_modified_date = '".date('Y-m-d H:i:s')."', last_page='".$_SESSION['getPage'] ."' WHERE u_id='".$_SESSION['auth']['user_id']."'";
$resultUser = $dbConnection->query($dataUser);
	
    /*END fadhli */

    $_SESSION['auth'] = ''; 

    unset($_SESSION['auth']);

}

if( isset($_SESSION['fb_auth']) && count($_SESSION['fb_auth']) > 0 ){

    $_SESSION['fb_auth'] = ''; 

    unset($_SESSION['fb_auth']);

}

if( isset($_SESSION['access_token']) && count($_SESSION['access_token']) > 0 ){

    $_SESSION['access_token'] = ''; 

    unset($_SESSION['access_token']);

}



session_destroy();

Session::SetFlushMsg('success', 'Logout Successful');

header('Location: '.$page);

exit();