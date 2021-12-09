<?php 

require_once('includes/head.php');
/* START - fahli = create,update image/picture */
require_once('includes/create-thumb.php');
require_once('includes/create-thumb2.php');
define('IMAGE_SMALL_DIR', 'images/profile/small/');
define('IMAGE_SMALL_SIZE', 50);
define('IMAGE_MEDIUM_DIR', 'images/profile/');
define('IMAGE_MEDIUM_SIZE', 250);
/* END - fahli */

# SESSION CHECK #
$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['auth'])) {

  header('Location: tutor-login.php');

  exit();

}
/*
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
*/
if (count($_FILES) > 0) {



  $testimonial_path = array();

  /*foreach ($_FILES['user_testimonial']['name'] as $key => $value) {

    

    if ($_FILES['user_testimonial']['size'][$key] > 0) {

      $testimonialname = $_FILES['user_testimonial']['name'][$key];

      $testimonialtemp = $_FILES['user_testimonial']['tmp_name'][$key];

      $testimonialext  = explode(".", $testimonialname);

      $testimonialext  = end($testimonialext);

      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');



      if(in_array($testimonialext, $allowedext)){

        move_uploaded_file($testimonialtemp, "files/".$testimonialname);

        $testimonial_path[] = "files/".$testimonialname;

      }

    }

  }*/
  
	$userID = isset($_SESSION['auth']['user_id']) ? $_SESSION['auth']['user_id'] : 0;
	$getDetailsUser = system::FireCurl(USER_LISTING_URL.'?user_id='.$userID);
	if(count($getDetailsUser->data) == 0){
		header('Location: logout.php');
		exit();
	}
	$detailsUser = (array) $getDetailsUser->data[0];
	
	$namaFile = date("Ymd-His")."-".$detailsUser['u_email'];
  
	$testiFileName = date("Ymd-His")."-".$detailsUser['u_displayid'];

  if(isset($_FILES['user_testimonial1']['name']) && $_FILES['user_testimonial1']['name'] != ''){
      /*$testimonialname = $_FILES['user_testimonial1']['name'];
      $testimonialtemp = $_FILES['user_testimonial1']['tmp_name'];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){	
        move_uploaded_file($testimonialtemp, "images/testimonial/".time()."_".$testimonialname);
        $testimonial_path['user_testimonial1'] = "images/testimonial/".time()."_".$testimonialname;
      }*/
	  $testimonialname = $_FILES['user_testimonial1']['name'];
	  $testimonialext  = explode(".", $testimonialname);
	  $testimonialext  = end($testimonialext);
	  $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
	  if(in_array($testimonialext, $allowedext)){			
		process_image_upload_testi('user_testimonial1', $testiFileName.'-1');
		$testimonial_path['user_testimonial1'] = "images/testimonial/".$testiFileName.'-1.jpg';
	  }
  }else{
    $testimonial_path['user_testimonial1']= '';
  }
  
  
  if(isset($_FILES['user_testimonial2']['name']) && $_FILES['user_testimonial2']['name'] != ''){
/*
      $testimonialname = $_FILES['user_testimonial2']['name'];
      $testimonialtemp = $_FILES['user_testimonial2']['tmp_name'];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){
        //move_uploaded_file($testimonialtemp, "files/".$testimonialname);
        //$testimonial_path['user_testimonial2'] = "files/".$testimonialname;
        move_uploaded_file($testimonialtemp, "images/testimonial/".time()."_".$testimonialname);
        $testimonial_path['user_testimonial2'] = "images/testimonial/".time()."_".$testimonialname;

      }
*/
	  $testimonialname = $_FILES['user_testimonial2']['name'];
	  $testimonialext  = explode(".", $testimonialname);
	  $testimonialext  = end($testimonialext);
	  $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
	  if(in_array($testimonialext, $allowedext)){			
		process_image_upload_testi('user_testimonial2', $testiFileName.'-2');
		$testimonial_path['user_testimonial2'] = "images/testimonial/".$testiFileName.'-2.jpg';
	  }
  }else{
    $testimonial_path['user_testimonial2']= '';
  }

  if(isset($_FILES['user_testimonial3']['name']) && $_FILES['user_testimonial3']['name'] != ''){
/*
      $testimonialname = $_FILES['user_testimonial3']['name'];
      $testimonialtemp = $_FILES['user_testimonial3']['tmp_name'];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){
        move_uploaded_file($testimonialtemp, "images/testimonial/".time()."_".$testimonialname);
        $testimonial_path['user_testimonial3'] = "images/testimonial/".time()."_".$testimonialname;
      }
*/
	  $testimonialname = $_FILES['user_testimonial3']['name'];
	  $testimonialext  = explode(".", $testimonialname);
	  $testimonialext  = end($testimonialext);
	  $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
	  if(in_array($testimonialext, $allowedext)){			
		process_image_upload_testi('user_testimonial3', $testiFileName.'-3');
		$testimonial_path['user_testimonial3'] = "images/testimonial/".$testiFileName.'-3.jpg';
	  }
  }else{
    $testimonial_path['user_testimonial3']= '';
  }

  if(isset($_FILES['user_testimonial4']['name']) && $_FILES['user_testimonial4']['name'] != ''){
/*
      $testimonialname = $_FILES['user_testimonial4']['name'];
      $testimonialtemp = $_FILES['user_testimonial4']['tmp_name'];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){
        move_uploaded_file($testimonialtemp, "images/testimonial/".time()."_".$testimonialname);
        $testimonial_path['user_testimonial4'] = "images/testimonial/".time()."_".$testimonialname;
      }*/
	  $testimonialname = $_FILES['user_testimonial4']['name'];
	  $testimonialext  = explode(".", $testimonialname);
	  $testimonialext  = end($testimonialext);
	  $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
	  if(in_array($testimonialext, $allowedext)){			
		process_image_upload_testi('user_testimonial4', $testiFileName.'-4');
		$testimonial_path['user_testimonial4'] = "images/testimonial/".$testiFileName.'-4.jpg';
	  }
   }else{
    $testimonial_path['user_testimonial4']= '';
  }



  $name       = $_FILES['u_profile_pic']['name'];

  $imgext     = explode(".", $name);

  $imgext     = end($imgext);

  $tmpname    = $_FILES['u_profile_pic']['tmp_name'];

  $extension  = array('jpg', 'jpeg', 'png', 'bmp');

  $path_parts = pathinfo($_FILES['u_profile_pic']['name']);

  //$imagenumber = rand(5000,10000);


  if(in_array($imgext, $extension)){

    // move_uploaded_file($tmpname, "files/".$name);
    //move_uploaded_file($tmpname, "images/profile/000".$imagenumber.'_0.jpg');

    //$picture_path = $imagenumber;//luqman buat so nnti image save sbagai number.sbb manfred dh set sume image read sbgai number

		/* START fadhli*/		
		/*create directory with 777 permission if not exist - start*/
		//createDir(IMAGE_SMALL_DIR);
		createDir(IMAGE_MEDIUM_DIR);
		
		//$imagenumber = rand(5000,10000);
		$path[0] = $_FILES['u_profile_pic']['tmp_name'];
		$file = pathinfo($_FILES['u_profile_pic']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		//$fileNameNew = "000".$imagenumber.'_0.jpg';
		$fileNameNew = $namaFile.'.jpg';
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
		
		if($detailsUser['u_profile_pic'] != '' ){
			unlink('images/profile/'.$detailsUser['u_profile_pic'].'.jpg');
		}
		
		//createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE);
		// https://salman-w.blogspot.com/2008/10/resize-images-using-phpgd-library.html
        process_image_upload('u_profile_pic', $namaFile);
		// https://stackoverflow.com/questions/16774521/scale-image-using-php-and-maintaining-aspect-ratio
/*
if(isMobile()){
    $deviceType = 'mobile';
}
else {
    $deviceType = 'desktop';
}
$fileNameNew2 = $namaFile.'-'.$deviceType.'.jpg';
		move_uploaded_file($tmpname, "fadhli/testimage/".$fileNameNew2);*/
		//createThumb($path[1], $path[2],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE);
		$picture_path = $namaFile;
		/* END - fadhli */


  }else{

    Session::SetFlushMsg("Error",'You Cannot Upload This File.');

  }


}



if (count($_POST) > 0) { 

  $data = $_POST;



  $data['u_profile_pic'] = isset($picture_path) ? $picture_path : '';

  $data['u_testimonial'] = count($testimonial_path) > 0 ? $testimonial_path : '';

  $data['ud_dob'] = implode('-', array_reverse($_POST['ud_dob']));

  

  $output = system::FireCurl(PROFILE_UPDATE_URL, "PUT", "JSON", $data);

  

  Session::SetFlushMsg($output->flag, $output->message);

  if ($output->flag == 'success') {

    

  } else {

     

  }

  

}



$user_id = isset($_SESSION['auth']['user_id']) ? $_SESSION['auth']['user_id'] : 0;



$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);

if ($getUserDetails->flag == 'error') {

  Session::SetFlushMsg($output->flag, $output->message);

  header('Location: logout.php');

  exit();

}



if(count($getUserDetails->data) == 0){

  header('Location: logout.php');

  exit();

}

// var_dump((array) $getUserDetails->data[0]);exit();

$user_info = (array) $getUserDetails->data[0];

$user_info['ud_dob'] = explode('-', $user_info['ud_dob']);

$user_info['ud_dob'] = array_reverse($user_info['ud_dob']);



//$getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');

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
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	  <!--<link rel="stylesheet" href="css/owl.theme.default.min.css">
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-42467282-1"></script>
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
	  <script async src="js/velocity.min.js"></script>-->
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
             'ud_about_yourself' : { required:true }
            },


              invalidHandler: function(form, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        /*var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';
                        var element = document.getElementById("toast-container");
                        element.classList.remove("hidden"); */
                        getStickyNote('error','Error in updating profile. Please re check the fields');
                    }
              },

            
            errorPlacement: function (error, element) {
                /*if ( (element.attr("name") == "u_email") ) { error.appendTo("#messageBoxEmail"); } else { //error.insertAfter(element) }
                if ( (element.attr("name") == "u_password") )    { error.appendTo("#messageBoxPassword"); }
                if ( (element.attr("name") == "con_password") )  { error.appendTo("#messageBoxConPassword"); }
                if ( (element.attr("name") == "ud_first_name") ) { error.appendTo("#messageBoxFirst"); }
                if ( (element.attr("name") == "ud_last_name") )  { error.appendTo("#messageBoxLast"); }*/
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
             'ud_about_yourself': '- About yourself is required'
            }
            /*  
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
            }*/
          });
        });
      </script> 
	  <style>
   .testing {
      /*color: #dc3545;*/
   }
	  
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

	$dropdownClick = 0;
	
	//if( $thisUserID == '1579981'){
			if( $getFullURL == '/edit_account.php' ){
				$queryCurrentlyStaying = " SELECT * FROM tk_user_details WHERE ud_u_id ='".$thisUserID."' "; 
				$resultCurrentlyStaying = $conn->query($queryCurrentlyStaying); 
				if($resultCurrentlyStaying->num_rows > 0){ 
					$rowCurrentlyStaying = $resultCurrentlyStaying->fetch_assoc();
					$CurrentlyStaying = $rowCurrentlyStaying['ud_city'];
					
						if( $CurrentlyStaying == NULL || $CurrentlyStaying == '' ){
							//echo "<script>$(document).ready(function(){ $('#myModalPopUpCurrentlyStaying').modal('show'); });</script>";
							echo "<script>$(document).ready(function(){ $('.autoClick').click(); });</script>";
							$dropdownClick = 1;
						}
					
				}
			}			
	//}

if( $dropdownClick == 0 ){

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

		  <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/logo.png" class="pull-left img-responsive" alt="tutorkami logo"/></a>
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
unset($_SESSION["firstlogin"]);
?>
<link rel="stylesheet" href="files/viewbox-master/viewbox.css">
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

      left: 408px;

      position: absolute;

      top: 5px;

      width: 300px;

      max-width: 300px;

    }

  }

#dvLoading {
background:url(https://www.tutorkami.com/images/loading-spinner.gif) no-repeat center center;
height: 100px;
width: 200px;
z-index: 1000;
}

#videoLoading {
background:url(https://www.tutorkami.com/images/loading3.gif) no-repeat center center;
height: 100px;
width: auto;
z-index: 1000;
}

.btn-orange { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
  padding-left: 8px !important;
  padding-right: 8px !important;
  border-radius: 4px;
} 
 
.btn-orange:hover, 
.btn-orange:focus, 
.btn-orange:active, 
.btn-orange.active, 
.open .dropdown-toggle.btn-orange { 
  color: #ffffff; 
  background-color: #ED4917; 
  border-color: #F1592A; 
} 
 
.btn-orange:active, 
.btn-orange.active, 
.open .dropdown-toggle.btn-orange { 
  background-image: none; 
} 
 
.btn-orange.disabled, 
.btn-orange[disabled], 
fieldset[disabled] .btn-orange, 
.btn-orange.disabled:hover, 
.btn-orange[disabled]:hover, 
fieldset[disabled] .btn-orange:hover, 
.btn-orange.disabled:focus, 
.btn-orange[disabled]:focus, 
fieldset[disabled] .btn-orange:focus, 
.btn-orange.disabled:active, 
.btn-orange[disabled]:active, 
fieldset[disabled] .btn-orange:active, 
.btn-orange.disabled.active, 
.btn-orange[disabled].active, 
fieldset[disabled] .btn-orange.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-orange .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}

