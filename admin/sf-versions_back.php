<?php
/*
date_default_timezone_set("Asia/Kuala_Lumpur");

    //ENTER THE RELEVANT INFO BELOW
    $mysqlUserName      = "tutorka1_live";
    $mysqlPassword      = "_+11pj,oow.L";
    $mysqlHostName      = "localhost";
    $DbName             = "tutorka1_tutorkami_db";
    $backup_name        = date("dmy_His").".sql";
    $tables             = array("1notif", "1notif_user");


    Export_Database($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName,  $tables=$tables, $backup_name=$backup_name );

    function Export_Database($host,$user,$pass,$name,  $tables=false, $backup_name=false )
    {
        $mysqli = new mysqli($host,$user,$pass,$name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables    = $mysqli->query('SHOW TABLES');
        while($row = $queryTables->fetch_row())
        {
            $target_tables[] = $row[0];
        }
        if($tables !== false)
        {
            $target_tables = array_intersect( $target_tables, $tables);
        }
        foreach($target_tables as $table)
        {
            $result         =   $mysqli->query('SELECT * FROM '.$table);
            $fields_amount  =   $result->field_count;
            $rows_num=$mysqli->affected_rows;
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table);
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0)
            {
                while($row = $result->fetch_row())
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )
                    {
                            $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)
                    {
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) );
                        if (isset($row[$j]))
                        {
                            $content .= '"'.$row[$j].'"' ;
                        }
                        else
                        {
                            $content .= '""';
                        }
                        if ($j<($fields_amount-1))
                        {
                                $content.= ',';
                        }
                    }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num)
                    {
                        $content .= ";";
                    }
                    else
                    {
                        $content .= ",";
                    }
                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }
        //$backup_name = $backup_name ? $backup_name : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";
        $date = date("Y-m-d");
        $backup_name = $backup_name ? $backup_name : $name.".$date.sql";
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");
        echo $content; exit;
    }
*/
?>


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
                                <thead>
                                  <th style="width: 10%" scope="col"><center>File Name</center></th>
                                  <th style="width: 10%" scope="col"><center> </center></th>
                                  <th style="width: 10%" scope="col"><center> </center></th>
                                </thead>
                              </tr>
                              <?PHP
                                $sqlExcel = " SELECT * FROM tk_excel ORDER BY ex_date DESC ";
                                $resultExcel = $conDB->query($sqlExcel);
                                if ($resultExcel->num_rows > 0) {
                                    while($rowExcel = $resultExcel->fetch_assoc()){
                                        
                                        $fullpath = $rowExcel["ex_name"];
                                        $folder = substr($fullpath, 0, strpos($fullpath, '_'));
                                        ?>
                                              <tr>
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
/*
$(document).ready(function() {
    $('#example').dataTable( {
    "order": [[ 3, 'desc' ]]
    } );
} );
*/
</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

