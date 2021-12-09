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
</style>

<section class="profile">
 <div class="main-body">
    <div class="container">

       <h1 class="text-center text-uppercase blue-txt"><?php echo TUTORS_TERMS; ?></h1><hr>



<button id="no1" type="button" class="btn btn-primary" >Terms Of Accepting Home Tuition Job</button> <button id="no2" type="button" class="btn btn-default" >Tutor Registration Terms</button>
  
  <div id="content1" class="collapse in"><br/><br/>
  
<form method="post" action="terms-of-accepting.php" class="sigPad">
	   <input type="hidden" name="displayid" id="displayid" value="<?php echo $getUserDetails->data[0]->u_displayid; ?>">

	<div class="row">
		
		<div class="col-lg-12">
<?PHP
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
if($getLan == "/my/"){	
	$queryTCBM = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='77'");
	$resTCBM = $queryTCBM->num_rows;
	if($resTCBM > 0){
		if($rowTCBM = $queryTCBM->fetch_assoc()){ 
			$idBM  = $rowTCBM['pmt_id'];
			echo $rowTCBM['pmt_pagedetail'];
		}
	}else{
		$idBM = "";
		echo "";
	}
}else{
	$queryTCBI = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='76'");
	$resTCBI = $queryTCBI->num_rows;
	if($resTCBI > 0){
		if($rowTCBI = $queryTCBI->fetch_assoc()){ 
			$idBI  = $rowTCBI['pmt_id'];
			echo $rowTCBI['pmt_pagedetail'];
		}
	}else{
		$idBI = "";
		echo "";
	}
}
?>
			<!--<u>TERMS OF ACCEPTING HOME TUITION JOB</u><br/><br/>
			<ol>
				<li> TutorKami will handle the collection of all payments from parent/student/tuition center (hereinafter called ‘the Client’) on behalf of you.
				</li><br/>
				<li> If Client decides to discontinue with you after the FIRST lesson (because they feel you are incompetent or unsuitable), the lesson will be deemed <u>a free trial session</u>. <b>You will not receive any payment</b>. No commission will be charged on you in return.
				</li><br/>
				<li> Your payment will be transferred to you once you have completed 1 cycle of classes. One (1) cycle is the total hours of lessons that is scheduled to be done in 4 weeks. For example, if Client requests for 1.5 hours of class per week, then 1 cycle is 6 hours. If Client request for 3 hours per week, then 1 cycle = 12 hours of class.
				</li><br/>
				<li> Payment amounts are based on the agreed rates (as stated in ‘Job Details’). Please record the dates & times of all the classes you have done every week and send it via What’s App or email it to us before your payment can be made.
				</li><br/>
				<li> You also agree that <b>we will take a commission</b> from your first payment for getting you this job. Commission amount is as stated in ‘Job Details’.
				</li><br/>
				<li> All payments will be made by our Finance Manager (019-361 3956). If matters regarding payment is made or dealt by a staff other than the one mentioned here, please report it to our GM, Mr. Hambal (019-220 8594). This is to ensure your payment is taken care by the right person, so it will be done correctly & promptly.
				</li><br/>
				<li> The rate we charge the Client is higher than the rate paid to you. The difference in the amount charged to the Client is for our following services and added values:
					<ol style="list-style-type:upper-roman;">
						<li> Collect monthly payment on behalf of the tutor;</li>
						<li> Bearing the risk on ensuring there will be no case of tutor not getting paid, class canceled at last minute or class canceled & no replacement class is made.</li>
					</ol>
				</li><br/>
				<li> If the Client ask about your payment rate, inform them that you are being paid directly by TutorKami and you are not allowed to disclose your rates. Anything regarding rates, payment procedures, Client wants you to teach more subjects or wants to add more class, please ask them to contact the Finance Manager.
				</li><br/>
				<li>If you need to postpone a class, please call the Client at least 24 hours before the next class starts to inform them (if the call is unanswered, send them an SMS and What's App). Make sure you receive Client’s acknowledgment, and the schedule of the replacement class is discussed right away. If you fail to do so, Client has the right to replace you. Your account with TutorKami may also be suspended.
				</li><br/>
				<li> All books required by the student will be purchased by the parent, not TutorKami. If you think the student needs reference or exercise books, please advise the parent the books you would recommend them to purchase.
				</li><br/>
				<li> If you decide to quit and stop giving class, please inform the parent and our Coordinator or Finance Manager at least 5 days before the upcoming class.
				</li><br/>
				<li> If you do not agree with any of the term above, or if you plan to deal directly with the Client after accepting all these terms, do not apply for this job.
				</li><br/>
			</ol>-->
		</div>
		<div class="col-lg-12 text-right">
		<p> I have read and agreed to all the terms above</p>
			 <!--<p> Date :
			<?PHP
			if ($getUserDetails->data[0]->signature_img != '') {
				$pix = $getUserDetails->data[0]->signature_img;
				$first = strtok($pix, '_');
				//echo $first;
			} else {
				//echo date("d-m-Y");
			}
			?>
			</p>-->
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
						<canvas id="newSignature" width="450" height="314"></canvas>
						<input type="hidden" id="output" name="output" class="output">
                    </div>
					<?PHP
                  }
                ?>
			</div>
			<div class="clearfix"> </div>
<style>
@media (min-width: 768px ) {

  .bottom-align-text {
    margin-left:500px;
  }
}
@media (min-width: 1200px ) {

  .bottom-align-text {
    margin-left:700px;
  }
}
</style>
			<div class="pull-left bottom-align-text"> 
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

		
		
  <!--<form method="post" action="" class="sigPad">
    <ul class="sigNav">
      <li class="clearButton"><a href="#clear">Clear</a></li>
    </ul>-->

    <!--<button type="submit">I accept the terms of this agreement.</button>-->
  </form>

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
		

		
		
	</div>
  
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
     if( dataURL == "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAcIAAAE6CAYAAACF2VIxAAAL8ElEQVR4Xu3ZsQ2AMBRDQZgp+4+QmQDREiRq3mUDn7/kIvtxvc0jQIAAAQJRgd0QRpsXmwABAgRuAUPoEAgQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAgeUQzjnJECBAgACB3wmMMR6ZDOHvahaIAAECBN4EPg8hQgIECBAgUBHwR1hpWk4CBAgQWAoYQodBgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIGAI3QABAgQIpAUMYbp+4QkQIEDAELoBAgQIEEgLGMJ0/cITIECAgCF0AwQIECCQFjCE6fqFJ0CAAAFD6AYIECBAIC1gCNP1C0+AAAEChtANECBAgEBawBCm6xeeAAECBAyhGyBAgACBtIAhTNcvPAECBAgYQjdAgAABAmkBQ5iuX3gCBAgQMIRugAABAgTSAoYwXb/wBAgQIHACYp7qj9MlD4oAAAAASUVORK5CYII=" || dataURL == "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAcIAAAE6CAYAAACF2VIxAAAL+klEQVR4Xu3ZsQ3DMBRDQbn2Itp/Gi2iOg7SBUaA1H6nDXj8AAsdr/cbHgECBAgQiAochjDavNgECBAg8BEwhA6BAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBC4DeFaa+y9yRAgQIAAgccJnOc55pxfuQzh42oWiAABAgR+Cfw1hPgIECBAgEBJwB9hqW1ZCRAgQOAmYAgdBQECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQIDABZeG8I/1zLOsAAAAAElFTkSuQmCC" ){
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
</script>
