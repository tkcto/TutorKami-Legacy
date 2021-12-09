<?PHP
/*
require_once('config.php.inc');


$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
*/
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";
$dbCon = new mysqli($servername, $username, $password, $dbname);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}
?>