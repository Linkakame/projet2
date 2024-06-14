<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>passager</title>
    <link rel="stylesheet" href="css/passager.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search/dist/leaflet-search.min.css" />
</head>
<body>
    <div id="profil">
        <?php
            session_start();
            require('../../connexion_bdd/connexion.php');
        ?>
        <a href="profil.php?id=<?php echo $_SESSION['id']; ?>"><img src="img/utilisateur.png"></a>
    </div>
    <form method="POST" action="">
        <p> Les trajets : <input type="text" name="search" placeholder="Rechercher une ville" /><button type="submit">Rechercher</button></p>
    </form>
    <?php
require('../../connexion_bdd/connexion.php');

// Initialisation des variables de recherche
$searchTerm = "";
$whereClause = "";

// Vérifie si une recherche est effectuée
if(isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $whereClause = "WHERE villedepart LIKE '%$searchTerm%' OR villearrive LIKE '%$searchTerm%'";
}

// Requête SQL pour récupérer les trajets en fonction de la recherche
$sql1 ="SELECT * FROM trajet $whereClause";
$stmt = $DB->prepare($sql1);
$stmt->execute();
?>
    <button id="openModal">Inscription</button>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <form  method="post">
                <label for="villedepart">ville depart &nbsp;:</label>
                <input type="text"  name="villedepart">
                <br><br>  
                <label for="villearrive">ville arriver &nbsp;:</label>
                <input type="text"  name="villearrive">
                <br><br>
                <label for="datetrajet">date trajet &nbsp;:</label> 
                <input type="date" name="datetrajet">
                <br><br>
                <label for="heuredepart">heure depart &nbsp;:</label>
                <input type="time" name="heuredepart">
                <button type="submit" name="ajouttrajet">Ajouter</button>
            </form>
            <?php
                 require('../../connexion_bdd/connexion.php');
                 if(isset($_POST['ajouttrajet'])) {
                    // Récupérer l'ID de l'utilisateur depuis la session
                    $utilisateur_id = $_SESSION['id'];
                    
                    // Récupérer les autres données du formulaire
                    $villedepart = $_POST['villedepart'];
                    $villearrive = $_POST['villearrive'];
                    $datetrajet = $_POST['datetrajet'];
                    $heuredepart = $_POST['heuredepart'];
                    
                    $conducteur = $_SESSION['conducteur'];
                    $passager = $_SESSION['passager'];
                    // Insérer le trajet dans la base de données
                    $sql2 = "INSERT INTO trajet (villedepart, villearrive, datetrajet, heuredepart, utilisateur_id, conducteur, passager) VALUES (:villedepart, :villearrive, :datetrajet, :heuredepart, :utilisateur_id, :conducteur, :passager)";
                    $stmt = $DB->prepare($sql2);
                    $stmt->bindParam(':villedepart', $villedepart);
                    $stmt->bindParam(':villearrive', $villearrive);
                    $stmt->bindParam(':datetrajet', $datetrajet);
                    $stmt->bindParam(':heuredepart', $heuredepart);
                    $stmt->bindParam(':utilisateur_id', $utilisateur_id);
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
        <span class="close">&times;</span>
    </div>
    <?php
        // Afficher les résultats de la recherche ici
        if(isset($_POST['search'])) {
            echo "<h2>Résultats de la recherche :</h2>";
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>Trajet ID: " . $row["idtrajet"] . " - Ville de départ: " . $row["villedepart"] . " - Ville d'arrivée: " . $row["villearrive"] . "</li>";
            }
            echo "</ul>";
        }
    ?>
    <?php
        require('../../connexion_bdd/connexion.php');
        $sql1 ="SELECT * FROM trajet ";
        $stmt = $DB->prepare($sql1);
        $stmt->execute();
        echo "<h2>Liste des trajets :</h2>";
        echo "<ul>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>Trajet ID: " . $row["idtrajet"] . " - Ville de départ: " . $row["villedepart"] . " - Ville d'arrivée: " . $row["villearrive"] . "</li>";
        }
        echo "</ul>";
    ?>
    <div id="contenue_map">
            <input id="search-input" placeholder="Rechercher une ville">
            <div id="map"></div>
    </div>
    <?php
require('../../connexion_bdd/connexion.php');

if(isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    try {
        
        $sql = "SELECT * FROM trajet WHERE utilisateur_id = :userId";

        $stmt = $DB->prepare($sql);

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            echo "<h2>Voici vos trajets :</h2>";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "Trajet ID: " . $row["idtrajet"]. " - Ville de départ: " . $row["villedepart"]. " - Ville d'arrivée: " . $row["villearrive"]. "<br>";
            }
        } else {
            echo "Aucun trajet trouvé pour cet utilisateur.";
        }
    } catch (PDOException $e) {
        echo "Erreur de requête : " . $e->getMessage();
    }
} else {
    echo "Erreur : Utilisateur non connecté.";
} 
?>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-search/dist/leaflet-search.min.js"></script>
    <script src="js/passager.js"></script>
    <script src="js/map.js"></script>
</body>
</html>