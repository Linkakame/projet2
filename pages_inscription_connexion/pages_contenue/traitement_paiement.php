<?php
session_start();
require('../../connexion_bdd/connexion.php');

function luhnCheck($number) {
    $number = strrev(preg_replace('/[^\d]/', '', $number));
    $sum = 0;
    for ($i = 0, $j = strlen($number); $i < $j; $i++) {
        $val = ($i % 2 == 0) ? $number[$i] : $number[$i] * 2;
        $sum += ($val > 9) ? $val - 9 : $val;
    }
    return ($sum % 10 == 0);
}

function validateCreditCard($cardNumber) {
    return luhnCheck($cardNumber) ? "La carte bleue est valide." : "La carte bleue n'est pas valide.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $numero_carte = $_POST["numero_carte"];
    $date_expiration = $_POST["date_expiration"];
    $crypto = $_POST["crypto"];

    if (validateCreditCard($numero_carte) === "La carte bleue est valide.") {
        if (isset($_SESSION['selected_vehicle'])) {
            $selectedVehicle = $_SESSION['selected_vehicle'];
            
            $garage_id = 1; // Exemple de l'ID du garage
            $immatriculation = 'XXX-XXX'; // Exemple d'immatriculation
            $etat = 'En location'; // Exemple d'état du véhicule après location
            $kilometrage = 0; // Exemple de kilométrage initial
            $nombreplace = 5; // Exemple du nombre de places du véhicule

            $sql = "INSERT INTO vehicule_loue (immatriculation, etat, kilometrage, nombreplace, vehicule_id, garage_id) 
                    VALUES (:immatriculation, :etat, :kilometrage, :nombreplace, :vehicule_id, :garage_id)";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
            $stmt->bindParam(':etat', $etat, PDO::PARAM_STR);
            $stmt->bindParam(':kilometrage', $kilometrage, PDO::PARAM_INT);
            $stmt->bindParam(':nombreplace', $nombreplace, PDO::PARAM_INT);
            $stmt->bindParam(':vehicule_id', $vehicule_id, PDO::PARAM_INT); // Vous devez définir cette variable
            $stmt->bindParam(':garage_id', $garage_id, PDO::PARAM_INT);
            $stmt->execute();

            // Une fois l'insertion réussie, redirigez vers la page de confirmation de paiement
            header("Location: confirmation_paiement.php");
            exit();
        } else {
            echo "Erreur : Aucun véhicule sélectionné pour paiement.";
        }
    } else {
        echo "Numéro de carte invalide.";
    }
} else {
    // Redirection en cas de requête non autorisée (non POST)
    header("Location: garage.php");
    exit();
}
?>
