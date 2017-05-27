<?php
/* @var $this NoteController */
/* @var $note Note */
?>

<div class="addmap">
	
	<h5 class="text-center map-header">Place your note on the map</h5>
	<h4 class="text-center map-header"><?php echo $note->title ?></h4>

	<div id="map"></div>
		
	<div id="map-note">
		<button class="map-menu-button"><span class="glyphicon glyphicon-menu-up"></span></button>
		<div class="map-form">
			<form action="<?php echo Yii::app()->request->baseUrl ?>/note/addmap/<?php echo $note->id ?>" method="post">
				<input id="note-lat" type="hidden" name="Note[lat]">
				<input id="note-lng" type="hidden" name="Note[lng]">
				<button id="save-marker" type="submit"><span class="glyphicon glyphicon-chevron-down"></span><span class="save-marker-text">&nbsp;&nbsp;Save</span></button>
				<button id="delete-marker" onclick="deleteMarker()" type="reset"><span class="glyphicon glyphicon-remove"></span><span class="delete-marker-text">&nbsp;&nbsp;Delete</span></button>
			</form>
		</div>
	</div>

</div>

<script>
$(function() {
	// Onclick menu show
	$('.map-menu-button').click(function() {
		$('.map-form').slideToggle('fast');
		$('.map-menu-button span').toggleClass('glyphicon-menu-up').toggleClass('glyphicon-menu-down');
	});
	
});
	
	
	
	var map, infoWindow, marker;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 49.258, lng: -123.194},
			zoom: 14,
			mapTypeControl: false,
			streetViewControl: false,
			rotateControl: false
		});
		
//		infoWindow = new google.maps.InfoWindow({
//			content: content
//		});
		
		marker = new google.maps.Marker({
			map: map,
			draggable: true
		});
		
		<?php if (!empty($note->lat) and !empty($note->lng)): ?>
				
			savedLocation = new google.maps.LatLng(<?=$note->lat?>, <?=$note->lng?>);
			marker.setPosition(savedLocation);
				
		<?php endif ?>
		
		map.addListener('click', function (event) {
			marker.setVisible(true);
			marker.setPosition(event.latLng);
			document.getElementById('note-lat').value = marker.getPosition().lat();
			document.getElementById('note-lng').value = marker.getPosition().lng();

		});
		
		//infoWindow.open(map, marker);

//		marker.addListener('click', function() {
//			infoWindow.open(map, marker);
//		});
		
//		// Get current location
//		if (navigator.geolocation) {
//			navigator.geolocation.getCurrentPosition(function (position) {
//				var pos = {
//					lat: position.coords.latitude,
//					lng: position.coords.longitude
//				};
//
//				map.setCenter(pos);
//			}, function () {
//				handleLocationError(true, infoWindow, map.getCenter());
//			});
//		} else {
//			// Browser doesn't support Geolocation
//			handleLocationError(false, infoWindow, map.getCenter());
//		}
//		
	}
//
//	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//		infoWindow.setPosition(pos);
//		infoWindow.setContent(browserHasGeolocation ?
//				'Error: The Geolocation service failed.' :
//				'Error: Your browser doesn\'t support geolocation.');
//		infoWindow.open(map);
//	}
	
	function deleteMarker() {
		marker.setVisible(false);
		marker.setPosition({lat: null, lng: null});
	}

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPjo_cCYIkkWKcnfpPsGV4d7G5nQ5GqmA&callback=initMap"
type="text/javascript"></script>