<style>

.circle2 {
  position: relative;
  width: 50%;
  height: 0;
  padding: 50% 0 0;
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
</style>

	<link href='css-pricing/rotating-card/rotating-card-seo.css' rel='stylesheet' />
	<link rel="stylesheet" type="text/css" href="css-pricing/adaptor/css/custom.css" />
<?php 

require_once('includes/head.php');

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

      <!-- Autocomplete -->
      <link rel="stylesheet" href="css/jquery-ui.css">
      <link rel="stylesheet" href="css/flush.css">
      <link rel="stylesheet" href="css/custom.css">
      <link rel="stylesheet" type="text/css" href="css/component.css" />
      
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></style>
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-42467282-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-42467282-1');
</script>


      <script src="js/jquery.min.js"></script> 
      <script src="js/bootstrap.min.js"></script> 
<style>
/* https://www.cssscript.com/custom-checkbox-radio-inputs-pure-css/ */
.checkbox,
.radio {
  display: inline-block;
  }
  .checkbox:hover,
  .radio:hover {
    cursor: pointer; }
  .checkbox .fa,
  .radio .fa {
    }

.checkbox input[type="checkbox"],
.radio input[type="radio"] {
  display: none; }
  .checkbox input[type="checkbox"] + i:before,
  .radio input[type="radio"] + i:before {
    content: "\f096";
    position: relative;
    color: #999; }

.checkbox:hover input[type="checkbox"] + i:before,
.radio:hover input[type="radio"] + i:before {
  color: #f85c2c; }

.checkbox input[type="checkbox"]:checked + i:before,
.radio input[type="radio"]:checked + i:before {
  content: "\f046";
  color: #f85c2c; }

.checkbox input[type="checkbox"]:disabled + i:before,
.checkbox input[type="checkbox"]:disabled:checked + i:before,
.radio input[type="radio"]:disabled + i:before,
.radio input[type="radio"]:disabled:checked + i:before {
  color: #ddd; }

/*RADIO*/
.radio input[type="radio"] + i:before {
  content: "\f1db"; }

.radio input[type="radio"]:checked + i:before {
  content: "\f058"; }

/* CHECKBOX&RADIO XS*/
.checkbox-xs input[type="checkbox"] + i:before,
.radio-xs input[type="radio"] + i:before {
  bottom: 0; }

</style>
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

.stay-open {display:block !important;}

.custom-nav{
    border: none;
    border-radius: 0;
    -webkit-box-shadow: 10px 20px 20px rgba(0, 0, 0, 0.3);  
    -moz-box-shadow:    20px 20px 20px rgba(0, 0, 0, 0.3);  
    box-shadow:         20px 20px 20px rgba(0, 0, 0, 0.3);  
    z-index:999;
}
</style>
    

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

</style>

<?php 

$thisUserID = $_SESSION['auth']['user_id'];

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
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


if($_SESSION['lang_code']=='en' || $_SESSION['lang_code']==''){
						?>
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

                        </li>
						<?php	
	
}
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
                              <li class="sizedcreenli"><a href="my-classes.php" class="language"><?php echo LIST_OF_CLASSES; ?></a></li>
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


  


<!-- ***** END HEADER ***** -->

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">


<section class="search_tutor myform">

   <div class="main-body">

      <div class="container">


         <div class="col-md-12">

            <div class="job-table" style="margin-top:0px;">
                
            <button id="btnPage" type="button" class="hidden btn btn-primary" data-toggle="modal" data-target="#tempModalPage"></button>
            <div class="modal fade" id="tempModalPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    
                  <div class="hidden modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                  <div class="modal-body" id="tempModalPageBody" ></div>
                  <div class="hidden modal-footer" id="tempModalExampleFooter"></div>
                  
                </div>
              </div>
            </div>
            


            <div id="successmsj" class="hidden">
                <br><br><br><br>
                <div class="alert alert-success" role="alert">
                  <center>Thank you. We will process your submission</center>
                </div>  
                <br><br><br><br>
                <br><br><br><br>  
            </div>

                <div class="container" id="contentData">



                <center style="font-size:20px;" >Please tick the tutor that you have chosen</center><br>
                
                <button id="btnHide" type="button" class="btn btn-primary hidden" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button></button>
                
                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                
                      <div class="modal-body" style="background-color:#f3f3f5;">
                            <button style="color:red;" type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <iframe id="iFrameName" width="100%" height="100%" frameborder="0" allowtransparency="true"></iframe>  
                      </div>
                      
                    </div>
                  </div>
                </div>

                <?PHP
                /*
                $no = 1;
                $ListOfTutor = " SELECT user_job_id, user_id FROM tk_shortlisted WHERE user_job_id = '".$_GET["id"]."'    ";
                $resultListOfTutor = $conn->query($ListOfTutor);
                if ($resultListOfTutor->num_rows > 0) {
                    while($rowListOfTutor = $resultListOfTutor->fetch_assoc()){
                        
                    $Details = " SELECT u_id, resit_pv_name, u_displayname, u_profile_pic, u_gender, u_displayid FROM tk_user WHERE u_id = '".$rowListOfTutor["user_id"]."'    ";
                    $resultDetails = $conn->query($Details);
                    if ($resultDetails->num_rows > 0) {
                        $rowDetails = $resultDetails->fetch_assoc();
                        if ($rowDetails['u_profile_pic'] != '') {
                            $pix = sprintf("%'.07d", $rowDetails['u_profile_pic']);
                            $pixAll = $pix.'_0.jpg';
                            if ( is_numeric($rowDetails['u_profile_pic']) ) {
                                $picProfile = "https://www.tutorkami.com/images/profile/".$pixAll;
                            }else{
                                $picProfile =  "https://www.tutorkami.com/images/profile/".$rowDetails['u_profile_pic'].".jpg";
                            }
                        } elseif ($rowDetails['u_gender'] == 'M') {
                            $picProfile =  "https://www.tutorkami.com/images/tutor_ma.png";
                        } else {
                            $picProfile =  "https://www.tutorkami.com/images/tutor_mi1.png";
                        }
                        
                        if( $rowDetails["resit_pv_name"] != '' ){
                            $disName = $rowDetails["resit_pv_name"];
                        }else{
                            $disName - $rowDetails["u_displayname"];
                        }
                        
                        $disID = $rowDetails["u_displayid"];
                    }
                        
                        ?>
                          <div class="panel panel-default">
                            <div class="panel-body">
                                  <div class="col-sm-1">
                                        </br><?PHP echo $no; ?>.
                                  </div>
                                  <div class="col-sm-2">
                                        <center> <div class="circle2"><img alt="avatar" src="<?PHP echo $picProfile; ?>" /></div> </center>
                                  </div>
                                  <div class="col-sm-5">
                                      <a style="cursor: pointer;" onClick="showModal('<?PHP echo $disID; ?>')"> <br><?PHP echo ucwords($disName); ?> </a> 
                                  </div>
                                  <div class="col-sm-4">
                                      <br>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios"><i class="fa fa-2x icon-radio"></i>
                                            </label>
                                        </div>
                                  </div>
                            </div>
                          </div>                        
                        <?PHP
                    $no++;
                    }
                }*/
                ?>
                




                                    <table id="example" class="table" style="width:50%;background-color: coral;">
                                        <tbody>
                                                    <?PHP
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // https://www.tutorkami.com/listoftutor?/8566
preg_match("/[^\/]+$/", $actual_link, $matches);
$last_word = $matches[0]; 


                                                    $no = 1;
                                                    $ListOfTutor = " SELECT user_job_id, user_id FROM tk_shortlisted WHERE user_job_id = '".$last_word."'    ";
                                                    $resultListOfTutor = $conn->query($ListOfTutor);
                                                    if ($resultListOfTutor->num_rows > 0) {
                                                        while($rowListOfTutor = $resultListOfTutor->fetch_assoc()){
                                                            
                                                        $Details = " SELECT u_id, resit_pv_name, u_displayname, u_profile_pic, u_gender, u_displayid FROM tk_user WHERE u_id = '".$rowListOfTutor["user_id"]."'    ";
                                                        $resultDetails = $conn->query($Details);
                                                        if ($resultDetails->num_rows > 0) {
                                                            $rowDetails = $resultDetails->fetch_assoc();
                                                            if ($rowDetails['u_profile_pic'] != '') {
                                                                $pix = sprintf("%'.07d", $rowDetails['u_profile_pic']);
                                                                $pixAll = $pix.'_0.jpg';
                                                                if ( is_numeric($rowDetails['u_profile_pic']) ) {
                                                                    $picProfile = "https://www.tutorkami.com/images/profile/".$pixAll;
                                                                }else{
                                                                    $picProfile =  "https://www.tutorkami.com/images/profile/".$rowDetails['u_profile_pic'].".jpg";
                                                                }
                                                            } elseif ($rowDetails['u_gender'] == 'M') {
                                                                $picProfile =  "https://www.tutorkami.com/images/tutor_ma.png";
                                                            } else {
                                                                $picProfile =  "https://www.tutorkami.com/images/tutor_mi1.png";
                                                            }
                                                            
                                                            if( $rowDetails["resit_pv_name"] != '' ){
                                                                $disName = $rowDetails["resit_pv_name"];
                                                            }else{
                                                                $disName - $rowDetails["u_displayname"];
                                                            }
                                                            
                                                            $disID = $rowDetails["u_displayid"];
                                                        }
                                                            
                                                            ?>
                                                                <tr style="width:100%;background-color: #f3f3f5;">
                                                                    <td> <center><?PHP echo $no; ?>. </center></td>
                                                                    <td> <center><img style="border-radius: 50%;  width: 100px;height: 100px;" alt="avatar" src="<?PHP echo $picProfile; ?>" /></center> </td>
                                                                    <td> <center><a style="cursor: pointer;" onClick="showModal('<?PHP echo $disID; ?>')"> <br><?PHP echo ucwords($disName); echo $disID; ?> </a></center> </td>
                                                                    <td><center> 
                                                                        <div class="radio" style="margin-top:25px;">
                                                                            <label>
                                                                                <input class="aaaa" onclick='handleSetup(this.value);' type="radio" name="optionsRadios" id="optionsRadios" value="<?PHP echo $disID; ?>"  ><i class="fa fa-2x icon-radio"></i>
                                                                            </label>
                                                                        </div>
                                                                    </center></td>
                                                                </tr>                      
                                                            <?PHP
                                                        $no++;
                                                        }
                                                    }
                                                    ?>
                                    
                                        </tbody>
                                    </table>   

<input type="hidden" id="last_word" value="<?PHP echo $last_word; ?>"   >
<input type="hidden" name="optionsRadioshide" id="optionsRadioshide"   >
<center>
                                        <div class="radio">
                                            <label>
                                                <input onclick='handleSetup(this.value);' type="radio" name="optionsRadios" id="optionsRadios" value="Undecided"><i class="fa fa-2x icon-radio">
                                                    <font style="font-size:18px;" >I have not decided which tutor yet </font> 
                                                </i>
                                            </label>
                                        </div>  
                                        <br>
                                        <div class="radio">
                                            <label>
                                                <input onclick='handleSetup(this.value);' type="radio" name="optionsRadios" id="optionsRadios" value="None"><i class="fa fa-2x icon-radio">
                                                    <font style="font-size:18px;" >None of these tutor I think is suitable </font>
                                                </i>
                                            </label>
                                        </div>   
                                        <br><br>
                                        <button type="button" class="btn btn-oren btn-md btnSubmit" onclick="submitForm()"> Submit </button>
                                        <button type="button" disabled class="hidden btn btn-oren btn-md btnLoad" style="margin-top:-20px;"><i class="fa fa-refresh fa-spin"></i> Loading ..</button>
                                        </center>

</center>


                  
                </div>

            </div>

         </div>         

      </div>

   </div>

</section>



<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>


<script>
function handleSetup(val) {
    if( document.getElementById('optionsRadioshide').value == val){
        document.getElementById('optionsRadioshide').value = val;
         $(".aaaa").prop("checked", false);
        document.getElementById('optionsRadioshide').value = '';

    }else{
        document.getElementById('optionsRadioshide').value = val;
    }
}

function showModal(id){
    //alert(id);
    document.getElementById('btnHide').click();
    document.getElementById('iFrameName').src = 'https://www.tutorkami.com/listoftutorload?did='+id;
}

function proceedMore(val){
    var last_word = document.getElementById('last_word').value;
    var checkedValue = $('#optionsRadios:checked').val();
    $.ajax({
        url: "ajax-all.php",
        method: "POST",
        data: {action: 'listoftutor', last_word: last_word, checkedValue: checkedValue, val: val}, 
        success: function(result){
            var stringA = result.split("-")[0].trim();
            var stringB = result.split("-")[1].trim();
            //alert(stringA + ' ' + stringB);
            if( stringA == 'Success' ){
                
                document.getElementById("tempModalPageBody").innerHTML = '';
                document.getElementById("tempModalPageBody").innerHTML = ' <input type="hidden" id="tempModalPage" value="" /> ' +
                ' <center> '+ stringB +' </center><br><br> ' +
                ' <center> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> </center> ';
                setTimeout(function () { $('#btnPage').click(); }, 1000);
                
            }else{
                alert(stringB);
            }
        }
    });
}

function submitForm(){
    var last_word = document.getElementById('last_word').value;
    var checkedValue = $('#optionsRadios:checked').val();

    if(checkedValue == null){
        alert('Please select an option above');
    }else{
        if( last_word == '' ){
            alert('Error : Code 7887');
        }else{
            if( checkedValue == 'Undecided' || checkedValue == 'None' ){
                document.getElementById("tempModalPageBody").innerHTML = ' <input type="hidden" id="tempModalPage" value="" /> ' +
                ' <center> Do you want us to search for more/other available tutors? </center><br><br> ' +
                ' <center> <button onclick="proceedMore(\'Yes\')" type="button" class="btn btn-oren" data-dismiss="modal">Yes</button> &nbsp;&nbsp; <button onclick="proceedMore(\'No\')" type="button" class="btn btn-secondary" data-dismiss="modal">No</button> </center> ';
                $('#btnPage').click();
            }else{
                $.ajax({
                    url: "ajax-all.php",
                    method: "POST",
                    data: {action: 'listoftutor', last_word: last_word, checkedValue: checkedValue}, 
                    success: function(result){
                        if( result == 'Success' ){
                            document.getElementById("contentData").classList.add("hidden");
                            document.getElementById("successmsj").classList.remove("hidden");                              
                        }else{
                            alert(result);
                        }
                    }
                });                
            }
        }
    }
}

$(document).ready(function(){
});
</script>
<?php include('includes/footer-new.php');?>

<script>
$(document).ready(function() {
    $('#example').dataTable( {
        searching: false, paging: false, info: false,
    } );
} );
</script>
