<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d inscription</title>
</head>
<body>
<form  method="post">
        <label for="nom">nom&nbsp;:</label>
        <input type="text"  name="nom" required>
        <br><br>  
        <label for="prenom">prenom&nbsp;:</label>
        <input type="text"  name="prenom" required>
        <br><br>
        <label for="date_naissance"> date naissance &nbsp;:</label>
        <input type="date"  name="date_naissance" required>
        <br><br>
        <label for="code_postale"> code postale &nbsp;:</label>
        <input type="number"  name="code_postale" required>
        <br><br>
        <label for="ville">ville&nbsp;:</label>
        <input type="text"  name="ville" required>
        <br><br>
        <label for="permis" name=permis> permis &nbsp;:</label>
        <input type="radio"  name="permis" value="1">OUI
        <input type="radio"  name="permis" value="0">NON
        <br><br>
        <label for="numero_permis"> numero permis &nbsp;:</label>
        <input type="number"  name="numero_permis" required>
        <br><br>
        <label for="vehicule"> vehicule &nbsp;:</label>
        <input type="radio"  name="vehicule" value="1">oui
        <input type="radio"  name="vehicule" value="0">non
        <br><br>
        <label for="login">login&nbsp;:</label>
        <input type="text"  name="login" required>
        <br><br>  
        <label for="password">password&nbsp;:</label>
        <input type="password"  name="password" required>
        <input type="submit" name="Enregistrer" value="Enregistrer"/>
</form>
</body>
</html>