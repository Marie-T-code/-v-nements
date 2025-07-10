<?php
require_once 'db.php';
$json = file_get_contents(__DIR__ . '/data/users/users_cleaned.json'); 
$data = json_decode($json, true);

if(!$data || !is_array($data)){
    die ("fichier json invalide ou vide");
}

foreach ($data as $user){
    $prenom = $user['prenom']; 
    $nom = $user['nom'];
    $email = $user['email'];
    $telephone = $user['telephone'];
    $gender = $user['gender'];
    $is_admin = isset($user['is_admin']) && $user['is_admin'] === true ? 1 : 0;

    $sql = "INSERT INTO users (
    prenom, nom, email, telephone, genre, is_admin)
    VALUES(
    :prenom, :nom, :email, :telephone, :genre, :is_admin)
    ON CONFLICT (email) DO NOTHING
    ";

    $stmt = $pdo->prepare($sql);

    try{
        $stmt->execute([
        ':prenom' => $prenom,
        ':nom' => $nom,
        ':email' => $email,
        ':telephone' => $telephone,
        ':genre'=> $gender, 
        ':is_admin' => $is_admin
        ]);
    } catch (PDOException $e) {
        echo" erreur d'insertion d'un utilisateur : " . $e->getMessage();
    }

}

echo "les utilisateurs sont insérés";