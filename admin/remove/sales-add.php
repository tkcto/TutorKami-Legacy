<?php

require_once('classes/config.php.inc');

// Create connection <!-- DONE BACKUP -->
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["no1"])) {
	$no1 = strip_tags($_POST["no1"]);
	$no2 = strip_tags($_POST["no2"]);
	
	
	

	
	
	
	
	
	
	
	
	
  $sql = "INSERT INTO tk_sales_sub (no1,no2) VALUES ('" . $no1 . "','" . $no2 . "')";
  $faq_id = $db_handle->executeInsert($sql);
	if(!empty($faq_id)) {
		$sql = "SELECT * from tk_sales_sub WHERE id = '$faq_id' ";
		$posts = $db_handle->runSelectQuery($sql);
	}
?>
<tr class="table-row" id="table-row-<?php echo $posts[0]["id"]; ?>">
<td contenteditable="true" onBlur="saveToDatabase(this,'no1','<?php echo $posts[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[0]["no1"]; ?></td>
<td contenteditable="true" onBlur="saveToDatabase(this,'no2','<?php echo $posts[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[0]["no2"]; ?></td>
<td><a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts[0]["id"]; ?>);">Delete</a></td>
</tr>  
<?php } ?>