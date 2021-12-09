<?php
require_once('classes/config.php.inc');

// Create connection <!-- DONE BACKUP -->
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_POST['dataFile'])){
    $dataFile = $_POST['dataFile'];

    $sql = " SELECT name, year FROM tk_sales_main WHERE name = '".ucwords($dataFile['FileInput'])."' AND year = '".$dataFile['YearInput']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo 'existing files';
    } else {
        $sqlInsert = "INSERT INTO tk_sales_main (name, year) VALUES ('".ucwords(trim($dataFile['FileInput']))."', '".trim($dataFile['YearInput'])."')";
        if ( ($conn->query($sqlInsert) === TRUE) ) {
            $last_id = $conn->insert_id;
            echo $last_id;
        } else {
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }
    }

}


if(isset($_POST['getSaleFile'])){
    $getSaleFile = $_POST['getSaleFile'];
    
    $sql = " SELECT id, name, year FROM tk_sales_main WHERE id = '".$getSaleFile['id']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['name'].' '.$row['year'].' thisID '.$row['id'];
    } else {
        echo 'empty file';
    }

}


if(isset($_POST['getYear'])){
    $getYear= $_POST['getYear'];
    
    $sql = " SELECT id, name, year FROM tk_sales_main WHERE year = '".$getYear['year']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['name'].' '.$row['year'].' thisID '.$row['id'];
    } else {
        echo 'empty year';
    }

}


if(isset($_POST['dataTabs'])){
    $dataTabs = $_POST['dataTabs'];
    
    $sql = " SELECT main_id, tab_name FROM tk_sales_sub WHERE main_id = '".$dataTabs['mainID']."' AND tab_name = '".ucwords($dataTabs['Tabname'])."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo 'Existing Tab';
    } else {
        $sqlInsert = "INSERT INTO tk_sales_sub (main_id, tab_name, row_no) VALUES ('".trim($dataTabs['mainID'])."', '".ucwords(trim($dataTabs['Tabname']))."', '0')";
        if ( ($conn->query($sqlInsert) === TRUE) ) {
            echo "Success";
        }else{
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }
    }

}


 /* note: CF 1/ CF 2 = Table ada CF/Takda CF (tak termasuk last row)    */
