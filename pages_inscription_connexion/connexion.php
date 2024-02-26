<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
    <div>
        <form method="POST" action="">
                <label>Login : </label>
                <input name="login" class="login" class="login">
                <br><br>
                <label>Password :</label>
                <input name="password" class="password" class="password">
                <br><br>
                <input type="submit"  name="connexion" value="se connecter">
        </form>
    </div>
    <?php
    session_start();
    require('../connexion_bdd/connexion.php');
    if(isset($_POST['connexion'])){
        $login = htmlentities($_POST['login']);
        $password = htmlentities($_POST['password']);
        if(!empty($login) AND !empty($password)) {
            $sql = 'SELECT * from utilisateur where login = ? AND password = ? ';
            $req = $DB->prepare($sql);
            $data = $req->execute(array($login,$password));
            $datas = $req->rowCount();
            if($datas == 1 ){
                $userinfo = $req->fetch();
                $_SESSION['id'] = $userinfo['id'];
                header("Location: pages_contenue/choix.php?id=".$_SESSION['id']);
            }else{
                echo"Mauvais mail ou mot de passe !";
            }
        } else{
            echo"tout les champs doivent etre rempli ";
        }
    }
    ?>
</body>
</html>