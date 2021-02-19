<?php
    require('dbconfig.php');
    session_start();
// SESSION VERIF
    if (isset($_POST['user_login'])){

        $user_login = htmlentities($_REQUEST['user_login'],ENT_QUOTES);
        $_SESSION['user_login'] = $user_login;
        $user_password = htmlentities($_REQUEST['user_password'],ENT_QUOTES);

        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete = "SELECT * FROM `users` WHERE `user_login` = '$user_login' AND `user_password` ='".hash('sha1', $user_password)."'";
            $prepare = $pdo->prepare($requete);
            $prepare->execute();
            $res = $prepare->rowCount();
            if (($res) == 1) {
                $user = $prepare->fetchAll();
                $_SESSION["user_login"] = $user[0]['user_login'];
                $_SESSION["user_id"] = $user[0]['user_id'];
                // vérifier si l'utilisateur existe
                if ($_SESSION["user_login"] == 'testadmin') {
                    header('location: private.php');
                }

            }
            else{
                $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                echo ($message);
            }
        }
        catch (PDOException $e){
            exit("❌🙀❌ OOPS :\n" . $e->getMessage());
        }
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
    <form action="" method="post">
   Login: <input type="text" name="user_login"/> <br>
   Mot de passe: <input type="password" name="user_password"/> <br>
    <input type="submit" value="me connecter"/>

    </form>

</body>
</html>