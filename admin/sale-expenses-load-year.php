<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
require_once('classes/config.php.inc');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if (isset($_POST['dataGrid'])) {
    $dataGrid = $_POST['dataGrid'];
    ?>

    <table class="tbl-qa" style="width: 200px;float: left;">

        <thead>
            <tr>
                <th class="table-header" style="font-size:14px;width:120px;border-right: 1px solid black;">
                    <center></center>
                </th>
                <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">
                    <center> Expenses</center>
                </th>
            </tr>
        </thead>

        <tbody id="bodyYear">

            <?php
            $sql = sprintf(
                "SELECT * FROM tk_sales_expenses 
                WHERE main_id = '%s' AND month !='' 
                GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec')",
                $dataGrid['mainID']
            );

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr class="table-row" id="">
                        <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:120px;text-left: right;" contenteditable="true">
                            <?PHP echo $row['month']; ?>
                        </td>

                        <td onClick="editRow(this,'remove','bodyYear');" class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">

                            <?php
                            $sqlSumRev = sprintf(
                                "SELECT SUM(amount) as total FROM tk_sales_expenses 
                                WHERE main_id = '%s' AND month = '%s' AND row_no != '0'",
                                $dataGrid['mainID'], $row['month']
                            );

                            $resultSumRev = $conn->query($sqlSumRev);

                            if ($resultSumRev->num_rows > 0) {
                                while ($rowSumRev = $resultSumRev->fetch_assoc()) {
                                    echo number_format((float) $rowSumRev['total'], 2);
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>

        <tfoot>
            <tr style="border-top: 1px solid black;">
                <td class="table-header" style="font-size:14px;width:120px;text-align: left;border-right: 1px solid black;">
                    Grand Total
                </td>
                <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;">
                    <?php
                    $sql = sprintf(
                        "SELECT * FROM tk_sales_expenses 
                        WHERE main_id = '%s' AND month !='' 
                        GROUP BY month ORDER BY FIELD(month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec')",
                        $dataGrid['mainID']
                    );

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $totalFooter = 0;

                        while ($row = $result->fetch_assoc()) {
                            $sqlSumRev = sprintf(
                                "SELECT SUM(amount) as total FROM tk_sales_expenses 
                                WHERE main_id = '%s' AND month = '%s' AND row_no != '0'",
                                $dataGrid['mainID'], $row['month']
                            );

                            $resultSumRev = $conn->query($sqlSumRev);

                            if ($resultSumRev->num_rows > 0) {
                                while ($rowSumRev = $resultSumRev->fetch_assoc()) {
                                    $totalFooter += number_format((float) $rowSumRev['total'], 2, '.', '');
                                }
                            }
                        }

                        echo number_format($totalFooter, 2);
                    }
                    ?>
                </td>
            </tr>
        </tfoot>

    </table>

    <?php
}

$conn->close();

?>
