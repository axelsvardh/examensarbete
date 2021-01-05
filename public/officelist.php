<?php
include '../layout/bottomnav.php';
require '../src/dbconnect.php';

try {
  $query = "SELECT * FROM offices";
  $stmt = $conn->query($query);
  $offices = $stmt->fetchall();
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
  <link rel="stylesheet" href="../css/officelist.css">
  <title>Office list</title>
</head>
<body>
<?php foreach ($offices as $key => $office) { ?>
<div id="officecard" class="d-flex justify-content-center justify-content-lg-between m-4">
<div class="card shadow" style="width: 18rem;">
  <img class="card-img-top" src="<?=htmlentities($office['office_img'])?>" alt="">
  <div class="card-body">
    <h5 class="card-title"><?=htmlentities($office['office_name'])?></h5>
    <p class="card-text"><?=htmlentities($office['description'])?></p>

<div class="d-flex justify-content-between">
    <a id="cardnav" href="#" class="btn btn-primary m-2">Book</a>
    <button class="heartcard"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
</svg></button>
</div>
  </div>
  <?php } ?>
</div>
</div>
</body>
</html>