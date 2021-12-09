<?php
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');

/**
 * Please use below endpoint to get all whatsapp group id
 * (Dashboard) https://web.wsapme.com/
 *
 * Use this endpoint to get group list
 * https://api.wsapme.com/v1/getGroup
 */


const DEVICE_ID = 237;
const API_TOKEN = '238ce7ee762d4e14f48e4d53e546b316';
const EP_SEND_MESSAGE = 'https://api.wsapme.com/v1/sendMessage';
const EP_SERVER_STATUS = 'https://api.wsapme.com/v1/server';

$whatsapp_group_list = array(
    'kl_selangor'   => '60122309743-1543553367@g.us',
    'kl_selangor_2' => '60196412395-1614695624@g.us', 'n_sembilan' => '60172327809-1600591965@g.us',
    'testing'       => '120363024242385680@g.us'
);

# Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

# Check connection
if ($conn->connect_error) {
    echo "Connection failed : " . str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

if (!isset($_POST['data'])) {
    # Don't proceed if it is not a post request
    return;
}

$data = $_POST['data'];
$queryJob = " SELECT * FROM tk_job 
    INNER JOIN tk_job_translation on jt_j_id = j_id
    WHERE j_id = '" . $data['JobID'] . "' ";

$resultJob = $conn->query($queryJob);

if ($resultJob->num_rows < 0) {
    echo 'Error, no such job !';
    exit(1);
}

$rowJob = $resultJob->fetch_assoc();
$sqlGetJob = "SELECT jlt_lang_code, jlt_jl_id, jlt_title FROM tk_job_level_translation WHERE jlt_lang_code = 'en' AND jlt_jl_id = '" . $rowJob['j_jl_id'] . "' ";
$resultGetJob = $conn->query($sqlGetJob);

if ($resultGetJob->num_rows > 0) {
    $rowGetJob = $resultGetJob->fetch_assoc();
    $thisJobName = $rowGetJob['jlt_title'];
} else {
    $thisJobName = '';
}

$sqlCity = "SELECT city_id, city_name FROM tk_cities WHERE city_id = '" . $rowJob['city'] . "' ";
$resultCity = $conn->query($sqlCity);

if ($resultCity->num_rows > 0) {
    $rowCity = $resultCity->fetch_assoc();
    $thisCity = $rowCity['city_name'];
} else {
    $thisCity = '';
}

# Online job
if (hasWord('ONLINE', $rowJob['jt_subject'])) {

    if (!isApiAlive(EP_SERVER_STATUS, API_TOKEN)) {
        echo 'Server Offline! Please try again later..';
        exit(1);
    }

    $msg = "*Job " . $rowJob['j_id'] . " :* newLine" . ucwords($rowJob['jt_subject']) . " [Online]." . " newLine" . $rowJob['j_rate'] . "newLinePlease click link to applynewLinehttps://www.tutorkami.com/job_details?jid=" . $rowJob['j_id'] . "&status=" . $rowJob['j_status'] . "newLine newLine(This is an auto message from TutorKami.com. Please do not reply to this number) ";
    $message = str_replace('newLine', "\n", $msg);

    # kuala lumpur, selangor, n.sembilan
    $loopPhone = array(
        $whatsapp_group_list['kl_selangor'], $whatsapp_group_list['kl_selangor_2'],
        $whatsapp_group_list['n_sembilan']
    );

    $response_result = array();
    foreach ($loopPhone as $fn) {
        $args = new stdClass();
        $args->to = $fn;
        $args->content = $message;

        $make_call = wsapme('POST', EP_SEND_MESSAGE, API_TOKEN, DEVICE_ID, $args);
        $response = json_decode($make_call, true);
        $response_result[] = $response['success'];
    }

    if (isSuccess($response_result)) {
        echo 'Successful sent whatsapp message';
    } else {
        echo 'Failed sent whatsapp message';
    }

    exit(0);
}

# Offline job
# Selangor & KL & Putrajaya
if ($rowJob['j_state_id'] == '1046' || $rowJob['j_state_id'] == '1658' || $rowJob['j_state_id'] == '1661') {

    if (!isApiAlive(EP_SERVER_STATUS, API_TOKEN)) {
        echo 'Server Offline! Please try again later..';
        exit(1);
    }

    $msg = "*Job " . $rowJob['j_id'] . " :* newLine" . ucwords($rowJob['jt_subject']) . " in " . ucwords($rowJob['j_area']) . ", " . ucwords($thisCity) . ". newLine" . $rowJob['j_rate'] . "newLinePlease click link to applynewLinehttps://www.tutorkami.com/job_details?jid=" . $rowJob['j_id'] . "&status=" . $rowJob['j_status'] . "newLine newLine(This is an auto message from TutorKami.com. Please do not reply to this number) ";
    $message = str_replace('newLine', "\n", $msg);

    # kuala lumpur & selangor
    $loopPhone = array(
        $whatsapp_group_list['kl_selangor'], $whatsapp_group_list['kl_selangor_2'],
    );

    $response_result = array();
    foreach ($loopPhone as $fn) {
        $args = new stdClass();
        $args->to = $fn;
        $args->content = $message;

        $make_call = wsapme('POST', EP_SEND_MESSAGE, API_TOKEN, DEVICE_ID, $args);
        $response = json_decode($make_call, true);
        $response_result[] = $response['success'];
    }


    if (isSuccess($response_result)) {
        echo 'Successful sent whatsapp message';
    } else {
        echo 'Failed sent whatsapp message';
    }
}

# N.Sembian
if ($rowJob['j_state_id'] == '1040') {

    if (!isApiAlive(EP_SERVER_STATUS, API_TOKEN)) {
        echo 'Server Offline! Please try again later..';
        exit(1);
    }

    $msg = "*Job " . $rowJob['j_id'] . " :* newLine" . ucwords($rowJob['jt_subject']) . " in " .
        ucwords($rowJob['j_area']) . ", " . ucwords($thisCity) . ". newLine" . $rowJob['j_rate'] .
//        "newLinePlease click link to applynewLine*https://www.tutorkami.com/job_details?jid=" . $rowJob['j_id'] . "&status=" . $rowJob['j_status'] .
        "newLinePlease click link to apply newLine" .
        "www.tutorkami.com/job_details?jid=" . $rowJob['j_id'] . "&status=" . $rowJob['j_status'] .
        "newLine newLine(This is an auto message from TutorKami.com. Please do not reply to this number) ";
    $message = str_replace('newLine', "\n", $msg);

    # Negeri Sembilan
    //   CHANGE BACK LATER
    #$loopPhone = array($whatsapp_group_list['n_sembilan']);

    $loopPhone = array($whatsapp_group_list['testing']);
    $response_result = array();
    foreach ($loopPhone as $fn) {
        $args = new stdClass();
        $args->to = $fn;
        $args->content = $message;

        $make_call = wsapme('POST', EP_SEND_MESSAGE, API_TOKEN, DEVICE_ID, $args);
        $response = json_decode($make_call, true);
        $response_result[] = $response['success'];
    }

    if (isSuccess($response_result)) {
        echo 'Successful sent whatsapp message';
    } else {
        echo 'Failed sent whatsapp message';
    }

}

$conn->close();