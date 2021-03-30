<?php
    @session_start();

    //Si l'utilisateur n'est pas connecté, redirection vers index.php
	if(@$_SESSION["autoriser"]!="oui"){
		header("location:login.php");
		exit();
	}
    @$msg = $_POST["msg"];
    @$pseudo = $_SESSION["login"];
    @$message ="";
    @$valider=$_POST["valider"];

    

    if(isset($valider)){
		//si une des cases n'est pas remplie correctement, message ajouté à la variable &message
		if(empty($msg)) $message="<li>veuillez ecrire un message!</li>";

		if(empty($message)){
			//connexion à la bd
            include("Commons/connexionBdd.php");
			
			//preparation de la requete de recherche dans la base de donnée si login est deja existant
			$req=$bdd->prepare("INSERT into minichat(pseudo, messagechat) values (?,?)");
			
			//execute la requete avec le login saisi par l'utilisateur
            $req->execute(array($pseudo, $msg));
            header("location:minichat_post.php");
        }
    }
?>
    <!-- Header avec class BS -->
    <?php include_once("./Commons/header.php"); ?>

    <div class="border m-2 p-2"> 
        
        <h1 class="text-center">Mini-Chat</h1>

        <!-- Affichage minichat -->
        
        <div class ="border ml-3 mr-3 pl-3 ml-3 minichat">
            <?php
            //connexion à la bd
            include("Commons/connexionBdd.php");
			
			//preparation de la requete de recherche dans la base de donnée si login est deja existant
			$req=$bdd->prepare("SELECT pseudo, messagechat FROM minichat ORDER BY ID DESC limit 0, 6");
			
			//execute la requete avec le login saisi par l'utilisateur
            $req->execute();
			
			//tableau reprenant la rechercher ligne par ligne
			 $tab=$req->fetch();

            do{
                echo '<p><strong>'.htmlspecialchars($tab["pseudo"]).'</strong> : '.htmlspecialchars($tab["messagechat"]).'</p>';
            }while($tab=$req->fetch());
            ?>
        </div>

        <!-- Formulaire minichat -->
        
        <form name="form" method="post" action="">
            <div class="label">Message</div>
                <input type="text" name="msg" rows="4" cols="47" />
            <div>
                <br/>
                <input type="submit" name="valider" value="Envoyer" />
            </div>
        </form>

    </div>

    <!-- Pied de page-->
    <?php include_once("./Commons/footer.php"); ?>