<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;
$userInit = new user;

if(isset($_REQUEST['st-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->edit_settings($data);

 
}
$arrCnt = $instApp->GetSettings();

$admin_info = $userInit->GetUserDetail(1);

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

    <?php 
     $title = 'Settings | Tutorkami';
     require_once('includes/html_head.php'); 
     ?>
 <script src="ckeditor/ckeditor.js"></script>

</head>

<body>
   <div id="wrapper">
      <?php include_once('includes/sidebar.php'); ?>
      <div id="page-wrapper" class="gray-bg">
         <?php include_once('includes/header.php'); ?>
         
         <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
               <div class="col-lg-12">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="ibox float-e-margins localization">
                        <div class="ibox-title">
                           <h5>Settings</h5>
                        </div>
                        <div class="ibox-content">
                           <div class="row settings-textfield-info">
                              <div class="col-md-6">
                                 <div class="form-group hidden">
                                    <label class="control-label">Company Name:</label>
                                    <input type="text" class="form-control" name="COMPANY_NAME" value="<?php echo $arrCnt['COMPANY_NAME'];?>">                                     
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label">Company Logo:</label>
                                    <input type="file" class="form-control" name="COMPANY_LOGO" >                                     
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label">Contact Email:</label>
                                    <input type="email" class="form-control" name="CONTACT_EMAIL" value="<?php echo $admin_info['u_email'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Phone No:</label>
                                    <input type="text" class="form-control" name="PHONE_NUMBER" value="<?php echo $arrCnt['PHONE_NUMBER'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Fax No:</label>
                                    <input type="text" class="form-control" name="FAX_NO" value="<?php echo $arrCnt['FAX_NO'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Address:</label>                                   
                                    <textarea class="form-control" rows="5" name="ADDRESS"><?php echo $arrCnt['ADDRESS'];?>"</textarea>                                   
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label">Google Analytics:</label>                                   
                                    <textarea class="form-control" rows="5" name="GOOGLE_ANALYTICS"><?php echo $arrCnt['GOOGLE_ANALYTICS'];?></textarea>                                   
                                 </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group hidden">
                                    <label class="control-label">Company Tagline:</label>
                                    <input type="text" class="form-control" name="TAG_LINE" value="<?php echo $arrCnt['TAG_LINE'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">SMTP Host:</label>
                                    <input type="text" class="form-control" name="SMTP_HOST" value="<?php echo $arrCnt['SMTP_HOST'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">SMTP Port:</label>
                                    <input type="Text" class="form-control" name="SMTP_PORT" value="<?php echo $arrCnt['SMTP_PORT'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">SMTP User:</label>
                                    <input type="text" class="form-control" name="SMTP_USER" value="<?php echo $arrCnt['SMTP_USER'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">SMTP Password:</label>
                                    <input type="password" class="form-control" name="SMTP_PASS" value="<?php echo $arrCnt['SMTP_PASS'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Footer Content:</label>                                   
                                    <textarea class="form-control" rows="5" name="FOOTER_CONTENT"><?php echo $arrCnt['FOOTER_CONTENT'];?></textarea>                                   
                                 </div>
                              </div>
                           </div>
                           <!-- end of settings-textfield-info --> 
                           <div class="row settings-textfield-info hidden">
                              <div class="ibox-title">
                                 <h3>Social Settings</h3>
                              </div>
                           </div>
                           <!-- end of settings-textfield-info -->                   
                           <div class="row settings-textfield-info hidden">
                              <div class="col-md-6">
                                 <div class="form-group hidden">
                                    <label class="control-label">Facebook:</label>
                                    <input type="text" class="form-control" name="FACEBOOK" value="<?php echo $arrCnt['FACEBOOK'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Twitter:</label>
                                    <input type="text" class="form-control" name="TWITTER" value="<?php echo $arrCnt['TWITTER'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Linkdin:</label>
                                    <input type="text" class="form-control" name="LINKEDIN" value="<?php echo $arrCnt['LINKEDIN'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Youtube:</label>
                                    <input type="text" class="form-control" name="YOU_TUBE" value="<?php echo $arrCnt['YOU_TUBE'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Google Plus:</label>
                                    <input type="text" class="form-control" name="GOOGLE_PLUS" value="<?php echo $arrCnt['GOOGLE_PLUS'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Instagram:</label>
                                    <input type="text" class="form-control" name="INSTAGRAM" value="<?php echo $arrCnt['INSTAGRAM'];?>">                                     
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group hidden">
                                    <label class="control-label">Pinterest:</label>
                                    <input type="text" class="form-control" name="PINTEREST" value="<?php echo $arrCnt['PINTEREST'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Tumblr:</label>
                                    <input type="text" class="form-control" name="TUMBLR" value="<?php echo $arrCnt['TUMBLR'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Flickr:</label>
                                    <input type="text" class="form-control" name="FLICKR" value="<?php echo $arrCnt['FLICKR'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Whatsapp:</label>
                                    <input type="text" class="form-control" name="WHATSAPP" value="<?php echo $arrCnt['WHATSAPP'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Android:</label>
                                    <input type="text" class="form-control" name="ANDROID" value="<?php echo $arrCnt['ANDROID'];?>">                                     
                                 </div>
                                 <div class="form-group hidden">
                                    <label class="control-label">Apple:</label>
                                    <input type="text" class="form-control" name="APPLE" value="<?php echo $arrCnt['APPLE'];?>">                                     
                                 </div>
                              </div>
                           </div>
                           <!-- end of settings-textfield-info -->
                           <div class="row settings-textfield-info">
                              <div class="form-group">
                                 <div class="col-lg-12">
                                    <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="st-save" type="submit">Save Changes</button>
                                    
                                 </div>
                              </div>
                           </div>
                           <!-- end of settings-textfield-info -->
                        </div>
                        <!-- end ibox-content -->
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <?php include_once('includes/footer.php'); ?>
         <script>
               // Replace the <textarea id="editor1"> with a CKEditor
               // instance, using default configuration.
               CKEDITOR.replace('FOOTER_CONTENT');
               CKEDITOR.replace('ADDRESS');
         </script>
      </div>
   </div>
   <!-- Mainly scripts -->
   
</body>
</html>
