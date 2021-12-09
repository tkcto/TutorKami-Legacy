<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
$instApp = new app;
$regUserWeek = $instApp->RegisteredUser(7);
$regUserBiWeek =  $instApp->RegisteredUser(14);
$regUserMonth = $instApp->RegisteredUser(30);
$regUserYear = $instApp->RegisteredUser(365);

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
   $title = 'Dashboard | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
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
if ( $conDB->query($updateLastPage) === TRUE ) {
    //echo "Update Is Successful";
}
//$dbCon->close();
?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
             <div class="row">
              <div class="col-lg-12">
               <div class="ibox float-e-margins">
                <div class="ibox-title">
                 <h5>Registered Users</h5>
                 <div class="el-right">
                  
                  
              </div>
          </div>
          <div class="ibox-content">
<!-- https://www.chartjs.org  -->
<div class="row">
   <div class="col-sm-12">
          <div style="width: 80%;margin: 0px auto;"><canvas id="myChart" height=200 width=500></canvas></div>
   </div>
</div><br/>
<div class="row">
   <div class="col-sm-6">
          <div style="width: 80%;margin: 0px auto;"><canvas id="tutorGender" height=200 width=500></canvas></div>
   </div>
   <div class="col-sm-6">
          <div style="width: 80%;margin: 0px auto;"><canvas id="parentGender" height=200 width=500></canvas></div>
   </div>
</div><br/>


<div class="row">
   <div class="col-sm-12">
        <div style="width: 80%;margin: 0px auto;"><canvas id="bar-chart" width="800" height="450"></canvas></div>
   </div>
</div>


<br/><br/><br/><br/>
             <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
             
<div class="row">
   <div class="col-sm-12">
   
          

    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded" data-page-size="15">
     <thead>
      <tr>
       <th class="footable-visible footable-first-column footable-sortable">In Last 7 days<span class="footable-sort-indicator"></span></th>
       <th class="footable-visible footable-first-column footable-sortable">In Last 14 days<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">In Last Month<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">In Last Year<span class="footable-sort-indicator"></span></th>
       <!-- <th data-hide="phone" class="footable-visible footable-sortable">Edit<span class="footable-sort-indicator"></span></th> -->

   </tr>
</thead>
<tbody>
  <tr class="footable-even" style="display: table-row;">
   <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
     <?php echo $regUserWeek[0];?>
   </td>
   <td class="footable-visible">
     <?php echo $regUserBiWeek[0];?>
  </td>
  <td class="footable-visible">
     <?php echo $regUserMonth[0];?>
  </td>

  <td class="footable-visible">
     <?=($regUserYear[0])?>
  </td>
</tr>
</tbody>

</table>



</div>
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

<!-- Mainly scripts -->

<?PHP
/*$dbConnection = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
} */

$querySuperAdmin = "SELECT * FROM tk_user WHERE u_role='1'";
$resultSuperAdmin  = $conDB->query($querySuperAdmin);
//$resultSuperAdmin ->num_rows;
//$totalSuperAdmin = $resultSuperAdmin;

$queryAdmin = "SELECT * FROM tk_user WHERE u_role='2'";
$resultAdmin = $conDB->query($queryAdmin);


$queryTutor = "SELECT * FROM tk_user WHERE u_role='3'";
$resultTutor = $conDB->query($queryTutor);


$queryParent = "SELECT * FROM tk_user WHERE u_role='4'";
$resultParent = $conDB->query($queryParent);

$queryTutorGenderM = "SELECT * FROM tk_user WHERE u_role='3' AND u_gender='M' ";
$resultTutorGenderM = $conDB->query($queryTutorGenderM);
$queryTutorGenderF = "SELECT * FROM tk_user WHERE u_role='3' AND u_gender='F' ";
$resultTutorGenderF = $conDB->query($queryTutorGenderF);

$queryParentGenderM = "SELECT * FROM tk_user WHERE u_role='4' AND u_gender='M' ";
$resultParentGenderM = $conDB->query($queryParentGenderM);
$queryParentGenderF = "SELECT * FROM tk_user WHERE u_role='4' AND u_gender='F' ";
$resultParentGenderF = $conDB->query($queryParentGenderF);

$queryJobPre = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '1' ";
$resultPre = $conDB->query($queryJobPre);

$queryJobTahap1 = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '2' ";
$resultTahap1 = $conDB->query($queryJobTahap1);

$queryJobTahap2 = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '3' ";
$resultTahap2 = $conDB->query($queryJobTahap2);

