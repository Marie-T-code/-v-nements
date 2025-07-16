<?php
require_once __DIR__ . '/db.php';

$mot_de_passe = 'changeme123';
$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// On met à jour tous les utilisateurs qui n'ont pas encore de mot de passe
$sql = "UPDATE users SET mot_de_passe = :hash WHERE mot_de_passe IS NULL";

$stmt = $pdo->prepare($sql);
$stmt->execute(['hash' => $mot_de_passe_hash]);

echo "✅ Mots de passe par défaut appliqués à tous les utilisateurs sans mot de passe.\n";


// note : script créé à destination de la table users (avais oublie colonne mot de passe)