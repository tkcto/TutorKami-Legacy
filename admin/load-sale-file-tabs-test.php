<?php
require_once('classes/config.php.inc');

# Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

# Check connection
if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();

if (isset($_GET['requiredid'])) {
    ?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/1.2.0/balloon.min.css" rel="stylesheet"/>

    <style>
        #tabs-label {
            background: yellow;
            color: black;
            border: 1px solid #000;
            margin-right: 6px;
        }

        .tbl-qa {
            width: 100%;
            background-color: #f5f5f5;
            border-right: 1px solid black;
            border-left: 1px solid black;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .tbl-qa th.table-header {
            padding: 3px;
            text-align: left;
            padding: 8px;
        }

        .tbl-qa td.table-header {
            padding: 3px;
            text-align: left;
            padding: 8px;
            font-size: 0.9em;
            font-weight: bold;
        }

        .tbl-qa .table-row td {
            padding: 8px;
            background-color: #FDFDFD;
            border-right: 1px solid black;
            border-left: 1px solid black;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .ajax-action-links {
            color: #28A745;
            margin: 8px 0px;
            cursor: pointer;
        }

        .ajax-action-button {
            border: #094 1px solid;
            color: #09F;
            margin: 8px 0px;
            cursor: pointer;
            display: inline-block;
            padding: 8px 18px;
        }

        .tab-pane {
            min-height: 100%
            overflow-y: scroll;
        }

        .fontSize {
            font-size: 13px;
        }

        #confirmBox {
            display: none;
            background-color: #f1592a;
            border-radius: 5px;
            width: 300px;
            margin-top: 90px;
            margin-left: -150px;
            padding: 6px 8px 8px;
            box-sizing: border-box;
            text-align: center;
            position: fixed;
        }

        #confirmBox .button {
            background-color: white;
            display: inline-block;
            border-radius: 3px;
            padding: 2px;
            text-align: center;
            width: 95px;
            cursor: pointer;
        }

        #confirmBox .button:hover {
            background-color: white;
        }

        #confirmBox .message {
            text-align: left;
            margin-bottom: 8px;
        }

        .centered {
            position: fixed;
            top: 45%;
            left: 60%;
            transform: translate(-50%, -50%);
        }

        #confirmBox2 {
            display: none;
            background-color: #f1592a;
            border-radius: 5px;
            width: 300px;
            margin-top: 90px;
            margin-left: -150px;
            padding: 6px 8px 8px;
            box-sizing: border-box;
            text-align: center;
            position: fixed;
        }

        #confirmBox2 .button {
            background-color: white;
            display: inline-block;
            border-radius: 3px;
            padding: 2px;
            text-align: center;
            width: 95px;
            cursor: pointer;
        }

        #confirmBox2 .button:hover {
            background-color: white;
        }

        #confirmBox2 .message {
            text-align: left;
            margin-bottom: 8px;
        }

        #confirmBoxLastRow {
            display: none;
            background-color: #f1592a;
            border-radius: 5px;
            width: 300px;
            margin-top: 90px;
            margin-left: -150px;
            padding: 6px 8px 8px;
            box-sizing: border-box;
            text-align: center;
            position: fixed;
        }

        #confirmBoxLastRow .button {
            background-color: white;
            display: inline-block;
            border-radius: 3px;
            padding: 2px;
            text-align: center;
            width: 95px;
            cursor: pointer;
        }

        #confirmBoxLastRow .button:hover {
            background-color: white;
        }

        #confirmBoxLastRow .message {
            text-align: left;
            margin-bottom: 8px;
        }

        #loading-imgBG {
            background: url(http://preloaders.net/preloaders/360/Velocity.gif) center center no-repeat;
            height: 100%;
            z-index: 20;
        }

        .overlayBG {
            background: #e9e9e9;
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.5;
        }

        #tempModal .modal-dialog {
            -webkit-transform: translate(0, -50%);
            -o-transform: translate(0, -50%);
            transform: translate(0, -50%);
            top: 50%;
            margin: 0 auto;
        }

        .spinner {
            margin: 100px auto 0;
            width: 70px;
            text-align: center;
        }

        .spinner > div {
            width: 13px;
            height: 13px;
            background-color: #900C3F;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }

        .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0)
            }
            40% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bouncedelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }
            40% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
            }
        }
    </style>


    <div class="modal fade" id="tempModal" tabindex="-1" role="dialog" aria-labelledby="tempModallLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header hidden" id="tempModalHeader">
                </div>

                <div class="modal-body" id="tempModalBody">
                </div>

                <div class="modal-footer hidden" id="tempModalFooter">
                    <div class="spinner">
                        <font style="font-size:14px;color:#900C3F"><b>Loading...</b></font>
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <input type="hidden" class="form-control" id="mainID" value="<?PHP echo $_GET['requiredid']; ?>">

    <div class="centered scrollTop" id="confirmBox">
        <div class="message"></div>
        <span class="button yes">Carry Forward </span>
        <span class="button no">Add Row</span>
        <span class="button cancel" style="margin-top:4px;">Cancel</span>
    </div>
    <div class="centered scrollTop" id="confirmBox2">
        <div class="message"></div>
        <span class="button yes">Carry Forward </span>
        <span class="button no">Add Row</span>
        <span class="button undo">Undo</span>
        <span class="button cancel" style="margin-top:4px;">Cancel</span>
    </div>
    <div class="centered scrollTop" id="confirmBoxLastRow">
        <div class="message"></div>
        <span class="button yes">Carry Forward </span>
        <span class="button cancel">Cancel</span>
    </div>

    <div class="overlayBG">
        <div id="loading-imgBG"></div>
    </div>


    <div class="modal fade" id="myModalAddTab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="TabInput">Tab Name </label>
                            <input type="text" class="form-control" id="TabInput" aria-describedby="TabHelp" placeholder="eg : Example">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button style="margin-top:4px;" type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
                    <button onclick="submitTab()" type="button" class="btn btn-rate">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <span id="buttonAddTab" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModalAddTab" class="glyphicon glyphicon-plus" style="color:#243027"></span>&nbsp;&nbsp;&nbsp;
    <?php
    $i = 1;
    $sql = " SELECT id, main_id, tab_name FROM tk_sales_sub WHERE main_id = '" . $_GET['requiredid'] . "' AND row_no = '0' ORDER BY tab_name ASC ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            if ($i == 1) {
                ?>
                <button type="button" class="btnTab btn btn-default active"><?PHP echo $row['tab_name']; ?> </button>
                <?php
            } else {
                ?>
                <button type="button" class="btnTab btn btn-default"><?PHP echo $row['tab_name']; ?> </button>
                <?php
            }
            $i++;
        }
    } else {
        echo "<script>$(document).ready(function(){ 
        setTimeout(function() { document.getElementById('buttonAddTab').click(); }, 1000);
    });</script>";
    }
    ?>

    <div class="btn-group pull-right">
        <span id="tabs-label" class="btn btn-info-ori dropdown-toggle">Sales File</span>
        <button type="button" class="btn btn-info-ori dropdown-toggle" data-toggle="dropdown">
            Tabs
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu scrollable-menu" role="menu" style="width:150px;">
            <li><a class="btnSalesFile" data-label="Sales File">Sales File</a></li>
            <li><a class="btnSummary" data-label="Summary">Summary</a></li>
            <li><a class="btnExpenses" data-label="Expenses">Expenses</a></li>
            <li><a class="btnBank" data-label="Bank">Bank</a></li>
            <li><a class="btnDeposit" data-label="Deposits">Deposits</a></li>
        </ul>
    </div>

    <p class="hidden" id="demo123"></p>
    <div class="panel panel-default tab-pane">
        <div class="panel-body">

            <button type="button" class="btnTabMonth btn btn-default active">Jan</button>
            <button type="button" class="btnTabMonth btn btn-default ">Feb</button>
            <button type="button" class="btnTabMonth btn btn-default ">Mar</button>
            <button type="button" class="btnTabMonth btn btn-default ">Apr</button>
            <button type="button" class="btnTabMonth btn btn-default ">May</button>
            <button type="button" class="btnTabMonth btn btn-default ">Jun</button>
            <button type="button" class="btnTabMonth btn btn-default ">Jul</button>
            <button type="button" class="btnTabMonth btn btn-default ">Aug</button>
            <button type="button" class="btnTabMonth btn btn-default ">Sep</button>
            <button type="button" class="btnTabMonth btn btn-default ">Oct</button>
            <button type="button" class="btnTabMonth btn btn-default ">Nov</button>
            <button type="button" class="btnTabMonth btn btn-default ">Dec</button>
            <button type="button" class="hidden btnTabYear btn btn-default ">Year</button>
            <button type="button" class="hidden btnTabYearExp btn btn-default ">Year</button>
            <button type="button" class="hidden btnTabYearDep btn btn-default ">Year</button>

            <div id="loadSaleData"></div>
            <br/>
            <button id="add-more" onClick="createNew();" type="button" class="btn btn-success-ori">
                <span class="glyphicon glyphicon-plus"></span> Add More
            </button>
            <span id="duplicateBtn"></span>

        </div>
    </div>

    <?php
} else {
    echo 'Error : Content..';
}
$conn->close();
?>

