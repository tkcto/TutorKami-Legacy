<?php
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if(isset($_POST['dataPV'])){
	$dataPV = $_POST['dataPV'];
	
    $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$dataPV['nilai']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        
        $qeJob = " SELECT * FROM tk_job WHERE j_id='".$row['no2']."'  ";
        $resQueryJob = $conn->query($qeJob); 
        if($resQueryJob->num_rows > 0){
            $rQJob = $resQueryJob->fetch_assoc();
            
            $jobID = $rQJob['j_id'];

            $thisutor = '';
            $qTutor = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_hired_tutor_email']."'  ";
            $rTutor = $conn->query($qTutor); 
            if($rTutor->num_rows > 0){ 
                $rowTutor = $rTutor->fetch_assoc();
                $thisutor = $rowTutor['u_id'];
            }
            
            $displayname = '';
            $queryUser = " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_email ='".$rQJob['j_hired_tutor_email']."' ";
            $resultQueryUser = $conn->query($queryUser); 
            if($resultQueryUser->num_rows > 0){ 
                $rowQueryUser = $resultQueryUser->fetch_assoc();
                $displayname  = $rowQueryUser['u_displayname'];
                $qUserDT      = $rowQueryUser['ud_phone_number'];
            }

            $aDate = explode('/',trim($row['no6']));
            $my_new_date = '20'.$aDate[2].'-'.$aDate[1].'-'.$aDate[0];
            
            
            if (strpos($row['no5'], 'T.S') !== false) {
                if( $dataPV['jenis'] == 'Yes' ){
                            $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor, ph_remarks) VALUES  
                            ('3', '".$thisutor."', '".$my_new_date."', '".trim($row["no2"])."', 'trial paid', '".trim($row["no7"])."', '0.00', '".trim($row["no10"])."', '".$displayname."', '".$dataPV['komen']."') ";
                            if ( ($conn->query($insertPayment) === TRUE) ) {
                                $last_id = $conn->insert_id;
                						/*
                						$args = new stdClass();
                						$xdata = new stdClass();
                						$args->to = "6".$qUserDT."@c.us";
                						$args->content = "Salam/Hi ".$displayname.", your payment of RM".trim($row["no7"])." for job ".trim($row["no2"])." trial session has been made. Please check your bank account to ensure you have received it (if your bank is not Maybank, please wait 1 or 2 days for interbank processes). A payment voucher has also been issued (login at www.tutorkami.com/tutor-login to view it) for your future references.If you still did not receive the payment, please notify our Finance Manager at 019-3613956. Thank you.\r\n\r\n(This is an auto message from tutorkami.com. Please do not reply to this number) ";
                						$xdata->args = $args;
                						
                						$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );  
                						*/
                						$xdata = array( "to" => "6".$qUserDT,
                						        "message" => "Salam/Hi ".$displayname.", your payment of RM".trim($row["no7"])." for job ".trim($row["no2"])." trial session has been made. Please check your bank account to ensure you have received it (if your bank is not Maybank, please wait 1 or 2 days for interbank processes). A payment voucher has also been issued (login at www.tutorkami.com/tutor-login to view it) for your future references.If you still did not receive the payment, please notify our Finance Manager at 019-3613956. Thank you. newLine (This is an auto message from tutorkami.com. Please do not reply to this number) " );
                						$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                						if($make_call){
                						    echo 'trial paid';
                						}else{
                						    echo 'Error!';
                						}
                  
                            }else{
                                echo 'Error!';
                            } 
                }else if( $dataPV['jenis'] == 'PV' ){
                            $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor, ph_remarks) VALUES  
                            ('3', '".$thisutor."', '".$my_new_date."', '".trim($row["no2"])."', 'trial paid', '".trim($row["no7"])."', '0.00', '".trim($row["no10"])."', '".$displayname."', '".$dataPV['komen']."') ";
                            if ( ($conn->query($insertPayment) === TRUE) ) {
                                $last_id = $conn->insert_id;
                                echo 'trial paid';
                            }else{
                                echo 'Error!';
                            }
                }else{
                    echo 'Success!';
                }
            }else{
                    $infoKelas = '';
                    $RekodKelas = " SELECT cl_display_id, last FROM tk_classes WHERE cl_display_id = '".$jobID."' ";
                    $reRekodKelas = $conn->query($RekodKelas); 
                    if($reRekodKelas->num_rows > 0){
                        $rRekodKelas = $reRekodKelas->fetch_assoc();
                        $infoKelas = $rRekodKelas['last'];
                    }            
        
                    //$Receipt = " SELECT ph_user_id, ph_job_id, ph_id, ph_receipt FROM tk_payment_history WHERE ph_user_id='".$thisutor."' AND ph_job_id ='".$row["no2"]."' ORDER BY ph_id DESC  ";
                    $Receipt = " SELECT * FROM tk_payment_history WHERE ph_user_type = '3' AND ph_user_id='".$thisutor."' AND ph_job_id ='".$row["no2"]."' ORDER BY ph_id DESC  ";
                    $resReceipt = $conn->query($Receipt); 
                    if($resReceipt->num_rows > 0){
                        $rowReceipt = $resReceipt->fetch_assoc();
                        $NoReceipt = (((int)$rowReceipt['ph_receipt']) + 1);
                    }else{
                        $NoReceipt = '1';
                    }
                    
                    $queryClasses = " SELECT * FROM tk_classes_record INNER JOIN tk_classes ON cl_id = cr_cl_id WHERE cl_display_id = '".$row['no2']."' AND current_cycle NOT LIKE '%temp%' ORDER BY cr_date DESC, cr_start_time DESC ";
                    $resultClasses = $conn->query($queryClasses); 
                    if($resultClasses->num_rows > 0){ 
                        $rowClasses = $resultClasses->fetch_assoc();
                        if( $rowClasses['cr_status'] == 'FM to pay tutor' ){
                            $Update= " UPDATE tk_classes_record SET cr_status = 'Tutor Paid' WHERE cr_id = '".$rowClasses['cr_id']."'  ";
                            $conn->query($Update);
                        }
                    }    
                    
                	if( $dataPV['jenis'] == 'Yes' ){
                	    
                            $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor, ph_remarks) VALUES  
                            ('3', '".$thisutor."', '".$my_new_date."', '".trim($row["no2"])."', '".$NoReceipt."', '".trim($row["no7"])."', '0.00', '".trim($row["no10"])."', '".$displayname."', '".$dataPV['komen']."') ";
                            if ( ($conn->query($insertPayment) === TRUE) ) {
                                $last_id = $conn->insert_id;
                						/*
                						$args = new stdClass();
                						$xdata = new stdClass();
                						$args->to = "6".$qUserDT."@c.us";
                						$args->content = "Salam/Hi ".$displayname.", your payment of RM".trim($row["no7"])." for job ".trim($row["no2"])." has been made. Please check your bank account to ensure you have received it (if your bank is not Maybank, please wait 1 or 2 days for interbank processes). A payment voucher has also been issued (login at www.tutorkami.com/tutor-login to view it) for your future references.If you still did not receive the payment, please notify our Finance Manager at 019-3613956. Thank you.\r\n\r\n(This is an auto message from tutorkami.com. Please do not reply to this number) ";
                						$xdata->args = $args;
                						
                						$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );  
                						*/
                						$xdata = array( "to" => "6".$qUserDT,
                						        "message" => "Salam/Hi ".$displayname.", your payment of RM".trim($row["no7"])." for job ".trim($row["no2"])." has been made. Please check your bank account to ensure you have received it (if your bank is not Maybank, please wait 1 or 2 days for interbank processes). A payment voucher has also been issued (login at www.tutorkami.com/tutor-login to view it) for your future references.If you still did not receive the payment, please notify our Finance Manager at 019-3613956. Thank you. newLine (This is an auto message from tutorkami.com. Please do not reply to this number) " );
                						$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                						if($make_call){
                						    //echo 'Success!';
                						    echo $jobID. ''.$infoKelas;
                						}else{
                						    echo 'Error!';
                						}
                  
                            }else{
                                echo 'Error!';
                            }   
                            
                	}else if( $dataPV['jenis'] == 'PV' ){
                	    
                            $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor, ph_remarks) VALUES  
                            ('3', '".$thisutor."', '".$my_new_date."', '".trim($row["no2"])."', '".$NoReceipt."', '".trim($row["no7"])."', '0.00', '".trim($row["no10"])."', '".$displayname."', '".$dataPV['komen']."') ";
                            if ( ($conn->query($insertPayment) === TRUE) ) {
                                $last_id = $conn->insert_id;
                                //echo 'Success!';
                                echo $jobID. ''.$infoKelas;
                            }else{
                                echo 'Error!';
                            }
                            
                	}else{
                	    echo 'Success!';
                	}                    
            }

        }else{
            echo 'Error!';
        }
    }else{
        echo 'Error!';
    }
	
}










