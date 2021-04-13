<title> Profil </title>

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

<div id="login">
<h3 class="text-center text-white pt-5">Profil</h3>
<div class="container">
<div id="login-row" class="row justify-content-center align-items-center">
<div id="login-column" class="col-md-6">
<div id="login-box" class="col-md-12">
    <table>
        <tr><td>Login de l'utilisateur:</td><td><?=$_SESSION['login'] ?> </td></tr>
        <tr><td>Nom de l'utilisateur:</td><td><?=$_SESSION['nom'] ?> </td></tr>
        <tr><td>Prénom de l'utilisateur:</td><td><?=$_SESSION['prenom'] ?> </td></tr>
        <tr><td>Adresse email:</td><td><?=$_SESSION['email'] ?> </td></tr>
        <tr><td><a href="modif_profil.php"> Modifier mon profil</td></tr>
    </table>
</div>
</div>
</div>
</div>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>