<?php require_once('includes/head.php'); ?><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
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
      <!--<title>TutorKami.com - <?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_title : '';?></title>
      <meta name="description" content="<?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_description : '';?>" />
      <meta name="keywords" content="<?php //echo ($seoArr->flag == 'success') ? $seoArr->data[0]->smt_meta_keyword : '';?>" />-->

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
      <!-- <link rel="stylesheet" href="css/owl.theme.default.min.css"> -->
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
          // $('.owl-stage-outer').owlCarousel({
          //   interval: 3000,
          //   autoPlay : true
          // });

          // $('.owl-carousel').owlCarousel({
          //     loop: true,
            
          //     margin: 10,
          //     responsiveClass: true,
          //     responsive: {
          //         0: {
          //             items: 1,
          //             nav: true
          //         },
          //         600: {
          //             items: 3,
          //             nav: false
          //         },
          //         1000: {
          //             items: 4,
          //             nav: true,
          //             loop: false,
          //             margin: 20
          //         }
          //     }
          // });
          // luqman hide sebab carousel nibuat search tutor page menu xshow dropdown

          $(".dropbox").click(function(){
            $(this).next('.dropPop').stop();
            $(this).next('.dropPop').slideToggle("slow");
          });
/*START fadhli - untuk menu bar(mobile), hide code ini*/
          /*$('ul.nav li.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
          }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
          });*/
