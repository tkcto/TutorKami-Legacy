<?php
//memasukkan file config.php
//include("config.php");

//mendefinisikan folder upload
define("UPLOAD_DIR", "files/");

if (!empty($_FILES["media"])) {
	$media	= $_FILES["media"];
	$ext	= pathinfo($_FILES["media"]["name"], PATHINFO_EXTENSION);
	$size	= $_FILES["media"]["size"];
	$tgl	= date("Y-m-d");

	if ($media["error"] !== UPLOAD_ERR_OK) {
		echo '<div class="alert alert-warning">Gagal upload file.</div>';
		exit;
	}

	// filename yang aman
	$name = preg_replace("/[^A-Z0-9._-]/i", "_", $media["name"]);

	// mencegah overwrite filename
	$i = 0;
	$parts = pathinfo($name);
	while (file_exists(UPLOAD_DIR . $name)) {
		$i++;
		$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	}

	$success = move_uploaded_file($media["tmp_name"], UPLOAD_DIR . $name);
	if ($success) { 
		/*$in = $conn->query("INSERT INTO files(tgl_upload, file_name, file_size, file_type) VALUES('$tgl', '$name', '$size', '$ext')");
		$q = $conn->query("SELECT id FROM files ORDER BY id DESC LIMIT 1");
		$rq = $q->fetch_assoc();
		echo $rq['id'];*/
		echo 'success';
		exit;
	}
	chmod(UPLOAD_DIR . $name, 0644);
}
?>