if(isset($_POST['carryForward'])){
    $carryForward = $_POST['carryForward'];

    $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$carryForward['id']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $array = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $current_array_val = array_search($row['month'], $array);
        $nextMonth = $array[$current_array_val+1];

        if( $nextMonth == '' ){
    
            $getYear = '';
            $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '".$row['main_id']."' ";
            $resultMain = $conn->query($sqlMain);
            if ($resultMain->num_rows > 0) {
                $rowMain = $resultMain->fetch_assoc();
                    $getYear = ($rowMain['year'] + 1);
            }
            
            if( $getYear != '' ){

                $sqlCurrMain = " SELECT * FROM tk_sales_main WHERE year = '".$getYear."' ";
                $resultCurrMain = $conn->query($sqlCurrMain);
                if ($resultCurrMain->num_rows > 0) {
                    $rowCurrMain = $resultCurrMain->fetch_assoc();
                    if( $carryForward['RF'] == 'Yes' ){
                        $sqlRF = " SELECT id, main_id, tab_name, month, no2, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row['main_id']."' AND tab_name = '".$row['tab_name']."' AND month = '".$row['month']."' AND no2 = '".$row['no2']."' AND row_no = '".($row['row_no']+1)."' ";
                        $resultRF = $conn->query($sqlRF);
                        if ($resultRF->num_rows > 0) {
                            $rowRF = $resultRF->fetch_assoc();
                            $rfID = $rowRF['id'];
                        }else{
                            $rfID = "Error";
                        }
                        
                        if( $rfID != 'Error' ){
                            $i = 1;
                            $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND id != '".$rfID."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";
                            $resultOldNo = $conn->query($OldNo);
                            if ($resultOldNo->num_rows > 0) {
                                while($rowOldNo = $resultOldNo->fetch_assoc()){
                                    $updateNo = "UPDATE tk_sales_sub SET row_no = '".$i."' WHERE id = '".$rowOldNo["id"]."' ";
                                    $conn->query($updateNo);  
                                $i++;
                                }
                            }else{
                                $i = 2;
                            }
                            if($i >= 2){
                                /*
                                $iCF = 3;
                                $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND id != '".$rfID."' AND main_id = '".$rowCurrMain['id']."' AND tab_name = '".$row["tab_name"]."' AND month = 'Jan' AND row_no = '999999' ORDER BY cf ASC   ";
                                $resultOldNo = $conn->query($OldNo);
                                if ($resultOldNo->num_rows > 0) {
                                    while($rowOldNo = $resultOldNo->fetch_assoc()){
                                        $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                        $conn->query($updateNo);  
                                    $iCF++;
                                    }
                                }
                                
                                $update = " UPDATE tk_sales_sub SET main_id = '".$rowCurrMain['id']."', month = 'Jan', row_no = '999999', cf = '1' WHERE id = '".$row['id']."' ";
                                if ( ($conn->query($update) === TRUE) ) {
                                    sleep(2);
                                    $update2 = " UPDATE tk_sales_sub SET main_id = '".$rowCurrMain['id']."', month = 'Jan', row_no = '999999', cf = '2' WHERE id = '".$rfID."' ";
                                    if ( ($conn->query($update2) === TRUE) ) {
                                        echo "Success";
                                    } else {
                                        echo "Error";
                                    }  
                                } else {
                                    echo "Error";
                                }
                                */
                                $update = " UPDATE tk_sales_sub SET main_id = '".$rowCurrMain['id']."', month = 'Jan', row_no = '999999', cf = '1000' WHERE id = '".$row['id']."' ";
                                $conn->query($update);
                                    $update2 = " UPDATE tk_sales_sub SET main_id = '".$rowCurrMain['id']."', month = 'Jan', row_no = '999999', cf = '1001' WHERE id = '".$rfID."' ";
                                    $conn->query($update2);
                                
                                $output = '';
                                $iCF = 1;
                                $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '".$rowCurrMain["id"]."' AND tab_name = '".$row["tab_name"]."' AND month = 'Jan' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";
                                $resultOldNo = $conn->query($OldNo);
                                if ($resultOldNo->num_rows > 0) {
                                    while($rowOldNo = $resultOldNo->fetch_assoc()){
                                        $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                        $conn->query($updateNo);  
                                    $iCF++;
                                    }
                                    $output = 'yes';
                                }
                                
                                if( $output == 'yes'){
                                    echo "Success";
                                }else{
                                    echo "Error";
                                }
                                
                            }
                        }else{
                            echo "Error";
                        }
                    }else{
                        $i = 1;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET row_no = '".$i."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $i++;
                            }
                        }else{
                            $i = 2;
                        }
                        
                        if($i >= 2){
                            /*
                            $iCF = 2;
                            $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$rowCurrMain['id']."' AND tab_name = '".$row["tab_name"]."' AND month = 'Jan' AND row_no = '999999' ORDER BY cf ASC   ";
                            $resultOldNo = $conn->query($OldNo);
                            if ($resultOldNo->num_rows > 0) {
                                while($rowOldNo = $resultOldNo->fetch_assoc()){
                                    $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                    $conn->query($updateNo);  
                                $iCF++;
                                }
                            }
                        
                            $update = " UPDATE tk_sales_sub SET main_id = '".$rowCurrMain['id']."', month = 'Jan', row_no = '999999', cf = '1' WHERE id = '".$row['id']."' ";
                            if ( ($conn->query($update) === TRUE) ) {
                                echo "Success";
                            } else {
                                echo "Error";
                            }
                            */
                            $update = " UPDATE tk_sales_sub SET main_id = '".$rowCurrMain['id']."', month = 'Jan', row_no = '999999', cf = '1000' WHERE id = '".$row['id']."' ";
                            $conn->query($update);
                            
                            $output = '';
                            $iCF = 1;
                            $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '".$rowCurrMain["id"]."' AND tab_name = '".$row["tab_name"]."' AND month = 'Jan' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";
                            $resultOldNo = $conn->query($OldNo);
                            if ($resultOldNo->num_rows > 0) {
                                while($rowOldNo = $resultOldNo->fetch_assoc()){
                                    $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                    $conn->query($updateNo);  
                                $iCF++;
                                }
                                $output = 'yes';
                            }
                            
                            if( $output == 'yes'){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            
                            
                        }
                    }
                }else{
                    echo "Error";
                }
               
            }else{
                echo "Error";
            }

        }else{
            if( $carryForward['RF'] == 'Yes' ){
                $sqlRF = " SELECT id, main_id, tab_name, month, no2, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row['main_id']."' AND tab_name = '".$row['tab_name']."' AND month = '".$row['month']."' AND no2 = '".$row['no2']."' AND row_no = '".($row['row_no']+1)."' ";
                $resultRF = $conn->query($sqlRF);
                if ($resultRF->num_rows > 0) {
                    $rowRF = $resultRF->fetch_assoc();
                    $rfID = $rowRF['id'];
                }else{
                    $rfID = "Error";
                }
                
                if( $rfID != 'Error' ){
                    $i = 1;
                    $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND id != '".$rfID."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";
                    $resultOldNo = $conn->query($OldNo);
                    if ($resultOldNo->num_rows > 0) {
                        while($rowOldNo = $resultOldNo->fetch_assoc()){
                            $updateNo = "UPDATE tk_sales_sub SET row_no = '".$i."' WHERE id = '".$rowOldNo["id"]."' ";
                            $conn->query($updateNo);  
                        $i++;
                        }
                    }else{
                        $i = 2;
                    }
                    if($i >= 2){
                        /*
                        $iCF = 3;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND id != '".$rfID."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                        }
                                
                        $update = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '1' WHERE id = '".$row['id']."' ";
                        if ( ($conn->query($update) === TRUE) ) {
                            sleep(2);
                            $update2 = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '2' WHERE id = '".$rfID."' ";
                            if ( ($conn->query($update2) === TRUE) ) {
                                echo "Success";
                            } else {
                                echo "Error";
                            }  
                        } else {
                            echo "Error";
                        }
                        */
                        $update = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '1000' WHERE id = '".$row['id']."' ";
                        $conn->query($update);
                            $update2 = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '1001' WHERE id = '".$rfID."' ";
                            $conn->query($update2);
                        
                        $output = '';
                        $iCF = 1;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                            $output = 'yes';
                        }
                        
                        if( $output == 'yes'){
                            echo "Success";
                        }else{
                            echo "Error";
                        }
                        
                    }
                }else{
                    echo "Error....";
                }
                
                
            }else{
                $i = 1;
                $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";
                $resultOldNo = $conn->query($OldNo);
                if ($resultOldNo->num_rows > 0) {
                    while($rowOldNo = $resultOldNo->fetch_assoc()){
                        $updateNo = "UPDATE tk_sales_sub SET row_no = '".$i."' WHERE id = '".$rowOldNo["id"]."' ";
                        $conn->query($updateNo);  
                    $i++;
                    }
                }else{
                    $i = 2;
                }
                
                if($i >= 2){
                        /*
                        $iCF = 2;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                        }
                        
                        $update = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '1' WHERE id = '".$row['id']."' ";
                        if ( ($conn->query($update) === TRUE) ) {
                            echo "Success";
                        } else {
                            echo "Error";
                        }
                        */   
                        $update = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '1000' WHERE id = '".$row['id']."' ";
                        $conn->query($update);
                        
                        $output = '';
                        $iCF = 1;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                            $output = 'yes';
                        }
                        
                        if( $output == 'yes'){
                            echo "Success";
                        }else{
                            echo "Error";
                        }

                }
            }
        }
    } else {
        echo 'empty ID';
    }
}

