<!-- DONE BACKUP -->
<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;
$instUser = new user;

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
 <?php 
   $title = 'Sales TutorKami | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>
</head>
<link href="css/button-ori.css" rel="stylesheet">
<body style="background-color: white;">
	<div id="wrapper">

<script src="https://kit.fontawesome.com/13ee0d0c31.js" crossorigin="anonymous"></script>
<div class="row border-bottom">
   <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
         <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
      </div>
      <ul class="nav navbar-top-links navbar-right">
         <li>
            <a href="<?php echo APP_ROOT;?>admin/manage_user.php" title="Home"><i class="fa fa-user-secret"></i> Home</a>
         </li>
         <li>
            <a href="<?php echo APP_ROOT;?>blog/wp-login.php" target="_blank" title="Blog Admin"><i class="fa fa-wordpress"></i> Blog Admin</a>
         </li>
         <li>
            <a href="<?php echo APP_ROOT;?>" target="_blank" title="Site"><i class="fa fa-home"></i>Visit Site</a>
         </li>
         <li>
            <span class="m-r-sm text-muted welcome-message">Welcome <?=$_SESSION[DB_PREFIX]['u_first_name']?></span>
         </li>
         <li>
            <a href="logout.php">
            <i class="fa fa-sign-out"></i> Log out
            </a>
         </li>
      </ul>
   </nav>
</div>
<?php 
$current_page = basename($_SERVER['PHP_SELF']);
$current_page = str_replace('php', '', $current_page);
$getbreadcrumb = $instSys->GetBreadCrumb($current_page);
$breadcrumb = $getbreadcrumb->fetch_array(MYSQLI_ASSOC);

$page_name = (isset($_GET) && count($_GET) > 0) ? str_replace('Add', 'Edit', $breadcrumb['m_name']) : $breadcrumb['m_name'];

/*
if( !isset($_SESSION[DB_PREFIX]['u_id']) ){
    echo '<div class="alert alert-danger"><strong>Under Maintenance!</strong></div>';
    exit();
}else{
    if( $_SESSION[DB_PREFIX]['u_id'] != '8' ){
        echo '<div class="alert alert-danger"><strong>Under Maintenance!</strong></div>';
        exit();
    }
}
*/
?>
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2><?php echo $page_name; ?></h2>
      <ol class="breadcrumb">
         <li>
            <a href="<?php echo ($breadcrumb['parent_url'] != '') ? $breadcrumb['parent_url'] : '#'; ?>"><?php echo ($breadcrumb['parent_name'] != '') ? $breadcrumb['parent_name'] : 'Home'; ?></a>
         </li>
         <li class="active">
            <strong><?php echo $page_name; ?></strong>
         </li>
      </ol>
   </div>
</div>
		
		

<?php 
if( (isset($_SESSION[DB_PREFIX]['u_id'])) && ($_SESSION[DB_PREFIX]['u_id'] == '1' || $_SESSION[DB_PREFIX]['u_id'] == '8' || $_SESSION[DB_PREFIX]['u_id'] == '1579926' || $_SESSION[DB_PREFIX]['u_id'] == '1581081' || $_SESSION[DB_PREFIX]['u_id'] == '3') ){
    //echo 'access';
    $block = 'No';
}else{
     $block = 'Yes';
}
?>

<style>
.scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}

.btn-black { 
  color: #ffffff; 
  background-color: #1B1B1C; 
  border-color: #1B1B1C; 
} 
.btn-black:hover, 
.btn-black:focus, 
.btn-black:active, 
.btn-black.active, 
.open .dropdown-toggle.btn-black { 
  color: #ffffff; 
  background-color: #1B1B1C; 
  border-color: #1B1B1C; 
} 
.btn-black:active, 
.btn-black.active, 
.open .dropdown-toggle.btn-black { 
  background-image: none; 
} 

