<?php
session_start();
require_once __DIR__ . '/../acces_insertions_DB/db.php';

// recupération des données du formulaire: 

$email = trim($_POST['email'] ?? '');
$mot_de_passe = trim($_POST['mot_de_passe'] ?? '');

// verification que les champs ne sont pas vides 

if (empty($email) || empty($mot_de_passe)) {
    header("Location: login.php?error=1");
    exit;
}

// requête pour trouver l'utilisateur 

$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// verification si utilisateur est trouvé ET mdp est correct 4

if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
    // alors stocke les infos utile en session 
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['prenom'] = $user['prenom'];
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['genre'] = $user['genre'];
    $_SESSION['is_admin'] = filter_var($user['is_admin'], FILTER_VALIDATE_BOOLEAN);

    // rediriger vers la page principale 
    header('Location: ../index.php');
    exit;
} else {
    // echec de connexion, rediriger avec erreur 
    header('Location: login.php?error=1');
    exit;
}
