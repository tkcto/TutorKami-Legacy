<?php
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
$queryLevel = $conn->query("SELECT tc_id, tc_title FROM tk_tution_course ORDER BY tc_id ASC");
$rowLevel = $queryLevel->num_rows;

$queryState = $conn->query("SELECT st_id, st_name FROM tk_states ORDER BY st_name ASC");
$rowState = $queryState->num_rows;

?> 
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

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

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files 
	<link href="css-pricing/assets/css/bootstrap-clean.css" rel="stylesheet" />
	<link href="css/bootstrap.min.css" rel="stylesheet">-->
	<link href="css-pricing/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="css-pricing/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project 
	<link href="css-pricing/assets/css/demo.css" rel="stylesheet" />-->
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-535HD3P');</script>
	<!-- End Google Tag Manager -->
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
      <div class="loaderBackground" id="hider"></div>
      <div class="loaderpop" id="loadermodaldiv">
         <h4><img src="images/loader.gif" style="width: 50px;" />Loading...</h4>
      </div>


    <nav class="navbar navbar-default navbar-fixed-top" style='background-color:white;min-height:80px;'>
      <div class="container">
        <div class="col-md-3">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="tutorkami logo" style="padding-left:15px;"/></a>

        </div>
        </div>
    <div class="hidden-md hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:30px;margin-right:0px;height:40px;" type="button" class="btn btn-success navbar-sm"><font style="margin-left:-15px;margin-right:-15px;">GET A TUTOR 1</font></a>
  	</div>
    <div class="hidden-lg hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:30px;margin-right:0px;" type="button" class="btn btn-success navbar-sm"><font style="margin-left:-15px;margin-right:-15px;">GET A TUTOR 2</font></a>
  	</div>
<div class="col-md-3">
	<div class="hidden-lg hidden-md hidden-xs pull-right">
      <a href="request_a_tutor.php" style="margin-top:30px;margin-left:10px;" type="button" class="btn btn-success navbar-sm"><font style="margin-left:-15px;margin-right:-15px;">GET A TUTOR 3</font></a>
  	</div>
    <div class="hidden-lg hidden-md hidden-sm pull-right">
      <a href="request_a_tutor.php" style="margin-top:-40px;margin-right:60px;" type="button" class="btn btn-success navbar-xs"><font style="margin-left:-15px;margin-right:-15px;">GET A TUTOR 4</font></a>
  	</div>
