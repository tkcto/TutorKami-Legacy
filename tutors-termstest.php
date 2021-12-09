<?php 
require_once('includes/head.php');

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

# SESSION CHECK #
if (!isset($_SESSION['auth'])) {
  header('Location: login.php');
  exit();
}

if ($_SESSION['auth']['user_role'] != '3') {
   header('Location:list_of_classes.php');
   exit();
}

$user_id = $_SESSION['auth']['user_id'];
$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);

include('includes/header.php');
$_SESSION['getPage'] = "Tutor Term";
unset($_SESSION["firstlogin"]);
date_default_timezone_set("Asia/Kuala_Lumpur");
?>

  <!-- <link rel="stylesheet" type="text/css" href="pdf/signature-pad-master/assets/jquery.signaturepad.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  
<style>
.btn-default {
    background: #DDDDDD;
}
/*
.btn-default {
    background: #f1592a;
    color: #ffffff;
    border-color: #f1592a;
}
 
.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
    background: #f1592a;
    color: #ffffff;
    border-color: #f1592a;
}
 
.btn-default:active, .btn-default.active {
    background: #f1592a;
    color: #ffffff;
}*/
/*
.btn-default {
    background: #F3F3F5; 
    color: #000000; 
    border-color: #F3F3F5;
}
 
.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
    background: #F3F3F5;
    color: #000000;
    border-color: #F3F3F5;
}
 
.btn-default:active, .btn-default.active {
    background: #F3F3F5;
    color: #000000;
}*/
.btn-oren { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren:hover, 
.btn-oren:focus, 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  color: #ffffff; 
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
  background-color: #ffffff; 
}

.btn-outline {
    background-color: transparent;
    color: inherit;
    transition: all .5s;
}

.btn-primary.btn-outline {
    color: #428bca;
}

.btn-success.btn-outline {
    color: #5cb85c;
}

.btn-info.btn-outline {
    color: #5bc0de;
}

.btn-warning.btn-outline {
    color: #f0ad4e;
}

.btn-danger.btn-outline {
    color: #d9534f;
}

.btn-primary.btn-outline:hover,
.btn-success.btn-outline:hover,
.btn-info.btn-outline:hover,
.btn-warning.btn-outline:hover,
.btn-danger.btn-outline:hover {
    color: #fff;
}
.notbold{
    font-weight:normal
}
</style>
							<style>
							@media (min-width: 768px ) {
								.bottom-align-text {
									margin-left:470px;
								}
							}
							@media (min-width: 1200px ) {
								.bottom-align-text {
									margin-left:670px;
								}
							}
							</style>
<?PHP
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
?>
<section class="profile">
 <div class="main-body">
    <div class="container">

       <h1 class="text-center text-uppercase blue-txt"><?php echo TUTORS_TERMS; ?></h1><hr>


<button id="no1" type="button" class="btn btn-primary" >Terms of Accepting Tuition Job</button>   
<?PHP
if($getLan == "/my/"){	
?>   
<a href="https://www.tutorkami.com/tutors-terms" type="button" class="btn btn-oren hidden-lg hidden-md hidden-sm" >BI</a>  
<?PHP
}else{
?>   
<a href="https://www.tutorkami.com/my/tutors-terms" type="button" class="btn btn-oren hidden-lg hidden-md hidden-sm" >BM</a>  
<?PHP
}
?>	
<button id="no2" type="button" class="btn btn-default" >Tutor Registration Terms</button>    
<?PHP
if($getLan == "/my/"){	
?>    
<a href="https://www.tutorkami.com/tutors-terms" type="button" class="btn btn-oren hidden-md hidden-sm hidden-xs" >BI</a>  
<?PHP
}else{
?>   
<a href="https://www.tutorkami.com/my/tutors-terms" type="button" class="btn btn-oren hidden-md hidden-sm hidden-xs" >BM</a> 
<?PHP
}
?>	
  
	<div id="content1" class="collapse in"><br/><br/>
  
		<a href="tutors-terms.php"     id="thisno1" type="button" class="btn btn-success btn-outline">Terms of Accepting 1-to-1 Tuition Job</a> 
		<a href="tutors-termstest.php" id="thisno2" type="button" class="btn btn-success btn-outline">Additional terms : Group Tuition</a>


			<input type="hidden" name="displayid" id="displayid" value="<?php echo $getUserDetails->data[0]->u_displayid; ?>">
			<div id="thiscontent1" class="collapse in">
			<form method="post" action="terms-of-accepting.php">
			<div class="sigPad">

					<div class="row">
		
						<div class="col-lg-12">
						<br/>
