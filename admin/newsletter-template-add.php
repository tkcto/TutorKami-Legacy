<?php
require_once('includes/head.php');
require_once('classes/app.class.php');
require_once('classes/user.class.php');
require_once('classes/newsletter.class.php');
$insUser  = new user;
$instNews = new newsletter;
$instApp = new app;

$resLang = $instApp->FetchLanguage();
$arrUser = $insUser->GetUserDetail($_SESSION[DB_PREFIX]['u_id']);
if(isset($_REQUEST['nt-save'])){
   $data = $instNews->RealEscape($_REQUEST);
   $res = $instNews->SaveNewsletterTemplate($data);

   header('Location:newsletter-template-list.php');
   exit();
}
if(isset($_REQUEST['nwt'])){
   $arrNt = $instNews->GetNewsTemplate($_REQUEST['nwt']);
  $resNtt = $instNews->GetNewsTemplateTranslationByNewsTemplate($_REQUEST['nwt']);
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <?php 
    $title = 'Newsletter Template  Add | Tutorkami';
    require_once('includes/html_head.php'); 
  ?>
  <script src="ckeditor/ckeditor.js"></script>
</head>
<body>
   <div id="wrapper">
      <?php include_once('includes/sidebar.php');?>
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
                  <form action="" method="post" class="form-horizontal">
                     <div class="ibox float-e-margins localization">
                        <div class="ibox-title">
                           <h5>Newsletter Template Add</h5>
                        </div>
                        <div class="ibox-content">
                           <input type="hidden" name="nwtemp_id" id="nwtemp_id" value="<?php echo isset($_REQUEST['nwt']) ? $arrNt['nwtemp_id'] : ''; ?>">
                           <div class="form-group">
                              <label class="col-lg-3 control-label">Email Account:</label>
                              <div class="col-lg-7">
                                 <input type="email" class="form-control" name="nwtemp_email_account" value="<?=$arrUser['u_email']?>" readonly> 
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-lg-3 control-label">Bcc:</label>
                              <div class="col-lg-7">
                                 <input type="email" class="form-control" name="nwtemp_bcc" value="<?php echo isset($_REQUEST['nwt']) ? $arrNt['nwtemp_bcc'] : ''; ?>">  
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-lg-3 control-label"> Status:</label>
                              <div class="col-lg-7">
                                 <select class="form-control" name="nwtemp_status">
                                    <option value="A" <?php if(isset($_REQUEST['nwt'])) echo $arrNt['nwtemp_status']=="A"?'selected':''?>>Active</option>
                                    <option value="D" <?php if(isset($_REQUEST['nwt'])) echo $arrNt['nwtemp_status']=="D"?'selected':''?>>Inactive</option>
                                 </select>
                              </div>
                           </div>
                           <div class="tabs-container mrg-top-30">
                              <ul class="nav nav-tabs">
                                 <?php $i =1; while($arrLang = $resLang->fetch_assoc()){ ?>
                                 <li <?php if($i==1) {?> class="active"<?php } ?>><a data-toggle="tab" href="#<?=$arrLang['lang_code']?>"><?=$arrLang['lang_name']?></a></li>
                                 <?php $i++;} $resLang->data_seek(0); ?>
                              </ul>
                              <div class="tab-content">
                                 <?php $j=1; if(!isset($_REQUEST['nwt']))  { while($arrLang = $resLang->fetch_assoc())  { ?>
                                 <div id="<?=$arrLang['lang_code']?>" class="tab-pane <?php if($j==1) echo 'active'?>">
                                    <div class="panel-body">
                                       <div class="form-group">
                                          <label class="col-lg-3 control-label" >Subject:</label>
                                          <div class="col-lg-7"><input type="text" class="form-control" name="ntt_subject[<?=$arrLang['lang_code']?>]" > 
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-lg-3 control-label" >Body:</label>
                                          <div class="col-lg-7">
                                             <textarea class="form-control" rows="5" name="ntt_content_body[<?=$arrLang['lang_code']?>]" >This is my textarea to be replaced with CKEditor.</textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- for ckeditor -->
                                 <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace('ntt_content_body[<?php echo $arrLang['lang_code'];?>]');
                                 </script>
                                 <?php $j++;} } else{ $k = 1; while($arrNtt = $resNtt->fetch_assoc()){ ?>
                                 <div id="<?=$arrNtt['ntt_lang_code']?>" class="tab-pane <?php if($k==1) echo 'active'?>">
                                    <div class="panel-body">
                                       <div class="form-group">
                                          <label class="col-lg-3 control-label">Subject:</label>
                                          <div class="col-lg-7"><input type="text" class="form-control" name="ntt_subject[<?=$arrNtt['ntt_lang_code']?>]" value="<?php echo isset($_REQUEST['nwt']) ? $arrNtt['ntt_subject'] : ''; ?>" > 
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-lg-3 control-label" >Body:</label>
                                          <div class="col-lg-7">
                                             <textarea class="form-control" rows="5" name="ntt_content_body[<?=$arrNtt['ntt_lang_code']?>]" ><?php echo isset($_REQUEST['nwt']) ? $arrNtt['ntt_content_body'] : ''; ?></textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- for ckeditor -->
                                 <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace('ntt_content_body[<?php echo $arrNtt['ntt_lang_code'];?>]');
                                 </script>
                                 <?php $k++; } } ?>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-3 col-lg-9">
                                 <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="nt-save" type="submit">Save</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <?php include_once('includes/footer.php'); ?>
      </div>
   </div>
</body>
</html>