/*
                $html = '
                <!DOCTYPE html>
                <html>
                <head>
                <style>
                table, td, th {
                  border: 0px solid black;
                }
                
                table {
                  border-collapse: collapse;
                  width: 100%;
                }
                
                th {
                  text-align: left;
                }
                </style>
                </head>
                <body>
                
                
                <table cellspacing="20">
                  <tr>
                    <td> <font style="font-size:30pt; color:#272264; font-family:Bebas Neue; line-height:18px;"><b>PAYMENT VOUCHER</b></font> </td>
                    <td align="right"><img src="https://www.tutorkami.com/images/logo.png" alt="Snow" ></td>
                  </tr>
                </table>
                
                <br/>
                <hr style="border: 5px solid #DDDDDD;">
                <br/><br/>
                <table cellspacing="20">
                  <tr>
                  <td>  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;FROM</b></font>         </td>
                  <td style="padding-left: 20px;">  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;PAID TO</b></font>       </td>
                  <td>  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;PV NO</b></font>  </td>
                  <td align="right">  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>PV'.trim($row["no10"]).'</b></font>     </td>
                  </tr>
                
                  <tr>
                  <td>  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>TK Edu Sdn Bhd</b></font>  </td>
                  <td style="padding-left: 20px;">  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$tutorFullName.'</b></font>       </td>
                  <td>  <br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;PAYMENT DATE</b></font>    </td>
                  <td align="right">  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.trim($row["no6"]).'</b></font>      </td>
                  </tr>
                  
                  <tr>
                  <td>  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>(1161349-W)</b></font>     </td>
                  <td style="padding-left: 20px;">  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$tutorIC.'</b></font>    </td>
                  <td></td>
                  <td></td>
                  </tr>
                  <tr>
                  <td>    <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Contact No :</b></font>  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  </tr>
                  <tr>
                  <td>    <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>019-3613956</b></font> </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                </table>
                
                <br/>
                
                <table cellspacing="20">
                  <tr>
                    <td> <br/><br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;DESCRIPTION</b></font>  </td>
                    <td align="right"> <br/><br/><font style="border-right: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>AMOUNT&nbsp;</b></font>  </td>
                  </tr>
                  <tr>
                    <td> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Job '.trim($row["no2"]).' - '.trim($row["no10"]).' hours of tuition classes</b></font> </td>
                    <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.trim($row["no7"]).'</b></font> </td>
                  </tr>
                </table>
                
                
                <table cellspacing="20">
                  <tr>';
    
                $html .= '
                  </tr>
                  <tr>
                    <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>&nbsp;</b></font> </td>
                    <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:15pt; color:#f1592a; font-family:Bebas Neue; line-height:18px;"><b>TOTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RM '.trim($row["no7"]).'</b></font> </td>
                  </tr>
                </table>
                
                <br/><br/><br/><br/>
                
                <table>
                    <tr>
                        <td> 
                            <img border="0" src="../images/signature/ShikinPV.jpeg" width="200" height="100"><br/>
                            ______________________________________________
                            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Prepared by :</b></font>
                            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Nur Ashikin Muzapa</b></font>
                            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Finance Manager TutorKami.com</b></font>
                        </td>
                        <td  style="padding-right: -80px;">  
                            <img border="0" src="../images/signature/ShikinPV2.jpg" width="200" height="100"><br/>
                            ______________________________________________
                            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Received by</b></font>
                            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>&nbsp;</b></font>
                            <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>&nbsp;</b></font>
                        </td>
                    </tr>
                </table>
                
                </body>
                </html>';
                
                
                $filename = "R".trim($row["no2"])."".$NoReceipt." ".$displayname.".pdf";
                
            	try {
            		require_once("../pdf/mpdf-library/vendor/autoload.php");
            
            		$mpdf = new \Mpdf\Mpdf([
            			//'mode' => 'c',
            			'margin_top' => 35,
            			'margin_bottom' => 17,
            			'margin_header' => 10,
            			'default_font_size' => 8,
            			'default_font' => 'Times New Roman',
            			
            			'mode' => 'utf-8',
            			'format' => 'A4-L',
            			'orientation' => 'L'
            		]);
            
            		$mpdf->showImageErrors = true;
            		$mpdf->mirrorMargins = 1;
            		$mpdf->SetTitle('Generate PV | tutorkami.com');
            		$mpdf->WriteHTML($html);
            		$mpdf->Output($filename, 'I');
            	} catch(\Mpdf\MpdfException $e) {
            	    echo $e->getMessage();
            	}
*/
?>