<?php 
require_once('includes/head.php');
//require_once('includes/compress-image.php');
require_once('includes/create-thumb.php');
require_once('includes/create-thumb2.php');

define('IMAGE_SMALL_DIR', 'images/profile/small/');
define('IMAGE_SMALL_SIZE', 50);
define('IMAGE_MEDIUM_DIR', 'images/profile/');
define('IMAGE_MEDIUM_SIZE', 250);

# SESSION CHECK #


if (isset($_SESSION['auth'])) {


  header('Location: tutor.php');


  exit();


}


if (count($_POST) > 0) { 


  $data = $_POST;


  $error = 0;


  if (count($_FILES) > 0) { 





    $name       = $_FILES['u_profile_pic']['name'];


    $imgext     = explode(".", $name);


    $imgext     = end($imgext);


    $tmpname    = $_FILES['u_profile_pic']['tmp_name'];


    $extension  = array('jpg', 'jpeg', 'png', 'bmp');


    $path_parts = pathinfo($_FILES['u_profile_pic']['name']);

    $imagenumber = rand(5000,10000);
    $namaFile = date("Ymd-His")."-".$data['u_email'];

    
	/*	
      if($_FILES['u_profile_pic']['size'] <= 512000){

        if(in_array($imgext, $extension)){

		  move_uploaded_file($tmpname, "images/profile/000".$imagenumber.'_0.jpg');
          $picture_path = $imagenumber;//luqman buat so nnti image save sbagai number.sbb manfred dh set sume image read sbgai number

        } else{

          $error++;
          Session::SetFlushMsg("error",'File you tried to upload is not an image. You can\'t upload this file.');

        }

      } else {

        if(in_array($imgext, $extension)){

          $path = "images/profile/";
          $actual_image_name = '000'.$imagenumber.'_0.jpg';
          compressImage($imgext,$tmpname,$path,$actual_image_name,'200');
          $picture_path = $imagenumber;//luqman buat so nnti image save sbagai number.sbb manfred dh set sume image read sbgai number

        } else{

          $error++;
          Session::SetFlushMsg("error",'File you tried to upload is not an image. You can\'t upload this file.');

        }

      }    */
if(!empty($name) || $name != ''){
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	  
	if ($_FILES['u_profile_pic']["error"] > 0) {
		$error++;
		Session::SetFlushMsg("error",'Error in File');
	}
	else if (!in_array($_FILES['u_profile_pic']["type"], $allowedImageType)) {
		$error++;
		Session::SetFlushMsg("error",'You can only upload JPG, PNG and GIF file');
	}
	/*else if (round($_FILES['u_profile_pic']["size"] / 1024) > 1096) {
		$error++;
		Session::SetFlushMsg("error",'You can only upload photo with size up to 1MB');
	}*/ else {
		/*create directory with 777 permission if not exist - start*/
		//createDir(IMAGE_SMALL_DIR);
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $_FILES['u_profile_pic']['tmp_name'];
		$file = pathinfo($_FILES['u_profile_pic']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		//$fileNameNew = "000".$imagenumber.'_0.jpg';
		$fileNameNew = $namaFile.'.jpg';
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
		
		//createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE);
		// https://salman-w.blogspot.com/2008/10/resize-images-using-phpgd-library.html
        process_image_upload('u_profile_pic', $namaFile);
		//createThumb($path[1], $path[2],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE);
		$picture_path = $namaFile;
	}
}


  }





  if ($error == 0) {


    


    $data['u_profile_pic'] = isset($picture_path) ? $picture_path : '';


    $data['ud_dob'] = implode('-', array_reverse($_POST['ud_dob']));


    


    $output = system::FireCurl(REGISTRATION_URL, "POST", "JSON", $data);


    // var_dump($output->flag);die;//NULL bila success tapi data masuk db

 // if ($output->flag != 'error') {//ni kua mesej kt bawah ni
    if ($output->flag == 'success') {
        header('Location: registration-success.php');
        Session::SetFlushMsg($output->flag, $output->message);
        exit();
    } else {
        Session::SetFlushMsg($output->flag, $output->message);
    }


  }


  


}





//$getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');





//include('includes/header.php');?>
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
      <!--<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
	  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	  <!--<link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
	  <link rel="stylesheet" href="css/swiper.min.css">  -->
      
      <!-- Autocomplete -->
      <link rel="stylesheet" href="css/jquery-ui.css">
      <link rel="stylesheet" href="css/flush.css">
      <link rel="stylesheet" href="css/custom.css">
      <!--<link rel="stylesheet" type="text/css" href="css/component.css" />-->
      
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
      <script type="text/javascript" src="js/jquery.validate.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
            

          $('#registration-form').validate({
            errorClass: 'testing',
            rules: {
             'ud_phone_number' : { required:true, digits: true },
             'ud_dob[0]':{ required:true },
             'ud_dob[1]':{ required:true },
             'ud_dob[2]':{ required:true },
             'u_gender':{ required:true },
             'search_ud_city' : { required:true },
             'conduct_online' : { required:true },
             'hiddentoolsname1' : {
                  required: function() {
                  var v = $('input[name=conduct_online]:checked').val();
                     if (v == 'Yes'){
                         return true;
                     }else{
                         return false;
                     }
                  }
             },
             'conduct_class' : { required:true },
             'cover_area_state[]' : { required:true },
             'tutor_course[]' : { required:true },
             'ud_tutor_experienceError' : { required:true },
             'ud_about_yourself' : { required:true },
             'agreement' : { required:true }
            },


              invalidHandler: function(form, validator) {
                       var errors = validator.numberOfInvalids();
                        if (errors) {
                            var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';
            
                            /*$("#err_report").html(message).addClass("text-error");
                            $("#err_report").html(message); 
                             var element = document.getElementById("toast-container");
                             element.classList.remove("hidden"); */
                             //getStickyNote('error','Error in updating profile. Please re check the fields');
                        }
                 
              },

            
            errorPlacement: function (error, element) {
                if ( (element.attr("name") == "u_email") ) { error.appendTo("#messageBoxEmail"); } else { //error.insertAfter(element) 
                }
                if ( (element.attr("name") == "u_password") )    { error.appendTo("#messageBoxPassword"); }
                if ( (element.attr("name") == "con_password") )  { error.appendTo("#messageBoxConPassword"); }
                if ( (element.attr("name") == "ud_first_name") ) { error.appendTo("#messageBoxFirst"); }
                if ( (element.attr("name") == "ud_last_name") )  { error.appendTo("#messageBoxLast"); }
                if ( (element.attr("name") == "u_displayname") ) { error.appendTo("#messageBoxDisplayname"); }
                if ( (element.attr("name") == "ud_phone_number") ) { error.appendTo("#messageBoxPhone"); }
                if ( (element.attr("name") == "ud_dob[0]") || (element.attr("name") == "ud_dob[1]") || (element.attr("name") == "ud_dob[2]") ) {
                    error.appendTo("#messageBoxDOB"); 
                }
                if ( (element.attr("name") == "u_gender") ) { error.appendTo("#messageBoxGender"); }
                if ( (element.attr("name") == "search_ud_city") ) { error.appendTo("#messageBoxCity"); }
                if ( (element.attr("name") == "conduct_online") ) { error.appendTo("#messageBoxConductOnline"); }
                if ( (element.attr("name") == "hiddentoolsname1") ) { error.appendTo("#messageBoxHiddentoolsname1"); }
                if ( (element.attr("name") == "conduct_class") ) { error.appendTo("#messageBoxConductClass"); }
                if ( (element.attr("name") == "cover_area_state[]") ) { error.appendTo("#messageBoxAreaCover"); }
                if ( (element.attr("name") == "tutor_course[]") ) { error.appendTo("#messageBoxSujectTech"); }
                if ( (element.attr("name") == "ud_tutor_experienceError") ) { error.appendTo("#messageBoxExperience"); }
                if ( (element.attr("name") == "ud_about_yourself") ) { error.appendTo("#messageBoxAboutYourself"); }
                if ( (element.attr("name") == "agreement") ) { error.appendTo("#messageBoxAgreement"); }
            },
            messages: {
             'ud_phone_number' : '- Phone number is required & numeric only',
             'ud_dob[0]': '&nbsp;',
             'ud_dob[1]': '- Date of birth is required.',
             'ud_dob[2]': '&nbsp;',
             'u_gender': '- Gender is required',
             'search_ud_city': '- This detail is required',
             'conduct_online': '- This detail is required',
             'hiddentoolsname1': '- You must tick at least 1 tool',
             'conduct_class': '- This detail is required',
             'cover_area_state[]': '- Areas you can cover is required',
             'tutor_course[]': '- Subjects you can teach is required',
             'ud_tutor_experienceError': '- Experience is required',
             'ud_about_yourself': '- About yourself is required',
             'agreement': '- Before continuing, you’ll need to agree to our terms'
            }
          });
            
/*
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
             'search_ud_city' : { required:true },
             'conduct_online' : { required:true },
             'ud_phone_number' : { required:true, digits: true }
            },
            messages: {
             'u_gender': '- Gender is required.',
             'ud_dob[0]': '',
             'ud_dob[1]': '',
             'ud_dob[2]': '- Date of birth is required.',
             'cover_area_state[]': '- Areas you can cover is required',
             'tutor_course[]': '- Subjects you can teach is required',
             'ud_about_yourself': '- About yourself is required.',
             'search_ud_city': '- This detail is required',
             'conduct_online': '- This detail is required',
             'ud_phone_number' : '- Phone number is required & numeric only'
            }
          });
*/
        });
      </script> 
	  <style>
        .testing {}
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


