<title> Connexion </title>

<?php
    session_start();

    //Si l'utilisateur est connecté, redirection vers index.php
    if(@$_SESSION["autoriser"]=="oui"){
        header("location:index.php");
        exit();
    }

    //creation de variable reprenant les saisies utilisateur
	@$email=$_POST['email'];
    @$login=$_POST["login"];
	@$password=$_POST["pass"];
	@$valider=$_POST["valider"];
    $message="";

    //Si bouton se connecter appuyer
	if(isset($valider))
    {
      require_once 'Commons/connexionBdd.php';

      $requete = $bdd->prepare('SELECT * FROM pdweb.users WHERE email=:email');
      $requete->execute(array('email'=>$email ));
      $result = $requete->fetch();

       if(!$result)
       {
        $message = "Merci de rentrer une adresse email valide";
       }
       elseif($result['validation']==0)
       {
           function token_random_string($leng=20)
           {
                $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $token = '';
                for($i=0;$i<$leng;$i++)
                {
                  $token.=$str[rand(0,strlen($str)-1)];
                }
                return $token;
            }

            $token = token_random_string(20);

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

            $mail->Body = 'Afin de valider votre adresse email, merci de cliquer sur le lien suivant:

            <a href="http://localhost/PDWeb/Pages/verification.php?token='.$token.'&email='.$_POST['email'].' ">Confirmation</a>';


          if(!$mail->send())
          { 
            $message = "Mail non envoyé";
            echo 'Erreurs:'.$mail->ErrorInfo;
          } 
          else
          { 
           $message =  "Votre adresse e-mail n'est pas encore confirmée, nous vous avons envoyé par courrier des instructions pour confirmer 
           votre adresse e-mail que vous avez fournie. 
           Vous devriez bientôt les recevoir.";  
          }
        }
        else 
        {
            $passwordIsOk = password_verify($password, $result['pass']);

            if($passwordIsOk)
            {
              session_start();
              $_SESSION["autoriser"]="oui";
              $_SESSION['id'] = $result['id'];
              $_SESSION["nomPrenom"]=strtoupper($result["nom"]." ".$result["prenom"]);
              $_SESSION['login'] = $result['login'];
              $_SESSION['email'] = $email;
              $_SESSION['nom'] = $result['nom'];
              $_SESSION['prenom'] = $result['prenom'];

              if(isset($_POST['sesouvenir']))
              {
               setcookie("email", $_POST['email']);
               setcookie("password", $_POST['pass']);
              } 
              else 
                {
                  if(isset($_COOKIE['email']))
                    {
                      setcookie($_COOKIE['email'], "");
                    }
                  if(isset($_COOKIE['password']))
                    {
                      setcookie($_COOKIE['password'], "");
                    }
                }
             header('location:session.php');
            }
            else
            {
                $message = "Merci de rentrer un mot de passe valide !";
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
        
    <!-- Formulaire de connexion-->
    <form name="form" method="post" action="">
        <div class="label">Adresse Email</div>
            <input type="email" name="email" value = <?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email'];} ?> >

        <div class="label">Mot de passe</div>
            <input type="password" name="pass" value = <?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?> >

        <div class="form-group">
            <label for="sesouvenir" class="text-info">Se souvenir de moi
            <input type="checkbox" name="sesouvenir" id="sesouvenir" ></label>
        </div>

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

        <a href="password_forget.php">Mot de passe oublié</a>
    </form>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>