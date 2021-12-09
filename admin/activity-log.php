<?php 
require_once('includes/head.php');
require_once('classes/user.class.php');
if(isset($_GET['atld'])){
   $res = Log::DeleteActivityLog($_GET['atld']);
}
if(isset($_POST['l-search'])){
    $data = $instSys->RealEscape($_POST);
    $resLog = Log::SearchActivityLog($data);
    
}
else{
    $resLog = Log::FetchActivityLog();
}

$instUser = new user;
$resActvityType = $instSys->FetchActivityTypes();

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

    <?php 
    $title = 'Activity Log | Tutorkami';
    require_once('includes/html_head.php'); 
    ?>

</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper" class="gray-bg">
        <?php include_once('includes/header.php'); ?>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
                <div class="col-lg-12">
                     
                <div class="ibox float-e-margins localization">
                 <form action="" method="post">
                    <div class="ibox-title">
                        <h5>Activity Log</h5>
                        <!-- <div class="ibox-tools">                            
                           <a href="javascript:void(0);" class="btn btn-primary " >clear</a> 
                        </div> -->
                    </div>
                       
                   <div class="ibox-content"> 
                     <div class="form-horizontal">     
                    <div class="form-group" id="data_1">
                                <label class="col-lg-3 control-label ">Created from:</label>
                                 <div class="col-lg-7">
                                    <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="<?php echo isset($_POST['l-search']) ? $data['atl_date_from'] : ''; ?>" placeholder="select date" name="atl_date_from">
                                </div>
                            </div>
                            </div>
                             <div class="form-group" id="data_2">
                                <label class="col-lg-3 control-label">Created to:</label>
                                  <div class="col-lg-7">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="<?php echo isset($_POST['l-search']) ? $data['atl_date_to'] : ''; ?>"  placeholder="select date" name="atl_date_to">
                                </div>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-lg-3 control-label">Activity Log Type:</label>

                                    <div class="col-lg-7">
                                     <select class="form-control" name="atl_at_id">
                                        <option value="">All</option>
                                        <?php while($arrActvityType = $resActvityType->fetch_assoc()) {?>
                                        <option value="<?=$arrActvityType['at_id']?>" <?php if(isset($_POST['l-search'])) echo ($data['atl_at_id']==$arrActvityType['at_id'])?'selected':''?>><?=$arrActvityType['at_name']?></option>
                                        <?php } ?>
                                    </select>   

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-7">
                                       <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="l-search">Search</button>
                                         <input class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="reset" name="reset"/>
                                    </div>
                                </div>


                           </div>
                   </div>
                   </form>
                    <div class="ibox-content">  

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example activity-table-list">                                             
                    <thead>
                    <tr>
                        <th>Activity Log Type</th>
                        <th>Customer</th>
                        <th>Message</th>
                        <th>Created On</th> 
                        <th>Delete</th>                         
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($arrLog = $resLog->fetch_assoc()){
                        $arrActType = $instSys->GetActivityType($arrLog['atl_at_id']);
                        $arrUser = $instUser->GetUserDetail($arrLog['atl_u_id']);
                    ?>
                    <tr class="gradeX">
                        <td><?=$arrActType['at_name']?></td>
                        <td><a href="#"><?=$arrUser['u_email']?></a></td>
                        <td><?=$arrLog['atl_message']?></td>
                        <td><?=$arrLog['atl_create_date']?></td>
                        <td class="center" >                        
                        <span class="btn-group">
                        <a href="activity-log.php?atld=<?=$arrLog['atl_id']?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
                        </span>
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


      <script>
        $(document).ready(function(){

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

           
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

             $('.clockpicker').clockpicker();

            $('input[name="daterange"]').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'YYYY-MM-DD',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });


        });

    </script>


   
</body>
</html>