<style>


  .form_error {


    display: none;


  }


  input.error {


    border: 1px solid #ff0101;


  }


  label.error {


    color: #ff0101;


    font-style: italic;


    font-weight: normal;


  }


  .myform [type="checkbox"]:not(:checked) + label.custom::before, 


  .myform [type="checkbox"]:checked + label.custom::before {


    background: #fff;


    border: 1px solid #ccc;


    border-radius: 0;


    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) inset;


    content: "";


    height: 20px;


    left: 0;


    position: absolute;


    top: 0;


    width: 20px;


  }





  @media (min-width: 768px) {


    label.error {


      position: absolute;


      top: 5px;


      left: 408px;


      width: 290px;


      max-width: 290px;


    }


    label[for="ud_dob_2"].error {


      left: 276px;


    }


    label[for="ud_dob_3"].error {


      left: 144px;


    }


    label[for="agreement"].error {


      left: 280px;


      width: 360px;


      max-width: 360px;


    }


  }


  ui-tooltip-content {


    line-height: 10px;


  }




::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    font-size: 13px;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    font-size: 13px;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    font-size: 13px;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
    font-size: 13px;
}

    .input-group-addon,
    .input-group-addon + input {
       border: none;
       background-color:transparent;
       color:transparent;
    }
    
.select2-results__option { 
  font-size: 15px;
}

.select2-selection__arrow b{
    display:none !important;
}
</style>
<style>
.this label {
  /*margin: 2em;*/
  display: inline-block;
  position: relative;
  padding-left: 30px;
  cursor: pointer;
  font-weight:normal;
  font-size:15px;
}

.this input {
  height: 1px;
  width: 1px;
  opacity: 0;
}

.outside {
  display: inline-block;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -10px;
  width: 20px;
  height: 20px;
  border: 2px solid #7C7674;
  border-radius: 50%;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  background: none;
}

.inside {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  display: inline-block;
  border-radius: 50%;
  width: 10px;
  height: 10px;
  background: #7C7674;
  left: 3px;
  top: 3px;
  -webkit-transform: scale(0, 0);
          transform: scale(0, 0);
}


input:checked + .outside .inside {
  -webkit-animation: radio-select 0.1s linear;
          animation: radio-select 0.1s linear;
  -webkit-transform: scale(1, 1);
          transform: scale(1, 1);
}
</style>

<section class="client_profile myform" style="margin-top:-60px;" >


  <div class="container">


    <div class="row">


      <div class="col-md-12 col-sm-8">


        <div>


          <h1 class="blue-txt text-uppercase text-center"><?php echo TUTOR_REGISTRATION; ?></h1>


          <hr>


        </div>


        <p><span class="rad-txt">*</span> <?php echo REQUIRED; ?><br>


          <?php echo REGISTER_CONTACT_US_PHONE; ?> </p>


        <div class="col-md-10 mrg_top30">


          <form class="form-horizontal" method="post" enctype="multipart/form-data" id="registration-form">

<!-- luqman -->
            <div class="form-group hidden">


              <label class="control-label col-sm-4" for="pwd"><?php echo USERNAME; ?>*</label>


              <div class="col-sm-8">


                <input type="hidden" class="form-control" name="u_username" id="u_username" value="<?php echo isset($_POST['u_username']) ? $_POST['u_username']: time();?>">


              </div>


            </div>
<!-- luqman -->

            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo EMAIL; ?> : *</label>


              <div class="col-sm-5">

                <span id="messageBoxEmail" style="color:#dc3545"></span>
                <input type="email" class="form-control" id="u_email" name="u_email" value="<?php echo isset($_POST['u_email']) ? $_POST['u_email']: '';?>" data-rule-required="true" data-msg-required="- Email is required.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo PASSWORD; ?> : *</label>


              <div class="col-sm-5">

                <span id="messageBoxPassword" style="color:#dc3545"></span>
                <input type="password" class="form-control" id="u_password" name="u_password" data-rule-required="true" data-msg-required="- Password is required.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo CONFIRM_PASSWORD; ?> : *</label>


              <div class="col-sm-5">

                <span id="messageBoxConPassword" style="color:#dc3545"></span>
                <input type="password" class="form-control" id="con_password" name="con_password" data-rule-equalto="#u_password" data-msg-required="- Password mismatch.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo FIRST_NAME; ?> : *</label>


              <div class="col-sm-5">

                <span id="messageBoxFirst" style="color:#dc3545"></span>
                <input type="text" class="form-control" id="ud_first_name" name="ud_first_name" value="<?php echo isset($_POST['ud_first_name']) ? $_POST['ud_first_name']: '';?>" data-rule-required="true" data-msg-required="- First name is required.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo LAST_NAME; ?> : *</label>


              <div class="col-sm-5">

                <span id="messageBoxLast" style="color:#dc3545"></span>
                <input type="text" class="form-control" id="ud_last_name" name="ud_last_name" value="<?php echo isset($_POST['ud_last_name']) ? $_POST['ud_last_name']: '';?>" data-rule-required="true" data-msg-required="- Last name is required.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo DISPLAY_NAME; ?> : *</label>


              <div class="col-sm-5">

                <span id="messageBoxDisplayname" style="color:#dc3545"></span>
                <input type="text" class="form-control" placeholder="<?php echo DISPLAY_NAME_EXAMPLE; ?>" id="u_displayname" name="u_displayname" value="<?php echo isset($_POST['u_displayname']) ? $_POST['u_displayname']: '';?>" data-rule-required="true" data-msg-required="- Display name is required.">


                <!--<label class="box_text_1"><?php //echo DISPLAY_NAME_EXAMPLE; ?></label>-->


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo PHONE_NUMBER; ?> : *</label>


              <div class="col-sm-5">

                <span id="messageBoxPhone" style="color:#dc3545"></span>
                <input type="text" class="form-control" id="ud_phone_number" name="ud_phone_number" value="<?php echo isset($_POST['ud_phone_number']) ? $_POST['ud_phone_number']: '';?>" />


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="ud_dob_1"><?php echo DOB; ?> : *</label>


              <div class="col-sm-5">

                <span id="messageBoxDOB" style="color:#dc3545;"></span>
                <div class="row rdc_pad">


                  <div class="col-md-4">


                    <select class="form-control" id="ud_dob_1" name="ud_dob[0]">


                      <option value=""><?php echo DOB_DAY; ?></option>


                      <?php


                      for ($i=1; $i < 32; $i++) {


                        $sl1 =  (isset($_POST) && $_POST['ud_dob'][0] == $i) ? 'selected' : '';


                        $dt = ($i < 10)? '0'.$i : $i;


                        echo '<option value="'.$dt.'" '.$sl1.'>'.$i.'</option>';


                      }


                      ?>


                    </select>


                  </div>


                  <div class="col-md-4">


                    <select class="form-control" id="ud_dob_2" name="ud_dob[1]">


                      <option value=""><?php echo DOB_MONTH; ?></option>


                      <?php


                      $m_arr = array('01' => 'January',


                        '02' => 'February',


                        '03' => 'March ',


                        '04' => 'April ',


                        '05' => 'May ',


                        '06' => 'June ',


                        '07' => 'July ',


                        '08' => 'August ',


                        '09' => 'September',


                        '10' =>'October',


                        '11' => 'November',


                        '12' => 'December'


                        );


                      foreach ($m_arr as $key => $value) {


                        $sl2 =  (isset($_POST) && $_POST['ud_dob'][1] == $key) ? 'selected' : '';


                        echo '<option value="'.$key.'" '.$sl2.'>'.$value.'</option>';


                      }


                      ?>


                    </select>


                  </div>


                  <div class="col-md-4">


                    <select class="form-control" id="ud_dob_3" name="ud_dob[2]">


                      <option value=""><?php echo DOB_YEAR; ?></option>


                      <?php


                      for ($j=2005; $j > 1950; $j--) {


                        $sl3 =  (isset($_POST) && $_POST['ud_dob'][2] == $j) ? 'selected' : '';


                        echo '<option value="'.$j.'" '.$sl3.'>'.$j.'</option>';


                      }


                      ?>


                    </select>


                  </div>


                </div>


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="u_gender_m"><?php echo GENDER; ?> : *</label>


              <div class="col-sm-8 radio_font">

                <span id="messageBoxGender" style="color:#dc3545"></span>
                <div class="row">

                <div class="col-sm-12">
                    <div class="this">
                        <label><input type="radio" class="radio-inline" name="u_gender" value="M" id="u_gender_m" <?php echo isset($_POST['u_gender']) && $_POST['u_gender'] == 'M' ? 'checked' : (!isset($_POST['u_gender']) ? 'checked' : '');?> ><span class="outside"><span class="inside"></span></span><?php echo MALE; ?></label>
                        <span style="padding-left: 54px;" ></span>
                        <label><input type="radio" class="radio-inline" name="u_gender" value="F" id="u_gender_f" <?php echo isset($_POST['u_gender']) && $_POST['u_gender'] == 'F' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo FEMALE; ?></label>
                    </div>
                </div>
                  <!--<div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="u_gender" value="M" id="u_gender_m" <?php //echo isset($_POST['u_gender']) && $_POST['u_gender'] == 'M' ? 'checked' : (!isset($_POST['u_gender']) ? 'checked' : '');?>>


                      <?php //echo MALE; ?></label>


                  </div>


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="u_gender" value="F" id="u_gender_f" <?php //echo isset($_POST['u_gender']) && $_POST['u_gender'] == 'F' ? 'checked' : '';?>>


                      <?php //echo FEMALE; ?></label>


                  </div>-->


                </div>


              </div>


            </div>

