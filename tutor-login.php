<?php 
require_once('includes/tutor-head-login.php');
# SESSION CHECK #
if (isset($_SESSION['auth'])) {
  header('Location: tutor.php');
  exit();
}

if (count($_POST) > 0) {
   if(!empty($_POST["remember"])) {
      setcookie ("member_login",$_POST["u_email"],time()+ (10 * 365 * 24 * 60 * 60));
      setcookie ("member_password",$_POST['u_password'],time()+ (10 * 365 * 24 * 60 * 60));
   } else {
      if(isset($_COOKIE["member_login"])) {
        setcookie ("member_login","");
      }
      if(isset($_COOKIE["member_password"])) {
        setcookie ("member_password","");
      }
   }

   $output = system::FireCurl(LOGIN_URL, "POST", "JSON", $_POST);
   Session::SetFlushMsg($output->flag, $output->message);

    if ($output->flag == 'success') {

      $_SESSION['auth'] = array(
        'user_id'       => $output->data->user_id,
        'user_name'     => $output->data->user_name,
        'first_name'    => $output->data->first_name,
        'last_name'     => $output->data->last_name,
        'display_name'  => $output->data->display_name,
        'user_email'    => $output->data->user_email,
        'user_role'     => $output->data->user_role,
        'user_gender'   => $output->data->user_gender,
        'user_displayid'   => $output->data->user_displayid,
        'user_pic'      => $output->data->user_pic
      );

      if (isset($_POST['redirect']) && $_POST['redirect'] != '') {
        if ( (isset($_GET['jid']) && $_GET['jid'] != '') && (isset($_GET['status']) && $_GET['status'] != '') ){
		  $_SESSION["firstlogin"] = "1";
		  header('Location: job_details.php?jid='.$_GET['jid'].'&status='.$_GET['status']);

          exit();
        }else{
          $_SESSION["firstlogin"] = "1";
          header('Location: '.$_POST['redirect']);
          exit();
        }
      } else {
		  if ( isset($_SESSION['url']) && (isset($_SESSION['url']) != '') ) {
			$_SESSION["firstlogin"] = "1";
			header('Location: '.$_SESSION['url']);
			exit();
		  }else{
			$_SESSION["firstlogin"] = "1";
			header('Location: tutor.php');
			exit();
		  }
		  
      }

    } else {
      header('Location: tutor-login.php');
      exit();
    }
}

//include('includes/header.php');

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="apple-touch-icon" sizes="57x57" href="admin/img/favicons/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="admin/img/favicons/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="admin/img/favicons/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="admin/img/favicons/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="admin/img/favicons/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="admin/img/favicons/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="admin/img/favicons/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="admin/img/favicons/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="admin/img/favicons/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="admin/img/favicons/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="admin/img/favicons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="admin/img/favicons/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="admin/img/favicons/favicon-16x16.png">
      

	  <title><?PHP echo $seoPageTitle; ?></title>
	  <meta name="description" content="<?PHP echo $seoPageDescription; ?>" />
	  <meta name="keywords" content="<?PHP echo $seoPageKeywords; ?>" />
	  <!-- add icon link 
	  <link rel="icon" href="https://www.tutorkami.com/admin/img/favicons/apple-icon-180x180.png" type="image/x-icon"> -->

<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="<?PHP echo $seoPageTitle; ?>">
<meta itemprop="description" content="<?PHP echo $seoPageDescription; ?>">
<meta itemprop="image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://www.tutorkami.com/">
<meta property="og:type" content="website">
<meta property="og:title" content="<?PHP echo $seoPageTitle; ?>">
<meta property="og:description" content="<?PHP echo $seoPageDescription; ?>">
<meta property="og:image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?PHP echo $seoPageTitle; ?>">
<meta name="twitter:description" content="<?PHP echo $seoPageDescription; ?>">
<meta name="twitter:image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">

	  <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
	  <link rel="stylesheet" href="css/swiper.min.css">   
      
      <!-- Autocomplete -->
      <link rel="stylesheet" href="css/jquery-ui.css">
      <link rel="stylesheet" href="css/flush.css">
      <link rel="stylesheet" href="css/custom.css">
      <link rel="stylesheet" type="text/css" href="css/component.css" />
      

      <script src="js/jquery.min.js"></script> 
      <script src="js/bootstrap.min.js"></script> 
        <link rel="shortcut icon" href="https://www.tutorkami.com/favicon.ico">


   </head>
   <body>
      
      


  









