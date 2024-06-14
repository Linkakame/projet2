<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>choix</title>
</head>
<body>
    <form method="post">
        <button type="submit" name="role" value="conducteur">Conducteur</button>
        <button type="submit" name="role" value="passager">Passager</button>
    </form>
</body>
<?php
    session_start();
    require('../../connexion_bdd/connexion.php');

    if (isset($_POST['role'])) {
        $role = $_POST['role'];
    
        if ($role === 'conducteur') {
            $_SESSION['conducteur'] = 1;
            $_SESSION['passager'] = 0;
            handleConducteur();
        } elseif ($role === 'passager') {
            $_SESSION['conducteur'] = 0;
            $_SESSION['passager'] = 1;
            handlePassager();
        }
    }
if(isset($_POST['conducteur'])) {;
    handleConducteur();
} elseif(isset($_POST['passager'])) {
    handlePassager();
}

function handleConducteur() {
    if(isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
        if(hasPermis($userId)) {
                header("Location: conducteur_choix.php?id=$userId");
                exit();
            }
        } else {
            echo "Vous devez avoir un permis pour accéder à cette fonctionnalité.";
        }
} 



function handlePassager() {
    if(isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
        // Logique pour le passager
        header("Location: passager.php?id=$userId");
        exit();
    } else {
        header("Location: ./connexion.php");
        exit();
    }
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
</html>

