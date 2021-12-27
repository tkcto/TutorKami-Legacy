<?php
/*
************************************************
** Page Name     : APIJob.php 
** Page Author   : Subhadeep Chowdhury
** Created On    : 06/06/2017
************************************************
*/
require_once('../admin/classes/db.class.php');
require_once('../admin/classes/whatsapp-api-call.php');
class APIJob extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
		$this->handler = new RestHandler();
	}
	
	public function SearchJob($data, $lang = 'en') {
		
        $state  = isset($data['state'])  ? $this->RealEscape($data['state'])  : '';
        $course = isset($data['course']) ? $this->RealEscape($data['course']) : '';
        $status = isset($data['status']) ? $this->RealEscape($data['status']) : '';
        $job_id = isset($data['job_id']) ? $this->RealEscape($data['job_id']) : '';
        
        // Validation
        if ($status == '') {
        	$res = array('flag' => 'error', 'message' => 'Status is required.');
        } else {
        	
	        $sql = "SELECT * FROM ".DB_PREFIX."_job AS J 
	        INNER JOIN ".DB_PREFIX."_job_translation AS JT ON JT.jt_j_id = J.j_id 
	        LEFT JOIN ".DB_PREFIX."_states AS ST ON ST.st_id = J.j_state_id 
	        LEFT JOIN ".DB_PREFIX."_job_level AS JL ON JL.jl_id = J.j_jl_id 
	        LEFT JOIN ".DB_PREFIX."_job_level_translation AS JLT ON JLT.jlt_jl_id = JL.jl_id
	        WHERE J.j_status = '{$status}' AND JL.jl_status = 'A' AND JLT.jlt_lang_code = '{$lang}' AND JT.jt_lang_code = '{$lang}'";

	        if ($state != '') {
	        	$in_states = implode(',', $state);
	        	$sql .= " AND J.j_state_id IN ({$in_states})";
	        }

	        if ($course != '') {
	        	$in_courses = implode(',', $course);
	        	$sql .= " AND  J.j_jl_id IN ({$in_courses})";
	        }

	        if ($job_id != '') {
	        	$sql .= " AND J.j_id = '{$job_id}'";
	        }

	        $sql .= " GROUP BY J.j_id";
	        $sql .= " ORDER BY J.j_id DESC";

	        $res = $this->db->query($sql);

	    }

		return $res;
	}

	public function ListLevel($lang = 'en', $level_id = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_job_level AS JL 
		INNER JOIN ".DB_PREFIX."_job_level_translation AS JLT ON JL.jl_id = JLT.jlt_jl_id 
		WHERE JL.jl_status = 'A' AND JLT.jlt_lang_code = '{$lang}'";
		if ($level_id != '') {
			$sql .= " AND JL.jl_id = {$level_id}";
		}

		return $this->db->query($sql);
	}

	public function JobUserStatus($job_id, $user_id) {
		
		$chk = "SELECT * FROM ".DB_PREFIX."_applied_job WHERE aj_j_id = '{$job_id}' AND aj_u_id = '{$user_id}'";
        $qry = $this->db->query($chk);
        $num_rows = $qry->num_rows;
        
		return $num_rows;
	}

	public function ApplyJob($data) {
		$job_id = isset($data['j_id']) ? $this->RealEscape($data['j_id']) : '';
		$user_id = isset($data['u_id']) ? $this->RealEscape($data['u_id']) : '';
		$status = isset($data['status']) ? $this->RealEscape($data['status']) : 'P';

		// Check for Duplicate
        $chk = "SELECT * FROM ".DB_PREFIX."_applied_job WHERE aj_j_id = '{$job_id}' AND aj_u_id = '{$user_id}'";
        $qry = $this->db->query($chk);

        if ($qry->num_rows == 0) {

			$sql = "INSERT INTO ".DB_PREFIX."_applied_job SET
	                aj_j_id   = '{$job_id}',
	                aj_u_id   = '{$user_id}',
	                aj_status = '{$status}',
	                aj_date   = '".date('Y-m-d H:i:s')."'";

	        $exe = $this->db->query($sql);
	        $insert_id = $this->db->insert_id;

	        if($exe) {
	        	$res = array('flag' => 'success', 'message' => 'Thank you for applying, your profile will be sent to the parent. If you are chosen our Coordinator will contact you. If you are not contacted within 5 days of applying, that means the parent chose another tutor. Thank you.', 'data' => $insert_id);        	

/***** Auto Send WhatsApp ****/
/*
$sqlGeJob = "SELECT j_id, j_telephone FROM ".DB_PREFIX."_job WHERE j_id = '".$job_id."' ";
$resultGeJob = $this->db->query($sqlGeJob);
if($resultGeJob->num_rows > 0){
    $rowGeJob = mysqli_fetch_array($resultGeJob);
    $totalNumber = strlen($rowGeJob['j_telephone']); // count total number
    if( preg_match("/^[0-9]+$/",$rowGeJob['j_telephone']) ){
        if( $totalNumber == '10' ){
            $sqlGeTutor = "SELECT u_id, u_displayid FROM ".DB_PREFIX."_user WHERE u_id = '".$user_id."' ";
            $resultGeTutor = $this->db->query($sqlGeTutor);
            if($resultGeTutor->num_rows > 0){
                $rowGeTutor = mysqli_fetch_array($resultGeTutor);
                    $args = new stdClass();
                    $xdata = new stdClass();
                    $args->to = $rowGeJob['j_telephone']."@c.us";
                    $args->content = "This is an automatic message sent from TutorKami.com as you have given us permission to auto send you tutor’s profiles. Please do not reply to this what’s app message. If you don’t want to receive this message anymore, please inform our Coordinator. Thank you./n/n https://www.tutorkami.com/tutor_profile?did='".$rowGeTutor['u_displayid']."' ";       
                    $xdata->args = $args;
                    $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                    if($make_call){
                        $sqlWaNoti = "INSERT INTO ".DB_PREFIX."_whatsapp_noti SET wa_job_id = '".$job_id."', wa_status = 'Success', wa_note = 'Success', wa_date = '".date('Y-m-d H:i:s')."' ";
                        $exeWaNoti = $this->db->query($sqlWaNoti);
                    }else{
                        $sqlWaNoti = "INSERT INTO ".DB_PREFIX."_whatsapp_noti SET wa_job_id = '".$job_id."', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
                        $exeWaNoti = $this->db->query($sqlWaNoti);
                    }
            }else{
                $sqlWaNoti = "INSERT INTO ".DB_PREFIX."_whatsapp_noti SET wa_job_id = '".$job_id."', wa_status = 'Fail Send', wa_note = 'Phone Number More Than 10 Digit', wa_date = '".date('Y-m-d H:i:s')."' ";
                $exeWaNoti = $this->db->query($sqlWaNoti);
            }
        }else{
            $sqlWaNoti = "INSERT INTO ".DB_PREFIX."_whatsapp_noti SET wa_job_id = '".$job_id."', wa_status = 'Fail Send', wa_note = 'Phone Number More Than 10 Digit', wa_date = '".date('Y-m-d H:i:s')."' ";
            $exeWaNoti = $this->db->query($sqlWaNoti);
        }    
    }else{
        $sqlWaNoti = "INSERT INTO ".DB_PREFIX."_whatsapp_noti SET wa_job_id = '".$job_id."', wa_status = 'Fail Send', wa_note = 'Phone Number Has Text', wa_date = '".date('Y-m-d H:i:s')."' ";
        $exeWaNoti = $this->db->query($sqlWaNoti);
    }
}
*/
/***** Auto Send WhatsApp ****/

	        } else {
	        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
	        }

	    } else {
        	$res = array('flag' => 'error', 'message' => 'You have already applied for this job.');
        }

		return $res;
	}
}
?>