.btn-blue { 
  color: #ffffff; 
  background-color: #101073; 
  border-color: #101073; 
} 
.btn-blue:hover, 
.btn-blue:focus, 
.btn-blue:active, 
.btn-blue.active, 
.open .dropdown-toggle.btn-blue { 
  color: #ffffff; 
  background-color: #101073; 
  border-color: #101073; 
} 
.btn-blue:active, 
.btn-blue.active, 
.open .dropdown-toggle.btn-blue { 
  background-image: none; 
} 
</style>
<button id="buttonModal" type="button" class="hidden btn btn-rate btn-xs" style="margin-left:40px;" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModalRating"></button>
<div class="modal fade" id="myModalRating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form>
              <div class="form-group">
                <label for="FileInput">File Name </label>
                <input type="text" class="form-control" id="FileInput" aria-describedby="FileHelp" placeholder="eg : Sales TutorKami">
              </div>
              <div class="form-group">
                <label for="YearInput">Year</label>
                <input type="text" class="form-control" id="YearInput" aria-describedby="YearHelp" placeholder="eg : 2020" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalFile">Close</button>
        <button onclick="submitFileName()" type="button" class="btn btn-rate">Submit</button>
      </div>
    </div>
  </div>
</div>
<?PHP 
/*
$seconds = 1;
$date_now = "2021-06-11 16:58:29";
echo date("Y-m-d H:i:s", (strtotime(date($date_now)) + $seconds));
*/
?>
			<div class="wrapper wrapper-content animated fadeInRight" style="overflow-y: scroll; overflow-x: scroll;"  > <!--  -->
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox float-e-margins">

                                <!-- START -->
<button type="button" class="btn btn-info-ori" onclick="openLog();"> <i class="glyphicon glyphicon-folder-open"></i> </button>

                                <input type="hidden" id="block" value="<?PHP echo $block; ?>" >
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info-ori dropdown-toggle" data-toggle="dropdown"><span id="showFile" ></span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu scrollable-menu" role="menu" style="width:250px;">
                                        <li><a onClick="AddFile();" > <i class="glyphicon glyphicon-plus-sign"></i> Create Sales File</a></li>
                                        <li class="divider"></li>
                                        <span id="loadFile" ></span>
                                    </ul>
                                </div>
                                <a target="_blank" href="https://docs.google.com/document/d/1J9BBoPGoGgRFmdaJNZn_sCnGn7-XKJFC52140dVC5cM/edit" type="button" class="btn"> <i style="color:#f1592a;font-size:23px;" class="glyphicon glyphicon-question-sign"></i> </a>
                                
                                <input type="hidden" id="ExportExcel">
                                <!--<button type="button" class="btn btn-info-ori pull-right" onClick="ExportExcel();" >  Export to Excel</button>-->
                                
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-info-ori dropdown-toggle" data-toggle="dropdown">Menu <span class="caret"></span></button>
                                    <ul class="dropdown-menu scrollable-menu" role="menu" style="width:150px;">
                                        <li><a onClick="ExportExcel();" > Export to Excel</a></li>
                                        <li><a onClick="openNewJobs()" > New Jobs</a></li>
                                    </ul>
                                </div>
                                
                                <br/><br/><br/>
                                
                                <span id="loadFileTabs"></span>

                                <!-- END -->
                                
						</div>
					</div>
				</div>
			</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery.appendgrid@2/dist/AppendGrid.js"></script>
<script>

function openNewJobs() {
    var id = document.getElementById("ExportExcel").value;
    window.open('https://www.tutorkami.com/admin/new-jobs?year='+ id,'_blank' );
}

function ExportExcel() {
    var id = document.getElementById("ExportExcel").value;
    $.ajax({
        url: "ajax/allinone.php",
        method: "POST",
        data: {action: 'ExportExcel', id: id}, 
        success: function(result){
            //alert(result);
            window.open('https://www.tutorkami.com/plugins/PHPExcel-1.8/test.php?id='+ id,'_blank' );
            //https://www.tutorkami.com/plugins/PHPExcel-1.8/test.php?id=1
        }
    });
}

