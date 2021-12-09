<?php
// https://www.twilio.com/docs/libraries/php
/*
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md

//require __DIR__ . '/autoload.php';
//require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
//require_once '/path/to/vendor/autoload.php';

//require_once '/path/to/vendor/autoload.php';

//fadhli/test/API/twilio-php-main/src/Twilio

*/

//https://www.twilio.com/console/sms/whatsapp/sandbox

require_once 'twilio-php-main/src/Twilio/autoload.php';
use Twilio\Rest\Client; 
 
$sid    = "ACa4064889163d4b608f86141e3958d242"; 
$token  = "2b386e86b67e4b47418e765f69f8d3b0"; 
$twilio = new Client($sid, $token); 
 /*
$message = $twilio->messages 
                  ->create("whatsapp:+60178847085", // to 
                           array( 
                               "from" => "whatsapp:+14155238886",       
                               "body" => "Your Yummy Cupcakes Company order of 1 dozen frosted cupcakes has shipped and should be delivered on July 10, 2019. Details: http://www.yummycupcakes.com/" 
                           ) 
                  ); 
 
print($message->sid);*/

?>
<?php
   if( $_GET["phone"] || $_GET["age"] ) {
      //echo "Welcome : ". $_GET['phone']. "<br />";
            $message = $twilio->messages 
                              ->create("whatsapp:+6".$_GET['phone'], // to 
                                       array( 
                                           "from" => "whatsapp:+14155238886",       
                                           "body" => "This is an automatic message sent from TutorKami.com as you have given us permission to auto send you tutor’s profiles. Please do not reply to this what’s app message. If you don’t want to receive this message anymore, please inform our Coordinator. Thank you.. Details: https://www.tutorkami.com/" 
                                       ) 
                              ); 
             
            print($message->sid);
      exit();
   }
?>
<html>
   <body >
<style>
body {
  font-size: 40px;
}
input[type=text] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid red;
  border-radius: 4px;
}
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<br/><br/>
<center>
<!-- Invite your friends to your Sandbox. Ask them to send a WhatsApp message to +1 415 523 8886 with code join off-deer. -->
1. <a href="https://api.whatsapp.com/send?phone=14155238886&text=join%20off-deer&source=&data=&app_absent=" target="_blank">Click Me !!</a> <br/>
2. Insert phone number here..
<br/><br/>
      <form action = "<?php $_PHP_SELF ?>" method = "GET">
         Phone: <input type = "text" name = "phone" />
         <input type="submit" class="button" value="Send">
      </form>
</center>
   </body>
</html>


<script>
/*
function Clipboard_CopyTo(value) {
  var tempInput = document.createElement("input");
  tempInput.value = value;
  document.body.appendChild(tempInput);
  tempInput.select();
  document.execCommand("copy");
  document.body.removeChild(tempInput);
}

document.querySelector('#Copy').onclick = function() {
  Clipboard_CopyTo('https://api.whatsapp.com/send?phone=14155238886&text=join%20off-deer&source=&data=&app_absent=');
}*/
</script>







<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script language="JavaScript" src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!--<script language="JavaScript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>-->

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" />

<!-- https://www.twilio.com/docs/sms/api/message-resource?code-sample=code-read-list-all-messages&code-language=PHP&code-sdk-version=6.x -->

<?php                        
    date_default_timezone_set("Asia/Kuala_Lumpur");
?>
            <div class="col-lg-12">

                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>direction</th>
                            <th>from</th>
                            <th>to</th>
                            <th>status</th>
                            <th>price</th>
                            <th>body</th>
                        </tr>
                    </thead>
                    
					<tbody>
					    
                                
                            <?PHP
                            $messages = $twilio->messages
                                               ->read([]);
                            
                            foreach ($messages as $record) {
                                //print($record->sid);
                                //echo $record->direction.' '.$record->from.' '.$record->to.'<br/>';
                                
                                echo '<tr>';
                                
                                echo '<td>'. $record->direction .'</td>';
                                echo '<td>'. $record->from .'</td>';
                                echo '<td>'. $record->to .'</td>';
                                echo '<td>'. $record->status .'</td>';
                                echo '<td>'. $record->price .'</td>';
                                echo '<td><textarea rows="3" cols="80">'. $record->body .'</textarea></td>';
                                
                                echo '</tr>';
                                
                            
                            }
                            ?>

					    

					</tbody>
                    
                    
                    

                </table>

            </div>



<script>
$('#example').dataTable( {

} );
</script>
<script async src='https://www.buildquickbots.com/gsui/js/embedScript/gs_wa_widget.js' data-appid='7fe64aee-6548-4765-8f8c-48ebd3b77e72' data-appname='TKNotification' data-source='WEB' data-env='PROD' data-lang='en_US'></script>


