<style>
    .saleFile {
        color: inherit;
        text-decoration: none;
        padding: 16px;
    }
</style>

<?php
require_once('classes/config.php.inc');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if (isset($_GET['requiredid'])) {
    
    $sql = " SELECT id, name, year FROM tk_sales_main ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li><a onClick="getSaleFile(' . $row['id'] . ');" class="saleFile" id="Main' . $row['id'] . '" >' . $row['name'] . ' ' . $row['year'] . '</a></li>' . '<br/>';
        }
    } else {
        echo '<li><a class="saleFile" ></a></li>' . '<br/>';
    }

    echo "<script>$(document).ready(function(){ document.getElementById('Main'+'" . $_GET['requiredid'] . "').click();  });</script>";
} else {
    
    $sql = " SELECT id, name, year FROM tk_sales_main ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li><a onClick="getSaleFile(' . $row['id'] . ');" class="saleFile" >' . $row['name'] . ' ' . $row['year'] . '</a></li>' . '<br/>';
        }
    } else {
        echo '<li><a class="saleFile" ></a></li>' . '<br/>';
    }
    
}

$conn->close();
?>