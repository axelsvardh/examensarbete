<?php
require '../src/dbconnect.php';
include '../src/config.php';

try {

  $query = "SELECT * FROM offices WHERE id = :id;";

  $stmt = $conn->prepare($query);
  $stmt->bindValue(':id', $_GET['id']);
  $stmt->execute();
  $offices = $stmt->fetch();
}   catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
  
  try {

    $query = "SELECT * FROM office_specs WHERE office_id = :id;";
  
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $office_specs = $stmt->fetch();
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
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/officespecs.css">
  <title>Office Specs</title>
</head>
<body>

<?php foreach ($offices as $key => $office) { ?>
  <img class="img-fluid" src="<?=($offices['office_img'])?>" alt=""></img>
  <div class="p-4">
    <h2 class="text-center"><?=($offices['office_name'])?></h2>
    <p class="street text-center"><?=($offices['street'])?>, <?=($offices['postal_code'])?></p>
    <p class=""><?=($offices['description'])?></p>
  <hr class="m-4">
</div>
  <?php break; } ?>

  <?php foreach ($office_specs as $key => $officespecs) { ?>
  <h4 class="text-center">Bekvämligheter</h4>
  <br>
  <!-- LEFT COLUMN WITH INFO -->
  <div class=" container">
    <div class="row">
    <div id="officeinfo" class="col-6">
    <p class="">Storlek: <?=($office_specs['conf_kvm'])?></p>
    <p class="">Rumstyp: <?=($office_specs['room_type'])?></p>
    <p class="">Platser lediga: <?=($office_specs['room_qty'])?></p>
    <br>
    </div>
<!-- RIGHT COLUMN WITH ICONS -->
    <div id="iconcol" class="col-6">
    <p class=""><?=($office_specs['conf_wifi'])?> <?=($office_specs['conf_printer'])?> <?=($office_specs['conf_coffe'])?></p>
    
    </div>
    <a id="cardnav" href="booking.php" class="btn btn-primary mb-5">Boka</a>
    </div>
    </div>
</body>
</html>
<?php break; } ?>

<?php
include '../layout/bottomnav.php';
?>