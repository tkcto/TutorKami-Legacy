<!-- START includes/header.php -->
<?php require_once('includes/head.php'); ?>
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
	  <title><?PHP echo $seoPageTitle; ?></title>
	  <meta name="description" content="<?PHP echo $seoPageDescription; ?>" />
	  <meta name="keywords" content="<?PHP echo $seoPageKeywords; ?>" />
	  
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
	  
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-42467282-1"></script> -->
      <script async src="googletagmanager.js"></script>
      <script>
window.onscroll = function (e) {  
function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","UA-42467282-1");  
} 
      </script>

       <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
       <?php $arrSet = system::FireCurl(GET_SETTINGS.'?set=GOOGLE_ANALYTICS');
        foreach($arrSet->data as $set){
         echo $set->ss_settings_value;
        } 
       ?>
      
      <script src="js/jquery.min.js"></script> 
      <script src="js/bootstrap.min.js" defer></script> 
      <!-- Swiper JS -->
      <script src="js/swiper.min.js"></script>
      <!-- Initialize Swiper -->
      <script>
        var swiper=new Swiper(".swiper-container",{pagination:".swiper-pagination",slidesPerView:3,slidesPerColumn:2,paginationClickable:!0,spaceBetween:30});function gotoPage(e){window.open(e,"_blank")}$(function(){$("#hider").hide(),$("#loadermodaldiv").hide()});
      </script>
      <!-- Autocomplete -->
      <script async src="js/jquery-ui.js"></script>
	  <script async src="js/owl.carousel.js"></script>
	  <script async src="js/velocity.min.js"></script>
      <script src="js/enhance.js" defer></script>
      <!--<script src="js/flush.js"></script>-->
      <script type="text/javascript">
function hideErrDiv(containerEle,progressEle){var elem=document.getElementById(progressEle);var width=100;var id=setInterval(frame,50);function frame(){if(width<=0){clearInterval(id);$("#"+containerEle).fadeOut(200)}else{width--;elem.style.width=width+'%'}}}
var counter=0;function getStickyNote(msg_type,msg_text){counter++;var html='<div id="sticky-container-'+counter+'" class="toast toast-'+msg_type+'" style="">'+'<div id="alert_progress_bar_'+counter+'" class="toast-progress" style="width: 100%;"></div>'+'<button type="button" class="toast-close-button" role="button">×</button>'+'<div class="toast-message">'+msg_text+'</div>'+'</div>';$('#toast-container').append(html);hideErrDiv('sticky-container-'+counter,'alert_progress_bar_'+counter);return html}
      </script>

      <script>
        $(document).ready(function(){$(".owl-stage-outer").owlCarousel({interval:3e3,autoPlay:!0}),$(".owl-carousel").owlCarousel({loop:!0,margin:10,responsiveClass:!0,responsive:{0:{items:1,nav:!0},600:{items:3,nav:!1},1000:{items:4,nav:!0,loop:!1,margin:20}}}),$(".dropbox").click(function(){$(this).next(".dropPop").stop(),$(this).next(".dropPop").slideToggle("slow")}),$('[data-toggle="btnToolTip"]').tooltip(),$(".tip-top").tooltip({placement:"top"}),$(".tip-right").tooltip({placement:"right"}),$(".tip-bottom").tooltip({placement:"bottom"}),$(".tip-left").tooltip({placement:"left",html:!0}),$(".tip-auto").tooltip({placement:"auto",html:!0})});
      </script>
      <script type="text/JavaScript">
       $('.nl .search-form .input-group input[type="text"]').attr("class","search_control"),$('.nl .search-form .input-group input[type="text"]').attr("placeholder","Search..."),$(".nl .search-form .input-group  .input-group-addon").hide();
      </script>
      <script type="text/javascript" src="js/jquery.validate.js" defer></script>
      <script type="text/javascript">
        $(document).ready(function(){$("#registration-form").validate({errorElement:"label",rules:{u_gender:{required:!0},"ud_dob[0]":{required:!0},"ud_dob[1]":{required:!0},"ud_dob[2]":{required:!0},"cover_area_state[]":{required:!0},"tutor_course[]":{required:!0},ud_about_yourself:{required:!0},ud_phone_number:{required:!0,digits:!0}},messages:{u_gender:"- Gender is required.","ud_dob[0]":"- Date of birth is required.","ud_dob[1]":"- Date of birth is required.","ud_dob[2]":"- Date of birth is required.","cover_area_state[]":"- Area you can cover is required.","tutor_course[]":"- Subject you can teach is required.",ud_about_yourself:"- About yourself is required.",ud_phone_number:"- Phone number is required and numeric only."}})});
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
      </style>

   </head>
   <body>

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
          <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/<?php echo $logo->ss_settings_value;?>" class="img-responsive" alt="tutorkami logo"/></a>
          <?php } ?>
        </div>
        </div>
		
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
                        <li class="dropdown">
							<!--<a href="https://www.tutorkami.com/my/index">Utama</a>-->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Utama <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/my/index">Halaman Utama</a></li>
								<li><a href="https://www.tutorkami.com/my/about">Mengenai Kami</a></li>
							</ul>
                        </li>						
  
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