<section class="sign_up_fb">
   <div class="container">
      <div class="col-md-12" align="center" >
        <a href="index.php"><img src="admin/upload/logo.png" alt="logo" class="img-responsive"></a>

      </div>
      <div class="col-md-12 mrg_top30" align="center" >
         <!-- <a href="fb_login.php"><img src="images/fb.jpg" alt="logo" class="img-responsive"></a> -->
         <h2>Tutor Sign In</h2>
      </div>
      
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 mrg_top30">

<div id="alertMsg" class="hidden alert alert-danger "> <center id="alertMsgText"> </center> </div>
<div id="alertMsgSuccess" class="hidden alert alert-success "> <center id="alertMsgTextSuccess"> </center> </div>
         <!-- <div class="row or_style mrg_top30" align="center">
            <hr>
            <h4>OR</h4>
         </div>
         <form action="" method="post" class="form-horizontal"> -->
      
      
         <div class="form-horizontal"> 
            <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : ''; ?>" />
            <div class="form-group has-feedback">   
               <input type="text" id="u_email" name="u_email" class="form-control" placeholder="Email address" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" />
               <span class="glyphicon glyphicon-envelope form-control-feedback"></span>   
            </div>
            <div class="form-group has-feedback">    
               <input type="password" id="u_password" name="u_password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" />
               <span class="glyphicon glyphicon-lock form-control-feedback"></span>   
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="checkbox">
                        <label><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> /> <?php echo REMEMBER_ME; ?></label>        
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="checkbox forget-text">
                        <a href="forgot_password.php"><?php echo FORGET_PASSWORD; ?></a>        
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">     
               <button onclick="tutorLogin()" class="btn btn-default"><?php echo BUTTON_SIGN_IN; ?></button>
            </div>
            <div class="form-group">
               <hr>
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col-sm-6 mrg_top20">
                     <p><?php echo DONT_HAVE_AN_ACCOUNT; ?></p>
                  </div>
                  <div class="col-sm-6 lower_btn">
                     <div class="checkbox forget-text">   
                        <a href="register.php" class="btn btn-default"><?php echo BUTTON_REGISTER_NOW; ?></a>   
                     </div>
                  </div>
               </div>
            </div>
         <!--</form>-->
         </div>
      </div>
   </div>
</section>
<?php //include('includes/footer.php');?>
<script>

function validEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};  