if(isset($_POST['carryForward2'])){
    $carryForward = $_POST['carryForward2'];

    $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$carryForward['id']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $array = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $current_array_val = array_search($row['month'], $array);
        $nextMonth = $array[$current_array_val+1];
        
        if( $nextMonth == '' ){
            echo "Error";
        }else{
                $sqlRF = " SELECT id, main_id, tab_name, month, no2, no3, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row['main_id']."' AND tab_name = '".$row['tab_name']."' AND month = '".$row['month']."' AND no2 = '".$row['no2']."' AND no3 = 'R.F' AND row_no = '999999' ";
                $resultRF = $conn->query($sqlRF);
                if ($resultRF->num_rows > 0) {
                    $rowRF = $resultRF->fetch_assoc();
                    //$rfID = $rowRF['id'];
                    
                        $i = 1;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND id != '".$rowRF['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no = '999999' ORDER BY cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$i."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $i++;
                            }
                        }
                        /*
                        $iCF = 3;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND id != '".$rowRF['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                        }
                    
                    
                        $update = " UPDATE tk_sales_sub SET month = '".$nextMonth."', cf = '1' WHERE id = '".$row['id']."' ";
                        if ( ($conn->query($update) === TRUE) ) {
                            sleep(2);
                            $update2 = " UPDATE tk_sales_sub SET month = '".$nextMonth."', cf = '2' WHERE id = '".$rowRF['id']."' ";
                            if ( ($conn->query($update2) === TRUE) ) {
                                echo "Success";
                            }else {
                                echo "Error";
                            }
                        } else {
                            echo "Error";
                        }*/
                        $update = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '1000' WHERE id = '".$row['id']."' ";
                        $conn->query($update);
                            $update2 = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '1001' WHERE id = '".$rowRF['id']."' ";
                            $conn->query($update2);
                        
                        $output = '';
                        $iCF = 1;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                            $output = 'yes';
                        }
                        
                        if( $output == 'yes'){
                            echo "Success";
                        }else{
                            echo "Error";
                        }
                        
                }else{
                        
                        $i = 1;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no = '999999' ORDER BY cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$i."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $i++;
                            }
                        }
                        /*
                        $iCF = 2;
                        $OldNoCF = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY cf ASC   ";
                        $resultOldNoCF = $conn->query($OldNoCF);
                        if ($resultOldNoCF->num_rows > 0) {
                            while($rowOldNoCF = $resultOldNoCF->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNoCF["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                        }
                    
                        $update = " UPDATE tk_sales_sub SET month = '".$nextMonth."', cf = '1' WHERE id = '".$row['id']."' ";
                        if ( ($conn->query($update) === TRUE) ) {
                            echo "Success";
                        } else {
                            echo "Error";
                        }*/
                        $update = " UPDATE tk_sales_sub SET month = '".$nextMonth."', row_no = '999999', cf = '1000' WHERE id = '".$row['id']."' ";
                        $conn->query($update);
                        
                        $output = '';
                        $iCF = 1;
                        $OldNoCF = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";
                        $resultOldNoCF = $conn->query($OldNoCF);
                        if ($resultOldNoCF->num_rows > 0) {
                            while($rowOldNoCF = $resultOldNoCF->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNoCF["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                            $output = 'yes';
                        }
                        
                        if( $output == 'yes'){
                            echo "Success";
                        }else{
                            echo "Error";
                        }
                        
                        
                }
        }
    } else {
        echo 'empty ID';
    }
}


