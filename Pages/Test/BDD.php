<?php

    //Connexion
    $serveur = 'localhost';
    $dbname = 'pdweb';
    $login = 'root';
    $pass = '';

    try {
        $bdd = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $login , $pass);
        $bdd->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $requete = $bdd->prepare(sql);
        $requete->execute();
    
        echo 'OK!';

    } catch (PDOException $e) {
        echo ('Erreur : '.$e->getMessage());
    }

    /*
        SQL REQUETTE
            Afficher
                SELECT *
                FROM baseName
                WHERE ... = "..."
                ORDER BY ....
                LIMIT ....
            Ajouter
                INSERT INTO baseName(..,..,..)
                VALUES (..,..,..)
            Mettre à jour
                UPDATE baseName
                SET ... = "...."
                WHERE ...
            Supprimer
                DELETE FROM baseName
                WHERE ... = "..."
        
        Jointure interne
            FROM ...
            INNER JOIN ...
            ON ...id = id...  
        Jointure externe
            FROM ...
            LEFT JOIN ...       OR  RIGHT JOIN ...
            ON ...id = id...        ON ...id = id...

    */


    //requete sql PHP
    $requete = $bdd->exec('sql');
    




