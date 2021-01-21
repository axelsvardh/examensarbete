<?php
include '../layout/bottomnav.php';
include '../src/config.php';


    
if (isset($_SESSION['email'])) {
      try {
      $query = "SELECT * FROM users 
                WHERE email = :email;
                ";
      $stmt = $conn->prepare($query);
      $stmt->bindvalue(':email', $_SESSION['email']);
      $stmt->execute();
      $user = $stmt->fetch();
      } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
         }
         
          $user_id = ($user['id']); 
          

		try {
			$query = "SELECT offices.office_name, office_specs.rating, offices.office_img, offices.id,office_specs.conf_wifi, office_specs.conf_printer, favs.user_id, favs.office_id, offices.description
			FROM ((offices
			INNER JOIN office_specs ON offices.id = office_specs.office_id)
      INNER JOIN favs ON offices.id = favs.office_id)
      WHERE user_id = :id
      ";
			$stmt = $conn->prepare($query);
      $stmt->bindValue(':id', $user['id']);
      $stmt->execute();
      $favs = $stmt->fetchall();
      $numrows =  $stmt->rowCount();
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

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../css/officelist.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
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
  <title>Office finder</title>
</head>
<body>

<p class="h1 text-center my-3">Dina favoritkontor</p class="h1 align-center">
<?php
    
// IF NO FAVORITE OFFICES - SHOW THIS MESSAGE INSTEAD
    if (isset($_SESSION['email']) && $numrows == 0) {
      echo "<div class='d-flex align-items-center justify-content-center' style='height:100%;'><p class='h3   my-3'>Du har inga favoritkontor ännu</p class='h1 align-center'></div>";
      } else if (!isset($_SESSION['email'])) {
      echo "<div class='d-flex align-items-center justify-content-center' style='height:100%;'><p class='h3   my-3'>Logga in för att se dina favoritkontor</p class='h1 align-center'></div>";
      }


      if (isset($_SESSION['email'])){
?>

<?php foreach ($favs as $key => $favs) { ?>
<div id="officecard" class="d-flex justify-content-center justify-content-lg-between mb-3">
  <div class="card shadow" style="width: 21rem;">
    <img class="card-img-top" src="<?=htmlentities($favs['office_img'])?>" alt="">
     <div class="card-body">
      <h5 class="card-title"><a class="titellink" href="officespecs.php?id=<?=$favs['id']?>"><?=($favs['office_name'])?></a></h5>
      <p class=""><?=($offices['description'])?></p>


       
<!--- CONF ICONS START --->
<hr>
<div class="d-flex justify-content-end">
      <p class=""><?=($favs['conf_wifi'])?></p>
      <p class="p-2"><?=($favs['conf_printer'])?></p>
</div>

<!--- CONF ICONS END --->
    <div class="d-flex justify-content-between">
      <p class="mt-1">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#f29a01" class="bi bi-star-fill" viewBox="0 0 21 21">
     <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
      </svg> <?=($favs['rating'])?></p>
        </button>               
    <?php
    if (isset($_SESSION['email'])) {  
      $office_id = $favs['id'];
      $fav_image = checkFavorite($user_id, $office_id, $conn);
      $fav_image;
	    }
    ?>
    </div>
      </div>
    </div>
  </div>  
<?php } ?>

			</tbody>
		</table>
			</tbody>
        </table>
    </div>  

    <?php } ?>