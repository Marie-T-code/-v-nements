<?php
session_start();

// si l'utilisateur est déjà connecté on le redirige 
if (isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>

<body>

    <h1>Créer un compte</h1>

    <!-- <?php if (isset($_GET['error'])): ?>
        <p class="message-error"> Erreur lors de l'inscription, veuillez vérifier vos informations</p>
    <?php endif; ?> -->

    <?php if (isset($_GET['error'])): ?>
    <p class="message-error">Erreur lors de l'inscription, veuillez vérifier vos informations</p>
<?php endif; ?>


    <form action="register_process.php" method="post">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required><br>

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label>Genre</label><br>

        <input type="radio" id="female" name="genre" value="female">
        <label for="female">Femme</label><br>

        <input type="radio" id="male" name="genre" value="male">
        <label for="male">Homme</label><br>

        <input type="radio" id="other" name="genre" value="other">
        <label for="other">Autre / Ne souhaite pas préciser</label><br><br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br>

        <label for="telephone">Téléphone :</label>
        <input type="text" name="telephone" id="telephone"><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>

        <button type="submit"> S'inscrire </button>

    </form>

</body>

</html>