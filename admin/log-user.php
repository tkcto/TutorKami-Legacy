<?php 
require_once('includes/head.php');
/*
require_once('classes/app.class.php');
require_once('classes/job.class.php');

$instApp = new app;
$instJob = new job;
$resJobLvl = $instJob->FetchJobLevelByLanguage('en-US');
$resStates = $instApp->FetchStatesByCountry(150);
if(isset($_REQUEST['jd'])){
  $res = $instJob->DeleteJob($_REQUEST['jd']);
}
if(isset($_REQUEST['j-search'])){
  $data = $instJob->RealEscape($_REQUEST);
}else{

} 

$resJobEmail = $instJob->FetchJobEmail();

$sorting = (isset($_REQUEST['sort_by'])) ? $_REQUEST['sort_by'] : '0';
$ordering = (isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != 0) ? 'asc' : 'desc';*/

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'User Log | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>

		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		
<!-- END fadhli -->		
</head>

<body>
  <div id="wrapper">
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper" class="gray-bg">
      <?php include_once('includes/header.php'); ?>

<?php 
/*
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} 
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $dbCon->query($updateLastPage) === TRUE ) {}
$dbCon->close();*/
?>

      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">

          <div class="ibox float-e-margins localization">
            <div class="ibox-title">
              <h5>User Log</h5>
           </div>
                      
             <!--<div class="ibox-content"> 
               <div class="form-horizontal">     

                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Job ID :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <div class="input-group">
                                          <input type="text" class="form-control" name="jobId" id="jobId">
                                          <span class="input-group-btn">
                                             <button onclick="goPageDetail();" class="btn btn-primary">Go</button>
                                          </span>
                                       </div>
                                    </div>
                                 </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Search Contact Person Email:</label>

                  <div class="col-lg-7"><input type="email" class="form-control" id="j_email" name="j_email" value="<?php //echo isset($_REQUEST['j-search']) ? $data['j_email'] : ''; ?>"> 
                  </div>
                </div>

                <div class="hidden form-group">
                  <label class="col-lg-3 control-label">Search Rate:</label>

                  <div class="col-lg-7"><input type="text" class="form-control" id="j_rate" name="j_rate" value="<?php // echo isset($_REQUEST['j-search']) ? $data['j_rate'] : ''; ?>"> 
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-lg-3 control-label">Search Tutor Hired Email:</label>

                  <div class="col-lg-7"><input type="email" class="form-control" id="j_hired_tutor_email" name="j_hired_tutor_email" value="<?php //echo isset($_REQUEST['j-search']) ? $data['j_hired_tutor_email'] : ''; ?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Search Phone:</label>

                  <div class="col-lg-7"><input type="text" class="form-control" id="j_telephone" name="j_telephone" value="<?php //echo isset($_REQUEST['j-search']) ? $data['j_telephone'] : ''; ?>"> 
                  </div>
                </div>


                <div class="hidden form-group" id="data_1">
                  <label class="col-sm-3 control-label">Search Date Posted:</label>
                  <div class="col-sm-7">
                    <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="" placeholder="select date" id="j_date" name="j_date" value="<?php //echo isset($_REQUEST['j-search']) ? $data['j_date'] : ''; ?>">
                    </div></div>
                  </div>

                  <div class="form-group"><label class="col-lg-3 control-label">Search Level:</label>
                    <div class="col-lg-7">
                     <select class="form-control" id="j_jl_id" name="j_jl_id">
                       <option value="">Select Job Level</option>
<?php
/*
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

	$sqlSubject = "SELECT * FROM tk_tution_course";
	$querySubject=mysqli_query($conn, $sqlSubject) or die("get tk_job_translation");
	while( $rowSubject=mysqli_fetch_array($querySubject) ) {
		?>
		<option value="<? echo $rowSubject["tc_id"];?>" ><? echo $rowSubject["tc_title"];?></option>
		<?php
	}*/
