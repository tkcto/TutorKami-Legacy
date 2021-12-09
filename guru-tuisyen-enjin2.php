<?php 
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

$_SESSION['lang_code'] = 'BM';
$resArr = system::FireCurl(GET_RESOURCES_URL.'?lang_code='.$_SESSION['lang_code']);
if($resArr->flag == 'success') {
   foreach ($resArr->data as $value) {      
      define($value->rm_target_res, $value->rmt_resourcevalue);
   }  
}


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
            //$sum = $num1 + $num2;
            //return "Sum of the two numbers is : $sum";
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
				//$currentData = str_replace("-"," ",$whatIWant);
				$getLevel = addFunction($whatIWant);
				if( $getLevel != 'NULL'){
					$currentData .= $getLevel.' *';
				}else{
					//$currentData .= sqlFunction(str_replace("-"," ",$whatIWant)).' *';
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
					//$currentData .= sqlFunction(str_replace("-"," ",$Before)).' *';
					$currentData .= (str_replace("-"," ",$Before)).' *';
				}
					
				// string after /
				$arrAfter = explode('/', $whatIWant);
				$After = $arrAfter[1];
				
				$getLevel2 = addFunction($After);
				if( $getLevel2 != 'NULL'){
					$currentData .= $getLevel2.' *';
				}else{
					//$currentData .= sqlFunction(str_replace("-"," ",$After)).' *';
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
					//$currentData .= sqlFunction(str_replace("-"," ",$Before)).' *';
					$currentData .= (str_replace("-"," ",$Before)).' *';
				}
					
				//substring-between-two-strings
				$getBetween = get_string_between($whatIWant, '/', '/');
				$getLevel2 = addFunction($getBetween);
				if( $getLevel2 != 'NULL'){
					$currentData .= $getLevel2.' *';
				}else{
					//$currentData .= sqlFunction(str_replace("-"," ",$getBetween)).' *';
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
					//$currentData .= sqlFunction(str_replace("-"," ",$getLast)).' *';
					$replace2 = str_replace("-"," ",$getLast);
					$replace2 = str_replace(","," *",$replace2);
					$currentData .= $replace2.' *';
				}	

				
			}else if (substr_count($whatIWant, "/") == 3){
/*********/
				// string before /
				$arrBefore = explode("/", $whatIWant, 2);
				$Before = $arrBefore[0];
				$getLevel = addFunction($Before);
				if( $getLevel != 'NULL'){
					$currentData .= $getLevel.' *';
				}else{
					//$currentData .= sqlFunction(str_replace("-"," ",$Before)).' *';
					$currentData .= (str_replace("-"," ",$Before)).' *';
				}
					
				//substring-between-two-strings
				$getBetween = get_string_between($whatIWant, '/', '/');
				$getLevel2 = addFunction($getBetween);
				if( $getLevel2 != 'NULL'){
					$currentData .= $getLevel2.' *';
				}else{
					//$currentData .= sqlFunction(str_replace("-"," ",$getBetween)).' *';
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
					//$currentData .= sqlFunction(str_replace("-"," ",$getLast)).' *';
					$replace2 = str_replace("-"," ",$getLast);
					$replace2 = str_replace(","," *",$replace2);
					$currentData .= $replace2.' *';
				}



			}else{
				
			}
	
				/*
			if (substr_count($whatIWant, "/") == 1){

				$urlLvl = explode('/',trim($whatIWant));
				$currentLevel = str_replace("-"," ",$urlLvl[0]);
				if( $currentLevel == "Pre School" ){
					$currentLevelThis = "Pre-School";
				}else if( $currentLevel == "Tahap 1 (Tahun 1 3)" ){
					$currentLevelThis = "Tahap 1 (Tahun 1-3)";
				}else if( $currentLevel == "Form 1 3 (PT3)" ){
					$currentLevelThis = "Form 1-3 (PT3)";
				}else if( $currentLevel == "Form 4 5 (SPM)" ){
					$currentLevelThis = "Form 4-5 (SPM)";
				}else if( $currentLevel == "Year 10 11 (IGCSE)" ){
					$currentLevelThis = "Year 10-11 (IGCSE)";
				}else if( $currentLevel == "Others_Lain lain" ){
					$currentLevelThis = "9";
				}else{
					$currentLevelThis = str_replace("-"," ",$urlLvl[1]);
				}		
				$urlArea = substr($whatIWant, strrpos($whatIWant, '/') + 1);  // Bekok
				$urlArea = str_replace("-"," ",$urlArea);		

			}else{
				
				$urlSub = explode('/',trim($whatIWant));  // English
				$urlSub = str_replace("-"," ",$urlSub[0]);

				preg_match('~/(.*?)/~', $whatIWant, $urlLvl);  // Pre_School
				$currentLevel = str_replace("-"," ",$urlLvl[1]);
				if( $currentLevel == "Pre School" ){
					$currentLevelThis = "Pre-School";
				}else if( $currentLevel == "Tahap 1 (Tahun 1 3)" ){
					$currentLevelThis = "Tahap 1 (Tahun 1-3)";
				}else if( $currentLevel == "Form 1 3 (PT3)" ){
					$currentLevelThis = "Form 1-3 (PT3)";
				}else if( $currentLevel == "Form 4 5 (SPM)" ){
					$currentLevelThis = "Form 4-5 (SPM)";
				}else if( $currentLevel == "Year 10 11 (IGCSE)" ){
					$currentLevelThis = "Year 10-11 (IGCSE)";
				}else if( $currentLevel == "Others_Lain lain" ){
					$currentLevelThis = "9";
				}else{
					$currentLevelThis = str_replace("-"," ",$urlLvl[1]);
				}		
				$urlArea = substr($whatIWant, strrpos($whatIWant, '/') + 1);  // Bekok
				$urlArea = str_replace("-"," ",$urlArea);		
			}
			*/

}
$currentData2 = $currentData; 
$currentData = (explode(" *", $currentData)); 
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
	  
