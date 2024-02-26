<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> votre profil </h1>
    <br><br>
    <p> vos informations sont :</p> 
    <?php
    session_start();
    require('../../connexion_bdd/connexion.php');

if(isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    try {
        
        $sql = "SELECT nom,prenom,date_naissance,code_postale,ville,permis,numero_permis,vehicule FROM utilisateur WHERE id = :userId";

        $stmt = $DB->prepare($sql);

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "Nom : " . $row["nom"] . "<br>";
                echo "Prénom : " . $row["prenom"] . "<br>";
                echo "date_naissance : " .$row["date_naissance"]. "<br>";
                echo "code_postale : " .$row["code_postale"]. "<br>";
                echo "ville : " .$row["ville"]. "<br>";
                echo "permis : ".$row["permis"]. "<br>";
                echo "numero_permis : " .$row["numero_permis"]. "<br>";
                echo "vehicule :".$row["vehicule"]. "<br>";             
            }
        } else {
            echo "Aucun information  trouvé pour cet utilisateur.";
        }
    } catch (PDOException $e) {
        echo "Erreur de requête : " . $e->getMessage();
    }
} else {
    echo "Erreur : Utilisateur non connecté.";
} 
?>
</body>
</html>