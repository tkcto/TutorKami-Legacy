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
   $title = 'Registration Form | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>
</head>
<body>
    <div id="wrapper">
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php');
            
            $sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
            $thisPage = $breadcrumb['m_name'].' Page';
            $updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
            if ( $conDB->query($updateLastPage) === TRUE ) {}            
            ?>



            <div class="wrapper wrapper-content animated fadeInRight">
             <div class="row">
              <div class="col-lg-12">
               <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Registration Form <a href="https://docs.google.com/document/d/1FroM24MnE6t5YGGKDCGV0CSGS1UxMElV1nOtkIGFZTM/edit" target="_blank" ><i class="glyphicon glyphicon-info-sign" style="color:#262262" ></i></a> </h5>
                    <div class="el-right"></div>
                </div>
                
                <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                   <div class="col-sm-12">
                    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></style>

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>School</th>
                                <th>R’ship</th>
                                <th>Job</th>
                                <th>Source</th>
                                <th>Age</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP
                                    	function getAge($dob) {
                                    	    
                                            $old_date = explode('/', $dob); 
                                            $new_data = $old_date[2].'-'.$old_date[1].'-'.$old_date[0];
                                    
                                    		$dateOfBirth = date("Y-m-d", strtotime($new_data));
                                    		$today = date("Y-m-d");
                                    		$diff = date_diff(date_create($dateOfBirth), date_create($today));
                                    		$age = $diff->format('%y');
                                    
                                    		return $age;
                                    	}
                        
                        
                        $query = " SELECT * FROM tk_rform ORDER BY timestamp DESC ";
                        $resultQuery = $conDB->query($query); 
                        if($resultQuery->num_rows > 0){
                        	while($rowQuery = $resultQuery->fetch_assoc()){
                        	?>
                        	
                        	

                        	    <tr>
                                        <td> <?php echo $rowQuery['timestamp']; ?> </td>  
                                        <td> <?php //echo $rowQuery['timestamp'];
                                            $arr = explode(' ',$rowQuery['timestamp']);
                                            
                                            $old_date = explode('-', $arr[0]); 
                                            $new_data = $old_date[2].'/'.$old_date[1].'/'.$old_date[0];

                                            $old_time = explode(':', $arr[1]); 
                                            $new_time = $old_time[0].':'.$old_time[1];
                                            
                                            echo $new_data; //$new_data.' '.$new_time;
                                        ?> </td>   
                                        <td> <a href="https://www.tutorkami.com/admin/manage_user?action=edit&u_id=<?php echo $rowQuery['displayid']; ?>" target="_blank"><?php echo $rowQuery['displayid']; ?></a> </td>   
                                        <td> <?php echo $rowQuery['name']; ?> </td>   
                                        <td> <?php echo $rowQuery['address']; ?> </td>   
                                        <td> <?php echo $rowQuery['school']; ?> </td>   
                                        <td> <?php echo $rowQuery['relationship']; ?> </td>   
                                        <td> <?php echo $rowQuery['occupation']; ?> </td>   
                                        <td> <?php echo $rowQuery['know']; ?> </td>   
                                        <td> <span data-toggle="tooltip" data-placement="left" title="<?PHP echo $rowQuery['dob']; ?>"><?PHP if($rowQuery['dob'] != ''){ echo getAge($rowQuery['dob']); } ?></span> </td>       
                                        <td> <i onclick="deleteShowPopup(<?php echo $rowQuery['id']; ?>)" class="glyphicon glyphicon-remove" style="color:red;cursor: pointer;" ></i> </td>   
                        	    </tr>     
                        	<?PHP
                        	}
                        }
                        ?>
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
</body>
</html>

<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "order": [[ 0, 'desc' ]],
        "columnDefs": [{ "visible": false, "targets": 0 }]
    } );
} );

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

function deleteShowPopup(id){
    var x = confirm("Confirm to delete row?");
    if (x == true){
            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'rform', id: id}, 
                success: function(result){
                    //alert(result);
                    location.reload();
                }
            });
    }
}
</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
