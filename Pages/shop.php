<?php
@session_start();
?>
    
    <!-- Header avec class BS -->
    <?php include_once("./Commons/header.php"); ?>

    <!-- Contenu du site-->
    <div class="border m-2 p-2 ">  

        <h1 class="text-center align-middle text-black">E-Shop</h1> 
        
        <?php
        //connexion à la bd
        include("Commons/connexionBdd.php");

        //preparation de la requete de recherche dans la base de donnée des produits
        $req=$bdd->prepare("SELECT * FROM produits");
        
        //execute la requete avec le login saisi par l'utilisateur
        $req->execute();
        
        //tableau reprenant la rechercher ligne par ligne
        $tab=$req->fetch();
        ?>
        <div class="row">
        <?php do {?>
            <div class="col-4 p-2">
                <img src="../SRC/img/blog.jpg" class="img-thumbnail" alt="essai" >
                <p class="text-center">Description<br/> <?php echo $tab["description"]; ?> </p>
                <p class="text-center text-danger"><?= number_format($tab["prix_unitaire"],2); ?></p>
                
            </div>
        <?php } while($tab=$req->fetch())
        ?>
        </div>
    </div>

    <!-- Pied de page-->
    <?php include_once("./Commons/footer.php"); ?>


    

    
