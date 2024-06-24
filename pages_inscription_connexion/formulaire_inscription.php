<?php
    session_start();
    require('../connexion_bdd/connexion.php');

    if (isset($_POST['Enregistrer'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];
        $code_postale = $_POST['code_postale'];
        $ville = $_POST['ville'];
        $permis = $_POST['permis'];
        $numero_permis = $permis == 1 ? $_POST['numero_permis'] : null;
        $vehicule = $_POST['vehicule'];
        $login = $_POST['login'];
        $password = $_POST['password']; 

        $query = $DB->prepare("INSERT INTO utilisateur (nom, prenom, date_naissance, code_postale, ville, permis, numero_permis, vehicule, login, password) VALUES (:nom, :prenom, :date_naissance, :code_postale, :ville, :permis, :numero_permis, :vehicule, :login, :password)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':date_naissance', $date_naissance);
        $query->bindParam(':code_postale', $code_postale);
        $query->bindParam(':ville', $ville);
        $query->bindParam(':permis', $permis);
        $query->bindParam(':numero_permis', $numero_permis);
        $query->bindParam(':vehicule', $vehicule);
        $query->bindParam(':login', $login);
        $query->bindParam(':password', $password); 

        if ($query->execute()) {
            echo "<p style='color: green;'>Inscription réussie!</p>";
        } else {
            echo "<p style='color: red;'>Erreur lors de l'inscription: " . $DB->errorInfo()[2] . "</p>";
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
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

        .form-container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="date"],
        .form-container input[type="password"] {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
            width: calc(100% - 20px);
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="number"]:focus,
        .form-container input[type="date"]:focus,
        .form-container input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
        }

        .form-container input[type="radio"] {
            margin-right: 8px;
        }

        .form-container .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }

        .form-container .submit-btn:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
    <script>
        function toggleNumeroPermis() {
            var permisOui = document.getElementById('permis_oui');
            var numeroPermis = document.getElementById('numero_permis');

            if (permisOui.checked) {
                numeroPermis.disabled = false;
            } else {
                numeroPermis.disabled = true;
                numeroPermis.value = '';
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Inscription</h2>
        <form method="post">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" required>

            <label for="date_naissance">Date de naissance :</label>
            <input type="date" name="date_naissance" required>

            <label for="code_postale">Code postal :</label>
            <input type="number" name="code_postale" required>

            <label for="ville">Ville :</label>
            <input type="text" name="ville" required>

            <label for="permis">Permis :</label>
            <input type="radio" id="permis_oui" name="permis" value="1" onclick="toggleNumeroPermis()">OUI
            <input type="radio" id="permis_non" name="permis" value="0" onclick="toggleNumeroPermis()">NON

            <label for="numero_permis">Numéro de permis :</label>
            <input type="number" id="numero_permis" name="numero_permis" disabled required>

            <label for="vehicule">Véhicule :</label>
            <input type="radio" name="vehicule" value="1">OUI
            <input type="radio" name="vehicule" value="0">NON

            <label for="login">Login :</label>
            <input type="text" name="login" required>

            <label for="password">Password :</label>
            <input type="password" name="password" required>

            <input type="submit" name="Enregistrer" class="submit-btn" value="Enregistrer">
        </form>
    </div>
</body>
</html>
