<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../login_logout/login.php');
    exit;
}

require_once __DIR__ . '/../acces_insertions_DB/db.php';

$user_id = $_SESSION['id'];
$evenement_id = $_POST['evenement_id'] ?? null;
$nb_places = $_POST['nb_places'] ?? 1;

if (!$evenement_id) {
    echo "Evènement non précisé.";
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
