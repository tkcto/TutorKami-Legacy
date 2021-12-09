<?php 
$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$_SESSION['auth']['user_id']);

?>
<div class="col-md-12 ">
    <?PHP 
    if( $deviceIs == 'desktop' ){
        $iconBtn = '&ldquo;+Add&rdquo; button at the respective job ID'; 
    }else{
        $iconBtn = '<button style="margin-top:-10px;" class="btn btn-success btn-xs" role="button"><span class="glyphicon glyphicon-plus"></span></button><br/><br/> You can click the icon/header/text below to see more details'; 
    }
    
    ?>
   <hr>
   <h3 class="org-txt"><strong><?php echo WELCOME; ?> <?php echo $getUserDetails->data[0]->u_displayname; ?></strong></h3>

   <!--<p><strong><?php //echo ID_NO; ?> :</strong> <?php //echo $getUserDetails->data[0]->u_displayid; ?></p>-->
      <p><?php echo 'To add a class record, please click '.$iconBtn; ?></p>
   <br/><div class="col-sm-4 padd_less">
      <p><?php echo ENTER_JOB_ID_TO_VIEW_DETAILS; ?> :  </p>
   </div>
   <div class="col-sm-4">
      <form action="tutor_view_class_detail.php" method="get">
         <div id="imaginary_container">
            <div class="input-group stylish-input-group ">
               <!--<input type="text" class="form-control" name="display_id" placeholder="Search" >-->
               <input type="text" class="form-control" name="searchBoxx" id="searchBoxx" placeholder="Search" >
               <span class="input-group-addon">
                  <button type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
         </div>
      </form>
   </div>
   <div class="clearfix"></div>
   <hr>
</div>