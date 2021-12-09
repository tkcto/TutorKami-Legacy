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

    $sqlSelect = " SELECT * FROM tk_sales_bank WHERE main_id = '".$dataGrid['mainID']."' ORDER BY row_no ASC";
    $resultSelect = $conn->query($sqlSelect);
    if ($resultSelect->num_rows > 0) {
        
        ?>				<br/>
        <table class="tbl-qa">
            <tbody id="table-bodyBank" style="font-size:14px;">
                <?PHP
                while($rowSelect = $resultSelect->fetch_assoc()){
                    
                ?><tr class="table-row" >
                    <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center;"> TK </td>
                    <td id="bodyBank<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:80px;text-align: right;"  contenteditable="true"  onkeyup="saveBank(this,'tk','<?php echo $rowSelect["id"]; ?>','table-bodyBank')" onClick="editRow(this,'','table-bodyBank');"> <?php if($rowSelect["tk"] == 'kosong' ){ echo ''; }else{ echo $rowSelect["tk"]; }  ?></td>
                    
                    <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center;"> HS </td>
                    <td id="bodyBank<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:80px;text-align: right;"  contenteditable="true"  onkeyup="saveBank(this,'hs','<?php echo $rowSelect["id"]; ?>','table-bodyBank')" onClick="editRow(this,'','table-bodyBank');"> <?php if($rowSelect["hs"] == 'kosong' ){ echo ''; }else{ echo $rowSelect["hs"]; }  ?></td>

                    <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center;"> Date </td>										<td id="bodyBank<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:200px;text-align: right;" contenteditable="true"  onkeyup="saveBank(this,'date','<?php echo $rowSelect["id"]; ?>','table-bodyBank')"   onClick="editRow(this,'','table-bodyBank');"> <?php echo $rowSelect["date"]; ?>  </td>
                </tr>				<tr class="table-row" >                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                </tr>				<tr class="table-row" >                    <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center;"> Total Bank </td>					                    <td id="" class="row-data" style="font-size:14px;width:80px;text-align: right;"> <?php echo number_format((str_replace(",", "", $rowSelect["tk"]) + str_replace(",", "", $rowSelect["hs"])),2)  ?></td>                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                </tr>				<tr class="table-row" >                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>					                </tr>				<tr class="table-row" >                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                </tr>				<tr class="table-row" >                    <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center"> Latest Balance </td>                    <td id="bodyBank<?php echo $rowSelect["id"]; ?>" class="row-data" style="font-size:14px;width:80px;text-align: right;"  contenteditable="true"  onkeyup="saveBank(this,'latest_balance','<?php echo $rowSelect["id"]; ?>','table-bodyBank')" onClick="editRow(this,'','table-bodyBank');"> <?php if($rowSelect["latest_balance"] == 'kosong' ){ echo ''; }else{ echo $rowSelect["latest_balance"]; }  ?></td>					<td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>										<td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp; </td>                    <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp; </td>                </tr>												<?PHP        
                }
                ?>
            </tbody>
        </table>
        <?PHP
        
    }else{

        echo '
            <table class="tbl-qa">
              <tbody id="table-bodyBank" style="font-size:14px;">
                <tr class="table-row" >
                </tr>
              </tbody>
            </table>';
            
    }

    ?><br/>
    
    <?PHP
}
$conn->close();
?>