<style>
.centerAll {
    margin-left:35%;
}
/*
@media all and (max-device-width: 2500px){
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    span {
        display: none;
    }
    .centerAll {
         margin-left:auto;
    }
}

@media all and (max-device-width: 420px){
    .fontsize {
        font-size: 16px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    span {
        display: none;
    }
    .centerAll {
         margin-left:auto;
    }
}

*/



@media all and (max-device-width: 768px) { 
    .fontsize {
        font-size: 19px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    span {
        display: none;
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
    span {
        display: none;
    }
    .centerAll {
         margin-left:auto;
    }
    
}

@media all and (max-device-width: 360px){
    .fontsize {
        font-size: 16px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    span {
        display: none;
    }
    .centerAll {
         margin-left:auto;
    }
}

@media all and (max-device-width: 320px){
    .fontsize {
        font-size: 14px;
    }
    .fontsize img{
        margin-left:-20px;
        height:30px;
    }
    span {
        display: none;
    }
    .centerAll {
         margin-left:auto;
    }
}
</style>
<?php 
require_once('includes/head.php');
include('includes/header.php');
?>
<section class="blog">	
    <div class="container">		
    
<?PHP
$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
if($getLan == "/my/"){	
	$titleForm = 'HUBUNGI KAMI';
}else{
	$titleForm = 'CONTACT US';
}
?>
    <h1 class="blue-txt"><?php echo $titleForm; ?></h1>		
    <hr>		
    

<!--
  <div class="form-group text-center">
    <div class="input-group" style="margin:auto;">
        <a style="margin-left:-19px;" href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a><?PHP echo "012-2309743 : Mon to Fri 9am-6pm"; ?>
    </div>
  </div>
  <div class="form-group text-center">
    <div class="input-group" style="margin:auto;">
        <a style="margin-left:-10px;" href="http://www.wasap.my/60198771868"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a><?PHP echo "019-8771868 : Mon to Fri 12pm-9pm"; ?>
    </div>
  </div>
  <div class="form-group text-center">
    <div class="input-group" style="margin:auto;">
        <a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a><?PHP echo "019-6412395 : Mon, Tue & Fri 1-10pm"; ?>
    </div>
  </div>
  <div class="form-group text-center">
    <div class="input-group" style="margin:auto;">
        <?PHP echo "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; Sat & Sun 10am-9pm"; ?>
    </div>
  </div>
  
  <div class="form-group text-center">
    <div class="input-group" style="margin:auto;">
        <img style="margin-left:-93px;" src="https://images.vexels.com/media/users/3/135888/isolated/preview/92edb0f36291c17bf125e8a120f08b9b-email-flat-icon-by-vexels.png" height="32" size="32"><?PHP echo "&nbsp;&nbsp;&nbsp; contact@tutorkami.com"; ?>
    </div>
  </div>

  
  <div class="form-group text-center">
    <div class="input-group" style="margin:auto;">
        <img style="margin-left:5px;" src="https://www.pinclipart.com/picdir/middle/98-987668_location-clipart-gps-tracker-map-and-location-png.png" height="32" size="32"><?PHP echo "&nbsp; 27-2, Jalan Selasih U12/J, Section U12,"; ?>
    </div>
  </div>
  <div class="form-group text-center">
    <div class="input-group" style="margin:auto;">
        <?PHP echo "&nbsp; Taman Cahaya Alam, Shah Alam"; ?>
    </div>
  </div>
  <div class="form-group text-center">
    <div class="input-group" style="margin:auto;">
        <p style="margin-left:-115px;"><?PHP echo "&nbsp; 40170 Selangor"; ?></p>
    </div>
  </div>
 --> 

  <div class="centerAll">
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
        <a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 012-2309743 : Mon to Fri 9am-6pm 
      </div>
      
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
        <a href="http://www.wasap.my/60198771868"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-8771868 : Mon to Fri 12pm-9pm 
      </div>
      
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
        <a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-6412395 : Mon, Tue & Fri 1-10pm 
      </div>
      
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
           &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; Sat & Sun 10am-9pm 
      </div>

      <div class="col-sm-12 fontsize" style="margin-left:-1px;">
        <img src="https://images.vexels.com/media/users/3/135888/isolated/preview/92edb0f36291c17bf125e8a120f08b9b-email-flat-icon-by-vexels.png" height="32" size="32">&nbsp;&nbsp;&nbsp; contact{at}tutorkami.com
      </div>
      <div class="col-sm-12 fontsize" style="margin-left:-10px;">
        <img src="https://www.pinclipart.com/picdir/middle/98-987668_location-clipart-gps-tracker-map-and-location-png.png" height="32" size="32">&nbsp; 27-2, Jalan Selasih U12/J, Section U12,
      </div>
      <div class="col-sm-12 fontsize" style="margin-left:18px;">
          <span>&emsp;&nbsp;</span> Taman Cahaya Alam, Shah Alam
      </div>
      <div class="col-sm-12 fontsize" style="margin-left:18px;">
          <span>&emsp;&nbsp;</span> 40170 Selangor
      </div>
      
      <div class="col-sm-12 fontsize" style="margin-left:-10px;">
          <br/>
Any complaint or report?<br/>
Please contact our :<br/>
General Manager at 019-220 8594 or<br/>
Managing Director at 012-495 1990
        
      </div>
  </div>
    
    </div>
    </section><?php include('includes/footer.php');?>