/*START fadhli - untuk menu bar(mobile), hide code diatas (tak pasti)*/
if($_SESSION['lang_code']=='en' || $_SESSION['lang_code']==''){
						?>
						<li class="dropdown">
							<!--<a href="https://www.tutorkami.com/">Home</a>-->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Home <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/index">Home Page</a></li>
								<li><a href="https://www.tutorkami.com/about">About Us</a></li>
							</ul>
						</li>
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
								<li><a href="https://www.tutorkami.com/tutor.php">Tutor’s Page</a></li>
								<li><a href="https://www.tutorkami.com/search_job.php">Latest Jobs</a></li>
								<li><a href="https://www.tutorkami.com/register.php">Register</a></li>
								<li><a href="https://www.tutorkami.com/tutor_faq.php">FAQs</a></li>
								<li><a href="https://www.tutorkami.com/login.php">Log In</a></li>
							</ul>

                        </li>
						<?php	
	
}
/*END fadhli */
?>

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
			
          </ul>
        </div>

		
      </div>
    </nav>
<script>
$(document).on("click",function(a){var n=$("#navbar").hasClass("in");$(a.target).closest("#navbar").length||$(a.target).is("#navbar")||!0!==n||$("#navbar").collapse("toggle")});
</script>
<!-- END includes/header.php -->


    <link href='css-pricing/rotating-card/rotating-card.css' rel='stylesheet' />
	<link rel="stylesheet" type="text/css" href="css-pricing/adaptor/css/custom.css" />
