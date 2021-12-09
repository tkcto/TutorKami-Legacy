<?php
mysql_connect("localhost", "tutorka1_live", "_+11pj,oow.L") or die('Connection Error');
mysql_select_db("tutorka1_tutorkami_db") or die("Database Connection Error");

$empId 		= $_REQUEST['empId'];
$newValue 	= $_REQUEST['newValue'];
$colName 	= $_REQUEST['colName'];

if($empId != '' && $newValue != '' && $colName != '')
{
	$update = "update tk_classes_record set ".$colName." = '".$newValue."' where id = ".$empId;
	if(mysql_query($update))
	{
		echo 'Updated successfully';
	}
	else
	{
		echo 'Erro in Updation';
	}
}

?>