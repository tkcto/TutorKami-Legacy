
<?php require_once('includes/head.php'); ?><!DOCTYPE html>
<?PHP
// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
$queryLevel2 = $conn->query("SELECT tc_id, tc_title FROM tk_tution_course ORDER BY tc_id ASC");
$rowLevel2 = $queryLevel2->num_rows;

$queryState = $conn->query("SELECT st_id, st_name FROM tk_states ORDER BY st_name ASC");
$rowState = $queryState->num_rows;




$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}
//FADHLI
$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if (($pos = strpos($actual_link, "?/")) !== FALSE) {    //  /English/Pre-School/Alam-Budiman 
    $whatIWant = substr($actual_link, $pos+1); 
	$whatIWant = substr($whatIWant, 1);    //  English/Pre-School/Alam-Budiman 	
	
	$totalSlash = substr_count($whatIWant, "/"); // total max = 3
	
         function addFunction($getSelectLevel) {
			if (strpos('test '.$getSelectLevel, 'Pre-School') == true) { 
				return 'Pre-School'; 
			}else if(strpos('test '.$getSelectLevel, 'Tahap-1-(Tahun-1-3)') == true){
				return 'Tahap 1 (Tahun 1-3)'; 
			}else if(strpos('test '.$getSelectLevel, 'Tahap-2-(UPSR)') == true){
				return 'Tahap 2 (UPSR)'; 
			}else if(strpos('test '.$getSelectLevel, 'Form-1-3-(PT3)') == true){
				return 'Form 1-3 (PT3)'; 
			}else if(strpos('test '.$getSelectLevel, 'Form-4-5-(SPM)') == true){
				return 'Form 4-5 (SPM)'; 
			}else if(strpos('test '.$getSelectLevel, 'Primary-(International-Syllabus)') == true){
				return 'Primary (International Syllabus)'; 
			}else if(strpos('test '.$getSelectLevel, 'Lower-Secondary-(International-Syllabus)') == true){
				return 'Lower Secondary (International Syllabus)'; 
			}else if(strpos('test '.$getSelectLevel, 'Year-10-11-(IGCSE)') == true){
				return 'Year 10-11 (IGCSE)'; 
			}else if(strpos('test '.$getSelectLevel, 'Others_Lain-lain') == true){
				return 'Others / Lain-lain'; 
			}else{
				return 'NULL'; 
			}
         }
         //echo addFunction($actual_link);
		 
         function get_string_between($string, $start, $end){
			$string = ' ' . $string;
			$ini = strpos($string, $start);
			if ($ini == 0) return '';
			$ini += strlen($start);
			$len = strpos($string, $end, $ini) - $ini;
			return substr($string, $ini, $len);
         }
		 
         function sqlFunction($data) {
				global $dbCon;
				
				$qS = "SELECT * FROM tk_states WHERE st_name LIKE '%$data%' "; 
				$rS = $dbCon->query($qS); 
				if($rS->num_rows > 0){ 
					$dS = $rS->fetch_assoc();
					$currentState = $dS['st_name'];
					return $currentState;
				}

				$qL = "SELECT * FROM tk_tution_course WHERE tc_title LIKE '%$data%' "; 
				$rL = $dbCon->query($qL); 
				if($rL->num_rows > 0){ 
					$dL = $rL->fetch_assoc();
					return $dL['tc_title'];
				}
				
				$qC = "SELECT * FROM tk_cities WHERE city_name LIKE '%$data%' "; 
				$rC = $dbCon->query($qC); 
				if($rC->num_rows > 0){ 
					$dC = $rC->fetch_assoc();
					return $dC['city_name'];
				}

         }
		 
		 
		
	$currentData = '';

			if (substr_count($whatIWant, "/") == 0){
				$getLevel = addFunction($whatIWant);
				if( $getLevel != 'NULL'){
					$currentData .= $getLevel.' *';
				}else{
					$currentData .= (str_replace("-"," ",$whatIWant)).' *';
					
				}
				
			}else if (substr_count($whatIWant, "/") == 1){
				
				// string before /
				$arrBefore = explode("/", $whatIWant, 2);
				$Before = $arrBefore[0];
				$getLevel = addFunction($Before);
				if( $getLevel != 'NULL'){
					$currentData .= $getLevel.' *';
				}else{
					$currentData .= (str_replace("-"," ",$Before)).' *';
				}
					
				// string after /
				$arrAfter = explode('/', $whatIWant);
				$After = $arrAfter[1];
				
				$getLevel2 = addFunction($After);
				if( $getLevel2 != 'NULL'){
					$currentData .= $getLevel2.' *';
				}else{
					$currentData .= (str_replace("-"," ",$After)).' *';
				}		
				
			}else if (substr_count($whatIWant, "/") == 2){

				// string before /
				$arrBefore = explode("/", $whatIWant, 2);
				$Before = $arrBefore[0];
				$getLevel = addFunction($Before);
				if( $getLevel != 'NULL'){
					$currentData .= $getLevel.' *';
				}else{
					$currentData .= (str_replace("-"," ",$Before)).' *';
				}
					
				//substring-between-two-strings
				$getBetween = get_string_between($whatIWant, '/', '/');
				$getLevel2 = addFunction($getBetween);
				if( $getLevel2 != 'NULL'){
					$currentData .= $getLevel2.' *';
				}else{
					$replace = str_replace("-"," ",$getBetween);
					$replace = str_replace(","," *",$replace);
					$currentData .= $replace.' *';
				}		
				
				// grab-remaining-text-after-last /
				$getLast = array_pop(explode('/', $whatIWant));
				$getLevel3 = addFunction($getLast);
				if( $getLevel3 != 'NULL'){
					$currentData .= $getLevel3.' *';
				}else{
					$replace2 = str_replace("-"," ",$getLast);
					$replace2 = str_replace(","," *",$replace2);
					$currentData .= $replace2.' *';
				}	

				
			}else if (substr_count($whatIWant, "/") == 3){
				// string before /
				$arrBefore = explode("/", $whatIWant, 2);
				$Before = $arrBefore[0];
				$getLevel = addFunction($Before);
				if( $getLevel != 'NULL'){
					$currentData .= $getLevel.' *';
				}else{
					$currentData .= (str_replace("-"," ",$Before)).' *';
				}
					
				//substring-between-two-strings
				$getBetween = get_string_between($whatIWant, '/', '/');
				$getLevel2 = addFunction($getBetween);
				if( $getLevel2 != 'NULL'){
					$currentData .= $getLevel2.' *';
				}else{
					$replace = str_replace("-"," ",$getBetween);
					$replace = str_replace(","," *",$replace);
					$currentData .= $replace.' *';
				}		
				
				
				// get-second-last-word-from-url /
				$refer_split = explode("/", $whatIWant);
				$secondLast = $refer_split[ count($refer_split) - 2]; 
				$getLevel4 = addFunction($secondLast);
				if( $getLevel4 != 'NULL'){
					$currentData .= $getLevel4.' *';
				}else{
					$replace = str_replace("-"," ",$secondLast);
					$replace = str_replace(","," *",$replace);
					$currentData .= $replace.' *';
				}
				
				
				// grab-remaining-text-after-last /
				$getLast = array_pop(explode('/', $whatIWant));
				$getLevel3 = addFunction($getLast);
				if( $getLevel3 != 'NULL'){
					$currentData .= $getLevel3.' *';
				}else{
					$replace2 = str_replace("-"," ",$getLast);
					$replace2 = str_replace(","," *",$replace2);
					$currentData .= $replace2.' *';
				}



			}else{
				
			}
}
$currentData2 = $currentData; 
$currentData = (explode(" *", $currentData)); 


