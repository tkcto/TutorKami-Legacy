<?php
// example of how to use basic selector to retrieve HTML contents
include('../simple_html_dom.php');
 
// get DOM from URL or file
$html = file_get_html('https://postcode.my/location/johor/ayer-baloi/');

/*
$count = 1;
$newline = 1;
foreach($html->find('<td><strong>') as $e){
    echo $e->plaintext.' ';

    if( $newline == 4){
        echo '<br>';
        $newline = 1;
    }
    
$count++;
$newline++;
}
*/

/*
//https://logikapagi.wordpress.com/2020/12/15/php-simple-html-dom-parser/
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

/*
$arr = array();
foreach($html->find('.pagination .hidden-xs') as $li) {
        foreach($li->find('a') as $e) {
            //echo 'https://postcode.my'.$e->href . '<br>';
            $arr[] = 'https://postcode.my'.$e->href;
        }
}

foreach($arr as $item) {

    echo '<pre>'; var_dump($item);
}
*/
?>