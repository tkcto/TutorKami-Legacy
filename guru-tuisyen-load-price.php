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

	<?php $seoArr = system::FireCurl(GET_SEO_CONTENT_URL.'?current_page='.basename($_SERVER['PHP_SELF']).'&lang_code='.$_SESSION['lang_code']); ?>

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!--<link href="css-pricing/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="css-pricing/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />-->

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


#example1 {
  padding: 50px;
  border-radius: 25px;
}
      </style>

</head>

<body>

		<div class="image-container set-full-height">
	    

		<!--   Big container   -->
		<div class="container" style="margin-top:0px;">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container" >
		                <div class="card wizard-card" data-color="red" id="wizardProfile">
		                    <form action="" method="">
		                    <!-- You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue" -->
<br/>
		                    	<div class="wizard-header">
		                        	<h2 class="wizard-title" id="search-term">
		                        	   <font color="#14114e"><strong>DAPATKAN HARGA KHIDMAT TUTOR DI LOKASI ANDA</strong></font>
		                        	</h2>
									<!--<h5>This information will let you know more about price.</h5>-->
		                    	</div><br/>
								<div class="wizard-navigation">
									<ul>
			                            <li class="hidden"><a href="#about" data-toggle="tab"></a></li>
			                            <li class="hidden"><a href="#address" data-toggle="tab"></a></li>
			                        </ul>
								</div>

		                        <div class="tab-content" id="example1">
		                            <div class="tab-pane" id="about">
		                              <div class="row">
		                                	<h4 class="info-text"></h4>
		                                	<div class="col-sm-12">
		                                    	<div class="form-group label-floating">
		                                        	<p class="control-label" style="text-align: left;">Tahap <small>(required)</small></p>
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
		                                        	<p class="control-label" style="text-align: left;">Lokasi Anda <small>(required)</small></p>	
		                                        	
	                                            		<div class="input-group ui-widget" style="">
                											 <span class="input-group-addon customInput" style="padding-left:10px;"><i class="glyphicon glyphicon-map-marker"></i></span>
                											 <input type="text" id="selectState" name="selectState" class="my_form_control ui-autocomplete-input customInput" placeholder="Your location" />
	                                               		</div>
		                                        	
		                                        	
	                                        		<!--<select class="form-control" id="selectState" name="selectState">
														<option disabled="" selected=""></option>
														<?PHP
														/*if($rowState > 0){
															while ($resultState = $queryState->fetch_assoc()) {
																?><option value="<?PHP echo $resultState['st_id']; ?>"> <?PHP echo $resultState['st_name']; ?> </option><?PHP
															}
														}*/
														?>
		                                        	</select>-->
		                                    	</div>
												<!--<div class="form-group label-floating">
		                                        	<div id="chgLabel"><label class="control-label">Cities <small>(Select State First)</small></label></div>
	                                        		<div id="chgLabel2"></div>
	                                        		<select class="form-control" id="selectCities" name="selectCities">
														<option disabled="" selected=""></option>
		                                        	</select>
		                                    	</div>-->
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
	                        	<br/>
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

	<script src="css-pricing/assets/js/material-bootstrap-wizard.js"></script>

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
	//alert(level + " - " + state + " - " + city + " - " + person);
	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	if (isMobile) {
		if(level != '' && state != '' && person != ''){
			$.ajax({
                type:'POST',
                url:'pricing-ajax-mobile.php',
                data:{level: level, state: state, person: person},
                beforeSend: function() {
					$('#demo').html("Loding ... ");
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
                url:'pricing-ajax-desktop.php',
                data:{level: level, state: state, person: person},
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
  border: 1px solid transparent;
  background-color: #d4d4d4;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #d4d4d4;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
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

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #d4d4d4; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: #d4d4d4; 
  color: #d4d4d4; 
}
</style>
