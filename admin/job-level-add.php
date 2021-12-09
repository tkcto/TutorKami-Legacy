<?php require_once('includes/head.php'); 
require_once('classes/app.class.php');
require_once('classes/job.class.php');
$instApp = new app;
$instJob = new job;

$resLang = $instApp->FetchLanguage();
if(isset($_REQUEST['jl-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instJob->SaveJobLevel($data);
 header('Location:job-level-list.php');
 exit();
}
if(isset($_REQUEST['jl'])){
  $arrJl = $instJob->GetJobLevel($_REQUEST['jl']);
  $resJlt = $instJob->GetJobLevelTranslationByJobLevel($_REQUEST['jl']);
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Job Level Add | Tutorkami';
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
          <form action="" method="post" class="form-horizontal">
           <input type="hidden" name="jl_id" id="jl_id" value="<?php echo isset($_REQUEST['jl']) ? $arrJl['jl_id'] : ''; ?>"> 
           <div class="ibox float-e-margins localization">
            <div class="ibox-title">
              <h5>Job Level</h5>                       
            </div>  

            <div class="ibox-content"> 

             <div class="form-group"><label class="col-lg-3 control-label">Job Level Status:</label>

              <div class="col-lg-7">
               <select class="form-control" name="jl_status" required="">
                <option value="">Select Job Level Status</option>
                <option value="A" <?php if(isset($_REQUEST['jl'])) echo $arrJl['jl_status']=="A"?'selected':''?>>Active</option>
                <option value="D" <?php if(isset($_REQUEST['jl'])) echo $arrJl['jl_status']=="D"?'selected':''?>>Inactive</option>                                       
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
              <?php $j=1; if(!isset($_REQUEST['jl']))  { while($arrLang = $resLang->fetch_assoc())  { ?>
              <div id="<?=$arrLang['lang_code']?>" class="tab-pane <?php if($j==1) echo 'active'?>">
                <div class="panel-body">                                
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Title:</label>

                    <div class="col-lg-7"><input type="text" class="form-control" name="jl-tl[<?=$arrLang['lang_code']?>]" > 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Description:</label>

                    <div class="col-lg-7">
                     <textarea class="form-control" rows="5" name="jl-ds[<?=$arrLang['lang_code']?>]" ></textarea>
                   </div>
                 </div>

               </div>
             </div>
             <?php $j++;} } else{ $k = 1; while($arrJlt = $resJlt->fetch_assoc()){ ?>
             <div id="<?=$arrJlt['jlt_lang_code']?>" class="tab-pane <?php if($k==1) echo 'active'?>">
              <div class="panel-body">                                
                <div class="form-group">
                  <label class="col-lg-3 control-label">Title:</label>

                  <div class="col-lg-7"><input type="text" class="form-control" name="jl-tl[<?=$arrJlt['jlt_lang_code']?>]" value="<?php echo isset($_REQUEST['jl']) ? $arrJlt['jlt_title'] : ''; ?>" > 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label" >Description:</label>

                  <div class="col-lg-7">
                   <textarea class="form-control" rows="5" name="jl-ds[<?=$arrJlt['jlt_lang_code']?>]" ><?php echo isset($_REQUEST['jl']) ? $arrJlt['jlt_description'] : ''; ?></textarea>
                 </div>
               </div>

             </div>
           </div>

           <?php $k++; } } ?>


         </div>

       </div>

       <div class="form-group mrg-top-30">
        <div class="col-lg-offset-3 col-lg-9">
          <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="jl-save" type="submit">Save</button>
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

<!-- Mainly scripts -->


<script type="text/javascript">
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
          if ( !multipleSupport ) {
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
