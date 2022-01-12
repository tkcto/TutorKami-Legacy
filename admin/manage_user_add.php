<?php
require_once('classes/newsletter.class.php');
$instNews = new newsletter;
$resNwtt = $instNews->ListNewsletterTemplate();

if ($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff') {
    exit();
}
?>

<style>
    .profile-btn {
        padding-left: 2px;
        padding-top: 9px;

    }
    .btn.btn-primary:disabled {
        background-color: #FF4500;
        border-color: #FF4500;
    }

    .btn-copy {
        color: #ffffff;
        background-color: #244782;
        border-color: #244782;
    }

    .btn-copy:hover,
    .btn-copy:focus,
    .btn-copy:active,
    .btn-copy.active,
    .open .dropdown-toggle.btn-copy {
        color: #ffffff;
        background-color: #244782;
        border-color: #244782;
    }

    .btn-copy:active,
    .btn-copy.active,
    .open .dropdown-toggle.btn-copy {
        background-image: none;
    }

    .btn-copy.disabled,
    .btn-copy[disabled],
    fieldset[disabled] .btn-copy,
    .btn-copy.disabled:hover,
    .btn-copy[disabled]:hover,
    fieldset[disabled] .btn-copy:hover,
    .btn-copy.disabled:focus,
    .btn-copy[disabled]:focus,
    fieldset[disabled] .btn-copy:focus,
    .btn-copy.disabled:active,
    .btn-copy[disabled]:active,
    fieldset[disabled] .btn-copy:active,
    .btn-copy.disabled.active,
    .btn-copy[disabled].active,
    fieldset[disabled] .btn-copy.active {
        background-color: #244782;
        border-color: #244782;
    }

    .btn-copy .badge {
        color: #244782;
        background-color: #ffffff;
    }

    .text-success {
        color: #28a745;
    }


    .btn-WA-black {
        color: #ffffff;
        background-color: #0C0B0D;
        border-color: #0C0B0D;
    }

    .btn-WA-black:hover,
    .btn-WA-black:focus,
    .btn-WA-black:active,
    .btn-WA-black.active,
    .open .dropdown-toggle.btn-WA-black {
        color: #ffffff;
        background-color: #0C0B0D;
        border-color: #0C0B0D;
    }

    .btn-WA-black:active,
    .btn-WA-black.active,
    .open .dropdown-toggle.btn-WA-black {
        background-image: none;
    }

    .btn-WA-black.disabled,
    .btn-WA-black[disabled],
    fieldset[disabled] .btn-WA-black,
    .btn-WA-black.disabled:hover,
    .btn-WA-black[disabled]:hover,
    fieldset[disabled] .btn-WA-black:hover,
    .btn-WA-black.disabled:focus,
    .btn-WA-black[disabled]:focus,
    fieldset[disabled] .btn-WA-black:focus,
    .btn-WA-black.disabled:active,
    .btn-WA-black[disabled]:active,
    fieldset[disabled] .btn-WA-black:active,
    .btn-WA-black.disabled.active,
    .btn-WA-black[disabled].active,
    fieldset[disabled] .btn-WA-black.active {
        background-color: #0C0B0D;
        border-color: #0C0B0D;
    }

    .btn-WA-black .badge {
        color: #0C0B0D;
        background-color: #ffffff;
    }

    .btn-WA {
        color: #ffffff;
        background-color: #25D366;
        border-color: #25D366;
    }

    .btn-WA:hover,
    .btn-WA:focus,
    .btn-WA:active,
    .btn-WA.active,
    .open .dropdown-toggle.btn-WA {
        color: #ffffff;
        background-color: #25D366;
        border-color: #25D366;
    }

    .btn-WA:active,
    .btn-WA.active,
    .open .dropdown-toggle.btn-WA {
        background-image: none;
    }

    .btn-WA.disabled,
    .btn-WA[disabled],
    fieldset[disabled] .btn-WA,
    .btn-WA.disabled:hover,
    .btn-WA[disabled]:hover,
    fieldset[disabled] .btn-WA:hover,
    .btn-WA.disabled:focus,
    .btn-WA[disabled]:focus,
    fieldset[disabled] .btn-WA:focus,
    .btn-WA.disabled:active,
    .btn-WA[disabled]:active,
    fieldset[disabled] .btn-WA:active,
    .btn-WA.disabled.active,
    .btn-WA[disabled].active,
    fieldset[disabled] .btn-WA.active {
        background-color: #25D366;
        border-color: #25D366;
    }

    .btn-WA .badge {
        color: #25D366;
        background-color: #ffffff;
    }

    .btn-rform {
        color: #ffffff;
        background-color: #7D0A2A;
        border-color: #7D0A2A;
    }

    .btn-rform:hover,
    .btn-rform:focus,
    .btn-rform:active,
    .btn-rform.active,
    .open .dropdown-toggle.btn-rform {
        color: #ffffff;
        background-color: #7D0A2A;
        border-color: #7D0A2A;
    }

    .btn-rform:active,
    .btn-rform.active,
    .open .dropdown-toggle.btn-rform {
        background-image: none;
    }

    .btn-rform.disabled,
    .btn-rform[disabled],
    fieldset[disabled] .btn-rform,
    .btn-rform.disabled:hover,
    .btn-rform[disabled]:hover,
    fieldset[disabled] .btn-rform:hover,
    .btn-rform.disabled:focus,
    .btn-rform[disabled]:focus,
    fieldset[disabled] .btn-rform:focus,
    .btn-rform.disabled:active,
    .btn-rform[disabled]:active,
    fieldset[disabled] .btn-rform:active,
    .btn-rform.disabled.active,
    .btn-rform[disabled].active,
    fieldset[disabled] .btn-rform.active {
        background-color: #7D0A2A;
        border-color: #7D0A2A;
    }


    .btn-danger2 {
        color: #ffffff;
        background-color: #E61C4E;
        border-color: #E61C4E;
    }

    .btn-danger2:hover,
    .btn-danger2:focus,
    .btn-danger2:active,
    .btn-danger2.active,
    .open .dropdown-toggle.btn-danger2 {
        color: #ffffff;
        background-color: #E61C4E;
        border-color: #E61C4E;
    }

    .btn-danger2:active,
    .btn-danger2.active,
    .open .dropdown-toggle.btn-danger2 {
        background-image: none;
    }

    .btn-danger2.disabled,
    .btn-danger2[disabled],
    fieldset[disabled] .btn-danger2,
    .btn-danger2.disabled:hover,
    .btn-danger2[disabled]:hover,
    fieldset[disabled] .btn-danger2:hover,
    .btn-danger2.disabled:focus,
    .btn-danger2[disabled]:focus,
    fieldset[disabled] .btn-danger2:focus,
    .btn-danger2.disabled:active,
    .btn-danger2[disabled]:active,
    fieldset[disabled] .btn-danger2:active,
    .btn-danger2.disabled.active,
    .btn-danger2[disabled].active,
    fieldset[disabled] .btn-danger2.active {
        background-color: #E61C4E;
        border-color: #E61C4E;
    }

    .btn-danger2 .badge {
        color: #E61C4E;
        background-color: #ffffff;
    }




    .btn-green {
        color: #ffffff;
        background-color: #557366;
        border-color: #557366;
    }

    .btn-green:hover,
    .btn-green:focus,
    .btn-green:active,
    .btn-green.active,
    .open .dropdown-toggle.btn-green {
        color: #ffffff;
        background-color: #4E665C;
        border-color: #557366;
    }

    .btn-green:active,
    .btn-green.active,
    .open .dropdown-toggle.btn-green {
        background-image: none;
    }

    .btn-green.disabled,
    .btn-green[disabled],
    fieldset[disabled] .btn-green,
    .btn-green.disabled:hover,
    .btn-green[disabled]:hover,
    fieldset[disabled] .btn-green:hover,
    .btn-green.disabled:focus,
    .btn-green[disabled]:focus,
    fieldset[disabled] .btn-green:focus,
    .btn-green.disabled:active,
    .btn-green[disabled]:active,
    fieldset[disabled] .btn-green:active,
    .btn-green.disabled.active,
    .btn-green[disabled].active,
    fieldset[disabled] .btn-green.active {
        background-color: #557366;
        border-color: #557366;
    }

    .btn-green .badge {
        color: #557366;
        background-color: #ffffff;
    }




    .btn-reset {
        color: #ffffff;
        background-color: #D60000;
        border-color: #D60000;
    }

    .btn-reset:hover,
    .btn-reset:focus,
    .btn-reset:active,
    .btn-reset.active,
    .open .dropdown-toggle.btn-reset {
        color: #ffffff;
        background-color: #D60000;
        border-color: #D60000;
    }

    .btn-reset:active,
    .btn-reset.active,
    .open .dropdown-toggle.btn-reset {
        background-image: none;
    }

    .btn-reset.disabled,
    .btn-reset[disabled],
    fieldset[disabled] .btn-reset,
    .btn-reset.disabled:hover,
    .btn-reset[disabled]:hover,
    fieldset[disabled] .btn-reset:hover,
    .btn-reset.disabled:focus,
    .btn-reset[disabled]:focus,
    fieldset[disabled] .btn-reset:focus,
    .btn-reset.disabled:active,
    .btn-reset[disabled]:active,
    fieldset[disabled] .btn-reset:active,
    .btn-reset.disabled.active,
    .btn-reset[disabled].active,
    fieldset[disabled] .btn-reset.active {
        background-color: #D60000;
        border-color: #D60000;
    }

    .btn-reset .badge {
        color: #D60000;
        background-color: #ffffff;
    }




    .btn-green {
        color: #ffffff;
        background-color: #557366;
        border-color: #557366;
    }

    .btn-green:hover,
    .btn-green:focus,
    .btn-green:active,
    .btn-green.active,
    .open .dropdown-toggle.btn-green {
        color: #ffffff;
        background-color: #4E665C;
        border-color: #557366;
    }

    .btn-green:active,
    .btn-green.active,
    .open .dropdown-toggle.btn-green {
        background-image: none;
    }

    .btn-green.disabled,
    .btn-green[disabled],
    fieldset[disabled] .btn-green,
    .btn-green.disabled:hover,
    .btn-green[disabled]:hover,
    fieldset[disabled] .btn-green:hover,
    .btn-green.disabled:focus,
    .btn-green[disabled]:focus,
    fieldset[disabled] .btn-green:focus,
    .btn-green.disabled:active,
    .btn-green[disabled]:active,
    fieldset[disabled] .btn-green:active,
    .btn-green.disabled.active,
    .btn-green[disabled].active,
    fieldset[disabled] .btn-green.active {
        background-color: #557366;
        border-color: #557366;
    }

    .btn-green .badge {
        color: #557366;
        background-color: #ffffff;
    }



</style>


<?php
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */

if (isset($_GET['action']) && $_GET['action'] == 'add_new') {
    $thisPage = 'Add ' . $breadcrumb['m_name'] . ' Page';
    $updateLastPage = " UPDATE tk_user SET last_page='" . $thisPage . "' WHERE u_id='" . $sessionIDLogin . "' ";
    if ($conDB->query($updateLastPage) === true) {
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $thisPage = 'Edit ' . $breadcrumb['m_name'] . ' Page';
    $updateLastPage = " UPDATE tk_user SET last_page='" . $thisPage . "' WHERE u_id='" . $sessionIDLogin . "' ";
    if ($conDB->query($updateLastPage) === true) {
    }
    if (isset($userRow) && $userRow !== null) {
        if ($_SESSION[DB_PREFIX]['u_id'] != '8') {
            //25/10/2019
            if ($userRow['ud_admin_comment'] == '') {

                $id = 'Display ID : ' . $userRow['u_displayid'] . '<br>';
                $adminComment = 'Admin Comment : NULL';
                $actionLog = $id . '' . $adminComment;

                $insertLog = " INSERT INTO tk_user_log2 SET user = '" . $_SESSION[DB_PREFIX]['u_id'] . "', date = '" . date('Y-m-d') . "', time = '" . date('H:i:s') . "', action = '" . $actionLog . "' ";
                $exe = $conDB->query($insertLog);
            }
            if ($userRow['ud_admin_comment'] !== '') {

                $id = 'Display ID : ' . $userRow['u_displayid'] . '<br>';
                $adminComment = 'Admin Comment : ' . $userRow['ud_admin_comment'];
                $actionLog = $id . '' . $adminComment;

                $insertLog = " INSERT INTO tk_user_log2 SET user = '" . $_SESSION[DB_PREFIX]['u_id'] . "', date = '" . date('Y-m-d') . "', time = '" . date('H:i:s') . "', action = '" . $actionLog . "' ";
                $exe = $conDB->query($insertLog);
            }
        }

    }
} else {
    $thisPage = $breadcrumb['m_name'] . ' Page';
    $updateLastPage = " UPDATE tk_user SET last_page='" . $thisPage . "' WHERE u_id='" . $sessionIDLogin . "' ";
    if ($conDB->query($updateLastPage) === true) {
    }
}
//$dbCon->close();

function getBetween($string, $start = "", $end = "") {
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return '';
    }
}