<?PHP
// SEO
if( strpos($actual_link, '?/') !== false ){
	$seoSub = $urlSub;
	//$seoLevel = str_replace("-"," ",$currentLevel);
	if($currentLevelThis == "9"){
		$seoLevel = "Others / Lain-lain";
	}else{
		$seoLevel = $currentLevelThis;
	}
	$seoArea = $urlArea;

	$seoTitle = 'Tutor & Guru Tuisyen di Rumah untuk '.$seoSub.' '.$seoLevel.' di '.$seoArea.' & Sekitarnya';
	$seoDescription = 'Dapatkan cikgu home tuisyen '.$seoSub.' '.$seoLevel.' di '.$seoArea.' & sekitarnya dengan lebih mudah, selamat dan ada jaminan';

	$seoLevel2 = "Pre School, Tahun 1-3, UPSR, PT3, SPM ";
	$seoSubject2 = $seoSub.' ';
	$contentTitle = "tutor dan cikgu tuisyen di ";
	$seoArea2 = "Tutor Persendirian untuk Tuisyen di Rumah di ".$seoArea.' ';
	
}else{
	$seoTitle = 'Tutor & Guru Tuisyen di Rumah untuk English Matematik SPM UPSR di Malaysia & Sekitarnya';   
	$seoDescription = 'Dapatkan cikgu home tuisyen English Matematik Pre School, Tahun 1-3, UPSR, PT3, SPM di Malaysia & sekitarnya dengan lebih mudah, selamat dan ada jaminan'; 
	
	$seoLevel2 = "Pre School, Tahun 1-3, UPSR, PT3, SPM ";
	$seoSubject2 = "Bahasa melayu, bahasa inggeris ";
	$contentTitle = "tutor dan cikgu tuisyen di ";
	$seoArea2 = "Tutor Persendirian untuk Tuisyen di Rumah di Malaysia ";
	
}




?>
	  

	  <title><?PHP echo $seoTitle; ?></title>
	  <meta name="description" content="<?PHP echo $seoDescription; ?>" />
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
    border: 2px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    border: 2px;
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
		  <a style="margin-left:0.5px;" class="navbar-brand" href="index.php"><img src="images/<?php echo $logo->ss_settings_value;?>" class="img-responsive" alt=""/></a>
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
                        <li class="dropdown"><a href="https://www.tutorkami.com/my/index">Utama</a></li>						
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Ibu / Bapa <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/my/search_tutor">Cari Tutor</a></li>
								<li><a href="https://www.tutorkami.com/my/parent_faq">FAQs</a></li>
								<li><a href="https://www.tutorkami.com/my/request_a_tutor?tutor_id=i3be8gz">Hubungi Kami</a></li>
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

