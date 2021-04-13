<title> Inscription </title>

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
	@$email=$_POST["email"];
	@$pass=$_POST["pass"];
	@$repass=$_POST["repass"];
	@$valider=$_POST["valider"];
	@$message="";

	//Si bouton se connecter appuyer
	if(isset($valider))
	{
		
		//si le login est vide ou il contient des caractères sépciaux
		//preg_match l'utilisateur utilise que les caractères spécifiés
	    if(empty($login) || !preg_match('/[a-zA-Z0-9]+/', $login)) $message = "<li>Votre login doit être une chaine de caractéres (alphanumérique) !</li>";

	    //si le mail est vide ou il n'est pas valide
	    //filter_var pour verifier s'il s'agit bien d'un mail en spécifiant une constante FILTER_VALIDATE_EMAIL
	    if(empty($email)|| !filter_var($email, FILTER_VALIDATE_EMAIL))$message .=  "<li>Rentrer une adresse email valide !</li>";

	    //si le password est vide ou il n'est pas conforme avec password2
	    if(empty($pass) || $pass != $repass) $message .= "<li>Rentrer un mot de passe valide</li>";

		//si une des cases n'est pas remplie correctement, message ajouté à la variable &message
		if(empty($nom)) $message.="<li>Non invalide!</li>";
		if(empty($prenom)) $message.="<li>Prénom invalide!</li>";
		if(empty($message))
		{
			//connexion à la bd
            include("Commons/connexionBdd.php");
			
			//preparation de la requete de recherche dans la base de donnée si login est deja existant
			$req=$bdd->prepare("SELECT id FROM users WHERE login=? limit 1");
            $req->setFetchMode(PDO::FETCH_ASSOC);
			
			//execute la requete avec le login saisi par l'utilisateur
            $req->execute(array($login));
			
			//tableau reprenant la rechercher ligne par ligne
			$tab=$req->fetchAll();

			//preparation de la requete de recherche dans la base de donnée si email est deja existant
			$req1=$bdd->prepare("SELECT id FROM users WHERE email=? limit 1");
            $req1->setFetchMode(PDO::FETCH_ASSOC);
			
			//execute la requete avec le login saisi par l'utilisateur
            $req1->execute(array($email));
			
			//tableau reprenant la rechercher ligne par ligne
			$tab1=$req1->fetchAll();

			//si login deja exitstant, message d'erreur
			if(count($tab)>0)
				$message="<li>Login existe déjà!</li>";

			//si login deja exitstant, message d'erreur
			if(count($tab1)>0)
				$message="<li>Adresse email existe déjà!</li>";
			//sinon ajout de l'utilisateur dans la bd et redirection vers la page de connexion
			else{
			        //créer une chaine de caractère aleatoire
			        function token_random_string($leng=20)
			        {
			          $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			          $token = '';
			          //on choisi aléatoirement un caractère puis le concaténé avec la chaine
			          for($i=0;$i<$leng;$i++)
			          {
			            $token.=$str[rand(0,strlen($str)-1)];
			          }
			         return $token;
			        }

			        $token = token_random_string(20);
			        
			        $password = password_hash($pass, PASSWORD_DEFAULT);

			        $requete = $bdd->prepare('INSERT INTO pdweb.users(date,nom,prenom,login,email,pass,token) VALUES(now(),?,?,?,?,?,?)');

					$requete->execute(array($nom,$prenom,$login,$email,$password,$token));

			        require('PHPMailer/PHPMailerAutoload.php');

			        $mail = new PHPMailer();
			        //Mailer peut utilisé le protocole SMTP
			        $mail ->isSMTP();
			        //pour designer le serveur
			        $mail->Host='smtp.gmail.com';
			        //pour activer l'authentification SMTP
			        $mail->SMTPAuth=true;
			        $mail->Username='sa.ben.iccbxl@gmail.com';
			        $mail->Password='@zerty123';
			        $mail->SMTPSecure = 'tls';
			        $mail->Port=587;
			        //$mail->SMTPDebug = 3;

			        //on veut envpoyer nos mail à partir de cette adresse
			        $mail->setFrom('sa.ben.iccbxl@gmail.com', 'SA&BEN');
			        //adresse de destination
			        $mail->addAddress($_POST['email']);

			        //spécifié que l'email peut etre sous forme html
			        $mail->isHTML(true);

			        //spécifié l'objet de l'email
			        $mail->Subject='Confirmation d\'email';

			        //spécifié le body de l'email
			        $mail->Body = 'Afin de valider votre adresse email, merci de cliquer sur le lien suivant:

			        <a href="http://localhost/PDWeb/Pages/verification.php?token='.$token.'&email='.$_POST['email'].' ">Confirmation</a>';

			         //test pour verifier si le mail a été bien envoyé
			        if(!$mail->send())
			        {//si le mail n'a pas été envoyé
			          $message = "Mail non envoyé";
			          echo 'Erreurs:'.$mail->ErrorInfo;//pour afficher le type de l'erreur
			        }
			        else
			        {
			           $message1 =  "Nous vous avons envoyé par courrier des instructions pour confirmer 
			                      votre adresse e-mail que vous avez fournie. 
			                      Vous devriez bientôt les recevoir.";
			        }
			    }

			header("location:login.php");
			
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

    <?php if(!empty($message1)){ ?>
            <div id="message1"><?php echo $message1 ?></div>
    <?php } ?>

    <!-- Formulaire d'inscription-->
    <form name="fo" method="post" action="" enctype="multipart/form-data">
        <div class="label">Nom</div>
            <input type="text" name="nom"/>

        <div class="label">Prénom</div>
            <input type="text" name="prenom"/>

        <div class="label">Login</div>
            <input type="text" name="login" value="<?php echo $login?>"/>

        <div class="label">Adresse Email</div>
            <input type="email" name="email"/>

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