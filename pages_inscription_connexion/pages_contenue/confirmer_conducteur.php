<?php
require('../../connexion_bdd/connexion.php');

if (isset($_POST['confirmer_conducteur'])) {
    $trajet_id = $_POST['trajet_id'];
    $utilisateur_id = $_POST['utilisateur_id'];
    $vehicule_id = $_POST['vehicule_id'];

    // Récupérer le nombre de places du véhicule sélectionné
    $sql2 = "SELECT nombreplace FROM vehicule_perso WHERE idVehiculeP = :vehicule_id";
    $stmt2 = $DB->prepare($sql2);
    $stmt2->bindParam(':vehicule_id', $vehicule_id, PDO::PARAM_INT);
    $stmt2->execute();
    $vehicule = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($vehicule) {
        $nombre_places = $vehicule['nombreplace'];

        // Mettre à jour le trajet avec le conducteur et le nombre de places
        $sql3 = "UPDATE trajet SET utilisateur_id = :utilisateur_id, nombre_places = :nombre_places, conducteur = 1 WHERE idtrajet = :trajet_id";
        $stmt3 = $DB->prepare($sql3);
        $stmt3->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $stmt3->bindParam(':nombre_places', $nombre_places, PDO::PARAM_INT);
        $stmt3->bindParam(':trajet_id', $trajet_id, PDO::PARAM_INT);

        if ($stmt3->execute()) {
            // Redirection après succès
            header("Location: passager.php");
            exit; // Arrête l'exécution du script après la redirection
        } else {
            echo "Erreur lors de l'ajout du conducteur.";
        }
    } else {
        echo "Véhicule non trouvé.";
    }
}
?>
