<?php 
 require_once('includes/head.php');
 require_once('classes/app.class.php');
 
 $instApp = new app;

 $resLang = $instApp->FetchLanguage();

 $resSub = $instApp->FetchSEOContent();
 $lang_code = (isset($_GET['lang']) && $_GET['lang'] != '') ? $_GET['lang'] : 'en';
 
 if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
 ?>
<!DOCTYPE html>
<html>
   <head>
      <?php 
         $title = 'SEO Mangement | Tutorkami';
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
                     <div class="ibox float-e-margins localization">
                        <div class="ibox-title">
                           <h5>SEO Mangement</h5>
                           <div class="ibox-tools">
                             <form action="">
                               <label>
                                 Select a Language:
                                 <select name="lang" onchange="this.form.submit()">
                                   <?php while($arrLang = $resLang->fetch_assoc()) {?>
                                    <option value="<?php echo $arrLang['lang_code'];?>" <?php echo (isset($_GET['lang']) && $_GET['lang'] == $arrLang['lang_code']) ? 'selected' : '';?>><?php echo $arrLang['lang_name'];?></option>
                                   <?php } ?>
                                 </select>
                               </label>
                               
                             </form>
                           </div>
                        </div>
                        <div class="ibox-content">
                           <table class="table table-striped table-bordered table-hover " id="editable" >
                              <thead>
                                 <tr>
                                    <th>Page</th>
                                    <th>Meta Title</th>
                                    <th>Meta Description</th>
                                    <th>Meta Keyword</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php while($arrSub = $resSub->fetch_assoc()) {
                                    $defaultLangContent = $instApp->GetLanguageSEOContent($arrSub['sm_id'], $lang_code);?>
                                 <tr id="<?=$arrSub['sm_id'];?>" lang="<?=$defaultLangContent['smt_id'];?>">
                                    <td>
                                       <?=$arrSub['sm_target_page']?>
                                    </td>
                                    <td class="edit_able"><?=$defaultLangContent['smt_meta_title']?></td>
                                    <td class="edit_able"><?=$defaultLangContent['smt_meta_description'];?></td>
                                    <td class="edit_able"><?=$defaultLangContent['smt_meta_keyword'];?></td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
            <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
            <script src="js/plugins/dataTables/datatables.min.js"></script>
            <!-- Custom and plugin javascript -->
            <script src="js/plugins/pace/pace.min.js"></script>
            <script>
               $(document).ready(function(){
                 /* Init DataTables */
                 var oTable = $('#editable').dataTable();
                 /* Apply the jEditable handlers to the table */
                 oTable.$('td.edit_able').editable( 'ajax/ajax_call.php', {
                   "callback": function( sValue, y ) {
                     var aPos = oTable.fnGetPosition( this );
                     oTable.fnUpdate( sValue, aPos[0], aPos[1], false );
                     $('#hider, #loadermodaldiv').hide();
                   },
                   "submitdata": function ( value, settings ) {
                      $('#hider, #loadermodaldiv').show();
                     return {
                       "action" : 'update_seo_data',
                       "lang_id": this.parentNode.getAttribute('lang'),
                       "row_id" : this.parentNode.getAttribute('id'),
                       "column" : oTable.fnGetPosition( this )[2]
                     };
                   },
                   "width": "90%",
                   "height": "100%"
                 });
               });
            </script>
         </div>
      </div>
      <div class="loaderBackground" id="hider" style="display: none;"></div>
      <div class="loaderpop" id="loadermodaldiv" style="display: none;">
         <h4><img src="img/loading.svg" style="width: 50px;" />Loading...</h4>
      </div>
   </body>
</html>