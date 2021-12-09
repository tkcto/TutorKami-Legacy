
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


/*
$test = "
SELECT 
    u_username, u_email, ud_last_name, u_role,
    COUNT(ud_last_name)
FROM
    tk_user
    INNER JOIN tk_user_details ON ud_u_id = u_id
    WHERE u_role = '4'
GROUP BY ud_last_name
HAVING COUNT(ud_last_name) > 1
";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {
echo '
<table>
  <tr>
    <th>No</th>
    <th>u_username</th>
    <th>u_email</th>
    <th>ud_last_name</th>
  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){
        
        

  echo '<tr>
    <td>'.$num.' </td>
    <td>'.$rowTest['u_username'].' </td>
    <td>'.$rowTest['u_email'].' </td>
    <td>'.ucwords(strtolower($rowTest['ud_last_name'])).' </td>
    
    
  </tr>';
		
    $num++; 
    }
    
echo '</table>';
}
*/

/*
echo '
<table>
  <tr>
    <th>No</th>
    <th>Date</th>
    <th>Job</th>
    <th>Tutor</th>
    <th>Received</th>
    <th>Note</th>
    <th>Date Tutor Paid</th>
    <th>Paid to Tutor</th>
    <th>Hour</th>
    <th>Note</th>
    <th>parentRate</th>
    <th>no9/GP</th>
    
    
  </tr>';
*/
$json_url = 'https://script.google.com/macros/s/AKfycbwjJjY4T4aK1PO831snfj_HpgSYGlwNj0T3GV8YccD545s-jyo/exec';
$json = file_get_contents($json_url);
$data = json_decode($json, true);
$entries = $data['user'];

// <td>'.date("d/m/Y", strtotime($entry['tutor_paid'])).'-----'.$tempDate.' </td>

$previous = '';
$current = '';
$previousJOB = '';
$currentJOB = '';
$no = 1;
$noloop = 1;

foreach ($entries as $entry) {
    //echo $date = date("d/m/Y", strtotime($entry['date'])).'<br>';
    
$time=strtotime($entry['date']);
$month=date("F",$time);
$year=date("Y",$time);    

/*
Nadia Apr - dah 631
Zahrah Apr - dah 783
Aisyah Apr -  dah 797

Nadia Jan - dah 910
Nadia Feb - dah 1090
Nadia Mar - dah 1294

Zahrah Jan - dah 1366
Zahrah Feb - dah 1468
Zahrah Mar - dah 1551

Aisyah Jan - dah 1565
Aisyah Feb - dah 1578
Aisyah Mar - dah 1590
*/


    if( $no >= 1404 && $no <= 1415 ){
        
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }
          $Date = date("d/m/y", strtotime($entry['date']));
          if( $entry['job'] == '' ){
                $job = $previousJOB;
          }else{
                $currentJOB = $entry['job'];
                $job = $entry['job'];
          }
          $Tutor = htmlspecialchars(trim($entry['tutor']), ENT_QUOTES);
          $amountParent = number_format($entry['amount'], 2);
          $noteParent = htmlspecialchars(trim($entry['note']), ENT_QUOTES);
          
          if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                $dateTutor = date("d/m/y", strtotime($entry['tutor_paid']));
          }else{
                $dateTutor = '';
          }
          $amountTutor = number_format($entry['kosong'], 2);
          $gp = (number_format(($entry['amount'] - $entry['kosong']), 2));
          $cycle = $entry['hours'];
          $noteTutor = htmlspecialchars(trim($entry['note_last2']), ENT_QUOTES); 
          $cf = '';
/*  
$sqlInsert = "INSERT INTO tk_sales_sub (main_id, tab_name, month, temp, row_no, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11, cf )
VALUES ('1', 'Aisyah', 'Mar', '', '".$noloop."', '".$Date."', '".$job."', '".$Tutor."', '".$amountParent."', '".$noteParent."', '".$dateTutor."', '".$amountTutor."', '".$parentRate."', '".$gp."', '".$cycle."', '".$noteTutor."', '".$cf."')";
$conn->query($sqlInsert);
*/
echo $no.' '.$Date.' '.$job.' '.$Tutor.'<br/>';
         
        $noloop++;
    }

