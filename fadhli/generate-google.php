<?php

date_default_timezone_set("Asia/Kuala_Lumpur");


    $json_url = 'https://script.googleusercontent.com/macros/echo?user_content_key=1BBScDq1Ck5tMVEBrvhkpQ7sZeao8vechkMxPEaTQJjgx7ssnVSPxHr-YaMIoKrXJY_meYeVjMFhyUyLPf0L73wHFZbIICXTm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnGAXeH36Eb4oZ9eApsUqZO6CM-Zv4ddTYIHBH1iDq98ipRNrDQH7HmoosO5XOfgajEW-dnclfdIe&lib=M-Kh6XKUQwC9rXqFu4aesQo9LPg1umDcO';

    $json = file_get_contents($json_url);
//echo $json.'<br/>';
/*
foreach($json->user as $record){
    echo $record->id;
    echo $record->name;
}
    */

    
$data = json_decode($json, true);
$entries = $data['user'];

foreach ($entries as $entry) {
    //$date = $entry['date'];
    $date = date("d/m/Y", strtotime($entry['date']));
    $job = $entry['job'];
    $tutor = $entry['tutor'];
    $amount = $entry['amount'];
    
    //echo date('d/m/Y',strtotime($date));
    //echo date("d/m/Y", strtotime($date)).'<br/>';
    echo $date.' - '.$job.' - '.$tutor.' - '.$amount.'<br/>';
     //break;
    if($date == '28/11/2019'){
        //echo $date.' - '.$job.' - '.$tutor.' - '.$amount.'<br/>';
	
    }
    
}
   


   
?>


