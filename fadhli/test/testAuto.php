<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<?php
require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


           
            //$GetJob = " SELECT j_id, j_hired_tutor_email, u_id_tutor FROM tk_job WHERE u_id_tutor IS NULL ORDER BY j_id ASC ";
            $GetJob = " SELECT * FROM tk_job WHERE j_hired_tutor_email != '' AND u_id_tutor IS NULL ORDER BY j_hired_tutor_email ASC ";
            $reGetJob = $conn->query($GetJob);
            if ($reGetJob->num_rows > 0) {
                while($roGetJob = $reGetJob->fetch_assoc()){
                    //echo $roGetJob["j_id"].'<br>';
                    echo '<a target="_blank" href="https://www.tutorkami.com/admin/job-edit?j='.$roGetJob["j_id"].'">'.$roGetJob["j_id"].'</a> '.$roGetJob["j_hired_tutor_email"].'<br/>';

                    /*if( $roGetJob["j_hired_tutor_email"] != '' ){

                        $User = " SELECT u_id, u_email FROM tk_user WHERE u_email = '".$roGetJob['j_hired_tutor_email']."' ";
                        $reUser = $conn->query($User);
                        if ($reUser->num_rows > 0) {
                            $roUser = $reUser->fetch_assoc();
                                //$sql = " UPDATE tk_job SET u_id_tutor = '".$roUser['u_id']."' WHERE j_id = '".$roGetJob['j_id']."' ";
                                //$conn->query($sql);                               
                        }

                    }*/
                }
            }
           
           
           










?>