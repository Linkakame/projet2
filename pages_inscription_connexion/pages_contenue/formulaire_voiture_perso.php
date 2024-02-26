<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <label for="immatriculation">Immatriculation</label>
        <input type="number" name="immatriculation">
        <label for="kilometrage">kilometrage &nbsp;:</label>
        <input type="number"  name="kilometrage">
        <label for="nombreplace">nombre place &nbsp;:</label>
        <input type="number"  name="nombreplace">
        <button type="submit" name="ajoutVehiculePerso">Ajouter vehicule</button>
    </form>
    <?php
         session_start();
         require('../../connexion_bdd/connexion.php');
         if(isset($_POST['ajoutVehiculePerso'])){
            $utilisateur_id = $_SESSION['id'];

                $immatriculation = $_POST['immatriculation'];
                $kilometrage = $_POST['kilometrage'];
                $nombreplace = $_POST['nombreplace'];

                
                $sql1 = "INSERT INTO vehicule (utilisateur_id) VALUES (:utilisateur_id)";
                $stmt1 = $DB->prepare($sql1);
                $stmt1->bindParam(':utilisateur_id', $utilisateur_id);
                $stmt1->execute();
                $vehicule_id = $DB->lastInsertId();
                $sql2 = "INSERT INTO vehicule_perso (vehicule_id,immatriculation,kilometrage,nombreplace) VALUES (:vehicule_id,:immatriculation, :kilometrage , :nombreplace )";
                $stmt2 = $DB->prepare($sql2);
                $stmt2->bindParam(':vehicule_id', $vehicule_id);
                $stmt2->bindParam(':immatriculation', $immatriculation);
                $stmt2->bindParam(':kilometrage', $kilometrage);
                $stmt2->bindParam(':nombreplace', $nombreplace);
                $stmt2->execute();
                header("Location: conducteur_Vehciule_perso.php");
                exit();
        }
    ?>
</body>
</html>