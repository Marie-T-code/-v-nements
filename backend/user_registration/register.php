<?php
session_start(); 

// si l'utilisateur est déjà connecté on le redirige 
if (isset($_SESSION['id'])){
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

<?php if(isset($_GET['error'])): ?>
    <p class="message-error"> Erreur lors de l'inscription, veuillez vérifier vos informations</p>
<?php endif; ?>




</body>
</html>