<?php
		/*$ipAddress = $_SERVER['REMOTE_ADDR'];
		$resultIpAddress = json_decode(file_get_contents("http://ipinfo.io/{$ipAddress}/json"));
		$dataIpAddress = $resultIpAddress->ip." - C : ".$resultIpAddress->country." - R : ".$resultIpAddress->region." - CT : ".$resultIpAddress->city;*/
		
		
   if (getenv('HTTP_X_FORWARDED_FOR')) {
       $pipaddress = getenv('HTTP_X_FORWARDED_FOR');
       $ipaddress = getenv('REMOTE_ADDR'); 
       $dataIpAddress = "Proxy IP : ".$pipaddress. "(via $ipaddress)" ; 
   }else { 
       $ipaddress = getenv('REMOTE_ADDR'); 
       $dataIpAddress = "$ipaddress"; 
   }
		

?>
<input type="hidden" class="form-control" id="ip_address" name="ip_address" value="<?php echo $dataIpAddress;?>">


            <!--<div class="form-group">


              <label class="control-label col-sm-4" for="udcity"><?php //echo YOUR_LOCATION; ?>*</label>


              <div class="col-sm-5">


                <textarea name="ud_city" id="ud_city" class="form-control" data-rule-required="true" data-msg-required="- Location information is required."><?php //echo isset($_POST['ud_city']) ? $_POST['ud_city']: '';?></textarea>


                <label class="box_text_1"><?php //echo YOUR_LOCATION_EXAMPLE; ?></label>


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>-->
            
            
            
            
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo 'The Location You Are Currently Staying In'; ?> : *</label>
                <div class="col-sm-4">
                    <!--<select class="form-control" name="search_ud_state" id="search_ud_state" data-rule-required="true" data-msg-required="- required.">
                    <option value="">Please Select State</option>
                    <?php 
                    /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                    if ($dbCon->connect_error) {
                        die("Connection failed: " . $dbCon->connect_error);
                    } 
                    $queryState = "SELECT * FROM tk_states ORDER BY st_name ASC"; 
                    $resultState = $dbCon->query($queryState); 
                    if($resultState->num_rows > 0){ 
                        while($rowState = $resultState->fetch_assoc()){
                            $sel = (isset($user_info['ud_state']) && $user_info['ud_state'] == $rowState['st_id']) ? 'selected' : (($user_info['ud_state'] == $rowState['st_id']) ? 'selected' : '' );
                            echo '<option value="'. $rowState['st_id'] .'" '.$sel.'>'. $rowState['st_name'] .'</option>';
                        }
                    }*/
                    ?>
                    </select>-->
                    <!--<select class="js-example-basic-single" name="search_ud_state" id="search_ud_state" style="width: 100%"  data-rule-required="true" data-msg-required="- required.">
                    <option value="">Please Select State</option>
                    <?php 
                    /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                    if ($dbCon->connect_error) {
                        die("Connection failed: " . $dbCon->connect_error);
                    } 
                    $queryState = "SELECT * FROM tk_states ORDER BY st_name ASC"; 
                    $resultState = $dbCon->query($queryState); 
                    if($resultState->num_rows > 0){ 
                        while($rowState = $resultState->fetch_assoc()){
                            $sel = (isset($user_info['ud_state']) && $user_info['ud_state'] == $rowState['st_id']) ? 'selected' : (($user_info['ud_state'] == $rowState['st_id']) ? 'selected' : '' );
                            echo '<option value="'. $rowState['st_id'] .'" '.$sel.'>'. $rowState['st_name'] .'</option>';
                        }
                    }*/
                    ?>
                    </select>-->
                                            <span id="messageBoxCity" style="color:#dc3545"></span>
                                            <select required class="js-example-basic-single" name="search_ud_city" id="search_ud_city" style="width: 100%" >
                                            <option value="">Please Select State</option>
										   <?php 
											 $conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
											 if ($conn->connect_error) {
											    die("Connection failed: " . $conn->connect_error);
											 }
											 $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
											 $rowDataState = $conn->query($queryDataState);
											 if ($rowDataState->num_rows > 0) {
												while($resultDataState= $rowDataState->fetch_assoc()){
													echo '<optgroup label="'. $resultDataState['st_name'] .'">';
													
														 $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_st_id = '".$resultDataState['st_id']."' ORDER BY city_name ASC ";
														 $rowDataCity = $conn->query($queryDataCity);
														 if ($rowDataCity->num_rows > 0) {
															while($resultDataCity = $rowDataCity->fetch_assoc()){
																echo '<option value="'. $resultDataCity['city_id'] .'">'. $resultDataCity['city_name'] .'</option>';
															}			
														 }
													
													echo '</optgroup>';
												}			
											 }
										   ?>
                                       </select><label class="box_text_1"><font color="#262262"><?php echo YOUR_LOCATION_EXAMPLE; ?></font></label>
                    
                    
                    
                    
                    
                </div>
                <div class="col-sm-4">
                    
                    <div id="search_ud_stateText" name="search_ud_stateText"></div>
                                       
                    <!--<select class="form-control" name="search_ud_city" id="search_ud_city" data-rule-required="true" data-msg-required="- This detail is required">
                        <?PHP
                        /*if(isset($user_info['ud_state']) && $user_info['ud_state'] != ''){
                            $queryCity = "SELECT * FROM tk_cities WHERE city_st_id = '".$user_info['ud_state']."' ORDER BY city_name ASC"; 
                            $resultCity = $dbCon->query($queryCity); 
                            if($resultCity->num_rows > 0){ 
                                while($rowCity = $resultCity->fetch_assoc()){
                                    $sel2 = (isset($user_info['ud_city']) && $user_info['ud_city'] == $rowCity['city_id']) ? 'selected' : (($user_info['ud_city'] == $rowCity['city_id']) ? 'selected' : '' );
                                    echo '<option value="'. $rowCity['city_id'] .'" '.$sel2.'>'. $rowCity['city_name'] .'</option>';
                                }
                            }                            
                        }*/
                        ?>
                    </select><label class="box_text_1"><font color="#262262"><?php //echo YOUR_LOCATION_EXAMPLE; ?></font></label>-->
                    
                    <!--<select class="js-example-basic-single" name="search_ud_city" id="search_ud_city" style="width: 100%"  data-rule-required="true" data-msg-required="- This detail is required">
                        <?PHP
                        /*if(isset($user_info['ud_state']) && $user_info['ud_state'] != ''){
                            $queryCity = "SELECT * FROM tk_cities WHERE city_st_id = '".$user_info['ud_state']."' ORDER BY city_name ASC"; 
                            $resultCity = $dbCon->query($queryCity); 
                            if($resultCity->num_rows > 0){ 
                                while($rowCity = $resultCity->fetch_assoc()){
                                    $sel2 = (isset($user_info['ud_city']) && $user_info['ud_city'] == $rowCity['city_id']) ? 'selected' : (($user_info['ud_city'] == $rowCity['city_id']) ? 'selected' : '' );
                                    echo '<option value="'. $rowCity['city_id'] .'" '.$sel2.'>'. $rowCity['city_name'] .'</option>';
                                }
                            }                            
                        }*/
                        ?>
                    </select>-->
                    
                    
                </div>
                <div class="col-sm-3 form_error">Error</div>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd"><?php echo CONDUCT_ONLINE; ?> : * <font color="black"><a id="popoverData" class="hidden" data-html="true" data-content="Please tick the tool for online teaching that you are familiar with (you can tick more than 1 tool)" rel="popover" data-placement="bottom" data-trigger="hover"><span class="glyphicon glyphicon-info-sign" style="margin-top:0px;color:#262262" ></span></a></font>
              <br/><a href="https://www.tutorkami.com/tuition/kelas-online-part-1/" target="_blank" class="box_text_2 sample-tooltip"><font color="blue" style="text-decoration: underline;"><?php echo 'Click here to learn how you can start online tutoring'; ?></font></a>
              </label>
              <div class="col-sm-8 radio_font">
                <span id="messageBoxConductOnline" style="color:#dc3545"></span><span id="messageBoxHiddentoolsname1" style="color:#dc3545"></span>
                <div class="row">
                  <!--<div class="col-md-6">
                    <label class="radio-inline udradio2" style="font-size:15px;">
                      <input type="radio" name="conduct_online" value="Yes" <?php echo isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'Yes' ? 'checked' : (!isset($_POST['conduct_online']) ? '' : '');?> data-rule-required="true" data-msg-required="- This detail is required">
                      <?php //echo YES; ?></label>
                  </div>

                  <div class="col-md-6">
                    <label class="radio-inline udradio2" style="font-size:15px;">
                      <input type="radio" name="conduct_online" value="No" <?php echo isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'No' ? 'checked' : '';?>>
                      <?php //echo NO; ?></label>
                  </div>-->
                    <div class="col-sm-12">
                        <div class="this">
                            <label class="udradio2" ><input type="radio" class="radio-inline" name="conduct_online" value="Yes" <?php echo isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'Yes' ? 'checked' : (!isset($_POST['conduct_online']) ? '' : '');?> ><span class="outside"><span class="inside"></span></span><?php echo YES; ?></label>
                            <span style="padding-left: 65px;" ></span>
                            <label class="udradio2" ><input type="radio" class="radio-inline" name="conduct_online" value="No" <?php echo isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'No' ? 'checked' : '';?>  ><span class="outside"><span class="inside"></span></span><?php echo NO; ?></label>
                        </div>
                    </div>
                </div>
                <!--<div class="notice"><?PHP //if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo ""; }else{ echo "If you tick Yes, please specify in ‘About Yourself’ section what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc"; }?></div>-->
                <div id="conduct_online_wrap" class="hidden">
                   <?php 
