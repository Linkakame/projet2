<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conducteur Véhicule Perso</title>
    <link rel="stylesheet" href="css/conducteur.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search/dist/leaflet-search.min.css" />
</head>
<body>
    <div id="profil">
        <?php
            session_start();
            require('../../connexion_bdd/connexion.php');
        ?>
        <a href="profil.php?id=<?php echo $_SESSION['id']; ?>"><img src="img/utilisateur.png" alt="Profil"></a>
    </div>
    <button id="openModal">Inscription</button>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="post">
                <label for="villedepart">Ville départ :</label>
                <input type="text" name="villedepart" required>
                <label for="villearrive">Ville arrivée :</label>
                <input type="text" name="villearrive" required>
                <label for="datetrajet">Date du trajet :</label>
                <input type="date" name="datetrajet" required>
                <label for="heuredepart">Heure de départ :</label>
                <input type="time" name="heuredepart" required>
                <label for="nombre_places">Nombre de places :</label>
                <input type="number" name="nombre_places" required>
                <button type="submit" name="ajouttrajet">Ajouter</button>
            </form>
            <?php
                require('../../connexion_bdd/connexion.php');
                if(isset($_POST['ajouttrajet'])) {
                    $utilisateur_id = $_SESSION['id'];
                    $villedepart = $_POST['villedepart'];
                    $villearrive = $_POST['villearrive'];
                    $datetrajet = $_POST['datetrajet'];
                    $heuredepart = $_POST['heuredepart'];
                    $nombre_places = $_POST['nombre_places'];
                    $conducteur = $_SESSION['conducteur'];
                    $passager = $_SESSION['passager'];

                    $sql2 = "INSERT INTO trajet (villedepart, villearrive, datetrajet, heuredepart, utilisateur_id, nombre_places, conducteur, passager) VALUES (:villedepart, :villearrive, :datetrajet, :heuredepart, :utilisateur_id, :nombre_places, :conducteur, :passager)";
                    $stmt = $DB->prepare($sql2);
                    $stmt->bindParam(':villedepart', $villedepart);
                    $stmt->bindParam(':villearrive', $villearrive);
                    $stmt->bindParam(':datetrajet', $datetrajet);
                    $stmt->bindParam(':heuredepart', $heuredepart);
                    $stmt->bindParam(':utilisateur_id', $utilisateur_id);
                    $stmt->bindParam(':nombre_places', $nombre_places);
                    $stmt->bindParam(':conducteur', $conducteur);
                    $stmt->bindParam(':passager', $passager);

                    if($stmt->execute()) {
                        header("Location: passager.php");
                    } else {
                        echo "Erreur lors de l'ajout du trajet.";
                    }
                }
            ?>
        </div>
    </div>
    <script src="js/conducteur.js"></script>
</body>
</html>
