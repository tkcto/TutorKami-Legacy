<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if(isset($_GET['requiredid'])){
    if( $_GET['requiredid'] == '' ){
        ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <label class="label label-danger">Error</label>
            </div>
        </div>
        <?PHP
    }else{
        ?>
        <div class="panel panel-default">
            <div class="panel-body">
            <?php 
            
            $status = '';
            $autoPost = '';
            $OnWA = " SELECT wa_job_id FROM tk_send_wa WHERE wa_job_id = '".$_GET['requiredid']."' ";
            $resultOnWA= $conn->query($OnWA);
            if ($resultOnWA->num_rows > 0) {
                $autoPost = 'TRUE';
            }
            
            $queryShortlisted = " SELECT * FROM tk_shortlisted WHERE user_job_id = '".$_GET['requiredid']."' "; 
            $resultShortlisted = $conn->query($queryShortlisted); 
            if($resultShortlisted->num_rows > 0){
                while( $rowShortlisted = $resultShortlisted->fetch_assoc() ){
                    if( $rowShortlisted['s_status'] == 'A' ){
                        $status = '<input readonly type="text" value="&#10003;"                        style="width: 15px;color:black !important;outline:none !important;cursor: pointer;" >';
                    }else{
                        $onClick = '';
                        if( $rowShortlisted['s_status'] == '' ){
                            $onClick = 'onclick="notiTerms('.$rowShortlisted['id'].')"';
                        }
                        $status = '<input readonly type="text" value="'.$rowShortlisted['s_status'].'" style="width: 15px;color:black !important;outline:none !important;cursor: pointer;" '.$onClick.' >';
                    }
                    
                    if( $autoPost != '' ){
                        echo '<label class="label label-primary"  draggable="true" ondragstart="drag(event)" style="margin-top:-223px;background-color: #070775; " ><a id="'.$rowShortlisted['user_email'].'" href="manage_user.php?action=edit&u_id='.$rowShortlisted['user_display_id'].'" target="_blank" title="ID: '.$rowShortlisted['user_display_id'].'" style="color:#FFF; text-decoration: none;">'.$rowShortlisted['user_display_name']/*$rowShortlisted['user_email']*/.'</a> '.$status.' <a onclick="removeEnterField('.$rowShortlisted['id'].','.$rowShortlisted['user_job_id'].')" style="color:#FFF; text-decoration: none;">&nbsp;&nbsp;&times;</a></label> &nbsp;&nbsp;';
                    }else{
                        echo '<label class="label label-primary"  draggable="true" ondragstart="drag(event)" style="margin-top:-223px;background-color: #070775; " ><a id="'.$rowShortlisted['user_email'].'" href="manage_user.php?action=edit&u_id='.$rowShortlisted['user_display_id'].'" target="_blank" title="ID: '.$rowShortlisted['user_display_id'].'" style="color:#FFF; text-decoration: none;">'.$rowShortlisted['user_display_name']/*$rowShortlisted['user_email']*/.'</a> <a onclick="removeEnterField('.$rowShortlisted['id'].','.$rowShortlisted['user_job_id'].')" style="color:#FFF; text-decoration: none;">&nbsp;&nbsp;&times;</a></label> &nbsp;&nbsp;';
                    }
                    
                }
            }
            ?>
            </div>
        </div> 
        <?PHP 
    }
}else{
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <label class="label label-danger">Error</label>
        </div>
    </div>
    <?PHP
}
?>
                            
                            
                            
<!--

-->