/* responsive queries */
@media (max-width: 768px) {
  .btn-responsive {
	font-size:13px;
    padding:4px 6px;
  }
}

@media (min-width: 768px) {
  .btn-responsive {
	font-size:13px;
    padding:6px 12px;
  }
}
  
@media (min-width: 992px) {
  .btn-responsive {
	font-size:14px;
    padding:8px 12px;
  }
}
 
@media (min-width: 1200px) {
  .btn-responsive {
    padding:10px 16px;
	font-size:16px;
  }
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





.checkbox-custom {
  opacity: 0;
  position: absolute;
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

    <link rel="stylesheet" type="text/css" href="css/responsive-tabs/css/easy-responsive-tabs.css " />
    <!--<script src="css/responsive-tabs/js/jquery-1.9.1.min.js"></script>-->
    <script src="css/responsive-tabs/js/easyResponsiveTabs.js"></script>
	
	<link rel="stylesheet" href="https://www.tutorkami.com/css/balloon.min.css">

    
<?PHP $_SESSION['getPage'] = "Update Account"; 
?>
<section class="client_profile myform">

  <div class="container">

    <div class="row">

      <div class="col-md-12 col-sm-8">

        <div>

          <h1 class="blue-txt text-uppercase text-center"> <?php echo MY_PROFILE; ?></h1>
          <hr>
<!--<center><p><button type="button" class="btn btn-danger">UNDER MAINTENANCE</button></p></center>-->
<input type="hidden" id="timeTableUserID" name="timeTableUserID" value="<?php echo isset($user_info['u_id']) ? $user_info['u_id']: '';?>">
        </div>

        <!--Horizontal Tab-->
        <div id="section">
            <ul class="resp-tabs-list hor_1">
                <li>Profile</li>
                <li>Time Slots</li>
                <li>Change Password</li>
                <li id="Subscribe" >Subscribe</li>
            </ul>
            <div class="resp-tabs-container hor_1">

		  
        <!--<div class="col-md-10 mrg_top30">-->
		<div>

        <p><span class="rad-txt">*</span> <?php echo REQUIRED; ?><br>

          <?php echo EDIT_ACCOUNT_CONTACT_US_PHONE; ?> </p><br>

          <form class="form-horizontal" method="post" enctype="multipart/form-data" id="registration-form">

            <input type="hidden" id="u_id" name="u_id" value="<?php echo isset($user_info['u_id']) ? $user_info['u_id']: '';?>">

            <div class="form-group">
			  <label class="control-label col-sm-4"><?php echo VIDEO; ?> <span data-balloon-length="large" aria-label="Upload a video profile to allow parents & students to get a feel of who you are, and why should they choose you to be their tutor.
Click 'Browse' to select the video, then click 'Upload' to upload the video.&#10;&#10;It can take up to 15 minutes for your video to be uploaded, depending on the file size (max size allowed is 1000 MB). If upload is successful, the message ‘The Video Has Been Uploaded’ will show up here.
(Don't forget to click 'Save' at the bottom after you have done updating your profile)&#10;&#10;Our staff will review your video to make sure it does not contain anything improper. If the video is approved, it will show up in your profile (under tab Video Profile) in 2-3 days. 
			  " data-balloon-pos="right" data-balloon-break ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></span></label>
              <div class="col-sm-8">
				<div class="btn-toolbar">
<?PHP
if ( isset($user_info['url_video']) && ($user_info['url_video'] != '') ){
	//echo $user_info['url_video'];
	function convertYoutube($string) {
		return preg_replace(
			"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
			"<center><iframe src=\"//www.youtube.com/embed/$2\" allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen height='300' frameborder='0' allowtransparency='true'></iframe></center>",
			$string
		);
	}
?>
					
<div id="ModalVideo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<div class="modal-body">
			<?PHP echo convertYoutube($user_info['url_video']); ?> 
		</div>
    </div>
  </div>
</div>
		<span>Click <a onclick="openVideo('<?PHP echo $user_info['url_video'];?>')" style="cursor: pointer;" >here</a> to view your current video profile</span><br/><br/>
	<?PHP
}
?>
					<!--<button type="button" class="btn btn-orange btn-responsive" id="google" onClick="reply_click(this.id)">Upload via Google</button>
					<button type="button" class="btn btn-orange btn-responsive" id="telegram" onClick="reply_click(this.id)">Send via Telegram</button>-->
					
<!-- https://codepen.io/ygoex/pen/KzYNVj -->
<style>	
input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
.btn-upload { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-upload:hover, 
.btn-upload:focus, 
.btn-upload:active, 
.btn-upload.active, 
.open .dropdown-toggle.btn-upload { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-upload:active, 
.btn-upload.active, 
.open .dropdown-toggle.btn-upload { 
  background-image: none; 
} 
 
.btn-upload.disabled, 
.btn-upload[disabled], 
fieldset[disabled] .btn-upload, 
.btn-upload.disabled:hover, 
.btn-upload[disabled]:hover, 
fieldset[disabled] .btn-upload:hover, 
.btn-upload.disabled:focus, 
.btn-upload[disabled]:focus, 
fieldset[disabled] .btn-upload:focus, 
.btn-upload.disabled:active, 
.btn-upload[disabled]:active, 
fieldset[disabled] .btn-upload:active, 
.btn-upload.disabled.active, 
.btn-upload[disabled].active, 
fieldset[disabled] .btn-upload.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-upload .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}

</style>
<?PHP
$queryVideo = " SELECT * FROM tk_upload_video WHERE v_displayid ='".$_SESSION['auth']['user_displayid']."' ORDER BY v_id DESC "; 
$resultVideo = $conn->query($queryVideo); 
if($resultVideo->num_rows > 0){ 
	$rowVideo = $resultVideo->fetch_assoc();
	$CurrentVideo = $rowVideo['v_filename'];
}else{
	$CurrentVideo = 'Please click on browse button';
}
?>
      <div class="input-group">
          <span class="input-group-btn">
            <button id="browseButton" style="padding-left:25px;padding-right:25px;" class="btn btn-upload browse-button" >
                <span class="browse-button-text">
                <i class="fa fa-folder-open"></i> Browse</span>
                <input type="file" id="media" name="media" onchange="return fileValidation()" />
            </button>
          </span>
          <input type="text" class="form-control filename" disabled="disabled" placeholder="<?PHP echo $CurrentVideo; ?>">
          <span class="input-group-btn">
            <button id="uploadButton" style="padding-left:25px;padding-right:25px;" class="btn btn-upload upload-button" type="button" onclick="uploadFile();">
                <i class="fa fa-upload"></i>Upload</button>
          </span>
        </div>
		<div class="hidden" id="videoLoading"></div> 	
		
		<br/><br/><div id="videoLoadingMessage" class="alert alert-success hidden" role="alert"><center><b>The Video Has Been Uploaded</b></center></div>
		
					
				</div><br/><span>Click <a target="_blank" href="https://www.tutorkami.com/tuition/tutor-video-profile/">here</a> to see sample videos</span>
              </div>
                
              
              
              
            </div>
            <!--<div class="form-group">
              <label class="control-label col-sm-4"></label>
              <div class="col-sm-8">
				<div class="btn-toolbar">
					<button type="button" class="btn btn-primary btn-md">Submit</button>
					<button type="button" class="btn btn-primary btn-md">Cancel</button>
				</div>
              </div>
            </div>-->
			
            <div class="form-group">

              <label class="control-label col-sm-4"><?php echo EMAIL; ?>*</label>

              <div class="col-sm-5">
                <span id="messageBoxEmail" style="color:#dc3545"></span>
                <input type="email" class="form-control" value="<?php echo isset($user_info['u_email']) ? $user_info['u_email']: '';?>" readonly>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4"><?php echo FIRST_NAME; ?>*</label>

              <div class="col-sm-5">
                <span id="messageBoxFirst" style="color:#dc3545"></span>
                <input type="text" class="form-control" value="<?php echo isset($user_info['ud_first_name']) ? $user_info['ud_first_name']: '';?>" readonly>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4"><?php echo LAST_NAME; ?>*</label>

              <div class="col-sm-5">
                <span id="messageBoxLast" style="color:#dc3545"></span>
                <input type="text" class="form-control" value="<?php echo isset($user_info['ud_last_name']) ? $user_info['ud_last_name']: '';?>" readonly>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="u_displayname"><?php echo DISPLAY_NAME; ?>*</label>

              <div class="col-sm-5">
                <span id="messageBoxDisplayname" style="color:#dc3545"></span>
                <input type="text" class="form-control" id="u_displayname" name="u_displayname" value="<?php echo isset($user_info['u_displayname']) ? $user_info['u_displayname']: '';?>" data-rule-required="true" data-msg-required="- Display name is required.">

                <label class="box_text_1"><?php echo DISPLAY_NAME_EXAMPLE; ?></label>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="ud_phone_number"><?php echo PHONE_NUMBER; ?>*</label>

              <div class="col-sm-5">
                <span id="messageBoxPhone" style="color:#dc3545"></span>
                <input type="text" class="form-control" id="ud_phone_number" name="ud_phone_number" value="<?php echo isset($user_info['ud_phone_number']) ? $user_info['ud_phone_number']: '';?>" />

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="ud_dob_1"><?php echo DOB; ?>*</label>

              <div class="col-sm-5">
                <span id="messageBoxDOB" style="color:#dc3545;"></span>
                <div class="row rdc_pad">

                  <div class="col-md-4">

                    <select class="form-control" id="ud_dob_1" name="ud_dob[0]">

                      <option value=""><?php echo DOB_DAY; ?></option>

                      <?php

                      for ($i=1; $i < 32; $i++) {

                        $sl1 =  (isset($user_info) && $user_info['ud_dob'][0] == $i) ? 'selected' : '';

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

                        $sl2 =  (isset($user_info) && $user_info['ud_dob'][1] == $key) ? 'selected' : '';

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

                        $sl3 =  (isset($user_info) && $user_info['ud_dob'][2] == $j) ? 'selected' : '';

                        echo '<option value="'.$j.'" '.$sl3.'>'.$j.'</option>';

                      }

                      ?>

                    </select>

                  </div>

                </div>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="u_gender_m"><?php echo GENDER; ?>*</label>

              <div class="col-sm-5 radio_font">
                <span id="messageBoxGender" style="color:#dc3545"></span>
                <div class="row">

                  <!--<div class="col-md-6">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="u_gender" value="M" id="u_gender_m" <?php //echo isset($user_info['u_gender']) && $user_info['u_gender'] == 'M' ? 'checked' : '';?>>

                      <?php //echo MALE; ?></label>

                  </div>

                  <div class="col-md-6">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="u_gender" value="F" id="u_gender_f" <?php //echo isset($user_info['u_gender']) && $user_info['u_gender'] == 'F' ? 'checked' : '';?>>

                      <?php //echo FEMALE; ?></label>

                  </div>-->
                <div class="col-sm-12">
                    <div class="this">
                        <label><input type="radio" class="radio-inline" name="u_gender" value="M" id="u_gender_m" <?php echo isset($user_info['u_gender']) && $user_info['u_gender'] == 'M' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo MALE; ?></label>
                        <span style="padding-left: 65px;" ></span>
                        <label><input type="radio" class="radio-inline" name="u_gender" value="F" id="u_gender_f" <?php echo isset($user_info['u_gender']) && $user_info['u_gender'] == 'F' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo FEMALE; ?></label>
                    </div>
                </div>

                </div>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4"><?php echo RACE; ?></label>

              <div class="col-sm-5 radio_font">

                <div class="row">

                  <!--div class="col-md-4">

                    <label class="radio-inline udradio" style="font-size:15px;">

                      <input type="radio" name="ud_race" value="Malay" <?php //echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Malay' ? 'checked' : '';?>>

                      Malay</label>

                  </div>

                  <div class="col-md-4">

                    <label class="radio-inline udradio" style="font-size:15px;">

                      <input type="radio" name="ud_race" value="Chinese" <?php //echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Chinese' ? 'checked' : '';?>>

                      Chinese</label>

                  </div>

                  <div class="col-md-4">

                    <label class="radio-inline udradio" style="font-size:15px;">

                      <input type="radio" name="ud_race" value="Indian" <?php //echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Indian' ? 'checked' : '';?>>

                      Indian</label>

                  </div>

                  <div class="col-md-4">

                    <label class="radio-inline udradio" style="font-size:15px;">

                      <input type="radio" name="ud_race" value="Others" <?php //echo (isset($user_info['ud_race']) && $user_info['ud_race'] != 'Malay' && $user_info['ud_race'] != 'Chinese' && $user_info['ud_race'] != 'Indian' && $user_info['ud_race'] != 'Not selected') ? 'checked' : '';?>>

                      Others</label>

                  </div>

                  <div class="col-md-6">

                    <label class="radio-inline udradio" style="font-size:15px;">

                      <input type="radio" name="ud_race" value="Not selected" <?php //echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Not selected' ? 'checked' : '';?>>

                      Not selected</label>

                  </div>-->
<div class="col-sm-12">
    <div class="this">
        <label class="udradio"><input type="radio" class="radio-inline"  name="ud_race" value="Malay" <?php echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Malay' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span>Malay</label>
        <span style="padding-left: 59px;" ></span>
        <label class="udradio"><input type="radio" class="radio-inline"  name="ud_race" value="Chinese" <?php echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Chinese' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span>Chinese</label>
        <span style="padding-left: 70px;" ></span>
        <label class="udradio"><input type="radio" class="radio-inline"  name="ud_race" value="Indian" <?php echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Indian' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span>Indian</label>
        <span style="padding-left: 57px;" ></span>
        <label class="udradio"><input type="radio" class="radio-inline"  name="ud_race" value="Others" <?php echo (isset($user_info['ud_race']) && $user_info['ud_race'] != 'Malay' && $user_info['ud_race'] != 'Chinese' && $user_info['ud_race'] != 'Indian' && $user_info['ud_race'] != 'Not selected') ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span>Others</label>
        <span style="padding-left: 53px;" ></span>
        <label class="udradio"><input type="radio" class="radio-inline"  name="ud_race" value="Not selected" <?php echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Not selected' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span>Not Selected</label>
    </div>
</div>

                </div>

                <br>

                <div id="other_race_wrap">

                   <?php 

                   if (isset($_POST['ud_race']) && $_POST['ud_race'] != 'Malay' && $_POST['ud_race'] != 'Chinese' && $_POST['ud_race'] != 'Indian' && $_POST['ud_race'] != 'Not Selected') {

                      echo '<textarea placeholder="Please state your race/ethnicity e.g Kadazan Dusun" name="ud_race" class="form-control">'.$_POST['ud_race'].'</textarea>';

                   }  elseif (isset($user_info) && $user_info !== null && $user_info['ud_race'] != 'Malay' && $user_info['ud_race'] != 'Chinese' && $user_info['ud_race'] != 'Indian' && $user_info['ud_race'] != 'Not selected') {

                      echo '<textarea placeholder="Please state your race/ethnicity e.g Kadazan Dusun" name="ud_race" class="form-control" >'.$user_info['ud_race'].'</textarea>';

                   }

                   ?>

                </div>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4"><?php echo MARITAL_STATUS; ?></label>

              <div class="col-sm-5 radio_font">

                <div class="row">

                  <!--<div class="col-md-3">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="ud_marital_status" value="Married" <?php //echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Married' ? 'checked' : '';?>>

                      Married</label>

                  </div>

                  <div class="col-md-4">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="ud_marital_status" value="Not married" <?php //echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Not married' ? 'checked' : '';?>>

                      Not married</label>

                  </div>

                  <div class="col-md-5">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="ud_marital_status" value="Not selected" <?php //echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Not selected' ? 'checked' : '';?>>

                      Not selected</label>

                  </div>-->
<div class="col-sm-12">
    <div class="this">
        <label><input type="radio" class="radio-inline"  name="ud_marital_status" value="Married" <?php echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Married' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span>Married</label>
        <span style="padding-left: 46px;" ></span>
        <label><input type="radio" class="radio-inline"  name="ud_marital_status" value="Not married" <?php echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Not married' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span>Not Married</label>
        <span style="padding-left: 46px;" ></span>
        <label><input type="radio" class="radio-inline"  name="ud_marital_status" value="Not selected" <?php echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Not selected' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span>Not Selected</label>
    </div>
</div>

                </div>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="ud_address2"><?php echo STREET_ADDRESS; ?></label>

              <div class="col-sm-8">

                <textarea placeholder="Example: 8, Jalan Dedap 9, Bandar Saujana Utama, 47000" name="ud_address2" id="ud_address2" class="form-control" rows="5" style=""><?php echo isset($user_info['ud_address2']) ? $user_info['ud_address2']: '';?></textarea>

              </div>

            </div>

            <!--<div class="form-group">

              <label class="control-label col-sm-4" for="ud_city"><?php //echo YOUR_LOCATION; ?>*</label>

              <div class="col-sm-5">

<?php 
/*
    $queryCity2 = "SELECT * FROM tk_cities WHERE city_id='".$user_info['ud_city']."' "; 
    $resultCity2 = $dbCon->query($queryCity2); 
    if($resultCity2->num_rows > 0){ 
        $rowCity2 = $resultCity2->fetch_assoc();
        $thisCity =  $rowCity2['city_name'];   
    }else{
        $thisCity =  $user_info['ud_city'];
    }*/
//$dbCon->close();   
?>
                <textarea name="ud_city" id="ud_city" class="form-control" data-rule-required="true" data-msg-required="- Location is required."><?php //echo $thisCity; //echo isset($user_info['ud_city']) ? $user_info['ud_city']: '';?></textarea>
              

                <label class="box_text_1"><?php //echo YOUR_LOCATION_EXAMPLE; ?></label>

              </div>

            </div>-->
            
            
            
            
            

            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo 'The City you are currently staying in'; ?>*</label>
                <div class="col-sm-4">
                    <!--<select class="form-control" name="search_ud_state" id="search_ud_state" data-rule-required="true" data-msg-required="- State & City is required.">
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
                    <select class="js-example-basic-single" name="search_ud_city" id="search_ud_city" style="width: 100%"  data-rule-required="true" data-msg-required="- State & City is required.">
                    <option value="">Please Select State</option>
                    <?php 
                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        while($resultDataState= $rowDataState->fetch_assoc()){
                            echo '<optgroup label="'. $resultDataState['st_name'] .'">';
													
                            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_st_id = '".$resultDataState['st_id']."' ORDER BY city_name ASC ";
                            $rowDataCity = $conn->query($queryDataCity);
                            if ($rowDataCity->num_rows > 0) {
                                while($resultDataCity = $rowDataCity->fetch_assoc()){
                                    $sel2 = (isset($user_info['ud_city']) && $user_info['ud_city'] == $resultDataCity['city_id']) ? 'selected' : (($user_info['ud_city'] == $resultDataCity['city_id']) ? 'selected' : '' );
                                    echo '<option value="'. $resultDataCity['city_id'] .'" '.$sel2.'>'. $resultDataCity['city_name'] .'</option>';
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
                    <!--<select class="form-control" name="search_ud_city" id="search_ud_city" data-rule-required="true" data-msg-required="- State & City is required.">
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
                </div>
            </div>

            
            
            
            
            
            
            
            
            
            <div class="form-group">
              <label class="control-label col-sm-4" for="conduct_online"><?php echo CONDUCT_ONLINE; ?> * <font color="black"><a id="popoverData" class="hidden" data-html="true" data-content="Please tick the tool for online teaching that you are familiar with (you can tick more than 1 tool)" rel="popover" data-placement="bottom" data-trigger="hover"><span class="glyphicon glyphicon-info-sign" style="margin-top:0px;color:#262262" ></span></a></font>
              <br/><a href="https://www.tutorkami.com/tuition/kelas-online-part-1/" target="_blank" class="box_text_2 sample-tooltip"><font color="blue" style="text-decoration: underline;"><?php echo 'Click here to learn how you can start online tutoring'; ?></font></a>
              </label>
              <div class="col-sm-8 radio_font">
                <span id="messageBoxConductOnline" style="color:#dc3545"></span><span id="messageBoxHiddentoolsname1" style="color:#dc3545"></span>
                <div class="row">
                  <!--<div class="col-md-6">
                    <label class="radio-inline udradio2" style="font-size:15px;">
                      <input type="radio" name="conduct_online" value="Yes" <?php //echo isset($user_info['conduct_online']) && $user_info['conduct_online'] == 'Yes' ? 'checked' : '';?> data-rule-required="true" data-msg-required="- Conduct Online is required.">
                      <?php //echo YES; ?></label>
                  </div>

                  <div class="col-md-6">
                    <label class="radio-inline udradio2" style="font-size:15px;">
                      <input type="radio" name="conduct_online" value="No" <?php //echo isset($user_info['conduct_online']) && $user_info['conduct_online'] == 'No' ? 'checked' : '';?>>
                      <?php //echo NO; ?></label>
                  </div>-->
                <div class="col-sm-12">
                    <div class="this">
                        <label class="udradio2"><input type="radio" class="radio-inline"  name="conduct_online" value="Yes" <?php echo isset($user_info['conduct_online']) && $user_info['conduct_online'] == 'Yes' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo YES; ?></label>
                        <span style="padding-left: 78px;" ></span>
                        <label class="udradio2"><input type="radio" class="radio-inline"  name="conduct_online" value="No" <?php echo isset($user_info['conduct_online']) && $user_info['conduct_online'] == 'No' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo NO; ?></label>
                    </div>
                </div>
                </div>
                <!--<div class="notice"><?PHP //if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo ""; }else{ echo "If you tick Yes, please specify in ‘About Yourself’ section what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc"; }?></div>-->
                <div id="conduct_online_wrap" class="hidden">

                   <?php 
/*
                   if ( isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'Yes' ) {

                      echo '<textarea placeholder="Please state what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc" name="conduct_online_text" class="form-control">'.$_POST['conduct_online_text'].'</textarea>';

                   }  elseif ( isset($user_info) && $user_info !== null && $user_info['conduct_online'] == 'Yes' ) {

                      echo '<textarea placeholder="Please state what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc" name="conduct_online_text" class="form-control" >'.$user_info['conduct_online_text'].'</textarea>';

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
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Microsoft Teams') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Microsoft Teams"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Microsoft Teams</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Google Hangouts') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Google Hangouts"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Hangouts</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Google Meet') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Google Meet"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Meet</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Google Classroom') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Google Classroom"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Classroom</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Google Duo') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Google Duo"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Duo</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Google Doc') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Google Doc"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Doc</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Zoom') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Zoom"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Zoom</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Skype') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Skype"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Skype</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'WhatsApp') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="WhatsApp"><span class="cr"><i class="cr-icon fa fa-check"></i></span>What's App</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Telegram') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Telegram"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Telegram</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Lark') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Lark"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Lark</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'GeoGebra') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="GeoGebra"><span class="cr"><i class="cr-icon fa fa-check"></i></span>GeoGebra</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Whereby') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Whereby"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Whereby</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Others') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Others"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Others</label><br>
								</div>
								<div class="pull-right checkbox mobileCheckbox mobileCheckboxFont">
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Phone Call') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Phone Call"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Phone Call</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Video Call') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Video Call"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Video Call</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Webex') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Webex"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Webex</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'YouTube') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="YouTube"><span class="cr"><i class="cr-icon fa fa-check"></i></span>YouTube</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Facebook') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Facebook"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Facebook</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'FaceTime') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="FaceTime"><span class="cr"><i class="cr-icon fa fa-check"></i></span>FaceTime</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Instagram') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Instagram"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Instagram</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Email') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Email"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Email</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Quizziz') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Quizziz"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Quizziz</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Kahoot') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Kahoot"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Kahoot</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Chegg') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Chegg"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Chegg</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'Edmodo') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="Edmodo"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Edmodo</label><br>
									<label style="font-size: 1em"><input type="checkbox" <?PHP if(strpos($user_info['conduct_online_text'], 'TeamLink') !== false){ echo "checked"; } ?> onchange="handleChange1();" name="toolsname1" value="TeamLink"><span class="cr"><i class="cr-icon fa fa-check"></i></span>TeamLink</label>

								</div>
							</div>
							<div class="col-xs-12">
							    <div class="pull-left checkbox mobileCheckboxFont"> 
									<?PHP if(strpos($user_info['conduct_online_text'], 'Others') !== false){
									?>
										<label id="conduct_online_other"  style="font-size: 1em"><textarea style="overflow-y: scroll;" class="form-control" name="conduct_online_other" cols="25" rows="50" placeholder="Type the name of the tool"><?php echo (isset($_POST['conduct_online_other'])) ? $_POST['conduct_online_other'] : ( (isset($user_info) && $user_info !== null) ? $user_info['conduct_online_other'] : '' );?></textarea></label>					
									<?PHP
									}else{
									?>
										<label id="conduct_online_other" class="hidden" style="font-size: 1em"><textarea style="overflow-y: scroll;" class="form-control" name="conduct_online_other" cols="25" rows="50" placeholder="Type the name of the tool"><?php echo (isset($_POST['conduct_online_other'])) ? $_POST['conduct_online_other'] : ( (isset($user_info) && $user_info !== null) ? $user_info['conduct_online_other'] : '' );?></textarea></label>					
									<?PHP  
									} 
									?>
							    </div>
							</div>
						</div><br/><br/>
					</div><input style="width: 2px;border:none;background-color:#f3f3f5;color:#f3f3f5" type="text" id="hiddentoolsname1" name="hiddentoolsname1" value="<?php echo (isset($_POST['conduct_online_text'])) ? $_POST['conduct_online_text'] : ( (isset($user_info) && $user_info !== null) ? $user_info['conduct_online_text'] : '' );?>" >
					<!--<input style="width: 80%" type="hidden" id="hiddentoolsname1" name="hiddentoolsname1" value="<?php //echo (isset($_POST['conduct_online_text'])) ? $_POST['conduct_online_text'] : ( (isset($user_info) && $user_info !== null) ? $user_info['conduct_online_text'] : '' );?>" >-->

                </div>
              
              
              
              </div>
            </div>            
			
            <div class="form-group">
              <label class="control-label col-sm-4" for="conduct_class"><?php echo CONDUCT_CLASS; ?> *</label>
              <div class="col-sm-8 radio_font">
                <span id="messageBoxConductClass" style="color:#dc3545"></span>
                <div class="row">
                  <!--<div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="conduct_class" value="Yes" <?php //echo isset($user_info['conduct_class']) && $user_info['conduct_class'] == 'Yes' ? 'checked' : '';?> data-rule-required="true" data-msg-required="- This detail is required">
                      <?php //echo YES; ?></label>
                  </div>

                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="conduct_class" value="No" <?php //echo isset($user_info['conduct_class']) && $user_info['conduct_class'] == 'No' ? 'checked' : '';?>>
                      <?php //echo NO; ?></label>
                  </div>-->
                <div class="col-sm-12">
                    <div class="this">
                        <label><input type="radio" class="radio-inline"  name="conduct_class" value="Yes" <?php echo isset($user_info['conduct_class']) && $user_info['conduct_class'] == 'Yes' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo YES; ?></label>
                        <span style="padding-left: 78px;" ></span>
                        <label><input type="radio" class="radio-inline"  name="conduct_class" value="No" <?php echo isset($user_info['conduct_class']) && $user_info['conduct_class'] == 'No' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo NO; ?></label>
                    </div>
                </div>
                  
                  
                </div>
              </div>
            </div>

            <div class="form-group">

              <label class="control-label col-sm-4"><?php echo STATUS_AS_TUTOR; ?></label>

              <div class="col-sm-8 radio_font">

                <div class="row">

                  <!--<div class="col-md-6">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="ud_tutor_status" value="Full Time" <?php //echo isset($user_info['ud_tutor_status']) && $user_info['ud_tutor_status'] == 'Full Time' ? 'checked' : '';?>>

                      <?php //echo FULL_TIME; ?></label>

                  </div>

                  <div class="col-md-6">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="ud_tutor_status" value="Part Time" <?php //echo isset($user_info['ud_tutor_status']) && $user_info['ud_tutor_status'] == 'Part Time' ? 'checked' : '';?>>

                      <?php //echo PART_TIME; ?></label>

                  </div>-->
                    <div class="col-sm-12">
                        <div class="this">
                            <label><input type="radio" class="radio-inline"  name="ud_tutor_status" value="Full Time" <?php echo isset($user_info['ud_tutor_status']) && $user_info['ud_tutor_status'] == 'Full Time' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo FULL_TIME; ?></label>
                            <span style="padding-left: 43px;" ></span>
                            <label><input type="radio" class="radio-inline"  name="ud_tutor_status" value="Part Time" <?php echo isset($user_info['ud_tutor_status']) && $user_info['ud_tutor_status'] == 'Part Time' ? 'checked' : '';?> ><span class="outside"><span class="inside"></span></span><?php echo PART_TIME; ?></label>
                        </div>
                    </div>
                </div>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="ud_current_occupation"><?php echo CURRENT_OCCUPATION; ?></label>

              <div class="col-sm-4">

                <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">

                  <option value="">Select one</option>

                  <option value="Full-time tutor" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Full-time tutor' ? 'selected' : '';?>><?php echo FULL_TIME_TUTOR; ?></option>

                  <option value="Kindergarten teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Kindergarten teacher' ? 'selected' : '';?>><?php echo KINDERGARTEN_TEACHER; ?></option>

                  <option value="Primary school teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Primary school teacher' ? 'selected' : '';?>><?php echo PRIMARY_SCHOOL_TEACHER; ?></option>

                  <option value="Secondary school teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Secondary school teacher' ? 'selected' : '';?>><?php echo SECONDARY_SCHOOL_TEACHER; ?></option>

                  <option value="Tuition center teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Tuition center teacher' ? 'selected' : '';?>><?php echo TUITION_CENTER_TEACHER; ?></option>

                  <option value="Lecturer" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Lecturer' ? 'selected' : '';?>>Lecturer</option>

                  <option value="Ex-teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Ex-teacher' ? 'selected' : '';?>><?php echo EX_TEACHER; ?></option>

                  <option value="Retired teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Retired teacher' ? 'selected' : '';?>><?php echo RETIRED_TEACHER; ?></option>

                  <option value="Other" <?php echo (isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Other') ? 'selected' : '';?>><?php echo OTHER; ?></option>

                </select>

              </div>

              <div class="col-sm-4">

                <?php 

                 if(isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Other') {

                  $occ_other = $user_info['ud_current_occupation_other'];

                  $sty_other = 'block';

                 } else {

                  $occ_other = '';

                  $sty_other = 'none';

                 }

                ?>

                <input placeholder="e.g Engineer, Accountant, Researcher" class="form-control" type="text" name="ud_current_occupation_other" value="<?php echo $occ_other;?>" style="display: <?php echo $sty_other;?>;">

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="ud_current_company"><?php echo CURRENT_COMPANY; ?></label>

              <div class="col-sm-8">

                <input placeholder="e.g. SMK Seafield, SEGI College, AirAsia, Kementerian Pendidikan Msia" type="text" name="ud_current_company" id="ud_current_company" class="form-control" value="<?php echo isset($user_info['ud_current_company']) ? $user_info['ud_current_company']: '';?>" />

                <!--<label class="box_text_1"><?php //echo CURRENT_COMPANY_EXAMPLE; ?></label>-->

              </div>

            </div>
			
			
			

            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo 'Location of your workplace'; ?></label>
                <div class="col-sm-4">
                    <!--<select class="form-control" name="locationWorkplaceState" id="locationWorkplaceState" >
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
                            $sel = (isset($user_info['ud_workplace_state']) && $user_info['ud_workplace_state'] == $rowState['st_id']) ? 'selected' : (($user_info['ud_workplace_state'] == $rowState['st_id']) ? 'selected' : '' );
                            echo '<option value="'. $rowState['st_id'] .'" '.$sel.'>'. $rowState['st_name'] .'</option>';
                        }
                    }*/
                    ?>
                    </select>-->

                    <select class="js-example-basic-single" name="locationWorkplaceCity" id="locationWorkplaceCity" style="width: 100%" >
                    <option value="">Please Select State</option>
                    <?php 
                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        while($resultDataState= $rowDataState->fetch_assoc()){
                        echo '<optgroup label="'. $resultDataState['st_name'] .'">';
													
                            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_st_id = '".$resultDataState['st_id']."' ORDER BY city_name ASC ";
                            $rowDataCity = $conn->query($queryDataCity);
                            if ($rowDataCity->num_rows > 0) {
                                while($resultDataCity = $rowDataCity->fetch_assoc()){
                                    $sel3 = (isset($user_info['ud_workplace_city']) && $user_info['ud_workplace_city'] == $resultDataCity['city_id']) ? 'selected' : (($user_info['ud_workplace_city'] == $resultDataCity['city_id']) ? 'selected' : '' );
                                    echo '<option value="'. $resultDataCity['city_id'] .'" '.$sel3.'>'. $resultDataCity['city_name'] .'</option>';
                                }			
                            }
													
                        echo '</optgroup>';
                        }			
                    }
                    ?>
                    </select><label class="box_text_1"><font color="#262262"><?php echo '*Provide this info if you would like to get notified with tuition jobs near your workplace'; ?></font></label>
                </div>
                <div class="col-sm-4">
                    <div id="locationWorkplaceStateText" name="locationWorkplaceStateText"></div>
                    <!--<select class="form-control" name="locationWorkplaceCity" id="locationWorkplaceCity" >
					<option value="">Please Select City</option>
                        <?PHP
                        /*if(isset($user_info['ud_workplace_state']) && $user_info['ud_workplace_state'] != ''){
                            $queryCity = "SELECT * FROM tk_cities WHERE city_st_id = '".$user_info['ud_workplace_state']."' ORDER BY city_name ASC"; 
                            $resultCity = $dbCon->query($queryCity); 
                            if($resultCity->num_rows > 0){ 
                                while($rowCity = $resultCity->fetch_assoc()){
                                    $sel2 = (isset($user_info['ud_workplace_city']) && $user_info['ud_workplace_city'] == $rowCity['city_id']) ? 'selected' : (($user_info['ud_workplace_city'] == $rowCity['city_id']) ? 'selected' : '' );
                                    echo '<option value="'. $rowCity['city_id'] .'" '.$sel2.'>'. $rowCity['city_name'] .'</option>';
                                }
                            }                            
                        }*/
                        ?>
                    </select>-->
                </div>
            </div>
			<!--<div class="form-group" style="margin-top:-20px;">
				<div class="col-sm-4">&nbsp;</div>
				<div class="col-sm-8"><label class="box_text_1"><font color="#262262"><?php //echo '*Provide this info if you would like to get notified with tuition jobs near your workplace'; ?></font></label></div>
			</div>-->
			
			
			
			
			
			


            <div class="form-group" style="margin-top:-40px;">
              <label class="control-label col-sm-4" for=""></label>
              <div class="col-sm-8">
                <div id="dvLoading"></div>
                <label class="box_text_1"></label>
              </div>
            </div>

<div id="div1"></div>

            <div class="form-group">
              <label class="control-label col-sm-4"><?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Boleh anda mengajar pelajar kurang upaya?"; }else{ echo "Can you teach student with learning disability?"; }?></label>
              <div class="col-sm-8 radio_font">
                <div class="row">
                  <!--<div class="col-md-6">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="student_disability" value="Yes" <?php //echo (isset($user_info['student_disability']) && $user_info['student_disability'] == 'Yes') ? 'checked' : ''; ?>>
                      <?php //echo YES; ?></label>
                  </div>
                  <div class="col-md-6">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="student_disability" value="No" <?php //echo (isset($user_info['student_disability']) && $user_info['student_disability'] == 'No') ? 'checked' : ''; ?>>
                      <?php //echo NO; ?></label>
                  </div>-->
                <div class="col-sm-12">
                    <div class="this">
                        <label class="udradio"><input type="radio" class="radio-inline" name="student_disability" value="Yes" <?php echo (isset($user_info['student_disability']) && $user_info['student_disability'] == 'Yes') ? 'checked' : ''; ?>  ><span class="outside"><span class="inside"></span></span><?php echo YES; ?></label>
                        <span style="padding-left: 78px;" ></span>
                        <label class="udradio"><input type="radio" class="radio-inline" name="student_disability" value="No" <?php echo (isset($user_info['student_disability']) && $user_info['student_disability'] == 'No') ? 'checked' : ''; ?>  ><span class="outside"><span class="inside"></span></span><?php echo NO; ?></label>
                    </div>
                </div>
                </div>
                <!--<div class="notice"><?PHP //if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Jika anda tandakan Ya, sila sebutkan di seksyen 'Mengenai Diri Anda'. Seperti Dyslexia, ADHD, Autism dan lain-lain."; }else{ echo "If you tick Yes, please mention in ‘About Yourself’ section the types you can attend to e.g Dyslexia, ADHD, Autism etcs"; }?></div>-->
                <div id="student_disability_wrap">

                   <?php 

                   if ( isset($_POST['student_disability']) && $_POST['student_disability'] == 'Yes' ) {

                      echo '<textarea placeholder="Please state the type of disabilities you can attend to e.g Dyslexia, ADHD, Autism etcs" name="student_disability_text" class="form-control">'.$_POST['student_disability_text'].'</textarea>';

                   }  elseif ( isset($user_info) && $user_info !== null && $user_info['student_disability'] == 'Yes' ) {

                      echo '<textarea placeholder="Please state the type of disabilities you can attend to e.g Dyslexia, ADHD, Autism etcs" name="student_disability_text" class="form-control" >'.$user_info['student_disability_text'].'</textarea>';

                   }

                   ?>

                </div>
              
              
              
              </div>
            </div>
			

            <div class="hidden form-group">

              <label class="control-label col-sm-4" for="pwd">

              <?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Kadar/jam (pilihan)"; }else{ echo "Your rate/hour (optional)"; }?>
			  <br>

              </label>

              <div class="col-sm-8">

                <textarea class="form-control" placeholder="<?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Contoh: UPSR: RM35 / jam, SPM: RM50 / jam, IGCSE: RM70 / jam. Tinggalkan kosong jika anda tidak pasti"; }else{ echo "Example: UPSR : RM35/hour, SPM : RM50/hour, IGCSE: RM70/hour. Leave empty if you are not sure"; }?>" style="height: 90px;" name="ud_rate_per_hour" id="ud_rate_per_hour"><?php echo isset($user_info['ud_rate_per_hour']) ? $user_info['ud_rate_per_hour']: '';?></textarea>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="ud_qualification"><?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION; ?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" id="ud_qualification" name="ud_qualification" value="<?php echo isset($user_info['ud_qualification']) ? $user_info['ud_qualification']: '';?>">

                <label class="box_text_1"><?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION_EXAMPLE; ?></label>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="ud_tutor_experience"><?php echo TUTORING_EXPERIENCE; ?></label>

              <div class="col-sm-8">
                <span id="messageBoxExperience" style="color:#dc3545"></span>
                <div class="row">

                  <!--<div class="col-md-6 col-sm-7">

                    <input type="text" class="form-control" id="ud_tutor_experience" name="ud_tutor_experience" value="<?php //echo isset($user_info['ud_tutor_experience']) ? $user_info['ud_tutor_experience']: '';?>">

                  </div>

                  <div class="col-md-6 col-sm-5">

                    <p class="box_text_3"> <?php //echo YEAR; ?> </p>

                  </div>-->
                  
                  <div class="col-md-2 col-sm-2">


                    <input style="width: 50px;" onBlur="isNumberKeyIn1()" maxlength="2" type="text" class="form-control" id="ud_tutor_experience" name="ud_tutor_experience" value="<?php echo isset($user_info['ud_tutor_experience']) ? $user_info['ud_tutor_experience']: '';?>">


                  </div>

                  <div class="col-md-4 col-sm-4">
                    <select class="form-control" onChange="isNumberKeyIn2()" name="experienceMonth" id="experienceMonth" style="width: 140px;">
                    <option value="">Please Choose</option>
                    <option value="year" <?php echo isset($user_info['ud_tutor_experience_month']) && $user_info['ud_tutor_experience_month'] == 'year' ? 'selected' : '';?> >Year(s)</option>
                    <option value="month" <?php echo isset($user_info['ud_tutor_experience_month']) && $user_info['ud_tutor_experience_month'] == 'month' ? 'selected' : '';?> >Month(s)</option>
                    </select>
                  </div>
                    <label style="margin-left:15px;"><input type="text" value="<?php if(isset($user_info['ud_tutor_experience_month']) && $user_info['ud_tutor_experience_month'] != ''){ echo 'monthyear'; } ?>" id="ud_tutor_experienceError" name="ud_tutor_experienceError"  style="width: 2px;height: 2px;border:none;background-color:#f3f3f5;color:#f3f3f5;" ></label>
                </div>

              </div>

            </div>
            
            
            
            
            

            <div class="form-group">

              <label class="control-label col-sm-4"><?php echo WILL_TEACH_AT_TUITION_CENTER; ?></label>

              <div class="col-sm-8 radio_font">

                <div class="row">

                  <!--<div class="col-md-6">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="tution_center" value="1" <?php echo (isset($user_info['ud_client_status']) && $user_info['ud_client_status'] == 'Tuition Centre') ? 'checked' : ''; ?>>

                      <?php echo YES; ?></label>

                  </div>

                  <div class="col-md-6">

                    <label class="radio-inline" style="font-size:15px;">

                      <input type="radio" name="tution_center" value="0" <?php echo (isset($user_info['ud_client_status']) && $user_info['ud_client_status'] != 'Tuition Centre') ? 'checked' : ''; ?>>

                      <?php echo NO; ?></label>

                  </div>-->
                <div class="col-sm-12">
                    <div class="this">
                        <label><input type="radio" class="radio-inline" name="tution_center" value="1" <?php echo (isset($user_info['ud_client_status']) && $user_info['ud_client_status'] == 'Tuition Centre') ? 'checked' : ''; ?>  ><span class="outside"><span class="inside"></span></span><?php echo YES; ?></label>
                        <span style="padding-left: 78px;" ></span>
                        <label><input type="radio" class="radio-inline" name="tution_center" value="0" <?php echo (isset($user_info['ud_client_status']) && $user_info['ud_client_status'] != 'Tuition Centre') ? 'checked' : ''; ?>  ><span class="outside"><span class="inside"></span></span><?php echo NO; ?></label>
                    </div>
                </div>

                </div>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-4" for="ud_about_yourself">

              <?php echo ABOUT_YOURSELF; ?>* <br>

              <p class="box_text_2"><?php echo ABOUT_YOURSELF_MESSAGE; ?></p>

              </label>

              <div class="col-sm-8">
                <span id="messageBoxAboutYourself" style="color:#dc3545"></span>
                <textarea class="form-control" style="height: 90px;" name="ud_about_yourself" id="ud_about_yourself"><?php echo isset($user_info['ud_about_yourself']) ? $user_info['ud_about_yourself']: '';?></textarea>

                <!--<a href="javascript:void(0);" class="box_text_1 sample-tooltip" data-toggle="tooltip" data-html="true" data-placement="top" title="<small style='font-size: 10px;'><?php echo VIEW_SAMPLE_POPUP_TEXT; ?></small>"><?php echo VIEW_SAMPLE; ?></a>-->
                <a href="https://www.tutorkami.com/tuition/guide-tips-about-yourself/" target="_blank" class="box_text_2 sample-tooltip"><font color="blue" style="text-decoration: underline;"><?php echo VIEW_SAMPLE; ?></font></a>
              </div>

            </div>
            
            
            
            
            
            
            
            
            

            <!--<div class="form-group">

              <label class="control-label col-sm-4">

              <?php //echo UPLOAD_PROFILE_PICTURE; ?> <br>

              <p class="box_text_2"><?php //echo UPLOAD_PROFILE_PICTURE_MESSAGE; ?></p>

              </label>

              <div class="col-sm-8">

                <input type="file" name="u_profile_pic" id="file-7" class="inputfile inputfile-6" accept="image/*" style="display:none;">

                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php echo CHOOSE_A_FILE; ?></strong></label>

              </div>

            </div>-->
            
            
            
            
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
	
	var oripreview = document.getElementById("oripreview");
	oripreview.classList.add("hidden");
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
		   
              <label class="control-label col-sm-4" for="pwd"><?php echo UPLOAD_PROFILE_PICTURE; ?><br>
                <p class="box_text_2"><?php //echo UPLOAD_PROFILE_PICTURE_MESSAGE; ?></p>
              </label>


             <div class="col-sm-8">

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
            


            <div class="form-group" id="oripreview">

              <label class="control-label col-sm-4"></label>

              <div class="col-sm-8">

                <img src="<?php 

                if ($user_info['u_profile_pic'] != '') {

                  //echo APP_ROOT.$user_info['u_profile_pic'];
				  //echo APP_ROOT."images/profile/000".$user_info['u_profile_pic']."_0.jpg";
				  // START fadhli 
				  $pix = sprintf("%'.07d", $user_info['u_profile_pic']);
				  $pixAll = $pix.'_0.jpg';
				  //echo APP_ROOT."images/profile/".$pixAll;
				  if ( is_numeric($user_info['u_profile_pic']) ) {
						echo APP_ROOT."images/profile/".$pixAll;
				  }else{
						echo APP_ROOT."images/profile/".$user_info['u_profile_pic'].".jpg";
				  }
				  // END fadhli 
				  
                } elseif ($user_info['u_gender'] == 'M') {

                  echo APP_ROOT."images/tutor_ma.png";

                } else {

                  echo APP_ROOT."images/tutor_mi1.png";

                }

                ?>" alt="profile_pic" class="img-thumbnail" />

              </div>

            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            <div class="form-group">

              <label class="control-label col-sm-4">

              <?php echo UPLOAD_TESTIMONIALS; ?> <br>

              <p class="box_text_2"><?php echo UPLOAD_TESTIMONIALS_MESSAGE1; ?><br>

                <br>

                <?php echo UPLOAD_TESTIMONIALS_MESSAGE2; ?></p>

              </label>

              <div class="col-sm-8">

              <?php 

              $image1 = $image2 = $image3 = $image4 = '';

              $getTestimonial = system::FireCurl(USER_TESTIMONIAL."?uid=".$user_id); 
/*
               foreach ($getTestimonial->data as $key => $testimonial) {

                if($testimonial->ut_user_testimonial1 !='') $image1 = substr($testimonial->ut_user_testimonial1,6);

                else $image1 = '';

                if($testimonial->ut_user_testimonial2 !='') $image2 = substr($testimonial->ut_user_testimonial2,6);

                else $image2 = '';

                if($testimonial->ut_user_testimonial3 !='') $image3 = substr($testimonial->ut_user_testimonial3,6);

                else $image3 = '';

                if($testimonial->ut_user_testimonial4 !='') $image4 = substr($testimonial->ut_user_testimonial4,6);

                else $image4 = '';

              }
*/
              ?>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="file" name="user_testimonial1" id="testimonial_1" class="" style="">
                <label for="testimonial_1"><span></span> <strong> <?php echo CHOOSE_A_FILE; ?></strong></label>
                <br/>
<div>
  <input id="checkbox-1" class="checkbox-custom" name="checkbox-1" type="checkbox">
  <label for="checkbox-1" class="checkbox-custom-label">DELETE TESTIMONIAL 1</label>
</div>
			  </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <?PHP
                foreach ($getTestimonial->data as $key => $testimonial) {
					if($testimonial->ut_user_testimonial1 !="" || $testimonial->ut_user_testimonial1 != NULL){
						 ?>
						 <!--<img src="<?php //echo APP_ROOT."images/".substr($testimonial->ut_user_testimonial1,6);?>" alt="testimonial" class="img-thumbnail" style="width: 215px;" />-->
    					<a href="<?php echo APP_ROOT."images".substr($testimonial->ut_user_testimonial1,6);?>" class="thumbnail-2" title="">
    						<img src="<?php echo APP_ROOT."images".substr($testimonial->ut_user_testimonial1,6);?>" alt="testimonial" class="img-thumbnail" style="width: 215px;">
    					</a>
						 <?PHP
					}				
                }
                ?>
              </div>
            </div>
			
            <div class="form-group">
              <div class="col-sm-12">
                <input type="file" name="user_testimonial2" id="testimonial_2" class="" style="">
                <label for="testimonial_2"><span></span> <strong> <?php echo CHOOSE_A_FILE; ?></strong></label> 
                <br/>
<div>
  <input id="checkbox-2" class="checkbox-custom" name="checkbox-2" type="checkbox">
  <label for="checkbox-2" class="checkbox-custom-label">DELETE TESTIMONIAL 2</label>
</div>
				
			  </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <?PHP
                foreach ($getTestimonial->data as $key => $testimonial) {
					if($testimonial->ut_user_testimonial2 !="" || $testimonial->ut_user_testimonial2 != NULL){
						?>
						<!--<img src="<?php //echo APP_ROOT."images/".substr($testimonial->ut_user_testimonial2,6);?>" alt="testimonial" class="img-thumbnail" style="width: 215px;" />-->
    					<a href="<?php echo APP_ROOT."images".substr($testimonial->ut_user_testimonial2,6);?>" class="thumbnail-2" title="">
    						<img src="<?php echo APP_ROOT."images".substr($testimonial->ut_user_testimonial2,6);?>" alt="testimonial" class="img-thumbnail" style="width: 215px;">
    					</a>
						<?PHP
					}				
                }
                ?>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">  
                <input type="file" name="user_testimonial3" id="testimonial_3" class="" style="">
                <label for="testimonial_3"><span></span> <strong> <?php echo CHOOSE_A_FILE; ?></strong></label>
                <br/>
<div>
  <input id="checkbox-3" class="checkbox-custom" name="checkbox-3" type="checkbox">
  <label for="checkbox-3" class="checkbox-custom-label">DELETE TESTIMONIAL 3</label>
</div>
			  </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <?PHP
                foreach ($getTestimonial->data as $key => $testimonial) {
					if($testimonial->ut_user_testimonial3 !="" || $testimonial->ut_user_testimonial3 != NULL){
						?>
						<!--<img src="<?php //echo APP_ROOT."images/".substr($testimonial->ut_user_testimonial3,6);?>" alt="testimonial" class="img-thumbnail" style="width: 215px;" />-->
    					<a href="<?php echo APP_ROOT."images".substr($testimonial->ut_user_testimonial3,6);?>" class="thumbnail-2" title="">
    						<img src="<?php echo APP_ROOT."images".substr($testimonial->ut_user_testimonial3,6);?>" alt="testimonial" class="img-thumbnail" style="width: 215px;">
    					</a>
						<?PHP
					}				
                }
                ?>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">  
                <input type="file" name="user_testimonial4" id="testimonial_4" class="" style="">
                <label for="testimonial_4"><span></span> <strong> <?php echo CHOOSE_A_FILE; ?></strong></label>
                <br/>
<div>
  <input id="checkbox-4" class="checkbox-custom" name="checkbox-4" type="checkbox">
  <label for="checkbox-4" class="checkbox-custom-label">DELETE TESTIMONIAL 4</label>
</div>
			  </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
               <?PHP
                foreach ($getTestimonial->data as $key => $testimonial) {
					if($testimonial->ut_user_testimonial4 !="" || $testimonial->ut_user_testimonial4 != NULL){
						 ?>
						 <!--<img src="<?php //echo APP_ROOT."images/".substr($testimonial->ut_user_testimonial4,6);?>" alt="testimonial" class="img-thumbnail" style="width: 215px;" />-->
    					<a href="<?php echo APP_ROOT."images".substr($testimonial->ut_user_testimonial4,6);?>" class="thumbnail-2" title="">
    						<img src="<?php echo APP_ROOT."images".substr($testimonial->ut_user_testimonial4,6);?>" alt="testimonial" class="img-thumbnail" style="width: 215px;">
    					</a>
						 <?PHP
					}				
                }
                ?>
              </div>
            </div>
			






              </div>

            </div>

            <!--<div class="form-group">

              <div class="col-sm-12">

                <div id="testimonials">

                  <em><?php //echo CLICK_IMAGE_TO_ENLARGE; ?></em><i class="fa fa-plus plus" aria-hidden="true"></i> <br>

                  <ul class="whatsapp">

                     <?php 

                      // Get Course

                      
/*
                      if ($getTestimonial->flag == 'success' && count($getTestimonial->data) > 0) {

                        $i = 0;

                      foreach ($getTestimonial->data as $key => $testimonial) {

                          if($testimonial->ut_user_testimonial1 !=''){
*/
                     ?>

                     <li style="width: 215px;"><img src="<?php //echo $testimonial->ut_user_testimonial1; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                     <?php 

                         //} if($testimonial->ut_user_testimonial2 !='') { ?>

                     <li style="width: 215px;"><img src="<?php //echo $testimonial->ut_user_testimonial2; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                      <?php //} if($testimonial->ut_user_testimonial3 !='') { ?>

                     <li style="width: 215px;"><img src="<?php //echo $testimonial->ut_user_testimonial3; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li> 

                     <?php //} if($testimonial->ut_user_testimonial4 !='') { ?>

                     <li style="width: 215px;"><img src="<?php //echo $testimonial->ut_user_testimonial4; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                     <?php //} }

                      //}

                     ?>

                  </ul>

               </div>

              </div>

            </div>-->

            <div class="form-group">

              <div class="col-sm-6">

                <button id="btnRealSave" type="submit" class="btn btn-default autoClick" style="border-radius: 5px;"><?php echo BUTTON_SAVE; ?></button>
                
              </div>

            </div>

          </form>

        </div>

                <div>
                    <?PHP //if(isset($user_info['u_id']) && $user_info['u_id'] =='1579981'){ ?> <?PHP //} ?> 
					<div class="loadDataTimeTableFix">
						<div class="loadDataTimeTable">
						
<p>Available Time Slots for Classes</p><br>

<?PHP
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$conn = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($conn->connect_error) {
    die("connection failed : " . $conn->connect_error);
} else {
    // echo "Successfully Connected";
}

date_default_timezone_set("Asia/Kuala_Lumpur");

		$recordFirst = 1;
		//$orderArrayDay = array('Mon','Tues','Wed','Thur','Fri','Sat','Sun');
				//$queryTT = " SELECT * FROM tk_timetable WHERE tt_tutor='".$user_info['u_id']."' ORDER BY tt_id ASC"; 
		$queryTT = " SELECT * FROM tk_timetable WHERE tt_tutor='".$user_info['u_id']."' ORDER BY tt_day='Mon' DESC, tt_day='Tues' DESC, tt_day='Wed' DESC, tt_day='Thur' DESC, tt_day='Fri' DESC, tt_day='Sat' DESC, tt_day='Sun' DESC "; 
		$resultTT = $conn->query($queryTT);
		if ($resultTT->num_rows > 0) {
			?>

			
		 <input type="hidden" id="hdnListCountExist" value="<?PHP echo $resultTT->num_rows; ?>"/>
		 <input type="hidden" id="name3" value="<?PHP echo $resultTT->num_rows; ?>" />
				<form name="add_name2" id="add_name2" class="" style="margin-left:5px;">
					<div class="table-responsive">  
						<input type="hidden" id="hdnListCount" value="1"/>  
						<input type="hidden" name="tutorPHP" id="tutorPHP" value="<?php echo $user_info['u_id'];?>"/> 
						<table class="table" id="dynamic_fieldExist" >  
		<?PHP
							 $recordFirst = 1;
							 while($rowTT = $resultTT->fetch_assoc()){
		?>
							<tr id="<?php echo 'thistr'.$rowTT['tt_id'];?>">  
								<td>
									<select id="<?php echo 'select'.$rowTT['tt_id'];?>" name="dayPHP[]" class="form-control name_list hahah2" required="" >
										<option value="Mon" <?PHP if($rowTT['tt_day'] == 'Mon' ){echo 'selected';} ?> >Mon</option>
										<option value="Tues" <?PHP if($rowTT['tt_day'] == 'Tues' ){echo 'selected';} ?> >Tues</option>
										<option value="Wed" <?PHP if($rowTT['tt_day'] == 'Wed' ){echo 'selected';} ?> >Wed</option>
										<option value="Thur" <?PHP if($rowTT['tt_day'] == 'Thur' ){echo 'selected';} ?> >Thur</option>
										<option value="Fri" <?PHP if($rowTT['tt_day'] == 'Fri' ){echo 'selected';} ?> >Fri</option>
										<option value="Sat" <?PHP if($rowTT['tt_day'] == 'Sat' ){echo 'selected';} ?> >Sat</option>
										<option value="Sun"<?PHP if($rowTT['tt_day'] == 'Sun' ){echo 'selected';} ?>  >Sun</option>
									</select>
								</td>  
								<td><input id="<?php echo 'input'.$rowTT['tt_id'];?>" type="text" name="namePHP[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list hahah" required="" value="<?php echo $rowTT['tt_time'];?>"  /></td>  
								<td ><a id="<?php echo 'remove'.$rowTT['tt_id'];?>" style="color:red;font-size:30px;text-decoration: none;" name="remove" class="fa fa-trash-o btn_removePHP"></a></td>  
							</tr>   
		<?PHP
							 }
		?>
						</table>  
							<br/>
                          <div class="col-xs-2"></div>
                          <button style="padding-left:5px;padding-right:5px;" type="button" name="addMore" id="addMore" class="btn btn-success"><i class="fa fa-plus"></i> Add Day</button>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input style="background-color: #ED4917;color: white;padding-left:5px;padding-right:5px;" type="button" name="submitExist" id="submitExist" class="btn btn-oren" value="Update" /> 
                          
                 <input style="background-color: #ED4917;color: white;padding-left:5px;padding-right:5px;" id="submitBtnLoad" type='button' class='hidden btn btn-oren disabled' value='Loading'  />
						
						
						
						
					</div>
				 </form> 
			
			
			
			<?PHP
		}else{
			
		?>
				<input type="hidden" id="changeDayArray" />  
				<form name="add_name" id="add_name" style="margin-left:5px;">
					<div class="table-responsive">  
						<input type="hidden" id="hdnListCount" value="1"/>  
						<input type="hidden" name="tutor" id="tutor" value="<?php echo $user_info['u_id'];?>"/> 
						<table class="table" id="dynamic_field" >  

						</table>  
						<br/>
                          <div class="col-xs-2"></div>
                          <button style="padding-left:5px;padding-right:5px;" type="button" name="addTimeTable" id="addTimeTable" class="btn btn-success"><i class="fa fa-plus"></i> Add Day</button> 
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input style="background-color: #ED4917;color: white;padding-left:5px;padding-right:5px;" type="button" name="submitNew" id="submitNew" class="btn btn-oren" value="Update" />  
                          
                 <input style="background-color: #ED4917;color: white;padding-left:5px;padding-right:5px;" id="submitBtnLoad" type='button' class='hidden btn btn-oren disabled' value='Loading'  />
                    
						
					</div>
				 </form> 
		<?PHP   
		}
		?>
		
						</div>
					</div>
                </div>
                
                <div>
                    <!--Change Password-->
                
                    
                    
                    
                          <div class="row">
                    
                             <div class="col-md-8 col-md-offset-2">
                    
      
                    
                                <div class="col-md-12 mrg_top30">
                    
                                   <!--<form method="post" class="form-horizontal">-->
                                   <div class="form-horizontal">
                    
                                      <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['auth']['user_id']) ? $_SESSION['auth']['user_id'] : '';?>">
                                      <div id="alert-success" class="alert alert-success hidden" role="alert"><center>You have successfully changed your password</center></div>
                                      <div class="form-group">
                    
                                         <label class="control-label col-sm-4"><?php echo OLD_PASSWORD; ?>:</label>
                    
                                         <div class="col-sm-8"> 
                    
                                            <input type="password" class="form-control" id="pwd" name="old_password">
                    
                                         </div>
                    
                                      </div>
                    
                                      <div class="form-group">
                    
                                         <label class="control-label col-sm-4"><?php echo NEW_PASSWORD; ?>:</label>
                    
                                         <div class="col-sm-8"> 
                    
                                            <input type="password" class="form-control" id="pwd_1" name="new_password">
                    
                                         </div>
                    
                                      </div>
                    
                                      <div class="form-group">
                    
                                         <label class="control-label col-sm-4"><?php echo RE_ENTER_PASSWORD; ?>:</label>
                    
                                         <div class="col-sm-8"> 
                    
                                            <input type="password" class="form-control" id="pwd_2" name="confirm_password">
                    
                                         </div>
                    
                                      </div>
                    
                                      <div class="form-group">
                    
                                         <div class="col-sm-6">
                    
                                            <!--<button type="submit" class="btn btn-default"><?php //echo CHANGE; ?></button>-->
                                            <button type="button" class="btn btn-default"  style="border-radius: 5px;" onClick="savePassword()"><?php echo CHANGE; ?></button>

                    
                                         </div>
                    
                                      </div>
                    
                                   </div>
                                   <!--</form>-->
                    
                                </div>
                    
                                
                    
                             </div>
                    
                          </div>
                    
                       
                    
                
                </div>
                
                <!-- Subscribe -->
                <div>
                        <button type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#myModal" id="myModalButton" data-backdrop="static" data-keyboard="false" >Open Modal</button>
                        <div id="myModal" class="modal fade" role="dialog" style="margin-top:5%">
                          <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-body">
                                <p id="textModal" ></p>
                              </div>
                              <div class="modal-footer">
                                  <span id="buttonModal" ></span>
                              </div>
                            </div>
                        
                          </div>
                        </div>
                        <?PHP
                        $arrayJob = array();
                        $ListJob = " SELECT j_id, j_hired_tutor_email FROM tk_job where j_hired_tutor_email = '".$user_info['u_email']."' ";
                        $resultListJob = $conn->query($ListJob);
                        if ($resultListJob->num_rows > 0) {
                            while($rowListJob = $resultListJob->fetch_assoc()){
                                $arrayJob[] = $rowListJob['j_id'];
                            }
                        }
                        
                        if(!empty($arrayJob)){
                            $showWaApp = '';
                            $GetClasses = " SELECT cl_id, cl_display_id FROM tk_classes where cl_display_id IN (".implode(',', $arrayJob).") ";
                            $resultClasses = $conn->query($GetClasses);
                            if ($resultClasses->num_rows > 0) {
                                while($rowClasses = $resultClasses->fetch_assoc()){
                                   if( $rowClasses['cl_id'] != '' ){
                                       $showWaApp = 'yes';
                                   }
                                }
                            }
                            if( $showWaApp != '' ){
                                    $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$user_info['ud_phone_number']."' ";
                                    $resultLogWa = $conn->query($queryLogWa);
                                    if ($resultLogWa->num_rows > 0) {
                                    	$rowLogWa = $resultLogWa->fetch_assoc();
                                    	if( $rowLogWa['wa_note'] == 'Yes' ){
                                        	$welcomeWa = 'background-color: green;color: white;';
                                        	$textTab = 'You have allowed us to send you automatic message via What’s App';
                                        	$textTab2 = 'You have allowed us to send you <br/>automatic message via What’s App';
                                        	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
                                        	$onclick = '';
                                        	$btnColor = 'success';
                                        	$btnTooltips = '';	    
                                    	}else{
                                        	$welcomeWa = 'background-color: #F1592A;color: white;';
                                        	$textTab = 'Unsubscribed. Just click this button again to re-subscribe';
                                        	$textTab2 = 'Unsubscribed. Just click this button again to re-subscribe';
                                        	$textInfo = '';
                                        	$onclick = 'onclick="myFunction2('.$user_info['ud_phone_number'].')"';
                                        	$btnColor = 'orange';
                                        	$btnTooltips = '';	 
                                    	}
                                    
                                    }else{
                                        require_once('admin/classes/whatsapp-api-call.php');
                                    
                                        $website = "https://wa.tutorkami.my/api-docs/";



                                            $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$user_info['ud_phone_number']."' ";
                                            $resultLogWa2 = $conn->query($queryLogWa2);
                                            if ($resultLogWa2->num_rows > 0) {
                                                $rowLogWa2 = $resultLogWa2->fetch_assoc();
                                                if( $rowLogWa2['wa_note'] == 'Yes' ){
                                                	$welcomeWa = 'background-color: green;color: white;';
                                                	$textTab = 'You have allowed us to send you automatic message via What’s App';
                                                	$textTab2 = 'You have allowed us to send you <br/>automatic message via What’s App';
                                                	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
                                                	$onclick = '';
                                                	$btnColor = 'success';
                                                	$btnTooltips = '';
                                                }else{
                                                	$welcomeWa = 'background-color: #F1592A;color: white;';
                                                	$textTab = 'Unsubscribed. Just click this button again to re-subscribe';
                                                	$textTab2 = 'Unsubscribed. Just click this button again to re-subscribe';
                                                	$textInfo = '';
                                                	$onclick = 'onclick="myFunction2('.$user_info['ud_phone_number'].')"';
                                                	$btnColor = 'orange';
                                                	$btnTooltips = '';
                                                }
                                                
                                            }else{
 
                                            		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$user_info['ud_phone_number']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                                            		$exeWaNoti = $conn->query($sqlWaNoti);
                                            		
                                                	$welcomeWa = 'background-color: green;color: white;';
                                                	$textTab = 'You have allowed us to send you automatic message via What’s App';
                                                	$textTab2 = 'You have allowed us to send you <br/>automatic message via What’s App';
                                                	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
                                                	$onclick = '';
                                                	$btnColor = 'success';
                                                	$btnTooltips = '';
                                            	
                                            }
                                        /*
                                        if( !activeAPI( $website ) ) {
                                        	//echo $website ." is down!";
                                        	$welcomeWa = 'background-color: #F1592A;color: white;';
                                        	$textTab = 'To Subscribe, click this button & click send at What’s App';
                                        	$textTab2 = 'To Subscribe, click this button & click send at What’s App';
                                        	$textInfo = '';
                                        	$onclick = 'onclick="myFunction()"';
                                        	$btnColor = 'orange';
                                        	$btnTooltips = ' <span data-balloon-length="large" aria-label="Make sure your device/mobile phone has What&#39;s App installed in it. After clicking this button, make sure you click Send/Enter the text in the What&#39;s App to confirm your subscription." data-balloon-pos="right" data-balloon-break ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></span>';
                                        } else {
                                            
                                            $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$user_info['ud_phone_number']."' ";
                                            $resultLogWa2 = $conn->query($queryLogWa2);
                                            if ($resultLogWa2->num_rows > 0) {
                                                $rowLogWa2 = $resultLogWa2->fetch_assoc();
                                                if( $rowLogWa2['wa_note'] == 'Yes' ){
                                                	$welcomeWa = 'background-color: green;color: white;';
                                                	$textTab = 'You have allowed us to send you automatic message via What’s App';
                                                	$textTab2 = 'You have allowed us to send you <br/>automatic message via What’s App';
                                                	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
                                                	$onclick = '';
                                                	$btnColor = 'success';
                                                	$btnTooltips = '';
                                                }else{
                                                	$welcomeWa = 'background-color: #F1592A;color: white;';
                                                	$textTab = 'Unsubscribed. Just click this button again to re-subscribe';
                                                	$textTab2 = 'Unsubscribed. Just click this button again to re-subscribe';
                                                	$textInfo = '';
                                                	$onclick = 'onclick="myFunction2('.$user_info['ud_phone_number'].')"';
                                                	$btnColor = 'orange';
                                                	$btnTooltips = '';
                                                }
                                                
                                            }else{
                                            	$args = new stdClass();
                                            	$xdata = new stdClass();
                                            	$args->contactId = "6".$user_info['ud_phone_number']."@c.us";
                                            	$xdata->args = $args;
                                            	
                                            	$make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
                                            	$response = json_decode($make_call, true);
                                            	$dataPhone     = $response['response']['id'];
                                            	        
                                            	if( $dataPhone != '' ){
                                            		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$user_info['ud_phone_number']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                                            		$exeWaNoti = $conn->query($sqlWaNoti);
                                            		
                                                	$welcomeWa = 'background-color: green;color: white;';
                                                	$textTab = 'You have allowed us to send you automatic message via What’s App';
                                                	$textTab2 = 'You have allowed us to send you <br/>automatic message via What’s App';
                                                	$textInfo = '(If you no longer want to receive automatic message from us on your What’s App, please notify our staff. Thank you)';
                                                	$onclick = '';
                                                	$btnColor = 'success';
                                                	$btnTooltips = '';
                                            	}else{
                                                	$welcomeWa = 'background-color: #F1592A;color: white;';
                                                	$textTab = 'To Subscribe, click this button & click send at What’s App';
                                                	$textTab2 = 'To Subscribe, click this button & click send at What’s App';
                                                	$textInfo = '';
                                                	$onclick = 'onclick="myFunction()"';
                                                	$btnColor = 'orange';
                                                	$btnTooltips = ' <span data-balloon-length="large" aria-label="Make sure your device/mobile phone has What&#39;s App installed in it. After clicking this button, make sure you click Send/Enter the text in the What&#39;s App to confirm your subscription." data-balloon-pos="right" data-balloon-break ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></span>';
                                            
                                            	}        
                                            }
                                            
                                            
                                    
                                            	
                                        }
                                        */
                                    
                                    }
                                    echo '<br><br>';
                                    if ($tablet_browser > 0) {
                                       //print 'is tablet';
                                       echo '<button type="button" class="btn btn-'.$btnColor.' " '.$onclick.' >'.$textTab.'</button>';
                                       echo $btnTooltips;
                                    }else if ($mobile_browser > 0) {
                                       //print 'is mobile';
                                       if( $btnColor == 'success' ){
                                           echo '<button type="button" class="btn btn-'.$btnColor.' btn-xs" '.$onclick.' >'.$textTab2.'</button>';
                                           echo $btnTooltips;
                                       }else{
                                           echo '<button type="button" class="btn btn-'.$btnColor.' btn-xs" '.$onclick.' >'.$textTab.'</button>';
                                           echo $btnTooltips;
                                       }
                                       
                                    }else {
                                       //print 'is desktop';
                                       echo '<button type="button" class="btn btn-'.$btnColor.' " '.$onclick.' >'.$textTab.'</button>';
                                       echo $btnTooltips;
                                    }
                                    
                                    echo '<br><br><br>';
                            }
                        }


                        ?>
                </div>
                
            </div>
        </div>
        
   
   




        
    

      </div>

    </div>

  </div>

</section>

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
   <!--<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>-->
   <script>
    /* (function() {
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
<script>
setTimeout( function () {
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

<script src="js/custom-file-input.js"></script>

</body>

</html>
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



    function toggleOther(ele, id, parentid) {

      if (ele.checked) {

          $('#'+parentid).prop('checked', true);

          $('[name^="'+id+'"]').parent('.col-md-12').show();

      } else {

          $('#'+parentid).prop('checked', false);

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



    $(document).ready(function(){

      $('select[name=ud_current_occupation]').on('change', function(){

        if($(this).val() == 'Other') {

          $('input[name=ud_current_occupation_other]').show();

        } else {

          $('input[name=ud_current_occupation_other]').hide();

        }

      });



      $('.sample-tooltip').tooltip({

          content: function () {

              return $(this).prop('title');

          }

      });



      $('.toggleShowHide').click(function(){

        $(this).parent('.checkbox').find('.showHide').toggle();

        $(this).parent('.checkbox').find('.dropPop').toggle();

        $(this).find('.fa').toggleClass( 'fa-plus-square-o fa-minus-square-o' );

      });



      function raceOther() {

        var v = $('input[name=ud_race]:checked').val();

        if (v == 'Others') {

           $('#other_race_wrap').html('<textarea placeholder="Please state your race/ethnicity e.g Kadazan Dusun" name="ud_race" class="form-control"></textarea>');

        } else {

           $('#other_race_wrap').html('');

        }

      }

      function conduct_online() {
        var v = $('input[name=conduct_online]:checked').val();
        if (v == 'Yes') {
           //$('#conduct_online_wrap').html('<textarea placeholder="Please state what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc" name="conduct_online_text" class="form-control"></textarea>');
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
           $('#student_disability_wrap').html('<textarea placeholder="Please state the type of disabilities you can attend to e.g Dyslexia, ADHD, Autism etcs" name="student_disability_text" class="form-control"></textarea>');
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



$(document).ready(function() {
    /*jQuery(window).load(function () {
    //$("#div1").load("http://tutorkami.com/parent_login_test.php");
    //$('#dvLoading').hide();
            $.ajax({
                context: this,
                dataType : "html",
                url : "ajax-load-area-subject.php",
                beforeSend: function() {
    				$('#dvLoading').show();
                },
                success: function(results) {
    				$('#dvLoading').hide();
    				$("#div1").html(results);
                }
            });
    });*/
            $.ajax({
                context: this,
                dataType : "html",
                url : "ajax-load-area-subject.php",
                beforeSend: function() {
    				$('#dvLoading').show();
                },
                success: function(results) {
    				$('#dvLoading').hide();
    				$("#div1").html(results);
					
					var v = $('input[name=conduct_online]:checked').val();
					if (v == 'Yes') {
					   document.getElementById("conduct_online_wrap").classList.remove("hidden"); 
					   document.getElementById("accordion").classList.remove("hidden"); 
					} else {
					   document.getElementById("conduct_online_wrap").classList.add("hidden");
					   document.getElementById("accordion").classList.add("hidden"); 
					}
					
                }
            });
});


function reply_click(clicked_id){
	if(clicked_id =='google'){
		var url = 'https://script.google.com/macros/s/AKfycbxH0n3Z2kQhYEv9OqzS3-fxIBzMM5TMVNvzII63rl-zzffrdqfe/exec'
		//alert('Something new is Coming...');
		//exit();
	}else{
		//var url = 'https://t.me/MarketingTutorkami'
		//alert('Something new is Coming...');
		var url = 'https://t.me/TKCoordinator1'
	}
	var win = window.open(url, '_blank');
	win.focus();
}





/*$('#search_ud_state').change(function(){
    var StateId = $(this).val();
    $.ajax({
        type: "POST",
        url: 'ajax-city.php',
        data: {state_id: StateId},
        success: function(data){
            $('#search_ud_city').html(data);
        }
    });
});

$('#locationWorkplaceState').change(function(){
    var StateId = $(this).val();
    $.ajax({
        type: "POST",
        url: 'ajax-city.php',
        data: {state_id: StateId},
        success: function(data){
            $('#locationWorkplaceCity').html(data);
        }
    });
});
*/
$(document).ready(function() {
    var CityID = $("#search_ud_city").val();
    var locationID = $("#locationWorkplaceCity").val();
    
    $.ajax({
        url: "ajax-get-location.php",
        method: "POST",
        data: {action: 'CityID', CityID: CityID}, 
        success: function(result){
            $('#search_ud_stateText').html(result);
        }
    });
    $.ajax({
        url: "ajax-get-location.php",
        method: "POST",
        data: {action: 'locationID', locationID: locationID}, 
        success: function(result){
            $('#locationWorkplaceStateText').html(result);
        }
    });
});
$('#search_ud_city').on('change', function() {
    var CityID = $(this).val();
    $.ajax({
        url: "ajax-get-location.php",
        method: "POST",
        data: {action: 'CityID', CityID: CityID}, 
        success: function(result){
            $('#search_ud_stateText').html(result);
        }
    });
 });
$('#locationWorkplaceCity').on('change', function() {
    var locationID = $(this).val();
    $.ajax({
        url: "ajax-get-location.php",
        method: "POST",
        data: {action: 'locationID', locationID: locationID}, 
        success: function(result){
            $('#locationWorkplaceStateText').html(result);
        }
    });
 });


</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>  
$(".js-example-basic-single").select2({
	placeholder: "Choose one of the following...",
});

</script>

<script type="text/javascript">
$(document).ready(function() {
/*
if(window.location.href =='https://www.tutorkami.com/edit_account#section2'){
    var timeTableUserID = document.getElementById("timeTableUserID").value;
    //$("#loadDataTimeTable").load('edit_account-load-timetable.php','u_id='+u_id);
    $("#loadDataTimeTable").remove();
    var item = $("<div id='loadDataTimeTable'></div>");
    $('#loadDataTimeTableFix').append(item);
                        $.ajax({
                            type: "POST",
                            url: 'edit_account-load-timetable.php',
                            data: {IDtimeTableUser: timeTableUserID},
                            success: function(data){
                                $('#loadDataTimeTable').html(data);
                            }
                        });
}*/ 
                
        //Horizontal Tab
        $('#section').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched

                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
                /*if($tab.text() == 'Timetable'){
                    var timeTableUserID = document.getElementById("timeTableUserID").value;
                    //$("#loadDataTimeTable").load('edit_account-load-timetable.php','u_id='+u_id);
                        $.ajax({
                            type: "POST",
                            url: 'edit_account-load-timetable.php',
                            data: {IDtimeTableUser: timeTableUserID},
                            success: function(data){
                                var item = $("<div id='loadDataTimeTable'></div>");
                                $('#loadDataTimeTableFix').append(item);
                                $('#loadDataTimeTable').html(data);
                            }
                        });
                }else{
                    $("#loadDataTimeTable").remove();
                }*/   
            }
        });
        


});


