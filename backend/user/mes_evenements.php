<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../login_logout/login.php');
    exit;
}

require_once __DIR__ . '/../acces_insertions_DB/db.php';

$user_id = $_SESSION['id'];

$sql = "SELECT e.titre, e.description, e.dates, i.nb_places, i.date_inscription 
        FROM inscriptions i
        JOIN evenements e ON e.id = i.evenement_id
        WHERE i.user_id = :user_id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo"<h2>Mes inscriptions aux événements</h2>
<p><a href='../index.php'>← Retour à l'accueil</a></p>"; 

if (count($evenements) === 0) {
    echo "<p>Vous n'êtes inscrit à aucun événement.</p>";
} else {
    echo "<table border='1'>";
    echo "<tr><th>Nom</th><th>Description</th><th>Date</th><th>Participants</th><th>Inscrit le</th></tr>";
    foreach ($evenements as $event) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($event['titre']) . "</td>";
        echo "<td>" . htmlspecialchars($event['description']) . "</td>";
        echo "<td>" . htmlspecialchars($event['dates']) . "</td>";
        echo "<td>" . htmlspecialchars($event['nb_places']) . "</td>";
        echo "<td>" . date('d/m/Y', strtotime($event['date_inscription'])) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
