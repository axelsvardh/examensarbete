<?php
include '../layout/bottomnav.php';
include '../src/config.php';


try {
  $query = "SELECT * FROM offices";
  $stmt = $conn->query($query);
  $offices = $stmt->fetchall();
  }   catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }

  try {
    $query = "SELECT offices.office_name, office_specs.rating, offices.office_img, offices.id, offices.description, office_specs.conf_wifi,office_specs.conf_printer,office_specs.room_type
    FROM offices
    LEFT JOIN office_specs ON offices.id = office_specs.office_id
    ORDER BY offices.office_name
    ";
    $stmt = $conn->query($query);
    $office_specs = $stmt->fetchall();
    }   catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

    function checkFavorite($user_id, $office_id, $conn) {
      $query = "SELECT * FROM favs WHERE user_id = '". $user_id."' AND office_id = '". $office_id."'";
      $result = $conn->query($query);
      $numrows =  $result->rowCount();
    if ($numrows == 0) {
      echo "<div class = 'button' method = 'Like'  user_id = ".$user_id." office_id = ".$office_id."> <img id=".$office_id." src='img/heart.png' width='30'> </div>";
      }
    else {
        echo  "<div class = 'button' method = 'Unlike'  user_id = ".$user_id." office_id = ".$office_id."> <img id=".$office_id." src='img/heart-fill.png' width='30'   > </div>";
      }
    }

    //DECLARE OFFICE ID AND USER ID 
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
      $user_id = ($user['id']); 
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
  <link rel="stylesheet" href="../css/officelist.css">
  <script src="https://www.w3schools.com/lib/w3.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($){
          $('.button').on('click', function(e){
              e.preventDefault();
              var user_id = $(this).attr('user_id'); // Get the parameter user_id from the button
              var office_id = $(this).attr('office_id'); // Get the parameter office_id from the button
              var method = $(this).attr('method');  // Get the parameter method from the button
              if (method == "Like") {
                $(this).attr('method', 'Unlike') // Change the div method attribute to Unlike
                $('#' + office_id).replaceWith('<img class="favicon" id="' + office_id + '" src="img/heart-fill.png" width="30">') // Replace the image with the liked button
              } else {
              $(this).attr('method', 'Like')
              $('#' + office_id).replaceWith('<img class="favicon" id="' + office_id + '" src="img/heart.png" width="30">')
              }
              $.ajax({
                  url: 'favs.php', // Call favs.php to update the database
                  type: 'GET',
                  data: {user_id: user_id, office_id: office_id, method: method},
                  cache: false,
                  success: function(data){
                  }
              });
          });
      });
  </script>
  <title>Office list</title>
</head>
<body>
<!--- HEADER INCLUDED NAVBAR --->
<div class="headnav">
<nav class="navbar navbar-light justify-content-around mb-4 pt-4">
  <form class="form-inline d-flex">
    <input type="text" class="form-control searchbar-style" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
  </form>
</nav>
</div>
<!--- HEADER INCLUDED NAVBAR END --->
<div id="id01">
<?php foreach ($office_specs as $key => $office) { ?>
<section id="section">
  <div id="officecard" class="d-flex justify-content-center justify-content-lg-between mb-3 office" >
    <div class="card shadow" style="width: 21rem;">
      <img class="card-img-top" src="<?=htmlentities($office['office_img'])?>" alt="">
      <div class="card-body">
        <h5 class="card-title" id="filter<?=$office['id']?>"><a class="titellink" href="officespecs.php?id=<?=$office['id']?>"><?=($office['office_name'])?></a></h5>
        <p class="card-text"><?=($office['room_type'])?></p>
        

  <!--- CONF ICONS START --->
  <hr>
  <div class="d-flex justify-content-end">
        <p class=""><?=($office['conf_wifi'])?></p>
        <p class="p-2"><?=($office['conf_printer'])?></p>
  </div>

  <!--- CONF ICONS END --->
          <div class="d-flex justify-content-between">
              <p class="mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="26" fill="#f29a01" class="bi bi-star-fill" viewBox="0 0 21 21">
            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg> <?=($office['rating'])?></p>
              
              </button>               
      <?php
      if (isset($_SESSION['email'])) {  
      $office_id = $office['id'];
      $fav_image = checkFavorite($user_id, $office_id, $conn);
      $fav_image;   
    }
      ?>
      </div>
        </div>
      </div>
    </div>  
  </section>
<?php } ?>
</div>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("id01");
  tr = table.getElementsByTagName("section");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("h5")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
</html>