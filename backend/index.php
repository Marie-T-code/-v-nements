<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nevers Evènements</title>
    <link rel="stylesheet" href="/CSS/carte.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
</head>

<body>
<header>
    <div class="login">
       <?php if (!isset($_SESSION['email'])): ?>
            <a class="login-btn" href="login_logout/login.php">Se connecter</a>
        <?php else: ?>
            <p> Bienvenue <?= htmlspecialchars($_SESSION['prenom'])?> !</p>
            <?php if ($_SESSION['is_admin']) echo "<p>Vous êtes administrateur.rice</p>"; ?>
            <a class="logout-btn" href="login_logout/logout.php">Déconnexion</a>
        <?php endif; ?>
    </div>
</header>


<div id="map">

</div>

</body>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<script src="JS_leaflet/carte.js"></script>
</html>