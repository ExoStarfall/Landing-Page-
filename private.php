<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if ($_SESSION["user_login"] != "testadmin") {
  header("Location: index.php");
  exit();
}
/*require('dbconfig.php');*/
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private</title>
    <!-- Flemme de mettre une feuille CSS, c'est moche mais ça marche-->
</head>
<body>
<h1>MA LANDING PAGE</h1>

<a class='lien-simple' href='ajout-lien.php'>Ajouter un lien</a>
    
    <?php
    include ('dbconfig.php');

    $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);

    //récupérer les infos des films
    $requete = "SELECT * FROM `info`";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    while ($info = $prepare->fetch()){
        echo("
            <div class='info'>
            <h1>".$info['info_intro']."</h1>
            </div>
            <div class='liens'>
            <h2>".$info['info_lien1']."</h2>
            <h2>".$info['info_lien2']."</h2>
            <h2>".$info['info_lien3']."</h2>
            <h2>".$info['info_lien4']."</h2>
            </div>
            <a href='modif.php/?id=".$info['info_id']."'> Modifier les infos de cet item </a> <br>
            <a href='suppr.php/?id=".$info['info_id']."'> Supprimer ce profil </a>
            </div>
        ");
    }
    ?>


    
</body>
</html>