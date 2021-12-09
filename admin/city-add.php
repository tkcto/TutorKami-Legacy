<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;
 
if(isset($_REQUEST['ct-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveCity($data);
 if ($res != false) {
   
   header('Location:city-list.php');
   exit();
 }
}
if(isset($_REQUEST['ct'])){
  $arrCt = $instApp->GetCity($_REQUEST['ct']);
}
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php 
  $title = 'City Add | Tutorkami';
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
                        <h5>City</h5>
                     </div>
                     <div class="ibox-content">
                        <form class="form-horizontal" action="" method="post">
                           <input type="hidden" name="ct_id" id="ct_id" value="<?php echo isset($_REQUEST['ct']) ? $arrCt['city_id'] : ''; ?>">
                           <div class="form-group">
                              <label class="col-lg-3 control-label">Country name:</label>
                              <div class="col-lg-7">
                                 <select class="form-control" name="city_c_id" required="required" id="ud_country">
                                    <option value="">Select Country Name</option>
                                    <?php 
                                    $resCnt = $instApp->FetchCountry();
                                    while($arrCnt = $resCnt->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $arrCnt['c_id'];?>" <?php if(isset($_REQUEST['ct'])){ echo ($arrCnt['c_id']==$arrCt['city_c_id'])?'selected':''; }else{ echo ($arrCnt['c_id']=='150')?'selected':''; }   ?> ><?php echo $arrCnt['c_name'];?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-lg-3 control-label">State name:</label>
                              <div class="col-lg-7">
                                 <select class="form-control" name="city_st_id" required="required" id="ud_state">
                                    <option value="">Select State Name</option>
                                    <?php 
                                    $resSt = $instApp->FetchState();
                                    while($arrSt = $resSt->fetch_assoc()) { 
                                    ?>
                                    <option value="<?php echo $arrSt['st_id'];?>" <?php if(isset($_REQUEST['ct'])) echo ($arrSt['st_id']==$arrCt['city_st_id'])?'selected':''?>><?php echo $arrSt['st_name'];?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-lg-3 control-label">City name:</label>
                              <div class="col-lg-7">
                                 <input type="text" class="form-control" name="city_name" value="<?php echo isset($_REQUEST['ct']) ? $arrCt['city_name'] : ''; ?>" required>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-lg-3 control-label">Status:</label>
                              <div class="col-lg-7">
                                 <select class="form-control" name="city_status">
                                    <option value="1" <?php if(isset($_REQUEST['ct'])) $arrCt['city_status']=="1"?'selected':''?>>Active</option>
                                    <option value="0" <?php if(isset($_REQUEST['ct'])) $arrCt['city_status']=="0"?'selected':''?>>Inactive</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-3 col-lg-9">

                                 <?PHP  
                                 if( $sessionIDLogin == 1){
                                     ?>
                                        <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="ct-save">Save</button>
                                     <?PHP
                                 }else{
                                     echo '<div class="col-xs-7 alert alert-danger" role="alert"><center>Only <strong>Super Admin</strong> can add a City, please contact <strong>GM</strong></center></div>';
                                 }
                                 ?>
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
