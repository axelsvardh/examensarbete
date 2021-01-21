<?php
include '../layout/bottomnav.php';
include '../src/config.php';

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

<!-- CHECK IF USER IS LOGGED IN -->
<?php if (isset($_SESSION['email'])){ ?>

<form action="booking-confirmation.php" method="POST">
<div class="wrapper d-flex row m-3">
  <div class="">
    <label for="validationDefault01" class="">Förnamn</label>
    <input type="text" class="form-control" id="validationDefault01" name="first_name" value="<?=htmlentities($user['first_name'])?>" required>
  </div>
  <div class="">
    <label for="validationDefault02" class="">Efternamn</label>
    <input type="text" class="form-control" id="validationDefault02" name="last_name" value="<?=htmlentities($user['last_name'])?>" required>
  </div>
  <div class="">
    <label for="validationDefault03" class="">E-post</label>
    <input type="text" class="form-control" id="validationDefault03" name="email" value="<?=htmlentities($user['email'])?>" required>
  </div>
  <div class="">
    <label for="validationDefault03" class="">Telefonnummer</label>
    <input type="text" class="form-control" id="validationDefault04" name="phone" value="<?=htmlentities($user['phone'])?>" required>
  </div>
  <div class="">
    <label for="validationDefault06" class="">Ditt företag</label>
    <input type="text" class="form-control" id="validationDefault06" name="company" required>
  </div>
  <div class="">
    <label for="validationDefault05" class="">Kontor</label>
    <select class="form-select" id="validationDefault05" name="office" required>
      <option selected disabled value="">Välj...</option>
      <option>Norrsken</option>
      <option>KG 10</option>
    </select>
  </div>
  <div>
  <label for="validationDefault07" class="">Datum</label><br>
  <input type="date" id="validationDefault07" name="date" required>
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
  <input id="bookbtn" class="btn btn-primary" name="book" type="submit">
  </div>
</div>
</form>

<?php } else { ?>

  <form action="booking-confirmation.php" method="POST">
<div class="wrapper d-flex row m-3">
  <div class="">
    <label for="validationDefault01" class="">Förnamn</label>
    <input type="text" class="form-control" id="validationDefault01" name="first_name"  required>
  </div>
  <div class="">
    <label for="validationDefault02" class="">Efternamn</label>
    <input type="text" class="form-control" id="validationDefault02" name="last_name"  required>
  </div>
  <div class="">
    <label for="validationDefault03" class="">E-post</label>
    <input type="text" class="form-control" id="validationDefault03" name="email"  required>
  </div>
  <div class="">
    <label for="validationDefault03" class="">Telefonnummer</label>
    <input type="text" class="form-control" id="validationDefault04" name="phone"  required>
  </div>
  <div class="">
    <label for="validationDefault06" class="">Ditt företag</label>
    <input type="text" class="form-control" id="validationDefault06" name="company" required>
  </div>
  <div class="">
    <label for="validationDefault05" class="">Kontor</label>
    <select class="form-select" id="validationDefault05" name="office" required>
      <option selected disabled value="">Välj...</option>
      <option>Norrsken</option>
      <option>KG 10</option>
    </select>
  </div>
  <div>
  <label for="validationDefault07" class="">Datum</label><br>
  <input type="date"  id="validationDefault07" name="date" required>
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
  <input id="bookbtn" class="btn btn-primary" name="book" type="submit">
  </div>
</div>
</form>
<?php } 

if (isset($_POST['book'])) { ?>

<h1 class="text-center">Din bokning är bekräftad</h1>
<?php echo"hello"?>

<?php } ?>
</body>
</html>