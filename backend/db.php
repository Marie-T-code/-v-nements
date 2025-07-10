<?php
$host = 'db';
$db_name = 'evenementiel_nevers_db';
$user = 'test'; 
$password = 'test'; 

try{
    $pdo = new PDO("pgsql:host=$host; port=5432; dbname=$db_name", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch(PDOException $e) {
    die("erreur de connexion : " . $e->getMessage());
};

echo "la base de données est connectée"; 