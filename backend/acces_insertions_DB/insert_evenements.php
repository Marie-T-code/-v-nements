<?php

require_once 'db.php'; 

$base_path = __DIR__ . '/../data/geojson/';

// $base_path : où aller chercher les fichiers 

$files = [
    'evenements_points.geojson', 
    'evenements_lignes.geojson',
    'evenements_polys.geojson',
]; 
// $files est un tableau avec des valeurs préparées qu'on utilisera dans le forEach


foreach ($files as $filename){
$geojson = file_get_contents($base_path . $filename);
// il n'y a pas de lien entre base_path et filename, MAIS on se sert des variables stockées pour créer le chemin qui va mener au fichier
$data = json_decode($geojson, true); 


    if (!$data || !isset($data['features'])) {
        echo"Fichier GeoJSON invalide ou vide : $filename";
        // $filename permet de savoir quel fichier pose problème 
        continue; 
        // continue évite de tuer tout le script 
    }

   foreach ($data['features'] as $feature){
    $props = $feature['properties']; 
    $geom = $feature['geometry']; 

            $sql = "INSERT INTO evenements (slug, openagenda, titre, description, mots_clefs, image, im_credits, dates, type, type_geom, geom) 
            VALUES (
            :slug, :openagenda, :titre, :description, :mots_clefs, :image, :im_credits, :dates, :type, :type_geom, ST_SetSRID(ST_GeomFromGeoJSON(:geom), 4326)
            )
            ON CONFLICT (slug) DO NOTHING"; 

            $stmt = $pdo->prepare($sql);

            try {
                $stmt->execute([
                ':slug' => $props['slug'] ?? null,
                ':openagenda' => $props['canonicalur'] ?? null,
                ':titre'=> $props['title_fr'] ?? null,
                ':description' => $props['description'] ?? null,
                ':mots_clefs' => is_array($props['keywords_fr']) ? implode(', ', $props['keywords_fr']) : ($props['keywords_fr'] ?? null),
                ':image' => $props['image'] ?? null,
                ':im_credits'=> $props['imagecredits'] ?? null,
                ':dates' => $props['daterange_f'] ?? null,
                ':type' => $props['type'] ?? null,
                ':type_geom' => $props['type_geom'] ?? null,
                ':geom' => json_encode($geom)
            ]);
            } 
            catch (PDOException $e) {
                echo "erreur d'insertion d'un évènement dans $filename : " . $e->getMessage();
            }
            
   }
}


echo "toutes les entités sont insérées";




