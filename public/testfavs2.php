<?php
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
  <link rel="stylesheet" href="../css/officelist.css">
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
                $('#' + office_id).replaceWith('<img class="favicon" id="' + office_id + '" src="img/favon.jpg">') // Replace the image with the liked button
              } else {
               $(this).attr('method', 'Like')
               $('#' + office_id).replaceWith('<img class="favicon" id="' + office_id + '" src="img/favoff.png">')
              }
              $.ajax({
                  url: 'favs2.php', // Call favs.php to update the database
                  type: 'GET',
                  data: {user_id: user_id, office_id: office_id, method: method},
                  cache: false,
                  success: function(data){
                  }
              });
          });
      });
    </script>
  </head>

  <body>
    <?php
      

      function checkFavorite($user_id, $office_id, $conn) {
        $query = "SELECT * FROM favs WHERE user_id = '". $user_id."' AND office_id = '". $office_id."'";
                $result = $conn->query($query);
                $numrows =  $result->rowCount();
        if ($numrows == 0) {
         echo "<div class = 'button' method = 'Like'  user_id = ".$user_id." office_id = ".$office_id."> <img id=".$office_id." src='img/favoff.png'> </div>";
        }
        else {
          echo  "<div class = 'button' method = 'Unlike'  user_id = ".$user_id." office_id = ".$office_id."> <img id=".$office_id." src='img/favon.jpg'> </div>";
        }
      }
      // Query to get the user_id
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

      // Query to Get the offices ID
      $result = $conn->query("SELECT * FROM offices WHERE id = '1'");
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $office_id = $row['id'];

      echo "<p>office: ".$row['office_name']."</p> ";
      $fav_image = checkFavorite($user_id, $office_id, $conn);
      echo "Favorite? : ".$fav_image."";

      
    ?>
  </body>
</html>