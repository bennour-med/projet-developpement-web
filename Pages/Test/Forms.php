<!-- Header avec class BS -->
<?php include_once("./Commons/header.php"); ?>

    <h1 class="text-center mt-2 text-black">Inscription</h1>

    <div class="border p-5 ml-5 mr-5 mb-5  p_minCorpSize"> 
        <form>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="formsPseudo">Pseudo</label>
                    <input type="text" class="form-control" id="formsPseudo" required>
                </div>
                <!-- <div class="custom-file col-md-6 mb-3">
                    <label class="custom-file-label" for="image">"png, jpeg, jpg""</label>
                    <input type="file" class="custom-file-input" id="image">
                </div> -->
                <!--
                <div class="col-md-6 mb-3">
                    <label for="formsImage">Photo (JPG, PNG ou GIF | max. 20 Ko):</label>
                    <input type="file" class="form-control" id="formsImage" >
                </div>
                -->
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="formsMail"><br/>Adresse mail</label>
                    <input type="mail" class="form-control" id="formsMail" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="formsPassword1">Mot de passe <br/>(entre 6 et 12 caractères)</label>
                    <input type="mail" class="form-control" id="formsPassword1" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="formsPassword2"><br/>Mot de passe </label>
                    <input type="text" class="form-control" id="formsPassword2" value="Répétez le mot de passe" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="formsNom">Nom</label>
                    <input type="text" class="form-control" id="formsNom" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="formsPrenom">Prénom</label>
                    <input type="text" class="form-control" id="formsPrenom" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="formsDdn">Date de naissance</label>
                    <input type="date" class="form-control" id="formsDdn" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-8 mb-3">
                    <label for="formsAdresse">Adresse</label>
                    <input type="text" class="form-control" id="formsAdresse" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="formsNumero">Numero</label>
                    <input type="text" class="form-control" id="formsNumero" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="formsBoite">Boite</label>
                    <input type="text" class="form-control" id="formsBoite">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="formsPays">Pays</label>
                    <select class="custom-select" id="formsPays" required>
                        <option selected disabled value="">Choose...</option>
                        <option>Allemagne</option>
                        <option>Belgique</option>
                        <option>Espagne</option>
                        <option>France</option>
                        <option>Italie</option>
                        <option>Luxembourg</option>
                        <option>Pays-Bas</option>
                        <option>Italie</option>
                        <option>Autre</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="formsCP">Code Postal</label>
                    <input type="text" class="form-control" id="formsCP" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="formsVille">Ville</label>
                    <input type="text" class="form-control" id="formsVille" required>
                </div> 
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input is-invalid" type="checkbox" value="" id="formsAgree" aria-describedby="invalidCheck3Feedback" required>
                    <label class="form-check-label" for="formsAgree">
                    J'accepte les conditions générales
                    </label>
                </div>
            </div>           
            <button class="btn btn-primary btn-lg btn-block" type="submit">S'incrire</button>
        </form>
    </div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>