</div>

        <div id="navbar" class="navbar-collapse collapse" >
          <ul class="nav navbar-nav navbar-right off_dropd">
            <li class="dropdown" style="padding-top:30px;">
              <a style="background-color: transparent;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><font color="black" size="4">Home <span class="caret"></span></font></a>
              <ul class="dropdown-menu">
                <li><a href="https://www.tutorkami.com/index">Home Page</a></li>
                <li><a href="https://www.tutorkami.com/about">About Us</a></li>
              </ul>
            </li>
            <li class="dropdown" style="padding-top:30px;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><font color="black" size="3">Parents  <span class="caret"></span></font></a>
              <ul class="dropdown-menu">
                <li><a href="https://www.tutorkami.com/search_tutor">Search Tutor</a></li>
                <li><a href="https://www.tutorkami.com/parent_faq">FAQs</a></li>
                <li><a href="https://www.tutorkami.com/request_a_tutor?tutor_id=i3be8gz">Contact Us</a></li>
              </ul>
            </li>
            <li class="dropdown" style="padding-top:30px;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><font color="black" size="3">I'm a Tutor  <span class="caret"></span></font></a>
              <ul class="dropdown-menu">
                <li><a href="https://www.tutorkami.com/tutor.php">Tutor’s Page</a></li>
                <li><a href="https://www.tutorkami.com/search_job.php">Latest Jobs</a></li>
                <li><a href="https://www.tutorkami.com/register.php">Register</a></li>
                <li><a href="https://www.tutorkami.com/tutor_faq.php">FAQs</a></li>
                <li><a href="https://www.tutorkami.com/login.php">Log In</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
		<div class="image-container set-full-height" style="background-image: url('https://www.tutorkami.com/images/Slider1920x1000.jpg')">
	    

		<!--   Big container   -->
		<div class="container" style="margin-top:0px;">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizardProfile">
		                    <form action="" method="">
		                    <!-- You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue" -->

		                    	<div class="wizard-header">
		                        	<h2 class="wizard-title" id="search-term">
		                        	   Pricing
		                        	</h2>
									<!--<h5>This information will let you know more about price.</h5>-->
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#about" data-toggle="tab">Area / Level</a></li>
			                            <!--<li><a href="#account" data-toggle="tab">Account</a></li>-->
			                            <li><a href="#address" data-toggle="tab">Price</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
		                              <div class="row">
		                                	<h4 class="info-text"> Let's start with the basic details.</h4>
		                                	<div class="col-sm-12">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">Level <small>(required)</small></label>
	                                        		<select class="form-control" id="selectthisLevel" name="selectthisLevel">
														<option disabled="" selected=""></option>
														<?PHP
														if($rowLevel > 0){
															while ($resultLevel = $queryLevel->fetch_assoc()) {
																?><option value="<?PHP echo $resultLevel['tc_id']; ?>"> <?PHP echo $resultLevel['tc_title']; ?> </option><?PHP
															}
														}
														?>
		                                        	</select>
		                                    	</div>
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">State <small>(required)</small></label>
	                                        		<select class="form-control" id="selectState" name="selectState">
														<option disabled="" selected=""></option>
														<?PHP
														if($rowState > 0){
															while ($resultState = $queryState->fetch_assoc()) {
																?><option value="<?PHP echo $resultState['st_id']; ?>"> <?PHP echo $resultState['st_name']; ?> </option><?PHP
															}
														}
														?>
		                                        	</select>
		                                    	</div>
												<div class="form-group label-floating">
		                                        	<div id="chgLabel"><label class="control-label">Cities <small>(Select State First)</small></label></div>
	                                        		<div id="chgLabel2"></div>
	                                        		<select class="form-control" id="selectCities" name="selectCities">
														<option disabled="" selected=""></option>
		                                        	</select>
		                                    	</div>
												<div class="form-group label-floating">
		                                        	<label class="control-label">Person</label>
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
		                                <div class="row">
		                                    <!--<h4 class="info-text"> Description.</h4>-->
										<p id="demo"></p>
		                                </div>
		                            </div>
		                        </div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' onClick="myFunction()"/>
	                                    <input type='button' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Home' onClick="closeWindow()" />
	                                </div>
	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
	                                </div>
	                                <div class="clearfix"></div>
	                        	</div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div><!-- end row -->
	    </div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	             
	        </div>
	    </div>
	</div>

</body>
	<!--   Core JS Files   -->
    <script src="css-pricing/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="css-pricing/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="css-pricing/assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="css-pricing/assets/js/material-bootstrap-wizard.js"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="css-pricing/assets/js/jquery.validate.min.js"></script>

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
	var city   = document.getElementById("selectCities").value; 
	var person = document.getElementById("selectPerson").value; 
	//alert(level + " - " + state + " - " + city + " - " + person);
	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	if (isMobile) {
		if(level != '' && state != '' && city != '' && person != ''){
			$.ajax({
                type:'POST',
                url:'pricing-ajax-mobile.php',
                data:{level: level, state: state, city: city, person: person},
                beforeSend: function() {
					$('#demo').html("Loding ... ");
                },
                success:function(result){
					$('#demo').html(result);
                }
			});
		}
	}else{
		if(level != '' && state != '' && city != '' && person != ''){
			$.ajax({
                type:'POST',
                url:'pricing-ajax-desktop.php',
                data:{level: level, state: state, city: city, person: person},
                beforeSend: function() {
					$('#demo').html("Loding ... ");
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
