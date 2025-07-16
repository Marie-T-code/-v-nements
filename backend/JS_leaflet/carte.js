console.log('chemin ok carte.js loaded');

var map = L.map('map').setView([46.98, 3.15], 15);
const osm = L.titleLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    minZoom: 13, 
    maxZoom: 16,
    attribution : '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

L.control.layers(baseMaps).addTo(map);

fetch('fetch_evenements.php')
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
})