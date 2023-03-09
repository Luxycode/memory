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
$message = "";
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
    <main class="bienvenue">

        <?php
        if (isset($_POST['enregistrer'])) {
            if (!empty($_POST['login'])) {
                $login = !empty($_POST['login']) ? $_POST['login'] : $_SESSION['login'];
                var_dump($login);
                var_dump($_SESSION);
                $log = $_SESSION['login'];
                $request = $bdd->prepare("UPDATE utilisateurs SET login = :login WHERE id = :id");
                $request->execute(["login" => $login, "id" => $_SESSION['id']]);
                $_SESSION['login'] = $login;
                header('refresh:0');
            }
            if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
                if ($_POST['password1'] == $_POST['password2']) {
                    $mdp = $_POST['password1'];
                    $sql = "UPDATE utilisateurs SET password = ? WHERE id = ?";
                    $request = $bdd->prepare($sql);
                    $request->execute([$mdp, $id]);
                    $result = $request->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $message = "Les deux mots de passe ne sont pas identiques !";
                }
            } else {
                $message = "Il faut remplir tous les champs de mot de passe !";
            }
        }

        ?>
        <div class="container">
            <h1 class="h1from">Modifier le Profil</h1>

            <form class='form1' method="POST">
                <div class="field">
                    <label>Login </label>
                    <input type="text" name="login" placeholder="<?php echo $_SESSION['login']; ?>">
                </div>

                <div class="field">
                    <label>Mot de passe</label>
                    <input type="password" name="password1">
                </div>

                <div class="field">
                    <label>Confirmez le mot de passe</label>
                    <input type="password" name="password2">
                </div>

                <div class="field">
                    <a href="#">
                        <button class="button" type="submit" name="enregistrer">Enregistrer</button>
                    </a>
                </div>

                <div>
                    <button class="button"><a href="profil.php">Retour au profil</a></button>
                </div>

                <div class="message"><?= $message ?></div>
            </form>

        </div>
    </main>
</body>

</html>