/*
$(".checkbox-custom").click(function() {
    //alert(this.id); // or alert($(this).attr('id'));
    var checkedValue = $('.checkbox-custom:checked').val();
    alert(checkedValue);
});*/
</script>


		
<!-- ****************** START TIMETABLE ******************-->
<script type="text/javascript">  
i = 0;
      $('#addTimeTable').click(function(){  
		   i++;  
           if((document.getElementById('hdnListCount').value) <= '7' ){
               
                var aaa = document.getElementById('hdnListCount').value;
                document.getElementById('hdnListCount').value =  parseInt(aaa) + 1;

                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">     <td class="changeDay"><select id="daySelOption" name="day[]" class="form-control name_list thishahah2" required onchange="changeDay()"><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name2" name="nameNew[]" placeholder="e.g 10-11.30am, 5-7pm, 8-10pm" class="form-control name_list thishahah" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="'+i+'" class="fa fa-trash-o btn_remove"></a></td>       </tr>');  
                i++;  
		   } else {  
                alert('You can add 7 record only!');  
           }
      });
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
           
           var bbb = document.getElementById('hdnListCount').value;
           document.getElementById('hdnListCount').value =  bbb - 1;
           
      }); 
      $('#submitNew').click(function(){      
            var name2 = document.getElementById("name2");
            if(name2){
                var name2 = document.getElementById('name2').value;
               if(name2 == ''){
                   alert('Empty Description');
                   exit();
               }else{

					if($('.thishahah2').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Day');
						exit();
						return false;
					}				   
					if($('.thishahah').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Description');
						exit();
						return false;
					}
					
                   var submitNew = document.getElementById( 'submitNew' );
                   submitNew.classList.add('hidden'); // Add class
                   
                   var submitBtnLoad = document.getElementById( 'submitBtnLoad' );
                   submitBtnLoad.classList.remove('hidden'); // Remove class  
					
                   $.ajax({  
                        url:"ajax-rate-timetable.php",  
                        method:"POST",  
                        data:$('#add_name').serialize(),
                        type:'json',
						cache: false,
                        success:function(data)  {
							if(data == 'Updated'){
								location.reload();
							    
								submitBtnLoad.classList.add('hidden'); // Add class
								submitNew.classList.remove('hidden'); // Remove class  
							}else{
								alert(data);
								submitBtnLoad.classList.add('hidden'); // Add class
								submitNew.classList.remove('hidden'); // Remove class 
							}
                        }  
                   });
               }                
            }else{
               alert('Please Add Day');
               exit();
            }
      });
	  
	  
	  
	  
	  
	  
	  
	  
      $('#addMore').click(function(){  
           i++;  
           if((document.getElementById('hdnListCountExist').value) <= '6' ){
               
                var aaa = document.getElementById('hdnListCountExist').value;
                document.getElementById('hdnListCountExist').value =  parseInt(aaa) + 1;
				
                var thistotal = document.getElementById('name3').value;
                document.getElementById('name3').value = parseInt(thistotal) + 1;
		   
                $('#dynamic_fieldExist').append('<tr id="rowExist'+i+'" class="dynamic-addedThis">     <td><select name="dayPHP[]" class="form-control name_list hahah2" required ><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name3" name="namePHP[]" placeholder="e.g 10-11.30am, 5-7pm, 8-10pm" class="form-control name_list hahah" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="'+i+'" class="fa fa-trash-o btn_removeExist"></a></td>       </tr>');  
           } else {  
                alert('You can add 7 record only!');  
           }
      });
      $(document).on('click', '.btn_removeExist', function(){  
           var button_id = $(this).attr("id");   
           $('#rowExist'+button_id+'').remove();  
           
           var bbb = document.getElementById('hdnListCountExist').value;
           document.getElementById('hdnListCountExist').value =  parseInt(bbb) - 1;

           var thistotal = document.getElementById('name3').value;
           document.getElementById('name3').value = parseInt(thistotal) - 1;
      });  
      $(document).on('click', '.btn_removePHP', function(){  
           var button_id = $(this).attr("id");    
           button_id = button_id.replace(/[^0-9\.]+/g, "");
           $('#thistr'+button_id+'').remove(); 
		   
            var ccc = document.getElementById('hdnListCountExist').value;
           document.getElementById('hdnListCountExist').value =  parseInt(ccc) - 1;
		   
            var thistotal = document.getElementById('name3').value;
		   document.getElementById('name3').value = parseInt(thistotal) - 1;
 
      }); 
      $('#submitExist').click(function(){      

            var name3 = document.getElementById("name3");
            if(name3){
                var name3 = document.getElementById('name3').value;
               if(name3 == '0'){
                   alert('Please Add Day');
                   exit();
               }else if(name3 == ''){
                   alert('Empty Description');
                   exit();
               }else{
					if($('.hahah2').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Day');
						exit();
						return false;
					}				   
					if($('.hahah').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Description');
						exit();
						return false;
					}
					
					
                   var submitExist = document.getElementById( 'submitExist' );
                   submitExist.classList.add('hidden'); // Add class
                   
                   var submitBtnLoad = document.getElementById( 'submitBtnLoad' );
                   submitBtnLoad.classList.remove('hidden'); // Remove class  
				  
                   $.ajax({  
                        url:"ajax-rate-timetable2.php",  
                        method:"POST",  
                        data:$('#add_name2').serialize(),
                        type:'json',
						cache: false,
                        success:function(data)  {
							if(data == 'Updated'){
							    
								//alert('Done');
								location.reload();
							    
								submitBtnLoad.classList.add('hidden'); // Add class
								submitExist.classList.remove('hidden'); // Remove class  
							}else{
								alert(data);
								submitBtnLoad.classList.add('hidden'); // Add class
								submitExist.classList.remove('hidden'); // Remove class 
							}
                        }  
                   });
               }                
            }else{
               alert('Please Add Day');
               exit();
            }

      });
	  
	  
	  
