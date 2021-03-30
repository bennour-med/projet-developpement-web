<?php
@session_start();
$id = $_GET['id'];
?>
    
    <!-- Header avec class BS -->
    <?php include_once("./Commons/header.php"); ?>

    <!-- Contenu du site-->
    <div class="border m-2 p-2 ">  
        
        <?php
        //connexion à la bd
        include("Commons/connexionBdd.php");

        //preparation de la requete de recherche dans la base de donnée des produits
        $req=$bdd->prepare('SELECT * FROM blog WHERE id = ?');
        
        //execute la requete avec le login saisi par l'utilisateur
        $req->execute(array($id));
        ?>

        
        <?php while($article=$req->fetch()) {?>
            <div class="border">
                <h2 class="text-center border-bottom"><?= htmlspecialchars($article["titre"]); ?></h2>
                <!-- nl2br permet de convertir les retours à la ligne en <br/> -->
                <p class="text-center text-danger"><?= nl2br(htmlspecialchars($article["contenu"])); ?></p>
            </div>
            
        <?php } ;
        ?>
        
    </div>

    <!-- Pied de page-->
    <?php include_once("./Commons/footer.php"); ?>


    

    
