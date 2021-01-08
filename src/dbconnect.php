<?php
$servername = "localhost";
$database = "examensarbete";
$username = "root";
$password = "1234";
$charset  = 'utf8mb4';

$dns 	    = "mysql:host={$servername};dbname={$database};charset={$charset}";

$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Error mode
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch style, fetching associative array
];

try {
  $conn = new PDO($dns, $username, $password, $options);
  // set the PDO error mode to exception
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
  

  