/*
      var postURL = "/ajax-rate-timetable.php";
      var postURL2 = "/ajax-rate-timetable2.php";
      var i=1; 

      $('#addTimeTable').click(function(){  
           i++;  
           if((document.getElementById('hdnListCount').value) <= '7' ){
               
                var aaa = document.getElementById('hdnListCount').value;
                document.getElementById('hdnListCount').value =  parseInt(aaa) + 1;

                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">     <td class="changeDay"><select id="daySelOption" name="day[]" class="form-control name_list" required onchange="changeDay()"><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name2" name="name[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="'+i+'" class="fa fa-trash-o btn_remove"></a></td>       </tr>');  
           } else {  
                alert('You can add 7 record only!');  
           }
      });

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
           
           var bbb = document.getElementById('hdnListCount').value;
           document.getElementById('hdnListCount').value =  bbb - 1;
           
      }); 
      
      $('#submit').click(function(){      
            var name2 = document.getElementById("name2");
            if(name2){
                var name2 = document.getElementById('name2').value;
               if(name2 == ''){
                   alert('Empty Description');
                   exit();
               }else{
                   $.ajax({  
                        url:postURL,  
                        method:"POST",  
                        data:$('#add_name').serialize(),
                        type:'json',
						cache: false,
                        success:function(data)  {

									location.reload();
                        }  
                   }); 
               }                
            }else{
               alert('Please Add Day');
               exit();
            }
      });
      
      
      
      
      $('#addMore').click(function(){  
           i++;  
           //if((document.getElementById('hdnListCountExist').value) <= '6' ){
               
                var aaa = document.getElementById('hdnListCountExist').value;
                document.getElementById('hdnListCountExist').value =  parseInt(aaa) + 1;
				
                var thistotal = document.getElementById('name3').value;
                document.getElementById('name3').value = parseInt(thistotal) + 1;
		   
                $('#dynamic_fieldExist').append('<tr id="row'+i+'" class="dynamic-addedThis">     <td><select name="dayPHP[]" class="form-control name_list" required ><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name3" name="namePHP[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="'+i+'" class="fa fa-trash-o btn_removeExist"></a></td>       </tr>');  
           //} else {  
                //alert('You can add 7 record only!');  
           //}
      });

      $(document).on('click', '.btn_removeExist', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
           
           var bbb = document.getElementById('hdnListCountExist').value;
           document.getElementById('hdnListCountExist').value =  parseInt(bbb) - 1;

           var thistotal = document.getElementById('name3').value;
           document.getElementById('name3').value = parseInt(thistotal) - 1;
      });  
      
      $(document).on('click', '.btn_removePHP', function(){  
           var button_id = $(this).attr("id");    
           button_id = button_id.replace(/[^0-9\.]+/g, "");
           $('#thistr'+button_id+'').remove(); 
		   
            var ccc = document.getElementById('hdnListCountExist').value;
           document.getElementById('hdnListCountExist').value =  parseInt(ccc) - 1;
		   
            var thistotal = document.getElementById('name3').value;
		   document.getElementById('name3').value = parseInt(thistotal) - 1;
 
      }); 

      $('#submitExist').click(function(){      

            var name3 = document.getElementById("name3");
            if(name3){
                var name3 = document.getElementById('name3').value;
               if(name3 == '0'){
                   alert('Please Add Day');
                   exit();
               }else if(name3 == ''){
                   alert('Empty Description');
                   exit();
               }else{
                   $.ajax({  
                        url:postURL2,  
                        method:"POST",  
                        data:$('#add_name2').serialize(),
                        type:'json',
						cache: false,
                        success:function(data)  {
    								if(data == 'Empty Rate'){
    									alert(data);
    								}else{
										location.reload();
    								}
                        }  
                   });
               }                
            }else{
               alert('Please Add Day');
               exit();
            }

      });
 
 
 
function changeDay() {

// dynamic_field
var changeDayVal = new Array();

$('#dynamic_field tr').each(function() {   
    var tdObject = $(this).find('td:eq(0)'); //locate the <td> holding select;
    var selectObject = tdObject.find("select"); //grab the <select> tag assuming that there will be only single select box within that <td> 
    var selCntry = selectObject.val(); // get the selected country from current <tr>
	changeDayVal.push('"'+selCntry+'" ');
});
	document.getElementById("changeDayArray").value = changeDayVal;
	
}*/
</script> 
<!-- ****************** END TIMETABLE ******************-->
<!--
<link rel="stylesheet" href="files/viewbox-master/viewbox.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="files/viewbox-master/jquery.viewbox.min.js"></script>
<script> 
$(function(){
	$('.image-link').viewbox();
});
</script> -->
<script src="files/viewbox-master/jquery.viewbox.min.js"></script>
<script>
		$(function(){
			
			$('.thumbnail').viewbox();
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
			
		});
		
		
