<?php 
require_once('includes/head.php');

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
  $title = 'Video Profile | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>

		
<style>
.btn-danger { 
  color: #ffffff; 
  background-color: #B81818; 
  border-color: #B81818; 
} 
 
.btn-danger:hover, 
.btn-danger:focus, 
.btn-danger:active, 
.btn-danger.active, 
.open .dropdown-toggle.btn-danger { 
  color: #ffffff; 
  background-color: #B81818; 
  border-color: #B81818; 
} 
 
.btn-danger:active, 
.btn-danger.active, 
.open .dropdown-toggle.btn-danger { 
  background-image: none; 
} 
 
.btn-danger.disabled, 
.btn-danger[disabled], 
fieldset[disabled] .btn-danger, 
.btn-danger.disabled:hover, 
.btn-danger[disabled]:hover, 
fieldset[disabled] .btn-danger:hover, 
.btn-danger.disabled:focus, 
.btn-danger[disabled]:focus, 
fieldset[disabled] .btn-danger:focus, 
.btn-danger.disabled:active, 
.btn-danger[disabled]:active, 
fieldset[disabled] .btn-danger:active, 
.btn-danger.disabled.active, 
.btn-danger[disabled].active, 
fieldset[disabled] .btn-danger.active { 
  background-color: #B81818; 
  border-color: #B81818; 
} 
 
.btn-danger .badge { 
  color: #B81818; 
  background-color: #ffffff; 
}

.dataTables_filter, .dataTables_info { display: none; }

#confirmBox
{
    /*display: none;*/
    background-color: #eee;
    border-radius: 5px;
    border: 1px solid #aaa;
    /*position: fixed;*/
    width: 300px;
    /*left: 50%;*/
    margin-left: -150px;
    padding: 6px 8px 8px;
    box-sizing: border-box;
    text-align: center;
    
  position: absolute;
  left: 55%;
  top: 20%;
  transform: translate(-50%, -50%);
}
#confirmBox .button {
    background-color: #ccc;
    display: inline-block;
    border-radius: 3px;
    border: 1px solid #aaa;
    padding: 2px;
    text-align: center;
    width: 80px;
    cursor: pointer;
}
#confirmBox .button:hover
{
    background-color: #ddd;
}
#confirmBox .message
{
    text-align: left;
    margin-bottom: 8px;
}

.bg-image {
  /* The image used */
  background-image: url("photographer.jpg");
  
  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
video {
  width: 300px;
  height: 300px;
}
</style>
</head>

<body>
  <div id="wrapper">
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper" class="gray-bg">
      <?php include_once('includes/header.php'); ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';

$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}

?>

      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12 ">

          <div class="ibox float-e-margins localization">
            <div class="ibox-title">
              <h5>Video Profile</h5>
              <div class="ibox-tools" id="blurBg"><br/><br/> 







	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Display ID</th>
                <th>File Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
		
<?PHP
/*
$queryLevel = " SELECT * FROM tk_job_level_translation WHERE jlt_lang_code='en' "; 
$resultLevel = $conn->query($queryLevel); 
if($resultLevel->num_rows > 0){ 
    while($rowLevel = $resultLevel->fetch_assoc()){        
    }
}*/
?>
<?php
$directory = "../video/";

