<style>
.gsc-control-cse
{
	padding:0px !important;
	border-width:0px !important;
}

form.gsc-search-box,table.gsc-search-box
{
	margin-bottom:0px !important;
}

.gsc-search-box .gsc-input
{
	padding:0px 4px 0px 6px !important;
}

#gsc-iw-id1
{
	border-width: 0px !important;
	height: auto !important;
	box-shadow:none !important;
}

#gs_tti50
{
	padding:0px !important;
}

#gsc-i-id1
{
	height:33px !important;
	padding:0px !important;
	background:none !important;
	text-indent:0px !important;
}

.gsib_b
{
	display:none;
}

button.gsc-search-button
{
        display:block;
        width:13px !important;
        height:13px !important;
        border-width:0px !important;
        margin:0px !important;
        padding: 10px 6px 10px 13px !important;
        outline:none;
        cursor:pointer;
        box-shadow:none !important;
        box-sizing: content-box !important;
}

.gsc-branding
{
	display:none !important;
}

.gsc-control-cse,#gsc-iw-id1
{
	background-color:transparent !important;
}


#search-box
{
	width:300px;
	height: 37px;
	margin:0 auto;
	background-color: #FFF;
	/*padding: 3px;*/
	border: 2px solid #000;
	border-radius: 4px;
}

#gsc-i-id1
{
	color:#000;
}

button.gsc-search-button
{
	padding:10px !important;
	background-color: #f1592a !important;
	border-radius: 3px !important;
}/**/
</style>
<footer <?php echo (basename($_SERVER['PHP_SELF']) == 'tutor-login.php' || basename($_SERVER['PHP_SELF']) == 'client_login.php' || basename($_SERVER['PHP_SELF']) == 'forget.php') ? 'class="hidden"' : '' ;?>>

   <section class="addr">

      <div class="container">

         <div class="row">

            <div class="col-md-5 col-sm-6 col-md-push-1">

               <h3><?php echo FOLLOW_US_ON_SOCIAL_MEDIA; ?> :</h3>

               <ul class="footer_followus">

                

                <?php // Get Social

                   $arrSocial = system::FireCurl(LIST_SOCIAL_URL);

                   

                   foreach($arrSocial->data as $social){

                     $post_id = $social->ID;

                   ?>

                  <li><a href="<?=$social->media_url?>"><i class="fa <?=$social->icon_name?>" aria-hidden="true"></i></a></li>

                  <?php } ?>

                </ul>

               <ul class="addr_list">

                <?php // Get Social

                  if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_CONTACT_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_CONTACT_URL);

                  }

                  $arrContact = system::FireCurl($lang_url);

                

                   

                   foreach($arrContact->data as $contact){

                     $post_id = $contact->ID;

                   ?>

                  <li><?=$contact->office_address?>

                  </li>

                  <li><?=$contact->phoneno?></li>

                  <li><?=$contact->emailid?></li>

                  <?php } ?>

               </ul>

            </div>

            <div class="col-md-2 col-sm-2">

               <h3><?php echo SITE_NAVIGATION; ?></h3>

               <ul class="nl">

                 <?php // Get Site Navigation

                 if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang){                 

                    $lang_url = str_replace('{lang}/', '', LIST_NAV_URL);

                  }

                  elseif($_SESSION['lang_code']=='BM'){
                    ?>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="https://www.tutorkami.com/blog/">Berita Terkini</a></li>
                    <li><a href="https://www.tutorkami.com/my/about.php">Tentang Kami</a></li>
                    <li><a href="https://www.tutorkami.com/my/tutor.php">Saya Tutor</a></li>
                    <li><a href="https://www.tutorkami.com/my/tips_for_parent.php">Tips untuk ibubapa</a></li>
                    <li><a href="https://www.tutorkami.com/tutor-login.php">Log Masuk</a></li>
                    <?php
                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_NAV_URL);

                  }

                 

                    $arrNav = system::FireCurl($lang_url);

                    $k=1;

                   foreach($arrNav->data as $nav){

                   ?>

                  <li><a href="<?=$nav->url?>" <?php if($k==1) {?> class="active" <?php } ?>><?=$nav->title?></a></li>

                  <?php $k++; } ?>

               </ul>

            </div>

            <div class="col-md-4 col-sm-4">

               <h3><?php echo SEARCH_THIS_SITE; ?></h3>

               <ul class="nl">

                  <?php // Get Site Navigation

                   $arrSearch = system::FireCurl(LIST_SEARCH_URL);

                    

                   foreach($arrSearch->data as $search){

                     //echo $search->content;

                   }

                  ?>
				<!--  
<script>
  (function() {
    var cx = '012605317305899767437:wmbhz60c7bk';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>-->
<div id="search-box">
   <script>
     (function() {
	   var cx = '012605317305899767437:wmbhz60c7bk';
	   var gcse = document.createElement("script");
	   gcse.type = "text/javascript";
	   gcse.async = true;
	   gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
	   var s = document.getElementsByTagName("script")[0];
	   s.parentNode.insertBefore(gcse, s);
     })();
     window.onload = function()
     { 
	   var searchBox =  document.getElementById("gsc-i-id1");
	   searchBox.placeholder="Google Custom Search";
	   searchBox.title="Google Custom Search"; 
     }
   </script>
   <gcse:search></gcse:search>
</div>



                  <?php // Get Site Navigation

                  if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_TERM_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_TERM_URL);

                  }

                  

                  $arrNav1 = system::FireCurl($lang_url);

                   foreach($arrNav1->data as $nav1){

                   ?>

                  <li><a href="<?=$nav1->url?>"><?=$nav1->title?></a></li>

                  <?php } ?>

               </ul>

            </div>

         </div>

      </div>

   </section>

   <section class="copyright">

      <div class="container">

         <div class="row">

            <div class="col-md-12">



            <?php // Get Site Navigation

                /* if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_COPYRIGHT_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_COPYRIGHT_URL);

                  }

                 

                   $arrCopyright = system::FireCurl($lang_url);

                 

                    

                   foreach($arrCopyright->data as $copy){

                     echo $copy->content;

                   }*/
                  ?>
				  
				  Copyright &copy; <?php $fromYear = 2013; 
										 $thisYear = (int)date('Y'); 
										echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : ''); ?> Tutorkami. All Rights Reserved.

               </div>

         </div>

      </div>

   </section>

</footer>

     

<div id="toast-container" class="toast-top-right" aria-live="polite" role="alert">

   <?php 

   if( isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != '' ) {

      $flash = Session::ReadFlushMsg();?>

   <div id="sticky-container" class="toast toast-<?php echo $flash['msg_type']; ?>" style="">

      <div id="alert_progress_bar" class="toast-progress" style="width: 100%;"></div>

      <button type="button" class="toast-close-button" role="button">×</button>

      <script>hideErrDiv('sticky-container', 'alert_progress_bar');</script>

      <div class="toast-message"><?php echo $flash['msg_text'];?></div>

   </div>

   <?php } ?>     

</div>

<!-- Load Facebook SDK for JavaScript -->
<!--<style>
.fb_customer_chat_bounce_out_v2 {
    display: none;
}
</style>--><!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v7.0'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  //js.src = 'xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>

<!-- Your customer chat code 193594130789161 
<div class="fb-customerchat" attribution=setup_tool page_id="660312020737748" theme_color="#f1592a"></div>-->

<script src="//code.tidio.co/xemvegnr9wqcfsvi5yswoogjelcyby2v.js" async></script>
</body>

</html>