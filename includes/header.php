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
      <?php //$seoArr = system::FireCurl(GET_SEO_CONTENT_URL.'?current_page='.basename($_SERVER['PHP_SELF']).'&lang_code='.$_SESSION['lang_code']); ?>
      <!-- <title>TutorKami.com - <?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_title : '';?></title>
      <meta name="description" content="<?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_description : '';?>" />
      <meta name="keywords" content="<?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_keyword : '';?>" />
      -->
	  <title><?PHP echo $seoPageTitle; ?></title>
	  <meta name="description" content="<?PHP echo $seoPageDescription; ?>" />
	  <meta name="keywords" content="<?PHP echo $seoPageKeywords; ?>" />
	  <!-- add icon link -->
	  <!--<link rel="icon" href="https://www.tutorkami.com/images/apple-icon-180x180.png" type="image/x-icon"> -->

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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-42467282-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-42467282-1');
</script>

      
       <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
       <?php $arrSet = system::FireCurl(GET_SETTINGS.'?set=GOOGLE_ANALYTICS');
        foreach($arrSet->data as $set){
         echo $set->ss_settings_value;
        } 
       ?>
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
      <!--<script async src="js/jquery-ui.js"></script>-->
	  <script src="js/owl.carousel.js"></script>
	  <script async src="js/velocity.min.js"></script>
      <script src="js/enhance.js"></script>
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
          $('.owl-stage-outer').owlCarousel({
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
          });

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

.shadow {
  box-shadow: 0px 15px 10px -15px #111;  
}
*/
.custom-nav{
    border: none;
    border-radius: 0;
    -webkit-box-shadow: 10px 20px 20px rgba(0, 0, 0, 0.3);  
    -moz-box-shadow:    20px 20px 20px rgba(0, 0, 0, 0.3);  
    box-shadow:         20px 20px 20px rgba(0, 0, 0, 0.3);  
    z-index:999;
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
        <link rel="shortcut icon" href="https://www.tutorkami.com/favicon.ico">
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

    <nav class="navbar navbar-default navbar-fixed-top <?php echo (basename($_SERVER['PHP_SELF']) == 'tutor-login.php' || basename($_SERVER['PHP_SELF']) == 'client_login.php' || basename($_SERVER['PHP_SELF']) == 'forgot_password.php') ? 'hidden' : '' ;?>">
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

if (isset($_SESSION['auth'])) {
    $thisUserID = $_SESSION['auth']['user_id'];
}else{
    $thisUserID = '';
}

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

	$dropdownClick = 0;

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
								$dropdownClick = 1;
							}else if($dateFormat2 < $dateFormat){
                                //echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
							}else if($dateFormat2 = $dateFormat){
								if($timeSaveTerms >= $getTime){
                                    echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
									$dropdownClick = 1;
								}else{
									
								}
							}else{
							    echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
								$dropdownClick = 1;
							}                    
						}
                }
        }
	}



	//if( $thisUserID == '1579981'){
		if( $dropdownClick == 0 ){
			if( $getFullURL != '/edit_account.php' ){
				$queryCurrentlyStaying = " SELECT * FROM tk_user_details WHERE ud_u_id ='".$thisUserID."' "; 
				$resultCurrentlyStaying = $conn->query($queryCurrentlyStaying); 
				if($resultCurrentlyStaying->num_rows > 0){ 
					$rowCurrentlyStaying = $resultCurrentlyStaying->fetch_assoc();
					$CurrentlyStaying = $rowCurrentlyStaying['ud_city'];
					
						if( $CurrentlyStaying == NULL || $CurrentlyStaying == '' ){
							
							echo "<script>$(document).ready(function(){ $('#myModalPopUpCurrentlyStaying').modal('show'); });</script>";
						}
					
				}
			}			
		}
	//}
	
	
	
	
}

