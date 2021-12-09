<?php 

require_once('includes/head.php');
require_once('mobile-detect/mobile-detect.php');



if (count($_POST) > 0) {

   $data = $_POST;  

   $output = system::FireCurl(APPLY_JOB_URL, "POST", "JSON", $data);

   Session::SetFlushMsg($output->flag, $output->message);

   if ($output->flag == 'success') {      

      header('Location: search_job.php');

      exit();

   }

}



$job_id = (isset($_GET['jid']) && $_GET['jid'] > 0) ? $_GET['jid'] : 0;

 if(isset($_GET['status'])) $status = $_GET['status'];

 else $status = 'open';

 

 

$user_id = (isset($_SESSION['auth']['user_id']) && $_SESSION['auth']['user_id'] > 0) ? $_SESSION['auth']['user_id'] : 0;



$data = array('status' => $status, 'job_id' => $job_id);

$output = system::FireCurl(SEACRH_JOB_URL, "POST", "JSON", $data);

$search = $output->data;

$row    = $search[0];



//include('includes/header.php');
?>
<!-- ***** START HEADER ***** -->
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
	  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!--<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
	  <link rel="stylesheet" href="css/swiper.min.css">   -->
      
      <!-- Autocomplete -->
      <link rel="stylesheet" href="css/jquery-ui.css">
      <link rel="stylesheet" href="css/flush.css">
      <link rel="stylesheet" href="css/custom.css">
      <link rel="stylesheet" type="text/css" href="css/component.css" />
      
      <!-- <link href="https://c5p8r7v3.hostrycdn.com/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://c5p8r7v3.hostrycdn.com/css/style.css" rel="stylesheet" type="text/css">
      <link href="https://c5p8r7v3.hostrycdn.com/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://c5p8r7v3.hostrycdn.com/css/owl.theme.default.min.css"> 
      <link rel="stylesheet" href="https://c5p8r7v3.hostrycdn.com/css/owl.carousel.min.css"> 
      <link rel="stylesheet" href="https://c5p8r7v3.hostrycdn.com/css/swiper.min.css"> 
      
      <link rel="stylesheet" href="https://c5p8r7v3.hostrycdn.com/css/jquery-ui.css">
      <link rel="stylesheet" href="https://c5p8r7v3.hostrycdn.com/css/flush.css">
      <link rel="stylesheet" href="https://c5p8r7v3.hostrycdn.com/css/custom.css">
      <link rel="stylesheet" type="text/css" href="https://c5p8r7v3.hostrycdn.com/css/component.css" />-->
      
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

  //gtag('config', 'UA-138159328-1');
  gtag('config', 'UA-42467282-1');
</script>

      
       <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
       <?php /*$arrSet = system::FireCurl(GET_SETTINGS.'?set=GOOGLE_ANALYTICS');
        foreach($arrSet->data as $set){
         echo $set->ss_settings_value;
        } */
       ?>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins)
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      
      <script src="js/jquery.min.js"></script> 
      <script src="js/bootstrap.min.js"></script> 
      <!-- Swiper JS 
      <script src="js/swiper.min.js"></script>-->
      <!-- Initialize Swiper -->
      <script>
        /*var swiper = new Swiper('.swiper-container', {
          pagination: '.swiper-pagination',
          slidesPerView: 3,
          slidesPerColumn: 2,
          paginationClickable: true,
          spaceBetween: 30
        });*/

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
      <!--<script async src="js/jquery-ui.js"></script>
	  <script src="js/owl.carousel.js"></script>
	  <script async src="js/velocity.min.js"></script>
      <script src="js/enhance.js"></script>-->
      <!--<script src="js/flush.js"></script>-->
      <script type="text/javascript">