if(isset($_POST['sentManual'])){
    $sentManual = $_POST['sentManual'];
    
    $update = " UPDATE tk_whatsapp_noti SET wa_manual = 'Yes' WHERE wa_id = '".$sentManual['id']."' ";
    if ( ($conn->query($update) === TRUE) ) {
        echo "Success";
    } else {
        echo "Error";
    }
    
}


if(isset($_POST['undo'])){
    $undo = $_POST['undo'];
    $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$undo['id']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $strArr = explode("-", $row["ss_undo"]);
        if(count($strArr) == 2){
            
            $month = str_replace(' ', '', $strArr[0]);
            $rowNo = str_replace(' ', '', $strArr[1]);
            
                $sqlRF = " SELECT id, main_id, tab_name, month, no2, no3, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row['main_id']."' AND tab_name = '".$row['tab_name']."' AND month = '".$row['month']."' AND no2 = '".$row['no2']."' AND no3 = 'R.F' AND row_no = '999999' ";
                $resultRF = $conn->query($sqlRF);
                if ($resultRF->num_rows > 0) {
                    $rowRF = $resultRF->fetch_assoc();
                    
                    if( $rowNo == '999999' ){
/*
                        $i = 1;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND id != '".$rowRF['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$month."' AND no1 = '".$row['no1']."' AND row_no = '999999' ORDER BY cf DESC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$i."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $i++;
                            }
                        }
                        $update = " UPDATE tk_sales_sub SET month = '".$month."', row_no = '999999', cf = '1000' WHERE id = '".$row['id']."' ";
                        $conn->query($update);
                            $update2 = " UPDATE tk_sales_sub SET month = '".$month."', row_no = '999999', cf = '1001' WHERE id = '".$rowRF['id']."' ";
                            $conn->query($update2);
                        
                        $output = '';
                        $iCF = 1;
                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$nextMonth."' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";
                        $resultOldNo = $conn->query($OldNo);
                        if ($resultOldNo->num_rows > 0) {
                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                $updateNo = "UPDATE tk_sales_sub SET cf = '".$iCF."' WHERE id = '".$rowOldNo["id"]."' ";
                                $conn->query($updateNo);  
                            $iCF++;
                            }
                            $output = 'yes';
                        }
                        
                        if( $output == 'yes'){
                            echo "Success";
                        }else{
                            echo "Error";
                        }
*/                        
                    }else{
                        
                    }
                    
                }else{

                        if( $rowNo == '999999' ){
/*
                            $AddIn = " SELECT id, main_id, tab_name, month, no1, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$month."' AND no1 = '".$row['no1']."' AND row_no = '999999' ORDER BY cf DESC   ";
                            $resultAddIn= $conn->query($AddIn);
                            if ($resultAddIn->num_rows > 0) {
                                $rowAddIn = $resultAddIn->fetch_assoc();
                                //echo $rowAddIn['id'];
                                
                                   $loopNewNo  = $rowAddIn['cf'] + 2;
                                   $loopNewNo1 = $rowAddIn['cf'] + 1;
                                   $output = '';
                                   $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$month."' AND cf > '".$rowAddIn["cf"]."' AND row_no = '999999' ORDER BY cf ASC   ";
                                   $resultOldNo = $conn->query($OldNo);
                                   if ($resultOldNo->num_rows > 0) {
                                        while($rowOldNo = $resultOldNo->fetch_assoc()){
                                            $updateNo = "UPDATE tk_sales_sub SET cf = '".$loopNewNo."' WHERE id = '".$rowOldNo["id"]."' ";
                                            $conn->query($updateNo);  
                                        $loopNewNo++;
                                        }
                                   }
                                   
                                   $update = " UPDATE tk_sales_sub SET month = '".$month."', cf = '".$loopNewNo1."', ss_undo = '' WHERE id = '".$row['id']."' ";
                                   $conn->query($update);
                                   
                                   $i = 1;
                                   $OldNo2 = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no = '999999' ORDER BY cf ASC   ";
                                   $resultOldNo2 = $conn->query($OldNo2);
                                   if ($resultOldNo2->num_rows > 0) {
                                        while($rowOldNo2 = $resultOldNo2->fetch_assoc()){
                                            $updateNo2 = "UPDATE tk_sales_sub SET cf = '".$i."' WHERE id = '".$rowOldNo2["id"]."' ";
                                            $conn->query($updateNo2);  
                                        $i++;
                                        }
                                   $output = 'yes';
                                   }
                                   
                                   if( $output == 'yes'){
                                        echo "Success";
                                   }else{
                                        echo "Error";
                                   }
                                   
                            }else{
                                echo 'test';
                            }
*/
                        }else{
/*
                            $AddIn = " SELECT id, main_id, tab_name, month, no1, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$month."' AND no1 = '".$row['no1']."' AND row_no != '999999' ORDER BY row_no DESC   ";
                            $resultAddIn= $conn->query($AddIn);
                            if ($resultAddIn->num_rows > 0) {
                                $rowAddIn = $resultAddIn->fetch_assoc();
                                   //echo $rowAddIn['id'];

                                   $loopNewNo  = $rowAddIn['row_no'] + 2;
                                   $loopNewNo1 = $rowAddIn['row_no'] + 1;
                                   $output = '';
                                   $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$month."' AND row_no > '".$rowAddIn["row_no"]."' AND row_no != '999999' ORDER BY row_no ASC   ";
                                   $resultOldNo = $conn->query($OldNo);
                                   if ($resultOldNo->num_rows > 0) {
                                        while($rowOldNo = $resultOldNo->fetch_assoc()){
                                            $updateNo = "UPDATE tk_sales_sub SET row_no = '".$loopNewNo."' WHERE id = '".$rowOldNo["id"]."' ";
                                            $conn->query($updateNo);  
                                        $loopNewNo++;
                                        }
                                   }
                                   
                                   $update = " UPDATE tk_sales_sub SET month = '".$month."', row_no = '".$loopNewNo1."', ss_undo = '' WHERE id = '".$row['id']."' ";
                                   $conn->query($update);
                                   
                                   $i = 1;
                                   $OldNo2 = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no = '999999' ORDER BY cf ASC   ";
                                   $resultOldNo2 = $conn->query($OldNo2);
                                   if ($resultOldNo2->num_rows > 0) {
                                        while($rowOldNo2 = $resultOldNo2->fetch_assoc()){
                                            $updateNo2 = "UPDATE tk_sales_sub SET cf = '".$i."' WHERE id = '".$rowOldNo2["id"]."' ";
                                            $conn->query($updateNo2);  
                                        $i++;
                                        }
                                   $output = 'yes';
                                   }
                                   
                                   if( $output == 'yes'){
                                        echo "Success";
                                   }else{
                                        echo "Error";
                                   }

                            }else{
                                $AddIn = " SELECT * FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$month."' AND no1 > '".$row['no1']."'     ";
                                $resultAddIn= $conn->query($AddIn);
                                if ($resultAddIn->num_rows > 0) {
                                    $rowAddIn = $resultAddIn->fetch_assoc();
                                       //echo $rowAddIn['id'];

                                       $update = " UPDATE tk_sales_sub SET month = '".$month."', row_no = '".$rowAddIn['row_no']."', ss_undo = '' WHERE id = '".$row['id']."' ";
                                       $conn->query($update);          
                                       
                                       $loopNewNo1 = $rowAddIn['row_no'] + 1;
                                       $output = '';
                                       $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$month."' AND row_no >= '".$rowAddIn["row_no"]."' AND row_no != '999999' ORDER BY row_no ASC   ";
                                       $resultOldNo = $conn->query($OldNo);
                                       if ($resultOldNo->num_rows > 0) {
                                            while($rowOldNo = $resultOldNo->fetch_assoc()){
                                                $updateNo = "UPDATE tk_sales_sub SET row_no = '".$loopNewNo1."' WHERE id = '".$rowOldNo["id"]."' ";
                                                $conn->query($updateNo);  
                                            $loopNewNo1++;
                                            }
                                       }
                                   
                                       $i = 1;
                                       $OldNo2 = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no = '999999' ORDER BY cf ASC   ";
                                       $resultOldNo2 = $conn->query($OldNo2);
                                       if ($resultOldNo2->num_rows > 0) {
                                            while($rowOldNo2 = $resultOldNo2->fetch_assoc()){
                                                $updateNo2 = "UPDATE tk_sales_sub SET cf = '".$i."' WHERE id = '".$rowOldNo2["id"]."' ";
                                                $conn->query($updateNo2);  
                                            $i++;
                                            }
                                       $output = 'yes';
                                       }
                                       
                                       if( $output == 'yes'){
                                            echo "Success";
                                       }else{
                                            echo "Error";
                                       }

                                   
                                }
                            }
*/
                        }

                }
            
        }else{
            echo 'Sorry cant undo';
        }
    }
}

$conn->close();
?>