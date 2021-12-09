
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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$num = 1;

$test = "
SELECT * FROM tk_specific WHERE note LIKE '%not validated%'
ORDER BY state_name ASC, city_name ASC, level_name ASC
";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
    <th>ID</th>
    <th>STATE</th>
    <th>CITY</th>
    <th>LEVEL</th>
    <th>MIN RATE</th>
    <th>MAX RATE</th>
    <th>NOTE</th>
    <th>TEST</th>

  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){
        
        /*$text = trim($rowTest['note']); // remove the last \n or whitespace character
        $text = nl2br($text); */
        
        $text = trim($rowTest['note']); // remove the last \n or whitespace character
        $text = nl2br($text); 
        $text = str_replace("<br />", ' *** ', $text);


        $str_arr = explode("\n", $rowTest['note']);
        $result = '';
            foreach ($str_arr as $line) {
                if (strpos($line, 'not validated') !== false) {
                    //true
                }else{
                    //echo $line."*** \n";
                    $remove = str_replace("/", "", $line);
                    $remove2 = str_replace("-", "", $remove);
            
                    $testtest = preg_replace('/[a-zA-Z0-9]{3,}/','',$remove2);
                    //$testtest2 = preg_replace('/[a-zA-Z]/','',$testtest);
                    
            
                    $str = ['C1','C2','C3','FM','MM','PT'];
                    $rplc =['','','','','',''];
            
                    $testtest2 = str_replace($str,$rplc,$testtest);
                    $int = (int) filter_var($testtest2, FILTER_SANITIZE_NUMBER_INT);
                    $int = trim($int);
                    //echo $int."\n";
                    //$int = trim($int)."\n";
                    $result .= $int." ";
                }
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
            }else{
                $min = min($new_array);
                $max = max($new_array);
            }
            
            

          echo '<tr>
            <td>'.$rowTest['id'].' </td>
            <td>'.$rowTest['state_name'].' </td>
            <td>'.$rowTest['city_name'].' </td>
            <td>'.$rowTest['level_name'].' </td>
            <td>'.$rowTest['tutor_rate_min'].' </td>
            <td>'.$rowTest['tutor_rate_max'].' </td>
            <td><textarea rows="8" cols="50">'.$rowTest['note'].'</textarea></td>
            <td><textarea rows="8" cols="50">'.$CountArray.' = '.$arrayToString."\n".'MIN : '.$min."\n".'MAX : '.$max.'</textarea></td>
          </tr>';
        		
            $num++; 
    }
    
echo '</table>';
}













?>