?>
                    </select>  
                  </div>
                </div>


                <div class="hidden form-group"><label class="col-lg-3 control-label">Search State:</label>
                  <div class="col-lg-7">
                   <select class="form-control" id="j_state_id" name="j_state_id">
                    <option value="">Select State</option>
                    <?php //while($arrStates = $resStates->fetch_assoc()){?>
                     <option value="<? //=$arrStates['st_id']?>" <?php //if(isset($_REQUEST['j-search'])) echo ($data['j_state_id']==$arrStates['st_id'])?'selected':''?>><?php //echo $arrStates['st_name']?></option>
                    <?php //} ?>                                       
                  </select>  
                </div>
              </div>


              <div class="form-group"><label class="col-lg-3 control-label">Search Status:</label>
                <div class="col-lg-7">
                 <select class="form-control" id="j_status" name="j_status">
                  <option value="">Select Status</option>
                  <option value='open' <?php //if(isset($_REQUEST['j-search'])) echo $data['j_status']=="open"?'selected':''?>>Open</option>
                  <option value='closed' <?php //if(isset($_REQUEST['j-search'])) echo $data['j_status']=="closed"?'selected':''?>>Closed</option>
                  <option value='negotiating' <?php //if(isset($_REQUEST['j-search'])) echo $data['j_status']=="negotiating"?'selected':''?>>Negotiating</option>
                                                   
                </select>  
              </div>
            </div>

            <div class="form-group"><label class="col-lg-3 control-label">Search Payment Status:</label>
              <div class="col-lg-7">
               <select class="form-control" id="j_payment_status" name="j_payment_status">
                <option value="">Select Payment Status</option>
                <option value='paid' <?php //if(isset($_REQUEST['j-search'])) echo $data['j_payment_status']=="paid"?'selected':''?>>Paid</option>
                <option value='unpaid' <?php //if(isset($_REQUEST['j-search'])) echo $data['j_payment_status']=="unpaid"?'selected':''?>>Unpaid</option>                                     
              </select>  
            </div>
          </div>

          <div class="form-group" id="data_2">
            <label class="col-sm-3 control-label">Search Payment Deadline:</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="" placeholder="select date" id="j_deadline" name="j_deadline" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_deadline'] : ''; ?>">
              </div></div>
            </div>

            <div class="hidden form-group" id="data_3">
              <label class="col-sm-3 control-label">Search Start Date:</label>
              <div class="col-sm-7">
                <div class="input-group date">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="" placeholder="select date" id="j_start_date" name="j_start_date" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_start_date'] : ''; ?>">
                </div></div>
              </div>

              <div class="hidden form-group" id="data_4">
                <label class="col-sm-3 control-label">Search End Date:</label>
                <div class="col-sm-7">
                  <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="" placeholder="select date" id="j_end_date" name="j_end_date" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_end_date'] : ''; ?>">
                  </div></div>
                </div>


                <div class="form-group"><label class="col-lg-3 control-label">Sort By:</label>
                  <div class="col-lg-7">
                   <select class="form-control" id="sort_by" name="sort_by">
                    <option value="0" <?php //if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="0"?'selected':''?>>None</option>
                    <option value="1" <?php //if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="1"?'selected':''?>>Date ( Latest ) </option>
                    <option value="2" <?php //if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="2"?'selected':''?>>Date ( Oldest  ) </option>
                    <option value="10" <?php //if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="10"?'selected':''?>>Payment Deadline ( Oldest  ) </option>
					<option value="11" <?php //if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="11"?'selected':''?>>Payment Deadline ( Latest ) </option>
                  </select>  
                </div>
              </div>
              <div class="form-group"><label class="col-lg-3 control-label">Created By:</label>
                <div class="col-lg-7">
                  <select class="form-control" id="j_creator_email" name="j_creator_email">
                    <option value="">Select Creator</option>
                    <?php //while($arrJobEmail = $resJobEmail->fetch_assoc()){ ?>
                    <option value="<?php //echo $arrJobEmail['email']; ?>" <?php //if(isset($_REQUEST['j-search'])) echo $data['j_creator_email']==$arrJobEmail['email']?'selected':''?>><?php //echo $arrJobEmail['email']; ?></option>
                    <?php //} ?>
                  </select>  
                </div>
              </div>                            

              <div class="form-group">
                <div class="col-lg-offset-3 col-lg-9">
                  <button type="button" name="filter" id="filter" class="btn btn-info btn-md">Filter</button>
				  <a class="btn btn-md btn-warning" href="job-list.php">Reset</a>				  
                </div>
              </div>


            </div>
          </div>-->

        <div class="ibox-content"> 
         <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

          <div class="row">
           <div class="col-sm-12">
            <div class="table-responsive">
			  
