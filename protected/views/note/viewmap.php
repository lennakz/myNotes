<?php
/* @var $this NoteController */
/* @var $notes Note */


//dump($notes);exit;

?>

<div class="viewmap">
	
	<h5 class="text-center map-header">All Your Notes</h5>

	<div id="map"></div>
	
	<div class="note-info">
		<h4 id="title"></h4>
		<p id="updated"></p>
		<p id="description"></p>
	</div>

</div>

<script>
	var array = <?= $json ?>;
	var baseUrl = "<?= Yii::app()->request->baseUrl ?>";
	
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
		
		var icon = {
			url: baseUrl + '/images/icons/marker-icon.png', // url
			scaledSize: new google.maps.Size(30, 30), // scaled size
			origin: new google.maps.Point(0,0), // origin
			anchor: new google.maps.Point(0, 0) // anchor
		};
		
		for (var note of array) {
			var lat = parseFloat(note.lat);
			var lng = parseFloat(note.lng);
			var m = new google.maps.Marker({
				position: {lat: lat, lng: lng},
				map: map,
				icon: icon
			});
			markers.push(m);
		}
		
		markers.forEach(function(marker, index) {
			marker.addListener('click', function() {
				var note = array[index];
				marker.setIcon(baseUrl + '/images/icons/marker-icon-selected.png');
				document.getElementById('title').innerHTML = note.title;
				document.getElementById('updated').innerHTML = note.updated;
				document.getElementById('description').innerHTML = note.description;
			});
		}); 
	}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPjo_cCYIkkWKcnfpPsGV4d7G5nQ5GqmA&callback=initMap" type="text/javascript"></script>

