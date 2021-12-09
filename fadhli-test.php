<?PHP
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
*/






?>