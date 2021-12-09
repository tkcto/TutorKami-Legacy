<style>
#tr_name2 { display: none; } 
.centerAll {
    /*margin-left:35%;*/
    margin-left:auto;
    /*display: none;*/
}
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
        font-size: 15px;
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
if (count($_POST) > 0) { 	$data = $_POST;	$output = system::FireCurl(TUTOR_REQUEST_URL, "POST", "JSON", $data);	Session::SetFlushMsg($output->flag, $output->message);		if ($output->flag == 'success') {		header('Location: index.php');		Session::SetFlushMsg($output->flag, $output->message);		exit();								} else {	 	}  }
include('includes/header.php');?><section class="blog">	<div class="container">		<h1 class="blue-txt"><?php echo "DAPATKAN TUTOR"; ?></h1>		<hr>		
<p>
<?php echo "Hubungi kami di talian (atau tekan butang What’s App):"; ?>
<!--
<br/><?PHP echo "012-2309743 : hari biasa 9am-6pm"; ?><a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a>
<br/><?PHP echo "014-2323492 : hari biasa 12pm-9pm"; ?><a href="http://www.wasap.my/60142323492"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a>
<br/><?PHP echo "019-6412395 : hari biasa (kecuali Rabu & Khamis) 1-10pm"; ?>
<br/><?PHP echo "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;  hujung minggu 10am-9pm";?><a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a>

<br/>
<br/><a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> <?PHP echo "012-2309743 : Isnin - Khamis 9am-6pm"; ?>
<br/><a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> <?PHP echo "019-6412395 : Jumaat - Ahad 9am-6pm"; ?><br/>-->
  <div class="centerAll">
      <div id="outputInner"> </div>
<!--
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
        <a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 012-2309743 : Isnin - Khamis 9am-6pm
      </div>
      
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
        <a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-6412395 : Isnin, Selasa & Jumaat 1pm - 10pm 
      </div>
      
      <div class="col-sm-12 fontsize" style="margin-left:-10px;margin-bottom:5px;">
           &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; Sabtu & Ahad 10am -  9pm
      </div>
-->
  </div>


<br/><?PHP echo "(Kedua-dua nombor di atas akan digilirkan. Jika anda tidak dapat menghubungi satu nombor, sila cuba nombor lagi satu. Terima kasih.)";?>


<br/><br/><?PHP echo "Atau isikan borang di bawah & kami akan hubungi anda."; ?>
</p>		<div class="request">			<form class="form-horizontal" method="post">				<div class="form-group">					<div class="col-sm-5">                    <label><span class="org-txt"><?php echo "Nama"; ?></span> <?php echo REQUIRED; ?>*</label>						<input type="text" class="form-control" id="tr_name" name="tr_name" required> <input type="text" class="form-control" id="tr_name2" name="tr_name2"> </div>				</div>				<div class="form-group">					<div class="col-sm-5">                     <label><span class="org-txt"><?php echo "Lokasi"; ?></span> <?php echo REQUIRED; ?>*</label>						<input type="text" class="form-control" id="tr_location" name="tr_location" required>                         </div>				</div>				<div class="form-group">					<div class="col-sm-5">                      <label><span class="org-txt"><?php echo "No Telefon Bimbit"; ?></span> <?php echo REQUIRED; ?>*</label>						<input type="text" class="form-control" id="tr_phone_number" name="tr_phone_number" required> </div>				</div>				<div class="form-group">					<div class="col-sm-5">                    	 <label><span class="org-txt"><?php echo "Subjek &amp; Tahap ( e.g Sains Tingkatan 3)"; ?></span> <?php echo REQUIRED; ?>*</label>						<input type="text" class="form-control" id="tr_subject" name="tr_subject" required> </div>				</div>				<div class="form-group">					<p><span class="org-txt"><b>Komen Tambahan</b></span></p>					<div class="col-sm-6">						<textarea class="form-control" placeholder="Example : Request tutor id 1093308" name="tr_additional_comment"><?php 						if(isset($_GET['tutor_id']) && $_GET['tutor_id'] != ''){							echo 'Request tutor id '.$_GET['tutor_id'];						}						?></textarea>					</div>				</div>				<div class="form-group">					<div class="col-sm-6">						<button type="submit" class="btn btn-default rate-your"><?php echo "Hantar"; ?></button>					</div>				</div>			</form>		</div>	</div></section>
<?php include('includes/footer.php');?>
<script>
$( document ).ready(function() {
      if(  screen.width <= '320' ){
          document.getElementById("outputInner").innerHTML = '<div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 012-2309743 : Isnin - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Khamis 9am-6pm</div><div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-6412395 : Isnin, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Selasa & Jumaat 1pm - 10pm </div><div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sabtu & Ahad 10am -  9pm</div>';
      }else if ( screen.width <= '412' ){
          document.getElementById("outputInner").innerHTML = '<div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 012-2309743 : Isnin - Khamis &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9am-6pm</div><div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-6412395 : Isnin, Selasa & &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumaat 1pm - 10pm <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sabtu & Ahad 10am - 9pm</div>';
      }else if ( screen.width <= '480' ){
          document.getElementById("outputInner").innerHTML = '<div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 012-2309743 : Isnin - Khamis 9am-6pm</div><div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-6412395 : Isnin, Selasa & Jumaat 1pm - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10pm <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sabtu & Ahad 10am - 9pm</div>';
      }else if ( screen.width <= '600' ){
          document.getElementById("outputInner").innerHTML = '<div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 012-2309743 : Isnin - Khamis 9am-6pm</div><div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-6412395 : Isnin, Selasa & Jumaat 1pm - 10pm <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sabtu & Ahad 10am - 9pm</div>';
      }else{
          document.getElementById("outputInner").innerHTML = '<div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 012-2309743 : Isnin - Khamis 9am-6pm</div><div class="col-sm-12" style="margin-left:-10px;margin-bottom:5px;"><a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="32" size="32"></a> 019-6412395 : Isnin, Selasa & Jumaat 1pm - 10pm <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sabtu & Ahad 10am - 9pm</div>';
      }
});
</script>