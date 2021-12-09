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
if(isset($_GET['lan'])){
   $_SESSION['lang_code']= $_GET['lan'];
}else{
   if(!isset($_SESSION['lang_code'])) $_SESSION['lang_code'] = $defaultLang;
}

//fadhli - get subfolder url (my)
$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
if($getLan == "/my/"){	
	$_SESSION['lang_code']= "BM";
	$seoPageTitle = "Tutorkami : Cari Guru Tuisyen, Cikgu Tuisyen di Rumah, Malaysia";
	$seoPageDescription = "Dapatkan guru tuisyen di rumah yang berkualiti untuk anak anda. Lebih 1,000 pilihan cikgu tuisyen untuk anda, bermula dari RM45 / jam.";
	$seoPageKeywords = "tutor rumah, tuisyen rumah, belajar di rumah, tutor swasta, guru swasta, guru tuisyen";
	$LangURL = "";
}else{
	$_SESSION['lang_code']= "en";
	$seoPageTitle = "Search for Private Tutor, Home Tuition & Tuisyen in Malaysia";
	$seoPageDescription = "Tutorkami is Malaysia's trusted and affordable private tutor & home tuition site";
	$seoPageKeywords = "home tutor, home tuition, home tuisyen, tuisyen rumah, homeschool, private tutor, private teacher, guru tuisyen";
	$LangURL = "";
}

// Resources
$resArr = system::FireCurl(GET_RESOURCES_URL.'?lang_code='.$_SESSION['lang_code']);
if($resArr->flag == 'success') {
   foreach ($resArr->data as $value) {      
      define($value->rm_target_res, $value->rmt_resourcevalue);
   }  
}

$getFullURL = $_SERVER['PHP_SELF'];
$arrayFullURL = explode('/',$getFullURL);
$lastPartURL = end($arrayFullURL);
?>