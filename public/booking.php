<?php
include '../layout/bottomnav.php';
require '../src/dbconnect.php';
include '../src/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/booking.css">
  <title>Booking Page</title>
</head>
<body>

<div class="wrapper d-flex row m-3">
  <div class="">
    <label for="validationDefault01" class="">Förnamn</label>
    <input type="text" class="form-control" id="validationDefault01" value="" required>
  </div>
  <div class="">
    <label for="validationDefault02" class="">Efternamn</label>
    <input type="text" class="form-control" id="validationDefault02" value="" required>
  </div>
  <div class="">
    <label for="validationDefault03" class="">E-post</label>
    <input type="text" class="form-control" id="validationDefault03" required>
  </div>
  <div class="">
    <label for="validationDefault04" class="">Kontor</label>
    <select class="form-select" id="validationDefault04" required>
      <option selected disabled value="">Välj...</option>
      <option>Norrsken</option>
      <option>KG 10</option>
    </select>
  </div>
  <div class="">
    <label for="validationDefault05" class="">Företag</label>
    <input type="text" class="form-control" id="validationDefault05" required>
  </div>
  <div class="">
    <div class="form-check m-1">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
      <label class="form-check-label" for="invalidCheck2">
      Acceptera villkor och integritetspolicy
      </label>
    </div>
  </div>
  <div class="justify-content-center">
    <button id="bookbtn" class="btn btn-primary" type="submit">Boka</button>
  </div>
</div>

</body>
</html>