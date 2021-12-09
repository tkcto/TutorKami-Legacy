<?php
require_once('includes/head.php'); 
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/responsive-tabs/css/easy-responsive-tabs.css" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="../css/responsive-tabs/js/easyResponsiveTabs.js"></script>


    <link rel="stylesheet" href="https://www.tutorkami.com/css/balloon.min.css">
    <!-- alert message -->
    	<link rel="stylesheet" href="plugin/lobibox/documentation.css"/>
    	<link rel="stylesheet" href="plugin/lobibox/LobiBox.min.css"/>
    <!-- alert message -->

    <title>New Jobs | Tutorkami</title>
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
            <!--<h2>New Jobs</h2>-->
            <div class="alert alert-success" role="alert"><strong>New Jobs</strong></div>
        <!--<p class="lead"></p>-->
      </div>

      <div class="row">
            <table class="table table-bordered">
                  <tr>
                    <thead>
                      <th style="width: 20%" scope="col"><center>Month & NJs</center></th>
                      <th style="width: 10%" scope="col"><center>TKC</center></th>
                      <th style="width: 10%" scope="col"><center># of NJ</center></th>
                      <th style="width: 60%" scope="col"><center>Job IDs</center></th>
                    </thead>
                  </tr>
                  <?PHP
                  if( isset($_GET['year']) && $_GET['year'] != '' ){
                          $sql = " SELECT * FROM tk_new_jobs WHERE nj_year = '".$_GET['year']."' GROUP BY nj_month ORDER BY FIELD(nj_month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                          $result = $conDB->query($sql);
                          if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                
                                $num = 1;  
                                $thisUser = 0;  
                                $TotalTKC = array();
                                $TotalTKC2 = array();  
                                $sqlTKC = " SELECT nj_year, nj_month, nj_name FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' GROUP BY nj_name ORDER BY nj_name ASC   ";
                                $resultTKC = $conDB->query($sqlTKC);
                                $thisUser = $resultTKC->num_rows;
                                if ($thisUser > 0) {
                                    while($rowTKC = $resultTKC->fetch_assoc()){
                                        if( $num == 1){
                                            $TotalTKC[] = $rowTKC['nj_name'];
                                        }else{
                                            $TotalTKC2[] = $rowTKC['nj_name'];
                                        }
                                    $num++;    
                                    }
                                }
                                ?>
                                  <tr>
                                    <td rowspan="<?PHP echo $thisUser; ?>">
                                        <center><?PHP 
                                            echo $row['nj_month']; ?><br><?PHP
                                            $sqlTotal = " SELECT nj_year, nj_month FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."'  ";
                                            $resultTotal = $conDB->query($sqlTotal);
                                            echo $resultTotal->num_rows;
                                        ?></center>
                                    </td>
                                    
                                    <?PHP
                                    foreach($TotalTKC as $data){
                                        ?>
                                            <td><center> <?PHP echo $data; ?> </center></td>
                                            <td><center>
                                                <?PHP
                                                $sqlTKC = " SELECT nj_year, nj_month, nj_name FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' AND nj_name = '".$data."'   ";
                                                $resultTKC = $conDB->query($sqlTKC);
                                                $thisUser = $resultTKC->num_rows;
                                                echo $thisUser;
                                                ?>
                                            </center></td>
                                            <td>
                                                <?PHP
                                                $TotalJob = '';
                                                $sqlJob = " SELECT * FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' AND nj_name = '".$data."' ORDER BY nj_job ASC ";
                                                $resultJob = $conDB->query($sqlJob);
                                                if ($resultJob->num_rows > 0) {
                                                    while($rowJob = $resultJob->fetch_assoc()){
                                                        $TotalJob .= $rowJob['nj_job'].', ';
                                                    }
                                                }
                                                echo rtrim($TotalJob, ", ");
                                                ?>
                                            </td>                                
                                        <?PHP
                                    }
                                    ?>
                                  </tr>
        
        
                                  <?PHP
                                  foreach($TotalTKC2 as $data){
                                      ?>
                                          <tr>
                                            <td><center> <?PHP echo $data; ?> </center></td>
                                            <td><center>
                                                <?PHP
                                                $sqlTKC = " SELECT nj_year, nj_month, nj_name FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' AND nj_name = '".$data."'   ";
                                                $resultTKC = $conDB->query($sqlTKC);
                                                $thisUser = $resultTKC->num_rows;
                                                echo $thisUser;
                                                ?>
                                            </center></td>
                                            <td>
                                                <?PHP
                                                $TotalJob = '';
                                                $sqlJob = " SELECT * FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' AND nj_name = '".$data."' ORDER BY nj_job ASC ";
                                                $resultJob = $conDB->query($sqlJob);
                                                if ($resultJob->num_rows > 0) {
                                                    while($rowJob = $resultJob->fetch_assoc()){
                                                        $TotalJob .= $rowJob['nj_job'].', ';
                                                    }
                                                }
                                                echo rtrim($TotalJob, ", ");
                                                ?>
                                            </td>
                                          </tr>                              
                                      <?PHP
                                  }
                                }
                          }                        
                  }

                  ?>
            </table>
      </div>
      
    </div>
  </body>