function hideErrDiv(containerEle,progressEle){var elem=document.getElementById(progressEle);var width=100;var id=setInterval(frame,50);function frame(){if(width<=0){clearInterval(id);$("#"+containerEle).fadeOut(200)}else{width--;elem.style.width=width+'%'}}}
var counter=0;function getStickyNote(msg_type,msg_text){counter++;var html='<div id="sticky-container-'+counter+'" class="toast toast-'+msg_type+'" style="">'+'<div id="alert_progress_bar_'+counter+'" class="toast-progress" style="width: 100%;"></div>'+'<button type="button" class="toast-close-button" role="button">×</button>'+'<div class="toast-message">'+msg_text+'</div>'+'</div>';$('#toast-container').append(html);hideErrDiv('sticky-container-'+counter,'alert_progress_bar_'+counter);return html}
      </script>

      <script>
        $(document).ready(function() {
//           $('#carousel-example-generic').carousel({
//             pause: "false"
//           });
       //   $('#carousel-example-generic1').carousel('pause');  
          /*$('.owl-stage-outer').owlCarousel({
            interval: 3000,
            autoPlay : true
          });

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
          });*/

          $(".dropbox").click(function(){
            $(this).next('.dropPop').stop();
            $(this).next('.dropPop').slideToggle("slow");
          });
/*START - untuk menu bar(mobile), hide code ini*/
          /*$('ul.nav li.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
          }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
          });*/
/*END*/
        
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
      <!--<script type="text/javascript" src="js/jquery.validate.js"></script>
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
      </script> -->
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


.stay-open {display:block !important;}






/* Extra2 small viewport or screen */
/*@media screen and (max-width : 320px) {
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

@media screen and (max-width : 360px) {
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
@media screen and (max-width : 370px) {
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
@media screen and (max-width : 380px) {
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
@media screen and (max-width : 400px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:14px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:240px;
  }
}

@media screen and (max-width : 480px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:14px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:300px;
  }
}

@media only screen and (min-width : 500px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:14px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:320px;
  }
}
@media only screen and (min-width : 600px) {
  .screensize {
      margin-left:-170px;
      margin-top:25px;
      font-size:14px;
  }
  .screensizelg {
       display: none;
  }
  .sizedcreenli{
	  margin-left:420px;
  }
}

@media only screen and (min-width : 700px) {

}
@media only screen and (min-width : 800px) {

}
@media only screen and (min-width : 900px) {

}
@media only screen and (min-width : 1000px) {

}
@media only screen and (min-width : 1100px) {

}
@media only screen and (min-width : 1200px) {

}

*/
.shadow {
  box-shadow: 0px 15px 10px -15px #111;  
}
</style>
    <!-- Bootstrap core CSS 
    <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <link href="https://getbootstrap.com/docs/3.3/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

    <!-- Custom styles for this template 
    <link href="https://getbootstrap.com/docs/3.3/examples/navbar-static-top/navbar-static-top.css" rel="stylesheet">-->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
    <script src="https://getbootstrap.com/docs/3.3/assets/js/ie-emulation-modes-warning.js"></script>-->
   </head>
   <body>
      <!--Start of Tawk.to Script-->
      <!-- <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/599d42bc4fe3a1168ead95ae/default';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
      </script> -->
      <!--End of Tawk.to Script-->
      <!--Start of Tawk.to Script-->
      <!--<script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/599fed3ab6e907673de09890/default';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
      </script>-->
      <!--End of Tawk.to Script-->
      
      
      <div class="loaderBackground" id="hider"></div>
      <div class="loaderpop" id="loadermodaldiv">
         <h4><img src="images/loader.gif" style="width: 50px;" />Loading...</h4>
      </div>

    <nav class="navbar navbar-default navbar-fixed-top <?php echo (basename($_SERVER['PHP_SELF']) == 'tutor-login.php' || basename($_SERVER['PHP_SELF']) == 'parent_login.php' || basename($_SERVER['PHP_SELF']) == 'forgot_password.php') ? 'hidden' : '' ;?>">
<style>
.alert {
padding: 8px 35px 8px 14px;
margin-bottom: 18px;
color: #c09853;
text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
background-color: #fcf8e3;
border: 1px solid #fbeed5;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}
.alert-heading {
color: inherit;
}
.alert .close {
position: relative;
top: -2px;
right: -21px;
line-height: 18px;
}
.alert-success {
color: #468847;
background-color: #dff0d8;
border-color: #d6e9c6;
}
.alert-danger,
.alert-error {
color: #b94a48;
background-color: #f2dede;
border-color: #eed3d7;
}
.alert-info {
color: #3a87ad;
background-color: #d9edf7;
border-color: #bce8f1;
}
.alert-block {
padding-top: 14px;
padding-bottom: 14px;
}
.alert-block > p,
.alert-block > ul {
margin-bottom: 0;
}
.alert-block p + p {
margin-top: 5px;
}
</style>

<!--
  <div class="alert alert-info alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Attention :</strong> The Terms of Accepting Personal Tuition Job has been updated. Please read the terms again, and if you agree, re-sign the term in the space at the bottom.
  </div>-->
<?php 

$thisUserID = $_SESSION['auth']['user_id'];

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
	
function getBetween($string, $start = "", $end = ""){
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return '';
    }
}

if($_SESSION['auth']['user_role'] == '3') { 

	$queryUser = $conn->query(" SELECT * FROM tk_user WHERE u_id='$thisUserID' ");
	$resUser = $queryUser->num_rows;
	if($resUser > 0){
        $rowUser = $queryUser->fetch_assoc();
        
        $tutorDisplayID = $rowUser['u_displayid'];
        
        if ( $rowUser['signature_img'] != '' ) {
 
    		$getSig = strtok($rowUser['signature_img'], '_');
    		$getSig = str_replace('-', '/', $getSig);
    		$dateConvert = strtotime($getSig); 
    		//$dateFormat = date('Y-m-d', $dateConvert);  //signature_img
    		
    		$b = explode('/',$getSig);
    		$dateFormat = (int)($b[2].$b[1].$b[0]);
    		
            $getTime = getBetween($rowUser['signature_img'],"_","_");
			if(strlen($getTime) == '7'){
				$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
			}else{
				$getTime = str_replace("-",":",$getTime).':00';
			}
			
    		
                $queryProof1 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='76' AND pmt_noti='TRUE' "; 
                $resultProof1 = $conn->query($queryProof1); 
                if($resultProof1->num_rows > 0){ 
						
						$rowProof1 = $resultProof1->fetch_assoc();
						$dateLastupdated2 = $rowProof1['pmt_lastupdated'];
						$timeSaveTerms = $rowProof1['pmt_time'];
			
						$dateConvert2 = strtotime($dateLastupdated2); 
						//$dateFormat2 = date('Y-m-d', $dateConvert2);    //pmt_lastupdated
					
						$a = explode('/',$rowProof1['pmt_lastupdated']);
						$dateFormat2 = (int)($a[2].$a[1].$a[0]);
					
						$queryProof1 = " SELECT * FROM tk_term_popup WHERE tp_id ='".$thisUserID."' "; 
						$resultProof1 = $conn->query($queryProof1); 
						if($resultProof1->num_rows > 0){ 
						}else{
							if($dateFormat2 > $dateFormat){
						        echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
							}else if($dateFormat2 < $dateFormat){
                                //echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
							}else if($dateFormat2 = $dateFormat){
								if($timeSaveTerms >= $getTime){
                                    echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
								}else{
									
								}
							}else{
							    echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
							}                    
						}
                }
        }
	}
}

if($_SESSION['auth']['user_role'] == '4') { 

	$queryUser = $conn->query(" SELECT * FROM tk_user WHERE u_id='$thisUserID' ");
	$resUser = $queryUser->num_rows;
	if($resUser > 0){
        $rowUser = $queryUser->fetch_assoc();
        
        $tutorDisplayID = $rowUser['u_displayid'];
        
        if ( $rowUser['signature_img'] != '' ) {
 
    		$getSig = strtok($rowUser['signature_img'], '_');
    		$getSig = str_replace('-', '/', $getSig);
    		$dateConvert = strtotime($getSig); 
    		//$dateFormat = date('Y-m-d', $dateConvert);  //signature_img
    		
    		$b = explode('/',$getSig);
    		$dateFormat = (int)($b[2].$b[1].$b[0]);
    		
            $getTime = getBetween($rowUser['signature_img'],"_","_");
			if(strlen($getTime) == '7'){
				$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
			}else{
				$getTime = str_replace("-",":",$getTime).':00';
			}
			
    		
                $queryProof1 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='78' AND pmt_noti='TRUE' "; 
                $resultProof1 = $conn->query($queryProof1); 
                if($resultProof1->num_rows > 0){ 
						
						$rowProof1 = $resultProof1->fetch_assoc();
						$dateLastupdated2 = $rowProof1['pmt_lastupdated'];
						$timeSaveTerms = $rowProof1['pmt_time'];
			
						$dateConvert2 = strtotime($dateLastupdated2); 
						//$dateFormat2 = date('Y-m-d', $dateConvert2);    //pmt_lastupdated
					
						$a = explode('/',$rowProof1['pmt_lastupdated']);
						$dateFormat2 = (int)($a[2].$a[1].$a[0]);
					
						$queryProof1 = " SELECT * FROM tk_term_popup WHERE tp_id ='".$thisUserID."' "; 
						$resultProof1 = $conn->query($queryProof1); 
						if($resultProof1->num_rows > 0){ 
						}else{
							if($dateFormat2 > $dateFormat){
						        echo "<script>$(document).ready(function(){ $('#myModalPopUp2').modal('show'); });</script>";
							}else if($dateFormat2 < $dateFormat){
                                //echo "<script>$(document).ready(function(){ $('#myModalPopUp2').modal('show'); });</script>";
							}else if($dateFormat2 = $dateFormat){
								if($timeSaveTerms >= $getTime){
                                    echo "<script>$(document).ready(function(){ $('#myModalPopUp2').modal('show'); });</script>";
								}else{
									
								}
							}else{
							    echo "<script>$(document).ready(function(){ $('#myModalPopUp2').modal('show'); });</script>";
							}                    
						}
                }
        }
	}
}
?>

      <div class="container">
        <div class="col-md-3">
        <div class="navbar-header ">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php $arrLogo = system::FireCurl(GET_SETTINGS.'?set=COMPANY_LOGO');
          foreach($arrLogo->data as $logo){ ?>
          <!--<a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="admin/upload/<?php echo $logo->ss_settings_value;?>" class="img-responsive" alt=""/></a>-->
		  <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/<?php echo $logo->ss_settings_value;?>" class="pull-left img-responsive" alt="tutorkami logo"/></a>
          <?php } ?>
          <a href="request_a_tutor.php" style="" type="button" class="pull-right btn btn-info navbar-sm screensize">GET A TUTOR</a>
        </div>
        </div>
		
        <!--<div class="col-md-1 hidden-sm hidden-md hidden-lg" style="margin-top:8px;">
			<a href="request_a_tutor.php" class="btn btn-info btn-lg get_btntop"><?php echo GET_A_TUTOR; ?></a>
        </div>-->
<!--
    <div class="hidden-md hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:40px;margin-right:0px;" type="button" class="btn btn-info navbar-sm"><?php echo GET_A_TUTOR; ?></a>
  	</div>
    <div class="hidden-lg hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:40px;margin-right:0px;" type="button" class="btn btn-info navbar-sm"><?php echo GET_A_TUTOR; ?></a>
  	</div>
<div class="col-md-3">
<?php
if($_SERVER['PHP_SELF'] == "/search-tutor.php" || $_SERVER['PHP_SELF'] == "/request_a_tutor.php"){
?>
	<div class="hidden-lg hidden-md hidden-xs pull-right">
      <a href="request_a_tutor.php" style="margin-top:-60px;margin-right:85px;" type="button" class="btn btn-info navbar-sm"><?php echo GET_A_TUTOR; ?></a>
  	</div>
    <div class="hidden-lg hidden-md hidden-sm pull-right">
      <a href="request_a_tutor.php" style="margin-top:-40px;margin-right:40px;" type="button" class="btn btn-info navbar-xs"><?php echo GET_A_TUTOR; ?></a>
  	</div>
<?php
}else{
?>
	<div class="hidden-lg hidden-md hidden-xs pull-right">
      <a href="request_a_tutor.php" style="margin-top:-110px;margin-right:85px;" type="button" class="btn btn-info navbar-sm"><?php echo GET_A_TUTOR; ?></a>
  	</div>
    <div class="hidden-lg hidden-md hidden-sm pull-right">
      <a href="request_a_tutor.php" style="margin-top:-80px;margin-right:40px;" type="button" class="btn btn-info navbar-xs"><?php echo GET_A_TUTOR; ?></a>
  	</div>
<?php
}
?>

</div>-->

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right off_dropd">

                       <?php if(!isset($_SESSION['auth'])) { ?>
                       <?php // Get Header Navigation
                        if($_SESSION['lang_code']=='' || $_SESSION['lang_code']== $defaultLang){                 
                          $lang_url = str_replace('{lang}/', '', LIST_HEADER_MENU);
                        }
                        elseif( $_SESSION['lang_code']=='BM'){
                         ?>
                        <li class="dropdown text-right">
							<!--<a href="https://www.tutorkami.com/my/index">Utama</a>-->
							<a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button">Utama <span class="caret"></span></a>
							<ul class="dropdown-menu text-right" role="menu">
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/index">Halaman Utama</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/about">Mengenai Kami</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/contact-us">Hubungi Kami</a></li>
							</ul>
                        </li>						
  
                        <li class="dropdown text-right">
							<a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button">Ibu / Bapa <span class="caret"></span></a>
							<ul class="dropdown-menu text-right" role="menu">
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/search-tutor">Cari Tutor</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/parent_faq">FAQs</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/request_a_tutor?tutor_id=i3be8gz">Hubungi Kami</a></li>
								<!--<li><a href="https://www.tutorkami.com/parent_login.php">Log Masuk Ibubapa</a></li>-->
								
								
							</ul>
                        </li>

                        <li class="dropdown text-right">
							<a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button">Saya Tutor <span class="caret"></span></a>
							<ul class="dropdown-menu text-right" role="menu">
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/tutor.php">Laman Tutor</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/search_job.php">Job Terkini</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/register.php">Pendaftaran</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/tutor_faq.php">Tutor FAQs</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/tutor-login.php">Log Masuk Tutor</a></li>
							</ul>
                        </li>

				
                         <?php
                        }
                        else{
                          $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_HEADER_MENU);

                        }
                        // die($lang_url);
/*                      
                        $arrHeadMenu = system::FireCurl($lang_url);

                        $staticURLs = array('http://projects.manfredinfotech.com/tutorkami/', 'http://localhost/tutorkami/');  
                        foreach($arrHeadMenu->data as $hmenu){
                           echo str_replace($staticURLs, APP_ROOT, $hmenu->mainmenu);
                        }
*/

/*START fadhli - untuk menu bar(mobile), hide code diatas (tak pasti)*/
if($_SESSION['lang_code']=='en' || $_SESSION['lang_code']==''){
						?>
						<li class="dropdown text-right">
							<!--<a href="https://www.tutorkami.com/">Home</a>-->
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
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/search-tutor">Search Tutor</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/parent_faq">FAQs</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/request_a_tutor?tutor_id=i3be8gz">Contact Us</a></li>
								<!--<li><a href="https://www.tutorkami.com/parent_login.php">Sign In</a></li>-->
								
								
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
<!--<ul class="dropdown-menu list-inline" role="menu">
								<li><a href="http://tutorkami.com/tutor.php">Tutor Page</a></li>
								<li><a href="http://tutorkami.com/search_job.php">Latest Job</a></li>
								<li><a href="http://tutorkami.com/register.php">Register</a></li>
								<li><a href="http://tutorkami.com/tutor_faq.php">Tutor FAQs</a></li>
</ul>-->
                        </li>
						<?php	
	
}

/*END fadhli */


                        ?>
				
						
						
						
						
						
                       <?php } else { ?>
                        <?php if($_SESSION['auth']['user_role'] == '4') { ?>
                        <li class="dropdown text-right" id="shadow">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle text-right" href="#">
                           <?php echo WELCOME; ?> <?php echo ucfirst($_SESSION['auth']['first_name']); ?> <?php //echo ucfirst($_SESSION['auth']['last_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu text-right
                           <?PHP 
                           if(!isset($_SESSION['getPage'])){
                               //echo 'stay-open';
                           }
                           ?>
                           " role="menu">
                              <li class="sizedcreenli"><a href="clients_profile.php" class="language"><?php echo MY_PROFILE; ?></a></li>
                              <li class="sizedcreenli"><a href="list_of_classes.php" class="language"><?php echo LIST_OF_CLASSES; ?></a></li>
                              <!--<li class="sizedcreenli"><a href="payment_history.php" class="language"><?php echo PAYMENT_HISTORY; ?></a></li>-->
                              <li class="sizedcreenli"><a href="parent_guide.php" class="language"><?php echo PARENT_GUIDE; ?></a></li>
							  <li class="sizedcreenli"><a href="clients-terms.php" class="language"><?php echo "Terms"; ?></a></li>
							  <li class="sizedcreenli"><a href="logout.php" class="language"><?php echo LOGOUT; ?></a></li>
                           </ul>
                        </li>
                        <?php } else { ?>
                        <li class="dropdown text-right" id="shadow">
                           <a id="caretthis" role="button" data-toggle="dropdown" class="dropdown-toggle text-right" href="#">
                           <?php echo WELCOME; ?> <?php echo ucfirst($_SESSION['auth']['display_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu text-right
                           <?PHP 
                           if(!isset($_SESSION['getPage'])){
                               //echo 'stay-open';
                           }
                           ?>
                           " role="menu"> <!-- show/stay-open  -->
                              <li class="sizedcreenli"><a href="edit_account.php" class="language"><?php echo EDIT_ACCOUNT; ?></a></li>
                              <li class="sizedcreenli"><a href="change_password.php" class="language"><?php echo CHANGE_PASSWORD; ?></a></li>
                              <?PHP
                                if( isset($tutorDisplayID) && $tutorDisplayID !='' ){
                                    ?>
                                        <li class="sizedcreenli"><a href="tutor_profile?did=<?PHP echo $tutorDisplayID; ?>" class="language"><?php echo VIEW_PROFILE; ?></a></li>
                                    <?PHP
                                }else{
                                    ?>
                                        <li class="sizedcreenli"><a href="view_profile.php" class="language"><?php echo VIEW_PROFILE; ?></a></li>
                                    <?PHP
                                }
                              ?>
                              <!--<li class="sizedcreenli"><a href="tutor_list_of_classes.php" class="language"><?php //echo LIST_OF_CLASSES; ?></a></li>-->
                              <li class="sizedcreenli"><a href="my-classes.php" class="language"><?php echo LIST_OF_CLASSES; ?></a></li>
                              <!--<li><a href="tutor_payment_history.php" class="language"><?php echo PAYMENT_HISTORY; ?></a></li>-->
                              <li class="sizedcreenli"><a href="search_job.php" class="language"><?php echo LATEST_JOB; ?></a></li>
                              <li class="sizedcreenli"><a href="tutor_guide.php" class="language"><?php echo TUTOR_GUIDE; ?></a></li>
							  <li class="sizedcreenli"><a href="terms-one-to-one.php" class="language"><?php echo "Terms"; ?></a></li>
							  
                              <li class="sizedcreenli"><a href="logout.php" class="language"><?php echo LOGOUT; ?></a></li>
                           </ul>
                        </li>
                        <?php } ?>
                        <input type="hidden" id="idpopup" value="<?PHP echo $_SESSION['auth']['user_id']; ?>">
                     <?php } ?>
					 
					 
			<a href="request_a_tutor.php" style="margin-top:10px" type="button" class="btn btn-info navbar-sm screensizelg">GET A TUTOR</a>
          </ul>
        </div>

		
      </div>
    </nav>

    <div id="myModalPopUp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body" style="background-color:#f1592a;">
          <font style="color:white;">
          <center>
          <strong>FRIENDLY UPDATE :</strong> The Terms of Accepting Tuition Job has been revised. Please read the terms again, the ones in red fonts are the amendments made. If you agree with the terms, please re-sign in the space at the bottom.
	<center>Thank you. <br><button type="button" class="btn btn-primary btn-xs buttonOk"> OK </button>
	<button type="button" class="btn btn-primary btn-xs buttondontShow"> Don&#39;t show this message anymore </button></center>
          </center>
          </font>
        </div>
      </div>
      
    </div>
  </div>
  
    <div id="myModalPopUp2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body" style="background-color:#f1592a;">
          <font style="color:white;">
          <center>
          <strong>FRIENDLY UPDATE :</strong> The Terms of Accepting Tuition Job has been revised. Please read the terms again, the ones in red fonts are the amendments made. If you agree with the terms, please re-sign in the space at the bottom.
	<center>Thank you. <br><button type="button" class="btn btn-primary btn-xs buttonOk2"> OK </button>
	<button type="button" class="btn btn-primary btn-xs buttondontShow2"> Don&#39;t show this message anymore </button></center>
          </center>
          </font>
        </div>
      </div>
      
    </div>
  </div>

<script>
$(document).ready(function() {

var isMobile = false; //initiate as false

if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true; 

<?PHP 
if (isset($_SESSION['auth'])) {
if ( isset($_SESSION['firstlogin']) && $_SESSION['firstlogin'] = "1"){
?>

    $(".navbar-toggle").click();
    $(".dropdown-toggle").click();
    $("#shadow").addClass("shadow");

<?PHP
}




?>
        $(".navbar-toggle").click(function() {
            setTimeout(function(){ 
                $("#caretthis").click(); 
                $("#shadow").addClass("shadow");
            }, 500);
        });  
<?PHP
  



}
?>
  
  
}else{
    
<?PHP 
if (isset($_SESSION['auth'])) {
if ( isset($_SESSION['firstlogin']) && $_SESSION['firstlogin'] = "1"){
?>
 $(".dropdown-toggle").click();

<?PHP
}
}
?>
    
}

window.onscroll = function (e) {  
    $(".navbar-collapse").collapse('hide');
    $('.dropdown').removeClass('open');
} 


});









$(document).on("click touchend", function(){
    $(".dropdown-menu").removeClass("stay-open");
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

$('.buttonOk').click(function(){
    window.location.href = "https://www.tutorkami.com/terms-one-to-one";
}) 
$('.buttonOk2').click(function(){
    window.location.href = "https://www.tutorkami.com/clients-terms";
}) 
$('.buttondontShow').click(function(){
    var value = document.getElementById("idpopup").value;
    $.ajax({
        type: "POST",
        url: "ajax-close-popup.php",
        dataType: "json",
        data: {value:value},
        success : function(data){
                if (data.code == "200"){
                    //alert("Success: " +data.msg);
                    /*var element = document.getElementById("buttondontShow");
                    element.classList.add("hidden");*/
                    var element = document.getElementById("myModalPopUp");
                    element.classList.add("hidden");
                    $('#myModalPopUp').modal('hide');
                } else {
                    alert(data.msg);
                }
            
        }
    });
}) 
</script>

<!-- ***** END HEADER ***** -->

<section class="profile">

   <div class="main-body">
<link href="css/popup/css/popup.css" rel="stylesheet" type="text/css">
<style>
ol, ul {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
ol, ul {
	list-style: none;
}
.btn-oren { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren:hover, 
.btn-oren:focus, 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  background-image: none; 
} 
 
.btn-oren.disabled, 
.btn-oren[disabled], 
fieldset[disabled] .btn-oren, 
.btn-oren.disabled:hover, 
.btn-oren[disabled]:hover, 
fieldset[disabled] .btn-oren:hover, 
.btn-oren.disabled:focus, 
.btn-oren[disabled]:focus, 
fieldset[disabled] .btn-oren:focus, 
.btn-oren.disabled:active, 
.btn-oren[disabled]:active, 
fieldset[disabled] .btn-oren:active, 
.btn-oren.disabled.active, 
.btn-oren[disabled].active, 
fieldset[disabled] .btn-oren.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}

.modal-header-success {
    color:#fff;
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #5cb85c;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
}

#updateSuccess {
top:20%;
/*right:50%;*/
outline: none;
overflow:hidden;
}
#myModalSuccess {
top:20%;
/*right:50%;*/
outline: none;
overflow:hidden;
}
</style>

<script>
function ButtonNext() {
  document.getElementById("timetable").click();
}
function ButtonPrevious() {
  document.getElementById("rate").click();
}
</script>
<?PHP
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$queryApply = " SELECT * FROM tk_applied_job WHERE aj_u_id='$user_id' AND aj_j_id='$job_id' "; 
$resultApply = $conn->query($queryApply);
if ($resultApply->num_rows > 0) {
    $rowApply = $resultApply->fetch_assoc();
    $rate = $rowApply['aj_rate'];
  
}else{
    $rate = '';
}


$queryJob = " SELECT * FROM tk_job WHERE j_id='".$job_id."' "; 
$resultJob = $conn->query($queryJob);
if ($resultJob->num_rows > 0) {
    $rowJob = $resultJob->fetch_assoc();
    $onRate = $rowJob['j_check_rate'];
    $onTimetable = $rowJob['j_check_timeday'];
    //$rowJob['city'];
    
    $GetJobCity = " SELECT * FROM tk_cities WHERE city_id='".$rowJob['city']."' "; 
    $GetJobCity2 = $conn->query($GetJobCity);
    if ($GetJobCity2->num_rows > 0) {
        $GetJobCity3 = $GetJobCity2->fetch_assoc();
        $GetJobCityName = ', '.$GetJobCity3['city_name'];
    }else{
        $GetJobCityName = '';
    }


    
    
}

?>

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt"><?php echo JOB_DETAILS; ?></h1>

         <div class="col-md-10 col-md-offset-1 ">

            <form method="post">

               <input type="hidden" name="j_id" value="<?php echo $job_id;?>" />

               <input type="hidden" name="u_id" value="<?php echo $user_id;?>" />

               <hr>

               <!--<table class="table table-responsive " width="100%" border="0" cellspacing="0" cellpadding="0">-->
               <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tbody>

                     <tr>

                        <td class="org-txt " width="50%"><strong><?php echo JOB_ID; ?> :</strong></td>

                        <td width="50%"><?php echo $row->j_id;?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo DATE; ?> :</strong></td>

                        <td><?php echo date('d/m/Y', strtotime($row->j_create_date));?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo LEVEL; ?> :</strong></td>

                        <td><?php echo $row->jlt_title;?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo SUBJECT; ?> :</strong></td>

                        <td><?php echo $row->jt_subject;?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo AREA; ?> :</strong></td>

                        <td><?php 
                        //echo $row->j_area.$GetJobCityName;
                        echo implode(',', array_unique(explode(',', $row->j_area.$GetJobCityName)));
                        ?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo STATE; ?> :</strong></td>

                        <td><?php echo $row->st_name;?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo RATE; ?> :</strong></td>

                        <td><?php echo isset($_SESSION['auth']) ? $row->j_rate : '<a href="tutor-login.php?redirect=job_details.php&jid='.$job_id.'&status='.$_GET['status'].'" class="org-txt"><strong><em>Login to view. If you have not registered, register with us now for free</em></strong></a>';?></td>
                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo LESSON; ?> :</strong></td>

                        <td><?php echo $row->jt_lessons;?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo "Schedule"; ?> :</strong></td>

                        <td><?php echo $row->j_preferred_date_time;?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo COMMISION_TO_TUTORKAMI; ?>:</strong></td>

                        <td><?php echo $row->j_commission;?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo DURATION_OF_ENGAGEMENT; ?>:</strong></td>

                        <td><?php echo $row->j_duration;?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo STATUS; ?> :</strong></td>

                        <td><?php echo ucfirst($row->j_status);?></td>

                     </tr>

                     <tr>

                        <td class="org-txt "><strong><?php echo REMARK; ?> :</strong></td>

                        <!--<td><?php //echo $row->jt_remarks;?></td>-->

                        <?php
                        if ($tablet_browser > 0) {
                        }else if ($mobile_browser > 0) {
                        }else {
                            ?><td><?php echo str_replace("\r",'<br/>',$row->jt_remarks);  //echo $row->jt_remarks;?></td><?PHP
                        }   
                        ?>

                     </tr>

                  </tbody>

               </table>
                        <?php
                        if ($tablet_browser > 0) {
                            //print 'is tablet';
                            ?><div style="margin-top:-20px;padding-left:10px;" class="row"><div class="col-xs-12"><?php echo str_replace("\r",'<br/>',$row->jt_remarks);//echo $row->jt_remarks;?></div></div><?PHP
                        }else if ($mobile_browser > 0) {
                            //print 'is mobile';
                            ?><div style="margin-top:-20px;padding-left:10px;" class="row"><div class="col-xs-12"><?php echo str_replace("\r",'<br/>',$row->jt_remarks);//echo $row->jt_remarks;?></div></div><?PHP
                        }else {
                            //print 'is desktop';
                        }   
                        ?>

               <hr>

               <div class="col-md-offset-1 col-md-10">

               <?php if($status != 'closed'){?>

                  <div class="col-md-4 omb_socialButtons"><a href="http://www.facebook.com/share.php?u=<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>&amp;title=<?php echo $row->jt_subject;?>" target="_blank" class="btn btn-lg btn-block omb_btn-facebook"> <i class="fa fa-facebook" aria-hidden="true"></i> <span class="hidden-xs">SHARE</span> </a></div>

                  <div class="col-md-4 omb_socialButtons"><a href="http://twitter.com/home?status=<?php echo $row->jt_subject;?>+<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>" target="_blank" class="btn btn-lg btn-block omb_btn-twitter"> <i class="fa fa-twitter" aria-hidden="true"></i> <span class="hidden-xs">twitter</span> </a></div>

                  <div class="col-md-4 omb_socialButtons"><a href="whatsapp://send?text=<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>" class="btn btn-lg btn-block omb_btn-whatsapp"> <i class="fa fa-whatsapp" aria-hidden="true"></i> <span class="hidden-xs">whatsapp</span> </a></div>

               </div>

               <?php } ?>

               <div class="clearfix"></div>

               <?php 

               if(isset($_SESSION['auth'])){

                  $user_job = system::FireCurl(CHECK_APPLIED_JOB_URL."?job_id={$job_id}&user_id={$user_id}");

                  if ($user_job->data > 0) {

                     echo '<h2 class="text-center">You have already <em>applied</em> for this job.</h2>';

                  } else {

               ?>

               <?php if($status != 'closed'){?>

               <div class="col-md-offset-4 col-md-4 col-xs-offset-3">

                  <!--<button type="submit" class="apply text-uppercase"><?php //echo BUTTON_APPLY_JOB; ?></button>-->
				  

<?php 
//if( $user_id =='1579981'){  
//echo '<br/><br/><br/><br/><br/><br/>';

	if($onTimetable != 'on' && $onRate != 'on'){ 
		?>
		<a href="#" class="apply text-uppercase" onclick="applyJob()" ><?php echo BUTTON_APPLY_JOB; ?></a>
		<?PHP
	}else if($onTimetable == 'on' && $onRate != 'on'){ 
		?>
		<a class="js-signin-modal-trigger cd-main-nav__item--signin  apply text-uppercase" href="#0" data-signin="signup"><?php echo BUTTON_APPLY_JOB; ?></a>
		<?PHP
	}else if($onTimetable != 'on' && $onRate == 'on'){
	    ?>
	    <a class="js-signin-modal-trigger cd-main-nav__item--signin  apply text-uppercase" href="#0" data-signin="login"><?php echo BUTTON_APPLY_JOB; ?></a>
	    <?PHP
	}else{
		?>
		<a class="js-signin-modal-trigger cd-main-nav__item--signin apply text-uppercase" href="#0" data-signin="login"><?php echo BUTTON_APPLY_JOB; ?></a>
		<?PHP
	}

//} 
?>  
				  
				  

               </div>

               <?php } } ?>

               <?php } else { ?>

               <h2 class="text-center"> <em><?php echo PLEASE; ?><strong> <a href="tutor-login.php?redirect=job_details.php&jid=<?php echo $job_id; ?>&status=<?php echo $_GET['status']; ?>" class="org-txt"><?php echo LOGIN; ?> </a></strong><?php echo TO_APPLY_FOR_THIS_JOB; ?></em></h2>

               <?php } ?>

            </form>

         </div>

      </div>

   </div>

</section>



<input type="hidden" id="pageJobID" value="<?php echo $job_id;?>">
<input type="hidden" id="pageUser" value="<?php echo $user_id;?>">
<input type="hidden" id="pageLevel" value="<?php echo $row->jlt_jl_id;?>">

  <div id="updateSuccessTimeTable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal-header-success">
          <h4 class="modal-title"><center>Sucess !</center></h4>
        </div>
        <div class="modal-body">
          <p><center>Your time slots has been successfully updated. Click 'Done' to go back to job application</center></p>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-primary" onClick="goBack2()" data-dismiss="modal">Done</button> </center>
        </div>
      </div>
      
    </div>
  </div>
  
  <div id="updateSuccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal-header-success">
          <h4 class="modal-title"><center>Sucess !</center></h4>
        </div>
        <div class="modal-body">
          <p><center>Your time slots has been successfully updated. Click 'Done' to go back to job application</center></p>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-primary" onClick="goBack()" data-dismiss="modal">Done</button> </center>
        </div>
      </div>
      
    </div>
  </div>

  <div id="myModalSuccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal-header-success">
          <h4 class="modal-title"><center>Thank You !</center></h4>
        </div>
        <div class="modal-body">
          <p><center>Your application has been successfully submited. 
Our coordinator will contact you within 5 days if you are shortlisted. 
If you dont't hear from us within these 5 days,
that means your application is unsuccessful.</center></p>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-success" onClick="doneButton()">Done</button> </center>
        </div>
      </div>
      
    </div>
  </div>

	<div id="myModalOpen" class="cd-signin-modal js-signin-modal" style="margin-top:-10px"> 
		<div class="cd-signin-modal__container"> 
			<ul class="cd-signin-modal__switcher js-signin-modal-switcher js-signin-modal-trigger" style="margin-top:30%;">
				<li><a href="#0" data-signin="login" data-type="login" id="rate">Rate</a></li>
				<li id="thisli1" ><a href="#0" data-signin="signup" data-type="signup" id="timetable"> <span id="addClass3" class="hidden">Edit </span>Time Slots</a></li>
			</ul>
<?PHP
if($onRate == 'on'){
?>
			<div class="cd-signin-modal__block js-signin-modal-block" data-type="login" > <!-- log in form -->
				<form class="cd-signin-modal__form">
				    <center><p class="cd-signin-modal__fieldset">Please State Your Rate</p></center>
					<p class="cd-signin-modal__fieldset">
						<center>RM <input style="width:100px;" type="text"  name="rate"  id="rate_input" onBlur="getRate(this.value)"> /hour</center>
					</p>
					<?PHP if($onRate == 'on' && $onTimetable != 'on'){ 
					?>
						<p class="cd-signin-modal__fieldset">
							<button type="button" class="btn btn-oren pull-right" style="margin-top:-20px;" onclick="submitRate()">Submit</button>
						</p>
					<?PHP
					}else{
					?>
						<p class="cd-signin-modal__fieldset">
							<button type="button" class="btn btn-oren pull-right" style="margin-top:-20px;" onclick="ButtonNext()">Next</button>
						</p>
					<?PHP
					}						
					?>
				</form>
			</div> 
<?PHP
}
if($onTimetable == 'on'){
?>
			<div class="cd-signin-modal__block js-signin-modal-block" data-type="signup"> 
				<form id="addClass" class="cd-signin-modal__form">
					<center>
						<div id="loadCurrTimeSlot"></div>
						<p class="cd-signin-modal__fieldset">
						<!--<input type="checkbox" id="accept-terms" class="cd-signin-modal__input ">
						<label for="accept-terms">Yes, proceed to apply this job</label>-->
						 <input type="hidden"  name="myFieldRate"  id="myFieldRate" >
						<label id="btmProceedApply" type="button" class="btn btn-oren btn-xs" onClick="proceedApply()">Yes, proceed to apply this job</label>
					</p></center>
					<center><p class="cd-signin-modal__fieldset js-signin-modal-trigger"><a href="#0" data-signin="signup" type="button" class="loadDataTimeTable btn btn-success btn-xs">No, I want to update my time slots</a></p></center>
					<?PHP if($onTimetable == 'on' && $onRate != 'on'){ 
					?>
						<!--<p class="cd-signin-modal__fieldset">
							<button onclick="submitTimeTable()" type="button" class="btn btn-oren pull-right" style="margin-top:-20px;" > Submit</button>
						</p>-->
					<?PHP
					}else{
					?>
						<p class="cd-signin-modal__fieldset">
							<button type="button" class="btn btn-oren pull-left" style="margin-top:-20px;" onclick="ButtonPrevious()">Previous</button>
							<!--<button onclick="submitJob()" type="button" class="btn btn-oren pull-right" style="margin-top:-20px;" > Submit</button>-->
						</p>
					<?PHP
					}						
					?>
				</form>
				
<center id="addClass2" class="hidden"><p class="cd-signin-modal__fieldset">
    

<input type="hidden" id="thisuser" value="<?php echo $user_id;?>">
<input type="hidden" id="alvl" value="<?php echo $row->jlt_jl_id;?>">
<input type="hidden" id="ajobid" value="<?php echo $job_id;?>">
<div id="loadDataTimeTable"></div>
<br/><br/>
</p>
</center>
				
				
			</div> 
<?PHP
}
?>
			<a href="#0" class="cd-signin-modal__close js-close">Close</a>
		</div> 
	</div>
<script src="css/popup/js/placeholders.min.js"></script> 
<script src="css/popup/js/main.js"></script> 








<?php //include('includes/footer.php');?>
<?php include('includes/footer-new.php');?>
<script>
/*
$('.loadDataTimeTable').click(function(){
    
	 $("#addClass").addClass("hidden");
	 $("#addClass2").removeClass("hidden");
	 $("#addClass3").removeClass("hidden");
	
	
    var ajobid     = document.getElementById("ajobid").value;
    var alvl       = document.getElementById("alvl").value;
    //var rate_input = document.getElementById("rate_input").value;
	
	if(document.getElementsByName("rate_input").length<=0) {
		var rate_input = '';
		$("#loadDataTimeTable").load('job_details-ajax2.php','ajobid='+ajobid+'&alvl='+alvl+'&rate_input='+rate_input);
	}else{
		var rate_input = document.getElementById("rate_input").value;
		$("#loadDataTimeTable").load('job_details-ajax2.php','ajobid='+ajobid+'&alvl='+alvl+'&rate_input='+rate_input);
	}
});

function submitJob (){
    var thisuser   = document.getElementById("thisuser").value;
    var ajobid     = document.getElementById("ajobid").value;
    var alvl       = document.getElementById("alvl").value;
    var rate_input = document.getElementById("rate_input").value;
    
    if ( document.getElementById('accept-terms').checked === false ) {
        alert("Please tick 'Yes, this is my updated timetable'");
    }else{
        //alert(ajobid + ' ' + alvl + ' ' + rate_input);
            if(thisuser == ''){
                alert('Empty User');
                exit();
            }else if(ajobid == ''){
                alert('Empty JobID');
                exit();
            }else if(alvl == ''){
                alert('Empty Level');
                exit();
            }else if(rate_input == ''){
                alert('Empty Rate');
                exit();
            }else{
                $.ajax({
                    type:'POST',
                    url:'submit-job.php',
                    data:{ajobid: ajobid, thisuser: thisuser, alvl: alvl, rate_input: rate_input},
                    success:function(result){
    					if(result == 'done'){
                            var element = document.getElementById("myModalOpen");
                            element.classList.add("hidden");
                            $('#myModalSuccess').modal('show');    					    
    					}else{
    					    alert(result);
    					}
                    }
    			});
            }
	
    }
    
    
}

function doneButton() {
	$('#myModalSuccess').modal('hide');
	location.reload();

}
function goBack (){
   $("#addClass").removeClass("hidden");
   $("#addClass2").addClass("hidden");
   $("#addClass3").addClass("hidden");
   $("#myModalOpen").removeClass("hidden");
}
function goBack2 (){
	location.reload();
}

function submitRate() {
    var ajobid     = document.getElementById("pageJobID").value;
    var thisuser   = document.getElementById("pageUser").value;
    var alvl       = document.getElementById("pageLevel").value;
    var rate_input = document.getElementById("rate_input").value;
	if(ajobid == ''){
		alert('Empty JobID');
		exit();
	}else if(thisuser == ''){
		alert('Empty User');
		exit();
	}else if(alvl == ''){
		alert('Empty Level');
		exit();
	}else if(rate_input == ''){
		alert('Empty Rate');
		exit();
	}else{
		$.ajax({
			type:'POST',
			url:'submit-rate.php',
			data:{ajobid: ajobid, thisuser: thisuser, alvl: alvl, rate_input: rate_input},
			success:function(result){
				if(result == 'done'){
					var element = document.getElementById("myModalOpen");
					element.classList.add("hidden");
					$('#myModalSuccess').modal('show');    					    
				}else{
					alert(result);
				}
			}
		});
	}
}


function submitTimeTable() {
}
*/
$(document).ready(function() {
    var thisuser   = document.getElementById("pageUser").value;
    $.ajax({
        type: "POST",
        url: "loadCurrTimeSlot.php",
        data: {thisuser: thisuser},  
        cache: true,
        success: function(response) {
            $('#loadCurrTimeSlot').html(response);
        }
    });
});

function applyJob() {
    var ajobid     = document.getElementById("pageJobID").value;
    var thisuser   = document.getElementById("pageUser").value;
    var alvl       = document.getElementById("pageLevel").value;
		$.ajax({
			type:'POST',
			url:'apply-job.php',
			data:{ajobid: ajobid, thisuser: thisuser, alvl: alvl},
			success:function(result){
				if(result == 'done'){
					$('#myModalSuccess').modal('show');    					    
				}else{
					alert(result);
				}
			}
		}); 				
}
function doneButton() {
	$('#myModalSuccess').modal('hide');
	location.reload();
}

$('.loadDataTimeTable').click(function(){
    
	 $("#addClass").addClass("hidden");
	 $("#addClass2").removeClass("hidden");
	 $("#addClass3").removeClass("hidden");
	
    var ajobid     = document.getElementById("ajobid").value;
    var alvl       = document.getElementById("alvl").value;
	
	if(document.getElementsByName("rate_input").length<=0) {
		var rate_input = '';
		$("#loadDataTimeTable").load('job_details-ajax2.php','ajobid='+ajobid+'&alvl='+alvl+'&rate_input='+rate_input);
	}else{
		var rate_input = document.getElementById("rate_input").value;
		$("#loadDataTimeTable").load('job_details-ajax2.php','ajobid='+ajobid+'&alvl='+alvl+'&rate_input='+rate_input);
	}
});



function submitRate() {
    var ajobid     = document.getElementById("pageJobID").value;
    var thisuser   = document.getElementById("pageUser").value;
    var alvl       = document.getElementById("pageLevel").value;
    var rate_input = document.getElementById("rate_input").value;
	if(ajobid == ''){
		alert('Empty JobID');
		exit();
	}else if(thisuser == ''){
		alert('Empty User');
		exit();
	}else if(alvl == ''){
		alert('Empty Level');
		exit();
	}else if(rate_input == ''){
		alert('Empty Rate');
		exit();
	}else{
		$.ajax({
			type:'POST',
			url:'submit-rate.php',
			data:{ajobid: ajobid, thisuser: thisuser, alvl: alvl, rate_input: rate_input},
			success:function(result){
				if(result == 'done'){
					var element = document.getElementById("myModalOpen");
					element.classList.add("hidden");
					$('#myModalSuccess').modal('show');    					    
				}else{
					alert(result);
				}
			}
		});
	}
}

function proceedApply() {
    
    var ajobid     = document.getElementById("pageJobID").value;
    var thisuser   = document.getElementById("pageUser").value;
    var alvl       = document.getElementById("pageLevel").value;
    
    $("#btmProceedApply").addClass("hidden");
 
	if(document.getElementsByName("rate_input").length<=0) {
		if(document.getElementsByName("myFieldRate").length<=0) {
		    var rate_input = '';
		}else{
		    var rate_input = document.getElementById("myFieldRate").value;
		}
		$.ajax({
			type:'POST',
			url:'submit-rate.php',
			data:{ajobid: ajobid, thisuser: thisuser, alvl: alvl, rate_input: rate_input},
			success:function(result){
				if(result == 'done'){
				    //alert('1'+result);
					var element = document.getElementById("myModalOpen");
					element.classList.add("hidden");
					$('#myModalSuccess').modal('show');    					    
				}else{
				    $("#btmProceedApply").removeClass("hidden");
					alert(result);
				}
			}
		});
	    /*
		$.ajax({
			type:'POST',
			url:'apply-job.php',
			data:{ajobid: ajobid, thisuser: thisuser, alvl: alvl},
			success:function(result){
				if(result == 'done'){
				    alert('1'+result);
					var element = document.getElementById("myModalOpen");
					element.classList.add("hidden");
					$('#myModalSuccess').modal('show');    					    
				}else{
				    $("#btmProceedApply").removeClass("hidden");
					alert(result);
				}
			}
		}); */
	}else{
		if(document.getElementsByName("myFieldRate").length<=0) {
		    var rate_input = '';
		}else{
		    var rate_input = document.getElementById("myFieldRate").value;
		}
		$.ajax({
			type:'POST',
			url:'submit-rate.php',
			data:{ajobid: ajobid, thisuser: thisuser, alvl: alvl, rate_input: rate_input},
			success:function(result){
				if(result == 'done'){
				    alert('2'+result);
					var element = document.getElementById("myModalOpen");
					element.classList.add("hidden");
					$('#myModalSuccess').modal('show');    					    
				}else{
				    $("#btmProceedApply").removeClass("hidden");
					alert(result);
				}
			}
		});
	}
	
}

function getRate(rate) {
  document.getElementById('myFieldRate').value = rate;
}
</script>