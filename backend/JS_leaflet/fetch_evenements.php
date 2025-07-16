<?php
require_once __DIR__ . '/../acces_insertions_DB/db.php'; 

if (!isset($pdo)){
    die("Erreur : connexion à la base de données non établie"); 
}

header( 'Content-Type: application/json');

$sql = "SELECT id, slug, openagenda, titre, description, mots_clefs, image, im_credits, dates, type, type_geom, ST_AsGeoJSON(geom) AS geometry FROM evenements";

$query = $pdo->prepare($sql);
$query->execute();

$features = []; 

while ($row = $query->fetch(PDO::FETCH_ASSOC)){
    $geometry = $row['geometry'];

    if(is_string($geometry)){
        $geometry = json_decode($geometry, true);
    }

    unset($row['geometry']);
    $features[] = [
        "type" => "Feature",
        "geometry" => $geometry, 
        "properties" => $row
    ];
}

echo json_encode([
    "type" => "FeatureCollection",
    "features" => $features
], JSON_UNESCAPED_UNICODE);