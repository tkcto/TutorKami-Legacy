<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
require_once('classes/config.php.inc');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if (isset($_POST['dataGrid'])) {
    # GP grand total:
    $sql = sprintf("
        SELECT 
            TRUNCATE(SUM(no4), 2) as equal,
            TRUNCATE(SUM(no7), 2) as equal2
        FROM tk_sales_sub
        WHERE main_id = '%s'
            AND no7 != ''
            AND row_no != '0' ",
        $_POST['dataGrid']['mainID']
    );

    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    $equal = (float)$result['equal'];
    $equal2 = (float)$result['equal2'];

    $sql = sprintf("
        SELECT TRUNCATE(SUM(tkss.no4), 2) AS rf
        FROM tk_sales_sub tkss
        WHERE main_id = '%s'
            AND no3 = 'R.F'
            AND row_no != '0'
                        
            AND EXISTS(
                SELECT *
                FROM tk_sales_sub
                WHERE id != tkss.id
                    AND no1 = tkss.no1
                    AND no2 = tkss.no2
                    AND main_id = tkss.main_id
                    AND row_no != '0'
                    AND no6 != ''
                    AND no7 != ''
            )",
        $_POST['dataGrid']['mainID']
    );

    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    $rf = (float)$result['rf'];
    $grand_total_gp = (($equal - $equal2) + $rf);


    # Deposit grand total:
    $sql = sprintf(
        "SELECT SUM(amount) total
        FROM tk_sales_deposit
        WHERE main_id = '%s'
            AND row_no != '0'",
        $_POST['dataGrid']['mainID']
    );

    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    $grand_total_deposit = (float)$result['total'];

    # Expenses grand total:
    $sql = sprintf(
        "SELECT TRUNCATE(SUM(amount), 2) as total
            FROM tk_sales_expenses
        WHERE main_id = '%s'
            AND row_no != '0'",
        $_POST['dataGrid']['mainID']
    );

    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    $grand_total_expenses = (float)$result['total'];


    $dataGrid = $_POST['dataGrid'];
    $sqlSelect = sprintf(
        "SELECT *,
           cast(replace(tk, ',', '') AS DECIMAL(20, 2)) tkk,
           cast(replace(hs, ',', '') AS DECIMAL(20, 2)) hss,
           cast(replace(current_tk, ',', '') AS DECIMAL(20, 2)) current_tkk,
           cast(replace(current_hs, ',', '') AS DECIMAL(20, 2)) current_hss
        FROM tk_sales_bank
        WHERE main_id = '%s'
        ORDER BY row_no ASC",
        $dataGrid['mainID']
    );

    $resultSelect = $conn->query($sqlSelect);
    $rowSelect = $resultSelect->fetch_assoc();

    $tk = (float)$rowSelect['tkk'];
    $hs = (float)$rowSelect['hss'];

    $current_tk = (float)$rowSelect['current_tkk'];
    $current_hs = (float)$rowSelect['current_hss'];
    $total_bank = $tk + $hs;


    $sql = sprintf("
        SELECT sum(no4) as total
        FROM tk_sales_sub
        WHERE main_id = '%s'", $dataGrid['mainID']
    );
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $grand_total_revenue = (float)$data['total'];

    $sql = sprintf("
        SELECT (
            (
                SELECT CAST(SUM(no7) AS DECIMAL(12, 2)) `before`
                FROM tk_sales_sub
                WHERE main_id = '%s'
                AND row_no != '0'
            ) -
            (
                SELECT CAST(COALESCE(sum(no7), 0) AS DECIMAL(12, 2)) `after`
                FROM tk_sales_sub
                WHERE main_id = '%s'
                AND row_no != '0'
                AND no11 LIKE '%%rtc%%'
            )
           ) AS tutor_paid",
        $dataGrid['mainID'], $dataGrid['mainID']
    );

    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $grand_total_ttp = (float)$data['tutor_paid'];

    $sql = sprintf("
        SELECT CAST(COALESCE(SUM(no7), 0) AS DECIMAL(12, 2)) AS refund
        FROM tk_sales_sub
        WHERE main_id = '%s'
        AND row_no != '0'
        AND no11 LIKE '%%rtc%%'", $dataGrid['mainID']
    );

    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $grand_total_refund = (float)$data['refund'];

    $sql = sprintf("
        SELECT sum(no4) non_current_year_revenue
        FROM tk_sales_sub
        WHERE main_id = '%s'
        AND cf IS NOT NULL
        AND SUBSTR(no1, -2) <> (SELECT substr(`year`, -2) FROM tk_sales_main WHERE  id = '%s')",
        $dataGrid['mainID'], $dataGrid['mainID']
    );

    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $revenue_non_current_year = (float)$data['non_current_year_revenue'];

    $latest_balance = $total_bank + $grand_total_revenue + $grand_total_deposit - $grand_total_expenses - $grand_total_ttp - $grand_total_refund - $revenue_non_current_year;

    if ($resultSelect->num_rows > 0) {

        ?>

        <br/>
        <table class="tbl-qa">
            <tbody id="table-bodyBank" style="font-size:14px;">

            <tr class="table-row">
                <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center;"> TK</td>

                <td id="tk-data" class="row-data data-edit" style="font-size:14px;width:80px;text-align: right;" contenteditable="true">
                    <?php echo ($rowSelect['tk'] == 'kosong') ? '' : number_format((float)str_replace(',', '', $rowSelect['tk']), 2, '.', ','); ?>
                </td>

                <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center;"> HS</td>

                <td id="hs-data" class="row-data data-edit" style="font-size:14px;width:80px;text-align: right;" contenteditable="true">
                    <?php echo ($rowSelect['hs'] == 'kosong') ? '' : number_format((float)str_replace(',', '', $rowSelect['hs']), 2, '.', ','); ?>
                </td>

                <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center;"> Date</td>

                <td id="date-data" class="row-data data-edit" style="font-size:14px;width:200px;text-align: right;" contenteditable="true">
                    <?php echo $rowSelect["date"]; ?>
                </td>

            </tr>

            <tr class="table-row">
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
            </tr>

            <tr class="table-row">
                <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center;"> Total Bank</td>
                <td id="" class="row-data" style="font-size:14px;width:80px;text-align: right;"> <?php echo number_format((float)str_replace(',', '', $total_bank), 2, '.', ','); ?></td>
                <td id="" class="row-data" style="font-size:14px;width:200px;text-align: center"> NCYR</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;text-align:right"><?php echo number_format((float)str_replace(',', '', $revenue_non_current_year), 2, '.', ','); ?></td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
            </tr>

            <tr class="table-row">
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
            </tr>

            <tr class="table-row">
                <td id="" class="row-data" style="font-size:14px;width:150px;text-align: center"> Latest Balance</td>
                <td id="latest-balance-data" class="row-data data-edit" style="font-size:14px;width:80px;text-align: right;" contenteditable="true"><?php echo number_format((float)str_replace(',', '', $latest_balance), 2, '.', ','); ?></td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
            </tr>

            <tr class="table-row">
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:200px;"> &nbsp;</td>
            </tr>

            <tr class="table-row">
                <td class="row-data" style="font-size:14px;width:200px;text-align: center">Current TK</td>
                <td id="current-tk-data" class="row-data" style="font-size:14px;width:200px;text-align:right"><?php echo number_format((float)str_replace(',', '', $current_tk), 2, '.', ','); ?></td>
                <td class="row-data" style="font-size:14px;width:150px;text-align: center;">Current HS</td>
                <td id="current-hs-data" class="row-data data-edit" style="font-size:14px;width:80px;text-align: right;" contenteditable="true"><?php echo number_format((float)str_replace(',', '', $current_hs), 2, '.', ','); ?></td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
                <td id="" class="row-data" style="font-size:14px;width:150px;"> &nbsp;</td>
            </tr>

            <input type="hidden" id="data-id" value="<?php echo $rowSelect["id"]; ?>">

            </tbody>
        </table>


        <?php
    } else {
        ?>

        <table class="tbl-qa">
            <tbody id="table-bodyBank" style="font-size:14px;">
            <tr class="table-row">
            </tr>
            </tbody>
        </table>

        <?php
    }
    ?>

    <br>
    <button class="btn btn-info-ori" id="confirm-bank-data">Confirm</button>
    <img id="ajax-spinner" class="invisible" src="../icon/spinner.gif" alt="Loading..." width="60" height="60">

    <?php
}
$conn->close();
?>