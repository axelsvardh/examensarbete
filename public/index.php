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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/bottomnav.css">
  <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLxvMUJc1j9h0hVAFB0A5K2B3KMk_PSA0&callback=myMap&libraries=places"
    defer>
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

  <table style='border: solid 1px black;'>
    <tr><th>Id</th><th>Office</th><th>Street</th></tr>
    <?php foreach ($offices as $key => $office) { ?>
      <tr>
        <td style='width:150px;border:1px solid black;'><?=($office['id'])?></td>
        <td style='width:150px;border:1px solid black;'><?=($office['office_name'])?></td>
        <td style='width:150px;border:1px solid black;'><?=($office['street'])?></td>
      </tr>
    <?php } ?>
  </table>


  
  <?php foreach ($office_specs as $key => $officespecs) { ?>
    lat = <?=($officespecs['lat'])?>";
    lng = "<?=($officespecs['lng'])?>";
    lng = "<?=($officespecs['office_name'])?>";
    <?php } ?> 

    <!-- <div id="mapholder"></div>
      <form>
         <input type="button" onclick="getLocation();" value="Get Location"/>
      </form> -->

    
    

  
  </body>
</html>