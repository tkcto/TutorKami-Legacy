<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;

$resLang = $instApp->FetchLanguage();
if(isset($_REQUEST['pm-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveContent($data);
 header('Location:content-list.php');
 exit();
}
if(isset($_REQUEST['sub'])){
 $arrCt = $instApp->GetContent($_REQUEST['sub']);
 $resCnt = $instApp->GetContentTranslationByContent($_REQUEST['sub']);
}
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Content Add | Tutorkami';
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
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5>Content</h5>
         </div>
         <div class="ibox-content">
          <form class="form-horizontal" action="" method="post">    
          <input type="hidden" name="pm_id" id="pm_id" value="<?php echo isset($_REQUEST['sub']) ? $arrCt['pm_id'] : ''; ?>">
          <div class="form-group">
              <label class="col-lg-3 control-label">Content Status:</label>
              <div class="col-lg-7">
               <select class="form-control" name="pm_status" required>
                <option value="">Select Content Status</option>
                <option value="1" <?php if(isset($_REQUEST['sub'])) echo $arrCt['pm_status']=="1"?'selected':''?>>Active</option>
                <option value="0" <?php if(isset($_REQUEST['sub'])) echo $arrCt['pm_status']=="0"?'selected':''?>>Inactive</option>
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
              <?php $j=1; if(!isset($_REQUEST['sub']))  { while($arrLang = $resLang->fetch_assoc())  { ?>
              <div id="<?=$arrLang['lang_code']?>" class="tab-pane <?php if($j==1) echo 'active'?>">
                <div class="panel-body">                                
                  <div class="form-group"><label class="col-lg-3 control-label">Pagename:</label>

              <div class="col-lg-7">
              <input type="text" class="form-control" name="pmt_pagename[<?=$arrLang['lang_code']?>]"  > 
              </div>
            </div>
            <div class="form-group"><label class="col-lg-3 control-label">Subtitle:</label>

              <div class="col-lg-7">
               <input type="text"  class="form-control" name="pmt_subtitle[<?=$arrLang['lang_code']?>]"  >   

             </div>
           </div>
           <div class="form-group"><label class="col-lg-3 control-label">Pagedetail:</label>

              <div class="col-lg-7">
               <textarea class="form-control" name="pmt_pagedetail[<?=$arrLang['lang_code']?>]"></textarea>   
             </div>
           </div>

               </div>
             </div>
             <script>
                  // Replace the <textarea id="editor1"> with a CKEditor
                  // instance, using default configuration.
                  CKEDITOR.replace('pmt_pagedetail[<?php echo $arrLang['lang_code'];?>]',{
                   allowedContent: true,
                   extraAllowedContent: 'div(*);p(*);a(*)'
                 });
              </script>
             <?php $j++;} } else{ $k = 1; while($arrCnt = $resCnt->fetch_assoc()){ ?>
             <div id="<?=$arrCnt['pmt_lang_code']?>" class="tab-pane <?php if($k==1) echo 'active'?>">
              <div class="panel-body">                                
                <div class="form-group"><label class="col-lg-3 control-label">Pagename:</label>

              <div class="col-lg-7">
              <input type="text" class="form-control" name="pmt_pagename[<?=$arrCnt['pmt_lang_code']?>]" value="<?php echo isset($_REQUEST['sub']) ? $arrCnt['pmt_pagename'] : ''; ?>" /> 
              </div>
            </div>
            <div class="form-group"><label class="col-lg-3 control-label">Subtitle:</label>

              <div class="col-lg-7">
               <input type="text"  class="form-control" name="pmt_subtitle[<?=$arrCnt['pmt_lang_code']?>]" value="<?php echo isset($_REQUEST['sub']) ? $arrCnt['pmt_subtitle'] : ''; ?>" />   

             </div>
           </div>
           <div class="form-group"><label class="col-lg-3 control-label">Pagedetail:</label>

              <div class="col-lg-7">
               <textarea class="form-control" name="pmt_pagedetail[<?=$arrCnt['pmt_lang_code']?>]"><?php echo isset($_REQUEST['sub']) ? htmlspecialchars($arrCnt['pmt_pagedetail']):''; ?></textarea>   
             </div>
           </div>

             </div>
           </div>
           <script>
              // Replace the <textarea id="editor1"> with a CKEditor
              // instance, using default configuration.
              CKEDITOR.replace('pmt_pagedetail[<?=$arrCnt['pmt_lang_code']?>]',{
                   allowedContent: true,
                   extraAllowedContent: 'div(*);p(*);a(*)'
                 });
          </script>
           <?php 
              $k++; 
              } 
            } 
            ?>
         </div>

       </div>

          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="pm-save">Save</button>
             

           </div>
         </div>

       </form>
     </div>
   </div>
 </div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>
<script>
      CKEDITOR.on('instanceReady', function(ev) {
          var jqScript = document.createElement('script');
          var bsScript = document.createElement('script');

          jqScript.src = 'js/jquery.min.js';
          bsScript.src = 'js/bootstrap.min.js';

          var editorHead = ev.editor.document.$.head;
          editorHead.appendChild(jqScript);
          editorHead.appendChild(bsScript);
       });
       // Replace the <textarea id="editor1"> with a CKEditor
       // instance, using default configuration.
       /*CKEDITOR.replace('pm_pagedetail',{
         enterMode : CKEDITOR.ENTER_BR,
         shiftEnterMode: CKEDITOR.ENTER_P,
         allowedContent: true,
         extraAllowedContent: 'div(*);p(*);a(*)'
       });*/
       
 </script>
</div> 

</div>

</body>
</html>
