<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/location.class.php');

$instApp = new app;
$initLocation = new location;

if(isset($_REQUEST['ctd'])){
  $res = $instApp->DeleteCity($_REQUEST['ctd']);
}
if (isset($_GET['state_id']) && $_GET['state_id'] > 0) {
  $resSt = $initLocation->StateWiseCity($_GET['state_id']);
} else {
  $resSt = $instApp->FetchCity();
}
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
 $title = 'City List | Tutorkami';
 require_once('includes/html_head.php'); 
 ?>
 <script>

  function getCity(val) {
    var country = $('#ud_country option:selected').val();
    location.href='city-list.php?country_id='+country+'&state_id='+val;
     /*$.ajax({
    type: "POST",
    url: "get_city.php",
    data:'state_id='+val,
    success: function(data){
      $("#st-ct-body").html(data);
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
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>

         <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
               <div class="col-lg-12">
                  <div class="ibox float-e-margins localization">
                     <div class="ibox-title">
                        <h5>City</h5>
                        <div class="el-right">
                           <a href="city-add.php" class="btn btn-primary">Add New</a>
                        </div>
                     </div>
                     <div class="ibox-content">
                        <!--  country filter start -->
                        <div class="form-horizontal">
                         <div class="form-group">
                         <label class="col-lg-3 control-label">Country Name:</label>
                            <div class="col-lg-3">
                              <select class="form-control" name="city_c_id" id="ud_country">
                                <option value="">Select Country Name</option>
                                <?php 
                                $resCnt = $instApp->FetchCountry(); 
                                while($arrCnt = $resCnt->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $arrCnt['c_id'];?>" <?PHP if($arrCnt['c_id'] == '150'){ echo 'selected'; }?>   <?php echo (isset($_GET['country_id']) && $_GET['country_id'] == $arrCnt['c_id']) ? 'selected' : '';?>><?php echo $arrCnt['c_name'];?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-lg-3">Before updating or deleting a City read this <span class="glyphicon glyphicon-info-sign" style="color:#262262" data-html="true" data-toggle="tooltip" data-placement="bottom" 
                            style="text-align:left;" title="<div class='text-justify'>
Only Super Admin can delete City. Delete a City will affect:<br><br>
1. Fields at Tutor’s profile:<br>
    &nbsp;&nbsp;&nbsp;a. Workplace Location*<br>
    &nbsp;&nbsp;&nbsp;b. Current City*<br>
    &nbsp;&nbsp;&nbsp;c. Area tutor can cover<br>
2. Field at Job’s detail<br>
    &nbsp;&nbsp;&nbsp;a. City*<br>
3. Field at Client’s detail<br>
    &nbsp;&nbsp;&nbsp;a. City*<br>
4. View Specific Price function <br>
    &nbsp;&nbsp;&nbsp;a. Delete or update the entries*<br><br>
So before you delete a City, make sure you update value for the field marked with * respectively. Otherwise error will occur in the system
                            </div>">
                            </span></div>
                            
                            
                          </div> 
                        </div>
                        <div class="form-horizontal">
                           <div class="form-group">
                              <label class="col-lg-3 control-label">State Name:</label>
                              <div class="col-lg-3">
                                 <select class="form-control" name="city_st_id" id="ud_state" onChange="getCity(this.value);">
                                    <option value="0">Select State Name</option>
                                    <?php 
                                    if(isset($_GET['country_id']) && $_GET['country_id'] != ''){
                                      $country_id = (isset($_GET['country_id']) && $_GET['country_id'] != '') ? $_GET['country_id'] : 0;
                                      $stresponse = $initLocation->CountryWiseState($country_id);
                                      if ($stresponse->num_rows > 0) {
                                        while($arrCnt = $stresponse->fetch_assoc()) {?>
                                    <option value="<?php echo $arrCnt['st_id'];?>" <?php echo (isset($_GET['state_id']) && $_GET['state_id'] == $arrCnt['st_id']) ? 'selected' : '';?>><?php echo $arrCnt['st_name'];?></option>
                                    <?php 
                                        }
                                      }
                                    } 
                                    ?>
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
                                          <th class="footable-visible footable-first-column footable-sortable">State Name<span class="footable-sort-indicator"></span></th>
                                          <th data-hide="phone" class="footable-visible footable-first-column footable-sortable">City Name<span class="footable-sort-indicator"></span></th>
                                          <th data-hide="phone,tablet" class="footable-visible footable-sortable">Active<span class="footable-sort-indicator"></span></th>
                                          <th data-hide="phone" class="footable-visible footable-sortable">Edit<span class="footable-sort-indicator"></span></th>
                                       </tr>
                                    </thead>
                                    <tbody id="st-ct-body">
                                       <?php while($arrSt = $resSt->fetch_assoc()) {
                                          $arrCnt = $instApp->GetState($arrSt['city_st_id']);
                                          ?>
                                       <tr class="footable-even" style="display: table-row;">
                                          <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                             <?php echo $arrCnt['st_name'];?>
                                          </td>
                                          <td class="footable-visible">
                                             <?php echo $arrSt['city_name'];?>
                                          </td>
                                          <td class="footable-visible">
                                             <i class="fa <?=($arrSt['city_status']=='1')?'fa-check':'fa-times'?>  text-navy"></i>
                                          </td>
                                          <td class="footable-visible footable-last-column">
                                             <div class="btn-group">
                                                <a href="city-add.php?ct=<?php echo $arrSt['city_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
                                                
<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
        $queryRole = "SELECT * FROM tk_user WHERE u_id = '".$sessionIDLogin."' "; 
        $resultRole = $conDB->query($queryRole); 
        if($resultRole->num_rows > 0){ 
            $rowRole = $resultRole->fetch_assoc();
            $userRole = $rowRole['u_role'];  
        }else{
            $userRole = '';
        }
//$dbCon->close();
if($userRole == 1){
    ?>
        <a href="city-list.php?ctd=<?php echo $arrSt['city_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>    
    <?PHP
}
?>
                                                
                                                
                                                          
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
                
                
        	$.ajax({

				url: "ajax/ajax_call.php",

				method: "POST",

				data: {action: 'get_state', country_id: '150'}, 

				success: function(result){

					$('#ud_state').html(result);

				}

	       	});
                
                
                
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
            
            
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
            
         </script>
      </div>
   </div>
</body>
</html>
