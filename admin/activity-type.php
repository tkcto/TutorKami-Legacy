<?php 
require_once('includes/head.php');

require_once('classes/system.class.php');
$instSys = new system;

if(isset($_POST['at-save'])){
    $data = $instSys->RealEscape($_POST);
    $res = $instSys->UpdateActivityStatus($data);
}
$resAct = $instSys->FetchActivityTypes();  

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

    <?php 
    $title = 'Activity Type | Tutorkami';
    require_once('includes/html_head.php'); 
    ?>
    <script type="text/javascript">
     $(document).ready(function(){
      $("#checkAll").click(function () {
         $('input:checkbox').not(this).prop('checked', this.checked);
        })
      });
    </script>

</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper" class="gray-bg">
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper wrapper-content animated fadeInRight">
         <div class="row">
          <div class="col-lg-12">
            <form action="" method="post" class="form-horizontal">

               <div class="ibox float-e-margins localization">
                <div class="ibox-title">
                 <h5>Activity Types</h5>
                 <div class="ibox-tools">

                     <input type="submit" name="at-save" class="btn btn-primary" value="Save">
                 </div>
             </div>
             
             <div class="ibox-content">
              <div class="form-horizontal">               
                 <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">                 
                  <div class="row">
                   <div class="col-sm-12">
                    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded activity-table-list" data-page-size="15" >
                     <thead>
                      <tr>
                       <th class="footable-visible footable-first-column footable-sortable">Name</th>
                       <?php $chk = 1; while($arrAct = $resAct->fetch_assoc()){
                        if($arrAct['at_status']=='D'){ $chk = 0; break;} } $resAct->data_seek(0);?>
                       <th data-hide="phone" class="footable-visible footable-sortable">Is Enabled <span class="mrgleft-10"><input type="checkbox" value="" id="checkAll" name="checkAll" <?php if($chk) echo "checked=checked"; else echo '';?>></span></th>
                     </tr>
               </thead>
               <tbody >
                   <?php while($arrAct = $resAct->fetch_assoc()){?>
                   <tr class="footable-even" style="display: table-row;">
                       <td class="footable-visible footable-first-column">
                          <?=$arrAct['at_name']?>
                      </td>
                      <td class="footable-visible">
                       <input type="hidden" name="at_status[<?=$arrAct['at_id']?>]" value="D" />
                       <input type="checkbox" value="A" name="at_status[<?=$arrAct['at_id']?>]" <?php if($arrAct['at_status']=='A') echo "checked=checked"; else echo ''; ?>>
                       
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
</form>
</div>
</div>
</div>





<?php include_once('includes/footer.php'); ?>

</div> 

</div>



<!-- jQuery UI -->
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>

<!-- Date range picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js"></script>


<!-- Custom and plugin javascript -->

<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/cropper/cropper.min.js"></script>


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
