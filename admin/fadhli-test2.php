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

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
       <?php
        $title = 'Job List | Tutorkami';
        require_once('includes/html_head.php'); 
       ?>
    
        <link rel="stylesheet" type="text/css" href="css/manageusercss/jquery.dataTables.min.css"></style>
        <link rel="stylesheet" type="text/css" href="css/manageusercss/jquery-ui.css">
    
        <script type="text/javascript" language="javascript" src="js/manageuserjs/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.jqueryui.min.js"></script>
        <!--<script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.jqueryui.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/manageuserjs/jszip.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.print.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.colVis.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.checkboxes.min.js"></script>
       
    
        <script type="text/javascript" language="javascript" src="js/plugins/pace/pace.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/manage_user.js"></script>
       
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>-->
       
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
        <script src="//cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
    </head>
<style>/*
.table-borderless {
    border-bottom:0px !important;
    border-top:0px !important;
}
.table-borderless th, .table-borderless td {
    border: 1px !important;
    border-bottom:0px !important;
    border-top:0px !important;
}
*/

.table {
    border: 1px !important;
    border-width: 1px !important;
}

table.dataTable thead tr {
    border-top: none;
    border-bottom: none;
}
table.dataTable thead th {
    border-top: none;
    border-bottom: none;
}
 
table.dataTable tfoot th {
    border-top: none;
    border-bottom: none;
    border-bottom: 1px solid  #111;
}

table.dataTable.no-footer {
    border-bottom: none;
}


/*
.dataTable.no-footer tfoot th, 
.dataTable.no-footer tfoot td {
    border-bottom: none;
}
.table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > thead > tr > th {
    border: none;
    border-top: none;
}
/*
table.dataTable thead th {
  border-style: solid;
  border-width: 5px;
}
.borderless{
    border-width: 1px;
}*/
</style>
<style>
[data-tooltip],
.tooltip {
  position: relative;
  cursor: pointer;
}

/* Base styles for the entire tooltip */
[data-tooltip]:before,
[data-tooltip]:after,
.tooltip:before,
.tooltip:after {
  position: absolute;
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: 
      opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        -webkit-transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
    -moz-transition:    
        opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        -moz-transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
    transition:         
        opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform:    translate3d(0, 0, 0);
  transform:         translate3d(0, 0, 0);
  pointer-events: none;
}

/* Show the entire tooltip on hover and focus */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after,
[data-tooltip]:focus:before,
[data-tooltip]:focus:after,
.tooltip:hover:before,
.tooltip:hover:after,
.tooltip:focus:before,
.tooltip:focus:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

/* Base styles for the tooltip's directional arrow */
.tooltip:before,
[data-tooltip]:before {
  z-index: 1001;
  border: 6px solid transparent;
  background: transparent;
  content: "";
}

/* Base styles for the tooltip's content area */
.tooltip:after,
[data-tooltip]:after {
  z-index: 1000;
  padding: 8px;
  /*width: 160px;*/
  width: 260px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  font-size: 14px;
  line-height: 1.2;
}

/* Directions */

/* Top (default) */
[data-tooltip]:before,
[data-tooltip]:after,
.tooltip:before,
.tooltip:after,
.tooltip-top:before,
.tooltip-top:after {
  bottom: 100%;
  left: 50%;
}

[data-tooltip]:before,
.tooltip:before,
.tooltip-top:before {
  margin-left: -6px;
  margin-bottom: -12px;
  border-top-color: #000;
  border-top-color: hsla(0, 0%, 20%, 0.9);
}

/* Horizontally align top/bottom tooltips */
[data-tooltip]:after,
.tooltip:after,
.tooltip-top:after {
  margin-left: -80px;
}

[data-tooltip]:hover:before,
[data-tooltip]:hover:after,
[data-tooltip]:focus:before,
[data-tooltip]:focus:after,
.tooltip:hover:before,
.tooltip:hover:after,
.tooltip:focus:before,
.tooltip:focus:after,
.tooltip-top:hover:before,
.tooltip-top:hover:after,
.tooltip-top:focus:before,
.tooltip-top:focus:after {
  -webkit-transform: translateY(-12px);
  -moz-transform:    translateY(-12px);
  transform:         translateY(-12px); 
}

