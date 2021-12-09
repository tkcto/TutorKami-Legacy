<?php require_once('includes/head.php'); ?><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <link rel="alternate" hreflang="ms" href="https://www.tutorkami.com/my/tutor_profile?did=1038663" />
      
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
      <?php $seoArr = system::FireCurl(GET_SEO_CONTENT_URL.'?current_page='.basename($_SERVER['PHP_SELF']).'&lang_code='.$_SESSION['lang_code']); ?>
      <!-- <title>TutorKami.com - <?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_title : '';?></title>
      <meta name="description" content="<?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_description : '';?>" />
      <meta name="keywords" content="<?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_keyword : '';?>" />
      -->
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
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <!--<link rel="stylesheet" href="css/owl.carousel.min.css">-->
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
      <script async src="js/jquery-ui.js"></script>
	  <!--<script src="js/owl.carousel.js"></script>-->
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
    <link rel="stylesheet" href="files/viewbox-master/viewbox.css">
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

    <nav class="navbar navbar-default navbar-fixed-top <?php echo (basename($_SERVER['PHP_SELF']) == 'tutor-login.php' || basename($_SERVER['PHP_SELF']) == 'parent_login.php' || basename($_SERVER['PHP_SELF']) == 'forget.php') ? 'hidden' : '' ;?>">
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
                        <input type="hidden" id="idpopup" value="<?PHP echo $_SESSION['auth']['user_id']; ?>">
                        <?php } ?>
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
<?php 
//require_once('includes/header.php');
$user_id = isset($_GET['uid']) ? $_GET['uid'] : '';
$display_id = isset($_GET['did']) ? $_GET['did'] : '';


if ($display_id != '') {
  $getUserDetails = system::FireCurl(USER_LISTING_URL.'?display_id='.$display_id);
} else {
  $getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);//PAGE AKAN LOAD YG NI TAU.
}

$user_id = isset($user_id) ? $getUserDetails->data[0]->u_id : $user_id;
?>


<script src="js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
      $.extend({
    getUrlVars: function(){
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++){
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    },
    getUrlVar: function(name){
      return $.getUrlVars()[name];
    }
  });

  $userid = $.getUrlVar('uid');
  $displayid = $.getUrlVar('did');
  
	loadprofile($userid);
    loadid($userid);
    loadArea($userid);
  });
  
  function loadprofile($userid){
    var userid = $userid;
    var displayid = $displayid;
    if(userid != '' || displayid != ''){
      $.ajax({
        method:"POST",
        url:"fetch_tutor_profile.php",
        dataType:"json",
        data:{
          data: {
            userid:userid,
            displayid:displayid,
          },
        },
        success:function(response){
             console.log(response);

             var len = response.length;
            for(var i=0; i<len; i++){
                var tc_title = response[i].tc_title;
                var ts_title = response[i].ts_title;
                
                $("#subjecttaught").append("<strong class = 'org-txt text-capitalize'>" + tc_title + "</strong>" + ": " + ts_title + "<br>");
                
            }

             
        }
      });

    }
    return false;
  }

                
    if (window.location.href.indexOf("my") > -1) {
       var title = 'Profil Cikgu Tuisyen';
    }else{
       var title = 'PROFILE'; 
    }


  function loadid($userid){
    var userid = $userid;
    var displayid = $displayid;
    if(userid != ''){
      $.ajax({
        method:"POST",
        url:"fetch_tutor_profile.php",
        dataType:"json",
        data:{
          dataid: {
            userid:userid,
            displayid:displayid,
          },
        },
        success:function(response){
             console.log(response);
             
             var len = response.length;
            for(var i=0; i<len; i++){
                var u_displayid = response[i].u_displayid;
                var u_displayname = response[i].u_displayname;
                var u_profile_pic = response[i].u_profile_pic;

                
                $("#displayid").append("<h3 class='org-txt'><strong>" + title + " - " + u_displayname + "</strong></h3>");
                $("#displayidcenter").append("<h3 class='org-txt'><strong>" + title + " - " + u_displayname + "</strong></h3>");
                $("#displayidmobile").append("<h3 class='org-txt'><strong>" + u_displayname + " (ID : " + u_displayid + ")</strong></h3>");
                
				$("#displayidimage").append("<h4 class='org-txt'><strong>" + u_displayname + " (ID : " + u_displayid + ")</strong></h4>");
                $("#displayprofilepic").append('<img src="' + u_profile_pic + '" alt="profile_pic" class="img-thumbnail" />');
            }
        }
      });

    }
    return false;
  }
  
  

  function loadArea($userid){
    var userid = $userid;
    var displayid = $displayid;
    if(userid != '' || displayid != ''){
      $.ajax({
        method:"POST",
        url:"fetch_tutor_profile.php",
        dataType:"json",
        data:{
          dataArea: {
            userid:userid,
            displayid:displayid,
          },
        },
        success:function(response){
             console.log(response);

             var len = response.length;
			 var title = [];
            for(var i=0; i<len; i++){
                var st_name = response[i].st_name;
                var city_name = response[i].city_name;
                $("#loadArea").append("<strong class = 'org-txt text-capitalize'>" + st_name + "</strong>" + ": " + city_name + "<br><br>");
   
            }
			
             
        }
      });

    }
    return false;
  }
  
