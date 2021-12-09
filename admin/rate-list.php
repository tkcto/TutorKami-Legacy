<?php 
require_once('includes/head.php'); 
?>
<!DOCTYPE html>
<html>
   <head>
    <?php 
     $title = 'Specific Rate | Tutorkami';
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
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} 
?>
<style>
.btn-blue { 
  color: #ffffff; 
  background-color: #262262; 
  border-color: #262262; 
} 
 
.btn-blue:hover, 
.btn-blue:focus, 
.btn-blue:active, 
.btn-blue.active, 
.open .dropdown-toggle.btn-blue { 
  color: #ffffff; 
  background-color: #262262; 
  border-color: #262262; 
} 
 
.btn-blue:active, 
.btn-blue.active, 
.open .dropdown-toggle.btn-blue { 
  background-image: none; 
} 
 
.btn-blue.disabled, 
.btn-blue[disabled], 
fieldset[disabled] .btn-blue, 
.btn-blue.disabled:hover, 
.btn-blue[disabled]:hover, 
fieldset[disabled] .btn-blue:hover, 
.btn-blue.disabled:focus, 
.btn-blue[disabled]:focus, 
fieldset[disabled] .btn-blue:focus, 
.btn-blue.disabled:active, 
.btn-blue[disabled]:active, 
fieldset[disabled] .btn-blue:active, 
.btn-blue.disabled.active, 
.btn-blue[disabled].active, 
fieldset[disabled] .btn-blue.active { 
  background-color: #262262; 
  border-color: #262262; 
} 
 
.btn-blue .badge { 
  color: #262262; 
  background-color: #ffffff; 
}
</style>
            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox float-e-margins">    

                        <div class="ibox-content">
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                     


    <div class="col-sm-12 align-items-end">
        <div class="col-sm-3">
            <label class="control-label control-label-left">List of Entries with only 1 price data</label>
        </div>
        <div class="col-sm-3">
            <button name="exportExcel1" id="exportExcel1" type="button" class="mt-auto btn btn-primary align-item-centre"><i class="fa fa-file-excel-o"></i> Generate</button>
        </div>
    </div>
    <div class="col-sm-12 align-items-end">
        <div class="col-sm-3">
            <label class="control-label control-label-left">Combine</label>
        </div>
<?php 
//if( $sessionIDLogin == '8'){
?>
        <!--<div class="col-sm-3">
            <button name="exportExcel3" id="exportExcel3" type="button" class="mt-auto btn btn-primary align-item-centre"><i class="fa fa-file-excel-o"></i> Combine</button>
        </div>-->
        <div class="col-sm-3">
            <button name="exportExcel3NEW" id="exportExcel3NEW" type="button" class="mt-auto btn btn-primary align-item-centre"><i class="fa fa-file-excel-o"></i> Combine</button>
        </div>
<?PHP
/*}else{
    echo '
        <div class="col-sm-3">
            <button type="button" class="mt-auto btn btn-primary align-item-centre"><i class="fa fa-file-excel-o"></i> Error</button>
        </div>';
}*/
?>
    </div>
    <div class="col-sm-12 align-items-end">
        <div class="col-sm-3">
            <label class="control-label control-label-left">List of Entries with no price data</label>
        </div>
        <div class="col-sm-3">
            <button name="exportExcel2" id="exportExcel2" type="button" class="mt-auto btn btn-primary align-item-centre"><i class="fa fa-file-excel-o"></i> Generate</button>
        </div>
    </div>
    
    
    <div class="col-sm-12 align-items-end">
        <div class="col-sm-3">
            <label class="control-label control-label-left">Check redundant entries</label>
        </div>
        <div class="col-sm-3">
            <a type="button" href="redundant-price" target="_blank" class="mt-auto btn btn-blue align-item-centre" > Check</a>
        </div>
    </div>

    <div class="col-sm-12 align-items-end">
        <div class="col-sm-3">
            <label class="control-label control-label-left">Not 2 digits</label>
        </div>
        <div class="col-sm-3">
            <button name="exportExcel5" id="exportExcel5" type="button" target="_blank" class="mt-auto btn btn-blue align-item-centre" > Not 2 digits</button>
        </div>
    </div>
    
<?php 
if( $sessionIDLogin == '8'){
?>

    <div class="col-sm-12 align-items-end">
        <div class="col-sm-3">
            <label class="control-label control-label-left">Tutor not validated</label>
        </div>
        <div class="col-sm-3">
            <button name="exportExcel4" id="exportExcel4" type="button" target="_blank" class="mt-auto btn btn-blue align-item-centre" > Check</button>
        </div>
    </div>
    
<?PHP
}
?>
    
    


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
   </body>
</html>

<script>
    $('#exportExcel1').click(function(){
        window.open("https://www.tutorkami.com/admin/excel-rate1.php", "_blank");
    });
    $('#exportExcel2').click(function(){
	    window.open("https://www.tutorkami.com/admin/excel-rate2.php", "_blank");
    });
    $('#exportExcel3').click(function(){
	    window.open("https://www.tutorkami.com/admin/excel-rate3.php", "_blank");
    });

    $('#exportExcel3NEW').click(function(){
	    window.open("https://www.tutorkami.com/admin/excel-rate3new.php", "_blank");
    });
    
    
    $('#exportExcel4').click(function(){
	    window.open("https://www.tutorkami.com/admin/tutor-not-validated.php", "_blank");
    });
    $('#exportExcel5').click(function(){
	    window.open("https://www.tutorkami.com/admin/excel-rate5.php", "_blank");
    });
</script>