/*
                   if ( isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'Yes' ) {

                      echo '<textarea style="height:70px;" placeholder="Please state what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc" name="conduct_online_text" class="form-control">'.$_POST['conduct_online_text'].'</textarea>';

                   }  
*/
                   ?>
<style>
/* https://bootsnipp.com/snippets/oPgeG */
.checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}

@media only screen and (max-width: 600px) {
  .mobileCheckbox {
    padding-right:3%;
  }
  .mobileCheckboxFont {
    font-size: 0.7em;
  }
}
@media only screen and (min-width: 601px) {
  .mobileCheckbox {
    padding-right:30%;
  }
  .mobileCheckboxFont {
    font-size: 1em;
  }
}
</style>
					<div class="dropbox" style="background-color:white;cursor: pointer;">Tools</div>
					<div class="dropPop">
						<div class="row">
							<div class="col-xs-12">
								<div class="pull-left checkbox mobileCheckboxFont">
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Microsoft Teams"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Microsoft Teams</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Google Hangouts"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Hangouts</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Google Meet"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Meet</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Google Classroom"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Classroom</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Google Duo"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Duo</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Google Doc"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Doc</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Zoom"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Zoom</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Skype"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Skype</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="WhatsApp"><span class="cr"><i class="cr-icon fa fa-check"></i></span>What's App</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Telegram"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Telegram</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Lark"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Lark</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="GeoGebra"><span class="cr"><i class="cr-icon fa fa-check"></i></span>GeoGebra</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Whereby"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Whereby</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Others"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Others</label><br>
								</div>
								<div class="pull-right checkbox mobileCheckbox mobileCheckboxFont">
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Phone Call"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Phone Call</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Video Call"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Video Call</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Webex"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Webex</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="YouTube"><span class="cr"><i class="cr-icon fa fa-check"></i></span>YouTube</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Facebook"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Facebook</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="FaceTime"><span class="cr"><i class="cr-icon fa fa-check"></i></span>FaceTime</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Instagram"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Instagram</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Email"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Email</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Quizziz"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Quizziz</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Kahoot"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Kahoot</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Chegg"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Chegg</label><br>
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="Edmodo"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Edmodo</label><br>	
									<label style="font-size: 1em"><input type="checkbox" onchange="handleChange1();" name="toolsname1" value="TeamLink"><span class="cr"><i class="cr-icon fa fa-check"></i></span>TeamLink</label>			
								</div>
							</div>
							<div class="col-xs-12">
							    <div class="pull-left checkbox mobileCheckboxFont"> 
									<label style="font-size: 1em" id="conduct_online_other" class="hidden" ><textarea cols="25" rows="50" style="overflow-y: scroll;" class="form-control" name="conduct_online_other" placeholder="Type the name of the tool"></textarea></label>	
							    </div>
							</div>
						</div><br/>
					</div><input style="width: 2px;border:none;background-color:#f3f3f5;color:#f3f3f5" type="text" id="hiddentoolsname1" name="hiddentoolsname1" value="">

                </div>
              </div>
               <div class="col-sm-3 form_error">Error</div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd"><?php echo CONDUCT_CLASS; ?> : *</label>
              <div class="col-sm-8 radio_font">
                <span id="messageBoxConductClass" style="color:#dc3545"></span>
                <div class="row">
                  <!--<div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="conduct_class" value="Yes" <?php echo isset($_POST['conduct_class']) && $_POST['conduct_class'] == 'Yes' ? 'checked' : (!isset($_POST['conduct_class']) ? '' : '');?> data-rule-required="true" data-msg-required="- This detail is required">
                      <?php //echo YES; ?></label>
                  </div>

                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="conduct_class" value="No" <?php echo isset($_POST['conduct_class']) && $_POST['conduct_class'] == 'No' ? 'checked' : '';?>>
                      <?php //echo NO; ?></label>
                  </div>-->
                    <div class="col-sm-12">
                        <div class="this">
                            <label><input type="radio" class="radio-inline" name="conduct_class" value="Yes" <?php echo isset($_POST['conduct_class']) && $_POST['conduct_class'] == 'Yes' ? 'checked' : (!isset($_POST['conduct_class']) ? '' : '');?> ><span class="outside"><span class="inside"></span></span><?php echo YES; ?></label>
                            <span style="padding-left: 65px;" ></span>
                            <label><input type="radio" class="radio-inline" name="conduct_class" value="No" <?php echo isset($_POST['conduct_class']) && $_POST['conduct_class'] == 'No' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo NO; ?></label>
                        </div>
                    </div>
                </div>
              </div>
               <div class="col-sm-3 form_error">Error</div>
            </div>
            
            
            
            


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo STATUS_AS_TUTOR; ?> :</label>


              <div class="col-sm-8 radio_font">


                <!--<div class="row">


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="ud_tutor_status" value="Full Time" <?php //echo isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Full Time' ? 'checked' : (!isset($_POST['ud_tutor_status']) ? 'checked' : '');?>>


                      <?php //echo FULL_TIME; ?></label>


                  </div>


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="ud_tutor_status" value="Part Time" <?php //echo isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Part Time' ? 'checked' : '';?>>


                      <?php //echo PART_TIME; ?></label>


                  </div>


                </div>-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="this">
                            <label><input type="radio" class="radio-inline" name="ud_tutor_status" value="Full Time" <?php echo isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Full Time' ? 'checked' : (!isset($_POST['ud_tutor_status']) ? 'checked' : '');?> ><span class="outside"><span class="inside"></span></span><?php echo FULL_TIME; ?></label>
                            <span style="padding-left: 30px;" ></span>
                            <label><input type="radio" class="radio-inline" name="ud_tutor_status" value="Part Time" <?php echo isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Part Time' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo PART_TIME; ?></label>
                        </div>
                    </div>
                </div>

              </div>


            </div>

