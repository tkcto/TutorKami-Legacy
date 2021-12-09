<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>

<?PHP
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";
$dbCon = new mysqli($servername, $username, $password, $dbname);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}

$Link = array();
    $sql = " SELECT * FROM tk_lokasi2 GROUP BY l_post ORDER BY l_post ASC ";
    $result = $dbCon->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            //echo $row['l_post'].'<br/>';
            $Link[] = $row['l_post'];
        }
    }
    
?>
Johor<img src="img/Johor.PNG" width="800" height="300">
Kedah<img src="img/Kedah.PNG" width="800" height="300">
Kelantan<img src="img/Kelantan.PNG" width="800" height="300">
Melaka<img src="img/Melaka.PNG" width="800" height="300">
Negeri<img src="img/Negeri-Sembilan.PNG" width="800" height="300">
Pahang<img src="img/Pahang.PNG" width="800" height="300">
Perak<img src="img/Perak.PNG" width="800" height="300">
Perlis<img src="img/Perlis.PNG" width="800" height="300">
Pinang<img src="img/PulauPinang.PNG" width="800" height="300">
Sabah<img src="img/Sabah.PNG" width="800" height="300">
Sarawak<img src="img/Sarawak.PNG" width="800" height="300">
Selangor<img src="img/Selangor.PNG" width="800" height="300">
Terengganu<img src="img/Terengganu.PNG" width="800" height="300">
Wilayah<img src="img/WilayahPersekutuan.PNG" width="800" height="300">

<table class="table display" id="example" style="width:100%">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Total</th>
      <th scope="col">Location</th>
      <th scope="col">Area</th>
    </tr>
  </thead>
  <tbody>
      <?PHP
        if(!empty($Link)){
            $totalLink = count($Link);
            for ($x = 0; $x < $totalLink; $x++) {
                //$result = $dbCon->query("SELECT COUNT(*) FROM tk_lokasi2 WHERE l_post = '".$Link[$x]."'  ");
                //$row = $result->fetch_row();
                
                $total = '';
                $dataL = '';
                $sql = " SELECT * FROM tk_lokasi2 WHERE l_post = '".$Link[$x]."' ";
                $result = $dbCon->query($sql);
                $total = $result->num_rows;
                if( $total > 0){
                    $row = $result->fetch_assoc();
                    $dataL = $row['l_state'];
                }
                ?>
                    <tr>
                      <th scope="row"><?PHP echo $total; ?></th>
                      <td><?PHP echo $Link[$x]; ?></td>
                      <td><?PHP echo $dataL; ?></td>
                    </tr>                
                <?PHP
            }
        }
      ?>
  </tbody>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers",
        "order": [
            [ 2, 'asc' ],
            [ 1, 'asc' ]
        ]
    } );
} );
</script>