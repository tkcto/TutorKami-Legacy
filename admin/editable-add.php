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
if(!empty($_POST["salesSubID"])) {
    
    
    if( (isset($_SESSION['tk']['u_id'])) && ($_SESSION['tk']['u_id'] == '1' || $_SESSION['tk']['u_id'] == '8' || $_SESSION['tk']['u_id'] == '1579926' || $_SESSION['tk']['u_id'] == '1581081' || $_SESSION['tk']['u_id'] == '3') ){

            $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$_POST["salesSubID"]."' ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                $main_id  = trim($row["main_id"]);
                $tab_name = trim($row["tab_name"]);
                
                
                    $sqlLargestNo = " SELECT MAX row_no AS max FROM tk_sales_sub WHERE main_id = '".$main_id."' AND tab_name = '".$tab_name."' AND month = '".$_POST["btnTabMonth"]."' AND row_no != '0' ";
                    $resultLargestNo = $conn->query($sqlLargestNo);
                    if ($resultLargestNo->num_rows > 0) {
                        $rowLargestNo = $resultLargestNo->fetch_assoc();
                        $largestNumber = ($rowLargestNo['max'] + 1);
                    }else{
                        $largestNumber = '1';
                    }
                
                if( $_POST["app"] == 'no' ){
                            $sqlInsert = " INSERT INTO tk_sales_sub (main_id, tab_name, month, row_no, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11) VALUES 
                            ('".trim($main_id)."', '".trim($tab_name)."', '".trim($_POST["btnTabMonth"])."', '".$largestNumber."', '".trim($_POST["no1"])."', '".trim($_POST["no2"])."', '".trim($_POST["no3"])."', '".trim($_POST["no4"])."', '".trim($_POST["no5"])."', '".trim($_POST["no6"])."', '".trim($_POST["no7"])."', '".trim($_POST["no8"])."', '".trim($_POST["no9"])."', '".trim($_POST["no10"])."', '".trim($_POST["no11"])."') ";
                            if ( ($conn->query($sqlInsert) === TRUE) ) {
                                $last_id = $conn->insert_id;
                                
                                /* Save jon details (AC) */
                                $sqlGetJob = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$_POST["no2"]."' ";
                                $resultGetJob = $conn->query($sqlGetJob);
                                if ($resultGetJob->num_rows > 0) {
                                    $rowGetJob = $resultGetJob->fetch_assoc();
            
                                    if( $_POST["RFno2"] != '' ){
                                        $thisRate = number_format((($rowGetJob['parent_rate'] * $_POST["no10"]) + $_POST["RFno4"]), 2);  
                                        $thisAC = date("d/m/Y")."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours + RM".trim($_POST["RFno4"])." R.F = RM ".trim($thisRate)." received. Receipt issued - ".trim($_POST["no5"])."\r\n".$rowGetJob["jt_comments"];
                                    }else{
                                        $thisAC = date("d/m/Y")."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours = RM ".trim($_POST["no4"])." received. Receipt issued - ".trim($_POST["no5"])."\r\n".$rowGetJob["jt_comments"];;
                                        
                                    }
            
                                    $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$thisAC."' WHERE jt_j_id = '".$_POST["no2"]."' AND jt_id = '".$rowGetJob["jt_id"]."'   ";
                                    $conn->query($sqlAC);
                                    
                                }
                                /* Save jon details (AC) */
            
                                $sqlQ = " SELECT * FROM tk_sales_sub WHERE id = '".$last_id."' ";
                                $resultQ = $conn->query($sqlQ);
                                if ($resultQ->num_rows > 0) {
                                    $rowQ = $resultQ->fetch_assoc();
                                    
                                    $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '".$rowQ['main_id']."' ";
                                    $resultMain = $conn->query($sqlMain);
                                    if ($resultMain->num_rows > 0) {
                                        $rowMain = $resultMain->fetch_assoc();
                                        $fileName = str_replace(' ', '', "Log-".$rowMain['name'].$rowMain['year'].".txt");
                                    }else{
                                        $fileName = "Log-temp.txt";
                                    }
            
                                    
                                    $header = date('d/m/Y H:i:s')." | NEW (".$rowQ['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowQ['row_no'].") | ".$_SESSION['tk']['u_first_name'];
                                    $myFile = $fileName;
                                    $message = $header;
                                    if (file_exists($myFile)) {
                                      $fh = fopen($myFile, 'a');
                                      fwrite($fh, $message."\n");
                                    } else {
                                      $fh = fopen($myFile, 'w');
                                      fwrite($fh, $message."\n");
                                    }
                                    fclose($fh); 
                                    
                                        ?>
                                        
                                	  <tr class="table-row" id="table-row-<?php echo $rowQ["id"]; ?>">
                                		<td class="row-data" style="font-size:14px;width:30px;"  contenteditable="false" onBlur="saveToDatabase(this,'row_no','<?php echo $rowQ["row_no"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["row_no"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no1','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);">
                                		    <?php echo $rowQ["no1"]; ?>
                                		</td>
                                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no2','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no2"]; ?></td>
                                	
                                		<td class="row-data" style="font-size:14px;width:200px;" contenteditable="true" onBlur="saveToDatabase(this,'no3','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no3"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no4','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no4"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no5','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no5"]; ?></td>
                                		
                                		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no6','<?php echo $rowQ["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno6','<?php echo $rowQ["id"]; ?>');"><?php echo $rowQ["no6"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no7','<?php echo $rowQ["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno7','<?php echo $rowQ["id"]; ?>');"><?php echo $rowQ["no7"]; ?></td>
                                		
                                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no8','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no8"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:130px;" contenteditable="true" onBlur="saveToDatabase(this,'no9','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no9"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no10','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no10"]; ?></td>
            
                                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onClick="dateTutorPaid(this,'saveManualno11','<?php echo $rowQ["id"]; ?>');"><?php echo $rowQ["no11"]; ?></td>
                                		
            
                                		<td style="font-size:14px;width:130px;" > <input style="border:none;background:none;color:#28A745;font-weight: bold;" id="saveDateTutorPaid<?php echo $rowQ["id"]; ?>" class="ajax-action-links hidden btnSaveEdit" type="button" value="Save" onclick="show(this,'saveManual','<?php echo $rowQ["id"]; ?>')" />  <a class="ajax-action-links" onclick="deleteRecord(<?php echo $rowQ["id"]; ?>);"><span class="glyphicon glyphicon-remove" style="color:#872247"></span></a> </td>
                                	  </tr>  
                                <?PHP               
                                }
                                /* INSERT RF */
                                if( $_POST["RFno2"] != '' ){
                                        $sqlInsertRF = " INSERT INTO tk_sales_sub (main_id, tab_name, month, row_no, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11) VALUES 
                                        ('".trim($main_id)."', '".trim($tab_name)."', '".trim($_POST["btnTabMonth"])."', '".($largestNumber+1)."', '".trim($_POST["RFno1"])."', '".trim($_POST["RFno2"])."', '".trim($_POST["RFno3"])."', '".trim($_POST["RFno4"])."', '".trim($_POST["RFno5"])."', '".trim($_POST["RFno6"])."', '".trim($_POST["RFno7"])."', '".trim($_POST["RFno8"])."', '".trim($_POST["RFno9"])."', '".trim($_POST["RFno10"])."', '".trim($_POST["RFno11"])."') ";
                                        if ( ($conn->query($sqlInsertRF) === TRUE) ) {
                                            $last_idRF = $conn->insert_id;
                                            $sqlQRF = " SELECT * FROM tk_sales_sub WHERE id = '".$last_idRF."' ";
                                            $resultQRF = $conn->query($sqlQRF);
                                            if ($resultQRF->num_rows > 0) {
                                                $rowQRF = $resultQRF->fetch_assoc();
                                            	  ?>
                                            	  <tr class="table-row" id="table-row-<?php echo $rowQRF["id"]; ?>">
                                            		<td class="row-data" style="font-size:14px;width:30px;"  contenteditable="false" onBlur="saveToDatabase(this,'row_no','<?php echo $rowQRF["row_no"]; ?>')" onClick="editRow(this);"><?php echo $rowQRF["row_no"]; ?></td>
                                            		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no1','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);">
                                            		    <?php echo $rowQRF["no1"]; ?>
                                            		</td>
                                            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no2','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            	
                                            		<td class="row-data" style="font-size:14px;width:200px;" contenteditable="true" onBlur="saveToDatabase(this,'no3','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQRF["no3"]; ?></td>
                                            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no4','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQRF["no4"]; ?></td>
                                            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no5','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		
                                            		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no6','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no7','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		
                                            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no8','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		<td class="row-data" style="font-size:14px;width:130px;" contenteditable="true" onBlur="saveToDatabase(this,'no9','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no10','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no11','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQRF["no11"]; ?></td>
                                            		
                                            		<td style="font-size:14px;width:130px;" > <a class="ajax-action-links" onclick="deleteRecord(<?php echo $rowQRF["id"]; ?>);"><span class="glyphicon glyphicon-remove" style="color:#872247"></span></a> </td>
                                            	  </tr>  
                                            	  <?PHP 
                                            }
                                            
                                            
                                        }else{
                                            echo "Error 1";
                                        }
                                }
                                /* INSERT RF */                    
                            } else {
                                echo "Error 1";
                            }
                }
                if( $_POST["app"] == 'yes' ){

                            $sqlNewNo = " SELECT * FROM tk_sales_sub WHERE main_id = '".$main_id."' AND tab_name = '".$tab_name."' AND month = '".(trim($_POST["btnTabMonth"]))."' AND row_no >= '".(trim($_POST["row_no"]))."' ";
                            $resultNewNo = $conn->query($sqlNewNo);
                            if ($resultNewNo->num_rows > 0) {
                                while($rowNewNo = $resultNewNo->fetch_assoc()){
                                    $loopNewNo = ($rowNewNo["row_no"] + 1);
                                    $NewNo = "UPDATE tk_sales_sub SET row_no = '".$loopNewNo."' WHERE id = '".$rowNewNo["id"]."'   ";
                                    $conn->query($NewNo);
                                }
                            }
                    
                    
/*

                            $sqlInsert = " INSERT INTO tk_sales_sub (main_id, tab_name, month, row_no, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11) VALUES 
                            ('".trim($main_id)."', '".trim($tab_name)."', '".trim($_POST["btnTabMonth"])."', '".$largestNumber."', '".trim($_POST["no1"])."', '".trim($_POST["no2"])."', '".trim($_POST["no3"])."', '".trim($_POST["no4"])."', '".trim($_POST["no5"])."', '".trim($_POST["no6"])."', '".trim($_POST["no7"])."', '".trim($_POST["no8"])."', '".trim($_POST["no9"])."', '".trim($_POST["no10"])."', '".trim($_POST["no11"])."') ";
                            if ( ($conn->query($sqlInsert) === TRUE) ) {
                                $last_id = $conn->insert_id;
                                
                                // Save jon details (AC) 
                                $sqlGetJob = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$_POST["no2"]."' ";
                                $resultGetJob = $conn->query($sqlGetJob);
                                if ($resultGetJob->num_rows > 0) {
                                    $rowGetJob = $resultGetJob->fetch_assoc();
            
                                    if( $_POST["RFno2"] != '' ){
                                        $thisRate = number_format((($rowGetJob['parent_rate'] * $_POST["no10"]) + $_POST["RFno4"]), 2);  
                                        $thisAC = date("d/m/Y")."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours + RM".trim($_POST["RFno4"])." R.F = RM ".trim($thisRate)." received. Receipt issued - ".trim($_POST["no5"])."\r\n".$rowGetJob["jt_comments"];
                                    }else{
                                        $thisAC = date("d/m/Y")."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours = RM ".trim($_POST["no4"])." received. Receipt issued - ".trim($_POST["no5"])."\r\n".$rowGetJob["jt_comments"];;
                                        
                                    }
            
                                    $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$thisAC."' WHERE jt_j_id = '".$_POST["no2"]."' AND jt_id = '".$rowGetJob["jt_id"]."'   ";
                                    $conn->query($sqlAC);
                                    
                                }
                                // Save jon details (AC) 
            
                                $sqlQ = " SELECT * FROM tk_sales_sub WHERE id = '".$last_id."' ";
                                $resultQ = $conn->query($sqlQ);
                                if ($resultQ->num_rows > 0) {
                                    $rowQ = $resultQ->fetch_assoc();
                                    
                                    $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '".$rowQ['main_id']."' ";
                                    $resultMain = $conn->query($sqlMain);
                                    if ($resultMain->num_rows > 0) {
                                        $rowMain = $resultMain->fetch_assoc();
                                        $fileName = str_replace(' ', '', "Log-".$rowMain['name'].$rowMain['year'].".txt");
                                    }else{
                                        $fileName = "Log-temp.txt";
                                    }
            
                                    
                                    $header = date('d/m/Y H:i:s')." | NEW (".$rowQ['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowQ['row_no'].") | ".$_SESSION['tk']['u_first_name'];
                                    $myFile = $fileName;
                                    $message = $header;
                                    if (file_exists($myFile)) {
                                      $fh = fopen($myFile, 'a');
                                      fwrite($fh, $message."\n");
                                    } else {
                                      $fh = fopen($myFile, 'w');
                                      fwrite($fh, $message."\n");
                                    }
                                    fclose($fh); 
                                    
                                        ?>
                                        
                                	  <tr class="table-row" id="table-row-<?php echo $rowQ["id"]; ?>">
                                		<td class="row-data" style="font-size:14px;width:30px;"  contenteditable="false" onBlur="saveToDatabase(this,'row_no','<?php echo $rowQ["row_no"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["row_no"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no1','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);">
                                		    <?php echo $rowQ["no1"]; ?>
                                		</td>
                                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no2','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no2"]; ?></td>
                                	
                                		<td class="row-data" style="font-size:14px;width:200px;" contenteditable="true" onBlur="saveToDatabase(this,'no3','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no3"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no4','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no4"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no5','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no5"]; ?></td>
                                		
                                		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no6','<?php echo $rowQ["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno6','<?php echo $rowQ["id"]; ?>');"><?php echo $rowQ["no6"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no7','<?php echo $rowQ["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno7','<?php echo $rowQ["id"]; ?>');"><?php echo $rowQ["no7"]; ?></td>
                                		
                                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no8','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no8"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:130px;" contenteditable="true" onBlur="saveToDatabase(this,'no9','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no9"]; ?></td>
                                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no10','<?php echo $rowQ["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQ["no10"]; ?></td>
            
                                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onClick="dateTutorPaid(this,'saveManualno11','<?php echo $rowQ["id"]; ?>');"><?php echo $rowQ["no11"]; ?></td>
                                		
            
                                		<td style="font-size:14px;width:130px;" > <input style="border:none;background:none;color:#28A745;font-weight: bold;" id="saveDateTutorPaid<?php echo $rowQ["id"]; ?>" class="ajax-action-links hidden btnSaveEdit" type="button" value="Save" onclick="show(this,'saveManual','<?php echo $rowQ["id"]; ?>')" />  <a class="ajax-action-links" onclick="deleteRecord(<?php echo $rowQ["id"]; ?>);"><span class="glyphicon glyphicon-remove" style="color:#872247"></span></a> </td>
                                	  </tr>  
                                <?PHP               
                                }
                                // INSERT RF 
                                if( $_POST["RFno2"] != '' ){
                                        $sqlInsertRF = " INSERT INTO tk_sales_sub (main_id, tab_name, month, row_no, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11) VALUES 
                                        ('".trim($main_id)."', '".trim($tab_name)."', '".trim($_POST["btnTabMonth"])."', '".($largestNumber+1)."', '".trim($_POST["RFno1"])."', '".trim($_POST["RFno2"])."', '".trim($_POST["RFno3"])."', '".trim($_POST["RFno4"])."', '".trim($_POST["RFno5"])."', '".trim($_POST["RFno6"])."', '".trim($_POST["RFno7"])."', '".trim($_POST["RFno8"])."', '".trim($_POST["RFno9"])."', '".trim($_POST["RFno10"])."', '".trim($_POST["RFno11"])."') ";
                                        if ( ($conn->query($sqlInsertRF) === TRUE) ) {
                                            $last_idRF = $conn->insert_id;
                                            $sqlQRF = " SELECT * FROM tk_sales_sub WHERE id = '".$last_idRF."' ";
                                            $resultQRF = $conn->query($sqlQRF);
                                            if ($resultQRF->num_rows > 0) {
                                                $rowQRF = $resultQRF->fetch_assoc();
                                            	  ?>
                                            	  <tr class="table-row" id="table-row-<?php echo $rowQRF["id"]; ?>">
                                            		<td class="row-data" style="font-size:14px;width:30px;"  contenteditable="false" onBlur="saveToDatabase(this,'row_no','<?php echo $rowQRF["row_no"]; ?>')" onClick="editRow(this);"><?php echo $rowQRF["row_no"]; ?></td>
                                            		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no1','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);">
                                            		    <?php echo $rowQRF["no1"]; ?>
                                            		</td>
                                            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no2','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            	
                                            		<td class="row-data" style="font-size:14px;width:200px;" contenteditable="true" onBlur="saveToDatabase(this,'no3','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQRF["no3"]; ?></td>
                                            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no4','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQRF["no4"]; ?></td>
                                            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no5','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		
                                            		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no6','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no7','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		
                                            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no8','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		<td class="row-data" style="font-size:14px;width:130px;" contenteditable="true" onBlur="saveToDatabase(this,'no9','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no10','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"></td>
                                            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no11','<?php echo $rowQRF["id"]; ?>')" onClick="editRow(this);"><?php echo $rowQRF["no11"]; ?></td>
                                            		
                                            		<td style="font-size:14px;width:130px;" > <a class="ajax-action-links" onclick="deleteRecord(<?php echo $rowQRF["id"]; ?>);"><span class="glyphicon glyphicon-remove" style="color:#872247"></span></a> </td>
                                            	  </tr>  
                                            	  <?PHP 
                                            }
                                            
                                            
                                        }else{
                                            echo "Error 1";
                                        }
                                }
                                // INSERT RF                   
                            } else {
                                echo "Error 1";
                            }
*/
                }
            }else{
                echo "Error 2";
            }    
    }else{
        echo "session";
    }
    
    

    
}else{
   echo "Error 3"; 
}
?>


