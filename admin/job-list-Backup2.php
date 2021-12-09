<?php 
require_once('includes/head.php');

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
  //$resJob = $instJob->SearchJob($data);
  //echo $resJob;
  //exit();
}else{
  //$resJob = $instJob->FetchJob();
} 

$resJobEmail = $instJob->FetchJobEmail();

$sorting = (isset($_REQUEST['sort_by'])) ? $_REQUEST['sort_by'] : '0';
$ordering = (isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != 0) ? 'asc' : 'desc';
?>
<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Job List | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>

<!-- START fadhli -->	
<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> -->
		<script type="text/javascript" language="javascript" >
			//$.noConflict();
			$(document).ready(function() {
				var dataTable = $('#joblist-grid').DataTable( {
					 //"dom": '<"toolbar">TClfrtip',
					"processing": true,
					"serverSide": true,
					order: [[10, 'ASC'],[0, 'ASC']],
					"ajax":{
						url :"ajax-load-job-list.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".joblist-grid-error").html("");
							$("#joblist-grid").append('<tbody class="joblist-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#joblist-grid_processing").css("display","none");
							
						}
					}
				} );
				
				$('.form-control').on( 'change', function () {   // for text boxes
					var i =$(this).attr('data-column');  // getting column index
					var v =$(this).val();  // getting search input value
					dataTable.columns(i).search(v).draw();
					//alert(i+" --- "+v);
				} );
				$('.form-control').on( 'change', function () {   // for select box
					var i =$(this).attr('data-column');  
					var v =$(this).val();  
					dataTable.columns(i).search(v).draw();
					//alert(i+" --- "+v);
				} );
				
	
			} );
		</script>
<!-- END fadhli -->		
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
            <div class="ibox-title">
              <h5>Job List</h5>
              <div class="ibox-tools">                            
               <a href="job-add.php" class="btn btn-primary">Add New</a> 

             </div>
           </div>
           <form action="" method="post" class="form-horizontal" id="formSearchJob">                       
             <div class="ibox-content"> 
               <div class="form-horizontal">     
                <!-- <div class="form-group">
                  <label class="col-lg-3 control-label">Go to Id:</label>

                  <div class="col-lg-7"><input type="text" class="form-control"  name=""> 
                  </div>
                </div> -->

                <div class="form-group">
                  <label class="col-lg-3 control-label">Search Contact Person Email:</label>

                  <div class="col-lg-7"><input data-column="0" type="email" class="form-control"  name="j_email" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_email'] : ''; ?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Search Rate:</label>

                  <div class="col-lg-7"><input data-column="1" type="text" class="form-control"  name="j_rate" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_rate'] : ''; ?>"> 
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-lg-3 control-label">Search Tutor Hired Email:</label>

                  <div class="col-lg-7"><input data-column="2" type="email" class="form-control"  name="j_hired_tutor_email" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_hired_tutor_email'] : ''; ?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Search Phone:</label>

                  <div class="col-lg-7"><input data-column="3" type="text" class="form-control"  name="j_telephone" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_telephone'] : ''; ?>"> 
                  </div>
                </div>


                <div class="form-group" id="data_1">
                  <label class="col-sm-3 control-label">Search Date Posted:</label>
                  <div class="col-sm-7">
                    <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input data-column="4" type="text" class="form-control" value="" placeholder="select date"  name="j_date" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_date'] : ''; ?>">
                    </div></div>
                  </div>

                  <div class="form-group"><label class="col-lg-3 control-label">Search Level:</label>
                    <div class="col-lg-7">
                     <select data-column="5" class="form-control" name="j_jl_id">
                       <option value="">Select Job Level</option>
<?php
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

	$sqlSubject = "SELECT * FROM tk_tution_course";
	$querySubject=mysqli_query($conn, $sqlSubject) or die("get tk_job_translation");
	while( $rowSubject=mysqli_fetch_array($querySubject) ) {
		//$nestedData[] = $rowSubject["jt_subject"];
		?>
		<option value="<? echo $rowSubject["tc_id"];?>" ><? echo $rowSubject["tc_title"];?></option>
		<?php
	}
