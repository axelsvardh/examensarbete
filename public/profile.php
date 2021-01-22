<?php
include '../src/config.php';
include 'layout/bottomnav.php';

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
    // ucfirst() turns the first letter to a capital letter, in a string
    $loggedInUsername = htmlentities(ucfirst($user['first_name'])); 
    $aboveNav = "<a href='logout.php' class='list-group-item list-group-item-action border-0'>Logga ut</a>";
    $loggedin = "<p class='m-4'>Hitta kontoret just för dig</p>";
} else {
    $aboveNav = "<a href='reg.php' class='btn profile-btn btn-md ms-4'>Registrera dig</a>";
    $loggedin = "<p class='m-4'>Logga in för att hitta ditt nästa kontor</p>";
}

if (isset($_POST['doLogin'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        try {
            $query = "
                SELECT * FROM users
                WHERE email = :email;
            ";

            $stmt = $conn->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute(); 

            $user = $stmt->fetch(); 

        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }


        if ($user && $password === $user['password']) {

            $_SESSION['email'] = $user['email'];
            header('Location: profile.php');

            exit;
        } else {

            $msg = '<div class="error_msg">Fel inloggningsuppgifter. Var snäll och försök igen.</div>';
        }
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
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLxvMUJc1j9h0hVAFB0A5K2B3KMk_PSA0&callback=myMap&libraries=places"
    defer>
  </script>
  <title>Office finder</title>
</head>
<body>
<div class="login-container">
<div class="text-btn-con">
<div>
<?php 
if( isset($_SESSION['email']) && !empty($_SESSION['email']) )
{
?>
  <h2 class="m-4"><b>Välkommen <?=$loggedInUsername?></b></h2>

<?=$loggedin?>

<div class="list-group rounded-0">
  <a href="#" class="list-group-item list-group-item-action border-0 mt-5 form-shadow border-radius-0">Settings</a>
  <a href="#" class="list-group-item list-group-item-action border">Policy and terms</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Help</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Sekretessinställningar</a>
  <!-- lägg reg högre upp så de syns tydligare -->
  <?=$aboveNav?>
</div>

<?php
}
else
{
?>
<h2 class="m-4"><b>Din Profil</b></h2>

<?=$loggedin?>
<div class="d-grid">
  <a href="login.php" class="btn btn-lg m-4 profile-btn">Logga in</a>
</div>
<?=$aboveNav?>

<div class="list-group rounded-0">
  <a href="#" class="list-group-item list-group-item-action border-0 mt-5 form-shadow border-radius-0">Settings</a>
  <a href="#" class="list-group-item list-group-item-action border">Policy and terms</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Help</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Sekretessinställningar</a>
</div>
<?php } ?>
</div>
</div>

</body>
</html>