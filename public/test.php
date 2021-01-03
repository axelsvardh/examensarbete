<?php
require '../src/dbconnect.php';

try {					
$first_name  = '';
$query = "SELECT * FROM users ";
$stmt = $conn->query($query);
$users = $stmt->fetchall();
}   catch (\PDOException $e) {
throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p>hejehejehej</p>
  <table style='border: solid 1px black;'>
  <tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>
  <?php foreach ($users as $key => $user) { ?>
   
  <td style='width:150px;border:1px solid black;'><?=($user['id'])?></td>
  <td style='width:150px;border:1px solid black;'><?=($user['first_name'])?></td>
  <td style='width:150px;border:1px solid black;'><?=($user['last_name'])?></td>
  <br>
  <?php } ?>
  <tr>
  <tr>
  
  </table>
</body>
</html>