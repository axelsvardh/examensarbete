<?php
require '../src/dbconnect.php';

try {					
$first_name  = '';
$query = "SELECT * FROM users ";
$stmt = $conn->query($query);
$users = $stmt->fetchall();
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
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<title>Document</title>
</head>
<body>

<div id="dudelmap" style="width:100%;height:70%;"></div>

<!-- sökfunktion form -->
<div class="container">
  <form id="location-form">
    <input type="text" id="location-input" placeholder="Enter location" class="form-control form-control-log">
    <br>
    <button type="submit" class="btn btn-primary btn-block">submit</button>
  </form>
<div class="card-block" id="formatted-address"></div>
<div class="card-block" id="address-components"></div>
<div class="card-block" id="geometry"></div>
</div>


<script>
		// get location form
    var locationForm = document.getElementById('location-form');

    // // listen for submit
    locationForm.addEventListener('submit', geocode);

    // function initmap(){
		// 	var options = {
		// 		zoom:8,
		// 		center:${lat},${lng}
		// 	}

		// 	var map = new google.maps.Map(document.getElementById('map'), options);


    // //   addMarker({lat:${office_street},lng:18.064343521174912})

    // //   function addMarker(coords){
    // //   var marker = new google.maps.Marker({
    // //     position:coords,
    // //     map:map,
    // //   });
    // // }
		// }

    function geocode(e){
      e.preventDefault();
      // call geocode
      
    var location = document.getElementById('location-input').value;
      axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
        params:{
          address: location,
          key: 'AIzaSyDLxvMUJc1j9h0hVAFB0A5K2B3KMk_PSA0'
        }
      })
      .then(function(response){
        console.log(response);

				// formatted address
				var formattedAddress = response.data.results[0].formatted_address;
				var formattedAddressOutput = `
					<ul class="list-group">
						<li class="list-group-item">${formattedAddress}</li>
					</ul>
				`;

				// address com
				var addressComponents = response.data.results[0].address_components;
				var addressComponentsOutput = '<ul class="list-group">';
				for(var i = 0;i < addressComponents.length;i++){
					addressComponentsOutput += `
						<li class="list-group-item"><strong>
						${addressComponents[i].types[0]}</strong>: ${addressComponents[i].long_name}</li>
					`;
				}
				addressComponentsOutput += '</ul>'

				// geometry function
				var lat = response.data.results[0].geometry.location.lat;
				var lng = response.data.results[0].geometry.location.lng;
				var geometryOutput = `
					<ul class="list-group">
						<li class="list-group-item">${lat}</li>
					</ul>
					<ul class="list-group">
						<li class="list-group-item">${lng}</li>
					</ul>
				`;

				// App Output
				document.getElementById('formatted-address').innerHTML = formattedAddressOutput;
				document.getElementById('address-components').innerHTML = addressComponentsOutput;
				document.getElementById('geometry').innerHTML = geometryOutput;
      })
      .catch(function(error){
        console.log(error);
      });  
    };
    

    

	</script>

  <table style='border: solid 1px black;'>
  <tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>
  <?php foreach ($users as $key => $user) { ?>
   
  <td style='width:150px;border:1px solid black;'><?=($user['id'])?></td>
  <td style='width:150px;border:1px solid black;'><?=($user['first_name'])?></td>
  <td style='width:150px;border:1px solid black;'><?=($user['last_name'])?></td>
  <br>
  <?php } ?>
  <tr>
  <tr>
  
	</table>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLxvMUJc1j9h0hVAFB0A5K2B3KMk_PSA0&callback=myMap"></script>
</body>
</html>