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



            <table class="tbl-qa" style="width: 920px;float: left;">
              <thead>
            	<tr>
            	  <th class="table-header" style="font-size:14px;width:120px;border-right: 1px solid black;" ><center>   </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> Revenue </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> TTP     </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> Refund  </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> GP      </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> %       </center></th>
            	  
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> New Jobs   </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> Total Jobs </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> A.Clients  </center></th>
            	</tr>
              </thead>
              <tbody id="bodyYear" >
              <?PHP
                $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                    ?>
                            <tr class="table-row" id="">
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:120px;text-left: right;" contenteditable="true">
                                    <?PHP echo $row['month']; ?>
                                </td>
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $sqlSumRev = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                    $resultSumRev = $conn->query($sqlSumRev);
                                    if ($resultSumRev->num_rows > 0) {
                                        while($rowSumRev = $resultSumRev->fetch_assoc()){
                                            //echo number_format((float)$rowSumRev['total'], 2, '.', ''); 
                                            echo number_format((float)$rowSumRev['total'],2);
                                        }
                                    }
                                  ?>
                                </td>
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $totalRefund = 0;
                                    $Before = 0;
                                    $After = 0;
                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $Before = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    
                                    $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' AND no11 LIKE '%rtc%' ";
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
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' AND no11 LIKE '%rtc%' ";
                                    $resultSumRefund = $conn->query($sqlSumRefund);
                                    if ($resultSumRefund->num_rows > 0) {
                                        while($rowSumRefund = $resultSumRefund->fetch_assoc()){
                                            //echo number_format((float)$rowSumRefund['total'], 2, '.', '');  
                                            echo number_format((float)$rowSumRefund['total'],2);
                                        }
                                    }
                                  ?>
                                </td>
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">
                                  <?PHP  
                                    $equal = 0;
                                    $rf = 0;
                                    $equal2 = 0;
                                    $equal3 = 0;
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                            /*
                                            $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no3 = 'R.F' AND row_no != '0' ";
                                            $resultSum = $conn->query($sqlSum);
                                            if ($resultSum->num_rows > 0) {
                                                while($rowSum = $resultSum->fetch_assoc()){
                                                    $rf = number_format((float)$rowSum['total'], 2, '.', '');  
                                                }
                                            }
                                            */
                                            $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no3 = 'R.F' AND row_no != '0' ";
                                            $resultSum = $conn->query($sqlSum);
                                            if ($resultSum->num_rows > 0) {
                                                while($rowSum = $resultSum->fetch_assoc()){
        
                                                    $sqlSum2 = " SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                                    $resultSum2 = $conn->query($sqlSum2);
                                                    if ($resultSum2->num_rows > 0) {
                                                        $rowSum2 = $resultSum2->fetch_assoc();
                                                        if( $rowSum2['no6'] != '' && $rowSum2['no7'] != '' ){
                                                            $rf += $rowSum['no4'];
                                                        }
                                                    }
        
                                                }
                                            }
                                            

                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal2 = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    //$equal3 =  $equal - $equal2;
                                    $equal3 =  (($equal - $equal2)+$rf);
                                    echo number_format((float)$equal3,2);
                                  ?>
                                </td>
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: center;" contenteditable="true">
                                  <?PHP  
                                    $thisVal = 0;
                                    $equal = 0;
                                    $rf = 0;
                                    $equal2 = 0;
                                    $equal3 = 0;
                                    $equal4 = 0;
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    
                                            $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no3 = 'R.F' AND row_no != '0' ";
                                            $resultSum = $conn->query($sqlSum);
                                            if ($resultSum->num_rows > 0) {
                                                while($rowSum = $resultSum->fetch_assoc()){
        
                                                    $sqlSum2 = " SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                                    $resultSum2 = $conn->query($sqlSum2);
                                                    if ($resultSum2->num_rows > 0) {
                                                        $rowSum2 = $resultSum2->fetch_assoc();
                                                        if( $rowSum2['no6'] != '' && $rowSum2['no7'] != '' ){
                                                            $rf += $rowSum['no4'];
                                                        }
                                                    }
        
                                                }
                                            }

                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal2 = number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    
                                    $sqlSumRev = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                    $resultSumRev = $conn->query($sqlSumRev);
                                    if ($resultSumRev->num_rows > 0) {
                                        while($rowSumRev = $resultSumRev->fetch_assoc()){
                                            //$thisVal = number_format((float)$rowSumRev['total'],2);
                                            $thisVal = $rowSumRev['total'];
                                        }
                                    }     
                                    
                                    $equal3 =  (($equal - $equal2)+$rf);
                                    $equal4 = (($equal3 / $thisVal) * 100);



                                    //echo number_format((float)$equal4, 2, '.', '').'%';
                                    //echo ($equal3 / $thisVal);
                                    echo number_format((float)(($equal3 / $thisVal)* 100),2).'%';
                                  ?>

                                </td>
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: center;" contenteditable="true">
                                    <?PHP
                                    $countTotalJob = '0';
                                    $totalJob = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' AND no11 LIKE '%NJ%'  ";
                                    $resTotalJob  = $conn->query($totalJob);
                                    $countTotalJob = $resTotalJob->num_rows;
                                    echo $countTotalJob;
                                    ?>
                                </td>
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: center;" contenteditable="true">
                                    <?PHP
                                    $countTotalJob = '0';
                                    $totalJob = " SELECT main_id, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY no2  ";
                                    $resTotalJob  = $conn->query($totalJob);
                                    $countTotalJob = $resTotalJob->num_rows;
                                    echo $countTotalJob;
                                    ?>
                                </td>
                                <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: center;" contenteditable="true">
                                    <?PHP
                                    $array = array();
                                    $totalClients = " SELECT main_id, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY no2  ";
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
                                </td>
                            </tr>                      
                    <?PHP
                    }
                }
              ?>
                   

              </tbody>
              <tfoot>
                <tr style="border-top: 1px solid black;">
                    <td class="table-header" style="font-size:14px;width:120px;text-align: left;border-right: 1px solid black;" >
