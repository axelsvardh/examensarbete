<?php

  $method = $_GET['method'];
  $user_id = $_GET['user_id'];
  $office_id = $_GET['office_id'];

  if ($method == "Like") {
    $conn->query("INSERT INTO favs (user_id, office_id) VALUES ('$user_id', '$office_id')");
  }
  else {
    $conn->query("DELETE FROM favs WHERE user_id = '$user_id' AND office_id = '$office_id'");
  }
?>