?>
<link rel="stylesheet" href="https://www.tutorkami.com/css/balloon.min.css">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" id="frmMain" enctype="multipart/form-data">
                <?php echo (isset($userRow) && $userRow !== null) ? '<input type="hidden" name="u_id" value="' . $userRow['u_id'] . '">' : ''; ?>
                <?php echo (isset($userRow) && $userRow !== null) ? '<input type="hidden" name="logdisplayid" value="' . $userRow['u_displayid'] . '">' : ''; ?>
                <input type="hidden" name="sessionIDLogin" id="sessionIDLogin" value="<?PHP echo $sessionIDLogin; ?>">
                <div class="ibox float-e-margins localization">
                    <div class="ibox-title">
                        <h5> Edit Customer Details</h5>

                        <div class="ibox-tools">
                            <a href="manage_user.php" class="pull-left"><small>(back to customer list)</small></a>
                            <a href="https://docs.google.com/document/d/1jeHy-zPenl4o34QszXa6Vfy0RkGEnvA9wBJg3ddQeT8/edit" target="_blank" class="pull-left"><i class="glyphicon glyphicon-info-sign" style="color:#262262"></i></a>
                            <?php

                            if (isset($userRow) && $userRow !== null && $userRow['u_role'] != 4) {//luqman hide approve tutor klu bukan parent
                                if (isset($userRow) && $userRow !== null && $userRow['u_role'] != 2) {//luqman hide approve tutor klu bukan admin

                                    if ($userRow['u_status'] == 'P' || $userRow['u_status'] == 'A') {//tutor
                                        if ($userRow['u_admin_approve'] == 0 || $userRow['u_admin_approve'] == null) {
                                            //echo '<button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="approve_tutor" type="submit">Approve Tutor</button>';
                                            /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
                                            $dataPhone = "SELECT * FROM " . DB_PREFIX . "_user INNER JOIN " . DB_PREFIX . "_user_details ON u_id = ud_u_id WHERE (u_status='A' OR u_admin_approve='1' OR u_admin_approve='2')  AND ud_phone_number = '" . $userRow['ud_phone_number'] . "'";
                                            $resultPhone = $conDB->query($dataPhone);
                                            if ($resultPhone->num_rows > 0) {
                                                echo '<div id="showBanned" class="btn btn-sm btn-primary sign-btn-box mrg-right-15 href="#" onClick="javascript:showBanned();" type="button">Approve Tutor</div>';
                                                echo '<div id="showBanned2" style="display:none;background-color: #FF4500;border-color: #FF4500;" class="btn btn-sm btn-primary sign-btn-box mrg-right-15 type="button" disabled>Approve Tutor</div>';
                                            } else {
                                                echo '<button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="approve_tutor" type="submit">Approve Tutor</button>';
                                            }

                                            //$dbCon->close();


                                            /* START fadhli - Manual Activated*/
                                        } else {
                                            if ($userRow['u_admin_approve'] == 10) {
                                                echo '<button class="btn btn-sm btn-info" name="manualActivated" type="submit">Activated Email</button>';
                                                /* END fadhli */
                                            } elseif ($userRow['u_admin_approve'] == 1) {
                                                echo '<small>(Admin Approved)</small> <button class="btn btn-sm btn-success" name="manualActive" type="submit">Manual Active</button>';
                                            } elseif ($userRow['u_admin_approve'] == 2) {
                                                echo '<small class="text-success">(Activated)</small>';
                                            }
                                        }


                                    } elseif ($userRow['u_status'] == 'A') {
                                        echo '<small class="text-success">(Active)</small>';
                                    } elseif ($userRow['u_status'] == 'B') {
                                        echo '<small class="text-danger" style="color:#ae0202;font-size:13px;margin-right:40px;"><b>(Banned)</b></small>';                           /*new user status added on 14/10/21 (siti) value is C*/
                                    } elseif ($userRow['u_status'] == 'C') {
                                        echo '<small class="text-danger" style="color:#ae0202;font-size:13px;margin-right:40px;"><b>(DON' . "'" . 'T HIRE)</b></small>';
                                    }
                                    //tutor
                                    //admin
                                } elseif ($userRow['u_status'] == 'P') {
                                    echo '<small>(Pending)</small>';
                                } elseif ($userRow['u_status'] == 'A') {
                                    echo '<small class="text-success">(Admin Active)</small>';
                                } elseif ($userRow['u_status'] == 'B') {
                                    echo '<small class="text-danger">(Admin Banned)</small>';
                                }

                                //parent
                            } elseif ($userRow['u_status'] == 'P') {
                                echo '<small>(Pending)</small>';
                            } elseif ($userRow['u_status'] == 'A') {
                                //echo '<small class="text-success">(Parent Active)</small>';
                                if ($userRow['ud_client_status_2'] != null && $userRow['ud_client_status_2'] == 'Tuition Centre') {
                                    echo '<small class="text-success">(TC Active)</small>';
                                } else {
                                    echo '<small class="text-success">(Parent Active)</small>';
                                }

                            } elseif ($userRow['u_status'] == 'C') {
                                if ($userRow['ud_client_status_2'] != null && $userRow['ud_client_status_2'] == 'Tuition Centre') {
                                    echo '<small class="text-success">(DON' . "'" . 'T HIRE)</small>';
                                } else {
                                    echo '<small class="text-danger">(DON' . "'" . 'T HIRE)</small>';
                                }
                            } elseif ($userRow['u_status'] == 'B') {
                                //echo '<small class="text-danger">(Parent Banned)</small>';
                                if ($userRow['ud_client_status_2'] != null && $userRow['ud_client_status_2'] == 'Tuition Centre') {
                                    echo '<small class="text-success">(TC Banned)</small>';
                                } else {
                                    echo '<small class="text-danger">(Parent Banned)</small>';
                                }                    //parent
                            }


                            ?>
                            <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                            <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">S&CE</button>
                            <?php if (isset($userRow) && $userRow !== null) { ?>
                                <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" title="Delete" onClick="if(confirm('Are you sure, you want to remove the user?'))document.location.href='manage_user.php?action=delete_user&u_id=<?php echo $userRow['u_id']; ?>'">Delete</button>
                            <?php } ?>
                        </div>
                        <div class="tabs-container">
                            <ul class="nav nav-tabs" id="myid">
                                <li onClick="clickLi(this.id)" id="this1" class="active"><a data-toggle="tab" href="#tab-1"> Customer Info</a></li>
                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 2) { ?>
                                    <li onClick="clickLi(this.id)" id="this2" class=""><a data-toggle="tab" href="#tab-2">Customer Roles</a></li>
                                <?php } ?>
                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                                    <li onClick="clickLi(this.id)" id="this5" class=""><a data-toggle="tab" href="#tab-5">Location Info</a></li>
                                    <li onClick="clickLi(this.id)" id="this6" class=""><a data-toggle="tab" href="#tab-6">Subject Info</a></li>
                                    <li onClick="clickLi(this.id)" id="this10" class=""><a data-toggle="tab" href="#tab-10">Schedule</a></li>
                                    <?PHP
                                    if (isset($userRow) && $userRow['url_video'] != '') {
                                        $videoBgColor = ' style="background-color:#f1592a;color:white" ';
                                    } else {
                                        $videoBgColor = '';
                                    }
                                    ?>
                                    <li onClick="clickLi(this.id)" id="this3" class=""><a <?PHP echo $videoBgColor; ?> data-toggle="tab" href="#tab-3">Testimonials</a></li>
                                    <li onClick="clickLi(this.id)" id="thisTabRating" class=""><a data-toggle="tab" href="#tabRating">Rating</a></li>
                                    <li onClick="clickLi(this.id)" id="this2" class=""><a data-toggle="tab" href="#tab-2">Customer Roles</a></li>


                                    <?PHP
                                    /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
                                    if ($userRow['signature_img'] != '') {

                                        $this4 = 'this4';

                                        $getSig = $userRow['signature_img'];
                                        $getSig = strtok($getSig, '_');
                                        $getSig = str_replace('-', '/', $getSig);
                                        //$getSig = '02/03/2020';

                                        $dateConvert = strtotime($getSig);
                                        //$dateFormat = date('Y-m-d', $dateConvert);

                                        $b = explode('/', $getSig);
                                        $dateFormat = (int) ($b[2] . $b[1] . $b[0]);

                                        $getTime = getBetween($userRow['signature_img'], "_", "_");
                                        //$getTime =  str_replace("-",":",substr($getTime, 0, -2)).':00';
                                        if (strlen($getTime) == '7') {
                                            $getTime = str_replace("-", ":", substr($getTime, 0, -2)) . ':00';
                                        } else {
                                            $getTime = str_replace("-", ":", $getTime) . ':00';
                                        }


                                        $queryProof1 = "SELECT * FROM " . DB_PREFIX . "_page_manage_translation WHERE pmt_id='76' ";
                                        $resultProof1 = $conDB->query($queryProof1);
                                        if ($resultProof1->num_rows > 0) {
                                            $rowProof1 = $resultProof1->fetch_assoc();
                                            $dateLastupdated2 = $rowProof1['pmt_lastupdated'];
                                            $timeSaveTerms = $rowProof1['pmt_time'];


                                            $dateConvert2 = strtotime($dateLastupdated2);
                                            //$dateFormat2 = date('Y-m-d', $dateConvert2);

                                            $a = explode('/', $rowProof1['pmt_lastupdated']);
                                            $dateFormat2 = (int) ($a[2] . $a[1] . $a[0]);

                                            if ($dateFormat2 > $dateFormat) {
                                                $bgColor = 'eff215'; // yellow
                                                $fColor = 'white';
                                            } else {
                                                if ($dateFormat2 < $dateFormat) {
                                                    $bgColor = '5cb85c'; //green
                                                    $fColor = 'white';
                                                } else {
                                                    if ($dateFormat2 = $dateFormat) {
                                                        if ($timeSaveTerms >= $getTime) {
                                                            $bgColor = 'eff215'; // yellow
                                                            $fColor = 'white';
                                                        } else {
                                                            $bgColor = '5cb85c'; //green
                                                            $fColor = 'white';
                                                        }
                                                    } else {
                                                        $bgColor = '';
                                                        $fColor = '';
                                                    }
                                                }
                                            }
                                        } else {
                                            $bgColor = '';
                                            $fColor = '';
                                        }
                                        echo '<li onClick="clickLi(this.id)" id="this4" class="" style="margin-right:5px;background-color:#' . $bgColor . '" ><a data-toggle="tab" href="#tab-4"><span id="fColor" color="' . $fColor . '">Proof1</span></a></li>';
                                    } else {
                                        echo '<li onClick="clickLi(this.id)" id="this4" class="" style="margin-right:5px;"><a data-toggle="tab" href="#tab-4"><span>Proof1</span></a></li>';
                                    }

                                    if ($userRow['signature_img2'] != '') {

                                        $thisProof2 = 'thisProof2';

                                        $agetSig = $userRow['signature_img2'];
                                        $agetSig = strtok($agetSig, '_');
                                        $agetSig = str_replace('-', '/', $agetSig);

                                        $adateConvert = strtotime($agetSig);
                                        //$adateFormat = date('Y-m-d', $adateConvert);

                                        $c = explode('/', $agetSig);
                                        $adateFormat = (int) ($c[2] . $c[1] . $c[0]);

                                        $getTime = getBetween($userRow['signature_img2'], "_", "_");
                                        //$getTime =  str_replace("-",":",substr($getTime, 0, -2)).':00';
                                        if (strlen($getTime) == '7') {
                                            $getTime = str_replace("-", ":", substr($getTime, 0, -2)) . ':00';
                                        } else {
                                            $getTime = str_replace("-", ":", $getTime) . ':00';
                                        }

                                        $queryProof2 = "SELECT * FROM " . DB_PREFIX . "_page_manage_translation WHERE pmt_id='82' ";
                                        $resultProof2 = $conDB->query($queryProof2);
                                        if ($resultProof2->num_rows > 0) {
                                            $rowProof2 = $resultProof2->fetch_assoc();
                                            $adateLastupdated2 = $rowProof2['pmt_lastupdated'];
                                            $timeSaveTerms = $rowProof2['pmt_time'];


                                            $adateConvert2 = strtotime($adateLastupdated2);
                                            //$adateFormat2 = date('Y-m-d', $adateConvert2);

                                            $d = explode('/', $rowProof2['pmt_lastupdated']);
                                            $adateFormat2 = (int) ($d[2] . $d[1] . $d[0]);

                                            if ($adateFormat2 > $adateFormat) {
                                                $abgColor = 'eff215'; // yellow
                                                $afColor = 'white';
                                            } else {
                                                if ($adateFormat2 < $adateFormat) {
                                                    $abgColor = '5cb85c'; //green
                                                    $afColor = 'white';
                                                } else {
                                                    if ($adateFormat2 = $adateFormat) {
                                                        if ($timeSaveTerms >= $getTime) {
                                                            $abgColor = 'eff215'; // yellow
                                                            $afColor = 'white';
                                                        } else {
                                                            $abgColor = '5cb85c'; //green
                                                            $afColor = 'white';
                                                        }
                                                    } else {
                                                        $abgColor = '';
                                                        $afColor = '';
                                                    }
                                                }
                                            }


                                        } else {
                                            $abgColor = '';
                                            $afColor = '';
                                        }

                                        echo '<li onClick="clickLi(this.id)" id="thisProof2" class="" style="background-color:#' . $abgColor . '" ><a data-toggle="tab" href="#tab-Proof2"><span id="afColor" color="' . $afColor . '">Proof2</span></a></li>';
                                    } else {
                                        echo '<li onClick="clickLi(this.id)" id="thisProof2" class=""><a data-toggle="tab" href="#tab-Proof2"><span>Proof2</span></a></li>';
                                    }
                                    //$dbCon->close();
                                    ?>
                                    <li id="thisPV" class=""><a data-toggle="tab" href="#tab-PV">PV</a></li>


                                    <!--<li onClick="clickLi(this.id)" id="this4" class="" style="background-color:#<?PHP //echo $bgColor;?>" ><a data-toggle="tab" href="#tab-4"><font id="fColor" color="<?PHP //echo $fColor;?>">Proof1</font></a></li>
                        <li onClick="clickLi(this.id)" id="thisProof2" class=""><a data-toggle="tab" href="#tab-Proof2">Proof2</a></li>-->
                                <?php } ?>
                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) { ?>

                                    <li id="this7" class=""><a data-toggle="tab" href="#tab-7">Invoice</a></li>
                                    <li onClick="clickLi(this.id)" id="this2" class=""><a data-toggle="tab" href="#tab-2">Customer Roles</a></li>


                                    <?PHP
                                    if ($userRow['ud_client_status_2'] != null && $userRow['ud_client_status_2'] != 'Tuition Centre') {
                                        if ($userRow['signature_img'] != '') {

                                            $this4 = 'this4';

                                            $getSig = $userRow['signature_img'];
                                            $getSig = strtok($getSig, '_');
                                            $getSig = str_replace('-', '/', $getSig);

                                            $dateConvert = strtotime($getSig);

                                            $b = explode('/', $getSig);
                                            $dateFormat = (int) ($b[2] . $b[1] . $b[0]);

                                            $getTime = getBetween($userRow['signature_img'], "_", "_");
                                            if (strlen($getTime) == '7') {
                                                $getTime = str_replace("-", ":", substr($getTime, 0, -2)) . ':00';
                                            } else {
                                                $getTime = str_replace("-", ":", $getTime) . ':00';
                                            }


                                            $queryProof1 = "SELECT * FROM " . DB_PREFIX . "_page_manage_translation WHERE pmt_id='78' ";
                                            $resultProof1 = $conDB->query($queryProof1);
                                            if ($resultProof1->num_rows > 0) {
                                                $rowProof1 = $resultProof1->fetch_assoc();
                                                $dateLastupdated2 = $rowProof1['pmt_lastupdated'];
                                                $timeSaveTerms = $rowProof1['pmt_time'];


                                                $dateConvert2 = strtotime($dateLastupdated2);

                                                $a = explode('/', $rowProof1['pmt_lastupdated']);
                                                $dateFormat2 = (int) ($a[2] . $a[1] . $a[0]);

                                                if ($dateFormat2 > $dateFormat) {
                                                    $bgColor = 'eff215'; // yellow
                                                    $fColor = 'white';
                                                } else {
                                                    if ($dateFormat2 < $dateFormat) {
                                                        $bgColor = '5cb85c'; //green
                                                        $fColor = 'white';
                                                    } else {
                                                        if ($dateFormat2 = $dateFormat) {
                                                            if ($timeSaveTerms >= $getTime) {
                                                                $bgColor = 'eff215'; // yellow
                                                                $fColor = 'white';
                                                            } else {
                                                                $bgColor = '5cb85c'; //green
                                                                $fColor = 'white';
                                                            }
                                                        } else {
                                                            $bgColor = '';
                                                            $fColor = '';
                                                        }
                                                    }
                                                }
                                            } else {
                                                $bgColor = '';
                                                $fColor = '';
                                            }
                                            echo '<li onClick="clickLi(this.id)" id="thisparent4" class="" style="margin-right:5px;background-color:#' . $bgColor . '" ><a data-toggle="tab" href="#tab-parent4"><span id="fColor" color="' . $fColor . '">Proof1 (for 1-1 tuition)</span></a></li>';
                                        } else {
                                            echo '<li onClick="clickLi(this.id)" id="thisparent4" class="" style="margin-right:5px;"><a data-toggle="tab" href="#tab-parent4"><span>Proof1 (for 1-1 tuition)</span></a></li>';
                                        }

                                        if ($userRow['signature_img2'] != '') {

                                            $thisProof2 = 'thisProof2';

                                            $agetSig = $userRow['signature_img2'];
                                            $agetSig = strtok($agetSig, '_');
                                            $agetSig = str_replace('-', '/', $agetSig);

                                            $adateConvert = strtotime($agetSig);

                                            $c = explode('/', $agetSig);
                                            $adateFormat = (int) ($c[2] . $c[1] . $c[0]);

                                            $getTime = getBetween($userRow['signature_img2'], "_", "_");
                                            if (strlen($getTime) == '7') {
                                                $getTime = str_replace("-", ":", substr($getTime, 0, -2)) . ':00';
                                            } else {
                                                $getTime = str_replace("-", ":", $getTime) . ':00';
                                            }

                                            $queryProof2 = "SELECT * FROM " . DB_PREFIX . "_page_manage_translation WHERE pmt_id='80' ";
                                            $resultProof2 = $conDB->query($queryProof2);
                                            if ($resultProof2->num_rows > 0) {
                                                $rowProof2 = $resultProof2->fetch_assoc();
                                                $adateLastupdated2 = $rowProof2['pmt_lastupdated'];
                                                $timeSaveTerms = $rowProof2['pmt_time'];


                                                $adateConvert2 = strtotime($adateLastupdated2);

                                                $d = explode('/', $rowProof2['pmt_lastupdated']);
                                                $adateFormat2 = (int) ($d[2] . $d[1] . $d[0]);

                                                if ($adateFormat2 > $adateFormat) {
                                                    $abgColor = 'eff215'; // yellow
                                                    $afColor = 'white';
                                                } else {
                                                    if ($adateFormat2 < $adateFormat) {
                                                        $abgColor = '5cb85c'; //green
                                                        $afColor = 'white';
                                                    } else {
                                                        if ($adateFormat2 = $adateFormat) {
                                                            if ($timeSaveTerms >= $getTime) {
                                                                $abgColor = 'eff215'; // yellow
                                                                $afColor = 'white';
                                                            } else {
                                                                $abgColor = '5cb85c'; //green
                                                                $afColor = 'white';
                                                            }
                                                        } else {
                                                            $abgColor = '';
                                                            $afColor = '';
                                                        }
                                                    }
                                                }


                                            } else {
                                                $abgColor = '';
                                                $afColor = '';
                                            }

                                            echo '<li onClick="clickLi(this.id)" id="thisProofparent2" class="" style="background-color:#' . $abgColor . '" ><a data-toggle="tab" href="#tab-Proofparent2"><span id="afColor" color="' . $afColor . '">Proof2 (for group tuition)</span></a></li>';
                                        } else {
                                            echo '<li onClick="clickLi(this.id)" id="thisProofparent2" class=""><a data-toggle="tab" href="#tab-Proofparent2"><span>Proof2 (for group tuition)</span></a></li>';
                                        }
                                    } else {

                                        if ($userRow['signature_img3'] != '') {

                                            $this4TuitionCentre = 'this4TuitionCentre';

                                            $getSig = $userRow['signature_img3'];
                                            $getSig = strtok($getSig, '_');
                                            $getSig = str_replace('-', '/', $getSig);

                                            $dateConvert = strtotime($getSig);

                                            $b = explode('/', $getSig);
                                            $dateFormat = (int) ($b[2] . $b[1] . $b[0]);

                                            $getTime = getBetween($userRow['signature_img3'], "_", "_");
                                            if (strlen($getTime) == '7') {
                                                $getTime = str_replace("-", ":", substr($getTime, 0, -2)) . ':00';
                                            } else {
                                                $getTime = str_replace("-", ":", $getTime) . ':00';
                                            }


                                            $queryProof1 = "SELECT * FROM " . DB_PREFIX . "_page_manage_translation WHERE pmt_id='84' ";
                                            $resultProof1 = $conDB->query($queryProof1);
                                            if ($resultProof1->num_rows > 0) {
                                                $rowProof1 = $resultProof1->fetch_assoc();
                                                $dateLastupdated2 = $rowProof1['pmt_lastupdated'];
                                                $timeSaveTerms = $rowProof1['pmt_time'];


                                                $dateConvert2 = strtotime($dateLastupdated2);

                                                $a = explode('/', $rowProof1['pmt_lastupdated']);
                                                $dateFormat2 = (int) ($a[2] . $a[1] . $a[0]);

                                                if ($dateFormat2 > $dateFormat) {
                                                    $bgColor = 'eff215'; // yellow
                                                    $fColor = 'white';
                                                } else {
                                                    if ($dateFormat2 < $dateFormat) {
                                                        $bgColor = '5cb85c'; //green
                                                        $fColor = 'white';
                                                    } else {
                                                        if ($dateFormat2 = $dateFormat) {
                                                            if ($timeSaveTerms >= $getTime) {
                                                                $bgColor = 'eff215'; // yellow
                                                                $fColor = 'white';
                                                            } else {
                                                                $bgColor = '5cb85c'; //green
                                                                $fColor = 'white';
                                                            }
                                                        } else {
                                                            $bgColor = '';
                                                            $fColor = '';
                                                        }
                                                    }
                                                }
                                            } else {
                                                $bgColor = '';
                                                $fColor = '';
                                            }
                                            echo '<li onClick="clickLi(this.id)" id="thisparent4TuitionCentre" class="" style="margin-right:5px;background-color:#' . $bgColor . '" ><a data-toggle="tab" href="#tab-parent4TuitionCentre"><span id="fColor" color="' . $fColor . '">Proof</span></a></li>';
                                        } else {
                                            echo '<li onClick="clickLi(this.id)" id="thisparent4TuitionCentre" class="" style="margin-right:5px;"><a data-toggle="tab" href="#tab-parent4TuitionCentre"><span>Proof</span></a></li>';
                                        }
                                    }
                                    //$dbCon->close();
                                    ?>
                                    <li onClick="clickLi(this.id)" id="this-rform" class=""><a data-toggle="tab" href="#rform">R.Form</a></li>


                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <!-- <div class="form-group hidden">
                                 <label class="col-sm-2 control-label">Username:</label>
                                 <div class="col-sm-10"><input type="hidden" class="form-control" name="u_username" value="<?php echo (isset($userRow) && $userRow !== null) ? $userRow['u_username'] : time(); ?>" data-required></div>
                              </div> -->
                                        <!-- luqman hide sbb save sbgai email spatutnya -->
                                        <div class="row">
                                            <div class="col-md-12">


                                                <div class="text-left <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && $userRow['u_role'] == 4) {
                                                    echo "hidden";
                                                } ?>">
                                                    <?php $pix = sprintf("%'.07d\n", $userRow['u_profile_pic']);
                                                    if (isset($userRow) && $userRow !== null) {
                                                        if ($userRow['u_profile_pic'] != '') {
                                                            //echo "<img src=\"".APP_ROOT."images/profile/".$pix."_0.jpg\" alt=\"profile_pic\" class=\"img-thumbnail\">";//luqman hide, ni accept gmbar yg sedia ada je
                                                            //echo "<img src=\"".APP_ROOT."images/profile/000".$userRow['u_profile_pic']."_0.jpg\" height=\"244\" width=\"190\" alt=\"profile_pic\" class=\"img-thumbnail\">";
                                                            if (is_numeric($userRow['u_profile_pic'])) {
                                                                echo "<img src=\"" . APP_ROOT . "images/profile/" . $pix . "_0.jpg\" alt=\"profile_pic\" class=\"img-thumbnail\">";
                                                            } else {

                                                                if(file_exists(DIR_ROOT . "images/profile/" . $userRow['u_profile_pic'] . ".jpg")) {
                                                                    echo "<img src=\"" . APP_ROOT . "images/profile/" . $userRow['u_profile_pic'] . ".jpg\" alt=\"profile_pic\" class=\"img-thumbnail\" width='250' height='250'>";
                                                                } else {
                                                                    echo "<img src=\"" . APP_ROOT . "images/profile/images/" . $userRow['u_profile_pic'] . ".jpg\" alt=\"profile_pic\" class=\"img-thumbnail\" width='250' height='250'>";
                                                                }
                                                            }
                                                        } elseif ($userRow['u_gender'] == 'M') {
                                                            echo '<img src="' . APP_ROOT . "images/tutor_ma.png" . '" alt="profile_pic" class="img-thumbnail" width="250" height="250">';
                                                        } else {
                                                            echo '<img src="' . APP_ROOT . "images/tutor_mi1.png" . '" alt="profile_pic" class="img-thumbnail" width="250" height="250">';
                                                        }
                                                    }
                                                    ?><p class="profile-btn">
                                                        <input type="file" name="u_profile_pic" id="file-7" class="inputfile inputfile-6" accept="image/*"></p>
                                                </div>

                                                <!-- add job button -->
                                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) { ?>
                                                    <div id="ModalRForm" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="modal-title">
                                                                        <center id="ModalRFormText"></center>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Add Job :</label>

                                                        <?php
                                                        $thisCopyLink = "'https://wa.me/60103169072?text=Subscribe%20TK%20Notification'";
                                                        $fnValue1 = "'Subscribe'";
                                                        $fnValue2 = "'Not Subscribe'";
                                                        $fnValue3 = "'" . $userRow['ud_phone_number'] . "'";
                                                        //$queryLogWa = " SELECT wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_status='POST' AND wa_note LIKE '%".$userRow['ud_phone_number']."%' ";
                                                        $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '" . $userRow['ud_phone_number'] . "' ";
                                                        $resultLogWa = $conDB->query($queryLogWa);
                                                        if ($resultLogWa->num_rows > 0) {
                                                            $rowLogWa = $resultLogWa->fetch_assoc();
                                                            if ($rowLogWa['wa_note'] == 'Yes') {
                                                                $welcomeWa = '<span class="pull-right" >
                                                	<a class="btn btn-WA btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue2 . ')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                	</span>';
                                                            } else {
                                                                $welcomeWa = '<span class="pull-right" >
                                                	<a class="btn btn-danger btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue1 . ')" ><i class="fa fa-whatsapp"></i> Unsubscribe</a>
                                                	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                	</span>';
                                                            }
                                                        } else {

                                                            require_once('classes/whatsapp-api-call.php');

                                                            $website = "https://wa.tutorkami.my/api-docs/";

                                                            $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '" . $userRow['ud_phone_number'] . "' ";
                                                            $resultLogWa2 = $conDB->query($queryLogWa2);
                                                            if ($resultLogWa2->num_rows > 0) {
                                                                $rowLogWa2 = $resultLogWa2->fetch_assoc();
                                                                if ($rowLogWa2['wa_note'] == 'Yes') {
                                                                    $welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-WA btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue2 . ')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                                } else {
                                                                    $welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-danger btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue1 . ')" ><i class="fa fa-whatsapp"></i> Unsubscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                                }
                                                            } else {
                                                                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '" . $userRow['ud_phone_number'] . "', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '" . date('Y-m-d H:i:s') . "' ";
                                                                $exeWaNoti = $conDB->query($sqlWaNoti);
                                                                $welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-WA btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue2 . ')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                            }
                                                            /*
                                                if( !activeAPI( $website ) ) {
                                                    $welcomeWa = '<span class="pull-right" >
                                                    <a class="btn btn-WA-black btn-sm"  ><i class="fa fa-whatsapp"></i> Not Subscribe</a>
                                                    <a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                    </span>';
                                                } else {
                                                    $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$userRow['ud_phone_number']."' ";
                                                    $resultLogWa2 = $conDB->query($queryLogWa2);
                                                    if ($resultLogWa2->num_rows > 0) {
                                                        $rowLogWa2 = $resultLogWa2->fetch_assoc();
                                                        if( $rowLogWa2['wa_note'] == 'Yes' ){
                                                            //$welcomeWa = '<span class="pull-right" >
                                                            //<a class="btn btn-WA btn-sm" onclick="tickSubscribe('.$fnValue3.','.$fnValue2.')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                            //<a data-balloon-length="large" aria-label="Click label to copy the link for client to click in order to subscribe to WA auto message. If label shows ‘Not Subscribe’, it means client has not clicked the link. If label show ‘Subscribe’ means client has clicked the link" data-balloon-pos="up-right" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                            //</span>';
                                                        	$welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-WA btn-sm" onclick="tickSubscribe('.$fnValue3.','.$fnValue2.')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                        }else{
                                                        	$welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-danger btn-sm" onclick="tickSubscribe('.$fnValue3.','.$fnValue1.')" ><i class="fa fa-whatsapp"></i> Unsubscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                        }
                                                    }else{
                                                    	$args = new stdClass();
                                                    	$xdata = new stdClass();
                                                    	$args->contactId = "6".$userRow['ud_phone_number']."@c.us";
                                                    	$xdata->args = $args;

                                                    	$make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
                                                    	$response = json_decode($make_call, true);
                                                    	$dataPhone     = $response['response']['id'];

                                                    	if( $dataPhone != '' ){
                                                    		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$userRow['ud_phone_number']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                                                    		$exeWaNoti = $conDB->query($sqlWaNoti);
                                                        	$welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-WA btn-sm" onclick="tickSubscribe('.$fnValue3.','.$fnValue2.')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                    	}else{
                                                    	    $welcomeWa = '<span class="pull-right" >
                                                    	    <a class="btn btn-WA-black btn-sm"  ><i class="fa fa-whatsapp"></i> Not Subscribe</a>
                                                    	    <a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                    	    </span>';
                                                    	}
                                                    }
                                                }
                                                */
                                                        }

                                                        $cRFORM = " SELECT id, displayid, lang FROM tk_rform WHERE displayid = '" . $_GET['u_id'] . "' ORDER BY id DESC ";
                                                        $resultcRFORM = $conDB->query($cRFORM);
                                                        if ($resultcRFORM->num_rows > 0) {
                                                            $rowcRFORM = $resultcRFORM->fetch_assoc();
                                                            $adaDB = " btn-rform ";
                                                            $adaDB2 = "Filled ";
                                                            $adaDB3 = " (" . $rowcRFORM['lang'] . ") ";
                                                        } else {
                                                            $adaDB = " btn-warning ";
                                                            $adaDB2 = "R.Form ";
                                                            $adaDB3 = "";
                                                        }

                                                        $LinkRFormBM = 'https://www.tutorkami.com/my/rform?token=' . $_GET['u_id'];
                                                        $LinkRFormBI = 'https://www.tutorkami.com/rform?token=' . $_GET['u_id'];
                                                        $testing = '
  <div class="btn-group" style="margin-left:20%">
	  <button class="btn ' . $adaDB . ' dropdown-toggle btn-sm" type="button" data-toggle="dropdown">' . $adaDB2 . ' ' . $adaDB3 . '  <span class="caret"></span></button>
	  <ul class="dropdown-menu">
		  <li onclick="getLinkRForm(this.id, \'' . $LinkRFormBM . '\')" id="bm"><a>BM</a></li>
		  <li onclick="getLinkRForm(this.id, \'' . $LinkRFormBI . '\')" id="bi"><a>English</a></li>
	  </ul>
  </div>';


                                                        if ($userRow['u_lang'] != '') {
                                                            $dataLangClient = '<span id="valLang">' . $userRow['u_lang'] . '</span>';
                                                            $dataLangClient2 = $userRow['u_lang'];
                                                        } else {
                                                            $dataLangClient = '<span id="valLang">Language</span>';
                                                            $dataLangClient2 = '';
                                                        }
                                                        $langClient = '
      <input type="hidden" class="form-control" id="Language" name="Language" value="' . $dataLangClient2 . '" data-required>
      <div class="btn-group" style="margin-left:20%">
    	  <button class="btn btn-default  dropdown-toggle btn-sm" type="button" data-toggle="dropdown">' . $dataLangClient . ' &nbsp;&nbsp;<span class="caret"></span></button>
    	  <ul class="dropdown-menu">
    		  <li onclick="getLang(this.id)" id="BM"><a>BM</a></li>
    		  <li onclick="getLang(this.id)" id="EN"><a>EN</a></li>
    	  </ul>
      </div>
';


                                                        if (isset($_GET['u_id'])) {
                                                            $jobResEm = $userInit->GetDisplayIdJobLink($_GET['u_id']);
                                                            $jobRowEm = $jobResEm->fetch_array(MYSQLI_ASSOC);
                                                            if ($jobResEm->num_rows > 0) {
                                                                echo '<div class="col-sm-9">
                                       				        <label class="label label-primary"><a href="job-add?u_id=' . $jobRowEm['u_id'] . '" target="_blank" title="ID: ' . $jobRowEm['u_id'] . '" style="color:#FFF; text-decoration: none;">Add Job</a></label>
                                       				        ' . $langClient . '
                                       				        ' . $testing . '
                                       				        ' . $welcomeWa . '
                                       				    </div> ';
                                                            } else {
                                                                echo 'no rows found';
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                <?php } ?>
                                                <!-- add job button -->

                                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                                                    <div class="clearfix"></div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" style="margin-top:10px;">Display ID :</label>
                                                        <div class="col-sm-2"><input type="text" class="form-control" name="u_displayid" value="<?php echo (isset($_POST['u_displayid'])) ? $_POST['u_displayid'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_displayid'] : ''); ?>" readonly></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-2">
                                                            <button type="button" class="btn btn-copy" onclick="copyFrontEnd('https://www.tutorkami.com/tutor_profile?did=<?php echo (isset($_POST['u_displayid'])) ? $_POST['u_displayid'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_displayid'] : ''); ?>')"><i class="fa fa-copy"></i> Copy to Front Link</button>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?PHP
                                                            if (isset($userRow) && $userRow['u_status'] == 'B') {
                                                                ?>
                                                                <h4 class="text-danger hidden-xs hidden-sm" style="margin-top:10px;color:#ae0202;font-size:13px;margin-left:20px;"><b>Tutor Is Banned</b></h4>
                                                                <h4 class="text-danger hidden-lg hidden-md" style="margin-top:10px;color:#ae0202;font-size:12px;margin-left:60px;"><b>Tutor Is Banned</b></h4>
                                                                <?PHP
                                                            }
                                                            ?>                                                                                <?PHP if (isset($userRow) && $userRow['u_status'] == 'C') { ?>                                            <h4 class="text-danger hidden-xs hidden-sm" style="margin-top:10px;color:#ae0202;font-size:13px;margin-left:20px;"><b>Don't hire this tutor</b></h4>
                                                                <h4 class="text-danger hidden-lg hidden-md" style="margin-top:10px;color:#ae0202;font-size:12px;margin-left:60px;"><b>Don't hire this tutor</b></h4>                                            <?PHP } ?>
                                                        </div>

                                                        <?php
                                                        $thisCopyLink = "'https://wa.me/60103169072?text=Subscribe%20TK%20Notification'";
                                                        $fnValue1 = "'Subscribe'";
                                                        $fnValue2 = "'Not Subscribe'";
                                                        $fnValue3 = "'" . $userRow['ud_phone_number'] . "'";
                                                        $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '" . $userRow['ud_phone_number'] . "' ";
                                                        $resultLogWa = $conDB->query($queryLogWa);
                                                        if ($resultLogWa->num_rows > 0) {
                                                            $rowLogWa = $resultLogWa->fetch_assoc();
                                                            if ($rowLogWa['wa_note'] == 'Yes') {
                                                                /*$welcomeWa = '<span class="pull-right" >
                                                	<a class="btn btn-WA btn-sm" onclick="tickSubscribe('.$fnValue3.','.$fnValue2.')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                	<a data-balloon-length="large" aria-label="Click label to copy the link for client to click in order to subscribe to WA auto message. If label shows ‘Not Subscribe’, it means client has not clicked the link. If label show ‘Subscribe’ means client has clicked the link" data-balloon-pos="up-right" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                	</span>';*/
                                                                $welcomeWa = '<span class="pull-right" >
                                                	<a class="btn btn-WA btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue2 . ')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                	</span>';
                                                            } else {
                                                                $welcomeWa = '<span class="pull-right" >
                                                	<a class="btn btn-danger btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue1 . ')" ><i class="fa fa-whatsapp"></i> Unsubscribe</a>
                                                	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                	</span>';
                                                            }

                                                        } else {

                                                            require_once('classes/whatsapp-api-call.php');

                                                            $website = "https://wa.tutorkami.my/api-docs/";
                                                            $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '" . $userRow['ud_phone_number'] . "' ";
                                                            $resultLogWa2 = $conDB->query($queryLogWa2);
                                                            if ($resultLogWa2->num_rows > 0) {
                                                                $rowLogWa2 = $resultLogWa2->fetch_assoc();
                                                                if ($rowLogWa2['wa_note'] == 'Yes') {
                                                                    $welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-WA btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue2 . ')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                                } else {
                                                                    $welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-danger btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue1 . ')" ><i class="fa fa-whatsapp"></i> Unsubscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                                }
                                                            } else {
                                                                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '" . $userRow['ud_phone_number'] . "', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '" . date('Y-m-d H:i:s') . "' ";
                                                                $exeWaNoti = $conDB->query($sqlWaNoti);
                                                                $welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-WA btn-sm" onclick="tickSubscribe(' . $fnValue3 . ',' . $fnValue2 . ')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                            }
                                                            /*
                                                if( !activeAPI( $website ) ) {
                                                    $welcomeWa = '<span class="pull-right" >
                                                    <a class="btn btn-WA-black btn-sm"  ><i class="fa fa-whatsapp"></i> Not Subscribe</a>
                                                    <a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                    </span>';
                                                } else {
                                                    $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$userRow['ud_phone_number']."' ";
                                                    $resultLogWa2 = $conDB->query($queryLogWa2);
                                                    if ($resultLogWa2->num_rows > 0) {
                                                        $rowLogWa2 = $resultLogWa2->fetch_assoc();
                                                        if( $rowLogWa2['wa_note'] == 'Yes' ){
                                                        	$welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-WA btn-sm" onclick="tickSubscribe('.$fnValue3.','.$fnValue2.')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                        }else{
                                                        	$welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-danger btn-sm" onclick="tickSubscribe('.$fnValue3.','.$fnValue1.')" ><i class="fa fa-whatsapp"></i> Unsubscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                        }
                                                    }else{
                                                    	$args = new stdClass();
                                                    	$xdata = new stdClass();
                                                    	$args->contactId = "6".$userRow['ud_phone_number']."@c.us";
                                                    	$xdata->args = $args;

                                                    	$make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
                                                    	$response = json_decode($make_call, true);
                                                    	$dataPhone     = $response['response']['id'];

                                                    	if( $dataPhone != '' ){
                                                    		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$userRow['ud_phone_number']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                                                    		$exeWaNoti = $conDB->query($sqlWaNoti);
                                                        	$welcomeWa = '<span class="pull-right" >
                                                        	<a class="btn btn-WA btn-sm" onclick="tickSubscribe('.$fnValue3.','.$fnValue2.')" ><i class="fa fa-whatsapp"></i> Subscribe</a>
                                                        	<a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                        	</span>';
                                                    	}else{
                                                    	    $welcomeWa = '<span class="pull-right" >
                                                    	    <a class="btn btn-WA-black btn-sm"  ><i class="fa fa-whatsapp"></i> Not Subscribe</a>
                                                    	    <a href="https://docs.google.com/document/d/1RC4Q-bW6YHe24tqKUt37cGRPnvkRCwZrLAWNeGxOK84/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                                                    	    </span>';
                                                    	}
                                                    }
                                                }
                                                */
                                                        }
                                                        echo $welcomeWa;
                                                        ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="clearfix "></div>
                                                <div class="hr-line-dashed"></div>
                                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { //untuk email tutor?>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Email :</label>
                                                        <input type="hidden" class="form-control" name="hiddenTutorEmail" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : ''); ?>">
                                                        <div class="col-sm-9"><input type="text" class="form-control" name="u_email" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : ''); ?>" data-email></div>
                                                    </div>
                                                <?php } ?>

                                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 2) { //untuk email parent?>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Email :</label>
                                                        <div class="col-sm-9">
                                                            <!-- <div class="input-group">                -->
                                                            <input type="text" class="form-control" name="u_email" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : ''); ?>" data-email>
                                                            <!-- <span class="input-group-addon">@tutorkami.com</span> -->
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <!-- kalau insert new -->
                                                <?php
                                                $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                                                //if($host == 'tutorkami.com/admin/manage_user?action=add_new'){
                                                if ($host == 'www.tutorkami.com/admin/manage_user?action=add_new') {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Key :</label>
                                                        <div class="col-sm-5">

                                                            <input type="text" class="form-control" name="u_email" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : ''); ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-control" name="emailalias" id="emailalias">
                                                                <option value="">Please Select</option>
                                                                <option value="@tutorkami.com" selected>@tutorkami.com</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <!-- kalau insert new -->
                                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) {
                                                    ?>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"><?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) {
                                                                echo 'Email :';
                                                            } else {
                                                                echo 'Last Name :';
                                                            } ?></label>
                                                        <div class="col-sm-9"><input type="text" class="form-control" name="ud_last_name" value="<?php echo (isset($_POST['ud_last_name'])) ? $_POST['ud_last_name'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_last_name'] : ''); ?>"></div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="clearfix"></div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Password :</label>
                                                    <div class="col-sm-9"><input type="password" class="form-control" name="u_password" <?php echo (isset($userRow) && $userRow !== null && $userRow['u_password'] != '') ? '' : 'data-required'; ?>></div>
                                                </div>

                                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) { //untuk email parent?>
                                                    <div class="clearfix"></div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Key :</label>
                                                        <div class="col-sm-9">
                                                            <!-- <div class="input-group">                -->
                                                            <input type="text" class="form-control" name="u_email" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : ''); ?>" data-email>
                                                            <!-- <span class="input-group-addon">@tutorkami.com</span> -->
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Salutation :</label>
                                                        <div class="col-sm-2" style="width:130px;">
                                                            <select class="form-control" name="Salutation" id="Salutation" data-required>
                                                                <option value=""></option>
                                                                <option value="Encik" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Encik' ? 'selected' : ''; ?> >Encik</option>
                                                                <option value="Puan" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Puan' ? 'selected' : ''; ?> >Puan</option>
                                                                <option value="Cik" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Cik' ? 'selected' : ''; ?> >Cik</option>
                                                                <option value="Mr" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Mr' ? 'selected' : ''; ?> >Mr</option>
                                                                <option value="Ms" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Ms' ? 'selected' : ''; ?> >Ms</option>
                                                                <option value="Mrs" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Mrs' ? 'selected' : ''; ?> >Mrs</option>
                                                                <option value="Madam" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Madam' ? 'selected' : ''; ?> >Madam</option>
                                                                <option value="Dato" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Dato' ? 'selected' : ''; ?> >Dato</option>
                                                                <option value="Datin" <?php echo isset($userRow['salutation']) && $userRow['salutation'] == 'Datin' ? 'selected' : ''; ?> >Datin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php } ?>


                                                <div class="clearfix"></div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">First Name :</label>
                                                    <div class="col-sm-9"><input type="text" class="form-control" name="ud_first_name" value="<?php echo (isset($_POST['ud_first_name'])) ? $_POST['ud_first_name'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_first_name'] : ''); ?>" data-required></div>
                                                </div>
                                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] != 4) {
                                                    ?>
                                                    <div class="clearfix"></div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"><?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) {
                                                                echo 'Actual Email :';
                                                            } else {
                                                                echo 'Last Name :';
                                                            } ?></label>
                                                        <div class="col-sm-9"><input type="text" class="form-control" name="ud_last_name" value="<?php echo (isset($_POST['ud_last_name'])) ? $_POST['ud_last_name'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_last_name'] : ''); ?>"></div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="clearfix"></div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Gender : <br>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <div class="form-horizontal i-checks">
                                                            <label> <input type="radio" <?php echo (isset($_POST['u_gender']) && $_POST['u_gender'] == 'M') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['u_gender'] == 'M') ? 'checked=""' : ''); ?> value="M" name="u_gender" data-required> Male</label>
                                                            <label> <input type="radio" <?php echo (isset($_POST['u_gender']) && $_POST['u_gender'] == 'F') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['u_gender'] == 'F') ? 'checked=""' : ''); ?> value="F" name="u_gender" data-required> Female</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>

                                            <!--<div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Display Name :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="u_displayname" value="<?php //echo (isset($_POST['u_displayname'])) ? $_POST['u_displayname'] : ( (isset($userRow) && $userRow !== null) ? $userRow['u_displayname'] : '' ) ;?>" ></div>
                              </div>-->

                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Display Name :</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="u_displayname" value="<?php echo (isset($_POST['u_displayname'])) ? $_POST['u_displayname'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_displayname'] : ''); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Resit/PV Name :</label>
                                                <div class="col-sm-3" style="margin-left:-50px;">
                                                    <input type="text" class="form-control" name="resit_pv_name" value="<?php echo (isset($_POST['resit_pv_name'])) ? $_POST['resit_pv_name'] : ((isset($userRow) && $userRow !== null) ? $userRow['resit_pv_name'] : ''); ?>">
                                                </div>
                                            </div>


                                        <?php } ?>
                                        <div class="clearfix"></div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group" id="dob">
                                            <label class="col-sm-3 control-label">Date Of Birth :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control date_picker" name="ud_dob" value="<?php echo (isset($_POST['ud_dob'])) ? $_POST['ud_dob'] : ((isset($userRow) && $userRow['ud_dob'] != '' && $userRow['ud_dob'] != '0000-00-00') ? date('d/m/Y', strtotime($userRow['ud_dob'])) : ''); ?>" placeholder="select date"/>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group" id="current_company">
                                                <label class="col-sm-3 control-label">Workplace :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control date_picker" name="ud_current_company" value="<?php echo (isset($_POST['ud_current_company'])) ? $_POST['ud_current_company'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_current_company'] : ''); ?>">
                                                </div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Workplace Location :</label>
                                                <div class="col-sm-3">
                                                    <?PHP
                                                    /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                                if ($dbCon->connect_error) {
                                    die("Connection failed: " . $dbCon->connect_error);
                                }
                                $queryCity2 = "SELECT * FROM tk_cities WHERE city_id='".$userRow['ud_city']."' ";
                                    $resultCity2 = $dbCon->query($queryCity2);
                                    if($resultCity2->num_rows > 0){
                                        $rowCity2 = $resultCity2->fetch_assoc();
                                        $outputCity2 = $rowCity2['city_name'];
                                    }else{
                                        $outputCity2 = $userRow['ud_city'];
                                    }
                                $dbCon->close();  */
                                                    ?>
                                                    <!--<input readonly type="hidden" class="form-control" name="ud_city2" id="ud_city2" value="<?php //echo $outputCity2;  ?>" >-->
                                                    <select class="form-control cnty" name="ud_workplace_state" id="ud_workplace_state">
                                                        <option value="">Please Select State</option>
                                                        <?php
                                                        $country_id = 150;
                                                        $stresponse = $initLocation->CountryWiseState($country_id);
                                                        if ($stresponse->num_rows > 0) {
                                                            while ($cu_row = $stresponse->fetch_assoc()) {
                                                                $sel = (isset($_POST['ud_workplace_state']) && $_POST['ud_workplace_state'] == $cu_row['st_id']) ? 'selected' : (($userRow['ud_workplace_state'] == $cu_row['st_id']) ? 'selected' : '');
                                                                echo '<option value="' . $cu_row['st_id'] . '" ' . $sel . '>' . $cu_row['st_name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>


                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control cnty" name="ud_workplace_city" id="ud_workplace_city">
                                                        <option value="">Please Select City</option>
                                                        <?php
                                                        if ((isset($_POST['ud_workplace_state']) && $_POST['ud_workplace_state'] != '') || (isset($userRow) && $userRow !== null && $userRow['ud_workplace_state'] != '')) {
                                                            $stateID = (isset($_POST['ud_workplace_state']) && $_POST['ud_workplace_state'] != '') ? $_POST['ud_workplace_state'] : $userRow['ud_workplace_state'];
                                                            /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                                                if ($dbCon->connect_error) {
                                                    die("Connection failed: " . $dbCon->connect_error);
                                                }*/
                                                            $query = "SELECT * FROM tk_cities WHERE city_st_id='$stateID' ORDER BY city_name ASC";
                                                            $result = $conDB->query($query);
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <option value="<?php echo $row['city_id']; ?>" <?php if ($userRow['ud_workplace_city'] == $row['city_id']) {
                                                                        echo 'selected';
                                                                    } ?> ><?php echo $row['city_name']; ?></option><?php
                                                                }
                                                            }

                                                            //$dbCon->close();
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Current Home Address :</label>
                                                <div class="col-sm-9"><textarea class="form-control" name="ud_address2"><?php echo (isset($_POST['ud_address2'])) ? $_POST['ud_address2'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_address2'] : ''); ?></textarea></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <!-- <div class="form-group">
                                 <label class="col-sm-2 control-label">City:</label>
                                 <div class="col-sm-10"><textarea class="form-control" name="ud_address"><?php echo (isset($_POST['ud_address'])) ? $_POST['ud_address'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_address'] : ''); ?></textarea></div>
                              </div> -->
                                            <!-- luqman -->
                                            <!--<div class="form-group">
                                 <label class="col-sm-3 control-label">City:</label>
                                 <div class="col-sm-9"><textarea class="form-control" style="text-transform:uppercase" name="ud_city"><?php //echo (isset($_POST['ud_city'])) ? $_POST['ud_city'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_city'] : '' );?></textarea></div>
                              </div>-->


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Current City :</label>
                                                <div class="col-sm-3">
                                                    <?PHP
                                                    /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
                                                    $queryCity2 = "SELECT * FROM tk_cities WHERE city_id='" . $userRow['ud_city'] . "' ";
                                                    $resultCity2 = $conDB->query($queryCity2);
                                                    if ($resultCity2->num_rows > 0) {
                                                        $rowCity2 = $resultCity2->fetch_assoc();
                                                        $outputCity2 = $rowCity2['city_name'];
                                                    } else {
                                                        $outputCity2 = $userRow['ud_city'];
                                                    }
                                                    //$dbCon->close();
                                                    ?>
                                                    <input readonly type="hidden" class="form-control" name="ud_city2" id="ud_city2" value="<?php echo $outputCity2; ?>">
                                                    <select class="form-control cnty" name="ud_state" id="ud_state" data-required>
                                                        <option value="">Please Select State</option>
                                                        <?php
                                                        $country_id = 150;
                                                        $stresponse = $initLocation->CountryWiseState($country_id);
                                                        if ($stresponse->num_rows > 0) {
                                                            while ($cu_row = $stresponse->fetch_assoc()) {
                                                                $sel = (isset($_POST['ud_state']) && $_POST['ud_state'] == $cu_row['st_id']) ? 'selected' : (($userRow['ud_state'] == $cu_row['st_id']) ? 'selected' : '');
                                                                echo '<option value="' . $cu_row['st_id'] . '" ' . $sel . '>' . $cu_row['st_name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>


                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control cnty" name="ud_city" id="ud_city" data-required>
                                                        <option value="">Please Select City</option>
                                                        <?php
                                                        if ((isset($_POST['ud_state']) && $_POST['ud_state'] != '') || (isset($userRow) && $userRow !== null && $userRow['ud_state'] != '')) {
                                                            $state_id = (isset($_POST['ud_state']) && $_POST['ud_state'] != '') ? $_POST['ud_state'] : $userRow['ud_state'];
                                                            /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}*/
                                                            $query = "SELECT * FROM tk_cities WHERE city_st_id='$state_id' ORDER BY city_name ASC";
                                                            $result = $conDB->query($query);
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <option value="<?php echo $row['city_id']; ?>" <?php if ($userRow['ud_city'] == $row['city_id']) {
                                                                        echo 'selected';
                                                                    } ?> ><?php echo $row['city_name']; ?></option><?php
                                                                }
                                                            }

                                                            //$dbCon->close();

                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                                <?PHP
                                                if (is_numeric($userRow['ud_city'])) {
                                                    //echo "Yes";
                                                } else {
                                                    //echo "No";
                                                    ?>
                                                    <div class="col-sm-3">
                                                        <textarea class="form-control" style="text-transform:uppercase" name="ud_cityOLD"><?php echo (isset($_POST['ud_city'])) ? $_POST['ud_city'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_city'] : ''); ?></textarea>
                                                    </div>
                                                    <?PHP
                                                }
                                                ?>
                                            </div>


                                            <!-- luqman -->
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phone :</label>
                                            <div class="col-sm-9"><input type="text" class="form-control" name="ud_phone_number" value="<?php echo (isset($_POST['ud_phone_number'])) ? $_POST['ud_phone_number'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_phone_number'] : ''); ?>" data-numeric></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group i-checks">
                                            <label class="col-sm-3 control-label">Race :</label>
                                            <div class="col-sm-9">
                                                <label class="udradio"> <input type="radio" value="Malay" id="" name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] == 'Malay') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_race'] == 'Malay') ? 'checked' : ''); ?>> Malay </label>
                                                <label class="udradio"> <input type="radio" value="Chinese" id="" name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] == 'Chinese') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_race'] == 'Chinese') ? 'checked' : ''); ?>> Chinese</label>
                                                <label class="udradio"> <input type="radio" value="Indian" id="" name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] == 'Indian') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_race'] == 'Indian') ? 'checked' : ''); ?>> Indian</label>
                                                <label class="udradio">
                                                    <input type="radio" value="Others" id="" name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] != 'Malay' && $_POST['ud_race'] != 'Chinese' && $_POST['ud_race'] != 'Indian' && $_POST['ud_race'] != 'Not selected') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_race'] != 'Malay' && $userRow['ud_race'] != 'Chinese' && $userRow['ud_race'] != 'Indian' && $userRow['ud_race'] != 'Not selected') ? 'checked' : ''); ?>> Others</label>
                                                <label class="udradio"> <input type="radio" value="Not selected" id="" name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] == 'Not selected') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_race'] == 'Not selected') ? 'checked' : ''); ?>> Not Selected </label>
                                                <br>
                                                <div id="other_race_wrap">
                                                    <?php
                                                    if (isset($_POST['ud_race']) && $_POST['ud_race'] != 'Malay' && $_POST['ud_race'] != 'Chinese' && $_POST['ud_race'] != 'Indian' && $_POST['ud_race'] != 'Not Selected') {
                                                        echo '<textarea name="ud_race" class="form-control">' . $_POST['ud_race'] . '</textarea>';
                                                    } elseif (isset($userRow) && $userRow !== null && $userRow['ud_race'] != 'Malay' && $userRow['ud_race'] != 'Chinese' && $userRow['ud_race'] != 'Indian' && $userRow['ud_race'] != 'Not selected') {
                                                        echo '<textarea name="ud_race" class="form-control">' . $userRow['ud_race'] . '</textarea>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- START fadhli - hide Nationality -->
                                        <?PHP
                                        if (isset($userRow) && $userRow['u_role'] == 3) {
                                            ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group i-checks">
                                                <label class="col-sm-3 control-label">Marital Status :</label>
                                                <div class="col-sm-9">
                                                    <label class="udradio"> <input type="radio" value="Married" id="" name="ud_marital_status" <?php echo (isset($_POST['ud_marital_status']) && $_POST['ud_marital_status'] == 'Married') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_marital_status'] == 'Married') ? 'checked' : ''); ?>> Married </label>
                                                    <label class="udradio"> <input type="radio" value="Not married" id="" name="ud_marital_status" <?php echo (isset($_POST['ud_marital_status']) && $_POST['ud_marital_status'] == 'Not married') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_marital_status'] == 'Not married') ? 'checked' : ''); ?>> Not Married</label>
                                                    <label class="udradio"> <input type="radio" value="Not selected" id="" name="ud_marital_status" <?php echo (isset($_POST['ud_marital_status']) && $_POST['ud_marital_status'] == 'Not selected') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_marital_status'] == 'Not selected') ? 'checked' : ''); ?>> Not Selected</label>
                                                </div>
                                            </div>
                                            <?PHP
                                        } else {
                                            ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group i-checks">
                                                <label class="col-sm-3 control-label">Nationality :</label>
                                                <div class="col-sm-9">
                                                    <label class="udradio"> <input type="radio" value="Malaysian" id="" name="ud_nationality" <?php echo (isset($_POST['ud_nationality']) && $_POST['ud_nationality'] == 'Malaysian') ? 'checked' : ((isset($userRow) && $userRow !== null && $userRow['ud_nationality'] == 'Malaysian') ? 'checked' : ''); ?>>Malaysian </label>
                                                    <label class="udradio"> <input type="radio" value="Non Malaysian" id="" name="ud_nationality" <?php echo (isset($_POST['ud_nationality']) && $_POST['ud_nationality'] != 'Malaysian' && $_POST['ud_nationality'] != 'Not Selected') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_nationality'] != 'Malaysian' && $userRow['ud_nationality'] != 'Not Selected') ? 'checked' : ''); ?>> Non Malaysian</label>
                                                    <label class="udradio"> <input type="radio" value="Not Selected" id="" name="ud_nationality" <?php echo (isset($_POST['ud_nationality']) && $_POST['ud_nationality'] == 'Not Selected') ? 'checked' : ((isset($userRow) && $userRow !== null && $userRow['ud_nationality'] == 'Not Selected') ? 'checked' : ''); ?>> Not Selected </label>
                                                    <br>
                                                    <div id="other_nationality_wrap"><?php
                                                        if (isset($_POST['ud_nationality']) && $_POST['ud_nationality'] != 'Malaysian' && $_POST['ud_nationality'] != 'Not Selected') {
                                                            echo '<textarea name="ud_nationality" class="form-control">' . $_POST['ud_nationality'] . '</textarea>';
                                                        } elseif (isset($userRow) && $userRow !== null && $userRow['ud_nationality'] != 'Malaysian' && $userRow['ud_nationality'] != 'Not Selected') {
                                                            echo '<textarea name="ud_nationality" class="form-control">' . $userRow['ud_nationality'] . '</textarea>';
                                                        }
                                                        ?></div>
                                                </div>
                                            </div>
                                            <?PHP
                                        }
                                        ?>
                                        <!-- END fadhli -->
                                        <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Status As Tutor : <br>
                                                </label>
                                                <div class="col-sm-9">
                                                    <div class="form-horizontal i-checks">
                                                        <label> <input type="radio" <?php echo (isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Full Time') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_tutor_status'] == 'Full Time') ? 'checked=""' : ''); ?> value="Full Time" name="ud_tutor_status" data-required> Full Time</label>
                                                        <label> <input type="radio" <?php echo (isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Part Time') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_tutor_status'] == 'Part Time') ? 'checked=""' : ''); ?> value="Part Time" name="ud_tutor_status" data-required> Part Time</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Occupation : <br>
                                                </label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">
                                                        <option value="">Select one</option>
                                                        <option value="Full-time tutor" <?php echo isset($userRow['ud_current_occupation']) && ($userRow['ud_current_occupation'] == 'Full-time tutor' || $userRow['ud_current_occupation'] == 'Full-Time tutor') ? 'selected' : ''; ?>>Full Time Tutor</option>
                                                        <option value="Kindergarten teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Kindergarten teacher' ? 'selected' : ''; ?>>Kindergarten Teacher</option>
                                                        <option value="Primary school teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Primary school teacher' ? 'selected' : ''; ?>>Primary School Teacher</option>
                                                        <option value="Secondary school teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Secondary school teacher' ? 'selected' : ''; ?>>Secondary School Teacher</option>
                                                        <option value="Tuition center teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Tuition center teacher' ? 'selected' : ''; ?>>Tuition Center Teacher</option>
                                                        <option value="Lecturer" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Lecturer' ? 'selected' : ''; ?>>Lecturer</option>
                                                        <option value="Ex-teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Ex-teacher' ? 'selected' : ''; ?>>Ex Teacher</option>
                                                        <option value="Retired teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Retired teacher' ? 'selected' : ''; ?>>Retired Teacher</option>
                                                        <option value="Other" <?php echo (isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <?php
                                                    if (isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Other') {
                                                        $occ_other = $userRow['ud_current_occupation_other'];
                                                        $sty_other = 'block';
                                                    } else {
                                                        $occ_other = '';
                                                        $sty_other = 'none';
                                                    }
                                                    ?>
                                                    <input class="form-control" type="text" name="ud_current_occupation_other" value="<?php echo $occ_other; ?>" style="display: <?php echo $sty_other; ?>;">
                                                </div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Can You Conduct Online Tuition? :</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="radio-inline udradio2" style="font-size:15px;">
                                                                <input type="radio" name="conduct_online" value="Yes" <?php if (isset($userRow) && $userRow !== null && ($userRow['conduct_online'] == 'Yes')) {
                                                                    echo 'checked';
                                                                } ?> >
                                                                Yes</label> <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id="popoverData" data-html="true" data-content="Please tick the tool for online teaching that you are familiar with ( you can tick more than 1 tool )" rel="popover" data-placement="bottom" data-trigger="hover"><span class="glyphicon glyphicon-info-sign" style="color:#262262" ></span></a>-->
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="radio-inline udradio2" style="font-size:15px;">
                                                                <input type="radio" name="conduct_online" value="No" <?php if (isset($userRow) && $userRow !== null && ($userRow['conduct_online'] == 'No')) {
                                                                    echo 'checked';
                                                                } ?> >
                                                                No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> </label>
                                                <div class="col-sm-6 hidden" id="conduct_online_wrap">

                                                    <?PHP
                                                    //if( $sessionIDLogin == '8'){
                                                    ?>

                                                    <div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top:0px;">
                                                        <div class="panel">
                                                            <div onClick="collapseOne1()" class="panel-heading" role="tab" id="headingOne">
                                                                <h4 class="panel-title">
                                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                        Tools <i id="glyphicon-chevron-down" class="pull-right glyphicon glyphicon-chevron-down"></i> <i id="glyphicon-chevron-up" class="hidden pull-right glyphicon glyphicon-chevron-up"></i>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                <div class="panel-body">
                                                                    <div class="col-xs-12">
                                                                        <div class="pull-left checkbox mobileCheckboxFont">
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Microsoft Teams') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Microsoft Teams"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Microsoft Teams</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Google Hangouts') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Google Hangouts"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Hangouts</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Google Meet') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Google Meet"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Meet</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Google Classroom') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Google Classroom"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Classroom</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Google Duo') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Google Duo"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Duo</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Google Doc') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Google Doc"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Doc</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Zoom') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Zoom"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Zoom</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Skype') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Skype"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Skype</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'WhatsApp') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="WhatsApp"><span class="cr"><i class="cr-icon fa fa-check"></i></span>What's App</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Telegram') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Telegram"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Telegram</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Lark') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Lark"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Lark</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'GeoGebra') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="GeoGebra"><span class="cr"><i class="cr-icon fa fa-check"></i></span>GeoGebra</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Whereby') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Whereby"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Whereby</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Others') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Others"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Others</label><br>


                                                                        </div>
                                                                        <div class="pull-right checkbox mobileCheckbox mobileCheckboxFont">
                                                                            <br><label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Phone Call') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Phone Call"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Phone Call</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Video Call') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Video Call"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Video Call</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Webex') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Webex"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Webex</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'YouTube') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="YouTube"><span class="cr"><i class="cr-icon fa fa-check"></i></span>YouTube</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Facebook') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Facebook"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Facebook</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'FaceTime') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="FaceTime"><span class="cr"><i class="cr-icon fa fa-check"></i></span>FaceTime</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Instagram') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Instagram"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Instagram</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Email') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Email"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Email</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Quizziz') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Quizziz"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Quizziz</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Kahoot') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Kahoot"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Kahoot</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Chegg') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Chegg"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Chegg</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'Edmodo') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="Edmodo"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Edmodo</label><br>
                                                                            <label style="font-size: 1em"><input type="checkbox" <?PHP if (strpos($userRow['conduct_online_text'], 'TeamLink') !== false) {
                                                                                    echo "checked";
                                                                                } ?> onchange="handleChange1();" name="toolsname1" value="TeamLink"><span class="cr"><i class="cr-icon fa fa-check"></i></span>TeamLink</label>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-12">
                                                                        <div class="pull-left checkbox mobileCheckboxFont">
                                                                            <?PHP if (strpos($userRow['conduct_online_text'], 'Others') !== false) {
                                                                                ?>
                                                                                <label id="conduct_online_other" style="font-size: 1em"><textarea style="overflow-y: scroll;" class="form-control" name="conduct_online_other" rows="2" cols="30"><?php echo (isset($_POST['conduct_online_other'])) ? $_POST['conduct_online_other'] : ((isset($userRow) && $userRow !== null) ? $userRow['conduct_online_other'] : ''); ?></textarea></label>
                                                                                <?PHP
                                                                            } else {
                                                                                ?>
                                                                                <label id="conduct_online_other" class="hidden" style="font-size: 1em"><textarea style="overflow-y: scroll;" class="form-control" name="conduct_online_other" rows="2" cols="30"><?php echo (isset($_POST['conduct_online_other'])) ? $_POST['conduct_online_other'] : ((isset($userRow) && $userRow !== null) ? $userRow['conduct_online_other'] : ''); ?></textarea></label>
                                                                                <?PHP
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input style="width: 80%" type="hidden" id="hiddentoolsname1" name="hiddentoolsname1" value="<?php echo (isset($_POST['conduct_online_text'])) ? $_POST['conduct_online_text'] : ((isset($userRow) && $userRow !== null) ? $userRow['conduct_online_text'] : ''); ?>">

                                                    <?PHP
                                                    //}
                                                    ?>


                                                    <!--<textarea class="form-control" name="conduct_online_text" rows="3"><?php //echo (isset($_POST['conduct_online_text'])) ? $_POST['conduct_online_text'] : ( (isset($userRow) && $userRow !== null) ? $userRow['conduct_online_text'] : '' );?></textarea>-->
                                                    <?php //if( isset($userRow) && $userRow !== null && ($userRow['conduct_online'] == 'Yes' ) ){
                                                    //} ?>
                                                </div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Can You Conduct Class At Your House Or Place? :</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="radio-inline" style="font-size:15px;">
                                                                <input type="radio" name="conduct_class" value="Yes" <?php if (isset($userRow) && $userRow !== null && ($userRow['conduct_class'] == 'Yes')) {
                                                                    echo 'checked';
                                                                } ?> >
                                                                Yes</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="radio-inline" style="font-size:15px;">
                                                                <input type="radio" name="conduct_class" value="No" <?php if (isset($userRow) && $userRow !== null && ($userRow['conduct_class'] == 'No')) {
                                                                    echo 'checked';
                                                                } ?> >
                                                                No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <?PHP

                                            /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}*/

                                            $queryLevel = " SELECT * FROM tk_job_level_translation WHERE jlt_lang_code='en' ";
                                            $resultLevel = $conDB->query($queryLevel);
                                            if ($resultLevel->num_rows > 0) {
                                                while ($rowLevel = $resultLevel->fetch_assoc()) {
                                                    $queryTutorRate = "SELECT * FROM tk_applied_job WHERE aj_u_id='" . $userRow['u_id'] . "' AND aj_level='" . $rowLevel['jlt_jl_id'] . "' AND (aj_rate IS NOT NULL AND aj_rate!='') ";
                                                    $resultTutorRate = $conDB->query($queryTutorRate);
                                                    if ($resultTutorRate->num_rows > 0) {
                                                        while ($rowTutorRate = $resultTutorRate->fetch_assoc()) {
                                                            $newdata[] = array(
                                                                'name'   => $rowLevel['jlt_title'],
                                                                'level'  => $rowTutorRate['aj_level'],
                                                                'job_id' => $rowTutorRate['aj_j_id'],
                                                                'rate'   => $rowTutorRate['aj_rate']
                                                            );

                                                        }

                                                    }
                                                }
                                            }
                                            //$dbCon->close();
                                            ?>
                                            <?php
                                            $arrNumber = 0;
                                            $arrNumber2 = 0;
                                            $arrNumber3 = 0;
                                            $arrNumber4 = 0;
                                            $arrNumber5 = 0;
                                            $arrNumber6 = 0;
                                            $arrNumber7 = 0;
                                            $arrNumber8 = 0;
                                            $arrNumber9 = 0;
                                            /*
if(sizeof($newdata) > 0){
    foreach ($newdata as $mdaKey => $mdaData) {
        if($mdaData["level"] == '1'){
            if($arrNumber == 0) {
                echo $mdaData["name"].' = ';
                $arrNumber++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
        if($mdaData["level"] == '2'){
            if($arrNumber2 == 0) {
                echo "\n".$mdaData["name"].' = ';
                $arrNumber2++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
        if($mdaData["level"] == '3'){
            if($arrNumber3 == 0) {
                echo "\n".$mdaData["name"].' = ';
                $arrNumber3++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
        if($mdaData["level"] == '4'){
            if($arrNumber4 == 0) {
                echo "\n".$mdaData["name"].' = ';
                $arrNumber4++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
        if($mdaData["level"] == '5'){
            if($arrNumber5 == 0) {
                echo "\n".$mdaData["name"].' = ';
                $arrNumber5++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
        if($mdaData["level"] == '6'){
            if($arrNumber6 == 0) {
                echo "\n".$mdaData["name"].' = ';
                $arrNumber6++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
        if($mdaData["level"] == '7'){
            if($arrNumber7 == 0) {
                echo "\n".$mdaData["name"].' = ';
                $arrNumber7++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
        if($mdaData["level"] == '8'){
            if($arrNumber8 == 0) {
                echo "\n".$mdaData["name"].' = ';
                $arrNumber8++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
        if($mdaData["level"] == '9'){
            if($arrNumber9 == 0) {
                echo "\n".$mdaData["name"].' = ';
                $arrNumber9++;
            }
            echo $mdaData["job_id"].' '.$mdaData["rate"].' , ';
        }
    }
    echo "\n\n";
}*/
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Tutor's Rate/Hour (Optional) :</label>
                                                <div class="col-sm-9">
                                                    <!--<textarea class="form-control" name="ud_rate_per_hour" rows="5"><?php //echo (isset($_POST['ud_rate_per_hour'])) ? $_POST['ud_rate_per_hour'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_rate_per_hour'] : '' );?></textarea>-->
                                                    <?PHP
                                                    if (isset($newdata) && sizeof($newdata) > 0) {
                                                        ?><textarea class="form-control" rows="7" readonly><?PHP
                                                        foreach ($newdata as $mdaKey => $mdaData) {
                                                            if ($mdaData["level"] == '1') {
                                                                if ($arrNumber == 0) {
                                                                    echo $mdaData["name"] . ' = ';
                                                                    $arrNumber++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                            if ($mdaData["level"] == '2') {
                                                                if ($arrNumber2 == 0) {
                                                                    echo "\n" . $mdaData["name"] . ' = ';
                                                                    $arrNumber2++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                            if ($mdaData["level"] == '3') {
                                                                if ($arrNumber3 == 0) {
                                                                    echo "\n" . $mdaData["name"] . ' = ';
                                                                    $arrNumber3++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                            if ($mdaData["level"] == '4') {
                                                                if ($arrNumber4 == 0) {
                                                                    echo "\n" . $mdaData["name"] . ' = ';
                                                                    $arrNumber4++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                            if ($mdaData["level"] == '5') {
                                                                if ($arrNumber5 == 0) {
                                                                    echo "\n" . $mdaData["name"] . ' = ';
                                                                    $arrNumber5++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                            if ($mdaData["level"] == '6') {
                                                                if ($arrNumber6 == 0) {
                                                                    echo "\n" . $mdaData["name"] . ' = ';
                                                                    $arrNumber6++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                            if ($mdaData["level"] == '7') {
                                                                if ($arrNumber7 == 0) {
                                                                    echo "\n" . $mdaData["name"] . ' = ';
                                                                    $arrNumber7++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                            if ($mdaData["level"] == '8') {
                                                                if ($arrNumber8 == 0) {
                                                                    echo "\n" . $mdaData["name"] . ' = ';
                                                                    $arrNumber8++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                            if ($mdaData["level"] == '9') {
                                                                if ($arrNumber9 == 0) {
                                                                    echo "\n" . $mdaData["name"] . ' = ';
                                                                    $arrNumber9++;
                                                                }
                                                                echo $mdaData["job_id"] . ' ' . $mdaData["rate"] . ' , ';
                                                            }
                                                        }
                                                        echo "\n*** SYSTEM ***\n";
                                                        ?></textarea><?PHP
                                                    }
                                                    ?>
                                                    <textarea class="form-control" name="ud_rate_per_hour" rows="5"><?php echo (isset($_POST['ud_rate_per_hour'])) ? $_POST['ud_rate_per_hour'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_rate_per_hour'] : ''); ?></textarea>
                                                </div>
                                            </div>

                                            <!--<div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Can Teach Learning Disability Student? :<br>
                                 </label>
                                 <div class="col-sm-9">
                                    <div  class="form-horizontal i-checks">
                                       <label> <input id="chkYes" onclick="clickSD()" type="radio" <?php //echo (isset($_POST['student_disability']) && $_POST['student_disability'] == 'Yes') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['student_disability'] == 'Yes') ? 'checked=""' : '' );?> value="Yes" name="student_disability"> Yes</label>
                                       <label> <input id="chkNo" onclick="clickSD()" type="radio" <?php //echo (isset($_POST['student_disability']) && $_POST['student_disability'] == 'No') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['student_disability'] == 'No') ? 'checked=""' : '' );?> value="No" name="student_disability"> No</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">  </label>
                                 <div class="col-sm-9 hidden" id="student_disability_wrap">
                                    <textarea class="form-control" name="student_disability_text" rows="3"><?php //echo (isset($_POST['student_disability_text'])) ? $_POST['student_disability_text'] : ( (isset($userRow) && $userRow !== null) ? $userRow['student_disability_text'] : '' );?></textarea>
                                 <?php //if( isset($userRow) && $userRow !== null && ($userRow['student_disability'] == 'Yes' ) ){
                                            //} ?>
                                 </div>
                              </div>-->


                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Can Teach Learning Disability Student? :</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="radio-inline udradio2" style="font-size:15px;">
                                                                <input type="radio" name="student_disability" value="Yes" <?php if (isset($userRow) && $userRow !== null && ($userRow['student_disability'] == 'Yes')) {
                                                                    echo 'checked';
                                                                } ?> >
                                                                Yes</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="radio-inline udradio2" style="font-size:15px;">
                                                                <input type="radio" name="student_disability" value="No" <?php if (isset($userRow) && $userRow !== null && ($userRow['student_disability'] == 'No')) {
                                                                    echo 'checked';
                                                                } ?> >
                                                                No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> </label>
                                                <div class="col-sm-9 hidden" id="student_disability_wrap">
                                                    <textarea class="form-control" name="student_disability_text" rows="3"><?php echo (isset($_POST['student_disability_text'])) ? $_POST['student_disability_text'] : ((isset($userRow) && $userRow !== null) ? $userRow['student_disability_text'] : ''); ?></textarea>
                                                    <?php if (isset($userRow) && $userRow !== null && ($userRow['student_disability'] == 'Yes')) {
                                                    } ?>
                                                </div>
                                            </div>


                                        <?php } ?>
                                        <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Qualification :</label>
                                                <div class="col-sm-9"><input type="text" class="form-control" name="ud_qualification" value="<?php echo (isset($_POST['ud_qualification'])) ? $_POST['ud_qualification'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_qualification'] : ''); ?>"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Experience :</label>
                                                <div class="col-sm-2">
                                                    <input style="width:100px;" type="text" class="form-control" name="ud_tutor_experience" value="<?php echo (isset($_POST['ud_tutor_experience'])) ? $_POST['ud_tutor_experience'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_tutor_experience'] : ''); ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-horizontal i-checks">
                                                        <label> <input type="radio" <?php echo (isset($_POST['ud_tutor_experience_month']) && $_POST['ud_tutor_experience_month'] == 'year') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_tutor_experience_month'] == 'year') ? 'checked=""' : ''); ?> value="year" name="experienceMonth"> Year</label> &nbsp;&nbsp;
                                                        <label> <input type="radio" <?php echo (isset($_POST['ud_tutor_experience_month']) && $_POST['ud_tutor_experience_month'] == 'month') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_tutor_experience_month'] == 'month') ? 'checked=""' : ''); ?> value="month" name="experienceMonth"> Month</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">About Yourself :</label>
                                                <div class="col-sm-9">
                                                    <textarea rows="5" class="form-control" name="ud_about_yourself"><?php echo (isset($_POST['ud_about_yourself'])) ? $_POST['ud_about_yourself'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_about_yourself'] : ''); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Consider Tuition Center :</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="radio-inline" style="font-size:15px;">
                                                                <input type="radio" name="ud_client_status" value="Tuition Centre" <?php if (isset($userRow) && $userRow !== null && ($userRow['ud_client_status'] == 'Tuition Centre' || $userRow['ud_client_status'] == '1')) {
                                                                    echo 'checked';
                                                                } ?> >
                                                                <!--<input type="radio" name="ud_client_status" value="Tuition Centre" <?php echo (isset($_POST['ud_client_status']) && $_POST['ud_client_status'] == 'Tuition Centre') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_client_status'] == 'Tuition Centre') ? 'checked=""' : ''); ?> >-->
                                                                <!--<input type="radio" name="ud_client_status" value="Tuition Centre" <?php //echo (isset($userRow['ud_client_status']) && $userRow['ud_client_status'] == 'Tuition Centre') ? 'checked' : ''; ?>>-->
                                                                Yes</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="radio-inline" style="font-size:15px;">
                                                                <input type="radio" name="ud_client_status" value="0" <?php if (isset($userRow) && $userRow !== null && ($userRow['ud_client_status'] == '0')) {
                                                                    echo 'checked';
                                                                } ?> >
                                                                <!--<input type="radio" name="ud_client_status" value="0" <?php echo (isset($_POST['ud_client_status']) && $_POST['ud_client_status'] != 'Tuition Centre') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_client_status'] != 'Tuition Centre') ? 'checked=""' : ''); ?> >-->
                                                                <!--<input type="radio" name="ud_client_status" value="0" <?php //echo (isset($userRow['ud_client_status']) && $userRow['ud_client_status'] != 'Tuition Centre') ? 'checked' : ''; ?>>-->
                                                                No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if (!isset($userRow) || (isset($userRow) && $userRow !== null && $userRow['u_role'] != 3)) { ?>

                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Address :</label>
                                                <div class="col-sm-9"><textarea class="form-control" name="ud_address"><?php echo (isset($_POST['ud_address'])) ? $_POST['ud_address'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_address'] : ''); ?></textarea></div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">City :</label>
                                                <div class="col-sm-5">
                                                    <?PHP

                                                    /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
                                                    $queryCity2 = "SELECT * FROM tk_cities WHERE city_id='" . $userRow['ud_city'] . "' ";
                                                    $resultCity2 = $conDB->query($queryCity2);
                                                    if ($resultCity2->num_rows > 0) {
                                                        $rowCity2 = $resultCity2->fetch_assoc();
                                                        $outputCity2 = $rowCity2['city_name'];
                                                    } else {
                                                        $outputCity2 = $userRow['ud_city'];
                                                    }
                                                    //$dbCon->close();   /**/
                                                    ?>
                                                    <input readonly type="hidden" class="form-control" name="ud_city2" id="ud_city2" value="<?php echo $outputCity2; //echo (isset($_POST['ud_city'])) ? $_POST['ud_city'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_city'] : '' ) ;  ?>">
                                                    <select class="form-control cnty" name="ud_state" id="ud_state" data-required>>
                                                        <option value="">Select State Name</option>
                                                        <?php
                                                        // luqman ubah so xpayah select country atas dah
                                                        $country_id = 150;
                                                        $stresponse = $initLocation->CountryWiseState($country_id);
                                                        if ($stresponse->num_rows > 0) {
                                                            while ($cu_row = $stresponse->fetch_assoc()) {
                                                                $sel = (isset($_POST['ud_state']) && $_POST['ud_state'] == $cu_row['st_id']) ? 'selected' : (($userRow['ud_state'] == $cu_row['st_id']) ? 'selected' : '');
                                                                echo '<option value="' . $cu_row['st_id'] . '" ' . $sel . '>' . $cu_row['st_name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>


                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control cnty" name="ud_city" id="ud_city" data-required>>
                                                        <option value="">Select City Name</option>
                                                        <!-- error sebab dye insert guna user detail tp nk display guna table city -->
                                                        <?php
                                                        if ((isset($_POST['ud_state']) && $_POST['ud_state'] != '') || (isset($userRow) && $userRow !== null && $userRow['ud_state'] != '')) {
                                                            $state_id = (isset($_POST['ud_state']) && $_POST['ud_state'] != '') ? $_POST['ud_state'] : $userRow['ud_state'];
                                                            /*$ciresponse = $initLocation->StateWiseCity($state_id);

                                          if ($ciresponse->num_rows > 0) {
                                             while( $cu_row = $ciresponse->fetch_assoc() ){
                                                $sel = (isset($_POST['ud_city']) && $_POST['ud_city'] == $cu_row['city_name']) ? 'selected' : (($userRow['ud_city'] == $cu_row['city_name']) ? 'selected' : '' );
                                                echo '<option value="'. $cu_row['city_id'] .'" '.$sel.'>'. $cu_row['city_name'] .'</option>';
                                             }
                                          }*/
                                                            /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}*/

                                                            $query = "SELECT * FROM tk_cities WHERE city_st_id='$state_id' ORDER BY city_name ASC";
                                                            $result = $conDB->query($query);
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <option value="<?php echo $row['city_id']; ?>" <?php if ($userRow['ud_city'] == $row['city_id']) {
                                                                        echo 'selected';
                                                                    } ?> ><?php echo $row['city_name']; ?></option><?php
                                                                }
                                                                ?>
                                                            <option value="1384" <?php if ($userRow['ud_city'] == '1384') {
                                                                echo 'selected';
                                                            } ?> >Online Tuition</option><?php
                                                            }

                                                            //$dbCon->close();

                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>

                                            <!--<div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">State:</label>
                                 <div class="col-sm-9">
                                    <select class="form-control cnty" name="ud_state" id="ud_state">
                                       <option value="0">Select State Name</option>
                                       <?php
                                            // luqman ubah so xpayah select country atas dah
                                            /*$country_id = 150;
                                          $stresponse = $initLocation->CountryWiseState($country_id);
                                          if ($stresponse->num_rows > 0) {
                                             while( $cu_row = $stresponse->fetch_assoc() ){
                                                 $sel = (isset($_POST['ud_state']) && $_POST['ud_state'] == $cu_row['st_id']) ? 'selected' : (($userRow['ud_state'] == $cu_row['st_id']) ? 'selected' : '' );
                                                echo '<option value="'. $cu_row['st_id'] .'" '.$sel.'>'. $cu_row['st_name'] .'</option>';
                                             }
                                          }*/
                                            ?>
                                    </select>
                                 </div>
                              </div>-->

                                        <?php } ?>


                                        <div class="clearfix"></div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group i-checks">
                                            <label class="col-sm-3 control-label">Client Status :</label>
                                            <div class="col-sm-9">
                                                <label> <input type="radio" value="Parent" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Parent') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Parent') ? 'checked' : ''); ?> data-required> Parent </label>
                                                <label> <input type="radio" value="Student" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Student') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Student') ? 'checked' : ''); ?> data-required> Student</label>
                                                <label> <input type="radio" value="Tuition Centre" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Tuition Centre') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Tuition Centre') ? 'checked' : ''); ?> data-required> Tuition Centre</label>
                                                <label> <input type="radio" value="Agent" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Agent') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Agent') ? 'checked' : ''); ?> data-required> Agent </label>
                                                <label> <input type="radio" value="Not Selected" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Not Selected') ? 'checked=""' : ((isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Not Selected') ? 'checked' : ''); ?> data-required>Not Selected </label>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group i-checks">
                                            <label class="col-sm-3 control-label">User Status :</label>
                                            <div class="col-sm-9">


                                                <?php $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                                                if ($host == 'www.tutorkami.com/admin/manage_user?action=add_new') { ?>

                                                <?php } else {
                                                    //if(isset($userRow) && $userRow !== null && $userRow['u_role'] != 4) {
                                                    if (isset($userRow) && $userRow !== null && $userRow['u_status'] == 'P') {
                                                        ?>
                                                        <label><input type="radio" name="u_status" value="P" id="inlineCheckbox1" <?php echo (isset($_POST['u_status']) && $_POST['u_status'] == 'P') ? 'checked' : ((isset($userRow) && $userRow['u_status'] == 'P') ? 'checked' : ''); ?>>
                                                            <b>Pending</b>
                                                        </label>
                                                        <?php
                                                    }
                                                    ?>

                                                <?php } ?>
                                                <label>
                                                    <input type="radio" name="u_status" value="A" id="inlineCheckbox1" <?php echo (isset($_POST['u_status']) && $_POST['u_status'] == 'A') ? 'checked' : ((isset($userRow) && $userRow['u_status'] == 'A') ? 'checked' : ''); ?>>
                                                    Active</label>

                                                <label>
                                                    <input type="radio" name="u_status" value="B" id="inlineCheckbox1" <?php echo (isset($_POST['u_status']) && $_POST['u_status'] == 'B') ? 'checked' : ((isset($userRow) && $userRow['u_status'] == 'B') ? 'checked' : ''); ?>>
                                                    Banned</label> <label> <input type="radio" name="u_status" value="C" id="inlineCheckbox1" <?php echo (isset($_POST['u_status']) && $_POST['u_status'] == 'C') ? 'checked' : ((isset($userRow) && $userRow['u_status'] == 'C') ? 'checked' : ''); ?>> DON'T HIRE</label> <label>

                                            </div>
                                        </div>


                                        <?php if (!isset($userRow) || (isset($userRow) && $userRow !== null && $userRow['u_role'] != 3)) { ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group i-checks">
                                                <label class="col-sm-3 control-label">Paying Client :</label>
                                                <div class="col-sm-9"><label class="checkbox-inline"> <input type="checkbox" value="P" id="inlineCheckbox2" name="u_paying_client" <?php echo (isset($_POST['u_paying_client']) && $_POST['u_paying_client'] == 'P') ? 'checked' : ((isset($userRow) && $userRow['u_paying_client'] == 'P') ? 'checked' : ''); ?>> </label></div>
                                            </div>
                                        <?php } ?>


                                        <div class="clearfix"></div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">List Of Past Jobs :</label>
                                            <div class="col-sm-9">
                                                <?php
                                                // Get all the Job Ids for this tutor
                                                if (isset($userRow) && $userRow !== null) {
                                                    if ($userRow['u_role'] != 3) {
                                                        //$jobList = $userInit->ClientsJob($userRow['u_email']);
                                                        $jobList = $userInit->ClientsJobNew($userRow['u_id']);
                                                    } else {
                                                        //$jobList = $userInit->TutorsJob($userRow['u_email']);
                                                        $jobList = $userInit->TutorsJobNew($userRow['u_id']);
                                                    }

                                                    if ($jobList->num_rows > 0) {
                                                        $level1 = '';
                                                        $level2 = '';
                                                        $level3 = '';
                                                        $level4 = '';
                                                        $level5 = '';
                                                        $level6 = '';
                                                        $level7 = '';
                                                        $level8 = '';
                                                        $level9 = '';
                                                        while ($appliedjob = $jobList->fetch_assoc()) {
                                                            //echo '<label class="label label-primary"><a href="job-edit.php?j='.$appliedjob['j_id'].'" target="_blank" style="color:#FFF; text-decoration: none;">'.$appliedjob['j_id'].'</a></label> ';

                                                            if ($appliedjob['j_jl_id'] == 1) {
                                                                $level1 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                            } else {
                                                                if ($appliedjob['j_jl_id'] == 2) {
                                                                    $level2 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                                } else {
                                                                    if ($appliedjob['j_jl_id'] == 3) {
                                                                        $level3 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                                    } else {
                                                                        if ($appliedjob['j_jl_id'] == 4) {
                                                                            $level4 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                                        } else {
                                                                            if ($appliedjob['j_jl_id'] == 5) {
                                                                                $level5 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                                            } else {
                                                                                if ($appliedjob['j_jl_id'] == 6) {
                                                                                    $level6 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                                                } else {
                                                                                    if ($appliedjob['j_jl_id'] == 7) {
                                                                                        $level7 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                                                    } else {
                                                                                        if ($appliedjob['j_jl_id'] == 8) {
                                                                                            $level8 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                                                        } else {
                                                                                            $level9 .= '<label class="label label-primary"><a href="job-edit.php?j=' . $appliedjob['j_id'] . '" target="_blank" style="color:#FFF; text-decoration: none;">' . $appliedjob['j_id'] . '</a></label> ';
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                        }
                                                        //if( $sessionIDLogin == '8'){

                                                        if ($level1 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >PS : </label> ' . $level1 . '<br>';
                                                        }
                                                        if ($level2 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >T1 : </label> ' . $level2 . '<br>';
                                                        }
                                                        if ($level3 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >T2 : </label> ' . $level3 . '<br>';
                                                        }
                                                        if ($level4 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >PT3 : </label> ' . $level4 . '<br>';
                                                        }
                                                        if ($level5 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >SPM : </label> ' . $level5 . '<br>';
                                                        }
                                                        if ($level6 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >PIS : </label> ' . $level6 . '<br>';
                                                        }
                                                        if ($level7 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >SIS : </label> ' . $level7 . '<br>';
                                                        }
                                                        if ($level8 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >IGCSE : </label> ' . $level8 . '<br>';
                                                        }
                                                        if ($level9 != '') {
                                                            echo '<div class="clearfix"></div>';
                                                            echo '<label class="label label-info" >OTHER : </label> ' . $level9 . '<br>';
                                                        }
                                                        //}


                                                    }
                                                }

                                                ?>
                                            </div>
                                        </div>


                                        <?php if (!isset($userRow) || (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3)) { ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Bank Name :</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" name="BankName" id="BankName">
                                                        <option value="">Select Bank</option>
                                                        <option value="Ambank" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'Ambank') ? 'selected' : ''; ?> >Ambank</option>
                                                        <option value="BankIslam" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'BankIslam') ? 'selected' : ''; ?> >Bank Islam</option>
                                                        <option value="BankRakyat" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'BankRakyat') ? 'selected' : ''; ?> >Bank Rakyat</option>
                                                        <option value="BankMuamalat" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'BankMuamalat') ? 'selected' : ''; ?> >Bank Muamalat</option>
                                                        <option value="BSN" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'BSN') ? 'selected' : ''; ?> >BSN</option>
                                                        <option value="CIMB" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'CIMB') ? 'selected' : ''; ?> >CIMB</option>
                                                        <option value="HongLeong" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'HongLeong') ? 'selected' : ''; ?> >Hong Leong</option>
                                                        <option value="HSBC" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'HSBC') ? 'selected' : ''; ?> >HSBC</option>
                                                        <option value="Maybank" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'Maybank') ? 'selected' : ''; ?> >Maybank</option>
                                                        <option value="OCBC" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'OCBC') ? 'selected' : ''; ?> >OCBC</option>
                                                        <option value="PublicBank" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'PublicBank') ? 'selected' : ''; ?> >Public Bank</option>
                                                        <option value="RHB" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'RHB') ? 'selected' : ''; ?> >RHB</option>
                                                        <option value="UOB" <?php echo (isset($userRow['bank_name']) && $userRow['bank_name'] == 'UOB') ? 'selected' : ''; ?> >UOB</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Acc No:</label>
                                                <div class="col-sm-3" style="margin-left:-50px;">
                                                    <input type="text" class="form-control" id="AccNo" name="AccNo" value="<?php echo (isset($_POST['acc_no'])) ? $_POST['acc_no'] : ((isset($userRow) && $userRow !== null) ? $userRow['acc_no'] : ''); ?>">
                                                </div>
                                            </div>
                                        <?php } ?>


                                        <div class="clearfix"></div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Admin Comment :</label>
                                            <div class="col-sm-9">
                                                <div class="clearfix"></div>
                                                <textarea class="form-control col-lg-12 col-sm-12" rows="5" name="ud_admin_comment"><?php echo (isset($_POST['ud_admin_comment'])) ? $_POST['ud_admin_comment'] : ((isset($userRow) && $userRow !== null) ? $userRow['ud_admin_comment'] : ''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) { ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Created On :</label>
                                                <div class="col-sm-9"><input type="text" class="form-control" name="created_on" value="<?php echo $userRow['u_create_date']; ?>" disabled></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Last Login :</label>
                                                <div class="col-sm-9"><input type="text" class="form-control" name="last_login" value="<?php echo $userRow['u_modified_date']; ?>" disabled></div>
                                            </div>
                                        <?php } ?>

                                        <?php if (!isset($userRow) || (isset($userRow) && $userRow !== null && $userRow['u_role'] != 3)) { ?>
                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Country :</label>
                                                <div class="col-sm-9">
                                                    <!-- <input type="text" name="ud_country" id="ud_country" value="Malaysia" data-required disabled> -->

                                                    <select class="form-control cnty" name="ud_country" id="ud_country" data-required>

                                                        <?php while ($arrCnt = $resCnt->fetch_assoc()) { ?>
                                                            <option selected="selected" value="<?php echo $arrCnt['c_id']; ?>" <?php echo (isset($_POST['ud_country']) && $_POST['ud_country'] == $arrCnt['c_id']) ? 'selected' : ((isset($userRow) && $userRow !== null && $userRow['ud_country'] == $arrCnt['c_id']) ? 'selected' : ''); ?>><?php echo $arrCnt['c_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php } ?>


                                        <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] != 4) {
                                            /*$dbConnection = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
} */
                                            $dataUser = "SELECT * FROM tk_user WHERE u_id='$userRow[ud_u_id]'";
                                            $resultUser = $conDB->query($dataUser);
                                            if ($resultUser->num_rows > 0) {
                                                /*while($row = $result->fetch_assoc()) {
        echo "u_id: " . $row["u_id"]. " - u_username: " . $row["u_username"]. " " . $row["u_create_date"]. "<br>";
    }*/
                                                $rowUser = $resultUser->fetch_assoc();
                                                $createDate = $rowUser["u_create_date"];
                                                $lastActivity = $rowUser["u_modified_date"];
                                                $ipAddress = $rowUser["ip_address"];
                                                $lastPage = $rowUser["last_page"];
                                            } /*else {
    echo "0 results";
}*/
                                            //$dbConnection->close();


                                            $replaceThis = array(
                                                '- C :'  => ' - ',
                                                '- R :'  => ' ',
                                                '- CT :' => ', ',
                                            );

                                            $replacedText = str_replace(array_keys($replaceThis), $replaceThis, $ipAddress);
                                            ?>

                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">IP Address :</label>
                                                <div class="col-sm-9"><input type="text" class="form-control" name="ip_address" value="<?PHP echo $replacedText; ?>" disabled></div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Registration Date :</label>
                                                <div class="col-sm-9"><input type="text" class="form-control" name="registration_date" value="<?PHP echo $createDate; ?>" disabled></div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Last Activity :</label>
                                                <div class="col-sm-9"><input type="text" class="form-control" name="last_activity" value="<?PHP echo $lastActivity; ?>" disabled></div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Last Visited Page :</label>
                                                <div class="col-sm-9"><input type="text" class="form-control" name="last_visited_page" value="<?PHP echo $lastPage; ?>" disabled></div>
                                            </div>


                                        <?php } ?>


                                        <div class="clearfix"></div>
                                        <div class="hr-line-dashed"></div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <?php //aaaa
                                        if ($roleData->num_rows > 0) {
                                            $ur = 0;
                                            while ($row = $roleData->fetch_assoc()) {
                                                //if($row['r_id'] > $_SESSION[DB_PREFIX]['r_id']) {
                                                /* START fadhli */
                                                if ($row['r_id'] >= $_SESSION[DB_PREFIX]['r_id']) {
                                                    ?>
                                                    <?php $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                                                    if ($host == 'www.tutorkami.com/admin/manage_user?action=add_new') { ?>
                                                        <div class="form-group i-checks">
                                                            <label class="col-sm-2 control-label"><?php echo $row['r_name']; ?> :</label>
                                                            <div class="col-sm-10"><label class="checkbox-inline"><input type="radio" value="<?php echo $row['r_id']; ?>" id="u_role" name="u_role" <?php
                                                                    if ((isset($_POST['u_role']) && $_POST['u_role'] == $row['r_id']) || (isset($userRow) && $userRow !== null && $row['r_id'] == $userRow['u_role'])) {
                                                                        echo 'checked';
                                                                    } elseif (!isset($userRow) && $ur == 3) {
                                                                        echo 'checked';
                                                                    }
                                                                    ?> checked='checked' data-required/></label></div>
                                                        </div>
                                                    <?php } else {
                                                        ?>

                                                        <div class="form-group i-checks">
                                                            <label class="col-sm-2 control-label"><?php echo $row['r_name']; ?> :</label>
                                                            <div class="col-sm-10"><label class="checkbox-inline"><input type="radio" value="<?php echo $row['r_id']; ?>" id="u_role" name="u_role" <?php
                                                                    if ((isset($_POST['u_role']) && $_POST['u_role'] == $row['r_id']) || (isset($userRow) && $userRow !== null && $row['r_id'] == $userRow['u_role'])) {
                                                                        echo 'checked';
                                                                    } elseif (!isset($userRow) && $ur == 3) {
                                                                        echo 'checked';
                                                                    }
                                                                    ?> data-required/></label></div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="clearfix"></div>
                                                    <div class="hr-line-dashed"></div>
                                                    <?php
                                                    $ur++;
                                                }
                                            }
                                        } else {
                                            echo '<tr><td colspan="3">No Record Found</td></tr>';
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div id="tab-7" class="tab-pane">
                                    <div class="panel-body">
                                        <!--

                           <input class="form-control" id="sendemail_displayid" type="hidden" value="<?php echo (isset($_POST['u_displayid'])) ? $_POST['u_displayid'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_displayid'] : ''); ?>">

                             <div class="form-horizontal">
                                <div class="form-group">
                                   <label class="col-lg-3 control-label">Email:</label>
                                   <div class="col-lg-9">
                                      <input class="form-control" id="sendemail_email" type="text" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : ''); ?>" readonly>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-lg-3 control-label"> User Details:</label>
                                   <div class="col-lg-9">
                                   <select class="form-control" id="sendemail_userdetail">
                                         <option value="">Select User Details</option>
<?PHP
                                        /*$dbConnection = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
} */
                                        $test1 = "SELECT * FROM tk_job WHERE j_email='$userRow[u_email]'";
                                        $test2 = $conDB->query($test1);
                                        if ($test2->num_rows > 0) {
                                            while ($test3 = $test2->fetch_assoc()) {
                                                ?>
        <option value="<?php echo $test3['j_hired_tutor_email']; ?>"><?php echo $test3['j_hired_tutor_email']; ?></option>
        <?PHP
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        //$dbConnection->close();
                                        ?>
                                      </select>



                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-lg-3 control-label">Email Template:</label>
                                   <div class="col-lg-9">
                                      <select class="form-control" id="sendemail_template">
                                         <option value="">Select Email Template</option>
                                         <?php
                                        $resNwtt1 = $instNews->ListNewsletterTemplate();
                                        while ($arrNwtt1 = $resNwtt1->fetch_assoc()) { ?>
                                         <option value="<?php echo $arrNwtt1['ntt_id']; ?>"><?php echo $arrNwtt1['ntt_subject']; ?></option>
                                         <?php } ?>
                                      </select>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <div class="col-lg-offset-3 col-lg-3">
                                      <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" id="send_newsletter" onClick="send_newsletter()">SEND</button>
                                   </div>
                                </div>
                             </div>
-->

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded" data-page-size="15">
                                                    <thead>
                                                        <tr>
                                                            <th data-hide="phone" class="footable-visible footable-sortable">Date <a href="https://docs.google.com/document/d/1ZRszJ8fGGa1oIvV3LQYKocbjPKQLGERY8TjwIgpZMZ0/edit" target="_black"><i class="glyphicon glyphicon-question-sign" style="color:#262262"></i></a></th>
                                                            <th data-hide="phone,tablet" class="footable-visible footable-sortable">Job ID<span class="footable-sort-indicator"></span></th>
                                                            <th data-hide="phone,tablet" class="footable-visible footable-sortable">Amount<span class="footable-sort-indicator"></span></th>
                                                            <th data-hide="phone,tablet" class="footable-visible footable-sortable">Invoice<span class="footable-sort-indicator"></span></th>
                                                            <th data-hide="phone,tablet" class="footable-visible footable-sortable">Action<span class="footable-sort-indicator"></span></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <div class="modal fade" id="myModalReceipt" role="dialog">
                                                            <div class="modal-dialog">

                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="ModalReceiptRole" id="ModalReceiptRole">
                                                                        <input type="hidden" name="ModalReceiptID" id="ModalReceiptID">
                                                                        <input type="hidden" name="ModalReceiptSess" id="ModalReceiptSess" value="<?PHP echo $_SESSION[DB_PREFIX]['u_first_name']; ?>">


                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Date</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" id="ModalReceiptDate" name="ModalReceiptDate">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Amount</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" id="ModalReceiptAmount" name="ModalReceiptAmount">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row" id="ModalReceiptRfLabel">
                                                                            <label class="col-sm-4 col-form-label">Registration Fees</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" id="ModalReceiptRfText" name="ModalReceiptRfText">
                                                                                <input type="text" class="form-control" id="ModalReceiptRf" name="ModalReceiptRf">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Tutor</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" id="ModalReceiptTutor" name="ModalReceiptTutor">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Hour</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" id="ModalReceiptHour" name="ModalReceiptHour">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Description</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" id="ModalReceiptDescription" name="ModalReceiptDescription">
                                                                            </div>
                                                                        </div>


                                                                        <!--<div class="form-group" id="ModalReceipt">
                    <label for="exampleInputPassword1">Date :</label>
                        <input type="text" class="form-control date_picker" name="ModalReceiptDate" id="ModalReceiptDate" />
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control date_picker" name="ModalReceiptDate" id="ModalReceiptDate" />
                        </div>
                  </div>-->

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary" onclick="ProceedPayment()">Proceed</button>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <?php
                                                        /*$dbConnection1 = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConnection1->connect_error) {
    die("Connection failed: " . $dbConnection1->connect_error);
} */
                                                        $payment = " SELECT * FROM tk_payment_history WHERE ph_user_type = '4' AND ph_user_id='" . $userRow['u_id'] . "' ORDER BY ph_date DESC, ph_receipt DESC ";
                                                        $payment2 = $conDB->query($payment);
                                                        if ($payment2->num_rows > 0) {
                                                            while ($payment3 = $payment2->fetch_assoc()) {

                                                                if (strpos($payment3['ph_receipt'], 'trial') !== false) {
                                                                    ?>
                                                                    <tr class="footable-even" style="display: table-row;">
                                                                        <td class="footable-visible" style="width: 120px;">
                                                                            <span color="#266569" style="cursor: pointer;" onclick="openPopup(<?PHP echo $payment3['ph_id'] . ',' . $payment3['ph_amount'] . ',' . $payment3['ph_rf'] . ',' . $payment3['hour']; ?>,'<?PHP echo $payment3['tutor']; ?>','<?PHP echo date("d/m/Y", strtotime($payment3['ph_date'])); ?>','<?PHP echo $payment3['description']; ?>','client','<?PHP echo $payment3['description_rf']; ?>')">
                                                                                <b><?PHP echo date("d/m/Y", strtotime($payment3['ph_date'])); ?></b>
                                                                            </span>
                                                                            <?PHP
                                                                            if ($payment3['description'] != '') {
                                                                                $resultpaymentLog3 = '';
                                                                                $paymentLog = " SELECT * FROM tk_payment_log WHERE id_payment = '" . $payment3['ph_id'] . "' ORDER BY id DESC ";
                                                                                $paymentLog2 = $conDB->query($paymentLog);
                                                                                if ($paymentLog2->num_rows > 0) {
                                                                                    while ($paymentLog3 = $paymentLog2->fetch_assoc()) {
                                                                                        $resultpaymentLog3 .= $paymentLog3['log'] . '&#10;';
                                                                                    }
                                                                                }
                                                                                ?>&nbsp;&nbsp;<span data-balloon-length="large" data-balloon-pos="right" data-balloon-break aria-label="<?PHP echo $resultpaymentLog3; ?>"><i class="glyphicon glyphicon-exclamation-sign" style="color:#F0AD4E"></i></span><?PHP
                                                                            }
                                                                            ?>
                                                                        </td>

                                                                        <td class="footable-visible" style="width: 80px;"><?php echo $payment3['ph_job_id']; ?></td>
                                                                        <td class="footable-visible" style="width: 80px;"><?php echo number_format((float) ($payment3['ph_amount'] + $payment3['ph_rf']), 2, '.', ''); ?></td>
                                                                        <td class="footable-visible" style="width: 80px;">
                                                                            <?php
                                                                            if ($payment3['ph_receipt'] == 'trial paid') {
                                                                                $thisCycle = 'T (paid)';
                                                                            } else {
                                                                                $thisCycle = 'T';
                                                                            }
                                                                            ?>
                                                                            <a href="https://www.tutorkami.com/admin/templates-pdf-user.php?last=<?php echo $payment3['ph_id'] ?>&date=<?php echo $payment3['ph_date'] ?>&jobID=<?php echo $payment3['ph_job_id']; ?> " target="_blank"><?php echo 'i' . $payment3['ph_job_id'] . $thisCycle; ?></a>
                                                                        </td>
                                                                        <td class="footable-visible" style="width: 80px;">
                                                                            <button onClick="deletePayment(<?php echo $payment3['ph_id']; ?>)" type="button" class="btn btn-danger2 btn-sm">Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                    <?PHP
                                                                } else {
                                                                    if ($payment3['ph_receipt'] == 'temp') {
                                                                        $CekExist = " SELECT ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '4' AND ph_user_id = '" . $payment3['ph_user_id'] . "' AND ph_job_id = '" . $payment3['ph_job_id'] . "' AND (ph_receipt = '1' OR ph_receipt = '01')   ";
                                                                        $rowCekExist = $conDB->query($CekExist);
                                                                        if ($rowCekExist->num_rows > 0) {
                                                                            //$resCekExist = $rowCekExist->fetch_assoc();
                                                                        } else {
                                                                            ?>
                                                                            <tr class="footable-even" style="display: table-row;">
                                                                                <td class="footable-visible" style="width: 120px;">
                                                                                    <?php
                                                                                    //echo date("d/m/Y", strtotime($payment3['ph_date']));
                                                                                    ?>
                                                                                    <span color="#266569" style="cursor: pointer;" onclick="openPopup(<?PHP echo $payment3['ph_id'] . ',' . $payment3['ph_amount'] . ',' . $payment3['ph_rf'] . ',' . $payment3['hour']; ?>,'<?PHP echo $payment3['tutor']; ?>','<?PHP echo date("d/m/Y", strtotime($payment3['ph_date'])); ?>','<?PHP echo $payment3['description']; ?>','client','<?PHP echo $payment3['description_rf']; ?>')">
                                                                                        <b><?PHP echo date("d/m/Y", strtotime($payment3['ph_date'])); ?></b>
                                                                                    </span>
                                                                                    <?PHP
                                                                                    if ($payment3['description'] != '') {
                                                                                        $resultpaymentLog3 = '';
                                                                                        $paymentLog = " SELECT * FROM tk_payment_log WHERE id_payment = '" . $payment3['ph_id'] . "' ORDER BY id DESC ";
                                                                                        $paymentLog2 = $conDB->query($paymentLog);
                                                                                        if ($paymentLog2->num_rows > 0) {
                                                                                            while ($paymentLog3 = $paymentLog2->fetch_assoc()) {
                                                                                                //$resultpaymentLog3 .= $paymentLog3['log'].'&#10;';
                                                                                                $resultpaymentLog3 .= $paymentLog3['log'] . '&#10;';
                                                                                            }
                                                                                        }
                                                                                        ?>&nbsp;&nbsp;<span data-balloon-length="large" data-balloon-pos="right" data-balloon-break aria-label="<?PHP echo $resultpaymentLog3; ?>"><i class="glyphicon glyphicon-exclamation-sign" style="color:#F0AD4E"></i></span><?PHP
                                                                                    }
                                                                                    ?>
                                                                                </td>

                                                                                <td class="footable-visible" style="width: 80px;"><?php echo $payment3['ph_job_id']; ?></td>
                                                                                <td class="footable-visible" style="width: 80px;"><?php echo number_format((float) ($payment3['ph_amount'] + $payment3['ph_rf']), 2, '.', '');  //echo $payment3['ph_amount'];
                                                                                    ?></td>
                                                                                <td class="footable-visible" style="width: 80px;">
                                                                                    <?php //echo $payment3['ph_receipt'];
                                                                                    $pad_length = 2;
                                                                                    $pad_char = 0;
                                                                                    if ($payment3['ph_receipt'] == 'temp') {
                                                                                        $thisCycle = '01';
                                                                                    } else {
                                                                                        $thisCycle = str_pad($payment3['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT) . ' (paid)';
                                                                                    }
                                                                                    ?>
                                                                                    <a href="https://www.tutorkami.com/admin/templates-pdf-user.php?last=<?php echo $payment3['ph_id'] ?>&date=<?php echo $payment3['ph_date'] ?>&jobID=<?php echo $payment3['ph_job_id']; ?> " target="_blank"><?php echo 'i' . $payment3['ph_job_id'] . $thisCycle; ?></a>
                                                                                </td>
                                                                                <td class="footable-visible" style="width: 80px;">
                                                                                    <button onClick="deletePayment(<?php echo $payment3['ph_id']; ?>)" type="button" class="btn btn-danger2 btn-sm">Delete</button>
                                                                                </td>
                                                                            </tr>
                                                                            <?PHP
                                                                        }
                                                                    } else {
                                                                        if (strpos($payment3['ph_receipt'], 'beginning') !== false) {

                                                                            $CycleNo = filter_var($payment3['ph_receipt'], FILTER_SANITIZE_NUMBER_INT);
                                                                            $CycleNo2 = str_pad($CycleNo, $pad_length, $pad_char, STR_PAD_LEFT);

                                                                            $CekExist = " SELECT ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '4' AND ph_user_id = '" . $payment3['ph_user_id'] . "' AND ph_job_id = '" . $payment3['ph_job_id'] . "' AND (ph_receipt = '" . $CycleNo . "' OR ph_receipt = '" . $CycleNo2 . "')   ";
                                                                            $rowCekExist = $conDB->query($CekExist);
                                                                            if ($rowCekExist->num_rows > 0) {
                                                                            } else {
                                                                                ?>
                                                                                <tr class="footable-even" style="display: table-row;">
                                                                                    <td class="footable-visible" style="width: 120px;">

                                                                                        <span color="#266569" style="cursor: pointer;" onclick="openPopup(<?PHP echo $payment3['ph_id'] . ',' . $payment3['ph_amount'] . ',' . $payment3['ph_rf'] . ',' . $payment3['hour']; ?>,'<?PHP echo $payment3['tutor']; ?>','<?PHP echo date("d/m/Y", strtotime($payment3['ph_date'])); ?>','<?PHP echo $payment3['description']; ?>','client','<?PHP echo $payment3['description_rf']; ?>')">
                                                                                            <b><?PHP echo date("d/m/Y", strtotime($payment3['ph_date'])); ?></b>
                                                                                        </span>
                                                                                        <?PHP
                                                                                        if ($payment3['description'] != '') {
                                                                                            $resultpaymentLog3 = '';
                                                                                            $paymentLog = " SELECT * FROM tk_payment_log WHERE id_payment = '" . $payment3['ph_id'] . "' ORDER BY id DESC ";
                                                                                            $paymentLog2 = $conDB->query($paymentLog);
                                                                                            if ($paymentLog2->num_rows > 0) {
                                                                                                while ($paymentLog3 = $paymentLog2->fetch_assoc()) {
                                                                                                    $resultpaymentLog3 .= $paymentLog3['log'] . '&#10;';
                                                                                                }
                                                                                            }
                                                                                            ?>&nbsp;&nbsp;<span data-balloon-length="large" data-balloon-pos="right" data-balloon-break aria-label="<?PHP echo $resultpaymentLog3; ?>"><i class="glyphicon glyphicon-exclamation-sign" style="color:#F0AD4E"></i></span><?PHP
                                                                                        }
                                                                                        ?>
                                                                                    </td>

                                                                                    <td class="footable-visible" style="width: 80px;"><?php echo $payment3['ph_job_id']; ?></td>
                                                                                    <td class="footable-visible" style="width: 80px;"><?php echo number_format((float) ($payment3['ph_amount'] + $payment3['ph_rf']), 2, '.', '');  //echo $payment3['ph_amount'];
                                                                                        ?></td>
                                                                                    <td class="footable-visible" style="width: 80px;">
                                                                                        <?php
                                                                                        $pad_length = 2;
                                                                                        $pad_char = 0;
                                                                                        if ($payment3['ph_receipt'] == 'temp') {
                                                                                            $thisCycle = '01';
                                                                                        } else {
                                                                                            if (strpos($payment3['ph_receipt'], 'beginning') !== false) {
                                                                                                $thisCycle = str_pad(filter_var($payment3['ph_receipt'], FILTER_SANITIZE_NUMBER_INT), $pad_length, $pad_char, STR_PAD_LEFT);
                                                                                            } else {
                                                                                                $thisCycle = str_pad($payment3['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT) . ' (paid)';
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <a href="https://www.tutorkami.com/admin/templates-pdf-user.php?last=<?php echo $payment3['ph_id'] ?>&date=<?php echo $payment3['ph_date'] ?>&jobID=<?php echo $payment3['ph_job_id']; ?> " target="_blank"><?php echo 'i' . $payment3['ph_job_id'] . $thisCycle; ?></a>
                                                                                    </td>
                                                                                    <td class="footable-visible" style="width: 80px;">
                                                                                        <button onClick="deletePayment(<?php echo $payment3['ph_id']; ?>)" type="button" class="btn btn-danger2 btn-sm">Delete</button>
                                                                                    </td>
                                                                                </tr>
                                                                                <?PHP
                                                                            }

                                                                        } else {
                                                                            ?>
                                                                            <tr class="footable-even" style="display: table-row;">
                                                                                <td class="footable-visible" style="width: 120px;">
                                                                                    <?php
                                                                                    //echo date("d/m/Y", strtotime($payment3['ph_date']));
                                                                                    ?>
                                                                                    <span color="#266569" style="cursor: pointer;" onclick="openPopup(<?PHP echo $payment3['ph_id'] . ',' . $payment3['ph_amount'] . ',' . $payment3['ph_rf'] . ',' . $payment3['hour']; ?>,'<?PHP echo $payment3['tutor']; ?>','<?PHP echo date("d/m/Y", strtotime($payment3['ph_date'])); ?>','<?PHP echo $payment3['description']; ?>','client','<?PHP echo $payment3['description_rf']; ?>')">
                                                                                        <b><?PHP echo date("d/m/Y", strtotime($payment3['ph_date'])); ?></b>
                                                                                    </span>
                                                                                    <?PHP
                                                                                    if ($payment3['description'] != '') {
                                                                                        $resultpaymentLog3 = '';
                                                                                        $paymentLog = " SELECT * FROM tk_payment_log WHERE id_payment = '" . $payment3['ph_id'] . "' ORDER BY id DESC ";
                                                                                        $paymentLog2 = $conDB->query($paymentLog);
                                                                                        if ($paymentLog2->num_rows > 0) {
                                                                                            while ($paymentLog3 = $paymentLog2->fetch_assoc()) {
                                                                                                //$resultpaymentLog3 .= $paymentLog3['log'].'&#10;';
                                                                                                $resultpaymentLog3 .= $paymentLog3['log'] . '&#10;';
                                                                                            }
                                                                                        }
                                                                                        ?>&nbsp;&nbsp;<span data-balloon-length="large" data-balloon-pos="right" data-balloon-break aria-label="<?PHP echo $resultpaymentLog3; ?>"><i class="glyphicon glyphicon-exclamation-sign" style="color:#F0AD4E"></i></span><?PHP
                                                                                    }
                                                                                    ?>
                                                                                </td>

                                                                                <td class="footable-visible" style="width: 80px;"><?php echo $payment3['ph_job_id']; ?></td>
                                                                                <td class="footable-visible" style="width: 80px;"><?php echo number_format((float) ($payment3['ph_amount'] + $payment3['ph_rf']), 2, '.', '');  //echo $payment3['ph_amount'];?></td>
                                                                                <td class="footable-visible" style="width: 80px;">
                                                                                    <?php //echo $payment3['ph_receipt'];
                                                                                    $pad_length = 2;
                                                                                    $pad_char = 0;
                                                                                    if ($payment3['ph_receipt'] == 'temp') {
                                                                                        $thisCycle = '01';
                                                                                    } else {
                                                                                        $thisCycle = str_pad($payment3['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT) . ' (paid)';
                                                                                    }
                                                                                    ?>
                                                                                    <a href="https://www.tutorkami.com/admin/templates-pdf-user.php?last=<?php echo $payment3['ph_id'] ?>&date=<?php echo $payment3['ph_date'] ?>&jobID=<?php echo $payment3['ph_job_id']; ?> " target="_blank"><?php echo 'i' . $payment3['ph_job_id'] . $thisCycle; ?></a>
                                                                                </td>
                                                                                <td class="footable-visible" style="width: 80px;">
                                                                                    <button onClick="deletePayment(<?php echo $payment3['ph_id']; ?>)" type="button" class="btn btn-danger2 btn-sm">Delete</button>
                                                                                </td>
                                                                            </tr>
                                                                            <?PHP
                                                                        }
                                                                    }
                                                                }


                                                            }
                                                        }

                                                        ?>


                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div id="tab-parent4" class="tab-pane">

                                    <div class="panel-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputCity"><u>Proof1 (for 1-1 tuition)</u></label>
                                                <?PHP
                                                /*$connDB = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($connDB->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $connDB->connect_error);
    exit();
}*/
                                                $queryTermsP = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='78'");
                                                $resTermsP = $queryTermsP->num_rows;
                                                if ($resTermsP > 0) {
                                                    if ($rowTermsP = $queryTermsP->fetch_assoc()) {
                                                        $idBIP = $rowTermsP['pmt_id'];
                                                        $desBIP = $rowTermsP['pmt_pagedetail'];
                                                    }
                                                } else {
                                                    $idBIP = "";
                                                    $desBIP = "";
                                                }

                                                ?>
                                                <div>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <?PHP
                                                                if ($userRow['signature_img'] != '') {
                                                                    $pix = $userRow['signature_img'];
                                                                    $pixAll = $pix . ".png";
                                                                    ?>
                                                                    <!--<div class="pull-right">
			<img width="‭225‬" height="157" src="<?php //echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature">
			<br/>
		<?PHP
                                                                    $firstname = $userRow['ud_first_name'];
                                                                    $fullnameSig = $firstname . " " . $userRow['ud_last_name'];

                                                                    $dateSig = $userRow['signature_img'];
                                                                    $dateSig = strtok($dateSig, '_');

                                                                    ?>
		</div>-->
                                                                    <div class="clearfix"></div>
                                                                    <button type="button" class="btn btn-sm btn-primary sign-btn-box" onclick="openParentPDF('<?php echo $userRow['u_displayid']; ?>')">Download PDF</button>
                                                                    <?PHP

                                                                    $getTime = getBetween($userRow['signature_img'], "_", "_");
                                                                    if (strlen($getTime) == '7') {
                                                                        $getTime = str_replace("-", ":", substr($getTime, 0, -2)) . ':00';
                                                                    } else {
                                                                        $getTime = str_replace("-", ":", $getTime) . ':00';
                                                                    }
                                                                    echo '&emsp;&emsp;Signed on ' . str_replace('-', '/', $dateSig) . ' (' . $getTime . ')';


                                                                }
                                                                ?>

                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="btn-group">
                                                                    <button class="btn" style="background-color:#5cb85c;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed latest terms</b>
                                                                </div>
                                                                <br/>
                                                                <div class="btn-group">
                                                                    <button class="btn" style="background-color:#eff215;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed previous terms</b>
                                                                </div>
                                                            </div>
                                                            <?PHP
                                                            if ($userRow['signature_img'] != null || $userRow['signature_img'] != '') {
                                                                ?>
                                                                <div class="col-sm-6">
                                                                    <button type="button" class="btn btn-md btn-reset" onclick="resetSignature('<?php echo $userRow['u_displayid']; ?>')">Reset signature</button>
                                                                </div>
                                                                <?PHP
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                        </div>

                                    </div>


                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">
                                                Link to Parent’s Terms
                                            </label>
                                            <div class="col-sm-8">
                                                <button type="button" class="btn btn-copy" onclick="copyLink('https://www.tutorkami.com/clients-terms')"><i class="fa fa-copy"></i> Copy Link</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="ModalCopy" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="modal-title">
                                                        <center>Link Successfully Copied</center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <div id="tab-Proofparent2" class="tab-pane">

                                    <div class="panel-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputCity"><u>Proof2 (for group tuition)</u></label>

                                                <div>


                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <?PHP
                                                                if ($userRow['signature_img2'] != '') {
                                                                    $dateSig2 = $userRow['signature_img2'];
                                                                    $dateSig2 = strtok($dateSig2, '_');
                                                                    ?>

                                                                    <div class="clearfix"></div>
                                                                    <button type="button" class="btn btn-sm btn-primary sign-btn-box" onclick="openParentPDF2('<?php echo $userRow['u_displayid']; ?>')">Download PDF</button>
                                                                    <?PHP

                                                                    $getTime2 = getBetween($userRow['signature_img2'], "_", "_");
                                                                    if (strlen($getTime2) == '7') {
                                                                        $getTime2 = str_replace("-", ":", substr($getTime2, 0, -2)) . ':00';
                                                                    } else {
                                                                        $getTime2 = str_replace("-", ":", $getTime2) . ':00';
                                                                    }
                                                                    echo '&emsp;&emsp;Signed on ' . str_replace('-', '/', $dateSig2) . ' (' . $getTime2 . ')';


                                                                }

                                                                ?>

                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="btn-group">
                                                                    <button class="btn" style="background-color:#5cb85c;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed latest terms</b>
                                                                </div>
                                                                <br/>
                                                                <div class="btn-group">
                                                                    <button class="btn" style="background-color:#eff215;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed previous terms</b>
                                                                </div>
                                                            </div>
                                                            <?PHP
                                                            if ($userRow['signature_img2'] != null || $userRow['signature_img2'] != '') {
                                                                ?>
                                                                <div class="col-sm-6">
                                                                    <button type="button" class="btn btn-md btn-reset" onclick="resetSignature2('<?php echo $userRow['u_displayid']; ?>')">Reset signature</button>
                                                                </div>
                                                                <?PHP
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div id="rform" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">

                                                <?PHP
                                                function getAge($dob) {

                                                    $old_date = explode('/', $dob);
                                                    $new_data = $old_date[2] . '-' . $old_date[1] . '-' . $old_date[0];

                                                    $dateOfBirth = date("Y-m-d", strtotime($new_data));
                                                    $today = date("Y-m-d");
                                                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                    $age = $diff->format('%y');

                                                    return $age;
                                                }


                                                $queryRForm = $conDB->query(" SELECT * FROM tk_rform WHERE displayid ='" . $_GET['u_id'] . "' ORDER BY timestamp DESC");
                                                $resRForm = $queryRForm->num_rows;
                                                if ($resRForm > 0){
                                                if ($rowRForm = $queryRForm->fetch_assoc()){
                                                //$idBIP  = $rowRForm['pmt_id'];
                                                //$desBIP = $rowRForm['pmt_pagedetail'];
                                                ?>
                                                <p><b>Student’s name :</b> <span style="color:#266569;font-weight: bold;"><?PHP echo $rowRForm['name']; ?></span>
                                                    <a href="https://docs.google.com/document/d/1FroM24MnE6t5YGGKDCGV0CSGS1UxMElV1nOtkIGFZTM/edit" target="_blank"><i class="glyphicon glyphicon-info-sign" style="color:#FF8040;margin-left:10%;"></i></a>
                                                <p>
                                                <p><b>Gender :</b> <span style="color:#266569;font-weight: bold;"><?PHP echo $rowRForm['gender']; ?></span>
                                                <p>
                                                <p><b>Home address :</b> <span style="color:#266569;font-weight: bold;"><?PHP echo $rowRForm['address']; ?></span>
                                                <p>
                                                <p><b>Name of student’s school :</b> <span style="color:#266569;font-weight: bold;"><?PHP echo $rowRForm['school']; ?></span>
                                                <p>
                                                <p><b>Relationship with student :</b> <span style="color:#266569;font-weight: bold;"><?PHP echo $rowRForm['relationship']; ?></span>
                                                <p>
                                                <p><b>Occupation :</b> <span style="color:#266569;font-weight: bold;"><?PHP echo $rowRForm['occupation']; ?></span>
                                                <p>
                                                <p><b>DOB :</b> <span style="color:#266569;font-weight: bold;"><?PHP if ($rowRForm['dob'] != '') {
                                                            echo getAge($rowRForm['dob']);
                                                        } ?></span>
                                                <p>
                                                <p><b>How did you get to know about TutorKami? :</b> <span style="color:#266569;font-weight: bold;"><?PHP echo $rowRForm['know']; ?></spankj>
                                                <p>
                                                    <?PHP
                                                    }
                                                    }
                                                    ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="tab-parent4TuitionCentre" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputCity"><u>Terms</u></label>
                                                <?PHP
                                                $queryTermsP = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='84'");
                                                $resTermsP = $queryTermsP->num_rows;
                                                if ($resTermsP > 0) {
                                                    if ($rowTermsP = $queryTermsP->fetch_assoc()) {
                                                        $idBIP = $rowTermsP['pmt_id'];
                                                        $desBIP = $rowTermsP['pmt_pagedetail'];
                                                    }
                                                } else {
                                                    $idBIP = "";
                                                    $desBIP = "";
                                                }
                                                ?>

                                                <div>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <?PHP
                                                                if ($userRow['signature_img3'] != '') {
                                                                    $pix = $userRow['signature_img3'];
                                                                    $pixAll = $pix . ".png";
                                                                    ?>

                                                                    <div class="clearfix"></div>
                                                                    <button type="button" class="btn btn-sm btn-primary sign-btn-box" onclick="openParentPDFCenter('<?php echo $userRow['u_displayid']; ?>')">Download PDF</button>
                                                                    <?PHP

                                                                    $getTime = getBetween($userRow['signature_img3'], "_", "_");
                                                                    if (strlen($getTime) == '7') {
                                                                        $getTime = str_replace("-", ":", substr($getTime, 0, -2)) . ':00';
                                                                    } else {
                                                                        $getTime = str_replace("-", ":", $getTime) . ':00';
                                                                    }
                                                                    echo '&emsp;&emsp;Signed on ' . str_replace('-', '/', $dateSig) . ' (' . $getTime . ')';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="btn-group">
                                                                    <button class="btn" style="background-color:#5cb85c;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed latest terms</b>
                                                                </div>
                                                                <br/>
                                                                <div class="btn-group">
                                                                    <button class="btn" style="background-color:#eff215;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed previous terms</b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">
                                                Link to Parent’s Terms
                                            </label>
                                            <div class="col-sm-8">
                                                <button type="button" class="btn btn-copy" onclick="copyLink('https://www.tutorkami.com/clients-terms')"><i class="fa fa-copy"></i> Copy Link</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="ModalCopy" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="modal-title">
                                                        <center>Link Successfully Copied</center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php if (isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                                    <div id="tab-3" class="tab-pane">
                                        <div class="panel-body">
                                            <p><label>Upload Testimonial</label></p><br/>

                                            <?PHP
                                            $testti1 = '';
                                            $testti2 = '';
                                            $testti3 = '';
                                            $testti4 = '';
                                            $testData = $userInit->GetUserTestimonial($userRow['u_id']);
                                            if ($testData->num_rows > 0) {
                                                while ($testimonial = $testData->fetch_assoc()) {
                                                    if ($testimonial['ut_user_testimonial1'] != '') {
                                                        $testti1 = APP_ROOT . $testimonial['ut_user_testimonial1'];
                                                    }
                                                    if ($testimonial['ut_user_testimonial2'] != '') {
                                                        $testti2 = APP_ROOT . $testimonial['ut_user_testimonial2'];
                                                    }
                                                    if ($testimonial['ut_user_testimonial3'] != '') {
                                                        $testti3 = APP_ROOT . $testimonial['ut_user_testimonial3'];
                                                    }
                                                    if ($testimonial['ut_user_testimonial4'] != '') {
                                                        $testti4 = APP_ROOT . $testimonial['ut_user_testimonial4'];
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="file" name="user_testimonial1" id="testimonial_1" class="inputfile inputfile-6"><br/>
                                                    <?PHP if ($testti1 != '') { ?>
                                                        <label> <input type="checkbox" id="checkbox-1" name="checkbox-1">DELETE TESTIMONIAL 1</label>
                                                        <a class="example-image-link" href="<?php echo $testti1; ?>" data-lightbox="example-set">
                                                            <img src="<?php echo $testti1; ?>" alt="testimonial1" class="cropped img-responsive admin-testm-img">
                                                        </a>
                                                    <?PHP } ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="file" name="user_testimonial2" id="testimonial_2" class="inputfile inputfile-6"> <br/>
                                                    <?PHP if ($testti2 != '') { ?>
                                                        <label> <input type="checkbox" id="checkbox-2" name="checkbox-2">DELETE TESTIMONIAL 2</label>
                                                        <a class="example-image-link" href="<?php echo $testti2; ?>" data-lightbox="example-set">
                                                            <img src="<?php echo $testti2; ?>" alt="testimonial2" class="cropped img-responsive admin-testm-img">
                                                        </a>
                                                    <?PHP } ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="file" name="user_testimonial3" id="testimonial_3" class="inputfile inputfile-6"><br/>
                                                    <?PHP if ($testti3 != '') { ?>
                                                        <label> <input type="checkbox" id="checkbox-3" name="checkbox-3">DELETE TESTIMONIAL 3</label>
                                                        <a class="example-image-link" href="<?php echo $testti3; ?>" data-lightbox="example-set">
                                                            <img src="<?php echo $testti3; ?>" alt="testimonial3" class="cropped img-responsive admin-testm-img">
                                                        </a>
                                                    <?PHP } ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="file" name="user_testimonial4" id="testimonial_4" class="inputfile inputfile-6"><br/>
                                                    <?PHP if ($testti4 != '') { ?>
                                                        <label> <input type="checkbox" id="checkbox-4" name="checkbox-4">DELETE TESTIMONIAL 4</label>
                                                        <a class="example-image-link" href="<?php echo $testti4; ?>" data-lightbox="example-set">
                                                            <img src="<?php echo $testti4; ?>" alt="testimonial4" class="cropped img-responsive admin-testm-img">
                                                        </a>
                                                    <?PHP } ?>
                                                </div>
                                            </div>


                                            <br/><br/>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity">Video Profile</label><br/>
                                                    <small id="emailHelp" class="form-text text-muted">Paste the URL of the video</small>
                                                    <input placeholder="E.g https://youtu.be/CPPQzT6kg24" type="text" class="form-control" name="url_video" value="<?php echo (isset($_POST['url_video'])) ? $_POST['url_video'] : ((isset($userRow) && $userRow !== null) ? $userRow['url_video'] : ''); ?>">
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                    <div id="tabRating" class="tab-pane">
                                        <div class="panel-body">
                                            <!--<p><label><b>Combined Average Rating</b></label></p>-->
                                            <p id="loadRating"><?php //include('review-rating.php');?></p>
                                        </div>
                                    </div>


                                    <div id="tab-4" class="tab-pane">

                                        <div class="panel-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity"><u>Terms of Accepting 1-to-1 Tuition Job</u></label>
                                                    <?PHP
                                                    /*$connDB = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($connDB->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $connDB->connect_error);
    exit();
}*/
                                                    $queryTerms = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='76'");
                                                    $resTerms = $queryTerms->num_rows;
                                                    if ($resTerms > 0) {
                                                        if ($rowTerms = $queryTerms->fetch_assoc()) {
                                                            $idBI = $rowTerms['pmt_id'];
                                                            $desBI = $rowTerms['pmt_pagedetail'];
                                                        }
                                                    } else {
                                                        $idBI = "";
                                                        $desBI = "";
                                                    }

                                                    //echo $desBI;
                                                    ?>
                                                    <!--<div class="col-lg-12 text-right">
	<p> I have read and agreed to all the terms above</p>
</div>-->

                                                    <style></style>
                                                    <div>


                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <?PHP
                                                                    if ($userRow['signature_img'] != '') {
                                                                        $pix = $userRow['signature_img'];
                                                                        $pixAll = $pix . ".png";
                                                                        ?>
                                                                        <!--<div class="pull-right">
			<img width="‭225‬" height="157" src="<?php //echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature">
			<br/>
		<?PHP
                                                                        $firstname = $userRow['ud_first_name'];
                                                                        $fullnameSig = $firstname . " " . $userRow['ud_last_name'];
                                                                        //echo 'Name : '.$fullnameSig.'<br/>';

                                                                        $dateSig = $userRow['signature_img'];
                                                                        $dateSig = strtok($dateSig, '_');
                                                                        //echo 'Date : '.$dateSig;

                                                                        ?>
		</div>-->
                                                                        <div class="clearfix"></div>
                                                                        <button type="button" class="btn btn-sm btn-primary sign-btn-box" onclick="openPDF('<?php echo $userRow['u_displayid']; ?>')">Download PDF</button>
                                                                        <?PHP
                                                                        /*$getTime = getBetween($userRow['signature_img'],"_","_");
		echo '&emsp;&emsp;Signed on '.str_replace('-', '/', $dateSig).' ('.str_replace("-",":",substr($getTime, 0, -2)).')';*/

                                                                        $getTime = getBetween($userRow['signature_img'], "_", "_");
                                                                        if (strlen($getTime) == '7') {
                                                                            $getTime = str_replace("-", ":", substr($getTime, 0, -2)) . ':00';
                                                                        } else {
                                                                            $getTime = str_replace("-", ":", $getTime) . ':00';
                                                                        }
                                                                        echo '&emsp;&emsp;Signed on ' . str_replace('-', '/', $dateSig) . ' (' . $getTime . ')';


                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="btn-group">
                                                                        <button class="btn" style="background-color:#5cb85c;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed latest terms</b>
                                                                    </div>
                                                                    <br/>
                                                                    <div class="btn-group">
                                                                        <button class="btn" style="background-color:#eff215;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed previous terms</b>
                                                                    </div>
                                                                </div>
                                                                <style>
                                                                    .btn-reset {
                                                                        color: #ffffff;
                                                                        background-color: #D60000;
                                                                        border-color: #D60000;
                                                                    }

                                                                    .btn-reset:hover,
                                                                    .btn-reset:focus,
                                                                    .btn-reset:active,
                                                                    .btn-reset.active,
                                                                    .open .dropdown-toggle.btn-reset {
                                                                        color: #ffffff;
                                                                        background-color: #D60000;
                                                                        border-color: #D60000;
                                                                    }

                                                                    .btn-reset:active,
                                                                    .btn-reset.active,
                                                                    .open .dropdown-toggle.btn-reset {
                                                                        background-image: none;
                                                                    }

                                                                    .btn-reset.disabled,
                                                                    .btn-reset[disabled],
                                                                    fieldset[disabled] .btn-reset,
                                                                    .btn-reset.disabled:hover,
                                                                    .btn-reset[disabled]:hover,
                                                                    fieldset[disabled] .btn-reset:hover,
                                                                    .btn-reset.disabled:focus,
                                                                    .btn-reset[disabled]:focus,
                                                                    fieldset[disabled] .btn-reset:focus,
                                                                    .btn-reset.disabled:active,
                                                                    .btn-reset[disabled]:active,
                                                                    fieldset[disabled] .btn-reset:active,
                                                                    .btn-reset.disabled.active,
                                                                    .btn-reset[disabled].active,
                                                                    fieldset[disabled] .btn-reset.active {
                                                                        background-color: #D60000;
                                                                        border-color: #D60000;
                                                                    }

                                                                    .btn-reset .badge {
                                                                        color: #D60000;
                                                                        background-color: #ffffff;
                                                                    }
                                                                </style>
                                                                <?PHP
                                                                if ($userRow['signature_img'] != null || $userRow['signature_img'] != '') {
                                                                    ?>
                                                                    <div class="col-sm-6">
                                                                        <button type="button" class="btn btn-md btn-reset" onclick="resetSignature('<?php echo $userRow['u_displayid']; ?>')">Reset signature</button>
                                                                    </div>
                                                                    <?PHP
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>

                                        </div>


                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4">
                                                    From What’s App
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="file" name="ud_proof_of_accepting_terms" id="ud_proof_of_accepting_terms" class="inputfile inputfile-6">
                                                </div>
                                            </div>
                                            <ul class="whatsapp">
                                                <?php
                                                if (isset($userRow) && $userRow !== null) {
                                                    if ($userRow['ud_proof_of_accepting_terms'] != '') {
                                                        ?>
                                                        <li><img src="<?php echo APP_ROOT . $userRow['ud_proof_of_accepting_terms']; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>

                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4">
                                                    Link to Tutor’s Terms
                                                </label>
                                                <div class="col-sm-8">
                                                    <button type="button" class="btn btn-copy" onclick="copyLink('https://www.tutorkami.com/tutors-terms')"><i class="fa fa-copy"></i> Copy Link</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="ModalCopy" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title">
                                                            <center>Link Successfully Copied</center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    <div id="tab-Proof2" class="tab-pane">

                                        <div class="panel-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity"><u>Additional terms: Group Tuition</u></label>

                                                    <div>


                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <?PHP
                                                                    if ($userRow['signature_img2'] != '') {
                                                                        $dateSig2 = $userRow['signature_img2'];
                                                                        $dateSig2 = strtok($dateSig2, '_');
                                                                        ?>

                                                                        <div class="clearfix"></div>
                                                                        <button type="button" class="btn btn-sm btn-primary sign-btn-box" onclick="openPDF2('<?php echo $userRow['u_displayid']; ?>')">Download PDF</button>
                                                                        <?PHP
                                                                        /*$getTime2 = getBetween($userRow['signature_img2'],"_","_");
		echo '&emsp;&emsp;Signed on '.str_replace('-', '/', $dateSig2).' ('.str_replace("-",":",substr($getTime2, 0, -2)).')';*/

                                                                        $getTime2 = getBetween($userRow['signature_img2'], "_", "_");
                                                                        if (strlen($getTime2) == '7') {
                                                                            $getTime2 = str_replace("-", ":", substr($getTime2, 0, -2)) . ':00';
                                                                        } else {
                                                                            $getTime2 = str_replace("-", ":", $getTime2) . ':00';
                                                                        }
                                                                        //echo '&emsp;&emsp;Signed on '.$getTime2;
                                                                        echo '&emsp;&emsp;Signed on ' . str_replace('-', '/', $dateSig2) . ' (' . $getTime2 . ')';


                                                                    }

                                                                    ?>

                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="btn-group">
                                                                        <button class="btn" style="background-color:#5cb85c;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed latest terms</b>
                                                                    </div>
                                                                    <br/>
                                                                    <div class="btn-group">
                                                                        <button class="btn" style="background-color:#eff215;">&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<b>Signed previous terms</b>
                                                                    </div>
                                                                </div>

                                                                <?PHP
                                                                if ($userRow['signature_img2'] != null || $userRow['signature_img2'] != '') {
                                                                    ?>
                                                                    <div class="col-sm-6">
                                                                        <button type="button" class="btn btn-md btn-reset" onclick="resetSignature2('<?php echo $userRow['u_displayid']; ?>')">Reset signature</button>
                                                                    </div>
                                                                    <?PHP
                                                                }
                                                                ?>


                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div id="tab-PV" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded" data-page-size="15">
                                                        <thead>
                                                            <tr>
                                                                <th data-hide="phone" class="footable-visible footable-sortable">Date <a href="https://docs.google.com/document/d/1lfMz2SYY6_7k5MWT6KFOP4mfjqpCr40OU1cUbVhHh7Y/edit" target="_black"><i class="glyphicon glyphicon-question-sign" style="color:#262262"></i></a></th>
                                                                <th data-hide="phone,tablet" class="footable-visible footable-sortable">Job ID<span class="footable-sort-indicator"></span></th>
                                                                <th data-hide="phone,tablet" class="footable-visible footable-sortable">Amount (RM)<span class="footable-sort-indicator"></span></th>
                                                                <th data-hide="phone,tablet" class="footable-visible footable-sortable">Payment Voucher<span class="footable-sort-indicator"></span></th>
                                                                <th data-hide="phone,tablet" class="footable-visible footable-sortable">Action<span class="footable-sort-indicator"></span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $paymentTutor = " SELECT * FROM tk_payment_history WHERE ph_user_type = '3' AND ph_user_id = '" . $userRow['u_id'] . "' ORDER BY ph_date DESC, ph_receipt DESC ";
                                                            $payment2Tutor = $conDB->query($paymentTutor);
                                                            if ($payment2Tutor->num_rows > 0) {
                                                                while ($payment3Tutor = $payment2Tutor->fetch_assoc()) {
                                                                    ?>
                                                                    <tr class="footable-even" style="display: table-row;">
                                                                        <td class="footable-visible" style="width: 120px;">
                                                                            <?php //echo date("d/m/Y", strtotime($payment3Tutor['ph_date'])); ?>
                                                                            <span color="#266569" style="cursor: pointer;" onclick="openPopup(<?PHP echo $payment3Tutor['ph_id'] . ',' . $payment3Tutor['ph_amount'] . ',' . $payment3Tutor['ph_rf'] . ',' . $payment3Tutor['hour']; ?>,'<?PHP echo $payment3Tutor['tutor']; ?>','<?PHP echo date("d/m/Y", strtotime($payment3Tutor['ph_date'])); ?>','<?PHP echo $payment3Tutor['description']; ?>','tutor','<?PHP echo $payment3Tutor['description_rf']; ?>')">
                                                                                <b><?PHP echo date("d/m/Y", strtotime($payment3Tutor['ph_date'])); ?></b>
                                                                            </span>
                                                                            <?PHP
                                                                            if ($payment3Tutor['description'] != '') {
                                                                                $resultpaymentLog3Tutor = '';
                                                                                $paymentLogTutor = " SELECT * FROM tk_payment_log WHERE id_payment = '" . $payment3Tutor['ph_id'] . "' ORDER BY id DESC ";
                                                                                $paymentLog2Tutor = $conDB->query($paymentLogTutor);
                                                                                if ($paymentLog2Tutor->num_rows > 0) {
                                                                                    while ($paymentLog3Tutor = $paymentLog2Tutor->fetch_assoc()) {
                                                                                        $resultpaymentLog3Tutor .= $paymentLog3Tutor['log'] . '&#10;';
                                                                                    }
                                                                                }
                                                                                ?>&nbsp;&nbsp;<span data-balloon-length="large" data-balloon-pos="right" data-balloon-break aria-label="<?PHP echo $resultpaymentLog3Tutor; ?>"><i class="glyphicon glyphicon-exclamation-sign" style="color:#F0AD4E"></i></span><?PHP
                                                                            }
                                                                            ?>
                                                                        </td>


                                                                        <td class="footable-visible" style="width: 80px;"><?php echo $payment3Tutor['ph_job_id']; ?></td>
                                                                        <td class="footable-visible" style="width: 80px;"><?php echo $payment3Tutor['ph_amount']; ?></td>
                                                                        <td class="footable-visible" style="width: 80px;">
                                                                            <?php
                                                                            $pad_length = 2;
                                                                            $pad_char = 0;
                                                                            if ($payment3Tutor['ph_receipt'] == 'trial paid') {
                                                                                $thisCycle = 'T';
                                                                            } else {
                                                                                $thisCycle = str_pad($payment3Tutor['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT);
                                                                            }

                                                                            ?>
                                                                            <a href="https://www.tutorkami.com/admin/templates-pdf-tutor.php?last=<?php echo $payment3Tutor['ph_id'] ?>&date=<?php echo $payment3Tutor['ph_date'] ?>&jobID=<?php echo $payment3Tutor['ph_job_id']; ?> " target="_blank"><?php echo 'PV' . $payment3Tutor['ph_job_id'] . $thisCycle; ?></a>
                                                                        </td>
                                                                        <td class="footable-visible" style="width: 80px;">
                                                                            <button onClick="deletePayment(<?php echo $payment3Tutor['ph_id']; ?>)" type="button" class="btn btn-danger2 btn-sm">Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                    <?PHP
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- luqman city -->
                                    <div id="tab-5" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Area You Can Cover : <br></label>
                                                <div class="col-sm-10">
                                                    <div class="row"><!-- row -->
                                                        <?php
                                                        $areaCnt = $initLocation->GetAllCountry(150);
                                                        if ($areaCnt->num_rows > 0) {
                                                            $i = 0;
                                                            while ($country = $areaCnt->fetch_assoc()) {
                                                                // Get State By Country Id
                                                                $getCountryWiseStates = $initLocation->CountryWiseState($country['c_id']);
                                                                if ($getCountryWiseStates->num_rows > 0) {
                                                                    $i = 0;//man tambah
                                                                    while ($state = $getCountryWiseStates->fetch_assoc()) {
                                                                        // GET User State
                                                                        $checked = $initLocation->UserWiseState($userRow['u_id'], $state['st_id'])->num_rows;

                                                                        // GET Other City of the state
                                                                        $OtherState = $initLocation->UserWiseOtherState($userRow['u_id'], $state['st_id']);
                                                                        ?>
                                                                        <div class="col-md-6"><!-- col-md-6 -->
                                                                            <div class="checkbox">
                                                                                <input type="checkbox" name="cover_area_state[]" id="ca_state_<?php echo $state['st_id']; ?>" value="<?php echo $state['st_id']; ?>" onchange="checkAll(this, '<?php echo 'cover_area_city_' . $state['st_id']; ?>')" <?php echo ($checked > 0) ? 'checked' : ''; ?>>
                                                                                <label class="custom toggleShowHide"><?php echo $state['st_name']; ?></label>
                                                                                <?php
                                                                                // Get City By State Id
                                                                                $getStateWiseCity = $initLocation->StateWiseCity($state['st_id']);

                                                                                if ($getStateWiseCity->num_rows > 0) {
                                                                                    ?>
                                                                                    <div class="showHide" style="display:none;"<?php //echo $stl; ?>>
                                                                                        <div class="dropbox">Please tick the area(s)</div>
                                                                                        <div class="dropPop" <?php //echo $stl; ?>>
                                                                                            <div class="row">
                                                                                                <?php
                                                                                                $city_arr = $initLocation->UserWiseCity($userRow['u_id']);//bukan array
                                                                                                // print_r($city_arr);die;
                                                                                                while ($city = $getStateWiseCity->fetch_assoc()) {


                                                                                                    ?>
                                                                                                    <div class="col-md-6">
                                                                                                        <input type="checkbox" name="cover_area_city_<?php echo $state['st_id']; ?>[<?php echo $i; ?>]" id="cover_area_city_<?php echo $state['st_id']; ?>_<?php echo $i; ?>"
                                                                                                            value="<?php echo $city['city_id']; ?>" data-pid="<?php echo $state['st_id']; ?>" data-cname="cover_area_city_" data-oname="other_area_"
                                                                                                            data-pname="ca_state_" onchange="check_parent( this)" <?php echo (in_array($city['city_id'], $city_arr)) ? 'checked="checked"' : ''; ?>>

                                                                                                        <label for="cover_area_city_<?php echo $state['st_id']; ?>_<?php echo $i; ?>" class="custom"><?php echo $city['city_name']; ?></label>
                                                                                                    </div>

                                                                                                    <?php $i++;
                                                                                                } ?>
                                                                                                <!-- SLOW ATAS -->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>

                                                                            </div><!-- checkbox -->
                                                                        </div><!-- col-md-6 -->
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </div><!-- row -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- timetable -->
                                    <div id="tab-10" class="tab-pane">
                                        <div class="panel-body">
                                            <p><span color="blue">Available Time Slots </span></p>


                                            <?PHP
                                            /*
$localhost = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

// create connection
$conn = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($conn->connect_error) {
    die("connection failed : " . $conn->connect_error);
} else {
    // echo "Successfully Connected";
}*/

                                            $recordFirst = 1;
                                            //$queryTT = " SELECT * FROM tk_timetable WHERE tt_tutor='".$userRow['u_id']."' ORDER BY tt_id ASC";
                                            $queryTT = " SELECT * FROM tk_timetable WHERE tt_tutor='" . $userRow['u_id'] . "' ORDER BY tt_day='Mon' DESC, tt_day='Tues' DESC, tt_day='Wed' DESC, tt_day='Thur' DESC, tt_day='Fri' DESC, tt_day='Sat' DESC, tt_day='Sun' DESC ";
                                            $resultTT = $conDB->query($queryTT);
                                            if ($resultTT->num_rows > 0) {
                                                ?>


                                                <input type="hidden" id="hdnListCountExist" value="<?PHP echo $resultTT->num_rows; ?>"/>
                                                <input type="hidden" id="name3" value="<?PHP echo $resultTT->num_rows; ?>"/>
                                                <form name="add_name2" id="add_name2" class="" style="margin-left:5px;">
                                                    <div class="table-responsive">
                                                        <input type="hidden" id="hdnListCount" value="1"/>
                                                        <input type="hidden" name="tutorPHP" id="tutorPHP" value="<?php echo $userRow['u_id']; ?>"/>
                                                        <table class="table" id="dynamic_fieldExist">
                                                            <?PHP
                                                            $recordFirst = 1;
                                                            while ($rowTT = $resultTT->fetch_assoc()) {
                                                                ?>
                                                                <tr id="<?php echo 'thistr' . $rowTT['tt_id']; ?>">
                                                                    <td>
                                                                        <select id="<?php echo 'select' . $rowTT['tt_id']; ?>" name="dayPHP[]" class="form-control name_list hahah2" required="">
                                                                            <option value="Mon" <?PHP if ($rowTT['tt_day'] == 'Mon') {
                                                                                echo 'selected';
                                                                            } ?> >Mon
                                                                            </option>
                                                                            <option value="Tues" <?PHP if ($rowTT['tt_day'] == 'Tues') {
                                                                                echo 'selected';
                                                                            } ?> >Tues
                                                                            </option>
                                                                            <option value="Wed" <?PHP if ($rowTT['tt_day'] == 'Wed') {
                                                                                echo 'selected';
                                                                            } ?> >Wed
                                                                            </option>
                                                                            <option value="Thur" <?PHP if ($rowTT['tt_day'] == 'Thur') {
                                                                                echo 'selected';
                                                                            } ?> >Thur
                                                                            </option>
                                                                            <option value="Fri" <?PHP if ($rowTT['tt_day'] == 'Fri') {
                                                                                echo 'selected';
                                                                            } ?> >Fri
                                                                            </option>
                                                                            <option value="Sat" <?PHP if ($rowTT['tt_day'] == 'Sat') {
                                                                                echo 'selected';
                                                                            } ?> >Sat
                                                                            </option>
                                                                            <option value="Sun"<?PHP if ($rowTT['tt_day'] == 'Sun') {
                                                                                echo 'selected';
                                                                            } ?> >Sun
                                                                            </option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input id="<?php echo 'input' . $rowTT['tt_id']; ?>" type="text" name="namePHP[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list hahah" required="" value="<?php echo $rowTT['tt_time']; ?>"/></td>
                                                                    <td><a id="<?php echo 'remove' . $rowTT['tt_id']; ?>" style="color:red;font-size:30px;text-decoration: none;" name="remove" class="fa fa-trash-o btn_removePHP"></a></td>
                                                                </tr>
                                                                <?PHP
                                                            }
                                                            ?>
                                                        </table>
                                                        <br/>
                                                        <button type="button" name="addMore" id="addMore" class="btn btn-success"><i class="fa fa-plus"></i> Add Day</button>
                                                        <input style="background-color: #ED4917;color: white;" type="button" name="submitExist" id="submitExist" class="btn btn-oren" value="Update"/>
                                                    </div>
                                                </form>


                                                <?PHP
                                            } else {

                                                ?>
                                                <input type="hidden" id="changeDayArray"/>
                                                <form name="add_name" id="add_name" style="margin-left:5px;">
                                                    <div class="table-responsive">
                                                        <input type="hidden" id="hdnListCount" value="1"/>
                                                        <input type="hidden" name="tutor" id="tutor" value="<?php echo $userRow['u_id']; ?>"/>
                                                        <table class="table" id="dynamic_field">

                                                        </table>
                                                        <br/>
                                                        <button type="button" name="addTimeTable" id="addTimeTable" class="btn btn-success"><i class="fa fa-plus"></i> Add Day</button>
                                                        <input style="background-color: #ED4917;color: white;" type="button" name="submitNew" id="submitNew" class="btn btn-oren" value="Update"/>
                                                    </div>
                                                </form>
                                                <?PHP
                                            }
                                            ?>


                                        </div>
                                    </div>


                                    <!-- luqman city -->
                                    <div id="tab-6" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="form-group" id="dob">
                                                <label class="col-sm-2 control-label">Subject You Can Teach :</label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <?php
                                                        // Get Course
                                                        $getCourse = $initApp->ListCourseNew();

                                                        if ($getCourse->num_rows > 0) {
                                                            $i = 0;
                                                            while ($course = $getCourse->fetch_assoc()) {
                                                                $checked = $initApp->UserWiseCourse($userRow['u_id'], $course['tc_id'])->num_rows;
                                                                $OtherCourse = $initApp->UserWiseOtherCourse($userRow['u_id'], $course['tc_id']);
                                                                ?>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <input type="checkbox" name="tutor_course[]" id="tu_course_<?php echo $course['tc_id']; ?>" value="<?php echo $course['tc_id']; ?>" onchange="checkAll(this, '<?php echo 'tutor_subject_' . $course['tc_id']; ?>')" <?php echo ($checked > 0) ? 'checked' : ''; ?>>
                                                                        <label class="custom toggleShowHide"><?php echo $course['tc_title']; ?></label>
                                                                        <?php
                                                                        $getSubject = $initApp->CourseWiseSubject($course['tc_id']);

                                                                        if ($getSubject->num_rows > 0) {
                                                                            ?>
                                                                            <div class="showHide" style="display:none;">
                                                                                <div class="dropbox">Please tick the subject(s)</div>
                                                                                <div class="dropPop">
                                                                                    <div class="row">
                                                                                        <?php

                                                                                        $subject_arr = $initApp->UserWiseSubject($userRow['u_id']);
                                                                                        while ($subject = $getSubject->fetch_assoc()) {
                                                                                            ?>
                                                                                            <div class="col-md-12">
                                                                                                <input type="checkbox" name="tutor_subject_<?php echo $course['tc_id']; ?>[<?php echo $i; ?>]" id="tutor_subject_<?php echo $course['tc_id']; ?>_<?php echo $i; ?>" value="<?php echo $subject['ts_id']; ?>" data-pid="<?php echo $course['tc_id']; ?>" data-cname="tutor_subject_" data-oname="subject_" data-pname="tu_course_" onchange="check_parent( this)" <?php echo (in_array($subject['ts_id'],
                                                                                                    $subject_arr)) ? 'checked="checked"' : ''; ?>>

                                                                                                <label for="tutor_subject_<?php echo $course['tc_id']; ?>_<?php echo $i; ?>" class="custom"><?php echo $subject['ts_title']; ?></label>
                                                                                            </div>
                                                                                            <?php $i++;
                                                                                        } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                            <div class="panel-body hidelater">
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                                        <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">S&CE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script>
    $('#popoverData').popover();
    $(function () {
        //$("#popoverData").popover('show');
    });
    $('body').on('click', function (e) {
        if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('.popover.in').length === 0) {
            $("#popoverData").popover('hide');
        }
    });
    $(document).ready(function () {
        hideCollapse();
        <?PHP
        if (isset($_SESSION['tabReceipt'])) {
        if( $_SESSION['tabReceipt'] == "tutortutor" ){
        unset($_SESSION['tabReceipt']);
        ?>$("a[href='#tab-PV']").trigger('click');
        <?PHP
        }
        if( $_SESSION['tabReceipt'] == "client" ){
        unset($_SESSION['tabReceipt']);
        ?>$("a[href='#tab-7']").trigger('click');<?PHP
        }
        }
        ?>
    });

    function hideCollapse() {
        $('.collapse').collapse('hide');
    }

    function handleChange1() {
        var favorite = [];
        $.each($("input[name='toolsname1']:checked"), function () {
            favorite.push($(this).val());
        });
        document.getElementById("hiddentoolsname1").value = favorite.join(", ");

        if (favorite.join(", ").includes("Others")) {
            document.getElementById("conduct_online_other").classList.remove("hidden");
        } else {
            document.getElementById("conduct_online_other").classList.add("hidden");
        }


    }

    function collapseOne1() {
        if ($("#collapseOne").hasClass('in')) {
            document.getElementById("glyphicon-chevron-up").classList.add("hidden");
            document.getElementById("glyphicon-chevron-down").classList.add("hidden");
            document.getElementById("glyphicon-chevron-down").classList.remove("hidden");
        } else {
            document.getElementById("glyphicon-chevron-up").classList.add("hidden");
            document.getElementById("glyphicon-chevron-down").classList.add("hidden");
            document.getElementById("glyphicon-chevron-up").classList.remove("hidden");
        }
    }


    function showBanned() {
        $("#showBanned").hide();
        $("#showBanned2").show();
        alert("Phone number is already used");
    }


    $("#myid li").click(function () {
        if (this.id == 'this7') {
            $('#tab-7').addClass('active');
            $(".hidelater").hide();
        } else {
            $(".hidelater").show();
        }
    });


    $(document).ready(function () {
        $("#send_newsletter").click(function () {

            var sendemail_displayid = $('#sendemail_displayid').val();
            var sendemail_email = $('#sendemail_email').val();
            var sendemail_userdetail = $('#sendemail_userdetail').val();
            var sendemail_template = $('#sendemail_template').val();

            if (sendemail_email == '' && sendemail_displayid == '') {
                alert('Empty Email');
            } else if (sendemail_userdetail == '') {
                alert('Please Select User Details');
            } else if (sendemail_template == '') {
                alert('Please Select Email Template');
            } else {
                $.post("send_email_newsletter.php", {
                        sendemail_displayid: sendemail_displayid,
                        sendemail_email: sendemail_email,
                        sendemail_userdetail: sendemail_userdetail,
                        sendemail_template: sendemail_template
                    },
                    function (response, status) { // Required Callback Function
                        alert("Response : " + response + "\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
                        location.reload();
                    });
            }

        });
    });


    $('#ud_city').change(function () {
        //var inputValue = $(this).val();
        var inputValue = $("#ud_city option:selected").text();
        document.getElementById("ud_city2").value = inputValue;
    });

    function resetSignature(id) {
        //u_displayid
        var x = confirm("Are you sure you want to reset?");
        if (x == true) {
            $.ajax({
                type: 'POST',
                url: 'reset-signature.php',
                data: {
                    dataReset: {id: id},
                },
                success: function (result) {
                    alert(result);
                    //window.location = "tutors-terms.php"
                    location.reload();

                }
            });
        }
    }

    function resetSignature2(id) {
        var x = confirm("Are you sure you want to reset?");
        if (x == true) {
            $.ajax({
                type: 'POST',
                url: 'reset-signature.php',
                data: {
                    dataResetProof2: {id: id},
                },
                success: function (result) {
                    alert(result);
                    location.reload();
                }
            });
        }
    }


    function openPDF(id) {
        //alert(id);
        location.href = "proof-of-accepting-terms.php?user=" + id;
    }

    function openParentPDF(id) {
        location.href = "proof-for-1-1-tuition.php?user=" + id;
    }

    function openParentPDFCenter(id) {
        location.href = "proof-center-tuition.php?user=" + id;
    }

    function openPDF2(id) {
        location.href = "group-tuition-terms.php?user=" + id;
    }

    function openParentPDF2(id) {
        location.href = "proof-for-group-tuition.php?user=" + id;
    }

    function copyLink(value) {
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = value;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);

        $(this).tooltip('hide');
        $("#ModalCopy").modal();

        //alert("Link successfully copied");
    }

    function copyFrontEnd(value) {
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = value;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);

        $(this).tooltip('hide');
        $("#ModalCopy").modal();
    }

    /*
$('.selectpicker').selectpicker({
  showSubtext:true
});

*/


</script>

<script>
    function clickLi(id) {
        if (id == 'this4') {
            document.getElementById('fColor').style.color = "black";
            document.getElementById('afColor').style.color = "white";
            document.getElementById('loadRating').innerHTML = "";
        } else if (id == 'thisProof2') {
            document.getElementById('afColor').style.color = "black";
            document.getElementById('fColor').style.color = "white";
            document.getElementById('loadRating').innerHTML = "";
        } else if (id == 'thisparent4') {
            document.getElementById('fColor').style.color = "black";
            document.getElementById('afColor').style.color = "white";
            document.getElementById('loadRating').innerHTML = "";
        } else if (id == 'thisProofparent2') {
            document.getElementById('afColor').style.color = "black";
            document.getElementById('fColor').style.color = "white";
            document.getElementById('loadRating').innerHTML = "";
        } else if (id == 'thisparent4TuitionCentre') {
            document.getElementById('fColor').style.color = "black";
            document.getElementById('afColor').style.color = "white";
            document.getElementById('loadRating').innerHTML = "";
        } else if (id == 'thisTabRating') {
            document.getElementById('loadRating').innerHTML = "";
            var tutorID = document.getElementsByName("u_id")[0].value;
            var sessionIDLogin = document.getElementById('sessionIDLogin').value;

            $.ajax({
                url: "review-rating2.php",
                method: "POST",
                data: {tutorID: tutorID, sessionIDLogin: sessionIDLogin},
                success: function (result) {
                    $('#loadRating').html(result);
                }
            });
        } else {
            document.getElementById('fColor').style.color = "white";
            document.getElementById('afColor').style.color = "white";
            document.getElementById('loadRating').innerHTML = "";
        }
    }


    $('#ud_workplace_state').change(function () {
        var StateId = $(this).val();
        $.ajax({
            url: "ajax/ajax_call.php",
            method: "POST",
            data: {action: 'get_city', state_id: StateId},
            success: function (result) {
                $('#ud_workplace_city').html(result);
            }
        });
    });


    $(document).ready(function () {
        var conduct_online = $('input[name="conduct_online"]:checked').val();
        var student_disability = $('input[name="student_disability"]:checked').val();
        if (conduct_online == 'Yes') {
            $('#conduct_online_wrap').removeClass('hidden');
        } else {
            $('#conduct_online_wrap').addClass('hidden');
        }
        if (student_disability == 'Yes') {
            $('#student_disability_wrap').removeClass('hidden');
        } else {
            $('#student_disability_wrap').addClass('hidden');
        }

    });
    $('.udradio2').on('click', function () {
        var ele = $(this).find('input[type=radio]').attr('name');
        if (ele == 'conduct_online') {
            conduct_online();
        }
        if (ele == 'student_disability') {
            student_disability();
        }
    });

    function conduct_online() {
        var v = $('input[name=conduct_online]:checked').val();
        if (v == 'Yes') {
            $('#conduct_online_wrap').removeClass('hidden');
        } else {
            $('#conduct_online_wrap').addClass('hidden');
        }
    }

    function student_disability() {
        var v = $('input[name=student_disability]:checked').val();
        if (v == 'Yes') {
            $('#student_disability_wrap').removeClass('hidden');
        } else {
            $('#student_disability_wrap').addClass('hidden');
        }
    }
</script>


<!-- ****************** START TIMETABLE ******************-->
<script type="text/javascript">
    i = 0;
    $('#addTimeTable').click(function () {
        i++;
        if ((document.getElementById('hdnListCount').value) <= '7') {

            var aaa = document.getElementById('hdnListCount').value;
            document.getElementById('hdnListCount').value = parseInt(aaa) + 1;

            $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added">     <td class="changeDay"><select id="daySelOption" name="day[]" class="form-control name_list thishahah2" required onchange="changeDay()"><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name2" name="nameNew[]" placeholder="State your available slots e.g 10-11.30am, 5-7pm, 8-10pm" class="form-control name_list thishahah" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="' + i + '" class="fa fa-trash-o btn_remove"></a></td>       </tr>');
            i++;
        } else {
            alert('You can add 7 record only!');
        }
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();

        var bbb = document.getElementById('hdnListCount').value;
        document.getElementById('hdnListCount').value = bbb - 1;

    });
    $('#submitNew').click(function () {
        var name2 = document.getElementById("name2");
        if (name2) {
            var name2 = document.getElementById('name2').value;
            if (name2 == '') {
                alert('Empty Description');
                exit();
            } else {

                if ($('.thishahah2').filter(function () {
                    return !this.value.trim();
                }).length) {
                    alert('Empty Day');
                    exit();
                    return false;
                }
                if ($('.thishahah').filter(function () {
                    return !this.value.trim();
                }).length) {
                    alert('Empty Description');
                    exit();
                    return false;
                }
                var day = $("select[name='day[]']").map(function () {
                    return $(this).val();
                }).get();
                var nameNew = $("input[name='nameNew[]']").map(function () {
                    return $(this).val();
                }).get();
                var tutor = document.getElementById('tutor').value;

                $.ajax({
                    type: 'POST',
                    url: 'ajax-rate-timetable.php',
                    data: {day: day, nameNew: nameNew, tutor: tutor},
                    success: function (result) {
                        if (result == 'Updated') {
                            location.reload();
                        } else {
                            alert(result);
                        }
                    }
                });
            }
        } else {
            alert('Please Add Day');
            exit();
        }
    });


    $('#addMore').click(function () {
        i++;
        if ((document.getElementById('hdnListCountExist').value) <= '6') {

            var aaa = document.getElementById('hdnListCountExist').value;
            document.getElementById('hdnListCountExist').value = parseInt(aaa) + 1;

            var thistotal = document.getElementById('name3').value;
            document.getElementById('name3').value = parseInt(thistotal) + 1;

            $('#dynamic_fieldExist').append('<tr id="rowExist' + i + '" class="dynamic-addedThis">     <td><select name="dayPHP[]" class="form-control name_list hahah2" required ><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name3" name="namePHP[]" placeholder="State your available slots e.g 10-11.30am, 5-7pm, 8-10pm" class="form-control name_list hahah" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="' + i + '" class="fa fa-trash-o btn_removeExist"></a></td>       </tr>');
        } else {
            alert('You can add 7 record only!');
        }
    });
    $(document).on('click', '.btn_removeExist', function () {
        var button_id = $(this).attr("id");
        $('#rowExist' + button_id + '').remove();

        var bbb = document.getElementById('hdnListCountExist').value;
        document.getElementById('hdnListCountExist').value = parseInt(bbb) - 1;

        var thistotal = document.getElementById('name3').value;
        document.getElementById('name3').value = parseInt(thistotal) - 1;
    });
    $(document).on('click', '.btn_removePHP', function () {
        var button_id = $(this).attr("id");
        button_id = button_id.replace(/[^0-9\.]+/g, "");
        $('#thistr' + button_id + '').remove();

        var ccc = document.getElementById('hdnListCountExist').value;
        document.getElementById('hdnListCountExist').value = parseInt(ccc) - 1;

        var thistotal = document.getElementById('name3').value;
        document.getElementById('name3').value = parseInt(thistotal) - 1;

    });
    $('#submitExist').click(function () {

        var name3 = document.getElementById("name3");
        if (name3) {
            var name3 = document.getElementById('name3').value;
            if (name3 == '0') {
                alert('Please Add Day');
                exit();
            } else if (name3 == '') {
                alert('Empty Description');
                exit();
            } else {
                if ($('.hahah2').filter(function () {
                    return !this.value.trim();
                }).length) {
                    alert('Empty Day');
                    exit();
                    return false;
                }
                if ($('.hahah').filter(function () {
                    return !this.value.trim();
                }).length) {
                    alert('Empty Description');
                    exit();
                    return false;
                }

                var day = $("select[name='dayPHP[]']").map(function () {
                    return $(this).val();
                }).get();
                var nameNew = $("input[name='namePHP[]']").map(function () {
                    return $(this).val();
                }).get();
                var tutor = document.getElementById('tutorPHP').value;
                $.ajax({
                    type: 'POST',
                    url: 'ajax-rate-timetable2.php',
                    data: {day: day, nameNew: nameNew, tutor: tutor},
                    success: function (result) {
                        if (result == 'Updated') {
                            location.reload();
                        } else {
                            alert(result);
                        }
                    }
                });
            }
        } else {
            alert('Please Add Day');
            exit();
        }

    });

    function tickSubscribe(phone, func) {

        if (func == 'Not Subscribe') {
            var x = confirm("Are you sure you want this User to be unsubscribed to WA auto message?");
            if (x == true) {
                $.ajax({
                    type: 'POST',
                    url: 'tickSubscribe.php',
                    data: {
                        dataUnsubscribe: {phone: phone},
                    },
                    success: function (result) {
                        alert(result);
                        if (result == "Success..") {
                            location.reload();
                        }
                    }
                });
            }
        } else {
            var x = confirm("Are you sure you want this User to be re- subscribe to WA auto message?");
            if (x == true) {
                $.ajax({
                    type: 'POST',
                    url: 'tickSubscribe.php',
                    data: {
                        dataSubscribe: {phone: phone},
                    },
                    success: function (result) {
                        alert(result);
                        if (result == "Success..") {
                            location.reload();
                        }
                    }
                });
            }
        }

    }


    function deletePayment(id) {
        var x = confirm("Are you sure you want delete?");
        if (x == true) {
            $.ajax({
                type: 'POST',
                url: 'tickSubscribe.php',
                data: {
                    deletePayment: {id: id},
                },
                success: function (result) {
                    alert(result);
                    if (result == "Success") {
                        location.reload();
                    }
                }
            });
        }
    }

    function getLinkRForm(value, value2) {
        if (value == 'bm') {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = value2;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            $(this).tooltip('hide');
            document.getElementById("ModalRFormText").innerHTML = "BM link has been successfully copied";
            $("#ModalRForm").modal();

        } else {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = value2;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            $(this).tooltip('hide');
            document.getElementById("ModalRFormText").innerHTML = "English link has been successfully copied";
            $("#ModalRForm").modal();
        }
    }

    function getLang(value) {
        //alert(value);
        document.getElementById('valLang').innerHTML = value;
        document.getElementById("Language").value = value;
    }

    function openPopup(Id, amount, rf, hour, tutor, date, des, role, des_rf) {
        document.getElementById("ModalReceiptID").value = Id;
        document.getElementById("ModalReceiptAmount").value = amount.toFixed(2);
        /*document.getElementById("ModalReceiptRf").value = rf.toFixed(2);*/
        document.getElementById("ModalReceiptHour").value = hour;
        document.getElementById("ModalReceiptTutor").value = tutor;
        document.getElementById("ModalReceiptDate").value = date;
        document.getElementById("ModalReceiptRole").value = role;
        if (des != '') {
            document.getElementById("ModalReceiptDescription").value = des;
        } else {
            if (role == 'client') {
                document.getElementById("ModalReceiptDescription").value = 'hours of classes';
            } else {
                document.getElementById("ModalReceiptDescription").value = 'hours of tuition classes';
            }
        }

        if (role == 'client') {
            if (des_rf != '') {
                document.getElementById("ModalReceiptRfText").value = des_rf;
            } else {
                document.getElementById("ModalReceiptRfText").value = 'Registration fees';
            }
            document.getElementById("ModalReceiptRf").value = rf.toFixed(2);
        } else {
            document.getElementById("ModalReceiptRfText").value = des_rf;
            document.getElementById("ModalReceiptRf").value = rf.toFixed(2);
            $("#ModalReceiptRfLabel").addClass("hidden");
        }
        $("#myModalReceipt").modal();
    }

    function ProceedPayment() {
        var Id = document.getElementById("ModalReceiptID").value;
        var amount = document.getElementById("ModalReceiptAmount").value;


        var des_rf = document.getElementById("ModalReceiptRfText").value;
        var rf = document.getElementById("ModalReceiptRf").value;

        var hour = document.getElementById("ModalReceiptHour").value;
        var tutor = document.getElementById("ModalReceiptTutor").value;
        var date = document.getElementById("ModalReceiptDate").value;
        var des = document.getElementById("ModalReceiptDescription").value;
        var Sess = document.getElementById("ModalReceiptSess").value;
        var role = document.getElementById("ModalReceiptRole").value;

        if (Id == '') {
            alert('Error..');
        } else {
            $.ajax({
                type: 'POST',
                url: 'tickSubscribe.php',
                data: {
                    updatePayment: {Id: Id, date: date, amount: amount, rf: rf, tutor: tutor, hour: hour, des: des, Sess: Sess, role: role, des_rf: des_rf},
                },
                success: function (result) {
                    if (result == "Success") {
                        location.reload();
                    } else {
                        alert(result);
                    }
                }
            });
        }


    }

    function goReviewPage(id) {
        window.open("https://www.tutorkami.com/admin/review-rating-approved?rr=" + id);
    }
</script>
<!-- ****************** END TIMETABLE ******************-->


