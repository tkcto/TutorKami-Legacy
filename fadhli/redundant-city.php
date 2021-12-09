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
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$num = 1;
$test = "
SELECT city_name, COUNT(*)
FROM tk_cities
GROUP BY city_name
HAVING COUNT(*) > 1
";
$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {
echo '
<table>
  <tr>
    <th>id</th>
    <th>city</th>
    <th>state</th>

  </tr>';
   
    while($rowTest = $resultTest->fetch_assoc()){
				
        $city = " SELECT * FROM tk_cities WHERE city_name LIKE '".$rowTest['city_name']."' ";
        $city1 = $conn->query($city);
        if ($city1->num_rows > 0) {
            while($city2 = $city1->fetch_assoc()){
				//$tisstateC = $city2['city_name'];
				$state = " SELECT * FROM tk_states WHERE st_id = '".$city2['city_st_id']."' ";
				$state1 = $conn->query($state);
				if ($state1->num_rows > 0) {
					$state2 = $state1->fetch_assoc();
					$stateName = $state2['st_name'];
				}else{
					$stateName = '';
				}
				
							
				
                echo '<tr>';
                echo '<td>'.$city2['city_id'].'</td>';
                echo '<td>'.$city2['city_name'].'</td>';
                echo '<td>'.$stateName.'</td>';
                echo '</tr>';  
			}
        }

     $num++;     
    }
    echo '</table>';
}



echo ' <br/><br/> 7	Salak Tinggi
<table>
  <tr>
    <th>location covered</th>
    <th>Workplace location (tutor)</th>
    <th>Current City (tutor & parent)</th>
    <th>Job City</th>
  </tr>';
                echo '<tr>';
