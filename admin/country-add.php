<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;


if(isset($_REQUEST['c-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveCountry($data);
 header('Location:country-list.php');
 exit();
}
if(isset($_REQUEST['cnt'])){
 $arrCnt = $instApp->GetCountry($_REQUEST['cnt']);
}
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Country Add | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>

</head>

<body>
  <div id="wrapper">
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include_once('includes/header.php'); ?>
      
      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5>Country</h5>

         </div>
         <div class="ibox-content">
          <form class="form-horizontal" action="" method="post">    
          <input type="hidden" name="c_id" id="c_id" value="<?php echo isset($_REQUEST['cnt']) ? $arrCnt['c_id'] : ''; ?>">                           
            <div class="form-group"><label class="col-lg-3 control-label">Name:</label>

              <div class="col-lg-7">
              <input type="text" class="form-control" name="c_name" value="<?php echo isset($_REQUEST['cnt']) ? $arrCnt['c_name'] : ''; ?>" required> 
              </div>
            </div>
            <div class="form-group"><label class="col-lg-3 control-label">ISO:</label>

              <div class="col-lg-7">
               <input type="text"  class="form-control" name="c_iso" value="<?php echo isset($_REQUEST['cnt']) ? $arrCnt['c_iso'] : ''; ?>" required>   

             </div>
           </div>
           <div class="form-group"><label class="col-lg-3 control-label">Nicename:</label>

              <div class="col-lg-7">
               <input type="text"  class="form-control" name="c_nicename" value="<?php echo isset($_REQUEST['cnt']) ? $arrCnt['c_nicename'] : ''; ?>" >   

             </div>
           </div>
           <div class="form-group"><label class="col-lg-3 control-label">ISO3:</label>

              <div class="col-lg-7">
               <input type="text"  class="form-control" name="c_iso3" value="<?php echo isset($_REQUEST['cnt']) ? $arrCnt['c_iso3'] : ''; ?>" required>   

             </div>
           </div>
           <div class="form-group"><label class="col-lg-3 control-label">Numcode:</label>

              <div class="col-lg-7">
               <input type="text"  class="form-control" name="c_numcode" value="<?php echo isset($_REQUEST['cnt']) ? $arrCnt['c_numcode'] : ''; ?>" required>   

             </div>
           </div>
           <div class="form-group"><label class="col-lg-3 control-label">Phonecode:</label>

              <div class="col-lg-7">
               <input type="text"  class="form-control" name="c_phonecode" value="<?php echo isset($_REQUEST['cnt']) ? $arrCnt['c_phonecode'] : ''; ?>">   

             </div>
           </div>

           <div class="form-group"><label class="col-lg-3 control-label">Status:</label>

            <div class="col-lg-7"><select class="form-control" name="c_status">
              <option value="1" <?php if(isset($_REQUEST['cnt'])) $arrCnt['c_status']=="1"?'selected':''?>>Active</option>
              <option value="0" <?php if(isset($_REQUEST['cnt'])) $arrCnt['c_status']=="0"?'selected':''?>>Inactive</option>
            </select></div>
          </div>                                                             
          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="c-save">Save</button>
             <!-- <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit">Save and Continue Edit</button> -->

           </div>
         </div>

       </form>
     </div>
   </div>
 </div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>

</div> 

</div>

</body>
</html>
