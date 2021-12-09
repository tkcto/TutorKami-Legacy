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

    <title>Reminder Log | Tutorkami</title>
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <!--<img src="https://www.tutorkami.com/images/whatsapp-logo.jpg" height="100" size="100">-->
        <h2>Reminder Log</h2>
        <p class="lead">Below is an log for job <?php echo $_GET['jobID']; ?> </p>
      </div>

      <div class="row">

        <!--Vertical Tab-->
        <div id="parentVerticalTab" >
            <ul class="resp-tabs-list hor_1">
                <li style="font-size:15px;" >Profile</li>
                <li style="font-size:15px;" >Class</li>
                <li style="font-size:15px;" >End Cycle</li>
                <li style="font-size:15px;" >Payment</li>
            </ul>
            <div class="resp-tabs-container hor_1">
                <div>
                    <p class="lead">
                        <?PHP
                                $whatIWant = '';
                                $historyWa = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$_GET['jobID']."' AND wa_remark = 'Apply Job' ORDER BY wa_id ASC ";
                                $resulthistoryWa = $conDB->query($historyWa);
                                if ($resulthistoryWa->num_rows > 0) {
                                	while($rowhistoryWa = $resulthistoryWa->fetch_assoc()){
                                		if( $rowhistoryWa['wa_status'] == 'POST' ){
                                			$textColor = '<b><span class=text-success>Success</span></b><br/>';
                                		}else{
                                			$textColor = '<b><span class=text-danger>Fail</span></b><br/>';
                                		}
                                		
                                		$originalDate = $rowhistoryWa['wa_date'];
                                		$newDate = date("d/m/Y H:i:s", strtotime($originalDate));

                                		$whatIWant.= ' <font color=#13004d><b>'.$newDate.'</b></font> '.substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , "- ") + 1).' '.$textColor; 
                                	}
                                    
                                }
                                echo $whatIWant;
                        ?>
                    </p>
                </div>
                <div>
                    <p class="lead">
                        <?PHP
                                $whatIWant = '';
                                $historyWa = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$_GET['jobID']."' AND wa_remark = 'Class Reminder' ORDER BY wa_id ASC ";
                                $resulthistoryWa = $conDB->query($historyWa);
                                if ($resulthistoryWa->num_rows > 0) {
                                	while($rowhistoryWa = $resulthistoryWa->fetch_assoc()){
                                		if( $rowhistoryWa['wa_status'] == 'POST' ){
                                			$textColor = '<b><span class=text-success>Success</span></b><br/>';
                                		}else{
                                			$textColor = '<b><span class=text-danger>Fail</span></b><br/>';
                                		}
                                		
                                		$originalDate = $rowhistoryWa['wa_date'];
                                		$newDate = date("d/m/Y H:i:s", strtotime($originalDate));
                                		
                                		$idTutor = trim(substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , ": ") + 1));
                                		
                                		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
                                		$resultGetEmail = $conDB->query($GetEmail);
                                		if ($resultGetEmail->num_rows > 0) {
                                		    $rowGetEmail = $resultGetEmail->fetch_assoc();
                                		    $idTutor = $rowGetEmail['u_email'];
                                		}
                                		$whatIWant.= ' <font color=#13004d><b>'.$newDate.'</b></font> '.$idTutor.' '.$textColor; 

                                	}
                                    
                                }
                                echo $whatIWant;
                        ?>
                    </p>
                </div>
                <div>
                    <p class="lead">
                        <?PHP
                                        $whatIWant = '';
                                        $historyWaCycle = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$_GET['jobID']."' AND wa_remark = 'Cycle Reminder' ORDER BY wa_id ASC ";
                                        $resulthistoryWaCycle = $conDB->query($historyWaCycle);
                                        if ($resulthistoryWaCycle->num_rows > 0) {
                                            while($rowhistoryWaCycle = $resulthistoryWaCycle->fetch_assoc()){
                                                if( $rowhistoryWaCycle['wa_status'] == 'POST' ){
                                                    $textColorCycle = '<b><span class=text-success>Success</span></b><br/>';
                                                }else{
                                                    $textColorCycle = '<b><span class=text-danger>Fail</span></b><br/>';
                                                }
                                            		
                                                $originalDateCycle = $rowhistoryWaCycle['wa_date'];
                                                $newDateCycle = date("d/m/Y H:i:s", strtotime($originalDateCycle));
                                            		
                                                $idTutorCycle = trim(substr($rowhistoryWaCycle['wa_user'] , strpos($rowhistoryWaCycle['wa_user'] , ": ") + 1));
                                            		
                                                $GetEmailCycle = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutorCycle."'  ";
                                                $resultGetEmailCycle = $conDB->query($GetEmailCycle);
                                                if ($resultGetEmailCycle->num_rows > 0) {
                                                    $rowGetEmailCycle = $resultGetEmailCycle->fetch_assoc();
                                                    $idTutorCycle = $rowGetEmailCycle['u_email'];
                                                }

                                            $whatIWant.= ' <font color=#13004d><b>'.$newDateCycle.'</b></font> '.$idTutorCycle.' '.$textColorCycle; 
                                            }
                                        }
                                        echo $whatIWant;
                        ?>
                    </p>
                </div>
                <div>
                    <p class="lead">
                        <?PHP
                                        $whatIWant = '';
                                        $text1stReminder = '';
                                        $text2stReminder = '';
                                        $historyWa1st = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$_GET['jobID']."' AND wa_remark = '1st Payment Reminder' ORDER BY wa_id ASC ";
                                        $resulthistoryWa1st = $conDB->query($historyWa1st);
                                        if ($resulthistoryWa1st->num_rows > 0) {
                                            $text1stReminder = '<b><span class=text-info>1st Reminder</span></b><br/>';
                                        	while($rowhistoryWa1st = $resulthistoryWa1st->fetch_assoc()){
                                        		if( $rowhistoryWa1st['wa_status'] == 'POST' ){
                                        			$textColor1st = '<b><span class=text-success>Success</span></b><br/>';
                                        		}else{
                                        			$textColor1st = '<b><span class=text-danger>Fail</span></b><br/>';
                                        		}
                                        
                                        		$originalDate1stReminder = $rowhistoryWa1st['wa_date'];
                                        		$newDate1stReminder = date("d/m/Y H:i:s", strtotime($originalDate1stReminder));
                                        		
                                        		$idTutor = trim(substr($rowhistoryWa1st['wa_user'] , strpos($rowhistoryWa1st['wa_user'] , ": ") + 1));
                                        		
                                        		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
                                        		$resultGetEmail = $conDB->query($GetEmail);
                                        		if ($resultGetEmail->num_rows > 0) {
                                        		    $rowGetEmail = $resultGetEmail->fetch_assoc();
                                        		    $idTutor = $rowGetEmail['u_email'];
                                        		}
                                        		
                                        		$whatIWant1st.= ' <font color=#13004d><b>'.$newDate1stReminder.'</b></font> '.$idTutor.' '.$textColor1st; 
                                        
                                        	}
                                            
                                        }
                                        
                                        
                                        $historyWa2st = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$_GET['jobID']."' AND wa_remark = '2nd Payment Reminder' ORDER BY wa_id ASC ";
                                        $resulthistoryWa2st = $conDB->query($historyWa2st);
                                        if ($resulthistoryWa2st->num_rows > 0) {
                                            $text2stReminder = '<b><span class=text-info>2nd Reminder</span></b><br/>';
                                        	while($rowhistoryWa2st = $resulthistoryWa2st->fetch_assoc()){
                                        		if( $rowhistoryWa2st['wa_status'] == 'POST' ){
                                        			$textColor2st = '<b><span class=text-success>Success</span></b><br/>';
                                        		}else{
                                        			$textColor2st = '<b><span class=text-danger>Fail</span></b><br/>';
                                        		}
                                        
                                        		$originalDateWa2st = $rowhistoryWa2st['wa_date'];
                                        		$newDateWa2st = date("d/m/Y H:i:s", strtotime($originalDateWa2st));
                                        		
                                        		$idTutor = trim(substr($rowhistoryWa2st['wa_user'] , strpos($rowhistoryWa2st['wa_user'] , ": ") + 1));
                                        		
                                        		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
                                        		$resultGetEmail = $conDB->query($GetEmail);
                                        		if ($resultGetEmail->num_rows > 0) {
                                        		    $rowGetEmail = $resultGetEmail->fetch_assoc();
                                        		    $idTutor = $rowGetEmail['u_email'];
                                        		}
                                        		
                                        		$whatIWant2st.= ' <font color=#13004d><b>'.$newDateWa2st.'</b></font> '.$idTutor.' '.$textColor2st; 
                                        	}
                                            
                                        }
                                        $whatIWant = $text1stReminder.' '.$whatIWant1st.' '.$text2stReminder.' '.$whatIWant2st;
                                        echo $whatIWant;
                        ?>
                    </p>
                </div>
            </div>
        </div>  



      </div>


    </div>


    <script>
    $(document).ready(function() {
        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
    </script>
  </body>
</html>
