<?php
require('../src/config.php');
$conn = OpenCon();
echo "Connected Successfully";
CloseCon($conn);
error_reporting(-1);
echo "Bulle med bulle";
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
</body>
</html>