</html>

<?PHP
/*
                $sql = " SELECT * FROM tk_new_jobs WHERE nj_year = '1' GROUP BY nj_month ORDER BY FIELD(nj_month,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') ";
                $result = $conDB->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        
                    $num = 1;  
                    $TotalTKC = array();
                    $TotalTKC2 = array();
                    $sqlTKC = " SELECT nj_year, nj_month FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' GROUP BY nj_name ORDER BY nj_name ASC   ";
                    $resultTKC = $conDB->query($sqlTKC);
                    $thisUser = $resultTKC->num_rows;
                    if ($thisUser > 0) {
                        while($rowTKC = $resultTKC->fetch_assoc()){
                            if( $num == 1){
                                $TotalTKC[] = $rowTKC['nj_name'];
                            }else{
                                $TotalTKC2[] = $rowTKC['nj_name'];
                            }
                        $num++;    
                        }
                    }
                                
                          ?>
                          <tr>
                            <td rowspan="4">
                                <center><?PHP 
                                    echo $row['nj_month']; ?><br><?PHP
                                    $sqlTotal = " SELECT nj_year, nj_month FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."'  ";
                                    $resultTotal = $conDB->query($sqlTotal);
                                    echo $resultTotal->num_rows;
                                ?></center>
                            </td>
                            <?PHP
                            foreach($TotalTKC as $data){
                                ?>
                                    <td><?PHP echo $data; ?></td>
                                    <td>
                                        <?PHP
                                        $sqlTKC = " SELECT nj_year, nj_month, nj_name FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' AND nj_name = '".$data."'   ";
                                        $resultTKC = $conDB->query($sqlTKC);
                                        $thisUser = $resultTKC->num_rows;
                                        echo $thisUser;
                                        ?>
                                    </td>   
                                    <td>
                                        <?PHP
                                        $TotalJob = '';
                                        $sqlJob = " SELECT * FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' AND nj_name = '".$data."'  ";
                                        $resultJob = $conDB->query($sqlJob);
                                        if ($resultJob->num_rows > 0) {
                                            while($rowJob = $resultJob->fetch_assoc()){
                                                $TotalJob .= $rowJob['nj_job'].', ';
                                            }
                                        }
                                        echo rtrim($TotalJob, ", ");
                                        ?>
                                    </td>                                    
                                <?PHP
                            }
                            ?>
                          </tr>
                          
                          
                            <?PHP
                            foreach($TotalTKC2 as $data){
                                ?>
                                <tr>
                                    <td><?PHP echo $data; ?></td>
                                    <td>
                                        <?PHP
                                        $sqlTKC = " SELECT nj_year, nj_month, nj_name FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' AND nj_name = '".$data."'   ";
                                        $resultTKC = $conDB->query($sqlTKC);
                                        $thisUser = $resultTKC->num_rows;
                                        echo $thisUser;
                                        ?>
                                    </td>
                                    <td>
                                        <?PHP
                                        $TotalJob = '';
                                        $sqlJob = " SELECT * FROM tk_new_jobs WHERE nj_year = '".$row['nj_year']."' AND nj_month = '".$row['nj_month']."' AND nj_name = '".$data."' ";
                                        $resultJob = $conDB->query($sqlJob);
                                        if ($resultJob->num_rows > 0) {
                                            while($rowJob = $resultJob->fetch_assoc()){
                                                $TotalJob .= $rowJob['nj_job'].', ';
                                            }
                                        }
                                        echo rtrim($TotalJob, ", ");
                                        ?>
                                    </td> 
                                </tr>
                                <?PHP
                            }
                            ?>


                          
                          
                          <?PHP
                        
                    }
                }
*/
?>
