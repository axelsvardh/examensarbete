<?php
require '../src/dbconnect.php';

try {
  $query = "SELECT * FROM offices";
  $stmt = $conn->query($query);
  $offices = $stmt->fetchall();
  }   catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
  
  try {
    $query = "SELECT * FROM office_specs";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/officespecs.css">
  <title>Office Specs</title>
</head>
<body>

<?php foreach ($offices as $key => $office) {foreach ($office_specs as $key => $officespecs) ?>
  <img class="img-fluid" src="<?=htmlentities($office['office_img'])?>" alt="">
  <div class="p-4">
    <h2 class="text-center"><?=htmlentities($office['office_name'])?></h2>
    <p class="street text-center"><?=htmlentities($office['street'])?>, <?=htmlentities($office['postal_code'])?></p>
    <p class=""><?=htmlentities($office['description'])?></p>
  <hr class="m-4">
  <h4 class="text-center">Bekvämligheter</h4>
  <br>
    <p class="">Storlek: <?=htmlentities($officespecs['conf_kvm'])?></p>
    <p class=""><?=htmlentities($officespecs['conf_wifi'])?></p>
    <p class=""><?=htmlentities($officespecs['conf_coffe'])?></p>
    <p class="">Rumstyp: <?=htmlentities($officespecs['room_type'])?></p><br>
    <p class="">Platser lediga: <?=htmlentities($officespecs['room_qty'])?></p>
    <a id="cardnav" href="#" class="btn btn-primary">Boka</a>
    </div>
  <?php } ?>
  


</body>

<?php
include '../layout/bottomnav.php';
?>