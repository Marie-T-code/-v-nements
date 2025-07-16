console.log('chemin ok carte.js loaded');

var map = L.map('map').setView([46.99, 3.157], 15);
const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    minZoom: 13, 
    maxZoom: 18,
    attribution : '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


fetch('/JS_leaflet/fetch_evenements.php')
.then(response => {
    if(!response.ok){
        throw new Error(`erreur HTTP: ${response.status}`);
    }
    return response.json(); 
})
.then(data => {
    console.log('données reçues:', data);
    console.log('Type de data:', typeof data);
    console.log('data.features:', data.features);

    if(!data.features || data.features.length === 0){
        console.warn('aucune donnée trouvée'); 
        alert('aucun evènement trouvé');
        return;
    }

    const markers = L.markerClusterGroup();
    
    
    const geojsonLayer = L.geoJSON(data, {
        pointToLayer: function(feature, Latlng){
            return L.marker(Latlng);
        }, 

        onEachFeature: function (feature, layer){
            const nom = feature.properties.titre || 'sans nom'; 
            const description = feature.properties.description || ''; 
            const dates = feature.properties.dates || 'aucune date fournie'; 
            const photo = feature.properties.image || 'inconnu'; 

            let imgHTMLPhoto = ''; 
            if (photo && photo !== 'inconnu') {
                imgHTMLPhoto = `<img src="${photo}" alt="Image de ${nom}"
                class="popup-img">`;
            }

            const popupContent = `
                <div class="popup-content">
                <h3>${nom}</h3>
                <p>${description}</p>
                <p>${dates}</p>
                ${imgHTMLPhoto}
                </div>
            `;

            layer.bindPopup(popupContent); 
        }
    });

    markers.addLayer(geojsonLayer); 

    map.addLayer(markers); 
})
.catch(error => console.error('Erreur de chargement GeoJson :', error)); 