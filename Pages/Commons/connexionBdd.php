<?php
    $serveur = 'localhost';
    $dbname = 'pdweb';

    try {
        $bdd = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", "root" , "");
        $bdd->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo ('Erreur : '.$e->getMessage());
    }

?>