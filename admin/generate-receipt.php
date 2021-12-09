<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/job.class.php');

$instApp = new app;
$instJob = new job;
$resJobLvl = $instJob->FetchJobLevelByLanguage('en-US');
$resStates = $instApp->FetchStatesByCountry(150);
if(isset($_REQUEST['jd'])){
  //$res = $instJob->DeleteJob($_REQUEST['jd']);
}
if(isset($_GET['date'])){
  //$data = $instJob->RealEscape($_REQUEST);
  $dateURL = $_GET['date'];
}

$resJobEmail = $instJob->FetchJobEmail();

$sorting = (isset($_REQUEST['sort_by'])) ? $_REQUEST['sort_by'] : '0';
$ordering = (isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != 0) ? 'asc' : 'desc';
/*
if($_SESSION[DB_PREFIX]['u_first_name'] != 'mohd nurfadhli'){
    echo 'Under Development';
exit();				
}*/
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Generate Receipt & Report | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>

<!-- START fadhli -->	

		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<!-- END fadhli -->		
<style>
table.table td.right {
  text-align: right;
}
table.table td.left {
  text-align: left;
}

.dataTables_paginate {
  float: left !important;
}

.btn-excel { 
  color: #ffffff; 
  background-color: #454447; 
  border-color: #454447; 
} 
 
.btn-excel:hover, 
.btn-excel:focus, 
.btn-excel:active, 
.btn-excel.active, 
.open .dropdown-toggle.btn-excel { 
  color: #ffffff; 
  background-color: #3B393D; 
  border-color: #454447; 
} 
 
.btn-excel:active, 
.btn-excel.active, 
.open .dropdown-toggle.btn-excel { 
  background-image: none; 
} 
 
.btn-excel.disabled, 
.btn-excel[disabled], 
fieldset[disabled] .btn-excel, 
.btn-excel.disabled:hover, 
.btn-excel[disabled]:hover, 
fieldset[disabled] .btn-excel:hover, 
.btn-excel.disabled:focus, 
.btn-excel[disabled]:focus, 
fieldset[disabled] .btn-excel:focus, 
.btn-excel.disabled:active, 
.btn-excel[disabled]:active, 
fieldset[disabled] .btn-excel:active, 
.btn-excel.disabled.active, 
.btn-excel[disabled].active, 
fieldset[disabled] .btn-excel.active { 
  background-color: #454447; 
  border-color: #454447; 
} 
 
.btn-excel .badge { 
  color: #454447; 
  background-color: #ffffff; 
}

.tooltip-inner {
    text-align: left;
    width: 250px;
}
</style>
<script src="https://kit.fontawesome.com/13ee0d0c31.js" crossorigin="anonymous"></script>

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
              <h5>Generate Receipt & Report</h5>
           </div>
                      
             <div class="ibox-content"> 
               <div class="form-horizontal">     
               
               




               

<div class="bs-example">
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
        <li class="active"><a href="#Step1" data-toggle="tab">Generate Receipt</a></li>
        <li><a href="#Step2" data-toggle="tab">Duration</a></li>
        <li><a href="#Step3" data-toggle="tab">From Google</a></li>
        <li><a href="#Sitemap" data-toggle="tab">Sitemap</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="Step1">
            
            <br/>
            <div class="form-group row"  id="data_2">
                <label class="col-sm-1 col-form-label">Date:</label>
                <div class="col-sm-6">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input style="width:200px" type="text" class="form-control" placeholder="select date" id="date" name="date"  value=<?php if(isset($_GET['date'])){echo $dateURL;} ?> >
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-1 col-form-label"> </label>
                <div class="col-sm-6">
                    <button type="button" name="filter" id="filter" class="btn btn-info btn-md"><i class="fa fa-search" aria-hidden="true"></i> Filter</button>
                </div>
            </div>
  
  

			  
<!-- START fadhli -->

<?PHP
//$json_url = 'https://script.google.com/macros/s/AKfycbxthDhU_-DWJMuWdpdgiOurWFvD-QMK9fk9toFqxy_d-utG5Cg/exec';
$json_url = 'https://script.google.com/macros/s/AKfycbwjJjY4T4aK1PO831snfj_HpgSYGlwNj0T3GV8YccD545s-jyo/exec';
$json = file_get_contents($json_url);
    
