<!DOCTYPE html>
    <html>
        <head>
            <title> Formulaire </title>
            <meta charset="utf-8"/>
            <!-- Bootstrap CSS -->
            <link href="../Bootstrap/css/bootstrap.css" rel="stylesheet"/>
        </head>
        <body>
            <!-- Header PHP-->
            <?php include_once("./Commons/header.php"); ?>

            <section>
                <form method="post" action="formulaire.php">
                    <table>
                        <tr>
                            <td>Prénom : </td> 
                            <td><input type="text" required name="prenom"/></td>
                        </tr>
                        <tr>
                            <td>Nom : </td> 
                            <td><input type="text" required name="nom"/></td>
                        </tr>
                        <tr>
                            <td>Pseudo : </td> 
                            <td><input type="text" required name="pseudo"/></td>
                        </tr>
                        <tr>
                            <td>Adresse mail : </td> 
                            <td><input type="text" required name="mail"/></td>
                        </tr>
                        <tr>
                            <td>Date de naissance : </td> 
                            <td><input type="date" name="dateDeNaissance"/></td>
                        </tr>
                        <tr>
                            <td>Numero de téléphone : </td> 
                            <td><input type="text" name="phoneNumber"/></td>
                        </tr>
                    </table>

                    <button type="submit" class="btn btn-outline-success mt-2">Envoyer</button> 
                    
                </form>

                <?php
                    if(isset($_POST['prenom']) && isset($_POST['nom'])){

                        $prenom = $_POST['prenom'];
                        $nom = $_POST['nom'];

                        echo 'Bonjour '. $prenom.' '.$nom.'!';
                    }
                ?>
            </section>
            
            <!-- Pied de page-->
            <footer>
            </footer>
    
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
            <!-- Bootstrap JS -->
            <script src="../Bootstrap/js/bootstrap.js"> </script>
        </body>
    </html>