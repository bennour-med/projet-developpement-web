<?php
    session_start();
    //si l'utilisateur n'est pas connecté, redirection vers la page de connexion
	if(@$_SESSION["autoriser"]!="oui"){
		header("location:login.php");
		exit();
	}
?>

<!-- Header avec class BS -->
<?php include_once("./Commons/header.php"); ?>

<!-- Contenu du site-->
<div class="border m-2 p-2 text-center"> 
    <h1>
        <?php 
            echo (date("H")<18)?("Bonjour"):("Bonsoir");
        ?>
        <span>
        <?=$_SESSION["nomPrenom"]?>
        </span>
    </h1>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>