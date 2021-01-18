<?php

$method = $_GET['method']; // Get the parameter passed in the Get
$user_id = $_GET['user_id']; // Get the parameter passed in the Get
$office_id = $_GET['office_id']; // Get the parameter passed in the Get
if ($method == "Like") {
    $query = "INSERT INTO favs (user_id, office_id) VALUES ('$user_id', '$office_id')";
  }
  else {
    $query = "DELETE FROM favs WHERE user_id = '$user_id' AND office_id = '$office_id'";
  }
?>


<?php

// $method = $_GET['method']; // Get the parameter passed in the Get
//   $user_id = $_GET['user_id']; // Get the parameter passed in the Get
//   $director_id = $_GET['director_id']; // Get the parameter passed in the Get
// if ($method == "Like") {
//     mysqli_query($conn,"INSERT INTO favs (user_id, director_id) VALUES ('$user_id', '$director_id')");
//   }
//   else {
//     mysqli_query($conn,"DELETE FROM favs WHERE user_id = '$user_id' AND director_id = '$director_id'");
//   }
?>