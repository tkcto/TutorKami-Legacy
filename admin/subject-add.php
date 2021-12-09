<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;

$resCrs = $instApp->FetchCourse();
if(isset($_REQUEST['sub-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->SaveSubject($data);
 
 header('Location:subject-list.php');
 exit();
}
if(isset($_REQUEST['sub'])){
 $arrSub = $instApp->GetSubject($_REQUEST['sub']);
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

  <?php 
   $title = 'Subject Add | Tutorkami';
   require_once('includes/html_head.php'); 
  ?>

</head>

<body>
  <div id="wrapper">
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include_once('includes/header.php'); ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>
      
      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5>Subject Add</h5>

         </div>
         <div class="ibox-content">
          <form class="form-horizontal" action="" method="post">    <input type="hidden" name="ts_id" id="ts_id" value="<?php echo isset($_REQUEST['sub']) ? $arrSub['ts_id'] : ''; ?>">
            <?php if($_SESSION[DB_PREFIX]['r_id'] == 1) { ?>
            <div class="form-group">
               <label class="col-lg-3 control-label">Country Name:</label>
               <div class="col-lg-7">
                  <select class="form-control" name="ts_c_id" required="required">
                     <option value="">Select Country Name</option>
                     <?php 
                     $resCnt = $instApp->FetchCountry();
                     while($arrCnt = $resCnt->fetch_assoc()) {
                     ?>
                     <option value="<?php echo $arrCnt['c_id'];?>" <?php if(isset($_REQUEST['sub'])) echo ($arrSub['ts_country_id']==$arrCnt['c_id'])?'selected':''?>><?php echo $arrCnt['c_name'];?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <?php } ?>
            <div class="form-group"><label class="col-lg-3 control-label">Level:</label>
              <div class="col-lg-7">
                 <select class="form-control" name="ts_tc_id" required="required">
                    <option value="">Select Course</option>
                    <?php while($arrCrs = $resCrs->fetch_assoc()) {?>
                    <option value="<?php echo $arrCrs['tc_id'];?>" <?php if(isset($_REQUEST['sub'])) echo ($arrSub['ts_tc_id']==$arrCrs['tc_id'])?'selected':''?>><?php echo $arrCrs['tc_title'];?></option>
                    <?php } ?>
                </select> 
                </div>
            </div>                           
            <div class="form-group"><label class="col-lg-3 control-label">Subject Title:</label>

              <div class="col-lg-7"><input type="text" class="form-control" name="ts_title" value="<?php echo isset($_REQUEST['sub']) ? $arrSub['ts_title'] : ''; ?>" required> 
              </div>
            </div>
            <div class="form-group"><label class="col-lg-3 control-label">Nama Subjek:</label>

              <div class="col-lg-7">
               
               <textarea class="form-control" rows="5" name="ts_description" required><?php echo isset($_REQUEST['sub']) ? $arrSub['ts_description'] : ''; ?></textarea>   

             </div>
           </div>

           <div class="form-group"><label class="col-lg-3 control-label">Subject Status:</label>

            <div class="col-lg-7"><select class="form-control" name="ts_status">
              <option value="A" <?php if(isset($_REQUEST['sub'])) echo $arrSub['ts_status']=="A"?'selected':''?>>Active</option>
              <option value="D" <?php if(isset($_REQUEST['sub'])) echo $arrSub['ts_status']=="D"?'selected':''?>>Inactive</option>
            </select></div>
          </div>                                                             
          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="sub-save">Save</button>
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
