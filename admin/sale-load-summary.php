<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_POST['dataGrid'])){
    $dataGrid = $_POST['dataGrid'];
    
    /*echo $dataGrid['mainID'].'<br>';
    echo $dataGrid['tab'].'<br>';
    echo $dataGrid['month'].'<br>';*/
?>


            <table class="tbl-qa" style="width: 200px;float: left;">
              <thead>
            	<tr>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> <span aria-label="Coordinator" data-balloon-pos="down" >TKC</span> </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center>Revenue</center></th>
            	</tr>
              </thead>
              <tbody>
              <?PHP  
              $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";
              $resultSelect = $conn->query($sqlSelect);
              if ($resultSelect->num_rows > 0) {
                  while($rowSelect = $resultSelect->fetch_assoc()){
                      ?>
                            <tr class="table-row" id="">
                                <td class="row-data" style="font-size:14px;width:100px;" contenteditable="true"><?PHP echo $rowSelect['tab_name'] ?></td>
                                <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            //echo number_format((float)$rowSum['total'], 2, '.', '');  
                                            echo number_format((float)$rowSum['total'],2);
                                        }
                                    }
                                  ?>
                                </td>
                            </tr>                      
                      <?PHP
                  }
              }
              ?>
              </tbody>
              <tfoot>
                <tr style="border-top: 1px solid black;">
                    <td class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" >Total</td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;">
                          <?PHP  
                          $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";
                          $resultSelect = $conn->query($sqlSelect);
                          if ($resultSelect->num_rows > 0) {
                              $totalFooter = 0;
                              while($rowSelect = $resultSelect->fetch_assoc()){
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            //echo number_format((float)$rowSum['total'], 2, '.', '');  
                                            $totalFooter += number_format((float)$rowSum['total'], 2, '.', '');
                                        }
                                    }
                              }
                              //echo number_format((float)$totalFooter, 2, '.', '');
                              echo number_format($totalFooter,2);
                          }
                          ?>
                    </td>
                </tr>
              </tfoot>
            </table>

            <table class="tbl-qa" style="width: 500px;float: left;">
              <thead>
            	<tr>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> <span aria-label="Total tutor paid" data-balloon-pos="down" >TTP</span> </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> <span aria-label="Total refund to clients" data-balloon-pos="down" >Refund</span> </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> <span aria-label="Gross profit" data-balloon-pos="down" >GP</span> </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> <span aria-label="Percentage of GP" data-balloon-pos="down" >%</span> </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center>New Jobs</center></th>
            	</tr>
              </thead>
              <tbody>
              <?PHP  
              $thisTotalGP = '';
              $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";
              $resultSelect = $conn->query($sqlSelect);
              if ($resultSelect->num_rows > 0) {
                  while($rowSelect = $resultSelect->fetch_assoc()){
                      ?>
                            <tr class="table-row" id="">
                                <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $totalRefund = 0;
                                    $Before = 0;
                                    $After = 0;
                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $Before = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    
                                    $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no11 LIKE '%rtc%' ";
                                    $resultSumRefund = $conn->query($sqlSumRefund);
                                    if ($resultSumRefund->num_rows > 0) {
                                        while($rowSumRefund = $resultSumRefund->fetch_assoc()){
                                            $After = number_format((float)$rowSumRefund['total'], 2, '.', '');  
                                        }
                                    }
                                    $totalRefund = $Before - $After;
                                    //echo number_format((float)$totalRefund, 2, '.', '');
                                    echo number_format((float)$totalRefund,2);
                                  ?>
                                </td>
                                <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no11 LIKE '%rtc%' ";
                                    $resultSumRefund = $conn->query($sqlSumRefund);
                                    if ($resultSumRefund->num_rows > 0) {
                                        while($rowSumRefund = $resultSumRefund->fetch_assoc()){
                                            echo number_format((float)$rowSumRefund['total'], 2, '.', '');
                                            //echo number_format((float)$rowSumRefund['total'],2);
                                        }
                                    }
                                  ?>
                                </td>
                                <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $equal = 0;
                                    $rf = 0;
                                    $equal2 = 0;
                                    $equal3 = 0;
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    /*
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND no3 = 'R.F' != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $rf = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    */
                                    $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND no3 = 'R.F' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){

                                            $sqlSum2 = " SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ";
                                            $resultSum2 = $conn->query($sqlSum2);
                                            if ($resultSum2->num_rows > 0) {
                                                $rowSum2 = $resultSum2->fetch_assoc();
                                                if( $rowSum2['no6'] != '' && $rowSum2['no7'] != '' ){
                                                    $rf += $rowSum['no4'];
                                                }
                                            }

                                        }
                                    }
                                    
                                    
                                    
                                    
                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal2 = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    $equal3 =  (($equal - $equal2)+$rf);
                                    echo number_format((float)$equal3,2);
                                    $thisTotalGP += $equal3;
                                  ?>
                                </td>
                                <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $pr = 0;
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $pr = $rowSum['total'];
                                        }
                                    }
                                    
                                    $equal = 0;
                                    $rf = 0;
                                    $equal2 = 0;
                                    $equal3 = 0;
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }

                                    $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND no3 = 'R.F' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){

                                            $sqlSum2 = " SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ";
                                            $resultSum2 = $conn->query($sqlSum2);
                                            if ($resultSum2->num_rows > 0) {
                                                $rowSum2 = $resultSum2->fetch_assoc();
                                                if( $rowSum2['no6'] != '' && $rowSum2['no7'] != '' ){
                                                    $rf += $rowSum['no4'];
                                                }
                                            }

                                        }
                                    }

                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal2 = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    $equal3 =  (($equal - $equal2)+$rf);
                                    echo number_format((float)(($equal3 / $pr) * 100),2).'%';
                                  ?>
                                </td>
                                <td class="row-data" style="font-size:14px;width:100px;text-align: center;" contenteditable="true">
                                    <?PHP
                                    $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no11 LIKE '%NJ%' ";
                                    $resultSum = $conn->query($sqlSum);
                                    $row_cnt = $resultSum->num_rows;
                                    echo $row_cnt;
                                    ?>
                                </td>
                            </tr>                     
                      <?PHP
                  }
              }
              ?>
              </tbody>
              <tfoot>
                <tr style="border-top: 1px solid black;">
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                          <?PHP  
                          $totalRefund = 0;
                          $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";
                          $resultSelect = $conn->query($sqlSelect);
                          if ($resultSelect->num_rows > 0) {
                                while($rowSelect = $resultSelect->fetch_assoc()){
                                    $Before = 0;
                                    $After = 0;
                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $Before = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    
                                    $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no11 LIKE '%rtc%' ";
                                    $resultSumRefund = $conn->query($sqlSumRefund);
                                    if ($resultSumRefund->num_rows > 0) {
                                        while($rowSumRefund = $resultSumRefund->fetch_assoc()){
                                            $After = number_format((float)$rowSumRefund['total'], 2, '.', '');  
                                        }
                                    }
                                    $totalRefund += $Before - $After;
                                }
                          }
                          echo number_format((float)$totalRefund,2);
                          ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                          <?PHP  
                          $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";
                          $resultSelect = $conn->query($sqlSelect);
                          if ($resultSelect->num_rows > 0) {
                              $totalFooter = 0;
                              while($rowSelect = $resultSelect->fetch_assoc()){
                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no11 LIKE '%rtc%' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $totalFooter += number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                              }
                              //echo number_format((float)$totalFooter, 2, '.', '');
                              echo number_format($totalFooter,2);
                          }
                          ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                                  <?PHP  
                                  echo number_format((float)$thisTotalGP,2);
                                  ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                                  <?PHP  
                                  $totalFooter = 0;
                                  $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";
                                  $resultSelect = $conn->query($sqlSelect);
                                  if ($resultSelect->num_rows > 0) {
                                      $totalFooter = 0;
                                      while($rowSelect = $resultSelect->fetch_assoc()){
                                            $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ";
                                            $resultSum = $conn->query($sqlSum);
                                            if ($resultSum->num_rows > 0) {
                                                while($rowSum = $resultSum->fetch_assoc()){
                                                    $totalFooter += $rowSum['total'];
                                                }
                                            }
                                      }
                                      
                                  }
                                  
                                  
                                  echo number_format((float)(($thisTotalGP / $totalFooter) * 100),2).'%';
                                  ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: center;border-right: 1px solid black;" >
                                  <?PHP
                                  $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";
                                  $resultSelect = $conn->query($sqlSelect);
                                  if ($resultSelect->num_rows > 0) {
                                      $equal = 0;
                                      while($rowSelect = $resultSelect->fetch_assoc()){
                                            $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no11 LIKE '%NJ%' ";
                                            $resultSum = $conn->query($sqlSum);
                                            $row_cnt = $resultSum->num_rows;
                                            $equal += $row_cnt;                                          
                                      }
                                      echo $equal;
                                  }
                                  ?>
                    </td>
                </tr>
              </tfoot>
            </table> 

            <span style="margin-left: 40px;"><b>Total active clients :
            <?PHP
            $array = array();
            $totalClients = " SELECT main_id, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY no2  ";
            $resTotalClients  = $conn->query($totalClients);
            if ($resTotalClients->num_rows > 0) {
                while($rowTotalClients = $resTotalClients->fetch_assoc()){
                    //echo $rowTotalClients['no2'].'<br/>';
                     $GetClients = " SELECT j_id, j_email FROM tk_job WHERE j_id = '".$rowTotalClients['no2']."' ";
                     $resGetClients  = $conn->query($GetClients);
                     if ($resGetClients->num_rows > 0) {
                         $rowGetClients = $resGetClients->fetch_assoc();
                         $array[] = $rowGetClients['j_email'];
                     }
                }
            }
            
            if(!empty($array)){
                echo count(array_unique($array));
            }
            ?>
            </b><span>
            <br/><br/>
            <span style="margin-left: 40px;"><b>Total jobs :
            <?PHP
            $countTotalJob = '0';
            $totalJob = " SELECT main_id, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY no2  ";
            $resTotalJob  = $conn->query($totalJob);
            $countTotalJob = $resTotalJob->num_rows;
            echo $countTotalJob;
            ?>
            </b><span>



<?PHP    
}
$conn->close();
?>
