<?php
@session_start();
?>
    
    <!-- Header avec class BS -->
    <?php include_once("./Commons/header.php"); ?>

    <!-- Contenu du site-->
    <div class="border m-2 p-2 ">  

        <h1 class="text-center align-middle text-black">Blog</h1> 
        
        <?php
        //connexion à la bd
        include("Commons/connexionBdd.php");

        //preparation de la requete de recherche dans la base de donnée des produits
        $req=$bdd->prepare("SELECT * FROM blog ORDER BY date_de_creation DESC LIMIT 0,4");
        
        //execute la requete avec le login saisi par l'utilisateur
        $req->execute();
        ?>

        
        <?php while($article=$req->fetch()) {?>
            <div class="border mb-3 w-70" style="width:70%; margin:auto;">
                <p class="text-center border-bottom" style="background-color:cadetblue; color: white">
                    <?= htmlspecialchars($article["titre"]); ?> 
                </p>
                <!-- nl2br permet de convertir les retours à la ligne en <br/> -->
                <p class="text-center" style="background-color:rgba(95,158,160,0.4); color: black">
                    <?= substr(htmlspecialchars($article["contenu"]), 0, 300).' ... '; ?>
                    <a href="articleBlog.php?id=<?= $article["id"];?>">Lire la suite</a>
                </p>
            </div>
                
        <?php } ;
        ?>
        
    </div>

    <!-- Pied de page-->
    <?php include_once("./Commons/footer.php"); ?>


    

    
