<?php
include '../src/config.php';
include '../layout/bottomnav.php';
include 'map-functions.php';
include '../layout/header.php';


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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/bottomnav.css">

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
<body class="index-body">

<!-- sökfunktion form -->
<div class="input-group">
  <input
  id="pac-input"
  class="controls"
  type="text"
  placeholder="Vart ska du?"
  />
</div>

<div id="googleMap" style="width:100%; height:100%;"></div>
  
<!-- knapp på startsidan (visa lista) -->
<!-- <div></div> -->
<a href="officelist.php" class="list-btn"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" class="bi bi-list-ul" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg></a>
  
  </body>
</html>