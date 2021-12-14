<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
$instApp = new app;
if(isset($_REQUEST['crsd'])){
  $res = $instApp->DeleteCourse($_REQUEST['crsd']);
}

$resCourse = $instApp->FetchCourse();  
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
 $title = 'Level List | Tutorkami';
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
           <h5>Levels</h5>
           <div class="el-right">
            <a href="course-add.php" class="btn btn-primary">Add New</a>

          </div>
        </div>
        <div class="ibox-content">

         <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

          <div class="row">
           <div class="col-sm-12">
            <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded dataTables-example" data-page-size="15">
             <thead>
              <tr>
               <th class="footable-visible footable-first-column footable-sortable">Country<span class="footable-sort-indicator"></span></th>
               <th class="footable-visible footable-first-column footable-sortable">Title<span class="footable-sort-indicator"></span></th>
               <th data-hide="phone" class="footable-visible footable-sortable">Description<span class="footable-sort-indicator"></span></th>
               <th data-hide="phone,tablet" class="footable-visible footable-sortable">Active<span class="footable-sort-indicator"></span></th>
               <th data-hide="phone" class="footable-visible footable-sortable">Edit<span class="footable-sort-indicator"></span></th>
             </tr>
           </thead>
           <tbody>
            <?php while($arrCourse = $resCourse->fetch_assoc()) {?>
            <tr class="footable-even" style="display: table-row;">
             <td class="footable-visible">
               <?php echo $arrCourse['c_name'];?>
             </td>
             <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
               <?php echo $arrCourse['tc_title'];?>
             </td>
             <td class="footable-visible">
               <?php echo $arrCourse['tc_description'];?>
             </td>

             <td class="footable-visible">
               <i class="fa <?=($arrCourse['tc_status']=='A')?'fa-check':'fa-times'?>  text-navy"></i>
             </td>

             <td class="footable-visible footable-last-column">
               <div class="btn-group">
                 <a href="course-add.php?crs=<?php echo $arrCourse['tc_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
                 <a href="course-list.php?crsd=<?php echo $arrCourse['tc_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
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
<script src="js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>


<!-- Custom and plugin javascript -->

<script src="js/plugins/pace/pace.min.js"></script>

<script>
  $(document).ready(function(){
    $('.dataTables-example').DataTable({
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [
      { extend: 'copy'},
      {extend: 'csv'},
      {extend: 'excel', title: 'ExampleFile'},
      {extend: 'pdf', title: 'ExampleFile'},

      {extend: 'print',
      customize: function (win){
        $(win.document.body).addClass('white-bg');
        $(win.document.body).css('font-size', '10px');

        $(win.document.body).find('table')
        .addClass('compact')
        .css('font-size', 'inherit');
      }
    }
    ]

  });

    /* Init DataTables */
    var oTable = $('#editable').DataTable();

    /* Apply the jEditable handlers to the table */
    oTable.$('td').editable( '../example_ajax.php', {
      "callback": function( sValue, y ) {
        var aPos = oTable.fnGetPosition( this );
        oTable.fnUpdate( sValue, aPos[0], aPos[1] );
      },
      "submitdata": function ( value, settings ) {
        return {
          "row_id": this.parentNode.getAttribute('id'),
          "column": oTable.fnGetPosition( this )[2]
        };
      },

      "width": "90%",
      "height": "100%"
    } );


  });

  function fnClickAddRow() {
    $('#editable').dataTable().fnAddData( [
      "Custom row",
      "New row",
      "New row",
      "New row",
      "New row" ] );

  }
</script>

</div> 

</div>

<!-- Mainly scripts -->
</body>
</html>