<style>
.paging_simple_numbers a.paginate_button {
    color: #f1592a !important;
}
.paging_simple_numbers a.paginate_active {
    color: #f1592a !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding : 2px;
    margin-left: 2px;
    /*display: inline;*/
    border: 2px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    border: 2px;
}
</style>
<?php 
//require_once('includes/head.php');

session_start();
require_once('admin/classes/config.php.inc');
require_once('admin/classes/system.class.php');
$instSys = new system;
require_once('admin/classes/auth.class.php');
$instAuth = new auth;

require_once('admin/classes/flush.class.php');
require_once('api/core/Constant.php');
require_once('admin/classes/app.class.php');
$init  = new app;
$defaultLang = $init->DefaultLanguage();

$getLan = strtok($_SERVER["REQUEST_URI"],'?');
if($getLan == "/my/search_tutor2"){	
	$_SESSION['lang_code']= "BM";
}else{
	$_SESSION['lang_code']= "en";
}
/*if(isset($_GET['lan'])){
   $_SESSION['lang_code']= $_GET['lan'];
}else{
   if(!isset($_SESSION['lang_code'])) $_SESSION['lang_code'] = $defaultLang;
}*/
// Resources
$resArr = system::FireCurl(GET_RESOURCES_URL.'?lang_code='.$_SESSION['lang_code']);
if($resArr->flag == 'success') {
   foreach ($resArr->data as $value) {      
      define($value->rm_target_res, $value->rmt_resourcevalue);
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
      <?php $seoArr = system::FireCurl(GET_SEO_CONTENT_URL.'?current_page='.basename($_SERVER['PHP_SELF']).'&lang_code='.$_SESSION['lang_code']); ?>

	  <?PHP   
	  $getLanguange = strtok($_SERVER["REQUEST_URI"],'?');
	  if($getLanguange == "/my/search_tutor2"){	  
		//echo "BM ";
		
	  $contentDescription = "Kami bantu anda untuk ";
	  $contentTitle = "tutor dan cikgu tuisyen di ";
	  
	  if( isset($_GET['subject']) && $_GET['subject'] != ''){
		$seoSubject = $_GET['subject'].' ';
		$descriptionSubject = $_GET['subject'].' ';
	  }else{
		$seoSubject = "Bahasa melayu, bahasa inggeris ";
		$descriptionSubject = "Bahasa melayu, bahasa inggeris ";
	  }
	  
	  if( isset($_GET['level']) && $_GET['level'] != ''){
		if($_GET['level'] =="All"){
			$seoLevel = "Pre school, tahun 1-3, UPSR, PT3, SPM ";
			$descriptionLevel = "Pre school, tahun 1-3, UPSR, PT3, SPM ";
		}else{
			$seoLevel = $_GET['level'].' ';
			$descriptionLevel = $_GET['level'].' ';
		}
	  }else{
		$seoLevel = "Pre school, tahun 1-3, UPSR, PT3, SPM ";
		$descriptionLevel = "Pre school, tahun 1-3, UPSR, PT3, SPM ";
	  }
	  
	  

	  if( isset($_GET['area']) && $_GET['area'] != ''){
		$seoArea = "Tutor Persendirian untuk Tuisyen di Rumah di ".$_GET['area'].' ';
		//$descriptionArea = "tutor persendirian untuk tuisyen di rumah di ".$_GET['area'].' ';
		$descriptionArea = $_GET['area'].' ';
	  }else{
		if( isset($_GET['state']) && $_GET['state'] != ''){
			if($_GET['state'] =="All"){
				$seoArea = "Tutor Persendirian untuk Tuisyen di Rumah di Malaysia ";
				//$descriptionArea = "tutor persendirian untuk tuisyen di rumah di Malaysia ";
				$descriptionArea = " Malaysia ";
			}else{
				$seoArea = "Tutor Persendirian untuk Tuisyen di Rumah di ".$_GET['state'].' ';
				//$descriptionArea = "Tutor Persendirian untuk Tuisyen di Rumah di ".$_GET['state'].' ';
				$descriptionArea = " ".$_GET['state'].' ';
			}
		}else{
			$seoArea = "Tutor Persendirian untuk Tuisyen di Rumah di Malaysia ";
			//$descriptionArea = "tutor persendirian untuk tuisyen di rumah di Malaysia ";
			$descriptionArea = " Malaysia ";
		}
	  }
	  
	  
		
	  }else{
		//echo "BI ";
		
	  $contentDescription = "We help you get the best ";
	  $contentTitle = "tutors and tuition teachers in ";
	  
	  if( isset($_GET['subject']) && $_GET['subject'] != ''){
		$seoSubject = $_GET['subject'].' ';
		$descriptionSubject = $_GET['subject'].' ';
	  }else{
		$seoSubject = "Bahasa melayu, bahasa inggeris ";
		$descriptionSubject = "Bahasa melayu, bahasa inggeris ";
	  }
	  
	  if( isset($_GET['level']) && $_GET['level'] != ''){
		if($_GET['level'] =="All"){
			$seoLevel = "Pre school, tahun 1-3, UPSR, PT3, SPM ";
			$descriptionLevel = "Pre school, tahun 1-3, UPSR, PT3, SPM ";
		}else{
			$seoLevel = $_GET['level'].' ';
			$descriptionLevel = $_GET['level'].' ';
		}
	  }else{
		$seoLevel = "Pre school, tahun 1-3, UPSR, PT3, SPM ";
		$descriptionLevel = "Pre school, tahun 1-3, UPSR, PT3, SPM ";
	  }
	  
	  

	  if( isset($_GET['area']) && $_GET['area'] != ''){
		$seoArea = "Private Tutor for Home Tuition or Home School in ".$_GET['area'].' ';
		$descriptionArea = "private tutor for home tuition or home school in ".$_GET['area'].' ';
	  }else{
		if( isset($_GET['state']) && $_GET['state'] != ''){
			if($_GET['state'] =="All"){
				$seoArea = "Private Tutor for Home Tuition or Home School in Malaysia ";
				$descriptionArea = "private tutor for home tuition or home school in Malaysia ";
			}else{
				$seoArea = "Private Tutor for Home Tuition or Home School in ".$_GET['state'].' ';
				$descriptionArea = "private tutor for home tuition or home school in ".$_GET['state'].' ';
			}
		}else{
			$seoArea = "Private Tutor for Home Tuition or Home School in Malaysia ";
			$descriptionArea = "private tutor for home tuition or home school in Malaysia ";
		}
	  }		

		//echo $seoSubject.''.$seoLevel.''.$seoArea;
	  }
	  ?>
	  <title><?PHP echo $seoSubject.''.$seoLevel.''.$seoArea; ?></title>
	  <!-- subjek level "Private Tutor for Home Tuition or Home School in location -->
	  <meta name="description" content="<?PHP if($getLanguange == "/my/search_tutor2"){echo "Kami bantu anda mendapatkan tutor persendirian untuk tuisyen di rumah untuk ".strtolower($seoSubject)."".strtolower($seoLevel)."di".strtolower($descriptionArea);}else{echo "We help you get the best ".strtolower($seoSubject)."".strtolower($seoLevel)."".strtolower($seoArea)."area.";} ?><?PHP //echo $contentDescription.''.strtolower($seoSubject.''.$seoLevel.''.$seoArea); ?>" />
	  <meta name="keywords" content="home tutor, home tuition, home tuisyen, tuisyen rumah, homeschool, private tutor, private teacher, guru tuisyen" />
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
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-138159328-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-138159328-1');
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
      <script src="js/jquery-ui.js"></script>
      <script src="js/owl.carousel.js"></script>
      <script src="js/velocity.min.js"></script>
      <script src="js/enhance.js"></script>
      <script src="js/flush.js"></script>
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

    <nav class="navbar navbar-default navbar-fixed-top <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'parent_login.php' || basename($_SERVER['PHP_SELF']) == 'forget.php') ? 'hidden' : '' ;?>">
      <div class="container">
        <div class="col-md-3">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php $arrLogo = system::FireCurl(GET_SETTINGS.'?set=COMPANY_LOGO');
          foreach($arrLogo->data as $logo){ ?>
          <!--<a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="admin/upload/<?php echo $logo->ss_settings_value;?>" class="img-responsive" alt=""/></a>-->
		  <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/<?php echo $logo->ss_settings_value;?>" class="img-responsive" alt=""/></a>
          <?php } ?>
        </div>
        </div>
		
        <!--<div class="col-md-1 hidden-sm hidden-md hidden-lg" style="margin-top:8px;">
			<a href="request_a_tutor.php" class="btn btn-info btn-lg get_btntop"><?php echo GET_A_TUTOR; ?></a>
        </div>-->
		
    <div class="hidden-md hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:40px;margin-right:0px;" type="button" class="btn btn-info navbar-sm"><?php echo GET_A_TUTOR; ?></a>
  	</div>
    <div class="hidden-lg hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:40px;margin-right:0px;" type="button" class="btn btn-info navbar-sm"><?php echo GET_A_TUTOR; ?></a>
  	</div>
<div class="col-md-3">
<?php
if($_SERVER['PHP_SELF'] == "/search_tutor.php" || $_SERVER['PHP_SELF'] == "/request_a_tutor.php"){
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
    <!--<div class="hidden-lg hidden-md hidden-xs pull-right">
      <a href="request_a_tutor.php" style="margin-top:-110px;margin-right:85px;" type="button" class="btn btn-info navbar-sm"><?php echo GET_A_TUTOR; ?></a>
  	</div>
    <div class="hidden-lg hidden-md hidden-sm pull-right">
      <a href="request_a_tutor.php" style="margin-top:-80px;margin-right:40px;" type="button" class="btn btn-info navbar-xs"><?php echo GET_A_TUTOR; ?></a>
  	</div>-->
</div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right off_dropd">

                       <?php if(!isset($_SESSION['auth'])) { ?>
                       <?php // Get Header Navigation
                        if($_SESSION['lang_code']=='' || $_SESSION['lang_code']== $defaultLang){                 
                          $lang_url = str_replace('{lang}/', '', LIST_HEADER_MENU);
                        }
                        elseif( $_SESSION['lang_code']=='BM'){
                         ?>
                        <li class="dropdown"><a href="https://www.tutorkami.com/my/index">Utama</a></li>						
  
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Ibu / Bapa <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/my/search_tutor">Cari Tutor</a></li>
								<li><a href="https://www.tutorkami.com/my/parent_faq">FAQs</a></li>
								<li><a href="https://www.tutorkami.com/my/request_a_tutor?tutor_id=i3be8gz">Hubungi Kami</a></li>
								<!--<li><a href="https://www.tutorkami.com/parent_login.php">Log Masuk Ibubapa</a></li>-->
								
								
							</ul>
                        </li>

                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Saya Tutor <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/my/tutor.php">Laman Tutor</a></li>
								<li><a href="https://www.tutorkami.com/my/search_job.php">Job Terkini</a></li>
								<li><a href="https://www.tutorkami.com/my/register.php">Pendaftaran</a></li>
								<li><a href="https://www.tutorkami.com/my/tutor_faq.php">Tutor FAQs</a></li>
								<li><a href="https://www.tutorkami.com/login.php">Log Masuk Tutor</a></li>
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
						<li class="dropdown"><a href="https://www.tutorkami.com/">Home</a></li>
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Parents <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/search_tutor">Search Tutor</a></li>
								<li><a href="https://www.tutorkami.com/parent_faq">FAQs</a></li>
								<li><a href="https://www.tutorkami.com/request_a_tutor?tutor_id=i3be8gz">Contact Us</a></li>
								<!--<li><a href="https://www.tutorkami.com/parent_login.php">Sign In</a></li>-->
								
								
							</ul>
                        </li>
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">I'm a Tutor<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/tutor.php">Tutor's Page</a></li>
								<li><a href="https://www.tutorkami.com/search_job.php">Latest Jobs</a></li>
								<li><a href="https://www.tutorkami.com/register.php">Register</a></li>
								<li><a href="https://www.tutorkami.com/tutor_faq.php">FAQs</a></li>
								<li><a href="https://www.tutorkami.com/login.php">Log In</a></li>
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
                        <li class="dropdown">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" href="" aria-haspopup="true" aria-expanded="false">
                           <?php echo WELCOME; ?> <?php echo ucfirst($_SESSION['auth']['first_name']); ?> <?php //echo ucfirst($_SESSION['auth']['last_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                              <li><a href="clients_profile.php" class="language"><?php echo MY_PROFILE; ?></a></li>
                              <li><a href="list_of_classes.php" class="language"><?php echo LIST_OF_CLASSES; ?></a></li>
                              <li><a href="payment_history.php" class="language"><?php echo PAYMENT_HISTORY; ?></a></li>
                              <li><a href="parent_guide.php" class="language"><?php echo PARENT_GUIDE; ?></a></li>
                              <li><a href="logout.php" class="language"><?php echo LOGOUT; ?></a></li>
                           </ul>
                        </li>
                        <?php } else { ?>
                        <li class="dropdown">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" href="" aria-haspopup="true" aria-expanded="false">
                           <?php echo WELCOME; ?> <?php echo ucfirst($_SESSION['auth']['display_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                              <li><a href="edit_account.php" class="language"><?php echo EDIT_ACCOUNT; ?></a></li>
                              <li><a href="change_password.php" class="language"><?php echo CHANGE_PASSWORD; ?></a></li>
                              <li><a href="view_profile.php" class="language"><?php echo VIEW_PROFILE; ?></a></li>
                              <li><a href="tutor_list_of_classes.php" class="language"><?php echo LIST_OF_CLASSES; ?></a></li>
                              <li><a href="tutor_payment_history.php" class="language"><?php echo PAYMENT_HISTORY; ?></a></li>
                              <li><a href="search_job.php" class="language"><?php echo LATEST_JOB; ?></a></li>
                              <li><a href="tutor_guide.php" class="language"><?php echo TUTOR_GUIDE; ?></a></li>
                              <li><a href="logout.php" class="language"><?php echo LOGOUT; ?></a></li>
                           </ul>
                        </li>
                        <?php } ?>
                     <?php } ?>
					 
					 
					 

			<!--<li style="margin-top:10px"><button type="submit" onclick="location.href = 'request_a_tutor.php';" type="button" class="btn btn-success"><?php echo GET_A_TUTOR; ?></button></li>
			<div class="col-md-1 hidden-xs" style="margin-top:-25px">
				<a href="request_a_tutor.php" class="btn btn-info btn-md get_btntop"><?php echo GET_A_TUTOR; ?></a>
			</div>-->
			
          </ul>
        </div>

		
      </div>
    </nav>
<script>
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



<?PHP
$findCity = $stateID = $cityID = '';

$findSubj = $levelID = $subjectID = '';



if (isset($_GET['location_id']) && $_GET['location_id'] != '') {

   $splitLocIDs = explode('||', $_GET['location_id']);

   $stateID = $splitLocIDs[0];

   $cityID = $splitLocIDs[1];   

}

if (isset($_GET['subject_id']) && $_GET['subject_id'] != '') {

   $splitSubIDs = explode('||', $_GET['subject_id']);

   $levelID = $splitSubIDs[0];

   $subjectID = $splitSubIDs[1];

}




if (count($_POST) > 0) {

  $data = $_POST;

  

  $output = system::FireCurl(SEACRH_TUTOR_URL, "POST", "JSON", $data);

  // var_dump($output);

  $search = $output->data;

  

} else {

if (isset($_GET['subject']) && $_GET['subject'] != '' && isset($_GET['location']) && $_GET['location'] != '') {
	$data = array('subject' => $_GET['subject'], 'location' => $_GET['location']);
}
 

  if ($stateID != '') {

     $data['cover_area_state'][] = $stateID;

  }

  if ($stateID != '' && $cityID != '') {

     $data['cover_area_city_'.$stateID][] = $cityID;

  }

  if ($stateID != '' && $cityID == '') {

     $data['location_other'] = 1;

  }



  if ($levelID != '') {

     $data['tutor_course'][] = $levelID;

  }

  if ($levelID != '' && $subjectID != '') {

     $data['tutor_subject_'.$levelID][] = $subjectID;

  }

  if ($levelID != '' && $subjectID == '') {

     $data['subject_other'] = 1;

  }

  



  // $output = system::FireCurl(SEACRH_TUTOR_URL, "POST", "JSON", $data);//punca slow view more tutor

  // var_dump($output);exit();

  // $search = $output->data;

}

if (isset($cityID) && $cityID != '') {

   $findCity = system::FireCurl(LIST_CITY_URL."?city_id=".urlencode($cityID));

}

if (isset($subjectID) && $subjectID != '') {

   $findSubj = system::FireCurl(LIST_SUBJECT_URL."?subject_id=".urlencode($subjectID));

}



$total_result = count($search);


?>

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<script> 
	//to indicate whether subject and area have been checked and repopulate or not before performing the initial cariTutor()
	var subjectPopulateDone = false;
	var areaPopulateDone = false;
	var checkPopulation;
	
   function tickAll(className) {

      $(className).prop('checked', true);

   }



   function untickAll(className) {

      $(className).prop('checked', false);

   }



   function toggleOther(ele, id) {

      if (ele.checked) {

         $('[name^="'+id+'"]').parent('.col-md-12').show();

      } else {

         $('[name^="'+id+'"]').parent('.col-md-12').hide();

      }

   }



   function check_parent(ele) {



      var parentID = $(ele).data('pid');

      var parentName = $(ele).data('pname');

      var childName = $(ele).data('cname');

      var checkboxes = document.getElementsByTagName('input');

      

      if (ele.checked) {

         for (var i = 0; i < checkboxes.length; i++) {

             if (checkboxes[i].type == 'checkbox' && checkboxes[i].id == parentName+parentID){

               checkboxes[i].checked = true;

            }

         }

      } else {

        for (var i = 0; i < checkboxes.length; i++) {                

            if (checkboxes[i].type == 'checkbox' && checkboxes[i].id == parentName+parentID) {

               if ($('input[name^="'+childName+parentID+'"]:checked').length == 0) {

                  checkboxes[i].checked = false;

               }

               

            }

         }

      }

   }



   function get_cities(StateId, CityId) {

      $.ajax({

         url: "front_ajax_call.php",

         method: "POST",

         data: {action: 'get_cities', state_id: StateId, city_id: CityId}, 

         success: function(result){

            if (result == '') {

               $('.city_check_uncheck_area').hide();

            } else{

               $('.city_check_uncheck_area').show();

            }

            

            $('.city-area').html(result);

            $('.showHide, .showHide .dropPop').show();

            $('#hider, #loadermodaldiv').hide();
      
      <?php
      
        if(isset($_GET['location_id']))
        {
          echo "$(city_check_".$_GET['location_id'].").prop('checked', true);";
        }   
			
		if(isset($_GET['area'])) {
			if($_GET['area'] != "") {
				$areaArr = explode(",", $_GET['area']);
				
				foreach($areaArr as $j) {
					echo "$('label').filter(function() {
							return $(this).text() == '".$j."';
						}).prev().attr('checked','checked');";
				}
				
			}
		}
      ?>

			areaPopulateDone = true;
         }

      });

   }



   function get_subjects(LevelId, SubjectId) {

      $.ajax({

         url: "front_ajax_call.php",

         method: "POST",

         data: {action: 'get_subjects', level_id: LevelId, subject_id: SubjectId}, 

         success: function(result){

            if (result == '') {

               $('.subject_check_uncheck_area').hide();

            } else{

               $('.subject_check_uncheck_area').show();

            }

            $('.subject-area').html(result);

            $('.levelShowHide, .levelShowHide .dropPop').show();

            $('#hider, #loadermodaldiv').hide();
      
      <?php
      
        if(isset($_GET['subject_id']))
        {
          echo "$(subject_check".$_GET['subject_id'].").prop('checked', true);";
        }
		
		if(isset($_GET['subject'])) {
			if($_GET['subject'] != "") {
				$subjectArr = explode(",", $_GET['subject']);
				
				foreach($subjectArr as $i) {
					echo "$('label').filter(function() {
							return $(this).text() == '".$i."';
						}).prev().attr('checked','checked');";
				}

			}
		}
      ?>
			subjectPopulateDone = true;
         }

      });

   }

   

   $(document).ready(function(){



      $('#state_drop').on('change', function(){

         $('#hider, #loadermodaldiv').show();

         var StateId = $(this).val();

         get_cities(StateId, '');

      });



      $('#level_drop').on('change', function(){

         $('#hider, #loadermodaldiv').show();

         var LevelId = $(this).val();

         get_subjects(LevelId, '');

      });

      // $(".dropbox").click(function(){

      //    // $(this).next('.dropPop').stop();

      //    $(this).next('.dropPop').slideToggle("slow");

      // });

   });

</script>



<section class="search_tutor myform">

   <div class="main-body">

      <div class="container">



         <h1 class="text-center text-uppercase blue-txt"><?php echo SEARCH_TUTOR; ?></h1>

         <hr>

         <div class="col-md-offset-2 col-md-8">

          <div class="clearfix"></div>
      
      
            <form method="post" id="filter_user">

               <input type="hidden" name="action" value="search_tutor">
<?PHP
if (isset($_REQUEST['subject']) && $_REQUEST['subject'] != '' && isset($_REQUEST['location']) && $_REQUEST['location'] != '') {
?>
               <input type="hidden" name="subject" value="<?php echo isset($_REQUEST['subject']) ? $_REQUEST['subject']: '';?>">

               <input type="hidden" name="location" value="<?php echo isset($_REQUEST['location']) ? $_REQUEST['location']: '';?>">

<?PHP
}
?>

               <div class="row">

                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo STATE; ?>:</strong></span></div>

                  <div class="col-md-9">

                     <div class="form-group">

						<?php	
							$stateSelected = "";
							$stateSelector = "";
							
							if(isset($_GET['state'])) {
								$stateSelected = $_GET['state'];
								$stateSelector = "$('#state_drop option:contains(".$stateSelected.")').attr('selected', 'selected');";
							} else if(isset($_POST['cover_area_state'])) {
								$stateSelected = $_POST['cover_area_state'][0];
								$stateSelector = "$('#state_drop').val('".$stateSelected."');";
							}
						?>
                        <select class="form-control" name="cover_area_state[]" id="state_drop">

                           <option value=""><?php echo SEARCH_TUTOR_SELECT_STATE; ?></option>
                           <option value="All"><?php echo "All"; ?></option>

                           <?php 

                           $getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');

                           if ($getAllCountries->flag == 'success' && count($getAllCountries->data) > 0) {

                              $i = 0;

                              foreach ($getAllCountries->data as $key => $country) {

                                 // Get State By Country Id

                                 $getCountryWiseStates = system::FireCurl(LIST_STATE_URL.'?country_id='.$country->c_id);

                                 if ($getCountryWiseStates->flag == 'success' && count($getCountryWiseStates->data) > 0) {

                                    foreach ($getCountryWiseStates->data as $key => $state) {

                                       $st_selected = '';

                                       if ($findCity != '') {

                                          foreach ($findCity->data as $cities) {

                                             if ($cities->city_st_id == $state->st_id) {

                                                $st_selected = 'selected';

                                                echo '<script>
                                                $(document).ready(function(){
                                                  get_cities("'.$state->st_id.'", "'.$cities->city_id.'");
                                                });
                                                </script>';

                                             } else {

                                                $st_selected = '';

                                             }

                                          }

                                       } elseif (isset($stateID) && $stateID == $state->st_id) {

                                          $st_selected = 'selected';

                                          echo '<script>
                                          $(document).ready(function(){
                                            get_cities("'.$state->st_id.'", "");
                                          });
                                          </script>';

                                       }

                           ?>

								 <option value="<?php echo $state->st_id; ?>" <?php echo (strcasecmp($stateSelected, $state->st_id) == 0 || strcasecmp($stateSelected, $state->st_name) == 0 ? "selected" : ""); ?>><?php echo $state->st_name; ?></option>

                           <?php 

                                    }

                                 }

                              }

                           }

                           ?>

                        </select>
                     </div>
                     <div class="form-group">

                        <div class="showHide" <?php 
                          if(!isset($_GET['location_id']))
                          { 
                            echo "style='display: none;'"; 
                          } 
                          else if($_GET['location_id'] == "")
                          { 
                            echo "style='display: none;'"; 
                          }  
                        ?>>

                           <div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>

                           <div class="dropPop">

                              <div class="row">

                                 <div class="col-md-12 city_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAll('.city_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('.city_check');">Untick All</a></div>

                                 <div class="city-area"></div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="row">

                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo SEARCH_JOB_LEVELS; ?>:</strong></span></div>

                  <div class="col-md-9">

                     <div class="form-group">

						<?php	
							$levelSelected = "";
							$levelSelector = "";
							
							if(isset($_GET['level'])) {
								$levelSelected = $_GET['level'];
								$levelSelector = "$('#level_drop option:contains(".$levelSelected.")').attr('selected', 'selected');";
							} else if(isset($_POST['tutor_course'])) {
								$levelSelected = $_POST['tutor_course'][0];
								$levelSelector = "$('#level_drop').val('".$levelSelected."');";
							}
						?>
						
                        <select class="form-control" name="tutor_course[]" id="level_drop">

                           <option value="">Choose subject</option>
                           <option value="All"><?php echo "All"; ?></option>

                           <?php 

                           // Get Course

                           $getCourse = system::FireCurl(LIST_COURSE_URL);

                           if ($getCourse->flag == 'success' && count($getCourse->data) > 0) {

                              $i = 0;

                              foreach ($getCourse->data as $key => $course) {

                                 $sub_selected = '';

                                 if ($findSubj != '') {

                                    foreach ($findSubj->data as $subjects) {

                                       if ($subjects->ts_tc_id == $course->tc_id) {

                                          $sub_selected = 'selected';

                                          echo '<script>$(document).ready(function(){get_subjects("'.$course->tc_id.'", "'.$subjects->ts_id.'");});</script>';

                                       } else {

                                          $sub_selected = '';

                                       }

                                    }

                                 } elseif (isset($levelID) && $levelID == $course->tc_id) {

                                    $sub_selected = 'selected';

                                    echo '<script>$(document).ready(function(){get_subjects("'.$course->tc_id.'", "");});</script>';

                                 }

                           ?>

                           <option value="<?php echo $course->tc_id; ?>" <?php echo (strcasecmp($levelSelected, $course->tc_id) == 0 || strcasecmp($levelSelected, $course->tc_title) == 0 ? "selected" : ""); ?>><?php echo $course->tc_title; ?></option>

                           <?php 

                             }

                           }

                           ?>

                        </select>
                     </div>

                     <div class="form-group">

                        <div class="levelShowHide" style="display: none;">

                           <div class="dropbox"><?php echo PLEASE_TICK_THE_SUBJECT; ?></div>

                           <div class="dropPop">

                              <div class="row">

                                 <div class="col-md-12 subject_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAll('.subject_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('.subject_check');">Untick All</a></div>

                                 <div class="subject-area"></div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="row">

				<?php	
					if(isset($_GET['gender'])) {
						$genderSelected = $_GET['gender'];
					} else if(isset($_POST['u_gender'])) {
						$genderSelected = $_POST['u_gender'];
					}
				?>
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo GENDER; ?>:</strong></span></div>

                  <div class="col-md-3">

                     <select class="form-control" name="u_gender" id="u_gender">

                        <option value="">All</option>

                        <option value="M" <?php echo (strcasecmp($genderSelected, "M") == 0 || strcasecmp($genderSelected, MALE) == 0 ? "selected" : "") ?>><?php echo MALE; ?> </option>

                        <option value="F" <?php echo (strcasecmp($genderSelected, "F") == 0 || strcasecmp($genderSelected, FEMALE) == 0 ? "selected" : "") ?>><?php echo FEMALE; ?></option>

                     </select>

                  </div>
				  
				  
                  <div class="col-md-3"> <span class="org-txt text-uppercase"><strong><?php echo OCCUPATION; ?>:</strong></span> </div>

                  <div class="col-md-3">

				     <?php	
						$occupationSelected = "";
						
						if(isset($_GET['occupation'])) {
							$occupationSelected = $_GET['occupation'];
						} else if(isset($_POST['ud_current_occupation'])) {
							$occupationSelected = $_POST['ud_current_occupation'];
						}
					?>
                     <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">

                        <option value="" <?php echo ($occupationSelected == "" ? "selected" : "") ?>>All</option>

                        <option value="Full-time tutor" <?php echo (strcasecmp($occupationSelected, "Full-time tutor") == 0 || strcasecmp($occupationSelected, FULL_TIME_TUTOR) == 0 ? "selected" : ""); ?>><?php echo FULL_TIME_TUTOR; ?></option>

                        <option value="Kindergarten teacher" <?php echo (strcasecmp($occupationSelected, "Kindergarten teacher") == 0 || strcasecmp($occupationSelected, KINDERGARTEN_TEACHER) == 0 ? "selected" : ""); ?>><?php echo KINDERGARTEN_TEACHER; ?></option>

                        <option value="Primary school teacher" <?php echo (strcasecmp($occupationSelected, "Primary school teacher") == 0 || strcasecmp($occupationSelected, PRIMARY_SCHOOL_TEACHER) == 0 ? "selected" : ""); ?>><?php echo PRIMARY_SCHOOL_TEACHER; ?></option>

                        <option value="Secondary school teacher" <?php echo (strcasecmp($occupationSelected, "Secondary school teacher") == 0 || strcasecmp($occupationSelected, SECONDARY_SCHOOL_TEACHER) == 0 ? "selected" : ""); ?>><?php echo SECONDARY_SCHOOL_TEACHER; ?></option>

                        <option value="Tuition center teacher" <?php echo (strcasecmp($occupationSelected, "Tuition center teacher") == 0 || strcasecmp($occupationSelected, TUITION_CENTER_TEACHER) == 0 ? "selected" : ""); ?>><?php echo TUITION_CENTER_TEACHER; ?></option>

                        <option value="Lacturer" <?php echo (strcasecmp($occupationSelected, "Lacturer") == 0 || strcasecmp($occupationSelected, LACTURER) == 0 ? "selected" : ""); ?>><?php echo LACTURER; ?></option>

                        <option value="Ex-teacher" <?php echo (strcasecmp($occupationSelected, "Ex-teacher") == 0 || strcasecmp($occupationSelected, EX_TEACHER) == 0 ? "selected" : ""); ?>><?php echo EX_TEACHER; ?></option>

                        <option value="Retired teacher" <?php echo (strcasecmp($occupationSelected, "Retired teacher") == 0 || strcasecmp($occupationSelected, RETIRED_TEACHER) == 0 ? "selected" : ""); ?>><?php echo RETIRED_TEACHER; ?></option>

                        <option value="Other" <?php echo (strcasecmp($occupationSelected, "Other") == 0 || strcasecmp($occupationSelected, OTHER) == 0 ? "selected" : ""); ?>><?php echo OTHER; ?></option>

                     </select>

                  </div>
				  
					
				  <?php	
					  if(isset($_GET['race'])) {
					  	  $raceSelected = $_GET['race'];
					  } else if(isset($_POST['ud_race'])) {
						  $raceSelected = $_POST['ud_race'];
					  }
				  ?>
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo RACE; ?>:</strong></span></div>

                  <div class="col-md-3">

                     <select class="form-control" name="ud_race" id="ud_race">

                        <option value="">All</option>

                        <option value="Malay" <?php echo (strcasecmp($raceSelected, "Malay") == 0 || strcasecmp($raceSelected, Malay) == 0 ? "selected" : "") ?>>Malay</option>

                        <option value="Chinese" <?php echo (strcasecmp($raceSelected, "Chinese") == 0 || strcasecmp($raceSelected, Chinese) == 0 ? "selected" : "") ?>>Chinese</option>

                        <option value="Indian" <?php echo (strcasecmp($raceSelected, "Indian") == 0 || strcasecmp($raceSelected, Indian) == 0 ? "selected" : "") ?>>Indian</option>

                        <option value="Others" <?php echo (strcasecmp($raceSelected, "Others") == 0 || strcasecmp($raceSelected, Others) == 0 ? "selected" : "") ?>>Others</option>

                     </select>

                  </div>

               </div>

               <div class="row">

                  <!--<div class="col-md-3"> <span class="org-txt text-uppercase"><strong><?php echo OCCUPATION; ?>:</strong></span> </div>

                  <div class="col-md-3">

                     <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">

                        <option value="">All</option>

                        <option value="Full-time tutor"><?php echo FULL_TIME_TUTOR; ?></option>

                        <option value="Kindergarten teacher"><?php echo KINDERGARTEN_TEACHER; ?></option>

                        <option value="Primary school teacher"><?php echo PRIMARY_SCHOOL_TEACHER; ?></option>

                        <option value="Secondary school teacher"><?php echo SECONDARY_SCHOOL_TEACHER; ?></option>

                        <option value="Tuition center teacher"><?php echo TUITION_CENTER_TEACHER; ?></option>

                        <option value="Lacturer"><?php echo LACTURER; ?></option>

                        <option value="Ex-teacher"><?php echo EX_TEACHER; ?></option>

                        <option value="Retired teacher"><?php echo RETIRED_TEACHER; ?></option>

                        <option value="Other"><?php echo OTHER; ?></option>

                     </select>

                  </div> -->

                  <div class="col-md-3 hidden"><span class="org-txt text-uppercase"><strong><?php echo TUTOR_STATUS; ?>:</strong></span> </div>

                  <div class="col-md-3 hidden">

                     <select class="form-control" name="ud_tutor_status" id="ud_tutor_status">

                        <option value="">All</option>

                        <option value="'Full Time'"><?php echo FULL_TIME_TUTOR; ?></option>

                        <option value="'Part Time'"><?php echo PART_TIME; ?></option>

                     </select>

                  </div>

               </div>

               <div class="row hidden">

                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo WILL_TEACH_AT_TUITION_CENTER; ?>:</strong></span></div>

                  <div class="col-md-3">

                     <select class="form-control" name="tution_center" id="tution_center">

                        <option value="">All</option>

                        <option value="1"><?php echo YES; ?></option>

                        <option value="0"><?php echo NO; ?></option>

                     </select>

                  </div>

               </div>

               <div class="row">

                  <div class=" col-sm-12 col-md-12 search-tb" id="submitsearch" align="center">

                     <!-- <button type="submit" class="btn btn-md search_btn" onclick="cariTutor()"><?php echo BUTTON_SEARCH_TUTOR; ?></button> -->
                     <br><input type="button" name="submitBtn" class="btn btn-md search_btn" onclick="preSubmission()" value="<?php echo BUTTON_SEARCH_TUTOR; ?>">

                  </div>

               </div>
			   
            </form>
			<script>
				function preSubmission() {
					var selectedState = encodeURI($("#state_drop :selected").html().trim());
					var selectedLevel = encodeURI($("#level_drop :selected").html().trim());
					var selectedGender = encodeURI($("#u_gender :selected").html().trim());
					var selectedRace = encodeURI($("#ud_race :selected").html().trim());
					var selectedOccupation = encodeURI($("#ud_current_occupation :selected").html().trim());
					var selectedArea = new Array();
					var selectedSubject = new Array();
					
					$(".city_check").each(
						function() {
							if($(this).is(":checked")) {
								selectedArea.push(encodeURI($(this).next().html().trim()));
							}
						}
					);
					
					$(".subject_check").each(
						function() {
							if($(this).is(":checked")) {
								selectedSubject.push(encodeURI($(this).next().html().trim()));
							}
						}
					);
					
					var parameterArr = new Array();
					
					if($("#state_drop").val() != "") {
						parameterArr.push("state=" + selectedState);
					}
					if($("#level_drop").val() != "") {
						parameterArr.push("level=" + selectedLevel);
					}
					if($("#u_gender").val() != "") {
						parameterArr.push("gender=" + selectedGender);
					}
					if($("#ud_race").val() != "") {
						parameterArr.push("race=" + selectedRace);
					}
					if($("#ud_current_occupation").val() != "") {
						parameterArr.push("occupation=" + selectedOccupation);
					}
					if(selectedArea.length > 0) {
						parameterArr.push("area=" + selectedArea.join(","));
					}
					if(selectedSubject.length > 0) {
						parameterArr.push("subject=" + selectedSubject.join(","));
					}
					
					
					<?php
						$urlArr = explode("?", $_SERVER['REQUEST_URI']);
						$getUrl = $urlArr[0];
					?>
					
					var getUrl = "<?php echo $getUrl; ?>?" + parameterArr.join("&");
					// /search_tutor2?state=Johor&level=Pre-School&area=Bekok&subject=Bahasa%20Melayu
					//alert(getUrl);
            /* */var subState = getUrl.match("state=(.*)&level"); 
            var subLevel = getUrl.match("level=(.*)&area");
            var subArea = getUrl.match("area=(.*)&subject");
            var subSubject = getUrl.match("subject=(.*)");
            //alert( subState[1] + '-' + subLevel[1] + '-' + subArea[1] + '-' + subSubject[1] );
			
			strSub = subSubject[1].replace(/-/g, '_');
			strLevel = subLevel[1].replace(/-/g, '_');
			strArea = subArea[1].replace(/-/g, '_');

			//alert(strSub);
			
			//var newURL = subState[1] + '-' + subLevel[1] + '-' + subArea[1] + '-' + subSubject[1];
			//var newURL = 'search_tutor2_lp?/' + subSubject[1] + '-' + subLevel[1] + '-' + subArea[1];
			var newURL = 'search_tutor2_lp?/' + strSub + '-' + strLevel + '-' + strArea;
					
					
					alert(newURL);
					/*$("#filter_user").prop("action", newURL);
					$("#filter_user").prop("action", getUrl);
					$("#filter_user").submit();*/
				}
			</script>
      
      <?php 
        $fromIndex = false;
        if(isset($_GET['location_id']))
        {
          $fromIndex = true;
          $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
          $sql = "SELECT city_st_id FROM tk_cities WHERE city_id = '".$_GET['location_id']."'";
          $row = mysqli_fetch_array(mysqli_query($connect, $sql));
          
          echo '<script>get_cities("'.$row['city_st_id'].'", ""); $("#state_drop").val("'.$row['city_st_id'].'");</script>'; 
          mysqli_close($connect);
        } 
		
        if(isset($_GET['subject_id']))
        { 
          $fromIndex = true;
          $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
          $sql = "SELECT ts_tc_id FROM tk_tution_subject WHERE ts_id = '".$_GET['subject_id']."'";
          $row = mysqli_fetch_array(mysqli_query($connect, $sql));
          
          echo '<script>get_subjects("'.$row['ts_tc_id'].'", ""); $("#level_drop").val("'.$row['ts_tc_id'].'");</script>'; 
          mysqli_close($connect);
        }  
        
        if($fromIndex)
        {
          echo "<script>window.onload = function () { cariTutor(); }</script>";
        }
      ?>

         </div>
		 

         <div class="col-md-12">
			<div class="job-table" style="margin-top:30px;">
				<div class="panel panel-default">
					<div class="panel-footer">
					
					<h3 class="text-primary text-left"><?PHP echo ucfirst($seoLevel); ?> <?PHP echo strtolower($seoSubject); ?> <?PHP echo $contentTitle; ?> <?PHP if($getLanguange == "/my/search_tutor2"){echo str_replace("Tutor Persendirian untuk Tuisyen di Rumah di"," ",$seoArea);}else{echo str_replace("Private Tutor for Home Tuition or Home School in"," ",$seoArea);} ?>
					</h3>
					<h4 class="text-left"><?PHP if($getLanguange == "/my/search_tutor2"){echo "Kami bantu anda mendapatkan tutor persendirian untuk tuisyen di rumah untuk ".strtolower($seoSubject)."".strtolower($seoLevel)." di ".strtolower($descriptionArea);}else{echo "We help you get the best ".strtolower($seoSubject)."".strtolower($seoLevel)."".strtolower($seoArea)." area.";} ?><?PHP //echo strtolower($seoSubject); ?><?PHP //echo strtolower($seoLevel); ?> <?PHP //echo strtolower($seoArea); ?> <?PHP //if($getLanguange == "/my/search_tutor2"){echo "kawasan.";}else{echo "area.";} ?>
					</h4>
					<h4 class="text-left"><?PHP if($getLanguange == "/my/search_tutor2"){echo "Hubungi kami dengan menekan butang 'Dapatkan Tutor'.";}else{echo "Contact us today by clicking the 'Get a Tutor' button.";} ?></h4>
					
					</div>
				</div>
			</div>
         </div>
		 

         <div class="col-md-12">

            <div class="job-table" style="margin-top:30px;">

               <div class="top">

                <div class="dataTables_info" id="example_info" role="status" aria-live="polite">

                  <?php echo SEARCH_RESULTS; ?> : <span class="org-txt"><span id="counttutor"></span> Tutor(s) found</span>

                  </div>

               </div>

             

               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center" style="background:#fff;" id="dataTable">

                  <thead>

                     <tr class="blue-bg">
						
						<!--<th class="hidden"><center><?php //echo "DATE"; ?></center></th>-->

                        <th><center><?php echo SEARCH_TUTOR_NAME; ?></center></th>

                        <th><center><?php echo SEARCH_TUTOR_GENDER; ?></center></th>

                        <th><center><?php echo SEARCH_TUTOR_AGE; ?></center></th>

                        <th><center><?php echo "LOCATION";//SEARCH_TUTOR_CITY; ?></center></th>

                        <th><center><?php echo "OCCUPATION"; ?></center></th>

                        <th><center><?php echo SEARCH_TUTOR_RATING; ?></center></th>

                        <th><center>ACTION</center></th>

                     </tr>

                  </thead>

               </table>

               <br>

            </div>

         </div>         

      </div>

   </div>

</section>

<script src="js/jquery-1.12.4.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

<script> 

   function tickAll(className) {

      $(className).prop('checked', true);

   }



   function untickAll(className) {

      $(className).prop('checked', false);

   }



   function toggleOther(ele, id) {

      if (ele.checked) {

         $('[name^="'+id+'"]').parent('.col-md-12').show();

      } else {

         $('[name^="'+id+'"]').parent('.col-md-12').hide();

      }

   }



   function check_parent(ele) {



      var parentID = $(ele).data('pid');

      var parentName = $(ele).data('pname');

      var childName = $(ele).data('cname');

      var checkboxes = document.getElementsByTagName('input');

      

      if (ele.checked) {

         for (var i = 0; i < checkboxes.length; i++) {

             if (checkboxes[i].type == 'checkbox' && checkboxes[i].id == parentName+parentID){

               checkboxes[i].checked = true;

            }

         }

      } else {

        for (var i = 0; i < checkboxes.length; i++) {                

            if (checkboxes[i].type == 'checkbox' && checkboxes[i].id == parentName+parentID) {

               if ($('input[name^="'+childName+parentID+'"]:checked').length == 0) {

                  checkboxes[i].checked = false;

               }

               

            }

         }

      }

   }



</script>

<script>
    $(document).ready(function(){
      //cariTutor();

      $('#state_drop').on('change', function(){

         $('#hider, #loadermodaldiv').show();

         var StateId = $(this).val();

         $.ajax({

            url: "front_ajax_call.php",

            method: "POST",

            data: {action: 'get_cities', state_id: StateId}, 

            success: function(result){

               if (result == '') {

                  $('.city_check_uncheck_area').hide();

               } else{

                  $('.city_check_uncheck_area').show();

               }

               

               $('.city-area').html(result);

               $('.showHide, .showHide .dropPop').show();

               $('#hider, #loadermodaldiv').hide();

            }

         });

      });



      $('#level_drop').on('change', function(){

         $('#hider, #loadermodaldiv').show();

         var LevelId = $(this).val();

         $.ajax({

            url: "front_ajax_call.php",

            method: "POST",

            data: {action: 'get_subjects', level_id: LevelId}, 

            success: function(result){

               if (result == '') {

                  $('.subject_check_uncheck_area').hide();

               } else{

                  $('.subject_check_uncheck_area').show();

               }

               $('.subject-area').html(result);

               $('.levelShowHide, .levelShowHide .dropPop').show();

               $('#hider, #loadermodaldiv').hide();

            }

         });

      });
   });


function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
$(document).ready(function() { 
	<?php
		if($levelSelected != "") {
			echo	$levelSelector.'
					var levelid = $("#level_drop").val();
					get_subjects(levelid, "");';
		} else {
			echo "subjectPopulateDone = true;";
		}
		
		if($stateSelected != "") {
			echo	$stateSelector.'
					var stateid = $("#state_drop").val();
					get_cities(stateid, "");';
		} else {
			echo "areaPopulateDone = true;";
		}
		
	?>
	checkPopulation = setInterval(startSearch, 500);
});

	function startSearch() {
		if(subjectPopulateDone && areaPopulateDone) {
			clearInterval(checkPopulation);
			cariTutor();
		}
	}
	
  function cariTutor(){

    var gender = $("#u_gender").val();
    var ud_race = $("#ud_race").val();
    var current_occupation = $("#ud_current_occupation").val();
    var ud_tutor_status = $("#ud_tutor_status").val();
    var tution_center = $("#tution_center").val();

    var areas = $("#state_drop").val();
    var location = $("#location").val();
    var course = $("#level_drop").val();
	
    var city_check = [];
			$('.city_check:checked').each(function(i){
				city_check[i] = $(this).val();
			});
	var subject_check = [];
			$('.subject_check:checked').each(function(i){
				subject_check[i] = $(this).val();
			});
			
    var subject = $("#subject").val();

    var getaarea = getUrlVars()['location_id'];
    var getSub = getUrlVars()['subject_id'];
	
	if( city_check == "" ){
		if(getaarea != "" && getaarea !== undefined){
			city_check[0] = getaarea;
		}else{
			$('.city_check:checked').each(function(i){
				city_check[i] = $(this).val();
			});
		}
	}else{
        $('.city_check:checked').each(function(i){
          city_check[i] = $(this).val();
        });
	}

	if( subject_check == "" ){
		if(getSub != "" && getSub !== undefined){
			subject_check[0] = getSub;
		}else{
			$('.subject_check:checked').each(function(i){
				subject_check[i] = $(this).val();
			});
		}
	}else{
        $('.subject_check:checked').each(function(i){
          subject_check[i] = $(this).val();
        });
	}
			$('#dataTable').DataTable().destroy();
			var dataTable = $('#dataTable').DataTable({
				pageLength: 5,
				language: {
                          "emptyTable":     "Tiada Maklumat Dijumpai!",
						  "info": "Showing _START_ to _END_ of _TOTAL_ tutors",
						  "infoEmpty":      "Showing 0 to 0 of 0 tutors",
                        },	

				"sPaginationType": "simple_numbers", //full_numbers
				paging: true,
				searching: true,
				/*"columnDefs": [
					{
						"targets": [ 0 ],
						"visible": false,
						"searchable": false
					}
				],*/
				
				"processing" : true,
				"serverSide" : true,
				//"order" : [ ],
				//"searching" : false,
				"ordering": false,
				
				"ajax" : {
					url:"ajax-load-search-tutor.php",
					type:"POST",
					data:{
						state:areas, area:city_check, level:course, subjek:subject_check, gender2:gender, occupation:current_occupation, race:ud_race
					}
				}
			});
		
	
	
	
	
    return false;
  }

</script>
<!-- luqman -->

<?php include('includes/footer.php');?>



