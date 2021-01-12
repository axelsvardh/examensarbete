<?php
try {
  $query = "SELECT offices.office_name, offices.office_img, offices.id, offices.description, office_specs.rating, office_specs.lat, office_specs.lng
  FROM offices
  INNER JOIN office_specs ON offices.id = office_specs.office_id;";
  $stmt = $conn->query($query);
  $office_specs = $stmt->fetchall();
  }   catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
?>

<script type="text/javascript">


// GOOGLE MAPS SEARCH BOX

function myMap() {
  const map = new google.maps.Map(document.getElementById('googleMap'), {
    center: {lat: 59.3411845, lng: 18.0646734},
    zoom: 15,
    mapTypeId: 'roadmap',
    disableDefaultUI: true,
    zoomControl: true,
  })
  // Create the search box and link it to the UI element.
  const input = document.getElementById('pac-input')
  const searchBox = new google.maps.places.SearchBox(input)
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input)
  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', () => {
    searchBox.setBounds(map.getBounds())
  })
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', () => {
    const places = searchBox.getPlaces()

    if (places.length == 0) {
      return
    }
    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds()
    places.forEach((place) => {
      if (!place.geometry) {
        console.log('Returned place contains no geometry')
        return
      }
      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      }
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport)
      } else {
        bounds.extend(place.geometry.location)
      }
    })
    map.fitBounds(bounds)
  })

  
  


    var markers = [
      <?php foreach ($office_specs as $key => $officespecs) { ?>
        lat = "<?=($officespecs['lat'])?>",
        lng = "<?=($officespecs['lng'])?>",
        {
        coords:{lat:parseFloat(lat),lng:parseFloat(lng)},
        content:'<?=($officespecs['office_name'])?>'
      },
      <?php } ?>
    ];

    for(var i = 0;i < markers.length;i++){
      // Add marker
      addMarker(markers[i]);
    }
    // var marker = new google.maps.Marker({
      // position:new google.maps.LatLng(props.coords), 
    // Add Marker Function
    
    function addMarker(props){
      var image = 'img/office-building (2).png';
      var marker = new google.maps.Marker({
        position:new google.maps.LatLng(props.coords),
        map:map,
        icon: {
          url: image,
          scaledSize: new google.maps.Size(30, 30)

        }
      }); 

      // Check for customicon
      // if(props.icon){
      //   // Set icon 
      //   marker.setIcon(props.icon);
      // }

      

      // Check content
      if(props.content){
        var infoWindow = new google.maps.InfoWindow({
          content:props.content,
          
        });

        marker.addListener('click', function(){
          infoWindow.open(map, marker);
        });
      }
    }


    
  const locationButton = document.createElement("button");
  locationButton.textContent = "Visa min position";
  locationButton.classList.add("custom-map-control-button", "btn", "btn-outline-primary", "geo-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
          
          map.setCenter(pos);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  
}

</script>