<?php SESSION_START(); 
//include ('Push.php');  
//$push = new Push(); 

require_once('../../admin/classes/push.class.php');
$Sys = new system;

date_default_timezone_set("Asia/Kuala_Lumpur");

$array=array(); 
$rows=array(); 
$notifList = $Sys->listNotificationUser($_SESSION['username']); 
$record = 0;
foreach ($notifList as $key) {
 $data['title'] = $key['title'];
 $data['msg'] = $key['notif_msg'];
 $data['icon'] = 'https://www.tutorkami.com/admin/img/favicons/apple-icon-57x57.png';
 $data['url'] = 'https://www.tutorkami.com/job_details?jid=8818&status=open';
 $rows[] = $data;
 $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($key['notif_repeat']*60));
 $Sys->updateNotification($key['id'],$nextime);
 $record++;
}
$array['notif'] = $rows;
$array['count'] = $record;
$array['result'] = true;
echo json_encode($array);
?>