/* Left */
.tooltip-left:before,
.tooltip-left:after {
  right: 100%;
  bottom: 50%;
  left: auto;
}

.tooltip-left:before {
  margin-left: 0;
  margin-right: -12px;
  margin-bottom: 0;
  border-top-color: transparent;
  border-left-color: #000;
  border-left-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-left:hover:before,
.tooltip-left:hover:after,
.tooltip-left:focus:before,
.tooltip-left:focus:after {
  -webkit-transform: translateX(-12px);
  -moz-transform:    translateX(-12px);
  transform:         translateX(-12px); 
}

/* Bottom */
.tooltip-bottom:before,
.tooltip-bottom:after {
  top: 100%;
  bottom: auto;
  left: 50%;
}

.tooltip-bottom:before {
  margin-top: -12px;
  margin-bottom: 0;
  border-top-color: transparent;
  border-bottom-color: #000;
  border-bottom-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-bottom:hover:before,
.tooltip-bottom:hover:after,
.tooltip-bottom:focus:before,
.tooltip-bottom:focus:after {
  -webkit-transform: translateY(12px);
  -moz-transform:    translateY(12px);
  transform:         translateY(12px); 
}

/* Right */
.tooltip-right:before,
.tooltip-right:after {
  bottom: 50%;
  left: 100%;
}

.tooltip-right:before {
  margin-bottom: 0;
  margin-left: -12px;
  border-top-color: transparent;
  border-right-color: #000;
  border-right-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-right:hover:before,
.tooltip-right:hover:after,
.tooltip-right:focus:before,
.tooltip-right:focus:after {
  -webkit-transform: translateX(12px);
  -moz-transform:    translateX(12px);
  transform:         translateX(12px); 
}

/* Move directional arrows down a bit for left/right tooltips */
.tooltip-left:before,
.tooltip-right:before {
  top: 3px;
}

/* Vertically center tooltip content for left/right tooltips */
.tooltip-left:after,
.tooltip-right:after {
  margin-left: 0;
  margin-bottom: -16px;
}

.cursor{
    cursor:pointer;cursor:hand

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
</style>
    <body>
        <div class="loaderBackground" id="hider" style="display: none;"></div>
        <div class="loaderpop" id="loadermodaldiv" style="display: none;">
            <h4><img src="img/loading.svg" style="width: 50px;" />Loading...</h4>
        </div>
        
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
                               <h5>Job List</h5> 
                               <div class="ibox-tools"> <a href="job-add.php" class="btn btn-primary"> Add New</a> </div>
                            </div>
                            
                                <div class="ibox-content">
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

                                    <div class="hidden form-group">
                                      <label class="col-lg-3 control-label">Search Contact Person Email :</label>
                                      <div class="col-lg-7"><input type="email" class="form-control" id="j_email" name="j_email" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_email'] : ''; ?>"> 
                                      </div>
                                    </div>
                
                                    <!--<div class="form-group"><label class="col-lg-3 control-label">Search State:</label>
                                      <div class="col-lg-7">
                                       <select class="form-control" id="j_state_id" name="j_state_id">
                                        <option value="">Select State</option>
                                        <?php //while($arrStates = $resStates->fetch_assoc()){?>
                                         <option value="<?//=$arrStates['st_id']?>" <?php //if(isset($_REQUEST['j-search'])) echo ($data['j_state_id']==$arrStates['st_id'])?'selected':''?>><?php //echo $arrStates['st_name']?></option>
                                        <?php //} ?>                                       
                                      </select>  
                                    </div>
                                  </div>-->
              

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">City :</label>
                                        <div class="col-sm-3">
                              
                                          <select class="form-control" name="j_state_id" id="j_state_id">
                                             <option value="">Please Select State</option>
                                             <?php while($arrStates = $resStates->fetch_assoc()){?>
                                             <option value="<?=$arrStates['st_id']?>" <?php if(isset($_REQUEST['j-search'])) echo ($data['j_state_id']==$arrStates['st_id'])?'selected':''?>><?php echo $arrStates['st_name']?></option>
                                             <?php }?>
                                             <option value="Unselected">Unselected</option>
                                          </select>
            								 
                                        </div>
            
                                        <div class="col-sm-4">
                                            <select class="form-control" name="newCity" id="newCity">
                                                <option value="">Please Select City</option>
                                            </select>
                                        </div>
                                    </div>

                                <div class="hidden form-group">
                                  <label class="col-lg-3 control-label">Search Rate :</label>
                                  <div class="col-lg-7"><input type="text" class="form-control" id="j_rate" name="j_rate" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_rate'] : ''; ?>"> 
                                  </div>
                                </div>
                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Search Tutor Hired Email :</label>
                                  <div class="col-lg-7"><input type="email" class="form-control" id="j_hired_tutor_email" name="j_hired_tutor_email" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_hired_tutor_email'] : ''; ?>"> 
                                  </div>
                                </div>
                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Search Phone :</label>
                                  <div class="col-lg-7"><input type="text" class="form-control" id="j_telephone" name="j_telephone" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_telephone'] : ''; ?>"> 
                                  </div>
                                </div>


                                <div class="hidden form-group" id="data_1">
                                    <label class="col-sm-3 control-label">Search Date Posted :</label>
                                    <div class="col-sm-7">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="" placeholder="select date" id="j_date" name="j_date" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_date'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-lg-3 control-label">Search Level :</label>
                                    <div class="col-lg-7">
                                        <select class="form-control" id="j_jl_id" name="j_jl_id">
                                           <option value="">Select Job Level</option>
                                            <?php
                                            /*
                                            $servername = "localhost";
                                            $username = "tutorka1_live";
                                            $password = "_+11pj,oow.L";
                                            $dbname = "tutorka1_tutorkami_db";
                                            $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
                                            */
                                            
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
                

                                <div class="form-group"><label class="col-lg-3 control-label">Search Status :</label>
                                    <div class="col-lg-7">
                                         <select class="form-control" id="j_status" name="j_status">
                                          <option value="">Select Status</option>
                                          <option value='open' <?php if(isset($_REQUEST['j-search'])) echo $data['j_status']=="open"?'selected':''?>>Open</option>
                                          <option value='closed' <?php if(isset($_REQUEST['j-search'])) echo $data['j_status']=="closed"?'selected':''?>>Closed</option>
                                          <option value='negotiating' <?php if(isset($_REQUEST['j-search'])) echo $data['j_status']=="negotiating"?'selected':''?>>Negotiating</option>
                                        </select>  
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-lg-3 control-label">Search Payment Status :</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" id="j_payment_status" name="j_payment_status">
                                        <option value="">Select Payment Status</option>
                                        <option value='paid' <?php if(isset($_REQUEST['j-search'])) echo $data['j_payment_status']=="paid"?'selected':''?>>Paid</option>
                                        <option value='unpaid' <?php if(isset($_REQUEST['j-search'])) echo $data['j_payment_status']=="unpaid"?'selected':''?>>Unpaid</option>                                     
                                      </select>  
                                    </div>
                                </div>

                                <div class="form-group" id="data_2">
                                    <label class="col-sm-3 control-label">Search Payment Deadline :</label>
                                    <div class="col-sm-7">
                                          <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="" placeholder="select date" id="j_deadline" name="j_deadline" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_deadline'] : ''; ?>">
                                          </div>
                                    </div>
                                </div>

                                <div class="hidden form-group" id="data_3">
                                    <label class="col-sm-3 control-label">Search Start Date :</label>
                                    <div class="col-sm-7">
                                        <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="" placeholder="select date" id="j_start_date" name="j_start_date" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_start_date'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="hidden form-group" id="data_4">
                                    <label class="col-sm-3 control-label">Search End Date :</label>
                                    <div class="col-sm-7">
                                          <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="" placeholder="select date" id="j_end_date" name="j_end_date" value="<?php echo isset($_REQUEST['j-search']) ? $data['j_end_date'] : ''; ?>">
                                          </div>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-lg-3 control-label">Sort By :</label>
                                    <div class="col-lg-7">
                                           <select class="form-control" id="sort_by" name="sort_by">
                                            <option value="0" <?php if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="0"?'selected':''?>>None</option>
                                            <option value="1" <?php if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="1"?'selected':''?>>Date ( Latest ) </option>
                                            <option value="2" <?php if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="2"?'selected':''?>>Date ( Oldest  ) </option>
                                            <option value="10" <?php if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="10"?'selected':''?>>Payment Deadline ( Oldest  ) </option>
                        					<option value="11" <?php if(isset($_REQUEST['j-search'])) echo $data['sort_by']=="11"?'selected':''?>>Payment Deadline ( Latest ) </option>
                                          </select>  
                                    </div>
                                </div>
              
                                <div class="form-group"><label class="col-lg-3 control-label">Created By :</label>
                                    <div class="col-lg-7">
                                          <select class="form-control" id="j_creator_email" name="j_creator_email">
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
                                        <button type="button" name="filter" id="filter" class="btn btn-info btn-md"><i class="fa fa-search"></i> Filter</button>
                                        <a class="btn btn-md btn-warning" href="job-list.php"><i class="fa fa-eraser"></i> Reset</a>		
                                        <!--<button type="button" name="exportExcel" id="exportExcel" class="btn btn-excel btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>-->

                                        <?php
                                        if($_SESSION[DB_PREFIX]['u_first_name'] == 'Mohd Nurfadhli'){
                                        ?>      
                                        <button type="button" class="btn btn-danger btn-md" onclick="cariTutor()"><i class="fa fa-search"></i> ttttt</button>
                                        <?PHP
                                        }
                                        ?>  

                                        <div class="btn-group">
                                          <div class="btn-group">
                                            <button type="button" class="btn btn-excel dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-file-excel-o"></i> Export To Excel <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                              <li><a href="#" name="exportExcel" id="exportExcel">Tutor's Rate</a></li>
                                              <li><a href="#" name="exportExcel2" id="exportExcel2">State & City</a></li>
                                        <?php
                                        if($_SESSION[DB_PREFIX]['u_first_name'] == 'Mohd Nurfadhli'){
                                        ?>      
                                        
                                              <li><a href="#" name="exportExcel3" id="exportExcel3">test</a></li>
                                              
                                        <?PHP
                                        }
                                        ?>      
                                              
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
                                </div>




            
                                        <div class="table-responsive">
                                            
<!-- START fadhli -->
			<!--<table id="joblist-grid" class="table table-bordered table-striped">    
					<thead>
						<tr>
							<th>ID</th>
							<th>Date</th>
							---<th>Start Date</th>
							<th>Level</th>
							<th>Subject</th>
							<th>Area</th>
							<th>City</th>
							<th>Status</th>
							<th>Payment Status</th>
							<th>Applied</th>
							<th>Deadline</th>
							<th>Action</th>
						</tr>
					</thead>
			</table>-->
<!-- END fadhli -->
                                            <h4 style="margin-bottom: 20px;" class="org-txt text-danger"><strong>Search Results : <span id="counttutor"></span></strong></h4>
                                                <table id="search_table" class="table  table-striped table-borderless" style="width:100%;">
                                                <!--<table class = "table table-striped" id="search_table" style="width:100%;">-->
                                                    <thead></thead>                                                                                                         
                                                    <tbody></tbody>                                                              
                                                </table>
                                         
                                        </div>                                      
                                      
                                   </div>
                                </div>
                

                  
          
           
                            </div>
                        </div>
                    </div>
                </div>
            <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
   </body>
</html>
<!-- https://select2.org/ -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script type="text/javascript">
    var rowperpage = 10;
       $(document).ready(function(){
        cariTutor();
        
    });

    function cariTutor(){
        
         var filterState    = $("#j_state_id").val();
         var filterCity     = $("#newCity").val();
         
         var filterEmail    = $("#j_hired_tutor_email").val();
         
         var filterPhone    = $("#j_telephone").val();
         
         var filterLevel    = $("#j_jl_id").val();
         
         var filterStatus   = $("#j_status").val();
         
         var filterPStatus  = $("#j_payment_status").val();
         
         var filterDeadline = $("#j_deadline").val();
         
         var filterSort     = $("#sort_by").val();
         
         var filterCreated  = $("#j_creator_email").val();
        

              $.ajax({
                method:"POST",
                url:"classes/ajax-job-list.php",
                dataType:"json",
                data:{
                  JobList:"All",
                  data: {
                    JobList:"All",
                  }
                },
                success:function(response){
                    createTablerow(response);
                     console.log(response);
                     document.getElementById("counttutor").innerHTML = response.length;
                }
              });
            return false;
    }

   /* Create Table */
   function createTablerow(data){
        $.fn.dataTable.moment( 'DD/MM/YYYY' );
        $('#search_table').DataTable({
            pageLength: 10,
            destroy:true,//elakkan dari error initialise
            language: {
                "emptyTable":     "Tiada Maklumat Dijumpai!"
            },

            paging: true,
            searching: false,
            deferRender: true,
            data : data,
            order : [[1,"desc"]],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                },
            ],//hidekan userID
/*
            order : [[2,"desc"],[1,"desc"]],
            "columnDefs": [
                {
                    "targets": [ 0 , 1 , 2],
                    "visible": false,
                    "searchable": false
                },
            ],//hidekan userID
*/
            columns: [
                {
                    title: 'Ori DATE',
                    data: "Data_OriCreate"
                },
/*
                {
                    title: 'create',
                    data: "ori_u_create_date"
                },
                {
                    title: 'last',
                    data: "ori_u_modified_date"
                },
                {
                    title: 'ID',
                    data: "u_displayid",
            			render: function ( data, type, JsonResultRow, meta ) {
            				var u_displayid = JsonResultRow['u_displayid'];
            				var u_email = JsonResultRow['u_email'];
            				return '<a style="white-space: pre-line;" data-html="true" href="manage_user.php?action=edit&u_id='+u_displayid+'" class="tooltip-right" data-tooltip="'+u_email+'" target="_blank">'+u_displayid+'</a>'
            			}
                },
*/                
                {
                    width: '3%',
                    title: 'ID',
                    data: "Data_ID",
            			render: function ( data, type, JsonResultRow, meta ) {
            				var jobID = JsonResultRow['Data_ID'];
            				return '<a href="job-edit.php?j='+jobID+'">'+jobID+'</a>'
            			}
                },
                {
                    width: '5%',
                    title: 'Date',
                    data: "Data_Date"
                },
                {
                    width: '10%',
                    title: 'Level',
                    data: "Data_Level"
                },
                {
                    width: '20%',
                    title: 'Subject',
                    data: "Data_Subject"
                },
                {
                    width: '10%',
                    title: 'Area',
                    data: "Data_Area"
                },
                {
                    width: '10%',
                    title: 'City',
                    data: "Data_City"
                },
                {
                    width: '5%',
                    title: 'Status',
                    data: "Data_Status"
                },
                {
                    width: '10%',
                    title: 'Payment Status',
                    data: "Data_PaymentStatus"
            
                },
                {
                    width: '5%',
                    title: 'Applied',
                    data: "Data_Applied",
            			render: function ( data, type, JsonResultRow, meta ) {
            				var Applied = JsonResultRow['Data_Applied'];
            				if( Applied == 'yes' ){
            				    return '<input disabled type="checkbox" checked>'
            				}else{
            				    return '<input disabled type="checkbox" >'
            				}
            			}
                },
                {
                    width: '8%',
                    title: 'Deadline',
                    data: "Data_Deadline"
                },
/*
                {
                    title: 'Action',
                    data: "Data_Action"
                }
*/
                {
                    width: '8%',
                    title: 'Action',
                    data: "Data_ID",
            			render: function ( data, type, JsonResultRow, meta ) {
            				var JobID = JsonResultRow['Data_ID'];
            				return '<a href="job-edit.php?j='+JobID+'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>'
            			}
                }
            ]
        });
   }
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script src="https://unpkg.com/popper.js@1"></script>
<script src="https://unpkg.com/tippy.js@5"></script>

<!-- Page-Level Scripts -->
<script type="text/javascript" language="javascript" >
function goPageDetail() {
	var goPage = $('#jobId').val();
	var win = window.open('job-edit?j='+goPage, '_blank');
	win.focus();
}
	$(document).ready(function(){
		
		//fill_datatable();
		
		function fill_datatable(j_email = '', j_rate = '', j_hired_tutor_email = '', j_telephone = '', j_date = '', j_jl_id = '', j_state_id = '', newCity = '', j_status = '', j_payment_status = '', j_deadline = '', j_start_date = '', j_end_date = '', sort_by = '', j_creator_email = '')
		{
			var dataTable = $('#joblist-grid').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [ ],
				"searching" : false,
				"ordering": false,
				'paging': true,
/*
        "aoColumns": [
		
           { "bSortable": false },
           null,
           { "bSortable": false },
           { "bSortable": false },
           { "bSortable": false },
           { "bSortable": false },
           { "bSortable": false },
           { "bSortable": false },
           { "bSortable": false },
           null,
           { "bSortable": false }
         ],
*/
                /*"filter": true,
                "orderMulti": false,
                "stateSave": true,
                "lengthChange": false,
                "pageLength": 5,
                "stateDuration": -1,*/
				
				"ajax" : {
					url:"ajax-load-job-list.php",
					type:"POST",
					data:{
						j_email:j_email, j_rate:j_rate, j_hired_tutor_email:j_hired_tutor_email, j_telephone:j_telephone, j_date:j_date, j_jl_id:j_jl_id, j_state_id:j_state_id, newCity:newCity, j_status:j_status, j_payment_status:j_payment_status, j_deadline:j_deadline, j_start_date:j_start_date, j_end_date:j_end_date, sort_by:sort_by, j_creator_email:j_creator_email
					}
				}
				,"fnDrawCallback": function () {
				    document.getElementById("counttutor").innerHTML = this.fnSettings().fnRecordsTotal();
				}
				
				
			});



		}
		
		$('#filter').click(function(){
			var j_email             = $('#j_email').val();
			var j_rate              = $('#j_rate').val();
			var j_hired_tutor_email = $('#j_hired_tutor_email').val();
			var j_telephone         = $('#j_telephone').val();
			var j_date              = $('#j_date').val();
			var j_jl_id             = $('#j_jl_id').val();
			var j_state_id          = $('#j_state_id').val();
			var newCity             = $('#newCity').val();
			var j_status            = $('#j_status').val();
			var j_payment_status    = $('#j_payment_status').val();
			var j_deadline          = $('#j_deadline').val();
			var j_start_date        = $('#j_start_date').val();
			var j_end_date          = $('#j_end_date').val();
			var sort_by             = $('#sort_by').val();
			var j_creator_email     = $('#j_creator_email').val();
			var istutor = 'Yes';

			if(j_email != '' || j_rate != '' || j_hired_tutor_email != '' || j_telephone != '' || j_date != '' || j_jl_id != '' || j_state_id != '' || newCity != '' || j_status != '' || j_payment_status != '' || j_deadline != '' || j_start_date != '' || j_end_date != '' || sort_by != '' || j_creator_email != ''){
				$('#joblist-grid').DataTable().destroy();
				fill_datatable(j_email, j_rate, j_hired_tutor_email, j_telephone, j_date, j_jl_id, j_state_id, newCity, j_status, j_payment_status, j_deadline, j_start_date, j_end_date, sort_by, j_creator_email);
			}else{
				$('#joblist-grid').DataTable().destroy();
				fill_datatable();
			}
		});

		$('#exportExcel').click(function(){
			var j_email             = $('#j_email').val();
			var j_rate              = $('#j_rate').val();
			var j_hired_tutor_email = $('#j_hired_tutor_email').val();
			var j_telephone         = $('#j_telephone').val();
			var j_date              = $('#j_date').val();
			var j_jl_id             = $('#j_jl_id').val();
			var j_state_id          = $('#j_state_id').val();
			var newCity             = $('#newCity').val();
			var j_status            = $('#j_status').val();
			var j_payment_status    = $('#j_payment_status').val();
			var j_deadline          = $('#j_deadline').val();
			var j_start_date        = $('#j_start_date').val();
			var j_end_date          = $('#j_end_date').val();
			var sort_by             = $('#sort_by').val();
			var j_creator_email     = $('#j_creator_email').val();

			window.open("https://www.tutorkami.com/admin/ajax-load-job-list-excel.php?j_email="+ j_email +"&j_rate="+ j_rate +"&j_hired_tutor_email="+ j_hired_tutor_email +"&j_telephone="+ j_telephone +"&j_date="+ j_date +"&j_jl_id="+ j_jl_id +"&j_state_id="+ j_state_id +"&newCity="+ newCity +"&j_status="+ j_status +"&j_payment_status="+ j_payment_status +"&j_deadline="+ j_deadline +"&j_start_date="+ j_start_date +"&j_end_date="+ j_end_date +"&sort_by="+ sort_by +"&j_creator_email="+ j_creator_email, "_blank");
			

		});

		$('#exportExcel2').click(function(){
			var j_email             = $('#j_email').val();
			var j_rate              = $('#j_rate').val();
			var j_hired_tutor_email = $('#j_hired_tutor_email').val();
			var j_telephone         = $('#j_telephone').val();
			var j_date              = $('#j_date').val();
			var j_jl_id             = $('#j_jl_id').val();
			var j_state_id          = $('#j_state_id').val();
			var newCity             = $('#newCity').val();
			var j_status            = $('#j_status').val();
			var j_payment_status    = $('#j_payment_status').val();
			var j_deadline          = $('#j_deadline').val();
			var j_start_date        = $('#j_start_date').val();
			var j_end_date          = $('#j_end_date').val();
			var sort_by             = $('#sort_by').val();
			var j_creator_email     = $('#j_creator_email').val();

			window.open("https://www.tutorkami.com/admin/ajax-load-job-list-excel2.php?j_email="+ j_email +"&j_rate="+ j_rate +"&j_hired_tutor_email="+ j_hired_tutor_email +"&j_telephone="+ j_telephone +"&j_date="+ j_date +"&j_jl_id="+ j_jl_id +"&j_state_id="+ j_state_id +"&newCity="+ newCity +"&j_status="+ j_status +"&j_payment_status="+ j_payment_status +"&j_deadline="+ j_deadline +"&j_start_date="+ j_start_date +"&j_end_date="+ j_end_date +"&sort_by="+ sort_by +"&j_creator_email="+ j_creator_email, "_blank");
		});
		

		$('#exportExcel3').click(function(){
			var j_email             = $('#j_email').val();
			var j_rate              = $('#j_rate').val();
			var j_hired_tutor_email = $('#j_hired_tutor_email').val();
			var j_telephone         = $('#j_telephone').val();
			var j_date              = $('#j_date').val();
			var j_jl_id             = $('#j_jl_id').val();
			var j_state_id          = $('#j_state_id').val();
			var newCity             = $('#newCity').val();
			var j_status            = $('#j_status').val();
			var j_payment_status    = $('#j_payment_status').val();
			var j_deadline          = $('#j_deadline').val();
			var j_start_date        = $('#j_start_date').val();
			var j_end_date          = $('#j_end_date').val();
			var sort_by             = $('#sort_by').val();
			var j_creator_email     = $('#j_creator_email').val();

			window.open("https://www.tutorkami.com/admin/ajax-load-job-list-excel3.php?j_email="+ j_email +"&j_rate="+ j_rate +"&j_hired_tutor_email="+ j_hired_tutor_email +"&j_telephone="+ j_telephone +"&j_date="+ j_date +"&j_jl_id="+ j_jl_id +"&j_state_id="+ j_state_id +"&newCity="+ newCity +"&j_status="+ j_status +"&j_payment_status="+ j_payment_status +"&j_deadline="+ j_deadline +"&j_start_date="+ j_start_date +"&j_end_date="+ j_end_date +"&sort_by="+ sort_by +"&j_creator_email="+ j_creator_email, "_blank");
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
        
$('#j_state_id').change(function(){
    var StateId = $(this).val();
    $.ajax({
        url: "ajax/ajax_call.php",
        method: "POST",
        data: {action: 'get_city', state_id: StateId}, 
        success: function(result){
            $('#newCity').html(result);
        }
    });
});
    </script>