<!-- prob -->
            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo AREA_YOU_CAN_COVER; ?> : *</label>


              <div class="col-sm-8">

                <span id="messageBoxAreaCover" style="color:#dc3545"></span>
                <div class="row">


                  <?php 


                  //if ($getAllCountries->flag == 'success' && count($getAllCountries->data) > 0) {//1


                    $i = 0;


                    //foreach ($getAllCountries->data as $key => $country) {//2


                      // Get State By Country Id


                      //$getCountryWiseStates = system::FireCurl(LIST_STATE_URL.'?country_id='.$country->c_id);
					  $getCountryWiseStates = system::FireCurl(LIST_STATE_URL.'?country_id=150');


                      if ($getCountryWiseStates->flag == 'success' && count($getCountryWiseStates->data) > 0) {//3


                        foreach ($getCountryWiseStates->data as $key => $state) {//4


                  ?>


                  <div class="col-md-6">


                     <div class="checkbox">                        

<input type="hidden" name="clickornot<?php echo $state->st_id; ?>" id="clickornot<?php echo $state->st_id; ?>" value="clickornot<?php echo $state->st_id; ?>">
                         <input type="checkbox" name="cover_area_state[]" id="ca_state_<?php echo $state->st_id; ?>" value="<?php echo $state->st_id; ?>" onchange="checkAll(this, '<?php echo 'cover_area_city_'.$state->st_id;?>')" <?php echo isset($_POST['cover_area_state']) && (in_array($state->st_id, $_POST['cover_area_state'])) ? 'checked':'';?>>


                         <!--<label for="ca_state_<?php echo $state->st_id; ?>" class="custom"><?php echo $state->st_name; ?></label>-->
                         <label  id="ca_state_<?php echo $state->st_id; ?>" class="custom" value="<?php echo $state->st_id; ?>" onClick="myFunction(this, '<?php echo 'cover_area_city_'.$state->st_id;?>', '<?php echo $state->st_id;?>')" ><?php if($getLan == "/my/"){ echo $state->st_name_bm; }else{ echo $state->st_name; } //echo $state->st_name; ?></label>

<!-- sini problem -->
                        <?php 


                        // Get City By State Id


                        $getStateWiseCity = system::FireCurl(LIST_CITY_URL.'?state_id='.$state->st_id);


                        if ($getStateWiseCity->flag == 'success' && count($getStateWiseCity->data) > 0) {//5


                        ?>

<!-- sini problem -->
                        <div class="showHide" style="display: <?php echo isset($_POST['cover_area_state']) && (in_array($state->st_id, $_POST['cover_area_state'])) ? 'block':'none';?>;">


                           <!--<div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>-->


                           <div class="dropPop" style="display: <?php echo isset($_POST['cover_area_state']) && (in_array($state->st_id, $_POST['cover_area_state'])) ? 'block':'none';?>;">


                              <div class="row">


                                 <div class="col-md-12"><!--<a href="javascript:void(0);" onclick="tickAll('ca_state_<?php //echo $state->st_id; ?>', '<?php //echo 'cover_area_city_'.$state->st_id;?>');">Tick All</a>--> <a href="javascript:void(0);" onclick="untickAll('ca_state_<?php echo $state->st_id; ?>', '<?php echo 'cover_area_city_'.$state->st_id;?>');">Untick All</a></div>


                                 <?php foreach ($getStateWiseCity->data as $key => $city) {//6 ?>


                                 <div class="col-md-6">


                                    


                                    <input type="checkbox" id="cover_area_city_<?php echo $state->st_id;?>_<?php echo $i; ?>" name="cover_area_city_<?php echo $state->st_id;?>[<?php echo $i; ?>]" value="<?php echo $city->city_id;?>" data-pid="<?php echo $state->st_id;?>" data-cname="cover_area_city_" data-pname="ca_state_" onchange="check_parent(this)" <?php echo isset($_POST['cover_area_city_'.$state->st_id]) && (in_array($city->city_id, $_POST['cover_area_city_'.$state->st_id])) ? 'checked':'';?>> 


                                    <label for="cover_area_city_<?php echo $state->st_id;?>_<?php echo $i; ?>" class="custom"><?php echo $city->city_name;?></label>


                                 </div>

<!-- sini problem -->
                                 <?php $i++;}//6 ?> 
<!-- sini problem -->

                              </div>


                           </div>


                           <div class="row hidden">


                              <div class="col-md-12">


                                <div class="checkbox">                                  


                                  <input type="checkbox" name="other_area_<?php echo $state->st_id;?>" id="other_area_<?php echo $state->st_id;?>" value="1" onchange="toggleOther(this, 'cover_area_other_<?php echo $state->st_id;?>')" <?php echo (isset($_POST['other_area_'.$state->st_id]) && $_POST['other_area_'.$state->st_id] == '1') ? 'checked':'';?>>


                                  <label for="other_area_<?php echo $state->st_id;?>"><?php echo AREA_YOU_CAN_COVER_OTHERS; ?></label>


                                </div>


                              </div>


                              <div class="col-md-12" style="display: <?php echo (isset($_POST['other_area_'.$state->st_id]) && $_POST['other_area_'.$state->st_id] == '1') ? 'block':'none';?>;">


                                <textarea class="form-control" name="cover_area_other_<?php echo $state->st_id;?>" rows="3" style="resize:none;"><?php echo (isset($_POST['cover_area_other_'.$state->st_id]) && $_POST['cover_area_other_'.$state->st_id] != '') ? $_POST['cover_area_other_'.$state->st_id]:'';?></textarea>


                              </div>


                            </div>


                        </div>


                        <?php }//5 ?>


                     </div>


                  </div>


                  <?php 


                        }//4


                      }//3


                    //}//2


                  //}//1


                  ?>                   


                </div>                


              </div>


            </div>


            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd"><?php echo SUBJECT_YOU_CAN_TEACH; ?> : *</label>
              <div class="col-sm-8">
                <span id="messageBoxSujectTech" style="color:#dc3545"></span>
                <div class="row">
                  <?php 
                  // Get Course
                  $getCourse = system::FireCurl(LIST_COURSE_URL);
                  if ($getCourse->flag == 'success' && count($getCourse->data) > 0) {
                    $i = 0;
					
array_multisort(array_column($getCourse->data, "sort_by"), SORT_ASC, $getCourse->data); 
                    foreach ($getCourse->data as $key => $course) {
                  ?>
                  <div class="col-md-6">                    
                    <div class="checkbox">  
<input type="hidden" name="clickornottwo<?php echo $course->tc_id; ?>" id="clickornottwo<?php echo $course->tc_id; ?>" value="clickornottwo<?php echo $course->tc_id; ?>">
                      <input type="checkbox" name="tutor_course[]" id="tu_course_<?php echo $course->tc_id; ?>" value="<?php echo $course->tc_id; ?>" onchange="checkAll(this, '<?php echo 'tutor_subject_'.$course->tc_id;?>')" <?php echo isset($_POST['tutor_course']) && (in_array($course->tc_id, $_POST['tutor_course'])) ? 'checked':'';?>>
                      <!--<label for="tu_course_<?php echo $course->tc_id; ?>" class="custom"><?php echo $course->tc_title; ?></label>-->
<label id="tu_course_<?php echo $course->tc_id; ?>" class="custom" value="<?php echo $course->tc_id; ?>" onClick="myFunction2(this, '<?php echo 'tutor_subject_'.$course->tc_id;?>', '<?php echo $course->tc_id;?>')" ><?php if($getLan == "/my/"){ echo $course->tc_description; }else{ echo $course->tc_title; } //echo $course->tc_title; ?></label>

					  <div class="showHide" style="display: <?php echo isset($_POST['tutor_course']) && (in_array($course->tc_id, $_POST['tutor_course'])) ? 'block':'none';?>;">
                       <!--<div class="dropbox"><?php echo PLEASE_TICK_THE_SUBJECT; ?></div>-->
                       <div class="dropPop" style="display: <?php echo isset($_POST['tutor_course']) && (in_array($course->tc_id, $_POST['tutor_course'])) ? 'block':'none';?>;">
                          <div class="row">
                              <div class="col-md-12"><!--<a href="javascript:void(0);" onclick="tickAll('tu_course_<?php //echo $course->tc_id; ?>', '<?php //echo 'tutor_subject_'.$course->tc_id;?>');">Tick All</a>--> <a href="javascript:void(0);" onclick="untickAll('tu_course_<?php echo $course->tc_id; ?>', '<?php echo 'tutor_subject_'.$course->tc_id;?>');">Untick All</a></div>
                             <?php 
                                 // Get Subjects
                                 $getSubject = system::FireCurl(LIST_SUBJECT_URL.'?course_id='.$course->tc_id);
                                 if ($getSubject->flag == 'success' && count($getSubject->data) > 0) {
                                   foreach ($getSubject->data as $key => $subject) {
                             ?>
                            <div class="col-md-12">  
                               <input type="checkbox" name="tutor_subject_<?php echo $course->tc_id;?>[<?php echo $i; ?>]" id="tutor_subject_<?php echo $course->tc_id;?>_<?php echo $i; ?>" value="<?php echo $subject->ts_id;?>" data-pid="<?php echo $course->tc_id;?>" data-cname="tutor_subject_" data-pname="tu_course_" onchange="check_parent(this)" <?php echo isset($_POST['tutor_subject_'.$course->tc_id]) && (in_array($subject->ts_id, $_POST['tutor_subject_'.$course->tc_id])) ? 'checked':'';?>> 
                               <label for="tutor_subject_<?php echo $course->tc_id;?>_<?php echo $i; ?>" class="custom"><?php if($getLan == "/my/"){ echo $subject->ts_description; }else{ echo $subject->ts_title; } //echo $subject->ts_title;?></label>
                            </div>
                             <?php
                                     $i++; 
                                   }
                                 } else {
                                   echo "<p>No Subject Found</p>";
                                 }
                             ?>         
                          </div>
                       </div>


                       <div class="row hidden">


                          <div class="col-md-12">


                             <div class="checkbox">            


                                <input type="checkbox" name="subject_<?php echo $course->tc_id;?>" id="subject_<?php echo $course->tc_id;?>" value="1" onchange="toggleOther(this, 'other_subject_<?php echo $course->tc_id;?>')" <?php echo (isset($_POST['subject_'.$course->tc_id]) && $_POST['subject_'.$course->tc_id] == '1') ? 'checked':'';?>>


                                <label for="subject_<?php echo $course->tc_id;?>"><?php echo SUBJECT_YOU_CAN_TEACH_OTHERS; ?> </label>


                             </div>


                          </div>


                          <div class="col-md-12" style="display: <?php echo (isset($_POST['subject_'.$course->tc_id]) && $_POST['subject_'.$course->tc_id] == '1') ? 'block':'none';?>;">


                             <textarea class="form-control" name="other_subject_<?php echo $course->tc_id;?>" rows="3" style="resize:none;"><?php echo (isset($_POST['other_subject_'.$course->tc_id]) && $_POST['other_subject_'.$course->tc_id] != '') ? $_POST['other_subject_'.$course->tc_id]:'';?></textarea>


                          </div>


                       </div>


                    </div>


                    </div>                                    


                  </div>


                  <?php    


                    }





                  } else {


                    echo "<p>No Course Found</p>";


                  }


                  ?>


                </div>


              </div>


            </div>
