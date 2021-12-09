<style>

.circle2 {
  position: relative;
  width: 100%;
  height: 0;
  padding: 100% 0 0;
  border-radius: 50%;
  overflow: hidden;
  border: 1px solid gray;
}

.circle2 img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.rounded-circle2 {
  /*margin-top:30px;*/
  border-radius: 50% !important;
}



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
<style>
.tooltip2 {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip2 .tooltiptext2 {
  visibility: hidden;
  width: 250px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  bottom: 100%;
  left: 50%;
  margin-left: -180px;
}

.tooltip2:hover .tooltiptext2 {
  visibility: visible;
}



    /* custom oren buttons */
 .btn-oren { 
  color: #FFFFFF; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren:hover, 
.btn-oren:focus, 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  color: #FFFFFF; 
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
  background-color: #FFFFFF; 
}

#dvLoading {
background:url(https://www.tutorkami.com/images/loading-spinner.gif) no-repeat center center;
height: 100px;
width: 200px;
z-index: 1000;
}
#loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
    position: fixed;
    top: 50%;
    left: 45%;
}   
 
 
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.circular-square {
  width:120px;
  height:120px;
  border-radius: 50%;
}
</style>
	<link href='css-pricing/rotating-card/rotating-card-seo.css' rel='stylesheet' />
	<link rel="stylesheet" type="text/css" href="css-pricing/adaptor/css/custom.css" />
<?php 

require_once('includes/head.php');

if($getLan == "/my/"){	
    $conductOnlineTitile = 'Buat Tuisyen Online';
}else{
    $conductOnlineTitile = 'Conduct Online Tuition';
}
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
	  
	  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!--<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
	  <link rel="stylesheet" href="css/swiper.min.css">-->
      
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
       <?php /*$arrSet = system::FireCurl(GET_SETTINGS.'?set=GOOGLE_ANALYTICS');
        foreach($arrSet->data as $set){
         echo $set->ss_settings_value;
        }*/ 
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


.shadow {
  box-shadow: 0px 15px 10px -15px #111;  
}*/
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
		  <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/<?php echo $logo->ss_settings_value;?>" class="pull-left img-responsive" alt="<?PHP echo $seoPageTitle; ?>"/></a>
          <?php } ?>
          <a href="request_a_tutor.php" style="" type="button" class="pull-right btn btn-info navbar-sm screensize">GET A TUTOR</a>
        </div>
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
<?PHP
$findCity = $stateID = $cityID = '';

$findSubj = $levelID = $subjectID = '';



if (isset($_GET['location_id']) && $_GET['location_id'] != '') {

   $splitLocIDs = explode('||', $_GET['location_id']);

   $stateID = $splitLocIDs[0];

   $cityID = $splitLocIDs[1];   

}
if (isset($_GET['location_id2']) && $_GET['location_id2'] != '') {

   $splitLocIDs = explode('||', $_GET['location_id2']);

   $stateID = $splitLocIDs[0];

   $cityID = $splitLocIDs[1];   

}

