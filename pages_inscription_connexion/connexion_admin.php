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
        
    }
    ?>
</body>
</html>