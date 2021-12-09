<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;


if(isset($_REQUEST['lang-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveLanguage($data,$_FILES);
 //echo $res;
 header('Location:language-add.php');
 exit();
}
if(isset($_REQUEST['lan'])){
  $arrLang = $instApp->GetLanguage($_REQUEST['lan']);
}
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
   $title = 'Language Add | Tutorkami';
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
if ( $conDB->query($updateLastPage) === TRUE ) {
    //echo "Update Is Successful";
}
//$dbCon->close();
?>

      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5>Languages</h5>

         </div>
         <div class="ibox-content">
          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">    <input type="hidden" name="lang_id" id="lang_id" value="<?php echo isset($_REQUEST['lan']) ? $arrLang['lang_id'] : ''; ?>">
            <div class="form-group"><label class="col-lg-3 control-label" >Flag:</label>
              <div class="col-lg-7">                                    
                <div class="custom-file-upload">                                       
                  <input type="file" id="upload" name="lang_flag"/>
                </div>
              </div>
            </div>                           
            <div class="form-group"><label class="col-lg-3 control-label">Name:</label>

              <div class="col-lg-7"><input type="text" class="form-control" name="lang_name" value="<?php echo isset($_REQUEST['lan']) ? $arrLang['lang_name'] : ''; ?>" required> 
              </div>
            </div>
            <div class="form-group"><label class="col-lg-3 control-label">Language code:</label>

              <div class="col-lg-7">
               <input type="text"  class="form-control" name="lang_code" value="<?php echo isset($_REQUEST['lan']) ? $arrLang['lang_code'] : ''; ?>" required>   

             </div>
           </div>

           <div class="form-group"><label class="col-lg-3 control-label">Status:</label>

            <div class="col-lg-7"><select class="form-control" name="lang_status">
              <option value="active" <?php if(isset($_REQUEST['lan'])) echo $arrLang['lang_status']=="active"?'selected':''?>>Active</option>
              <option value="inactive" <?php if(isset($_REQUEST['lan'])) echo $arrLang['lang_status']=="inactive"?'selected':''?>>Inactive</option>
              <option value="default" <?php if(isset($_REQUEST['lan'])) echo $arrLang['lang_status']=="default"?'selected':''?>>Default</option>
            </select></div>
          </div>                                                             
          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="lang-save">Save</button>
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
