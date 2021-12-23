<?php
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');
session_start();

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

function hoursToMinutes($hours) {
    $minutes = 0;
    if (strpos($hours, '.') !== false) {
        list($hours, $minutes) = explode('.', $hours);
    }
    return $hours * 60 + $minutes;
}

function minutesToHours($minutes) {
    $hours = (int) ($minutes / 60);
    $minutes -= $hours * 60;
    return sprintf("%d.%02.0f", $hours, $minutes);
}

if (empty($_POST['mainID']) && empty($_POST['btnTabMonth'])) {
    exit(json_encode(['status' => 1, 'message' => 'Error: Missing Some Post Data']));
}

if (!isset($_SESSION['tk'])) {
    exit(json_encode(['status' => 1, 'message' => 'Session Error: User not logged in']));
}


$ThisRow = 1;
$GetRow = " SELECT id, main_id, month, row_no FROM tk_sales_deposit WHERE main_id = '" . trim($_POST["mainID"]) . "' AND month = '" . trim($_POST["btnTabMonth"]) . "' ORDER BY id DESC ";
$resultGetRow = $conn->query($GetRow);

if ($resultGetRow->num_rows > 0) {
    $rowGetRow = $resultGetRow->fetch_assoc();
    $ThisRow = ($rowGetRow['row_no'] + 1);
}

$sqlInsert = sprintf("
        INSERT INTO tk_sales_deposit 
        (main_id, month, date, item, amount, note, row_no) 
            VALUES 
        ('%s', '%s', '%s', 'kosong', 'kosong', 'kosong', '%s')",
    trim($_POST['mainID']),
    trim($_POST['btnTabMonth']),
    trim($_POST['today']),
    $ThisRow
);


if ($conn->query($sqlInsert) === true) {
    exit(json_encode(['status' => 0, 'message' => 'Successfully Add Data', 'insert_id' => $conn->insert_id]));
} else {
    exit(json_encode(['status' => 1, 'message' => 'Error Update Data']));
}