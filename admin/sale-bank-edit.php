<?php

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if (!isset($_SESSION['tk'])) {
    exit(json_encode(['status' => 1, 'message' => 'Session Error: User not logged in']));
}

$sql = "SELECT * FROM tk_sales_bank WHERE id = '" . $_POST["id"] . "' ";
$result = $conn->query($sql);

if ($result->num_rows <= 0) {
    exit(json_encode(['status' => 1, 'message' => 'No Such User']));
}

$row = $result->fetch_assoc();

if ($_POST["column"] == 'tk' || $_POST["column"] == 'hs' || $_POST["column"] == 'latest_balance') {
    $val = number_format(($_POST["editval"]), 2);
} else {
    $val = trim($_POST["editval"]);
}

$sql = sprintf("
    UPDATE tk_sales_bank 
        SET tk='%s', 
        hs='%s', 
        date='%s', 
        latest_balance='%s'
    WHERE id='%s'",
    $_POST['tk'],
    $_POST['hs'],
    $_POST['date'],
    $_POST['latest_balance'],
    $_POST['id']
);

if ($conn->query($sql) === true) {
    exit(json_encode(['status' => 0, 'message' => 'Successfully Update Data']));
} else {
    exit(json_encode(['status' => 1, 'message' => 'Error Update Data']));
}