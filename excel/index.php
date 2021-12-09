<?php
require_once('../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
?>

<!doctype>
<html>
<head>
</head>
<body>
    
<center>
<h2>Read Excel By PHPExcel</h2>
<?php
$path="test1.xls";
$reader= PHPExcel_IOFactory::createReaderForFile($path);
$excel_Obj = $reader->load($path);

//https://jinujawad.com/read-data-from-excel-and-store-in-mysql-database-using-php/

$worksheet=$excel_Obj->getSheet('0');
//echo 'Value of Cell E33 '.$worksheet->getCell('E33')->getValue().'<br>';
$lastRow = $worksheet->getHighestRow();
$colomncount = $worksheet->getHighestDataColumn();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
//echo 'Number of Rows '.$lastRow.'<br>';
//echo 'Number of Columns '.$colomncount;
echo "<table border='1'>";
	for($row=0;$row<=$lastRow;$row++){
		$values_array[]="";
		echo "<tr>";
		for($col=0;$col<=$colomncount_number;$col++){
			echo "<td>";
			$values_array[$col]=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
			echo $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
			echo "</td>";
		}
		echo "</tr>";
		//echo "('".$values_array[0]."','".$values_array[1]."','".$values_array[2]."','".$values_array[3]."')";
		if( $values_array[0] != '' && $values_array[0] != 'Location'){
            //$sqlInsert = "INSERT INTO tk_lokasi2 (l_lokasi, l_post, l_state, l_code) VALUES ('".$values_array[0]."','".$values_array[1]."','".$values_array[2]."','".$values_array[3]."')";
            //$conn->query($sqlInsert);		    
		}
		
	}	
echo "</table>";
?>
</center>
    
    
    
    
    
<?php
// https://a2znotes.blogspot.com/2015/01/exporting-data-from-mysql-to-excel-with.html
// https://dev.to/programmingdive/which-one-to-use-phpexcel-or-phpspreadsheet-c6a
/*
$states = " SELECT * FROM tk_cities  ";
$resultstates = $conn->query($states);
if ($resultstates->num_rows > 0) {
    while($rowstates = $resultstates->fetch_assoc()){
        echo $rowstates['city_name'].'<br/>';
    }
}
*/

/*
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("RN Kushwaha")
        ->setLastModifiedBy("Aryan")
        ->setTitle("Reports")
        ->setSubject("Excel Turorials")
        ->setDescription("Test document ")
        ->setKeywords("phpExcel")
        ->setCategory("Test file");
        
// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Phone');

$n=2;
$states = " SELECT * FROM tk_cities  ";
$resultstates = $conn->query($states);
if ($resultstates->num_rows > 0) {
    while($d = $resultstates->fetch_assoc()){
     $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['city_id']);
     $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['city_name']);
     $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['city_st_id']);
     $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['city_c_id']);
    }
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Agents');

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Title');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Phone No');

$n=2;
$states = " SELECT * FROM tk_states  ";
$resultstates = $conn->query($states);
if ($resultstates->num_rows > 0) {
    while($d = $resultstates->fetch_assoc()){
     $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['st_id']);
     $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['st_name']);
     $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['st_c_id']);
     $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['st_status']);
    }
}


// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Technician');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="data.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
*/





?>
</body>
</html>