<!-- prob -->
<!--fadhli -->
            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd"><?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Boleh Anda Mengajar Pelajar Kurang Upaya? :"; }else{ echo "Can You Teach Student With Learning Disability? :"; }?></label>
              <div class="col-sm-8 radio_font">
                <!--<div class="row">
                  <div class="col-md-6">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="student_disability" value="Yes">
                      <?php //echo YES; ?></label>
                  </div>
                  <div class="col-md-6">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="student_disability" value="No" checked>
                      <?php //echo NO; ?></label>
                  </div>
                </div>-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="this">
                        <label class="udradio"><input type="radio" class="radio-inline" name="student_disability" value="Yes" ><span class="outside"><span class="inside"></span></span><?php echo YES; ?></label>
                        <span style="padding-left: 70px;" ></span>
                        <label class="udradio"><input type="radio" class="radio-inline" name="student_disability" value="No" checked ><span class="outside"><span class="inside"></span></span><?php echo NO; ?></label>
                        </div>
                    </div>
                </div>
                <!--<div class="notice"><?PHP //if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Jika anda tandakan Ya, sila sebutkan di seksyen 'Mengenai Diri Anda'. Seperti Dyslexia, ADHD, Autism dan lain-lain."; }else{ echo "If you tick Yes, please mention in ‘About Yourself’ section the types you can attend to e.g Dyslexia, ADHD, Autism etcs"; }?></div>-->
                <div id="student_disability_wrap">

                   <?php 

                   if ( isset($_POST['student_disability']) && $_POST['student_disability'] == 'Yes' ) {

                      echo '<textarea style="height:70px;" placeholder="Please state the type of disabilities you can attend to e.g Dyslexia, ADHD, Autism etcs" name="student_disability_text" class="form-control">'.$_POST['student_disability_text'].'</textarea>';

                   }  
                   
                   ?>

                </div>
              </div>
            </div>


         <div class="hidden form-group">


              <label class="control-label col-sm-4" for="pwd">


              <?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Kadar/jam"; }else{ echo "Your rate/hour"; }?>
			  <br>


              </label>


              <div class="col-sm-8">


                <textarea class="form-control" placeholder="<?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Contoh: UPSR: RM35 / jam, SPM: RM50 / jam, IGCSE: RM70 / jam. Tinggalkan kosong jika anda tidak pasti"; }else{ echo "Example: UPSR: RMXX/hour, SPM: RMXX/hour, IGCSE: RMXX/hour.\n\nIf you can conduct class at your house or place and offer a lower rate, please mention your rate here too. Example : Rate teaching at my house: UPSR: RMXX/hour”"; }?>" style="height: 90px;" name="ud_rate_per_hour" id="ud_rate_per_hour"><?php echo (isset($_POST['ud_rate_per_hour']) && $_POST['ud_rate_per_hour'] != '') ? $_POST['ud_rate_per_hour']:'';?></textarea>


              </div>


            </div>

            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION; ?> :</label>


              <div class="col-sm-8">


                <input type="text" class="form-control" placeholder="<?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION_EXAMPLE; ?>" id="ud_qualification" name="ud_qualification" value="<?php echo (isset($_POST['ud_qualification']) && $_POST['ud_qualification'] != '') ? $_POST['ud_qualification']:'';?>">


                <!--<label class="box_text_1"><?php //echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION_EXAMPLE; ?></label>-->


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-xs-4" ><?php echo TUTORING_EXPERIENCE; ?> : * </label>


              <div class="col-xs-8 form-inline">


           

            <span id="messageBoxExperience" style="color:#dc3545"></span>
            <div class="row">
                <div class="col-sm-12">
                		<div class="input-group">
                			<input style="width: 50px;" onBlur="isNumberKeyIn1()" maxlength="2" type="text" class="form-control" id="ud_tutor_experience" name="ud_tutor_experience" value="<?php echo (isset($_POST['ud_tutor_experience']) && $_POST['ud_tutor_experience'] != '') ? $_POST['ud_tutor_experience']:'';?>" >
                			<span class="input-group-addon"></span>
                                <select class="form-control" onChange="isNumberKeyIn2()" name="experienceMonth" id="experienceMonth">
                                <option value="">Please Choose</option>
                                <option value="year">Year(s)</option>
                                <option value="month">Month(s)</option>
                                </select>
                		</div>
                </div>
                <label style="margin-left:15px;"><input type="text" id="ud_tutor_experienceError" name="ud_tutor_experienceError"  style="width: 2px;height: 2px;border:none;background-color:#f3f3f5;color:#f3f3f5;" ></label>
            </div>

    		<!--<div class="input-group">
    			<input style="width: 50px;" onkeypress="return isNumberKey(event)" maxlength="2" type="text" class="form-control" id="ud_tutor_experience" name="ud_tutor_experience" value="<?php //echo (isset($_POST['ud_tutor_experience']) && $_POST['ud_tutor_experience'] != '') ? $_POST['ud_tutor_experience']:'';?>" data-rule-required="true" data-msg-required="">
    			<span class="input-group-addon"></span>
                    <select class="form-control" name="experienceMonth" id="experienceMonth" data-rule-required="true" data-msg-required="- Experience is required." style="">
                    <option value="">Please Choose</option>
                    <option value="year">Year(s)</option>
                    <option value="month">Month(s)</option>
                    </select>
    		</div>-->


              


              </div>


            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo WILL_TEACH_AT_TUITION_CENTER; ?> :</label>


              <div class="col-sm-8 radio_font">


                <!--<div class="row">


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="tution_center" value="1" <?php //echo (isset($_POST['tution_center']) && $_POST['tution_center'] == '1') ? 'checked': (!isset($_POST['tution_center']) ? 'checked' : '');?>>


                      <?php //echo YES; ?></label>


                  </div>


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="tution_center" value="0" <?php //echo (isset($_POST['tution_center']) && $_POST['tution_center'] == '0') ? 'checked':'';?>>


                      <?php //echo NO; ?></label>


                  </div>


                </div>-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="this">
                            <label><input type="radio" class="radio-inline" name="tution_center" value="1" <?php echo (isset($_POST['tution_center']) && $_POST['tution_center'] == '1') ? 'checked': (!isset($_POST['tution_center']) ? 'checked' : '');?> ><span class="outside"><span class="inside"></span></span><?php echo YES; ?></label>
                            <span style="padding-left: 70px;" ></span>
                            <label><input type="radio" class="radio-inline" name="tution_center" value="0" <?php echo (isset($_POST['tution_center']) && $_POST['tution_center'] == '0') ? 'checked':'';?> ><span class="outside"><span class="inside"></span></span><?php echo NO; ?></label>
                        </div>
                    </div>
                </div>

              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd">


              <?php echo ABOUT_YOURSELF; ?> : * <br>


              <p class="box_text_2"><?php echo ABOUT_YOURSELF_MESSAGE; ?></p>


              </label>


              <div class="col-sm-8">

                <span id="messageBoxAboutYourself" style="color:#dc3545"></span>
                <textarea class="form-control" style="height: 90px;" name="ud_about_yourself" id="ud_about_yourself"><?php echo (isset($_POST['ud_about_yourself']) && $_POST['ud_about_yourself'] != '') ? $_POST['ud_about_yourself']:'';?></textarea>


                <!--<a href="javascript:void(0);" class="box_text_1 sample-tooltip" data-toggle="tooltip" data-html="true" data-placement="top" title="<small style='font-size: 10px;'><?php echo VIEW_SAMPLE_POPUP_TEXT; ?></small>"><?php echo VIEW_SAMPLE; ?></a>-->
                <a href="https://www.tutorkami.com/tuition/guide-tips-about-yourself/" target="_blank" class="box_text_2 sample-tooltip"><font color="blue" style="text-decoration: underline;"><?php echo VIEW_SAMPLE; ?></font></a>


              </div>


            </div>

