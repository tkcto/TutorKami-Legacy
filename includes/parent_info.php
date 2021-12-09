<style>
.btn-orange { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
.btn-orange:hover, 
.btn-orange:focus, 
.btn-orange:active, 
.btn-orange.active, 
.open .dropdown-toggle.btn-orange { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-orange:active, 
.btn-orange.active, 
.open .dropdown-toggle.btn-orange { 
  background-image: none; 
} 
 
.btn-orange.disabled, 
.btn-orange[disabled], 
fieldset[disabled] .btn-orange, 
.btn-orange.disabled:hover, 
.btn-orange[disabled]:hover, 
fieldset[disabled] .btn-orange:hover, 
.btn-orange.disabled:focus, 
.btn-orange[disabled]:focus, 
fieldset[disabled] .btn-orange:focus, 
.btn-orange.disabled:active, 
.btn-orange[disabled]:active, 
fieldset[disabled] .btn-orange:active, 
.btn-orange.disabled.active, 
.btn-orange[disabled].active, 
fieldset[disabled] .btn-orange.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 

.tooltip-inner {
    text-align: left;
}
</style>


<?php 
$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$_SESSION['auth']['user_id']);

?>
<div class="col-md-12 ">
   <hr>
   <h3 class="org-txt"><strong><?php echo WELCOME; ?> <?php echo ucwords($getUserDetails->data[0]->salutation.' '.$getUserDetails->data[0]->ud_first_name); ?> <?php //echo $getUserDetails->data[0]->ud_last_name; ?></strong></h3>
   <br> 
   <!--<p><strong><?php //echo ID_NO; ?> :</strong> <?php //echo $getUserDetails->data[0]->u_displayid; ?> </p>
   <p><strong><?php //echo CLIENT_NAME; //"Client name"; ?> : </strong><?php //echo $getUserDetails->data[0]->ud_first_name; ?> <?php //echo $getUserDetails->data[0]->ud_last_name; ?> </p>-->
   <p><strong><?php echo EMAIL; ?> :</strong> <?php echo $getUserDetails->data[0]->ud_last_name; //echo $getUserDetails->data[0]->u_email; ?> </p>
   <p><strong><?php echo PASSWORD; ?> :</strong>  ******** <span><a href="change_password.php" class="sky-txt"><?php echo BUTTON_EDIT; ?></a> &nbsp;<i class="fa fa-pencil" aria-hidden="true"></i> </span> </p>
   <p><strong><?php echo PHONE_NO; ?> :</strong>  <?php echo $getUserDetails->data[0]->ud_phone_number; ?> </p>
   <!--<p><strong><?php echo ADDRESS; ?> :</strong> <?php echo $getUserDetails->data[0]->ud_address; ?>  </p>-->
   <?PHP
   $conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
   if ($conn->connect_error) {
        echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
        exit();
   }
    
    //ambil address dari client profil instead on 17/5/21
    
    /*$dataEmail = $getUserDetails->data[0]->u_email;
    $queryJob = $conn->query("SELECT * FROM tk_job WHERE j_email='".$dataEmail."' ");
	$resJob = $queryJob->num_rows;
	if($resJob > 0){
		if($rowJob = $queryJob->fetch_assoc()){ 
			$userAddress = $rowJob['j_area'];
		}
	}else{
	    $userAddress = $getUserDetails->data[0]->ud_address;
	}*/
	
	$userAddress = $getUserDetails->data[0]->ud_address;
	?>
	<p><strong><?php echo ADDRESS; ?> :</strong> <?php echo $userAddress; ?>  </p>
<?PHP
$queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$getUserDetails->data[0]->ud_phone_number."' ";
$resultLogWa = $conn->query($queryLogWa);
if ($resultLogWa->num_rows > 0) {
	$rowLogWa = $resultLogWa->fetch_assoc();
	if( $rowLogWa['wa_note'] == 'Yes' ){
    	$welcomeWa = 'background-color: green;color: white;';
    	
    	//$textTab = 'You have allowed us to send you automatic message via What’s App';
    	//$textTab2 = 'You have allowed us to send you <br/>automatic message via What’s App';

    	$textTab = 'Occasionally, our system will send automatic message via What’s App for faster correspondences';
    	$textTab2 = 'Occasionally, our system will send <br/>automatic message via What’s App for faster correspondences';
    	
    	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
    	$onclick = '';
    	$btnColor = 'success';
    	$btnTooltips = '';	    
	}else{
    	$welcomeWa = 'background-color: #F1592A;color: white;';
    	$textTab = 'Unsubscribed. Just click this button again to re-subscribe';
    	$textTab2 = 'Unsubscribed. Just click this button again to re-subscribe';
    	$textInfo = '';
    	$onclick = 'onclick="myFunction2('.$getUserDetails->data[0]->ud_phone_number.')"';
    	$btnColor = 'orange';
    	$btnTooltips = '';	 
	}

}else{
    require_once('admin/classes/whatsapp-api-call.php');

    $website = "https://wa.tutorkami.my/api-docs/";
    if( !activeAPI( $website ) ) {
    	//echo $website ." is down!";
    	$welcomeWa = 'background-color: #F1592A;color: white;';
    	$textTab = 'To Subscribe, click this button & click send at What’s App';
    	$textTab2 = 'To Subscribe, click this button & click send at What’s App';
    	$textInfo = '';
    	$onclick = 'onclick="myFunction()"';
    	$btnColor = 'orange';
    	$btnTooltips = ' <a data-toggle="tooltip" data-html="true" data-placement="bottom" title="Make sure your device/mobile phone has What&#39;s App installed in it. After clicking this button, make sure you click Send/Enter the text in the What&#39;s App to confirm your subscription." ><i class="glyphicon glyphicon-question-sign" style="color:#262262;"></i></a>';
    } else {
        
        $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$getUserDetails->data[0]->ud_phone_number."' ";
        $resultLogWa2 = $conn->query($queryLogWa2);
        if ($resultLogWa2->num_rows > 0) {
            $rowLogWa2 = $resultLogWa2->fetch_assoc();
            if( $rowLogWa2['wa_note'] == 'Yes' ){
            	$welcomeWa = 'background-color: green;color: white;';
            	$textTab = 'Occasionally, our system will send automatic message via What’s App for faster correspondences';
            	$textTab2 = 'Occasionally, our system will send <br/>automatic message via What’s App for faster correspondences';
            	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
            	$onclick = '';
            	$btnColor = 'success';
            	$btnTooltips = '';
            }else{
            	$welcomeWa = 'background-color: #F1592A;color: white;';
            	$textTab = 'Unsubscribed. Just click this button again to re-subscribe';
            	$textTab2 = 'Unsubscribed. Just click this button again to re-subscribe';
            	$textInfo = '';
            	$onclick = 'onclick="myFunction2('.$getUserDetails->data[0]->ud_phone_number.')"';
            	$btnColor = 'orange';
            	$btnTooltips = '';
            }
            
        }else{
            
        		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$getUserDetails->data[0]->ud_phone_number."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
        		$exeWaNoti = $conn->query($sqlWaNoti);
        		
            	$welcomeWa = 'background-color: green;color: white;';
            	$textTab = 'Occasionally, our system will send automatic message via What’s App for faster correspondences';
            	$textTab2 = 'Occasionally, our system will send <br/>automatic message via What’s App for faster correspondences';
            	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
            	$onclick = '';
            	$btnColor = 'success';
            	$btnTooltips = '';
        	
            
        	/*
        	$args = new stdClass();
        	$xdata = new stdClass();
        	$args->contactId = "6".$getUserDetails->data[0]->ud_phone_number."@c.us";
        	$xdata->args = $args;
        	
        	$make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
        	$response = json_decode($make_call, true);
        	$dataPhone     = $response['response']['id'];
        	        
        	if( $dataPhone != '' ){
        		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$getUserDetails->data[0]->ud_phone_number."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
        		$exeWaNoti = $conn->query($sqlWaNoti);
        		
            	$welcomeWa = 'background-color: green;color: white;';
            	$textTab = 'You have allowed us to send you automatic message via What’s App';
            	$textTab2 = 'You have allowed us to send you <br/>automatic message via What’s App';
            	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
            	$onclick = '';
            	$btnColor = 'success';
            	$btnTooltips = '';
        	}else{
            	$welcomeWa = 'background-color: #F1592A;color: white;';
            	$textTab = 'To Subscribe, click this button & click send at What’s App';
            	$textTab2 = 'To Subscribe, click this button & click send at What’s App';
            	$textInfo = '';
            	$onclick = 'onclick="myFunction()"';
            	$btnColor = 'orange';
            	$btnTooltips = ' <a data-toggle="tooltip" data-html="true" data-placement="bottom" title="Make sure your device/mobile phone has What&#39;s App installed in it. After clicking this button, make sure you click Send/Enter the text in the What&#39;s App to confirm your subscription." ><i class="glyphicon glyphicon-question-sign" style="color:#262262;"></i></a>';
        
        	}       
        	*/
        }
        
        

        	
    }

}

if ($tablet_browser > 0) {
   //print 'is tablet';
   echo '<button type="button" class="btn btn-'.$btnColor.' " '.$onclick.' >'.$textTab.'</button>';
   echo $btnTooltips;
}else if ($mobile_browser > 0) {
   //print 'is mobile';
   if( $btnColor == 'success' ){
       echo '<button type="button" class="btn btn-'.$btnColor.' btn-xs" '.$onclick.' >'.$textTab2.'</button>';
       echo $btnTooltips;
   }else{
       echo '<button type="button" class="btn btn-'.$btnColor.' btn-xs" '.$onclick.' >'.$textTab.'</button>';
       echo $btnTooltips;
   }
   
}else {
   //print 'is desktop';
   echo '<button type="button" class="btn btn-'.$btnColor.' " '.$onclick.' >'.$textTab.'</button>';
   echo $btnTooltips;
}  
?>


<p style="margin-top:5px;"><?PHP echo $textInfo; ?>  </p>
	
   <div class="clearfix"></div>
   <hr>
</div>