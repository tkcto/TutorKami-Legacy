<?php
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
$queryLevel = $conn->query("SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id !='9' ORDER BY tc_id ASC");
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
	<!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" type="text/css" rel="stylesheet" />-->

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
.navbar{
	min-height:80px;
}

.navbar-toggle {
    margin-top: 16px;
}

/* navbar */
.navbar-default {
    background-color: white;
    border-color: white;
}
/* Title */
.navbar-default .navbar-brand {
    color: white;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
    color: white;
}
/* Link */
.navbar-default .navbar-nav > li > a {
    color: white;
}
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus {
    color: white;
}
.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
    color: white;
    background-color: white;
}
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
    color: white;
    background-color: white;
}

.thicker {
  font-weight: 400;
}




/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
     .img-responsive {
       max-width: 60%;
       height: auto;
     }	
     .navbar-toggle {
		margin-right:-20px;
     }
} 
*/
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
     .img-responsive {
       max-width: 60%;
       height: auto;
     }	
} 

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
     .img-responsive {
       max-width: 100%;
       height: auto;
     }		
     .menuul {
       padding-top:30px;
     }	
} 

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
     .img-responsive {
       max-width: 100%;
       height: auto;
     }	
     .menuul {
       padding-top:30px;
     }		
} 

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
     .img-responsive {
       max-width: 100%;
       height: auto;
     }	
     .menuul {
       padding-top:30px;
     }	
}
</style>
</head>

<body>
    
		<div class="image-container set-full-height" style="background-image: url('https://www.tutorkami.com/images/Slider1920x1000.jpg')">
		
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
	  
        <div class="col-md-3">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="img-responsive" alt="tutorkami logo"/></a>
        </div>
        </div>

    <div class="hidden-md hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:30px;margin-right:0px;height:40px;" type="button" class="btn btn-success btn-md"><font style="margin-left:-15px;margin-right:-15px;">GET A TUTOR</font></a>
  	</div>
    <div class="hidden-lg hidden-sm hidden-xs pull-right" style="padding-left:15px;">
      <a href="request_a_tutor.php" style="margin-top:30px;margin-right:0px;" type="button" class="btn btn-success btn-md"><font style="margin-left:-15px;margin-right:-15px;">GET A TUTOR</font></a>
  	</div>
	<div class="hidden-lg hidden-md hidden-xs pull-right">
      <a href="request_a_tutor.php" style="margin-top:30px;margin-left:10px;" type="button" class="btn btn-success btn-md"><font style="margin-left:-15px;margin-right:-15px;">GET A TUTOR</font></a>
  	</div>
    <div class="hidden-lg hidden-md hidden-sm pull-right">
      <a href="request_a_tutor.php" style="margin-top:-45px;margin-right:50px;" type="button" class="btn btn-success btn-md"><font style="margin-left:-15px;margin-right:-15px;">GET A TUTOR</font></a>
  	</div>


        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown menuul">
				<a href="#" class="dropdown-toggle thicker" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><font color="#777" size="4">Home <span class="caret"></span></font></a>
				<ul class="dropdown-menu">
					<li><a href="https://www.tutorkami.com/index">Home Page</a></li>
					<li><a href="https://www.tutorkami.com/about">About Us</a></li>
				</ul>
            </li>
            <li class="dropdown menuul">
				<a href="#" class="dropdown-toggle thicker" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><font color="#777" size="4">Parents <span class="caret"></span></font></a>
				<ul class="dropdown-menu">
					<li><a href="https://www.tutorkami.com/search_tutor">Search Tutor</a></li>
					<li><a href="https://www.tutorkami.com/parent_faq">FAQs</a></li>
					<li><a href="https://www.tutorkami.com/request_a_tutor?tutor_id=i3be8gz">Contact Us</a></li>
				</ul>
            </li>
            <li class="dropdown menuul">
				<a href="#" class="dropdown-toggle thicker" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><font color="#777" size="4">I'm a Tutor <span class="caret"></span></font></a>
				<ul class="dropdown-menu">
					<li><a href="https://www.tutorkami.com/tutor.php">Tutor’s Page</a></li>
					<li><a href="https://www.tutorkami.com/search_job.php">Latest Jobs</a></li>
					<li><a href="https://www.tutorkami.com/register.php">Register</a></li>
					<li><a href="https://www.tutorkami.com/tutor_faq.php">FAQs</a></li>
					<li><a href="https://www.tutorkami.com/login.php">Log In</a></li>
				</ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	

<style>
.hover_bkgr_fricc{
    background:rgba(0,0,0,.4);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 100px;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5%;
}
/*
.popupCloseButton {
    background-color: #fff;
    border: 3px solid #999;
    border-radius: 50px;
    cursor: pointer;
    display: inline-block;
    font-family: arial;
    font-weight: bold;
    position: absolute;
    top: -20px;
    right: -20px;
    font-size: 25px;
    line-height: 30px;
    width: 30px;
    height: 30px;
    text-align: center;
}
.popupCloseButton:hover {
    background-color: #ccc;
}*/
.trigger_popup_fricc {
    cursor: pointer;
    font-size: 20px;
    margin: 20px;
    display: inline-block;
    font-weight: bold;
}

