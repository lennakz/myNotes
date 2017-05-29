<?php
/* @var $this NoteController */
/* @var $notes Note */


//dump($notes);exit;

?>

<div class="viewmap">
	
	<h5 class="text-center map-header">All Your Notes</h5>

	<div id="map"></div>

</div>

<script>
	var array = <?= $json ?>;
	
	var map, infoWindow, marker;
	var markers = [];
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 49.258, lng: -123.194},
			zoom: 14,
			mapTypeControl: false,
			streetViewControl: false,
			rotateControl: false
		});
		
		for (var note of array) {
			var lat = parseFloat(note.lat);
			var lng = parseFloat(note.lng);
			var m = new google.maps.Marker({
				position: {lat: lat, lng: lng},
				map: map
			});
			markers.push(m);
		}
	}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPjo_cCYIkkWKcnfpPsGV4d7G5nQ5GqmA&callback=initMap" type="text/javascript"></script>

