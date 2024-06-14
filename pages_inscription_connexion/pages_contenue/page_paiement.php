<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Page de Paiement</h1>
    <form method="post" action="traitement_paiement.php">
        <label for="nom">Nom sur la carte:</label><br>
        <input type="text" id="nom" name="nom" required><br>
        <label for="numero_carte">Numéro de carte:</label><br>
        <input type="text" id="numero_carte" name="numero_carte" required><br>
        <label for="date_expiration">Date d'expiration (MM/AAAA):</label><br>
        <input type="text" id="date_expiration" name="date_expiration" required><br>
        <label for="crypto">Code de sécurité (CVV):</label><br>
        <input type="text" id="crypto" name="crypto" required><br><br>
        <input type="submit" value="Payer">
    </form>
</body>
</html>
<?php

function luhnCheck($number) {
    $number = strrev(preg_replace('/[^\d]/', '', $number));
    $sum = 0;
    for ($i = 0, $j = strlen($number); $i < $j; $i++) {
        if (($i % 2) == 0) {
            $val = $number[$i];
        } else {
            $val = $number[$i] * 2;
            if ($val > 9) {
                $val -= 9;
            }
        }
        $sum += $val;
    }
    return ($sum % 10 == 0);
}

function validateCreditCard($cardNumber) {
    if (luhnCheck($cardNumber)) {
        return "La carte bleue est valide.";
    } else {
        return "La carte bleue n'est pas valide.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $numero_carte = $_POST["numero_carte"];
    $date_expiration = $_POST["date_expiration"];
    $crypto = $_POST["crypto"];
    
    // Valider le numéro de carte
    $validation_result = validateCreditCard($numero_carte);
    
    // Faites quelque chose avec le résultat de la validation, par exemple :
    echo $validation_result;
    
}

?>