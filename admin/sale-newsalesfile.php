<?php

require_once('classes/config.php.inc');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$echo = 0;
// Added By Hidayat
// To check the existing tab from current file name and sub table to CF to next year 
$checkTabName = "SELECT tk_sales_main.year,tk_sales_main.name, tk_sales_sub.main_id, tk_sales_sub.tab_name AS tabName FROM tk_sales_main INNER JOIN tk_sales_sub ON tk_sales_main.id = tk_sales_sub.main_id WHERE tk_sales_sub.row_no = 0";
$resultCTN = $conn->query($checkTabName);

if ($resultCTN->num_rows > 0) {	//Check The resultCTN id row number
	while ($rowCTN = $resultCTN->fetch_assoc()){ // List the column in array
	$YearArr = array($rowCTN['year']);	// Put Year in Array	
	$MainIdArr = array($rowCTN['main_id']);	// Put year Id in array
	$nameArr = array($rowCTN['name']);	// Sales File Name in array
	}
	
	$maxMainId = Max($MainIdArr);	// Check the current DB Join Max Id
	$maxYear = Max($YearArr);	//2022
	$maxName = Max ($nameArr);	//Sales File Name
	$futureMainId = $maxMainId + 1; //1,2,3
	$currentYear = date("Y");	//2022
	$currentMonth = date("m");	//12
	$futureYear = $currentYear + 1; //2023

}

// Insert New Sales File Year if not exist
if ($maxYear === $currentYear && $currentMonth === "12" && $maxYear !== $futureYear){
	//$sqlSalesFile = "INSERT INTO `tk_sales_main`(`id`, `name`, `year`) VALUES  ('3','Sales File','2023')";
	$sqlSalesFile = "INSERT INTO `tk_sales_main`(`id`, `name`, `year`) VALUES  ('" . $futureMainId . "', '" . $maxName . "', '" . $futureYear . "')";
	$resultSF = $conn->query($sqlSalesFile);
	
}

// ---- Section to add tabName to next year ---
// Sql to filter the latest tabName for latest user tab existing year to CF to next year
$sqlTabName = "SELECT `main_id`,`tab_name` AS tabName,`row_no` FROM `tk_sales_sub` WHERE row_no = 0 AND main_id = '" . $maxMainId . "'";
$resulTabName = $conn->query($sqlTabName);
//$tabNameArray = array();
if ($resulTabName->num_rows > 0) {	//Check The resultCTN id row number
	while ($rowTabName = $resulTabName->fetch_assoc()){ // List the column in array
	$tabNameArray []= ($rowTabName['tabName']); // Put tabName in array
	}
}
// ---- Section to add tabName to next year ---
if( $maxYear == $currentYear && $currentMonth == "12" && $maxYear != $futureYear){ // Main ID, Max year not yet exist
	if(is_array($tabNameArray)){
		foreach ($tabNameArray as $row) {
			$tabName = mysqli_real_escape_string($conn, $row);
			// To Check the Table that contain Tab_name related to current year
			$insertTabName = "INSERT INTO `tk_sales_sub`(`main_id`,`tab_name`,`row_no`) VALUES  ('" . $futureMainId . "', '" . $tabName . "', '0')";
			$resultTabName = $conn->query($insertTabName);			
		}	
	}	
	$echo = 1;
}

if( $maxYear > $currentYear && $currentMonth == "12" && $maxYear == $futureYear){ // Main ID, Max year already existed
	$echo = 2;
}
if( $maxYear > $currentYear && $currentMonth != "12" && $maxYear == $futureYear){ // Main ID, Max year already existed, but not in month 12
	$echo = 3;
}
if ($echo == 1){
	echo 'New Sales File Successfully Copied to year '.$futureYear;	
}
elseif ($echo == 2){
	echo 'Sales File Copy Error! Sales File Already Existed!';
}
elseif($echo == 3){
	echo 'Sales File Copy Error! Run this in December Month Only!';
}
//var_dump($echo);
?>
