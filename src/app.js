var mymap = L.map('mapid').setView([lat, lon], 9);
			L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>',
    			maxZoom: 18,
    			id: 'mapbox.streets'
			}).addTo(mymap);

for(let i=0; i<donneesApi.length; i++){
	let msg = "";

        if (typeof donneesApi[i].ligne1 !== 'undefined') {
            msg += donneesApi[i].ligne1+" ";
        }
        if (typeof donneesApi[i].ligne2 !== 'undefined') {
            msg += donneesApi[i].ligne2+" ";
        }
        if (typeof donneesApi[i].ligne3 !== 'undefined') {
            msg += donneesApi[i].ligne3+" ";
        }
        if (typeof donneesApi[i].ligne4 !== 'undefined') {
            msg += donneesApi[i].ligne4+" ";
        }
        if (typeof donneesApi[i].ligne5 !== 'undefined') {
            msg += donneesApi[i].ligne5+" ";
        }
        if (typeof donneesApi[i].ligne6 !== 'undefined') {
            msg += donneesApi[i].ligne6+" ";
        }
        if (typeof donneesApi[i].nature !== 'undefined') {
            msg += "</br>Nature : " + donneesApi[i].nature + "</br>";
        }
        if (typeof donneesApi[i].type !== 'undefined') {
            msg += "Type : " + donneesApi[i].type + "</br>";
        }
        if (typeof donneesApi[i].statut !== 'undefined') {
            msg += "Statut : " +donneesApi[i].statut;
        }

	L.marker([donneesApi[i].latitude, donneesApi[i].longitude]).addTo(mymap).bindPopup(msg).openPopup();

}
