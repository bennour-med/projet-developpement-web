<?php require 'commons/header.php';
require_once 'Commons/connexionBdd.php';
?>
<title>Verification</title>
</head><body>

//confirmation de l'inscription

<?php
//si il ya des parametres qui sont passé par l'URL
if($_GET){
//si l'email est passé par l'URL
if(isset($_GET['email'])){
	$email = $_GET['email'];//recuperer la valeur de l'email ds une variable
}
//si le token est passé par l'URL
if(isset($_GET['token'])){
	$token = $_GET['token'];
}

//on verifie si les deux variable ne sont pas vides
if(!empty($email) && !empty($token)){

		$requete = $bdd->prepare('SELECT * FROM pdweb.users WHERE email=:email');
		$requete->bindvalue(':email',$email);

		$requete->execute();

		//calculé le nombre d'enregistrements
		$nombre=$requete->rowCount();

		if($nombre==1){
			$update = $bdd->prepare('UPDATE pdweb.users SET validation=:validation, token=:token WHERE email=:email');

			$update->bindvalue(':validation',1);
			$update->bindvalue(':token','valide');
			$update->bindvalue(':email',$email);

			$resultUpdate=$update->execute();

			if($resultUpdate){
				echo "<script type=\"text/javascript\">
				alert('Votre adresse email est bien confirmée');
				document.location.href='login.php';
				</script>";


			}
		}
}
}















