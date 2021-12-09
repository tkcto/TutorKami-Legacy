<?php
// https://weichie.com/blog/curl-api-calls-with-php/

date_default_timezone_set("Asia/Kuala_Lumpur");

function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
           $data = json_encode($data,true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'key: ePc8i7mnWq98Mi6vd1NxsxmRKQ4UsVa5',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}
/*
    $args = new stdClass();
    $xdata = new stdClass();
    $args->to = "60172327809-1600591965@g.us";
    //$args->content = "*Job 8888 :* \r\nSubjek in Location. \r\nRM 35/jam\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=8888&status=open ";
    //$args->content = "*Job 8889 :* \r\nSubjek in Location. \r\nRM 35/jam\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=8889&status=open ";
    //$args->content = "*Job 8890 :* \r\nSubjek in Location. \r\nRM 35/jam\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=8890&status=open ";
    $xdata->args = $args;
    
    //$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );   
    */
    
    

$args = new stdClass();
$xdata = new stdClass();
$args->to = "60172327809@c.us";
$args->content = "11Hello testing..";
$xdata->args = $args;

$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
//$response = json_decode($make_call, true);
//$data     = $response['response'];
//echo $data . "<br>";
echo var_dump($make_call) . "<br>";

?>
