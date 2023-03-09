<?php
session_start();
$message = "";
require("config.php");

if (isset($_POST['submit'])) {
  if (!empty($_POST['login']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
    $sql = 'SELECT login FROM utilisateurs';
    $request = $bdd->prepare($sql);
    $request2 = $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $i = 0;
    foreach ($result as $value) {
      if ($value["login"] == $_POST['login']) {
        $message = "Ce login existe deja, utilisez un autre login !";
        $i++;
      }
    }
    if ($i == 0) {
      if ($_POST['password1'] == $_POST['password2']) {
        $login = $_POST['login'];
        $mdp = $_POST['password1'];
        $sql = "INSERT INTO utilisateurs(login, password) VALUES (?, ?)";
        $request = $bdd->prepare($sql);
        $request->execute([$login,$mdp]);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        //header('location:connexion.php');
      } else {
        $message = "Les deux mots de passe ne sont pas identiques !";
      }
      echo $message;
    }
  } else {
    $message = "Vous devez remplir tous les champs !";
  }
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
      <h1 class="h1from">Inscription</h1>
      <form class='form1' method="POST">
        <div class="field">
          <label>Login</label>
          <input type="text" name="login">
        </div>

        <div class="field">
          <label>Mot de passe</label>
          <input type="password" name="password1">
        </div>

        <div class="field">
          <label>Confirmez le mot de passe</label>
          <input type="password" name="password2">
        </div>

        <a href="#">
          <button class="button" type="submit" name="submit">Inscription</button>
        </a>

        <div class="message"><?= $message ?></div>
      </form>

      <div class="petitmsg">
        <span>Vous avez deja un compte ? <a class="petitmsg2" href="connexion.php">Connectez-vous !</a></span>
      </div>
    </div>
  </main>
</body>

</html>