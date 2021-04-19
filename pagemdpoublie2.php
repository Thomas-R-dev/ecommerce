<?php
session_start();
require_once("functions/variables.php");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Changer votre mot de passe - <?php echo NOM_SITE; ?></title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="css/mdpoublie.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!--<script src="https://kit.fontawesome.com/77e6c773b0.js"></script>-->
    </head>
    <body>
        <!--Logo du site-->
        <div id="conteneur_logo">
            <img src="<?php echo LOGO_SITE; ?>" alt="logo du site" id="logo">
        </div>

        <!--Nom du site-->
        <div id="conteneur_nom">
            <h1 id="nom"><?php echo NOM_SITE; ?></h1>
        </div>

        <!--Formulaire de login-->
        <div class="container">
            <form method="POST">
                <div class="form-group">
                    <label for="newmotdepasse">Nouveau mot de passe:</label>
                    <input type="password" class="form-control" id="newmotdepasse" placeholder="Choisissez un nouveau mot de passe" name="motdepasse" required>
                </div>
                <div class="form-group">
                    <label for="newmotdepasse_2">Confirmation nouveau mot de passe:</label>
                    <input type="password" class="form-control" id="newmotdepasse-2" placeholder="Confirmez votre nouveau mot de passe" name="motdepasse" required>
                </div>
                <input type="submit" onclick="alert('Votre mot de passe à été \nchangé avec succès!');" class="btn btn-primary">
                <input type="reset" class="btn btn-primary">
            </form>
        </div>

        <!--Boutons de navigation-->
        <div class="container2">
            <div class="btn-group">
                <button type="button" class="btn btn-primary"><a href="index.php" class="navlink">Accueil</a></button>
                <button type="button" class="btn btn-primary"><a href="pageconnexion.php" class="navlink">Connexion</a></button>
                <button type="button" class="btn btn-primary"><a href="pageinscription.php" class="navlink">Inscription</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?page=pagefaq" class="navlink">FAQ</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?page=pagecontact" class="navlink">Contact</a></button>
            </div> 
        </div>

        <!--Mentions légales,etc-->
        <div id="conteneur_mentions">
            <p id="mentions">mentions légales et autres en petits caractères</p>
        </div>
    </body>
</html>