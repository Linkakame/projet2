<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nom'], $_GET['image'], $_GET['autonomie'], $_GET['tempsDeCharge'], $_GET['puissance'], $_GET['prix'])) {
    $vehicule = [
        'nom' => $_GET['nom'],
        'image' => $_GET['image'],
        'autonomie' => $_GET['autonomie'],
        'tempsDeCharge' => $_GET['tempsDeCharge'],
        'puissance' => $_GET['puissance'],
        'prix' => $_GET['prix']
    ];

    $_SESSION['selected_vehicle'] = $vehicule;
} 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Paiement</title>
    <link rel="stylesheet" href="css/page_paiement.css">
</head>
<body>
    <div class="container">
        <h1>Page de Paiement</h1>

        <div class="flex-container">
            <div class="vehicule-details">
                <div><strong>Nom :</strong> <?php echo htmlspecialchars($_GET['nom']); ?></div>
                <div><strong>Autonomie :</strong> <?php echo htmlspecialchars($_GET['autonomie']); ?></div>
                <div><strong>Temps de charge :</strong> <?php echo htmlspecialchars($_GET['tempsDeCharge']); ?></div>
                <div><strong>Puissance :</strong> <?php echo htmlspecialchars($_GET['puissance']); ?></div>
                <div><strong>Prix :</strong> <?php echo htmlspecialchars($_GET['prix']); ?></div>
            </div>

            <form method="post" action="traitement_paiement.php" class="payment-form">
                <label for="nom">Nom sur la carte :</label><br>
                <input type="text" id="nom" name="nom" required><br>
                <label for="numero_carte">Numéro de carte :</label><br>
                <input type="text" id="numero_carte" name="numero_carte" required><br>
                <label for="date_expiration">Date d'expiration (MM/AAAA) :</label><br>
                <input type="text" id="date_expiration" name="date_expiration" required><br>
                <label for="crypto">Code de sécurité (CVV) :</label><br>
                <input type="text" id="crypto" name="crypto" required><br><br>
                <input type="submit" value="Payer">
            </form>
        </div>

        <a href="garage.php" class="btn">Retour au garage</a>
    </div>
</body>
</html>
