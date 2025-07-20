<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../login_logout/login.php');
    exit;
}

require_once __DIR__ . '/../acces_insertions_DB/db.php';

$user_id = $_SESSION['id'];
$evenement_id = (int)($_POST['evenement_id'] ?? null);
$nb_places = (int)($_POST['nb_places'] ?? 1);

if ($evenement_id <= 0 || $nb_places <= 0) {
    echo "Données invalides.";
    exit;
}

// empêcher des inscriptions multiples pour un utilisateur 
$sql_check = "SELECT COUNT(*) FROM inscriptions WHERE user_id = :user_id AND evenement_id = :evenement_id";
$stmt_check = $pdo->prepare($sql_check); 
$stmt_check->execute([
    'user_id' =>$user_id,
    'evenement_id' => $evenement_id
]);

$deja_inscrit = $stmt_check->fetchColumn();

if($deja_inscrit > 0){
    echo "Vous êtes déjà inscrit à cet évènement <a href='../user/mes_evenements.php'>Voir mes événements</a>";
    exit; 
}

// insérer l'inscription: 

$sql = "INSERT INTO inscriptions (user_id, evenement_id, nb_places) VALUES (:user_id, :evenement_id, :nb_places)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        'user_id' => $user_id,
        'evenement_id' => $evenement_id,
        'nb_places' => $nb_places
    ]);
    echo "Inscription réussie ! <a href='../user/mes_evenements.php'> Voir mes évènements </a>";
} catch (PDOException $e) {
    echo "Erreur lors de l'inscription : "
        . $e->getMessage();
}
