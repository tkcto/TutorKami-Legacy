<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

//melakukan koneksi ke database
$conn = new mysqli("localhost", "tutorka1_live", "_+11pj,oow.L", "tutorka1_tutorkami_db");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>