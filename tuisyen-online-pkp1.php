<?php require_once('includes/head.php'); ?><!DOCTYPE html>
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

	  
	  <title>Tutor & Guru Tuisyen Online UPSR, PT3, SPM dan sebagainya</title>
	  <meta name="description" content="Dapatkan cikgu tuisyen online UPSR, PT3, SPM dan sebagainya seluruh Malaysia dengan lebih mudah, selamat dan ada jaminan." />
	  <meta name="keywords" content="home tutor, home tuition, home tuisyen, tuisyen rumah, homeschool, private tutor, private teacher, guru tuisyen" />
	  
<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="Search for Private Tutor, Home Tuition & Tuisyen in Malaysia">
<meta itemprop="description" content="Tutorkami is Malaysia's trusted and affordable private tutor & home tuition site">
<meta itemprop="image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://www.tutorkami.com/">
<meta property="og:type" content="website">
<meta property="og:title" content="Search for Private Tutor, Home Tuition & Tuisyen in Malaysia">
<meta property="og:description" content="Tutorkami is Malaysia's trusted and affordable private tutor & home tuition site">
<meta property="og:image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Search for Private Tutor, Home Tuition & Tuisyen in Malaysia">
<meta name="twitter:description" content="Tutorkami is Malaysia's trusted and affordable private tutor & home tuition site">
<meta name="twitter:image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">
	  
	  <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="css/swiper.min.css">   
      
      <!-- Autocomplete -->
      <link rel="stylesheet" href="css/jquery-ui.css">
      <link rel="stylesheet" href="css/flush.css">
      <link rel="stylesheet" href="css/custom.css">
      <link rel="stylesheet" type="text/css" href="css/component.css" />
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      
<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-42467282-1"></script> -->
<script async src="googletagmanager.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-42467282-1');
</script>

      
       <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
             <!-- jQuery (necessary for Bootstrap's JavaScript plugins)
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      
      <script src="js/jquery.min.js"></script> 
      <script src="js/bootstrap.min.js"></script> 
      <!-- Swiper JS -->
      <script src="js/swiper.min.js"></script>
      <!-- Initialize Swiper -->
      <script>
        var swiper = new Swiper('.swiper-container', {
          pagination: '.swiper-pagination',
          slidesPerView: 3,
          slidesPerColumn: 2,
          paginationClickable: true,
          spaceBetween: 30
        });

        $(function(){
          $("#hider").hide();
          $("#loadermodaldiv").hide();
        });

        
        function gotoPage(url) {
          // window.location = url;
          window.open(url, '_blank');
        }
      </script>
      <!-- Autocomplete -->
      <script async src="js/jquery-ui.js"></script>
	  <script async src="js/velocity.min.js"></script>
      <script src="js/enhance.js"></script>
      <script type="text/javascript">
function hideErrDiv(containerEle,progressEle){var elem=document.getElementById(progressEle);var width=100;var id=setInterval(frame,50);function frame(){if(width<=0){clearInterval(id);$("#"+containerEle).fadeOut(200)}else{width--;elem.style.width=width+'%'}}}
var counter=0;function getStickyNote(msg_type,msg_text){counter++;var html='<div id="sticky-container-'+counter+'" class="toast toast-'+msg_type+'" style="">'+'<div id="alert_progress_bar_'+counter+'" class="toast-progress" style="width: 100%;"></div>'+'<button type="button" class="toast-close-button" role="button">×</button>'+'<div class="toast-message">'+msg_text+'</div>'+'</div>';$('#toast-container').append(html);hideErrDiv('sticky-container-'+counter,'alert_progress_bar_'+counter);return html}
      </script>

      <script>
        $(document).ready(function() {

          $(".dropbox").click(function(){
            $(this).next('.dropPop').stop();
            $(this).next('.dropPop').slideToggle("slow");
          });
        
          // Method 1 - uses 'data-toggle' to initialize
          $('[data-toggle="btnToolTip"]').tooltip();    

          // options set in JS by class
          $(".tip-top").tooltip({
              placement : 'top'
          });
          $(".tip-right").tooltip({
              placement : 'right'
          });
          $(".tip-bottom").tooltip({
              placement : 'bottom'
          });
          $(".tip-left").tooltip({
              placement : 'left',
              html : true
          });

          $(".tip-auto").tooltip({
              placement : 'auto',
              html : true
          });

        });
      </script>
      <script type="text/JavaScript">
        $('.nl .search-form .input-group input[type="text"]').attr('class','search_control');
            $('.nl .search-form .input-group input[type="text"]').attr('placeholder','Search...');
            $('.nl .search-form .input-group  .input-group-addon').hide();
      </script>
      <script type="text/javascript" src="js/jquery.validate.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('#registration-form').validate({
            errorElement: 'label',
            rules: {
             'u_gender':{ required:true },
             'ud_dob[0]':{ required:true },
             'ud_dob[1]':{ required:true },
             'ud_dob[2]':{ required:true },
             'cover_area_state[]' : { required:true },
             'tutor_course[]' : { required:true },
             'ud_about_yourself' : { required:true },
             'ud_phone_number' : { required:true, digits: true }
            },
            messages: {
             'u_gender': '- Gender is required.',
             'ud_dob[0]': '- Date of birth is required.',
             'ud_dob[1]': '- Date of birth is required.',
             'ud_dob[2]': '- Date of birth is required.',
             'cover_area_state[]': '- Area you can cover is required.',
             'tutor_course[]': '- Subject you can teach is required.',
             'ud_about_yourself': '- About yourself is required.',
             'ud_phone_number' : '- Phone number is required and numeric only.'
            }
          });
        });
      </script> 
	  <style>
        .customInput
        {
            padding: 10px;
            background-color: rgba(255,255,255);
            color: #000;
        }
		.col-40 {
			float: left;
			width: 40%;
			margin-top: 6px;
		}

		.col-20 {
			float: left;
			width: 20%;
			margin-top: 6px;
		}
		
		.ro1 {
			margin-right: 1em;
			margin-left: 1em;
		}
		@media screen and (max-width: 600px) {
			.col-40, .col-20{
				width: 100%;
				margin-top: 0;
				height: 50px;
			}
		}
		@media screen and (max-width: 600px) {
			button[type=submit]{
				width: 100%;
				margin-top: 0;
				height: 40px;
				padding: 0px;
			}
		}
		
		
		
