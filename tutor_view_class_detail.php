<?php 
require_once('includes/head.php');
require_once('mobile-detect/mobile-detect.php');
# SESSION CHECK #
if (!isset($_SESSION['auth'])) {
  header('Location: tutor-login.php');
  exit();
}
if ($_SESSION['auth']['user_role'] != '3') {
   header('Location:view_class_detail.php');
   exit();
}
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (count($_POST) > 0) {
   $data = $_POST;
   
   $output = system::FireCurl(ADD_RECORD_URL, "POST", "JSON", $data);
   Session::SetFlushMsg($output->flag, $output->message);
   if ($output->flag == 'success') {
      $_SESSION["balance"] = "true";
      header('Location: ' . basename($_SERVER['PHP_SELF']).'?c_id='.$_POST['class_id']);
      exit();
   }
  
}
if (isset($_GET['c_id']) && $_GET['c_id'] > 0) {
   $output = system::FireCurl(TUTOR_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']."&cid=". $_GET['c_id']);
   $classes = $output->data;
} elseif (isset($_GET['display_id']) && $_GET['display_id'] > 0) {
   $output = system::FireCurl(TUTOR_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']."&displayid=". $_GET['display_id']);
   $classes = $output->data;
}
/*
$row = $classes[0];
$status = array(
   'ongoing' => '<span class="green-txt">Ongoing</span>', 
   'onhold'  => '<span class="org-txt"><strong>On hold</strong></span>', 
   'ended'   => '<span><strong>Ended</strong></span>');

$record = system::FireCurl(CLASS_RECORDS_URL ."?tutor_id=". $_SESSION['auth']['user_id']."&cid=". $row->cl_id);
$record_arr = $record->data;
*/
//include('includes/headernonmobile.php');
include('includes/header.php');
$_SESSION['getPage'] = "My Classes";
unset($_SESSION["firstlogin"]);
?>
<link rel="stylesheet" href="admin/css/plugins/datapicker/datepicker3.css">
<link rel="stylesheet" href="admin/css/plugins/clockpicker/clockpicker.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<style>
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

input[type=radio] {
    float: left;
}
label {
    margin-left: 30px;
    display: block;
}
</style>
<section class="class-id">
   <div class="main-body">
		<input type="hidden" id="sessBalance" value="<?PHP echo $_SESSION["balance"]; ?>"> 
		
<?php
$row = $classes[0];
$status = array(
   'ongoing' => '<span class="green-txt">Ongoing</span>', 
   'onhold'  => '<span class="org-txt"><strong>On hold</strong></span>', 
   'ended'   => '<span><strong>Ended</strong></span>');

$record = system::FireCurl(CLASS_RECORDS_URL ."?tutor_id=". $_SESSION['auth']['user_id']."&cid=". $row->cl_id);
$record_arr = $record->data;

if ($tablet_browser > 0) {
   //print 'is tablet';
   require_once('add-classes-mobile.php');
}
else if ($mobile_browser > 0) {
   //print 'is mobile';
   require_once('add-classes-mobile.php');
}
else {
   //print 'is desktop';
   require_once('add-classes-non-mobile.php');
}   
    $DisplayNameT = '';
    $query = " SELECT u_id, u_displayname FROM tk_user WHERE u_id = '".$_SESSION['auth']['user_id']."' "; 
    $result = $conn->query($query); 
    if($result->num_rows > 0){
        $row1 = $result->fetch_assoc();
        $DisplayNameT = ucwords($row1['u_displayname']);
    }
?>

		<input type="hidden" id="DisplayNameT" value="<?PHP echo $DisplayNameT; ?>"> 
		<input type="hidden" id="hiddenJObID" value="<?PHP echo $row->cl_display_id; ?>"> 
		
   </div>
</section>

<?php //include('includes/footer.php');?>
<!-- START FOOTER -->
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

               <h3><?php echo FOLLOW_US_ON_SOCIAL_MEDIA; ?> :</h3>

               <ul class="footer_followus">

                

                <?php // Get Social

                   $arrSocial = system::FireCurl(LIST_SOCIAL_URL);

                   

                   foreach($arrSocial->data as $social){

                     $post_id = $social->ID;

                   ?>

                  <li><a href="<?=$social->media_url?>"><i class="fa <?=$social->icon_name?>" aria-hidden="true"></i></a></li>

                  <?php } ?>

                </ul>

               <ul class="addr_list">

                <?php // Get Social

                  if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_CONTACT_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_CONTACT_URL);

                  }

                  $arrContact = system::FireCurl($lang_url);

                

                   

                   foreach($arrContact->data as $contact){

                     $post_id = $contact->ID;

                   ?>

                  <li><?=$contact->office_address?>

                  </li>

                  <li><?=$contact->phoneno?></li>

                  <li><?=$contact->emailid?></li>

                  <?php } ?>

               </ul>

            </div>

            <div class="col-md-2 col-sm-2">

               <h3><?php echo SITE_NAVIGATION; ?></h3>

               <ul class="nl">

                 <?php // Get Site Navigation

                 if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang){                 

                    $lang_url = str_replace('{lang}/', '', LIST_NAV_URL);

                  }

                  elseif($_SESSION['lang_code']=='BM'){
                    ?>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="https://www.tutorkami.com/blog/">Berita Terkini</a></li>
                    <li><a href="https://www.tutorkami.com/my/about.php">Tentang Kami</a></li>
                    <li><a href="https://www.tutorkami.com/my/tutor.php">Saya Tutor</a></li>
                    <li><a href="https://www.tutorkami.com/my/tips_for_parent.php">Tips untuk ibubapa</a></li>
                    <li><a href="https://www.tutorkami.com/tutor-login.php">Log Masuk</a></li>
                    <?php
                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_NAV_URL);

                  }

                 

                    $arrNav = system::FireCurl($lang_url);

                    $k=1;

                   foreach($arrNav->data as $nav){

                   ?>

                  <li><a href="<?=$nav->url?>" <?php if($k==1) {?> class="active" <?php } ?>><?=$nav->title?></a></li>

                  <?php $k++; } ?>

               </ul>

            </div>

            <div class="col-md-4 col-sm-4">

               <h3><?php echo SEARCH_THIS_SITE; ?></h3>

               <ul class="nl">

                  <?php // Get Site Navigation

                   $arrSearch = system::FireCurl(LIST_SEARCH_URL);

                    

                   foreach($arrSearch->data as $search){

                     //echo $search->content;

                   }

                  ?>
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



                  <?php // Get Site Navigation

                  if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_TERM_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_TERM_URL);

                  }

                  

                  $arrNav1 = system::FireCurl($lang_url);

                   foreach($arrNav1->data as $nav1){

                   ?>

                  <li><a href="<?=$nav1->url?>"><?=$nav1->title?></a></li>

                  <?php } ?>

               </ul>

            </div>

         </div>

      </div>

   </section>

   <section class="copyright">

      <div class="container">

         <div class="row">

            <div class="col-md-12">



            <?php // Get Site Navigation

                /* if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_COPYRIGHT_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_COPYRIGHT_URL);

                  }

                 

                   $arrCopyright = system::FireCurl($lang_url);

                 

                    

                   foreach($arrCopyright->data as $copy){

                     echo $copy->content;

                   }*/
                  ?>
				  
				  Copyright &copy; <?php $fromYear = 2013; 
										 $thisYear = (int)date('Y'); 
										echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : ''); ?> Tutorkami. All Rights Reserved.

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


