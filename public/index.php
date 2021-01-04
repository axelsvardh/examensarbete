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
  
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <title>Office finder</title>
</head>
<body>

<div id="googleMap" style="width:100%;height:70%;"></div>

<!-- sökfunktion form -->
<div class="container">
  <form id="location-form">
    <input type="text" id="location-input" placeholder="Enter location" class="form-control form-control-log">
    <br>
    <button type="submit" class="btn btn-primary btn-block">submit</button>
  </form>
</div>

<!-- knapp på startsidan (visa lista) -->
<div><a href="#" class="list-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg></a></div>

  <table style='border: solid 1px black;'>
    <tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>
    <?php foreach ($users as $key => $user) { ?>
      <tr>
        <td style='width:150px;border:1px solid black;'><?=($user['id'])?></td>
        <td style='width:150px;border:1px solid black;'><?=($user['first_name'])?></td>
        <td style='width:150px;border:1px solid black;'><?=($user['last_name'])?></td>
      </tr>
    <?php } ?>
  </table>


  <script>
    function myMap() {
    var mapProp= {
      center:new google.maps.LatLng(59.341604698459555, 18.064399342823773),
      zoom:13,
      disableDefaultUI: true,
      zoomControl: true,
    };
    // const norrsken = { lat: 59.34150268741652, lng: 18.064343521174912 };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    // var marker = new google.maps.Marker({
    //   position:norrsken,
    //   title: "Norrsken"
    //   // icon:'/img/building.svg'
    // });
    
    addMarker({lat:12.34150268741652,lng:18.064343521174912})

    function addMarker(coords){
    var marker = new google.maps.Marker({
      position:coords,
      map:map,
    });
    }

  marker.setMap(map);
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLxvMUJc1j9h0hVAFB0A5K2B3KMk_PSA0&callback=myMap"></script>
</body>
</html>