<style>
.fileUpload {
    position: relative;
    overflow: hidden;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    /*font-size: 20px;*/
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}

</style>
<script>
$(document).on('change','.up', function(e){
		   	var names = [];
		   	var length = $(this).get(0).files.length;
			    for (var i = 0; i < $(this).get(0).files.length; ++i) {
			        names.push($(this).get(0).files[i].name);
			    }
			    // $("input[name=file]").val(names);
				if(length>2){
				  var fileName = names.join(', ');
				  $(this).closest('.form-group').find('.form-control').attr("value",length+" files selected");
  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
    document.getElementById("previewpopup").src = e.target.result;
      $('#myModalImg').modal('show');
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
				}
				else{
					$(this).closest('.form-group').find('.form-control').attr("value",names);
  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
    document.getElementById("previewpopup").src = e.target.result;
      $('#myModalImg').modal('show');
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
				}
	   });

function doneButton() {
	$('#myModalImg').modal('hide');
	var element = document.getElementById("preview");
	element.classList.remove("hidden");
}
function changeButton() {
	$('#myModalImg').modal('hide');
	$('#up').click(); 
}
function clickInput() {
	var element = document.getElementById("preview");
	element.classList.add("hidden");
}

</script>

<div id="myModalImg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <center><img id="previewpopup" class="img-thumbnail"></center>
			<center><button type="button" class="btn btn-success" onClick="doneButton()">Done</button> <button type="button" class="btn btn-danger" onClick="changeButton()">Change</button></center>
        </div>
    </div>
  </div>
</div>
           <div class="form-group">
		   
              <label class="control-label col-sm-4" for="pwd"><?php echo UPLOAD_PROFILE_PICTURE; ?> :<br>
                <p class="box_text_2"><?php //echo UPLOAD_PROFILE_PICTURE_MESSAGE; ?></p>
              </label>


             <div class="col-sm-8">
                <!--<input type="file" name="u_profile_pic" id="file-7" class="inputfile inputfile-6" accept="image/*" style="display:none;">
                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php //echo CHOOSE_A_FILE; ?></strong></label>
                -->
<div class="input-group">
  <input type="text" class="form-control" readonly>
 <div class="input-group-btn">
  <span class="fileUpload btn btn-default">
      <span class="upl" id="upload"><?php echo CHOOSE_A_FILE; ?></span>
      <input onClick="clickInput()" name="u_profile_pic" type="file" class="upload up" id="up" onchange="readURL(this);" />
    </span>
 </div>
 </div>

  <img src="https://placehold.it/80x80" id="preview" class="hidden img-thumbnail">

				<div class="notice"><?php echo REGISTER_UPLOAD_PROFILE_PIC_MESSAGE; ?></div>              
              </div>

            </div>


              <div class="form-group">


              <div class="col-md-12">


              <div class="checkbox">


              


              <input type="checkbox" value="1" name="agreement" id="agreement" >


              <label style="font-size:13px; color:#F1951F;" for="agreement"><?php echo REGISTER_AGREEMENT; ?> 
			  <?PHP
			  $getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
			  if($getLan == "/my/"){	
			  ?>
				<a href="https://www.tutorkami.com/my/terms_condition" target="_blank" class="sky-txt">Terma & Syarat</a>
			  <?PHP
			  }else{
			  ?>
				<a href="https://www.tutorkami.com/terms_condition" target="_blank" class="sky-txt">Terms & Conditions</a>
			  <?PHP
			  }
			  ?>
			  </label>
			  <span id="messageBoxAgreement" style="color:#dc3545"><b></b></span>

              </div>


              </div>


              </div>


            <div class="form-group">


              <div class="col-sm-6">


                <button type="submit" class="btn btn-default"><?php echo BUTTON_SUBMIT; ?></button>


              </div>


            </div>


          </form>


        </div>


      </div>


    </div>


  </div>


</section>


<?php //include('includes/footer.php');?>

<!-- START FOOTER -->
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

               <h3><?php echo FOLLOW_US_ON_SOCIAL_MEDIA; ?> :</h3>

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

               <h3><?php echo SITE_NAVIGATION; ?></h3>

               <ul class="nl">

                 
                  <li><a href="<?PHP echo $LangURL; ?>index.php"  class="active" >Home</a></li>

                  
                  <li><a href="https://www.tutorkami.com/blog/" >Latest News</a></li>

                  
                  <li><a href="<?PHP echo $LangURL; ?>about.php" >About Us</a></li>

                  
                  <li><a href="<?PHP echo $LangURL; ?>tutor.php" >I'm a Tutor</a></li>

                  
                  <li><a href="<?PHP echo $LangURL; ?>tips_for_parent.php" >Tips for Parents</a></li>

                  
                  <li><a href="<?PHP echo $LangURL; ?>tutor-login.php" >Sign In</a></li>

                  
               </ul>

            </div>

            <div class="col-md-4 col-sm-4">

               <h3><?php echo SEARCH_THIS_SITE; ?></h3>

               <ul class="nl">