.navbar-default {
  background-color: #ffffff;
  border-color: #e7e7e7;
  .navbar-brand {
    color: #777;
  }
  .navbar-brand:hover,
  .navbar-brand:focus {
    color: #5e5e5e;
    background-color: transparent;
  }
  .navbar-text {
    color: #777;
  }
  .navbar-nav > li > a {
    color: #777;
    &:hover, &:focus {
      color: #333;
      background-color: transparent;
    }
    .active {
      & > a, & > a:hover, & > a:focus {
        color: #555;
        background-color: #e7e7e7;
      }
    }
    .disabled {
      & > a, & > a:hover, & > a:focus {
        color: #ccc;
        background-color: transparent;
      }
    }
    .open {
      & > a, &  > a:hover, & > a:focus {
        color: #555;
        background-color: #e7e7e7;
      }
      @media (max-width: 767px) {
        .dropdown-menu {
          & > li > a {
            color: #777;
            &:hover, &:active {
              color: #333;
              background-color: transparent;
            }
          }
          .active {
            & > a, & > a:hover, & a:focus {
              color: #555;
              background-color: #e7e7e7;
            }
          }
          .disabled {
            & > a, & > a:hover, & a:focus {
              color: #ccc;
              background-color: transparent;
            }
          }
        }
      }
    }
    .navbar-toggle {
      border-color: #ddd;
      &:hover, &:focus {
        background-color: #ddd;
      }
      .icon-bar {
        background-color: #888;
      }
    }
    .navbar-collapse, .navbar-form {
      border-color: #e7e7e7;
    }
  }
  .navbar-link {
    color: #777;
    &:hover {
      color: #333;
    }
  }
  .btn-link {
      color: #777;
    &:hover, &:focus {
      color: #333;
    }
  }
}

.btn-info {
  color: #fff;
  background-color: #4CAF50;
  border-color: #4CAF50;
  border-radius: 4px;
}
.btn-info.focus,
.btn-info:focus {
  color: #fff;
  background-color: #4CAF50;
  border-color: #4CAF50;
  outline: none;
  box-shadow: none;
}
.btn-info:hover {
  color: #fff;
  background-color: #4CAF50;
  border-color: #4CAF50;
  outline: none;
  box-shadow: none;
}
.btn-info.active,
.btn-info:active {
  color: #fff;
  background-color: #4CAF50;
  border-color: #4CAF50;
  outline: none;
}
.btn-info.active.focus,
.btn-info.active:focus,
.btn-info.active:hover,
.btn-info:active.focus,
.btn-info:active:focus,
.btn-info:active:hover {
  color: #fff;
  background-color: #4CAF50;
  border-color: #4CAF50;
  outline: none;
  box-shadow: none;
}
/*
#fb-root > div.fb_dialog.fb_dialog_advanced.fb_shrink_active {
    background-color: #4CAF50;
  }
  .fb-customerchat.fb_invisible_flow.fb_iframe_widget iframe {
    background-color: #4CAF50;
  }*/

/*
.nav > li{
position: static !important;
}
.dropdown-menu {
left: 0 !important;
right: 0 !important;
margin-left:10px;
}
.dropdown-menu > li{
float: left !important;
} 
.dropdown-menu > li > a{
width:auto !important;
}*/
      </style>
<style>
/*
@media only screen and (max-width: 320px) {
  .screensize {
      margin-left:-170px;
      margin-top:0px;
      font-size:11px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
      margin-left:180px;
  }
}

@media only screen and (max-width: 360px) {
  .screensize {
      margin-left:-185px;
      margin-top:0px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
      margin-left:215px;
  }
}




@media only screen and (max-width: 600px) {
  .screensize {
      margin-right:10px;
      margin-top:25px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
      margin-left:215px;
  }
}


@media only screen and (max-width: 970px) {
  .screensize {
      margin-right:10px;
      margin-top:25px;
  }
  .screensizelg {
      display: none;
  }
  .sizedcreenli{
      
  }
}
@media only screen and (min-width: 992px) {
  .screensize {
      display: none;
  }
  .sizedcreenli{
      
  }
}
@media only screen and (min-width: 1200px) {
  .screensize {
    display: none;
  }
  .sizedcreenli{
      
  }
}*/

@media (min-width:250px) and (max-width: 320px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:11px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:160px;
  }
}

