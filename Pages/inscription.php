<?php
	@session_start();

	//Si l'utilisateur est connecté, redirection vers index.php
	if(@$_SESSION["autoriser"]=="oui"){
		header("location:index.php");
		exit();
	}

	//creation de variable reprenant les saisies utilisateur
	@$nom=$_POST["nom"];
	@$prenom=$_POST["prenom"];
	@$login=$_POST["login"];
	@$pass=$_POST["pass"];
	@$repass=$_POST["repass"];
	@$valider=$_POST["valider"];
	@$message="";

	//Si bouton se connecter appuyer
	if(isset($valider)){
		//si une des cases n'est pas remplie correctement, message ajouté à la variable &message
		if(empty($nom)) $message="<li>Non invalide!</li>";
		if(empty($prenom)) $message.="<li>Prénom invalide!</li>";
		if(empty($login)) $message.="<li>Login invalide!</li>";
		if(empty($pass)) $message.="<li>Mot de passe invalide!</li>";
		if($pass!=$repass) $message.="<li>Mots de passe non identiques!</li>";	
		if(empty($message)){
			//connexion à la bd
            include("Commons/connexionBdd.php");
			
			//preparation de la requete de recherche dans la base de donnée si login est deja existant
			$req=$bdd->prepare("SELECT id FROM users WHERE login=? limit 1");
            $req->setFetchMode(PDO::FETCH_ASSOC);
			
			//execute la requete avec le login saisi par l'utilisateur
            $req->execute(array($login));
			
			//tableau reprenant la rechercher ligne par ligne
			$tab=$req->fetchAll();

			//si login deja exitstant, message d'erreur
			if(count($tab)>0)
				$message="<li>Login existe déjà!</li>";
			//sinon ajout de l'utilisateur dans la bd et redirection vers la page de connexion
			else{
				$ins=$bdd->prepare("insert into users(date,nom,prenom,login,pass) values(now(),?,?,?,?)");
				$ins->execute(array($nom,$prenom,$login,md5($pass)));
				header("location:login.php");
			}
		}
	}
?>

<!-- Header avec class BS -->
<?php include_once("./Commons/header.php"); ?>

<!-- Contenu du site-->
<div class="border m-2 p-2"> 
    <!-- Affichage des messages d'erreurs formulaire SI il y en a-->
    <?php if(!empty($message)){ ?>
            <div id="message"><?php echo $message ?></div>
    <?php } ?>

    <!-- Formulaire d'inscription-->
    <form name="fo" method="post" action="" enctype="multipart/form-data">
        <div class="label">Nom</div>
            <input type="text" name="nom"/>

        <div class="label">Prénom</div>
            <input type="text" name="prenom"/>

        <div class="label">Login</div>
            <input type="text" name="login" value="<?php echo $login?>"/>

        <div class="label">Mot de passe</div>
            <input type="password" name="pass"/>
        
        
        <div class="label">Confirmation du mot de passe</div>
            <input type="password" name="repass"/>
        
        <div>
            <br/>
            <input type="submit" name="valider" value="S'inscrire" />
        </div>
    </form>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>