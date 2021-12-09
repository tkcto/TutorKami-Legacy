<?php 

require_once('includes/head.php');

# SESSION CHECK #

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['auth'])) {

  header('Location: tutor-login.php');

  exit();

}

if ($_SESSION['auth']['user_role'] != '3') {

   header('Location:list_of_classes.php');

   exit();

}

$output = system::FireCurl(TUTOR_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']);

$classes = $output->data;

include('includes/header.php');
$_SESSION['getPage'] = "My Classes";
unset($_SESSION["firstlogin"]);

if( $deviceIs == 'desktop' ){
    $imageHours = HOURS_LEFT; 
    $action = '';
    $hourText = 'hours';
}else{
    $imageHours = '<img data-toggle="btnToolTip" data-placement="bottom" title="Duration of lessons you need to do to complete 1 cycle"  src="images/duration-icon-29.png" alt="Duration" width="25" height="25">'; 
    $action = 'Action';
    $hourText = 'hrs';
}
?>
<style> 
.tooltip-inner { 
    width:180px; 
}
.tooltip-inner {
    white-space:pre-wrap;
}
/*
table.dataTable thead .sorting:after, 
table.dataTable thead .sorting_asc:after, 
table.dataTable thead .sorting_desc:after {
  color : #262262;
}

table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc_disabled:before {
   padding-left: -20px;
  content: "" !important;
}
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_desc_disabled:after {
    padding-left: -20px;
  content: "" !important;
}
*/
.table thead td{
    border-right: none !important;
    border-left: none !important;

}

table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc_disabled:before {
    display : none;
  content: "" !important;
}
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_desc_disabled:after {
    display : none;
  content: "" !important;
}
/*
table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background : none;
}

*/
.table tbody td{
    /*border-right: #f2f2f2 solid 1px !important;
    border-left: #f2f2f2 solid 1px !important;*/
    border-bottom: #f2f2f2 solid 1px !important;
    border-right: none !important;
    border-left: none !important;
}


/*
table.dataTable thead .sorting_asc {
  background: url("http://cdn.datatables.net/1.10.0/images/sort_asc.png") no-repeat center right;
}
table.dataTable thead .sorting_desc {
  background: url("http://cdn.datatables.net/1.10.0/images/sort_desc.png") no-repeat center right;
}
table.dataTable thead .sorting {
  background: url("http://cdn.datatables.net/1.10.0/images/sort_both.png") no-repeat center right;
}*/
.not-active { 
    /*pointer-events: none; */
    cursor: not-allowed; 
} 
        
</style> 
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<section class="clients_profile_2">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt "><?php echo LIST_OF_CLASSES; ?></h1>

         <?php include('includes/private_info.php'); ?>

         <ul class="nav nav-tabs" role="tablist">

            <li role="presentation" class="active"><a href="javascript: void(0);"><?php echo LIST_OF_CLASSES; ?></a></li>


         </ul>

         <div class="tab-content">

            <div role="tabpanel" class="active" id="home">

               <div class="job-table">

                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive  text-center table-striped table-bordered" style="background:#fff;" id="dataTables_cl">

                     <thead>

                        <tr class="blue-bg">

                           <td><a style="text-decoration: none;" href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="bottom" title="<?php echo TOOLTIP_SORT_BY_ID; ?>"><font style="color:#fff;margin-right:-12px;"><?php echo 'Job&nbsp;ID';//echo ID_NO; ?></font></a></td>


<?PHP
if( $deviceIs == 'desktop' ){
?>
                           <td><?php echo STUDENT_NAME; ?></td>

                           <td><?php echo SUBJECT; ?></td>
<?PHP
}else{
?>
                           <td>
                               <a style="text-decoration: none;" href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="bottom" title="Click the people icons below to see details"><font style="color:#fff;"><?php echo STUDENT_NAME; ?></font></a>
                           </td>

                           <td>
                               <a style="text-decoration: none;" href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="bottom" title="Click the subject names below to see details"><font style="color:#fff;"><?php echo SUBJECT; ?></font></a>
                           </td>
<?PHP
}
?>



                           <td width="20%"><?php echo $imageHours; ?></td>

                           <td><a style="text-decoration: none;" href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="bottom" title="<?php echo TOOLTIP_SORT_BY_STATUS; ?>"><font style="color:#fff;margin-right:-12px;"><?php echo STATUS; ?></font></a></td>                           

                           <td><?PHP echo $action; ?></td>

                        </tr>

                     </thead>

                     <tbody>

                        <?php 

                        $status = array(

                           'ongoing' => '<span class="green-txt">Ongoing</span>', 

                           'onhold'  => '<span class="org-txt"><strong>On hold</strong></span>', 

                           'ended'   => '<span><strong>Ended</strong></span>');

                        if(count($classes) > 0) {

                           foreach ($classes as $key => $row) {                           

                        ?>

                        <tr>

                           <td class="sky-txt"><a style="margin-left:-8px;" href="tutor_view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn_edit tip-right" data-toggle="btnToolTip" data-placement="bottom" title="Click id no to view detail"><?php echo $row->cl_display_id;?></a></td>


<?PHP
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
        $queryCity = "SELECT * FROM tk_cities WHERE city_id = '".$row->ud_city."' "; 
        $resultCity = $conn->query($queryCity); 
        if($resultCity->num_rows > 0){ 
            $rowCity = $resultCity->fetch_assoc();
            $nameCity = $rowCity['city_name']; 

        }
?>



                           <td>
<?PHP
if( $deviceIs == 'desktop' ){
                                echo $row->ud_first_name.', '.$nameCity;//$row->u_displayname;//$row->cl_student
}else{
                                if($row->u_gender == 'M'){
                                    echo '<img data-toggle="btnToolTip" data-placement="bottom" title="Client: '.$row->ud_first_name.', '.$nameCity.'
Student: '.$row->cl_student.'"  src="images/man-icon.png" alt="Lelaki" width="35" height="35">';
                                }else{
                                    echo '<img data-toggle="btnToolTip" data-placement="bottom" title="Client: '.$row->ud_first_name.', '.$nameCity.'
Student: '.$row->cl_student.'"  src="images/women-icon.png" alt="Perempuan" width="35" height="35">';
                                }
}
?>
                           
                           </td>

                           <td>
<?PHP
if( $deviceIs == 'desktop' ){
                                echo $row->cl_subject;
}else{
                                $arrSubjek = explode(' ',trim($row->cl_subject));
                                echo '<span data-toggle="btnToolTip" data-placement="bottom" title="'.$row->cl_subject.'" >'.$arrSubjek[0].'</span>';
                                
}
?>
                           </td>

                           <td><?php 
/*
if( $row->cl_hours_balance < 0){
	//echo '-';
	$outputTwoDigit =  number_format((float)$row->cl_hours_balance, 2, '.', '');
	
	$first = strtok($outputTwoDigit, '.');
	$searchForValue = '-';

	if( strpos($first, $searchForValue) !== false ) {
		echo preg_replace('/[ -]+/', ' - ', trim($first)) .' '.$hourText.' &';
	}else{
		echo intval($first) .' '.$hourText.' &';
	}
	echo '<br/>';
	echo substr($outputTwoDigit, strrpos($outputTwoDigit, '.' )+1) .' min';
}else{
	//echo '+';
	if( $row->cl_hours_balance == '-'){
		echo '00 '.$hourText.' & <br/> 00 min';
	}else{
		$outputTwoDigit =  number_format((float)$row->cl_hours_balance, 2, '.', '');
		$first = strtok($outputTwoDigit, '.');
		$searchForValue = '-';

		if( strpos($first, $searchForValue) !== false ) {
			echo preg_replace('/[ -]+/', ' - ', trim($first)) .' '.$hourText.' &';
		}else{
			echo intval($first) .' '.$hourText.' &';
		}
		echo '<br/>';
		echo substr($outputTwoDigit, strrpos($outputTwoDigit, '.' )+1) .' min';
		
	}
}
*/
                                $queryStatusClass = " SELECT * FROM tk_classes_record WHERE cr_cl_id ='".$row->cl_id."' ORDER BY cr_date DESC   "; 
                                $resultStatusClass = $conn->query($queryStatusClass); 
                                if($resultStatusClass->num_rows > 0){ 
                                    $rowStatusClass = $resultStatusClass->fetch_assoc();
                                    $getStatusClass = $rowStatusClass['cr_status'];  //cr_status
                                }
                                
                                if( $getStatusClass == 'FM to pay tutor' ){
                                    echo 'Tutor to be paid';
                                    $disableAdd = '';
                                    $disableAdd2 = '';
                                }else if( $getStatusClass == 'Tutor Paid' ){
                                    //echo 'New cycle to start';
                                    
                                    if( $row->last == 'This is the last session' ){
                                        echo '<img data-toggle="btnToolTip" data-placement="bottom" title="Client has stopped the class"  src="images/1.wait3.png" alt="" width="30" height="25">';
                                    }else if( $row->last == 'Next class as usual' ){
                                        echo '<img data-toggle="btnToolTip" data-placement="bottom" title="New cycle to start. Please update record once new session has started"  src="images/1.right-arrow.png" alt="" width="30" height="30">';
                                    }else if( $row->last == 'Not sure if got next class' ){
                                        echo '<img data-toggle="btnToolTip" data-placement="bottom" title="Waiting confirmation from Client. Please update record if new session has started "  src="images/2.time.png" alt="" width="30" height="25">';
                                    }else{
                                        
                                    }

                                    $disableAdd = '';
                                    $disableAdd2 = '';
                                }else if( $getStatusClass == 'Required Parent To Pay' ){
                                    //echo 'Wait for Admin';
                                    echo '<img data-toggle="btnToolTip" data-placement="bottom" title="Admin to update"  src="images/1.circle-blue.jpg" alt="" width="30" height="25">';
                                    $disableAdd = 'not-active';
                                    $disableAdd2 = 'disabled';
                                }else{
                                    
                                        if( $row->cl_hours_balance < 0){
                                        	//echo '-';
                                        	$outputTwoDigit =  number_format((float)$row->cl_hours_balance, 2, '.', '');
                                        	
                                        	$first = strtok($outputTwoDigit, '.');
                                        	$searchForValue = '-';
                                        
                                        	if( strpos($first, $searchForValue) !== false ) {
                                        		echo preg_replace('/[ -]+/', ' - ', trim($first)) .' '.$hourText.' &';
                                        	}else{
                                        		echo intval($first) .' '.$hourText.' &';
                                        	}
                                        	echo '<br/>';
                                        	echo substr($outputTwoDigit, strrpos($outputTwoDigit, '.' )+1) .' min';
                                        }else{
                                        	//echo '+';
                                        	if( $row->cl_hours_balance == '-'){
                                        		echo '00 '.$hourText.' & <br/> 00 min';
                                        	}else{
                                        		$outputTwoDigit =  number_format((float)$row->cl_hours_balance, 2, '.', '');
                                        		$first = strtok($outputTwoDigit, '.');
                                        		$searchForValue = '-';
                                        
                                        		if( strpos($first, $searchForValue) !== false ) {
                                        			echo preg_replace('/[ -]+/', ' - ', trim($first)) .' '.$hourText.' &';
                                        		}else{
                                        			echo intval($first) .' '.$hourText.' &';
                                        		}
                                        		echo '<br/>';
                                        		echo substr($outputTwoDigit, strrpos($outputTwoDigit, '.' )+1) .' min';
                                        		
                                        	}
                                        }
                                    $disableAdd = '';
                                    $disableAdd2 = '';
                                }


						  ?> </td>

                           <td style="margin-left:-12px;">
                               <?php echo $status[$row->cl_status];?>
                                <?PHP
                                /*
                                $queryStatusClass = " SELECT * FROM tk_classes_record WHERE cr_cl_id ='".$row->cl_id."' ORDER BY cr_date DESC   "; 
                                $resultStatusClass = $conn->query($queryStatusClass); 
                                if($resultStatusClass->num_rows > 0){ 
                                    $rowStatusClass = $resultStatusClass->fetch_assoc();
                                    $getStatusClass = $rowStatusClass['cr_status'];  //cr_status
                                }
                                
                                if( $getStatusClass == 'FM to pay tutor' ){
                                    echo 'Tutor to be paid';
                                    $disableAdd = '';
                                    $disableAdd2 = '';
                                }else if( $getStatusClass == 'Tutor Paid' ){
                                    echo 'New cycle to start';
                                    $disableAdd = '';
                                    $disableAdd2 = '';
                                }else if( $getStatusClass == 'Required Parent To Pay' ){
                                    echo 'Wait for Admin';
                                    $disableAdd = 'not-active';
                                    $disableAdd2 = 'disabled';
                                }else{
                                    echo $status[$row->cl_status];
                                    $disableAdd = '';
                                    $disableAdd2 = '';
                                }
                                */
                                ?>
                           </td>

                           <td>
<?PHP
if( $deviceIs == 'desktop' ){
?>
            <a href="tutor_view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-search"></span> <?php echo "View"; //VIEW_DETAILS; ?></a>
            <div style="margin-bottom:5px;"></div>
            <a href="tutor_view_class_detail.php?action=add_record&c_id=<?php echo $row->cl_id;?>" class="btn btn-success btn-sm <?PHP echo $disableAdd; ?>" <?PHP echo $disableAdd2; ?> role="button"><span class="glyphicon glyphicon-plus"></span> &nbsp;<?php echo "Add"; //ADD_RECORD; ?>&nbsp;</a>
<?PHP
}else{
?>
            <a href="tutor_view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;</a>
            <div style="margin-bottom:5px;"></div>
            <a href="tutor_view_class_detail.php?action=add_record&c_id=<?php echo $row->cl_id;?>" class="btn btn-success btn-sm <?PHP echo $disableAdd; ?>" <?PHP echo $disableAdd2; ?> role="button"><span class="glyphicon glyphicon-plus"></span>&nbsp;</a>
<?PHP
}
?>



                           </td>

                        </tr>

                        <?php 

                           }

                        } else { 

                        ?>

                        <tr>

                           <td colspan="6"><?php echo 'No classes found';//NO_RECORDS_FOUND; ?></td>

                        </tr>

                        <?php } ?>

                     </tbody>

                  </table>

               </div>

            </div>

         </div>

         <div class="clearfix"></div>

      </div>

   </div>

</section>

<?php //include('includes/footer.php');?>

<!--START footer -->
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

<!-- Load Facebook SDK for JavaScript -->
<!--<style>
.fb_customer_chat_bounce_out_v2 {
    display: none;
}
</style>--><!-- Load Facebook SDK for JavaScript -->



</body>

</html>
<!--END footer -->

<script src="js/jquery-1.12.4.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

<script src="js/select2.min.js"></script>

<script>

   $.noConflict();

   jQuery(document).ready(function($){


    $('#searchBoxx').on( 'keyup click', function () {
       $('#dataTables_cl').DataTable().search(
           $('#searchBoxx').val()
       ).draw();
    } ); 
    
    

      $("#e1").select2();

      $("#e2").select2();
      
      

      $('#dataTables_cl').DataTable({

         "order": [[ 0, "desc" ]],
         
         "sDom": 'lrtip',

         "info":false,

         "searching":true,

         "lengthChange":false,

         "bSort":true,

         "bPaginate":true,

         "sPaginationType":"simple_numbers",

         "iDisplayLength": 10,

         "columns": [            

            null,

            { "orderable": false },

            { "orderable": false },

            { "orderable": false }, 

            null,           

            { "orderable": false }            

         ]

      });



      $(".clickable-row").click(function() {

           window.location = $(this).data("href");

      });

      

   });
   

$(document).ready(function(){
    $(".not-active").each(function(){
        if($(this).hasClass("not-active")){
            $(this).removeAttr("href");
        }
    });
});


</script>