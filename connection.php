<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tat_app";

try{
	$con = mysqli_connect($servername,$username,$password,$dbname);
 
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
