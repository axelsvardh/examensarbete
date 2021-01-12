<?php
include '../src/config.php';
include '../layout/bottomnav.php';
include 'map-functions.php';

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
    $loggedin = 'Hitta kontoret just för dig';
} else {
    $aboveNav = "<a href='reg.php' class='list-group-item list-group-item-action border-0'>Registrera dig</a>";
    $loggedin = 'Logga in för att hitta ditt nästa kontor';
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
<div class="text-btn-con m-4">
<div>
<?php 
if( isset($_SESSION['email']) && !empty($_SESSION['email']) )
{
?>
  <h2><b>Välkommen <?=$loggedInUsername?></b></h2>

<?=$loggedin?>

<?php
}
else
{
?>
<h2><b>Din Profil</b></h2>

<?=$loggedin?>
<div class="d-grid">
  <a href="login.php" class="btn btn-primary btn-lg mt-5">Logga in</a>
</div>

<?php
} ?>
</div>
</div>
<div class="list-group rounded-0">
  <a href="#" class="list-group-item list-group-item-action border-0 mt-5 lol-auto border-radius-0">Settings</a>
  <a href="#" class="list-group-item list-group-item-action border">Policy and terms</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Help</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Sekretessinställningar</a>
  <?=$aboveNav?>
</div>
  
</body>
</html>