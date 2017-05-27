<?php
/* @var $this NoteController */
/* @var $notes Note */
?>

<div class="viewmap">
	
	<h5 class="text-center map-header">All Your Notes</h5>

	<div id="map"></div>

</div>

<script>
	var map, infoWindow, marker;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 49.258, lng: -123.194},
			zoom: 14,
			mapTypeControl: false,
			streetViewControl: false,
			rotateControl: false
		});
		
		<?php foreach ($notes as $k => $m): ?>
			<?php if (!empty($m->lat) and !empty($m->lng)): ?>
				lat = <?php echo $m->lat ?>
				lng = <?php echo $m->lng ?>
				marker<?php echo $k ?> = new google.maps.Marker({
					position: {lat: lat, lng: lng},
					map: map
				});
			<?php endif ?>
		<?php endforeach; ?>
	}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPjo_cCYIkkWKcnfpPsGV4d7G5nQ5GqmA&callback=initMap" type="text/javascript"></script>