<style>
.transparent{background-color:transparent!important;box-shadow:inset 0 1px 0 rgba(0,0,0,.075)}.left-border-none{border-left:none!important;box-shadow:inset 0 1px 0 rgba(0,0,0,.075)}.border-radius{border-radius:4px}.carousel-control.left,.carousel-control.right{background-image:none!important;filter:none!important;opacity:1!important;color:#f1592a}@media screen and (max-width :320px){h4.media_example{font-size:11px}p.media_example{font-size:11px}}.thisfont{font-family:Cambria,Palatino,"Palatino Linotype","Palatino LT STD",Georgia,serif;font-size:15px}.alert-message{margin:5px 0;padding:5px;border-left:3px solid #eee}.alert-message h4{margin-top:0;margin-bottom:5px}.alert-message p:last-child{margin-bottom:0}.alert-message code{background-color:#fff;border-radius:3px}.alert-message-success{background-color:#f4fdf0;border-color:#3c763d}.alert-message-success h4{color:#3c763d}.alert-message-danger{background-color:#fdf7f7;border-color:#d9534f}.alert-message-danger h4{color:#d9534f}.alert-message-warning{background-color:#fcf8f2;border-color:#f0ad4e}.alert-message-warning h4{color:#f0ad4e}.alert-message-info{background-color:#f4f8fa;border-color:#5bc0de}.alert-message-info h4{color:#5bc0de}.alert-message-default{background-color:#eee;border-color:#b4b4b4}.alert-message-default h4{color:#000}.alert-message-notice{background-color:#fcfcdd;border-color:#bdbd89}.alert-message-notice h4{color:#444}.circular-square{width:150px;height:150px;border-radius:50%}
</style>
<section class="banner">

   <article class="banner_text">

      <div class="container">

         <div class="row">

            <div style="width:100%">

            <?php 

            // Get Header Text

            $arrHeadText = system::FireCurl(CMS_URL.'?cms_id=21&lang='.$_SESSION['lang_code']);

            foreach($arrHeadText->data as $head){

              echo $head->pmt_pagedetail;

            } 

            ?>

				<script>
					function checkField(){return""==$("#subject_id").val()?(document.getElementById("subject").value="",alert("Please select / click from the list of subject only!"),!1):""!=$("#location_id").val()||(document.getElementById("location").value="",alert("Please select / click from the list of location only!"),!1)}
				</script>
               <div class="form_div" style="width: 100%">
<div class="hidden-sm hidden-xs">
                  <form autocomplete="off" action="search_tutor.php#submitsearch" method="get" onsubmit="return checkField();">
			
                    <input type="hidden" name="subject_id" id="subject_id" value="">

                    <input type="hidden" name="location_id" id="location_id" value="">

                     <div class="form-group">

                        <div class="row ro1">
								<div class="col-40">
											<?php
												$connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
											?>
										  <div class="input-group" style="">
											
											<span class="input-group-addon customInput " style="padding-left:10px;"><i class="fa fa-search"></i></span>

											<input type="text" id="subject" name="subject" class="my_form_control autocomplete customInput" id="subject" placeholder="<?php echo "Subject";//echo HOME_SEARCH_EXAMPLE; ?>">

										  </div>                              
								</div>
								<div class="col-40">

										  <div class="input-group ui-widget" style="">

											 <span class="input-group-addon customInput" style="padding-left:10px;"><i class="glyphicon glyphicon-map-marker"></i></span>
											 
											 <input type="text" id="location" name="location" class="my_form_control ui-autocomplete-input customInput" id="location" placeholder="<?php echo "Your location";//echo HOME_SEARCH_LOCATION_PLACEHOLDER; ?>" />
										  </div>
										  
										  
								</div>
								<div class="col-20">
										<div>

											<button type="submit" class="btn btn-md search_btn" style="width:100%;"><?php echo HOME_SEARCH_TUTOR_PLACEHOLDER; ?></button>
										</div>
								</div>
                        </div>

                     </div>

                  </form>
</div>
               </div>

            </div>

         </div>

      </div>

   </article> 

   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">

      <!-- Indicators -->

      <ol class="carousel-indicators">

        <?php 

         // Get Slider

         $arrSlider = system::FireCurl(LIST_SLIDER);

         $i = 0;

         foreach($arrSlider->data as $sl){

         ?>

         <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if($i==0) {?> class="active" <?php } ?>></li>

         <?php $i++; } ?>

      </ol> 

      <div class="carousel-inner" role="listbox">

        <?php 

         // Get Slider

         $j = 0;

         foreach($arrSlider->data as $sl){

         ?>

         <div class="item <?php if($j==0) {?> active <?php } ?>">


<?php
if(stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")){ // if mobile browser
?>
			<img src="<?php echo $sl->sl_image;?>">
<?php
}
else { // desktop browser
?>
			<img src="<?php echo $sl->sl_image;?>" style="padding-top: 80px;">
			
<?php
}
?>


            <div class="carousel-caption">

            </div>

         </div>

         <?php $j++; } ?>


      </div>

<div class="hidden-lg hidden-md" style="margin-top:20px">


                  <form autocomplete="off" action="search_tutor.php#submitsearch" method="get" onsubmit="return checkField();">
			
                    <input type="hidden" name="subject_id2" id="subject_id2" value="">

                    <input type="hidden" name="location_id2" id="location_id2" value="">

                     <div class="form-group">

                        <div class="row ro1">
								<div class="col-40">
											<?php
												$connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
											?>
										  <div class="input-group">
											<span class="input-group-addon transparent"><i class="glyphicon glyphicon-search"></i></span>
											<input type="text" id="subject2" name="subject2" class="form-control autocomplete left-border-none" placeholder="Subject">
										  </div>
										  
								</div>
								<div class="col-40">

										  
										  <div class="input-group">
											<span class="input-group-addon transparent"><i class="glyphicon glyphicon-map-marker"></i></span>
											<input type="text" id="location2" name="location2" class="form-control autocomplete left-border-none" placeholder="Your location">
										  </div>
										  
										  
								</div>
								<div class="col-20">
										<div>

											<button type="submit" class="btn btn-md search_btn border-radius" style="width:100%;"><?php echo HOME_SEARCH_TUTOR_PLACEHOLDER; ?></button>
										</div>
								</div>
                        </div>

                     </div>

                  </form>
 </div>

   </div>

</section>

<section class="how_works bott_border">

   <div class="container">

   <div class="col-md-2"></div>

   <?php 

         // Get How it works

         $arrHowitworks = system::FireCurl(CMS_URL.'?cms_id=1&lang='.$_SESSION['lang_code']);

         

         foreach($arrHowitworks->data as $how){?>

       <div class=" col-md-12 tutor_button">

			<div class="row  b_margin_50">

					<h1 class="header"><?=$how->pmt_subtitle?></h1>

			</div>

		</div>

      <div class="row">

        <?php

             echo $how->pmt_pagedetail;

         

         }

         ?>

      </div>
	
   </div>

</section>


<section class="how_works bott_border">

   <div class="container">

      <?php 

         // Get Why Tutorkami

         $arrWhytutorkami = system::FireCurl(CMS_URL.'?cms_id=3&lang='.$_SESSION['lang_code']);

         

         foreach($arrWhytutorkami->data as $why){?>

      <div class="row  b_margin_50">

         <div class="col-md-12">

            <h1 class="header"><?=$why->pmt_subtitle?></h1>

         </div>

      </div>

      <div class="row">

        <?php

             echo $why->pmt_pagedetail;

         

         }

        ?>

      </div>

   </div>

</section>

<section class="how_works bott_border">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">

           <?php 

            // Get Our Guarantee

            $arrOurGuarantee = system::FireCurl(CMS_URL.'?cms_id=4&lang='.$_SESSION['lang_code']);

            

            foreach($arrOurGuarantee->data as $guarant){ ?>

            <h1 class="header"><?=$guarant->pmt_subtitle?></h1>

            <?php

                echo $guarant->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<section class="how_works bott_border">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">

          <?php 

            // Get Tutor Text

            $arrTutorText = system::FireCurl(CMS_URL.'?cms_id=22&lang='.$_SESSION['lang_code']);

            

            foreach($arrTutorText->data as $ttext){ ?>

            <h1 class="header"><?php echo $ttext->pmt_subtitle;?></h1>

            <p class="subHead"><?php 
		   if($_SESSION['lang_code'] == 'BM'){
			   echo "TUTORS SWASTA TERKINI UNTUK TUISYEN DARI RUMAH";
		   }else{
			   echo "LATEST REGISTERED PRIVATE TUTORS FOR HOME TUITION";
		   }
			//echo "LATEST REGISTERED PRIVATE TUTORS FOR HOME TUITION";//$ttext->pmt_pagedetail;?></p>

            <?php

            }

           ?>

         </div>

      </div>

      <div class="row">

         <div class="col-md-12">

            <ul class="tutor_list">

              <?php 

                 // Get Slider

                 $arrTutor = system::FireCurl(LIST_TUTOR);

                 $i = 0;

                 foreach($arrTutor->data as $tutor){

                   $arrState = system::FireCurl(LIST_STATE_URL.'?state_id='.$tutor->ud_state);

                 foreach($arrState->data as $state){

                     $statename = $state->st_name;

                   }

                   $pix = sprintf("%'.07d\n", $tutor->u_profile_pic);

                 ?>  



         <div class="col-md-4 col-sm-6">
             <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="css-pricing/rotating-card/bg-card.jpg"/>
                        </div>
                        <div class="user">
                            <img class="circular-square" src="<?php if($tutor->u_profile_pic!='') { echo APP_ROOT."images/profile/".$pix."_0.jpg"; } else { if($tutor->u_gender=='M') echo 'images/tutor_ma.png'; else echo 'images/tutor_mi1.png'; }?>"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h3 class="name"><strong> <?=$tutor->u_displayname?> </strong></h3>
                                <p class="profession"><?=$tutor->ud_city ?></p>
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

    // truncate string
    $langStringCut = substr($langString, 0, 300);
    $langStringEndPoint = strrpos($langStringCut, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
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
<div class="clearfix"></div>
            <p class="m_top_30"><a href="<?PHP 
		   if($_SESSION['lang_code'] == 'BM'){
			   echo "https://www.tutorkami.com/my/search_tutor.php";
		   }else{
			   echo "search_tutor.php";
		   }
			?>" class="orange_btn"><?php echo BUTTON_VIEW_MORE_TUTOR; ?></a></p>

         </div>

      </div>

   </div>

</section>

<section class="how_works">

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <?php 

            // Get People Saying

            $arrPeopleSaying = system::FireCurl(CMS_URL.'?cms_id=5&lang='.$_SESSION['lang_code']);
            

            foreach($arrPeopleSaying->data as $saying){ ?>
            <!--<h1 class="header"><?=$saying->pmt_subtitle?></h1>-->
            <?php 
             //echo $saying->pmt_pagedetail;           
            }
           ?>
		   <h1 class="header"><? 
		   if($_SESSION['lang_code'] == 'BM'){
			   echo "TESTIMONIAL PELANGGAN";
		   }else{
			   echo "CLIENT’S TESTIMONIAL";
		   }
		    ?></h1>

<!-- START fadhli -->

            <div class="owl-carousel owl-theme">

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
<!-- END fadhli -->



         </div>

      </div>

   </div>

</section>

<section class="join">

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <?php 

            // Get Are you a tutor

            $arrIsTutor = system::FireCurl(CMS_URL.'?cms_id=6&lang='.$_SESSION['lang_code']);

            

            foreach($arrIsTutor->data as $tutor){

                echo $tutor->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<section class="how_works gray_bg">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">



            <h1 class="header">

            <?php 

            // Get Are you a tutor

            $arrNewsText = system::FireCurl(CMS_URL.'?cms_id=23&lang='.$_SESSION['lang_code']);

            

            foreach($arrNewsText->data as $newst){

              echo $newst->pmt_pagedetail;

            }?>

            </h1>

         </div>

      </div>

      <div class="row">

      <?php // Get Latest News

          if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang){                 

            $lang_url = str_replace('{lang}/', '', LIST_LATESTNEWS_URL);

          }

          else{

            $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_LATESTNEWS_URL);

          }

          $arrLatestNews = system::FireCurl($lang_url);

          // var_dump($lang_url);

           $n = 1;

           $count = sizeof($arrLatestNews->data);

        

           foreach($arrLatestNews->data as $news){

             $post_id = $news->ID;

           ?>


       <?php $n++ ; } ?>
      </div>
     
   </div>

</section>



<section class="qe">

   <div class="container">

      <div class="row">

         <div class="col-md-12" style="position:relative;">

            <?php 

            // Get Questions or Enquires

            $arrEnquery = system::FireCurl(CMS_URL.'?cms_id=7&lang='.$_SESSION['lang_code']);

            

            foreach($arrEnquery->data as $entry){

                echo $entry->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<!-- START includes/footer.php -->
<style>
.gsc-control-cse{padding:0!important;border-width:0!important}form.gsc-search-box,table.gsc-search-box{margin-bottom:0!important}.gsc-search-box .gsc-input{padding:0 4px 0 6px!important}#gsc-iw-id1{border-width:0!important;height:auto!important;box-shadow:none!important}#gs_tti50{padding:0!important}#gsc-i-id1{height:33px!important;padding:0!important;background:0 0!important;text-indent:0!important}.gsib_b{display:none}button.gsc-search-button{display:block;width:13px!important;height:13px!important;border-width:0!important;margin:0!important;padding:10px 6px 10px 13px!important;outline:0;cursor:pointer;box-shadow:none!important;box-sizing:content-box!important}.gsc-branding{display:none!important}#gsc-iw-id1,.gsc-control-cse{background-color:transparent!important}#search-box{width:300px;height:37px;margin:0 auto;background-color:#fff;border:2px solid #000;border-radius:4px}#gsc-i-id1{color:#000}button.gsc-search-button{padding:10px!important;background-color:#f1592a!important;border-radius:3px!important}
</style>
<footer <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'parent_login.php' || basename($_SERVER['PHP_SELF']) == 'forget.php') ? 'class="hidden"' : '' ;?>>

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
                    <li><a href="https://www.tutorkami.com/login.php">Log Masuk</a></li>
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
<div id="search-box">
   <script>
     !function(){var e=document.createElement("script");e.type="text/javascript",e.async=!0,e.src="https://cse.google.com/cse.js?cx=012605317305899767437:wmbhz60c7bk";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)}(),window.onload=function(){var e=document.getElementById("gsc-i-id1");e.placeholder="Google Custom Search",e.title="Google Custom Search"};
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
<div id="fb-root"></div>
<script>
window.onscroll = function (e) {  
window.fbAsyncInit=function(){FB.init({xfbml:!0,version:"v3.2"})},function(e,t,n){var c,o=e.getElementsByTagName(t)[0];e.getElementById(n)||((c=e.createElement(t)).id=n,c.src="https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js",o.parentNode.insertBefore(c,o))}(document,"script","facebook-jssdk");
} 
</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="193594130789161"
  theme_color="#f1592a">
</div>

</body>

</html>
<!-- END includes/footer.php -->

<script>
   $(function(){$(document).ready(function(){$(".carousel").carousel({interval:3e3})})});
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
	
	function autocomplete(e,t){var n,i,a,s=[],l=[];function o(e){if(!e)return!1;!function(e){for(var t=0;t<e.length;t++)e[t].classList.remove("autocomplete-active")}(e),a>=e.length&&(a=0),a<0&&(a=e.length-1),e[a].classList.add("autocomplete-active")}function u(t){for(var n=document.getElementsByClassName("autocomplete-items"),i=0;i<n.length;i++)t!=n[i]&&t!=e&&n[i].parentNode.removeChild(n[i])}"s"==t?(s=subjects,l=subjects_id,n="#subject_id",i="#subject_id2"):"l"==t&&(s=locations,l=locations_id,n="#location_id",i="#location_id2"),e.addEventListener("input",function(t){var o,c,d,r=this.value;if(u(),!r)return!1;for(a=-1,(o=document.createElement("DIV")).setAttribute("id",this.id+"autocomplete-list"),o.setAttribute("class","autocomplete-items"),o.setAttribute("style","border:0"),this.parentNode.appendChild(o),d=0;d<s.length;d++)s[d].toUpperCase().includes(r.toUpperCase())&&((c=document.createElement("DIV")).innerHTML=s[d].substr(0,r.length),c.innerHTML+=s[d].substr(r.length),c.innerHTML+="<input type='hidden' value='"+l[d]+"'>",c.addEventListener("click",function(t){e.value=this.innerHTML.split("<input")[0],$(n).val(this.getElementsByTagName("input")[0].value),$(i).val(this.getElementsByTagName("input")[0].value),u()}),o.appendChild(c))}),e.addEventListener("keydown",function(e){var t=document.getElementById(this.id+"autocomplete-list");t&&(t=t.getElementsByTagName("div")),40==e.keyCode?(a++,o(t)):38==e.keyCode?(a--,o(t)):13==e.keyCode&&(e.preventDefault(),a>-1&&t&&t&&t[a].click())}),document.addEventListener("click",function(e){u(e.target)})}
	
	autocomplete(document.getElementById("subject"), 's');
	autocomplete(document.getElementById("location"), 'l');
	
	autocomplete(document.getElementById("subject2"), 's');
	autocomplete(document.getElementById("location2"), 'l');
</script>
<style>
	.autocomplete{position:relative;display:inline-block}.autocomplete-items{overflow:auto;position:absolute;border:1px solid #d4d4d4;border-bottom:none;border-top:none;height:300px;z-index:99;top:100%;left:0;right:0}.autocomplete-items div{padding:10px;cursor:pointer;background-color:#fff;border-bottom:1px solid #d4d4d4;color:#000;text-align:left}.autocomplete-items div:hover{background-color:#e9e9e9}.autocomplete-active{background-color:#1e90ff!important;color:#fff}
</style>
<script>
	equalheight=function(t){var i,e=0,h=0,n=new Array;$(t).each(function(){if(i=$(this),$(i).height("auto"),topPostion=i.position().top,h!=topPostion){for(currentDiv=0;currentDiv<n.length;currentDiv++)n[currentDiv].height(e);n.length=0,h=topPostion,e=i.height(),n.push(i)}else n.push(i),e=e<i.height()?i.height():e;for(currentDiv=0;currentDiv<n.length;currentDiv++)n[currentDiv].height(e)})},$(window).load(function(){equalheight(".how_works .thum_bg")}),$(window).resize(function(){equalheight(".how_works .thum_bg")});
</script>
<script src="css-pricing/adaptor/js/box-slider-all.jquery.min.js"></script>
<script>
	$(function(){var e=$(".slide > img"),t=e.length;e.on("load",function(){0===(t-=1)&&o()});var o=function(){var e=function(e,t,o,i){l.stop().css("width",0),n.removeClass("current").eq(i).addClass("current")},t=function(){l.animate({width:"100%"},r)},o=$("#box"),n=$(".goto-slide"),i=$(".effect"),l=$("#time-indicator"),r=5e3,s={speed:1200,autoScroll:!0,timeout:r,next:"#next",prev:"#prev",pause:"#pause",onbefore:e,onafter:t,effect:"scrollHorz"},d={blindLeft:{blindCount:15},blindDown:{blindCount:15},tile3d:{tileRows:6,rowOffset:80},tile:{tileRows:6,rowOffset:80}};o.boxSlider(s),t(),$("#controls").on("click",".goto-slide",function(e){o.boxSlider("showSlide",$(this).data("slideindex")),e.preventDefault()}),$("#effect-list").on("click",".effect",function(n){var l=$(this),r=l.data("fx"),f=d[r];i.removeClass("current"),l.addClass("current"),e(0,0,0,0),o.boxSlider("destroy").boxSlider($.extend({effect:r},s,f)),t(),n.preventDefault()})}});
</script>
