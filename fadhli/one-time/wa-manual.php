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

    $loopPhone = array('60122309743-1543553367@g.us','60172327809-1600591965@g.us');
    foreach ($loopPhone as $fn) {
        //echo $fn.'<br>';
        $args = new stdClass();
        $xdata = new stdClass();
        $args->to = $fn;
        //$args->content = "*Job ".$insert_id." :* \r\n".ucwords($value)." in ".ucwords($data['j_area']).", ".ucwords($thisCity).". \r\n".$waRate."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
        $args->content = "*Job 8138 :* \r\n(ONLINE) Matematik SPMU in .,Johor Bahru\r\nRM 35/jam\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=8138&status=open\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
        
        $xdata->args = $args;
        
        //$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );  
    }


?>