$queryJobPT3 = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '4' ";
$resultPT3 = $conDB->query($queryJobPT3);

$queryJobPSPM = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '5' ";
$resultSPM = $conDB->query($queryJobPSPM);

$queryJobPrimary  = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '6' ";
$resultPrimary = $conDB->query($queryJobPrimary);

$queryJobLower  = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '7' ";
$resultLower = $conDB->query($queryJobLower);

$queryJobYear  = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '8' ";
$resultYear = $conDB->query($queryJobYear);

$queryJobOthers = " SELECT * FROM tk_job WHERE j_payment_status = 'paid' AND j_status = 'closed' AND j_jl_id = '9' ";
$resultOthers = $conDB->query($queryJobOthers);




//$dbConnection->close();
?>
<script>
// https://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
      labels: [""],
      datasets: [{
         label: "Super Admin",
         backgroundColor: "#A569BD",
         data: [<?php echo $resultSuperAdmin->num_rows; ?>],
      },{
         label: "Admin",
         backgroundColor: "#5DADE2",
         data: [<?php echo $resultAdmin->num_rows; ?>],
      },{
         label: "Tutor",
         backgroundColor: "#45B39D",
         data: [<?php echo $resultTutor->num_rows; ?>],
      },{
         label: "Parent",
         backgroundColor: "#DC7633",
         data: [<?php echo $resultParent->num_rows; ?>],
      }]
				/*labels: ["Super Admin", "Admin", "Tutor", "Parent"],
				datasets: [{
					label: '',
					data: [
					<?php echo $resultSuperAdmin->num_rows; ?>, 
					<?php echo $resultAdmin->num_rows; ?>, 
					<?php echo $resultTutor->num_rows; ?>, 
					<?php echo $resultParent->num_rows;?>
					],
					backgroundColor: [
					//'rgba(255, 99, 132, 0.2)',
					//'rgba(54, 162, 235, 0.2)',
					//'rgba(255, 206, 86, 0.2)',
					//'rgba(75, 192, 192, 0.2)'
                    'salmon',
					'green',
					'teal',
					'gray'
					],
					//borderColor: [
					//'rgba(255,99,132,1)',
					//'rgba(54, 162, 235, 1)',
					//'rgba(255, 206, 86, 1)',
					//'rgba(75, 192, 192, 1)'
					],
					borderWidth: 2
				}]*/
			},
			options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'List Of Users'
                },
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true,
                            //max: 5,
                            min: 0,
                            //stepSize: 50
						}
					}]
				}
			}
		});




var tutorGender = $("#tutorGender");
var myChart = new Chart(tutorGender, {
    type: 'pie',
    data: {
        labels: ["Male", "Female"],
        datasets: [
        {
            data: [<?php echo $resultTutorGenderM->num_rows; ?>,<?php echo $resultTutorGenderF->num_rows; ?>],
            backgroundColor: [
            "#717D7E",
            "#F08080"
            ]
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Gender - Tutor'
        },
		responsive: true,
        maintainAspectRatio: false,
    }
});


var parentGender = $("#parentGender");
var myChart = new Chart(parentGender, {
    type: 'pie',
    data: {
        labels: ["Male", "Female"],
        datasets: [
        {
            data: [<?php echo $resultParentGenderM->num_rows; ?>,<?php echo $resultParentGenderF->num_rows; ?>],
            backgroundColor: [
            "#717D7E",
            "#F08080"
            ]
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Gender - Parent'
        },
		responsive: true,
        maintainAspectRatio: false,
    }
});







new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["Pre-School", "Tahap 1 (Tahun 1-3)", "Tahap 2 (UPSR)", "Form 1-3 (PT3)", "Form 4-5 (SPM)", "Primary (International Syllabus)", "Lower Secondary (International Syllabus)", "Year 10-11 (IGCSE)", "Others"],
      datasets: [
        {
          label: "Total",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#808000","#00FF00","#008000","#0000FF"],
          data: [<?php echo $resultPre->num_rows; ?>,<?php echo $resultTahap1->num_rows; ?>,<?php echo $resultTahap2->num_rows; ?>,<?php echo $resultPT3->num_rows; ?>,<?php echo $resultSPM->num_rows; ?>,<?php echo $resultPrimary->num_rows; ?>,<?php echo $resultLower->num_rows; ?>,<?php echo $resultYear->num_rows; ?>,<?php echo $resultOthers->num_rows; ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Closed and Paid - Job'
      }
    }
});


	</script>
</body>
</html>
