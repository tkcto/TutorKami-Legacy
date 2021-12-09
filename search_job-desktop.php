<?php 

require_once('includes/head.php');



if (count($_POST) > 0) {

  $data = $_POST;

  

  $output = system::FireCurl(SEACRH_JOB_URL, "POST", "JSON", $data);

  $search = $output->data;


} else {

  $data = array('status' => 'open');

  

  $output = system::FireCurl(SEACRH_JOB_URL, "POST", "JSON", $data);

  $search = $output->data;


}


include('includes/headernonmobile.php');
//include('includes/header.php');
$_SESSION['getPage'] = "Search Job";
unset($_SESSION["firstlogin"]);
?>

<link rel="stylesheet" href="css/select2.css">

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<script   src="https://code.jquery.com/jquery-3.3.1.js"></script>
<style>
.banner{
  width:100%;
  height:100vh;
  /*background: url(https://images.pexels.com/photos/683929/pexels-photo-683929.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940) no-repeat center center fixed;
  */background-size:cover;
} 
.content{
  padding:50px 100px;
}
.content h2{
  padding:0;
  margin:0 0 20px;
  /*font-size:30px;*/
}
.content p{
  /*font-size:18px;*/
}
.par p{
  font-size:14px;
}
.sidebar-contact{
  position:fixed;
  top:50%;
  right:-350px;
  transform:translateY(-50%);
  width:350px;
  height:auto;
  padding:30px;
  background:#fff;
  box-shadow: 0 20px 50px rgba(0,0,0,.5);
  box-sizing:border-box;
  transition:0.5s;
  /*font-family: "Times New Roman", Times, serif;*/
}
.sidebar-contact.active{
  right:0;
}
.sidebar-contact input,
.sidebar-contact textarea{
  width:100%;
  height:36px;
  padding:5px;
  margin-bottom:10px;
  box-sizing:border-box;
  border:1px solid rgba(0,0,0,.5);
  outline:none;
}
.sidebar-contact h2{
  margin:0 0 20px;
  padding:0;
  color: #271A60;
}
.sidebar-contact textarea{
  height:60px;
  resize:none;
}
.sidebar-contact input[type="submit"]{
  background:#00bcd4;
  color:#fff;
  cursor:pointer;
  border:none;
  /*font-size:18px;*/
}
.toggle{
 /*position:absolute;
   height:48px;
  width:48px;
  text-align:center;
  cursor:pointer;
  background:#f00;
  top:0;
  left:-48px;
  line-height:48px;*/
  
 position:absolute;
   /*height:48px;
  width:48px;*/
  text-align:center;
  cursor:pointer;
  background:#f00;
  top:10;
  left:-134px;
  line-height:48px;
  color:white;
  margin-top:80px;
  font-family:"Lucida Console", Monaco, monospace;

    -moz-transform: rotate(-90deg);
    -moz-transform-origin: center center;
    -webkit-transform: rotate(-90deg);
    -webkit-transform-origin: center center;
    -ms-transform: rotate(-90deg);
    -ms-transform-origin: center center;
}
.toggle:before{
  /*content:'\f003';
  content:'\f00d';*/
  font-family:fontAwesome;
  font-size:18px;
  color:#fff;
}
.toggle.active:before{
  /*content:'\f00d';
  content:'\f003';*/
}
@media(max-width:768px)
{
  .sidebar-contact{
    width:100%;
    height:100%;
    right:-100%;
  }
  .sidebar-contact .toggle{
    top:50%;
    transform:translateY(-50%);
    transition:0.5s;
  }
  .sidebar-contact.active .toggle
  {
    top:0;
    left:0;
    transform:translateY(0);
  }
  .scroll{
    width:100%;
    height:100%;
    overflow-y:auto;
  }
  .content{
    padding:50px 50px;
  }
}

.sidebar-contact img {
    max-width: 100%;
    max-height: 100%;
}

.msg {

}
.btn-custom { 
  color: #ffffff; 
  background-color: #f1592a; 
  border-color: #F1592A; 
} 
 
