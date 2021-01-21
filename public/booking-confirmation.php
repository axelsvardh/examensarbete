<?php
include 'layout/bottomnav.php';
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
  <link rel="stylesheet" href="css/style.css">
  <title>Booking Page</title>

</head>
<body>


<?php
if (isset($_POST['book'])) { ?>


<div>
  <h1 class="text-center my-4">Bokningsbekräftelse</h1>
  <p class="text-center  ms-1">Tack för din bokning</p>
  <div class="ms-1">
    <p>Namn: <?=ucfirst(($_POST['first_name']))?> <?=ucfirst(($_POST['last_name']))?></p>
    <p>E-post: <?=($_POST['email'])?></p>
    <p>Telefon: <?=($_POST['phone'])?></p>
    <p>Ditt företag: <?=($_POST['company'])?></p>
    <p>Kontor: <?=($_POST['office'])?></p>
    <p>Datum: <?=($_POST['date'])?></p>
  </div>
</div>
<?php } else {
   header('Location: booking.php');
} ?>
</body>
</html>