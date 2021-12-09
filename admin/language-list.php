<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
$instApp = new app;
if(isset($_REQUEST['land'])){
  $res = $instApp->DeleteLanguage($_REQUEST['land']);
}

$resLang = $instApp->FetchLanguage();  
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
   $title = 'Language List | Tutorkami';
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
                 <div class="el-right">
                  <a href="language-add.php" class="btn btn-primary">Add New</a>
                  
              </div>
          </div>
          <div class="ibox-content">

             <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
              
<div class="row">
   <div class="col-sm-12">
    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded" data-page-size="15">
     <thead>
      <tr>
       <th class="footable-visible footable-first-column footable-sortable">Flag<span class="footable-sort-indicator"></span></th>
       <th class="footable-visible footable-first-column footable-sortable">Name<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">Language code<span class="footable-sort-indicator"></span></th>
       <th>View string resources</th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Active<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">Edit<span class="footable-sort-indicator"></span></th>

   </tr>
</thead>
<tbody>
  <?php while($arrLang = $resLang->fetch_assoc()) {?>
  <tr class="footable-even" style="display: table-row;">
   <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
     
   <img src="<?php echo $arrLang['lang_flag'];?>" alt="flag-img" class="sdl-user">
   </td>
   <td class="footable-visible">
     <?php echo $arrLang['lang_name'];?>
  </td>
  <td class="footable-visible">
     <?php echo $arrLang['lang_code'];?>
  </td>
  <td class="footable-visible">
     <a href="resource-manage.php?lang=<?php echo $arrLang['lang_code'];?>">View string resources</a>
  </td>

  <td class="footable-visible">
     <i class="fa <?=($arrLang['lang_status']=='active')?'fa-check':'fa-times'?>  text-navy"></i>
  </td>

  <td class="footable-visible footable-last-column">
   <div class="btn-group">
     <a href="language-add.php?lan=<?php echo $arrLang['lang_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
     <a href="language-list.php?land=<?php echo $arrLang['lang_id'];?>" class="gray-text" <?php if($arrLang['lang_status']=='default') {?> style='display: none;' <?php } ?>><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
 </div>
 </td>
</tr>
<?php } ?>


</tbody>

</table>

</div>
</div>                  
</div>
</div>
</div>
</div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>

</div> 

</div>

<!-- Mainly scripts -->



</body>
</html>
