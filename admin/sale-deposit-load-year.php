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
            	  <th class="table-header" style="font-size:14px;width:120px;border-right: 1px solid black;" ><center>   </center></th>
            	  <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;" ><center> Deposit </center></th>
            	</tr>
              </thead>
              <tbody id="bodyYear" >
              <?PHP
                $sql = " SELECT * FROM tk_sales_deposit WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
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
                                    $sqlSumRev = " SELECT SUM(amount) as total FROM tk_sales_deposit WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
                                    $resultSumRev = $conn->query($sqlSumRev);
                                    if ($resultSumRev->num_rows > 0) {
                                        while($rowSumRev = $resultSumRev->fetch_assoc()){
                                            //echo number_format((float)$rowSumRev['total'], 2, '.', ''); 
                                            echo number_format((float)$rowSumRev['total'],2);
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
                    <td class="table-header" style="font-size:14px;width:120px;text-align: left;border-right: 1px solid black;" >
Grand Total
                    </td>
                    <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;" >
                        <?PHP
                        $sql = " SELECT * FROM tk_sales_deposit WHERE main_id = '".$dataGrid['mainID']."' AND month !='' GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $totalFooter = 0;
                            while($row = $result->fetch_assoc()){
                                    $sqlSumRev = " SELECT SUM(amount) as total FROM tk_sales_deposit WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$row['month']."' AND row_no != '0' ";
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
                </tr>
              </tfoot>
            </table> 





<?PHP    
}
$conn->close();
?>