@media (min-width:321px) and (max-width: 360px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:12px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:200px;
  }
}

@media (min-width:361px) and (max-width: 370px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:12px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:210px;
  }
}

@media (min-width:371px) and (max-width: 380px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:12px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:220px;
  }
}

@media (min-width:381px) and (max-width: 400px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:14px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:200px;
  }
}

@media (min-width:401px) and (max-width: 480px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:14px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:220px;
  }
}

@media (min-width:481px) and (max-width: 768px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:14px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:220px;
  }
}

@media (min-width:769px) and (max-width: 992px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:14px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:220px;
  }
}

@media (min-width:993px) and (max-width: 1200px) {
  .screensize {
      display: none;
  }

}

@media (min-width:1201px) {
  .screensize {
      display: none;
  }

}
.shadow {
  /*box-shadow: 0px 15px 10px -15px #111;*/
  box-shadow: 0px 15px 10px -15px #111;

}

</style>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
    <script src="https://getbootstrap.com/docs/3.3/assets/js/ie-emulation-modes-warning.js"></script>-->
	
	<!-- START owl.carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
	<!-- END owl.carousel -->
   </head>
   <body>
   <!--<body style="background-image: url('folder-tuisyen-online/Wallpaper.png');">-->
      <div class="loaderBackground" id="hider"></div>
      <div class="loaderpop" id="loadermodaldiv">
         <h4><img src="images/loader.gif" style="width: 50px;" />Loading...</h4>
      </div>

    <nav class="navbar navbar-default navbar-fixed-top <?php echo (basename($_SERVER['PHP_SELF']) == 'tutor-login.php' || basename($_SERVER['PHP_SELF']) == 'parent_login.php' || basename($_SERVER['PHP_SELF']) == 'forget.php') ? 'hidden' : '' ;?>">
      <div class="container">
        <div class="col-md-3">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/logo.png" class="pull-left img-responsive" alt="tutorkami logo"/></a>
          <a href="request_a_tutor.php" style="" type="button" class="pull-right btn btn-info navbar-sm screensize">GET A TUTOR</a>
        </div>
        </div>
<!--
    <div class="hidden-md hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:40px;margin-right:0px;" type="button" class="btn btn-info navbar-sm">GET A TUTOR</a>
  	</div>
    <div class="hidden-lg hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:40px;margin-right:0px;" type="button" class="btn btn-info navbar-sm">GET A TUTOR</a>
  	</div>
<div class="col-md-3">
<?php
if($_SERVER['PHP_SELF'] == "/search_tutor.php" || $_SERVER['PHP_SELF'] == "/request_a_tutor.php"){
?>
	<div class="hidden-lg hidden-md hidden-xs pull-right">
      <a href="request_a_tutor.php" style="margin-top:-60px;margin-right:85px;" type="button" class="btn btn-info navbar-sm">GET A TUTOR</a>
  	</div>
    <div class="hidden-lg hidden-md hidden-sm pull-right">
      <a href="request_a_tutor.php" style="margin-top:-40px;margin-right:40px;" type="button" class="btn btn-info navbar-xs">GET A TUTOR</a>
  	</div>
<?php
}else{
?>
	<div class="hidden-lg hidden-md hidden-xs pull-right">
      <a href="request_a_tutor.php" style="margin-top:-110px;margin-right:85px;" type="button" class="btn btn-info navbar-sm">GET A TUTOR</a>
  	</div>
    <div class="hidden-lg hidden-md hidden-sm pull-right">
      <a href="request_a_tutor.php" style="margin-top:-80px;margin-right:40px;" type="button" class="btn btn-info navbar-xs">GET A TUTOR</a>
  	</div>
<?php
}
?>

