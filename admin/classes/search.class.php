<?php

/*

************************************************

** Page Name     : user.class.php 

** Page Author   : Tathagata Basu

** Created On    : 12/11/2014

************************************************

*/

require_once('db.class.php');

require_once('system.class.php');



class user extends db {

    

    var $db, $system;

    

    function __construct() {

        $this->db = $this->con_db();

        $this->system = new system();

        if(!isset($_SESSION)){

            session_start();

        }

    }

    // luqman
    public function isTutor($data){
        $search_tutor           = isset($data['is_tutor'])                  ? $data['is_tutor'] : '';
        $search_email           = isset($data['u_email'])                   ? $data['u_email'] : '';
        $search_first_name      = isset($data['ud_first_name'])             ? $data['ud_first_name'] : '';
        $search_last_name       = isset($data['ud_last_name'])              ? $data['ud_last_name'] : '';
        $search_display_name    = isset($data['u_displayname'])             ? $data['u_displayname'] : '';
        $search_phone_number    = isset($data['ud_phone_number'])           ? $data['ud_phone_number'] : '';
         // if ($search_tutor == 'Yes') {
            // For Tutor   
            $displayname        = isset($data['u_displayname'])             ? $data['u_displayname'] : '';          //ada
            $areas              = isset($data['state_drop'])          ? $data['state_drop'] : '';                   //ada nombor
            $course             = isset($data['level_drop'])              ? $data['level_drop'] : '';               //ada nombor 
            $u_admin_approve    = isset($data['u_admin_approve'])           ? $data['u_admin_approve'] : '';        //ada
            // $subject            = isset($data['subject'])                   ? $data['subject'] : '';
            // $location           = isset($data['location'])                  ? $data['location'] : '';
            $gender             = isset($data['u_gender'])                  ? $data['u_gender'] : '';               //ada
            $ud_race            = isset($data['ud_race'])                   ? $data['ud_race'] : '';                //ada
            $ud_tutor_status    = isset($data['ud_tutor_status'])           ? $data['ud_tutor_status'] : '';        //ada
            $tution_center      = isset($data['tution_center'])             ? $data['tution_center']    : '';       //ada
            $current_occupation = isset($data['ud_current_occupation'])     ? $data['ud_current_occupation'] : '';  //ada
        // } elseif ($search_tutor == 'No') {
            // For Non-Tutor
            $u_role         = isset($data['u_role'])          ? $data['u_role'] : '';                               //ada nombor
            $client_status  = isset($data['ud_client_status'])  ? $data['ud_client_status'] : '';                   //ada
            $state          = isset($data['ud_state'])          ? $data['ud_state'] : '';                           //ada nombor
            $paying_client  = isset($data['u_paying_client'])   ? $data['u_paying_client'] : '';                    //XDAPAT VALUE LAGI
        // }
        // echo json_encode(["message"=>$paying_client]);
/* Getting post data */
 $rowid = $_POST['rowid'];
 $rowperpage = $_POST['rowperpage'];
 /* Count total number of rows */
 $querycount = "SELECT count(*) as allcount FROM tk_user U
             INNER JOIN tk_user_details UD
             ON U.u_id = UD.ud_u_id";
$resultcount = $this->db->query($querycount);
$fetchresult = mysqli_fetch_array($resultcount);
$allcount = $fetchresult['allcount'];
/* Count total number of rows */

$sql = "SELECT 
            U.*, 
            UD.*";
        /* QUERY 1 **/
//search 'list tutor only' pilih YES
if ($search_tutor == 'Yes') {
    $sql.="FROM tk_user U
            INNER JOIN tk_user_details UD ON U.u_id = UD.ud_u_id
            LEFT JOIN  tk_cities CT ON CT.city_id   = UD.ud_city
            WHERE U.u_status <> 'D' 
            AND U.u_role = 3";
    if($search_email != ''){
    $sql.= "AND U.u_email LIKE '%".$search_email."%'";       
    }
    $sql.="LIMIT ".$rowid.",".$rowperpage;   
}else if($search_tutor == 'No'){
    //search 'list tutor only' pilih NO
    $sql.="FROM tk_user U
            INNER JOIN tk_user_details UD ON U.u_id = UD.ud_u_id
            LEFT JOIN  tk_cities CT ON CT.city_id   = UD.ud_city
            WHERE U.u_status <> 'D' 
            AND U.u_role = 4";
    if($search_email != ''){
    $sql.= "AND U.u_email LIKE '%".$search_email."%'";       
    }
    $sql.="LIMIT ".$rowid.",".$rowperpage;   
}else{
    //search 'list tutor only' pilih ALL
    $sql.="FROM tk_user U
            INNER JOIN tk_user_details UD ON U.u_id = UD.ud_u_id
            LEFT JOIN  tk_cities CT ON CT.city_id   = UD.ud_city
            WHERE U.u_status <> 'D'";
    if($search_email != ''){
    $sql.= "AND U.u_email LIKE '%".$search_email."%'";       
    }
    $sql.="LIMIT ".$rowid.",".$rowperpage;   
}
        /* QUERY 1 **/

        /* QUERY 2 **/
    $result =  $this->db->query($sql);
    $tutor_arr = array();
            $tutor_arr[] = array("allcount" => $allcount);
        if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
    {
        $u_displayid = $row['u_displayid'];
        $u_email = $row['u_email'];
        $ud_first_name = $row['ud_first_name'];
        $u_displayname = $row['u_displayname'];
        $u_status = $row['u_status'];
        $ud_dob = $row['ud_dob'];
        $ud_city = $row['ud_city'];
        $ud_phone_number = $row['ud_phone_number'];
        $u_role = $row['u_role'];
        $u_create_date = $row['u_create_date'];
        $u_modified_date = $row['u_modified_date'];
           
      $tutor_arr[] = array("u_displayid" => $u_displayid,"u_email" => $u_email,"ud_first_name" => $ud_first_name,"u_displayname" => $u_displayname,"u_status" => $u_status,"ud_dob" => $ud_dob,"ud_city" => $ud_city,"ud_phone_number" => $ud_phone_number,"u_role" => $u_role,"u_create_date" => $u_create_date,"u_modified_date" => $u_modified_date);  
    }
    echo json_encode($tutor_arr);
}else{
    echo 'No data found';
}
}
// luqman

}
?>