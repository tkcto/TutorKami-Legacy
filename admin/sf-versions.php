<?php session_start(); ?>

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
   $title = 'SF Versions | Tutorkami';
   require_once('includes/html_head.php');
 ?>

<style>
.link { color: #000080; font-weight: bold; } /* CSS link color (red) */
.link:hover { color: #000080; font-weight: bold; } /* CSS link hover (green) */
</style>

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

                <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                   <div class="col-sm-12">
                    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></style>



                        <table class="table table-bordered">
                              <tr>
                                <thead>																  <th style="width: 3%" scope="col"><center>No</center></th>
								  <th style="width: 10%" scope="col"><center>File Name</center></th>
								  <th style="width: 10%" scope="col"><center> </center></th>
								  <th style="width: 10%" scope="col"><center> </center></th>
                                </thead>
                              </tr>
                              <?PHP																$no = 0;
                                $sqlExcel = " SELECT * FROM tk_excel ORDER BY ex_date DESC ";
                                $resultExcel = $conDB->query($sqlExcel);
                                if ($resultExcel->num_rows > 0) {
                                    while($rowExcel = $resultExcel->fetch_assoc()){

                                        $fullpath = $rowExcel["ex_name"];
                                        $folder = substr($fullpath, 0, strpos($fullpath, '_'));																				$no++;
                                        ?>
                                              <tr>											  												<td rowspan=""><center><b><?PHP echo $no; ?></b></center></td>
                                                <td rowspan=""><b><?PHP echo str_replace(".xls","",$rowExcel["ex_name"]); ?></b></td>
                                                <td rowspan="">
                                                    <center> <a class="link" href="excel/<?PHP echo $rowExcel["ex_name"]; ?>">Download</a> </center>
                                                </td>
                                                <td rowspan="">
                                                    <center><?PHP
                                                    if(file_exists("excel/".$folder.'.sql')){
                                                        ?>
                                                        <a class="link" onclick="Restore('<?PHP echo $folder.'.sql'; ?>')" >Restore</a>
                                                        <?PHP
                                                    }
                                                    ?></center>
                                                </td>
                                              </tr>
                                        <?PHP
                                    }
                                }
                              ?>
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
function Restore(file) {
    if( file == '' ){
        alert('Error');
    }else{
        var x = confirm("Are you sure you want to Restore?");
        if (x == true){
                $.ajax({
                    url: "ajax/allinone.php",
                    method: "POST",
                    data: {action: 'RestoreDB', file: file},
                    success: function(result){
                        if(result == 1){
                            alert('Success');
                        }else{
                            alert('Error..');
                        }
                    }
                });
        }
    }
}

</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

