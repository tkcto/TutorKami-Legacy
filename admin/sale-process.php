<?phprequire_once('classes/config.php.inc');$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);if ($conn->connect_error) {    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);    exit();}session_start();date_default_timezone_set("Asia/Kuala_Lumpur");if (isset($_POST['dataFile'])) {    $dataFile = $_POST['dataFile'];    $sql = " SELECT name, year FROM tk_sales_main WHERE name = '" . ucwords($dataFile['FileInput']) .        "' AND year = '" . $dataFile['YearInput'] . "' ";    $result = $conn->query($sql);    if ($result->num_rows > 0) {        echo 'File already exist';    } else {        $sqlInsert = "INSERT INTO tk_sales_main (name, year) VALUES ('" . ucwords(trim($dataFile['FileInput'])) .            "', '" . trim($dataFile['YearInput']) . "')";        if (($conn->query($sqlInsert) === TRUE)) {            $last_id = $conn->insert_id;            # GP grand total:            $sql = sprintf("                SELECT                     TRUNCATE(SUM(no4), 2) as equal,                    TRUNCATE(SUM(no7), 2) as equal2                FROM tk_sales_sub                WHERE main_id = '%s'                    AND no7 != ''                    AND row_no != '0' ",                $last_id            );            $query = $conn->query($sql);            $result = $query->fetch_assoc();            $equal = (float)$result['equal'];            $equal2 = (float)$result['equal2'];            $sql = sprintf("                SELECT TRUNCATE(SUM(tkss.no4), 2) AS rf                FROM tk_sales_sub tkss                WHERE main_id = '%s'                    AND no3 = 'R.F'                    AND row_no != '0'                                                    AND EXISTS(                        SELECT *                        FROM tk_sales_sub                        WHERE id != tkss.id                            AND no1 = tkss.no1                            AND no2 = tkss.no2                            AND main_id = tkss.main_id                            AND row_no != '0'                            AND no6 != ''                            AND no7 != ''                    )",                $last_id            );            $query = $conn->query($sql);            $result = $query->fetch_assoc();            $rf = (float)$result['rf'];            $grand_total_gp = (($equal - $equal2) + $rf);            # Deposit grand total:            $sql = sprintf(                "SELECT SUM(amount) total                FROM tk_sales_deposit                WHERE main_id = '%s'                AND row_no != '0'",                $last_id            );            $query = $conn->query($sql);            $result = $query->fetch_assoc();            $grand_total_deposit = (float)$result['total'];            # Expenses grand total:            $sql = sprintf(                "SELECT TRUNCATE(SUM(amount), 2) as total                FROM tk_sales_expenses                WHERE main_id = '%s'                AND row_no != '0'",                $last_id            );            $query = $conn->query($sql);            $result = $query->fetch_assoc();            $grand_total_expenses = (float)$result['total'];            $sqlSelect = sprintf(                "SELECT *,                   cast(replace(tk, ',', '') AS DECIMAL(20, 2)) tkk,                   cast(replace(hs, ',', '') AS DECIMAL(20, 2)) hss,                   cast(replace(current_tk, ',', '') AS DECIMAL(20, 2)) current_tkk,                   cast(replace(current_hs, ',', '') AS DECIMAL(20, 2)) current_hss                FROM tk_sales_bank                WHERE main_id = '%s'                ORDER BY row_no ASC",                $last_id            );            $resultSelect = $conn->query($sqlSelect);            $rowSelect = $resultSelect->fetch_assoc();            $tk = (float)$rowSelect['tkk'];            $hs = (float)$rowSelect['hss'];            $current_tk = (float)$rowSelect['current_tkk'];            $current_hs = (float)$rowSelect['current_hss'];            $total_bank = $tk + $hs;            $sql = sprintf("                SELECT sum(no4) as total                FROM tk_sales_sub                WHERE main_id = '%s'", $last_id            );            $result = $conn->query($sql);            $data = $result->fetch_assoc();            $grand_total_revenue = (float)$data['total'];            $sql = sprintf("                SELECT (                    (                        SELECT CAST(SUM(no7) AS DECIMAL(12, 2)) `before`                        FROM tk_sales_sub                        WHERE main_id = '%s'                        AND row_no != '0'                    ) -                    (                        SELECT CAST(COALESCE(sum(no7), 0) AS DECIMAL(12, 2)) `after`                        FROM tk_sales_sub                        WHERE main_id = '%s'                        AND row_no != '0'                        AND no11 LIKE '%%rtc%%'                    )                   ) AS tutor_paid",                $last_id, $last_id            );            $result = $conn->query($sql);            $data = $result->fetch_assoc();            $grand_total_ttp = (float)$data['tutor_paid'];            $sql = sprintf("                SELECT CAST(COALESCE(SUM(no7), 0) AS DECIMAL(12, 2)) AS refund                FROM tk_sales_sub                WHERE main_id = '%s'                AND row_no != '0'                AND no11 LIKE '%%rtc%%'", $last_id            );            $result = $conn->query($sql);            $data = $result->fetch_assoc();            $grand_total_refund = (float)$data['refund'];            $sql = sprintf("                SELECT sum(no4) non_current_year_revenue                FROM tk_sales_sub                WHERE main_id = '%s'                AND cf IS NOT NULL                AND SUBSTR(no1, -2) <> (SELECT substr(`year`, -2) FROM tk_sales_main WHERE  id = '%s')",                $last_id, $last_id            );            $result = $conn->query($sql);            $data = $result->fetch_assoc();            $revenue_non_current_year = (float)$data['non_current_year_revenue'];            $latest_balance = $total_bank + $grand_total_revenue + $grand_total_deposit - $grand_total_expenses - $grand_total_ttp - $grand_total_refund - $revenue_non_current_year;            $row_no = 1;            $date = date('d/m/Y', time());            $sql = sprintf("               INSERT INTO tk_sales_bank (main_id, month, tk, hs, date, total_bank, latest_balance, row_no)                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",                $last_id, 'Jan', $tk, $hs, $date, $total_bank, $latest_balance, $row_no            );            $conn->query($sql);            echo $last_id;        } else {            echo "Error: " . $sqlInsert . "<br>" . $conn->error;        }    }}if (isset($_POST['getSaleFile'])) {    $getSaleFile = $_POST['getSaleFile'];    $sql = " SELECT id, name, year FROM tk_sales_main WHERE id = '" . $getSaleFile['id'] . "' ";    $result = $conn->query($sql);    if ($result->num_rows > 0) {        $row = $result->fetch_assoc();        echo $row['name'] . ' ' . $row['year'] . ' thisID ' . $row['id'];    } else {        echo 'File empty';    }}if (isset($_POST['getYear'])) {    $getYear = $_POST['getYear'];    $sql = " SELECT id, name, year FROM tk_sales_main WHERE year = '" . $getYear['year'] . "' ";    $result = $conn->query($sql);    if ($result->num_rows > 0) {        $row = $result->fetch_assoc();        echo $row['name'] . ' ' . $row['year'] . ' thisID ' . $row['id'];    } else {        echo 'Year empty';    }}if (isset($_POST['dataTabs'])) {    $dataTabs = $_POST['dataTabs'];    $sql = " SELECT main_id, tab_name FROM tk_sales_sub WHERE main_id = '" . $dataTabs['mainID'] .        "' AND tab_name = '" . ucwords($dataTabs['Tabname']) . "' ";    $result = $conn->query($sql);    if ($result->num_rows > 0) {        echo 'Existing Tab';    } else {        $sqlInsert = "INSERT INTO tk_sales_sub (main_id, tab_name, row_no) VALUES ('" . trim($dataTabs['mainID']) .            "', '" . ucwords(trim($dataTabs['Tabname'])) . "', '0')";        if (($conn->query($sqlInsert) === TRUE)) {            echo "Success";        } else {            echo "Error: " . $sqlInsert . "<br>" . $conn->error;        }    }}# Note: CF 1/ CF 2 = Table ada CF/Takda CF (tak termasuk last row)if (isset($_POST['carryForward'])) {    $carryForward = $_POST['carryForward'];    $sql = " SELECT * FROM tk_sales_sub WHERE id = '" . $carryForward['id'] . "' ";    $result = $conn->query($sql);    if ($result->num_rows > 0) {        $row = $result->fetch_assoc();        $array = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');        $current_array_val = array_search($row['month'], $array);        $nextMonth = $array[$current_array_val + 1];        if ($nextMonth == '') {            $getYear = '';            $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '" . $row['main_id'] . "' ";            $resultMain = $conn->query($sqlMain);            if ($resultMain->num_rows > 0) {                $rowMain = $resultMain->fetch_assoc();                $getYear = ($rowMain['year'] + 1);            }            if ($getYear != '') {                $sqlCurrMain = " SELECT * FROM tk_sales_main WHERE year = '" . $getYear . "' ";                $resultCurrMain = $conn->query($sqlCurrMain);                if ($resultCurrMain->num_rows > 0) {                    $rowCurrMain = $resultCurrMain->fetch_assoc();                    if ($carryForward['RF'] == 'Yes') {                        $sqlRF = " SELECT id, main_id, tab_name, month, no2, row_no FROM tk_sales_sub WHERE id != '" .                            $row['id'] . "' AND main_id = '" . $row['main_id'] . "' AND tab_name = '" . $row['tab_name'] .                            "' AND month = '" . $row['month'] . "' AND no2 = '" . $row['no2'] . "' AND row_no = '" .                            ($row['row_no'] + 1) . "' ";                        $resultRF = $conn->query($sqlRF);                        if ($resultRF->num_rows > 0) {                            $rowRF = $resultRF->fetch_assoc();                            $rfID = $rowRF['id'];                        } else {                            $rfID = "Error";                        }                        if ($rfID != 'Error') {                            $i = 1;                            $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '" .                                $row['id'] . "' AND id != '" . $rfID . "' AND main_id = '" . $row["main_id"] .                                "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" . $row["month"] .                                "' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";                            $resultOldNo = $conn->query($OldNo);                            if ($resultOldNo->num_rows > 0) {                                while ($rowOldNo = $resultOldNo->fetch_assoc()) {                                    $updateNo = "UPDATE tk_sales_sub SET row_no = '" . $i . "' WHERE id = '" . $rowOldNo["id"] . "' ";                                    $conn->query($updateNo);                                    $i++;                                }                            } else {                                $i = 2;                            }                            if ($i >= 2) {                                $update = " UPDATE tk_sales_sub SET main_id = '" . $rowCurrMain['id'] .                                    "', month = 'Jan', row_no = '999999', cf = '1000' WHERE id = '" . $row['id'] . "' ";                                $conn->query($update);                                $update2 = " UPDATE tk_sales_sub SET main_id = '" . $rowCurrMain['id'] .                                    "', month = 'Jan', row_no = '999999', cf = '1001' WHERE id = '" . $rfID . "' ";                                $conn->query($update2);                                $output = '';                                $iCF = 1;                                $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '" .                                    $rowCurrMain["id"] . "' AND tab_name = '" . $row["tab_name"] .                                    "' AND month = 'Jan' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";                                $resultOldNo = $conn->query($OldNo);                                if ($resultOldNo->num_rows > 0) {                                    while ($rowOldNo = $resultOldNo->fetch_assoc()) {                                        $updateNo = "UPDATE tk_sales_sub SET cf = '" . $iCF . "' WHERE id = '" . $rowOldNo["id"] . "' ";                                        $conn->query($updateNo);                                        $iCF++;                                    }                                    $output = 'yes';                                }                                if ($output == 'yes') {                                    echo "Success";                                } else {                                    echo "Error";                                }                            }                        } else {                            echo "Error";                        }                    } else {                        $i = 1;                        $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '" . $row['id'] .                            "' AND main_id = '" . $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" .                            $row["month"] . "' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";                        $resultOldNo = $conn->query($OldNo);                        if ($resultOldNo->num_rows > 0) {                            while ($rowOldNo = $resultOldNo->fetch_assoc()) {                                $updateNo = "UPDATE tk_sales_sub SET row_no = '" . $i . "' WHERE id = '" . $rowOldNo["id"] . "' ";                                $conn->query($updateNo);                                $i++;                            }                        } else {                            $i = 2;                        }                        if ($i >= 2) {                            $update = " UPDATE tk_sales_sub SET main_id = '" . $rowCurrMain['id'] .                                "', month = 'Jan', row_no = '999999', cf = '1000' WHERE id = '" . $row['id'] . "' ";                            $conn->query($update);                            $output = '';                            $iCF = 1;                            $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '" .                                $rowCurrMain["id"] . "' AND tab_name = '" . $row["tab_name"] .                                "' AND month = 'Jan' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";                            $resultOldNo = $conn->query($OldNo);                            if ($resultOldNo->num_rows > 0) {                                while ($rowOldNo = $resultOldNo->fetch_assoc()) {                                    $updateNo = "UPDATE tk_sales_sub SET cf = '" . $iCF . "' WHERE id = '" . $rowOldNo["id"] . "' ";                                    $conn->query($updateNo);                                    $iCF++;                                }                                $output = 'yes';                            }                            if ($output == 'yes') {                                echo "Success";                            } else {                                echo "Error";                            }                        }                    }                } else {                    echo "Error";                }            } else {                echo "Error";            }        } else {            if ($carryForward['RF'] == 'Yes') {                $sqlRF = " SELECT id, main_id, tab_name, month, no2, row_no FROM tk_sales_sub WHERE id != '" . $row['id'] .                    "' AND main_id = '" . $row['main_id'] . "' AND tab_name = '" . $row['tab_name'] . "' AND month = '" .                    $row['month'] . "' AND no2 = '" . $row['no2'] . "' AND row_no = '" . ($row['row_no'] + 1) . "' ";                $resultRF = $conn->query($sqlRF);                if ($resultRF->num_rows > 0) {                    $rowRF = $resultRF->fetch_assoc();                    $rfID = $rowRF['id'];                } else {                    $rfID = "Error";                }                if ($rfID != 'Error') {                    $i = 1;                    $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '" . $row['id'] .                        "' AND id != '" . $rfID . "' AND main_id = '" . $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] .                        "' AND month = '" . $row["month"] . "' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC";                    $resultOldNo = $conn->query($OldNo);                    if ($resultOldNo->num_rows > 0) {                        while ($rowOldNo = $resultOldNo->fetch_assoc()) {                            $updateNo = "UPDATE tk_sales_sub SET row_no = '" . $i . "' WHERE id = '" . $rowOldNo["id"] . "' ";                            $conn->query($updateNo);                            $i++;                        }                    } else {                        $i = 2;                    }                    if ($i >= 2) {                        $update = " UPDATE tk_sales_sub SET month = '" . $nextMonth .                            "', row_no = '999999', cf = '1000' WHERE id = '" . $row['id'] . "' ";                        $conn->query($update);                        $update2 = " UPDATE tk_sales_sub SET month = '" . $nextMonth .                            "', row_no = '999999', cf = '1001' WHERE id = '" . $rfID . "' ";                        $conn->query($update2);                        $output = '';                        $iCF = 1;                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '" .                            $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" . $nextMonth .                            "' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";                        $resultOldNo = $conn->query($OldNo);                        if ($resultOldNo->num_rows > 0) {                            while ($rowOldNo = $resultOldNo->fetch_assoc()) {                                $updateNo = "UPDATE tk_sales_sub SET cf = '" . $iCF . "' WHERE id = '" . $rowOldNo["id"] . "' ";                                $conn->query($updateNo);                                $iCF++;                            }                            $output = 'yes';                        }                        if ($output == 'yes') {                            echo "Success";                        } else {                            echo "Error";                        }                    }                } else {                    echo "Error....";                }            } else {                $i = 1;                $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '" . $row['id'] .                    "' AND main_id = '" . $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" .                    $row["month"] . "' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";                $resultOldNo = $conn->query($OldNo);                if ($resultOldNo->num_rows > 0) {                    while ($rowOldNo = $resultOldNo->fetch_assoc()) {                        $updateNo = "UPDATE tk_sales_sub SET row_no = '" . $i . "' WHERE id = '" . $rowOldNo["id"] . "' ";                        $conn->query($updateNo);                        $i++;                    }                } else {                    $i = 2;                }                if ($i >= 2) {                    $update = "UPDATE tk_sales_sub SET month = '" . $nextMonth .                        "', row_no = '999999', cf = '1000' WHERE id = '" . $row['id'] . "' ";                    $conn->query($update);                    $output = '';                    $iCF = 1;                    $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '" .                        $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" . $nextMonth .                        "' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";                    $resultOldNo = $conn->query($OldNo);                    if ($resultOldNo->num_rows > 0) {                        while ($rowOldNo = $resultOldNo->fetch_assoc()) {                            $updateNo = "UPDATE tk_sales_sub SET cf = '" . $iCF . "' WHERE id = '" . $rowOldNo["id"] . "' ";                            $conn->query($updateNo);                            $iCF++;                        }                        $output = 'yes';                    }                    if ($output == 'yes') {                        echo "Success";                    } else {                        echo "Error";                    }                }            }        }    } else {        echo 'empty ID';    }}# Recarry existing carried rowif (isset($_POST['carryForward2'])) {    $carryForward = $_POST['carryForward2'];    $sql = "SELECT * FROM tk_sales_sub WHERE id = '" . $carryForward['id'] . "' ";    $result = $conn->query($sql);    if ($result->num_rows > 0) {        $row = $result->fetch_assoc();        $array = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');        $current_array_val = array_search($row['month'], $array);        $nextMonth = $array[$current_array_val + 1];        if ($nextMonth == '') {            $getYear = '';            $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '" . $row['main_id'] . "' ";            $resultMain = $conn->query($sqlMain);            if ($resultMain->num_rows > 0) {                $rowMain = $resultMain->fetch_assoc();                $getYear = $rowMain['year'] + 1;            }            $sqlCurrMain = " SELECT * FROM tk_sales_main WHERE year = '" . $getYear . "' ";            $resultCurrMain = $conn->query($sqlCurrMain);            if ($resultCurrMain->num_rows > 0) {                $rowCurrMain = $resultCurrMain->fetch_assoc();                if ($carryForward['RF'] == 'Yes') {                    $sqlRF = " SELECT id, main_id, tab_name, month, no2, row_no FROM tk_sales_sub WHERE id != '" .                        $row['id'] . "' AND main_id = '" . $row['main_id'] . "' AND tab_name = '" . $row['tab_name'] .                        "' AND month = '" . $row['month'] . "' AND no2 = '" . $row['no2'] . "' AND row_no = '" .                        ($row['row_no'] + 1) . "' ";                    $resultRF = $conn->query($sqlRF);                    if ($resultRF->num_rows > 0) {                        $rowRF = $resultRF->fetch_assoc();                        $rfID = $rowRF['id'];                    } else {                        $rfID = "Error";                    }                    if ($rfID != 'Error') {                        $i = 1;                        $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '" .                            $row['id'] . "' AND id != '" . $rfID . "' AND main_id = '" . $row["main_id"] .                            "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" . $row["month"] .                            "' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";                        $resultOldNo = $conn->query($OldNo);                        if ($resultOldNo->num_rows > 0) {                            while ($rowOldNo = $resultOldNo->fetch_assoc()) {                                $updateNo = "UPDATE tk_sales_sub SET row_no = '" . $i . "' WHERE id = '" . $rowOldNo["id"] . "' ";                                $conn->query($updateNo);                                $i++;                            }                        } else {                            $i = 2;                        }                        if ($i >= 2) {                            $update = " UPDATE tk_sales_sub SET main_id = '" . $rowCurrMain['id'] .                                "', month = 'Jan', row_no = '999999', cf = '1000' WHERE id = '" . $row['id'] . "' ";                            $conn->query($update);                            $update2 = " UPDATE tk_sales_sub SET main_id = '" . $rowCurrMain['id'] .                                "', month = 'Jan', row_no = '999999', cf = '1001' WHERE id = '" . $rfID . "' ";                            $conn->query($update2);                            $output = '';                            $iCF = 1;                            $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '" .                                $rowCurrMain["id"] . "' AND tab_name = '" . $row["tab_name"] .                                "' AND month = 'Jan' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";                            $resultOldNo = $conn->query($OldNo);                            if ($resultOldNo->num_rows > 0) {                                while ($rowOldNo = $resultOldNo->fetch_assoc()) {                                    $updateNo = "UPDATE tk_sales_sub SET cf = '" . $iCF . "' WHERE id = '" . $rowOldNo["id"] . "' ";                                    $conn->query($updateNo);                                    $iCF++;                                }                                $output = 'yes';                            }                            if ($output == 'yes') {                                echo "Success";                            } else {                                echo "Error";                            }                        }                    } else {                        echo "Error";                    }                } else {                    $i = 1;                    $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '" . $row['id'] .                        "' AND main_id = '" . $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" .                        $row["month"] . "' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";                    $resultOldNo = $conn->query($OldNo);                    if ($resultOldNo->num_rows > 0) {                        while ($rowOldNo = $resultOldNo->fetch_assoc()) {                            $updateNo = "UPDATE tk_sales_sub SET row_no = '" . $i . "' WHERE id = '" . $rowOldNo["id"] . "' ";                            $conn->query($updateNo);                            $i++;                        }                    } else {                        $i = 2;                    }                    if ($i >= 2) {                        $update = " UPDATE tk_sales_sub SET main_id = '" . $rowCurrMain['id'] .                            "', month = 'Jan', row_no = '999999', cf = '1000' WHERE id = '" . $row['id'] . "' ";                        $conn->query($update);                        $output = '';                        $iCF = 1;                        $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '" .                            $rowCurrMain["id"] . "' AND tab_name = '" . $row["tab_name"] .                            "' AND month = 'Jan' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";                        $resultOldNo = $conn->query($OldNo);                        if ($resultOldNo->num_rows > 0) {                            while ($rowOldNo = $resultOldNo->fetch_assoc()) {                                $updateNo = "UPDATE tk_sales_sub SET cf = '" . $iCF . "' WHERE id = '" . $rowOldNo["id"] . "' ";                                $conn->query($updateNo);                                $iCF++;                            }                            $output = 'yes';                        }                        if ($output == 'yes') {                            echo "Success";                        } else {                            echo "Error";                        }                    }                }            } else {                printf('Error: No Sales File for: %s', $getYear);            }        } else {            $sqlRF = "SELECT id, main_id, tab_name, month, no2, no3, row_no FROM tk_sales_sub WHERE id != '" .                $row['id'] . "' AND main_id = '" . $row['main_id'] . "' AND tab_name = '" . $row['tab_name'] .                "' AND month = '" . $row['month'] . "' AND no2 = '" . $row['no2'] . "' AND no3 = 'R.F' AND row_no = '999999' ";            $resultRF = $conn->query($sqlRF);            /**             * If registration fee row is there             */            if ($resultRF->num_rows > 0) {                $rowRF = $resultRF->fetch_assoc();                /**                 * Since we carry this row and its registration fee to next month, we need to update cf ordering for current month - START                 */                $i = 1;                $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '" .                    $row['id'] . "' AND id != '" . $rowRF['id'] . "' AND main_id = '" . $row["main_id"] .                    "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" . $row["month"] .                    "' AND row_no = '999999' ORDER BY cf ASC   ";                $resultOldNo = $conn->query($OldNo);                if ($resultOldNo->num_rows > 0) {                    while ($rowOldNo = $resultOldNo->fetch_assoc()) {                        $updateNo = "UPDATE tk_sales_sub SET cf = '" . $i . "' WHERE id = '" . $rowOldNo["id"] . "' ";                        $conn->query($updateNo);                        $i++;                    }                }                /**                 * Since we carry this row and its registration fee to next month, we need to update cf ordering for current month - END                 */                /**                 * Carry this row and its registration fee to next month - START                 */                $update = "UPDATE tk_sales_sub SET month = '" . $nextMonth .                    "', row_no = '999999', cf = '1000' WHERE id = '" . $row['id'] . "' ";                $conn->query($update);                $update2 = " UPDATE tk_sales_sub SET month = '" . $nextMonth .                    "', row_no = '999999', cf = '1001' WHERE id = '" . $rowRF['id'] . "' ";                $conn->query($update2);                /**                 * Carry this row and its registration fee to next month - END                 */                /**                 * Since we carry this row and its registration fee to next month, we need to update next month cf ordering - START                 */                $output = '';                $iCF = 1;                $OldNo = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '" .                    $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" . $nextMonth .                    "' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";                $resultOldNo = $conn->query($OldNo);                if ($resultOldNo->num_rows > 0) {                    while ($rowOldNo = $resultOldNo->fetch_assoc()) {                        $updateNo = "UPDATE tk_sales_sub SET cf = '" . $iCF . "' WHERE id = '" . $rowOldNo["id"] . "' ";                        $conn->query($updateNo);                        $iCF++;                    }                    $output = 'yes';                }                /**                 * Since we carry this row and its registration fee to next month, we need to update next month cf ordering - START                 */                if ($output == 'yes') {                    echo "Success";                } else {                    echo "Error";                }            } else {                /**                 * Since we carry this row to next month, we need to update current month cf ordering - START                 */                $i = 1;                $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE id != '" .                    $row['id'] . "' AND main_id = '" . $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] .                    "' AND month = '" . $row["month"] . "' AND row_no = '999999' ORDER BY cf ASC   ";                $resultOldNo = $conn->query($OldNo);                if ($resultOldNo->num_rows > 0) {                    while ($rowOldNo = $resultOldNo->fetch_assoc()) {                        $updateNo = "UPDATE tk_sales_sub SET cf = '" . $i . "' WHERE id = '" . $rowOldNo["id"] . "' ";                        $conn->query($updateNo);                        $i++;                    }                }                /**                 * Since we carry this row to next month, we need to update current month cf ordering - END                 */                /**                 * Carry this row to next month                 */                $update = " UPDATE tk_sales_sub SET month = '" . $nextMonth .                    "', row_no = '999999', cf = '1000' WHERE id = '" . $row['id'] . "' ";                $conn->query($update);                /**                 * Since we carry this row to next month, we need to update next month cf ordering - START                 */                $output = '';                $iCF = 1;                $OldNoCF = " SELECT id, main_id, tab_name, month, row_no, no1, no2, cf FROM tk_sales_sub WHERE main_id = '" .                    $row["main_id"] . "' AND tab_name = '" . $row["tab_name"] . "' AND month = '" . $nextMonth .                    "' AND row_no = '999999' ORDER BY str_to_date(no1,'%d/%m/%Y') ASC, no2 ASC, cf ASC   ";                $resultOldNoCF = $conn->query($OldNoCF);                if ($resultOldNoCF->num_rows > 0) {                    while ($rowOldNoCF = $resultOldNoCF->fetch_assoc()) {                        $updateNo = "UPDATE tk_sales_sub SET cf = '" . $iCF . "' WHERE id = '" . $rowOldNoCF["id"] . "' ";                        $conn->query($updateNo);                        $iCF++;                    }                    $output = 'yes';                }                /**                 * Since we carry this row to next month, we need to update next month cf ordering - END                 */                if ($output == 'yes') {                    echo "Success";                } else {                    echo "Error";                }            }        }    } else {        echo 'Error: Empty ID';    }}if (isset($_POST['sentManual'])) {    $sentManual = $_POST['sentManual'];    $update = " UPDATE tk_whatsapp_noti SET wa_manual = 'Yes' WHERE wa_id = '" . $sentManual['id'] . "' ";    if (($conn->query($update) === TRUE)) {        echo "Success";    } else {        echo "Error";    }}if (isset($_POST['undo'])) {    $undo = $_POST['undo'];    $sql = " SELECT * FROM tk_sales_sub WHERE id = '" . $undo['id'] . "' ";    $result = $conn->query($sql);    if ($result->num_rows > 0) {        $row = $result->fetch_assoc();        $strArr = explode("-", $row["ss_undo"]);        if (count($strArr) == 2) {            $month = str_replace(' ', '', $strArr[0]);            $rowNo = str_replace(' ', '', $strArr[1]);            $sqlRF = " SELECT id, main_id, tab_name, month, no2, no3, row_no FROM tk_sales_sub WHERE id != '" . $row['id'] .                "' AND main_id = '" . $row['main_id'] . "' AND tab_name = '" . $row['tab_name'] . "' AND month = '" .                $row['month'] . "' AND no2 = '" . $row['no2'] . "' AND no3 = 'R.F' AND row_no = '999999' ";            $resultRF = $conn->query($sqlRF);            if ($resultRF->num_rows > 0) {                $rowRF = $resultRF->fetch_assoc();                if ($rowNo == '999999') {                } else {                }            } else {                if ($rowNo == '999999') {                } else {                }            }        } else {            echo 'Sorry cant undo';        }    }}$conn->close();?>