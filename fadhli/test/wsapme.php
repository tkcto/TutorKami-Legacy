<?php
/*
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://svr3.wsapme.com/api/listMessage',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "id_device" : "237",
    "jid" : "60172327809@c.us"
}',

  CURLOPT_HTTPHEADER => array(
    'x-wsapme-token: 238ce7ee762d4e14f48e4d53e546b316',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.wsapme.com/v1/sendMessage',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "device" : "237",
    "to": "60172327809",
    "message": "Hello World - fadhli test"
}',
  CURLOPT_HTTPHEADER => array(
    'x-wsapme-token: 238ce7ee762d4e14f48e4d53e546b316',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
*/
/*
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.wsapme.com/v1/sendMessage',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "device" : "237",
    "to": "60172327809",
    "message": "Hello World - fadhli test"
}',
  CURLOPT_HTTPHEADER => array(
    'x-wsapme-token: 238ce7ee762d4e14f48e4d53e546b316',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
*/
/*
function wsapme($method, $url, $data){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS =>'{
        "device" : "237",
        "to": "'.$data['to'].'",
        "message": "'.$data['message'].'"
      }',
      CURLOPT_HTTPHEADER => array(
        'x-wsapme-token: 238ce7ee762d4e14f48e4d53e546b316',
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// https://stackoverflow.com/questions/5568901/php-how-to-retrieve-array-values
$xdata = array( "to" => "60172327809",
        "message" => 'test dari sistem.' );
                
$response = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
//echo $response; 

$response2 = json_decode($response, true);
$data     = $response2['message'];
echo $data . "<br>";

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.wsapme.com/v1/sendMessage',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  
  CURLOPT_POSTFIELDS =>'{
        "device" : "237",
        "to": "60172327809-1600591965@g.us",
        "message": "hello world"
}',

  CURLOPT_HTTPHEADER => array(
    'x-wsapme-token: 238ce7ee762d4e14f48e4d53e546b316',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
*/
?>

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.wsapme.com/v1/server',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'x-wsapme-token: 238ce7ee762d4e14f48e4d53e546b316',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
/*$response2 = json_decode($response, true);
$data     = $response2['message'];
echo $data . "<br>";*/

