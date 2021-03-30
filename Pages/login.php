<?php
    session_start();

    //Si l'utilisateur est connecté, redirection vers index.php
    if(@$_SESSION["autoriser"]=="oui"){
        header("location:index.php");
        exit();
    }

    //creation de variable reprenant les saisies utilisateur
	@$login=$_POST["login"];
	@$pass=$_POST["pass"];
	@$valider=$_POST["valider"];
    $message="";

    //Si bouton se connecter appuyer
	if(isset($valider)){
        include("Commons/connexionBdd.php");
        
        //preparation de la requete de recherche dans la base de donnée une correspondance de login/mdp
		$res=$bdd->prepare("select * from users where login=? and pass=? limit 1");
        $res->setFetchMode(PDO::FETCH_ASSOC);
        
        //execution de la requete avec les données saisies
        $res->execute(array($login,md5($pass)));
        
        $tab=$res->fetchAll();
        //si il y a récurrence, message d'erreur
		if(count($tab)==0)
			$message="<li>Mauvais login ou mot de passe!</li>";
        //sinon authentification et redirection vers l'espace perso
        else{
			$_SESSION["autoriser"]="oui";
            $_SESSION["nomPrenom"]=strtoupper($tab[0]["nom"]." ".$tab[0]["prenom"]);
            $_SESSION["login"]=strtolower($tab[0]["prenom"]);
			header("location:session.php");
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
        
    <!-- Formulaire de connexion-->
    <form name="form" method="post" action="">
        <div class="label">Login</div>
            <input type="text" name="login" value="<?php echo $login?>" />

        <div class="label">Mot de passe</div>
            <input type="password" name="pass" />
        <div>
            <br/>
            <input type="submit" name="valider" value="Se connecter" />
        </div>

        <div>
            <br/>
            <button type="button"> 
                <a href="inscription.php" class="text-white">Créer un compte</a>
            </button>
        </div>
    </form>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>