$data = json_decode($json, true);
$entries = $data['user'];
if( !empty($_GET['date']) ){
?>
            <br/>
            <div class="alert alert-info" role="alert" style="width:50%">
              <strong>*Note :</strong> Default RF : <strong>RM 50</strong>
            </div><br/>

			<input type="text" id="dummyEmail" name="dummyEmail" class="form-control" placeholder="Recipient Email" style="width:30%;"><br/><br/>
			<table id="generate" class="table table-bordered table-striped" style="width:50%">    
					<thead>
						<tr>
							<th class="center" width="5%">Date</th>
							<th class="center" width="5%">Job</th>
							<th class="center" width="10%">Tutor</th>
							<th class="center" width="5%">Amount</th>
							<th class="center" width="5%">Action</th>
							<th class="center" width="10%">RF<br/><span class="glyphicon glyphicon-info-sign" style="color:#2f4050" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Tick the checkbox if you want to include RF & fill in the amount. If you tick & leave box empty, default amount will be RM50"></span> </th>
							<th class="center" width="10%">Cycle No</th>
							<th class="center" width="10%">Hour/Cycle<br/><span class="glyphicon glyphicon-info-sign" style="color:#2f4050" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Hour/Cycle is from sales file"></span></th>
						</tr>
					</thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    foreach ($entries as $entry) {

                        $date = date("d/m/Y", strtotime($entry['date']));
                        $job = $entry['job'];
                        $tutor = $entry['tutor'];
                        $amount = $entry['amount'];
                        $hours = $entry['hours'];

                        $timestamp = strtotime($_GET['date']);
                        $new_date = date("d/m/Y", $timestamp);
                            if($date == $new_date){
                                if( $tutor == '' && $amount == '' ){
                                }else{
                                ?>
                                    <tr class="gradeX">
                                        <td class="mainId"><? echo $date; ?></td>
                                        <td><? echo $job; ?></td>
                                        <td><? echo $tutor; ?></td>
                                        <td class="right" ><div style="width: 50%; float: left; text-align: left;">RM</div> <? echo $amount; ?> <input type="hidden" id="amount" name="amount" value="<? echo $amount; ?>"> </td>
                                        <td class="center" >                        
                                            <!--<button type="button" id="Btn<?PHP echo $i; ?>" class="btn btn-success btn-sm generateEmail"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate </button>-->
                                            <button type="button" id="<?PHP echo 'BtnS'.$i; ?>" class="btn btn-success btn-sm hidden" disabled> <i class="fa fa-spinner fa-spin"></i> Loading </button>
                                        </td>
                                        <td class="center" >
                                            <label><input type="text" class="form-control input-sm " onkeypress="return isNumberKey(event)" id="rf_text" name="rf_text" maxlength="4" style="width:60px;"></label>&nbsp;&nbsp;
                                            <label><input type="checkbox" id="rf_checkbox" name="rf_checkbox"></label>&nbsp;&nbsp;
                                            <label><input type="hidden" id="hours" name="hours" value="<? echo $hours; ?>"></label>
                                            <label><input type="hidden" id="actualEmail" name="actualEmail" value="<? echo $actualEmail; ?>"></label>
                                           
                                       </td>
                                        <td class="center" >
                                            <label><input type="text" class="form-control input-sm " onkeypress="return isNumberKey(event)" id="cycle_no" name="cycle_no" maxlength="2" style="width:60px;"></label>
                                       </td>
                                        <td class="center" >
                                            <label><input type="text" class="form-control input-sm " onkeypress="return isNumberKey(event)" id="cl_cycle" name="cl_cycle" maxlength="2" style="width:60px;" value="<? echo $hours; ?>"></label>
                                       </td>
                                    </tr>                                
                                <?php 
                                }
                            }
                    $i++;
                    }
                    ?>
                    </tbody>
			</table>
		
<?PHP   
}else{
    //echo '<b>Please Select Date</b>';
?>    
<div class="alert alert-info" role="alert">
  <strong>Please</strong> Select Date
</div>
<?PHP   
}
?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
            
            
            
            
        </div>
        <div class="tab-pane fade in" id="Step2">
<br/>
<a class="btn btn-excel" href="generate-excel.php" role="button"><i class="far fa-file-excel"></i> Export To Excel</a>
			<table id="example" class="table table-bordered table-striped" style="width:80%">
					<thead>
						<tr>
						    <th class="center" width="2%">No</th>
							<th class="center" width="5%">ID</th>
							<th class="center" width="5%">Date</th>
							<th class="center" width="5%">Deadline</th>
							<th class="center" width="5%">End Date</th>
							<th class="center" width="5%">Parent Rate</th>
							<th class="center" width="5%">Tutor Rate</th>
							<th class="center" width="5%">Duration</th>
						</tr>
					</thead>
                    <tbody>