$stringResult =  str_replace(" *",",",$currentData2);
$array=(explode(',', $stringResult));
$array = implode("','",$array);
    		

$qS = "SELECT * FROM tk_states WHERE st_name IN ('".$array."') "; 
$rS = $dbCon->query($qS); 
if($rS->num_rows > 0){ 
    $dS = $rS->fetch_assoc();
    $seoState = $dS['st_name'];
}else{
    $seoState ='';
}
$qC = "SELECT * FROM tk_cities WHERE city_name IN ('".$array."') "; 
$rC = $dbCon->query($qC); 
if($rC->num_rows > 0){ 
    while($dC = $rC->fetch_assoc()){
        $seoCity .= $dC['city_name'].',';
    }
}else{
    $seoCity = '';
}
				
				
$qL = "SELECT * FROM tk_tution_course WHERE tc_title IN ('".$array."') "; 
$rL = $dbCon->query($qL); 
if($rL->num_rows > 0){ 
    $dL = $rL->fetch_assoc();
    $seoLevel =  $dL['tc_title'];
}else{
    $seoLevel = '';
}
$qSub = "SELECT * FROM tk_tution_subject WHERE ts_title IN ('".$array."') "; 
$rSub = $dbCon->query($qSub); 
if($rSub->num_rows > 0){ 
    while($dSub = $rSub->fetch_assoc()){
        $seoSub .= $dSub['ts_title'].',';
    }
}else{
    $seoSub = '';
}

$seoCity = implode(',',array_unique(explode(',', $seoCity)));
$seoCity = str_replace(",,",",",$seoCity);
$seoSub = implode(',',array_unique(explode(',', $seoSub)));
?>
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

	  
	  <title>Tutor & Guru Tuisyen online <?PHP echo str_replace(","," ",str_replace(",,",",",$seoSub)).' '.str_replace(","," ",str_replace(",,"," ",$seoLevel)); ?> di <?PHP echo str_replace(","," ",str_replace(",,"," ",$seoCity)); ?> <?PHP echo str_replace(","," ",str_replace(",,"," ",$seoState)); ?> & Sekitarnya</title>
	  <meta name="description" content="Dapatkan cikgu online tuition <?PHP echo str_replace(","," ",str_replace(",,",",",$seoSub)).' '.str_replace(","," ",str_replace(",,"," ",$seoLevel)); ?> di <?PHP echo str_replace(","," ",str_replace(",,"," ",$seoCity)); ?> <?PHP echo str_replace(","," ",str_replace(",,"," ",$seoState)); ?> & sekitarnya dengan lebih mudah, selamat dan ada jaminan" />
	  <meta name="keywords" content="home tutor, home tuition, home tuisyen, tuisyen rumah, homeschool, private tutor, private teacher, guru tuisyen" />
	  
<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="Search for Private Tutor, Home Tuition & Tuisyen in Malaysia">
<meta itemprop="description" content="Tutorkami is Malaysia's trusted and affordable private tutor & home tuition site">
<meta itemprop="image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://www.tutorkami.com/">
<meta property="og:type" content="website">
<meta property="og:title" content="Search for Private Tutor, Home Tuition & Tuisyen in Malaysia">
<meta property="og:description" content="Tutorkami is Malaysia's trusted and affordable private tutor & home tuition site">
<meta property="og:image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Search for Private Tutor, Home Tuition & Tuisyen in Malaysia">
<meta name="twitter:description" content="Tutorkami is Malaysia's trusted and affordable private tutor & home tuition site">
<meta name="twitter:image" content="https://www.tutorkami.com/images/Slider1920x1000.jpg">
	  
	  <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-42467282-1"></script> -->
<script async src="googletagmanager.js"></script>
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
      <!--<script src="css-pricing/assets/js/bootstrap.min.js" type="text/javascript"></script>-->
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
	  <script async src="js/velocity.min.js"></script>
      <script src="js/enhance.js"></script>
      <script type="text/javascript">
