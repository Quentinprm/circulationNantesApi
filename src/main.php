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
$resJsonAlertes = json_decode($alertesTrafic);
//var_dump($resJsonAlertes);

// Ligne1.2.3.4.5.6 rattarchement nature type 
$it = 0;
$arr = array();
$arr2 = array();
foreach ($resJsonAlertes as $value){
	if(isset($value->longitude) && isset($value->longitude)){
		$arr2['longitude'] = $value->longitude;
		$arr2['latitude'] = $value->latitude;
		$arr2['statut'] = $value->statut;
		$arr2['type'] = $value->type;
		$arr2['nature'] = $value->nature;
		if(isset($value->ligne1)){
			$arr2['ligne1'] = $value->ligne1;
		}
		if(isset($value->ligne2)){
			$arr2['ligne2'] = $value->ligne2;
		}
		if(isset($value->ligne3)){
			$arr2['ligne3'] = $value->ligne3;
		}
		if(isset($value->ligne4)){
			$arr2['ligne4'] = $value->ligne4;
		}
		if(isset($value->ligne5)){
			$arr2['ligne5'] = $value->ligne5;
		}
		if(isset($value->ligne6)){
			$arr2['ligne6'] = $value->ligne6;
		}
		
	}
	$arr[] = $arr2;
}

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
			var mymap = L.map('mapid').setView([$latitudeNantes, $longitudeNantes], 13);
			L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>',
    			maxZoom: 18,
    			id: 'mapbox.streets'
			}).addTo(mymap);
			
		</script>
	</body>

</html>";

echo $html;