if($_SESSION['lang_code']=='en' || $_SESSION['lang_code']==''){
						?>
						<li class="dropdown"><a href="https://www.tutorkami.com/">Home</a></li>
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Parents <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="https://www.tutorkami.com/search_tutor">Search Tutor</a></li>
								<li><a href="https://www.tutorkami.com/parent_faq">FAQs</a></li>
								<li><a href="https://www.tutorkami.com/request_a_tutor?tutor_id=i3be8gz">Contact Us</a></li>						
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
                        </li>
						<?php	
	
}
                        ?>
						
                       <?php } else { ?>
                        <?php if($_SESSION['auth']['user_role'] == '4') { ?>
                        <li class="dropdown">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" href="" aria-haspopup="true" aria-expanded="false">
                           <?php echo WELCOME; ?> <?php echo ucfirst($_SESSION['auth']['first_name']); ?> <span class="caret"></span></a>
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

?>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">




<section class="search_tutor myform">

   <div class="main-body">
      <div class="container">
         <h1 class="text-center text-uppercase blue-txt"><?php echo SEARCH_TUTOR; ?></h1>
         <hr>
         <div class="col-md-offset-2 col-md-8">
          <div class="clearfix"></div>
		  
<?PHP
/*
 echo 'FADHLI';
 echo '<br/><br/><br/>';
 
 
 echo 'actual_link : '.$actual_link;
 
 echo '<br/>';
 echo 'whatIWant : '.$whatIWant;
 
 echo '<br/>';
 echo 'totalSlash : '.$totalSlash;
 
 echo '<br/>';
 //echo 'currentData : '.$currentData;
 
//explode(" ,", $currentData);
 print_r($currentData); 
 
 echo '<br/>';
 echo 'currentData1 : '.$currentData1;
 

if (substr_count($whatIWant, "/") == 2){
				//substring-between-two-strings
				$getBetween = get_string_between($whatIWant, '/', '/');
				echo $getBetween;
 echo '<br/>';
				echo str_replace("-"," ",$getBetween);
					
}
 
 echo '<br/>';
 echo 'currentData2 : '.$currentData2;
		

 echo '<br/>';
 echo 'db2 : '. implode(',', $currentData);
 
 echo '<br/>';
 */

 
?>
		  
		  
		  
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
                     <br><input type="button" name="submitBtn" class="btn btn-md search_btn" onclick="pretest()" value="<?php echo BUTTON_SEARCH_TUTOR; ?>">
                  </div>
               </div>
            </form>

         </div>	 

         <div class="col-md-12">
			<div class="job-table" style="margin-top:30px;">
				<div class="panel panel-default">
					<div class="panel-footer">
					
					<h3 class="text-primary text-left"><?PHP echo $seoTitle; ?></h3>
					<h4 class="text-left"><?PHP echo $seoDescription; ?></h4>
					<h4 class="text-left"><?PHP echo "Contact us today by clicking the 'Get a Tutor' button.";?></h4>
					
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

		if($("#state_drop").val() != "") {
			if(selectedState == 'Pilih%20Negeri'){
			}else{
				parameterArr.push("/" + selectedState);
			}
		}	
		if(selectedArea.length > 0) {
			parameterArr.push("/" + selectedArea.join(","));
		}
		if($("#level_drop").val() != "") {
			if(selectedLevel == 'Choose%20Subject'){
			}else if(selectedLevel == 'Others%20/%20Lain-lain'){
				parameterArr.push("/Others_Lain-lain");
			}else{
				parameterArr.push("/" + selectedLevel);
			}
		}
		if(selectedSubject.length > 0) {
			parameterArr.push("/" + selectedSubject.join(","));
		}	

				
				
		<?php
		$urlArr = explode("?", $_SERVER['REQUEST_URI']);
		$getUrl = $urlArr[0];
		?>
		/*var getUrl  = "<?php echo $getUrl; ?>?";
		var getUrl2 = getUrl + parameterArr.join("");
		var getUrl3 = getUrl2.replace(/%20/g, '-');

		$("#filter_user").prop("action", getUrl3);
		$("#filter_user").submit();*/
		
		var getUrl  = "https://www.tutorkami.com/guru-tuisyen?";
		var getUrl2 = getUrl + parameterArr.join("");
		var getUrl3 = getUrl2.replace(/%20/g, '-');
window.open(getUrl3, '_blank');
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
   
   


/*
function getState(str) {
	$.ajax({
		type: 'GET',
		url: 'store-session.php',
		data: {state:str},
		success: function(data){}
	});
}
function getGender(str) {
	$.ajax({
		type: 'GET',
		url: 'store-session.php',
		data: {gender:str},
		success: function(data){}
	});
}
function getOccupation(str) {
	$.ajax({
		type: 'GET',
		url: 'store-session.php',
		data: {occupation:str},
		success: function(data){}
	});
}
function getRace(str) {
	$.ajax({
		type: 'GET',
		url: 'store-session.php',
		data: {race:str},
		success: function(data){}
	});
}
*/
</script>












<script>
/*
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
      }else{
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




	  
   });


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
   
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}


function startSearch() {
	if(subjectPopulateDone && areaPopulateDone) {
		clearInterval(checkPopulation);
		//cariTutor();
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
				"processing" : true,
				"serverSide" : true,
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
  

*/
</script>
<?php include('includes/footer.php');?>