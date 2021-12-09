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

function myFilter($string) {
  //return strpos($string, 'tutor not validated ') === false;
    if (strpos($string, 'tutor not validated ') === false || strpos($string, '(tutor not validated) ') === false) {
        return  strpos($string, 'tutor not validated ') === false && strpos($string, '(tutor not validated) ') === false;
    }
}

function myFilter2($string) {
    /*if (strpos($string, ' ') === false ) {
        return  strpos($string, ' ') === false;
    }
    $result = preg_match('/^ *$/', $string);
    return $result;*/
    //$string = filter_var($string, FILTER_VALIDATE_INT);
    //return ($string !== FALSE);
    
    //preg_match_all('/^\d{2}$/', $string);
    //return preg_match_all('/^\d{2}$/', $string);

$last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
$last_word = substr($string, $last_word_start); // $last_word = PHP.
return $last_word;




}





function get_numerics ($str) {
    //preg_match_all('/\d+/', $str, $matches);
    //preg_match_all("/[0-9]{2}/", $str, $matches);
    
     //preg_match_all('/\d{2}+/', $str, $matches);

    //return $matches[0];
preg_match("/([0-9]{2}+)/", $str, $matches);
return $matches[1];
    
    
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

$queryRate = " SELECT * FROM tk_specific WHERE note LIKE '%tutor not validated%' ORDER BY state_name ASC, city_name ASC, level_name ASC";
$resultRate = $conn->query($queryRate); 
if($resultRate->num_rows > 0){ 
    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>State</th>
                <th>City</th>
                <th>Level</th>
                <th>Note</th>
                <th>tutor_rate_min</th>
                <th>tutor_rate_max</th>
            </tr>
    ';
        while($rowRate = $resultRate->fetch_assoc()){
            
                $beforeString = explode(' tutor not validated', $rowRate['note']);
                $beforeString =  $beforeString[0];

                $beforeStringValue = substr($beforeString, strrpos($beforeString, " " )+1)."\n";




//$variable = substr(strstr($rowRate['note'], 'tutor not validated '), strlen('tutor not validated '));

$variable = explode("\n", $rowRate['note']);


$newArray = array_filter($variable, 'myFilter');
$newArray = implode("\n",$newArray);
if( $newArray != ''){
    $variable2 = $newArray;
}else{
    $variable2 = 'Error';
}

                if( $variable2 != 'Error'){
                    

$variableNEW = explode("\n", $variable2);
$newArrayNEW2 = array_filter($test2222, 'myFilter2');
//$newArrayNEW3 = implode(" ",$newArrayNEW2);


   
//$test2222 =  'array("'.implode('", "', $variableNEW).'");';



foreach ($variableNEW as $key => $value) {
  if ($key > 0) 
  //echo '"'.$value.'"';
  $testArr =  '"'.$value.'[/tag] ';
  //echo $testArr;
  

$parsed = get_string_between($testArr, " ", '[/tag]');

echo $parsed; // (result = dog)
  
}




$testtest =  get_numerics($variable2);
//$testtest = implode("\n",$testtest);

//print_r($variableNEW)
                
                                $output .= '
                                    <tr>  
                                        <td>'.$rowRate['state_name'].'</td>
                                        <td>'.$rowRate['city_name'].'</td>
                                        <td>'.$rowRate['level_name'].'</td>
                                        <td><textarea rows="10" cols="50">'.$rowRate['note'].'</textarea></td>
                                        
                                        <td>'.$rowRate['tutor_rate_min'].'</td>
                                        <td>'.$rowRate['tutor_rate_max'].'-'.$variable2.'<textarea rows="10" cols="50">'.$last_word.'</textarea></td>
                                    </tr>
                                ';    
                }

        }
  
  
  $output .= '</table>';
  /*header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=rate-one-data.xls');*/
  echo $output;
}

?>