function openLog() {
     var data = document.getElementById("showFile").innerHTML;
    if (data != "") {
        if( data == 'Sales File' ){
            alert("Log File Doesn't Exists");
        }else{
            
            var str = data.replace(/\s/g, '');
            var thisR = 'Log-'+str+'.txt';
            $.ajax(thisR).done(function(){ 
                /* File exists */ 
                var top = window.screen.height - 600;
                    top = top > 0 ? top/2 : 0;
                            
                var left = window.screen.width - 700;
                    left = left > 0 ? left/2 : 0;
                
                var uploadWin = window.open("https://www.tutorkami.com/admin/"+thisR,"Log File","width=700,height=600" + ",top=" + top + ",left=" + left);
                    uploadWin.moveTo(left, top);
                    uploadWin.focus();
            }).fail(function(){ 
                /* File doesn't exist */ 
                alert("Log File Doesn't Exists");
            });

        }
    } else { 
        alert('url kosong');
    }
}
function getAfterPart(str) {
    return str.split(' thisID ')[1];
}
function getBeforePart(str){
    return str.substring(0, str.indexOf(" thisID ")); 
}

$(document).ready(function(){
    
    $('#loadFile').load('load-sale-file.php');
    
    var d = new Date();
    var year = d.getFullYear();
    if( year != '' ){
        $.ajax({
            type:'POST',
            url:'sale-process.php',
            data: {
                getYear: {year: year},
            },
            success:function(result){
                if(result == "empty year"){
                    document.getElementById("showFile").innerHTML = 'Sales File';
                }else{
                    document.getElementById("showFile").innerHTML = getBeforePart(result);
                    var loadFileTabs = getAfterPart(result);
                    document.getElementById("ExportExcel").value = loadFileTabs;
                    //$('#loadFileTabs').load('load-sale-file-tabs.php?requiredid='+loadFileTabs);
                    $('#loadFileTabs').load('load-sale-file-tabs-test.php?requiredid='+loadFileTabs);
                    //$('#loadFileTabs').load('load-sale-table.php?requiredid='+loadFileTabs);
                }
            }
        });
    }
    
});

function getSaleFile(id){
    document.getElementById("ExportExcel").value = id;
    if ( id == '' ) {
        alert('Error ..');
    }else{
        $.ajax({
            type:'POST',
            url:'sale-process.php',
            data: {
                getSaleFile: {id: id},
            },
            success:function(result){
                if(result == "empty file"){
                    alert('empty file');
                }else{
                    document.getElementById("showFile").innerHTML = getBeforePart(result);
                    var loadFileTabs = getAfterPart(result);
                    //$('#loadFileTabs').load('load-sale-file-tabs.php?requiredid='+loadFileTabs);
                    $('#loadFileTabs').load('load-sale-file-tabs-test.php?requiredid='+loadFileTabs);
                    //$('#loadFileTabs').load('load-sale-table.php?requiredid='+loadFileTabs);
                }
            }
        });
    }
}

function AddFile(){
    document.getElementById('buttonModal').click();
}

function submitFileName() {
    
    var FileInput = document.getElementById('FileInput').value;
    var YearInput = document.getElementById('YearInput').value;
    
    if ( FileInput == '' || YearInput == '' ) {
        alert('Please insert file name and year ..');
    }else{
        $.ajax({
            type:'POST',
            url:'sale-process.php',
            data: {
                dataFile: {FileInput: FileInput, YearInput: YearInput},
            },
            success:function(result){
                if(/^\d+$/.test(result)) {
                    $('#loadFile').load('load-sale-file.php?requiredid='+result);
                    document.getElementById('closeModalFile').click();
                }else{
                    alert(result);
                }
            }
        });
    }

}
</script>
   <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- alert message -->
	<link rel="stylesheet" href="plugin/lobibox/documentation.css"/>
	<link rel="stylesheet" href="plugin/lobibox/LobiBox.min.css"/>
<!-- alert message -->
<script src="plugin/lobibox/lobibox.min.js"></script>
      <script>
      $(document).ready(function(){
/*
                Lobibox.notify('success', {
                    position: 'top right',
                    //icon: false,
					width: 250, //Any Integer
					size: 'mini',
					//title: filed_label + ' is required'
                    msg: ' test must be valid email'
                });
*/
          $('#date_deadline .input-group.date').datepicker({
              startView: 0,
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              format: "dd-mm-yyyy"
          });
      });
      </script>
</body>
</html>