.h1Title{
  font-family: "Roboto", "Helvetica", "Arial", sans-serif;
  font-weight: 800;
  font-size: 1.825em;
  line-height: 1.4em;
  /*margin: 20px 0 10px;*/
  padding-left:50px;
  padding-right:50px;
}
</style>
    <!-- https://atomiks.github.io/tippyjs/ -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    
<div class="hover_bkgr_fricc">
    <span class="helper"></span>
    <div>
            <div class="form-group label-floating" style="text-align: left;">
                <label class="control-label">Your Location <small>(required)</small></label>
                <input style="color: black;" id="selectStateModal" name="selectStateModal" type="text" class="form-control my_form_control">
            </div>
          
            <!--<button type="button" class="btn btn-secondary popupCloseButton" data-dismiss="modal">Close</button>-->
            <button style="margin-top:10px;" type="button" class="btn btn-success" onClick="Procced()">Proceed</button>
    </div>
</div>
	
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
		                        	<h1 class="wizard-title h1Title" id="search-term">
		                        	   Price for private tutor service in your location or for online tuition
		                        	</h1>
									<!--<h5>This information will let you know more about price.</h5>-->
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#about" data-toggle="tab">DETAILS</a></li>
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
		                                    	<!--<div class="form-group label-floating">
		                                        	<p class="control-label" style="text-align: left;">Your Location <small>(required)</small></p>	
	                                            		<div class="input-group ui-widget" style="text-align: left;">
                											 <span class="input-group-addon customInput" style=""><i style="margin-top:-5px;" class="fa fa-map-marker fa-3x"></i></span>
                											 <input type="text" id="selectState" name="selectState" class="my_form_control ui-autocomplete-input customInput" placeholder="Your location" />
	                                               		</div>
		                                    	</div>-->

												<!--<div class="input-group">
													<span class="input-group-addon">
														<i style="margin-top:-5px;" class="fa fa-map-marker fa-2x"></i>
													</span>-->
													<div class="form-group label-floating">
			                                          	<label class="control-label">Your Location or type Online Tuition <small>(required)</small></label>
			                                          	<input id="selectState" name="selectState" type="text" class="form-control my_form_control">
			                                        </div>
												<!--</div>-->
		                                    	
		                                    	
		                                    	
		                                    	<!--<div class="form-group label-floating">
		                                        	<label class="control-label">State <small>(required)</small></label>
	                                        		<select class="form-control" id="selectState" name="selectState">
														<option disabled="" selected=""></option>
														<?PHP
														/*if($rowState > 0){
															while ($resultState = $queryState->fetch_assoc()) {
																?><option value="<?PHP echo $resultState['st_id']; ?>"> <?PHP echo $resultState['st_name']; ?> </option><?PHP
															}
														}*/
														?>
		                                        	</select>
		                                    	</div>
												<div class="form-group label-floating">
		                                        	<div id="chgLabel"><label class="control-label">Cities <small>(Select State First)</small></label></div>
	                                        		<div id="chgLabel2"></div>
	                                        		<select class="form-control" id="selectCities" name="selectCities">
														<option disabled="" selected=""></option>
		                                        	</select>
		                                    	</div>-->
												<div class="form-group label-floating">
		                                        	<label class="control-label">Number of Student</label>
	                                        		<select class="form-control" id="selectPerson" name="selectPerson">
	                                                	<option value="1"> 1 Student </option>
	                                                	<option value="2"> 2 Students </option>
	                                                	<option value="3"> 3 Students </option>
	                                                	<option value="4"> 4 Students </option>
	                                                	<option value="5"> 5 Students </option>
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
<script src="//code.tidio.co/xemvegnr9wqcfsvi5yswoogjelcyby2v.js" async></script>
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
	//var city   = document.getElementById("selectCities").value; 
	var person = document.getElementById("selectPerson").value; 
	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	/*if (isMobile) {
		if(level != '' && state != '' && person != ''){
			$.ajax({
                type:'POST',
                //url:'pricing-ajax-mobile.php',
                url:'price-load-mobile.php',
                data:{level: level, state: state, person: person},
                beforeSend: function() {
					$('#demo').html("Loading ... ");
                },
                success:function(result){
					$('#demo').html(result);
                }
			});
		}
	}else{*/
		if(level != '' && state != '' && person != ''){
			$.ajax({
                type:'POST',
                //url:'pricing-ajax-desktop.php',
                url:'price-load-desktop.php',
                data:{level: level, state: state, person: person},
                beforeSend: function() {
					$('#demo').html("Loading ... ");
                },
                success:function(result){
					$('#demo').html(result);
                }
			});    
		}
	//}
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
							echo "'Online Tuition',";
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
/*
input {
  padding: 10px;
  font-size: 16px;
  background-color: #ffffff; 
  
}

input[type=text] {
  width: 100%;
  background-color: #ffffff; 
  border-top: 2px solid  #e5e7e9 ;
  border-right: 2px solid  #e5e7e9 ;
  border-bottom: 2px solid  #e5e7e9 ;
}

input[type=submit] {
  cursor: pointer;
  background-color: #ffffff; 
}
*/
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
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  /*background-color: #d4d4d4; 
  color: #d4d4d4; */
  background-color: #ffffff; 
}
</style>