<?PHP
if($getLan == "/my/"){	
	$queryTCBM = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='77'");
	$resTCBM = $queryTCBM->num_rows;
	if($resTCBM > 0){
		if($rowTCBM = $queryTCBM->fetch_assoc()){ 
			$idBM  = $rowTCBM['pmt_id'];
			$thisReplace = str_replace("TERMA PENERIMAAN JOB TUISYEN", "", $rowTCBM['pmt_pagedetail']);
			$needle    = 'Terma Tambahan untuk Tuisyen Berkumpulan';
			//echo strstr($thisReplace, $needle, true);
			//$rowTCBM['pmt_pagedetail']
			
			echo htmlspecialchars_decode($rowTCBM['pmt_pagedetail']);

			
		}
	}else{
		//$idBM = "";
		//echo "";
	}
}else{
	$queryTCBI = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='76'");
	$resTCBI = $queryTCBI->num_rows;
	if($resTCBI > 0){
		if($rowTCBI = $queryTCBI->fetch_assoc()){ 
			$idBI  = $rowTCBI['pmt_id'];
			$thisReplace = str_replace("TERMS OF ACCEPTING HOME TUITION JOB", "", $rowTCBI['pmt_pagedetail']);
			$needle    = 'Additional Terms for Group Tuition';
			//echo strstr($thisReplace, $needle, true);
			//echo $rowTCBI['pmt_pagedetail'];

			echo htmlspecialchars_decode($rowTCBI['pmt_pagedetail']);
		}
	}else{
		//$idBI = "";
		//echo "";
	}
}
?>


						<div class="col-lg-12 text-right">
							<p class="notbold"> I have read and agreed to all the terms above</p>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="pull-right" id="canvas" > 
								<?PHP
								if ($getUserDetails->data[0]->signature_img != '') {
									$pix = $getUserDetails->data[0]->signature_img;
									$pixAll = $pix.".png";
									?><img src="<?php echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature"> <?PHP
								} else {
									?> 
									<div class="sig sigWrapper">
										<div class="typed"></div>
										<canvas class="pad" id="newSignature" width="450" height="314"></canvas>
										<input type="hidden" id="output" name="output" class="output">
									</div>
									
									<?PHP
								}
								?>
							</div>
							<div class="clearfix"> </div>

							<div class="notbold pull-left bottom-align-text"> 
							<?PHP
							if ($getUserDetails->data[0]->signature_img != '') {
								$firstname = $getUserDetails->data[0]->ud_first_name;
								$fullname = $firstname." ".$getUserDetails->data[0]->ud_last_name;
								echo 'Name : '.$fullname.'<br/>';

								$date = $getUserDetails->data[0]->signature_img;
								$date = strtok($date, '_');
								echo 'Date : '.$date;
							}
							?>
							</div>
						</div>

		
						<div class="col-lg-12">
							<div class="text-right pull-right" style="margin-top:10px;">
							<?PHP
							if ($getUserDetails->data[0]->signature_img != '') {
							} else {
								echo "<p style='font-style: oblique;font-size: 12px;'> * Please sign at the designated area</p>";
							}
							?>
							<?PHP 
							if ($getUserDetails->data[0]->signature_img != '') {
								echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
							}else{
								echo '<button type="button" class="btn btn-success" onclick="signatureSave()">Save signature</button>';
								echo '<a type="button" class="btn btn-danger clearButton" href="#clear">Clear signature</a>';
							}
							?>				
							</div>
						</div>



						</div>
					</div>
			</div>
			</form>
			</div>
			
			<div id="thiscontent2" class="notbold hidden">
			
			<form method="post" action="terms-of-accepting2.php">
			<div class="sigPad">


					<div class="row">
		
						<div class="col-lg-12">
						<br/>
<?PHP

