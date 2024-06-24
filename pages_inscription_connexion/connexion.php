<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .login-form label {
            margin-bottom: 5px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .login-form input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 480px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 style="text-align: center;">Connexion</h2>
        <form class="login-form" method="POST" action="">
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" class="login" required>
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" class="password" required>
            <input type="submit" name="connexion" value="Se connecter">
        </form>
        <?php
        session_start();
        require('../connexion_bdd/connexion.php');

        if (isset($_POST['connexion'])) {
            $login = htmlentities($_POST['login']);
            $password = htmlentities($_POST['password']);

            if (!empty($login) && !empty($password)) {
                // Requête pour récupérer l'utilisateur par son login
                $sql = 'SELECT * FROM utilisateur WHERE login = :login';
                $req = $DB->prepare($sql);
                $req->bindValue(':login', $login);
                $req->execute();

                // Vérifier si l'utilisateur existe
                if ($req->rowCount() == 1) {
                    $userinfo = $req->fetch();

                    // Vérification du mot de passe (en clair pour le moment)
                    if ($password === $userinfo['password']) {
                        // Mot de passe correct
                        $_SESSION['id'] = $userinfo['id'];
                        header("Location: pages_contenue/choix.php?id=" . $_SESSION['id']);
                        exit();
                    } else {
                        // Mot de passe incorrect
                        echo "<p style='color: red; text-align: center;'>Mauvais login ou mot de passe !</p>";
                    }
                } else {
                    // Aucun utilisateur trouvé avec ce login
                    echo "<p style='color: red; text-align: center;'>Mauvais login ou mot de passe !</p>";
                }
            } else {
                echo "<p style='color: red; text-align: center;'>Tous les champs doivent être remplis.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
