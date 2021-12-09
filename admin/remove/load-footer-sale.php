<style>
.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;}
.tbl-qa th.table-header {padding: 3px;text-align: left;padding:8px;}
.tbl-qa td.table-header {padding: 3px;text-align: left;padding:8px;font-size:0.9em;font-weight: bold;}
.tbl-qa .table-row td {padding:8px;background-color: #FDFDFD;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;}
.ajax-action-links {color: #09F; margin: 8px 0px;cursor:pointer;}
.ajax-action-button {border:#094 1px solid;color: #09F; margin: 8px 0px;cursor:pointer;display: inline-block;padding: 8px 18px;}
</style>

<?php
require_once('classes/config.php.inc');

// Create connection <!-- DONE BACKUP -->
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


if(isset($_POST['dataFooter'])){
	$dataFooter = $_POST['dataFooter'];
	
	//echo $dataFooter['id'].'<br>';
	//echo $dataFooter['month'].'<br>';
	
    $sqlSelect = " SELECT id, main_id, tab_name FROM tk_sales_sub WHERE id = '".$dataFooter['id']."'  ";
    $resultSelect = $conn->query($sqlSelect);
    if ($resultSelect->num_rows > 0) {
        $rowSelect = $resultSelect->fetch_assoc();
        ?>
        <tr style="background-color: white;">
            <th class="table-header" style="font-size:14px;width:30px;" ></th>
            <td class="table-header" style="font-size:14px;width:150px;"></td>
            <td class="table-header" style="font-size:14px;width:80px;"></td>
            <td class="table-header" style="font-size:14px;width:200px;"></td>
            <td class="table-header" style="font-size:14px;width:80px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"> 
            <?PHP
                $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$rowSelect['main_id']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataFooter['month']."' AND temp != 'Delete' AND row_no != '0' ";
                $resultSum = $conn->query($sqlSum);
                if ($resultSum->num_rows > 0) {
                    while($rowSum = $resultSum->fetch_assoc()){
                        //echo number_format((float)$rowSum['total'], 2, '.', '');  // Outputs -> 105.00
                        echo number_format($rowSum['total'],2);
                    }
                }
            ?>
            </td>
            <td class="table-header" style="font-size:14px;width:300px;"></td>
            <td class="table-header" style="font-size:14px;width:150px;"></td>
            <td class="table-header" style="font-size:14px;width:300px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
            <?PHP
                $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$rowSelect['main_id']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataFooter['month']."' AND temp != 'Delete' AND row_no != '0' ";
                $resultSum = $conn->query($sqlSum);
                if ($resultSum->num_rows > 0) {
                    while($rowSum = $resultSum->fetch_assoc()){
                        //echo number_format((float)$rowSum['total'], 2, '.', '');  
                        echo number_format($rowSum['total'],2);
                    }
                }
            ?>
            </td>
            <td class="table-header" style="font-size:14px;width:80px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"></td>
            <td class="table-header" style="font-size:14px;width:130px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
            <?PHP
                $sqlSum = " SELECT SUM(no9) as total FROM tk_sales_sub WHERE main_id = '".$rowSelect['main_id']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataFooter['month']."' AND temp != 'Delete' AND row_no != '0' ";
                $resultSum = $conn->query($sqlSum);
                if ($resultSum->num_rows > 0) {
                    while($rowSum = $resultSum->fetch_assoc()){
                        //echo number_format((float)$rowSum['total'], 2, '.', '');
                        echo number_format($rowSum['total'],2);
                    }
                }
            ?>
            </td>
            <td class="table-header" style="font-size:14px;width:80px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
            <?PHP
                $sqlSum = " SELECT SUM(no10) as total FROM tk_sales_sub WHERE main_id = '".$rowSelect['main_id']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataFooter['month']."' AND temp != 'Delete' AND row_no != '0' ";
                $resultSum = $conn->query($sqlSum);
                if ($resultSum->num_rows > 0) {
                    while($rowSum = $resultSum->fetch_assoc()){
                        echo number_format($rowSum['total']);  
                    }
                }
            ?>
            </td>
            <td class="table-header" style="font-size:14px;width:300px;"></td>
            <td class="table-header" style="font-size:14px;width:130px;"></td>
        </tr>
        <tr style="border-top: 1px solid black;">
            <th class="table-header" style="font-size:14px;width:30px;" >No</th>
            <td class="table-header" style="font-size:14px;width:150px;">Date Client Paid</td>
            <td class="table-header" style="font-size:14px;width:80px;">Job</td>
            <td class="table-header" style="font-size:14px;width:200px;">Tutor's Name</td>
            <td class="table-header" style="font-size:14px;width:80px;">Received</td>
            <td class="table-header" style="font-size:14px;width:300px;">Note</td>
            <td class="table-header" style="font-size:14px;width:150px;">Date Tutor Paid</td>
            <td class="table-header" style="font-size:14px;width:300px;">Paid to Tutor/Refund to pr</td>
            <td class="table-header" style="font-size:14px;width:80px;">GST</td>
            <td class="table-header" style="font-size:14px;width:130px;">Gross Profit</td>
            <td class="table-header" style="font-size:14px;width:80px;">Hour</td>
            <td class="table-header" style="font-size:14px;width:300px;">Note</td>
            <td class="table-header" style="font-size:14px;width:130px;">Actions</td>
        </tr>
        <?PHP
    }else{
        echo 'Error !!';
        ?>
        <tr style="background-color: white;">
            <th class="table-header" style="font-size:14px;width:30px;" ></th>
            <td class="table-header" style="font-size:14px;width:150px;"></td>
            <td class="table-header" style="font-size:14px;width:80px;"></td>
            <td class="table-header" style="font-size:14px;width:200px;"></td>
            <td class="table-header" style="font-size:14px;width:80px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"> </td>
            <td class="table-header" style="font-size:14px;width:300px;"></td>
            <td class="table-header" style="font-size:14px;width:150px;"></td>
            <td class="table-header" style="font-size:14px;width:300px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">Paid to Tutor/Refund to pr</td>
            <td class="table-header" style="font-size:14px;width:80px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">GST</td>
            <td class="table-header" style="font-size:14px;width:130px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">Gross Profit</td>
            <td class="table-header" style="font-size:14px;width:80px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">Hour</td>
            <td class="table-header" style="font-size:14px;width:300px;"></td>
            <td class="table-header" style="font-size:14px;width:130px;"></td>
        </tr>
        <tr style="border-top: 1px solid black;">
            <th class="table-header" style="font-size:14px;width:30px;" >No</th>
            <td class="table-header" style="font-size:14px;width:150px;">Date Client Paid</td>
            <td class="table-header" style="font-size:14px;width:80px;">Job</td>
            <td class="table-header" style="font-size:14px;width:200px;">Tutor's Name</td>
            <td class="table-header" style="font-size:14px;width:80px;">Received</td>
            <td class="table-header" style="font-size:14px;width:300px;">Note</td>
            <td class="table-header" style="font-size:14px;width:150px;">Date Tutor Paid</td>
            <td class="table-header" style="font-size:14px;width:300px;">Paid to Tutor/Refund to pr</td>
            <td class="table-header" style="font-size:14px;width:80px;">GST</td>
            <td class="table-header" style="font-size:14px;width:130px;">Gross Profit</td>
            <td class="table-header" style="font-size:14px;width:80px;">Hour</td>
            <td class="table-header" style="font-size:14px;width:300px;">Note</td>
            <td class="table-header" style="font-size:14px;width:130px;">Actions</td>
        </tr>
        <?PHP
    }
    
}
?>