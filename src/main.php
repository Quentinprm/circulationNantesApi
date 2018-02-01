<?php

// Contexte
$opts = array('http' => array('proxy' => 'www-cache:3128', "request_fulluri" => true));
$context = stream_context_create($opts);

// On récupère les coordonnées de Nantes via l'api google map sous forme de JSON
$pos = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=Nantes&key=AIzaSyCbe1PnR0JtbZBZN9mJSu_rb_0kSfsWPCQ',false,$context);
$resJson = json_decode($pos);

// On extrait la latitude et longitude du Json 
$latitudeNantes = $resJson->results[0]->geometry->location->lat;
$longitudeNantes = $resJson->results[0]->geometry->location->lng;

$html = "
<!doctype html>
<html lang=\"fr\">
	<head>
		<meta charset=\"utf-8\">
		<title>Titre de la page</title>
		<link rel=\"stylesheet\" href=\"style.css\">
		<link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet@1.3.1/dist/leaflet.css\" integrity=\"sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==\" crossorigin=\"\"/>
	  
		<script src=\"https://unpkg.com/leaflet@1.3.1/dist/leaflet.js\" integrity=\"sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==\" crossorigin=\"\"></script>
		<script src=\"script.js\"></script>
	
	</head>

	<body>
		<h1>Circulation de Nantes</h1>
		<div id=\"mapid\"></div>

		<script>
			var mymap = L.map('mapid').setView([$latitudeNnates, $longitudeNantes], 13);
			L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>',
    			maxZoom: 18,
    			id: 'mapbox.streets'
			}).addTo(mymap);

		</script>
	</body>

</html>";

echo $html;
