<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "examensarbete";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   

// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";


// $host		   		 = 'localhost';
// $database 	   = 'examensarbete';
// $user     	   = 'root';
// $password			 = '';
// $passwordmysql = 'mysql';
// $charset  	   = 'utf8mb4';

// // $dns 	  = "mysql:host={$host};dbname={$database};charset={$charset}";

// // För MAMP, så kan dns se lite olika ut
// $dns 	  = "mysql:unix_socket=/Application/XAMPP/tmp/mysql/mysql.sock;dbname={$database}";

/**
 * Read about setting error mode:
 * https://www.php.net/manual/en/pdo.setattribute.php
 *
 * Read about different fetching styles:
 * https://www.php.net/manual/en/pdostatement.fetch.php
 */
// $options = [
// 	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Error mode
// 	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch style, fetching associative array
// ];


// // Upprätta en DB koppling
// try {
// 	// Försök köra koden i try-blocket
// 	$dbconnect = new PDO("mysql:host=localhost;dbname=database;port=3306","root","");
// } catch (\PDOException $e) {
// 	// Catch-blocket körs om något gick fel i try-blocket
// 	// echo $e->getMessage();
// 	// echo $e->getCode();
// 	throw new \PDOException($e->getMessage(), (int) $e->getCode());
// }

