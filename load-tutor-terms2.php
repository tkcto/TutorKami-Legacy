							<style>
							@media (min-width: 768px ) {
								.bottom-align-text {
									margin-left:470px;
								}
							}
							@media (min-width: 1200px ) {
								.bottom-align-text {
									margin-left:670px;
								}
							}
							</style>
			<form method="post" action="terms-of-accepting2.php">
			<div class="sigPad">


					<div class="row">
		
						<div class="col-lg-12">
						<br/>
<?PHP

if($getLan == "/my/"){	
	$queryTCBM = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='83'");
	$resTCBM = $queryTCBM->num_rows;
	if($resTCBM > 0){
		if($rowTCBM = $queryTCBM->fetch_assoc()){ 
			$idBM  = $rowTCBM['pmt_id'];
			$thisReplace = str_replace("TERMA PENERIMAAN JOB TUISYEN", "", $rowTCBM['pmt_pagedetail']);
			$needle    = 'Terma Tambahan untuk Tuisyen Berkumpulan';
			//echo strstr($thisReplace, $needle, true);
			//$rowTCBM['pmt_pagedetail']
			
			echo htmlspecialchars_decode($rowTCBM['pmt_pagedetail']);

			
		}
	}else{
		//$idBM = "";
		//echo "";
	}
}else{
	$queryTCBI = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='82'");
	$resTCBI = $queryTCBI->num_rows;
	if($resTCBI > 0){
		if($rowTCBI = $queryTCBI->fetch_assoc()){ 
			$idBI  = $rowTCBI['pmt_id'];
			$thisReplace = str_replace("TERMS OF ACCEPTING HOME TUITION JOB", "", $rowTCBI['pmt_pagedetail']);
			$needle    = 'Additional Terms for Group Tuition';
			//echo strstr($thisReplace, $needle, true);
			//echo $rowTCBI['pmt_pagedetail'];

			echo htmlspecialchars_decode($rowTCBI['pmt_pagedetail']);
		}
	}else{
		//$idBI = "";
		//echo "";
	}
}
?>


						<div class="col-lg-12 text-right">
							<p class="notbold"> I have read and agreed to all the terms above</p>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="pull-right" id="canvas" > 
								<?PHP
								if ($getUserDetails->data[0]->signature_img2 != '') {
									$pix2 = $getUserDetails->data[0]->signature_img2;
									$pixAll2 = $pix2.".png";
									
                            		$agetSig = strtok($pix2, '_');
                            		$agetSig = str_replace('-', '/', $agetSig);
                            		$adateConvert = strtotime($agetSig); 
                            		$adateFormat = date('Y-m-d', $adateConvert);
									

                                            $aqueryProof1 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='82' AND pmt_noti='TRUE' "; 
                                            $aresultProof1 = $conn->query($aqueryProof1); 
                                            if($aresultProof1->num_rows > 0){ 
                                              
                                                $arowProof1 = $aresultProof1->fetch_assoc();
                                                $adateLastupdated2 = $arowProof1['pmt_lastupdated'];
                                      
                                    		
                                                $adateConvert2 = strtotime($adateLastupdated2); 
                                                $adateFormat2 = date('Y-m-d', $adateConvert2); 
                                    		
                                                if($adateFormat2 <= $adateFormat){
                                                    ?><img src="<?php echo APP_ROOT."images/signature/".$pixAll2; ?>" alt="signature"> <?PHP
                                                }else if($adateFormat2 >= $adateFormat){
                    									?> 
                    									<div class="sig sigWrapper">
                    										<div class="typed"></div>
                    										<canvas class="pad" id="newSignature2" width="450" height="314"></canvas>
                    										<input type="hidden" id="output-2" name="output-2" class="output">
                    									</div>
                    									<?PHP
                                                }else{
                                                    ?><img src="<?php echo APP_ROOT."images/signature/".$pixAll2; ?>" alt="signature"> <?PHP
                                                }
                                                
                                                
                                            }else{
                                                ?><img src="<?php echo APP_ROOT."images/signature/".$pixAll2; ?>" alt="signature"> <?PHP
                                            }
									
									
									
									?><!--<img src="<?php //echo APP_ROOT."images/signature/".$pixAll2; ?>" alt="signature">--> <?PHP
								} else {
									?> 
									<div class="sig sigWrapper">
										<div class="typed"></div>
										<canvas class="pad" id="newSignature2" width="450" height="314"></canvas>
										<input type="hidden" id="output-2" name="output-2" class="output">
									</div>
									<?PHP
								}
								?>
							</div>
							<div class="clearfix"> </div>

							<div class="notbold pull-left bottom-align-text"> 
							<?PHP
							if ($getUserDetails->data[0]->signature_img2 != '') {
								$firstname2 = $getUserDetails->data[0]->ud_first_name;
								$fullname2 = $firstname2." ".$getUserDetails->data[0]->ud_last_name;
								//echo 'Name : '.$fullname2.'<br/>';

								$date2 = $getUserDetails->data[0]->signature_img2;
								$date2 = strtok($date2, '_');
								//echo 'Date : '.$date2;

                                            $aqueryProof3 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='82' AND pmt_noti='TRUE' "; 
                                            $aresultProof3 = $conn->query($aqueryProof3); 
                                            if($aresultProof3->num_rows > 0){ 
                                              
                                                $arowProof3 = $aresultProof3->fetch_assoc();
                                                $adateLastupdated3 = $arowProof3['pmt_lastupdated'];
                                      
                                    		
                                                $adateConvert3 = strtotime($adateLastupdated3); 
                                                $adateFormat3 = date('Y-m-d', $adateConvert3); 
                                    		
                                                if($adateFormat3 <= $adateFormat){
                                                    echo 'Name : '.$fullname2.'<br/>';
                                                    echo 'Date : '.$date2;
                                                }else if($adateFormat3 >= $adateFormat){
                    
                                                }else{
                                                    echo 'Name : '.$fullname2.'<br/>';
                                                    echo 'Date : '.$date2;
                                                }
                                                
                                                
                                            }else{
                                                echo 'Name : '.$fullname2.'<br/>';
                                                echo 'Date : '.$date2;
                                            }
								
								
								
							}
							?>
							</div>
						</div>

		
						<div class="col-lg-12">
							<div class="text-right pull-right" style="margin-top:10px;">
							<?PHP
							if ($getUserDetails->data[0]->signature_img2 != '') {

                                            $aqueryProof4 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='82' AND pmt_noti='TRUE' "; 
                                            $aresultProof4 = $conn->query($aqueryProof4); 
                                            if($aresultProof4->num_rows > 0){ 
                                              
                                                $arowProof4 = $aresultProof4->fetch_assoc();
                                                $adateLastupdated4 = $arowProof4['pmt_lastupdated'];
                                      
                                    		
                                                $adateConvert4 = strtotime($adateLastupdated4); 
                                                $adateFormat4 = date('Y-m-d', $adateConvert4); 
                                    		
                                                if($adateFormat4 <= $adateFormat){
                                                }else if($adateFormat4 >= $adateFormat){
                                                    echo "<p style='font-style: oblique;font-size: 12px;'> * Please sign at the designated area</p>";
                                                }else{
                                                }
                                            }else{
                                            }
							} else {
								echo "<p style='font-style: oblique;font-size: 12px;'> * Please sign at the designated area</p>";
							}
							?>
							<?PHP 
							if ($getUserDetails->data[0]->signature_img2 != '') {
								//echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
								
                                            $aqueryProof5 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='82' AND pmt_noti='TRUE' "; 
                                            $aresultProof5 = $conn->query($aqueryProof5); 
                                            if($aresultProof5->num_rows > 0){ 
                                              
                                                $arowProof5 = $aresultProof5->fetch_assoc();
                                                $adateLastupdated5 = $arowProof5['pmt_lastupdated'];
                                      
                                    		
                                                $adateConvert5 = strtotime($adateLastupdated5); 
                                                $adateFormat5 = date('Y-m-d', $adateConvert5); 

                                                if($adateFormat5 <= $adateFormat){
                                                    echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
                                                }else if($adateFormat5 >= $adateFormat){
                    								echo '<button type="button" class="btn btn-success" onclick="signatureSave2()">Save signature</button>';
                    								echo '<a type="button" class="btn btn-danger clearButton" href="#clear">Clear signature</a>';
                                                }else{
                                                    echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
                                                }
                                            }else{
                                                echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
                                            }
								
							}else{
								echo '<button type="button" class="btn btn-success" onclick="signatureSave2()">Save signature</button>';
								echo '<a type="button" class="btn btn-danger clearButton" href="#clear">Clear signature</a>';
							}
							?>				
							</div>
						</div>



						</div>
					</div>
			
			</div>
			</form>
			
				<script src="pdf/signature-pad-master/jquery.signaturepad.js"></script>
				<script>
				$(document).ready(function() {
					$('.sigPad').signaturePad({
						drawOnly:true, 
						lineTop:220, 
						bgColour : '#ffffff', //transparent
						penColour : '#000000',
						penWidth : 5
					});
				});
				</script>
				<script src="pdf/signature-pad-master/assets/json2.min.js"></script>
<script>
function signatureSave2() {

	var displayid = document.getElementById("displayid").value;
	var output = document.getElementById("output-2").value;
	var canvas = document.getElementById("newSignature2");
	var dataURL = canvas.toDataURL("image/png");

     //if( dataURL == "data:image/png;base64,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" || dataURL == "data:image/png;base64,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"){
     if( output == "" ){
		 alert("Empty Signature");
	 }else{
		 if(displayid != ''){
			$.ajax({
				type: "POST",
				url: 'tutors-terms3.php',
				data: {displayid: displayid, dataURL: dataURL},
				success: function(response){
					alert(response);
					document.location.reload(true);
				}
			});
		 }else{
			 alert("Something Wrong Happened !!");
		 }
	 }

}
</script>