// Open a directory, and read its contents
if (is_dir($directory)){
  if ($opendirectory = opendir($directory)){
    while (($file = readdir($opendirectory)) !== false){
      //echo "filename:" . $file . "<br>";
	  if( $file == '.' || $file == '..' ){
	  }else{
	  ?>
            <tr>
                <td> <?PHP $arr = explode("_", $file, 2); $first = $arr[0]; echo '<label class="label label-danger"><span class="glyphicon glyphicon-user"></span> <a href="manage_user?action=edit&u_id='.$first.'" target="_blank" style="color:#FFF; text-decoration: none;font-size: 15px;">'.$first.'</a></label> ';  ?>
				</td>
                <td><?PHP echo $file; ?>
				</td>
                <td>
					<button type="button" class="btn btn-primary btn-sm" onclick="displayIframe('<?php echo $file; ?>')" ><span class="glyphicon glyphicon-picture"></span> View</button>
					<a href="https://www.tutorkami.com/video/<?PHP echo $file; ?>" download><button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></span> Download</button></a>
					
					<?PHP
					if( $file != 'yavdi9o_30-10-2020_22-06-50_Video_Resume_Hamidah_Mohd_Zain.mp4'){
					    ?>
					        <button type="button" class="btn btn-danger" onclick="deleteVideo('<?php echo $file; ?>')" ><span class="glyphicon glyphicon-floppy-remove"></span> Delete</button>
					    <?PHP					    
					}
					?>
                </td>
            </tr>	  
	  <?PHP
	  }
    }
    closedir($opendirectory);
  }
}
?>
		
		



        </tbody>

    </table>


			  

             </div>
<div id="confirmBox" class="hidden">
    <div class="message"></div>
    <span class="button yes">Yes</span>
    <span class="button no">No</span>
</div>

<center>
    <div id="iframeDisplay">
        <b>Example of video that cannot be approved<b> <br><br><br> 
        <!---<iframe src='https://www.tutorkami.com/video/yavdi9o_30-10-2020_22-06-50_Video_Resume_Hamidah_Mohd_Zain.mp4' height='400' width='600' controls></iframe>-->
        <div class="row">
            <div class="col-lg-3 "></div>
            <div class="col-lg-6 ">
                <video width="520" height="340" controls>
                  <source src="https://www.tutorkami.com/video/yavdi9o_30-10-2020_22-06-50_Video_Resume_Hamidah_Mohd_Zain.mp4" type="video/mp4" height='400' width='600'>
                </video>          
            </div>
            <div class="col-lg-3 "></div>
        </div>
    </div>
    <div id="iframeDisplay2"></div>
</center>
<br/><br/><br/>
             
           </div>		  
          </div>
		  
        </div>
       </div>
      </div>     




<?php include_once('includes/footer.php'); ?>


<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" language="javascript" >
$(document).ready(function() {
    $('#example').DataTable( );
} );

function doConfirm(msg, yesFn, noFn) {
    var confirmBox = $("#confirmBox");
    confirmBox.find(".message").text(msg);
    confirmBox.find(".yes,.no").unbind().click(function () {
        confirmBox.hide();
    });
    confirmBox.find(".yes").click(yesFn);
    confirmBox.find(".no").click(noFn);
    confirmBox.show();
} 


function deleteVideo(id) {
    
  var blurBg = document.getElementById("blurBg");
  blurBg.classList.add("bg-image");
  var confirmBox = document.getElementById("confirmBox");
  confirmBox.classList.remove("hidden");
 
  
    doConfirm("Are you sure you want to delete?", function yes() {
        //alert('yes');
    	$.ajax({
    		type:'POST',
    		url:'delete-video.php',
    		data: {
    			dataReset: {id: id},
    		},
    		success:function(result){
    		    if( result == 'success'){
        			blurBg.classList.remove("bg-image");
        			alert(result);
    				location.reload();    		        
    		    }else{
        			blurBg.classList.remove("bg-image");
    		        alert(result);
    		    }

    		}
    	});
        
    }, function no() {
        //alert('no');
        blurBg.classList.remove("bg-image");
    });
/*
     var x = confirm("Are you sure you want to delete?");
	 if (x == true){
    	$.ajax({
    		type:'POST',
    		url:'delete-video.php',
    		data: {
    			dataReset: {id: id},
    		},
    		success:function(result){
    		    if( result == 'success'){
        			alert(result);
    				location.reload();    		        
    		    }else{
    		        alert(result);
    		    }

    		}
    	});
	 }
*/
}

function displayIframe(file) {
    document.getElementById("iframeDisplay").innerHTML = '';
    document.getElementById("iframeDisplay2").innerHTML = "<iframe src='https://www.tutorkami.com/video/"+file+"' height='400' width='600' ></iframe>";
}
</script>

</div> 

</div>
</body>
</html>
