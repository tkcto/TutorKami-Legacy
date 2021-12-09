<style>
/**/ #tr_name2 { display: none; } 

.centerAll {
    /*margin-left:35%;*/
    margin-left:auto;
    /*display: none;*/
}
/*
@media all and (max-device-width: 768px) { 
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }

    .centerAll {
         margin-left:auto;
    }
    
}

@media all and (max-device-width: 576px) { 
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    .centerAll {
         margin-left:auto;
    }
    
}

@media all and (max-device-width: 360px){
    .fontsize {
        font-size: 13px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    .centerAll {
         margin-left:auto;
    }
}

@media all and (max-device-width: 320px){
    .fontsize {
        font-size: 12px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    .centerAll {
         margin-left:auto;
    }
}*/

@media all and (min-device-width: 320px)  { /* smartphones, portrait iPhone, portrait 480x320 phones (Android) */ 
    .fontsize {
        font-size: 10px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    .centerAll {
         margin-left:auto;
    }
}
@media all and (min-device-width:400px)  { /* smartphones, Android phones, landscape iPhone */ 
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    .centerAll {
         margin-left:auto;
    }
}



@media all and (min-device-width:600px)  { /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */ 
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }

    .centerAll {
         margin-left:auto;
    }
}
@media all and (min-device-width:801px)  { /* tablet, landscape iPad, lo-res laptops ands desktops */ 
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }

    .centerAll {
         margin-left:auto;
    }
}
@media all and (min-device-width:1025px) { /* big landscape tablets, laptops, and desktops */ 
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }

    .centerAll {
         margin-left:auto;
    }
}
@media all and (min-device-width:1281px) { /* hi-res laptops and desktops */ 
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }

    .centerAll {
         margin-left:auto;
    }
}
</style>
<?php require_once('includes/head.php');
if (count($_POST) > 0) { 	
    $data = $_POST;	$output = system::FireCurl(TUTOR_REQUEST_URL2, "POST", "JSON", $data);	Session::SetFlushMsg($output->flag, $output->message);		
    if ($output->flag == 'success') {
        header('Location: index.php');		
        Session::SetFlushMsg($output->flag, $output->message);		exit();								
    } else {	 	
    }  
}
include('includes/header.php');?>
<section class="blog">	<div class="container">		<h1 class="blue-txt"><?php echo 'PHONE NUMBER'; //echo REQUEST_A_TUTOR_FORM; ?></h1>		<hr>		
<p>
<?php echo "Call us at the numbers below (or click What’s App icon to instant message):"; ?>

  <div class="centerAll">
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
        <a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 012-2309743 : Mon to Thu 9am-6pm 
      </div>
      
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
        <a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-6412395 : Mon, Tue & Fri 1-10pm 
      </div>
      
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
           &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; Weekends 10am-9pm
      </div>
  </div>
  
  
<br/><br/><?PHP echo '(The two numbers above will be alternated. If you cannot reach a number, please try the other one. Thank you.)';//echo "Or fill in the form below & we will get to you soon."; ?>
<br/><br/><?PHP echo "Or fill in the form below & we will get to you soon."; ?>

</p>		
<div class="request">			
    <form class="form-horizontal" method="post">				
        <div class="form-group">					
            <div class="col-sm-5">                    
                <label><span class="org-txt"><?php echo NAME; ?></span> <?php echo REQUIRED; ?>*</label>						
                <input type="text" class="form-control" id="tr_name" name="tr_name" required> 
            </div>				
            </div>				
                <!--<div class="form-group">					
                    <div class="col-sm-5">                     
                        <label><span class="org-txt"><?php //echo LOCATION; ?></span> <?php //echo REQUIRED; ?>*</label>						
                        <input type="text" class="form-control" id="tr_location" name="tr_location" required>                         
                    </div>				
                </div>	-->			
                <div class="form-group">					
                    <div class="col-sm-5">                      
                        <label><span class="org-txt"><?php echo PHONE_NUMBER; ?></span> <?php echo REQUIRED; ?>*</label>						
                        <input type="text" class="form-control" id="tr_phone_number" name="tr_phone_number" required> 
                    </div>				
                </div>				
                <!--<div class="form-group">					
                    <div class="col-sm-5">                    	 
                        <label><span class="org-txt"><?php //echo SUBJECT_LEVEL; ?></span> <?php //echo REQUIRED; ?>*</label>						
                        <input type="text" class="form-control" id="tr_subject" name="tr_subject" required> 
                    </div>				
                </div>				
                <div class="form-group">					
                    <p><span class="org-txt"><b><?php //echo ADDITIONAL_COMMENT; ?></b></span></p>					
                    <div class="col-sm-6">						
                        <textarea class="form-control" placeholder="Example : Request tutor id 1093308" name="tr_additional_comment"><?php //if(isset($_GET['tutor_id']) && $_GET['tutor_id'] != ''){ echo 'Request tutor id '.$_GET['tutor_id']; } ?></textarea>	
                    </div>				
                </div>	-->			
                <div class="form-group">					
                    <div class="col-sm-6">					
                        <button type="submit" class="btn btn-default rate-your"><?php echo BUTTON_SUBMIT; ?></button>					
                    </div>			
                </div>		
    </form>		
</div>	
</div>
</section>
<?php include('includes/footer.php');?>