<script>
    function runPv(type, val) {
        var txtAddRemark = document.getElementById("txtAddRemark").value;
        $(".overlayBG").show();
        $.ajax({
            type: 'POST',
            url: 'sale-issue-pv.php',
            data: {
                dataPV: {jenis: type, nilai: val, komen: txtAddRemark},
            },
            success: function (receipt) {
                $(".overlayBG").hide();
                $("#tempModal").modal('hide');
                if (receipt == 'Error!') {
                    alert(receipt);
                } else if (receipt == 'trial paid') {

                } else {

                    if (type == 'Yes' || type == 'PV') {

                        var trimData = receipt.trim();
                        var JobID = trimData.match(/\d+/g);
                        var infoKelas = receipt.replace(/[0-9]/g, '');
                        var infoKelas2 = infoKelas.trim();
                        var dataInfoKelas = '';

                        if (infoKelas2 == 'This is the last session') {
                            dataInfoKelas = '<b> <p style="color:red;"> Class has stopped </p> </b> <br/>';
                        } else if (infoKelas2 == 'Next class as usual') {
                            dataInfoKelas = '<b> <p style="color:green;"> Class resume </p> </b> <br/>';
                        } else if (infoKelas2 == 'Not sure if got next class') {
                            dataInfoKelas = '<b> <p style="color:blue;"> Not sure if class resume </p> </b> <br/>';
                        } else {
                            dataInfoKelas = '<b> <p style="color:red;"> Error </p> </b> <br/>';
                        }


                        function addDays(date, days) {
                            const copy = new Date(Number(date))
                            copy.setDate(date.getDate() + days)
                            return copy
                        }

                        var date = new Date();
                        var newDate = addDays(date, 9);

                        var dd = String(newDate.getDate()).padStart(2, '0');
                        var mm = String(newDate.getMonth() + 1).padStart(2, '0');
                        var yyyy = newDate.getFullYear();
                        newDate = dd + '/' + mm + '/' + yyyy;


                        document.getElementById("tempModalBody").innerHTML = '<center> <b> Set the deadline to follow up if tutor has started the next cycle </b> <br/><br/> ' + dataInfoKelas +

                            ' <input type="hidden" class="form-control" id="jobIDPopUp" value="' + JobID + '" /> ' +

                            ' <div class="input-group" id="date_deadline"> ' +
                            ' <div class="form-inline">' +
                            ' <div class="input-group date"> ' +
                            ' <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" style="width:100px;" id="deadLinePopUp" value="' + newDate + '" /> ' +
                            ' </div> ' +
                            ' &nbsp;&nbsp;&nbsp;<input type="checkbox" class="form-check-input" id="checkboxPopUp" checked > <span ><font size="4"><b>&nbsp;ASER</b></font></span>  ' +
                            ' </div> ' +
                            ' </div> ' +


                            ' <br/><br/>  </center> ' +


                            ' <b> Note: end cycle reminder will be send to tutor 2 days before the date above </b> <br/><br/> ' +
                            ' <b> Note 2: if class stopped but need to open another job, untick ASER </b> <br/><br/> ' +

                            ' <center> <b> <div class="form-group"><label for="exampleFormControlTextarea1"></label><textarea class="form-control" id="remarksPopUp" rows="3" placeholder="Fill in your remarks here" ></textarea></div> ' +


                            ' <button type="button" class="btn btn-primary"   onclick="proceedDeadline()" > Proceed</button> &nbsp;&nbsp;' +
                            ' <button type="button" class="btn btn-secondary" onclick="closeModal()" > No</button> </center> ';

                        setTimeout(function () {
                            $('#tempModal').modal({backdrop: 'static', keyboard: false});
                        }, 1500);
                    }

                }

            }
        });
    }

    function proceedDeadline() {
        var pJobID = document.getElementById("jobIDPopUp").value;
        var pDeadline = document.getElementById("deadLinePopUp").value;
        var pCheck = document.getElementById("checkboxPopUp").checked;
        var pRemark = document.getElementById("remarksPopUp").value;
        //alert( pJobID + ' | ' + pDeadline + ' | ' + pCheck  + ' | ' + pRemark );
        if (pJobID == '') {
            alert('Error');
        } else {
            if (/^\d+$/.test(pJobID)) {
                $.ajax({
                    url: "ajax/allinone.php",
                    method: "POST",
                    data: {
                        action: 'proceedDeadline',
                        pJobID: pJobID,
                        pDeadline: pDeadline,
                        pCheck: pCheck,
                        pRemark: pRemark
                    },
                    success: function (result) {
                        if (result == 'Error') {
                            alert('Error');
                        } else {
                            $("#tempModal").modal('hide');
                            Lobibox.notify('success', {
                                position: 'top right',
                                width: 250,
                                size: 'mini',
                                msg: 'PV to tutor has been issued'
                            });

                            var disID = result.substr(0, result.indexOf(' '));
                            var Lang = result.substr(result.indexOf(' ') + 1);
                            var Lang2 = Lang.replace('-', '');

                            if (pCheck !== true) {
                                if (Lang2.trim() == 'BM') {
                                    var tempInput = document.createElement("input");
                                    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
                                    tempInput.value = 'https://www.tutorkami.com/my/rform?token=' + disID;
                                    document.body.appendChild(tempInput);
                                    tempInput.select();
                                    document.execCommand("copy");
                                    document.body.removeChild(tempInput);

                                    document.getElementById("tempModalBody").innerHTML = "<center>BM link has been successfully copied <br/><br/> <button type='button' class='btn btn-secondary' onclick='closeModal()' > Close</button> </center>";
                                    setTimeout(function () {
                                        $("#tempModal").modal();
                                    }, 1000);
                                } else {
                                    var tempInput = document.createElement("input");
                                    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
                                    tempInput.value = 'https://www.tutorkami.com/rform?token=' + disID;
                                    document.body.appendChild(tempInput);
                                    tempInput.select();
                                    document.execCommand("copy");
                                    document.body.removeChild(tempInput);

                                    document.getElementById("tempModalBody").innerHTML = "<center>English link has been successfully copied <br/><br/> <button type='button' class='btn btn-secondary' onclick='closeModal()' > Close</button> </center>";
                                    setTimeout(function () {
                                        $("#tempModal").modal();
                                    }, 1000);
                                }
                            }
                        }
                    }
                });
            } else {
                alert('Error');
            }
        }

    }

    function closeModal() {
        $("#tempModal").modal('hide');
    }

    $(function () {
        $('.fetched-date input').datepicker({
            calendarWeeks: true,
            todayHighlight: true,
            autoclose: true
        });
    });

    function runReceipt(type, val) {
        $("#tempModalFooter").removeClass("hidden");
        var txtAddRemark = document.getElementById("txtAddRemark").value;
        $.ajax({
            type: 'POST',
            url: 'sale-issue-receipt.php',
            data: {
                dataReceipt: {jenis: type, nilai: val, komen: txtAddRemark},
            },
            success: function (receipt) {
                $("#tempModalFooter").addClass("hidden");
                alert(receipt);
                $("#tempModal").modal('hide');
            }
        });
    }

    $(document).ready(function () {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        $.ajax({
            type: 'POST',
            url: 'sale-load-table.php',
            data: {
                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
            },
            success: function (result) {
                document.getElementById("loadSaleData").innerHTML = result;
                $.ajax({
                    type: 'POST',
                    url: 'sale-load-footer.php',
                    data: {
                        dataFooter: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                    },
                    success: function (resultFooter) {
                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                    }
                });
            }
        });

        $(".btnTabYear").click(function () {
            $(this).addClass("active");
            $(".btnTabMonth").removeClass("active");

            var mainID = document.getElementById('mainID').value;
            $.ajax({
                type: 'POST',
                url: 'sale-load-year.php',
                data: {
                    dataGrid: {mainID: mainID},
                },
                success: function (result) {
                    document.getElementById("loadSaleData").innerHTML = result;
                }
            });
        });

        $(".btnTabYearExp").click(function () {
            $(this).addClass("active");
            $(".btnTabMonth").removeClass("active");

            var mainID = document.getElementById('mainID').value;

            $.ajax({
                type: 'POST',
                url: 'sale-expenses-load-year.php',
                data: {
                    dataGrid: {mainID: mainID},
                },
                success: function (result) {
                    document.getElementById("loadSaleData").innerHTML = result;
                }
            });

        });

        $(".btnTabYearDep").click(function () {
            $(this).addClass("active");
            $(".btnTabMonth").removeClass("active");

            var mainID = document.getElementById('mainID').value;
            $.ajax({
                type: 'POST',
                url: 'sale-deposit-load-year.php',
                data: {
                    dataGrid: {mainID: mainID},
                },
                success: function (result) {
                    document.getElementById("loadSaleData").innerHTML = result;
                }
            });

        });

        $(".btnTab").click(function () {

            $(".btnTabYear").addClass("hidden");
            $(".btnTabYearExp").addClass("hidden");
            $(".btnTabYearDep").addClass("hidden");
            $(".btnTabMonth").removeClass("hidden");

            $(".btnExpenses").removeClass("active");
            $(".btnSummary").removeClass("active");
            $(".btnDeposit").removeClass("active");
            $(".btnBank").removeClass("active");

            $(".btnTab").removeClass("active");
            $(this).addClass("active");

            var btnTab = $(this).text();
            var btnTabMonth = $(".btnTabMonth.active").text();

            $("#add-more").show();
            document.getElementById('duplicateBtn').innerHTML = '';

            $.ajax({
                type: 'POST',
                url: 'sale-load-table.php',
                data: {
                    dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                },
                success: function (result) {
                    document.getElementById("loadSaleData").innerHTML = result;
                    $.ajax({
                        type: 'POST',
                        url: 'sale-load-footer.php',
                        data: {
                            dataFooter: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                        },
                        success: function (resultFooter) {
                            document.getElementById("loadFooterSale").innerHTML = resultFooter;
                        }
                    });
                }
            });
        });

        $(".btnTabMonth").click(function () {
            $(".btnTabMonth").removeClass("active");
            $(".btnTabYear").removeClass("active");
            $(".btnTabYearExp").removeClass("active");
            $(".btnTabYearDep").removeClass("active");

            $(this).addClass("active");
            var btnTab = $(".btnTab.active").text();
            var btnTabMonth = $(this).text();
            $("#add-more").show();
            document.getElementById('duplicateBtn').innerHTML = '';

            if (btnTab != '') {
                $.ajax({
                    type: 'POST',
                    url: 'sale-load-table.php',
                    data: {
                        dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                    },
                    success: function (result) {
                        document.getElementById("loadSaleData").innerHTML = result;
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-footer.php',
                            data: {
                                dataFooter: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (resultFooter) {
                                document.getElementById("loadFooterSale").innerHTML = resultFooter;
                            }
                        });
                    }
                });
            } else {
                var btnExpense = $(".btnExpenses.active").text();
                var btnSummary = $(".btnSummary.active").text();
                var btnDeposit = $(".btnDeposit.active").text();

                if (btnSummary != '') {
                    $("#add-more").hide();
                    $.ajax({
                        type: 'POST',
                        url: 'sale-load-summary.php',
                        data: {
                            dataGrid: {mainID: mainID, month: btnTabMonth},
                        },
                        success: function (result) {
                            document.getElementById("loadSaleData").innerHTML = result;
                        }
                    });
                }
                if (btnExpense != '') {
                    $("#add-more").hide();
                    $.ajax({
                        type: 'POST',
                        url: 'sale-load-expenses.php',
                        data: {
                            dataGrid: {mainID: mainID, month: btnTabMonth},
                        },
                        success: function (result) {
                            document.getElementById("loadSaleData").innerHTML = result;
                        }
                    });
                }
                if (btnDeposit != '') {
                    $("#add-more").hide();
                    $.ajax({
                        type: 'POST',
                        url: 'sale-load-deposit.php',
                        data: {
                            dataGrid: {mainID: mainID, month: btnTabMonth},
                        },
                        success: function (result) {
                            document.getElementById("loadSaleData").innerHTML = result;
                        }
                    });
                }
            }

        });

        $(".btnSummary").click(function () {

            $('#tabs-label').html($(this).data('label'))

            $(".btnTabYear").removeClass("hidden");
            $(".btnTabYearExp").addClass("hidden");
            $(".btnTabYearDep").addClass("hidden");
            $(".btnTabMonth").removeClass("hidden");

            $(".btnTab").removeClass("active");
            $(".btnExpenses").removeClass("active");
            $(".btnDeposit").removeClass("active");
            $(".btnBank").removeClass("active");
            $(this).addClass("active");

            var btnTabMonth = $(".btnTabMonth.active").text();
            $("#add-more").hide();
            document.getElementById('duplicateBtn').innerHTML = '';
            $.ajax({
                type: 'POST',
                url: 'sale-load-summary.php',
                data: {
                    dataGrid: {mainID: mainID, month: btnTabMonth},
                },
                success: function (result) {
                    document.getElementById("loadSaleData").innerHTML = result;
                }
            });
        });

        $(".btnExpenses").click(function () {
            $('#tabs-label').html($(this).data('label'))

            $(".btnTabYearExp").removeClass("hidden");
            $(".btnTabYear").addClass("hidden");
            $(".btnTabYearDep").addClass("hidden");
            $(".btnTabMonth").removeClass("hidden");

            $(".btnTab").removeClass("active");
            $(".btnSummary").removeClass("active");
            $(".btnDeposit").removeClass("active");
            $(".btnBank").removeClass("active");
            $(this).addClass("active");

            var btnTabMonth = $(".btnTabMonth.active").text();

            $("#add-more").hide();
            document.getElementById('duplicateBtn').innerHTML = '';

            $.ajax({
                type: 'POST',
                url: 'sale-load-expenses.php',
                data: {
                    dataGrid: {mainID: mainID, month: btnTabMonth},
                },
                success: function (result) {
                    document.getElementById("loadSaleData").innerHTML = result;
                }
            });
        });

        $(".btnDeposit").click(function () {
            $('#tabs-label').html($(this).data('label'))

            $(".btnTabYearDep").removeClass("hidden");
            $(".btnTabYearExp").addClass("hidden");
            $(".btnTabYear").addClass("hidden");
            $(".btnTabMonth").removeClass("hidden");

            $(".btnTab").removeClass("active");
            $(".btnSummary").removeClass("active");
            $(".btnExpense").removeClass("active");
            $(".btnBank").removeClass("active");
            $(this).addClass("active");

            var btnTabMonth = $(".btnTabMonth.active").text();
            $("#add-more").hide();
            document.getElementById('duplicateBtn').innerHTML = '';

            $.ajax({
                type: 'POST',
                url: 'sale-load-deposit.php',
                data: {
                    dataGrid: {mainID: mainID, month: btnTabMonth},
                },
                success: function (result) {
                    document.getElementById("loadSaleData").innerHTML = result;
                }
            });
        });

        $(".btnBank").click(function () {
            $('#tabs-label').html($(this).data('label'))

            $(".btnTabYearDep").addClass("hidden");
            $(".btnTabYearExp").addClass("hidden");
            $(".btnTabYear").addClass("hidden");
            $(".btnTabMonth").addClass("hidden");

            $(".btnTab").removeClass("active");
            $(".btnSummary").removeClass("active");
            $(".btnExpense").removeClass("active");
            $(".btnDeposit").removeClass("active");
            $(this).addClass("active");

            var btnTabMonth = $(".btnTabMonth.active").text();

            $("#add-more").hide();
            document.getElementById('duplicateBtn').innerHTML = '';

            $.ajax({
                type: 'POST',
                url: 'sale-load-bank.php',
                data: {
                    dataGrid: {mainID: mainID, month: btnTabMonth},
                },
                success: function (result) {
                    document.getElementById("loadSaleData").innerHTML = result;
                    setCurrentTK();
                }
            });

        });

        $(".btnSalesFile").click(function (){
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
        })


    });

    var timer = null;

    function addToHiddenField(addColumn, hiddenField) {
        var columnValue = $(addColumn).text();
        $("#" + hiddenField).val(columnValue);
    }

    function editRow(editableObj, btn, tableID) {
        var idx = (($(editableObj).closest('tr').index()) + 1);
        var tr = document.getElementsByTagName("tr")[idx];
        var x = document.getElementById(tableID).rows[parseInt((idx - 1), 10)].cells;

        $('#table-body > tr > td').css('background-color', '#fff');
        $('#table-body2 > tr > td').css('background-color', '#fff');
        $('#table-bodyExpenses > tr > td').css('background-color', '#fff');
        $('#bodyYear > tr > td').css('background-color', '#fff');

        if (tableID == 'bodyYear') {
            x[parseInt(0, 10)].style.backgroundColor = "#F3EBCD";
        }

        x[parseInt(1, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(2, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(3, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(4, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(5, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(6, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(7, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(8, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(9, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(10, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(11, 10)].style.backgroundColor = "#F3EBCD";

        $('.btnSaveEdit').addClass("hidden");

        if (btn == 'remove') {
            document.getElementById('duplicateBtn').innerHTML = '';
        }
    }

    function app_keyupFunctionCF(editableObj, thisID, newNo) {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear().toString().substr(-2);
        today = dd + '/' + mm + '/' + yyyy;
        var newNo = (Number(newNo) + 1);

        if (thisID === 'app_txt_no2') {
            clearTimeout(timer);
            timer = setTimeout(function () {

                var JobID = $(editableObj).text();
                if (JobID == '') {
                    $(".tempRowAddRF").remove();
                    document.getElementById('app_no3').value = '';
                    document.getElementById('app_txt_no3').innerHTML = '';

                    document.getElementById('app_no4').value = '';
                    document.getElementById('app_txt_no4').innerHTML = '';

                    document.getElementById('app_no5').value = '';
                    document.getElementById('app_txt_no5').innerHTML = '';

                    document.getElementById('app_no6').value = '';
                    document.getElementById('app_txt_no6').innerHTML = '';

                    document.getElementById('app_no7').value = '';
                    document.getElementById('app_txt_no7').innerHTML = '';

                    document.getElementById('app_no9').value = '';
                    document.getElementById('app_txt_no9').innerHTML = '';

                    document.getElementById('app_no10').value = '';
                    document.getElementById('app_txt_no10').innerHTML = '';

                    document.getElementById('app_no11').value = '';
                    document.getElementById('app_txt_no11').innerHTML = '';
                } else {
                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + JobID,
                        success: function (result) {
                            trim = result.replace(/\s+/g, '');
                            if (trim == "No") {
                                $(".tempRowAddRF").remove();
                                document.getElementById('app_no3').value = '';
                                document.getElementById('app_txt_no3').innerHTML = '';

                                document.getElementById('app_no4').value = '';
                                document.getElementById('app_txt_no4').innerHTML = '';

                                document.getElementById('app_no5').value = '';
                                document.getElementById('app_txt_no5').innerHTML = '';

                                document.getElementById('app_no6').value = '';
                                document.getElementById('app_txt_no6').innerHTML = '';

                                document.getElementById('app_no7').value = '';
                                document.getElementById('app_txt_no7').innerHTML = '';

                                document.getElementById('app_no9').value = '';
                                document.getElementById('app_txt_no9').innerHTML = '';

                                document.getElementById('app_no10').value = '';
                                document.getElementById('app_txt_no10').innerHTML = '';

                                document.getElementById('app_no11').value = '';
                                document.getElementById('app_txt_no11').innerHTML = '';
                            } else if (trim == "Error 3") {
                                alert(trim);
                            } else {
                                var nameArr = result.split(',');
                                var tutorRate = nameArr[0];
                                var parentRate = nameArr[1];
                                var cycle = nameArr[2];
                                var tutorEmail = nameArr[3];
                                var tutorDisplay = nameArr[4];
                                var userAcc = nameArr[5];
                                var RF = nameArr[6];
                                var cycleNo = nameArr[7].replace(/(\r\n|\n|\r)/gm, "");

                                if (cycleNo == 'T.S') {
                                    var stringWithLineBreaks = cycleNo + ' - ' + userAcc;
                                } else {
                                    var stringWithLineBreaks = 'Cycle #' + cycleNo + ' - ' + userAcc;
                                }
                                var stringWithoutLineBreaks = stringWithLineBreaks.replace(/(\r\n|\n|\r)/gm, "");

                                if (RF > 0) {
                                    var data = '<tr class="table-row tempRowAdd tempRowAddRF">' +

                                        '<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_dataNo" onBlur="addToHiddenField(this,\'app_RFrow_no\')" onClick="editRow(this);"><font color="blue"><b>' + newNo + '</font></b></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="app_RFtxt_no1"    onBlur="addToHiddenField(this,\'app_RFno1\')"    onClick="editRow(this);">' + today + '</td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no2"    onBlur="addToHiddenField(this,\'app_RFno2\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no3"    onBlur="addToHiddenField(this,\'app_RFno3\')"    onClick="editRow(this);">R.F</td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="app_RFtxt_no4"    onBlur="addToHiddenField(this,\'app_RFno4\')"    onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id)">' + RF + '</td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no8"    onBlur="addToHiddenField(this,\'app_RFno8\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="app_RFtxt_no5"    onBlur="addToHiddenField(this,\'app_RFno5\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no6"    onBlur="addToHiddenField(this,\'app_RFno6\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no7"    onBlur="addToHiddenField(this,\'app_RFno7\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no9"    onBlur="addToHiddenField(this,\'app_RFno9\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no10"   onBlur="addToHiddenField(this,\'app_RFno10\')"   onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="app_RFtxt_no11"   onBlur="addToHiddenField(this,\'app_RFno11\')"   onClick="editRow(this);">NJ</td>' +


                                        '<td style="font-size:14px;" >  <input type="hidden" id="app_RFrow_no" value="' + newNo + '" /> <input type="hidden" id="app_RFno1" value="' + today + '"/> <input type="hidden" id="app_RFno2" value="' + JobID + '"/> <input type="hidden" id="app_RFno3" value="R.F"/> <input type="hidden" id="app_RFno4" value="' + RF + '" /> <input type="hidden" id="app_RFno5" /> <input type="hidden" id="app_RFno6" /> <input type="hidden" id="app_RFno7" /> <input type="hidden" id="app_RFno8" /> <input type="hidden" id="app_RFno9" /> <input type="hidden" id="app_RFno10" /> <input type="hidden" id="app_RFno11" value="NJ"/>  <span id="confirmAdd"><a onclick="app_RemoveAdd();" class="ajax-action-links" style="color:red"><b>Remove</b></a></span>  </td>' +
                                        '</tr>';

                                    $('table > #table-body > tr').eq(newNo - 2).after(data);

                                    document.getElementById('app_RFno5').value = stringWithoutLineBreaks;
                                    document.getElementById('app_RFtxt_no5').innerHTML = stringWithoutLineBreaks;

                                    document.getElementById('app_no6').value = '';
                                    document.getElementById('app_txt_no6').innerHTML = '';

                                    document.getElementById('app_no7').value = '';
                                    document.getElementById('app_txt_no7').innerHTML = '';

                                    document.getElementById('app_RFno9').value = parseFloat((document.getElementById('app_RFno4').value - document.getElementById('app_RFno7').value)).toFixed(2);
                                    document.getElementById('app_RFtxt_no9').innerHTML = parseFloat((document.getElementById('app_RFno4').value - document.getElementById('app_RFno7').value)).toFixed(2);
                                } else {
                                    $(".tempRowAddRF").remove();
                                }

                                document.getElementById('app_no3').value = tutorDisplay;
                                document.getElementById('app_txt_no3').innerHTML = tutorDisplay;

                                document.getElementById('app_no4').value = parseFloat((parentRate * cycle)).toFixed(2);
                                document.getElementById('app_txt_no4').innerHTML = parseFloat((parentRate * cycle)).toFixed(2);

                                document.getElementById('app_no8').value = parseFloat(parentRate).toFixed(2);
                                document.getElementById('app_txt_no8').innerHTML = parseFloat(parentRate).toFixed(2);

                                document.getElementById('app_no5').value = stringWithoutLineBreaks;
                                document.getElementById('app_txt_no5').innerHTML = stringWithoutLineBreaks;

                                document.getElementById('app_no6').value = '';
                                document.getElementById('app_txt_no6').innerHTML = '';

                                document.getElementById('app_no7').value = '';
                                document.getElementById('app_txt_no7').innerHTML = '';

                                document.getElementById('app_no9').value = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                document.getElementById('app_txt_no9').innerHTML = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);

                                document.getElementById('app_no10').value = cycle;
                                document.getElementById('app_txt_no10').innerHTML = cycle;

                                document.getElementById('app_no11').value = '';
                                document.getElementById('app_txt_no11').innerHTML = '';
                            }
                        }
                    });
                }
            }, 1000);
        }

        if (thisID === 'app_txt_no3') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var tutorName = $(editableObj).text();

                var Row = document.getElementById("table-row-" + (newNo - 2));
                var Cells = Row.getElementsByTagName("td");
                var tJobID = Cells[2].innerText;

                if (tutorName == 'R.F') {
                    $(".tempRowAddRF").remove();

                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + tJobID,
                        success: function (result) {

                            trim = result.replace(/\s+/g, '');
                            if (trim == "No") {
                                alert('Job ID Not Found!');
                                document.getElementById('app_no2').value = '';
                                document.getElementById('app_txt_no2').innerHTML = '';
                                document.getElementById('app_txt_no2').setAttribute("contenteditable", true);

                                document.getElementById('app_no3').value = '';
                                document.getElementById('app_txt_no3').innerHTML = '';
                                document.getElementById('app_txt_no3').setAttribute("contenteditable", true);

                                document.getElementById('app_no4').value = '';
                                document.getElementById('app_txt_no4').innerHTML = '';
                                document.getElementById('app_txt_no4').setAttribute("contenteditable", true);

                                document.getElementById('app_no5').value = '';
                                document.getElementById('app_txt_no5').innerHTML = '';
                                document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                                document.getElementById('app_no6').value = '';
                                document.getElementById('app_txt_no6').innerHTML = '';
                                document.getElementById('app_txt_no6').setAttribute("contenteditable", true);

                                document.getElementById('app_no7').value = '';
                                document.getElementById('app_txt_no7').innerHTML = '';
                                document.getElementById('app_txt_no7').setAttribute("contenteditable", true);

                                document.getElementById('app_no8').value = '';
                                document.getElementById('app_txt_no8').innerHTML = '';
                                document.getElementById('app_txt_no8').setAttribute("contenteditable", true);

                                document.getElementById('app_no9').value = '';
                                document.getElementById('app_txt_no9').innerHTML = '';
                                document.getElementById('app_txt_no9').setAttribute("contenteditable", true);

                                document.getElementById('app_no10').value = '';
                                document.getElementById('app_txt_no10').innerHTML = '';
                                document.getElementById('app_txt_no10').setAttribute("contenteditable", true);

                                document.getElementById('app_no11').value = '';
                                document.getElementById('app_txt_no11').innerHTML = '';
                                document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                            } else if (trim == "Error 3") {
                                alert(trim);
                                document.getElementById('app_no2').value = '';
                                document.getElementById('app_txt_no2').innerHTML = '';
                                document.getElementById('app_txt_no2').setAttribute("contenteditable", true);

                                document.getElementById('app_no3').value = '';
                                document.getElementById('app_txt_no3').innerHTML = '';
                                document.getElementById('app_txt_no3').setAttribute("contenteditable", true);

                                document.getElementById('app_no4').value = '';
                                document.getElementById('app_txt_no4').innerHTML = '';
                                document.getElementById('app_txt_no4').setAttribute("contenteditable", true);

                                document.getElementById('app_no5').value = '';
                                document.getElementById('app_txt_no5').innerHTML = '';
                                document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                                document.getElementById('app_no6').value = '';
                                document.getElementById('app_txt_no6').innerHTML = '';
                                document.getElementById('app_txt_no6').setAttribute("contenteditable", true);

                                document.getElementById('app_no7').value = '';
                                document.getElementById('app_txt_no7').innerHTML = '';
                                document.getElementById('app_txt_no7').setAttribute("contenteditable", true);

                                document.getElementById('app_no8').value = '';
                                document.getElementById('app_txt_no8').innerHTML = '';
                                document.getElementById('app_txt_no8').setAttribute("contenteditable", true);

                                document.getElementById('app_no9').value = '';
                                document.getElementById('app_txt_no9').innerHTML = '';
                                document.getElementById('app_txt_no9').setAttribute("contenteditable", true);

                                document.getElementById('app_no10').value = '';
                                document.getElementById('app_txt_no10').innerHTML = '';
                                document.getElementById('app_txt_no10').setAttribute("contenteditable", true);

                                document.getElementById('app_no11').value = '';
                                document.getElementById('app_txt_no11').innerHTML = '';
                                document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                            } else {
                                var nameArr = result.split(',');
                                var tutorRate = nameArr[0];
                                var parentRate = nameArr[1];
                                var cycle = nameArr[2];
                                var tutorEmail = nameArr[3];
                                var tutorDisplay = nameArr[4];
                                var userAcc = nameArr[5];
                                var RF = nameArr[6];
                                var cycleNo = nameArr[7].replace(/(\r\n|\n|\r)/gm, "");

                                if (cycleNo == 'T.S') {
                                    var stringWithLineBreaks = cycleNo + ' - ' + userAcc;
                                } else {
                                    var stringWithLineBreaks = 'Cycle #' + cycleNo + ' - ' + userAcc;
                                }

                                var stringWithoutLineBreaks = stringWithLineBreaks.replace(/(\r\n|\n|\r)/gm, "");

                                if (RF > 0) {
                                    document.getElementById('app_no2').value = tJobID;
                                    document.getElementById('app_txt_no2').innerHTML = '';
                                    document.getElementById('app_txt_no2').setAttribute("contenteditable", false);

                                    document.getElementById('app_no4').value = RF;
                                    document.getElementById('app_txt_no4').innerHTML = RF;
                                    document.getElementById('app_txt_no4').setAttribute("contenteditable", true);

                                    document.getElementById('app_no5').value = stringWithoutLineBreaks;
                                    document.getElementById('app_txt_no5').innerHTML = stringWithoutLineBreaks;
                                    document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                                    document.getElementById('app_no6').value = '';
                                    document.getElementById('app_txt_no6').innerHTML = '';
                                    document.getElementById('app_txt_no6').setAttribute("onclick", false);
                                    document.getElementById('app_txt_no6').setAttribute("contenteditable", false);

                                    document.getElementById('app_no7').value = '';
                                    document.getElementById('app_txt_no7').innerHTML = '';
                                    document.getElementById('app_txt_no7').setAttribute("contenteditable", false);

                                    document.getElementById('app_no8').value = '';
                                    document.getElementById('app_txt_no8').innerHTML = '';
                                    document.getElementById('app_txt_no8').setAttribute("contenteditable", false);

                                    document.getElementById('app_no9').value = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                    document.getElementById('app_txt_no9').innerHTML = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                    document.getElementById('app_txt_no9').setAttribute("contenteditable", false);

                                    document.getElementById('app_no10').value = '';
                                    document.getElementById('app_txt_no10').innerHTML = '';
                                    document.getElementById('app_txt_no10').setAttribute("contenteditable", false);

                                    document.getElementById('app_no11').value = 'NJ';
                                    document.getElementById('app_txt_no11').innerHTML = 'NJ';
                                    document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                                } else {
                                    document.getElementById('app_no2').value = tJobID;
                                    document.getElementById('app_txt_no2').innerHTML = '';
                                    document.getElementById('app_txt_no2').setAttribute("contenteditable", false);

                                    document.getElementById('app_no4').value = RF;
                                    document.getElementById('app_txt_no4').innerHTML = RF;
                                    document.getElementById('app_txt_no4').setAttribute("contenteditable", true);

                                    document.getElementById('app_no5').value = stringWithoutLineBreaks;
                                    document.getElementById('app_txt_no5').innerHTML = stringWithoutLineBreaks;
                                    document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                                    document.getElementById('app_no6').value = '';
                                    document.getElementById('app_txt_no6').innerHTML = '';
                                    document.getElementById('app_txt_no6').setAttribute("onclick", false);
                                    document.getElementById('app_txt_no6').setAttribute("contenteditable", false);

                                    document.getElementById('app_no7').value = '';
                                    document.getElementById('app_txt_no7').innerHTML = '';
                                    document.getElementById('app_txt_no7').setAttribute("contenteditable", false);

                                    document.getElementById('app_no8').value = '';
                                    document.getElementById('app_txt_no8').innerHTML = '';
                                    document.getElementById('app_txt_no8').setAttribute("contenteditable", false);

                                    document.getElementById('app_no9').value = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                    document.getElementById('app_txt_no9').innerHTML = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                    document.getElementById('app_txt_no9').setAttribute("contenteditable", false);

                                    document.getElementById('app_no10').value = '';
                                    document.getElementById('app_txt_no10').innerHTML = '';
                                    document.getElementById('app_txt_no10').setAttribute("contenteditable", false);

                                    document.getElementById('app_no11').value = 'NJ';
                                    document.getElementById('app_txt_no11').innerHTML = 'NJ';
                                    document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                                }
                            }

                        }
                    });
                } else {
                    document.getElementById('app_txt_no1').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no2').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no3').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no4').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                    document.getElementById('app_txt_no6').setAttribute("onclick", "ChangeThis(this,this.id);");
                    document.getElementById('app_txt_no6').setAttribute("contenteditable", true);

                    document.getElementById('app_txt_no7').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no8').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no9').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no10').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                }
            }, 1000);
        }


        if (thisID === 'app_txt_no4') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountReceived = $(editableObj).text();
                var amountTutor = document.getElementById('app_no7').value;
                document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'app_txt_no8') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountRate = $(editableObj).text();
                var hour = document.getElementById('app_no10').value;
                document.getElementById('app_no4').value = parseFloat((amountRate * hour)).toFixed(2);
                document.getElementById('app_txt_no4').innerHTML = parseFloat((amountRate * hour)).toFixed(2);

                var amountReceived = document.getElementById('app_no4').value;
                var amountTutor = document.getElementById('app_no7').value;
                document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'app_txt_no6') {
            clearTimeout(timer);
            timer = setTimeout(function () {

                if ($(editableObj).text() == '') {
                    document.getElementById('app_no7').value = '';
                    document.getElementById('app_txt_no7').innerHTML = '';

                    document.getElementById('app_no9').value = parseFloat(((document.getElementById('app_no4').value) - (document.getElementById('app_no7').value))).toFixed(2);
                    document.getElementById('app_txt_no9').innerHTML = parseFloat(((document.getElementById('app_no4').value) - (document.getElementById('app_no7').value))).toFixed(2);
                }
            }, 1000);
        }

        if (thisID === 'app_txt_no7') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountTutor = $(editableObj).text();
                var amountReceived = document.getElementById('app_no4').value;
                document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'app_RFtxt_no4') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountReceived = $(editableObj).text();
                var amountTutor = document.getElementById('app_RFno7').value;
                document.getElementById('app_RFno9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_RFtxt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'app_txt_no10') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var hour = $(editableObj).text();
                var amountRate = document.getElementById('app_no8').value;
                document.getElementById('app_no4').value = parseFloat((amountRate * hour)).toFixed(2);
                document.getElementById('app_txt_no4').innerHTML = parseFloat((amountRate * hour)).toFixed(2);

                var amountReceived = document.getElementById('app_no4').value;
                var amountTutor = document.getElementById('app_no7').value;
                document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }
    }

    function app_addToDatabaseCF(newNo) {
        var addRowBetween = 'Yes';
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        var row_no = $("#app_row_no").val();

        var no1 = $("#app_no1").val();
        var no2 = $("#app_no2").val();
        var no3 = $("#app_no3").val();
        var no4 = $("#app_no4").val();
        var no5 = $("#app_no5").val();
        var no6 = $("#app_no6").val();
        var no7 = $("#app_no7").val();
        var no8 = $("#app_no8").val();
        var no9 = $("#app_no9").val();
        var no10 = $("#app_no10").val();
        var no11 = $("#app_no11").val();

        if (($('.tempRowAddRF').length > 0) == true) {
            var thisRF = '&RFno2=' + $("#app_RFno2").val() + '&RFno1=' + $("#app_RFno1").val() + '&RFno3=' + $("#app_RFno3").val() + '&RFno4=' + $("#app_RFno4").val() + '&RFno5=' + $("#app_RFno5").val() + '&RFno6=' + $("#app_RFno6").val() + '&RFno7=' + $("#app_RFno7").val() + '&RFno8=' + $("#app_RFno8").val() + '&RFno9=' + $("#app_RFno9").val() + '&RFno10=' + $("#app_RFno10").val() + '&RFno11=' + $("#app_RFno11").val();
        } else {
            var thisRF = '&RFno2=';
        }

        $(".overlayBG").show();

        $.ajax({
            url: "sale-editable-add-cf.php",
            type: "POST",
            data: 'mainID=' + mainID + '&btnTab=' + btnTab + '&btnTabMonth=' + btnTabMonth + '&addRowBetween=' + addRowBetween + '&row_no=' + row_no + '&no1=' + no1 + '&no2=' + no2 + '&no3=' + no3 + '&no4=' + no4 + '&no5=' + encodeURIComponent(no5) + '&no6=' + no6 + '&no7=' + no7 + '&no8=' + no8 + '&no9=' + no9 + '&no10=' + no10 + '&no11=' + encodeURIComponent(no11) + thisRF,
            success: function (data) {

                $(".overlayBG").hide();
                $("#add-more").show();
                document.getElementById('duplicateBtn').innerHTML = '';

                var trimData = data.trim();
                var numberOnly = trimData.replace(/^\D+/g, '');
                if (numberOnly != '') {
                    if (trimData.includes("R.F")) {
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-table.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                                $.ajax({
                                    type: 'POST',
                                    url: 'sale-load-footer.php',
                                    data: {
                                        dataFooter: {
                                            mainID: mainID,
                                            tab: btnTab,
                                            month: btnTabMonth
                                        },
                                    },
                                    success: function (resultFooter) {
                                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                    }
                                });
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-table.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {

                                document.getElementById("tempModalBody").innerHTML = '<center> <b> Are you sure you want to issue invoice(paid) & email the client? </b> <br/><br/> ' +
                                    ' <button type="button" class="btn btn-primary"   onclick="runReceipt(\'Yes\',\'' + numberOnly + '\')" > Yes</button> ' +
                                    ' <button type="button" class="btn btn-success"   onclick="runReceipt(\'IP\',\'' + numberOnly + '\')"  > IP Only</button> ' +
                                    ' <button type="button" class="btn btn-secondary" onclick="runReceipt(\'No\',\'' + numberOnly + '\')"  > No</button> <br/><br/> <textarea placeholder="Additional Remarks" class="form-control" id="txtAddRemark" rows="3"></textarea> </center> ';
                                $('#tempModal').modal({backdrop: 'static', keyboard: false});

                                document.getElementById("loadSaleData").innerHTML = result;
                                $.ajax({
                                    type: 'POST',
                                    url: 'sale-load-footer.php',
                                    data: {
                                        dataFooter: {
                                            mainID: mainID,
                                            tab: btnTab,
                                            month: btnTabMonth
                                        },
                                    },
                                    success: function (resultFooter) {
                                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                    }
                                });
                            }
                        });
                    }
                } else {
                    alert(trimData);
                }
            }
        });
    }

    function addRowConfirm2(editableObj, column, id, row_no) {
        $("#confirmBox2").hide();
        setTimeout(function () {

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear().toString().substr(-2);
            today = dd + '/' + mm + '/' + yyyy;
            var newNo = (Number(row_no) + 1);

            $('#table-body > tr > td').css('background-color', '#fff');
            $('#table-body2 > tr > td').css('background-color', '#fff');

            var trythis = (Number(row_no) + 1);

            var btmRow = document.getElementById("table-row-" + trythis);
            var btmCells = btmRow.getElementsByTagName("td");

            if (btmCells[3].innerText == 'R.F') {
                var post = (newNo + 1);
                var post2 = (newNo - 1);
            } else {
                var post = newNo;
                var post2 = (row_no - 1);
            }

            $("#add-more").hide();
            document.getElementById('duplicateBtn').innerHTML = '<span id="confirmAdd"><a onClick="app_addToDatabaseCF()" class="ajax-action-links" style="color:#28A745"><b>Save</b></a> / <a onclick="app_cancelAdd();" class="ajax-action-links" style="color:#007BFF"><b>Cancel</b></a></span>';

            var data = '<tr class="table-row tempRowAdd" >' +

                '<td style="font-size:14px;" contenteditable="false" id="app_txt_dataNo" onBlur="addToHiddenField(this,\'app_row_no\')"  onClick="editRow(this);"><font color="blue"><b>' + post + '</b></font></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no1"     onBlur="addToHiddenField(this,\'app_no1\')"     onClick="editRow(this);">' + today + '</td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no2"     onBlur="addToHiddenField(this,\'app_no2\')"     onClick="editRow(this);" onkeyup="app_keyupFunctionCF(this,this.id,' + post + ')"></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no3"     onBlur="addToHiddenField(this,\'app_no3\')"     onClick="editRow(this);" onkeyup="app_keyupFunctionCF(this,this.id,' + post + ')"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no4"     onBlur="addToHiddenField(this,\'app_no4\')"     onClick="editRow(this);" onkeyup="app_keyupFunctionCF(this,this.id)"></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no8"     onBlur="addToHiddenField(this,\'app_no8\')"     onClick="editRow(this);" onkeyup="app_keyupFunctionCF(this,this.id)"></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;border-right: 3px solid black;" contenteditable="true" id="app_txt_no5"     onBlur="addToHiddenField(this,\'app_no5\')"     onClick="editRow(this);"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no6"     onBlur="addToHiddenField(this,\'app_no6\')"     onClick="ChangeThis(this,this.id);" onkeyup="app_keyupFunctionCF(this,this.id)"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no7"     onBlur="addToHiddenField(this,\'app_no7\')"     onClick="ChangeThis(this,this.id);" onkeyup="app_keyupFunctionCF(this,this.id)"></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no9"     onBlur="addToHiddenField(this,\'app_no9\')"     onClick="editRow(this);"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no10"    onBlur="addToHiddenField(this,\'app_no10\')"    onClick="editRow(this);" onkeyup="app_keyupFunctionCF(this,this.id)"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no11"    onBlur="addToHiddenField(this,\'app_no11\')"    onClick="editRow(this);"></td>' +

                '<td style="font-size:14px;" >  <input type="hidden" id="app_row_no" value="' + post + '"/> <input type="hidden" id="app_no1" value="' + today + '"/> <input type="hidden" id="app_no2" /> <input type="hidden" id="app_no3" /> <input type="hidden" id="app_no4" /> <input type="hidden" id="app_no5" /> <input type="hidden" id="app_no6" /> <input type="hidden" id="app_no7" /> <input type="hidden" id="app_no8" /> <input type="hidden" id="app_no9" /> <input type="hidden" id="app_no10" /> <input type="hidden" id="app_no11" />  <span id="confirmAdd"><a onClick="app_addToDatabaseCF()" class="ajax-action-links" style="color:#28A745"><b><i class="fa fa-check" aria-hidden="true"></i></b></a> <a onclick="app_cancelAdd();" class="ajax-action-links" style="color:red"><b><i style="float:right;" class="fa fa-times" aria-hidden="true"></i></b></a></span>  </td>' +
                '</tr>';
            $('table > #table-body > tr').eq(post2).after(data);

        }, 1000);
    }

    function carryForward2(editableObj, column, id, numTable) {
        var userSess = '<?php echo $_SESSION['tk']['u_id'];?>';

        if (userSess == '1' || userSess == '3' || userSess == '8' || userSess == '1579926' || userSess == '1581081') {
            $(".tempRowAdd").remove();
            $(".tempRowAddRF").remove();
            $("#add-more").show();

            document.getElementById('duplicateBtn').innerHTML = '';

            doConfirm2("Please select type :", function yes() {
                    carryForwardConfirm2(editableObj, column, id, numTable);
                }, function no() {
                    addRowConfirm2(editableObj, column, id, numTable);
                }, function cancel() {
                    //alert('cancel');
                }, function undo() {
                    undoCF(editableObj, column, id, numTable);
                    //alert('under development');
                }
            );
        } else {
            alert('Access Denied !');
        }
    }

    function undoCF(editableObj, column, id, numTable) {
        $("#confirmBox2").hide();

        setTimeout(function () {
            var x = confirm("Are you sure you want to undo?");
            if (x == true) {
                $(".overlayBG").show();
                $.ajax({
                    type: 'POST',
                    url: 'sale-process.php',
                    data: {
                        undo: {id: id},
                    },
                    success: function (result) {
                        $(".overlayBG").hide();
                        alert(result);
                    }
                });
            }
        }, 1000);

    }

    function doConfirm2(msg, yesFn, noFn, cnFn, undoFn) {
        var confirmBox = $("#confirmBox2");
        confirmBox.find(".message").text(msg);

        confirmBox.find(".yes,.no,.undo,.cancel").unbind().click(function () {
            confirmBox.hide();
        });

        confirmBox.find(".yes").click(yesFn);
        confirmBox.find(".no").click(noFn);
        confirmBox.find(".undo").click(undoFn);
        confirmBox.find(".cancel").click(cnFn);
        confirmBox.show();
    }

    function carryForwardConfirm2(editableObj, column, id, numTable) {
        debugger;
        let mainID = document.getElementById('mainID').value;
        let btnTab = $(".btnTab.active").text();
        let btnTabMonth = $(".btnTabMonth.active").text();
        let trythis = (Number(numTable) + 1);

        let RF = null;
        let btmRow = document.getElementById("table-row-" + trythis);

        if(btmRow !==null) {
            let btmCells = btmRow.getElementsByTagName("td");

            if (btmCells[3].innerText == 'R.F') {
                RF = 'Yes';
            } else {
                RF = 'No';
            }
        } else {
            RF = 'No';
        }

        $("#confirmBox2").hide();
        setTimeout(function () {
            let x = confirm("Are you sure you want to carry forward?");

            if (x == true) {
                $(".overlayBG").show();
                $.ajax({
                    type: 'POST',
                    url: 'sale-process.php',
                    data: {
                        carryForward2: {id: id, RF:RF},
                    },
                    success: function (result) {
                        $(".overlayBG").hide();
                        if (result == 'Success') {
                            $.ajax({
                                type: 'POST',
                                url: 'sale-load-table.php',
                                data: {
                                    dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                                },
                                success: function (result) {
                                    document.getElementById("loadSaleData").innerHTML = result;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'sale-load-footer.php',
                                        data: {
                                            dataFooter: {
                                                mainID: mainID,
                                                tab: btnTab,
                                                month: btnTabMonth
                                            },
                                        },
                                        success: function (resultFooter) {
                                            document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                        }
                                    });
                                }
                            });
                        } else {
                            alert(result);
                        }
                    }
                });
            }
        }, 1000);
    }

    function carryForwardLastRow(editableObj, column, id, numTable) {
        var userSess = '<?php echo $_SESSION['tk']['u_id'];?>';
        if (userSess == '1' || userSess == '3' || userSess == '8' || userSess == '1579926' || userSess == '1581081') {
            $(".tempRowAdd").remove();
            $(".tempRowAddRF").remove();
            $("#add-more").show();
            document.getElementById('duplicateBtn').innerHTML = '';

            doConfirmLastRow("Please select type :", function yes() {
                carryForwardLastRowConfirm(editableObj, column, id, numTable);
            }, function cancel() {
                //alert('cancel');
            });
        } else {
            alert('Access Denied !');
        }
    }

    function doConfirmLastRow(msg, yesFn, cnFn) {
        var confirmBox = $("#confirmBoxLastRow");

        confirmBox.find(".message").text(msg);

        confirmBox.find(".yes,.cancel").unbind().click(function () {
            confirmBox.hide();
        });

        confirmBox.find(".yes").click(yesFn);
        confirmBox.find(".cancel").click(cnFn);
        confirmBox.show();
    }

    function carryForwardLastRowConfirm(editableObj, column, id, numTable) {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();
        var trythis = (Number(numTable) + 1);
        var btmRow = document.getElementById("table-rowOri-" + trythis);

        if (btmRow > 0) {
            var btmCells = btmRow.getElementsByTagName("td");
            if (btmCells[3].innerText == 'R.F') {
                var RF = 'Yes';
            } else {
                var RF = 'No';
            }
        } else {
            var RF = 'No';
        }

        $("#confirmBoxLastRow").hide();
        setTimeout(function () {
            var x = confirm("Are you sure you want to carry forward?");
            if (x == true) {
                $(".overlayBG").show();
                $.ajax({
                    type: 'POST',
                    url: 'sale-process.php',
                    data: {
                        carryForward: {id: id, RF: RF},
                    },
                    success: function (result) {
                        $(".overlayBG").hide();
                        if (result == 'Success') {
                            $.ajax({
                                type: 'POST',
                                url: 'sale-load-table.php',
                                data: {
                                    dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                                },
                                success: function (result) {
                                    document.getElementById("loadSaleData").innerHTML = result;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'sale-load-footer.php',
                                        data: {
                                            dataFooter: {
                                                mainID: mainID,
                                                tab: btnTab,
                                                month: btnTabMonth
                                            },
                                        },
                                        success: function (resultFooter) {
                                            document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                        }
                                    });
                                }
                            });
                        } else {
                            alert(result);
                        }
                    }
                });
            }
        }, 1000);
    }

    function carryForward(editableObj, column, id, numTable) {
        var userSess = '<?php echo $_SESSION['tk']['u_id'];?>';
        if (userSess == '1' || userSess == '3' || userSess == '8' || userSess == '1579926' || userSess == '1581081') {
            $(".tempRowAdd").remove();
            $(".tempRowAddRF").remove();
            $("#add-more").show();
            document.getElementById('duplicateBtn').innerHTML = '';

            doConfirm("Please select type :", function yes() {
                carryForwardConfirm(editableObj, column, id, numTable);
            }, function no() {
                addRowConfirm(editableObj, column, id, numTable);
            }, function cancel() {
                //alert('cancel');
            });
        } else {
            alert('Access Denied !');
        }
    }

    function doConfirm(msg, yesFn, noFn, cnFn) {
        var confirmBox = $("#confirmBox");
        confirmBox.find(".message").text(msg);

        confirmBox.find(".yes,.no,.cancel").unbind().click(function () {
            confirmBox.hide();
        });

        confirmBox.find(".yes").click(yesFn);
        confirmBox.find(".no").click(noFn);
        confirmBox.find(".cancel").click(cnFn);
        confirmBox.show();
    }

    function carryForwardConfirm(editableObj, column, id, numTable) {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();
        var trythis = (Number(numTable) + 1);

        var btmRow = document.getElementById("table-rowOri-" + trythis);
        var btmCells = btmRow.getElementsByTagName("td");

        if (btmCells[3].innerText == 'R.F') {
            var RF = 'Yes';
        } else {
            var RF = 'No';
        }

        $("#confirmBox").hide();
        setTimeout(function () {
            var x = confirm("Are you sure you want to carry forward?");

            if (x == true) {
                $(".overlayBG").show();
                $.ajax({
                    type: 'POST',
                    url: 'sale-process.php',
                    data: {
                        carryForward: {id: id, RF: RF},
                    },
                    success: function (result) {
                        $(".overlayBG").hide();
                        if (result == 'Success') {
                            $.ajax({
                                type: 'POST',
                                url: 'sale-load-table.php',
                                data: {
                                    dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                                },
                                success: function (result) {
                                    document.getElementById("loadSaleData").innerHTML = result;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'sale-load-footer.php',
                                        data: {
                                            dataFooter: {
                                                mainID: mainID,
                                                tab: btnTab,
                                                month: btnTabMonth
                                            },
                                        },
                                        success: function (resultFooter) {
                                            document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                        }
                                    });
                                }
                            });
                        } else {
                            alert(result);
                        }
                    }
                });
            }
        }, 1000);
    }

    function app_cancelAdd(newNo) {
        $("#add-more").show();
        $(".tempRowAdd").remove();
        document.getElementById('duplicateBtn').innerHTML = '';
    }

    function app_RemoveAdd() {
        $(".tempRowAddRF").remove();
    }

    function app_addToDatabase(newNo) {
        var addRowBetween = 'Yes';
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        var row_no = $("#app_row_no").val();

        var no1 = $("#app_no1").val();
        var no2 = $("#app_no2").val();
        var no3 = $("#app_no3").val();
        var no4 = $("#app_no4").val();
        var no5 = $("#app_no5").val();
        var no6 = $("#app_no6").val();
        var no7 = $("#app_no7").val();
        var no8 = $("#app_no8").val();
        var no9 = $("#app_no9").val();
        var no10 = $("#app_no10").val();
        var no11 = $("#app_no11").val();

        if (($('.tempRowAddRF').length > 0) == true) {
            var thisRF = '&RFno2=' + $("#app_RFno2").val() + '&RFno1=' + $("#app_RFno1").val() + '&RFno3=' + $("#app_RFno3").val() + '&RFno4=' + $("#app_RFno4").val() + '&RFno5=' + $("#app_RFno5").val() + '&RFno6=' + $("#app_RFno6").val() + '&RFno7=' + $("#app_RFno7").val() + '&RFno8=' + $("#app_RFno8").val() + '&RFno9=' + $("#app_RFno9").val() + '&RFno10=' + $("#app_RFno10").val() + '&RFno11=' + $("#app_RFno11").val();
        } else {
            var thisRF = '&RFno2=';
        }

        $(".overlayBG").show();

        $.ajax({
            url: "sale-editable-add.php",
            type: "POST",
            data: 'mainID=' + mainID + '&btnTab=' + btnTab + '&btnTabMonth=' + btnTabMonth + '&addRowBetween=' + addRowBetween + '&row_no=' + row_no + '&no1=' + no1 + '&no2=' + no2 + '&no3=' + no3 + '&no4=' + no4 + '&no5=' + encodeURIComponent(no5) + '&no6=' + no6 + '&no7=' + no7 + '&no8=' + no8 + '&no9=' + no9 + '&no10=' + no10 + '&no11=' + encodeURIComponent(no11) + thisRF,
            success: function (data) {

                $(".overlayBG").hide();
                $("#add-more").show();
                document.getElementById('duplicateBtn').innerHTML = '';

                var trimData = data.trim();
                var numberOnly = trimData.replace(/^\D+/g, '');

                if (numberOnly != '') {
                    if (trimData.includes("R.F")) {
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-table.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                                $.ajax({
                                    type: 'POST',
                                    url: 'sale-load-footer.php',
                                    data: {
                                        dataFooter: {
                                            mainID: mainID,
                                            tab: btnTab,
                                            month: btnTabMonth
                                        },
                                    },
                                    success: function (resultFooter) {
                                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                    }
                                });
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-table.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {

                                document.getElementById("tempModalBody").innerHTML = '<center> <b> Are you sure you want to issue invoice(paid) & email the client? </b> <br/><br/> ' +
                                    ' <button type="button" class="btn btn-primary"   onclick="runReceipt(\'Yes\',\'' + numberOnly + '\')" > Yes</button> ' +
                                    ' <button type="button" class="btn btn-success"   onclick="runReceipt(\'IP\',\'' + numberOnly + '\')"  > IP Only</button> ' +
                                    ' <button type="button" class="btn btn-secondary" onclick="runReceipt(\'No\',\'' + numberOnly + '\')"  > No</button> <br/><br/> <textarea placeholder="Additional Remarks" class="form-control" id="txtAddRemark" rows="3"></textarea> </center> ';
                                $('#tempModal').modal({backdrop: 'static', keyboard: false});

                                document.getElementById("loadSaleData").innerHTML = result;

                                $.ajax({
                                    type: 'POST',
                                    url: 'sale-load-footer.php',
                                    data: {
                                        dataFooter: {
                                            mainID: mainID,
                                            tab: btnTab,
                                            month: btnTabMonth
                                        },
                                    },
                                    success: function (resultFooter) {
                                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                    }
                                });
                            }
                        });
                    }
                } else {
                    alert(trimData);
                }
            }
        });
    }

    function app_keyupFunction(editableObj, thisID, newNo) {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear().toString().substr(-2);
        today = dd + '/' + mm + '/' + yyyy;
        var newNo = (Number(newNo) + 1);

        if (thisID === 'app_txt_no2') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var JobID = $(editableObj).text();

                if (JobID == '') {
                    $(".tempRowAddRF").remove();
                    document.getElementById('app_no3').value = '';
                    document.getElementById('app_txt_no3').innerHTML = '';

                    document.getElementById('app_no4').value = '';
                    document.getElementById('app_txt_no4').innerHTML = '';

                    document.getElementById('app_no5').value = '';
                    document.getElementById('app_txt_no5').innerHTML = '';

                    document.getElementById('app_no6').value = '';
                    document.getElementById('app_txt_no6').innerHTML = '';

                    document.getElementById('app_no7').value = '';
                    document.getElementById('app_txt_no7').innerHTML = '';

                    document.getElementById('app_no9').value = '';
                    document.getElementById('app_txt_no9').innerHTML = '';

                    document.getElementById('app_no10').value = '';
                    document.getElementById('app_txt_no10').innerHTML = '';

                    document.getElementById('app_no11').value = '';
                    document.getElementById('app_txt_no11').innerHTML = '';
                } else {
                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + JobID,
                        success: function (result) {
                            trim = result.replace(/\s+/g, '');
                            if (trim == "No") {
                                $(".tempRowAddRF").remove();
                                document.getElementById('app_no3').value = '';
                                document.getElementById('app_txt_no3').innerHTML = '';

                                document.getElementById('app_no4').value = '';
                                document.getElementById('app_txt_no4').innerHTML = '';

                                document.getElementById('app_no5').value = '';
                                document.getElementById('app_txt_no5').innerHTML = '';

                                document.getElementById('app_no6').value = '';
                                document.getElementById('app_txt_no6').innerHTML = '';

                                document.getElementById('app_no7').value = '';
                                document.getElementById('app_txt_no7').innerHTML = '';

                                document.getElementById('app_no9').value = '';
                                document.getElementById('app_txt_no9').innerHTML = '';

                                document.getElementById('app_no10').value = '';
                                document.getElementById('app_txt_no10').innerHTML = '';

                                document.getElementById('app_no11').value = '';
                                document.getElementById('app_txt_no11').innerHTML = '';
                            } else if (trim == "Error 3") {
                                alert(trim);
                            } else {
                                var nameArr = result.split(',');
                                var tutorRate = nameArr[0];
                                var parentRate = nameArr[1];
                                var cycle = nameArr[2];
                                var tutorEmail = nameArr[3];
                                var tutorDisplay = nameArr[4];
                                var userAcc = nameArr[5];
                                var RF = nameArr[6];
                                var cycleNo = nameArr[7].replace(/(\r\n|\n|\r)/gm, "");

                                if (cycleNo == 'T.S') {
                                    var stringWithLineBreaks = cycleNo + ' - ' + userAcc;
                                } else {
                                    var stringWithLineBreaks = 'Cycle #' + cycleNo + ' - ' + userAcc;
                                }
                                var stringWithoutLineBreaks = stringWithLineBreaks.replace(/(\r\n|\n|\r)/gm, "");

                                if (RF > 0) {
                                    var data = '<tr class="table-row tempRowAdd tempRowAddRF">' +

                                        '<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_dataNo" onBlur="addToHiddenField(this,\'app_RFrow_no\')" onClick="editRow(this);"><font color="blue"><b>' + newNo + '</font></b></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="app_RFtxt_no1"    onBlur="addToHiddenField(this,\'app_RFno1\')"    onClick="editRow(this);">' + today + '</td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no2"    onBlur="addToHiddenField(this,\'app_RFno2\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no3"    onBlur="addToHiddenField(this,\'app_RFno3\')"    onClick="editRow(this);">R.F</td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="app_RFtxt_no4"    onBlur="addToHiddenField(this,\'app_RFno4\')"    onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id)">' + RF + '</td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no8"    onBlur="addToHiddenField(this,\'app_RFno8\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="app_RFtxt_no5"    onBlur="addToHiddenField(this,\'app_RFno5\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no6"    onBlur="addToHiddenField(this,\'app_RFno6\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no7"    onBlur="addToHiddenField(this,\'app_RFno7\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no9"    onBlur="addToHiddenField(this,\'app_RFno9\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="app_RFtxt_no10"   onBlur="addToHiddenField(this,\'app_RFno10\')"   onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="app_RFtxt_no11"   onBlur="addToHiddenField(this,\'app_RFno11\')"   onClick="editRow(this);">NJ</td>' +


                                        '<td style="font-size:14px;" >  <input type="hidden" id="app_RFrow_no" value="' + newNo + '" /> <input type="hidden" id="app_RFno1" value="' + today + '"/> <input type="hidden" id="app_RFno2" value="' + JobID + '"/> <input type="hidden" id="app_RFno3" value="R.F"/> <input type="hidden" id="app_RFno4" value="' + RF + '" /> <input type="hidden" id="app_RFno5" /> <input type="hidden" id="app_RFno6" /> <input type="hidden" id="app_RFno7" /> <input type="hidden" id="app_RFno8" /> <input type="hidden" id="app_RFno9" /> <input type="hidden" id="app_RFno10" /> <input type="hidden" id="app_RFno11" value="NJ"/>  <span id="confirmAdd"><a onclick="app_RemoveAdd();" class="ajax-action-links" style="color:red"><b>Remove</b></a></span>  </td>' +
                                        '</tr>';

                                    $('table > #table-body2 > tr').eq(newNo - 2).after(data);

                                    document.getElementById('app_RFno5').value = stringWithoutLineBreaks;
                                    document.getElementById('app_RFtxt_no5').innerHTML = stringWithoutLineBreaks;

                                    document.getElementById('app_no6').value = '';
                                    document.getElementById('app_txt_no6').innerHTML = '';

                                    document.getElementById('app_no7').value = '';
                                    document.getElementById('app_txt_no7').innerHTML = '';

                                    document.getElementById('app_RFno9').value = parseFloat((document.getElementById('app_RFno4').value - document.getElementById('app_RFno7').value)).toFixed(2);
                                    document.getElementById('app_RFtxt_no9').innerHTML = parseFloat((document.getElementById('app_RFno4').value - document.getElementById('app_RFno7').value)).toFixed(2);
                                } else {
                                    $(".tempRowAddRF").remove();
                                }

                                document.getElementById('app_no3').value = tutorDisplay;
                                document.getElementById('app_txt_no3').innerHTML = tutorDisplay;

                                document.getElementById('app_no4').value = parseFloat((parentRate * cycle)).toFixed(2);
                                document.getElementById('app_txt_no4').innerHTML = parseFloat((parentRate * cycle)).toFixed(2);

                                document.getElementById('app_no8').value = parseFloat(parentRate).toFixed(2);
                                document.getElementById('app_txt_no8').innerHTML = parseFloat(parentRate).toFixed(2);

                                document.getElementById('app_no5').value = stringWithoutLineBreaks;
                                document.getElementById('app_txt_no5').innerHTML = stringWithoutLineBreaks;

                                document.getElementById('app_no6').value = '';
                                document.getElementById('app_txt_no6').innerHTML = '';

                                document.getElementById('app_no7').value = '';
                                document.getElementById('app_txt_no7').innerHTML = '';

                                document.getElementById('app_no9').value = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                document.getElementById('app_txt_no9').innerHTML = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);

                                document.getElementById('app_no10').value = cycle;
                                document.getElementById('app_txt_no10').innerHTML = cycle;

                                document.getElementById('app_no11').value = '';
                                document.getElementById('app_txt_no11').innerHTML = '';
                            }
                        }
                    });
                }
            }, 1000);
        }

        if (thisID === 'app_txt_no3') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var tutorName = $(editableObj).text();
                var Row = document.getElementById("table-row-" + (newNo - 2));
                var Cells = Row.getElementsByTagName("td");
                var tJobID = Cells[2].innerText;

                if (tutorName == 'R.F') {
                    $(".tempRowAddRF").remove();

                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + tJobID,
                        success: function (result) {

                            trim = result.replace(/\s+/g, '');
                            if (trim == "No") {
                                alert('Job ID Not Found!');
                                document.getElementById('app_no2').value = '';
                                document.getElementById('app_txt_no2').innerHTML = '';
                                document.getElementById('app_txt_no2').setAttribute("contenteditable", true);

                                document.getElementById('app_no3').value = '';
                                document.getElementById('app_txt_no3').innerHTML = '';
                                document.getElementById('app_txt_no3').setAttribute("contenteditable", true);

                                document.getElementById('app_no4').value = '';
                                document.getElementById('app_txt_no4').innerHTML = '';
                                document.getElementById('app_txt_no4').setAttribute("contenteditable", true);

                                document.getElementById('app_no5').value = '';
                                document.getElementById('app_txt_no5').innerHTML = '';
                                document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                                document.getElementById('app_no6').value = '';
                                document.getElementById('app_txt_no6').innerHTML = '';
                                document.getElementById('app_txt_no6').setAttribute("contenteditable", true);

                                document.getElementById('app_no7').value = '';
                                document.getElementById('app_txt_no7').innerHTML = '';
                                document.getElementById('app_txt_no7').setAttribute("contenteditable", true);

                                document.getElementById('app_no8').value = '';
                                document.getElementById('app_txt_no8').innerHTML = '';
                                document.getElementById('app_txt_no8').setAttribute("contenteditable", true);

                                document.getElementById('app_no9').value = '';
                                document.getElementById('app_txt_no9').innerHTML = '';
                                document.getElementById('app_txt_no9').setAttribute("contenteditable", true);

                                document.getElementById('app_no10').value = '';
                                document.getElementById('app_txt_no10').innerHTML = '';
                                document.getElementById('app_txt_no10').setAttribute("contenteditable", true);

                                document.getElementById('app_no11').value = '';
                                document.getElementById('app_txt_no11').innerHTML = '';
                                document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                            } else if (trim == "Error 3") {
                                alert(trim);
                                document.getElementById('app_no2').value = '';
                                document.getElementById('app_txt_no2').innerHTML = '';
                                document.getElementById('app_txt_no2').setAttribute("contenteditable", true);

                                document.getElementById('app_no3').value = '';
                                document.getElementById('app_txt_no3').innerHTML = '';
                                document.getElementById('app_txt_no3').setAttribute("contenteditable", true);

                                document.getElementById('app_no4').value = '';
                                document.getElementById('app_txt_no4').innerHTML = '';
                                document.getElementById('app_txt_no4').setAttribute("contenteditable", true);

                                document.getElementById('app_no5').value = '';
                                document.getElementById('app_txt_no5').innerHTML = '';
                                document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                                document.getElementById('app_no6').value = '';
                                document.getElementById('app_txt_no6').innerHTML = '';
                                document.getElementById('app_txt_no6').setAttribute("contenteditable", true);

                                document.getElementById('app_no7').value = '';
                                document.getElementById('app_txt_no7').innerHTML = '';
                                document.getElementById('app_txt_no7').setAttribute("contenteditable", true);

                                document.getElementById('app_no8').value = '';
                                document.getElementById('app_txt_no8').innerHTML = '';
                                document.getElementById('app_txt_no8').setAttribute("contenteditable", true);

                                document.getElementById('app_no9').value = '';
                                document.getElementById('app_txt_no9').innerHTML = '';
                                document.getElementById('app_txt_no9').setAttribute("contenteditable", true);

                                document.getElementById('app_no10').value = '';
                                document.getElementById('app_txt_no10').innerHTML = '';
                                document.getElementById('app_txt_no10').setAttribute("contenteditable", true);

                                document.getElementById('app_no11').value = '';
                                document.getElementById('app_txt_no11').innerHTML = '';
                                document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                            } else {
                                var nameArr = result.split(',');
                                var tutorRate = nameArr[0];
                                var parentRate = nameArr[1];
                                var cycle = nameArr[2];
                                var tutorEmail = nameArr[3];
                                var tutorDisplay = nameArr[4];
                                var userAcc = nameArr[5];
                                var RF = nameArr[6];
                                var cycleNo = nameArr[7].replace(/(\r\n|\n|\r)/gm, "");

                                if (cycleNo == 'T.S') {
                                    var stringWithLineBreaks = cycleNo + ' - ' + userAcc;
                                } else {
                                    var stringWithLineBreaks = 'Cycle #' + cycleNo + ' - ' + userAcc;
                                }

                                var stringWithoutLineBreaks = stringWithLineBreaks.replace(/(\r\n|\n|\r)/gm, "");

                                if (RF > 0) {
                                    document.getElementById('app_no2').value = tJobID;
                                    document.getElementById('app_txt_no2').innerHTML = '';
                                    document.getElementById('app_txt_no2').setAttribute("contenteditable", false);

                                    document.getElementById('app_no4').value = RF;
                                    document.getElementById('app_txt_no4').innerHTML = RF;
                                    document.getElementById('app_txt_no4').setAttribute("contenteditable", true);

                                    document.getElementById('app_no5').value = stringWithoutLineBreaks;
                                    document.getElementById('app_txt_no5').innerHTML = stringWithoutLineBreaks;
                                    document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                                    document.getElementById('app_no6').value = '';
                                    document.getElementById('app_txt_no6').innerHTML = '';
                                    document.getElementById('app_txt_no6').setAttribute("onclick", false);
                                    document.getElementById('app_txt_no6').setAttribute("contenteditable", false);

                                    document.getElementById('app_no7').value = '';
                                    document.getElementById('app_txt_no7').innerHTML = '';
                                    document.getElementById('app_txt_no7').setAttribute("contenteditable", false);

                                    document.getElementById('app_no8').value = '';
                                    document.getElementById('app_txt_no8').innerHTML = '';
                                    document.getElementById('app_txt_no8').setAttribute("contenteditable", false);

                                    document.getElementById('app_no9').value = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                    document.getElementById('app_txt_no9').innerHTML = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                    document.getElementById('app_txt_no9').setAttribute("contenteditable", false);

                                    document.getElementById('app_no10').value = '';
                                    document.getElementById('app_txt_no10').innerHTML = '';
                                    document.getElementById('app_txt_no10').setAttribute("contenteditable", false);

                                    document.getElementById('app_no11').value = 'NJ';
                                    document.getElementById('app_txt_no11').innerHTML = 'NJ';
                                    document.getElementById('app_txt_no11').setAttribute("contenteditable", true);

                                } else {
                                    document.getElementById('app_no2').value = tJobID;
                                    document.getElementById('app_txt_no2').innerHTML = '';
                                    document.getElementById('app_txt_no2').setAttribute("contenteditable", false);

                                    document.getElementById('app_no4').value = RF;
                                    document.getElementById('app_txt_no4').innerHTML = RF;
                                    document.getElementById('app_txt_no4').setAttribute("contenteditable", true);

                                    document.getElementById('app_no5').value = stringWithoutLineBreaks;
                                    document.getElementById('app_txt_no5').innerHTML = stringWithoutLineBreaks;
                                    document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                                    document.getElementById('app_no6').value = '';
                                    document.getElementById('app_txt_no6').innerHTML = '';
                                    document.getElementById('app_txt_no6').setAttribute("onclick", false);
                                    document.getElementById('app_txt_no6').setAttribute("contenteditable", false);

                                    document.getElementById('app_no7').value = '';
                                    document.getElementById('app_txt_no7').innerHTML = '';
                                    document.getElementById('app_txt_no7').setAttribute("contenteditable", false);

                                    document.getElementById('app_no8').value = '';
                                    document.getElementById('app_txt_no8').innerHTML = '';
                                    document.getElementById('app_txt_no8').setAttribute("contenteditable", false);

                                    document.getElementById('app_no9').value = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                    document.getElementById('app_txt_no9').innerHTML = parseFloat((document.getElementById('app_no4').value - document.getElementById('app_no7').value)).toFixed(2);
                                    document.getElementById('app_txt_no9').setAttribute("contenteditable", false);

                                    document.getElementById('app_no10').value = '';
                                    document.getElementById('app_txt_no10').innerHTML = '';
                                    document.getElementById('app_txt_no10').setAttribute("contenteditable", false);

                                    document.getElementById('app_no11').value = 'NJ';
                                    document.getElementById('app_txt_no11').innerHTML = 'NJ';
                                    document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                                }
                            }

                        }
                    });
                } else {
                    document.getElementById('app_txt_no1').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no2').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no3').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no4').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                    document.getElementById('app_txt_no6').setAttribute("onclick", "ChangeThis(this,this.id);");
                    document.getElementById('app_txt_no6').setAttribute("contenteditable", true);

                    document.getElementById('app_txt_no7').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no8').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no9').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no10').setAttribute("contenteditable", true);
                    document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
                }
            }, 1000);
        }

        if (thisID === 'app_txt_no4') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountReceived = $(editableObj).text();
                var amountTutor = document.getElementById('app_no7').value;
                document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'app_txt_no8') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountRate = $(editableObj).text();
                var hour = document.getElementById('app_no10').value;
                document.getElementById('app_no4').value = parseFloat((amountRate * hour)).toFixed(2);
                document.getElementById('app_txt_no4').innerHTML = parseFloat((amountRate * hour)).toFixed(2);

                var amountReceived = document.getElementById('app_no4').value;
                var amountTutor = document.getElementById('app_no7').value;
                document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'app_txt_no6') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if ($(editableObj).text() == '') {
                    document.getElementById('app_no7').value = '';
                    document.getElementById('app_txt_no7').innerHTML = '';

                    document.getElementById('app_no9').value = parseFloat(((document.getElementById('app_no4').value) - (document.getElementById('app_no7').value))).toFixed(2);
                    document.getElementById('app_txt_no9').innerHTML = parseFloat(((document.getElementById('app_no4').value) - (document.getElementById('app_no7').value))).toFixed(2);
                }
            }, 1000);
        }

        if (thisID === 'app_txt_no7') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountTutor = $(editableObj).text();
                var amountReceived = document.getElementById('app_no4').value;
                document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'app_RFtxt_no4') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountReceived = $(editableObj).text();
                var amountTutor = document.getElementById('app_RFno7').value;
                document.getElementById('app_RFno9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_RFtxt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'app_txt_no10') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var hour = $(editableObj).text();
                var amountRate = document.getElementById('app_no8').value;
                document.getElementById('app_no4').value = parseFloat((amountRate * hour)).toFixed(2);
                document.getElementById('app_txt_no4').innerHTML = parseFloat((amountRate * hour)).toFixed(2);

                var amountReceived = document.getElementById('app_no4').value;
                var amountTutor = document.getElementById('app_no7').value;
                document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }
    }

    function ChangeThis(editableObj, thisID) {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear().toString().substr(-2);
        today = dd + '/' + mm + '/' + yyyy;

        if (thisID === 'app_txt_no6') {
            if ($(editableObj).text() == '') {
                document.getElementById('app_no6').value = today;
                document.getElementById('app_txt_no6').innerHTML = today;
            }

            var GetJob = document.getElementById("app_no2").value
            var rowPaid = document.getElementById("app_no7").value

            if (GetJob != '') {
                if (rowPaid === '') {
                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + GetJob,
                        success: function (result) {
                            trim = result.replace(/\s+/g, '');
                            if (trim == "No") {
                                alert(trim);
                            } else if (trim == "Error 3") {
                                alert(trim);
                            } else {
                                var nameArr = trim.split(',');
                                var tutorRate = nameArr[0];
                                var cycle = nameArr[2];
                                var matches = tutorRate.match(/[+-]?\d+(?:\.\d+)?/);

                                document.getElementById('app_no7').value = parseFloat(((matches[0]) * cycle)).toFixed(2);
                                document.getElementById('app_txt_no7').innerHTML = parseFloat(((matches[0]) * cycle)).toFixed(2);

                                document.getElementById('app_no9').value = parseFloat(((document.getElementById('app_no4').value) - (parseFloat(((matches[0]) * cycle)).toFixed(2)))).toFixed(2);
                                document.getElementById('app_txt_no9').innerHTML = parseFloat(((document.getElementById('app_no4').value) - (parseFloat(((matches[0]) * cycle)).toFixed(2)))).toFixed(2);
                            }

                        }
                    });
                }
            }
        }

        if (thisID === 'txt_no6') {
            if ($(editableObj).text() == '') {
                document.getElementById('no6').value = today;
                document.getElementById('txt_no6').innerHTML = today;
            }

            var GetJob = document.getElementById("no2").value
            var rowPaid = document.getElementById("no7").value

            if (GetJob != '') {
                if (rowPaid === '') {
                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + GetJob,
                        success: function (result) {
                            trim = result.replace(/\s+/g, '');
                            if (trim == "No") {
                                alert(trim);
                            } else if (trim == "Error 3") {
                                alert(trim);
                            } else {
                                var nameArr = trim.split(',');
                                var tutorRate = nameArr[0];
                                var cycle = nameArr[2];
                                var matches = tutorRate.match(/[+-]?\d+(?:\.\d+)?/);

                                document.getElementById('no7').value = parseFloat(((matches[0]) * cycle)).toFixed(2);
                                document.getElementById('txt_no7').innerHTML = parseFloat(((matches[0]) * cycle)).toFixed(2);

                                document.getElementById('no9').value = parseFloat(((document.getElementById('no4').value) - (parseFloat(((matches[0]) * cycle)).toFixed(2)))).toFixed(2);
                                document.getElementById('txt_no9').innerHTML = parseFloat(((document.getElementById('no4').value) - (parseFloat(((matches[0]) * cycle)).toFixed(2)))).toFixed(2);
                            }
                        }
                    });
                }
            }
        }
    }

    function addRowConfirm(editableObj, column, id, row_no) {
        $("#confirmBox").hide();
        $(".tempRowAdd").remove();

        setTimeout(function () {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear().toString().substr(-2);
            today = dd + '/' + mm + '/' + yyyy;
            var newNo = (Number(row_no) + 1);

            $('#table-body > tr > td').css('background-color', '#fff');
            $('#table-body2 > tr > td').css('background-color', '#fff');

            var trythis = (Number(row_no) + 1);
            var btmRow = document.getElementById("table-rowOri-" + trythis);
            var btmCells = btmRow.getElementsByTagName("td");

            if (btmCells[3].innerText == 'R.F') {
                var post = (newNo + 1);
                var post2 = (newNo - 1);
            } else {
                var post = newNo;
                var post2 = (row_no - 1);
            }

            $("#add-more").hide();
            document.getElementById('duplicateBtn').innerHTML = '<span id="confirmAdd"><a onClick="app_addToDatabase()" class="ajax-action-links" style="color:#28A745"><b>Save</b></a> / <a onclick="app_cancelAdd();" class="ajax-action-links" style="color:#007BFF"><b>Cancel</b></a></span>';

            var data = '<tr class="table-row tempRowAdd" >' +

                '<td style="font-size:14px;" contenteditable="false" id="app_txt_dataNo" onBlur="addToHiddenField(this,\'app_row_no\')"  onClick="editRow(this);"><font color="blue"><b>' + post + '</b></font></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no1"     onBlur="addToHiddenField(this,\'app_no1\')"     onClick="editRow(this);">' + today + '</td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no2"     onBlur="addToHiddenField(this,\'app_no2\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id,' + post + ')"></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no3"     onBlur="addToHiddenField(this,\'app_no3\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id,' + post + ')"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no4"     onBlur="addToHiddenField(this,\'app_no4\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id)"></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no8"     onBlur="addToHiddenField(this,\'app_no8\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id)"></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;border-right: 3px solid black;" contenteditable="true" id="app_txt_no5"     onBlur="addToHiddenField(this,\'app_no5\')"     onClick="editRow(this);"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no6"     onBlur="addToHiddenField(this,\'app_no6\')"     onClick="ChangeThis(this,this.id);" onkeyup="app_keyupFunction(this,this.id)"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no7"     onBlur="addToHiddenField(this,\'app_no7\')"     onClick="ChangeThis(this,this.id);" onkeyup="app_keyupFunction(this,this.id)"></td>' +

                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no9"     onBlur="addToHiddenField(this,\'app_no9\')"     onClick="editRow(this);"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no10"    onBlur="addToHiddenField(this,\'app_no10\')"    onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id)"></td>' +
                '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="app_txt_no11"    onBlur="addToHiddenField(this,\'app_no11\')"    onClick="editRow(this);"></td>' +


                '<td style="font-size:14px;" >  <input type="hidden" id="app_row_no" value="' + post + '"/> <input type="hidden" id="app_no1" value="' + today + '"/> <input type="hidden" id="app_no2" /> <input type="hidden" id="app_no3" /> <input type="hidden" id="app_no4" /> <input type="hidden" id="app_no5" /> <input type="hidden" id="app_no6" /> <input type="hidden" id="app_no7" /> <input type="hidden" id="app_no8" /> <input type="hidden" id="app_no9" /> <input type="hidden" id="app_no10" /> <input type="hidden" id="app_no11" />  <span id="confirmAdd"><a onClick="app_addToDatabase()" class="ajax-action-links" style="color:#28A745"><b><i class="fa fa-check" aria-hidden="true"></i></b></a> <a onclick="app_cancelAdd();" class="ajax-action-links" style="color:red"><b><i style="float:right;" class="fa fa-times" aria-hidden="true"></i></b></a></span>  </td>' +
                '</tr>';
            $('table > #table-body2 > tr').eq(post2).after(data);

        }, 1000);
    }

    function cancelAdd() {
        $("#add-more").show();
        $(".tempRowAdd").remove();
        document.getElementById('duplicateBtn').innerHTML = '';
    }

    function RemoveAdd() {
        $(".tempRowAddRF").remove();
    }

    function addToDatabase() {
        var addRowBetween = 'No';
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();
        var row_no = $("#row_no").val();
        var no1 = $("#no1").val();
        var no2 = $("#no2").val();
        var no3 = $("#no3").val();
        var no4 = $("#no4").val();
        var no5 = $("#no5").val();
        var no6 = $("#no6").val();
        var no7 = $("#no7").val();
        var no8 = $("#no8").val();
        var no9 = $("#no9").val();
        var no10 = $("#no10").val();
        var no11 = $("#no11").val();

        if (($('.tempRowAddRF').length > 0) == true) {
            var thisRF = '&RFno2=' + $("#RFno2").val() + '&RFno1=' + $("#RFno1").val() + '&RFno3=' + $("#RFno3").val() + '&RFno4=' + $("#RFno4").val() + '&RFno5=' + $("#RFno5").val() + '&RFno6=' + $("#RFno6").val() + '&RFno7=' + $("#RFno7").val() + '&RFno8=' + $("#RFno8").val() + '&RFno9=' + $("#RFno9").val() + '&RFno10=' + $("#RFno10").val() + '&RFno11=' + $("#RFno11").val();
        } else {
            var thisRF = '&RFno2=';
        }

        $(".overlayBG").show();

        $.ajax({
            url: "sale-editable-add.php",
            type: "POST",
            data: 'mainID=' + mainID + '&btnTab=' + btnTab + '&btnTabMonth=' + btnTabMonth + '&addRowBetween=' + addRowBetween + '&row_no=' + row_no + '&no1=' + no1 + '&no2=' + no2 + '&no3=' + no3 + '&no4=' + no4 + '&no5=' + encodeURIComponent(no5) + '&no6=' + no6 + '&no7=' + no7 + '&no8=' + no8 + '&no9=' + no9 + '&no10=' + no10 + '&no11=' + encodeURIComponent(no11) + thisRF,
            success: function (data) {
                $(".overlayBG").hide();
                $("#add-more").show();
                document.getElementById('duplicateBtn').innerHTML = '';

                var trimData = data.trim();
                var numberOnly = trimData.replace(/^\D+/g, '');

                if (numberOnly != '') {
                    if (trimData.includes("R.F")) {
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-table.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                                $.ajax({
                                    type: 'POST',
                                    url: 'sale-load-footer.php',
                                    data: {
                                        dataFooter: {
                                            mainID: mainID,
                                            tab: btnTab,
                                            month: btnTabMonth
                                        },
                                    },
                                    success: function (resultFooter) {
                                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                    }
                                });

                                var elmnt = document.getElementById("loadFooterSale");
                                elmnt.scrollIntoView();
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-table.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {

                                document.getElementById("tempModalBody").innerHTML = '<center> <b> Are you sure you want to issue invoice(paid) & email the client? </b> <br/><br/> ' +
                                    ' <button type="button" class="btn btn-primary"   onclick="runReceipt(\'Yes\',\'' + numberOnly + '\')" > Yes</button> ' +
                                    ' <button type="button" class="btn btn-success"   onclick="runReceipt(\'IP\',\'' + numberOnly + '\')"  > IP Only</button> ' +
                                    ' <button type="button" class="btn btn-secondary" onclick="runReceipt(\'No\',\'' + numberOnly + '\')"  > No</button> <br/><br/> <textarea placeholder="Additional Remarks" class="form-control" id="txtAddRemark" rows="3"></textarea> </center> ';
                                $('#tempModal').modal({backdrop: 'static', keyboard: false});

                                document.getElementById("loadSaleData").innerHTML = result;
                                $.ajax({
                                    type: 'POST',
                                    url: 'sale-load-footer.php',
                                    data: {
                                        dataFooter: {
                                            mainID: mainID,
                                            tab: btnTab,
                                            month: btnTabMonth
                                        },
                                    },
                                    success: function (resultFooter) {
                                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                    }
                                });
                                var elmnt = document.getElementById("loadFooterSale");
                                elmnt.scrollIntoView();
                            }
                        });
                    }
                } else {
                    alert(trimData);
                }
            }
        });
    }

    function createNew() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear().toString().substr(-2);
        today = dd + '/' + mm + '/' + yyyy;

        $('#table-body > tr > td').css('background-color', '#fff');
        $('#table-body2 > tr > td').css('background-color', '#fff');

        $("#add-more").hide();
        $(".tempRowAdd").remove();

        $('.btnSaveEdit').addClass("hidden");
        document.getElementById('duplicateBtn').innerHTML = '<span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links" style="color:#28A745"><b>Save</b></a> / <a onclick="cancelAdd();" class="ajax-action-links" style="color:#007BFF"><b>Cancel</b></a></span>';


        var numTable = '';
        var countTable = document.getElementsByClassName("table-rowCount").length;

        if (countTable > 0) {
            numTable = countTable + 1;
        } else {
            numTable = 1;
        }

        var data = '<tr class="table-row tempRowAdd">' +

            '<td style="font-size:14px;" contenteditable="false" id="txt_dataNo" onBlur="addToHiddenField(this,\'row_no\')" onClick="editRow(this);">' + numTable + '</td>' +

            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no1"     onBlur="addToHiddenField(this,\'no1\')"    onClick="editRow(this);" >' + today + '</td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no2"     onBlur="addToHiddenField(this,\'no2\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id,' + numTable + ')"></td>' +

            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no3"     onBlur="addToHiddenField(this,\'no3\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id,' + numTable + ')"></td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no4"     onBlur="addToHiddenField(this,\'no4\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)"></td>' +

            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no8"     onBlur="addToHiddenField(this,\'no8\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)"></td>' +

            '<td style="font-size:14px;background-color: #F3EBCD;border-right: 3px solid black;" contenteditable="true" id="txt_no5"     onBlur="addToHiddenField(this,\'no5\')"    onClick="editRow(this);"></td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no6"     onBlur="addToHiddenField(this,\'no6\')"    onClick="ChangeThis(this,this.id);" onkeyup="keyupFunction(this,this.id)"></td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no7"     onBlur="addToHiddenField(this,\'no7\')"    onClick="ChangeThis(this,this.id);" onkeyup="keyupFunction(this,this.id)"></td>' +

            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no9"     onBlur="addToHiddenField(this,\'no9\')"    onClick="editRow(this);"></td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no10"    onBlur="addToHiddenField(this,\'no10\')"   onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)"></td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no11"    onBlur="addToHiddenField(this,\'no11\')"   onClick="editRow(this);"></td>' +


            '<td style="font-size:14px;" >  <input type="hidden" id="row_no" value="' + numTable + '"/> <input type="hidden" id="no1" value="' + today + '"/> <input type="hidden" id="no2" /> <input type="hidden" id="no3" /> <input type="hidden" id="no4" /> <input type="hidden" id="no5" /> <input type="hidden" id="no6" /> <input type="hidden" id="no7" /> <input type="hidden" id="no8" /> <input type="hidden" id="no9" /> <input type="hidden" id="no10" /> <input type="hidden" id="no11" />  <span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links" style="color:#28A745"><b><i class="fa fa-check" aria-hidden="true"></i></b></a> <a onclick="cancelAdd();" class="ajax-action-links" style="color:red"><b><i style="float:right;" class="fa fa-times" aria-hidden="true"></i></b></a></span>  </td>' +
            '</tr>';

        $("#table-body2").append(data);
        var elmnt = document.getElementById("loadFooterSale");
        elmnt.scrollIntoView();
    }

    function keyupFunction(editableObj, thisID, newNo) {
        var newNo = (Number(newNo) + 1);

        if (thisID === 'txt_no2') {
            clearTimeout(timer);
            timer = setTimeout(function () {

                var JobID = $(editableObj).text();

                if (JobID == '') {
                    $(".tempRowAddRF").remove();
                    document.getElementById('no3').value = '';
                    document.getElementById('txt_no3').innerHTML = '';

                    document.getElementById('no4').value = '';
                    document.getElementById('txt_no4').innerHTML = '';

                    document.getElementById('no5').value = '';
                    document.getElementById('txt_no5').innerHTML = '';

                    document.getElementById('no6').value = '';
                    document.getElementById('txt_no6').innerHTML = '';

                    document.getElementById('no7').value = '';
                    document.getElementById('txt_no7').innerHTML = '';

                    document.getElementById('no9').value = '';
                    document.getElementById('txt_no9').innerHTML = '';

                    document.getElementById('no10').value = '';
                    document.getElementById('txt_no10').innerHTML = '';

                    document.getElementById('no11').value = '';
                    document.getElementById('txt_no11').innerHTML = '';
                } else {

                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + JobID,
                        success: function (result) {
                            trim = result.replace(/\s+/g, '');
                            if (trim == "No") {
                                $(".tempRowAddRF").remove();
                                document.getElementById('no3').value = '';
                                document.getElementById('txt_no3').innerHTML = '';

                                document.getElementById('no4').value = '';
                                document.getElementById('txt_no4').innerHTML = '';

                                document.getElementById('no5').value = '';
                                document.getElementById('txt_no5').innerHTML = '';

                                document.getElementById('no6').value = '';
                                document.getElementById('txt_no6').innerHTML = '';

                                document.getElementById('no7').value = '';
                                document.getElementById('txt_no7').innerHTML = '';

                                document.getElementById('no9').value = '';
                                document.getElementById('txt_no9').innerHTML = '';

                                document.getElementById('no10').value = '';
                                document.getElementById('txt_no10').innerHTML = '';

                                document.getElementById('no11').value = '';
                                document.getElementById('txt_no11').innerHTML = '';
                            } else if (trim == "Error 3") {
                                alert(trim);
                            } else {
                                var nameArr = result.split(',');
                                var tutorRate = nameArr[0];
                                var parentRate = nameArr[1];
                                var cycle = nameArr[2];
                                var tutorEmail = nameArr[3];
                                var tutorDisplay = nameArr[4];
                                var userAcc = nameArr[5];
                                var RF = nameArr[6];
                                var cycleNo = nameArr[7].replace(/(\r\n|\n|\r)/gm, "");

                                if (cycleNo == 'T.S') {
                                    var stringWithLineBreaks = cycleNo + ' - ' + userAcc;
                                } else {
                                    var stringWithLineBreaks = 'Cycle #' + cycleNo + ' - ' + userAcc;
                                }

                                var stringWithoutLineBreaks = stringWithLineBreaks.replace(/(\r\n|\n|\r)/gm, "");

                                if (RF > 0) {
                                    var today = new Date();
                                    var dd = String(today.getDate()).padStart(2, '0');
                                    var mm = String(today.getMonth() + 1).padStart(2, '0');
                                    var yyyy = today.getFullYear().toString().substr(-2);
                                    today = dd + '/' + mm + '/' + yyyy;

                                    var data = '<tr class="table-row tempRowAdd tempRowAddRF">' +

                                        '<td style="font-size:14px;" contenteditable="false"  id="RFtxt_dataNo" onBlur="addToHiddenField(this,\'RFrow_no\')" onClick="editRow(this);">' + newNo + '</td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="RFtxt_no1"    onBlur="addToHiddenField(this,\'RFno1\')"    onClick="editRow(this);">' + today + '</td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="RFtxt_no2"    onBlur="addToHiddenField(this,\'RFno2\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="RFtxt_no3"    onBlur="addToHiddenField(this,\'RFno3\')"    onClick="editRow(this);">R.F</td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="RFtxt_no4"    onBlur="addToHiddenField(this,\'RFno4\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)">' + RF + '</td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="RFtxt_no8"    onBlur="addToHiddenField(this,\'RFno8\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="RFtxt_no5"    onBlur="addToHiddenField(this,\'RFno5\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="RFtxt_no6"    onBlur="addToHiddenField(this,\'RFno6\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="RFtxt_no7"    onBlur="addToHiddenField(this,\'RFno7\')"    onClick="editRow(this);"></td>' +

                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="RFtxt_no9"    onBlur="addToHiddenField(this,\'RFno9\')"    onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="false"  id="RFtxt_no10"   onBlur="addToHiddenField(this,\'RFno10\')"   onClick="editRow(this);"></td>' +
                                        '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true"   id="RFtxt_no11"   onBlur="addToHiddenField(this,\'RFno11\')"   onClick="editRow(this);">NJ</td>' +


                                        '<td style="font-size:14px;" >  <input type="hidden" id="RFrow_no" value="' + newNo + '" /> <input type="hidden" id="RFno1" value="' + today + '"/> <input type="hidden" id="RFno2" value="' + JobID + '"/> <input type="hidden" id="RFno3" value="R.F"/> <input type="hidden" id="RFno4" value="' + RF + '" /> <input type="hidden" id="RFno5" /> <input type="hidden" id="RFno6" /> <input type="hidden" id="RFno7" /> <input type="hidden" id="RFno8" /> <input type="hidden" id="RFno9" /> <input type="hidden" id="RFno10" /> <input type="hidden" id="RFno11" value="NJ"/>  <span id="confirmAdd"><a onclick="RemoveAdd();" class="ajax-action-links" style="color:red"><b>Remove</b></a></span>  </td>' +
                                        '</tr>';
                                    $("#table-body2").append(data);

                                    document.getElementById('RFno5').value = stringWithoutLineBreaks;
                                    document.getElementById('RFtxt_no5').innerHTML = stringWithoutLineBreaks;

                                    document.getElementById('no6').value = '';
                                    document.getElementById('txt_no6').innerHTML = '';

                                    document.getElementById('no7').value = '';
                                    document.getElementById('txt_no7').innerHTML = '';

                                    document.getElementById('RFno9').value = parseFloat((document.getElementById('RFno4').value - document.getElementById('RFno7').value)).toFixed(2);
                                    document.getElementById('RFtxt_no9').innerHTML = parseFloat((document.getElementById('RFno4').value - document.getElementById('RFno7').value)).toFixed(2);
                                } else {
                                    $(".tempRowAddRF").remove();
                                }

                                document.getElementById('no3').value = tutorDisplay;
                                document.getElementById('txt_no3').innerHTML = tutorDisplay;

                                document.getElementById('no4').value = parseFloat((parentRate * cycle)).toFixed(2);
                                document.getElementById('txt_no4').innerHTML = parseFloat((parentRate * cycle)).toFixed(2);

                                document.getElementById('no8').value = parseFloat(parentRate).toFixed(2);
                                document.getElementById('txt_no8').innerHTML = parseFloat(parentRate).toFixed(2);

                                document.getElementById('no5').value = stringWithoutLineBreaks;
                                document.getElementById('txt_no5').innerHTML = stringWithoutLineBreaks;

                                document.getElementById('no6').value = '';
                                document.getElementById('txt_no6').innerHTML = '';

                                document.getElementById('no7').value = '';
                                document.getElementById('txt_no7').innerHTML = '';

                                document.getElementById('no9').value = parseFloat((document.getElementById('no4').value - document.getElementById('no7').value)).toFixed(2);
                                document.getElementById('txt_no9').innerHTML = parseFloat((document.getElementById('no4').value - document.getElementById('no7').value)).toFixed(2);

                                document.getElementById('no10').value = cycle;
                                document.getElementById('txt_no10').innerHTML = cycle;

                                document.getElementById('no11').value = '';
                                document.getElementById('txt_no11').innerHTML = '';
                            }

                        }
                    });

                }
            }, 1000);
        }

        if (thisID === 'txt_no3') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var tutorName = $(editableObj).text();

                var Row = document.getElementById("table-row-" + (newNo - 2));
                var Cells = Row.getElementsByTagName("td");
                var tJobID = Cells[2].innerText;

                if (tutorName == 'R.F') {

                    $(".tempRowAddRF").remove();
                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + tJobID,
                        success: function (result) {
                            trim = result.replace(/\s+/g, '');
                            if (trim == "No") {
                                alert('Job ID Not Found!');
                                document.getElementById('no2').value = '';
                                document.getElementById('txt_no2').innerHTML = '';
                                document.getElementById('txt_no2').setAttribute("contenteditable", true);

                                document.getElementById('no3').value = '';
                                document.getElementById('txt_no3').innerHTML = '';
                                document.getElementById('txt_no3').setAttribute("contenteditable", true);

                                document.getElementById('no4').value = '';
                                document.getElementById('txt_no4').innerHTML = '';
                                document.getElementById('txt_no4').setAttribute("contenteditable", true);

                                document.getElementById('no5').value = '';
                                document.getElementById('txt_no5').innerHTML = '';
                                document.getElementById('txt_no5').setAttribute("contenteditable", true);

                                document.getElementById('no6').value = '';
                                document.getElementById('txt_no6').innerHTML = '';
                                document.getElementById('txt_no6').setAttribute("contenteditable", true);

                                document.getElementById('no7').value = '';
                                document.getElementById('txt_no7').innerHTML = '';
                                document.getElementById('txt_no7').setAttribute("contenteditable", true);

                                document.getElementById('no8').value = '';
                                document.getElementById('txt_no8').innerHTML = '';
                                document.getElementById('txt_no8').setAttribute("contenteditable", true);

                                document.getElementById('no9').value = '';
                                document.getElementById('txt_no9').innerHTML = '';
                                document.getElementById('txt_no9').setAttribute("contenteditable", true);

                                document.getElementById('no10').value = '';
                                document.getElementById('txt_no10').innerHTML = '';
                                document.getElementById('txt_no10').setAttribute("contenteditable", true);

                                document.getElementById('no11').value = '';
                                document.getElementById('txt_no11').innerHTML = '';
                                document.getElementById('txt_no11').setAttribute("contenteditable", true);
                            } else if (trim == "Error 3") {
                                alert(trim);
                                document.getElementById('no2').value = '';
                                document.getElementById('txt_no2').innerHTML = '';
                                document.getElementById('txt_no2').setAttribute("contenteditable", true);

                                document.getElementById('no3').value = '';
                                document.getElementById('txt_no3').innerHTML = '';
                                document.getElementById('txt_no3').setAttribute("contenteditable", true);

                                document.getElementById('no4').value = '';
                                document.getElementById('txt_no4').innerHTML = '';
                                document.getElementById('txt_no4').setAttribute("contenteditable", true);

                                document.getElementById('no5').value = '';
                                document.getElementById('txt_no5').innerHTML = '';
                                document.getElementById('txt_no5').setAttribute("contenteditable", true);

                                document.getElementById('no6').value = '';
                                document.getElementById('txt_no6').innerHTML = '';
                                document.getElementById('txt_no6').setAttribute("contenteditable", true);

                                document.getElementById('no7').value = '';
                                document.getElementById('txt_no7').innerHTML = '';
                                document.getElementById('txt_no7').setAttribute("contenteditable", true);

                                document.getElementById('no8').value = '';
                                document.getElementById('txt_no8').innerHTML = '';
                                document.getElementById('txt_no8').setAttribute("contenteditable", true);

                                document.getElementById('no9').value = '';
                                document.getElementById('txt_no9').innerHTML = '';
                                document.getElementById('txt_no9').setAttribute("contenteditable", true);

                                document.getElementById('no10').value = '';
                                document.getElementById('txt_no10').innerHTML = '';
                                document.getElementById('txt_no10').setAttribute("contenteditable", true);

                                document.getElementById('no11').value = '';
                                document.getElementById('txt_no11').innerHTML = '';
                                document.getElementById('txt_no11').setAttribute("contenteditable", true);
                            } else {
                                var nameArr = result.split(',');
                                var tutorRate = nameArr[0];
                                var parentRate = nameArr[1];
                                var cycle = nameArr[2];
                                var tutorEmail = nameArr[3];
                                var tutorDisplay = nameArr[4];
                                var userAcc = nameArr[5];
                                var RF = nameArr[6];
                                var cycleNo = nameArr[7].replace(/(\r\n|\n|\r)/gm, "");

                                if (cycleNo == 'T.S') {
                                    var stringWithLineBreaks = cycleNo + ' - ' + userAcc;
                                } else {
                                    var stringWithLineBreaks = 'Cycle #' + cycleNo + ' - ' + userAcc;
                                }
                                var stringWithoutLineBreaks = stringWithLineBreaks.replace(/(\r\n|\n|\r)/gm, "");

                                if (RF > 0) {
                                    document.getElementById('no2').value = tJobID;
                                    document.getElementById('txt_no2').innerHTML = '';
                                    document.getElementById('txt_no2').setAttribute("contenteditable", false);

                                    document.getElementById('no4').value = RF;
                                    document.getElementById('txt_no4').innerHTML = RF;
                                    document.getElementById('txt_no4').setAttribute("contenteditable", true);

                                    document.getElementById('no5').value = stringWithoutLineBreaks;
                                    document.getElementById('txt_no5').innerHTML = stringWithoutLineBreaks;
                                    document.getElementById('txt_no5').setAttribute("contenteditable", true);

                                    document.getElementById('no6').value = '';
                                    document.getElementById('txt_no6').innerHTML = '';
                                    document.getElementById('txt_no6').setAttribute("onclick", false);
                                    document.getElementById('txt_no6').setAttribute("contenteditable", false);

                                    document.getElementById('no7').value = '';
                                    document.getElementById('txt_no7').innerHTML = '';
                                    document.getElementById('txt_no7').setAttribute("contenteditable", false);

                                    document.getElementById('no8').value = '';
                                    document.getElementById('txt_no8').innerHTML = '';
                                    document.getElementById('txt_no8').setAttribute("contenteditable", false);

                                    document.getElementById('no9').value = parseFloat((document.getElementById('no4').value - document.getElementById('no7').value)).toFixed(2);
                                    document.getElementById('txt_no9').innerHTML = parseFloat((document.getElementById('no4').value - document.getElementById('no7').value)).toFixed(2);
                                    document.getElementById('txt_no9').setAttribute("contenteditable", false);

                                    document.getElementById('no10').value = '';
                                    document.getElementById('txt_no10').innerHTML = '';
                                    document.getElementById('txt_no10').setAttribute("contenteditable", false);

                                    document.getElementById('no11').value = 'NJ';
                                    document.getElementById('txt_no11').innerHTML = 'NJ';
                                    document.getElementById('txt_no11').setAttribute("contenteditable", true);

                                } else {
                                    document.getElementById('no2').value = tJobID;
                                    document.getElementById('txt_no2').innerHTML = '';
                                    document.getElementById('txt_no2').setAttribute("contenteditable", false);

                                    document.getElementById('no4').value = RF;
                                    document.getElementById('txt_no4').innerHTML = RF;
                                    document.getElementById('txt_no4').setAttribute("contenteditable", true);

                                    document.getElementById('no5').value = stringWithoutLineBreaks;
                                    document.getElementById('txt_no5').innerHTML = stringWithoutLineBreaks;
                                    document.getElementById('txt_no5').setAttribute("contenteditable", true);

                                    document.getElementById('no6').value = '';
                                    document.getElementById('txt_no6').innerHTML = '';
                                    document.getElementById('txt_no6').setAttribute("onclick", false);
                                    document.getElementById('txt_no6').setAttribute("contenteditable", false);

                                    document.getElementById('no7').value = '';
                                    document.getElementById('txt_no7').innerHTML = '';
                                    document.getElementById('txt_no7').setAttribute("contenteditable", false);

                                    document.getElementById('no8').value = '';
                                    document.getElementById('txt_no8').innerHTML = '';
                                    document.getElementById('txt_no8').setAttribute("contenteditable", false);

                                    document.getElementById('no9').value = parseFloat((document.getElementById('no4').value - document.getElementById('no7').value)).toFixed(2);
                                    document.getElementById('txt_no9').innerHTML = parseFloat((document.getElementById('no4').value - document.getElementById('no7').value)).toFixed(2);
                                    document.getElementById('txt_no9').setAttribute("contenteditable", false);

                                    document.getElementById('no10').value = '';
                                    document.getElementById('txt_no10').innerHTML = '';
                                    document.getElementById('txt_no10').setAttribute("contenteditable", false);

                                    document.getElementById('no11').value = 'NJ';
                                    document.getElementById('txt_no11').innerHTML = 'NJ';
                                    document.getElementById('txt_no11').setAttribute("contenteditable", true);
                                }
                            }

                        }
                    });

                } else {
                    document.getElementById('txt_no1').setAttribute("contenteditable", true);
                    document.getElementById('txt_no2').setAttribute("contenteditable", true);
                    document.getElementById('txt_no3').setAttribute("contenteditable", true);
                    document.getElementById('txt_no4').setAttribute("contenteditable", true);
                    document.getElementById('txt_no5').setAttribute("contenteditable", true);

                    document.getElementById('txt_no6').setAttribute("onclick", "ChangeThis(this,this.id);");
                    document.getElementById('txt_no6').setAttribute("contenteditable", true);

                    document.getElementById('txt_no7').setAttribute("contenteditable", true);
                    document.getElementById('txt_no8').setAttribute("contenteditable", true);
                    document.getElementById('txt_no9').setAttribute("contenteditable", true);
                    document.getElementById('txt_no10').setAttribute("contenteditable", true);
                    document.getElementById('txt_no11').setAttribute("contenteditable", true);
                }
            }, 1000);
        }

        if (thisID === 'txt_no4') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountReceived = $(editableObj).text();
                var amountTutor = document.getElementById('no7').value;
                document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'txt_no8') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountRate = $(editableObj).text();
                var hour = document.getElementById('no10').value;
                document.getElementById('no4').value = parseFloat((amountRate * hour)).toFixed(2);
                document.getElementById('txt_no4').innerHTML = parseFloat((amountRate * hour)).toFixed(2);

                var amountReceived = document.getElementById('no4').value;
                var amountTutor = document.getElementById('no7').value;
                document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'txt_no6') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if ($(editableObj).text() == '') {
                    document.getElementById('no7').value = '';
                    document.getElementById('txt_no7').innerHTML = '';

                    document.getElementById('no9').value = parseFloat(((document.getElementById('no4').value) - (document.getElementById('no7').value))).toFixed(2);
                    document.getElementById('txt_no9').innerHTML = parseFloat(((document.getElementById('no4').value) - (document.getElementById('no7').value))).toFixed(2);
                }
            }, 1000);
        }

        if (thisID === 'txt_no7') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountTutor = $(editableObj).text();
                var amountReceived = document.getElementById('no4').value;
                document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'RFtxt_no4') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var amountReceived = $(editableObj).text();
                var amountTutor = document.getElementById('RFno7').value;
                document.getElementById('RFno9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('RFtxt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

        if (thisID === 'txt_no10') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var hour = $(editableObj).text();
                var amountRate = document.getElementById('no8').value;
                document.getElementById('no4').value = parseFloat((amountRate * hour)).toFixed(2);
                document.getElementById('txt_no4').innerHTML = parseFloat((amountRate * hour)).toFixed(2);

                var amountReceived = document.getElementById('no4').value;
                var amountTutor = document.getElementById('no7').value;
                document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
            }, 1000);
        }

    }

    function deleteRecordCF(id) {
        if (confirm("Are you sure you want to delete this row?")) {

            var mainID = document.getElementById('mainID').value;
            var btnTab = $(".btnTab.active").text();
            var btnTabMonth = $(".btnTabMonth.active").text();

            $(".overlayBG").show();
            $.ajax({
                url: "sale-editable-delete-cf.php",
                type: "POST",
                data: 'mainID=' + mainID + '&btnTab=' + btnTab + '&btnTabMonth=' + btnTabMonth + '&id=' + id,
                success: function (data) {
                    $(".overlayBG").hide();
                    if (data.trim() == 'Success') {
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-table.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                                $.ajax({
                                    type: 'POST',
                                    url: 'sale-load-footer.php',
                                    data: {
                                        dataFooter: {
                                            mainID: mainID,
                                            tab: btnTab,
                                            month: btnTabMonth
                                        },
                                    },
                                    success: function (resultFooter) {
                                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                    }
                                });
                            }
                        });
                    } else {
                        alert('Error !!');
                    }
                }
            });
        }
    }

    function deleteRecord(id) {
        if (confirm("Are you sure you want to delete this row?")) {

            var mainID = document.getElementById('mainID').value;
            var btnTab = $(".btnTab.active").text();
            var btnTabMonth = $(".btnTabMonth.active").text();

            $(".overlayBG").show();
            $.ajax({
                url: "sale-editable-delete.php",
                type: "POST",
                data: 'mainID=' + mainID + '&btnTab=' + btnTab + '&btnTabMonth=' + btnTabMonth + '&id=' + id,
                success: function (data) {
                    $(".overlayBG").hide();
                    if (data.trim() == 'Success') {
                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-table.php',
                            data: {
                                dataGrid: {mainID: mainID, tab: btnTab, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                                $.ajax({
                                    type: 'POST',
                                    url: 'sale-load-footer.php',
                                    data: {
                                        dataFooter: {
                                            mainID: mainID,
                                            tab: btnTab,
                                            month: btnTabMonth
                                        },
                                    },
                                    success: function (resultFooter) {
                                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                                    }
                                });
                            }
                        });
                    } else {
                        alert('Error !!');
                    }
                }
            });
        }
    }

    function dateTutorPaid(editableObj, column, id, tableID) {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear().toString().substr(-2);
        today = dd + '/' + mm + '/' + yyyy;

        var idx = (($(editableObj).closest('tr').index()) + 1);
        var tr = document.getElementsByTagName("tr")[idx];
        var currVal = $(editableObj).text().trim();
        var calc = '';
        var GrossProfit = '';

        var x = document.getElementById(tableID).rows[parseInt((idx - 1), 10)].cells;

        $('#table-body > tr > td').css('background-color', '#fff');
        $('#table-body2 > tr > td').css('background-color', '#fff');
        x[parseInt(1, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(2, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(3, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(4, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(5, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(6, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(7, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(8, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(9, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(10, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(11, 10)].style.backgroundColor = "#F3EBCD";

        var no1 = x[parseInt(1, 10)].innerHTML.trim();
        var no2 = x[parseInt(2, 10)].innerHTML.trim();
        var no3 = x[parseInt(3, 10)].innerHTML.trim();
        var no4 = x[parseInt(4, 10)].innerHTML.trim();
        var no8 = x[parseInt(5, 10)].innerHTML.trim();
        var no5 = x[parseInt(6, 10)].innerHTML.trim();
        var no6 = x[parseInt(7, 10)].innerHTML.trim();
        var no7 = x[parseInt(8, 10)].innerHTML.trim();
        var no9 = x[parseInt(9, 10)].innerHTML.trim();
        var no10 = x[parseInt(10, 10)].innerHTML.trim();
        var no11 = x[parseInt(11, 10)].innerHTML.trim();

        $('.btnSaveEdit').addClass("hidden");
        $("#add-more").show();
        $(".tempRowAdd").remove();
        $(".tempRowAddRF").remove();
        document.getElementById('duplicateBtn').innerHTML = '';

        if (column === 'saveManualno6') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if (currVal == '') {
                    x[parseInt(7, 10)].innerHTML = today;
                }
                if (no2 != '') {
                    $.ajax({
                        url: "sale-editable-job.php",
                        type: "POST",
                        data: 'JobID=' + no2,
                        success: function (result) {
                            if (result == 'No') {
                                alert(result);
                            } else if (result == 'Error 3') {
                                alert(result);
                            } else {
                                var nameArr = result.split(',');
                                var tutorRate = nameArr[0];
                                var cycle = nameArr[2];
                                var matches = tutorRate.match(/[+-]?\d+(?:\.\d+)?/);
                                if (no7 == '') {
                                    x[parseInt(8, 10)].innerHTML = parseFloat(((matches[0]) * cycle)).toFixed(2);
                                }
                                calc = (no4 - (parseFloat(((matches[0]) * cycle)).toFixed(2)));
                                GrossProfit = parseFloat(calc).toFixed(2);
                                x[parseInt(9, 10)].innerHTML = GrossProfit;
                            }
                        }
                    });

                }
                document.getElementById("saveDateTutorPaid" + id).classList.remove('hidden');
                document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\'' + id + '\')" />';

            }, 1000);
        } else if (column === 'saveManualno7') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if (currVal == '') {
                    x[parseInt(7, 10)].innerHTML = today;
                }

                if (no2 != '') {
                    $.ajax({
                        url: "editable-job.php",
                        type: "POST",
                        data: 'JobID=' + no2,
                        success: function (result) {
                            if (result == 'No') {
                                alert(result);
                            } else if (result == 'Error 3') {
                                alert(result);
                            } else {
                                var nameArr = result.split(',');
                                var tutorRate = nameArr[0];
                                var cycle = nameArr[2];
                                var matches = tutorRate.match(/[+-]?\d+(?:\.\d+)?/);
                                if (no7 == '') {
                                    x[parseInt(8, 10)].innerHTML = parseFloat(((matches[0]) * cycle)).toFixed(2);
                                }
                                calc = (no4 - (parseFloat(((matches[0]) * cycle)).toFixed(2)));
                                GrossProfit = parseFloat(calc).toFixed(2);
                                x[parseInt(9, 10)].innerHTML = GrossProfit;
                            }
                        }
                    });
                }

                document.getElementById("saveDateTutorPaid" + id).classList.remove('hidden');
                document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\'' + id + '\')" />';

            }, 1000);
        } else if (column === 'saveManualno11') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if (no3 != 'R.F') {
                    document.getElementById("saveDateTutorPaid" + id).classList.remove('hidden');
                    document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\'' + id + '\')" />';
                }
            }, 1000);
        } else {
            $('.btnSaveEdit').addClass("hidden");
            document.getElementById('duplicateBtn').innerHTML = '';
        }
    }

    function dateTutorPaidEdit(editableObj, column, id, tableID) {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear().toString().substr(-2);
        today = dd + '/' + mm + '/' + yyyy;
        var idx = (($(editableObj).closest('tr').index()) + 1);
        var tr = document.getElementsByTagName("tr")[idx];
        var currVal = $(editableObj).text().trim();
        var calc = '';
        var GrossProfit = '';
        var x = document.getElementById(tableID).rows[parseInt((idx - 1), 10)].cells;

        $('#table-body > tr > td').css('background-color', '#fff');
        $('#table-body2 > tr > td').css('background-color', '#fff');
        x[parseInt(1, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(2, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(3, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(4, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(5, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(6, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(7, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(8, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(9, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(10, 10)].style.backgroundColor = "#F3EBCD";
        x[parseInt(11, 10)].style.backgroundColor = "#F3EBCD";

        var no1 = x[parseInt(1, 10)].innerHTML.trim();
        var no2 = x[parseInt(2, 10)].innerHTML.trim();
        var no3 = x[parseInt(3, 10)].innerHTML.trim();
        var no4 = x[parseInt(4, 10)].innerHTML.trim();

        var no8 = x[parseInt(5, 10)].innerHTML.trim();

        var no5 = x[parseInt(6, 10)].innerHTML.trim();
        var no6 = x[parseInt(7, 10)].innerHTML.trim();
        var no7 = x[parseInt(8, 10)].innerHTML.trim();

        var no9 = x[parseInt(9, 10)].innerHTML.trim();
        var no10 = x[parseInt(10, 10)].innerHTML.trim();
        var no11 = x[parseInt(11, 10)].innerHTML.trim();

        $('.btnSaveEdit').addClass("hidden");
        $("#add-more").show();
        $(".tempRowAdd").remove();
        $(".tempRowAddRF").remove();
        document.getElementById('duplicateBtn').innerHTML = '';

        if (column === 'saveManualno6') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if (currVal == '') {
                    x[parseInt(7, 10)].innerHTML = today;
                }
                document.getElementById("saveDateTutorPaid" + id).classList.remove('hidden');
                document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\'' + id + '\')" />';

            }, 1000);
        } else if (column === 'saveManualno7') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if (currVal == '') {
                    x[parseInt(7, 10)].innerHTML = today;
                }
                document.getElementById("saveDateTutorPaid" + id).classList.remove('hidden');
                document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\'' + id + '\')" />';
            }, 1000);
        } else if (column === 'saveManualno11') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if (no3 != 'R.F') {
                    document.getElementById("saveDateTutorPaid" + id).classList.remove('hidden');
                    document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\'' + id + '\')" />';
                }
            }, 1000);
        } else {
            $('.btnSaveEdit').addClass("hidden");
            document.getElementById('duplicateBtn').innerHTML = '';
        }
    }

    function changeTutorPaid(editableObj, column, id, tableID) {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear().toString().substr(-2);
        today = dd + '/' + mm + '/' + yyyy;

        var idx = (($(editableObj).closest('tr').index()) + 1);
        var tr = document.getElementsByTagName("tr")[idx];
        var currVal = $(editableObj).text().trim();
        var calc = '';
        var GrossProfit = '';

        var x = document.getElementById(tableID).rows[parseInt((idx - 1), 10)].cells;

        var no1 = x[parseInt(1, 10)].innerHTML.trim();
        var no2 = x[parseInt(2, 10)].innerHTML.trim();
        var no3 = x[parseInt(3, 10)].innerHTML.trim();
        var no4 = x[parseInt(4, 10)].innerHTML.trim();
        var no8 = x[parseInt(5, 10)].innerHTML.trim();
        var no5 = x[parseInt(6, 10)].innerHTML.trim();
        var no6 = x[parseInt(7, 10)].innerHTML.trim();
        var no7 = x[parseInt(8, 10)].innerHTML.trim();
        var no9 = x[parseInt(9, 10)].innerHTML.trim();
        var no10 = x[parseInt(10, 10)].innerHTML.trim();
        var no11 = x[parseInt(11, 10)].innerHTML.trim();

        if (column === 'no6') {
            clearTimeout(timer);
            timer = setTimeout(function () {
            }, 1000);
        }

        if (column === 'no7') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                calc = (no4 - currVal);
                GrossProfit = parseFloat(calc).toFixed(2)
                x[parseInt(9, 10)].innerHTML = GrossProfit;
            }, 1000);
        }
    }

    // Guna bila masuk data di right side and data belum ada. Untuk cf/normal table. Untuk isu PV.
    function show(editableObj, column, id, tableID) {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        var idx = (($(editableObj).closest('tr').index()) + 1);
        var tr = document.getElementsByTagName("tr")[idx];
        var x = document.getElementById(tableID).rows[parseInt((idx - 1), 10)].cells;
        var no1 = x[parseInt(1, 10)].innerHTML.trim();
        var no2 = x[parseInt(2, 10)].innerHTML.trim();
        var no3 = x[parseInt(3, 10)].innerHTML.trim();
        var no4 = x[parseInt(4, 10)].innerHTML.trim();
        var no8 = x[parseInt(5, 10)].innerHTML.trim();
        var no5 = x[parseInt(6, 10)].innerHTML.trim();
        var no6 = x[parseInt(7, 10)].innerHTML.trim();
        var no7 = x[parseInt(8, 10)].innerHTML.trim();
        var no9 = x[parseInt(9, 10)].innerHTML.trim();
        var no10 = x[parseInt(10, 10)].innerHTML.trim();
        var no11 = x[parseInt(11, 10)].innerHTML.trim();

        $.ajax({
            url: "sale-editable-edit2.php",
            type: "POST",
            data: 'id=' + id + '&btnTabMonth=' + btnTabMonth + '&datePaid=' + no6 + '&amountPaid=' + no7 + '&GrossProfit=' + no9 + '&note=' + encodeURIComponent(no11),
            success: function (data) {

                document.getElementById("saveDateTutorPaid" + id).classList.add('hidden');
                document.getElementById('duplicateBtn').innerHTML = '';

                var trimData = data.trim();
                var numberOnly = trimData.replace(/^\D+/g, '');

                if (numberOnly != '') {
                    document.getElementById("tempModalBody").innerHTML = '<center> <b> Do you want to issue PV & send WA to tutor? </b> <br/><br/> ' +
                        ' <button type="button" class="btn btn-primary"   onclick="runPv(\'Yes\',\'' + numberOnly + '\')" > Yes</button> ' +
                        ' <button type="button" class="btn btn-success"   onclick="runPv(\'PV\',\'' + numberOnly + '\')"  > PV Only</button> ' +
                        ' <button type="button" class="btn btn-secondary" onclick="runPv(\'No\',\'' + numberOnly + '\')"  > No</button> <br/><br/> <textarea placeholder="Additional Remarks" class="form-control" id="txtAddRemark" rows="3"></textarea> </center> ';
                    $('#tempModal').modal({backdrop: 'static', keyboard: false});

                } else {
                    alert(trimData);
                }
            }
        });

    }

    function show2(editableObj, column, id, tableID) {
        $('#saveDateTutorPaid' + id).click();
    }

    // Function ni guna, bila data dah ada di DB dan untuk edit rekod tu. Dari saveToDatabase. Untuk cf/mormal table
    function saveThis(id, column, btnTabMonth, currVal, no9) {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        $.ajax({
            url: "sale-editable-edit.php",
            type: "POST",
            data: 'column=' + column + '&editval=' + encodeURIComponent(currVal) + '&id=' + id + '&btnTabMonth=' + btnTabMonth + '&GrossProfit=' + no9,
            success: function (data) {
                if (data.trim() == 'Success') {
                } else {
                    alert(data.trim());
                }
            }
        });
    }

    // Function ni guna, bila data dah ada di DB dan untuk edit rekod tu. Call function saveThis (atas ni). Untuk cf/mormal table
    function saveToDatabase(editableObj, column, id, tableID) {
        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        var idx = (($(editableObj).closest('tr').index()) + 1);
        var tr = document.getElementsByTagName("tr")[idx];
        var currVal = $(editableObj).text().trim();
        var calc = '';
        var GrossProfit = '';

        var idx = (($(editableObj).closest('tr').index()) + 1);
        var tr = document.getElementsByTagName("tr")[idx];

        var x = document.getElementById(tableID).rows[parseInt((idx - 1), 10)].cells;
        var no1 = x[parseInt(1, 10)].innerHTML.trim();
        var no2 = x[parseInt(2, 10)].innerHTML.trim();
        var no3 = x[parseInt(3, 10)].innerHTML.trim();
        var no4 = x[parseInt(4, 10)].innerHTML.trim();
        var no8 = x[parseInt(5, 10)].innerHTML.trim();
        var no5 = x[parseInt(6, 10)].innerHTML.trim();
        var no6 = x[parseInt(7, 10)].innerHTML.trim();
        var no7 = x[parseInt(8, 10)].innerHTML.trim();
        var no9 = x[parseInt(9, 10)].innerHTML.trim();
        var no10 = x[parseInt(10, 10)].innerHTML.trim();
        var no11 = x[parseInt(11, 10)].innerHTML.trim();

        if (column === 'no1') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, no9);
            }, 1000);
        }

        if (column === 'no2') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, no9);
            }, 1000);
        }

        if (column === 'no3') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, no9);
            }, 1000);
        }

        if (column === 'no4') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var td = tr.getElementsByTagName("td")[7];
                calc = (currVal - no7);
                GrossProfit = parseFloat(calc).toFixed(2);
                x[parseInt(9, 10)].innerHTML = GrossProfit;
                saveThis(id, column, btnTabMonth, currVal, GrossProfit);
            }, 1000);
        }

        if (column === 'no5') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, no9);
            }, 1000);
        }

        if (column === 'no6') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, no9);
            }, 1000);
        }
        if (column === 'no7') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                calc = (no4 - currVal);
                GrossProfit = parseFloat(calc).toFixed(2);
                x[parseInt(9, 10)].innerHTML = GrossProfit;
                saveThis(id, column, btnTabMonth, currVal, GrossProfit);
            }, 1000);
        }

        if (column === 'no8') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, no9);
            }, 1000);
        }

        if (column === 'no9') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, currVal);
            }, 1000);
        }

        if (column === 'no10') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, no9);
            }, 1000);
        }

        if (column === 'no11') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                saveThis(id, column, btnTabMonth, currVal, no9);
            }, 1000);
        }
    }

    function submitTab() {
        var mainID = document.getElementById('mainID').value;
        var Tabname = document.getElementById('TabInput').value;

        if (mainID == '' && TabInput == '') {
            alert('Please insert name');
        } else {
            $.ajax({
                type: 'POST',
                url: 'sale-process.php',
                data: {
                    dataTabs: {mainID: mainID, Tabname: Tabname},
                },
                success: function (result) {
                    if (result == "Success") {
                        document.getElementById('closeModal').click();
                        setTimeout(function () {
                            getSaleFile(mainID);
                        }, 1000);
                    } else {
                        alert(result);
                    }
                }
            });
        }
    }
