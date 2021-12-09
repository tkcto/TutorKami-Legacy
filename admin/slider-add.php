<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;

$resLang = $instApp->FetchLanguage();
if(isset($_REQUEST['sl-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveSlider($data,$_FILES);
 header('Location:slider-list.php');
 exit();
}
if(isset($_REQUEST['sl'])){
  $arrSl = $instApp->GetSlider($_REQUEST['sl']);
  $resSlt = $instApp->GetSliderTranslationBySlider($_REQUEST['sl']);
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Slider Add | Tutorkami';
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
           <h5>Slider</h5>

         </div>
         <div class="ibox-content">
          <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" name="sl-add" id="frmMain">
            <input type="hidden" name="sl_id" id="sl_id" value="<?php echo isset($_REQUEST['sl']) ? $arrSl['sl_id'] : ''; ?>">
            <div class="form-group"><label class="col-lg-3 control-label" >Slider Image:</label>

              <div class="col-lg-7">                                    
                <div class="custom-file-upload">                                       
                  <input type="file" id="upload" name="sl_image" data-required />
                </div>
                <span class="help-block m-b-none">Recommended size 1920 x 1000 .</span>
              </div>
            </div>

            <div class="form-group"><label class="col-lg-3 control-label">Slider status:</label>

              <div class="col-lg-7">
               <select class="form-control" name="sl_status">
                <option value="A" <?php if(isset($_REQUEST['sl'])) echo $arrSl['sl_status']=="A"?'selected':''?>>Active</option>
                <option value="D" <?php if(isset($_REQUEST['sl'])) echo $arrSl['sl_status']=="D"?'selected':''?>>Inactive</option>                                       
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
              <?php $j=1; if(!isset($_REQUEST['sl']))  { while($arrLang = $resLang->fetch_assoc())  { ?>
              <div id="<?=$arrLang['lang_code']?>" class="tab-pane <?php if($j==1) echo 'active'?>">
                <div class="panel-body">                                
                  <div class="form-group">
                    <label class="col-lg-3 control-label" >Title:</label>

                    <div class="col-lg-7"><input type="text" class="form-control" name="sl-tl[<?=$arrLang['lang_code']?>]" > 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label" >Description:</label>

                    <div class="col-lg-7">
                     <textarea class="form-control" rows="5" name="sl-ds[<?=$arrLang['lang_code']?>]" ></textarea>
                   </div>
                 </div>

               </div>
             </div>
             <?php $j++;} } else{ $k = 1; while($arrSlt = $resSlt->fetch_assoc()){ ?>
              <div id="<?=$arrSlt['slt_lang_code']?>" class="tab-pane <?php if($k==1) echo 'active'?>">
                <div class="panel-body">                                
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Title:</label>

                    <div class="col-lg-7"><input type="text" class="form-control" name="sl-tl[<?=$arrSlt['slt_lang_code']?>]" value="<?php echo isset($_REQUEST['sl']) ? $arrSlt['slt_title'] : ''; ?>" > 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label" >Description:</label>

                    <div class="col-lg-7">
                     <textarea class="form-control" rows="5" name="sl-ds[<?=$arrSlt['slt_lang_code']?>]" ><?php echo isset($_REQUEST['sl']) ? $arrSlt['slt_description'] : ''; ?></textarea>
                   </div>
                 </div>

               </div>
             </div>
             
         <?php $k++; } } ?>

           
       </div>

     </div>

     <div class="form-group mrg-top-30">
      <div class="col-lg-offset-3 col-lg-9">
        <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="sl-save" type="submit">Save</button>
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
<script type="text/javascript">
$(document).ready(function(){
  $('form#frmMain').submit(function(){
      var error = 0;
      var errEl = '';
      var reg_number = /^[0-9]+$/;
      var reg_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      var elem = document.getElementById('frmMain').elements;
      for(var i = 0; i < elem.length; i++) {
         if (elem[i].hasAttribute("data-required")) {
            if (elem[i].type == 'radio' || elem[i].type == 'checkbox') {
               var elemName = document.getElementsByName(elem[i].name);
               var r_err = 0;
               for(var k = 0; k < elemName.length; k++) {
                  // alert(k+'='+elemName[k].checked)
                  if (elemName[k].checked == false) {
                     r_err++;
                  }  
               }
               // alert(r_err+'='+elemName.length)
               if (r_err == elemName.length) {
                  if (elemName != errEl) {
                     error++;
                     errEl = elemName;
                     var field_name  = elem[i].name;
                     var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                         filed_label = filed_label.split('_').join(' ');
                         filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

                     getStickyNote ('error', filed_label + ' is required');   
                  }
                  
               }

            } else if(elem[i].value == '') {
               error++;
               var field_name  = elem[i].name;
               var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                   filed_label = filed_label.split('_').join(' ');
                   filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

               getStickyNote ('error', filed_label + ' is required');
            }
         }

         if(elem[i].hasAttribute("data-numeric") && !elem[i].value.match(reg_number)) {
            error++;
            var field_name  = elem[i].name;
            var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                filed_label = filed_label.split('_').join(' ');
                filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

            getStickyNote ('error', filed_label + ' must be numeric');
         }

         if(elem[i].hasAttribute("data-email") && !elem[i].value.match(reg_email)) {
            error++;
            var field_name  = elem[i].name;
            var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                filed_label = filed_label.split('_').join(' ');
                filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

            getStickyNote ('error', filed_label + ' must be valid email');
         }
      }

      if (error > 0) {
         return false;  
      }
   });
});

    ;(function($) {

          // Browser supports HTML5 multiple file?
          var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
              isIE = /msie/i.test( navigator.userAgent );

          $.fn.customFile = function() {

            return this.each(function() {

              var $file = $(this).addClass('custom-file-upload-hidden'), // the original file input
                  $wrap = $('<div class="file-upload-wrapper">'),
                  $input = $('<input type="text" class="file-upload-input" />'),
                  // Button that will be used in non-IE browsers
                  $button = $('<button type="button" class="file-upload-button">Select a File</button>'),
                  // Hack for IE
                  $label = $('<label class="file-upload-button" for="'+ $file[0].id +'">Select a File</label>');

              // Hide by shifting to the left so we
              // can still trigger events
              $file.css({
                position: 'absolute',
                left: '-9999px'
              });

              $wrap.insertAfter( $file )
                .append( $file, $input, ( isIE ? $label : $button ) );

              // Prevent focus
              $file.attr('tabIndex', -1);
              $button.attr('tabIndex', -1);

              $button.click(function () {
                $file.focus().click(); // Open dialog
              });

              $file.change(function() {

                var files = [], fileArr, filename;

                // If multiple is supported then extract
                // all filenames from the file array
                if ( multipleSupport ) {
                  fileArr = $file[0].files;
                  for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                    files.push( fileArr[i].name );
                  }
                  filename = files.join(', ');

                // If not supported then just take the value
                // and remove the path to just show the filename
                } else {
                  filename = $file.val().split('\\').pop();
                }

                $input.val( filename ) // Set the value
                  .attr('title', filename) // Show filename in title tootlip
                  .focus(); // Regain focus

              });

              $input.on({
                blur: function() { $file.trigger('blur'); },
                keydown: function( e ) {
                  if ( e.which === 13 ) { // Enter
                    if ( !isIE ) { $file.trigger('click'); }
                  } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
                    // On some browsers the value is read-only
                    // with this trick we remove the old input and add
                    // a clean clone with all the original events attached
                    $file.replaceWith( $file = $file.clone( true ) );
                    $file.trigger('change');
                    $input.val('');
                  } else if ( e.which === 9 ){ // TAB
                    return;
                  } else { // All other keys
                    return false;
                  }
                }
              });

            });

          };

          // Old browser fallback
          if (!multipleSupport) {
            $( document ).on('change', 'input.customfile', function() {

              var $this = $(this),
                  // Create a unique ID so we
                  // can attach the label to the input
                  uniqId = 'customfile_'+ (new Date()).getTime(),
                  $wrap = $this.parent(),

                  // Filter empty input
                  $inputs = $wrap.siblings().find('.file-upload-input')
                    .filter(function(){ return !this.value }),

                  $file = $('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

              // 1ms timeout so it runs after all other events
              // that modify the value have triggered
              setTimeout(function() {
                // Add a new input
                if ( $this.val() ) {
                  // Check for empty fields to prevent
                  // creating new inputs when changing files
                  if ( !$inputs.length ) {
                    $wrap.after( $file );
                    $file.customFile();
                  }
                // Remove and reorganize inputs
                } else {
                  $inputs.parent().remove();
                  // Move the input so it's always last on the list
                  $wrap.appendTo( $wrap.parent() );
                  $wrap.find('input').focus();
                }
              }, 1);

            });
          }

}(jQuery));

$('input[type=file]').customFile();


    </script>

</body>
</html>
