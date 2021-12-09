<?php

session_start();

require_once('classes/config.php.inc');

require_once('classes/system.class.php');

$instSys = new system;

require_once('classes/auth.class.php');

$instAuth = new auth;

require_once('includes/page_security.php');

require_once('classes/flush.class.php');

require_once('classes/log.class.php');


$conDB = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conDB->connect_error) {
    die("Connection failed: " . $conDB->connect_error);
}
?>