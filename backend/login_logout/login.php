<?php
session_start(); 

// verifier que l'utilisateur est connecté, si oui, le rediriger

if(isset($_SESSION ['email'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<h1>Se Connecter</h1>

<!-- si mauvais identifiants, afficher un message d'erreur simple  -->

<?php if (isset($_GET['error'])): ?>
    <p class="message-error"> Identifiants incorrects</p>
<?php endif; ?>

 <form action="login_process.php" method="POST">
    <label for="email">Adresse email :</label><br>
    <input type="email" id="email" name="email" id="email" placeholder="email" required/><br>

    <label for="mot_de_passe"> Mot de passe :</label><br>
    <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="mot de passe" required /><br>
    <button type="submit"> Se connnecter</button>
 </form>   

 <p><a href="../index.php"> Retour à l'accueil</a></p>
</body>
</html>