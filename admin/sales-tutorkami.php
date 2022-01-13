<?php
require_once('includes/head.php');
require_once('classes/app.class.php');
require_once('classes/user.class.php');

$instApp = new app();
$instUser = new user();

if ($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff') {
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    $title = 'Sales TutorKami | Tutorkami';
    require_once('includes/html_head.php');
    ?>

    <link rel="stylesheet" href="css/button-ori.css" rel="stylesheet">
    <link rel="stylesheet" href="plugin/lobibox/documentation.css"/>
    <link rel="stylesheet" href="plugin/lobibox/LobiBox.min.css"/>
    <script src="https://kit.fontawesome.com/13ee0d0c31.js" crossorigin="anonymous"></script>

</head>

<body style="background-color: white;">
    <div id="wrapper">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                </div>

                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="<?php echo APP_ROOT; ?>admin/manage_user.php" title="Home"><i class="fa fa-user-secret"></i> Home</a>
                    </li>
                    <li>
                        <a href="<?php echo APP_ROOT; ?>blog/wp-login.php" target="_blank" title="Blog Admin"><i class="fa fa-wordpress"></i> Blog Admin</a>
                    </li>
                    <li>
                        <a href="<?php echo APP_ROOT; ?>" target="_blank" title="Site"><i class="fa fa-home"></i>Visit Site</a>
                    </li>
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome <?= $_SESSION[DB_PREFIX]['u_first_name'] ?></span>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        $current_page = str_replace('php', '', $current_page);
        $getbreadcrumb = $instSys->GetBreadCrumb($current_page);
        $breadcrumb = $getbreadcrumb->fetch_array(MYSQLI_ASSOC);
        $page_name = (isset($_GET) && count($_GET) > 0) ? str_replace('Add', 'Edit', $breadcrumb['m_name']) : $breadcrumb['m_name'];
        ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo $page_name; ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo ($breadcrumb['parent_url'] != '') ? $breadcrumb['parent_url'] : '#'; ?>"><?php echo ($breadcrumb['parent_name'] != '') ? $breadcrumb['parent_name'] : 'Home'; ?></a>
                    </li>
                    <li class="active">
                        <strong><?php echo $page_name; ?></strong>
                    </li>
                </ol>
            </div>
        </div>

        <?php
        if ((isset($_SESSION[DB_PREFIX]['u_id'])) && ($_SESSION[DB_PREFIX]['u_id'] == '1' || $_SESSION[DB_PREFIX]['u_id'] == '8' || $_SESSION[DB_PREFIX]['u_id'] == '1579926' || $_SESSION[DB_PREFIX]['u_id'] == '1581081' || $_SESSION[DB_PREFIX]['u_id'] == '3')) {
            $block = 'No';
        } else {
            $block = 'Yes';
        }
        ?>

        <style>
            .scrollable-menu {
                height: auto;
                max-height: 200px;
                overflow-x: hidden;
            }

            .btn-black {
                color: #ffffff;
                background-color: #1B1B1C;
                border-color: #1B1B1C;
            }

            .btn-black:hover,
            .btn-black:focus,
            .btn-black:active,
            .btn-black.active,
            .open .dropdown-toggle.btn-black {
                color: #ffffff;
                background-color: #1B1B1C;
                border-color: #1B1B1C;
            }

            .btn-black:active,
            .btn-black.active,
            .open .dropdown-toggle.btn-black {
                background-image: none;
            }

            .btn-blue {
                color: #ffffff;
                background-color: #101073;
                border-color: #101073;
            }

            .btn-blue:hover,
            .btn-blue:focus,
            .btn-blue:active,
            .btn-blue.active,
            .open .dropdown-toggle.btn-blue {
                color: #ffffff;
                background-color: #101073;
                border-color: #101073;
            }

            .btn-blue:active,
            .btn-blue.active,
            .open .dropdown-toggle.btn-blue {
                background-image: none;
            }
        </style>

        <button id="buttonModal" type="button" class="hidden btn btn-rate btn-xs" style="margin-left:40px;" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModalRating"></button>
        <div class="modal fade" id="myModalRating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="FileInput">File Name </label>
                                <input type="text" class="form-control" id="FileInput" aria-describedby="FileHelp" placeholder="eg : Sales TutorKami">
                            </div>
                            <div class="form-group">
                                <label for="YearInput">Year</label>
                                <input type="text" class="form-control" id="YearInput" aria-describedby="YearHelp" placeholder="eg : 2020" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalFile">Close</button>
                        <button onclick="submitFileName()" type="button" class="btn btn-rate">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <button type="button" class="btn btn-info-ori" onclick="openLog();">
                            <i class="glyphicon glyphicon-folder-open"></i></button>

                        <input type="hidden" id="block" value="<?PHP echo $block; ?>">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info-ori dropdown-toggle" data-toggle="dropdown">
                                <span id="showFile"></span> <span class="caret"></span></button>
                            <ul class="dropdown-menu scrollable-menu" role="menu" style="width:250px;">
                                <li><a onClick="AddFile();">
                                        <i class="glyphicon glyphicon-plus-sign"></i> Create Sales File</a>
                                </li>
                                <li class="divider"></li>
                                <span id="loadFile"></span>
                            </ul>
                        </div>
                        <a target="_blank" href="https://docs.google.com/document/d/1J9BBoPGoGgRFmdaJNZn_sCnGn7-XKJFC52140dVC5cM/edit" type="button" class="btn">
                            <i style="color:#f1592a;font-size:23px;" class="glyphicon glyphicon-question-sign"></i>
                        </a>

                        <input type="hidden" id="ExportExcel">

                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-info-ori dropdown-toggle" data-toggle="dropdown">Menu
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu scrollable-menu" role="menu" style="width:150px;">
                                <li><a onClick="ExportExcel();"> Export to Excel</a></li>
                                <li><a onClick="openNewJobs()"> New Jobs</a></li>
                            </ul>
                        </div>

                        <br/><br/><br/>

                        <span id="loadFileTabs"></span>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery.appendgrid@2/dist/AppendGrid.js"></script>

    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>


    <script src="plugin/lobibox/lobibox.min.js"></script>

    <script>
        function openNewJobs() {
            let id = document.getElementById("ExportExcel").value;
            window.open('https://www.tutorkami.com/admin/new-jobs?year=' + id, '_blank');
        }

        function ExportExcel() {
            let id = document.getElementById("ExportExcel").value;

            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'ExportExcel', id: id},
                success: function (result) {
                    window.open('/plugins/PHPExcel-1.8/test.php?id=' + id, '_blank');
                }
            });
        }

        function openLog() {
            let data = document.getElementById("showFile").innerHTML;

            if (data !== "") {
                if (data === 'Sales File') {
                    alert("Log File Doesn't Exists");
                } else {

                    let str = data.replace(/\s/g, '');
                    let thisR = 'Log-' + str + '.txt';

                    $.ajax(thisR).done(function () {
                        let top = window.screen.height - 600;
                        top = top > 0 ? top / 2 : 0;

                        let left = window.screen.width - 700;
                        left = left > 0 ? left / 2 : 0;

                        let uploadWin = window.open("https://www.tutorkami.com/admin/" + thisR, "Log File", "width=700,height=600" + ",top=" + top + ",left=" + left);
                        uploadWin.moveTo(left, top);
                        uploadWin.focus();
                    }).fail(function () {
                        alert("Log File Doesn't Exists");
                    });
                }
            } else {
                alert('Url kosong');
            }
        }

        function getAfterPart(str) {
            return str.split(' thisID ')[1];
        }

        function getBeforePart(str) {
            return str.substring(0, str.indexOf(" thisID "));
        }

        function getSaleFile(id) {
            document.getElementById("ExportExcel").value = id;
            if (id === '') {
                alert('Error ..');
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'sale-process.php',
                    data: {
                        getSaleFile: {id: id},
                    },
                    success: function (result) {
                        if (result === 'empty file') {
                            alert('empty file');
                        } else {
                            document.getElementById("showFile").innerHTML = getBeforePart(result);
                            let loadFileTabs = getAfterPart(result);
                            $('#loadFileTabs').load('load-sale-file-tabs-test.php?requiredid=' + loadFileTabs);
                        }
                    }
                });
            }
        }

        function AddFile() {
            document.getElementById('buttonModal').click();
        }

        function submitFileName() {
            let FileInput = document.getElementById('FileInput').value;
            let YearInput = document.getElementById('YearInput').value;

            if (FileInput === '' || YearInput === '') {
                alert('Please insert file name and year ..');
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'sale-process.php',
                    data: {
                        dataFile: {FileInput: FileInput, YearInput: YearInput},
                    },
                    success: function (result) {
                        if (/^\d+$/.test(result)) {
                            $('#loadFile').load('load-sale-file.php?requiredid=' + result);
                            document.getElementById('closeModalFile').click();
                        } else {
                            alert(result);
                        }
                    }
                });
            }
        }

        /* Save bank data*/
        function saveBank(editableObj, column, id, tableID) {
            var mainID = document.getElementById('mainID').value;
            var btnTab = $(".btnTab.active").text();
            var btnTabMonth = $(".btnTabMonth.active").text();
            var currVal = $(editableObj).text().trim();

            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThisBank(id, column, btnTabMonth, currVal);
            }, 1000);
        }

        function saveThisBank(id, column, btnTabMonth, currVal) {
            $.ajax({
                url: "sale-bank-edit.php",
                type: "POST",
                data: 'column=' + column + '&editval=' + encodeURIComponent(currVal) + '&id=' + id + '&btnTabMonth=' + btnTabMonth,
                success: function (data) {
                    if (data.trim() === 'Success') {

                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-bank.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                            }
                        });
                    } else {
                        alert(data);
                    }
                }
            });
        }

        function saveExpenses(editableObj, column, id, tableID) {
            var mainID = document.getElementById('mainID').value;
            var btnTab = $(".btnTab.active").text();
            var btnTabMonth = $(".btnTabMonth.active").text();
            var currVal = $(editableObj).text().trim();

            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThisExpenses(id, column, btnTabMonth, currVal);
            }, 1000);
        }

        function saveThisExpenses(id, column, btnTabMonth, currVal) {
            $.ajax({
                url: "sale-expenses-edit.php",
                type: "POST",
                data: 'column=' + column + '&editval=' + encodeURIComponent(currVal) + '&id=' + id + '&btnTabMonth=' + btnTabMonth,
                success: function (data) {
                    if (data.trim() == 'Success') {

                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-expenses.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                            }
                        });

                    } else {
                        alert(data);
                    }
                }
            });
        }

        function createExpenses() {
            confirmExpensesData(function () {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyyy = today.getFullYear().toString().substr(-2);
                today = dd + '/' + mm + '/' + yyyy;

                var mainID = document.getElementById('mainID').value;
                var btnTab = $(".btnTab.active").text();
                var btnTabMonth = $(".btnTabMonth.active").text();

                $.ajax({
                    url: "sale-expenses-add.php",
                    type: "POST",
                    dataType: 'json',
                    data: 'mainID=' + mainID + '&btnTabMonth=' + btnTabMonth + '&today=' + today,
                    success: function (data) {
                        let numberOnly = data.insert_id;

                        if (numberOnly !== null) {
                            $.ajax({
                                type: 'POST',
                                url: 'sale-load-expenses.php',
                                data: {
                                    dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                                },
                                success: function (result) {
                                    document.getElementById("loadSaleData").innerHTML = result;
                                    document.getElementById('bodyExpenses' + numberOnly).click();
                                }
                            });
                        } else {
                            alert(trimData);
                        }
                    }
                });
            });
        }

        function createDeposit() {
            confirmDepositData(function () {
                let today = new Date();
                let dd = String(today.getDate()).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0');
                let yyyy = today.getFullYear().toString().substr(-2);
                today = dd + '/' + mm + '/' + yyyy;

                let mainID = document.getElementById('mainID').value;
                let btnTab = $(".btnTab.active").text();
                let btnTabMonth = $(".btnTabMonth.active").text();

                $.ajax({
                    url: 'sale-deposit-add.php',
                    type: 'POST',
                    dataType: 'json',
                    data: 'mainID=' + mainID + '&btnTabMonth=' + btnTabMonth + '&today=' + today,
                    success: function (data) {
                        let insert_id = data.insert_id;

                        if (insert_id !== 0) {
                            $.ajax({
                                type: 'POST',
                                url: 'sale-load-deposit.php',
                                data: {
                                    dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                                },
                                success: function (result) {
                                    document.getElementById("loadSaleData").innerHTML = result;
                                    document.getElementById('bodyDeposit' + insert_id).click();
                                }
                            });
                        } else {
                            alert(data.message);
                        }
                    }
                });
            });
        }

        function saveDeposit(editableObj, column, id, tableID) {
            var mainID = document.getElementById('mainID').value;
            var btnTab = $(".btnTab.active").text();
            var btnTabMonth = $(".btnTabMonth.active").text();

            var currVal = $(editableObj).text().trim();

            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThisDeposit(id, column, btnTabMonth, currVal);
            }, 1000);
        }

        function saveThisDeposit(id, column, btnTabMonth, currVal) {
            $.ajax({
                url: "sale-deposit-edit.php",
                type: "POST",
                data: 'column=' + column + '&editval=' + encodeURIComponent(currVal) + '&id=' + id + '&btnTabMonth=' + btnTabMonth,
                success: function (data) {
                    if (data.trim() == 'Success') {

                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-deposit.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                            }
                        });

                    } else {
                        alert(data);
                    }
                }
            });
        }

        function confirmExpensesData(cb) {
            $('#ajax-spinner').attr('class', 'visible');

            let datas = [];
            let btnTabMonth = $(".btnTabMonth.active").text();
            let mainID = document.getElementById('mainID').value;
            let btnTab = $(".btnTab.active").text();

            $('.expenses-data').each(function () {
                let id = $(this).data('expenses-id');
                let date = $('.expenses-date', this).html().trim();
                let item = $('.expenses-item', this).html().trim();
                let category = $('.expenses-category option:selected', this).val();
                let amount = $('.expenses-amount', this).html().trim();
                let note = $('.expenses-note', this).html().trim();
                let this_row = {id: id, date: date, item: item, category: category, amount: amount, note: note};
                datas.push(this_row)
            });

            $.ajax({
                url: 'sale-expenses-edit.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    btnTabMonth: btnTabMonth,
                    datas: datas,
                },
                success: function (data) {
                    cb(data, mainID, btnTab, btnTabMonth);
                }
            });
        }

        function confirmDepositData(cb) {
            $('#ajax-spinner').attr('class', 'visible');

            let datas = [];
            let btnTabMonth = $(".btnTabMonth.active").text();
            let mainID = document.getElementById('mainID').value;
            let btnTab = $(".btnTab.active").text();

            $('.deposit-data').each(function () {
                let id = $(this).data('deposit-id');
                let date = $('.deposit-date', this).html().trim();
                let item = $('.deposit-item', this).html().trim();
                let amount = $('.deposit-amount', this).html().trim();
                let note = $('.deposit-note', this).html().trim();
                let this_row = {id: id, date: date, item: item, amount: amount, note: note};
                datas.push(this_row)
            });

            $.ajax({
                url: 'sale-deposit-edit.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    btnTabMonth: btnTabMonth,
                    datas: datas,
                },

                success: function (data) {
                    cb(data, mainID, btnTab, btnTabMonth);
                }
            });
        }

        function confirmBankData() {
            $('#ajax-spinner').attr('class', 'visible');

            let tk = $('#tk-data').text().trim();
            let hs = $('#hs-data').text().trim();
            let date = $('#date-data').text().trim();
            let latest_balance = $('#latest-balance-data').text().trim();
            let id = $('#data-id').val();
            let btn_tab = $('.btnTab.active').text();
            let btn_tab_month = $('.btnTabMonth.active').text();
            let mainID = document.getElementById('mainID').value;
            let current_tk = $('#current-tk-data').text().trim();
            let current_hs = $('#current-hs-data').text().trim();

            $.ajax({
                url: "sale-bank-edit.php",
                type: "POST",
                dataType: "json",
                data: {
                    tk: tk,
                    hs: hs,
                    date: date,
                    latest_balance: latest_balance,
                    current_tk: current_tk,
                    current_hs: current_hs,
                    id: id,
                },
                success: function (data) {
                    if (data.status === 0) {
                        $('#ajax-spinner').attr('class', 'invisible');
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-bank.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btn_tab, month: btn_tab_month},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                            }
                        });
                    } else {
                        alert(data.message);
                    }
                }
            });
        }

        function setCurrentTK() {
            let latest_balance = parseFloat($('#latest-balance-data').html().replace(",",""));
            let current_hs = parseFloat($('#current-hs-data').html().replace(",",""));

            if(isNaN(current_hs)) {
                current_hs = 0;
                $('#current-hs-data').html(current_hs);
            }

            let tk_val = (Math.round(((latest_balance - current_hs) + Number.EPSILON) * 100) / 100).toFixed(2);
            let tk_val_str = tk_val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#current-tk-data').html(tk_val_str);
        }

        $(document).ready(function () {
            $('#loadFile').load('load-sale-file.php');
            let d = new Date();
            let year = d.getFullYear();

            $.ajax({
                type: 'POST',
                url: 'sale-process.php',
                data: {
                    getYear: {year: year},
                },
                success: function (result) {
                    if (result === "empty year") {
                        document.getElementById("showFile").innerHTML = 'Sales File';
                    } else {
                        document.getElementById("showFile").innerHTML = getBeforePart(result);
                        let loadFileTabs = getAfterPart(result);
                        document.getElementById("ExportExcel").value = loadFileTabs;
                        $('#loadFileTabs').load('load-sale-file-tabs-test.php?requiredid=' + loadFileTabs);
                    }
                }
            });

            $('#date_deadline .input-group.date').datepicker({
                startView: 0,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "dd-mm-yyyy"
            });

            /* Show generate button */
            $(document).on('change', '#item-category', function () {
                let value = $(this).val();

                if (value !== 'others' && value !== '') {
                    $('#generate-action').attr('class', 'visible');
                } else {
                    $('#generate-action').attr('class', 'invisible');
                }
            });

            /* Event when user click on the editable table cell*/
            let bg_color = null;
            let cell_focus = false;
            $(document).on('click', '.data-edit', function () {
                // bg_color = $(this).css('background-color');
                cell_focus = true;
                $(this).css('background-color', '#f3ebcd');
            });

            $(document).on('mouseover', '.data-edit', function () {
                if(!cell_focus) {
                    bg_color = $(this).css('background-color');
                    $(this).css('background-color', '#ddd');
                }
            });

            $(document).on('mouseleave', '.data-edit', function () {
                if(!cell_focus) {
                    $(this).css('background-color', bg_color);
                }
            });

            /* Event when user lost focus on the editable table cell*/
            $(document).on('blur', '.data-edit', function () {
                cell_focus = false;
                $(this).css('background-color', bg_color);
            });

            /* Confirm bank data*/
            $(document).on('click', '#confirm-bank-data', confirmBankData);

            /* Confirm expenses data */
            $(document).on('click', '#confirm-expenses-data', function () {
                confirmExpensesData(function (data, mainID, btnTab, btnTabMonth) {
                        $('#ajax-spinner').attr('class', 'invisible');
                        if (data.status === 0) {
                            $.ajax({
                                type: 'POST',
                                url: 'sale-load-expenses.php',
                                data: {
                                    dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                                },
                                success: function (result) {
                                    document.getElementById("loadSaleData").innerHTML = result;
                                }
                            });

                        } else {
                            alert(data.message);
                        }
                    }
                )
            });

            /* Confirm deposit data*/
            $(document).on('click', '#confirm-deposit-data', function () {
                confirmDepositData(function (data, mainID, btnTab, btnTabMonth) {
                        $('#ajax-spinner').attr('class', 'invisible');

                        if (data.status === 0) {
                            $.ajax({
                                type: 'POST',
                                url: 'sale-load-deposit.php',
                                data: {
                                    dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                                },
                                success: function (result) {
                                    document.getElementById("loadSaleData").innerHTML = result;
                                }
                            });
                        } else {
                            alert(data.message);
                        }
                    }
                )
            });

            /* Calculate current tk*/
            $(document).on('blur','#current-hs-data', function(){
                setCurrentTK();
            });

        });


    </script>

</body>
</html>