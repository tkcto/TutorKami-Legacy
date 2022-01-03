<style type="text/css">    #table-wrapper {        width: 100%;    }    #left-table {        float: left;        width: 25%;    }    #right-table {        float: left;        width: 60%;    }</style><?phpdate_default_timezone_set("Asia/Kuala_Lumpur");require_once('classes/config.php.inc');$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);if ($conn->connect_error) {    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);    exit();}if (isset($_POST['dataGrid'])) {    $dataGrid = $_POST['dataGrid'];    ?>    <div id="table-wrapper">    <table class="tbl-qa" id="left-table">        <thead>        <tr>            <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">                <center><span aria-label="Coordinator" data-balloon-pos="down">TKC</span></center>            </th>            <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">                <center>Revenue</center>            </th>        </tr>        </thead>        <tbody>        <?php        $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";        $resultSelect = $conn->query($sqlSelect);        if ($resultSelect->num_rows > 0) {            while ($rowSelect = $resultSelect->fetch_assoc()) {                ?>                <tr class="table-row" id="">                    <td class="row-data" style="font-size:14px;width:100px;" contenteditable="true"><?php echo $rowSelect['tab_name'] ?></td>                    <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">                        <?php                        $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            $rowSum = $resultSum->fetch_assoc();                            echo number_format((float)$rowSum['total'], 2);                        }                        ?>                    </td>                </tr>                <?php            }        }        ?>        </tbody>        <tfoot>        <tr style="border-top: 1px solid black;">            <td class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">Total</td>            <td class="table-header" style="font-size:14px;width:100px;text-align: right;">                <?php                $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";                $resultSelect = $conn->query($sqlSelect);                if ($resultSelect->num_rows > 0) {                    $totalFooter = 0;                    while ($rowSelect = $resultSelect->fetch_assoc()) {                        $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $totalFooter += number_format((float)$rowSum['total'], 2, '.', '');                            }                        }                    }                    echo number_format($totalFooter, 2);                }                ?>            </td>        </tr>        </tfoot>    </table>    <table class="tbl-qa" id="right-table">        <thead>        <tr>            <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">                <center><span aria-label="Total tutor paid" data-balloon-pos="down">TTP</span>                </center>            </th>            <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">                <center>                    <span aria-label="Total refund to clients" data-balloon-pos="down">Refund</span>                </center>            </th>            <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">                <center><span aria-label="Gross profit" data-balloon-pos="down">GP</span></center>            </th>            <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">                <center><span aria-label="Percentage of GP" data-balloon-pos="down">%</span>                </center>            </th>            <th class="table-header" style="font-size:14px;width:100px;border-right: 1px solid black;">                <center>New Jobs</center>            </th>        </tr>        </thead>        <tbody>        <?php        $thisTotalGP = '';        $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";        $resultSelect = $conn->query($sqlSelect);        if ($resultSelect->num_rows > 0) {            while ($rowSelect = $resultSelect->fetch_assoc()) {                ?>                <tr class="table-row" id="">                    <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">                        <?php                        $totalRefund = 0;                        $Before = 0;                        $After = 0;                        $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $Before = number_format((float)$rowSum['total'], 2, '.', '');                            }                        }                        $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no11 LIKE '%rtc%' ";                        $resultSumRefund = $conn->query($sqlSumRefund);                        if ($resultSumRefund->num_rows > 0) {                            while ($rowSumRefund = $resultSumRefund->fetch_assoc()) {                                $After = number_format((float)$rowSumRefund['total'], 2, '.', '');                            }                        }                        $totalRefund = $Before - $After;                        echo number_format((float)$totalRefund, 2);                        ?>                    </td>                    <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">                        <?php                        $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no11 LIKE '%rtc%' ";                        $resultSumRefund = $conn->query($sqlSumRefund);                        if ($resultSumRefund->num_rows > 0) {                            while ($rowSumRefund = $resultSumRefund->fetch_assoc()) {                                echo number_format((float)$rowSumRefund['total'], 2, '.', '');                            }                        }                        ?>                    </td>                    <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">                        <?php                        $equal = 0;                        $rf = 0;                        $equal2 = 0;                        $equal3 = 0;                        $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND no7 != '' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $equal = number_format((float)$rowSum['total'], 2, '.', '');                            }                        }                        $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND no3 = 'R.F' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $sqlSum2 = " SELECT * FROM tk_sales_sub WHERE id != '" . $rowSum['id'] . "' AND no1 = '" . $rowSum['no1'] . "' AND no2 = '" . $rowSum['no2'] . "' AND main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' ";                                $resultSum2 = $conn->query($sqlSum2);                                if ($resultSum2->num_rows > 0) {                                    $rowSum2 = $resultSum2->fetch_assoc();                                    if ($rowSum2['no6'] != '' && $rowSum2['no7'] != '') {                                        $rf += $rowSum['no4'];                                    }                                }                            }                        }                        $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND no7 != '' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $equal2 = number_format((float)$rowSum['total'], 2, '.', '');                            }                        }                        $equal3 = (($equal - $equal2) + $rf);                        echo number_format((float)$equal3, 2);                        $thisTotalGP = (float)$thisTotalGP + $equal3;                        ?>                    </td>                    <td class="row-data" style="font-size:14px;width:100px;text-align: right;" contenteditable="true">                        <?php                        $pr = 0;                        $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $pr = $rowSum['total'];                            }                        }                        $equal = 0;                        $rf = 0;                        $equal2 = 0;                        $equal3 = 0;                        $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND no7 != '' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $equal = number_format((float)$rowSum['total'], 2, '.', '');                            }                        }                        $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND no3 = 'R.F' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $sqlSum2 = " SELECT * FROM tk_sales_sub WHERE id != '" . $rowSum['id'] . "' AND no1 = '" . $rowSum['no1'] . "' AND no2 = '" . $rowSum['no2'] . "' AND main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' ";                                $resultSum2 = $conn->query($sqlSum2);                                if ($resultSum2->num_rows > 0) {                                    $rowSum2 = $resultSum2->fetch_assoc();                                    if ($rowSum2['no6'] != '' && $rowSum2['no7'] != '') {                                        $rf += $rowSum['no4'];                                    }                                }                            }                        }                        $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND no7 != '' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $equal2 = number_format((float)$rowSum['total'], 2, '.', '');                            }                        }                        $equal3 = (($equal - $equal2) + $rf);                        echo number_format((float)(($equal3 / $pr) * 100), 2) . '%';                        ?>                    </td>                    <td class="row-data" style="font-size:14px;width:100px;text-align: center;" contenteditable="true">                        <?php                        $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no11 LIKE '%NJ%' ";                        $resultSum = $conn->query($sqlSum);                        $row_cnt = $resultSum->num_rows;                        echo $row_cnt;                        ?>                    </td>                </tr>                <?php            }        }        ?>        </tbody>        <tfoot>        <tr style="border-top: 1px solid black;">            <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;">                <?php                $totalRefund = 0;                $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";                $resultSelect = $conn->query($sqlSelect);                if ($resultSelect->num_rows > 0) {                    while ($rowSelect = $resultSelect->fetch_assoc()) {                        $Before = 0;                        $After = 0;                        $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $Before = number_format((float)$rowSum['total'], 2, '.', '');                            }                        }                        $sqlSumRefund = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no11 LIKE '%rtc%' ";                        $resultSumRefund = $conn->query($sqlSumRefund);                        if ($resultSumRefund->num_rows > 0) {                            while ($rowSumRefund = $resultSumRefund->fetch_assoc()) {                                $After = number_format((float)$rowSumRefund['total'], 2, '.', '');                            }                        }                        $totalRefund += $Before - $After;                    }                }                echo number_format((float)$totalRefund, 2);                ?>            </td>            <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;">                <?php                $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";                $resultSelect = $conn->query($sqlSelect);                if ($resultSelect->num_rows > 0) {                    $totalFooter = 0;                    while ($rowSelect = $resultSelect->fetch_assoc()) {                        $sqlSum = " SELECT SUM(no7) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no11 LIKE '%rtc%' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $totalFooter += number_format((float)$rowSum['total'], 2, '.', '');                            }                        }                    }                    echo number_format($totalFooter, 2);                }                ?>            </td>            <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;">                <?php                echo number_format((float)$thisTotalGP, 2);                ?>            </td>            <td class="table-header" style="font-size:14px;width:100px;text-align: right;border-right: 1px solid black;">                <?php                $totalFooter = 0;                $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";                $resultSelect = $conn->query($sqlSelect);                if ($resultSelect->num_rows > 0) {                    $totalFooter = 0;                    while ($rowSelect = $resultSelect->fetch_assoc()) {                        $sqlSum = " SELECT SUM(no4) as total FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' ";                        $resultSum = $conn->query($sqlSum);                        if ($resultSum->num_rows > 0) {                            while ($rowSum = $resultSum->fetch_assoc()) {                                $totalFooter += $rowSum['total'];                            }                        }                    }                }                $thisTotalGP = (float)$thisTotalGP;                $totalFooter = (float)$totalFooter;                if( $totalFooter != 0 ) {                    echo number_format((float)(($thisTotalGP / $totalFooter) * 100), 2) . '%';                } else {                    echo number_format($thisTotalGP,2 ). '%';                }                ?>            </td>            <td class="table-header" style="font-size:14px;width:100px;text-align: center;border-right: 1px solid black;">                <?php                $sqlSelect = " SELECT main_id, tab_name, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY tab_name ORDER BY tab_name ASC    ";                $resultSelect = $conn->query($sqlSelect);                if ($resultSelect->num_rows > 0) {                    $equal = 0;                    while ($rowSelect = $resultSelect->fetch_assoc()) {                        $sqlSum = " SELECT * FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND tab_name = '" . $rowSelect['tab_name'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no11 LIKE '%NJ%' ";                        $resultSum = $conn->query($sqlSum);                        $row_cnt = $resultSum->num_rows;                        $equal += $row_cnt;                    }                    echo $equal;                }                ?>            </td>        </tr>        </tfoot>    </table>    <span style="margin-left: 40px;"><b>Total active clients :                                <?php                                $array = array();                                $totalClients = " SELECT main_id, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY no2  ";                                $resTotalClients = $conn->query($totalClients);                                if ($resTotalClients->num_rows > 0) {                                    while ($rowTotalClients = $resTotalClients->fetch_assoc()) {                                        $GetClients = " SELECT j_id, j_email FROM tk_job WHERE j_id = '" . $rowTotalClients['no2'] . "' ";                                        $resGetClients = $conn->query($GetClients);                                        if ($resGetClients->num_rows > 0) {                                            $rowGetClients = $resGetClients->fetch_assoc();                                            $array[] = $rowGetClients['j_email'];                                        }                                    }                                }                                if (!empty($array)) {                                    echo count(array_unique($array));                                }                                ?>                                </b><span>    <br/><br/>    <span style="margin-left: 40px;"><b>Total jobs :                                <?php                                $countTotalJob = '0';                                $totalJob = " SELECT main_id, month, row_no, no2, no3 FROM tk_sales_sub WHERE main_id = '" . $dataGrid['mainID'] . "' AND month = '" . $dataGrid['month'] . "' AND row_no != '0' AND no2 != '' AND no3 != 'R.F' GROUP BY no2  ";                                $resTotalJob = $conn->query($totalJob);                                $countTotalJob = $resTotalJob->num_rows;                                echo $countTotalJob;                                ?>                                </b><div>        </div>    <?php}$conn->close();?>