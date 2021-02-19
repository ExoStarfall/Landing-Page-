<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MODIFICATIONS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

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




<?php
include ('dbconfig.php');
 //récupérer les infos du form


 $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
 $requete = "SELECT * FROM `info` WHERE `info_id`=:info_id";
 $prepare = $pdo->prepare($requete);
 $info_id = htmlspecialchars($_GET['id']);
 $prepare->execute(array(
    "info_id"=> $info_id
));
$prepare = $prepare->fetch();
 

 echo("
     <h1>Modifier les infos et cliquer sur Valider</h1>
     <div class='info'>
     <form method='POST' action='modif.php?id=".$prepare['info_id']."'>

     <label for='info_intro'>Intro:</label>
     <input type='text' id='info_intro' name='info_intro' value='".$prepare['info_intro']."'>

     <label for='info_lien1'>URL du lien 1:</label>
     <input type='text' id='info_lien1' name='info_lien1' value='".$prepare['info_lien1']."'>

     <label for='info_lien2'>URL du lien 2:</label>
     <input type='text' id='info_lien2' name='info_lien2' value='".$prepare['info_lien2']."'>

    
     <label for='info_lien3'>URL du lien 3:</label>
     <input type='text' id='info_lien3' name='info_lien3' value='".$prepare['info_lien3']."' > 

    
     <label for='info_lien4'>URL du lien 4:</label>
     <input type='text' id='info_lien4' name='info_lien4' value='".$prepare['info_lien4']."'>

     <label for='background'>Background:</label>
            <input type='text' id='background' name='background' value='".$prepare['background']."' >

    <label for='info_titre'>Titre:</label>
   <input type='text' id='info_titre' name='info_titre' value='".$prepare['info_titre']."' >

    <label for='info_meta'>Meta:</label>
   <input type='text' id='info_meta' name='info_meta' value='".$prepare['info_meta']."' >

   <label for='info_textcolor'>Couleur du texte:</label>
   <input type='text' id='info_textcolor' name='info_textcolor' value='".$prepare['info_textcolor']."' >

  


     <input type='submit'  name='valider' value='Valider'> <br>
     <a href='../private.php'>Retour à l'espace admin></a> <br>
     <a href='../index.php'>Prévisualiser></a>

     </form>
     </div>
 ");



//UPDATE
if (isset($_POST['valider'])) {
            $info_intro = htmlspecialchars($_POST['info_intro']);
            $info_lien1 = htmlspecialchars($_POST['info_lien1']);
            $info_lien2 = htmlspecialchars($_POST['info_lien2']);
            $info_lien3 = htmlspecialchars($_POST['info_lien3']);
            $info_lien4 = htmlspecialchars($_POST['info_lien4']);
            $info_id = htmlspecialchars($_GET['id']);
            $background = htmlspecialchars($_POST['background']);
            $info_titre = htmlspecialchars($_POST['info_titre']);
            $info_meta = htmlspecialchars($_POST['info_meta']);
            $info_textcolor = htmlspecialchars($_POST['info_textcolor']);
            
    try {
      $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
      $requete = "UPDATE `info` 
                        SET `info_intro`=:info_intro,
                            `info_lien1`=:info_lien1,
                            `info_lien2`=:info_lien2,
                            `info_lien3`=:info_lien3,
                            `info_lien4`=:info_lien4,
                            `background`=:background,
                            `info_titre`=:info_titre,
                            `info_meta`=:info_meta,
                            `info_textcolor`=:info_textcolor
                            
                        WHERE `info_id`=:info_id";
      $prepare = $pdo->prepare($requete);
      $prepare->execute(array(
             ":info_intro"=> $info_intro,
            ":info_lien1"=> $info_lien1,
            ":info_lien2"=> $info_lien2,
            ":info_lien3"=> $info_lien3,
            ":info_lien4"=> $info_lien4,
            ":background"=> $background,
            ":info_titre"=> $info_titre,
            ":info_meta"=> $info_meta,
            ":info_textcolor"=> $info_textcolor,
            ":info_id"=> $info_id 
      ));
      $res = $prepare->rowCount();
  
      if ($res == 1) {
        echo "<p>Modifications enregistrées!</p>";
      }
    } catch (PDOException $e) {
      exit("❌🙀❌ OOPS :\n" . $e->getMessage());
    }
  }

?>
</body>
</html>