</div>-->

        <div id="navbar" class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right off_dropd">

                       <?php if(!isset($_SESSION['auth'])) { ?>
						<li class="dropdown text-right">
							<a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button">Home <span class="caret"></span></a>
							<ul class="dropdown-menu text-right" role="menu">
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/index">Home Page</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/about">About Us</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/contact-us">Contact Us</a></li>
							</ul>
						</li>
                        <li class="dropdown text-right">
							<a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button">Parents <span class="caret"></span></a>
							<ul class="dropdown-menu text-right" role="menu">
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/search_tutor">Search Tutor</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/parent_faq">FAQs</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/request_a_tutor?tutor_id=i3be8gz">Contact Us</a></li>
							</ul>
                        </li>
                        <li class="dropdown text-right">
							<a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button">I'm a Tutor<span class="caret"></span></a>
							<ul class="dropdown-menu text-right" role="menu">
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/tutor.php">Tutor’s Page</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/search_job.php">Latest Jobs</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/register.php">Register</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/tutor_faq.php">FAQs</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/tutor-login.php">Log In</a></li>
							</ul>
                        </li>
						
                       <?php } else { 
					   if($_SESSION['auth']['user_role'] == '4') { ?>
                        <li class="dropdown text-right" id="shadow">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle text-right" href="#">
                           Welcome <?php echo ucfirst($_SESSION['auth']['first_name']); ?> <?php //echo ucfirst($_SESSION['auth']['last_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu text-right" role="menu">
                              <li class="sizedcreenli"><a href="clients_profile.php" class="language">My Profile</a></li>
                              <li class="sizedcreenli"><a href="my-classes.php" class="language">My Classes</a></li>
                              <!--<li class="sizedcreenli"><a href="payment_history.php" class="language">Payment History</a></li>-->
                              <li class="sizedcreenli"><a href="parent_guide.php" class="language">Parent's Guide</a></li>
							  <li class="sizedcreenli"><a href="clients-terms.php" class="language">Terms</a></li>
							  <li class="sizedcreenli"><a href="logout.php" class="language">Logout</a></li>
							  <div class="category"><div class="alternate"><br><br></div></div>
							  
                           </ul>
                        </li>
                        <?php } else { ?>
                        <li class="dropdown text-right" id="shadow">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle text-right" href="#">
                           Welcome <?php echo ucfirst($_SESSION['auth']['display_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu text-right" role="menu">
                              <li class="sizedcreenli"><a href="edit_account.php" class="language">Edit Account</a></li>
                              <li class="sizedcreenli"><a href="change_password.php" class="language">Change Password</a></li>
                              <li class="sizedcreenli"><a href="view_profile.php" class="language">View Profile</a></li>
                              <li class="sizedcreenli"><a href="my-classes.php" class="language">My Classes</a></li>
                              <!--<li class="sizedcreenli"><a href="tutor_payment_history.php" class="language">Payment History</a></li>-->
                              <li class="sizedcreenli"><a href="search_job.php" class="language">Latest Job</a></li>
                              <li class="sizedcreenli"><a href="tutor_guide.php" class="language">Tutor's Guide</a></li>
							  
							  <li class="sizedcreenli"><a href="tutors-terms.php" class="language">Terms</a></li>
							  
                              <li class="sizedcreenli"><a href="logout.php" class="language">Logout</a></li>
                           </ul>
                        </li>
                        <?php } ?>
                     <?php } ?>
					 
			<a href="request_a_tutor.php" style="margin-top:10px" type="button" class="btn btn-info navbar-sm screensizelg">GET A TUTOR</a>
          </ul>
        </div>

		
      </div>
    </nav>
<script>
$(document).ready(function() {
    
var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true; 
    <?PHP 
    if (isset($_SESSION['auth'])) {
        ?>
        $(".navbar-toggle").click();
        $(".dropdown-toggle").click();
        $("#shadow").addClass("shadow");
        <?php
    }
    ?>
}else{
    $('div.category .alternate br').remove();
<?PHP 
if (isset($_SESSION['auth'])) {
if(!isset($_SESSION['getPage'])){
?>
  $(".dropdown-toggle").click();
<?PHP
}
}
?>
}
window.onscroll = function (e) {  
    //$(".navbar-toggle").collapse('hide');
    $(".navbar-collapse").collapse('hide');
    $('.dropdown').removeClass('open');
} 
});
$(document).on('click', function (e){
    /* bootstrap collapse js adds "in" class to your collapsible element*/
    var menu_opened = $('#navbar').hasClass('in');
  
    if(!$(e.target).closest('#navbar').length &&
        !$(e.target).is('#navbar') &&
        menu_opened === true){
            $('#navbar').collapse('toggle');
    }

});
</script>    

	<link href='css-pricing/rotating-card/rotating-card.css' rel='stylesheet' />
	<link rel="stylesheet" type="text/css" href="css-pricing/adaptor/css/custom.css" />
<style>
.transparent {
    background-color: transparent !important;
    box-shadow: inset 0px 1px 0 rgba(0,0,0,.075);
 }
 .left-border-none {
    border-left:none !important;
    box-shadow: inset 0px 1px 0 rgba(0,0,0,.075);
 }
 .border-radius {
    border-radius: 4px;
 }
 
  .carousel-control.left, .carousel-control.right {
   background-image:none !important;
   filter:none !important;
   opacity:1 !important;color:#f1592a;
}


/*==========  Mobile First Method  ==========*/

/* Custom, iPhone Retina */ 
@media screen and (min-width : 320px) {

}

/* Extra Small Devices, Phones */ 
@media screen and (min-width : 480px) {

}

/* Small Devices, Tablets */
@media screen and (min-width : 768px) {

}

/* Medium Devices, Desktops */
@media screen and (min-width : 992px) {
	
}

/* Large Devices, Wide Screens */
@media screen and (min-width : 1200px) {
	
}



/*==========  Non-Mobile First Method  ==========*/

/* Large Devices, Wide Screens */
@media screen and (max-width : 1200px) {

}

/* Medium Devices, Desktops */
@media screen and (max-width : 992px) {

}

/* Small Devices, Tablets */
@media screen and (max-width : 768px) {

}

/* Extra Small Devices, Phones */ 
@media screen and (max-width : 480px) {

}

/* Custom, iPhone Retina */ 
@media screen and (max-width : 320px) {
  h4.media_example {
    font-size: 11px;
  }
  p.media_example {
    font-size: 11px;
  }	
  
}

.thisfont {
    font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
    font-size: 15px;
}

.alert-message
{
    margin: 5px 0;
    padding: 5px;
    border-left: 3px solid #eee;
}
.alert-message h4
{
    margin-top: 0;
    margin-bottom: 5px;
}
.alert-message p:last-child
{
    margin-bottom: 0;
}
.alert-message code
{
    background-color: #fff;
    border-radius: 3px;
}
.alert-message-success
{
    background-color: #F4FDF0;
    border-color: #3C763D;
}
.alert-message-success h4
{
    color: #3C763D;
}
.alert-message-danger
{
    background-color: #fdf7f7;
    border-color: #d9534f;
}
.alert-message-danger h4
{
    color: #d9534f;
}
.alert-message-warning
{
    background-color: #fcf8f2;
    border-color: #f0ad4e;
}
.alert-message-warning h4
{
    color: #f0ad4e;
}
.alert-message-info
{
    background-color: #f4f8fa;
    border-color: #5bc0de;
}
.alert-message-info h4
{
    color: #5bc0de;
}
.alert-message-default
{
    background-color: #EEE;
    border-color: #B4B4B4;
}
.alert-message-default h4
{
    color: #000;
}
.alert-message-notice
{
    background-color: #FCFCDD;
    border-color: #BDBD89;
}
.alert-message-notice h4
{
    color: #444;
}

.circular-square {
  width:150px;
  height:150px;
  border-radius: 50%;
}
</style>
<section class="banner">

   <article class="banner_text">

      <div class="container">

         <div class="row">

            <div style="width:100%">



               <div class="form_div" style="width: 100%">

               </div>

            </div>

         </div>

      </div>

   </article> 

   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">

      <!-- Indicators -->

      <ol class="carousel-indicators">

        <li data-target="#carousel-example-generic" data-slide-to="0"  class="active" ></li>

      </ol> 

      <!-- Wrapper for slides -->

      <div class="carousel-inner" role="listbox">

         <div class="item  active ">
			<?php if(stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")){ // if mobile browser ?>
				<img src="folder-tuisyen-online/pkp_header-min.png">
			<?php }else { // desktop browser ?>
				<img src="folder-tuisyen-online/pkp_header-min.png" style="padding-top: 80px;">
			<?php } ?>

            <div class="carousel-caption"></div>
         </div>

      </div>


   </div>

</section>


<!-- style="background-image: url('folder-tuisyen-online/Wallpaper.png');opacity:1;" -->
<style>
  /*.supersizer {
    background: url("folder-tuisyen-online/Wallpaper.png");
    opacity: 0.5;
    z-index: -1;
    width: 100%;
    height: 100%;
    position: fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    top: 0;
  }*/
.gray_bg2{
     background:url(../folder-tuisyen-online/download.png);
}
</style>
<section class="how_works gray_bg2">
   <div class="container">
      <div class="row">
	  
        <!--<div class="col-xs-12 text-center hw_box">
			<img alt="" class="img-responsive center-block" src="folder-tuisyen-online/kelebihan-tuisyen-online.PNG"  />
        </div>
		
        <div class="col-xs-12 text-center hw_box">
			<img alt="" class="img-responsive center-block" src="folder-tuisyen-online/kualiti.PNG"  />

			<img alt="" class="img-responsive center-block" src="folder-tuisyen-online/selamat.PNG"  />

			<img alt="" class="img-responsive center-block" src="folder-tuisyen-online/berpengalaman.PNG"  />
        </div>
		
        <div class="col-xs-12 text-center hw_box">
			<img alt="" class="img-responsive center-block" src="folder-tuisyen-online/online-1-to-1.PNG"  />
        </div>-->

        <div class="col-xs-12 text-center hw_box">
			<img alt="" class="img-responsive center-block" src="folder-tuisyen-online/ps2pdf.com-min.png"  />
			
        <br/><br/>
            <ul class="tutor_list">

              <?php 

                 // Get Slider

                 $arrTutor = system::FireCurl(LIST_TUTOR2);

                 $i = 0;

                 foreach($arrTutor->data as $tutor){

                   $arrState = system::FireCurl(LIST_STATE_URL.'?state_id='.$tutor->ud_state);

                 foreach($arrState->data as $state){

                     $statename = $state->st_name;

                   }

                   $pix = sprintf("%'.07d\n", $tutor->u_profile_pic);

                 ?>  



         <div class="col-md-3 col-sm-6">
             <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="css-pricing/rotating-card/bg-card.jpg"/>
                        </div>
                        <div class="user">
                            <img class="circular-square" src="<?php 
							if($tutor->u_profile_pic!='') { 
								//echo APP_ROOT."images/profile/".$pix."_0.jpg"; 
								if ( is_numeric($tutor->u_profile_pic) ) {
									echo APP_ROOT."images/profile/".$pix."_0.jpg"; 
								}else{
									$pic = $tutor->u_profile_pic;
									echo APP_ROOT."images/profile/".$pic.".jpg";
								}
							} else { 
								if($tutor->u_gender=='M') echo 'images/tutor_ma.png'; else echo 'images/tutor_mi1.png'; 
							}
							?>"/>
						</div>
                        <div class="content">
                            <div class="main">
                                <h3 class="name"><strong> <?=$tutor->u_displayname?> </strong></h3>
<?php
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
        $dataCity = $tutor->ud_city;
        $queryCity = "SELECT * FROM tk_cities WHERE city_id = '".$dataCity."' "; 
        $resultCity = $conn->query($queryCity); 
        if($resultCity->num_rows > 0){ 
            $rowCity = $resultCity->fetch_assoc();
            $nameCity = $rowCity['city_name'];  
        }else{
            $nameCity =  $tutor->ud_city;
        }
?>
                                <p class="profession"><? echo $nameCity;//=$tutor->ud_city ?></p>
                                <p class="alert-message alert-message-info text-center"><strong>
<?php
$langStringQua = strip_tags($tutor->ud_qualification);
if (strlen($langStringQua) > 67) {

    // truncate string
    $langStringCutQua = substr($langStringQua, 0, 67);
    $langStringEndPointQua = strrpos($langStringCutQua, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
    $langStringQua = $langStringEndPointQua? substr($langStringCutQua, 0, $langStringEndPointQua) : substr($langStringCutQua, 0);
	$langStringQua .= ' ...';
	echo '<br/>'.$langStringQua; 	
}else{
	echo '<br/>'.$langStringQua; 
}

?>
								</strong></p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto"><a href="tutor_profile.php?did=<?php echo $tutor->u_displayid; ?>" target="_blank" class="btn btn-info">View <?=$tutor->u_displayname?></a></h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center"><strong>About Me </strong></h4>
                                <p class="alert-message alert-message-info text-center thisfont">
<?php
$langString = strip_tags($tutor->ud_about_yourself);
if (strlen($langString) > 300) {

    $langStringCut = substr($langString, 0, 300);
    $langStringEndPoint = strrpos($langStringCut, ' ');

    $langString = $langStringEndPoint? substr($langStringCut, 0, $langStringEndPoint) : substr($langStringCut, 0);
	$langString .= ' ...';
	echo '<br/>'.$langString; 	
}else{
	echo '<br/>'.$langString; 
}

?>
								
								
								</p>


                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
        </div>







               <?php } ?>

             </ul>
            <!--<div class="clearfix"></div>
            <p class="m_top_30"><a href="search_tutor.php" class="orange_btn">VIEW MORE TUTORS</a></p>-->
			
        </div>




        <div class="col-xs-12 text-center hw_box">
			<img alt="" class="img-responsive center-block" src="folder-tuisyen-online/jaminan.PNG"  />
        </div>
		
		
		
		
		
      </div>
   </div>
</section>








<section class="how_works gray_bg2">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
			<h1 class="header">CLIENT’S TESTIMONIAL</h1>

            <div class="owl-carousel owl-theme" id="load-testimonial">

              <div class="item">
                <figure>
                  <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent1.jpeg" style="width: 270px; height: 480px;" class="img-responsive center-block" alt=""/>
                </figure>
              </div>

              <div class="item">
                <figure>
                  <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent2.jpeg" style="width: 270px; height: 480px;" class="img-responsive center-block" alt=""/>
                </figure>
              </div>

              <div class="item">
                <figure>
                  <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent3.jpeg" style="width: 270px; height: 480px;" class="img-responsive center-block" alt=""/>
                </figure>
              </div>

              <div class="item">
                <figure>
                  <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent4.jpeg" style="width: 270px; height: 480px;" class="img-responsive center-block" alt=""/>
                </figure>
              </div>
  
            </div>

         </div>
      </div>
   </div>
</section>

<section class="join">

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <h1> Ada sebarang pertanyaan?</h1>

<h2>Telefon kami atau klik ikon untuk What's App</h2>
<h3> <a href="http://www.wasap.my/60187882464"><img src="https://www.tutorkami.com/images/whatsapp-logo-transparent.png" height="32" size="32"></a> 018-788 2464</h3>

<!--
<p>012-230 9743 Mon to Fri 9am-6pm <a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo-transparent.png" height="32" size="32"></a></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp; 019-877 1868 Mon to Fri 12pm-9pm <a href="http://www.wasap.my/60198771868"><img src="https://www.tutorkami.com/images/whatsapp-logo-transparent.png" height="32" size="32"></a></p>
<p style="margin-left:-30px;">019-641 2395 Mon, Tue, & Fri 1-10pm</p>
<p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sat & Sun 10am-9pm <a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo-transparent.png" height="32" size="32"></a></p>
<br>
<p>Or click the button below to fill a form</p>-->
<!--<p class="m_top_30"><a class="orange_btn" href="https://www.tutorkami.com/request_a_tutor">Request a Tutor</a></p>-->
         </div>

      </div>

   </div>

</section>

<section class="how_works gray_bg">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <h1 class="header">Supported By</h1>
         </div>
      </div>
	  <br/><br/>
      <div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://erezeki.my/partners" target="_blank"><img alt="mdec logo" class="img-responsive center-block" src="images/mdec-logo.png" style="width:80%" /></a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://erezeki.my/partners" target="_blank"><img alt="erezeki logo" class="img-responsive center-block" src="images/eRezeki-logo.png" style="width:80%" /></a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://www.cradle.com.my/" target="_blank"><img alt="cradle logo" class="img-responsive center-block" src="images/cradle-logo.png" style="width:80%" /></a>
			</div>
      </div>
   </div>
</section>



<section class="qe">

   <div class="container">

      <div class="row">

         <div class="col-md-12" style="position:relative;">

            <h1><span>question</span> or enquiries</h1>

<h3>Just say hi. Email us at : contact@tutorkami.com</h3>


         </div>

      </div>

   </div>

</section>

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
<footer <?php echo (basename($_SERVER['PHP_SELF']) == 'tutor-login.php' || basename($_SERVER['PHP_SELF']) == 'parent_login.php' || basename($_SERVER['PHP_SELF']) == 'forget.php') ? 'class="hidden"' : '' ;?>>

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

                  
                  <li><a href="tutor-login.php" >Sign In</a></li>

                  
               </ul>

            </div>

            <div class="col-md-4 col-sm-4">

               <h3>Search this site</h3>

               <ul class="nl">

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



            				  
				  Copyright &copy; 2013-2019 Tutorkami. All Rights Reserved.

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
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v3.2'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  //js.src = 'https://www.tutorkami.com/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code 193594130789161 
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="193594130789161"
  greeting_dialog_display="hide"
  theme_color="#f1592a">
</div>-->
<script src="//code.tidio.co/xemvegnr9wqcfsvi5yswoogjelcyby2v.js" async></script>


<script>
$(document).ready(function() {
	
	$('.owl-carousel').owlCarousel({
		loop: true,
		margin: 10,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 3,
				nav: false
			},
			1000: {
				items: 4,
				nav: true,
				loop: false,
				margin: 20
			}
		}
	})
})
</script>
</body>

