<?php
class DBController {
	private $conn = "";
	private $host = "localhost";
	private $user = "tutorka1_live";
	private $password = "_+11pj,oow.L";
	private $database = "tutorka1_tutorkami_db";

	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->conn = $conn;			
		}
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function runSelectQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}
	
	function executeInsert($query) {
        $result = mysqli_query($this->conn,$query);
        $insert_id = mysqli_insert_id($this->conn);
		return $insert_id;
		
    }
	function executeUpdate($query) {
        $result = mysqli_query($this->conn,$query);
        return $result;
		
    }
	
	function executeQuery($sql) {
		$result = mysqli_query($this->conn,$sql);
		return $result;
		
    }

	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;
	}
}
?>