</script>

<?php if($getUserDetails->data[0]->u_status == 'A') { ?>

<section class="profile">
 <div class="main-body">
    <div class="container">
       <h1 class="text-center text-uppercase blue-txt"><?php echo TUTOR_PROFILE; ?></h1>
       <div class="col-md-10 col-md-offset-1 ">
          <hr>
          <div class="row">
             <div class="col-md-8 col-sm-10">
              <center><img style="margin-bottom:-5px;" class="hidden-lg hidden-md" src="<?php 

                $pix = sprintf("%'.07d\n", $getUserDetails->data[0]->u_profile_pic);
                  if ($getUserDetails->data[0]->u_profile_pic != '') {
                    //echo APP_ROOT."images/profile/".$pix."_0.jpg";
                    if ( is_numeric($getUserDetails->data[0]->u_profile_pic) ) {
						echo APP_ROOT."images/profile/".$pix."_0.jpg";
                    }else{
						$pic = $getUserDetails->data[0]->u_profile_pic;
						echo APP_ROOT."images/profile/".$pic.".jpg";
                    }
                  } elseif ($getUserDetails->data[0]->u_gender == 'M') {
                    echo APP_ROOT."images/tutor_ma.png";
                  } else {
                    echo APP_ROOT."images/tutor_mi1.png";
                  }                  
                ?>" alt="profile_pic" class="img-thumbnail"></center>
                <div class="hidden-sm hidden-xs" id="displayid"></div> 
                <center><div class="hidden-lg hidden-md" id="displayidcenter"></div></center>
				<br>
                <strong><?php echo HOME_TUTOR_ID; ?> : <?php echo $getUserDetails->data[0]->u_displayid; ?></strong>
                <br><br>
				<strong><?php echo NAME; ?> :</strong> <?php echo $getUserDetails->data[0]->u_displayname; ?> <br>
				<br>
				<strong><?php echo AGE; ?> :</strong> <?php echo system::CalculateAge($getUserDetails->data[0]->ud_dob); ?> <br>
				<br>
				<strong><?php echo GENDER; ?> :</strong> <?php echo ($getUserDetails->data[0]->u_gender == 'M') ? 'Male' : 'Female'; ?> <br>
				<br>
				<strong><?php echo RACE; ?> :</strong> <?php echo ($getUserDetails->data[0]->ud_race != '' && $getUserDetails->data[0]->ud_race != 'Not selected') ? ''.$getUserDetails->data[0]->ud_race : ''; ?> <br>
				<br>
                <!--<strong><?php echo system::CalculateAge($getUserDetails->data[0]->ud_dob); ?> <?php echo YEARS_OLD; ?>, <?php echo ($getUserDetails->data[0]->u_gender == 'M') ? 'Male' : 'Female'; ?><?php echo ($getUserDetails->data[0]->ud_race != '' && $getUserDetails->data[0]->ud_race != 'Not selected') ? ', '.$getUserDetails->data[0]->ud_race : ''; ?> </strong><br>
                
				<?php //echo $getUserDetails->data[0]->ud_qualification; ?> <br>
                <br>-->
                <strong><?php echo TUTOR_STATUS; ?> :</strong> <?php echo $getUserDetails->data[0]->ud_tutor_status; ?> <br>
                <br>
                <strong><?php echo OCCUPATION; ?> :</strong> <?php echo $getUserDetails->data[0]->ud_current_occupation == 'Other' ? $getUserDetails->data[0]->ud_current_occupation_other : $getUserDetails->data[0]->ud_current_occupation; ?> <br>
                <br>
                <!--<strong><?php //echo CURRENT_COMPANY; ?> :</strong> <?php //echo $getUserDetails->data[0]->ud_company_name; ?> <br>
                <br>-->

                <strong><?php echo AREAS_COVERED_FOR_HOME_TUITION; ?> :</strong> <br>
                <div id="loadArea"></div>

                <div class="text-capitalize"> <strong><?php echo SUBJECTS_TAUGHT; ?>: </strong> <br>
                  <div id="subjecttaught"></div>
                </div><br>
				<strong><?php echo SEARCH_TUTOR_QUALIFICATION; ?> :</strong> <?php echo $getUserDetails->data[0]->ud_qualification; ?> <br>
				<br>
				
                <!--<strong><?php //echo EXPERIENCE; ?>:</strong> <?php //echo ($getUserDetails->data[0]->ud_tutor_experience != '') ? $getUserDetails->data[0]->ud_tutor_experience.' '.YEARS : ''; ?> <br>-->
                <strong><?php echo EXPERIENCE; ?>:</strong> 
                <?php 
                    if($getUserDetails->data[0]->ud_tutor_experience != ''){
                        echo $getUserDetails->data[0]->ud_tutor_experience;
                    }
                    if($getUserDetails->data[0]->ud_tutor_experience_month != ''){
                        echo ' '.$getUserDetails->data[0]->ud_tutor_experience_month.'(s)';
                    }
                ?> 
                <br>
                <br>
<?PHP
$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
if($getLan == "/my/"){	
	$condOnline = 'Boleh buat tuisyen online';
	$timeSlot = 'Slot Kosong';
}else{
	$condOnline = 'Can conduct online tuition';
	$timeSlot = 'Time Slots';
}
?>
                <strong><?php echo $condOnline; ?>:</strong> 
                <?php echo $getUserDetails->data[0]->conduct_online; if( $getUserDetails->data[0]->conduct_online_text != '' ){ echo '. '.$getUserDetails->data[0]->conduct_online_text;} ?>  
                
                
                <br>
                <br>
                <strong><?php echo WILL_TEACH_AT_TUITION_CENTER; ?>:</strong> <?php 
                $tution_center = ($getUserDetails->data[0]->ud_client_status == 'Tuition Centre')? 'Yes':'No';
                echo $tution_center; ?> <br>
                <br>



                <div> </div>

             </div>

                
             <div class="hidden-sm hidden-xs col-md-4 text-center">
              <img src="<?php 

                $pix = sprintf("%'.07d\n", $getUserDetails->data[0]->u_profile_pic);

                  if ($getUserDetails->data[0]->u_profile_pic != '') {
                    //echo APP_ROOT."images/profile/".$pix."_0.jpg";
                    if ( is_numeric($getUserDetails->data[0]->u_profile_pic) ) {
						echo APP_ROOT."images/profile/".$pix."_0.jpg";
                    }else{
						$pic = $getUserDetails->data[0]->u_profile_pic;
						echo APP_ROOT."images/profile/".$pic.".jpg";
                    }
                  } elseif ($getUserDetails->data[0]->u_gender == 'M') {
                    echo APP_ROOT."images/tutor_ma.png";
                  } else {
                    echo APP_ROOT."images/tutor_mi1.png";
                  }                  
                ?>" alt="profile_pic" class="img-thumbnail">

                <div id="displayidimage"></div>
				<!--<div id="displayidimage"></div>-->
                <a href="request_a_tutor.php?tutor_id=<?php echo $getUserDetails->data[0]->u_displayid; ?>" class="org-button btn-block"><?php echo BUTTON_CHOOSE_THIS_TUTOR; ?></a>
                <p class="text-center"><?php echo CANNOT_FIND_A_SUITABLE_TUTOR; ?><br><?php echo CLICK_THE_BUTTON_BELOW; ?> </p>
                <a style="margin-left:-1px;" href="request_a_tutor.php" class="green-button btn-block"><?php echo REQUEST_A_TUTOR; ?></a>
                <br/>
                <?PHP 
                    $conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    
                    $timeTable1 = " SELECT date FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC ";
                    $resulttimeTable1 = $conn->query($timeTable1);
                    if ($resulttimeTable1->num_rows > 0) {
                        $rowtimeTable1 = $resulttimeTable1->fetch_assoc();
                        
                        $newDateTimeTable = date("d-m-Y", strtotime($rowtimeTable1['date']));
                        $arr = explode('-', $newDateTimeTable);
                        $monthName = date("F", mktime(0, 0, 0, $arr[1], 10));
                        $dateTimeTable = $arr[0].' '.$monthName.', '.$arr[2];

                        echo '
                        <p class="text-left"><strong>Available Schedule :</strong></p>
                        <p class="text-left" style="font-size:15px;">* Last updated: '.$dateTimeTable.'</p>
                        ';
                    }
                    
                    
                    $timeTable = " SELECT * FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC ";
                    $resulttimeTable = $conn->query($timeTable);
                    if ($resulttimeTable->num_rows > 0) {
                        while($rowtimeTable = $resulttimeTable->fetch_assoc()){
                            
                            echo ' 
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" value="'.$rowtimeTable['tt_day'].'" style="text-align: center;border-color: red;">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" value="'.$rowtimeTable['tt_time'].'" style="border-color: red;">
                                    </div>
                                </div>
                            ';
                            
                            
                            
                        }
                    }
                ?>
             </div>

          </div>
          <hr>
          
          
          <!-- <div class="hidden-lg hidden-md">-->
<?PHP
                    /*$timeTable1Mobile = " SELECT date FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC ";
                    $resulttimeTable1Mobile = $conn->query($timeTable1Mobile);
                    if ($resulttimeTable1Mobile->num_rows > 0) {
                        $rowtimeTable1Mobile = $resulttimeTable1Mobile->fetch_assoc();
                        
                            $newDateTimeTableMobile = date("d-m-Y", strtotime($rowtimeTable1Mobile['date']));
                            $arrMobile = explode('-', $newDateTimeTableMobile);
                            $monthNameMobile = date("F", mktime(0, 0, 0, $arrMobile[1], 10));
                            $dateTimeTableMobile = $arrMobile[0].' '.$monthNameMobile.', '.$arrMobile[2];
                                echo '
                                <p class="text-left"><strong>Available Schedule :</strong></p>
                                <p class="text-left" style="font-size:15px;">* Last updated: '.$dateTimeTableMobile.'</p>
                                ';
                    }
                    
                    $timeTableMobile = " SELECT * FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC ";
                    $resulttimeTableMobile = $conn->query($timeTableMobile);
                    if ($resulttimeTableMobile->num_rows > 0) {
                        while($rowtimeTableMobile = $resulttimeTableMobile->fetch_assoc()){
                            echo ' 
                                <div class="row">
                                    <div class="form-group col-xs-4">
                                        <input type="text" class="form-control" value="'.$rowtimeTableMobile['tt_day'].'" style="text-align: center;border-color: red;">
                                    </div>
                                    <div class="form-group col-xs-8">
                                        <input type="text" class="form-control" value="'.$rowtimeTableMobile['tt_time'].'" style="border-color: red;">
                                    </div>
                                </div>
                            ';
                        }
                    }*/
?>
          <!-- </div> -->
                
                
                
                
                
                
                
          <br>

<style>

.responsive-tabs-container .tab-content {

}

.responsive-tabs-container[class*="accordion-"] .tab-pane {
  margin-bottom: 15px;
}

.responsive-tabs-container[class*="accordion-"] .accordion-link {
  display: none;
  margin-bottom: 10px;
  padding: 10px 15px;
  background-color: #f5f5f5;
  border-radius: 3px;
  border: 1px solid #ddd;
  color: #333;
}

.responsive-tabs-container[class*="accordion-"] .accordion-link.active {
    border-bottom: medium none;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    color: #ff6600;
}

@media (max-width: 767px) {
  .responsive-tabs-container.accordion-xs .nav-tabs {
    display: none;
  }
  
  .responsive-tabs-container.accordion-xs .accordion-link {
    display: block;
  }
  
  .responsive-tabs-container[class*="accordion-"] .tab-pane {
    border:1px solid #ddd;
    border-top:none;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-width: medium 1px 1px;
    margin-bottom: 10px;
    margin-top: -10px;
    padding: 10px 10px 0;
 }
}

@media (min-width: 768px) and (max-width: 991px) {
  .responsive-tabs-container.accordion-sm .nav-tabs {
    display: none;
  }
  
  .responsive-tabs-container.accordion-sm .accordion-link {
    display: block;
  }
  
  .responsive-tabs-container[class*="accordion-"] .tab-pane {
    border:1px solid #ddd;
    border-top:none;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-width: medium 1px 1px;
    margin-bottom: 10px;
    margin-top: -10px;
    padding: 10px 10px 0;
 }
}

@media (min-width: 992px) and (max-width: 1199px) {
  .responsive-tabs-container.accordion-md .nav-tabs {
    display: none;
  }
  
  .responsive-tabs-container.accordion-md .accordion-link {
    display: block;
  }
}

@media (min-width: 1200px) {
  .responsive-tabs-container.accordion-lg .nav-tabs {
    display: none;
  }
  
  .responsive-tabs-container.accordion-lg .accordion-link {
    display: block;
  }
}
/* http://openam.github.io/bootstrap-responsive-tabs/ */
</style>


<?PHP
if($getUserDetails->data[0]->url_video != ''){
    $videoBgColor = ' style="background-color:#f1592a;color:white" ';
}else{
    $videoBgColor = '';
}
?>
    							  <ul class="nav nav-tabs responsive-tabs">
									<li class="active"><a href="#home"><?php echo ABOUT_MYSELF; ?></a></li>
									<li><a href="#testimonials"><?php echo TESTIMONIALS; ?></a></li>
									<li><a href="#reviews"><?php echo REVIEWS; ?></a></li>
									<li><a href="#schedule"><?php echo $timeSlot; ?></a></li>
									<li><a href="#video" <?PHP echo $videoBgColor;?> ><?php echo VIDEO; ?></a></li>
								  </ul>

								  <div class="tab-content">
									<div class="tab-pane active" id="home">
									  <textarea class="form-control" rows="10"><?php echo $getUserDetails->data[0]->ud_about_yourself; ?></textarea>
									</div>

									<div class="tab-pane" id="testimonials">
                <em><?php echo CLICK_IMAGE_TO_ENLARGE; ?></em><i class="fa fa-plus plus" aria-hidden="true"></i> <br>
                <!--<ul class="whatsapp">
                   <?php 
                    /*$getTestimonial = system::FireCurl(USER_TESTIMONIAL."?uid=".$user_id);
                    if ($getTestimonial->flag == 'success' && count($getTestimonial->data) > 0) {
                      $i = 0;
                      foreach ($getTestimonial->data as $key => $testimonial) {
                   ?>
                   <?php if ($testimonial->ut_user_testimonial1 != '') { ?>
                   <li><img src="<?php //echo $testimonial->ut_user_testimonial1; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                   <?php } ?>
                   <?php if ($testimonial->ut_user_testimonial2 != '') { ?>
                   <li><img src="<?php //echo $testimonial->ut_user_testimonial2; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                   <?php } ?>
                   <?php if ($testimonial->ut_user_testimonial3 != '') { ?>
                   <li><img src="<?php //echo $testimonial->ut_user_testimonial3; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                   <?php } ?>
                   <?php if ($testimonial->ut_user_testimonial4 != '') { ?>
                   <li><img src="<?php //echo $testimonial->ut_user_testimonial4; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                   <?php } 
                      }
                    }*/
                   ?>

                </ul>-->
                   <?php 
                    $getTestimonial = system::FireCurl(USER_TESTIMONIAL."?uid=".$user_id);
                    if ($getTestimonial->flag == 'success' && count($getTestimonial->data) > 0) {
                      $i = 0;
                      foreach ($getTestimonial->data as $key => $testimonial) {
                   ?>
                   <?php if ($testimonial->ut_user_testimonial1 != '') { ?>

    					<a href="<?php echo $testimonial->ut_user_testimonial1; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">
    						<img src="<?php echo $testimonial->ut_user_testimonial1; ?>" alt="testimonial" class="cropped" style="width: 23.33%;">
    					</a>

                   <?php } ?>
                   <?php if ($testimonial->ut_user_testimonial2 != '') { ?>

    					<a href="<?php echo $testimonial->ut_user_testimonial2; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">
    						<img src="<?php echo $testimonial->ut_user_testimonial2; ?>" alt="testimonial" class="cropped" style="width: 23.33%;"  >
    					</a>

                   <?php } ?>
                   <?php if ($testimonial->ut_user_testimonial3 != '') { ?>

    					<a href="<?php echo $testimonial->ut_user_testimonial3; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">
    						<img src="<?php echo $testimonial->ut_user_testimonial3; ?>" alt="testimonial" class="cropped" style="width: 23.33%;" >
    					</a>

                   <?php } ?>
                   <?php if ($testimonial->ut_user_testimonial4 != '') { ?>

    					<a href="<?php echo $testimonial->ut_user_testimonial4; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">
    						<img src="<?php echo $testimonial->ut_user_testimonial4; ?>" alt="testimonial" class="cropped" style="width: 23.33%;" >
    					</a>

                   <?php }   
                      }
                    }
                   ?>
                
                

                
                
									</div>

									<div class="tab-pane" id="reviews">
									  <p><?php include('includes/list_tutor_review.php');?></p>
									</div>
									<div class="tab-pane" id="schedule">
									    <p><font color="blue" size="3">Available Time Slots</font></p>
          <!-- <div class="hidden-lg hidden-md">-->
<?PHP
                    $timeTable1Mobile = " SELECT date FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC ";
                    $resulttimeTable1Mobile = $conn->query($timeTable1Mobile);
                    if ($resulttimeTable1Mobile->num_rows > 0) {
                        $rowtimeTable1Mobile = $resulttimeTable1Mobile->fetch_assoc();
                        
                            $newDateTimeTableMobile = date("d-m-Y", strtotime($rowtimeTable1Mobile['date']));
                            $arrMobile = explode('-', $newDateTimeTableMobile);
                            $monthNameMobile = date("F", mktime(0, 0, 0, $arrMobile[1], 10));
                            $dateTimeTableMobile = $arrMobile[0].' '.$monthNameMobile.', '.$arrMobile[2];
                                echo '
                                <p class="text-left"><strong>Available Schedule :</strong></p>
                                <p class="text-left" style="font-size:15px;">* Last updated: '.$dateTimeTableMobile.'</p>
                                ';
                    }
                    
                    $timeTableMobile = " SELECT * FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC ";
                    $resulttimeTableMobile = $conn->query($timeTableMobile);
                    if ($resulttimeTableMobile->num_rows > 0) {
                        while($rowtimeTableMobile = $resulttimeTableMobile->fetch_assoc()){
                            echo ' 
                                <div class="row">
                                    <div class="form-group col-xs-4">
                                        <input type="text" class="form-control" value="'.$rowtimeTableMobile['tt_day'].'" style="text-align: center;border-color: red;">
                                    </div>
                                    <div class="form-group col-xs-8">
                                        <input type="text" class="form-control" value="'.$rowtimeTableMobile['tt_time'].'" style="border-color: red;">
                                    </div>
                                </div>
                            ';
                        }
                    }
?>
          <!-- </div> -->
									</div>
								
									<div class="tab-pane" id="video">
<div class="embed-responsive embed-responsive-16by9">
<?PHP
function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$2\" allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>",
        $string
    );
}
echo convertYoutube($getUserDetails->data[0]->url_video);
?>	 
</div>
									</div>
								  </div>
								  
					


		  
		  
		  

             <div class="hidden-lg hidden-md col-md-4 text-center">
			 
                
				<div id="displayidmobile"></div>

                <a href="request_a_tutor.php?tutor_id=<?php echo $getUserDetails->data[0]->u_displayid; ?>" class="org-button btn-block"><?php echo BUTTON_CHOOSE_THIS_TUTOR; ?></a>

                <p class="text-center"><?php echo CANNOT_FIND_A_SUITABLE_TUTOR; ?><br><?php echo CLICK_THE_BUTTON_BELOW; ?> </p>

                <a style="margin-left:-1px;" href="request_a_tutor.php" class="green-button btn-block"><?php echo REQUEST_A_TUTOR; ?></a>

             </div>


       </div>

    </div>

 </div>