<?php 
$DBCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($DBCon->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $DBCon->connect_error);
    exit();
}


$num = 1;
$queryJob1 = " SELECT * FROM tk_job WHERE ( j_deadline !='' AND j_deadline !='0000-00-00' AND j_end_date !='' AND j_end_date !='0000-00-00' )
ORDER BY j_id DESC
";
$resultQueryJob1 = $DBCon->query($queryJob1); 
if($resultQueryJob1->num_rows > 0){ 
	while($rowQueryJob1 = $resultQueryJob1->fetch_assoc()){
?>
                    <tr class="gradeX">
                        <td><? echo $num; ?></td>
                        <td><? echo $rowQueryJob1['j_id']; ?></td>
                        <td><? echo $rowQueryJob1['j_create_date']; ?></td>
                        <td><? echo $rowQueryJob1['j_deadline']; ?></td>
                        <td><? echo $rowQueryJob1['j_end_date']; ?></td>
                        <td><? echo $rowQueryJob1['parent_rate']; ?></td>
                        <td><? echo $rowQueryJob1['j_rate']; ?></td>
                        <td><? 
$now = strtotime($rowQueryJob1['j_deadline']);
$your_date = strtotime($rowQueryJob1['j_end_date']);
$datediff = $now - $your_date;

echo round($datediff / (60 * 60 * 24));
                        
                        ?></td>
                    </tr>
<?php   
     $num++;
	}
     
}
$DBCon->close();
?>
                    </tbody>
			</table>			
<?PHP
//}
?>			

        </div>
        
        

        <div class="tab-pane fade in" id="Step3">

        <br/>
        

        <a class="btn btn-excel" href="google-register.php" role="button"><i class="far fa-file-excel"></i> HOME TUITION REGISTRATION</a>
        <a class="btn btn-excel" href="google-daftar.php" role="button"><i class="far fa-file-excel"></i> PENDAFTARAN HOME TUISYEN</a>

        </div>
        
        
        
        <div class="tab-pane fade in" id="Sitemap">
        <br/>
            <a class="btn btn-excel btn-sm" href="excel-sitemap-tutor-profiles.php" role="button"><i class="far fa-file"></i> Tutor Profiles</a><br/>
            <a class="btn btn-excel btn-sm" href="excel-sitemap-guru-tuisyen.php" role="button"><i class="far fa-file"></i> Guru Tuisyen</a><br/>

            <a class="btn btn-excel btn-sm" href="excel-sitemap-tuisyen-online.php" role="button"><i class="far fa-file"></i> Tuisyen Online</a><br/>
            <a class="btn btn-excel btn-sm" href="excel-sitemap-private-tutors.php" role="button"><i class="far fa-file"></i> Private Tutors</a><br/>
            <a class="btn btn-excel btn-sm" href="excel-sitemap-guru-tuisyen-my.php" role="button"><i class="far fa-file"></i> Guru Tuisyen (.my)</a><br/>
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

  
	$(document).ready(function(){

		$('#filter').click(function(){
			var jobId   = $('#jobId').val();
			var date    = $('#date').val();
			    window.location = "https://www.tutorkami.com/admin/generate-receipt.php?id="+ jobId +"&date="+ date;



		});
		
		
	});

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 
    && (charCode < 48 || charCode > 57))
    return false;
    return true;
}  	