.btn-custom:hover, 
.btn-custom:focus, 
.btn-custom:active, 
.btn-custom.active, 
.open .dropdown-toggle.btn-custom { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-custom:active, 
.btn-custom.active, 
.open .dropdown-toggle.btn-custom { 
  background-image: none; 
} 
.btn:focus,.btn:active {
   outline: none !important;
   box-shadow: none;
}
</style>
<script>
$(document).ready(function(){
  $('.toggle').click(function(){
    $('.sidebar-contact').toggleClass('active')
    $('.toggle').toggleClass('active')
	if($('.toggle').hasClass('active')){
		$("#iconclose").css("display", "none");
	}else{
		$("#iconclose").css("display", "");
	}
  })
})
</script>

<section class="profile searchjob">

   <div class="main-body">

      <div class="container">
<!-- text-uppercase -->
         <h1 class="text-center blue-txt"><?php echo SEARCH_JOB; ?></h1>

         <div class="col-md-12 ">

            <hr>

            <!--<form method="post">-->

               <div class="col-md-10 col-md-offset-1 ">               

                  <table class="table table-responsive " width="100%" border="0" cellspacing="0" cellpadding="0">

<div class="sidebar-contact active">
<?PHP
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
$queryNoti = $conn->query("SELECT * FROM tk_user_notification");
$resNoti = $queryNoti->num_rows;
    if($resNoti > 0){
       $rowNoti = $queryNoti->fetch_assoc();
?>
    <div class="toggle"> &nbsp;&nbsp;<i class="fa fa-times" id="iconclose"></i> Announcement &nbsp;&nbsp; </div>
    <div class="scroll">
		<!--<div class="par"><p><?PHP //echo $rowNoti['text']; ?></p></div>-->
        <button id="no1" type="button" class="btn btn-custom" >Latest </button> 
        <button id="no3" type="button" class="btn btn-default" >Urgent </button> 
        <button id="no2" type="button" class="btn btn-default" >Profile </button>
        <div style="margin-top:10px;"></div>
            <div id="content1" class="collapse in">
                <div class="par"><p>
				
                    <p><strong><a href="https://chat.whatsapp.com/KCwZftki5fK7ny2RMRmORq" target="_blank">What’s App Group</a></strong></p>
                    <p>Dapatkan info job terkini di KL & Selangor dengan lebih pantas melalui What’s App. Klik link di bawah utk join group ini:</p>
                    <p><a href="https://chat.whatsapp.com/KCwZftki5fK7ny2RMRmORq" target="_blank">https://bit.ly/30a9EFT</a></p>
                    <p>&nbsp;</p> 
                    <p>&nbsp;</p> 

                </p></div>
            </div>
            <div id="content3" class="hidden">
                <div class="par"><p>

                    <?PHP 
                    $queryNews = $conn->query("SELECT * FROM tk_user_news");
                    $resNews = $queryNews->num_rows;
                    if($resNews > 0){
                           $rowNews = $queryNews->fetch_assoc();
                            echo $rowNews['text'];
                    }
                    ?> 
                </p></div>
            </div>
            <div id="content2" class="hidden">
                <div class="par"><p>
                    <?PHP echo $rowNoti['text']; ?>
                </p></div>
            </div>



    </div>
<?PHP
    }else{
 ?>
    <div class="toggle"></div>
    <h2></h2>
    <div class="scroll">
	<p></p>
    </div>
<?PHP
	}
 ?>
</div>
<!-- https://codepen.io/bootpen/pen/jbbaRa -->


                     <tbody>

                        <tr>

                           <td class="org-txt " width="20%"><strong><?php echo SEARCH_JOB_STATE; ?> :</strong></td>

                           <td width="80%" class="from_all">

                              <div class="form-group">

                                 <select class="form-control" name="state" id="state">
                                    <option value="<?php echo "All"; ?>">All</option>
                                    <option value="1384">Online Tuition</option>
                                    <?php 

                                    // Get Country

                                    $getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');

                                    if ($getAllCountries->flag == 'success' && count($getAllCountries->data) > 0) {

                                      $i = 0;

                                      foreach ($getAllCountries->data as $key => $country) {

                                        // Get State By Country Id

                                        $getCountryWiseStates = system::FireCurl(LIST_STATE_URL.'?country_id='.$country->c_id);

                                        if ($getCountryWiseStates->flag == 'success' && count($getCountryWiseStates->data) > 0) {

                                          foreach ($getCountryWiseStates->data as $key => $state) {

                                    ?>

                                    <option value="<?php echo $state->st_id; ?>" <?php if (count($_POST) > 0) {if($_SESSION['col-getState'] == $state->st_id) echo "selected";} ?> ><?php if($getLan == "/my/"){ echo $state->st_name_bm; }else{ echo $state->st_name; } //echo $state->st_name; ?></option>

                                    <?php 

                                          }

                                        }

                                      }

                                    }

                                    ?>                                  

                                 </select>

                              </div>

                           </td>

                        </tr>

                        <tr>

                           <td class="org-txt"><strong><?php echo SEARCH_JOB_LEVELS; ?> :</strong></td>

                           <td >

                              <div class="form-group">

                                 <select class="form-control" name="course" id="course">
                                    <option value="<?php echo "All"; ?>">All</option>
                                    <?php 

                                    // Get Course

                                    $getCourse = system::FireCurl(LIST_LEVEL_URL);

                                    if ($getCourse->flag == 'success' && count($getCourse->data) > 0) {

                                      $i = 0;

                                      foreach ($getCourse->data as $key => $course) {

                                    ?>

                                    <option value="<?php echo $course->jl_id; ?>"><?php if($getLan == "/my/"){ echo $course->jlt_description; }else{ echo $course->jlt_title; }//echo $course->jlt_title; ?></option>

                                    <?php 

                                      }

                                    }

                                    ?>

                                 </select>

                              </div>

                           </td>

                        </tr>

                        <tr>

                           <td class="org-txt"><strong><?php echo SEARCH_JOB_STATUS; ?> :</strong></td>

                           <td >

                              <div class="form-group">

                                 <select class="form-control" id="status" name="status">
                                    <option value="All">All</option>
                                    <option value="open">Open</option>
                                    <option value="closed">Closed</option>

                                 </select>

                              </div>

                           </td>

                        </tr>

                        <tr>

                           <td class="org-txt"><strong><?php echo SEARCH_JOB_JOB_ID; ?> :</strong></td>

                           <td ><input id="job_id" type="text" class="form-control" name="job_id" placeholder="If you already know the job ID you want to search, enter it here"></td>

                        </tr>
						

                        <tr class="hidden">
                           <td class="org-txt"><strong><?php echo "thissort"; ?>:</strong></td>
                           <td >
                              <div class="form-group">
                                 <select class="form-control" id="thissort" name="thissort">
                                    <option value="DESC">DESC</option>
                                    <option value="ASC">ASC</option>
                                 </select>
                              </div>
                           </td>
                        </tr>

                     </tbody>

                  </table>            

               </div>
			   
               

               <div class="clearfix"></div>

               <div class="col-md-offset-5 col-md-4 col-xs-offset-3">

                  <button type="button" id="filter" name="filter" class="apply text-uppercase"><?php echo BUTTON_SEARCH_JOB; ?></button>

               </div>

            <!--</form>-->

            <div class="clearfix"></div>

            <div class="job-table">
            <br/>   
            <p><font color="red"><b>NOTE :</b></font> <font color="#262262">Status</font> <font color="#dc3545"><b>'Closed'</b></font> <font color="#262262">means the job is no longer available to apply</font></p>

			  <!-- START fadhli -->
			<table id="search-job-grid" width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive mrg-top-bot text-center" style="background:#fff;">    
				<thead>
					<tr class="blue-bg">
						<!--<td width="10%"><?php //echo SEARCH_JOB_JOB_ID; ?></td>-->
                        <td width="10%"><?php echo SEARCH_JOB_DATE; ?></td>
                        <td width="10%"><?php echo SEARCH_JOB_LEVEL; ?></td>
                        <td width="20%"><?php echo SEARCH_JOB_SUBJECT; ?></td>
                        <td width="15%"><?php echo SEARCH_JOB_LOCATION; ?></td>
                        <td width="15%"><?php echo SEARCH_JOB_RATE; ?></td>
                        <td width="10%"><?php echo 'STATUS'; ?></td>
                        <td width="20%"><?php //echo SEARCH_JOB_REMARKS; ?></td>

					</tr>
				</thead>
			</table>
			  <!-- END fadhli -->

            </div>

            <hr>

         </div>

         <div class="clearfix"></div>

      </div>

   </div>

</section>

<?php include('includes/footer.php');?>

<script src="js/jquery-1.12.4.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

<script src="js/select2.min.js"></script>

<script>
$(document).ready(function(){
	datatableRecord();

	function datatableRecord(state = '', course = '', status = '', job_id = '', thissort = 'DESC'){
		var dataTable = $('#search-job-grid').DataTable({
			"processing" : true,
			"serverSide" : true,
			"order" : [ ],
			"searching" : false,
			"ordering": false,
			
			"info":false,
			"lengthChange":false,
			"bSort":true,
			"bPaginate":true,
			"sPaginationType":"simple_numbers",
			"iDisplayLength": 10,
			
				
			"ajax" : {
				url:"ajax-load-search-job.php",
				type:"POST",
				data:{
					state:state, course:course, status:status, job_id:job_id, thissort:thissort
				}
			}
		});
	}
	

		$('#filter').click(function(){
			var state    = $('#state').val();
			var course   = $('#course').val();
			var status   = $('#status').val();
			var job_id   = $('#job_id').val();
			var thissort = $('#thissort').val();

			if(state != '' || course != '' || status != '' || job_id != '' || thissort != ''){
				$('#search-job-grid').DataTable().destroy();
				datatableRecord(state, course, status, job_id, thissort);
			}else{
				$('#search-job-grid').DataTable().destroy();
				datatableRecord();
			}

		});
	
	
});
</script>
<script>
   jQuery(document).ready(function($){


      $(".clickable-row").click(function() {

           window.location = $(this).data("href");

      });

      

   });
</script>
<script>
    $("#no1").click(function(event) 
    {
       $("#no1").removeClass('btn-custom');
       $("#no2").removeClass("btn-custom");
       $("#no3").removeClass("btn-custom");
       $("#no1").removeClass('btn-default');
       $("#no2").removeClass("btn-default");
       $("#no3").removeClass("btn-default");
       
       $("#no1").addClass("btn-custom");
       $("#no2").addClass("btn-default");
       $("#no3").addClass("btn-default");
       
         
       $("#content1").removeClass("hidden");
       $("#content2").addClass("hidden");
       $("#content3").addClass("hidden");
    });
    $("#no2").click(function(event) 
    {
       $("#no1").removeClass('btn-custom');
       $("#no2").removeClass("btn-custom");
       $("#no3").removeClass("btn-custom");
       $("#no1").removeClass('btn-default');
       $("#no2").removeClass("btn-default");
       $("#no3").removeClass("btn-default");
       
       $("#no1").addClass("btn-default");
       $("#no2").addClass("btn-custom");
       $("#no3").addClass("btn-default");
       
       
       $("#content2").removeClass("hidden");
       $("#content1").addClass("hidden");
       $("#content3").addClass("hidden");
    });
    $("#no3").click(function(event) 
    {
       $("#no1").removeClass('btn-custom');
       $("#no2").removeClass("btn-custom");
       $("#no3").removeClass("btn-custom");
       $("#no1").removeClass('btn-default');
       $("#no2").removeClass("btn-default");
       $("#no3").removeClass("btn-default");
       
       $("#no1").addClass("btn-default");
       $("#no2").addClass("btn-default");
       $("#no3").addClass("btn-custom");
       

       $("#content3").removeClass("hidden");
       $("#content2").addClass("hidden");
       $("#content1").addClass("hidden");
    });
    
</script>