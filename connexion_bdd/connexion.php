<?php
    $host='localhost';
    $dbname='projet2';
    $username='root';
    $password='';

    try{
        $DB = new PDO("mysql:host=$host;dbname=$dbname","$username","$password");
        //echo "vous êtes connecter a la base de données ";
    }
    catch(PDOException $e){
        die("impossible de se connecter à la base de données ". $e->getMessage());
    }
?>