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
/*    
    echo $dataGrid['mainID'].'<br>';
    echo $dataGrid['tab'].'<br>';
    echo $dataGrid['month'].'<br>';
*/

    $sqlSelect = " SELECT * FROM tk_sales_expenses WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' ORDER BY row_no ASC";
    $resultSelect = $conn->query($sqlSelect);
    if ($resultSelect->num_rows > 0) {
        
        ?>
        <table class="tbl-qa">
            <thead>
                <tr>
                    <th class="table-header" style="font-size:14px;width:80px;text-align: center;"  >Date</th>
                    <th class="table-header" style="font-size:14px;width:400px;text-align: center;"  >Item</th>
                	  
                    <th class="table-header" style="font-size:14px;width:80px;text-align: center;" >Amount</th>
                    <th class="table-header" style="font-size:14px;width:300px;text-align: center;"  >Note</th>

                    <th class="table-header" style="font-size:14px;width:50px;text-align: center;"  >Action</th>
                </tr>
            </thead>
            <tbody id="table-bodyExpenses" style="font-size:14px;">
                <?PHP
                while($rowSelect = $resultSelect->fetch_assoc()){
                    
                ?><tr class="table-row" >
                    <td id="bodyExpenses<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:80px;"                    contenteditable="true"  onkeyup="saveExpenses(this,'date','<?php echo $rowSelect["id"]; ?>','table-bodyExpenses')"   onClick="editRow(this,'','table-bodyExpenses');"> <?php echo $rowSelect["date"]; ?>  </td>
                    <td id="bodyExpenses<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:400px;"                   contenteditable="true"  onkeyup="saveExpenses(this,'item','<?php echo $rowSelect["id"]; ?>','table-bodyExpenses')"   onClick="editRow(this,'','table-bodyExpenses');"> <?php if($rowSelect["item"] == 'kosong' ){ echo ''; }else{ echo $rowSelect["item"]; } ?>  </td>
                    
                    <td id="bodyExpenses<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:80px;text-align: right;"  contenteditable="true"  onkeyup="saveExpenses(this,'amount','<?php echo $rowSelect["id"]; ?>','table-bodyExpenses')" onClick="editRow(this,'','table-bodyExpenses');"> <?php if($rowSelect["amount"] == 'kosong' ){ echo ''; }else{ echo $rowSelect["amount"]; }  ?>  </td>
                    <td id="bodyExpenses<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:300px;"                   contenteditable="true"  onkeyup="saveExpenses(this,'note','<?php echo $rowSelect["id"]; ?>','table-bodyExpenses')"   onClick="editRow(this,'','table-bodyExpenses');"> <?php if($rowSelect["note"] == 'kosong' ){ echo ''; }else{ echo $rowSelect["note"]; } ?>  </td>

                    <td id="bodyExpenses<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:50px;"> 
                        <a class="ajax-action-links" onclick="deleteRecordExpenses(<?php echo $rowSelect["id"]; ?>);"><span class="" style="margin-left:5px; color:#872247"><b>x</b></span></a> 
                    </td>
                </tr><?PHP
                    
                }
                ?>
            </tbody>
            <tfoot>
                <tr style="background-color: #F5F5F5;">
                    <th class="table-header" style="font-size:14px;width:80px;" >Total</th>
                    <td class="table-header" style="font-size:14px;width:400px;"></td>
                    
                    <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"> 
                    <?PHP
                        $sqlSum = " SELECT SUM(amount) as total FROM tk_sales_expenses WHERE main_id = '".$dataGrid['mainID']."' AND month = '".$dataGrid['month']."' ";
                        $resultSum = $conn->query($sqlSum);
                        if ($resultSum->num_rows > 0) {
                            while($rowSum = $resultSum->fetch_assoc()){
                                //echo number_format((float)$rowSum['total'], 2, '.', '');
                                echo number_format($rowSum['total'],2);
                            }
                        }
                    ?>
                    </td>
                    <td class="table-header" style="font-size:14px;width:300px;"></td>

                    <th class="table-header" style="font-size:14px;width:50px;text-align: center;"  ></th>
                    
                </tr>
            </tfoot>
        </table>
        <?PHP
        
    }else{

        echo '
            <table class="tbl-qa">
              <thead>
            	<tr>
            	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;"  >Date</th>
            	  <th class="table-header" style="font-size:14px;width:400px;text-align: center;"  >Item</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" >Amount</th>
            	  <th class="table-header" style="font-size:14px;width:300px;text-align: center;"  >Note</th>

            	  <th class="table-header" style="font-size:14px;width:50px;text-align: center;"  >Action</th>
            	  
            	</tr>
              </thead>
              <tbody id="table-bodyExpenses" style="font-size:14px;">
                <tr class="table-row" >
                </tr>
              </tbody>
              <tfoot>
                <tr style="background-color: white;">
                    <th class="table-header" style="font-size:14px;width:80px;" >Total</th>
                    <td class="table-header" style="font-size:14px;width:400px;"></td>
                    
                    <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"> 0.00</td>
                    <td class="table-header" style="font-size:14px;width:300px;"></td>

                    <td class="table-header" style="font-size:14px;width:50px;"></td>
                </tr>
              </tfoot>
            </table>';
            
    }

    ?><br/><button id="add-moreExpenses" onClick="createExpenses();" type="button" class="btn btn-success-ori btn-sm"><span class="glyphicon glyphicon-plus"></span> Add More</button>
    <!--<button id="add-moreExpenses" onClick="createExpensesNew();" type="button" class="btn btn-danger-ori btn-sm"><span class="glyphicon glyphicon-plus"></span> Test</button>-->
    <?PHP






   
}
$conn->close();
?>