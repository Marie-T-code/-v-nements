<?php
session_start();
require_once __DIR__ . '/../acces_insertions_DB/db.php';

// récupération et nettoyage des données 

$prenom = trim($_POST['prenom'] ?? '');
$nom = trim($_POST['nom'] ?? '');
$genre = ($_POST['genre'] ?? null);
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$mot_de_passe = $_POST['mot_de_passe'] ?? '';


// validation basique 

if (empty($prenom) || empty($nom) || empty($email) || empty($mot_de_passe)){
    header("Location: register.php?error=1"); 
    exit; 
}

// valider que le genre est correct 

$genres_valides = ['female', 'male', 'other']; 
if($genre !== null && !in_array($genre, $genres_valides)){
    header("Location: register.php?error=1"); 
    exit; 
}

// hashage du mot de passe 

$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT); 

// preparation de la requête d'insertion 

try{
    $sql = "INSERT INTO users (prenom, nom, genre, email, telephone, mot_de_passe) VALUES (:prenom, :nom, :genre, :email, :telephone,:mot_de_passe)"; 

    $stmt = $pdo->prepare($sql); 

    $stmt->execute([
        'prenom' => $prenom, 
        'nom' => $nom,
        'genre' => $genre,
        'email' => $email,
        'telephone' => $telephone,
        'mot_de_passe' => $mot_de_passe_hash
    ]);


// redirection vers le login 

    header("Location: ../login_logout/login.php");
    exit;

}catch(PDOException $e) {
    // cas de doublon email ou autre erreur 
    
    echo "Erreur : " . $e->getMessage();

    // header("Location: register.php?error=1");
    exit;
}