function hideErrDiv(containerEle,progressEle){var elem=document.getElementById(progressEle);var width=100;var id=setInterval(frame,50);function frame(){if(width<=0){clearInterval(id);$("#"+containerEle).fadeOut(200)}else{width--;elem.style.width=width+'%'}}}
var counter=0;function getStickyNote(msg_type,msg_text){counter++;var html='<div id="sticky-container-'+counter+'" class="toast toast-'+msg_type+'" style="">'+'<div id="alert_progress_bar_'+counter+'" class="toast-progress" style="width: 100%;"></div>'+'<button type="button" class="toast-close-button" role="button">×</button>'+'<div class="toast-message">'+msg_text+'</div>'+'</div>';$('#toast-container').append(html);hideErrDiv('sticky-container-'+counter,'alert_progress_bar_'+counter);return html}
      </script>

      <script>
        $(document).ready(function() {

          $(".dropbox").click(function(){
            $(this).next('.dropPop').stop();
            $(this).next('.dropPop').slideToggle("slow");
          });
        
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
.shadow {
  /*box-shadow: 0px 15px 10px -15px #111;*/
  box-shadow: 0px 15px 10px -15px #111;

}

</style>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
    <script src="https://getbootstrap.com/docs/3.3/assets/js/ie-emulation-modes-warning.js"></script>-->
	
	<!-- START owl.carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
	<!-- END owl.carousel -->
   </head>
   <body>
   <!--<body style="background-image: url('folder-tuisyen-online/Wallpaper.png');">-->
      <div class="loaderBackground" id="hider"></div>
      <div class="loaderpop" id="loadermodaldiv">
         <h4><img src="images/loader.gif" style="width: 50px;" />Loading...</h4>
      </div>

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
          <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/logo.png" class="pull-left img-responsive" alt="tutorkami logo"/></a>
          <a href="request_a_tutor.php" style="" type="button" class="pull-right btn btn-info navbar-sm screensize">GET A TUTOR</a>
        </div>
        </div>


        <div id="navbar" class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right off_dropd">

                       <?php if(!isset($_SESSION['auth'])) { ?>
						<li class="dropdown text-right">
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
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/search_tutor">Search Tutor</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/parent_faq">FAQs</a></li>
								<li class="sizedcreenli"><a href="https://www.tutorkami.com/request_a_tutor?tutor_id=i3be8gz">Contact Us</a></li>
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
                        </li>
						
                       <?php } else { 
					   if($_SESSION['auth']['user_role'] == '4') { ?>
                        <li class="dropdown text-right" id="shadow">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle text-right" href="#">
                           Welcome <?php echo ucfirst($_SESSION['auth']['first_name']); ?> <?php //echo ucfirst($_SESSION['auth']['last_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu text-right" role="menu">
                              <li class="sizedcreenli"><a href="clients_profile.php" class="language">My Profile</a></li>
                              <li class="sizedcreenli"><a href="my-classes.php" class="language">My Classes</a></li>
                              <!--<li class="sizedcreenli"><a href="payment_history.php" class="language">Payment History</a></li>-->
                              <li class="sizedcreenli"><a href="parent_guide.php" class="language">Parent's Guide</a></li>
							  <li class="sizedcreenli"><a href="clients-terms.php" class="language">Terms</a></li>
							  <li class="sizedcreenli"><a href="logout.php" class="language">Logout</a></li>
							  <div class="category"><div class="alternate"><br><br></div></div>
							  
                           </ul>
                        </li>
                        <?php } else { ?>
                        <li class="dropdown text-right" id="shadow">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle text-right" href="#">
                           Welcome <?php echo ucfirst($_SESSION['auth']['display_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu text-right" role="menu">
                              <li class="sizedcreenli"><a href="edit_account.php" class="language">Edit Account</a></li>
                              <li class="sizedcreenli"><a href="change_password.php" class="language">Change Password</a></li>
                              <li class="sizedcreenli"><a href="view_profile.php" class="language">View Profile</a></li>
                              <li class="sizedcreenli"><a href="my-classes.php" class="language">My Classes</a></li>
                              <!--<li class="sizedcreenli"><a href="tutor_payment_history.php" class="language">Payment History</a></li>-->
                              <li class="sizedcreenli"><a href="search_job.php" class="language">Latest Job</a></li>
                              <li class="sizedcreenli"><a href="tutor_guide.php" class="language">Tutor's Guide</a></li>
							  
							  <li class="sizedcreenli"><a href="tutors-terms.php" class="language">Terms</a></li>
							  
                              <li class="sizedcreenli"><a href="logout.php" class="language">Logout</a></li>
                           </ul>
                        </li>
                        <?php } ?>
                     <?php } ?>
					 
			<a href="request_a_tutor.php" style="margin-top:10px" type="button" class="btn btn-info navbar-sm screensizelg">GET A TUTOR</a>
          </ul>
        </div>

		
      </div>
    </nav>
<script>
$(document).ready(function() {
    
var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true; 
    <?PHP 
    if (isset($_SESSION['auth'])) {
        ?>
        $(".navbar-toggle").click();
        $(".dropdown-toggle").click();
        $("#shadow").addClass("shadow");
        <?php
    }
    ?>
}else{
    $('div.category .alternate br').remove();
<?PHP 
if (isset($_SESSION['auth'])) {
if(!isset($_SESSION['getPage'])){
?>
  $(".dropdown-toggle").click();
<?PHP
}
}
?>
}
window.onscroll = function (e) {  
    //$(".navbar-toggle").collapse('hide');
    $(".navbar-collapse").collapse('hide');
    $('.dropdown').removeClass('open');
} 
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
</script>    

	<link href='css-pricing/rotating-card/rotating-card.css' rel='stylesheet' />
	<link rel="stylesheet" type="text/css" href="css-pricing/adaptor/css/custom.css" />
<style>
.transparent {
    background-color: transparent !important;
    box-shadow: inset 0px 1px 0 rgba(0,0,0,.075);
 }
 .left-border-none {
    border-left:none !important;
    box-shadow: inset 0px 1px 0 rgba(0,0,0,.075);
 }
 .border-radius {
    border-radius: 4px;
 }
 
  .carousel-control.left, .carousel-control.right {
   background-image:none !important;
   filter:none !important;
   opacity:1 !important;color:#f1592a;
}


/*==========  Mobile First Method  ==========*/

/* Custom, iPhone Retina */ 
@media screen and (min-width : 320px) {

}

/* Extra Small Devices, Phones */ 
@media screen and (min-width : 480px) {

}

/* Small Devices, Tablets */
@media screen and (min-width : 768px) {

}

/* Medium Devices, Desktops */
@media screen and (min-width : 992px) {
	
}

/* Large Devices, Wide Screens */
@media screen and (min-width : 1200px) {
	
}



/*==========  Non-Mobile First Method  ==========*/

/* Large Devices, Wide Screens */
@media screen and (max-width : 1200px) {

}

/* Medium Devices, Desktops */
@media screen and (max-width : 992px) {

}

/* Small Devices, Tablets */
@media screen and (max-width : 768px) {

}

/* Extra Small Devices, Phones */ 
@media screen and (max-width : 480px) {

}

/* Custom, iPhone Retina */ 
@media screen and (max-width : 320px) {
  h4.media_example {
    font-size: 11px;
  }
  p.media_example {
    font-size: 11px;
  }	
  
}

.thisfont {
    font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
    font-size: 15px;
}

.alert-message
{
    margin: 5px 0;
    padding: 5px;
    border-left: 3px solid #eee;
}
.alert-message h4
{
    margin-top: 0;
    margin-bottom: 5px;
}
.alert-message p:last-child
{
    margin-bottom: 0;
}
.alert-message code
{
    background-color: #fff;
    border-radius: 3px;
}
.alert-message-success
{
    background-color: #F4FDF0;
    border-color: #3C763D;
}
.alert-message-success h4
{
    color: #3C763D;
}
.alert-message-danger
{
    background-color: #fdf7f7;
    border-color: #d9534f;
}
.alert-message-danger h4
{
    color: #d9534f;
}
.alert-message-warning
{
    background-color: #fcf8f2;
    border-color: #f0ad4e;
}
.alert-message-warning h4
{
    color: #f0ad4e;
}
.alert-message-info
{
    background-color: #f4f8fa;
    border-color: #5bc0de;
}
.alert-message-info h4
{
    color: #5bc0de;
}
.alert-message-default
{
    background-color: #EEE;
    border-color: #B4B4B4;
}
.alert-message-default h4
{
    color: #000;
}
.alert-message-notice
{
    background-color: #FCFCDD;
    border-color: #BDBD89;
}
.alert-message-notice h4
{
    color: #444;
}

.circular-square {
  width:150px;
  height:150px;
  border-radius: 50%;
}
</style>
<section class="banner">

   <article class="banner_text">

      <div class="container">

         <div class="row">

            <div style="width:100%">



               <div class="form_div" style="width: 100%">

               </div>

            </div>

         </div>

      </div>

   </article> 

   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">

      <!-- Indicators -->

      <ol class="carousel-indicators">

        <li data-target="#carousel-example-generic" data-slide-to="0"  class="active" ></li>

      </ol> 

      <!-- Wrapper for slides -->

      <div class="carousel-inner" role="listbox">

         <div class="item  active ">
			<?php if(stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")){ // if mobile browser ?>
				<img src="folder-tuisyen-online/pkp_header-min.png">
			<?php }else { // desktop browser ?>
				<img src="folder-tuisyen-online/pkp_header-min.png" style="padding-top: 80px;">
			<?php } ?>

            <div class="carousel-caption"></div>
         </div>

      </div>


   </div>

</section>


<!-- style="background-image: url('folder-tuisyen-online/Wallpaper.png');opacity:1;" -->
<style>

.gray_bg2{
     background:url(../folder-tuisyen-online/download.png);
}

.span4 img {
    margin-right: 10px;
}
.span4 .img-left {
    float: left;
}
.span4 .img-right {
    float: right;
}


#wizardProfile {
    /*opacity: 0.8;
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.5);
    border-color: rgb(24, 17, 12);
    border-color: rgba(24, 17, 12);
    box-shadow: inset 1px 2000px rgb(252, 252, 252);*/
    background-color: rgba(255, 255, 255, 0.7);
}

#example2 {
  padding: 50px;
  border-radius: 25px;
}

@media (min-width: 300px) {
    .textH2 { font-size: 2.2rem; font-family: Tahoma, Geneva, sans-serif; }
    .textH3 { font-size: 1.7rem; }
    .imgResponsive {
          width: 5%;
          max-width: 80px;
          height: auto;
    }
    .imgResponsive2 {
          width: 30%;
          max-width: 150px;
          height: auto;
    }
}
@media (min-width: 576px) {
    .textH2 { font-size: 2.2rem; font-family: Tahoma, Geneva, sans-serif; }
    .textH3 { font-size: 1.7rem; }
    .imgResponsive {
          width: 5%;
          max-width: 80px;
          height: auto;
    }
    .imgResponsive2 {
          width: 30%;
          max-width: 150px;
          height: auto;
    }
}
@media (min-width: 768px) {
    .textH2 { font-size: 2.5rem;   font-family: Tahoma, Geneva, sans-serif; }
    .textH3 { font-size: 2rem; }
    .imgResponsive {
          width: 5%;
          max-width: 80px;
          height: auto;
    }
    .imgResponsive2 {
          width: 30%;
          max-width: 150px;
          height: auto;
    }
}
@media (min-width: 992px) {
    .textH2 { font-size: 3rem; font-family: Tahoma, Geneva, sans-serif; }
    .textH3 { font-size: 2.5rem; }
    .imgResponsive {
          width: 5%;
          max-width: 80px;
          height: auto;
    }
    .imgResponsive2 {
          width: 30%;
          max-width: 150px;
          height: auto;
    }
}
@media (min-width: 1200px) {
    .textH2 { font-size: 3.5rem;   font-family: Tahoma, Geneva, sans-serif; }
    .textH3 { font-size: 3rem; }
    .imgResponsive {
          width: 5%;
          max-width: 80px;
          height: auto;
    }
    .imgResponsive2 {
          width: 30%;
          max-width: 150px;
          height: auto;
    }
}

.strikethrough {
  text-decoration: line-through;
}
</style>


<?PHP
/*
 echo '<br/>';
 echo 'currentData2 : '.$currentData2;
		
 echo '<br/>';
 echo 'db2 : '. implode(',', $currentData);
 
 echo '<br/>';
 */
 
/*echo '<br/>';
echo str_replace(","," ",$seoState);
echo '<br/>';*/
/*echo '<br/>';
echo str_replace(","," ",$seoLevel);
echo '<br/>';
echo str_replace(",,",",",$seoSub);*/

?>




<section class="how_works gray_bg2">
   <div class="container">
      <div class="row">
	  

		<div class="image-container set-full-height">
	    

		<div class="container" style="margin-top:0px;">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <div class="wizard-container" >
		                <div class="card wizard-card" data-color="red" id="wizardProfile">
		                    
		                        	<h2 class="wizard-title textH2" id="search-term">
		                        	   <p><font color="#14114e" style=""><strong>Tutor & Guru Tuisyen online <?PHP echo str_replace(","," ",str_replace(",,",",",$seoSub)).' '.str_replace(","," ",str_replace(",,"," ",$seoLevel)); ?> di <?PHP echo str_replace(","," ",str_replace(",,"," ",$seoCity)); ?> <?PHP echo str_replace(","," ",str_replace(",,"," ",$seoState)); ?> & Sekitarnya</strong></font></p>
		                        	</h2>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p class="control-label textH3" style="text-align: center;font-family: system-ui;">Dapatkan cikgu online tuition <?PHP echo str_replace(","," ",str_replace(",,",",",$seoSub)).' '.str_replace(","," ",str_replace(",,"," ",$seoLevel)); ?> di <?PHP echo str_replace(","," ",str_replace(",,"," ",$seoCity)); ?> <?PHP echo str_replace(","," ",str_replace(",,"," ",$seoState)); ?> & sekitarnya dengan lebih mudah, selamat dan ada jaminan</p>
                                            </div>
                                        </div>

       
		                    
		                    <form action="" method="">
<br/>

		                    	<br/>
		                    	<div class="wizard-header">
		                    	    <img alt="" class="img-responsive center-block" src="folder-tuisyen-online/red-line.PNG"  /><br/>
		                        	<h2 class="wizard-title textH2" id="search-term">
		                        	   <p><font color="#14114e" style=""><strong>KELEBIHAN TUISYEN 1-to-1 SECARA ONLINE</strong></font></p>
		                        	</h2><br/>


                                        <div class="row">
                                            <div class="col-xs-2">
                                                <img src="folder-tuisyen-online/start.png" class="rounded-circle img-fluid" alt=""/>
                                            </div>
                                            <div class="col-xs-10">
                                                <p class="control-label textH3" style="text-align: left;font-family: system-ui;">Boleh dilakukan dimana saja pelajar berada</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <img src="folder-tuisyen-online/start.png" class="rounded-circle img-fluid" alt=""/>
                                            </div>
                                            <div class="col-xs-10">
                                                <p class="control-label textH3" style="text-align: left;font-family: system-ui;">Sesi kelas disesuaikan mengikut keperluan dan kehendak pelajar</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <img src="folder-tuisyen-online/start.png" class="rounded-circle img-fluid" alt=""/>
                                            </div>
                                            <div class="col-xs-10">
                                                <p class="control-label textH3" style="text-align: left;font-family: system-ui;">Tiada interaksi fizikal, mengelakkan pelajar dijangkiti virus Covid -19</p>
                                            </div>
                                        </div>
                      	
		                        	
		                        	
		                    	</div>
		                    	<br/>
		                    	<div class="wizard-header">
		                    	    <img alt="" class="img-responsive center-block" src="folder-tuisyen-online/red-line.PNG"  /><br/>
		                        	<h2 class="wizard-title textH2" id="search-term">
		                        	   <p><font color="#14114e" style=""><strong>KENAPA PATUT PILIH TUTORKAMI</strong></font></p>
		                        	</h2><br/>

		          
		                        	
                                        <div class="row"><br/>
                                            <div class="col-xs-12">
                                                <img alt="" class="imgResponsive2 center-block" src="folder-tuisyen-online/kualti-img.PNG"  /><br/>
                                                <p class="control-label textH2"><font color="#14114e" style="text-align: center;"><strong>Kualiti</strong></font></p>
                                                <p class="control-label textH3" style="text-align: center;font-family: system-ui;">Kami mempunyai sistem dan proses pemilihan tutor yang dapat membantu anda mendapat cikgu tuisyen yang berkualiti</p>
                                            </div>
                                        </div><br/><br/><br/>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <img alt="" class="imgResponsive2 center-block" src="folder-tuisyen-online/selamat-img.PNG"  /><br/>
                                                <p class="control-label textH2"><font color="#14114e" style="text-align: center;"><strong>Selamat</strong></font></p>
                                                <p class="control-label textH3" style="text-align: center;font-family: system-ui;">Kami pastikan tutor melengkapkan semua sesi seperti yang dipersetujui. Ini akan mengelakkan berlakunya kes tutor tidak menjalankan kelas walaupun setelah menerima bayaran</p>
                                            </div>
                                        </div><br/><br/><br/>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <img alt="" class="imgResponsive2 center-block" src="folder-tuisyen-online/pengalaman-img.PNG"  /><br/>
                                                <p class="control-label textH2"><font color="#14114e" style="text-align: center;"><strong>Berpengalaman</strong></font></p>
                                                <p class="control-label textH3" style="text-align: center;font-family: system-ui;">Ditubuhkan pada 2013, TutorKami berpengalaman lebih dari 6 tahun membantu ibubapa mendapatkan tutor dan guru tuisyen hampir di seluruh Malaysia</p>
                                            </div>
                                        </div>
		                    	</div>
		                    	<br/>
		                    	<div class="wizard-header">
		                    	    <img alt="" class="img-responsive center-block" src="folder-tuisyen-online/red-line.PNG"  /><br/>
		                        	<h2 class="wizard-title textH2" id="search-term">
		                        	   <p><font color="#14114e" style=""><strong>HARGA KHIDMAT TUISYEN 1-TO-1 SECARA ONLINE</strong></font></p>
		                        	</h2><br/>
		                    	</div>

  <div class="panel" style="padding-left:10px;padding-right:10px;">

    <!--<div class="panel-heading" style="background-color: #1b4a5c;text-align: left;"><font color="white"><b>Tahap 1 = <span class="strikethrough">RM 35 sejam</span> RM 25 sejam</b></font></div><br/>-->

    <div class="panel-heading" style="background-color: #1b4a5c;text-align: left;"><font color="white"><b>Pra-sekolah = <span class="">RM 30 sejam</span>  </b></font></div><br/>
    <div class="panel-heading" style="background-color: #1b4a5c;text-align: left;"><font color="white"><b>Tahap 1 = <span class="">RM 30 sejam</span>  </b></font></div><br/>
    <div class="panel-heading" style="background-color: #1b4a5c;text-align: left;"><font color="white"><b>Tahap 2 (UPSR) = <span class="">RM 35 sejam</span>  </b></font></div><br/>
    <div class="panel-heading" style="background-color: #1b4a5c;text-align: left;"><font color="white"><b>Menengah Rendah (PT3) = <span class="">RM 40 sejam</span> </b></font></div><br/>
    <div class="panel-heading" style="background-color: #1b4a5c;text-align: left;"><font color="white"><b>Form 4/5 (SPM) = <span class="">RM 45 sejam</span> </b></font></div><br/>
    <div class="panel-heading" style="background-color: #1b4a5c;text-align: left;"><font color="white"><b>IGCSE (Year 10/11) = <span class="">RM 55 sejam</span> </b></font></div>
      
      
    <!--<div class="panel-heading" style="background-color: #e50000;"><font color="white"><b>Promosi sempena PKP, diskaun RM10 sejam!<br/>(Terhad kepada 10 pelajar pertama sahaja)</b></font></div>-->
  </div>

		                    
		                    
		                    	<!--<div class="wizard-header">
		                        	<h2 class="wizard-title textH2" id="search-term">
		                        	   <p><font color="#14114e"><strong>DAPATKAN HARGA KHIDMAT TUISYEN ONLINE 1-to-1</strong></font></p>
		                        	</h2>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li class="hidden"><a href="#about" data-toggle="tab"></a></li>
			                            <li class="hidden"><a href="#address" data-toggle="tab"></a></li>
			                        </ul>
								</div>

		                        <div class="tab-content" id="example1">
		                            <div class="tab-pane" id="about">
		                              <div class="row" style="padding-left: 10px;padding-right: 10px;">
		                                	<h4 class="info-text"></h4>
		                                	<div class="col-sm-12">
		                                    	<div class="form-group label-floating">
		                                        	<p class="control-label" style="text-align: left;">Tahap <small>(required)</small></p>
	                                        		<select class="form-control" id="selectthisLevel" name="selectthisLevel">
														<option disabled="" selected=""></option>
														<?PHP
														/*if($rowLevel2 > 0){
															while ($resultLevel2 = $queryLevel2->fetch_assoc()) {
																?><option value="<?PHP echo $resultLevel2['tc_id']; ?>"> <?PHP echo $resultLevel2['tc_title']; ?> </option><?PHP
															}
														}*/
														?>
		                                        	</select>
		                                    	</div>
		                                    	<div class="form-group label-floating">
		                                        	<p class="control-label" style="text-align: left;">Lokasi Anda <small>(required)</small></p>	
		                                        	
	                                            		<div class="input-group ui-widget" style="text-align: left;">
                											 <span class="input-group-addon customInput" style="padding-left:10px;"><i class="glyphicon glyphicon-map-marker"></i></span>
                											 <input type="text" id="selectState" name="selectState" class="my_form_control ui-autocomplete-input customInput" placeholder="Your location" />
	                                               		</div>
		                                        	
		                                    	</div>

												<div class="form-group label-floating">
		                                        	<p class="control-label" style="text-align: left;">Bilangan Pelajar</p>
	                                        		<select class="form-control" id="selectPerson" name="selectPerson">
	                                                	<option value="1"> 1 Person </option>
	                                                	<option value="2"> 2 Person </option>
	                                                	<option value="3"> 3 Person </option>
	                                                	<option value="4"> 4 Person </option>
	                                                	<option value="5"> 5 Person </option>
		                                        	</select>
		                                    	</div>
		                                	</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="address">
		                                <div class="row" style="background-color:white;">
										<p style="background-color:white;" id="demo"></p>
		                                </div>
		                            </div>
		                        </div>
	                        	<div class="wizard-footer" style="padding-left: 10px;padding-right: 10px;">
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' onClick="myFunction()"/>
	                                </div>
	                                <div class="pull-left hidden">
	                                    <input type='button' class='btn btn-previous btn-fill btn-danger btn-wd' id='btnPrevious2' value='Previous' />
	                                </div>
	                                <div class="clearfix"></div>
	                        	</div>
	                        	<br/>-->
		                    </form>
		                    
		                    
		                    	<br/><br/>
		                    	<div class="wizard-header">
		                    	    <img alt="" class="img-responsive center-block" src="folder-tuisyen-online/red-line.PNG"  /><br/>
		                        	<h2 class="wizard-title textH2" id="search-term">
		                        	   <p><font color="#14114e" style=""><strong>TUTOR TERKINI UNTUK TUISYEN ONLINE</strong></font></p>
		                        	</h2><br/>
		                        	<h3 class="wizard-title" id="search-term">
		                        	   <!--<p><font color="#14114e" style="">Klik gambar tutor untuk lihat profile dan jadual available mereka</font></p>-->
		                        	   <p><font color="#14114e" style="">Klik untuk lihat profile tutor</font></p>
		                        	</h3>
		                    	</div>
		                    
		                    
		                </div>
		            </div> 
		        </div>
	        </div>
	    </div>


	</div>


	
		
		
      </div>
   </div>
</section>










<section class="how_works gray_bg2">
   <div class="container">
      <div class="row">
	  
        <div class="col-xs-12 text-center hw_box">
			
            <ul class="tutor_list" style="margin-top:-80px;">

              <?php 

                 // Get Slider

                 $arrTutor = system::FireCurl(LIST_TUTOR2);

                 $i = 0;

                 foreach($arrTutor->data as $tutor){

                   $arrState = system::FireCurl(LIST_STATE_URL.'?state_id='.$tutor->ud_state);

                 foreach($arrState->data as $state){

                     $statename = $state->st_name;

                   }

                   $pix = sprintf("%'.07d\n", $tutor->u_profile_pic);

                 ?>  



         <div class="col-md-3 col-sm-3">
             <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="css-pricing/rotating-card/bg-card.jpg"/>
                        </div>
                        <div class="user">
                            <img class="circular-square" src="<?php 
							if($tutor->u_profile_pic!='') { 
								//echo APP_ROOT."images/profile/".$pix."_0.jpg"; 
								if ( is_numeric($tutor->u_profile_pic) ) {
									echo APP_ROOT."images/profile/".$pix."_0.jpg"; 
								}else{
									$pic = $tutor->u_profile_pic;
									echo APP_ROOT."images/profile/".$pic.".jpg";
								}
							} else { 
								if($tutor->u_gender=='M') echo 'images/tutor_ma.png'; else echo 'images/tutor_mi1.png'; 
							}
							?>"/>
						</div>
                        <div class="content">
                            <div class="main">
                                <h3 class="name"><strong> <?=$tutor->u_displayname?> </strong></h3>
<?php
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
        $dataCity = $tutor->ud_city;
        $queryCity = "SELECT * FROM tk_cities WHERE city_id = '".$dataCity."' "; 
        $resultCity = $conn->query($queryCity); 
        if($resultCity->num_rows > 0){ 
            $rowCity = $resultCity->fetch_assoc();
            $nameCity = $rowCity['city_name'];  
        }else{
            $nameCity =  $tutor->ud_city;
        }
?>
                                <p class="profession"><? echo $nameCity;//=$tutor->ud_city ?></p>
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
	echo ' '.$langStringQua; 	
}else{
	echo ' '.$langStringQua; 
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

    $langStringCut = substr($langString, 0, 300);
    $langStringEndPoint = strrpos($langStringCut, ' ');

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
			
        </div>

<div class="clearfix"></div>
		                    	<div class="col-sm-8 col-sm-offset-2">
		                    	<div class="wizard-header" id="">
		                    	    <img id="wizardProfile" alt="" class="img-responsive center-block" src="folder-tuisyen-online/red-line.PNG"  /><br/>
		                        	<h2 class="wizard-title textH2" id="search-term" id="wizardProfile">
		                        	   <p id="wizardProfile"><font color="#14114e" style=""><strong>JAMINAN KAMI</strong></font></p>
		                        	</h2>
                                        <div class="row" id="wizardProfile">
                                            <div class="col-xs-12">
                                                <img alt="" class="imgResponsive2 center-block" src="folder-tuisyen-online/Capture.PNG"  /><br/>
                                                <p class="control-label textH3" style="text-align: center;font-family: system-ui;">Anda hanya mula membayar dari sesi pertama jika anda berpuas hati dengan khidmat tutor kami. <br/><br/> Jika tidak, kami akan dapatkan tutor lain untuk anda, dan sesi pertama dengan tutor sebelum itu adalah <u>percuma</u> </p>
                                            </div>
                                        </div>
		                    	</div>
		                    	</div>
		
		
		
      </div>
   </div>
</section>



























<section class="how_works gray_bg2" style="margin-top:-80px;">
   <div class="container">
      <div class="row" style="margin-top:-80px;">
         <div class="col-md-12">
			
		                    	<div class="wizard-header" id="wizardProfile">
		                    	    <img alt="" class="img-responsive center-block" src="folder-tuisyen-online/red-line.PNG"  /><br/>
		                        	<h2 class="wizard-title textH2" id="search-term">
		                        	   <p><font color="#14114e" style=""><strong>TESTIMONI IBUBAPA & PELAJAR</strong></font></p>
		                        	</h2><br/>
		                    	</div>
			

            <div class="owl-carousel owl-theme" id="load-testimonial">

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

         </div>
      </div>
   </div>
</section>








<section class="join">

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <h1> Ada sebarang pertanyaan?</h1>

<h2>Klik butang di bawah</h2>
<!--
<h3> <a href="http://www.wasap.my/60187882464"><img src="https://www.tutorkami.com/images/whatsapp-logo-transparent.png" height="32" size="32"></a> 018-788 2464</h3>
<p>012-230 9743 Mon to Fri 9am-6pm <a href="http://www.wasap.my/60122309743"><img src="https://www.tutorkami.com/images/whatsapp-logo-transparent.png" height="32" size="32"></a></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp; 019-877 1868 Mon to Fri 12pm-9pm <a href="http://www.wasap.my/60198771868"><img src="https://www.tutorkami.com/images/whatsapp-logo-transparent.png" height="32" size="32"></a></p>
<p style="margin-left:-30px;">019-641 2395 Mon, Tue, & Fri 1-10pm</p>
<p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sat & Sun 10am-9pm <a href="http://www.wasap.my/60196412395"><img src="https://www.tutorkami.com/images/whatsapp-logo-transparent.png" height="32" size="32"></a></p>
<br>
<p>Or click the button below to fill a form</p>-->
<p class="m_top_30"><a class="orange_btn" href="https://www.tutorkami.com/request_a_tutor">Hubungi Kami</a></p>
         </div>

      </div>

   </div>

</section>

<section class="how_works gray_bg">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <h1 class="header">DISOKONG OLEH</h1>
         </div>
      </div>
	  <br/><br/>
      <div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://erezeki.my/partners" target="_blank"><img alt="mdec logo" class="img-responsive center-block" src="images/mdec-logo.png" style="width:80%" /></a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://erezeki.my/partners" target="_blank"><img alt="erezeki logo" class="img-responsive center-block" src="images/eRezeki-logo.png" style="width:80%" /></a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://www.cradle.com.my/" target="_blank"><img alt="cradle logo" class="img-responsive center-block" src="images/cradle-logo.png" style="width:80%" /></a>
			</div>
      </div>
   </div>
</section>




<section class="how_works gray_bg2" style="margin-top:0px;">

   <div class="container">
      <div class="row" style="text-align: left;">

         <div class="col-md-offset-2 col-md-8" id="wizardProfile">
          <div class="clearfix"></div>
  
		  
		  
            <form method="post" id="filter_user">
               <input type="hidden" name="action" value="search_tutor">
               <div class="row">
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo STATE; ?>:</strong></span></div>
                  <div class="col-md-9">
                     <div class="form-group">
						<?php	
							$stateSelected = "";
							$stateSelector = "";

							if( $currentState != "" ){
								$stateSelected = $currentState;
								$stateSelector = "$('#state_drop').val('".$stateSelected."');";
							}
							
							/*if( isset($_SESSION['getNegeri']) && $_SESSION['getNegeri'] != "" ){
								$stateSelected = $_SESSION['getNegeri'];
								$stateSelector = "$('#state_drop').val('".$stateSelected."');";
							}*/
						?>
                        <select class="form-control" name="cover_area_state[]" id="state_drop" onchange="getState(this.value)">
                           <option value=""><?php echo SEARCH_TUTOR_SELECT_STATE; ?></option>
                           <option value="AllState"><?php echo "All"; ?></option>
                           <?php 
							$queryState = "SELECT * FROM tk_states ORDER BY st_name ASC"; 
							$resultState = $dbCon->query($queryState); 
							if($resultState->num_rows > 0){ 
								while($rowState = $resultState->fetch_assoc()){  
								?><option value="<?php echo $rowState['st_id']; ?>" <?php if(in_array($rowState['st_name'], $currentData)) { echo "selected"; }		echo (strcasecmp($stateSelected, $rowState['st_id']) == 0 || strcasecmp($stateSelected, $rowState['st_name']) == 0 ? "selected" : ""); ?>><?php echo $rowState['st_name']; ?></option><?php
								} 
							}
                           ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <div class="showHide" <?php 
                          if(!isset($_GET['location_id'])){ 
                            echo "style='display: none;'"; 
                          } else if($_GET['location_id'] == ""){ 
                            echo "style='display: none;'"; 
                          }  
                        ?>>
                           <div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>
                           <div class="dropPop">
                              <div class="row">
                                 <!--<div class="col-md-12 city_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAll('.city_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('.city_check');">Untick All</a></div>-->
                                 <div class="col-md-12 city_check_uncheck_area"></div>
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


							if( $currentLevel != "" ){
								$levelSelected = $currentLevel;
							}
							/*if( strpos($actual_link, '?/') !== false ){
								if($currentLevel != "") {
									$levelSelected = $currentLevelThis;
									$levelSelector = "$('#level_drop option:contains(".$levelSelected.")').attr('selected', 'selected');";
									$testl = 'test2 = '.$levelSelected;
								}
							}*/
						?>
                        <select class="form-control" name="tutor_course[]" id="level_drop">
                           <option value="">Choose Subject</option>
                           <option value="AllLevel"><?php echo "All"; ?></option>
                           <?php 
							$queryLevel = "SELECT * FROM tk_tution_course ORDER BY sort_by ASC"; 
							$resultLevel = $dbCon->query($queryLevel); 
							if($resultLevel->num_rows > 0){ 
								while($rowLevel = $resultLevel->fetch_assoc()){  
								?><option value="<?php echo $rowLevel['tc_id']; ?>" <?php if(in_array($rowLevel['tc_title'], $currentData)) { echo "selected"; }		echo (strcasecmp($levelSelected, $rowLevel['tc_id']) == 0 || strcasecmp($levelSelected, $rowLevel['tc_title']) == 0 ? "selected" : ""); ?>><?php echo $rowLevel['tc_title']; ?></option><?php
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
                                 <!--<div class="col-md-12 subject_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAll('.subject_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('.subject_check');">Untick All</a></div>-->
                                 <div class="col-md-12 subject_check_uncheck_area"></div>
                                 <div class="subject-area"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
				<?php	

					if( isset($_SESSION['getJantina']) && $_SESSION['getJantina'] != "" ){
						$genderSelected = $_SESSION['getJantina'];
						$testg = 'test2 = '.$genderSelected;
					}
				?>
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo GENDER; ?>:</strong></span></div>
                  <div class="col-md-3">
                     <select class="form-control" name="u_gender" id="u_gender" onchange="getGender(this.value)">
                        <option value="">All</option>
                        <option value="M" <?php echo (strcasecmp($genderSelected, "M") == 0 || strcasecmp($genderSelected, MALE) == 0 ? "selected" : "") ?>><?php echo MALE; ?> </option>
                        <option value="F" <?php echo (strcasecmp($genderSelected, "F") == 0 || strcasecmp($genderSelected, FEMALE) == 0 ? "selected" : "") ?>><?php echo FEMALE; ?></option>
                     </select>
                  </div>
				  
                  <div class="col-md-3"> <span class="org-txt text-uppercase"><strong><?php echo OCCUPATION; ?>:</strong></span> </div>

                  <div class="col-md-3">
				     <?php	
						$occupationSelected = "";

						if( isset($_SESSION['getKerja']) && $_SESSION['getKerja'] != "" ){
							$occupationSelected = $_SESSION['getKerja'];
							$testo = 'test2 = '.$occupationSelected;
						}
					?>
                     <select class="form-control" name="ud_current_occupation" id="ud_current_occupation" onchange="getOccupation(this.value)">
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

					  if( isset($_SESSION['getBangsa']) && $_SESSION['getBangsa'] != "" ){
						  $raceSelected = $_SESSION['getBangsa'];
					  	  $testr = 'test2 = '.$raceSelected;
					  }
				  ?>
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo RACE; ?>:</strong></span></div>
                  <div class="col-md-3">
                     <select class="form-control" name="ud_race" id="ud_race" onchange="getRace(this.value)">
                        <option value="">All</option>
                        <option value="Malay" <?php echo (strcasecmp($raceSelected, "Malay") == 0 || strcasecmp($raceSelected, Malay) == 0 ? "selected" : "") ?>>Malay</option>
                        <option value="Chinese" <?php echo (strcasecmp($raceSelected, "Chinese") == 0 || strcasecmp($raceSelected, Chinese) == 0 ? "selected" : "") ?>>Chinese</option>
                        <option value="Indian" <?php echo (strcasecmp($raceSelected, "Indian") == 0 || strcasecmp($raceSelected, Indian) == 0 ? "selected" : "") ?>>Indian</option>
                        <option value="Others" <?php echo (strcasecmp($raceSelected, "Others") == 0 || strcasecmp($raceSelected, Others) == 0 ? "selected" : "") ?>>Others</option>
                     </select>
                  </div>
               </div>

               <div class="row">
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
                     <br>
                     <!--
                     <input type="button" name="submitBtn" class="btn btn-md search_btn" onclick="pretest()" value="<?php //echo BUTTON_SEARCH_TUTOR; ?>">-->
                     <button type="button" name="submitBtn" onclick="pretest()" class="btn orange_btn"><?php echo BUTTON_SEARCH_TUTOR; ?></button>
                  </div>
               </div>
            </form>
<br/><br/>
         </div>	 



      </div>
   </div>
</section>










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

                  <li>contact@tutorkami.com</li>

                  
               </ul>

            </div>

            <div class="col-md-2 col-sm-2">

               <h3>Site Navigation</h3>

               <ul class="nl">

                 
                  <li><a href="index.php"  class="active" >Home</a></li>

                  
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

<div id="search-box">
   <script>
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
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v3.2'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  //js.src = 'https://www.tutorkami.com/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code 193594130789161 
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="193594130789161"
  greeting_dialog_display="hide"
  theme_color="#f1592a">
</div>-->
<script src="//code.tidio.co/xemvegnr9wqcfsvi5yswoogjelcyby2v.js" async></script>


<script>
$(document).ready(function() {
	
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
	})
})




   $(function() {

      function log( message ) {

         $( "<div>" ).text( message ).prependTo( "#log" );

         $( "#log" ).scrollTop( 0 );

      }

      $(document).ready(function(){

        $('.carousel').carousel({

          interval: 3000

        });


      });    

   

   });
</script>
</body>

</html>


<!--   Core JS Files   -->
    <!--<script src="css-pricing/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="css-pricing/assets/js/bootstrap.min.js" type="text/javascript"></script>-->
	<script src="css-pricing/assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<script src="css-pricing/assets/js/material-bootstrap-wizard.js"></script>

	<!--<script src="css-pricing/assets/js/jquery.validate.min.js"></script>-->

<script type="text/javascript">
$(document).ready(function(){
    $('#selectState').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'pricing-ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
					$('#chgLabel').html('');
					$('#chgLabel2').html('<label class="control-label">Cities <small>(required)</small></label>');
                    $('#selectCities').html(html);
                }
            });
        }else{
            $('#selectCities').html('<option disabled="" selected=""></option>');
        }
    });
});

