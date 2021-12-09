<?php
function hasWord($word, $txt) {
    $patt = "/(?:^|[^a-zA-Z])" . preg_quote($word, '/') . "(?:$|[^a-zA-Z])/i";
    return preg_match($patt, $txt);
}


function isSuccess($response_result) {
    $is_success = true;
    foreach ($response_result as $res) {
        if (!$res) {
            $is_success = false;
            break;
        }
    }

    return $is_success;
}


function activeAPI($url) {
    $timeout = 10;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);


    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'key: ePc8i7mnWq98Mi6vd1NxsxmRKQ4UsVa5', 'Content-Type: application/json',
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


    $http_respond = curl_exec($ch);
    $http_respond = trim(strip_tags($http_respond));
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (($http_code == "200") || ($http_code == "302")) {
        return true;
    } else {
        // you can return $http_code here if necessary or wanted
        return false;
    }
    curl_close($ch);
}


function callAPI($method, $url, $data) {
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) $data = json_encode($data, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'key: ePc8i7mnWq98Mi6vd1NxsxmRKQ4UsVa5', 'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    // EXECUTE:
    $result = curl_exec($curl);

    if (!$result) {
        die("Connection Failure");
    }

    curl_close($curl);
    return $result;
}


function isApiAlive($url, $token) {
    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL          => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS    => 10, CURLOPT_TIMEOUT => 0, CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER   => array(
            sprintf('x-wsapme-token: %s', $token), 'Content-Type: application/json'
        )
    ));

    curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);

    return $info['http_code'] == 200;
}


function wsapme($method, $url, $token, $device, $data) {
    if (!in_array(strtolower($method), array('post', 'put', 'get'))) {
        return json_encode(array('success' => -1, 'response' => 'Unsupported request method'));
    }

    $url = sprintf("%s?%s", $url, http_build_query($data));
    $post_data = array('device' => $device, 'to' => $data->to, 'message' => $data->content);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL          => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS    => 10, CURLOPT_TIMEOUT => 0, CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS   => json_encode($post_data), CURLOPT_HTTPHEADER => array(
            sprintf('x-wsapme-token: %s', $token), 'Content-Type: application/json'
        )
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}