$salutation = '';
if($_SESSION['auth']['user_role'] == '4') { 

	$dropdownClickClient = 0;

	$queryUserClient = $conn->query(" SELECT * FROM tk_user WHERE u_id='$thisUserID' ");
	$resUserClient = $queryUserClient->num_rows;
	if($resUserClient > 0){
        $rowUserClient = $queryUserClient->fetch_assoc();
        
        $tutorDisplayIDClient = $rowUserClient['u_displayid'];
        
    	$DetailsClient = $conn->query(" SELECT ud_u_id, salutation FROM tk_user_details WHERE ud_u_id = '".$rowUserClient['u_id']."' ");
    	$resDetailsClient = $DetailsClient->num_rows;
    	if($resDetailsClient > 0){
    	    $rowDetailsClient = $DetailsClient->fetch_assoc();
    	    $salutation = $rowDetailsClient['salutation'];
    	}
        
        if ( $rowUserClient['signature_img'] != '' ) {
 
    		$getSigClient = strtok($rowUserClient['signature_img'], '_');
    		$getSigClient = str_replace('-', '/', $getSigClient);
    		$dateConvertClient = strtotime($getSigClient); 
    		//$dateFormat = date('Y-m-d', $dateConvert);  //signature_img
    		
    		$bClient = explode('/',$getSigClient);
    		$dateFormatClient = (int)($bClient[2].$bClient[1].$bClient[0]);
    		
            $getTimeClient = getBetween($rowUserClient['signature_img'],"_","_");
			if(strlen($getTimeClient) == '7'){
				$getTimeClient = str_replace("-",":",substr($getTimeClient, 0, -2)).':00';
			}else{
				$getTimeClient = str_replace("-",":",$getTimeClient).':00';
			}
			
    		
                $queryProof1Client = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='78' AND pmt_noti='TRUE' "; 
                $resultProof1Client = $conn->query($queryProof1Client); 
                if($resultProof1Client->num_rows > 0){ 
						
						$rowProof1Client = $resultProof1Client->fetch_assoc();
						$dateLastupdated2Client = $rowProof1Client['pmt_lastupdated'];
						$timeSaveTermsClient = $rowProof1Client['pmt_time'];
			
						$dateConvert2Client = strtotime($dateLastupdated2Client); 
					
						$aClient = explode('/',$rowProof1Client['pmt_lastupdated']);
						$dateFormat2Client = (int)($aClient[2].$aClient[1].$aClient[0]);
					
						$queryProof1Client = " SELECT * FROM tk_term_popup WHERE tp_id ='".$thisUserID."' "; 
						$resultProof1Client = $conn->query($queryProof1Client); 
						if($resultProof1Client->num_rows > 0){ 
						}else{
							if($dateFormat2Client > $dateFormatClient){
						        echo "<script>$(document).ready(function(){ $('#myModalPopUp2').modal('show'); });</script>";
								$dropdownClickClient = 1;
							}else if($dateFormat2Client < $dateFormatClient){
							}else if($dateFormat2Client = $dateFormatClient){
								if($timeSaveTermsClient >= $getTimeClient){
                                    echo "<script>$(document).ready(function(){ $('#myModalPopUp2').modal('show'); });</script>";
									$dropdownClickClient = 1;
								}else{
									
								}
							}else{
							    echo "<script>$(document).ready(function(){ $('#myModalPopUp2').modal('show'); });</script>";
								$dropdownClickClient = 1;
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
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"  onclick = "threelayer()" >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php $arrLogo = system::FireCurl(GET_SETTINGS.'?set=COMPANY_LOGO');
          foreach($arrLogo->data as $logo){ ?>
          <!--<a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="admin/upload/<?php echo $logo->ss_settings_value;?>" class="img-responsive" alt=""/></a>-->
		  <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/<?php echo $logo->ss_settings_value;?>" class="pull-left img-responsive" alt="<?PHP echo $seoPageTitle; ?>"/></a>
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
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/my/tutor-login.php">Log Masuk Tutor</a></li>
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
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/client_login">Log In</a></li>
								
								
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
                        <!--<li class="dropdown">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" >
                           <?php $arrLan = system::FireCurl(CHOOSEN_LANG.'?lan='.$_SESSION['lang_code']);foreach($arrLan->data as $lan){
                                  ?>
                           <img id="imgNavSel" src="admin/<?=$lan->lang_flag?>" alt="Grossbritanien" class="img-thumbnail icon-small"><span class="caret"></span>
                           <?php }?></a>
                            
                           <ul class="dropdown-menu" role="menu" >
                             <?php 
                              // Get How it works
                              
                              $arrLangs = system::FireCurl(LIST_LANGUAGES);
                              
                              foreach($arrLangs->data as $lang){
                                  if ($lang->lang_status == 'default') {
                                     $lg = '';
                                  } else {
                                    $lg = $lang->lang_code;
                                  }
                              ?>
                              <li>
                                 <a id="navEng" href="<?=basename($_SERVER['PHP_SELF']).'?lan='.$lg?>" class="language"><img id="imgNavEng" src="admin/<?=$lang->lang_flag?>" alt="..." class="img-thumbnail icon-small">  <span id="lanNavEng"><?=$lang->lang_name?></span></a>
                                 <?PHP
								 if($lg == 'BM'){
									 ?>
									 <a id="navEng" href="https://www.tutorkami.com/my<? echo $_SERVER['PHP_SELF'].'?lan='.$lg?>" class="language"><img id="imgNavEng" src="admin/<?=$lang->lang_flag?>" alt="..." class="img-thumbnail icon-small">  <span id="lanNavEng"><?=$lang->lang_name?></span></a>
									 <?PHP
								 }else{
									 ?>
									 <a id="navEng" href="<?=basename($_SERVER['PHP_SELF']).'?lan='.$lg?>" class="language"><img id="imgNavEng" src="admin/<?=$lang->lang_flag?>" alt="..." class="img-thumbnail icon-small">  <span id="lanNavEng"><?=$lang->lang_name?></span></a>
									 <?PHP
								 }
								 ?>
							  </li>
                              <?php } ?>
                              
                           </ul>
                        </li>-->
						
						
						
						
						
						
                       <?php } else { ?>
                        <?php if($_SESSION['auth']['user_role'] == '4') { ?>
                        <li class="dropdown text-right" id="shadow">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle text-right" href="#">
                           <?php //echo WELCOME; ?> <?php echo $salutation.' '.ucwords($_SESSION['auth']['first_name']); ?> <?php //echo ucwords($_SESSION['auth']['last_name']); ?> <span id="showParentMenu" class="caret"></span></a>
                           <ul class="dropdown-menu text-right
                           <?PHP 
                           if(!isset($_SESSION['getPage'])){
                               //echo 'stay-open';
                           }
                           ?>
                           " role="menu">
<!--
                              <li class="sizedcreenli"><a href="clients_profile.php" class="language"><?php echo MY_PROFILE; ?></a></li>
                              <li class="sizedcreenli"><a href="list_of_classes.php" class="language"><?php if($getLan == "/my/"){echo 'Maklumat';}else{echo 'Details';} ?></a></li>
                              hide <li class="sizedcreenli"><a href="payment_history.php" class="language"><?php echo PAYMENT_HISTORY; ?></a></li> hide
                              <li class="sizedcreenli"><a href="parent_guide.php" class="language"><?php echo PARENT_GUIDE; ?></a></li>
-->
<?php 
if($getLan == "/my/"){
?>
    <li class="sizedcreenli"><a href="https://www.tutorkami.com/clients_profile.php" class="language"><?php echo 'Akaun Saya'; ?></a></li>
    <li class="sizedcreenli"><a href="https://www.tutorkami.com/list_of_classes.php" class="language">Maklumat</a></li>
    <li class="sizedcreenli"><a href="https://www.tutorkami.com/parent_guide.php" class="language"><?php echo PARENT_GUIDE; ?></a></li>
<?PHP
}else{
 ?>
    <li class="sizedcreenli"><a href="https://www.tutorkami.com/clients_profile.php" class="language"><?php echo 'My Profile'; ?></a></li>
    <li class="sizedcreenli"><a href="https://www.tutorkami.com/list_of_classes.php" class="language">Details</a></li>
    <li class="sizedcreenli"><a href="https://www.tutorkami.com/parent_guide.php" class="language"><?php echo PARENT_GUIDE; ?></a></li>
<?PHP   
}
?>
                              
							  <?PHP
							  $queryUserClientStatus = $conn->query(" SELECT * FROM tk_user_details WHERE ud_u_id='$thisUserID' ");
							  $resUserClientStatus = $queryUserClientStatus->num_rows;
							  if($resUserClientStatus > 0){
									$rowUserClientStatus = $queryUserClientStatus->fetch_assoc();
									if( $rowUserClientStatus['ud_client_status_2'] != NULL && $rowUserClientStatus['ud_client_status_2'] == 'Tuition Centre'){
										?><li class="sizedcreenli"><a href="tuition-center-terms.php" class="language"><?php if($getLan == "/my/"){echo 'Terma';}else{echo 'Terms';} ?></a></li><?PHP
									}else{
										?><li class="sizedcreenli"><a href="clients-terms.php" class="language"><?php if($getLan == "/my/"){echo 'Terma';}else{echo 'Terms';} ?></a></li><?PHP
									}
							  }
							  ?>
							  
							  
							  
							  <li class="sizedcreenli"><a href="logout.php" class="language"><?php echo LOGOUT; ?></a></li>
                           </ul>
                        </li>
                        <?php } else { ?>
                        <li class="dropdown text-right" id="shadow">
                           <a id="caretthis" role="button" data-toggle="dropdown" class="dropdown-toggle text-right" href="#">
                           <?php echo WELCOME; ?> <?php echo ucwords($_SESSION['auth']['display_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu text-right
                           <?PHP 
                           if(!isset($_SESSION['getPage'])){
                               //echo 'stay-open';
                           }
                           ?>
                           " role="menu"> <!-- show/stay-open  -->
                              <li class="sizedcreenli"><a href="edit_account.php" class="language"><?php echo EDIT_ACCOUNT; ?></a></li>
                              <!--<li class="sizedcreenli"><a href="change_password.php" class="language"><?php echo CHANGE_PASSWORD; ?></a></li>-->
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
							  <li class="sizedcreenli"><a href="payments-tutor.php" class="language"><?php echo "Payments"; ?></a></li>
							  
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
          <strong>FRIENDLY UPDATE : </strong> The Terms of Accepting Tuition Job has been revised. Please read the terms again, the ones in red fonts are the amendments made. If you agree with the terms, please re-sign in the space at the bottom.
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
  
<style>
.autocompleteCurr {
  position: relative;
  display: inline-block;
}

.autocompleteCurr-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocompleteCurr-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

.autocompleteCurr-items div:hover {
  background-color: #e9e9e9; 
}
.autocompleteCurr-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
    <div id="myModalPopUpCurrentlyStaying" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-body" style="background-color:#f1592a;">
          <font style="color:white;">
            Friendly Notice: Your profile needs to be updated, please update your profile. Thank you.
            <center><button type="button" class="btn btn-primary btn-xs buttonCurrentlyStaying"> OK </button></center>
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
    //$("#shadow").addClass("shadow");
	$("#navbar").addClass("custom-nav");

<?PHP
}




?>
        $(".navbar-toggle").click(function() {
            setTimeout(function(){ 
                $("#caretthis").click(); 
                //$("#shadow").addClass("shadow");
				$("#navbar").addClass("custom-nav");
            }, 500);
        });  
<?PHP
  



}else{
        ?>
		$("#navbar").addClass("custom-nav");
        <?php
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
$('.buttonCurrentlyStaying').click(function(){
    window.location.href = "https://www.tutorkami.com/edit_account";
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
$('.buttondontShow2').click(function(){
    var value = document.getElementById("idpopup").value;
    $.ajax({
        type: "POST",
        url: "ajax-close-popup.php",
        dataType: "json",
        data: {value:value},
        success : function(data){
                if (data.code == "200"){
                    var element = document.getElementById("myModalPopUp2");
                    element.classList.add("hidden");
                    $('#myModalPopUp2').modal('hide');
                } else {
                    alert(data.msg);
                }
            
        }
    });
}) 


function autocompleteCurr(inp, arr) {
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
      a.setAttribute("id", this.id + "autocompleteCurr-list");
      a.setAttribute("class", "autocompleteCurr-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
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
      var x = document.getElementById(this.id + "autocompleteCurr-list");
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
        if (currentFocus > -1) {
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
    x[currentFocus].classList.add("autocompleteCurr-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocompleteCurr-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocompleteCurr-items");
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

/*An array containing all the country names in the world:*/
	<?php
		$connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
		$sqlL = "SELECT tc.city_id, tc.city_name, st.st_name
				FROM tk_cities tc
				LEFT JOIN tk_states st
				ON st.st_id = tc.city_st_id
				WHERE tc.city_status = '1'";
				
		$subjectid = array();
		$locationid = array();
	?>
	var cityStaying = 	[
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
					
					
/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocompleteCurr(document.getElementById("textModalPopUpCurrentlyStaying"), cityStaying);

function threelayer() {  
    setTimeout(function() { 
        $("#showParentMenu").click();
    }, 800);
}  
</script>