function myFunction() {
	var level  = document.getElementById("selectthisLevel").value;  
	var state  = document.getElementById("selectState").value; 
	//var city   = document.getElementById("selectCities").value; 
	var person = document.getElementById("selectPerson").value; 
	//alert(level + " - " + state + " - " + city + " - " + person);
	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	if (isMobile) {
		if(level != '' && state != '' && person != ''){
			$.ajax({
                type:'POST',
                url:'pricing-ajax-mobile-seo.php',
                data:{level: level, state: state, person: person},
                beforeSend: function() {
					$('#demo').html("Loading ... ");
                },
                success:function(result){
					$('#demo').html(result);
                }
			});
		}
	}else{
		if(level != '' && state != '' && person != ''){
			$.ajax({
                type:'POST',
                url:'pricing-ajax-desktop-seo.php',
                data:{level: level, state: state, person: person},
                beforeSend: function() {
					$('#demo').html("Loading ... ");
                },
                success:function(result){
					$('#demo').html(result);
                }
			});
		}
	}
}

function closeWindow() {
	 //window.parent.close();
	 window.location = "https://www.tutorkami.com/";
}

function openPopup(){
	var popup = window.open("/pricing", "popup", "fullscreen");
	if (popup.outerWidth < screen.availWidth || popup.outerHeight < screen.availHeight){
		popup.moveTo(0,0);
		popup.resizeTo(screen.availWidth, screen.availHeight);
	}
}
</script>

