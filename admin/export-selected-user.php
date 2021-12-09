<?php 
require_once('classes/location.class.php');
require_once('classes/app.class.php');
require_once('classes/user.class.php');

$instLocation = new location;
$instApp = new app;
$instUser = new user;
$resTutor = $instUser->ExportUser($_POST);
// echo $resTutor;exit();
// var_dump($_REQUEST["id"]);exit();
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// file name for download
$fileName = "selected_export_user" . date('Ymd') . ".xls";

// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
header("Pragma: no-cache"); 
header("Expires: 0");


$excel_heading = array('Id', 'Display Name', 'Email', 'First name', 'Last name', 'City', 'Phone Number', 'Type', 'Created on', 'Last activity');
echo implode("\t", $excel_heading) . "\n";

if ($resTutor->num_rows > 0) {
    while ( $row = $resTutor->fetch_assoc() ) {
        echo $row['u_displayid']."\t";
    	echo $row['u_displayname']."\t";
    	echo $row['u_email']."\t";
    	echo $row['ud_first_name']."\t";
    	echo $row['ud_last_name']."\t";
    	echo $row['city_name']."\t";
    	// echo "(+)".$row['ud_phone_number']."\t";
        echo "'".$row['ud_phone_number']."\t";
    	echo $row['r_name']."\t";
    	echo $row['u_create_date']."\t";
    	echo $row['u_modified_date']. "\n";
    }
}

exit;
?>
<!-- <table border="1">
    <tr>
        <th>Id</th>
        <th>Display Name</th>
        <th>Email</th>
        <th>First name</th>
        <th>Last name</th>
        <th>City</th>
        <th>Phone Number</th>
        <th>Type</th>
        <th>Created on</th>
        <th>Last activity</th>
    </tr>
    <?php 
    if ($resTutor->num_rows > 0) {
        while ( $row = $resTutor->fetch_assoc() ) {
    ?>
    <tr>
        <td><?php echo $row['u_displayid']; ?></td>
        <td><?php echo $row['u_displayname']; ?></td>
        <td><?php echo $row['u_email']; ?></td>
        <td><?php echo $row['ud_first_name']; ?></td>
        <td><?php echo $row['ud_last_name']; ?></td>
        <td><?php echo $row['city_name']; ?></td>
        <td><?php echo (string)$row['ud_phone_number']; ?></td>
        <td><?php echo $row['r_name']; ?></td>
        <td><?php echo $row['u_create_date']; ?></td>
        <td><?php echo $row['u_modified_date']; ?></td>
    </tr>
    <?php 
        }
    }
    ?>
</table> -->