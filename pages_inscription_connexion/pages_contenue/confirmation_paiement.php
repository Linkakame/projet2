<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Paiement</title>
    <link rel="stylesheet" href="css/confirmation_paiement.css">
</head>
<body>
    <div class="container">
        <h1>Merci pour votre paiement !</h1>
        <p>Votre paiement a été traité avec succès. Voici les détails de votre véhicule :</p>
        <?php if (isset($_SESSION['selected_vehicle'])): ?>
            <div class="vehicule-details">
                <p><strong>Nom :</strong> <?php echo htmlspecialchars($_SESSION['selected_vehicle']['nom']); ?></p>
                <p><strong>Autonomie :</strong> <?php echo htmlspecialchars($_SESSION['selected_vehicle']['autonomie']); ?></p>
                <p><strong>Temps de charge :</strong> <?php echo htmlspecialchars($_SESSION['selected_vehicle']['tempsDeCharge']); ?></p>
                <p><strong>Puissance :</strong> <?php echo htmlspecialchars($_SESSION['selected_vehicle']['puissance']); ?></p>
                <p><strong>Prix :</strong> <?php echo htmlspecialchars($_SESSION['selected_vehicle']['prix']); ?></p>
                <img src="<?php echo htmlspecialchars($_SESSION['selected_vehicle']['image']); ?>" alt="Image du véhicule">
            </div>
        <?php else: ?>
            <p>Erreur : Les détails du véhicule ne sont pas disponibles.</p>
        <?php endif; ?>
        <a href="conducteur_vehicule_louee.php" class="btn">Aller à la page de création de trajet</a>
        <a href="garage.php" class="btn">Retour à la page principale</a>
    </div>
</body>
</html>
