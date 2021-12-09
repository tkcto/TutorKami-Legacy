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
			<form method="post" action="terms-of-accepting.php">
			<div class="sigPad">

					<div class="row">
		
						<div class="col-lg-12">
						<br/>
<?PHP
echo 'test';
if($getLan == "/my/"){	
	$queryTCBM = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='77'");
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
	$queryTCBI = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='76'");
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
								if ($getUserDetails->data[0]->signature_img != '') {
									$pix = $getUserDetails->data[0]->signature_img;
									$pixAll = $pix.".png";
									
                            		$getSig = strtok($pix, '_');
                            		$getSig = str_replace('-', '/', $getSig);
                            		$dateConvert = strtotime($getSig); 
                            		$dateFormat = date('Y-m-d', $dateConvert);
									
                                            $queryProof1 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='76' AND pmt_noti='TRUE' "; 
                                            $resultProof1 = $conn->query($queryProof1); 
                                            if($resultProof1->num_rows > 0){ 
                                              
                                                $rowProof1 = $resultProof1->fetch_assoc();
                                                $dateLastupdated2 = $rowProof1['pmt_lastupdated'];
                                      
                                    		
                                                $dateConvert2 = strtotime($dateLastupdated2); 
                                                $dateFormat2 = date('Y-m-d', $dateConvert2); 
                                    		
                                                if($dateFormat2 <= $dateFormat){
                                                    ?><img src="<?php echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature"> <?PHP
                                                }else if($dateFormat2 >= $dateFormat){
                    									?> 
                    									<div class="sig sigWrapper">
                    										<div class="typed"></div>
                    										<canvas class="pad" id="newSignature" width="450" height="314"></canvas>
                    										<input type="hidden" id="output" name="output" class="output">
                    									</div>
                    									<?PHP
                                                }else{
                                                    ?><img src="<?php echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature"> <?PHP
                                                }
                                                
                                                
                                            }else{
                                                ?><img src="<?php echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature"> <?PHP
                                            }
    		
									
									
									
									?><!--<img src="<?php //echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature">--> <?PHP
								} else {
									?> 
									<div class="sig sigWrapper">
										<div class="typed"></div>
										<canvas class="pad" id="newSignature" width="450" height="314"></canvas>
										<input type="hidden" id="output" name="output" class="output">
									</div>
									
									<?PHP
								}
								?>
							</div>
							<div class="clearfix"> </div>

							<div class="notbold pull-left bottom-align-text"> 
							<?PHP
							if ($getUserDetails->data[0]->signature_img != '') {
								$firstname = $getUserDetails->data[0]->ud_first_name;
								$fullname = $firstname." ".$getUserDetails->data[0]->ud_last_name;
								//echo 'Name : '.$fullname.'<br/>';

								$date = $getUserDetails->data[0]->signature_img;
								$date = strtok($date, '_');
								//echo 'Date : '.$date;
								
								
                                            $queryProof3 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='76' AND pmt_noti='TRUE' "; 
                                            $resultProof3 = $conn->query($queryProof3); 
                                            if($resultProof3->num_rows > 0){ 
                                              
                                                $rowProof3 = $resultProof3->fetch_assoc();
                                                $dateLastupdated3 = $rowProof3['pmt_lastupdated'];
                                      
                                    		
                                                $dateConvert3 = strtotime($dateLastupdated3); 
                                                $dateFormat3 = date('Y-m-d', $dateConvert3); 
                                    		
                                                if($dateFormat3 <= $dateFormat){
                                                    echo 'Name : '.$fullname.'<br/>';
                                                    echo 'Date : '.$date;
                                                }else if($dateFormat3 >= $dateFormat){
                    
                                                }else{
                                                    echo 'Name : '.$fullname.'<br/>';
                                                    echo 'Date : '.$date;
                                                }
                                                
                                                
                                            }else{
                                                echo 'Name : '.$fullname.'<br/>';
                                                echo 'Date : '.$date;
                                            }
								
								
								
								
								
								
								
								
								
							}
							?>
							</div>
						</div>

		
						<div class="col-lg-12">
							<div class="text-right pull-right" style="margin-top:10px;">
							<?PHP
							if ($getUserDetails->data[0]->signature_img != '') {
							    

                                            $queryProof4 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='76' AND pmt_noti='TRUE' "; 
                                            $resultProof4 = $conn->query($queryProof4); 
                                            if($resultProof4->num_rows > 0){ 
                                              
                                                $rowProof4 = $resultProof4->fetch_assoc();
                                                $dateLastupdated4 = $rowProof4['pmt_lastupdated'];
                                      
                                    		
                                                $dateConvert4 = strtotime($dateLastupdated4); 
                                                $dateFormat4 = date('Y-m-d', $dateConvert4); 
                                    		
                                                if($dateFormat4 <= $dateFormat){
                                                }else if($dateFormat4 >= $dateFormat){
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
							if ($getUserDetails->data[0]->signature_img != '') {
								
                                            $queryProof5 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='76' AND pmt_noti='TRUE' "; 
                                            $resultProof5 = $conn->query($queryProof5); 
                                            if($resultProof5->num_rows > 0){ 
                                              
                                                $rowProof5 = $resultProof5->fetch_assoc();
                                                $dateLastupdated5 = $rowProof5['pmt_lastupdated'];
                                      
                                    		
                                                $dateConvert5 = strtotime($dateLastupdated5); 
                                                $dateFormat5 = date('Y-m-d', $dateConvert5); 

                                                if($dateFormat5 <= $dateFormat){
                                                    echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
                                                }else if($dateFormat5 >= $dateFormat){
                    								echo '<button type="button" class="btn btn-success" onclick="signatureSave()">Save signature</button>';
                    								echo '<a type="button" class="btn btn-danger clearButton" href="#clear">Clear signature</a>';
                                                }else{
                                                    echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
                                                }
                                            }else{
                                                echo '<button type="submit" class="btn btn-primary">Copy PDF</button>';
                                            }
								
								
								
								
							}else{
								echo '<button type="button" class="btn btn-success" onclick="signatureSave()">Save signature</button>';
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
function signatureSave() {

	var displayid = document.getElementById("displayid").value;
	var output = document.getElementById("output").value;
	var canvas = document.getElementById("newSignature");
	var dataURL = canvas.toDataURL("image/png");
	//alert(output);
	
     //if( dataURL == "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAcIAAAE6CAYAAACF2VIxAAAL00lEQVR4Xu3VAREAAAgCMelf2iA/GzC8Y+cIECBAgEBYYOHsohMgQIAAgTOEnoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgAABQ+gHCBAgQCAtYAjT9QtPgAABAobQDxAgQIBAWsAQpusXngABAgQMoR8gQIAAgbSAIUzXLzwBAgQIGEI/QIAAAQJpAUOYrl94AgQIEDCEfoAAAQIE0gKGMF2/8AQIECBgCP0AAQIECKQFDGG6fuEJECBAwBD6AQIECBBICxjCdP3CEyBAgIAh9AMECBAgkBYwhOn6hSdAgACBBwTZATsC1OYWAAAAAElFTkSuQmCC" || dataURL == "data:image/png;base64,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"){
     /*if( dataURL == "data:image/png;base64,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" || dataURL == "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAcIAAAE6CAYAAACF2VIxAAAL+klEQVR4Xu3ZsQ3DMBRDQbn2Itp/Gi2iOg7SBUaA1H6nDXj8AAsdr/cbHgECBAgQiAochjDavNgECBAg8BEwhA6BAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBC4DeFaa+y9yRAgQIAAgccJnOc55pxfuQzh42oWiAABAgR+Cfw1hPgIECBAgEBJwB9hqW1ZCRAgQOAmYAgdBQECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQICAIXQDBAgQIJAWMITp+oUnQIAAAUPoBggQIEAgLWAI0/ULT4AAAQKG0A0QIECAQFrAEKbrF54AAQIEDKEbIECAAIG0gCFM1y88AQIECBhCN0CAAAECaQFDmK5feAIECBAwhG6AAAECBNIChjBdv/AECBAgYAjdAAECBAikBQxhun7hCRAgQMAQugECBAgQSAsYwnT9whMgQIDABZeG8I/1zLOsAAAAAElFTkSuQmCC" ){
		 alert("Please Signature In The Space Provided");
	 }*/
	 
	 if( output == "" ){
		 alert("Empty Signature");
	 }else{
		 if(displayid != ''){
			$.ajax({
				type: "POST",
				url: 'tutors-terms2.php',
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