<?php
require('../../connexion_bdd/connexion.php');

if (isset($_POST['ajouter_conducteur'])) {
    session_start();
    $utilisateur_id = $_SESSION['id'];
    $trajet_id = $_POST['trajet_id'];

    // Vérifier si l'utilisateur possède un véhicule personnel
    $sql1 = "SELECT vp.*, v.utilisateur_id FROM vehicule_perso vp JOIN vehicule v ON vp.vehicule_id = v.id WHERE v.utilisateur_id = :utilisateur_id";
    $stmt1 = $DB->prepare($sql1);
    $stmt1->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
    $stmt1->execute();

    if ($stmt1->rowCount() > 0) {
        $vehicules = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Choisir un véhicule</title>
        </head>
        <body>
        <h2>Choisir un véhicule pour le trajet</h2>
        <form method="post" action="confirmer_conducteur.php">
            <input type="hidden" name="trajet_id" value="<?php echo $trajet_id; ?>">
            <input type="hidden" name="utilisateur_id" value="<?php echo $utilisateur_id; ?>">
            <label for="vehicule">Sélectionnez un véhicule :</label>
            <select name="vehicule_id" id="vehicule" required>
                <?php foreach ($vehicules as $vehicule) { ?>
                    <option value="<?php echo $vehicule['idVehiculeP']; ?>">
                        <?php echo $vehicule['immatriculation'] . ' - ' . $vehicule['nombreplace'] . ' places'; ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit" name="confirmer_conducteur">Confirmer</button>
        </form>
        </body>
        </html>
        <?php
    } else {
        echo "Vous n'avez pas de véhicule personnel.";
    }
}
?>
