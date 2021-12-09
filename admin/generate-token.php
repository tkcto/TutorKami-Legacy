<?PHP
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


function GetShortUrl($function, $email, $url){
    global $conn;
    $query = "SELECT * FROM url_shorten WHERE function = '".$function."' AND email = '".$email."' AND url = '".$url."' "; 
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['short_code'];
    } else {
        $short_code = generateUniqueID();
        $sql = "INSERT INTO url_shorten (function, email, url, short_code, hits) VALUES ('".$function."', '".$email."', '".$url."', '".$short_code."', '0')";
        if ($conn->query($sql) === TRUE) {
            return $short_code;
        } else { 
            die("Unknown Error Occured");
        }
    }
}



function generateUniqueID(){
     global $conn; 
     $token = substr(md5(uniqid(rand(), true)),0,10); // creates a 3 digit unique short id. You can maximize it but remember to change .htacess value as well
     $query = "SELECT * FROM url_shorten WHERE short_code = '".$token."' ";
     $result = $conn->query($query); 
     if ($result->num_rows > 0) {
        generateUniqueID();
     } else {
        return $token;
     }
}


?>