<style>
/*
.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;}*/
.tbl-qa{background-color: #f5f5f5;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;}
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
	
    $sqlSelect = " SELECT main_id, tab_name, month, row_no FROM tk_sales_sub WHERE main_id = '".$dataFooter['mainID']."' AND tab_name = '".$dataFooter['tab']."' AND month = '".$dataFooter['month']."' AND row_no != '0' ";
    $resultSelect = $conn->query($sqlSelect);
    if ($resultSelect->num_rows > 0) {
        $rowSelect = $resultSelect->fetch_assoc();
        ?>
        <tr style="background-color: white;">
            <th class="table-header" style="font-size:14px;width:30px;" ></th>
            <td class="table-header" style="font-size:14px;width:80px;"></td>
            <td class="table-header" style="font-size:14px;width:50px;"></td>
            <td class="table-header" style="font-size:14px;width:150px;"></td>
            <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"> 
            <?PHP
                $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '".$dataFooter['mainID']."' AND tab_name = '".$dataFooter['tab']."' AND month = '".$dataFooter['month']."' AND row_no != '0' ";
                $resultSum = $conn->query($sqlSum);
                if ($resultSum->num_rows > 0) {
                    while($rowSum = $resultSum->fetch_assoc()){
                        //echo number_format((float)$rowSum['total'], 2, '.', '');  
                        echo number_format($rowSum['total'],2);
                    }
                }
            ?>
            </td>
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
            <?PHP
                $sqlSum = " SELECT SUM(no8) as total FROM tk_sales_sub WHERE main_id = '".$dataFooter['mainID']."' AND tab_name = '".$dataFooter['tab']."' AND month = '".$dataFooter['month']."' AND row_no != '0' ";
                $resultSum = $conn->query($sqlSum);
                if ($resultSum->num_rows > 0) {
                    while($rowSum = $resultSum->fetch_assoc()){
                        //echo number_format((float)$rowSum['total'], 2, '.', '');  
                        echo number_format($rowSum['total'],2);
                    }
                }
            ?>
            </td>
            
            <td class="table-header" style="font-size:14px;width:250px;border-right: 3px solid black;"></td>
            <td class="table-header" style="font-size:14px;width:80px;"></td>
            <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
            <?PHP
                $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '".$dataFooter['mainID']."' AND tab_name = '".$dataFooter['tab']."' AND month = '".$dataFooter['month']."' AND row_no != '0' ";
                $resultSum = $conn->query($sqlSum);
                if ($resultSum->num_rows > 0) {
                    while($rowSum = $resultSum->fetch_assoc()){
                        //echo number_format((float)$rowSum['total'], 2, '.', '');  
                        echo number_format($rowSum['total'],2);
                    }
                }
            ?>
            </td>
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
			  <?PHP  
				$no4 = 0;
				$no7 = 0;
				$rf = 0;
				$Total = 0;								$no5 = 0;								//SELECT (SUM(no4) - SUM(no7)) as total FROM tk_sales_sub WHERE main_id = '1' AND tab_name = 'Nadia' AND month = 'Aug' AND no7 != '' AND row_no != '' AND row_no != '0';
				$sqlSum = " SELECT (SUM(no4) - SUM(no7)) as total FROM tk_sales_sub WHERE main_id = '".$dataFooter['mainID']."' AND tab_name = '".$dataFooter['tab']."' AND month = '".$dataFooter['month']."' AND no7 != '' AND row_no != '0' AND row_no != '' ";
				$resultSum = $conn->query($sqlSum);
				if ($resultSum->num_rows > 0) {
					while($rowSum = $resultSum->fetch_assoc()){
						$no4 = number_format((float)$rowSum['total'], 2, '.', '');  
					}
				}
				//SELECT sum(no4) FROM tk_sales_sub as tk WHERE EXISTS (SELECT no2 FROM tk_sales_sub as t WHERE t.no2 = tk.no2 AND no7 != '' ) AND no3 = 'R.F' AND main_id = '1' AND tab_name = 'Ain' AND month = 'Oct'
				$sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub as tk WHERE EXISTS (SELECT no2 FROM tk_sales_sub as t WHERE t.no2 = tk.no2 AND no7 != '' AND no5 NOT LIKE '%trial%' ) AND main_id = '".$dataFooter['mainID']."' AND tab_name = '".$dataFooter['tab']."' AND month = '".$dataFooter['month']."' AND no3 = 'R.F' AND row_no != '0' AND row_no != '' ";				$resultSum = $conn->query($sqlSum);				if ($resultSum->num_rows > 0) {					while($rowSum = $resultSum->fetch_assoc()){						$no5 = number_format((float)$rowSum['total'], 2, '.', '');  					}				}				$Total =  $no4 + $no5;								echo number_format((float)$Total,2);								//SELECT sum(t.no4) FROM tk_sales_sub as tk inner join (SELECT * FROM tk_sales_sub WHERE main_id = '1' AND tab_name = 'Nadia' AND month = 'Sep' AND no7 = '' AND row_no = '999999') as t on t.id = tk.id WHERE tk.no2 = t.no2 AND t.no3 = 'R.F'				//$sqlSum = " SELECT SUM(t.no4) as total FROM tk_sales_sub as tk inner join (SELECT * FROM tk_sales_sub WHERE main_id = '".$dataFooter['mainID']."' AND tab_name = '".$dataFooter['tab']."' AND month = '".$dataFooter['month']."' AND no7 = '' AND row_no = '999999') as t on t.id = tk.id WHERE tk.no2 = t.no2 AND t.no3 = 'R.F' ";												//$resultSum = $conn->query($sqlSum);				//if ($resultSum->num_rows > 0) {										//while($rowSum = $resultSum->fetch_assoc()){						//$cf = number_format((float)$rowSum['SUM(t.no4)'], 2, '.', '');  												//echo $cf;					//}				//}								
																						  ?>
            </td>
            <td class="table-header" style="font-size:14px;width:50px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
            <?PHP
                $sqlSum = " SELECT SUM(no10) as total FROM tk_sales_sub WHERE main_id = '".$dataFooter['mainID']."' AND tab_name = '".$dataFooter['tab']."' AND month = '".$dataFooter['month']."' AND row_no != '0' ";
                $resultSum = $conn->query($sqlSum);
                if ($resultSum->num_rows > 0) {
                    while($rowSum = $resultSum->fetch_assoc()){
                        echo number_format($rowSum['total']);  
                    }
                }
            ?>
            </td>
            <td class="table-header" style="font-size:14px;width:250px;"></td>
            <td class="table-header" style="font-size:14px;width:140px;"></td>
        </tr>
        <!--<tr style="border-top: 1px solid black;">
            <th class="table-header" style="font-size:14px;width:30px;text-align: center;" >No</th>
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;"> <span aria-label="Date Client Paid" data-balloon-pos="up" ><i class="fa fa-calendar" aria-hidden="true"></i></span> </td>
            <td class="table-header" style="font-size:14px;width:50px;text-align: center;">Job</td>
            
            <td class="table-header" style="font-size:14px;width:150px;text-align: center;">Tutor's Name</td>
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;"> <span aria-label="Amount received from Client" data-balloon-pos="up" ><i class="fa fa-usd" aria-hidden="true"></i></span> </td>
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;">Rate</td>
            
            <td class="table-header" style="font-size:14px;width:250px;text-align: center;border-right: 3px solid black;">Note</td>
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;"> <span aria-label="Date Tutor Paid" data-balloon-pos="up" ><i class="fa fa-calendar" aria-hidden="true"></i></span> </td>
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;"> <span aria-label="Amount paid/Refund to client" data-balloon-pos="up" ><i class="fa fa-money" aria-hidden="true"></i></span> </td>
            
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;">GP</td>
            <td class="table-header" style="font-size:14px;width:50px;text-align: center;"> <span aria-label="Hours per cycle" data-balloon-pos="up" ><i class="fa fa-clock-o" aria-hidden="true"></i></span> </td>
            <td class="table-header" style="font-size:14px;width:250px;text-align: center;">Note</td>
            
            <td class="table-header" style="font-size:14px;width:140px;text-align: center;">Actions</td>
        </tr>-->
        <?PHP
    }else{
        ?>
        <tr style="background-color: white;">
            <th class="table-header" style="font-size:14px;width:30px;" ></th>
            <td class="table-header" style="font-size:14px;width:80px;"></td>
            <td class="table-header" style="font-size:14px;width:50px;"></td>
            
            <td class="table-header" style="font-size:14px;width:150px;"></td>
            <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0.00</td>
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0.00</td>
            
            <td class="table-header" style="font-size:14px;width:250px;border-right: 3px solid black;"></td>
            
            <td class="table-header" style="font-size:14px;width:80px;"></td>
            <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0.00</td>
            
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0.00</td>
            <td class="table-header" style="font-size:14px;width:50px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0</td>
            <td class="table-header" style="font-size:14px;width:250px;"></td>
            
            <td class="table-header" style="font-size:14px;width:140px;"></td>
        </tr>
        <!--<tr style="border-top: 1px solid black;">
            <th class="table-header" style="font-size:14px;width:30px;text-align: center;" >No</th>
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;"> <span aria-label="Date Client Paid" data-balloon-pos="up" ><i class="fa fa-calendar" aria-hidden="true"></i></span> </td>
            <td class="table-header" style="font-size:14px;width:50px;text-align: center;">Job</td>
            
            <td class="table-header" style="font-size:14px;width:150px;text-align: center;">Tutor's Name</td>
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;"> <span aria-label="Amount received from Client" data-balloon-pos="up" ><i class="fa fa-usd" aria-hidden="true"></i></span> </td>
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;">Rate</td>
            
            <td class="table-header" style="font-size:14px;width:250px;text-align: center;border-right: 3px solid black;">Note</td>
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;"> <span aria-label="Date Tutor Paid" data-balloon-pos="up" ><i class="fa fa-calendar" aria-hidden="true"></i></span> </td>
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;"> <span aria-label="Amount paid/Refund to client" data-balloon-pos="up" ><i class="fa fa-money" aria-hidden="true"></i></span> </td>
            
            
            <td class="table-header" style="font-size:14px;width:80px;text-align: center;">GP</td>
            <td class="table-header" style="font-size:14px;width:50px;text-align: center;"> <span aria-label="Hours per cycle" data-balloon-pos="up" ><i class="fa fa-clock-o" aria-hidden="true"></i></span> </td>
            <td class="table-header" style="font-size:14px;width:250px;text-align: center;">Note</td>
            
            <td class="table-header" style="font-size:14px;width:140px;text-align: center;">Actions</td>
        </tr>-->
        <?PHP
    }
    
}
?>