if($getLan == "/my/"){	
	$queryTCBM = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='83'");
	$resTCBM = $queryTCBM->num_rows;
	if($resTCBM > 0){
		if($rowTCBM = $queryTCBM->fetch_assoc()){ 
			$idBM  = $rowTCBM['pmt_id'];
			$thisReplace = str_replace("TERMA PENERIMAAN JOB TUISYEN", "", $rowTCBM['pmt_pagedetail']);
			$needle    = 'Terma Tambahan untuk Tuisyen Berkumpulan';
			//echo strstr($thisReplace, $needle, true);
			//$rowTCBM['pmt_pagedetail']
			
			echo htmlspecialchars_decode($rowTCBM['pmt_pagedetail']);

			
		}
	}else{
		//$idBM = "";
		//echo "";
	}
}else{
	$queryTCBI = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='82'");
	$resTCBI = $queryTCBI->num_rows;
	if($resTCBI > 0){
		if($rowTCBI = $queryTCBI->fetch_assoc()){ 
			$idBI  = $rowTCBI['pmt_id'];
			$thisReplace = str_replace("TERMS OF ACCEPTING HOME TUITION JOB", "", $rowTCBI['pmt_pagedetail']);
			$needle    = 'Additional Terms for Group Tuition';
			//echo strstr($thisReplace, $needle, true);
			//echo $rowTCBI['pmt_pagedetail'];

			echo htmlspecialchars_decode($rowTCBI['pmt_pagedetail']);
		}
	}else{
		//$idBI = "";
		//echo "";
	}
}
?>


						<div class="col-lg-12 text-right">
							<p class="notbold"> I have read and agreed to all the terms above</p>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="pull-right" id="canvas" > 
								<?PHP
								if ($getUserDetails->data[0]->signature_img2 != '') {
									$pix2 = $getUserDetails->data[0]->signature_img2;
									$pixAll2 = $pix2.".png";
									?><img src="<?php echo APP_ROOT."images/signature/".$pixAll2; ?>" alt="signature"> <?PHP
								} else {
									?> 
									<div class="sig sigWrapper">
										<div class="typed"></div>
										<canvas class="pad" id="newSignature2" width="450" height="314"></canvas>
										<input type="hidden" id="output-2" name="output-2" class="output">
									</div>
									<?PHP
								}
								?>
							</div>
							<div class="clearfix"> </div>

							<div class="notbold pull-left bottom-align-text"> 
							<?PHP
							if ($getUserDetails->data[0]->signature_img2 != '') {
								$firstname2 = $getUserDetails->data[0]->ud_first_name;
								$fullname2 = $firstname2." ".$getUserDetails->data[0]->ud_last_name;
								echo 'Name : '.$fullname2.'<br/>';

								$date2 = $getUserDetails->data[0]->signature_img2;
								$date2 = strtok($date2, '_');
								echo 'Date : '.$date2;
							}
							?>
							</div>
						</div>

		
						<div class="col-lg-12">
							<div class="text-right pull-right" style="margin-top:10px;">
							<?PHP
							if ($getUserDetails->data[0]->signature_img2 != '') {
							} else {
								echo "<p style='font-style: oblique;font-size: 12px;'> * Please sign at the designated area</p>";
							}
							?>
							<?PHP 
							if ($getUserDetails->data[0]->signature_img2 != '') {
								echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
							}else{
								echo '<button type="button" class="btn btn-success" onclick="signatureSave2()">Save signature</button>';
								echo '<a type="button" class="btn btn-danger clearButton" href="#clear">Clear signature</a>';
							}
							?>				
							</div>
						</div>



						</div>
					</div>
			
			</div>
			</form>
			

			</div>

<!--  HERE ---->




			
			
			




  
	</div>
	<div id="content2" class="hidden"><br/><br/>
		<div class="row">
		<div class="col-lg-12">
		<?php 
            $arrTerms = system::FireCurl(CMS_URL.'?cms_id=17&lang='.$_SESSION['lang_code']);
            foreach($arrTerms->data as $terms){?>
		<?php echo $terms->pmt_pagedetail; } ?>
		</div>
		</div>
	</div>




    </div>
 </div>
