<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conducteur</title>
</head>
<body>
    <form method="post">
        <button type ="submit" name ="possedez">vous possedez une voiture</button>
        <button type ="submit" name ="garage">vous voulez louer une voiture</button>
    </form>
    <?php
   session_start();
   require('../../connexion_bdd/connexion.php');
   
   if(isset($_POST['possedez'])) {
       handlepossedez();
   } elseif(isset($_POST['garage'])) {
       handlegarage();
   }
   
   function handlepossedez() {
       if(isset($_SESSION['id'])) {
           $userId = $_SESSION['id'];
           if(hasVoiture($userId)) {
               header("Location: conducteur_Vehciule_perso.php?id=$userId");
               exit();
           } else {
               header("Location: formulaire_voiture_perso.php?id=$userId");
               exit();
           }
       } else {
           header("Location: conducteur_choix.php");
           exit();
       }
   }
   function handlegarage(){
        if(isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            if(hasPermis($userId)) {
                header("Location: garage.php?id=$userId");
            }else {
                header("Location: conducteur_choix.php");
                exit();
            }
        }
    }
   
   function hasVoiture($userId) {
       global $DB;
       $sql = "SELECT COUNT(*) FROM vehicule WHERE utilisateur_id = :userId";
       $stmt = $DB->prepare($sql);
       $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
       $stmt->execute();
       $count = $stmt->fetchColumn();
       return $count > 0;
   }
   function hasPermis($userId) {
        global $DB;
        $sql = "SELECT permis FROM utilisateur WHERE id = :userId AND permis = 1";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? true : false;
    }
    ?>
</body>
</html>