/*END fadhli*/

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
      </style>
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
      <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/599fed3ab6e907673de09890/default';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
      </script>
      <!--End of Tawk.to Script-->
      <div class="loaderBackground" id="hider"></div>
      <div class="loaderpop" id="loadermodaldiv">
         <h4><img src="images/loader.gif" style="width: 50px;" />Loading...</h4>
      </div>
      
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
	
	
	
}
?>
      
      
      
      
      <!--<header class="navbar-fixed-top <?php echo (basename($_SERVER['PHP_SELF']) == 'tutor-login.php' || basename($_SERVER['PHP_SELF']) == 'parent_login.php' || basename($_SERVER['PHP_SELF']) == 'forgot_password.php') ? 'hidden' : '' ;?>">
         <div class="container">
            <nav class="navbar navbar-default">
               <div class="container-fluid">
                  <div class="col-md-3">
                  <div class="navbar-header">
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     </button>
                     
                     <?php $arrLogo = system::FireCurl(GET_SETTINGS.'?set=COMPANY_LOGO');
                      foreach($arrLogo->data as $logo){ ?>
                    <a class="navbar-brand" href="index.php"><img src="admin/upload/<?php echo $logo->ss_settings_value;?>" class="img-responsive" alt=""/></a>
                     <?php } ?>
                  </div>
                  </div>
                  <div class="form-group">
                  <div class="col-md-1 hidden-xs">
                  <a href="request_a_tutor.php" class="btn btn-info btn-lg get_btntop"><?php echo GET_A_TUTOR; ?></a>
                  </div>
                  

                  <div class="col-md-8 pull-right">
                  <div class="col-md-1 hidden-sm hidden-md hidden-lg" style="margin-top:8px;">
                  <a href="request_a_tutor.php" class="btn btn-info btn-lg get_btntop"><?php echo GET_A_TUTOR; ?></a>
                  </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav navbar-right off_dropd">
                       <?php if(!isset($_SESSION['auth'])) { ?>
                       <?php 
                        if($_SESSION['lang_code']=='' || $_SESSION['lang_code']== $defaultLang){                 
                          $lang_url = str_replace('{lang}/', '', LIST_HEADER_MENU);
                        }
                        elseif( $_SESSION['lang_code']=='BM'){
                         ?>
                         <li class="dropdown">
                          <a href="request_a_tutor.php" class="title btn-success" style="color: white;"><?php echo GET_A_TUTOR; ?></a>
                        </li> 
                         <li class="dropdown">
                          <a href="http://tutorkami.com/" class="title">Utama</a>
                        </li>                           
                      
                        <li class="dropdown">
                          <a href="#" class="title">
                          Log Masuk
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                          <li>
                            <a href="http://tutorkami.com/parent_login.php" class="title">Log Masuk Ibubapa</a>
                          </li> 
                          <li>
                            <a href="http://tutorkami.com/login.php" class="title">Log Masuk Tutor</a>
                          </li> 
                        </ul>
                      </li>                           
                    
                    <li class="dropdown">
                      <a href="#" class="title">Saya Tutor</a>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: none;">
                        <li>
                          <a href="http://tutorkami.com/tutor.php" class="title">Laman Tutor</a>
                        </li> 
                        <li>
                          <a href="http://tutorkami.com/search_job.php" class="title">Job Terkini</a>
                        </li> 
                        <li>
                          <a href="http://tutorkami.com/register.php" class="title">Pendaftaran</a>
                        </li> 
                        <li>
                          <a href="http://tutorkami.com/tutor_faq.php" class="title">Tutor FAQs</a>
                        </li> 
                      </ul>
                    </li>   

                         <?php
                        }
                        else{
                          $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_HEADER_MENU);
                        }

                      
                        $arrHeadMenu = system::FireCurl($lang_url);
                        
                        $staticURLs = array('http://projects.manfredinfotech.com/tutorkami/', 'http://localhost/tutorkami/');  
                        foreach($arrHeadMenu->data as $hmenu){
                           echo str_replace($staticURLs, APP_ROOT, $hmenu->mainmenu);
                        }
                        ?>
                        <li class="dropdown lag">
                           <a id="dLabel" role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" href="#">
                           <?php $arrLan = system::FireCurl(CHOOSEN_LANG.'?lan='.$_SESSION['lang_code']);foreach($arrLan->data as $lan){
                                  ?>
                           <img id="imgNavSel" src="admin/<?=$lan->lang_flag?>" alt="Grossbritanien" class="img-thumbnail icon-small"><span class="caret"></span>
                           <?php }?></a>
                            
                           <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                             <?php 

                              
                              $arrLangs = system::FireCurl(LIST_LANGUAGES);
                              
                              foreach($arrLangs->data as $lang){
                                  if ($lang->lang_status == 'default') {
                                     $lg = '';
                                  } else {
                                    $lg = $lang->lang_code;
                                  }
                              ?>
                              <li class=" <?php echo (isset($_SESSION['lang_code']) && $_SESSION['lang_code'] == $lg) ? 'active' : ''; ?>">
                                 <a id="navEng" href="<?=basename($_SERVER['PHP_SELF']).'?lan='.$lg?>" class="language"><img id="imgNavEng" src="admin/<?=$lang->lang_flag?>" alt="..." class="img-thumbnail icon-small">  <span id="lanNavEng"><?=$lang->lang_name?></span></a>
                              </li>
                              <?php } ?>
                              
                           </ul>
                        </li>


                       <?php } else { ?>
                        <?php if($_SESSION['auth']['user_role'] == '4') { ?>
                        <li class="dropdown">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" href="">
                           <?php echo WELCOME; ?> <?php echo ucfirst($_SESSION['auth']['first_name']); ?> <?php echo ucfirst($_SESSION['auth']['last_name']); ?> <span class="caret"></span></a>
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
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" href="">
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
                  </div>
               </div>
            </nav>
         </div>
      </header>-->
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
          <?php $arrLogo = system::FireCurl(GET_SETTINGS.'?set=COMPANY_LOGO');
          foreach($arrLogo->data as $logo){ ?>
          <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="admin/upload/<?php echo $logo->ss_settings_value;?>" class="img-responsive" alt=""/></a>
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
    <div class="hidden-lg hidden-md hidden-xs pull-right">
      <a href="request_a_tutor.php" style="margin-top:-110px;margin-right:85px;" type="button" class="btn btn-info navbar-sm"><?php echo GET_A_TUTOR; ?></a>
  	</div>
    <div class="hidden-lg hidden-md hidden-sm pull-right">
      <a href="request_a_tutor.php" style="margin-top:-80px;margin-right:40px;" type="button" class="btn btn-info navbar-xs"><?php echo GET_A_TUTOR; ?></a>
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
                        <li class="dropdown">
							<!--<a href="https://www.tutorkami.com/my/index">Utama</a>-->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Utama <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/my/index">Halaman Utama</a></li>
								<li><a href="https://www.tutorkami.com/my/about">Mengenai Kami</a></li>
								<li><a href="https://www.tutorkami.com/my/contact-us">Hubungi Kami</a></li>
							</ul>
                        </li>	
						
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Ibu / Bapa <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/my/search-tutor">Cari Tutor</a></li>
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
								<li><a href="https://www.tutorkami.com/tutor-login.php">Log Masuk Tutor</a></li>
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
						<li class="dropdown">
							<!--<a href="https://www.tutorkami.com/">Home</a>-->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Home <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/index">Home Page</a></li>
								<li><a href="https://www.tutorkami.com/about">About Us</a></li>
								<li><a href="https://www.tutorkami.com/contact-us">Contact Us</a></li>
							</ul>
						</li>
						
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Parents <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/search-tutor">Search Tutor</a></li>
								<li><a href="https://www.tutorkami.com/parent_faq">FAQs</a></li>
								<li><a href="https://www.tutorkami.com/request_a_tutor?tutor_id=i3be8gz">Contact Us</a></li>
								<li><a href="https://www.tutorkami.com/client_login">Log In</a></li>
								
							</ul>
                        </li>
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">I'm a Tutor<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/tutor.php">Tutor’s Page</a></li>
								<li><a href="https://www.tutorkami.com/search_job.php">Latest Jobs</a></li>
								<li><a href="https://www.tutorkami.com/register.php">Register</a></li>
								<li><a href="https://www.tutorkami.com/tutor_faq.php">FAQs</a></li>
								<li><a href="https://www.tutorkami.com/tutor-login.php">Log In</a></li>
							</ul>
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
                           <?php //echo WELCOME; ?> <?php echo ucwords($_SESSION['auth']['first_name']); ?> <?php //echo ucfirst($_SESSION['auth']['last_name']); ?> <span class="caret"></span></a>
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
                           <?php echo WELCOME; ?> <?php echo ucwords($_SESSION['auth']['display_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                              <li><a href="edit_account.php" class="language"><?php echo EDIT_ACCOUNT; ?></a></li>
                              <!--<li><a href="change_password.php" class="language"><?php echo CHANGE_PASSWORD; ?></a></li>-->
                              <?PHP
                                if( isset($tutorDisplayID) && $tutorDisplayID !='' ){
                                    ?>
                                        <li><a href="tutor_profile?did=<?PHP echo $tutorDisplayID; ?>" class="language"><?php echo VIEW_PROFILE; ?></a></li>
                                    <?PHP
                                }else{
                                    ?>
                                        <li><a href="view_profile.php" class="language"><?php echo VIEW_PROFILE; ?></a></li>
                                    <?PHP
                                }
                              ?>
                              <li><a href="tutor_list_of_classes.php" class="language"><?php echo LIST_OF_CLASSES; ?></a></li>
                              <!--<li><a href="tutor_payment_history.php" class="language"><?php echo PAYMENT_HISTORY; ?></a></li>-->
                              <li><a href="search_job.php" class="language"><?php echo LATEST_JOB; ?></a></li>
                              <li><a href="tutor_guide.php" class="language"><?php echo TUTOR_GUIDE; ?></a></li>
                              <li><a href="terms-one-to-one" class="language"><?php echo "Terms"; ?></a></li>
							  <li><a href="payments-tutor.php" class="language"><?php echo "Payments"; ?></a></li>
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
    var menu_opened = $('#bs-example-navbar-collapse-1').hasClass('in');
  
    if(!$(e.target).closest('#bs-example-navbar-collapse-1').length &&
        !$(e.target).is('#bs-example-navbar-collapse-1') &&
        menu_opened === true){
            $('#bs-example-navbar-collapse-1').collapse('toggle');
    }

});
</script>