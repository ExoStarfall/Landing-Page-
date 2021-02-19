
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter de nouvelles entrées</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1{
            border: solid black 2px;
            padding: 20px;
        }
        .info{
            width: 50%;
            border-bottom: solid black 2px;
        }
        form{
            display: flex;
            flex-direction: column;
        }
        input, textarea{
            margin-bottom: 20px;
        }
        label{
            font-weight: bold;
        }
        a{
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            width: 200px;
            padding-left: 20px;
            padding-right: 20px;
        }
        .lien-simple{
            border: none;
            padding: 0px;
            width: auto;
            font-size: 28px;
            background-color: grey;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    

    <?php
    
        include ('dbconfig.php');

        if (isset($_POST['info_intro'])){
            $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
    
            $info_intro = htmlspecialchars($_POST['info_intro']);
            $info_lien1 = htmlspecialchars($_POST['info_lien1']);
            $info_lien2 = htmlspecialchars($_POST['info_lien2']);
            $info_lien3 = htmlspecialchars($_POST['info_lien3']);
            $info_lien4 = htmlspecialchars($_POST['info_lien4']);
            $background = htmlspecialchars($_POST['background']);
    
            $requete = "INSERT INTO `info` 
                            (`info_intro`,
                            `info_lien1`,
                            `info_lien2`,
                            `info_lien3`,
                            `info_lien4`,
                            `background`

                            )
                            VALUES (:info_intro, :info_lien1, :info_lien2, :info_lien3, :info_lien4, :background)";
            $prepare = $connexion->prepare($requete);
            $prepare->execute(array(
                "info_intro"=> $info_intro,
                "info_lien1"=> $info_lien1,
                "info_lien2"=> $info_lien2,
                "info_lien3"=> $info_lien3,
                "info_lien4"=> $info_lien4,
                "background"=> $background
            ));
        
            echo ("
            <p>C'est noté! Les informations on été ajoutées</p>
            <a class='lien-simple' href='index.php'>Retour à l'accueil</a>
            ");
        }
        
        else {
            echo("
            <h1>Renseigner toutes les infos et cliquer sur Valider</h1>
        <div class='info'>
        <form method='POST' action='ajout-lien.php'>

        <label for='info_intro'>Intro:</label>
        <input type='text' id='info_intro' name='info_intro'>

        <label for='info_lien1'>URL du lien 1:</label>
        <input type='text' id='info_lien1' name='info_lien1' >

        <label for='info_lien2'>URL du lien 2 :</label>
        <input type='info_lien2' id='info_lien2' name='info_lien2'>

        <label for='info_lien3'>URL du lien 3:</label>
        <input type='text' id='info_lien3' name='info_lien3'>

        <label for='info_lien4'>URL du lien 4:</label>
        <input type='text' id='info_lien4' name='info_lien4'>

        <label for='background'>Background:</label>
            <input type='text' id='background' name='background' >

            <label for='info_titre'>Titre:</label>
            <input type='text' id='info_titre' name='info_titre' >
        
            <label for='info_meta'>Meta:</label>
            <input type='text' id='info_meta' name='info_meta' >

            
            <label for='info_textcolor'>Couleur du texte:</label>
            <input type='text' id='info_textcolor' name='info_textcolor' >



        <input type='submit' value='Valider'>
        <a href='../index.php'> retour à l'espace admin</a>
        </form>
        </div>
            ");
        }
    ?>
</body>
</html>