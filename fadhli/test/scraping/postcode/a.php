<?php
// example of how to use basic selector to retrieve HTML contents
include('../simple_html_dom.php');
 
 
/*
location/johor/index.html
location/kedah/index.html
location/kelantan/index.html
location/melaka/index.html
location/negeri-sembilan/index.html
location/pahang/index.html
location/perak/index.html
location/perlis/index.html
location/pulau-pinang/index.html
location/sabah/index.html
location/sarawak/index.html
location/selangor/index.html
location/terengganu/index.html
location/wilayah-persekutuan/index.html
*/
 

// get DOM from URL or file
$html = file_get_html('https://www.tutorkami.com/fadhli/test/scraping/postcode/location/johor/index.html');
foreach($html->find('.media-heading a') as $e){
    //echo 'https://www.tutorkami.com/fadhli/test/scraping/postcode/location/johor/'.$e->href.'<br/>';
    $negeri [] = 'https://www.tutorkami.com/fadhli/test/scraping/postcode/location/johor/'.$e->href.'<br/>';

}
foreach($negeri as $item) {
    echo '<pre>'; var_dump($item);
}
 /*
$html = file_get_html('https://postcode.my/location/johor/ayer-baloi/');
$a=1;
foreach($html->find('tr') as $tr) {
	
    if( $a == 1){
            
    }else{
		echo '1: '.$tr->find('td',0)->plaintext .'<br />'; 
		echo '2: '.$tr->find('td',1)->plaintext .'<br />'; 
		echo '3: '.$tr->find('td',2)->plaintext .'<br />'; 
		echo '4: '.$tr->find('td',3)->plaintext .'<br />';  
		echo '<hr />';              
    }


	 $a++;
}
function getHTML($url,$timeout){
    $ch = curl_init($url); // initialize curl with given url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
    curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
//https://www.proxynova.com/proxy-server-list/
//https://deviceatlas.com/blog/list-of-user-agent-strings
    $proxy = '89.188.110.196';
    $proxyPort = '8080';
    
    //proxy suport
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);
        
    curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML,like Gecko) Chrome/27.0.1453.94 Safari/537.36");   

    return @curl_exec($ch);
}
$html=str_get_html(getHTML("https://postcode.my/location/johor/ayer-baloi/",10));
$a=1;
foreach($html->find('tr') as $tr) {
	
    if( $a == 1){
            
    }else{
		echo '1: '.$tr->find('td',0)->plaintext .'<br />'; 
		echo '2: '.$tr->find('td',1)->plaintext .'<br />'; 
		echo '3: '.$tr->find('td',2)->plaintext .'<br />'; 
		echo '4: '.$tr->find('td',3)->plaintext .'<br />';  
		echo '<hr />';              
    }


	 $a++;
}

*/
?>