$(".browse-button input:file").change(function (){
  $("input[name='media']").each(function() {
    var fileName = $(this).val().split('/').pop().split('\\').pop();
    $(".filename").val(fileName);
    //$(".browse-button-text").html('<i class="fa fa-refresh"></i> Change');
    $(".clear-button").show();
  });
});
$('.clear-button').click(function(){
    $('.filename').val("");
    $('.clear-button').hide();
    $('.browse-button input:file').val("");
    $(".browse-button-text").html('<i class="fa fa-folder-open"></i> Browse'); 
}); 

function fileValidation() { 
	var fileInput =  document.getElementById('media'); 
	var filePath = fileInput.value; 
          
	// Allowing file type 
	var allowedExtensions =  /(\.mp4|\.mpg|\.mpeg|\.mov|\.avi|\.flv|\.3gp)$/i; 
              
	if (!allowedExtensions.exec(filePath)) { 
		alert('Invalid File Type'); 
		fileInput.value = ''; 
		return false; 
	}  
}
function uploadFile() {
	
	if( document.getElementById("media").files.length == 0 ){
		alert('No Video Selected !');
	}else{
		document.getElementById("uploadButton").disabled = true;
		document.getElementById("browseButton").disabled = true;
		$("#videoLoading").removeClass("hidden");
		$("#btnRealSave").addClass("hidden");
			  var property=document.getElementById("media").files[0];
			  var img_name=property.name;
			  var property=$('#media').prop('files')[0];
			  var form_data = new FormData();
			  form_data.append("media",property);
			  $.ajax({
				 url:"upload-video.php",
				 method:"POST",
				 data:form_data,
				 contentType:false,
				 cache:false,
				 processData:false,
				 success:function(data){
					if(data == 'success'){
						document.getElementById("uploadButton").disabled = false;
						document.getElementById("browseButton").disabled = false;
						$("#videoLoading").addClass("hidden");
						$("#videoLoadingMessage").removeClass("hidden");
						$("#btnRealSave").removeClass("hidden");
						/*setTimeout(function(){
						   window.location.reload(1);
						}, 3000);	   */ 
					}else{
						alert('Error! Please Upload Again ..');
						document.getElementById("uploadButton").disabled = false;
						document.getElementById("browseButton").disabled = false;
						$("#videoLoading").addClass("hidden");
						$("#btnRealSave").removeClass("hidden");
					}
				 }
			  })
	}
}
function openVideo(value) {
	$("#ModalVideo").modal();
}


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

