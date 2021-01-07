<?php
$servername = "localhost";
$username = "root";
$password = "1234";

$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Error mode
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch style, fetching associative array
];

try {
  $conn = new PDO("mysql:host=$servername;dbname=examensarbete", $username, $password, $options);
  // set the PDO error mode to exception
  // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch (\PDOException $e) {
  echo $e->getMessage();
	echo $e->getCode();
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
?>
   

  