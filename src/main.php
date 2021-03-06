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

// Alertes Info Trafic 
$alertesTrafic = file_get_contents('http://api.loire-atlantique.fr/opendata/1.0/traficevents?filter=Tous',false,$context);

// https://webetu.iutnc.univ-lorraine.fr/www/jacquem38u/circulationNantesApi/src/main.php 
// Ligne1.2.3.4.5.6 rattarchement nature type 

$html = "
<!doctype html>
<html lang=\"fr\">
	<head>
		<meta charset=\"utf-8\">
		<title>Circulation Nantes</title>
		<link rel=\"stylesheet\" href=\"style.css\">
		<link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet@1.3.1/dist/leaflet.css\" integrity=\"sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==\" crossorigin=\"\"/>
	  
		<script src=\"https://unpkg.com/leaflet@1.3.1/dist/leaflet.js\" integrity=\"sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==\" crossorigin=\"\"></script>
		<script src=\"script.js\"></script>
	
	</head>

	<body>
		<h1>Circulation de Nantes</h1>
		<div id=\"mapid\"></div>

		<script>	
			let lat = $latitudeNantes;
			let lon = $longitudeNantes;
			let donneesApi = $alertesTrafic;

		</script>
		<script src=\"app.js\">	</script>

	</body>

</html>";

echo $html;
