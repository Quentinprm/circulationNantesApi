<?php

$ip = $_SERVER['HTTP_CLIENT_IP'];
$pos = file_get_contents('http://freegeoip.net/json/'.$ip);
$resJson = json_decode($pos);

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
			var mymap = L.map('mapid').setView([51.505, -0.09], 13);
			L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>',
    			maxZoom: 18,
    			id: 'mapbox.streets'
			}).addTo(mymap);

		</script>
	</body>

</html>";

echo $html;
