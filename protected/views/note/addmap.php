<?php
/* @var $this NoteController */
/* @var $note Note */
?>

<div class="addmap">

	<h5 class="text-center map-header">Place your note on the map</h5>
	<h4 class="text-center map-header"><?php echo $note->title ?></h4>
	<h5 id="location" class="text-center map-header"></h5>

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

	<div id="lat"></div>
	<div id="lng"></div>
	<br>
	<div id="lat1"></div>
	<div id="lng1"></div>
	
</div>



<script>
	$(function () {
		// Onclick menu show
		$('.map-menu-button').click(function () {
			$('.map-form').slideToggle('fast');
			$('.map-menu-button span').toggleClass('glyphicon-menu-up').toggleClass('glyphicon-menu-down');
		});

	});

	$.ajax({
		url: '//freegeoip.net/json',
		type: 'post',
		dataType: 'jsonp',
		success: function(location) {
			console.log(location);
		}
	});
	
	function getIP(json) {
		console.log(json.ip);
	};
	
	$.getJSON('https://ipinfo.io', function(data){
		console.log(data);
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

<?php if (!empty($note->lat) and ! empty($note->lng)): ?>

			savedLocation = new google.maps.LatLng(<?= $note->lat ?>, <?= $note->lng ?>);
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

		// Get current location
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				$('#location').html(pos.lat + ';' + pos.lng);
			}, function () {
				handleLocationError(true);
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false);
		}
		
	}

	function handleLocationError(browserHasGeolocation) {
		$('#location').html(browserHasGeolocation ?
				'Error: The Geolocation service failed.' :
				'Error: Your browser doesn\'t support geolocation.');
	}

	function deleteMarker() {
		marker.setVisible(false);
		document.getElementById('note-lat').value = '';
		document.getElementById('note-lng').value = '';
	}

</script>





<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPjo_cCYIkkWKcnfpPsGV4d7G5nQ5GqmA&callback=initMap"
type="text/javascript"></script>