if (isset($_GET['subject_id']) && $_GET['subject_id'] != '') {

   $splitSubIDs = explode('||', $_GET['subject_id']);

   $levelID = $splitSubIDs[0];

   $subjectID = $splitSubIDs[1];

}
if (isset($_GET['subject_id2']) && $_GET['subject_id2'] != '') {

   $splitSubIDs = explode('||', $_GET['subject_id2']);

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

if (isset($_GET['subject2']) && $_GET['subject2'] != '' && isset($_GET['location2']) && $_GET['location2'] != '') {
	$data = array('subject' => $_GET['subject2'], 'location' => $_GET['location2']);
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
      
        if(isset($_GET['location_id'])){
            if( $_GET['location_id'] == 0 ){
                
            }else{
                echo "$(city_check_".$_GET['location_id'].").prop('checked', true);";
            }
        }
      
        if(isset($_GET['location_id2'])){
            if( $_GET['location_id2'] == 0 ){
                
            }else{
                echo "$(city_check_".$_GET['location_id2'].").prop('checked', true);";
            }
        }        
      ?>

         }

      });

   }



   function get_subjects(LevelId, SubjectId) {
       
      var locationURL = window.location.pathname.split('/')[1];

      $.ajax({

         url: "front_ajax_call.php",

         method: "POST",

         data: {action: 'get_subjects', level_id: LevelId, subject_id: SubjectId, locationURL: locationURL}, 

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

        if(isset($_GET['subject_id2']))
        {
          echo "$(subject_check".$_GET['subject_id2'].").prop('checked', true);";
        }
      ?>

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

<?PHP
if (isset($_REQUEST['subject2']) && $_REQUEST['subject2'] != '' && isset($_REQUEST['location2']) && $_REQUEST['location2'] != '') {
?>
               <input type="hidden" name="subject" value="<?php echo isset($_REQUEST['subject2']) ? $_REQUEST['subject2']: '';?>">

               <input type="hidden" name="location" value="<?php echo isset($_REQUEST['location2']) ? $_REQUEST['location2']: '';?>">

<?PHP
}
?>

               <div class="row">
<!-- text-uppercase -->
                  <div class="col-md-3"><span class="org-txt"><strong><?php echo STATE; ?> :</strong></span></div>

                  <div class="col-md-9">

                     <div class="form-group">

                        <select class="form-control" name="cover_area_state[]" id="state_drop">

                           <option value=""><?php echo SEARCH_TUTOR_SELECT_STATE; ?></option>

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

                           <option value="<?php echo $state->st_id; ?>" <?php echo (isset($_POST['cover_area_state']) && in_array($state->st_id, $_POST['cover_area_state'])) ? 'selected' : $st_selected;?>><?php if($getLan == "/my/"){ echo $state->st_name_bm; }else{ echo $state->st_name; } //echo $state->st_name; ?></option>

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
                          else if($_GET['location_id'] == 0)
                          { 
                            echo "style='display: none;'"; 
                          }

                          if(!isset($_GET['location_id2']))
                          { 
                            echo "style='display: none;'"; 
                          } 
                          else if($_GET['location_id2'] == "")
                          { 
                            echo "style='display: none;'"; 
                          } 
                          else if($_GET['location_id2'] == 0)
                          { 
                            echo "style='display: none;'"; 
                          } 
                        ?>>

                           <div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>

                           <div class="dropPop">

                              <div class="row">

                                 <div class="col-md-12 city_check_uncheck_area"> <!--<a href="javascript:void(0);" onclick="tickAll('.city_check');">Tick All</a>--> <a href="javascript:void(0);" onclick="untickAll('.city_check');">Untick All</a></div>

                                 <div class="city-area"></div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="row">

                  <div class="col-md-3"><span class="org-txt"><strong><?php echo SEARCH_JOB_LEVELS; ?> :</strong></span></div>

                  <div class="col-md-9">

                     <div class="form-group">

                        <select class="form-control" name="tutor_course[]" id="level_drop">

                           <option value="">Choose subject</option>

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

                           <option value="<?php echo $course->tc_id; ?>" <?php echo (isset($_POST['tutor_course']) && in_array($course->tc_id, $_POST['tutor_course'])) ? 'selected' : $sub_selected;?>><?php if($getLan == "/my/"){ echo $course->tc_description; }else{ echo $course->tc_title; } //echo $course->tc_title; ?></option>

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

                                 <div class="col-md-12 subject_check_uncheck_area"><!--<a href="javascript:void(0);" onclick="tickAll('.subject_check');">Tick All</a>--> <a href="javascript:void(0);" onclick="untickAll('.subject_check');">Untick All</a></div>

                                 <div class="subject-area"></div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="row">

                  <div class="col-md-3"><span class="org-txt"><strong><?php echo GENDER; ?> :</strong></span></div>

                  <div class="col-md-3">

                     <select class="form-control" name="u_gender" id="u_gender">

                        <option value="">All</option>

                        <option value="M"><?php echo MALE; ?> </option>

                        <option value="F"><?php echo FEMALE; ?></option>

                     </select>

                  </div>
				  
				  
                  <div class="col-md-3"> <span class="org-txt"><strong><?php echo OCCUPATION; ?> :</strong></span> </div>

                  <div class="col-md-3">

                     <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">

                        <option value="">All</option>

                        <option value="Full-time tutor"><?php echo FULL_TIME_TUTOR; ?></option>

                        <option value="Kindergarten teacher"><?php echo KINDERGARTEN_TEACHER; ?></option>

                        <option value="Primary school teacher"><?php echo PRIMARY_SCHOOL_TEACHER; ?></option>

                        <option value="Secondary school teacher"><?php echo SECONDARY_SCHOOL_TEACHER; ?></option>

                        <option value="Tuition center teacher"><?php echo TUITION_CENTER_TEACHER; ?></option>

                        <option value="Lecturer"><?php echo LACTURER; ?></option>

                        <option value="Ex-teacher"><?php echo EX_TEACHER; ?></option>

                        <option value="Retired teacher"><?php echo RETIRED_TEACHER; ?></option>

                        <option value="Other"><?php echo OTHER; ?></option>

                     </select>

                  </div>
				 


                  <div class="col-md-3"><span class="org-txt"><strong><?php echo $conductOnlineTitile; ?> :</strong></span> 
                        <!--<div class="tooltip2"><span class="glyphicon glyphicon-info-sign" style="color:#262262"></span><span class="tooltiptext2">For online tuition, please ignore the tutor’s location as tutor can conduct online tuition for you from any location</span></div>-->
                  </div>
                  <div class="col-md-3">
                     <select class="form-control" name="conductOnline" id="conductOnline">
                        <option value="">All</option>
                        <option <?PHP if(  (isset($_GET['location_id']) && $_GET['location_id'] == 0) || (isset($_GET['location_id2']) && $_GET['location_id2'] == 0)  ){ echo 'selected'; } ?> value="Yes">Yes</option>
                        <!--<option value="No">No</option>-->
                     </select>
                  </div>
                  
                  

                  <div class="col-md-3 hidden"><span class="org-txt"><strong><?php echo RACE; ?> :</strong></span></div>

                  <div class="col-md-3 hidden">

                     <select class="form-control" name="ud_race" id="ud_race">

                        <option value="">All</option>

                        <option value="Malay">Malay</option>

                        <option value="Chinese">Chinese</option>

                        <option value="Indian">Indian</option>

                        <option value="Others">Others</option>

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

                     <!-- <button type="submit" class="btn btn-md search_btn" onclick="cariTutor()"><?php //echo BUTTON_SEARCH_TUTOR; ?></button> -->
                     <!--<br><input type="button" name="submit" class="btn btn-md search_btn" onclick="cariTutor()" value="<?php //echo BUTTON_SEARCH_TUTOR; ?>">
                     <br><input type="button" name="filter" id="filter" class="btn btn-md search_btn" value="<?php //echo BUTTON_SEARCH_TUTOR; ?>">-->
<br><input type="button" name="filter2" id="filter2" class="btn btn-md btn-oren" value="<?php echo BUTTON_SEARCH_TUTOR; ?>">
<input type="hidden" id="stateValue" >	
<input type="hidden" id="levelValue" >			    
<?PHP
if( isset($_SESSION['auth']['user_id']) == '1579981' ){ 
    //echo '<input type="button" name="filter2" id="filter2" class="btn btn-md search_btn" value="BUTTON_SEARCH_TUTOR">';
}
?>



                  </div>

               </div>

            </form>
      
      <?php 
        $fromIndex = false;
        if(isset($_GET['location_id'])){
            if( $_GET['location_id'] == 0 ){
                
            }else{
              $fromIndex = true;
              $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
              $sql = "SELECT city_st_id FROM tk_cities WHERE city_id = '".$_GET['location_id']."'";
              $row = mysqli_fetch_array(mysqli_query($connect, $sql));
              
              echo '<script>get_cities("'.$row['city_st_id'].'", ""); $("#state_drop").val("'.$row['city_st_id'].'");</script>'; 
              echo '<script>document.getElementById("stateValue").value = "'.$row['city_st_id'].'";</script>'; 
              mysqli_close($connect);                
            }
        }
        if(isset($_GET['location_id2'])){
            if( $_GET['location_id2'] == 0 ){
                
            }else{
              $fromIndex = true;
              $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
              $sql = "SELECT city_st_id FROM tk_cities WHERE city_id = '".$_GET['location_id2']."'";
              $row = mysqli_fetch_array(mysqli_query($connect, $sql));
              
              echo '<script>get_cities("'.$row['city_st_id'].'", ""); $("#state_drop").val("'.$row['city_st_id'].'");</script>'; 
              mysqli_close($connect);                
            }
        }
		
        if(isset($_GET['subject_id']))
        { 
          $fromIndex = true;
          $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
          $sql = "SELECT ts_tc_id FROM tk_tution_subject WHERE ts_id = '".$_GET['subject_id']."'";
          $row = mysqli_fetch_array(mysqli_query($connect, $sql));
          
          echo '<script>get_subjects("'.$row['ts_tc_id'].'", ""); $("#level_drop").val("'.$row['ts_tc_id'].'");</script>'; 
          echo '<script>document.getElementById("levelValue").value = "'.$row['ts_tc_id'].'";</script>'; 
          mysqli_close($connect);
        } 
        if(isset($_GET['subject_id2']))
        { 
          $fromIndex = true;
          $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
          $sql = "SELECT ts_tc_id FROM tk_tution_subject WHERE ts_id = '".$_GET['subject_id2']."'";
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

               <div class="top">

                <div class="dataTables_info hidden" id="example_info" role="status" aria-live="polite">

                  <?php echo SEARCH_RESULTS; ?> : <span class="org-txt"><span id="counttutor"></span> Tutor(s) found</span>

                  </div>

               </div>

               <!--<table id="tutor-grid" width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center" style="background:#fff;">
					<thead>
						<tr class="blue-bg">
                            <th><center><?php echo SEARCH_TUTOR_NAME; ?></center></th>
                            <th><center><?php echo SEARCH_TUTOR_GENDER; ?></center></th>
                            <th><center><?php echo SEARCH_TUTOR_AGE; ?></center></th>
                            <th><center><?php echo "LOCATION"; ?></center></th>
                            <th><center><?php echo "OCCUPATION"; ?></center></th>
                            <th><center><?php echo SEARCH_TUTOR_RATING; ?></center></th>
                            <th><center>ACTION</center></th>
						</tr>
					</thead>
			    </table>-->
			    
			    
<?PHP
//if( isset($_SESSION['auth']['user_id']) == '1579981' ){
?>

<?PHP
if(stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")){
//mobile
?>
               <table id="tutor-grid-layout" width="100%">
					<thead>
						<tr>
                            <th></th>
						</tr>
					</thead>
			    </table>    
<?PHP
}else{
// desktop
?>
               <table id="tutor-grid-layout" width="100%">
					<thead>
						<tr>
                            <th></th>
						</tr>
					</thead>
			    </table>    
<?PHP
}
?>
<?php
//}
?>
			    

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
         
         var locationURL = window.location.pathname.split('/')[1];

         $.ajax({

            url: "front_ajax_call.php",

            method: "POST",

            data: {action: 'get_subjects', level_id: LevelId, locationURL: locationURL}, 

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
</script>


<script>

$(document).ready(function(){
    
    var isMobile = false; //initiate as false
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true; 
    
    var postURL = 'search-tutor-ajax3.php';
    
if(isMobile == true){
    window.addEventListener('load', function () {
        if (window.location.href.indexOf("subject_id") > -1) {
            document.getElementById('filter2').click();
        }
    })    
}
    
}else{
    var postURL = 'search-tutor-ajax2.php';
}
    
/*
window.addEventListener('load', function () {
    if (window.location.href.indexOf('?subject_id=') > 0) {
        //document.getElementById('filter2').click();
    }else{
        //datatableLayout();
    }
})*/



    // processing': '$("#loadermodaldiv").show();'
    function datatableLayout(state = '', city_check = '', level = '', subject_check = '', u_gender = '', ud_current_occupation = '', conductOnline = ''){
		var dataTable = $('#tutor-grid-layout').DataTable({
			"processing" : true,
			"serverSide" : true,

			"order": [],
			"columnDefs": [ { orderable: false, targets: [0]}],
			
			"searching" : false,
			//"ordering": false,
			'paging': true,			
            'language': {
                'loadingRecords': '&nbsp;',
                'processing': '<div id="loader"></div>'
                /* 'processing': '<center><div id="dvLoading"></div><center>' */
            },
			"ajax" : {
				url:postURL,
				type:"POST",
				data:{
					state:state, city_check:city_check, level:level, subject_check:subject_check, u_gender:u_gender, ud_current_occupation:ud_current_occupation, conductOnline:conductOnline
				}
			}
			,"fnDrawCallback": function () {
				document.getElementById("counttutor").innerHTML = this.fnSettings().fnRecordsTotal();
			}
				
				
		});
	}
    $('#filter2').click(function(){
        
        document.getElementById("example_info").classList.remove('hidden');
        
        var state                   = $('#state_drop').val();
        var u_gender                = $('#u_gender').val();
        var ud_current_occupation   = $('#ud_current_occupation').val();
        var conductOnline           = $('#conductOnline').val();
        

        var city_check = [];
            $('.city_check:checked').each(function(i){
                city_check[i] = $(this).val();
            });


        var level                   = $('#level_drop').val();
        var subject_check = [];
            $('.subject_check:checked').each(function(i){
                subject_check[i] = $(this).val();
            });


        //alert(state + ' - ' + city_check + ' - ' + level + ' - ' + subject_check);
        
        if(state != '' || city_check != '' || level != '' || subject_check != '' || u_gender != '' || ud_current_occupation != '' || conductOnline != ''  ){
				$('#tutor-grid-layout').DataTable().destroy();
				datatableLayout(state, city_check, level, subject_check, u_gender, ud_current_occupation, conductOnline);
		}else{
				$('#tutor-grid-layout').DataTable().destroy();
				datatableLayout();
        }


    });
    
    
    
    
 
    
    function fill_datatable(state = '', city_check = '', level = '', subject_check = '', u_gender = '', ud_current_occupation = '', conductOnline = ''){
		var dataTable = $('#tutor-grid').DataTable({
			"processing" : true,
			"serverSide" : true,
			"order" : [ ],
			"searching" : false,
			"ordering": false,
			'paging': true,				
			"ajax" : {
				url:"search-tutor-ajax.php",
				type:"POST",
				data:{
					state:state, city_check:city_check, level:level, subject_check:subject_check, u_gender:u_gender, ud_current_occupation:ud_current_occupation, conductOnline:conductOnline
				}
			}
			,"fnDrawCallback": function () {
				document.getElementById("counttutor").innerHTML = this.fnSettings().fnRecordsTotal();
			}
				
				
		});
	}

    $('#filter').click(function(){
        //alert('click');
        var state                   = $('#state_drop').val();
        var u_gender                = $('#u_gender').val();
        var ud_current_occupation   = $('#ud_current_occupation').val();
        var conductOnline           = $('#conductOnline').val();

        var city_check = [];
            $('.city_check:checked').each(function(i){
                city_check[i] = $(this).val();
            });


        var level                   = $('#level_drop').val();
        var subject_check = [];
            $('.subject_check:checked').each(function(i){
                subject_check[i] = $(this).val();
            });


        
        if(state != '' || city_check != '' || level != '' || subject_check != '' || u_gender != '' || ud_current_occupation != '' || conductOnline != ''  ){
				$('#tutor-grid').DataTable().destroy();
				fill_datatable(state, city_check, level, subject_check, u_gender, ud_current_occupation, conductOnline);
		}else{
				$('#tutor-grid').DataTable().destroy();
				fill_datatable();
        }


    });









function codeAddress() {
    if (window.location.href.indexOf('?subject_id=') > 0) {
            var city_check = [];
            var subject_check = [];
            var urllocation_id = window.location.href;
            var urllocation_id = new URL(urllocation_id);
            city_check[0] = urllocation_id.searchParams.get("location_id");

            var urlsubject_id = window.location.href;
            var urlsubject_id = new URL(urlsubject_id);
            subject_check[0] = urlsubject_id.searchParams.get("subject_id");
            
            //alert(urllocation_id + ' - ' + urlsubject_id);

            document.getElementById("example_info").classList.remove('hidden');
            
            var state                   = document.getElementById("stateValue").value;
            var level                   = document.getElementById("levelValue").value;
            var u_gender                = $('#u_gender').val();
            var ud_current_occupation   = $('#ud_current_occupation').val();
            var conductOnline           = $('#conductOnline').val();
    
            //alert(state + ' - ' + city_check + ' - ' + level + ' - ' + subject_check);
            
            if(state != '' || city_check != '' || level != '' || subject_check != '' || u_gender != '' || ud_current_occupation != '' || conductOnline != ''  ){
    				$('#tutor-grid-layout').DataTable().destroy();
    				datatableLayout(state, city_check, level, subject_check, u_gender, ud_current_occupation, conductOnline);
    		}else{
    				$('#tutor-grid-layout').DataTable().destroy();
    				datatableLayout();
            }
    }    
}
window.onload = codeAddress;






});



/*
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
$(document).ready(function() { 
	cariTutor();
});

  function cariTutor(){

    var gender = $("#u_gender").val();
    var ud_race = $("#ud_race").val();
    var current_occupation = $("#ud_current_occupation").val();
    var ud_tutor_status = $("#ud_tutor_status").val();
    var tution_center = $("#tution_center").val();
    var conductOnline = $("#conductOnline").val();

    var areas = $("#state_drop").val();
    var location = $("#location").val();
    var course = $("#level_drop").val();
    

  var subject_check = [];
        $('.subject_check:checked').each(function(i){
          subject_check[i] = $(this).val();
        });

    var city_check = [];
        $('.city_check:checked').each(function(i){
          city_check[i] = $(this).val();
        });

    var subject = $("#subject").val();
    
    
	
	if(getUrlVars()['location_id'] !== undefined){
		var getaarea = getUrlVars()['location_id'];
	}
	if(getUrlVars()['location_id2'] !== undefined){
		var getaarea = getUrlVars()['location_id2'];
	}
	if(getUrlVars()['subject_id'] !== undefined){
		var getSub = getUrlVars()['subject_id'];
	}
	if(getUrlVars()['subject_id2'] !== undefined){
		var getSub = getUrlVars()['subject_id2'];
	}
	
	
	
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
	
	
	
    if(areas == '' || course == ''){
      //alert("Please select location and subject");
    }else{

    if(conductOnline != '' || gender != '' || ud_race != '' || current_occupation != '' || ud_tutor_status != '' || tution_center != '' || areas != '' || course != '' || subject_check != '' || city_check != ''){
      $.ajax({
        method:"POST",
        url:"new_front_ajax_call.php",
        dataType:"json",
        data:{
          data: {
            conductOnline:conductOnline,
            u_gender:gender,
            ud_race:ud_race,
            ud_current_occupation:current_occupation,
            ud_tutor_status:ud_tutor_status,
            tution_center:tution_center,
            state_drop:areas,
            location:location,
            level_drop:course,
            subject_check: subject_check,
            city_check:city_check,
            subject:subject,
          },
        },
        success:function(response){
             createTablerow(response);  //bila on ni,dye tak detect table createtablerow
             
             var x = "Tiada Maklumat";
             var y = response.message;

             if (x = y){ 
             document.getElementById("counttutor").innerHTML = "No";

             }else{
             document.getElementById("counttutor").innerHTML = response.length;
             }
        }
      });

    }
  }
    return false;
  }



function convertCase(str) {
  var lower = String(str).toLowerCase();
  return lower.replace(/(^| )(\w)/g, function(x) {
    return x.toUpperCase();
  });
}



   function createTablerow(data){
<?PHP
		   //if($_SESSION['lang_code'] == 'BM'){
			  ?>
			  var pagelink = 'Tutor tidak dijumpai. Sila hubungi coordinators untuk bantuan dengan menekan <a href="https://www.tutorkami.com/my/request_a_tutor" target="_blank"><u> link</u></a> ini.'
			  <?PHP
		   //}else{
			  ?>
			  var pagelink = 'No tutors found. Please contact our coordinators to help you by clicking this<a href="https://www.tutorkami.com/request_a_tutor" target="_blank"><u> link</u></a>'
			  <?PHP
		   //}
?>
          $('#dataTable').DataTable({
            pageLength: 5,
            language: {
                          "emptyTable":     pagelink,
						  "info": "Showing _START_ to _END_ of _TOTAL_ tutors",
						  "infoEmpty":      "Showing 0 to 0 of 0 tutors",
                        },	

"sPaginationType": "simple_numbers", //full_numbers
						
            paging: true,
            searching: true,
            deferRender: true,
            destroy:true,//elakkan dari error initialise
			//"ordering": false,
			 "order": [[ 0, "desc" ]],
            columnDefs: [ 
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
			{

            targets: [0, 1, 2, 3, 4, 5, 6, 7], // column or columns numbers

            orderable: false,  // set orderable for selected columns

            }],
            data : data,
            
            
            "columns" : [
                        { "data": "u_modified_date" },
						
                        //{ "data": "u_displayname" },
						
                        { "data": "u_displayname",
                            "render": function ( data, type, JsonResultRow, meta ) {
                              var u_displayid = JsonResultRow['u_displayid'];
                              var u_displayname = JsonResultRow['u_displayname'];
                              // console.log(JsonResultRow);
                              return '<a href="tutor_profile.php?did='+u_displayid+'" target="_blank">'+u_displayname+'</a>'
                              
                            }
                         },
						
                        { "data": "u_gender" },
                        { "data": "ud_dob" },
                        { "data": "ud_city" },
                        //{ "data": "ud_qualification" },
                        { "data": "ud_current_occupation",
                            "render": function ( data, type, row ) {
								

								
								//var other = row['ud_current_occupation_other'].replace(/^[a-z]{1}/igm,function(m){return m.toUpperCase()});
								//var upStringOther = other.replace(/^[a-z]{1}/igm,function(m){return m.toUpperCase()});
								
								if ((data.toLowerCase()) == 'full-time tutor') {
									return 'Full Time Tutor';
								}else if ((data.toLowerCase()) == 'kindergarten teacher'){
									return 'Kindergarten Teacher';
								}else if ((data.toLowerCase()) == 'primary school teacher'){
									return 'Primary School Teacher';
								}else if ((data.toLowerCase()) == 'secondary school teacher'){
									return 'Secondary School Teacher';
								}else if ((data.toLowerCase()) == 'tuition center teacher'){
									return 'Tuition Center Teacher';
								}else if((data.toLowerCase()) == 'lacturer' || (data.toLowerCase()) == 'lecture'|| (data.toLowerCase()) == 'lecturer'){
									return 'Lecture';
								}else if((data.toLowerCase()) == 'ex-teacher'){
									return 'Ex-Teacher';
								}else if((data.toLowerCase()) == 'retired teacher'){
									return 'Retired Teacher';
								}else if((data.toLowerCase()) == 'other'){
									return convertCase(row['ud_current_occupation_other']); 
								}else{
									return convertCase(data); 
								}


								
								
                            }
                         },
                        { "data": "rr_rating" },
						
                        { "data": "u_email",
                            "render": function ( data, type, JsonResultRow, meta ) {
                              var u_displayid = JsonResultRow['u_displayid'];
                              var u_email = JsonResultRow['u_email'];
                              // console.log(JsonResultRow);
                              return '<a href="tutor_profile.php?did='+u_displayid+'" class="btn btm-xs view-button" target="_blank"><?php echo VIEW_PROFILE; ?></a>'
                              
                            }
                         }, 
                        
                   ]
          });
        }
*/

</script>
<?php include('includes/footer-new.php');?>