</script>


<script>
    function myFunction123() {
        var elmnt = document.getElementById("myDIV123");
        var x = elmnt.scrollLeft;
        var y = elmnt.scrollTop;
        document.getElementById("demo123").innerHTML = y;
    }

    function createExpensesNew() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear().toString().substr(-2);
        today = dd + '/' + mm + '/' + yyyy;

        var mainID = document.getElementById('mainID').value;
        var btnTab = $(".btnTab.active").text();
        var btnTabMonth = $(".btnTabMonth.active").text();

        var data = '<tr class="table-row tempRowAdd">' +

            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no1"     onBlur="addToHiddenField(this,\'date\')"    onClick="editRow(this);" >' + today + '</td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no2"     onBlur="addToHiddenField(this,\'item\')"    onClick="editRow(this);" ></td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no3"     onBlur="addToHiddenField(this,\'amount\')"  onClick="editRow(this);" ></td>' +
            '<td style="font-size:14px;background-color: #F3EBCD;" contenteditable="true" id="txt_no4"     onBlur="addToHiddenField(this,\'note\')"    onClick="editRow(this);" ></td>' +

            '<td style="font-size:14px;" >  <input type="hidden" id="date" value="' + today + '"/> <input type="hidden" id="item" /> <input type="hidden" id="amount" /> <input type="hidden" id="note" /> <span id="confirmAdd">   </span>  </td>' +
            '</tr>';

        $("#table-bodyExpenses").append(data);
    }

    function deleteRecordExpenses(id) {
        if (confirm("Are you sure you want to delete this row?")) {
            var mainID = document.getElementById('mainID').value;
            var btnTabMonth = $(".btnTabMonth.active").text();

            $(".overlayBG").show();

            $.ajax({
                url: "sale-expenses-delete.php",
                type: "POST",
                data: 'id=' + id,
                success: function (data) {
                    if (data.trim() == 'Success') {

                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-expenses.php',
                            data: {
                                dataGrid: {mainID: mainID, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                                $(".overlayBG").hide();
                            }
                        });

                    } else {
                        alert('Error !!');
                    }
                }
            });
        }
    }

    function deleteRecordDeposit(id) {
        if (confirm("Are you sure you want to delete this row?")) {
            var mainID = document.getElementById('mainID').value;
            var btnTabMonth = $(".btnTabMonth.active").text();

            $(".overlayBG").show();

            $.ajax({
                url: "sale-deposit-delete.php",
                type: "POST",
                data: 'id=' + id,
                success: function (data) {
                    if (data.trim() == 'Success') {

                        $.ajax({
                            type: 'POST',
                            url: 'sale-load-deposit.php',
                            data: {
                                dataGrid: {mainID: mainID, month: btnTabMonth},
                            },
                            success: function (result) {
                                document.getElementById("loadSaleData").innerHTML = result;
                                $(".overlayBG").hide();
                            }
                        });

                    } else {
                        alert('Error !!');
                    }
                }
            });
        }
    }

</script>