<?php

require_once('classes/config.php.inc');

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if (!isset($_SESSION['tk'])) {
    exit(json_encode(['status' => 1, 'message' => 'Session Error: User not logged in']));
}


$result = true;

foreach ($_POST['datas'] as $data) {
    # Remove any html tag
    $data = array_map(function ($elem) {
        return strip_tags($elem);
    }, $data);

    $sql = sprintf("
      UPDATE tk_sales_deposit 
        SET date='%s',
            item='%s',
            amount='%s',
            note='%s'
        WHERE id='%s'",
        $data['date'], $data['item'],
        $data['amount'], $data['note'],
        $data['id']
    );

    $result = $conn->query($sql);

}

if ($result) {
    exit(json_encode(['status' => 0, 'message' => 'Successfully Update Data']));
} else {
    exit(json_encode(['status' => 1, 'message' => 'Error Update Data']));
}