?>
                      <?php //while($arrJobLvl = $resJobLvl->fetch_assoc()){ ?>
                      <!--<option value="<?=$arrJobLvl['jlt_jl_id']?>" <?php if(isset($_REQUEST['j-search'])) echo ($data['j_jl_id']==$arrJobLvl['jlt_jl_id'])?'selected':''?>><?=$arrJobLvl['jlt_title']?></option>-->
                      <?php //} ?>                                       
                    </select>  
                  </div>
                </div>


                <div class="form-group"><label class="col-lg-3 control-label">Search State:</label>
                  <div class="col-lg-7">
                   <select data-column="6" class="form-control" name="j_state_id">
                    <option value="">Select State</option>
                    <?php while($arrStates = $resStates->fetch_assoc()){?>
                     <option value="<?=$arrStates['st_id']?>" <?php if(isset($_REQUEST['j-search'])) echo ($data['j_state_id']==$arrStates['st_id'])?'selected':''?>><?php echo $arrStates['st_name']?></option>
                    <?php } ?>                                       
                  </select>  
                </div>
              </div>


              <div class="form-group"><label class="col-lg-3 control-label">Search Status:</label>
                <div class="col-lg-7">
                 <select data-column="7" class="form-control" name="j_status">
                  <option value="">Select Status</option>
                  <option value='open' <?php if(isset($_REQUEST['j-search'])) echo $data['j_status']=="open"?'selected':''?>>Open</option>
                  <option value='closed' <?php if(isset($_REQUEST['j-search'])) echo $data['j_status']=="closed"?'selected':''?>>Closed</option>
                  <option value='negotiating' <?php if(isset($_REQUEST['j-search'])) echo $data['j_status']=="negotiating"?'selected':''?>>Negotiating</option>
                                                   
                </select>  
              </div>
            </div>

            <div class="form-group"><label class="col-lg-3 control-label">Search Payment Status:</label>
              <div class="col-lg-7">
               <select data-column="8" class="form-control" name="j_payment_status">
                <option value="">Select Payment Status</option>
                <option value='paid' <?php if(isset($_REQUEST['j-search'])) echo $data['j_payment_status']=="paid"?'selected':''?>>Paid</option>
                <option value='unpaid' <?php if(isset($_REQUEST['j-search'])) echo $data['j_payment_status']=="unpaid"?'selected':''?>>Unpaid</option>                                     
              </select>  
            </div>
          </div>

          <div class="form-group" id="data_2">
            <label class="col-sm-3 control-label">Search Payment Deadline:</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input data-column="9" type="text" class="form-control" value="" placeholder="select date"  name="j_deadline" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_deadline'] : ''; ?>">
              </div></div>
            </div>

            <div class="form-group" id="data_3">
              <label class="col-sm-3 control-label">Search Start Date:</label>
              <div class="col-sm-7">
                <div class="input-group date">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input data-column="10" type="text" class="form-control" value="" placeholder="select date"  name="j_start_date" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_start_date'] : ''; ?>">
                </div></div>
              </div>

              <div class="form-group" id="data_4">
                <label class="col-sm-3 control-label">Search End Date:</label>
                <div class="col-sm-7">
                  <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input data-column="11" type="text" class="form-control" value="" placeholder="select date"  name="j_end_date" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_end_date'] : ''; ?>">
                  </div></div>
                </div>


                <div class="form-group"><label class="col-lg-3 control-label">Sort By:</label>
                  <div class="col-lg-7">
                   <select data-column="13" class="form-control" name="sort_by">
                    <option value="0" <?php if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="0"?'selected':''?>>None</option>
                    <option value="1" <?php if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="1"?'selected':''?>>Date</option>
                    <option value="10" <?php if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="10"?'selected':''?>>Payment Deadline</option>
                  </select>  
                </div>
              </div>
              <div class="form-group"><label class="col-lg-3 control-label">Created By:</label>
                <div class="col-lg-7">
                  <select data-column="12" class="form-control" name="j_creator_email">
                    <option value="">Select Creator</option>
                    <?php while($arrJobEmail = $resJobEmail->fetch_assoc()){ ?>
                    <option value="<?php echo $arrJobEmail['email']; ?>" <?php if(isset($_REQUEST['j-search'])) echo $data['j_creator_email']==$arrJobEmail['email']?'selected':''?>><?php echo $arrJobEmail['email']; ?></option>
                    <?php } ?>
                  </select>  
                </div>
              </div>                            

              <div class="form-group">
                <div class="col-lg-offset-3 col-lg-9">
                  <!--<button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="j-search">Search</button> -->
                  <a class="btn btn-sm btn-warning sign-btn-box mrg-right-15" href="job-list.php">Reset</a>				  
                </div>
              </div>


            </div>
          </div>
        </form>
        <div class="ibox-content"> 
         <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

          <div class="row">
           <div class="col-sm-12">
            <!-- <div class="table-responsive"> -->
            <div class="table-responsive">
			  
<!-- START fadhli -->
			<table id="joblist-grid" class="display table table-striped table-bordered table-hover">

<!--<input type="text" data-column="0" class="search-input-text" id="dataTable-email"> -->
    
					<thead>
						<tr>
							<th>Id</th>
							<th>Date</th>
							<th>Start Date</th>
							<th>Level</th>
							<th>Subject</th>
							<th>Area</th>
							<th>State</th>
							<th>Status</th>
							<th>Payment Status</th>
							<th>Applied</th>
							<th>Deadline</th>
							<th>Edit</th>  
							<th class="hidden">Create</th>
						</tr>
					</thead>
			</table>
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
<script>
  $(document).ready(function(){
    $('.dataTables-example').DataTable({
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [
        { extend: 'copy'},
        {extend: 'csv'},
        {extend: 'excel', title: 'ExampleFile'},
        {extend: 'pdf', title: 'ExampleFile'},
        {extend: 'print', customize: function (win){
            $(win.document.body).addClass('white-bg');
            $(win.document.body).css('font-size', '10px');

            $(win.document.body).find('table')
            .addClass('compact')
            .css('font-size', 'inherit');
          }
        }
      ],
      "order": [[ <?php echo $sorting;?>, "<?php echo $ordering;?>" ]]
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
</html>
