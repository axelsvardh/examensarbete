<?php
include '../src/config.php';
include '../layout/bottomnav.php';
include 'map-functions.php';


// try {
//   $query = "SELECT * FROM office_specs";
//   $stmt = $conn->query($query);
//   $office_specs = $stmt->fetchall();
//   }   catch (\PDOException $e) {
//   throw new \PDOException($e->getMessage(), (int) $e->getCode());
//   }

try {
  $query = "SELECT offices.office_name, offices.office_img, offices.id, offices.description, office_specs.rating, office_specs.lat, office_specs.lng
  FROM offices
  INNER JOIN office_specs ON offices.id = office_specs.office_id;";
  $stmt = $conn->query($query);
  $office_specs = $stmt->fetchall();
  }   catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }

function checkFavorite($user_id, $office_id, $conn) {
    $query = "SELECT * FROM favs WHERE user_id = '". $user_id."' AND office_id = '". $office_id."'";
    $result = $conn->query($query);
    $numrows =  $result->rowCount();
  if ($numrows == 0) {
     echo "<div class = 'button' method = 'Like'  user_id = ".$user_id." office_id = ".$office_id."> <img id=".$office_id." src='img/favoff.png'> </div>";
    }
  else {
      echo  "<div class = 'button' method = 'Unlike'  user_id = ".$user_id." office_id = ".$office_id."> <img id=".$office_id." src='img/favon.jpg'> </div>";
    }
  }

  if (isset($_SESSION['email'])){
    try {
    $query = "SELECT * FROM users 
              WHERE email = :email;";
    $stmt = $conn->prepare($query);
    $stmt->bindvalue(':email', $_SESSION['email']);
    $stmt->execute();
    $user = $stmt->fetch();
  }   catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
                      }}

  if (isset($_SESSION['email'])) {
    $user_id = ($user['id']); 
  }


  $query = "SELECT * FROM users";
  $result = $conn->query($query);
  $row = $result->fetch(PDO::FETCH_ASSOC);
      
// Query to Get the office ID
  $query = "SELECT * FROM offices";
  $result = $conn->query($query);
  $row = $result->fetch(PDO::FETCH_ASSOC);
  $office_id = $row['id'];
echo "<p>office: ".$row['office_name']."</p> ";
  $fav_image = checkFavorite($user_id, $office_id, $conn);
  echo "Favorite : ".$fav_image."";



    



    
//     $result = $conn->query("SELECT * FROM user WHERE name = 'Henrique'");
//       $row = $result->fetch_assoc();
//       $user_id = $row['id'];
// // Query to Get the Director ID
//       $result = $conn->query("SELECT * FROM director WHERE name = 'Donal'");
//       $row = $result->fetch_assoc();
//       $director_id = $row['id'];
// echo "<p>Director: ".$row['name']."</p> ";
//       $fav_image = checkFavorite($user_id, $director_id, $conn);
//       echo "Favorite? : ".$fav_image."";
    
  if (isset($_GET['logout'])) {
    $msg = '<br><div class="alert alert-success">Du har loggat ut</div>';
  }else {
    $msg = '';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/bottomnav.css">

  <link rel="stylesheet" href="../css/welcome.css">



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->

  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLxvMUJc1j9h0hVAFB0A5K2B3KMk_PSA0&callback=myMap&libraries=places"
    defer>
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($){
        $('.button').on('click', function(e){
            e.preventDefault();
            var user_id = $(this).attr('user_id'); // Get the parameter user_id from the button
            var office_id = $(this).attr('office_id'); // Get the parameter office_id from the button
            var method = $(this).attr('method');  // Get the parameter method from the button
            if (method == "Like") {
              $(this).attr('method', 'Unlike') // Change the div method attribute to Unlike
              $('#' + office_id).replaceWith('<img class="favicon" id="' + office_id + '" src="img/favon.jpg">') // Replace the image with the liked button
            } else {
             $(this).attr('method', 'Like')
             $('#' + office_id).replaceWith('<img class="favicon" id="' + office_id + '" src="img/favoff.png">')
            }
            $.ajax({
                url: 'favs.php', // Call favs.php to update the database
                type: 'GET',
                data: {user_id: user_id, office_id: office_id, method: method},
                cache: false,
                success: function(data){
                }
            });
        });
    });
</script>
  <title>Office finder</title>
</head>
<body>

<!-- sökfunktion form -->
<div class="input-group">
  <input
  id="pac-input"
  class="controls"
  type="text"
  placeholder="Vart ska du?"
  />
</div>

<div id="googleMap" style="width:100%;height:80%;"></div>
  
<!-- knapp på startsidan (visa lista) -->
<!-- <div></div> -->
<a href="officelist.php" class="list-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg></a>

  <?=$msg?>

  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694L1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
  <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
</svg>

<i class="bi bi-building"></i>

  <!-- <table style='border: solid 1px black;'>
    <tr><th>Id</th><th>Office</th><th>Street</th></tr>
    <?php foreach ($offices as $key => $office) { ?>
      <tr>
        <td style='width:150px;border:1px solid black;'><?=($office['id'])?></td>
        <td style='width:150px;border:1px solid black;'><?=($office['office_name'])?></td>
        <td style='width:150px;border:1px solid black;'><?=($office['street'])?></td>
      </tr>
    <?php } ?>
  </table>

<!-- FILTRERING  -->

<!-- <div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <div id="myBtnContainer">
    <?php foreach ($office_specs as $key => $officespecs) { ?>
      <input type="checkbox" class="btn" onclick="filterSelection('<?=($officespecs['conf_wifi'])?>')" value="Wifi">
      <input type="checkbox" class="btn" onclick="filterSelection('animals')" value="Animals">
      <input type="checkbox" class="btn" onclick="filterSelection('fruits')" value="Fruits">
      <input type="checkbox" class="btn" onclick="filterSelection('colors')" value="Colors">
    </div>
    <?php } ?>
    <div class="container"> 
        <?php foreach ($office_specs as $key => $officespecs) { ?>
      <div class="filterDiv wifi"><p><?=($officespecs['conf_kvm'])?></p></div>
      <div class="filterDiv colors fruits">Orange</div>
      <div class="filterDiv cars">Volvo</div>
      <div class="filterDiv colors">Red</div>
      <div class="filterDiv cars animals">Mustang</div>
      <div class="filterDiv colors">Blue</div>
      <div class="filterDiv animals">Cat</div>
      <div class="filterDiv animals">Dog</div>
      <div class="filterDiv fruits">Melon</div>
      <div class="filterDiv fruits animals">Kiwi</div>
      <div class="filterDiv fruits">Banana</div>
      <div class="filterDiv fruits">Lemon</div>
      <div class="filterDiv animals">Cow</div>
        <?php } ?>
    </div>
  </div>
</div> -->
  
  <?php foreach ($office_specs as $key => $officespecs) { ?>
    lat = "<?=($officespecs['lat'])?>";
    lng = "<?=($officespecs['lng'])?>";
    lng = "<?=($officespecs['office_name'])?>";
    <?php } ?>  -->

    <!-- FILTRERING -->
    

    <?php 
    include ('welcome.php')
    ?>

<script src="js/functions.js"></script>


<!-- <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it


function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
};
</script> -->
  

  </body>
</html>