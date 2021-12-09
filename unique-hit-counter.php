<?php
/*    START 16/01/2020    09:00 AM    */
/*
date_default_timezone_set("Asia/Kuala_Lumpur");

$uniqueFilename = 'unique_counter.txt';
$uniqueIpfilename = 'unique_ip.txt';
$uniqueDate = date('d/m/Y H:i A');
$uniqueIpfilename2 = 'unique_ip2.txt';
function inc_count(){
	$uniqueIp = get_ip();
	global $uniqueFilename, $uniqueIpfilename, $uniqueDate, $uniqueIpfilename2;

	if(!in_array($uniqueIp, file($uniqueIpfilename, FILE_IGNORE_NEW_LINES))){
		$current_value = (file_exists($uniqueFilename)) ? file_get_contents($uniqueFilename) : 0;
		file_put_contents($uniqueIpfilename, $uniqueIp."\n", FILE_APPEND);
		file_put_contents($uniqueFilename, ++$current_value);
		file_put_contents($uniqueIpfilename2, $uniqueIp.' - '.$uniqueDate."\n", FILE_APPEND);
	}
}
function get_ip(){
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	$uniqueIpAddress = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$uniqueIpAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
	$uniqueIpAddress = $_SERVER['REMOTE_ADDR'];
}
return $uniqueIpAddress;
}


  $crawlers = array(
    'Google'=>'Google',
    'MSN' => 'msnbot',
    'Rambler'=>'Rambler',
    'Yahoo'=> 'Yahoo',
    'AbachoBOT'=> 'AbachoBOT',
    'accoona'=> 'Accoona',
    'AcoiRobot'=> 'AcoiRobot',
    'ASPSeek'=> 'ASPSeek',
    'CrocCrawler'=> 'CrocCrawler',
    'Dumbot'=> 'Dumbot',
    'FAST-WebCrawler'=> 'FAST-WebCrawler',
    'GeonaBot'=> 'GeonaBot',
    'Gigabot'=> 'Gigabot',
    'Lycos spider'=> 'Lycos',
    'MSRBOT'=> 'MSRBOT',
    'Altavista robot'=> 'Scooter',
    'AltaVista robot'=> 'Altavista',
    'ID-Search Bot'=> 'IDBot',
    'eStyle Bot'=> 'eStyle',
    'Scrubby robot'=> 'Scrubby',
    );
 
function crawlerDetect($USER_AGENT){
    $crawlers_agents = 'Google|msnbot|Rambler|Yahoo|AbachoBOT|accoona|AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby';
    if ( strpos($crawlers_agents , $USER_AGENT) === false )
       return false;
}
 
// example
 
$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);
 
if ($crawler ){
   // it is crawler, it's name in $crawler variable
}else{
   // usual visitor
   inc_count();
}
*/
date_default_timezone_set("Asia/Kuala_Lumpur");

$uniqueFilename = 'unique_counter.txt';
$uniqueIpfilename = 'unique_ip.txt';
$uniqueDate = date('d/m/Y H:i A');
$uniqueIpfilename2 = 'unique_ip2.txt';
function inc_count(){
	$uniqueIp = get_ip();
	$url = getAddress();
	global $uniqueFilename, $uniqueIpfilename, $uniqueDate, $uniqueIpfilename2;

	if(!in_array($uniqueIp, file($uniqueIpfilename, FILE_IGNORE_NEW_LINES))){
		$current_value = (file_exists($uniqueFilename)) ? file_get_contents($uniqueFilename) : 0;
		file_put_contents($uniqueIpfilename, $uniqueIp."\n", FILE_APPEND);
		file_put_contents($uniqueFilename, ++$current_value);
		file_put_contents($uniqueIpfilename2, $uniqueIp.' - '.$uniqueDate.' - '.$url."\n", FILE_APPEND);
	}
}
function get_ip(){
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	$uniqueIpAddress = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$uniqueIpAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
	$uniqueIpAddress = $_SERVER['REMOTE_ADDR'];
}
return $uniqueIpAddress;
}

function getAddress() {
    $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}


function ip_details($IPaddress) {
    $json       = file_get_contents("http://ipinfo.io/{$IPaddress}");
    $details    = json_decode($json);
    return $details;
}

$IPaddress  =  get_ip();

$details    =   ip_details("$IPaddress");


$country =  $details->country;  

if( $country == 'SG' || $country == 'MY' || $country == 'BN' ){
    inc_count();
}



?>