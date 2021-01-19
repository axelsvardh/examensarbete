<?php
include '../src/config.php';
include '../layout/bottomnav.php';
    
    if (!isset($_SESSION['email'])) {
	    header("location: #");
	    }

		try {
			$query = "SELECT offices.office_name, office_specs.rating, offices.office_img, offices.id, office_specs.conf_wifi,office_specs.conf_printer
			FROM ((offices
			INNER JOIN office_specs ON offices.id = office_specs.office_id)
			INNER JOIN favs ON favs.id = favs.office_id);
			$stmt = $conn->query($query);
			$office_specs = $stmt->fetchall();
			}   catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
        
    try {
    
    $query = "SELECT * FROM users 
              WHERE email = :email;";
    $stmt = $conn->prepare($query);
    $stmt->bindvalue(':email', $_SESSION['email']);
    $stmt->execute();
    $user = $stmt->fetch();
		} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
       }
    

       try {

    $query = "SELECT * FROM favs WHERE user_id = :id";
            
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $user['id']);
    $stmt->execute();
    $favs = $stmt->fetchall();
}   catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
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

<?php foreach ($office_specs as $key => $office) { ?>
<div id="officecard" class="d-flex justify-content-center justify-content-lg-between mb-3">
  <div class="card shadow" style="width: 21rem;">
    <img class="card-img-top" src="<?=htmlentities($office['office_img'])?>" alt="">
     <div class="card-body">
      <h5 class="card-title"><a class="titellink" href="officespecs.php?id=<?=$office['id']?>"><?=($office['office_name'])?></a></h5>
       
<!--- CONF ICONS START --->
<hr>
<div class="d-flex justify-content-end">
      <p class=""><?=($office['conf_wifi'])?></p>
      <p class="p-2"><?=($office['conf_printer'])?></p>
</div>

<!--- CONF ICONS END --->
        <div class="d-flex justify-content-between">
            <p class="mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#f29a01" class="bi bi-star-fill" viewBox="0 0 16 16">
           <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg> <?=($office['rating'])?></p>
            
            </button>               
    <?php
    $office_id = $office['id'];
    $fav_image
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

