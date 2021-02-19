<?php 
require_once ('dbconfig.php');
$connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);

//récupérer les infos du form
$requete = "SELECT * FROM `info`";
$prepare = $connexion->prepare($requete);
$prepare->execute();
 $info = $prepare->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo ($info['info_meta']);?>">
    <title><?php echo ($info['info_titre']);?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

        <h1>MA LANDING PAGE</h1>
        
    

     

    <?php
       echo("
            <div class='info'>
            <h1>" . $info['info_intro'] . "</h1>
            </div>

            <div class='liens'>
            <h2>".$info['info_lien2']."</h2> <br>
            <h2>" . $info['info_lien1'] . "</h2> <br>
            <h2>".$info['info_lien3']."</h2> <br>
            <h2>".$info['info_lien4']."</h2> <br>
            </div>
        
        ");
        
    
    
    ?>
   
</body>
<style>

body{
    background-color: <?php echo ($info['background']);?>;   
}
h1{
    color: <?php echo ($info['info_textcolor']);?>;
}

h2{
    color: <?php echo ($info['info_linkcolor']);?>;
}
</style>
</html>