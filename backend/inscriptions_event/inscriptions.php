<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../login_logout/login.php');
    exit;
}

require_once __DIR__ . '/../acces_insertions_DB/db.php';

$slug = trim($_GET['slug'] ?? '');

if (!$slug) {
    echo "Evènement non spécifié";
    exit;
}

// récupérer l'évènement à partir du slug 

$sql = "SELECT id, titre FROM evenements WHERE slug = :slug";
$stmt = $pdo->prepare($sql);
$stmt->execute(['slug' => $slug]);
$evenement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evenement) {
    echo "Evènement introuvable. <a href='../index.php'>Retour à l'accueil</a>";
    exit;
}
?>

<h2>S'inscrire à <?= htmlspecialchars($evenement['titre']) ?></h2>

<form action="traitement_inscriptions.php" method="POST">
    <!-- (même si on utilise le slug pour l'url, on passe l'id de l'event) -->
    <input type="hidden" name="evenement_id" value="<?= (int)$evenement['id'] ?>">

    <label for="nb_places">Nombre de participants</label>
    <input type="number" name="nb_places" id="nb_places" min="1" value="1" required>

    <button type="submit">Confirmer l'inscription</button>
</form>

<a href="../index.php"> Annuler, retour à l'accueil</a>