<button type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#myModal" id="myModalButton" data-backdrop="static" data-keyboard="false" >Open Modal</button>
<div id="myModal" class="modal fade" role="dialog" style="margin-top:5%">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="background-color: #F1592A;color: white;">
      <div class="modal-body">
            <br/>  
            <p><label>Is this the final session for this student?</label></p>
            
            <div class="form-check">
              <input class="form-check-input messageCheckbox" value="This is the last session" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
              <label class="form-check-label" for="flexRadioDefault1">
                Yes, the client/student wants to stop & this is the final session 
              </label>
            </div><br/>
            <div class="form-check">
              <input class="form-check-input messageCheckbox" value="Next class as usual" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
              <label class="form-check-label" for="flexRadioDefault2">
                No, there will be a class after this as usual
              </label>
            </div><br/>
            <div class="form-check">
              <input class="form-check-input messageCheckbox" value="Not sure if got next class" type="radio" name="flexRadioDefault" id="flexRadioDefault3" >
              <label class="form-check-label" for="flexRadioDefault3">
                I’m not sure, the client/student will inform me later
              </label>
            </div><br/>
            <br/>       
            <center><button onClick="final()" type="button" class="btn btn-default">Submit</button>
            <button type="button" class="btn btn-secondary hidden" data-dismiss="modal">Close</button></center>
            <br/> 

      </div>
    </div>
  </div>