<!-- START fadhli -->

			<table id="userLog" class="table table-bordered table-striped">    
					<thead>
						<tr>
							<th>User</th>
							<th>Date / Time</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
					</thead>
			</table>
<!--
			<table class = "table table-striped" id="search_table" style="width:100%;">
			    <thead></thead>                                                                                                         
			    <tbody></tbody>                                                              
			</table>
-->			
			
			  <!-- END fadhli -->
			  
			  
			  
			  
			  
              <!-- </div> -->
              </div>
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
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Date range picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js"></script>


<!-- Custom and plugin javascript -->

<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/cropper/cropper.min.js"></script>


<!-- Page-Level Scripts -->
<script type="text/javascript" language="javascript" >
/*
function goPageDetail() {
	var goPage = $('#jobId').val();
	var win = window.open('job-edit?j='+goPage, '_blank');
	win.focus();
}*/
	$(document).ready(function(){
		
		fill_datatable();
		
		function fill_datatable( user = '', date = '', time = '', action = '' )
		{
			var dataTable = $('#userLog').DataTable({
				//"order": [[ 1, "desc" ],[ 2, "desc" ]],
				//"order": [[ 1, "desc" ]],
				//"order": [[ 1, "desc" ],[ 2, "desc" ]],
				"processing" : true,
				"serverSide" : true,
				
				
				"ajax" : {
					url:"ajax-load-user-log.php",
					type:"POST",
					data:{
						user:user, date:date, time:time, action:action 
					}
				}
			});
		}
		
		$('#filter').click(function(){
			var user = $('#user').val();
			var date = $('#date').val();
			var time = $('#time').val();
			var action = $('#action').val();

			if( id != '' || user != '' || date != '' || time != '' || action != '' ){
				$('#userLog').DataTable().destroy();
				fill_datatable( id, user, date, time, action );
			}else{
				$('#joblist-grid').DataTable().destroy();
				fill_datatable();
			}

		});
		
		
	});
	
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
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyy-mm-dd"
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "yyyy-mm-dd"
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

</div> 

</div>

<!-- Mainly scripts -->


</body>
<script>
$(document).ready(function(){
	$.ajax({
        method:"POST",
        url:"ajax-load-user-log.php",
        dataType:"json",
        data:{
			loadLog:loadLog,
				data: {
					user:user,
					date:date,
					time:time,
					action:action,
				}
        },
        success:function(response){
             createTablerow(response);
        }
	});
});
function createTablerow(data){
$('#search_table').DataTable({
	pageLength: 20,
	destroy:true,//elakkan dari error initialise
	paging: true,
	searching: true,
	deferRender: true,
	data : data,
	/*order : [[2,"desc"],[1,"desc"]],
	
	"columnDefs": [
		{
			"targets": [ 0 , 1 , 2],
			"visible": false,
			"searchable": false
		},
	],//hidekan userID*/
	columns: [{
        title: 'User',
        data: "user"
      },
      {
        title: 'Date',
        data: "date"
      },
	  {
        title: 'Time',
        data: "time"
      },
	  {
        title: 'Action',
        data: "action"
      }
      /*,
      {
        title: 'display id',
        data: "u_displayid",
			render: function ( data, type, JsonResultRow, meta ) {
				var u_displayid = JsonResultRow['u_displayid'];
				var u_email = JsonResultRow['u_email'];
				return '<a href="manage_user.php?action=edit&u_id='+u_displayid+'" class="tooltip-right" data-tooltip="'+u_email+'" target="_blank">'+u_displayid+'</a>'
			}
      }*/
	]

});
}
</script>
</html>