</html>
<script>

   $(function() {

      function log( message ) {

         $( "<div>" ).text( message ).prependTo( "#log" );

         $( "#log" ).scrollTop( 0 );

      }

      $(document).ready(function(){

        $('.carousel').carousel({

          interval: 3000

        });


      });    

   

   });
		
	<?php
		$connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
		$sqlS = "SELECT ts.ts_id, tc.tc_title, ts.ts_title FROM tk_tution_subject ts
				LEFT JOIN tk_tution_course tc ON tc.tc_id = ts.ts_tc_id AND tc.tc_status = 'A'
				WHERE ts.ts_status = 'A'";
		$sqlL = "SELECT tc.city_id, tc.city_name, st.st_name
				FROM tk_cities tc
				LEFT JOIN tk_states st
				ON st.st_id = tc.city_st_id
				WHERE tc.city_status = '1'";
				
		$subjectid = array();
		$locationid = array();
	?>
   var subjects = 	[
						<?php
							$res = mysqli_query($connect, $sqlS);
							$i = 0;
							while($row = mysqli_fetch_array($res))
							{
								array_push($subjectid, $row['ts_id']);
								
								if($i != 0)
								{
									echo ",";
								}
								
								echo "'".$row['ts_title']." ".$row['tc_title']."'";
								$i++;
							}
						?>
					];
	var subjects_id = ['<?php echo join("', '", $subjectid); ?>'];
	
	var locations = 	[
						<?php
							$res = mysqli_query($connect, $sqlL);
							$i = 0;
							while($row = mysqli_fetch_array($res))
							{
								array_push($locationid, $row['city_id']);
								
								if($i != 0)
								{
									echo ",";
								}
								
								echo "'".$row['city_name'].", ".$row['st_name']."'";
								$i++;
							}
						?>
					];
	var locations_id = ['<?php echo join("', '", $locationid); ?>'];
	
	function autocomplete(inp, type) {
		var arr = [];
		var arrId = [];
		var hiddenInput;
		var hiddenInput2;
		
		if(type == "s")
		{
			arr = subjects;
			arrId = subjects_id;
			hiddenInput = "#subject_id";
			hiddenInput2 = "#subject_id2";
		}
		else if(type == "l")
		{
			arr = locations;
			arrId = locations_id;
			hiddenInput = "#location_id";
			hiddenInput2 = "#location_id2";
		}
		/*the autocomplete function takes two arguments,
		the text field element and an array of possible autocompleted values:*/
		var currentFocus;
		/*execute a function when someone writes in the text field:*/
		inp.addEventListener("input", function(e) {
			var a, b, i, val = this.value;
			/*close any already open lists of autocompleted values*/
			closeAllLists();
			if (!val) { return false;}
			currentFocus = -1;
			/*create a DIV element that will contain the items (values):*/
			a = document.createElement("DIV");
			a.setAttribute("id", this.id + "autocomplete-list");
			a.setAttribute("class", "autocomplete-items");
			a.setAttribute("style", "border:0");
			/*append the DIV element as a child of the autocomplete container:*/
			this.parentNode.appendChild(a);
			/*for each item in the array...*/
			for (i = 0; i < arr.length; i++) {
				/*check if the item starts with the same letters as the text field value:*/
				if (arr[i].toUpperCase().includes(val.toUpperCase())) {
					/*create a DIV element for each matching element:*/
					b = document.createElement("DIV");
					/*make the matching letters bold:*/
					b.innerHTML = arr[i].substr(0, val.length);
					b.innerHTML += arr[i].substr(val.length);
					/*insert a input field that will hold the current array item's value:*/
					b.innerHTML += "<input type='hidden' value='" + arrId[i] + "'>";
					/*execute a function when someone clicks on the item value (DIV element):*/
					b.addEventListener("click", function(e) {
						/*insert the value for the autocomplete text field:*/
						inp.value = this.innerHTML.split("<input")[0];
						$(hiddenInput).val(this.getElementsByTagName("input")[0].value);
						$(hiddenInput2).val(this.getElementsByTagName("input")[0].value);
						//alert(this.getElementsByTagName("input")[0].value);
						/*close the list of autocompleted values,
						(or any other open lists of autocompleted values:*/
						closeAllLists();
					});
					a.appendChild(b);
				}
			}
		});
		/*execute a function presses a key on the keyboard:*/
		inp.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
				increase the currentFocus variable:*/
				currentFocus++;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 38) { //up
				/*If the arrow UP key is pressed,
				decrease the currentFocus variable:*/
				currentFocus--;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault();
				if (currentFocus > -1 && x) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();
				}
			}
		});
		function addActive(x) {
			/*a function to classify an item as "active":*/
			if (!x) return false;
			/*start by removing the "active" class on all items:*/
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1);
			/*add class "autocomplete-active":*/
			x[currentFocus].classList.add("autocomplete-active");
		}
		function removeActive(x) {
			/*a function to remove the "active" class from all autocomplete items:*/
			for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
			}
		}
		function closeAllLists(elmnt) {
			/*close all autocomplete lists in the document,
			except the one passed as an argument:*/
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != inp) {
					x[i].parentNode.removeChild(x[i]);
				}
			}
		}
		/*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function (e) {
			closeAllLists(e.target);
		});
	}
	
	autocomplete(document.getElementById("subject"), 's');
	autocomplete(document.getElementById("location"), 'l');
	
	autocomplete(document.getElementById("subject2"), 's');
	autocomplete(document.getElementById("location2"), 'l');
</script>

<style>

	.autocomplete {
				/*the container must be positioned relative:*/
				position: relative;
				display: inline-block;
			}
			
	.autocomplete-items {
		overflow: auto;
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;
		border-top: none;
		height: 300px;
		z-index: 99;
		/*position the autocomplete items to be the same width as the container:*/
		top: 100%;
		left: 0;
		right: 0;
	}

	.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #fff; 
		border-bottom: 1px solid #d4d4d4; 
		color: #000;
		text-align: left;
	}

	.autocomplete-items div:hover {
		/*when hovering an item:*/
		background-color: #e9e9e9; 
	}

	.autocomplete-active {
		/*when navigating through the items using the arrow keys:*/
		background-color: DodgerBlue !important; 
		color: #ffffff; 
	}