/** covered **/
				$covered = " SELECT * FROM tk_tutor_area_cover WHERE tac_city_id ='7' ";
				$resultcovered = $conn->query($covered);
				if ($resultcovered->num_rows > 0) {
					echo '<td> Total User : '.$resultcovered->num_rows.'';
					$coveredUser = " SELECT * FROM tk_user
					INNER JOIN tk_tutor_area_cover ON tk_tutor_area_cover.tac_u_id = tk_user.u_id
					WHERE tac_city_id ='7' ";
					$resultcoveredUser = $conn->query($coveredUser);
					if ($resultcoveredUser->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowcoveredUser = $resultcoveredUser->fetch_assoc()){
							echo $rowcoveredUser['u_displayid'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
				}else{
					echo '<td>0</td>';
				}
/** covered **/
				
/** Workplace **/
				$Workplace = " SELECT * FROM tk_user_details WHERE ud_workplace_city ='7' ";
				$resultWorkplace = $conn->query($Workplace);
				if ($resultWorkplace->num_rows > 0) {
					//echo '<td>'.$resultWorkplace->num_rows.'</td>';
					echo '<td> Total User : '.$resultWorkplace->num_rows.'';
					$WorkplaceUser = " SELECT * FROM tk_user
					INNER JOIN tk_user_details ON tk_user_details.ud_u_id = tk_user.u_id
					WHERE ud_workplace_city ='7' ";
					$resultWorkplaceUser = $conn->query($WorkplaceUser);
					if ($resultWorkplaceUser->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowWorkplaceUser = $resultWorkplaceUser->fetch_assoc()){
							echo $rowWorkplaceUser['u_displayid'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
					
				}else{
					echo '<td>0</td>';
				}
/** Workplace **/	
				
/** Current **/
				$Current = " SELECT * FROM tk_user_details WHERE ud_city ='7' ";
				$resultCurrent = $conn->query($Current);
				if ($resultCurrent->num_rows > 0) {
					//echo '<td>'.$resultCurrent->num_rows.'</td>';
					echo '<td> Total User : '.$resultCurrent->num_rows.'';
					$CurrentUser = " SELECT * FROM tk_user
					INNER JOIN tk_user_details ON tk_user_details.ud_u_id = tk_user.u_id
					WHERE ud_city ='7' ";
					$resultCurrentUser = $conn->query($CurrentUser);
					if ($resultCurrentUser->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowCurrentUser = $resultCurrentUser->fetch_assoc()){
							echo $rowCurrentUser['u_displayid'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
					
					
					
				}else{
					echo '<td>0</td>';
				}
/** Current **/		
/** Parent **/
				/*$Parent = " SELECT * FROM tk_user_details WHERE ud_city ='7' ";
				$resultParent = $conn->query($Parent);
				if ($resultParent->num_rows > 0) {
					//echo '<td>'.$resultParent->num_rows.'</td>';
					echo '<td> Total User : '.$resultParent->num_rows.'';
					$ParentUser = " SELECT * FROM tk_user
					INNER JOIN tk_user_details ON tk_user_details.ud_u_id = tk_user.u_id
					WHERE ud_city ='7' ";
					$resultParentUser = $conn->query($ParentUser);
					if ($resultParentUser->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowParentUser = $resultParentUser->fetch_assoc()){
							echo $rowParentUser['u_displayid'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
					
					
				}else{
					echo '<td>0</td>';
				}*/
/** Parent **/	
				
/** Job **/
				$Job = " SELECT * FROM tk_job WHERE city ='7' ";
				$resultJob = $conn->query($Job);
				if ($resultJob->num_rows > 0) {
					//echo '<td>'.$resultJob->num_rows.'</td>';
					echo '<td> Total Job : '.$resultJob->num_rows.'';
					$JobID = " SELECT * FROM tk_job WHERE city ='7' ";
					$resultJobID = $conn->query($JobID);
					if ($resultJobID->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowJobID = $resultJobID->fetch_assoc()){
							echo $rowJobID['j_id'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
					
					
				}else{
					echo '<td>0</td>';
				}
/** Job **/				
				
				


                echo '</tr>';  
    echo '</table>';

echo ' <br/><br/> 1384	Salak Tinggi
<table>
  <tr>
    <th>location covered</th>
    <th>Workplace location (tutor)</th>
    <th>Current City (tutor & parent)</th>
    <th>Job City</th>
  </tr>';
                echo '<tr>';
/** covered **/
				$covered2 = " SELECT * FROM tk_tutor_area_cover WHERE tac_city_id ='1384' ";
				$resultcovered2 = $conn->query($covered2);
				if ($resultcovered2->num_rows > 0) {
					echo '<td> Total User : '.$resultcovered2->num_rows.'';
					$coveredUser2 = " SELECT * FROM tk_user
					INNER JOIN tk_tutor_area_cover ON tk_tutor_area_cover.tac_u_id = tk_user.u_id
					WHERE tac_city_id ='1384' ";
					$resultcoveredUser2 = $conn->query($coveredUser2);
					if ($resultcoveredUser2->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowcoveredUser2 = $resultcoveredUser2->fetch_assoc()){
							echo $rowcoveredUser2['u_displayid'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
				}else{
					echo '<td>0</td>';
				}
/** covered **/
				
/** Workplace **/
				$Workplace2 = " SELECT * FROM tk_user_details WHERE ud_workplace_city ='1384' ";
				$resultWorkplace2 = $conn->query($Workplace2);
				if ($resultWorkplace2->num_rows > 0) {
					//echo '<td>'.$resultWorkplace->num_rows.'</td>';
					echo '<td> Total User : '.$resultWorkplace2->num_rows.'';
					$WorkplaceUser2 = " SELECT * FROM tk_user
					INNER JOIN tk_user_details ON tk_user_details.ud_u_id = tk_user.u_id
					WHERE ud_workplace_city ='1384' ";
					$resultWorkplaceUser2 = $conn->query($WorkplaceUser2);
					if ($resultWorkplaceUser2->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowWorkplaceUser2 = $resultWorkplaceUser2->fetch_assoc()){
							echo $rowWorkplaceUser2['u_displayid'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
					
				}else{
					echo '<td>0</td>';
				}
/** Workplace **/	
				
/** Current **/
				$Current2 = " SELECT * FROM tk_user_details WHERE ud_city ='1384' ";
				$resultCurrent2 = $conn->query($Current2);
				if ($resultCurrent2->num_rows > 0) {
					//echo '<td>'.$resultCurrent->num_rows.'</td>';
					echo '<td> Total User : '.$resultCurrent2->num_rows.'';
					$CurrentUser2 = " SELECT * FROM tk_user
					INNER JOIN tk_user_details ON tk_user_details.ud_u_id = tk_user.u_id
					WHERE ud_city ='1384' ";
					$resultCurrentUser2 = $conn->query($CurrentUser2);
					if ($resultCurrentUser2->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowCurrentUser2 = $resultCurrentUser2->fetch_assoc()){
							echo $rowCurrentUser2['u_displayid'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
					
					
					
				}else{
					echo '<td>0</td>';
				}
/** Current **/		
/** Parent **/
				/*$Parent2 = " SELECT * FROM tk_user_details WHERE ud_city ='1384' ";
				$resultParent2 = $conn->query($Parent2);
				if ($resultParent2->num_rows > 0) {
					//echo '<td>'.$resultParent->num_rows.'</td>';
					echo '<td> Total User : '.$resultParent2->num_rows.'';
					$ParentUser2 = " SELECT * FROM tk_user
					INNER JOIN tk_user_details ON tk_user_details.ud_u_id = tk_user.u_id
					WHERE ud_city ='1384' ";
					$resultParentUser2 = $conn->query($ParentUser2);
					if ($resultParentUser2->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowParentUser2 = $resultParentUser2->fetch_assoc()){
							echo $rowParentUser2['u_displayid'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
					
					
				}else{
					echo '<td>0</td>';
				}*/
/** Parent **/	
				
/** Job **/
				$Job2 = " SELECT * FROM tk_job WHERE city ='1384' ";
				$resultJob2 = $conn->query($Job2);
				if ($resultJob2->num_rows > 0) {
					//echo '<td>'.$resultJob->num_rows.'</td>';
					echo '<td> Total Job : '.$resultJob2->num_rows.'';
					$JobID2 = " SELECT * FROM tk_job WHERE city ='1384' ";
					$resultJobID2 = $conn->query($JobID2);
					if ($resultJobID2->num_rows > 0) {
						echo '<br/><textarea rows="8" cols="50">';
						while($rowJobID2 = $resultJobID2->fetch_assoc()){
							echo $rowJobID2['j_id'].", ";
						}
						echo '</textarea>';
					}
					echo '</td>';
					
					
				}else{
					echo '<td>0</td>';
				}
/** Job **/	
                echo '</tr>';  
    echo '</table>';








?>