</html>



<script>
function autocomplete(inp, arr) {
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
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
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
      var x = document.getElementById(this.id + "autocomplete-list");
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
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
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
	var countries = 	[
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
autocomplete(document.getElementById("selectState"), countries);
</script>
<style>
/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  /*border: 1px solid transparent;
  background-color: #d4d4d4;*/
  padding: 10px;
  font-size: 16px;
  background-color: #ffffff; 
  
}

input[type=text] {
  /*background-color: #d4d4d4;*/
  width: 100%;
  background-color: #ffffff; 
  border-top: 2px solid  #e5e7e9 ;
  border-right: 2px solid  #e5e7e9 ;
  border-bottom: 2px solid  #e5e7e9 ;
}

input[type=submit] {
  /*background-color: DodgerBlue;
  color: #fff;*/
  cursor: pointer;
  background-color: #ffffff; 
}

.autocomplete-items {
  position: absolute;
  /*border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;*/
  background-color: #ffffff; 
  
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  /*background-color: #d4d4d4; 
  border-bottom: 1px solid #d4d4d4; */
  background-color: #ffffff; 

  border-top: 1px solid  #e5e7e9 ;
  border-bottom: 1px solid  #e5e7e9 ;
  border-left: 1px solid  #e5e7e9 ;
  border-right: 1px solid  #e5e7e9 ;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  /*background-color: #e9e9e9; */
  background-color: #ffffff; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  /*background-color: #d4d4d4; 
  color: #d4d4d4; */
  background-color: #ffffff; 
}
</style>










<script> 
      $('#state_drop').on('change', function(){
         $('#hider, #loadermodaldiv').show();
         var StateId = $(this).val();
         $.ajax({
            url: "guru-tuisyen-ajax.php",
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
            url: "guru-tuisyen-ajax.php",
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
	  
	  
	  
	  
	function pretest() {
		var selectedArea = new Array();
		var selectedSubject = new Array();
		var parameterArr = new Array();
		var selectedState = encodeURI($("#state_drop :selected").html().trim());
		
		$(".city_check").each(
			function() {
				if($(this).is(":checked")) {
					selectedArea.push(encodeURI($(this).next().html().trim()));
				}
			}
		);			
					
		var selectedLevel = encodeURI($("#level_drop :selected").html().trim());
		$(".subject_check").each(
			function() {
				if($(this).is(":checked")) {
					selectedSubject.push(encodeURI($(this).next().html().trim()));
				}
			}
		);				
					
		var selectedGender = encodeURI($("#u_gender :selected").html().trim());
		var selectedOccupation = encodeURI($("#ud_current_occupation :selected").html().trim());
		var selectedRace = encodeURI($("#ud_race :selected").html().trim());

		if(selectedSubject.length > 0) {
			parameterArr.push("/" + selectedSubject.join(","));
		}
		if($("#level_drop").val() != "") {
			if(selectedLevel == 'Choose%20Subject'){
			}else if(selectedLevel == 'Others%20/%20Lain-lain'){
				parameterArr.push("/Others_Lain-lain");
			}else{
				parameterArr.push("/" + selectedLevel);
			}
		}	
		if(selectedArea.length > 0) {
			parameterArr.push("/" + selectedArea.join(","));
		}
		if($("#state_drop").val() != "") {
			if(selectedState == 'Pilih%20Negeri'){
			}else{
				parameterArr.push("/" + selectedState);
			}
		}
				
				
		<?php
		$urlArr = explode("?", $_SERVER['REQUEST_URI']);
		$getUrl = $urlArr[0];
		?>
		var getUrl  = "<?php echo $getUrl; ?>?";
		var getUrl2 = getUrl + parameterArr.join("");
		var getUrl3 = getUrl2.replace(/%20/g, '-');

		$("#filter_user").prop("action", getUrl3);
		$("#filter_user").submit();
		
		/*var getUrl  = "https://www.tutorkami.com/guru-tuisyen?";
		var getUrl2 = getUrl + parameterArr.join("");
		var getUrl3 = getUrl2.replace(/%20/g, '-');
window.open(getUrl3, '_blank');*/
	}



 $(document).ready(function(){
		<?php
		if($currentData2 != ""){
			echo 'get_cities2("'.$currentData2.'", "'.$currentData2.'");';
			echo 'get_subjects2("'.$currentData2.'", "'.$currentData2.'");';
		}
		?>
   });


   function get_cities2(StateId, CityId) {
        /*alert(CityId);*/
      $.ajax({
         url: "guru-tuisyen-ajax.php",
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
         }
      });
   }
   
   function get_subjects2(LevelId, SubjectId) {
      $.ajax({
         url: "guru-tuisyen-ajax.php",
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

         }
      });
   }   
   
function btnPrevious() {
    document.getElementById('btnPrevious2').click();
}
</script>









<script>

  equalheight = function(container){



    var currentTallest = 0,

    currentRowStart = 0,

    rowDivs = new Array(),

    $el,

    topPosition = 0;

    $(container).each(function() {



     $el = $(this);

     $($el).height('auto')

     topPostion = $el.position().top;



     if (currentRowStart != topPostion) {

       for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {

         rowDivs[currentDiv].height(currentTallest);

       }

       rowDivs.length = 0; // empty the array

       currentRowStart = topPostion;

       currentTallest = $el.height();

       rowDivs.push($el);

     } else {

       rowDivs.push($el);

       currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

     }

     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {

       rowDivs[currentDiv].height(currentTallest);

     }

   });

  }



  $(window).load(function() {

    equalheight('.how_works .thum_bg');

  });





  $(window).resize(function(){

    equalheight('.how_works .thum_bg');

  });


</script>



		<script src="css-pricing/adaptor/js/box-slider-all.jquery.min.js"></script>
		<script>
		  $(function () {
        var $images = $('.slide > img');
        var imagesLeftToLoad = $images.length;
        $images.on('load', function () {
          imagesLeftToLoad -= 1;

          if (imagesLeftToLoad === 0) {
            init();
          }
        });

        var init = function () {
          // This function runs before the slide transition starts
          var switchIndicator = function ($c, $n, currIndex, nextIndex) {
            // kills the timeline by setting it's width to zero
            $timeIndicator.stop().css('width', 0);
            // Highlights the next slide pagination control
            $indicators.removeClass('current').eq(nextIndex).addClass('current');
          };

          // This function runs after the slide transition finishes
          var startTimeIndicator = function () {
            // start the timeline animation
            $timeIndicator.animate({width: '100%'}, slideInterval);
          };

          var $box = $('#box')
            , $indicators = $('.goto-slide')
            , $effects = $('.effect')
            , $timeIndicator = $('#time-indicator')
            , slideInterval = 5000
            , defaultOptions = {
                  speed: 1200
                , autoScroll: true
                , timeout: slideInterval
                , next: '#next'
                , prev: '#prev'
                , pause: '#pause'
                , onbefore: switchIndicator
                , onafter: startTimeIndicator
                , effect : 'scrollHorz'
              }
            , effectOptions = {
                'blindLeft': {blindCount: 15}
              , 'blindDown': {blindCount: 15}
              , 'tile3d': {tileRows: 6, rowOffset: 80}
              , 'tile': {tileRows: 6, rowOffset: 80}
            };

          // initialize the plugin with the desired settings
          $box.boxSlider(defaultOptions);
          // start the time line for the first slide
          startTimeIndicator();

          // Paginate the slides using the indicator controls
          $('#controls').on('click', '.goto-slide', function (ev) {
            $box.boxSlider('showSlide', $(this).data('slideindex'));
            ev.preventDefault();
          });

          // This is for demo purposes only, kills the plugin and resets it with
          // the newly selected effect
          $('#effect-list').on('click', '.effect', function (ev) {
            var $effect = $(this)
              , fx = $effect.data('fx')
              , extraOptions = effectOptions[fx];

            $effects.removeClass('current');
            $effect.addClass('current');
            switchIndicator(null, null, 0, 0);
            $box
              .boxSlider('destroy')
              .boxSlider($.extend({effect: fx}, defaultOptions, extraOptions));
            startTimeIndicator();

            ev.preventDefault();
          });
        };
		  });
		  
		  
		  
$(document).ready(function() {
    
  $(document).on('change', ".city_check", function () {
    $(".city_check").prop("checked", false);
    $(this).prop("checked", true);
  });
  $(document).on('change', ".subject_check", function () {
    $(".subject_check").prop("checked", false);
    $(this).prop("checked", true);
  });
  
});
		</script>
		
