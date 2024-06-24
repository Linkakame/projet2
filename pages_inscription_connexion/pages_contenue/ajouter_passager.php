<?php
require('../../connexion_bdd/connexion.php');

if (isset($_POST['ajouter_passager'])) {
    session_start();
    $utilisateur_id = $_SESSION['id'];
    $trajet_id = $_POST['trajet_id'];

    // Vérifier si l'utilisateur est déjà passager de ce trajet
    $sql1 = "SELECT * FROM trajet_passager WHERE trajet_id = :trajet_id AND utilisateur_id = :utilisateur_id";
    $stmt1 = $DB->prepare($sql1);
    $stmt1->bindParam(':trajet_id', $trajet_id, PDO::PARAM_INT);
    $stmt1->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
    $stmt1->execute();

    if ($stmt1->rowCount() == 0) {
        // Vérifier le nombre de places disponibles
        $sql2 = "SELECT nombre_places FROM trajet WHERE idtrajet = :trajet_id";
        $stmt2 = $DB->prepare($sql2);
        $stmt2->bindParam(':trajet_id', $trajet_id, PDO::PARAM_INT);
        $stmt2->execute();
        $trajet = $stmt2->fetch(PDO::FETCH_ASSOC);

        if ($trajet && $trajet['nombre_places'] > 0) {
            // Mettre à jour le nombre de places et ajouter le passager
            $sql3 = "UPDATE trajet SET nombre_places = nombre_places - 1 WHERE idtrajet = :trajet_id";
            $stmt3 = $DB->prepare($sql3);
            $stmt3->bindParam(':trajet_id', $trajet_id, PDO::PARAM_INT);
            $stmt3->execute();

            // Ajouter le passager au trajet
            $sql4 = "INSERT INTO trajet_passager (trajet_id, utilisateur_id) VALUES (:trajet_id, :utilisateur_id)";
            $stmt4 = $DB->prepare($sql4);
            $stmt4->bindParam(':trajet_id', $trajet_id, PDO::PARAM_INT);
            $stmt4->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);

            if ($stmt4->execute()) {
                echo "Passager ajouté avec succès!";
            } else {
                echo "Erreur lors de l'ajout du passager.";
            }
        } else {
            echo "Aucune place disponible pour ce trajet.";
        }
    } else {
        echo "Vous êtes déjà inscrit comme passager sur ce trajet.";
    }
}
?>
