<!DOCTYPE>
<html>
    <head>
        <title>Get Visitor's Current Location using PHP and JQuery</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <style type="text/css">
            #container{ color:  #116997; border: 2px solid #0b557b; border-radius: 5px;}
            p{ font-size: 15px; font-weight: bold;}
        </style>
    </head>
    <body>
        <script type="text/javascript">
            function getlocation() {
                if (navigator.geolocation) { 
                    if(document.getElementById('location').innerHTML == '') {
                        navigator.geolocation.getCurrentPosition(visitorLocation);
                    } 
                } else { 
                    $('#location').html('This browser does not support Geolocation Service.');
                }
            }
            function visitorLocation(position) {
                var lat = position.coords.latitude;
                var long = position.coords.longitude;
                $.ajax({
                    type:'POST',
                    url:'https://www.tutorkami.com/fadhli/test.php',
                    data:'latitude='+lat+'&longitude='+long,
                    success:function(address){
                        if(address){
                           $("#location").html(address);
                        }else{
                            $("#location").html('Not Available');
                        }
                    }
                });
            }
        </script>
        <input type="button" onclick="return getlocation()" value="Get Current Location" />
        <div id="container"><p>Your Current Location: <span id="location"></span></p></div>
    </body>
</html>





<?php
/*
$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$url = "http://freegeoip.net/json/$ip";
$ch  = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
$data = curl_exec($ch);
curl_close($ch);

if ($data) {
    $location = json_decode($data);

    $lat = $location->latitude;
    $lon = $location->longitude;

    $sun_info = date_sun_info(time(), $lat, $lon);
    print_r($sun_info);
    echo $sun_info;
}*/



function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$ipAddr = getUserIP();

$geoIP  = json_decode(file_get_contents("http://freegeoip.net/json/$ipAddr"), true);

echo 'lat: ' . $geoIP['latitude'] . '<br />';
echo 'long: ' . $geoIP['longitude']. '<br />';
echo '<br/>';











function grabIpInfo($ip)
{

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, "https://api.ipgeolocationapi.com/geolocate/" . $ip);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

  $returnData = curl_exec($curl);

  curl_close($curl);

  return $returnData;

}


$ipInfo = grabIpInfo($_SERVER["REMOTE_ADDR"]);
$ipJsonInfo = json_decode($ipInfo);

echo $ipJsonInfo->name;
echo '<br/>';


function get_ip_detail($ip){
    $ip_response = file_get_contents('http://ip-api.com/json/'.$ip);
    $ip_array=json_decode($ip_response);
    return  $ip_array;
  }
 
  $user_ip=$_SERVER['REMOTE_ADDR'];
  $ip_array= get_ip_detail($user_ip);
  echo $country_name=$ip_array->country; 
  echo $city=$ip_array->city;
  echo '<br/>';


  $ipAddress = $_SERVER['REMOTE_ADDR'];
  $resultIpAddress = json_decode(file_get_contents("http://ipinfo.io/{$ipAddress}/json"));
  $dataIpAddress = $resultIpAddress->ip." - C : ".$resultIpAddress->country." - R : ".$resultIpAddress->region." - CT : ".$resultIpAddress->city;
  echo   $dataIpAddress;
  echo '<br/>';



?>
<div id="GeoAPI"></div>
<script language="Javascript">
/*
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function(position) {
  doStuff(position.coords.latitude, position.coords.longitude);
  });
}
else {
  if (document.getElementById("GeoAPI")) {
    document.getElementById("GeoAPI").innerHTML = "I'm sorry but geolocation services are not supported by your browser";
    document.getElementById("GeoAPI").style.color = "#FF0000";
  }
}
 
function doStuff(mylat, mylong) {
  if (document.getElementById("GeoAPI")) {
    document.getElementById("GeoAPI").innerHTML = " mylat : " + mylat + " mylong : " + mylong;
  }
}*/
</script>
<br/><br/>new<br/><br/>











<?php

/* Database connection start */
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$connect = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($connect->connect_error) {
    die("connection failed : " . $connect->connect_error);
} else {
    //echo "Successfully Connected";
}

function getBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
  }

$queryTutor = " SELECT * FROM tk_user WHERE u_role='3' AND ip_address!='' ";
$resultTutor = $connect->query($queryTutor);
$rowTutor = $resultTutor->num_rows;
if($rowTutor > 0){
    while ($dataTutor = $resultTutor->fetch_assoc()) {
        //echo $dataTutor['ip_address'];
        //echo $dataTutor['u_id'].' - '.$dataIp.' <br> ';
        $dataIp =  getBetween($dataTutor['ip_address'],'- R :','- CT');

        if (strpos($dataTutor['ip_address'], '- R ') !== false) {
            //echo $dataTutor['u_id'].' - '.$dataIp.' <br> '.$dataTutor['ip_address'].' <br> <br> ';
            echo $dataIp.' <br> ';
        }else{
            //echo $dataTutor['u_id'].' - '.$dataTutor['ip_address'].' <br><br>  ';
            echo $dataTutor['ip_address'].' <br> ';
        }

            if($dataIp = "Sabah"){
                echo 'test';
            }
        
    }
}
//115.134.121.9 - C : MY - R : Selangor - CT : Kajang
?>