</section>

<?php } else { ?> 

<section class="parent_rating">

   <div class="container">

      <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-10">

        <h1 class="blue-txt"> <?php echo TUTOR_404_MESSAGE1; ?> </h1>

        <hr>

    <h3 class="org-txt martop"> <?php echo TUTOR_404_MESSAGE2; ?></h3>

    <p class="text-center martop"><?php echo TUTOR_404_MESSAGE3; ?></p>

    <br>

    <div class="col-md-4 col-md-offset-4 col-xs-offset-3">

      <a href="search_tutor.php" class="apply text-uppercase"><?php echo BUTTON_RETURN; ?></a>

    </div>

      </div>

   </div>

</section>

<?php } ?>

<?php //include('includes/footer.php');?>
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

                  <li><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="385b57564c595b4c784c4d4c574a53595551165b5755">[email&#160;protected]</a></li>

                  
               </ul>

            </div>

            <div class="col-md-2 col-sm-2">

               <h3>Site Navigation</h3>

               <ul class="nl">

                 
                  <li><a href="index.php"  class="" >Home</a></li>

                  
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
   <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
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

        

</div>

<script src="js/custom-file-input.js"></script>

<script>
// responsive tabs
! function($) {
    "use strict";
    var a = {
        accordionOn: ["xs"]
    };
    $.fn.responsiveTabs = function(e) {
        var t = $.extend({}, a, e),
            s = "";
        return $.each(t.accordionOn, function(a, e) {
            s += " accordion-" + e
        }), this.each(function() {
            var a = $(this),
                e = a.find("> li > a"),
                t = $(e.first().attr("href")).parent(".tab-content"),
                i = t.children(".tab-pane");
            a.add(t).wrapAll('<div class="responsive-tabs-container" />');
            var n = a.parent(".responsive-tabs-container");
            n.addClass(s), e.each(function(a) {
                var t = $(this),
                    s = t.attr("href"),
                    i = "",
                    n = "",
                    r = "";
                t.parent("li").hasClass("active") && (i = " active"), 0 === a && (n = " first"), a === e.length - 1 && (r = " last"), t.clone(!1).addClass("accordion-link" + i + n + r).insertBefore(s)
            });
            var r = t.children(".accordion-link");
            e.on("click", function(a) {
                a.preventDefault();
                var e = $(this),
                    s = e.parent("li"),
                    n = s.siblings("li"),
                    c = e.attr("href"),
                    l = t.children('a[href="' + c + '"]');
                s.hasClass("active") || (s.addClass("active"), n.removeClass("active"), i.removeClass("active"), $(c).addClass("active"), r.removeClass("active"), l.addClass("active"))
            }), r.on("click", function(t) {
                t.preventDefault();
                var s = $(this),
                    n = s.attr("href"),
                    c = a.find('li > a[href="' + n + '"]').parent("li");
                s.hasClass("active") || (r.removeClass("active"), s.addClass("active"), i.removeClass("active"), $(n).addClass("active"), e.parent("li").removeClass("active"), c.addClass("active"))
            })
        })
    }
}(jQuery);


$('.responsive-tabs').responsiveTabs({
	accordionOn: ['xs', 'sm'],
});

</script>

<script src="files/viewbox-master/jquery.viewbox.min.js"></script>
	<script>
/*
		$(function(){
			
			//$('.thumbnail-2').viewbox();
			$('.thumbnail-2').viewbox({fullscreenButton: true});

			(function(){
				var vb = $('.popup-link').viewbox();
				$('.popup-open-button').click(function(){
					vb.trigger('viewbox.open');
				});
				$('.close-button').click(function(){
					vb.trigger('viewbox.close');
				});
			})();
			
		});*/
	$('.thumbnail-2').viewbox({
	    fullscreenButton: true,
		setTitle: true,
		margin: 60,
		resizeDuration: 300,
		openDuration: 200,
		closeDuration: 200,
		closeButton: true,
		navButtons: true,
		closeOnSideClick: true,
		nextOnContentClick: true
	});
			(function(){
				var vb = $('.popup-link').viewbox();
				$('.popup-open-button').click(function(){
					vb.trigger('viewbox.open');
				});
				$('.close-button').click(function(){
					vb.trigger('viewbox.close');
				});
			})();
	</script>
</body>

</html>