<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profil.css">
    <title>Votre Profil</title>
</head>
<body>
    <div class="profile-container">
        <div class="profile-box">
            <h1>Votre Profil</h1>
            <div class="profile-info">
                <?php
                session_start();
                require('../../connexion_bdd/connexion.php');

                if(isset($_SESSION['id'])) {
                    $userId = $_SESSION['id'];

                    try {
                        
                        $sql = "SELECT nom, prenom, date_naissance, code_postale, ville, permis, numero_permis, vehicule FROM utilisateur WHERE id = :userId";

                        $stmt = $DB->prepare($sql);

                        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<p><span>Nom :</span> " . $row["nom"] . "</p>";
                                echo "<p><span>Prénom :</span> " . $row["prenom"] . "</p>";
                                echo "<p><span>Date de naissance :</span> " . $row["date_naissance"] . "</p>";
                                echo "<p><span>Code postal :</span> " . $row["code_postale"] . "</p>";
                                echo "<p><span>Ville :</span> " . $row["ville"] . "</p>";
                                echo "<p><span>Permis :</span> " . $row["permis"] . "</p>";
                                echo "<p><span>Numéro de permis :</span> " . $row["numero_permis"] . "</p>";
                                echo "<p><span>Véhicule :</span> " . $row["vehicule"] . "</p>";             
                            }
                        } else {
                            echo "<p>Aucune information trouvée pour cet utilisateur.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur de requête : " . $e->getMessage() . "</p>";
                    }
                } else {
                    echo "<p>Erreur : Utilisateur non connecté.</p>";
                } 
                ?>
            </div>
        </div>
    </div>
</body>
</html>
