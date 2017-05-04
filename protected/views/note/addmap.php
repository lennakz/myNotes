
<h3 class="text-center">Place your note on the map</h3>

<div id="map"></div>


<script>
	var content = 
			'<div id="map-note">' +
				'<h3><?php echo $note->title ?></h3>' +
				'<p><?php echo $note->description ?></p>' +
				'<ul>' +
					'<?php foreach ($note->Items as $item): ?>' +
						'<li><?php echo $item->name ?></li>' +
					'<?php endforeach; ?>' +
				'</ul>' +
				'<form action="<?php echo Yii::app()->request->baseUrl ?>/note/savePosition/<?php echo $note->id ?>" method="post">' +
					'<input id="note-lat" type="hidden" name="Note[lat]">' +
					'<input id="note-lng" type="hidden" name="Note[lng]">' +
					'<button id="save-marker" type="submit" class="btn btn-success">Save</button>' +
					'<button id="delete-marker" onclick="deleteMarker()" type="reset" class="btn btn-danger">Delete</button>' +
				'</form>' +
			'</div>';
	var map, infoWindow, marker;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 14,
			mapTypeControl: false,
			streetViewControl: false,
			rotateControl: false
		});
		
		infoWindow = new google.maps.InfoWindow({
			content: content
		});
		

		google.maps.event.addListener(map, 'click', function (event) {
			marker = new google.maps.Marker({
				position: event.latLng,
				map: map
			});

			google.maps.event.addListener(marker, 'click', function () {
				infoWindow.open(map, marker);
				document.getElementById('note-lat').value = marker.getPosition().lat();
				document.getElementById('note-lng').value = marker.getPosition().lng();
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
	
	function deleteMarker() {
		marker.setMap(null);
	}

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPjo_cCYIkkWKcnfpPsGV4d7G5nQ5GqmA&callback=initMap"
type="text/javascript"></script>