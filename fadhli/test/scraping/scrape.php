<?PHP
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";
$dbCon = new mysqli($servername, $username, $password, $dbname);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}


include('simple_html_dom.php');

//https://www.proxynova.com/proxy-server-list/
//https://deviceatlas.com/blog/list-of-user-agent-strings
//https://www.freeproxylists.net/?c=&pt=8080&pr=HTTP&a%5B%5D=0&a%5B%5D=1&a%5B%5D=2&u=0

function getHTML($url,$timeout){
    /*
    $ch = curl_init($url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
    curl_setopt($ch, CURLOPT_FAILONERROR, 1); 

    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36");  

    curl_setopt($ch, CURLOPT_PROXY, "202.152.51.44");
    curl_setopt($ch, CURLOPT_PROXYPORT, "8080");
    curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1); 

    return @curl_exec($ch);
*/

/*
API Key
40590b4405b73ba521ef8811aa640b20
e3a2430b41c72e2a7758536e185c4708
*/
 //$ch = curl_init();
 //curl_setopt($ch, CURLOPT_URL, "http://httpbin.org/ip");
 $ch = curl_init($url); 
 curl_setopt($ch, CURLOPT_PROXY, "http://scraperapi:e3a2430b41c72e2a7758536e185c4708@proxy-server.scraperapi.com:8001");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 curl_setopt($ch, CURLOPT_HEADER, FALSE);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 return @curl_exec($ch);
    
    
}
/*
$html = str_get_html(getHTML("https://postcode.my/location/wilayah-persekutuan/putrajaya/",120));
$a = 1;
foreach($html->find('tr') as $tr) {
    if( $a > 1){
		echo '1: '.$tr->find('td',0)->plaintext .'<br />'; 
		echo '2: '.$tr->find('td',1)->plaintext .'<br />'; 
		echo '3: '.$tr->find('td',2)->plaintext .'<br />'; 
		echo '4: '.$tr->find('td',3)->plaintext .'<br />';  
		echo '<hr />';                 
    }
    $a++;
}
*/
//182 - 188 belum
    $Link = array();
    //$sql = " SELECT * FROM tk_lokasi WHERE l_id = '288' ";
    $sql = " SELECT * FROM tk_lokasi WHERE l_lokasi != '' AND (l_id >= '294' AND l_id <= '297') ORDER BY l_id ASC ";
    $result = $dbCon->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            //echo $row['l_post'].'<br>';
        
            $html = str_get_html(getHTML($row['l_post'],120));
            foreach($html->find('.pagination .hidden-xs') as $li) {
                    foreach($li->find('a') as $e) {
                        $Link[] = 'https://postcode.my'.$e->href;
                    }
            }

        }
    }
            
            if(!empty($Link)){
                
                /*
                echo 'Total Link : '.count($Link).'<br>';
                echo 'Total 1st : '.$Link[0].'<br>';
                unset($Link[0]);
                
                echo '<br>';
                foreach($Link as $item) {
                    echo '<pre>'; var_dump($item);
                }
                */
                $arrFirst = $Link[0]; // first array
                $totalLink = count($Link);
                for ($x = 0; $x < $totalLink; $x++) {
                  //echo "The number is: $x <br>";
                    $html2 = str_get_html(getHTML($Link[$x],120));
                    $a = 1;   
                    $data1 = '';
                    foreach($html2->find('tr') as $tr) {
                        if( $a > 1){
                    		$data1 = $tr->find('td',0)->plaintext;
                    		$data2 = $tr->find('td',1)->plaintext;
                    		$data3 = $tr->find('td',2)->plaintext;
                    		$data4 = $tr->find('td',3)->plaintext;
                    		
                    		if( $data1 != '' ){
                        		//$sqlInsert = "INSERT INTO tk_lokasi2 (l_lokasi, l_post, l_state, l_code) VALUES ('".$data1."', '".$data2."', '".$data3."', '".$data4."')";
                        		//$dbCon->query($sqlInsert);         
                        		//echo $data1.' '.$data2.' '.$data3.' '.$data4;
                    		}
                        }
                        $a++;
                        //sleep(3);
                    }
                    //unset($Link[0]); // remove first array
                }
            }
    
    
    
?>