/*
    // START nadia NAM (hold till PKP) 677 - 853
    if( $no >= 677 && $no <= 853 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END nadia NAM (hold till PKP) 677 - 853
    
    
    // START zahrah 1210 - 1285
    if( $no >= 1232 && $no <= 1307 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>zahrah '.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END zahrah 1210 - 1285
    
    
    // START aisyah 1392 - 1405
    if( $no >= 1421 && $no <= 1434 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>aisyah '.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END aisyah  1392 - 1405
*/








/*
    // * JAN * //
    // START nadia 165 - 277
    if( $no >= 165 && $no <= 277 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END nadia 165 - 277
    


    // * FEB * //
    // START nadia 283 - 462
    if( $no >= 283 && $no <= 462 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END nadia 283 - 462
    


    // * MARCH * //
    // START nadia 468 - 671
    if( $no >= 468 && $no <= 671 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END nadia 468 - 671
*/









/*
    // * JAN * //
    // START zahrah 942 - 1013
    if( $no >= 960 && $no <= 1031 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END zahrah 942 - 1013
    


    // * FEB * //
    // START zahrah 1019 - 1120
    if( $no >= 1037 && $no <= 1138 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END zahrah 1019 - 1120
    


    // * MARCH * //
    // START zahrah 1126 - 1208
    if( $no >= 1144 && $no <= 1226 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END zahrah 1126 - 1208
*/










/*
    // * JAN * //
    // START asiyah 1349 - 1362
    if( $no >= 1367 && $no <= 1380 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END asiyah 1349 - 1362
    


    // * FEB * //
    // START asiyah 1368 - 1380
    if( $no >= 1386 && $no <= 1398 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END asiyah 1368 - 1380
    


    // * MARCH * //
    // START asiyah 1386 - 1397
    if( $no >= 1404 && $no <= 1415 ){
        $parentRate = '';
        $test = " SELECT j_id, parent_rate FROM tk_job where j_id = '".$entry['job']."' ";
        $resultTest = $conn->query($test);
        if ($resultTest->num_rows > 0) {
            $rowTest = $resultTest->fetch_assoc();
            $parentRate = $rowTest['parent_rate'];
        }

          echo '<tr>
            <td>'.$no.' </td>
            <td>'.date("d/m/y", strtotime($entry['date'])).'</td>
            ';
            

            if( $entry['job'] == '' ){
                echo '<td>'.$previousJOB.'</td>';
            }else{
                $currentJOB = $entry['job'];
                echo '<td>'.$entry['job'].' </td>';
            }


          echo '
            <td>'.$entry['tutor'].' </td>
            <td>'.number_format($entry['amount'], 2).' </td>
            <td>'.$entry['note'].' </td>
            ';
      
            if( date("d/m/Y", strtotime($entry['tutor_paid'])) != '01/01/1970' ){
                $current = date("d/m/y", strtotime($entry['tutor_paid']));
                echo '<td>'.date("d/m/y", strtotime($entry['tutor_paid'])).'</td>';
            }else{
                //echo '<td>'.$previous.'</td>';
                echo '<td></td>';
            }
            
          echo '
            <td>'.number_format($entry['kosong'], 2).' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            <td>'.$parentRate.' </td>
            <td>'.number_format(($entry['amount'] - $entry['kosong']), 2).' || '.$noloop.' || '.$entry['note_last2'].'</td>
          </tr>';         
        $noloop++;
    }
    // END asiyah 1386 - 1397
*/








        $previous = $current;
        $previousJOB = $currentJOB;
        $no++;
    
    
}
//echo '</table>';









?>