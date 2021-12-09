<?php
require_once('classes/config.php.inc');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


if(isset($_GET['requiredid'])){
    if( $_GET['requiredid'] == '' ){
        ?>
        <div class="well">
            <font color='red'><b>Error Code : 3341</b></font>
        </div>
        <?PHP
    }else{
        ?>
        <div class="well">
            <?PHP

                $autoPost = '';
                $OnWA = " SELECT wa_job_id FROM tk_send_wa WHERE wa_job_id = '".$_GET['requiredid']."' ";
                $resultOnWA= $conn->query($OnWA);
                if ($resultOnWA->num_rows > 0) {
                    $autoPost = 'TRUE';
                }
                
                $apply = " SELECT u_id, aj_u_id, aj_j_id, aj_rate, u_email, u_displayid FROM tk_applied_job
                INNER JOIN tk_user ON u_id = aj_u_id 
                WHERE aj_j_id = '".$_GET['requiredid']."' "; 
                $resultApply = $conn->query($apply); 
                if($resultApply->num_rows > 0){
                    while( $rowApply = $resultApply->fetch_assoc() ){
                        if($rowApply['aj_rate'] != ''){
                            $showRM = ' RM : ';
                        }else{
                            $showRM = '';
                        }
                        
                        if( $autoPost != '' ){
                            echo '<label class="label label-primary"  draggable="true" ondragstart="drag(event)" ><a id="'.$rowApply['u_email'].'" href="manage_user.php?action=edit&u_id='.$rowApply['u_displayid'].'" target="_blank" title="ID: '.$rowApply['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$rowApply['u_email'].$showRM.$rowApply['aj_rate'].'</a> <input readonly type="text" value="" style="width: 15px;color:black !important;outline:none !important;" > </label> &nbsp;&nbsp;';
                        }else{
                            echo '<label class="label label-primary"  draggable="true" ondragstart="drag(event)" ><a id="'.$rowApply['u_email'].'" href="manage_user.php?action=edit&u_id='.$rowApply['u_displayid'].'" target="_blank" title="ID: '.$rowApply['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$rowApply['u_email'].$showRM.$rowApply['aj_rate'].'</a> </label> &nbsp;&nbsp;';
                        }
                    
                    }
                }
            ?>
        </div>
        <?PHP
    }
}else{
    ?>
    <div class="well">
        <font color='red'><b>Error Code : 5561</b></font>
    </div>
    <?PHP
}


?>