$(".generate").on('click',function(e){
   e.preventDefault();
    var currentRow=$(this).closest("tr");
    var col1=currentRow.find("td:eq(0)").html();
    var col2=currentRow.find("td:eq(1)").html();
    var col3=currentRow.find("td:eq(2)").html();
    var col4=currentRow.find("td:eq(3)").html();
    var col5=currentRow.find("td:eq(4)").html();
		 
    var col6 = currentRow.find('input[name="rf_text"]').val();
    var col7 = currentRow.find('[name="rf_checkbox"]').is(':checked');
    var col8 = currentRow.find('input[name="amount"]').val();
    
    var hours = currentRow.find('input[name="hours"]').val(); 
    var data=col1+"\n"+col2+"\n"+col3+"\n"+col8+"\n"+col6+"\n"+col7;
    //alert(data);
    window.open("https://www.tutorkami.com/admin/generate-pdf-file.php?date="+ col1 +"&job="+ col2 +"&tutor="+ col3 +"&amount="+ col8 +"&rf_text="+ col6 +"&rf_checkbox="+ col7 +"&hours="+ hours, "_blank");

});	
$(".generateEmail").on('click',function(e){
    e.preventDefault();
    
    var currentRow=$(this).closest("tr");
    var col1=currentRow.find("td:eq(0)").html();
    var col2=currentRow.find("td:eq(1)").html();
    var col3=currentRow.find("td:eq(2)").html();
    var col4=currentRow.find("td:eq(3)").html();
    var col5=currentRow.find("td:eq(4)").html();
		 
    var col6 = currentRow.find('input[name="rf_text"]').val();
    var col7 = currentRow.find('[name="rf_checkbox"]').is(':checked');
    var col8 = currentRow.find('input[name="amount"]').val();

    var hours = currentRow.find('input[name="hours"]').val(); 
    var colEmail=currentRow.find('input[name="actualEmail"]').val(); 

    var data=col1+"\n"+col2+"\n"+col3+"\n"+col8+"\n"+col6+"\n"+col7+"\n"+colEmail;
    
    var dummyEmail = document.getElementById("dummyEmail").value;
    
    //var cycle_no = document.getElementById("cycle_no").value;
    var cycle_no = currentRow.find('input[name="cycle_no"]').val(); 
    var cl_cycle = currentRow.find('input[name="cl_cycle"]').val(); 
    
/*alert(col1 +' - '+ col2 +' - '+  col3 +' - '+ col8 +' - '+ col6 +' - '+ col7 +' - '+ hours +' - '+ dummyEmail +' - '+ cycle_no +' - '+ cl_cycle);*/

	var answer = this.id;
    var answer2 = answer.replace(/[0-9]/g, '');
    var answer3 = answer.replace( /^\D+/g, '');
     if( answer2 == 'Btn'){
         document.getElementById(this.id).classList.add("hidden");
         document.getElementById('BtnS'+answer3).classList.remove("hidden");
     }

       $.post("templates-email.php",{
            date:col1,
            jobID:col2,
            tutor:col3,
            amount:col8,
            rfAmount:col6,
            checkbox:col7,
            hours:hours,
            //actualEmail:colEmail
            actualEmail:dummyEmail,
            cycle_no:cycle_no,
            cl_cycle:cl_cycle
            
        },
        //function(response,status){ // Required Callback Function
        function(response){ // Required Callback Function
   
                alert("Response : " + response);//"response" receives - whatever written in echo of above PHP script.
                //location.reload();
        
                document.getElementById('BtnS'+answer3).classList.add("hidden");
                document.getElementById(answer).classList.remove("hidden");
            
        });



});	




$(".test").on('click',function(e){
    e.preventDefault();
    
    var currentRow=$(this).closest("tr");
    var col1=currentRow.find("td:eq(0)").html();
    var col2=currentRow.find("td:eq(1)").html();
    var col3=currentRow.find("td:eq(2)").html();
    var col4=currentRow.find("td:eq(3)").html();
    var col5=currentRow.find("td:eq(4)").html();
		 
    var col6 = currentRow.find('input[name="rf_text"]').val();
    var col7 = currentRow.find('[name="rf_checkbox"]').is(':checked');
    var col8 = currentRow.find('input[name="amount"]').val();

    var hours = currentRow.find('input[name="hours"]').val(); 
    var colEmail=currentRow.find('input[name="actualEmail"]').val(); 

    var data=col1+"\n"+col2+"\n"+col3+"\n"+col8+"\n"+col6+"\n"+col7+"\n"+colEmail;
    
    var dummyEmail = document.getElementById("dummyEmail").value;

	if(dummyEmail == ''){
		alert('Empty Actual Email');
	}else{
        $.post("templates-emailtest.php",{ 
            date:col1,
            jobID:col2,
            tutor:col3,
            amount:col8,
            rfAmount:col6,
            checkbox:col7,
            hours:hours,
            actualEmail:dummyEmail
            
        },
        function(response){ // Required Callback Function
   
                alert("Response : " + response);//"response" receives - whatever written in echo of above PHP script.

            
        });
	}

});	








</script>

		
</div> 

</div>

<!-- Mainly scripts -->


</body>
</html>
<script>
$(document).ready(function() {
    
    $('#example').DataTable( {
        dom: 'lBfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "dom": '<"pull-left"f><"pull-right"l>tip', //searchbox & pagination left
        "pageLength": 20,
    } );
    
    $('#generate').DataTable( {
        dom: 'lBfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "dom": '<"pull-left"f><"pull-right"l>tip', //searchbox & pagination left
        //"pageLength": 10,
        "paging":   false,
        
    } );
} );

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>>-->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>