</div>


<button type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#myModalEnd" id="myModalButtonEnd" data-backdrop="static" data-keyboard="false" >Open Modal</button>
<div id="myModalEnd" class="modal fade" role="dialog" style="margin-top:5%">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="modalStyle" style="background-color: #F1592A;color: white;">
      <div class="modal-body">
        <p id="textModal" ></p>
      </div>
      <div class="modal-footer" id="modalStyle2">
          <span id="buttonModal" ></span>
      </div>
    </div>

  </div>
</div>
</body>

</html>
<!-- END FOOTER -->
<script>
$(document).ready(function(){
    var sessBalance = document.getElementById("sessBalance").value;
    if( sessBalance == 'true' ){
        if (window.location.href.indexOf("add_record") > -1) {
        }else{
            var url = new URL(window.location.href);
            var c_id = url.searchParams.get("c_id");
            if( c_id != ''){
                setTimeout(function() { 
                  $.ajax({
                    type: "POST",
                    url: 'last-popup.php',
                    data: {c_id: c_id},
                    success: function(response){
                        
                        /*if(response == 'negative'){
                            document.getElementById('myModalButton').click();
                        }else if(response == 'positif'){
                        }else{
                            alert(response);
                        }*/
                        if( response == 'negative' ){
                            document.getElementById('myModalButton').click();
                        }else if(response == 'positif'){
                        }else if(response == 'yes 1'){
                                  document.getElementById('modalStyle').style.backgroundColor = 'white';
                                  document.getElementById("modalStyle").style.color = 'black';
                                  $("#modalStyle2").addClass("hidden");
                                  document.getElementById('textModal').innerHTML = '<center>Please fill in the student&#39;s name :<br><input type="text" class="form-control" id="textStudentName" name="textStudentName" ><br><button type="submit" class="btn btn-oren" onclick="submitStudentName()" >Submit</button></center>';
                                  document.getElementById('buttonModal').innerHTML = '<button id=closeModal style=background-color:#357BB6 type=button class=btn btn-default data-dismiss=modal>Close</button>';
                                  document.getElementById('myModalButtonEnd').click();
                        }else if(response == 'yes 2'){
                                  document.getElementById('modalStyle').style.backgroundColor = 'white';
                                  document.getElementById("modalStyle").style.color = 'black';
                                  $("#modalStyle2").addClass("hidden");
                                  document.getElementById('textModal').innerHTML = '<center>Please provide your bank details for future payment purpose</center><br><br><div class="form-group row"><p class="col-sm-6">Choose your bank name</p><div class="col-sm-6"><select class="form-control" id="bankName" name="bankName"><option value=""></option><option value="Ambank"       >Ambank</option><option value="BankIslam"    >Bank Islam</option><option value="BankRakyat"   >Bank Rakyat</option><option value="BankMuamalat" >Bank Muamalat</option><option value="BSN"          >BSN</option><option value="CIMB"         >CIMB</option><option value="HongLeong"    >Hong Leong</option><option value="HSBC"         >HSBC</option><option value="Maybank"      >Maybank</option><option value="OCBC"         >OCBC</option><option value="PublicBank"   >Public Bank</option><option value="RHB"          >RHB</option><option value="UOB"          >UOB</option></select></div></div><div class="form-group row"><p class="col-sm-6">Insert your account number</p><div class="col-sm-6"><input type="text" class="form-control" id="accNo" name="accNo"></div></div><br><center><button type="submit" class="btn btn-oren" onclick="submitBank()" >Submit</button><br><br><p style=margin-left:10%;margin-right:10%;>Note : if your bank name is not in the list,inform our staff so we can update it</p></center>';
                                  document.getElementById('buttonModal').innerHTML = '<button id=closeModal style=background-color:#357BB6 type=button class=btn btn-default data-dismiss=modal>Close</button>';
                                  document.getElementById('myModalButtonEnd').click();
                        }else{
                            //alert(response);
                        }
                    }
                  });
                }, 500);

                
            }
        }
    }

});

