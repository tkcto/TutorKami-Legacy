<?php
// example of how to use basic selector to retrieve HTML contents
include('../simple_html_dom.php');

function getHTML($url,$timeout)
{
       $ch = curl_init($url); // initialize curl with given url
       curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
       curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
       return @curl_exec($ch);
}
$html=str_get_html(getHTML("http://www.website.com",10));
// Find all images on webpage
foreach($html->find("img") as $element)
echo $element->src . '
';
// Find all links on webpage
foreach($html->find("a") as $element)
echo $element->href . '
';

/* 
// get DOM from URL or file

//all perlis
$html = file_get_html('https://postcode.my/location/perlis/');




$arr = array();
foreach($html->find('.media-heading') as $class) {
        foreach($class->find('a') as $e) {
            $arr[] = $e->href;
        }
}

foreach($arr as $item) {
     echo '<pre>'; var_dump($item);

    $html = file_get_html($item);
    $arr2 = array();
    foreach($html->find('.pagination .hidden-xs') as $li) {
            foreach($li->find('a') as $e) {
                //$arr2[] = 'https://postcode.my'.$e->href;
                $arr2[] = $e->href;
            }
    }
    
    foreach($arr2 as $item) {
        $html = file_get_html($item);
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
    }

}
*/
?>