function savePassword() {
    var old_password     = document.getElementById("pwd").value;
    var new_password     = document.getElementById("pwd_1").value;
    var confirm_password = document.getElementById("pwd_2").value;
    
    if( old_password == ''){
        getStickyNote('error','Please Insert Old Password !');
    }
    else if( new_password == ''){
        getStickyNote('error','Please Insert New Password !');
    }
    else if( confirm_password == ''){
        getStickyNote('error','Please Insert Re-enter Password !');
    }else{
        $.ajax({
            url: "ajax-save-password.php",
            method: "POST",
            data: {action: 'savePassword', old_password: old_password,new_password: new_password,confirm_password: confirm_password}, 
            success: function(result){
                if( result == 'success' ){
                    document.getElementById("pwd").value = '';
                    document.getElementById("pwd_1").value = '';
                    document.getElementById("pwd_2").value = '';
                    document.getElementById("alert-success").classList.remove("hidden");
                    setTimeout(function() { document.getElementById("alert-success").classList.add("hidden"); }, 5000);
                    getStickyNote('success','You have successfully changed your password');
                }else{
                    getStickyNote('error',result);
                }
            }
        });        
    }
}


function myFunction() {
    document.getElementById('textModal').innerHTML = 'Please click Ok';
    document.getElementById('buttonModal').innerHTML = '<button type=button class=btn btn-default onClick=closeModal()>Ok</button>';
    document.getElementById('myModalButton').click();   
    window.open("https://wa.me/60103169072?text=Allow%20automatic%20message%20from%20TutorKami.com");
}

function myFunction2(val) {
    if( val != '' ){
      $.ajax({
        type: "POST",
        url: 'active-phone.php',
        data: {val: val},
        success: function(response){
            document.location.reload(true);      
        }
      });        
    }else{
        alert('Error');
    }
}
function closeModal() {
  document.location.reload(true);
  document.getElementById('Subscribe').click();
}
</script>