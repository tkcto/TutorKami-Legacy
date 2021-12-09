<?php 
require_once('includes/head.php');

# SESSION CHECK #

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['auth'])) {
  header('Location: login.php');
  exit();
}
/*if($_SESSION['auth']['user_id'] == "1579981"){
	include ('edit_account-fadhli.php');
	exit();
}*/
if ($_SESSION['auth']['user_role'] != '3') {
   header('Location:list_of_classes.php');
   exit();
}

$user_id = $_SESSION['auth']['user_id'];
$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);

include('includes/header.php');
$_SESSION['getPage'] = "View Profile";
unset($_SESSION["firstlogin"]);
?>

<section class="profile">

 <div class="main-body">

    <div class="container">

       <h1 class="text-center text-uppercase blue-txt"><?php echo VIEW_PROFILE; ?></h1>

       <div class="col-md-10 col-md-offset-1 ">

          <hr>

          <div class="row">

             <div class="col-md-8 col-sm-10">

                <h3 class="org-txt text-capitalize"><strong><?php echo $_SESSION['auth']['display_name'];?> (<?php echo ID_NO; ?> : <?php echo $getUserDetails->data[0]->u_displayid; ?>)</strong></h3>

                <br>

                <strong><?php echo system::CalculateAge($getUserDetails->data[0]->ud_dob); ?> <?php echo YEARS_OLD; ?>, <?php echo ($getUserDetails->data[0]->u_gender == 'M') ? 'Male' : 'Female'; ?>, <?php echo ($getUserDetails->data[0]->ud_race != '' && $getUserDetails->data[0]->ud_race != 'Not selected') ? $getUserDetails->data[0]->ud_race : ''; ?> </strong><br>

                <?php echo $getUserDetails->data[0]->ud_qualification; ?> <br>

                <br>

                <strong><?php echo TUTOR_STATUS; ?> :</strong> <?php echo $getUserDetails->data[0]->ud_tutor_status; ?> <br>

                <br>

                <!--<strong><?php //echo EXPERIENCE; ?>:</strong> <?php //echo ($getUserDetails->data[0]->ud_tutor_experience != '') ? $getUserDetails->data[0]->ud_tutor_experience.' '.YEARS : ''; ?> <br>-->
                <strong><?php echo EXPERIENCE; ?>:</strong> 
                <?php 
                    if($getUserDetails->data[0]->ud_tutor_experience != ''){
                        echo $getUserDetails->data[0]->ud_tutor_experience;
                    }
                    if($getUserDetails->data[0]->ud_tutor_experience_month != ''){
                        echo ' '.$getUserDetails->data[0]->ud_tutor_experience_month;
                    }
                ?> 
                <br>

                <br>

                <strong><?php echo OCCUPATION; ?>:</strong> <?php echo $getUserDetails->data[0]->ud_current_occupation == 'Other' ? $getUserDetails->data[0]->ud_current_occupation_other : $getUserDetails->data[0]->ud_current_occupation; ?> <br>

                <br>

                <strong><?php echo WILL_CONSIDER_TEACHING_AT_TUITION_CENTER; ?>:</strong> <?php echo $getUserDetails->data[0]->ud_client_status == 'Tuition Centre' ? 'Yes' : 'No'; ?> <br>

                <br>

                <strong><?php echo AREAS_COVERED_FOR_HOME_TUITION; ?>:</strong> <br>
					<div id="loadArea"></div>
                <br>

                <div class="text-capitalize"> <strong><?php echo SUBJECTS_TAUGHT; ?>: </strong> <br>
					<div id="loadSubject"></div>
                </div>

                <div> </div>

             </div>

             <div class="col-md-4 text-center">

                <img src="<?php 

                if (isset( $_SESSION['auth'] )) {

                  if ($_SESSION['auth']['user_pic'] != '') {

                    // echo APP_ROOT.$_SESSION['auth']['user_pic'];
                     //echo APP_ROOT."images/profile/000".$_SESSION['auth']['user_pic']."_0.jpg";
					 
					/* START fadhli */
					$pix = sprintf("%'.07d", $_SESSION['auth']['user_pic']);
					$pixAll = $pix.'_0.jpg';
					//echo APP_ROOT."images/profile/".$pixAll;
					if ( is_numeric($_SESSION['auth']['user_pic']) ) {
						echo APP_ROOT."images/profile/".$pixAll;
					}else{
						echo APP_ROOT."images/profile/".$_SESSION['auth']['user_pic'].".jpg";
					}
					/* END fadhli */

                  } elseif ($_SESSION['auth']['user_gender'] == 'M') {

                    echo APP_ROOT."images/tutor_ma.png";

                  } else {

                    echo APP_ROOT."images/tutor_mi1.png";

                  }

                }

                ?>" alt="profile_pic" class="img-thumbnail" height="244" width="190">
                <h4 class="org-txt text-capitalize"><strong><?php echo $_SESSION['auth']['display_name'];?> (<?php echo ID_NO; ?> : <?php echo $getUserDetails->data[0]->u_displayid; ?>)</strong></h4>                

             </div>

          </div>

          <hr>

          <br>

          <!-- Nav tabs -->

          <ul class="nav nav-tabs" role="tablist">

             <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo ABOUT_MYSELF; ?></a></li>

             <li role="presentation"><a href="#testimonials" aria-controls="testimonials" role="tab" data-toggle="tab"><?php echo TESTIMONIALS; ?></a></li>

             <li role="presentation" ><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab"><?php echo REVIEWS; ?></a></li>

          </ul>

          <!-- Tab panes -->

          <div class="tab-content">

             <div role="tabpanel" class="tab-pane active" id="home"><?php echo $getUserDetails->data[0]->ud_about_yourself; ?></div>

             <div role="tabpanel" class="tab-pane" id="testimonials">

                <em><?php echo CLICK_IMAGE_TO_ENLARGE; ?></em><i class="fa fa-plus plus" aria-hidden="true"></i> <br>

                <ul class="whatsapp">

                   <?php 

                    // Get Course

                    $getTestimonial = system::FireCurl(USER_TESTIMONIAL."?uid=".$user_id);

                    if ($getTestimonial->flag == 'success' && count($getTestimonial->data) > 0) {

                      $i = 0;

                      foreach ($getTestimonial->data as $key => $testimonial) {

                   ?>

                   <?php if ($testimonial->ut_user_testimonial1 != '') { ?>

                   <li><img src="<?php echo $testimonial->ut_user_testimonial1; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                   <?php } ?>

                   <?php if ($testimonial->ut_user_testimonial2 != '') { ?>

                   <li><img src="<?php echo $testimonial->ut_user_testimonial2; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                   <?php } ?>

                   <?php if ($testimonial->ut_user_testimonial3 != '') { ?>

                   <li><img src="<?php echo $testimonial->ut_user_testimonial3; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                   <?php } ?>

                   <?php if ($testimonial->ut_user_testimonial4 != '') { ?>

                   <li><img src="<?php echo $testimonial->ut_user_testimonial4; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                   <?php } ?>

                   <?php 

                      }

                    }

                   ?>

                </ul>

             </div>

             <div role="tabpanel" class="tab-pane " id="reviews">                

                <?php include('includes/list_tutor_review.php');?>

             </div>

          </div>

       </div>

    </div>

 </div>

</section>

<?php //include('includes/footer.php');?>
<script type="text/javascript">
$(document).ready(function(){
	loadArea(<?PHP echo $user_id; ?>);
	loadSubject(<?PHP echo $user_id; ?>);
});

function loadArea($userid){
	var userid = $userid;
    var displayid = '';
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
             console.log(response);

             var len = response.length;
			 var title = [];
            for(var i=0; i<len; i++){
                var st_name = response[i].st_name;
                var city_name = response[i].city_name;
                $("#loadArea").append("<strong class = 'org-txt text-capitalize'>" + st_name + "</strong>" + ": " + city_name + "<br><br>");
   
            }
			
             
        }
      });

    }
    return false;
}

function loadSubject($userid){
	var userid = $userid;
    var displayid = '';
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
                
                $("#loadSubject").append("<strong class = 'org-txt text-capitalize'>" + tc_title + "</strong>" + ": " + ts_title + "<br>");
                
            }

             
        }
      });

    }
    return false;
}
 </script>
 
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

</body>

</html>