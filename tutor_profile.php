<?php


   function fixTestimonialPath($path) {
       $found = strpos( $path, 'public_html');

       if($found != false) {
           $path = substr($path, strpos($path, '/', $found + 1) + 1);
       }

       return $path;
   }

?>

<?php require_once('includes/head.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if(isset($_GET['did'])){
    $getUrlID = $_GET['did'];

	$queryCurrentUser = $conn->query("
	    SELECT * FROM tk_user 
        INNER JOIN tk_user_details
        ON tk_user.u_id = tk_user_details.ud_u_id
        WHERE u_displayid = '".$getUrlID."' "
    );

	$resCurrentUser = $queryCurrentUser->num_rows;

	if($resCurrentUser > 0){
        $rowCurrentUser = $queryCurrentUser->fetch_assoc();
        $currentUserID = $rowCurrentUser['u_id'];

        if($rowCurrentUser['conduct_online'] == 'Yes'){
            if($getLan == "/my/"){
                $titleH1 = 'Cikgu Tuisyen Online & Di Rumah';
                $title = 'Cikgu Tuisyen Online & Di Rumah – TutorKami.com';
            }else{
                $titleH1 = 'Online Tuition & Private Tutor';
                $title = 'Online Tuition & Private Tutor - TutorKami.com';
            }

        }else{

            if($getLan == "/my/"){
                $titleH1 = 'Guru Tuisyen ke Rumah';
                $title = 'Guru Tuisyen ke Rumah - TutorKami.com';

            }else{
                $titleH1 = 'Home Tuition & Private Tutor';
                $title = 'Home Tuition & Private Tutor - TutorKami.com';
            }
        }
	}else{
        $currentUserID = '';
        $titleH1 = '';
        $title = '';
	}

	$queryUserRating = $conn->query(" SELECT rr_tutor_id, rr_parent_id, rr_status FROM tk_review_rating WHERE rr_status = 'approved' AND rr_parent_id > 10 AND rr_tutor_id = '".$currentUserID."' ");
	$resUserRating = $queryUserRating->num_rows;

	if($resUserRating > 0){
        $rowUserRating = $queryUserRating->fetch_assoc();
        $reviewBgColor = '#f1592a';
	}else{
	    $reviewBgColor = '';
	}

    /* Testimonial */
	$queryUserTestimonial = $conn->query(" SELECT * FROM tk_user_testimonial WHERE ut_u_id = '".$currentUserID."' ");
	$resUserTestimonial = $queryUserTestimonial->num_rows;

	if($resUserTestimonial > 0){
        $rowUserTestimonial  = $queryUserTestimonial->fetch_assoc();

        if( $rowUserTestimonial['ut_user_testimonial1'] != '' || $rowUserTestimonial['ut_user_testimonial2'] != '' || $rowUserTestimonial['ut_user_testimonial3'] != '' || $rowUserTestimonial['ut_user_testimonial4'] != '' ){
            $testiBgColor = '#f1592a';
        }else{
            $testiBgColor = '';
        }

	}else{
	    $testiBgColor = '';
	}

    /* LEVEL & SUBJECT */
    $queryUserSubject = $conn->query(" 
        SELECT COUNT(trs_id), trs_tc_id
        FROM tk_tutor_subject
        WHERE trs_u_id = '".$currentUserID."'
        GROUP BY trs_tc_id
        ORDER BY COUNT(trs_id) DESC "
    );

	$resUserSubject = $queryUserSubject->num_rows;

	if($resUserSubject > 0){

        $rowUserSubject = $queryUserSubject->fetch_assoc();

        if($getLan == "/my/"){

            $qUserLevel = $conn->query(" 
                        SELECT trs_u_id, GROUP_CONCAT(ts_description SEPARATOR ', ') ts_description, tc_description FROM tk_tutor_subject 
                        INNER JOIN tk_tution_subject ON ts_id = trs_ts_id
                        INNER JOIN tk_tution_course ON trs_tc_id = tc_id
                        WHERE trs_u_id = '".$currentUserID."' AND trs_tc_id = '".$rowUserSubject['trs_tc_id']."'
            ");

        	$resUserLevel = $qUserLevel->num_rows;

        	if($resUserLevel > 0){
                while($rowUserLevel = $qUserLevel->fetch_assoc()){
                    $currentUserLevel = $rowUserLevel['tc_description'];
                    $currentUserSubject = $rowUserLevel['ts_description'];
                }

        	}else{
        	    $currentUserLevel = '';
        	    $currentUserSubject = '';
        	}

        }else{

            $qUserLevel = $conn->query(" 
                        SELECT trs_u_id, GROUP_CONCAT(ts_title SEPARATOR ', ') ts_title, tc_title FROM tk_tutor_subject 
                        INNER JOIN tk_tution_subject ON ts_id = trs_ts_id
                        INNER JOIN tk_tution_course ON trs_tc_id = tc_id
                        WHERE trs_u_id = '".$currentUserID."' AND trs_tc_id = '".$rowUserSubject['trs_tc_id']."'
            ");

        	$resUserLevel = $qUserLevel->num_rows;

        	if($resUserLevel > 0){

                while($rowUserLevel = $qUserLevel->fetch_assoc()){
                    $currentUserLevel = $rowUserLevel['tc_title'];
                    $currentUserSubject = $rowUserLevel['ts_title'];
                }
        	}else{
        	    $currentUserLevel = '';
        	    $currentUserSubject = '';
        	}

        }

	}else{
	    $currentUserLevel = '';
	    $currentUserSubject = '';
	}

/* LEVEL & SUBJECT */



/* STATE & CITY */

    $queryUserArea = $conn->query(" SELECT COUNT(tac_id), tac_st_id
        FROM tk_tutor_area_cover
        WHERE tac_u_id = '".$currentUserID."'
        GROUP BY tac_st_id
        ORDER BY COUNT(tac_id) DESC  ");

	$resUserArea = $queryUserArea->num_rows;

	if($resUserArea > 0){
        $rowUserArea = $queryUserArea->fetch_assoc();

        $qUserArea = $conn->query(" 
                    SELECT tac_u_id, GROUP_CONCAT(city_name SEPARATOR ', ') city_name, st_name, city_id FROM tk_tutor_area_cover
                    INNER JOIN tk_cities ON city_id = tac_city_id
                    INNER JOIN tk_states ON st_id = tac_st_id
                    WHERE tac_u_id = '".$currentUserID."' AND st_id = '".$rowUserArea['tac_st_id']."'
        ");

    	$resUserqArea = $qUserArea->num_rows;

    	if($resUserqArea > 0){

            while($rowUserqArea = $qUserArea->fetch_assoc()){
                $currentUserState = $rowUserqArea['st_name'];
                $currentUserCity = $rowUserqArea['city_name'];
            }
    	}else{
    	    $currentUserState = '';
    	    $currentUserCity = '';
    	}

	}else{
        $currentUserState = '';
        $currentUserCity = '';
	}

/* STATE & CITY */

}else{
    $getUrlID = '';
    $currentUserID = '';
    $reviewBgColor = '';
    $titleH1 = '';
    $title = '';
    $currentUserLevel = '';
    $currentUserSubject = '';
    $currentUserState = '';
    $currentUserCity = '';
}


                if($rowCurrentUser['conduct_online'] == 'Yes'){

                    if($getLan == "/my/"){
                        $OutputMeta = $currentUserLevel.' '.$currentUserSubject;
                    }else{
                        $OutputMeta = $currentUserLevel.' '.$currentUserSubject;
                    }

                }else{

                    if($getLan == "/my/"){
                        $OutputMeta = $currentUserState.' '.$currentUserCity;
                    }else{
                        $OutputMeta = $currentUserState.' '.$currentUserCity;
                    }
                }
?>

<!DOCTYPE html>

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



	  <title><?PHP echo $title; ?></title>

	  <meta name="description" content="<?PHP echo $OutputMeta; ?>" />

	  <meta name="keywords" content="<?PHP echo $seoPageKeywords; ?>" />

	  <!-- add icon link

	  <link rel="icon" href="https://www.tutorkami.com/admin/img/favicons/apple-icon-180x180.png" type="image/x-icon">  -->



<!-- Google / Search Engine Tags -->

<meta itemprop="name" content="<?PHP echo $title; ?>">

<meta itemprop="description" content="<?PHP echo $OutputMeta; ?>">

<meta itemprop="image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">



<!-- Facebook Meta Tags -->

<meta property="og:url" content="https://www.tutorkami.com/">

<meta property="og:type" content="website">

<meta property="og:title" content="<?PHP echo $title; ?>">

<meta property="og:description" content="<?PHP echo $OutputMeta; ?>">

<meta property="og:image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">



<!-- Twitter Meta Tags -->

<meta name="twitter:card" content="summary_large_image">

<meta name="twitter:title" content="<?PHP echo $title; ?>">

<meta name="twitter:description" content="<?PHP echo $OutputMeta; ?>">

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

      <script async src="js/jquery-ui.js"></script>

	  <!--<script src="js/owl.carousel.js"></script>

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

    <link rel="stylesheet" href="files/viewbox-master/viewbox.css">

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



if( isset($_SESSION['auth'])){

    $thisUserID = $_SESSION['auth']['user_id'];

}else{

    $thisUserID = '';

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
							<!-- Hidayat comment based on 17/12/2022 as inform by Mr. Hambal -->
                              <!--<li class="sizedcreenli"><a href="my-classes.php" class="language"><?php echo LIST_OF_CLASSES; ?></a></li>--> 

                              <!--<li><a href="tutor_payment_history.php" class="language"><?php echo PAYMENT_HISTORY; ?></a></li>-->

                              <li class="sizedcreenli"><a href="search_job.php" class="language"><?php echo LATEST_JOB; ?></a></li>

                              <li class="sizedcreenli"><a href="tutor_guide.php" class="language"><?php echo TUTOR_GUIDE; ?></a></li>

							  <li class="sizedcreenli"><a href="terms-one-to-one.php" class="language"><?php echo "Terms"; ?></a></li>

							  <li class="sizedcreenli"><a href="payments-tutor.php" class="language"><?php echo "Payments"; ?></a></li>



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



if($getLan == "/my/"){

	if( $getUserDetails->data[0]->ud_current_occupation == 'Other' ){

		$tutorOccupation = $getUserDetails->data[0]->ud_current_occupation_other;

	}else{

		if( $getUserDetails->data[0]->ud_current_occupation == 'Full-time tutor' || $getUserDetails->data[0]->ud_current_occupation == 'Full-Time tutor' ){

			$tutorOccupation = 'Tutor sepenuh masa';

		}else if( $getUserDetails->data[0]->ud_current_occupation == 'Kindergarten teacher' ){

			$tutorOccupation = 'Cikgu pra-sekolah';

		}else if( $getUserDetails->data[0]->ud_current_occupation == 'Primary school teacher' ){

			$tutorOccupation = 'Cikgu sekolah rendah';

		}else if( $getUserDetails->data[0]->ud_current_occupation == 'Secondary school teacher' ){

			$tutorOccupation = 'Cikgu sekolah menengah';

		}else if( $getUserDetails->data[0]->ud_current_occupation == 'Tuition center teacher' ){

			$tutorOccupation = 'Cikgu pusat tuisyen';

		}else if( $getUserDetails->data[0]->ud_current_occupation == 'Lecturer' ){

			$tutorOccupation = 'Pensyarah';

		}else if( $getUserDetails->data[0]->ud_current_occupation == 'Ex-teacher' ){

			$tutorOccupation = 'Bekas guru';

		}else if( $getUserDetails->data[0]->ud_current_occupation == 'Retired teacher' ){

			$tutorOccupation = 'Guru bersara';

		}else{

			$tutorOccupation = $getUserDetails->data[0]->ud_current_occupation;

		}

	}

}else{

	$tutorOccupation = $getUserDetails->data[0]->ud_current_occupation == 'Other' ? $getUserDetails->data[0]->ud_current_occupation_other : $getUserDetails->data[0]->ud_current_occupation;

}

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



    if (window.location.href.indexOf("my") > -1) {

       //bm

			if(userid != '' || displayid != ''){

			  $.ajax({

				method:"POST",

				url:"fetch_tutor_profile.php",

				dataType:"json",

				data:{

				  dataBM: {

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

    }else{

       //bi

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

             //console.log(response);



             var len = response.length;

			 var title = [];

			 var locationURL = window.location.pathname.split('/')[1];



            for(var i=0; i<len; i++){

                if( locationURL == 'my' ){

                    var st_name = response[i].st_name_bm;

                }else{

                    var st_name = response[i].st_name;

                }



                var city_name = response[i].city_name;

                $("#loadArea").append("<strong class = 'org-txt text-capitalize'>" + st_name + "</strong>" + ": " + city_name + "<br><br>");



            }





        }

      });



    }

    return false;

  }



</script>

<style>

  .textH6 {

      font-size:40px;

  }

  .textH1 {

      font-size:24px;

  }

</style>



<?php if($getUserDetails->data[0]->u_status == 'A') { ?>



<section class="profile">

 <div class="main-body">

    <div class="container">

       <p class="text-center text-uppercase blue-txt textH6"><b><?php echo TUTOR_PROFILE; ?></b></p>

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
						$pic = $getUserDetails->data[0]->u_profile_pic . '.jpg';

                        if(file_exists(DIR_ROOT . 'images/profile/'. $pic)) {
                            echo APP_ROOT . "images/profile/".$pic;
                        } else {
                            echo APP_ROOT . "images/profile/images/".$pic;
                        }
                    }

                  } elseif ($getUserDetails->data[0]->u_gender == 'M') {

                    echo APP_ROOT."images/tutor_ma.png";

                  } else {

                    echo APP_ROOT."images/tutor_mi1.png";

                  }

                ?>" alt="profile_pic" class="img-thumbnail" width="250" height="250"></center>

                <!--<div class="hidden-sm hidden-xs" id="displayid"></div>

                <center><div class="hidden-lg hidden-md" id="displayidcenter"></div></center>-->

                <div class="hidden-sm hidden-xs"><h1 class='org-txt textH1'><strong><?PHP echo $titleH1; ?></strong></h1></div>

                <center><div class="hidden-lg hidden-md"><h1 class='org-txt textH1'><strong><?PHP echo $titleH1; ?></strong></h1></div></center>



				<br>

                <strong><?php echo HOME_TUTOR_ID; ?> : <?php echo $getUserDetails->data[0]->u_displayid; ?></strong>

                <br><br>

				<strong><?php echo NAME; ?> :</strong><font color="#f1592a"> <?php echo $getUserDetails->data[0]->u_displayname; ?> </font><br>

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

                <strong><?php echo OCCUPATION; ?> :</strong> <?php echo $tutorOccupation; //echo $getUserDetails->data[0]->ud_current_occupation == 'Other' ? $getUserDetails->data[0]->ud_current_occupation_other : $getUserDetails->data[0]->ud_current_occupation; ?> <br>

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

                <?php echo $getUserDetails->data[0]->conduct_online; if( $getUserDetails->data[0]->conduct_online_text != '' ){

                    //echo '. '.$getUserDetails->data[0]->conduct_online_text;



                    if(strpos($getUserDetails->data[0]->conduct_online_text, 'Others') !== false){

                        echo '. '.str_replace("Others"," ",$getUserDetails->data[0]->conduct_online_text).' '.$getUserDetails->data[0]->conduct_online_other;

                    } else{

                        echo '. '.$getUserDetails->data[0]->conduct_online_text;

                    }





                }

                ?>





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

						$pic = $getUserDetails->data[0]->u_profile_pic . '.jpg';

                        if(file_exists(DIR_ROOT . 'images/profile/' .$pic)) {
                            echo APP_ROOT . "images/profile/" . $pic;
                        } else {
                            echo APP_ROOT . "images/profile/images/" . $pic;
                        }
                    }

                  } elseif ($getUserDetails->data[0]->u_gender == 'M') {

                    echo APP_ROOT."images/tutor_ma.png";

                  } else {

                    echo APP_ROOT."images/tutor_mi1.png";

                  }

                ?>" alt="profile_pic" class="img-thumbnail" width="250" height="250">



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





                    $timeTable1 = " SELECT * FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC ";

                    $resulttimeTable1 = $conn->query($timeTable1);

                    if ($resulttimeTable1->num_rows > 0) {

                        $rowtimeTable1 = $resulttimeTable1->fetch_assoc();



                        $newDateTimeTable = date("d-m-Y", strtotime($rowtimeTable1['tt_date']));

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

.rates-page-tabs .nav-tabs>li>a {

  border: none;

  text-transform: uppercase;

  /*color: #7d7d7d;*/

}



.rates-page-tabs .nav-tabs>li>a:hover,

.rates-page-tabs .nav-tabs>li>a:focus {

  /*color: red;

  background-color: white;

  box-shadow: 0px -2px 0px #f1592a inset;*/

}



.rates-page-tabs .nav-tabs>li.active>a,

.rates-page-tabs .nav-tabs>li.active>a:focus,

.rates-page-tabs .nav-tabs>li.active>a:hover {

  border: none;

  /*box-shadow: 0px -2px 0px red inset;

  color: red;

  box-shadow: 0px -2px 0px #f1592a inset;*/

}



.panel-group .panel-heading + .panel-collapse > .panel-body {

  border: 1px solid #ddd;

}

.rates-page-tabs .panel-group,

.rates-page-tabs .panel-group .panel,

.rates-page-tabs .panel-group .panel-heading,

.rates-page-tabs .panel-group .panel-heading a,

.rates-page-tabs .panel-group .panel-title,

.rates-page-tabs .panel-group .panel-title a,

.rates-page-tabs .panel-group .panel-body,

.rates-page-tabs .panel-group .panel-group .panel-heading + .panel-collapse > .panel-body {

  border-radius: 2px;

  border: 0;

}

.rates-page-tabs .panel-group .panel-heading {

  padding: 0;

  background-color: white;

}

.rates-page-tabs .panel-group .panel-heading a {

  display: block;

  color: #303030;

  font-size: 18px;

  padding: 15px 15px 15px 45px;

  text-decoration: none;

  text-transform: uppercase;

  position: relative;

}

.rates-page-tabs .panel-group .panel-heading a.collapsed {



}

.rates-page-tabs .panel-group .panel-heading a:before {

  content: '-';

  position: absolute;

  left: 14px;

  top: 8px;

  font-size:26px;

}

.rates-page-tabs .panel-group .panel-heading a.collapsed:before {

  content: '+';

  left: 10px;

  top: 10px;

}





.rates-page-tabs .panel-group .panel-collapse {

  margin-top: 5px !important;

}

.rates-page-tabs .panel-group .panel-body {

  background: #ffffff;

  padding: 15px;

}

.rates-page-tabs .panel-group .panel {

  background-color: transparent;

}

.rates-page-tabs .panel-group .panel-body p:last-child,

.rates-page-tabs .panel-group .panel-body ul:last-child,

.rates-page-tabs .panel-group .panel-body ol:last-child {

  margin-bottom: 0;

}



.anyClass {

  height:300px;

  overflow-y: scroll;

}





/* Custom Scrollbar */

/* width */

::-webkit-scrollbar {

  width: 10px;

}



/* Track */

::-webkit-scrollbar-track {

  background: #f1f1f1;

}



/* Handle */

::-webkit-scrollbar-thumb {

  background: #888;

}



/* Handle on hover */

::-webkit-scrollbar-thumb:hover {

  background: #555;

}

/* Custom Scrollbar */

</style>





<?PHP

if($getUserDetails->data[0]->url_video != ''){

    $videoBgColor = ' style="background-color:#f1592a;color:white" ';

    $videoBgColorFont = '#f1592a';

}else{

    $videoBgColor = '';

    $videoBgColorFont = '';

}



$adatimeSlot = " SELECT tt_tutor FROM tk_timetable WHERE tt_tutor='".$user_id."'  ";

$resultadatimeSlot = $conn->query($adatimeSlot);

if ($resultadatimeSlot->num_rows > 0) {

    $timeSlotBgColor = '#f1592a';

}else{

    $timeSlotBgColor = '';

}

?>



    <link rel="stylesheet" type="text/css" href="css/responsive-tabs/css/easy-responsive-tabs.css " />

    <script src="css/responsive-tabs/js/easyResponsiveTabs.js"></script>



    <div id="sectionTab">

        <ul class="resp-tabs-list hor_1">

            <li> <?php echo ABOUT_MYSELF; ?> </li>

            <li> <font color="<?PHP echo $testiBgColor; ?>"><?php echo TESTIMONIALS; ?></font> </li>

            <li> <font color="<?PHP echo $reviewBgColor; ?>"><?php echo REVIEWS; ?></font> </li>

            <li> <font color="<?PHP echo $timeSlotBgColor; ?>"><?php echo $timeSlot; ?></font> </li>

            <li> <font color="<?PHP echo $videoBgColorFont; ?>"><?php echo VIDEO; ?></font> </li>

        </ul>



        <div class="resp-tabs-container hor_1">

            <div> <textarea class="form-control" rows="10"><?php echo $getUserDetails->data[0]->ud_about_yourself; ?></textarea> </div>

            <div>

                <em><?php echo CLICK_IMAGE_TO_ENLARGE; ?></em><i class="fa fa-plus plus" aria-hidden="true"></i> <br>

                   <?php

                    $items = array();

                    $QueryTesti = " SELECT * FROM tk_user_testimonial WHERE ut_u_id='".$user_id."'  ";

                    $resultQueryTesti = $conn->query($QueryTesti);

                    if ($resultQueryTesti->num_rows > 0) {

                        $rowQueryTesti = $resultQueryTesti->fetch_assoc();

                        $re = '/(\d{8})|([0-9]{4}-[0-9]{2}-[0-9]{2})|([0-9]{2}-[0-9]{2}-[0-9]{4})/';

                        if( $rowQueryTesti['ut_user_testimonial1'] != '' ){

                            $URL = $rowQueryTesti['ut_user_testimonial1'];

                            $str = $rowQueryTesti['ut_user_testimonial1'];

                            preg_match($re, $str, $matches);

                            if( (str_replace("-", "", $matches[0])) != '' ){

                                $sorting = str_replace("-", "", $matches[0]);

                            }

                            $address[]  = array(

                                "URL" => fixTestimonialPath($URL),
                               "sorting"    => $sorting

                            );

                        }

                        if( $rowQueryTesti['ut_user_testimonial2'] != '' ){

                            $URL = $rowQueryTesti['ut_user_testimonial2'];

                            $str = $rowQueryTesti['ut_user_testimonial2'];

                            preg_match($re, $str, $matches);

                            if( (str_replace("-", "", $matches[0])) != '' ){

                                $sorting = str_replace("-", "", $matches[0]);

                            }

                            $address[]  = array(

                                "URL" => fixTestimonialPath($URL),
                               "sorting"    => $sorting

                            );

                        }

                        if( $rowQueryTesti['ut_user_testimonial3'] != '' ){

                            $URL = $rowQueryTesti['ut_user_testimonial3'];



                            $str = $rowQueryTesti['ut_user_testimonial3'];

                            preg_match($re, $str, $matches);

                            if( (str_replace("-", "", $matches[0])) != '' ){

                                $sorting = str_replace("-", "", $matches[0]);

                            }

                            $address[]  = array(

                                "URL" => fixTestimonialPath($URL),
                               "sorting"    => $sorting

                            );

                        }

                        if( $rowQueryTesti['ut_user_testimonial4'] != '' ){

                            $URL = $rowQueryTesti['ut_user_testimonial4'];

                            $str = $rowQueryTesti['ut_user_testimonial4'];

                            preg_match($re, $str, $matches);

                            if( (str_replace("-", "", $matches[0])) != '' ){

                                $sorting = str_replace("-", "", $matches[0]);

                            }

                            $address[]  = array(

                                "URL" => fixTestimonialPath($URL),
                               "sorting"    => $sorting

                            );

                        }

                        if( $rowQueryTesti['ut_user_testimonial5'] != '' ){

                            $URL = $rowQueryTesti['ut_user_testimonial5'];

                            $str = $rowQueryTesti['ut_user_testimonial5'];

                            preg_match($re, $str, $matches);

                            if( (str_replace("-", "", $matches[0])) != '' ){

                                $sorting = str_replace("-", "", $matches[0]);

                            }

                            $address[]  = array(

                                "URL" => fixTestimonialPath($URL),
                               "sorting"    => $sorting

                            );

                        }

                    }



                    function sortFunction( $a, $b ) {

                        //return strtotime($a["sorting"]) - strtotime($b["sorting"]);

                        $a = strtotime($a["sorting"]);

                        $b = strtotime($b["sorting"]);

                        if ($a == $b) {

                            return 0;

                        }

                        return ($a > $b) ? -1 : 1;

                    }


                    if(!empty($address)) {
                        usort($address, "sortFunction");
                    }

                    foreach ($address as $vals) {

                        //echo $vals['URL'] . "\n";

                        ?>

                    					<a href="<?php echo $vals['URL']; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">

                    						<img src="<?php echo$vals['URL']; ?>" alt="testimonial" class="cropped" style="width: 23.33%;">

                    					</a>

                        <?PHP

                    }

/*

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

*/

                   ?>

            </div>

            <div class="anyClass" > <p><?php include('includes/list_tutor_review.php');?></p> </div>

            <div>

                    <p><font color="blue" size="3">Available Time Slots</font>

                    <?PHP

                    $timeTable1Mobile = " SELECT * FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC ";

                    $resulttimeTable1Mobile = $conn->query($timeTable1Mobile);

                    if ($resulttimeTable1Mobile->num_rows > 0) {

                        $rowtimeTable1Mobile = $resulttimeTable1Mobile->fetch_assoc();



                            $newDateTimeTableMobile = date("d-m-Y", strtotime($rowtimeTable1Mobile['tt_date']));

                            $arrMobile = explode('-', $newDateTimeTableMobile);

                            $monthNameMobile = date("F", mktime(0, 0, 0, $arrMobile[1], 10));

                            $dateTimeTableMobile = $arrMobile[0].'/'.$arrMobile[1].'/'.$arrMobile[2];

                                echo '

                                <b><font class="text-left" style="font-size:12px;">(last updated on '.$dateTimeTableMobile.')</font></b>

                                ';

                    }  ?>

                    </p>



                    <?PHP

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

            </div>

            <div>

                    <p class="embed-responsive embed-responsive-16by9">

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

                    </p>

            </div>

        </div>

    </div>

































    <!--<div class="tab-group rates-page-tabs">

        <ul class="nav nav-tabs responsive" role="tablist">

            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php //echo ABOUT_MYSELF; ?></a></li>

            <li role="presentation"><a href="#testimonials" aria-controls="testimonials" role="tab" data-toggle="tab"><?php //echo TESTIMONIALS; ?></a></li>

            <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab"><?php //echo REVIEWS; ?></a></li>

            

            <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab"><?php //echo $timeSlot; ?></a></li>

            <li role="presentation"><a <?PHP //echo $videoBgColor;?> href="#video" aria-controls="video" role="tab" data-toggle="tab"><font color="<?PHP //echo $videoBgColorFont; ?>"><?php //echo VIDEO; ?></font></a></li>

        </ul>



        <div class="tab-content responsive">

            <div role="tabpanel" class="tab-pane active" id="home">

                <div class="panel-group" id="accordion">



                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <h4 class="panel-title">

                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">

                                    New Auto

                                </a>

                            </h4>

                        </div>

                        <div id="collapseOne" class="panel-collapse collapse in">

                            <div class="panel-body">

                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.

                            </div>

                        </div>

                    </div>



                </div>

                <textarea class="form-control" rows="10"><?php //echo $getUserDetails->data[0]->ud_about_yourself; ?></textarea>

            </div>

            <div role="tabpanel" class="tab-pane" id="testimonials">

                <em><?php //echo CLICK_IMAGE_TO_ENLARGE; ?></em><i class="fa fa-plus plus" aria-hidden="true"></i> <br>

                   <?php

                    //$getTestimonial = system::FireCurl(USER_TESTIMONIAL."?uid=".$user_id);

                    //if ($getTestimonial->flag == 'success' && count($getTestimonial->data) > 0) {

                      //$i = 0;

                      //foreach ($getTestimonial->data as $key => $testimonial) {

                   ?>

                   <?php //if ($testimonial->ut_user_testimonial1 != '') { ?>



    					<a href="<?php //echo $testimonial->ut_user_testimonial1; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">

    						<img src="<?php //echo $testimonial->ut_user_testimonial1; ?>" alt="testimonial" class="cropped" style="width: 23.33%;">

    					</a>



                   <?php //} ?>

                   <?php //if ($testimonial->ut_user_testimonial2 != '') { ?>



    					<a href="<?php //echo $testimonial->ut_user_testimonial2; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">

    						<img src="<?php //echo $testimonial->ut_user_testimonial2; ?>" alt="testimonial" class="cropped" style="width: 23.33%;"  >

    					</a>



                   <?php //} ?>

                   <?php //if ($testimonial->ut_user_testimonial3 != '') { ?>



    					<a href="<?php //echo $testimonial->ut_user_testimonial3; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">

    						<img src="<?php //echo $testimonial->ut_user_testimonial3; ?>" alt="testimonial" class="cropped" style="width: 23.33%;" >

    					</a>



                   <?php //} ?>

                   <?php //if ($testimonial->ut_user_testimonial4 != '') { ?>



    					<a href="<?php //echo $testimonial->ut_user_testimonial4; ?>" class="thumbnail-2" title="<font color=#f1592a>To close the image, click the background</font>">

    						<img src="<?php //echo $testimonial->ut_user_testimonial4; ?>" alt="testimonial" class="cropped" style="width: 23.33%;" >

    					</a>



                   <?php //}   

                      //}

                    //}

                   ?>

            </div>

            <div role="tabpanel" class="tab-pane" id="reviews">

                <p><?php //include('includes/list_tutor_review.php');?></p>

            </div>



            <div role="tabpanel" class="tab-pane" id="schedule">

                    <p><font color="blue" size="3">Available Time Slots</font></p>

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

            </div>

            <div role="tabpanel" class="tab-pane" id="video">

                    <div class="embed-responsive embed-responsive-16by9">

                    <?PHP

                    /*function convertYoutube($string) {

                        return preg_replace(

                            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",

                            "<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$2\" allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>",

                            $string

                        );

                    }

                    echo convertYoutube($getUserDetails->data[0]->url_video);*/

                    ?>	 

                    </div>

            </div>

            

            

            

        </div>

    </div>-->



















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

/*Downloaded from https://www.codeseek.co/justingordon/bootstrap-3-responsive-tabs-with-nested-accordions-EbwVxG */

/*

var fakewaffle = (function($, fakewaffle) {

  "use strict";



  fakewaffle.responsiveTabs = function(collapseDisplayed) {

    fakewaffle.currentPosition = "tabs";



    var tabGroups = $(".nav-tabs.responsive");

    var hidden = "";

    var visible = "";

    var activeTab = "";



    if (collapseDisplayed === undefined) {

      collapseDisplayed = ["xs", "sm"];

    }



    $.each(collapseDisplayed, function() {

      hidden += " hidden-" + this;

      visible += " visible-" + this;

    });



    $.each(tabGroups, function(index) {

      var collapseDiv;

      var $tabGroup = $(this);

      var tabs = $tabGroup.find("li a");



      if ($tabGroup.attr("id") === undefined) {

        $tabGroup.attr("id", "tabs-" + index);

      }



      collapseDiv = $("<div></div>", {

        class: "panel-group responsive" + visible,

        id: "collapse-" + $tabGroup.attr("id")

      });



      $.each(tabs, function() {

        var $this = $(this);

        var oldLinkClass =

          $this.attr("class") === undefined ? "" : $this.attr("class");

        var newLinkClass = "accordion-toggle";

        var oldParentClass =

          $this.parent().attr("class") === undefined

            ? ""

            : $this.parent().attr("class");

        var newParentClass = "panel panel-default";

        var newHash = $this.get(0).hash.replace("#", "collapse-");



        if (oldLinkClass.length > 0) {

          newLinkClass += " " + oldLinkClass;

        }



        if (oldParentClass.length > 0) {

          oldParentClass = oldParentClass.replace(/\bactive\b/g, "");

          newParentClass += " " + oldParentClass;

          newParentClass = newParentClass.replace(/\s{2,}/g, " ");

          newParentClass = newParentClass.replace(/^\s+|\s+$/g, "");

        }



        if ($this.parent().hasClass("active")) {

          activeTab = "#" + newHash;

        }



        collapseDiv.append(

          $("<div>")

            .attr("class", newParentClass)

            .html(

              $("<div>")

                .attr("class", "panel-heading")

                .html(

                  $("<h4>")

                    .attr("class", "panel-title")

                    .html(

                      $("<a>", {

                        class: newLinkClass,

                        "data-toggle": "collapse",

                        "data-parent": "#collapse-" + $tabGroup.attr("id"),

                        href: "#" + newHash,

                        html: $this.html()

                      })

                    )

                )

            )

            .append(

              $("<div>", {

                id: newHash,

                class: "panel-collapse collapse"

              })

            )

        );

      });



      $tabGroup.next().after(collapseDiv);

      $tabGroup.addClass(hidden);

      $(".tab-content.responsive").addClass(hidden);



      if (activeTab) {

        $(activeTab).collapse("show");

      }

    });



    fakewaffle.checkResize();

    fakewaffle.bindTabToCollapse();

  };



  fakewaffle.checkResize = function() {

    if (

      $(".panel-group.responsive").is(":visible") === true &&

      fakewaffle.currentPosition === "tabs"

    ) {

      fakewaffle.tabToPanel();

      fakewaffle.currentPosition = "panel";

    } else if (

      $(".panel-group.responsive").is(":visible") === false &&

      fakewaffle.currentPosition === "panel"

    ) {

      fakewaffle.panelToTab();

      fakewaffle.currentPosition = "tabs";

    }

  };



  fakewaffle.tabToPanel = function() {

    var tabGroups = $(".nav-tabs.responsive");



    $.each(tabGroups, function(index, tabGroup) {

      // Find the tab

      var tabContents = $(tabGroup)

        .next(".tab-content")

        .find(".tab-pane");



      $.each(tabContents, function(index, tabContent) {

        // Find the id to move the element to

        var destinationId = $(tabContent)

          .attr("id")

          .replace(/^/, "#collapse-");



        // Convert tab to panel and move to destination

        $(tabContent)

          .removeClass("tab-pane")

          .addClass("panel-body fw-previous-tab-pane")

          .appendTo($(destinationId));

      });

    });

  };



  fakewaffle.panelToTab = function() {

    var panelGroups = $(".panel-group.responsive");



    $.each(panelGroups, function(index, panelGroup) {

      var destinationId = $(panelGroup)

        .attr("id")

        .replace("collapse-", "#");

      var destination = $(destinationId).next(".tab-content")[0];



      // Find the panel contents

      var panelContents = $(panelGroup).find(

        ".panel-body.fw-previous-tab-pane"

      );



      // Convert to tab and move to destination

      panelContents

        .removeClass("panel-body fw-previous-tab-pane")

        .addClass("tab-pane")

        .appendTo($(destination));

    });

  };



  fakewaffle.bindTabToCollapse = function() {

    var tabs = $(".nav-tabs.responsive").find("li a");

    var collapse = $(".panel-group.responsive").find(".panel-collapse");



    // Toggle the panels when the associated tab is toggled

    tabs.on("shown.bs.tab", function(e) {

      if (fakewaffle.currentPosition === "tabs") {

        var $current = $(e.currentTarget.hash.replace(/#/, "#collapse-"));

        $current.collapse("show");



        if (e.relatedTarget) {

          var $previous = $(e.relatedTarget.hash.replace(/#/, "#collapse-"));

          $previous.collapse("hide");

        }

      }

    });



    // Toggle the tab when the associated panel is toggled

    collapse.on("shown.bs.collapse", function(e) {

      if (fakewaffle.currentPosition === "panel") {

        // Activate current tabs

        var current = $(e.target).context.id.replace(/collapse-/g, "#");

        $('a[href="' + current + '"]').tab("show");



        // Update the content with active

        var panelGroup = $(e.currentTarget).closest(".panel-group.responsive");

        $(panelGroup)

          .find(".panel-body")

          .removeClass("active");

        $(e.currentTarget)

          .find(".panel-body")

          .addClass("active");

      }

    });

  };



  $(window).resize(function() {

    fakewaffle.checkResize();

  });



  return fakewaffle;

})(window.jQuery, fakewaffle || {});







(function($) {

  fakewaffle.responsiveTabs(['xs']);

})(jQuery);*/

</script>



<script src="files/viewbox-master/jquery.viewbox.min.js"></script>

	<script>

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







$(document).ready(function() {

        //Horizontal Tab

        $('#sectionTab').easyResponsiveTabs({

            type: 'default', //Types: default, vertical, accordion

            width: 'auto', //auto or any width like 600px

            fit: true, // 100% fit in a container

            tabidentify: 'hor_1', // The tab groups identifier

            activate: function(event) { // Callback function if tab is switched

            }

        });

});





	</script>



<script src="//code.tidio.co/xemvegnr9wqcfsvi5yswoogjelcyby2v.js" async></script>

</body>



</html>