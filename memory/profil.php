<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:connexion.php');
}
require("config.php");
$sql = 'SELECT * FROM utilisateurs';
$request = $bdd->prepare($sql);
$request->execute();
$result = $request->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>memory</title>
</head>

<body>
    <?php include("header.php"); ?>
    <main>
        <div class="titre">
            <h1 class="bonjour"><?= 'Bonjour, ' . $_SESSION['login'] ?></h1>
            </div>
            <div class="prog">
            <p><strong>Progression</strong></br></br>
            Score : 0 point </p>
            </div>
        <div class="editprofil">
            <a href="editprofil.php"><button class="button">Editer mon profil</button></a>
            <a href="deconnexion.php"><button class="button">Se déconnecter</button></a>
        </div>
    </main>
</body>

</html>