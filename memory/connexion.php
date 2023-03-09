<?php
session_start();
$message = "";

require("config.php");
$request = $bdd->prepare('SELECT * FROM utilisateurs');
$request->execute();
$result = $request->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = $_POST['login'];
        $mdp = $_POST['password'];
        if ($login == $result['login'] && $mdp == $result['password']) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $result['id'];
            header('location:index.php');
        } else {
            $message = "Le login et le mot de passe ne correspendent pas !";
        }
    }
} else {
    $message = "Vous devez remplir tous les champs !";
}

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
        <div class="container">
            <h1 class="h1from">Connexion</h1>
            <form class='form1' method="POST">
                <div class="field">
                    <label>Login</label>
                    <input type="text" name="login">
                </div>
                <div class="field">
                    <label>Mot de passe</label>
                    <input type="password" name="password">
                </div>
                <a href="#">
                    <button class="button" type="submit" name="submit">Se connecter</button>
                </a>

                <div class="message"><?= $message ?></div>

            </form>
            <div class="petitmsg">
                <span>Vous n'avez pas encore de compte ? <a class="petitmsg2" href="inscription.php">Inscrivez-vous !</a></span>
            </div>
        </div>
    </main>
</body>

</html>