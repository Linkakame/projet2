<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
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

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button-container a {
            text-decoration: none;
            width: 100%; /* Définit la largeur à 100% */
            max-width: 200px; /* Largeur maximale pour limiter la largeur sur de grands écrans */
            margin: 10px 0;
        }

        .button {
            display: block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%; /* Définit la largeur à 100% */
        }

        .button:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 600px) {
            .button {
                width: 100%;
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="button-container">
        <a href="pages_inscription_connexion/formulaire_inscription.php" class="button">Inscription</a>
        <a href="pages_inscription_connexion/connexion.php" class="button">Connexion</a>
        <a href="pages_inscription_connexion/pages_contenue/invite.php" class="button">Invité</a>
        <a href="pages_inscription_connexion/connexion_partenariat.php" class="button">Partenaire</a>
        <a href="pages_inscription_connexion/connexion_admin.php" class="button">Admin</a>
    </div>
</body>
</html>