function final() {
    var checkedValue = $('.messageCheckbox:checked').val();
    var url = new URL(window.location.href);
    var c_id = url.searchParams.get("c_id");
    var DisTutor = document.getElementById("DisplayNameT").value;
    
    if( c_id != '' && checkedValue != '' ){
        //alert(checkedValue);
        $.ajax({
            type: "POST",
            url: 'last-popup2.php',
            data: {c_id: c_id, checkedValue: checkedValue},
            success: function(response){
                if(response != 'success'){
                    alert(response);
                }else{
                    $('.btn-secondary').click();
                      setTimeout(function() { 
                          if( checkedValue == 'This is the last session' ){
                                  document.getElementById('textModal').innerHTML = 'Thank you '+DisTutor+', our Finance Manager will proceed to make your payment';
                                  document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default data-dismiss=modal onclick="showWa()">Close</button>';
                                  document.getElementById('myModalButtonEnd').click();
                          }else if( checkedValue == 'Next class as usual' ){
                                  document.getElementById('textModal').innerHTML = 'Okay '+DisTutor+', our Finance Manager will proceed to make your payment. Please update the online record after you have completed the next session. Thank you.';
                                  document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default data-dismiss=modal onclick="showWa()">Close</button>';
                                  document.getElementById('myModalButtonEnd').click();
                          }else if( checkedValue == 'Not sure if got next class' ){
                                  document.getElementById('textModal').innerHTML = 'Okay '+DisTutor+', our Finance Manager will proceed to make your payment.';
                                  document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default data-dismiss=modal onclick="showWa()">Close</button>';
                                  document.getElementById('myModalButtonEnd').click();
                          }
        
                      }, 500);
                }
            }
        });
    }else{
        alert('Error..');
    }
}

function submitStudentName() {
    var job  = document.getElementById('hiddenJObID').value;
    var name = document.getElementById('textStudentName').value;
            $.ajax({
                url: "allinone.php",
                method: "POST",
                data: {action: '1rekod', job: job,name: name}, 
                success: function(result){
                    if( result == 'Success'){
                        document.getElementById('closeModal').click();
                    }else{
                        alert(result);
                    }
                }
            });
}
function submitBank() {
    var job  = document.getElementById('hiddenJObID').value;
    var bank = document.getElementById('bankName').value;
    var acc  = document.getElementById('accNo').value;
    //alert(job + ' ' + bank + ' ' + acc);
            $.ajax({
                url: "allinone.php",
                method: "POST",
                data: {action: '2rekod', job: job,bank: bank,acc: acc}, 
                success: function(result){
                    if( result == 'Error' ){
                        alert(result);
                    }else{
                        document.getElementById('closeModal').click();
                        setTimeout(function() { 
                                  response = JSON.parse(result);
                                  var dataB = response[0];
                                  var dataA = response[1];
                            
                                  document.getElementById('modalStyle').style.backgroundColor = 'white';
                                  document.getElementById("modalStyle").style.color = 'black';
                                  $("#modalStyle2").addClass("hidden");
                                  document.getElementById('textModal').innerHTML = '<center>Bank name : '+ dataB +'<br> Account no : '+ dataA +'<br><br><span style=margin-left:5%;margin-right:10%;>Make sure the details above is correct so future payment(s) to you will be made correctly</span><br><br> <button type="submit" class="btn btn-oren" onclick="YesCorrect()" >Yes, it correct</button> <button type="submit" class="btn btn-oren" onclick="EditCorrect()" >Edit</button></center>';
                                  document.getElementById('buttonModal').innerHTML = '<button id=closeModal style=background-color:#357BB6 type=button class=btn btn-default data-dismiss=modal>Close</button>';
                                  document.getElementById('myModalButtonEnd').click();
                        }, 500);                        
                    }
                }
            });
}