<div id="search-box">
   <gcse:search></gcse:search>
</div>



                  
                  <li><a href="<?PHP echo $LangURL; ?>index.php">Privacy Policy</a></li>

                  
                  <li><a href="<?PHP echo $LangURL; ?>terms_condition.php">Terms of Use</a></li>


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
<div id="toast-container" class="toast-top-right hidden" aria-live="polite" role="alert">
   <div id="sticky-container" class="toast toast-error" style="">
      <div id="alert_progress_bar" class="toast-progress" style="width: 100%;"></div>
      <button type="button" class="toast-close-button" role="button">×</button>
      <script>hideErrDiv('sticky-container', 'alert_progress_bar');</script>
      <div id="err_report"></div>
      <div class="toast-message">Error in updating profile. Please re check the fields</div>
   </div>
</div>


<?php 
if( isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != '' ) {
    $flash = Session::ReadFlushMsg();
?>
<script>$(document).ready(function(){ $('#myModalFlash').modal('show'); });</script>
<?PHP
}
?>

    <div id="myModalFlash" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body" style="background-color:#f1592a;">
          <font style="color:white;">
          <center><?php echo $flash['msg_text'];?><br><button type="button" class="btn btn-primary btn-xs closeMyModalFlash"> OK </button></center>
          </font>
        </div>
      </div>
      
    </div>
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
<!-- END FOOTER -->


<script type="text/javascript">
$('#popoverData').popover();
$(document).on('click', function (e) {
	if ($(e.target).closest(".udradio2").length 
		=== 0) { 
	
    setTimeout(function () {
		$("#popoverData").popover('hide');
    }, 2500);
	
	} 
});

function myFunction(ele, id, realid) {
	var clickornot = document.getElementById("clickornot"+realid).value;
	/*alert(clickornot);*/
	if(clickornot == "click"){
		document.getElementById("clickornot"+realid).value="";
		$('[name^="'+id+'"]').parents('.showHide').hide();
		$(ele).parent('.checkbox').find('.dropPop').hide();
	}else{
		document.getElementById("clickornot"+realid).value="click";
		$('[name^="'+id+'"]').parents('.showHide').show();
		$(ele).parent('.checkbox').find('.dropPop').show();		
	}
}
function myFunction2(ele, id, realid) {
	var clickornot = document.getElementById("clickornottwo"+realid).value;
	if(clickornot == "click"){
		document.getElementById("clickornottwo"+realid).value="";
		$('[name^="'+id+'"]').parents('.showHide').hide();
		$(ele).parent('.checkbox').find('.dropPop').hide();
	}else{
		document.getElementById("clickornottwo"+realid).value="click";
		$('[name^="'+id+'"]').parents('.showHide').show();
		$(ele).parent('.checkbox').find('.dropPop').show();		
	}
}

    function checkAll(ele, id) {


        var checkboxes = document.getElementsByTagName('input');


        var patt1 = /[^0-9]/g;





        if (ele.checked) {


            // $('[name^="'+id+'"]').prop('checked', true);


            $('[name^="'+id+'"]').parents('.showHide').show();


            $(ele).parent('.checkbox').find('.dropPop').show();


        } else {


            // $('[name^="'+id+'"]').prop('checked', false);


            $('[name^="'+id+'"]').parents('.showHide').hide();


            $(ele).parent('.checkbox').find('.dropPop').hide();


        }


    }





    function tickAll(pid, id) {


      $('#'+pid).prop('checked', true);


      $('[name^="'+id+'"]').prop('checked', true);


    }





    function untickAll(pid, id) {


      $('#'+pid).prop('checked', false);


      $('[name^="'+id+'"]').prop('checked', false);


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





    $('.sample-tooltip').tooltip({


        content: function () {


            return $(this).prop('title');


        }


    });
/*
$('#search_ud_state').change(function(){
    var StateId = $(this).val();
    $.ajax({
        type: "POST",
        url: 'ajax-city.php',
        data: {state_id: StateId},
        success: function(data){
            $('#search_ud_city').html(data);
        }
    });
});*/
$('#search_ud_city').on('change', function() {
    var CityID = $(this).val();
    $.ajax({
        url: "ajax-get-location.php",
        method: "POST",
        data: {action: 'CityID', CityID: CityID}, 
        success: function(result){
            //$('#search_ud_state').html(result);
            $('#search_ud_stateText').html(result);
        }
    });
 });

function isNumberKeyIn1(){
    if( document.getElementById("ud_tutor_experience").value != '' ){
        if( document.getElementById("experienceMonth").value != '' ){
            document.getElementById("ud_tutor_experienceError").value = 'monthyear';
        }else{
            document.getElementById("ud_tutor_experienceError").value = '';
        }
    }else{
        document.getElementById("ud_tutor_experienceError").value = '';
    }
}
function isNumberKeyIn2(){
    if( document.getElementById("experienceMonth").value != '' ){
        if( document.getElementById("ud_tutor_experience").value != '' ){
            document.getElementById("ud_tutor_experienceError").value = 'monthyear';
        }else{
            document.getElementById("ud_tutor_experienceError").value = '';
        }
            
    }else{
        document.getElementById("ud_tutor_experienceError").value = '';
    }
}
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));
$("#ud_tutor_experience").inputFilter(function(value) {
    return /^-?\d*$/.test(value);
});

 $(document).ready(function(){
     
      function conduct_online() {
        var v = $('input[name=conduct_online]:checked').val();
        if (v == 'Yes') {
           //$('#conduct_online_wrap').html('<textarea style="height:70px;" placeholder="Please state what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc" name="conduct_online_text" class="form-control"></textarea>');
		   document.getElementById("popoverData").classList.remove("hidden"); 
		   $("#popoverData").popover('show');
		   document.getElementById("conduct_online_wrap").classList.remove("hidden"); 
		   document.getElementById("accordion").classList.remove("hidden"); 
		} else {
           //$('#conduct_online_wrap').html('');
           document.getElementById("popoverData").classList.add("hidden"); 
           $("#popoverData").popover('hide');
           document.getElementById("conduct_online_wrap").classList.add("hidden");
           document.getElementById("accordion").classList.add("hidden"); 
        }
      }

      function student_disability() {
        var v = $('input[name=student_disability]:checked').val();
        if (v == 'Yes') {
           $('#student_disability_wrap').html('<textarea style="height:70px;" placeholder="Please state the type of disabilities you can attend to e.g Dyslexia, ADHD, Autism etcs" name="student_disability_text" class="form-control"></textarea>');
        } else {
           $('#student_disability_wrap').html('');
        }
      }

      $('.udradio').on('click', function(){

        var ele = $(this).find('input[type=radio]').attr('name');

        if(ele == 'ud_race'){
           raceOther();
        }

        if(ele == 'ud_nationality'){
           nationalityOther();
        }


        if(ele == 'student_disability'){
           student_disability();
        }

      });
      
      $('.udradio2').on('click', function(){
        var ele = $(this).find('input[type=radio]').attr('name');
        if(ele == 'conduct_online'){
           conduct_online();
        }
    

      });
      
 });


$('.closeMyModalFlash').click(function(){
    $('#myModalFlash').modal('hide');
}) 
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>  
$(".js-example-basic-single").select2({
	placeholder: "Choose one of the following...",
});

function handleChange1() {
	var favorite = [];
	$.each($("input[name='toolsname1']:checked"), function(){            
		favorite.push($(this).val());
	});
	document.getElementById("hiddentoolsname1").value = favorite.join(", ");
	if(favorite.join(", ").includes("Others")){
	  document.getElementById("conduct_online_other").classList.remove("hidden");
	}else{
	  document.getElementById("conduct_online_other").classList.add("hidden"); 
	}
}
function collapseOne1() {
	if($("#collapseOne").hasClass('in')){
	  document.getElementById("glyphicon-chevron-up").classList.add("hidden"); 
	  document.getElementById("glyphicon-chevron-down").classList.add("hidden"); 
	  document.getElementById("glyphicon-chevron-down").classList.remove("hidden"); 
	}else {
	  document.getElementById("glyphicon-chevron-up").classList.add("hidden"); 
	  document.getElementById("glyphicon-chevron-down").classList.add("hidden"); 
	  document.getElementById("glyphicon-chevron-up").classList.remove("hidden"); 
	}
}
</script>