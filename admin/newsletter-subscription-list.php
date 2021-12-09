<?php
require_once('includes/head.php');

require_once('classes/newsletter.class.php');
$instNews = new newsletter;
$resNwtt = $instNews->ListNewsletterTemplate();


if(isset($_GET['nwd'])){
    $res = $instNews->DeleteNewsletterSubscription($_GET['nwd']);
}


 if(isset($_POST) && isset($_POST['nwt-send'])) {
  
    $recepients = '';
    foreach($_POST['nwt_send'] as $key=>$value){
        $arrSub = $instNews->GetNewsletterSubscription($key);
        $Sub[] = $arrSub['news_email'];

    }
    //$recepients = implode(',',$Sub);
    
   if(isset($_POST['nwt-send'])){

    
    $arrTemp = $instNews->GetNewsTemplateTranslation($_POST['ntt_id']);
    
    
    $subject = $arrTemp['ntt_subject'];
    $message = $arrTemp['ntt_content_body'];
    $m = $instNews->sendNewsletterEmailTemplate('',$Sub,$subject,$message);
    
    
    if($m){
        $msg = '<div class="alert alert-success">Mail been sent successfully!</div>';
        }
    else{
        $msg = '<div class="alert alert-danger">Mail cannot be sent!</div>';
        }
    }
  else{
      $msg = '<div class="alert alert-warning">No recipient selected!</div>';
  }
    
}


 if(isset($_POST['sub-list-imp'])){
    $arrFileData = $fields = array(); $i = 0; $j = 0;
    $handle = @fopen($_FILES['importcsvfile']['tmp_name'], "r");
    if ($handle) {
        while (($row = fgetcsv($handle, 4096)) !== false) {
            if (empty($fields)) {
                $fields = $row;
                continue;
            }
            foreach ($row as $k=>$value) {
                $arrFileData[$i][$fields[$k]] = $value;
            }
            $i++;
        }
        if (!feof($handle)) {
            echo "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
    }
    

    while($j < sizeOf($arrFileData))
    {
      if($arrFileData[$j]['Email']==''){
        echo 'Email field is mandatory!';
        break;
      }
      if($arrFileData[$j]['Status'] =='')
      {
        echo 'Status field is mandatory!';
        break;
      }
      else
      {
          $csvFormat = 1;
      }
      $j++;
    }

    $data = $instNews->RealEscape($arrFileData);
    $res =  $instNews->SaveSubscribers($data);
}




if(isset($_REQUEST['n-save'])){
 $data = $instNews->RealEscape($_REQUEST);
 $res = $instNews->UpdateNewletter($data);
 header('Location:newsletter-subscription-list.php');
 exit();
}

if(isset($_REQUEST['nw'])){
  $arrNews = $instNews->GetNewsletterSubscription($_REQUEST['nw']);
}
if(isset($_POST['n-search'])){
 $resNews = $instNews->SearchSubscribersByEmail($_POST['u_email']);
}
else{
 $resNews = $instNews->FetchNewletterSubscribersList();
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
   <head>
      <?php 
         $title = 'Newsletter Subsription  List | Tutorkami';
         require_once('includes/html_head.php'); 
         ?>
      <script type="text/javascript">
         $(document).ready(function(){
          $("#checkAll").click(function () {
             $('input:checkbox').not(this).prop('checked', this.checked);
            })
          $("#export").click(function(){
              $("#subtable").tableToCSV();
            });
         
          });
         
      </script>
   </head>
   <body>
      <div id="wrapper">
         <?php include_once('includes/sidebar.php');?>
         <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php'); ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = 'Subscriber&#039;s List Page';//$breadcrumb['m_name'].' Page';
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>

            <?php if(isset($_REQUEST['nwe'])) { 
               include_once("newsletter-subscription-edit.php");
               } else{ ?>
            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox float-e-margins localization">
                        <div class="ibox-title">
                           <h5>Newsletter Subscribers</h5>
                           <div class="ibox-tools">
                              <button class="btn btn-success" id="export" type="button"><i class="fa fa-download"></i>Export to CSV</button> 
                              <div class="btn btn-primary " onclick="fnClickAddRow();" href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> Import form CSV</div>
                           </div>
                           <!-- Modal -->
                           <div id="myModal" class="modal fade" role="dialog">
                              <div class="modal-dialog modal-lg">
                                 <!-- Modal content-->
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title">Import from CSV</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form class="form-horizontal" method="post" action="newsletter-subscription-list.php" enctype="multipart/form-data">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-2"> CSV file:</div>
                                                <div class="col-md-10"> <input type="file" id="importcsvfile" name="importcsvfile"></div>
                                             </div>
                                             <input type="submit" class="t-button" value="Import from CSV" name="sub-list-imp">
                                          </div>
                                       </form>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="ibox-content">
                           <form action="" method="post">
                              <div class="form-horizontal">
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Email:</label>
                                    <div class="col-lg-4">
                                       <input type="text" class="form-control" name="u_email"> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-3">
                                       <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="n-search">Search</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="ibox-content">
                           <form action="" method="post" class="form-horizontal">
                              <?php if(isset($_REQUEST) && isset($_REQUEST['nwt-send'])) { echo $msg; }?>
                              <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover dataTables-example activity-table-list" id="subtable">
                                    <thead>
                                       <tr>
                                          <th data-hide="phone" class="footable-visible footable-sortable">Select All<span class="mrgleft-10"><input type="checkbox" value="" id="checkAll" name="checkAll"></span></th>
                                          <th>Group</th>
                                          <th>Level</th>
                                          <th>IdNumber</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Active</th>
                                          <th>Subscribed on</th>
                                          <th>Edit</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php while($arrNews = $resNews->fetch_assoc()){?>
                                       <tr class="gradeX">
                                          <td class="footable-visible">
                                             <input type="checkbox" value="" name="nwt_send[<?=$arrNews['news_id']?>]">
                                          </td>
                                          <td><?=$arrNews['news_group']?></td>
                                          <td><?=$arrNews['news_level']?></td>
                                          <td><?=$arrNews['news_id_numer']?></td>
                                          <td><?=$arrNews['news_name']?></td>
                                          <td><?=$arrNews['news_email']?></td>
                                          <td><i class="fa <?=($arrNews['news_status']=='A')?'fa-check':'fa-times'?> text-navy fa-2x" aria-hidden="true"></i></td>
                                          <td><?=$arrNews['news_create_date']?></td>
                                          <td>
                                             <a href="newsletter-subscription-list.php?nw=<?php echo $arrNews['news_id'];?>&nwe" class="gray-text"><button class="btn-white btn edt-btn btn-xs" type="button">Edit</button></a>
                                             <a href="javascript:void(0);" title="Delete" onClick="if(confirm('Are you sure, you want to remove the data?'))document.location.href='newsletter-subscription-list.php?nwd=<?php echo $arrNews['news_id'];?>'" class="btn-white btn edt-btn btn-xs gray-text">Delete</a>
                                          </td>
                                       </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                              <p>Select the checkboxes from the list to whom you wish to send the Template.</p>
                              <div class="form-group">
                                 <label class="col-md-3 control-label">Email Template:</label>
                                 <div class="col-md-6">
                                    <select class="form-control" name="ntt_id">
                                       <option value="">Select Email Template</option>
                                       <?php while($arrNwtt = $resNwtt->fetch_assoc()) {?>
                                       <option value="<?php echo $arrNwtt['ntt_id'];?>"><?php echo $arrNwtt['ntt_subject'];?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="col-md-3"><button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="nwt-send">Send Template</button></div>
                              </div>
                           </form>
                        </div>                        
                     </div>
                     <div class="ibox float-e-margins localization">
                       <div class="ibox-title">
                          <h5>Send Newsletter apart from the list</h5>
                       </div>
                       <div class="ibox-content">
                          <form action="send_newsletter_manually.php" method="post">
                             <div class="form-horizontal">
                                <div class="form-group">
                                   <label class="col-lg-3 control-label">Email:</label>
                                   <div class="col-lg-9">
                                      <input class="form-control" name="u_email" type="text"> 
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-lg-3 control-label">Email Template:</label>
                                   <div class="col-lg-9">
                                      <select class="form-control" name="ntt_id">
                                         <option value="">Select Email Template</option>
                                         <?php 
                                         $resNwtt1 = $instNews->ListNewsletterTemplate();
                                         while($arrNwtt1 = $resNwtt1->fetch_assoc()) {?>
                                         <option value="<?php echo $arrNwtt1['ntt_id'];?>"><?php echo $arrNwtt1['ntt_subject'];?></option>
                                         <?php } ?>
                                      </select>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <div class="col-lg-offset-3 col-lg-3">
                                      <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="nwt-send">SEND</button>
                                   </div>
                                </div>
                             </div>
                          </form>
                       </div>
                    </div>
                  </div>
               </div>
            </div>
            <?php } ?>
            <!-- end of wrapper-content part -->    
            <?php include_once('includes/footer.php'); ?>
         </div>
      </div>
      <!-- Mainly scripts -->
      <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
      <script src="js/plugins/dataTables/datatables.min.js"></script>
      <!-- Data picker -->
      <!-- Date range picker -->
      <script src="js/plugins/daterangepicker/daterangepicker.js"></script>
      <!-- Custom and plugin javascript -->
      <script src="js/plugins/pace/pace.min.js"></script>
      <!-- Data picker -->
      <!-- Image cropper -->
      <script src="js/plugins/cropper/cropper.min.js"></script>
      <script type="text/javascript" src="js/jquery.tabletoCSV.js"></script>
      <!-- Page-Level Scripts -->
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
   </body>
</html>