Grand Total
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                        <?PHP
                        $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $totalFooter = 0;
                            while($row = $result->fetch_assoc()){
                                    $sqlSumRev = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                    $resultSumRev = $conn->query($sqlSumRev);
                                    if ($resultSumRev->num_rows > 0) {
                                        while($rowSumRev = $resultSumRev->fetch_assoc()){
                                            //echo number_format((float)$rowSumRev['total'], 2, '.', '');  
                                            $totalFooter += number_format((float)$rowSumRev['total'], 2, '.', '');  
                                        }
                                    }
                            }
                            echo number_format($totalFooter,2);
                        }
                        ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                        <?PHP
                        $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $totalFooter = 0;                                    
                            $totalRefund = 0;
                            $Before = 0;
                            $After = 0;
                            while($row = $result->fetch_assoc()){
                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $Before += number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                    $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' AND no11 LIKE '%rtc%' ";
                                    $resultSumRefund = $conn->query($sqlSumRefund);
                                    if ($resultSumRefund->num_rows > 0) {
                                        while($rowSumRefund = $resultSumRefund->fetch_assoc()){
                                            $After += number_format((float)$rowSumRefund['total'], 2, '.', '');  
                                        }
                                    }
                            }
                            $totalRefund = $Before - $After;
                            echo number_format($totalRefund,2);
                        }
                        ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                        <?PHP
                        $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $totalFooter = 0;
                            while($row = $result->fetch_assoc()){
                                    $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' AND no11 LIKE '%rtc%' ";
                                    $resultSumRefund = $conn->query($sqlSumRefund);
                                    if ($resultSumRefund->num_rows > 0) {
                                        while($rowSumRefund = $resultSumRefund->fetch_assoc()){
                                            $totalFooter += number_format((float)$rowSumRefund['total'], 2, '.', '');  
                                        }
                                    }
                            }
                            echo number_format($totalFooter,2);
                        }
                        ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                        <?PHP
                        $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $totalFooter = 0;
                            $equal = 0;
                            $rf = 0;
                            $equal2 = 0;
                            $equal3 = 0;
                            while($row = $result->fetch_assoc()){
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal += number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                                            /*
                                            $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no3 = 'R.F' AND row_no != '0' ";
                                            $resultSum = $conn->query($sqlSum);
                                            if ($resultSum->num_rows > 0) {
                                                while($rowSum = $resultSum->fetch_assoc()){
                                                    $rf += number_format((float)$rowSum['total'], 2, '.', '');  
                                                }
                                            }
                                            */
                                            $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no3 = 'R.F' AND row_no != '0' ";
                                            $resultSum = $conn->query($sqlSum);
                                            if ($resultSum->num_rows > 0) {
                                                while($rowSum = $resultSum->fetch_assoc()){
        
                                                    $sqlSum2 = " SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                                    $resultSum2 = $conn->query($sqlSum2);
                                                    if ($resultSum2->num_rows > 0) {
                                                        $rowSum2 = $resultSum2->fetch_assoc();
                                                        if( $rowSum2['no6'] != '' && $rowSum2['no7'] != '' ){
                                                            $rf += $rowSum['no4'];
                                                        }
                                                    }
        
                                                }
                                            }

                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal2 += number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                            }
                            //$equal3 =  $equal - $equal2;
                            $equal3 =  (($equal - $equal2)+$rf);
                            echo number_format($equal3,2);
                        }
                        ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: center;border-right: 1px solid black;" >
