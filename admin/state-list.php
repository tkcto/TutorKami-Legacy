<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
$instApp = new app;
$resCnt = $instApp->FetchCountry();  
if(isset($_REQUEST['std'])){
 $res = $instApp->DeleteState($_REQUEST['std']);
}

if (isset($_GET['country_id']) && $_GET['country_id'] > 0) {
  require_once('classes/location.class.php');
  $initLocation = new location;
  $resSt = $initLocation->CountryWiseState($_GET['country_id']);
} else {
  $resSt = $instApp->FetchState();  
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
 $title = 'State List | Tutorkami';
 require_once('includes/html_head.php'); 
 ?>
 <script>

  function getState(val) {
    location.href='state-list.php?country_id='+val;

    /*$.ajax({
      type: "POST",
      url: "get_state.php",
      data:'country_id='+val,
      success: function(data){
        $("#cnt-st-body").html(data);
      }
    });*/
  }
  </script>

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
         <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
               <div class="col-lg-12">
                  <div class="ibox float-e-margins localization">
                     <div class="ibox-title">
                        <h5>State</h5>
                        <div class="el-right">
                           <a href="state-add.php" class="btn btn-primary">Add New</a>
                        </div>
                     </div>
                     <div class="ibox-content">
                      <!--  country filter start -->
                      <div class="form-horizontal">
                         <div class="form-group">
                         <label class="col-lg-3 control-label">Country Filter:</label>
                            <div class="col-lg-7">
                              <select class="form-control" name="st_c_id" onChange="getState(this.value);">
                                <option value="">Select Country Name</option>
                                <?php while($arrCnt = $resCnt->fetch_assoc()) {?>
                                <option value="<?php echo $arrCnt['c_id'];?>" <?php echo (isset($_GET['country_id']) && $_GET['country_id'] == $arrCnt['c_id']) ? 'selected' : '';?>><?php echo $arrCnt['c_name'];?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div> 
                        </div>  
                        <hr> 
                        <!--  country filter end -->  
                        <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                           <div class="row">
                              <div class="col-sm-12">
                                 <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded dataTables-example" data-page-size="15">
                                    <thead>
                                       <tr>
                                          <th class="footable-visible footable-first-column footable-sortable">Country Name<span class="footable-sort-indicator"></span></th>
                                          <th data-hide="phone" class="footable-visible footable-first-column footable-sortable">State Name<span class="footable-sort-indicator"></span></th>
                                          <th data-hide="phone,tablet" class="footable-visible footable-sortable">Active<span class="footable-sort-indicator"></span></th>
                                          <th data-hide="phone" class="footable-visible footable-sortable">Edit<span class="footable-sort-indicator"></span></th>
                                       </tr>
                                    </thead>
                                    <tbody id="cnt-st-body">
                                       <?php while($arrSt = $resSt->fetch_assoc()) {
                                          $arrCnt = $instApp->GetCountry($arrSt['st_c_id']);
                                          ?>
                                       <tr class="footable-even" style="display: table-row;">
                                          <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                             <?php echo $arrCnt['c_name'];?>
                                          </td>
                                          <td class="footable-visible">
                                             <?php echo $arrSt['st_name'];?>
                                          </td>
                                          <td class="footable-visible">
                                             <i class="fa <?=($arrSt['st_status']=='1')?'fa-check':'fa-times'?>  text-navy"></i>
                                          </td>
                                          <td class="footable-visible footable-last-column">
                                             <div class="btn-group">
                                                <a href="state-add.php?st=<?php echo $arrSt['st_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
                                                <a href="state-list.php?std=<?php echo $arrSt['st_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
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
</body>
</html>
