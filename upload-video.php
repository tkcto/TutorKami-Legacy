<?php
//memasukkan file config.php
require_once('admin/classes/config.php.inc');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


//mendefinisikan folder upload
define("UPLOAD_DIR", "video/");

session_start();    

date_default_timezone_set("Asia/Kuala_Lumpur");
//date('d-m-Y H:i:s'); //Returns IST

$displayID =  $_SESSION['auth']['user_displayid'];
$date = date('d-m-Y_H-i-s');

if (!empty($_FILES["media"])) {
	$media	= $_FILES["media"];
	$ext	= pathinfo($_FILES["media"]["name"], PATHINFO_EXTENSION);
	$size	= $_FILES["media"]["size"];
	$tgl	= date("Y-m-d");

	if ($media["error"] !== UPLOAD_ERR_OK) {
		echo '<div class="alert alert-warning">Gagal upload file.</div>';
		exit;
	}
	
	if( $displayID == '' ){
		echo '<div class="alert alert-warning">Error!!. Please Refresh Your Page.</div>';
		exit;
	}

	//$name = preg_replace("/[^A-Z0-9._-]/i", "_", $media["name"]);
	$name = preg_replace("/[^A-Z0-9._-]/i", "_", $displayID.'_'.$date.'_'.$media["name"]);

	// mencegah overwrite filename
	$i = 0;
	$parts = pathinfo($name);
	while (file_exists(UPLOAD_DIR . $name)) {
		$i++;
		$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		//$name = $displayID.'_'.$date . "-" . $i . "." . $parts["extension"];
	}
	
    $name2 = $media["name"];
    
        $sql = "INSERT INTO tk_upload_video SET
        v_displayid   = '$displayID',
        v_filename   = '$name2',
        v_filename2   = '$name'";
        $conn->query($sql);

	$success = move_uploaded_file($media["tmp_name"], UPLOAD_DIR . $name);

		echo 'success';	
/*	
	if ($success) { 
	    
        $sql = "INSERT INTO tk_upload_video SET
        v_displayid   = '$displayID',
        v_filename   = '$name2',
        v_filename2   = '$name'";
        $conn->query($sql);
	    
		//$in = $conn->query("INSERT INTO files(tgl_upload, file_name, file_size, file_type) VALUES('$tgl', '$name', '$size', '$ext')");
		//$q = $conn->query("SELECT id FROM files ORDER BY id DESC LIMIT 1");
		//$rq = $q->fetch_assoc();
		//echo $rq['id'];
		echo 'success';
	}
	//chmod(UPLOAD_DIR . $name, 0644);
	//echo 'success';
*/
}
?>