<?PHP

                        $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $totalFooter = 0;
                            $equal = 0;
                            $equalThis = 0;
                            $rf = 0;
                            $equal2 = 0;
                            $equal3 = 0;
                            while($row = $result->fetch_assoc()){
                                    $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal += number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
 

                                    $sqlSumRev = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                    $resultSumRev = $conn->query($sqlSumRev);
                                    if ($resultSumRev->num_rows > 0) {
                                        while($rowSumRev = $resultSumRev->fetch_assoc()){
                                            $totalFooter += number_format((float)$rowSumRev['total'], 2, '.', '');  
                                        }
                                    }
                        

                                    
                                            $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no3 = 'R.F' AND row_no != '0' ";
                                            $resultSum = $conn->query($sqlSum);
                                            if ($resultSum->num_rows > 0) {
                                                while($rowSum = $resultSum->fetch_assoc()){
        
                                                    $sqlSum2 = " SELECT * FROM tk_sales_sub WHERE id != '".$rowSum['id']."' AND no1 = '".$rowSum['no1']."' AND no2 = '".$rowSum['no2']."' AND main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                                    $resultSum2 = $conn->query($sqlSum2);
                                                    if ($resultSum2->num_rows > 0) {
                                                        $rowSum2 = $resultSum2->fetch_assoc();
                                                        if( $rowSum2['no6'] != '' && $rowSum2['no7'] != '' ){
                                                            $rf += $rowSum['no4'];
                                                        }
                                                    }
        
                                                }
                                            }

                                    $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND no7 != '' AND row_no != '0' ";
                                    $resultSum = $conn->query($sqlSum);
                                    if ($resultSum->num_rows > 0) {
                                        while($rowSum = $resultSum->fetch_assoc()){
                                            $equal2 += number_format((float)$rowSum['total'], 2, '.', '');  
                                        }
                                    }
                            }
                            //$equal3 =  $equal - $equal2;
                            $equal3 =  (($equal - $equal2)+$rf);
                            echo number_format((($equal3 / $totalFooter) * 100),2).'%';
                        }
                        ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: center;border-right: 1px solid black;" >
                        <?PHP
                        $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $totalFooter = 0;
                            $equal = 0;
                            $equal2 = 0;
                            $equal3 = 0;
                            $countTotalJob = '0';
                            while($row = $result->fetch_assoc()){
                                    $totalJob = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' AND no11 LIKE '%NJ%'  ";
                                    $resTotalJob  = $conn->query($totalJob);
                                    $countTotalJob += $resTotalJob->num_rows;                              
                            }
                            echo $countTotalJob;  
                        }
                        ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: center;border-right: 1px solid black;" >

                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: center;border-right: 1px solid black;" >

                    </td>
                </tr>
              </tfoot>
            </table> 





<?PHP    
}
$conn->close();
?>
