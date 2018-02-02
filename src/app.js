var mymap = L.map('mapid').setView([lat, lon], 9);
			L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>',
    			maxZoom: 18,
    			id: 'mapbox.streets'
			}).addTo(mymap);

for(let i=0; i<donneesApi.length; i++){
	L.marker([donneesApi[i].latitude, donneesApi[i].longitude]).addTo(mymap);
}
