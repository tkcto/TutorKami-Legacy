<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;
$instUser = new user;
if(isset($_REQUEST['cld'])){
  $res = $instApp->DeleteClasses($_REQUEST['cld']);
}

$resClasses = $instApp->FetchClasses();  

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
   $title = 'Classes List | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>


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
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>
            <div class="wrapper wrapper-content animated fadeInRight">
             <div class="row">
              <div class="col-lg-12">
               <div class="ibox float-e-margins">
                <div class="ibox-title">
                 <h5>Classes</h5>
                 <div class="el-right">
                  <a href="classes-add.php" class="btn btn-primary">Add New</a>
                  
              </div>
          </div>
          <div class="ibox-content">

             <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
              
<div class="row">
   <div class="col-sm-12">
    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded" data-page-size="15">
     <thead>
      <tr>
       <th class="footable-visible footable-first-column footable-sortable">Job Id<span class="footable-sort-indicator"></span></th>
       <th class="footable-visible footable-first-column footable-sortable">Student Name<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">Tutor Name<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Subject<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Rate<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Hourly Balance<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Cycle<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Status<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">Edit<span class="footable-sort-indicator"></span></th>

   </tr>
</thead>
<tbody>
  <?php while($arrClasses = $resClasses->fetch_assoc()) {
    // var_dump($arrClasses['cl_student_id']); 
    $arrStudent = $instUser->GetUserDetail($arrClasses['cl_student_id']); 
    $arrTutor = $instUser->GetUserDetail($arrClasses['cl_tutor_id']);
    $arrSubject = $instApp->GetSubject($arrClasses['cl_subject_id']);
    ?>
  <tr class="footable-even" style="display: table-row;">
   <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
     
    <?php echo $arrClasses['cl_display_id']; ?>
   </td>
   <td class="footable-visible">
     <?php echo $arrClasses['cl_student'];?>
   </td>
   <td class="footable-visible">
     <?php echo $arrTutor['u_displayname'];?>
   </td>

   <td class="footable-visible">
    <?php echo $arrClasses['cl_subject'];?>
     
   </td>
   <td class="footable-visible">
    <?php echo $arrClasses['cl_rate'];?>
     
   </td>
   <td class="footable-visible">
    <?php //echo $arrClasses['cl_hours_balance'];

    $first = strtok($arrClasses['cl_hours_balance'], '.');
    //echo intval($first); 
    //echo substr($arrClasses['cl_hours_balance'], strrpos($arrClasses['cl_hours_balance'], '.' )+1)."\n";
    if (strpos($arrClasses['cl_hours_balance'], '.') !== false) {
        //echo intval($first) .' hrs & '. substr($arrClasses['cl_hours_balance'], strrpos($arrClasses['cl_hours_balance'], '.' )+1) .' min';
        $searchForValue = '-';
        if( strpos($first, $searchForValue) !== false ) {
             echo preg_replace('/[ -]+/', ' - ', trim($first)) .' hrs & ';
        }else{
            echo intval($first) .' hrs & ';
        }
        echo substr($arrClasses['cl_hours_balance'], strrpos($arrClasses['cl_hours_balance'], '.' )+1) .' min';
        
    }else{
        //echo intval($first) .' hrs & 00 min';
        $searchForValue = '-';
        if( strpos($first, $searchForValue) !== false ) {
             echo preg_replace('/[ -]+/', ' - ', trim($first)) .' hrs & 00 min';
        }else{
            echo intval($first) .' hrs & 00 min';
        }
        
        
    }
    


    ?>
     
   </td>
   <td class="footable-visible">
    <?php echo $arrClasses['cl_cycle'];?>
     
   </td>
   <td class="footable-visible">
    <?php echo $arrClasses['cl_status'];?>
     
   </td>
  <td class="footable-visible footable-last-column">
   <div class="btn-group">
     <a href="classes-add.php?cl=<?php echo $arrClasses['cl_display_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
    <!-- <a href="classes-list.php?cld=<?php echo $arrClasses['cl_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a> -->
    <a class="gray-text"><button class="btn-white btn edt-btn btn-xs" onClick="return ConfirmDelete(<?php echo $arrClasses['cl_id'];?>);" type="submit" id="delete">Delete</button>  </a>           
 </div>
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
</div>
</div>

<?php include_once('includes/footer.php'); ?>
<script>
function ConfirmDelete(id){
	var x = confirm("Are you sure you want to delete?");
	if (x == true){
		//alert(id);
	$.ajax({
		type:'POST',
		url:'classes-details-save.php',
		data: {
			dataDelete: {id: id},
		},
		beforeSend: function() {
		},
		success:function(result){
			alert(result);
			if(result == "Data Has Been Deleted"){
				window.location = "classes-list.php"
			}
		}
	});
		
	}
}
</script>
</div> 

</div>
<!-- Mainly scripts -->
</body>
</html>