function YesCorrect() {
    document.getElementById('textModal').innerHTML = '';
    document.getElementById('buttonModal').innerHTML = '';    
    setTimeout(function() {
                                  document.getElementById('modalStyle').style.backgroundColor = 'white';
                                  document.getElementById("modalStyle").style.color = 'black';
                                  $("#modalStyle2").addClass("hidden");
                                  document.getElementById('textModal').innerHTML = '<center>We have received your bank details.<br/>Thank you. <br/><br/><button class="btn btn-oren" type=button class=btn btn-oren data-dismiss=modal >Close</button></center>';
                                  document.getElementById('buttonModal').innerHTML = '';        
    }, 500);   
}

function EditCorrect() {
    var job  = document.getElementById('hiddenJObID').value;

    document.getElementById('textModal').innerHTML = '';
    document.getElementById('buttonModal').innerHTML = '';    
    setTimeout(function() {
            $.ajax({
                url: "allinone.php",
                method: "POST",
                data: {action: 'getBank', job: job}, 
                success: function(result){
                                  response = JSON.parse(result);
                                  var dataB = response[0];
                                  var dataA = response[1];

                                  document.getElementById('modalStyle').style.backgroundColor = 'white';
                                  document.getElementById("modalStyle").style.color = 'black';
                                  $("#modalStyle2").addClass("hidden");
                                  document.getElementById('textModal').innerHTML = '<center>Please provide your bank details for future payment purpose</center><br><br><div class="form-group row"><p class="col-sm-6">Choose your bank name</p><div class="col-sm-6"><select class="form-control" id="bankName" name="bankName"><option value=""></option><option value="Ambank"  >Ambank</option><option value="BankIslam"    >Bank Islam</option><option value="BankRakyat"   >Bank Rakyat</option><option value="BankMuamalat" >Bank Muamalat</option><option value="BSN"          >BSN</option><option value="CIMB"         >CIMB</option><option value="HongLeong"    >Hong Leong</option><option value="HSBC"         >HSBC</option><option value="Maybank"      >Maybank</option><option value="OCBC"         >OCBC</option><option value="PublicBank"   >Public Bank</option><option value="RHB"          >RHB</option><option value="UOB"          >UOB</option></select></div></div><div class="form-group row"><p class="col-sm-6">Insert your account number</p><div class="col-sm-6"><input type="text" class="form-control" id="accNo" name="accNo" value="'+dataA+'"></div></div><br><center><button type="submit" class="btn btn-oren" onclick="submitBank()" >Submit</button><br><br><p style=margin-left:10%;margin-right:10%;>Note : if your bank name is not in the list,inform our staff so we can update it</p></center>';
                                  $('#bankName option[value="'+dataB+'"]').prop('selected', true);
                                  document.getElementById('buttonModal').innerHTML = '<button id=closeModal style=background-color:#357BB6 type=button class=btn btn-default data-dismiss=modal>Close</button>';
                }
            });
                                  
    }, 500); 
}

function showWa() {
    var job  = document.getElementById('hiddenJObID').value;
            $.ajax({
                url: "allinone.php",
                method: "POST",
                data: {action: 'showWa', job: job}, 
                success: function(result){
                    setTimeout(function() {
                        if( result == '' ){
                                      document.getElementById('modalStyle').style.backgroundColor = 'white';
                                      document.getElementById("modalStyle").style.color = 'black';
                                      $("#modalStyle2").addClass("hidden");
                                      document.getElementById('textModal').innerHTML = '<center>Please subscribe to our What’s App auto message, so you can receive auto notification after your payment has been made <br><br> <button style=background-color:#F1592A;color:white; type=button class=btn btn-oren data-dismiss=modal onclick="showWaApp()">To Subscribe, click this button & click send at What’sApp</button> </center>';
                                      document.getElementById('myModalButtonEnd').click();
                        }                        
                    }, 500);   
                }
            });
}
function showWaApp() {
    window.open("https://wa.me/60103169072?text=Allow%20automatic%20message%20from%20TutorKami.com");
}
</script>