</section>
				<script src="pdf/signature-pad-master/jquery.signaturepad.js"></script>
				<script>
				$(document).ready(function() {
					$('.sigPad').signaturePad({
						drawOnly:true, 
						lineTop:220, 
						bgColour : '#ffffff', //transparent
						penColour : '#000000',
						penWidth : 5
					});
				});
				</script>
				<script src="pdf/signature-pad-master/assets/json2.min.js"></script>
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

                  
                  <li><a href="login.php" >Sign In</a></li>

                  
               </ul>

            </div>

            <div class="col-md-4 col-sm-4">

               <h3>Search this site</h3>

               <ul class="nl">

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
<script>
function signatureSave() {

	var displayid = document.getElementById("displayid").value;
	var output = document.getElementById("output").value;
	var canvas = document.getElementById("newSignature");
	var dataURL = canvas.toDataURL("image/png");

     //if( dataURL == "data:image/png;base64,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" || dataURL == "data:image/png;base64,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"){
     if( dataURL == "data:image/png;base64,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" || dataURL == "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAcIAAAE6CAYAAACF2VIxAAAL+klEQVR4Xu3ZsQ3DMBRDQbn2Itp/Gi2iOg7SBUaA1H6nDXj8AAsdr/cbHgECBAgQiAochjDavNgECBAg8BEwhA6BAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBC4DeFaa+y9yRAgQIAAgccJnOc55pxfuQzh42oWiAABAgR+Cfw1hPgIECBAgEBJwB9hqW1ZCRAgQOAmYAgdBQECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQIDABZeG8I/1zLOsAAAAAElFTkSuQmCC" ){
		 alert("Please Signature In The Space Provided");
	 }else{
		 if(displayid != ''){
			$.ajax({
				type: "POST",
				url: 'tutors-terms2.php',
				data: {displayid: displayid, dataURL: dataURL},
				success: function(response){
					alert(response);
					document.location.reload(true);
				}
			});
		 }else{
			 alert("Something Wrong Happened !!");
		 }
	 }

}



function signatureSave2() {

	var displayid = document.getElementById("displayid").value;
	var output = document.getElementById("output-2").value;
	var canvas = document.getElementById("newSignature2");
	var dataURL = canvas.toDataURL("image/png");

     //if( dataURL == "data:image/png;base64,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" || dataURL == "data:image/png;base64,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"){
     if( dataURL == "data:image/png;base64,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" || dataURL == "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAcIAAAE6CAYAAACF2VIxAAAL+klEQVR4Xu3ZsQ3DMBRDQbn2Itp/Gi2iOg7SBUaA1H6nDXj8AAsdr/cbHgECBAgQiAochjDavNgECBAg8BEwhA6BAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBC4DeFaa+y9yRAgQIAAgccJnOc55pxfuQzh42oWiAABAgR+Cfw1hPgIECBAgEBJwB9hqW1ZCRAgQOAmYAgdBQECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQIDABZeG8I/1zLOsAAAAAElFTkSuQmCC" ){
		 alert("Please Signature In The Space Provided");
	 }else{
		 if(displayid != ''){
			$.ajax({
				type: "POST",
				url: 'tutors-terms3.php',
				data: {displayid: displayid, dataURL: dataURL},
				success: function(response){
					alert(response);
					document.location.reload(true);
				}
			});
		 }else{
			 alert("Something Wrong Happened !!");
		 }
	 }

}
</script>
<script>
    $("#no1").click(function(event) 
    {
       $("#no1").removeClass('btn-primary');
       $("#no2").removeClass("btn-primary");
       $("#no1").removeClass('btn-default');
       $("#no2").removeClass("btn-default");
       
       $("#no1").addClass("btn-primary");
       $("#no2").addClass("btn-default");
       
         
       $("#content1").removeClass("hidden");
       $("#content2").addClass("hidden");
    });
    $("#no2").click(function(event) 
    {
       $("#no1").removeClass('btn-primary');
       $("#no2").removeClass("btn-primary");
       $("#no1").removeClass('btn-default');
       $("#no2").removeClass("btn-default");
       
       $("#no1").addClass("btn-default");
       $("#no2").addClass("btn-primary");
       
       
       $("#content2").removeClass("hidden");
       $("#content1").addClass("hidden");
    });
    
//btn btn-success btn-outline
    $("#thisno1").click(function(event) 
    {
       $("#thisno1").removeClass('btn-outline');
       $("#thisno2").removeClass("btn-primary");
       
       $("#thisno1").addClass("btn-primary");
       $("#thisno2").addClass("btn-outline");
       
         
       $("#thiscontent1").removeClass("hidden");
       $("#thiscontent2").addClass("hidden");
    });
    $("#thisno2").click(function(event) 
    {
       $("#thisno1").removeClass('btn-primary');
       $("#thisno2").removeClass("btn-outline");
       
       $("#thisno1").addClass("btn-outline");
       $("#thisno2").addClass("btn-primary");
       
       
       $("#thiscontent2").removeClass("hidden");
       $("#thiscontent1").addClass("hidden");
    });
</script>