</style>

<script>

  equalheight = function(container){



    var currentTallest = 0,

    currentRowStart = 0,

    rowDivs = new Array(),

    $el,

    topPosition = 0;

    $(container).each(function() {



     $el = $(this);

     $($el).height('auto')

     topPostion = $el.position().top;



     if (currentRowStart != topPostion) {

       for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {

         rowDivs[currentDiv].height(currentTallest);

       }

       rowDivs.length = 0; // empty the array

       currentRowStart = topPostion;

       currentTallest = $el.height();

       rowDivs.push($el);

     } else {

       rowDivs.push($el);

       currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

     }

     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {

       rowDivs[currentDiv].height(currentTallest);

     }

   });

  }



  $(window).load(function() {

    equalheight('.how_works .thum_bg');

  });





  $(window).resize(function(){

    equalheight('.how_works .thum_bg');

  });


</script>



		<script src="css-pricing/adaptor/js/box-slider-all.jquery.min.js"></script>
		<script>
		  $(function () {
        var $images = $('.slide > img');
        var imagesLeftToLoad = $images.length;
        $images.on('load', function () {
          imagesLeftToLoad -= 1;

          if (imagesLeftToLoad === 0) {
            init();
          }
        });

        var init = function () {
          // This function runs before the slide transition starts
          var switchIndicator = function ($c, $n, currIndex, nextIndex) {
            // kills the timeline by setting it's width to zero
            $timeIndicator.stop().css('width', 0);
            // Highlights the next slide pagination control
            $indicators.removeClass('current').eq(nextIndex).addClass('current');
          };

          // This function runs after the slide transition finishes
          var startTimeIndicator = function () {
            // start the timeline animation
            $timeIndicator.animate({width: '100%'}, slideInterval);
          };

          var $box = $('#box')
            , $indicators = $('.goto-slide')
            , $effects = $('.effect')
            , $timeIndicator = $('#time-indicator')
            , slideInterval = 5000
            , defaultOptions = {
                  speed: 1200
                , autoScroll: true
                , timeout: slideInterval
                , next: '#next'
                , prev: '#prev'
                , pause: '#pause'
                , onbefore: switchIndicator
                , onafter: startTimeIndicator
                , effect : 'scrollHorz'
              }
            , effectOptions = {
                'blindLeft': {blindCount: 15}
              , 'blindDown': {blindCount: 15}
              , 'tile3d': {tileRows: 6, rowOffset: 80}
              , 'tile': {tileRows: 6, rowOffset: 80}
            };

          // initialize the plugin with the desired settings
          $box.boxSlider(defaultOptions);
          // start the time line for the first slide
          startTimeIndicator();

          // Paginate the slides using the indicator controls
          $('#controls').on('click', '.goto-slide', function (ev) {
            $box.boxSlider('showSlide', $(this).data('slideindex'));
            ev.preventDefault();
          });

          // This is for demo purposes only, kills the plugin and resets it with
          // the newly selected effect
          $('#effect-list').on('click', '.effect', function (ev) {
            var $effect = $(this)
              , fx = $effect.data('fx')
              , extraOptions = effectOptions[fx];

            $effects.removeClass('current');
            $effect.addClass('current');
            switchIndicator(null, null, 0, 0);
            $box
              .boxSlider('destroy')
              .boxSlider($.extend({effect: fx}, defaultOptions, extraOptions));
            startTimeIndicator();

            ev.preventDefault();
          });
        };
		  });
		</script>