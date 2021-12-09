<?php 
require_once('includes/head.php');

require_once('classes/newsletter.class.php');
$instNews = new newsletter;
if(isset($_REQUEST['nwtd'])){
 $res = $instNews->DeleteNewsletterTemplate($_REQUEST['nwtd']);
}

$resNwt = $instNews->FetchNewsletterTemplate();  

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

  <?php 
   $title = 'Newsletter Template List | Tutorkami';
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
              <h5>Newletter Template List</h5>
              <div class="ibox-tools">                            
               <a href="newsletter-template-add.php" class="btn btn-primary">Add New</a> 
              </div>
           </div>                       

           <div class="ibox-content"> 
           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
              
            <div class="row">
               <div class="col-sm-12">
            <!-- <div class="table-responsive"> -->
              <table class="table table-striped table-bordered table-hover dataTables-example activity-table-list" >                                             
                <thead>
                  <tr>                      
                    <th>Id</th>
                    <th>Status</th>
                    <th>Language Code</th>
                    <th>Subject</th>
                    <th>Action</th>  
                  </tr>
                </thead>
                <tbody>
                  <?php while($arrNwt = $resNwt->fetch_assoc()){
                    $defaultLangNwTemp = $instNews->GetDefaultLanguageNewsTemplate($arrNwt['nwtemp_id']);?>
                  <tr class="gradeX">                       
                    <td><?=$arrNwt['nwtemp_id']?></td> 
                    <td><i class="fa <?=($arrNwt['nwtemp_status']=='A')?'fa-check':'fa-times'?>  text-navy"></i></td>                         
                    <td><?=$defaultLangNwTemp['ntt_lang_code']?></td>
                    <td><?=$defaultLangNwTemp['ntt_subject']?></td>
                    <td class="center" >                        
                      <span class="btn-group">
                        <a href="newsletter-template-add.php?nwt=<?=$arrNwt['nwtemp_id']?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
                        <a href="newsletter-template-list.php?nwtd=<?=$arrNwt['nwtemp_id']?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
                      </span>
                    </td>

                  </tr>
            <?php } ?>
                  
  </tbody>

</table>
<!-- </div> -->
</div>
</div>
</div>

</div>
</div>
</div>
</div>

</div>  
<!-- end of wrapper-content part -->    
<?php include_once('includes/footer.php'); ?>
<script src="js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>


<!-- Custom and plugin javascript -->

<script src="js/plugins/pace/pace.min.js"></script>


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
</div> 
</div>
<!-- Mainly scripts -->
</body>
</html>
