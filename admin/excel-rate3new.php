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
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$queryState = " SELECT st_id, st_name, city_id, city_name, city_st_id FROM tk_states 
LEFT JOIN tk_cities ON city_st_id = st_id
ORDER BY st_name ASC, city_name ASC
";
$resultState = $conn->query($queryState); 
if($resultState->num_rows > 0){

    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>State</th>
                <th>City</th>
                <th>Level</th>
                <th>Note</th>
            </tr>
    ';
    

        while($rowState = $resultState->fetch_assoc()){
            $number = 1;
			$thisGroup = '';
			
            $querySpecific = " SELECT * FROM tk_specific WHERE state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' GROUP BY state_name, city_name     ORDER BY level ASC  ";
            $resultSpecific = $conn->query($querySpecific);
            if($resultSpecific->num_rows > 0){
				while($rowSpecific = $resultSpecific->fetch_assoc()){
					$thisID = array();
					$thisID = [];
					$querySpecificW = " SELECT * FROM tk_specific WHERE note NOT LIKE '%Standard Price%' AND state_name ='".$rowSpecific['state_name']."' AND city_name ='".$rowSpecific['city_name']."' ORDER BY level ASC  ";
					$resultSpecificW = $conn->query($querySpecificW); 
					if($resultSpecificW->num_rows > 0){
						while($rowSpecificW = $resultSpecificW->fetch_assoc()){
							
									$str_arr = explode("\n", $rowSpecificW['note']);
									$result = '';
										foreach ($str_arr as $line) {
											/*if (strpos($line, 'not validated') !== false) {
											}else{}*/
												$remove = str_replace("/", "", $line);
												$remove2 = str_replace("-", "", $remove);
										
												$testtest = preg_replace('/[a-zA-Z0-9]{3,}/','',$remove2);
										
												$str = ['C1','C2','C3','FM','MM','PT'];
												$rplc =['','','','','',''];
										
												$testtest2 = str_replace($str,$rplc,$testtest);
												$int = (int) filter_var($testtest2, FILTER_SANITIZE_NUMBER_INT);
												$int = trim($int);
												$result .= $int." ";
											
										} 

										$array = array_unique((explode(" ",$result)));
										$new_array = array_filter($array);
										$CountArray =  count($new_array);
										$arrayToString = implode(" ",$new_array);
										
										if( $CountArray == 0 ){
											$min = '';
											$max = '';
										}else if( $CountArray == 1 ){
											$min = min($new_array);
											$max = '';
												$thisID[] = $rowSpecificW['id'];
												/*$output .= '
													<tr>  
														<td>'.$rowSpecificW['state_name'].'</td>
														<td>'.$rowSpecificW['city_name'].'</td>
														<td>'.$rowSpecificW['level_name'].'</td>
														<td>'.nl2br($rowSpecificW['note']).'</td>
														<td><textarea rows="8" cols="50">'.$CountArray.' = '.$arrayToString."\n".'MIN : '.$min."\n".'MAX : '.$max.'</textarea></td>
													</tr>
												';*/
										}else{
											$min = min($new_array);
											$max = max($new_array);
										}
						}
					}	
						if($thisID != ''){
							$thisLevel = '';
							$querySpecificA = " SELECT * FROM tk_specific WHERE id IN (".implode(',',$thisID).")  ";
							$resultSpecificA = $conn->query($querySpecificA);
							if($resultSpecificA->num_rows > 0){
								while($rowSpecificA = $resultSpecificA->fetch_assoc()){
									
									$people = array();
									$people = [];
									$querySpecificG = " SELECT * FROM tk_specific WHERE id IN (".implode(',',$thisID).") GROUP BY state_name, city_name  ORDER BY level ASC  ";
									$resultSpecificG = $conn->query($querySpecificG);
									if($resultSpecificG->num_rows > 0){
										while($rowSpecificG = $resultSpecificG->fetch_assoc()){
												$people[] = $rowSpecificG['id'];
										}
									}
									
									if (in_array($rowSpecificA['id'], $people)){
									  $stateName = $rowSpecificA['state_name'];
									  $cityName = $rowSpecificA['city_name'];
									}else{
									  $stateName = '';
									  $cityName = '';
									}
									
									
									
									$thisLevel .= $rowSpecificA['level_name'].',';
													$output .= '
														<tr>  
															<td>'.$stateName.'</td>
															<td>'.$cityName.'</td>
															<td>'.$rowSpecificA['level_name'].'</td>
															<td>'.nl2br($rowSpecificA['note']).'</td>
														</tr>
													';
								}
							}

									
									$querySpecificB = " SELECT * FROM tk_specific WHERE state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' AND id NOT IN (".implode(',',$thisID).") ORDER BY level ASC  ";
									$resultSpecificB = $conn->query($querySpecificB);
									if($resultSpecificB->num_rows > 0){
										while($rowSpecificB = $resultSpecificB->fetch_assoc()){
											$thisLevel .= $rowSpecificB['level_name'].',';
										}
									}
							
							if($thisLevel != ''){
								$a1 = (explode(",",$thisLevel));
								$a2 = array('Pre-School','Tahap 1 (Tahun 1-3)','Tahap 2 (UPSR)','Form 1-3 (PT3)','Form 4-5 (SPM)','Primary (International Syllabus)','Lower Secondary (International Syllabus)','Year 10-11 (IGCSE)');
								$result = array_diff($a2, $a1);  
								if(!empty($result)){
										$first = true;
										foreach ($result as $cell) {
											if ( $first ){
												/*$arrayResultState = $rowState['st_name'];
												$arrayResultcity = $rowState['city_name'];*/
												$arrayResultState = '';
												$arrayResultcity = '';
												$first = false;
											}else{
												$arrayResultState = '';
												$arrayResultcity = '';
											}
											$output .= "<tr><td>" . $arrayResultState . "</td>"."<td>" . $arrayResultcity . "</td>"."<td>" . $cell . "</td>"."<td></td></tr>";
										}

								}
							}
							
							
						}
					
					
				}		
				
			}else{
                $number2 = 1;
                $queryLevel = " SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id !='9' ORDER BY tc_id ASC ";
                $resultLevel = $conn->query($queryLevel); 
                if($resultLevel->num_rows > 0){
                    while($rowLevel = $resultLevel->fetch_assoc()){     
                        if( $number2 == '1'){
                            $thisState = $rowState['st_name'];
                            $thisCity = $rowState['city_name'];
                        }else{
                            $thisState = '';
                            $thisCity = '';
                        }
                        
                        
                            $querySpecificNotSP = " SELECT level, state_name, city_name, level_name, note, tutor_rate_min, tutor_rate_max FROM tk_specific WHERE note LIKE '%Standard Price%' AND state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' AND level_name ='".$rowLevel['tc_title']."' ";
                            $resultSpecificNotSP = $conn->query($querySpecificNotSP);
                            if($resultSpecificNotSP->num_rows > 0){
                                
                            }else{
                                        $output .= '
                                            <tr>  
                                                <td>'.$thisState.'</td>
                                                <td>'.$thisCity.'</td>
                                                <td>'.$rowLevel['tc_title'].'</td>
                                                <td></td>
                                            </tr>
                                        ';
                                $number2++;                                     
                            }
                        
                        
   
                    }
                }
			}
        }  
		

		
		
		
		
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=combine-data.xls');
  echo $output;
}

?>