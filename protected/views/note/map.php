

<div id="map"></div>
<div id="map-note">
	<h3><?php echo $note->title ?></h3>
	<p><?php echo $note->description ?></p>
	<ul>
		<?php foreach ($note->Items as $item): ?>
			<li><?php echo $item->name ?></li>
		<?php endforeach; ?>
	</ul>
</div>

<script>
	var map, infoWindow, marker;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 14
		});
		
		infoWindow = new google.maps.InfoWindow({
			content: document.getElementById('map-note')
		});
		
		google.maps.event.addListener(map, 'click', function (event) {
			marker = new google.maps.Marker({
				position: event.latLng,
				map: map
			});
			
			google.maps.event.addListener(marker, 'click', function () {
				infoWindow.open(map, marker);
				marker.getPosition().lat()
			});
		});
		// Get current location
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				map.setCenter(pos);
			}, function () {
				handleLocationError(true, infoWindow, map.getCenter());
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, map.getCenter());
		}
		
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
				'Error: The Geolocation service failed.' :
				'Error: Your browser doesn\'t support geolocation.');
		infoWindow.open(map);
	}

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPjo_cCYIkkWKcnfpPsGV4d7G5nQ5GqmA&callback=initMap"
type="text/javascript"></script>