function tutorLogin() {
  //alert("Hello World");
  var email =    document.getElementById("u_email").value;
  var password = document.getElementById("u_password").value;
  if (document.getElementById('remember').checked) {
    var remember = 'On';
  } else {
    var remember = 'Off';
  }
  
  
  var alertMsg = document.getElementById( 'alertMsg' );
  var alertMsgSuccess = document.getElementById( 'alertMsgSuccess' );
  var path = location.pathname.substring(1);

  if(email == '' && password == '') {
      document.getElementById("alertMsgText").innerHTML = "Email And Password is required !";
      alertMsg.classList.remove('hidden');
      exit();
  }else if(email == '') {
      document.getElementById("alertMsgText").innerHTML = "Email is required !";
      alertMsg.classList.remove('hidden');
      exit();
  }else if ( !validEmail( email ) ) {
      document.getElementById("alertMsgText").innerHTML = "Invalid email format !";
      alertMsg.classList.remove('hidden');
      exit();
  }else if(password == '') {
      document.getElementById("alertMsgText").innerHTML = "Password is required !";
      alertMsg.classList.remove('hidden');
      exit();
  }else{

        $.ajax({
            type:'POST',
            url:'ajax-tutorLogin.php',
            data:{email: email, password: password, remember: remember},
            beforeSend: function() {
            },
            success:function(result){
                if(result =='Success'){
                    alertMsg.classList.add('hidden'); // Add class
            
                    document.getElementById("alertMsgTextSuccess").innerHTML = "Success";
                    alertMsgSuccess.classList.remove('hidden');


                    if (window.location.href.indexOf("jid") > -1) {
                      var url_string = window.location.href;
                      var url = new URL(url_string);
                      var jid = url.searchParams.get("jid");
                      var status = url.searchParams.get("status");
                      window.location = "https://www.tutorkami.com/job_details.php?jid="+jid+"&status="+status; 
                    }else{
                        var sessionURL = "<?php echo $_SESSION['url'] ?>";
                        if( sessionURL != '' ){
                            window.location = sessionURL; 
                        }else{
                            if(path == 'my/tutor-login'){
                                window.location = "https://www.tutorkami.com/my/tutor"; 
                            }else{
                                window.location = "https://www.tutorkami.com/tutor"; 
                            }                                
                        }




                    
                    }



                }else if(result =='Wrong password'){
                    document.getElementById("alertMsgText").innerHTML = "Wrong password";
                    alertMsg.classList.remove('hidden');
                    exit();
                }else if(result =='TutorKami Will Review To Activated Your Account'){
                    document.getElementById("alertMsgText").innerHTML = "TutorKami Will Review To Activated Your Account";
                    alertMsg.classList.remove('hidden');
                    exit();
                }else if(result =='Please Check Your Email To Activate'){
                    document.getElementById("alertMsgText").innerHTML = "Please Check Your Email To Activate";
                    alertMsg.classList.remove('hidden');
                    exit();
                }else if(result =='Your Account Has Been Banned !'){
                    document.getElementById("alertMsgText").innerHTML = "Your Account Has Been Banned !";
                    alertMsg.classList.remove('hidden');
                    exit();
                }else if(result =='Email doesnot exists in our record'){
                    document.getElementById("alertMsgText").innerHTML = "The email does not exist in our record";
                    alertMsg.classList.remove('hidden');
                    exit();
                }else{
                    document.getElementById("alertMsgText").innerHTML = "Login Failed !";
                    alertMsg.classList.remove('hidden');
                    exit();
                }
            }
        });
        
  }
}
</script>
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
<footer >

   <section class="addr">

      <div class="container">

         <div class="row">

            <div class="col-md-5 col-sm-6 col-md-push-1">

               <h3>Follow us on social media :</h3>

               <ul class="footer_followus">

                

                
                  <li><a href="https://www.facebook.com/TutorKamiDotCom"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                  
                  <li><a href="https://twitter.com/TutorKami"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                  
                  <li><a href="https://www.instagram.com/tutorkami/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

                  
                </ul>

               <ul class="addr_list">

                
                  <li>Office : 27-2, Jalan Selasih U12/J, <br>
Section U12, Taman Cahaya Alam,<br>
Shah Alam 40170 Selangor
                  </li>

                  <li>012-230 9743</li>

                  <li>contact@tutorkami.com</li>

                  
               </ul>

            </div>

            <div class="col-md-2 col-sm-2">

               <h3>Site Navigation</h3>

               <ul class="nl">

                 
                  <li><a href="index.php"  class="active" >Home</a></li>

                  
                  <li><a href="https://www.tutorkami.com/blog/" >Latest News</a></li>

                  
                  <li><a href="about.php" >About Us</a></li>

                  
                  <li><a href="tutor.php" >I'm a Tutor</a></li>

                  
                  <li><a href="https://www.tutorkami.com/tips_for_parent.php" >Tips for Parents</a></li>

                  
                  <li><a href="login.php" >Sign In</a></li>

                  
               </ul>

            </div>

            <div class="col-md-4 col-sm-4">

               <h3>Search this site</h3>

               <ul class="nl">

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
     /*(function() {
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
     }*/
   </script>
   <gcse:search></gcse:search>
</div>



                  
                  <li><a href="https://www.tutorkami.com/">Privacy Policy</a></li>

                  
                  <li><a href="https://www.tutorkami.com/terms_condition.php">Terms of Use</a></li>

                  
               </ul>

            </div>

         </div>

      </div>

   </section>

   <section class="copyright">

      <div class="container">

         <div class="row">

            <div class="col-md-12">



            				  
				  Copyright &copy; 2013-2020 Tutorkami. All Rights Reserved.

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
/*
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  //js.src = 'xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/
setTimeout( function () {
   (function(d,s,id){
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
          //js.src = 'xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
      }
      (document, "script", "facebook-jssdk")
   );
   
   
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
   
   
   
}, 3000);
</script>

<!-- Your customer chat code 193594130789161 
<div class="fb-customerchat" attribution=setup_tool page_id="660312020737748" theme_color="#f1592a"></div>-->

<script src="//code.tidio.co/xemvegnr9wqcfsvi5yswoogjelcyby2v.js" async></script>
</body>

</html>



