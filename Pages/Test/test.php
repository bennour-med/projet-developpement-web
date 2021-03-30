<?php

    $serveur = 'localhost';
    $dbname = 'pdweb';
    $login = 'root';
    $pass = '';

    //connexion
    try {
        $bdd = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $login , $pass);
        $bdd->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo ('Erreur : '.$e->getMessage());
    }

    //preparation requete
    $requete = $bdd->prepare("SELECT * FROM users");
    $requete->setFetchMode(PDO::FETCH_ASSOC);

    //execution requete
    $requete->execute();
    
    //Affection du resultat de la requete à une variable tableau
    $tabUsers = $requete->fetchAll();
    //Boucle pour afficher les résultats
    for($i=0;$i<count($tabUsers);$i++){
        echo $tabUsers[$i]['id'].' '.$tabUsers[$i]['nom'].' '.$tabUsers[$i]['prenom'].
            ' '.$tabUsers[$i]['date_de_naissance'].' '.$tabUsers[$i]['email'].'<br/>';
	}

?>