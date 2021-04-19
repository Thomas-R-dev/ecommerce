<?php
require_once("functions/classes.php");
session_start();
require_once("functions/variables.php");

// Si connecté , on renvoie à l'accueil
if (isset($_SESSION['authOk'])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Inscription - <?php echo NOM_SITE; ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="css/inscription.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
    <div id="conteneur_titre">
        <h1 id="titre"><?php echo NOM_SITE; ?></h1>
    </div>

    <?php
    $verifComplete = 0;
    $genre = $nom = $prenom = $datenaissance = $adresse = $codepostal = $ville = $telmobile = $telfixe = $rang = $societe = $siret = $login = $motdepasse = $motdepasse2 = "";
    $genreErr = $nomErr = $prenomErr = $datenaissanceErr = $adresseErr = $codepostalErr = $villeErr = $telmobileErr = $telfixeErr = $rangErr = $societeErr = $siretErr = $loginErr = $motdepasseErr = $motdepasse2Err = "";

    if (isset($_POST['send']) and $_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST) and !empty($_POST)) {

            if (empty($_POST['genre'])) {
                $genreErr = "Votre civilité n'est pas sélectionnée !";
                $verifComplete = 0;
            } else {
                $genre = securite($_POST['genre']);
                $verifComplete += 1;
            }

            if (empty($_POST["nom"])) {
                $nomErr = "Votre nom est vide !";
                $verifComplete = 0;
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["nom"])) {
                $nomErr = "Lettres et espaces seulement !";
                $verifComplete = 0;
            } else {
                $nom = securite($_POST["nom"]);
                $verifComplete += 1;
            }

            if (empty($_POST["prenom"])) {
                $prenomErr = "Votre prénom est vide !";
                $verifComplete = 0;
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["prenom"])) {
                $prenomErr = "Lettres et espaces seulement !";
                $verifComplete = 0;
            } else {
                $prenom = securite($_POST["prenom"]);
                $verifComplete += 1;
            }

            if (empty($_POST['datenaissance'])) {
                $datenaissanceErr = "Votre date de naissance est vide !";
                $verifComplete = 0;
            } elseif (!verifAge($_POST['datenaissance'], $age = 18)) {
                $datenaissanceErr = "Vous n'avez pas 18 ans !";
                $verifComplete = 0;
            } else {
                $datenaissance = securite($_POST['datenaissance']);
                $verifComplete += 1;
            }

            if (empty($_POST['adresse'])) {
                $adresseErr = "Votre adresse est vide !";
                $verifComplete = 0;
            } else {
                $adresse = securite($_POST['adresse']);
                $adresse_sup =  securite($_POST['adresse_sup']);
                $verifComplete += 1;
            }



            if (empty($_POST['codepostal'])) {
                $codepostalErr = "Votre code postal est vide !";
                $verifComplete = 0;
            } elseif (!is_numeric($_POST['codepostal'])) {
                $codepostalErr = "Votre code postal n'est pas numérique !";
                $verifComplete = 0;
            } elseif (strlen($_POST['codepostal']) != 5) {
                $codepostalErr = "Votre code postal doit faire 5 chiffres !";
                $verifComplete = 0;
            } else {
                $codepostal = securite($_POST['codepostal']);
                $verifComplete += 1;
            }

            if (empty($_POST['ville'])) {
                $villeErr = "Votre ville est vide !";
                $verifComplete = 0;
            } else {
                $ville = securite($_POST['ville']);
                $verifComplete += 1;
            }

            if (empty($_POST['telmobile'])) {
                $telmobileErr = "Votre téléphone mobile est vide !";
                $verifComplete = 0;
            } elseif (!is_numeric($_POST['telmobile'])) {
                $telmobileErr = "Votre téléphone mobile n'est pas numérique !";
                $verifComplete = 0;
            } elseif (strlen($_POST['telmobile']) != 10) {
                $telmobileErr = "Votre téléphone mobile doit faire 10 chiffres !";
                $verifComplete = 0;
            } else {
                $telmobile = securite($_POST['telmobile']);
                $verifComplete += 1;
            }

            /*  Code pas fini
        if (!empty($_POST['telfixe'])) {
            $telfixeErr = "";
        } elseif (!is_numeric($_POST['telfixe'])) {
            $telfixeErr = "Votre téléphone fixe n'est pas numérique !";
        } elseif (strlen($_POST['telfixe']) != 10) {
            $telfixeErr = "Votre téléphone fixe doit faire 10 chiffres !";
        } else {
            $telfixe = securite($_POST['telfixe']);
        }*/

            if (isset($_POST['rang']) === "Commerçant") {
                if (empty($_POST['societe'])) {
                    $societeErr = "Votre nom de société est vide !";
                    //$verifComplete = 0;
                } else {
                    $societe = securite($_POST['societe']);
                    //$verifComplete += 1;
                }

                if (empty($_POST['siret'])) {
                    $siretErr = "Votre SIRET est vide !";
                    //$verifComplete = 0;
                } elseif (!is_numeric($_POST['siret'])) {
                    $siretErr = "Votre SIRET n'est pas numérique !";
                    //$verifComplete = 0;
                } elseif (strlen($_POST['siret']) != 14) {
                    $siretErr = "Votre SIRET doit faire 14 chiffres !";
                    //$verifComplete = 0;
                } else {
                    $siret = securite($_POST['siret']);
                    //$verifComplete += 1;
                }
            }

            $siret = 12;
            $societe = "blabla";

            if (empty($_POST['login'])) {
                $loginErr = "Votre e-mail est vide !";
                $verifComplete = 0;
            } elseif (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
                $loginErr = "Votre e-mail n'est pas valide !";
                $verifComplete = 0;
            } else {
                $login = securite($_POST['login']);
                $verifComplete += 1;
            }

            if (empty($_POST['motdepasse'])) {
                $motdepasseErr = "Votre mot de passe est vide !";
                $verifComplete = 0;
            } elseif (strlen($_POST['motdepasse']) <= 5) {
                $motdepasseErr = "Votre mot de passe doit faire 5 caractères !";
                $verifComplete = 0;
            } elseif (empty($_POST['motdepasse2'])) {
                $motdepasseErr2 = "Votre mot de passe est vide !";
                $verifComplete = 0;
            } elseif (strlen($_POST['motdepasse2']) <= 5) {
                $motdepasse2Err = "Votre mot de passe doit faire 5 caractères !";
                $verifComplete = 0;
            } elseif ($_POST['motdepasse'] !== $_POST['motdepasse2']) {
                $motdepasse2Err = "Les 2 mots de passe sont différents !";
                $verifComplete = 0;
            } else {
                $mdpvalide = securite($_POST['motdepasse2']);
                $verifComplete += 1;
            }

            if (isset($_POST['auto1'])) {
                $verifComplete += 1;
            }

            if (empty($_POST['rang'])) {
                $rangErr = "Votre type de compte n'est pas sélectionné !";
            } else {
                $rang = securite($_POST['rang']);
            }

            if ($verifComplete === 11) {
                // Je vérifie que le nom et prénom ne sont pas pris dans la table Client
                $req1 = $pdo->prepare("SELECT nom , prenom FROM utilisateurs") or die(print_r($pdo->errorInfo()));
                $req1->execute();
                $data = $req1->fetch(PDO::FETCH_ASSOC);
                $nomExist = $data['nom'];
                $prenomExist = $data['prenom'];
                if ($nom == $nomExist and $prenom == $prenomExist) {
                    echo "<script>alert('Client déjà existant !');</script>";
                } else {
                    // Je vérifie que le login n'existe pas dans la table Compte
                    $req2 = $pdo->prepare("SELECT login as email FROM comptes") or die(print_r($pdo->errorInfo()));
                    $req2->execute();
                    $data = $req2->fetch(PDO::FETCH_ASSOC);
                    $loginExist = $data['email'];
                    if ($loginExist == $login) {
                        echo "<script>alert('E-mail déjà existant !');</script>";
                    } else {

                        // J'insère les données dans la table Client
                        $sql1 = $pdo->prepare("INSERT INTO utilisateurs(genre , nom , prenom , datenaissance , adresse , adressesup, codepostal , ville , telephonemobile , telephonefixe , societe , siret) 
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($genre, $nom, $prenom, $datenaissance, $adresse, $adresse_sup, $codepostal, $ville, $telmobile, $telfixe, $societe, $siret));

                        // Je vérifie la dernière ID dans la table Client
                        $sql2 = $pdo->prepare("SELECT max(id) as last_id FROM utilisateurs") or die(print_r($pdo->errorInfo()));
                        $sql2->execute();
                        $data = $sql2->fetch(PDO::FETCH_ASSOC);
                        $max_id = $data['last_id'];

                        // J'insère une fois que tout est bon dans la table Comptes
                        $sql3 = $pdo->prepare("INSERT INTO comptes (login , password , rang , idutilisateur ) VALUES (?,?,?,?)") or die(print_r($pdo->errorInfo()));
                        $sql3->execute(array($login, cryptMdp($mdpvalide), $rang, $max_id));
                        echo "<center>Inscription réussie !</center>";
                        //header('location: pageconnexion.php');
                        //header('location: ' . $_SERVER['PHP_SELF']);
                    }
                }
            }
        }
    }
    ?>

    <body>

        <!--Formulaire d'inscription-->
        <div class="container">

            <!-- Coordonnées Client -->
            <h2 class="container_h2">Coordonnées Client</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="genre"></label>
                    <select id="genre" name="genre" class="form-control" required>
                        <option value="M.">Monsieur</option>
                        <option value="Mme.">Madame</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom"><span class="error">* </span>Nom:</label>
                        <input type="text" class="form-control" id="nom" placeholder="Votre nom" name="nom" value="Marko" required>
                        <span class="error"><?php echo $nomErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom"><span class="error">* </span>Prénom:</label>
                        <input type="text" class="form-control" id="prenom" placeholder="Votre prenom" name="prenom" value="Polo" required>
                        <span class="error"><?php echo $prenomErr; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="naissance"><span class="error">* </span>Date de naissance:</label>
                    <input type="date" class="form-control" id="naissance" name="datenaissance" value="1980-07-10" required>
                    <span class="error"><?php echo $datenaissanceErr; ?></span>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="adresse"><span class="error">* </span>Adresse:</label>
                        <input type="text" class="form-control" id="adresse" placeholder="Votre adresse" name="adresse" value="20 rue du commerce " required>
                        <span class="error"><?php echo $adresseErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="adresse_sup">Supplément d'adresse:</label>
                        <input type="text" class="form-control" id="adresse_sup" placeholder="N°d'immeuble, lieu-dit, etc" name="adresse_sup" value="Pas de sonnette">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cp"><span class="error">* </span>Code postal:</label>
                        <input type="text" class="form-control" id="cp" placeholder="Votre code postal" name="codepostal" value="59000" required>
                        <span class="error"><?php echo $codepostalErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ville"><span class="error">* </span>Ville:</label>
                        <input type="text" class="form-control" id="ville" placeholder="Votre ville" name="ville" value="Toulouse" required>
                        <span class="error"><?php echo $villeErr; ?></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mobile"><span class="error">* </span>Téléphone mobile:</label>
                        <input type="text" class="form-control" id="mobile" placeholder="Votre n° de Téléphone mobile" name="telmobile" value="0612345678" required>
                        <span class="error"><?php echo $telmobileErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fixe">Téléphone fixe:</label>
                        <input type="text" class="form-control" id="fixe" placeholder="Votre n° de Téléphone fixe" name="telfixe">
                        <span class="error"><?php echo $telfixeErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fixe">Type de compte:</label>
                        <input type="radio" name="rang" value="Client" required> Client
                        <input type="radio" name="rang" value="Commerçant"> Commerçant
                        <span class="error"><?php echo $rangErr; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <p><em>Si vous êtes un commerçant, veuillez indiquer l'adresse de votre siège social dans les champs "adresse","Code postal" et "Ville".</em></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="societe">Société:</label>
                        <input type="text" class="form-control" id="societe" placeholder="Indiquez le nom de votre société" name="societe">
                        <span class="error"><?php echo $societeErr; ?></span>
                        <span class="error"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="siret">N° Siret:</label>
                        <input type="text" class="form-control" id="siret" placeholder="Indiquez votre n° de SIRET" name="siret" value="12345">
                        <span class="error"><?php echo $siretErr; ?></span>
                    </div>
                </div>
                <span class="btn_center">
                    <input type="reset" class="btn btn-primary" id="res1" value="Effacer">
                </span>
                <hr class="container_hr">

                <!-- Coordonnées Connexion -->
                <h2 class="container_h2">Coordonnées Connexion</h2>
                <div class="form-group">
                    <label for="login"><span class="error">* </span>E-mail:</label>
                    <input type="email" class="form-control" id="login" placeholder="Votre adresse e-mail" name="login" value="test@admin.com" required>
                    <span class="error"><?php echo $loginErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="motdepasse"><span class="error">* </span>Mot de passe:</label>
                    <input type="password" class="form-control" id="motdepasse" placeholder="Votre mot de passe" name="motdepasse" value="123456" required>
                    <span class="error"><?php echo $motdepasseErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="motdepassebis"><span class="error">* </span>Confirmation mot de passe:</label>
                    <input type="password" class="form-control" id="motdepassebis" placeholder="Confirmez votre mot de passe" name="motdepasse2" value="123456" required>
                    <span class="error"><?php echo $motdepasse2Err; ?></span>
                </div>
                <p id="oblig">Tous les champs marqués d'une " <span class="error">*</span> " sont obligatoires.</p>
                <div class="form-group form-check">
                    <label for="auto1" class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="auto1" name="auto1" checked required> Autorisation 1
                    </label>
                </div>
                <div class="form-group form-check">
                    <label for="auto2" class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="auto2" name="auto2"> Autorisation 2
                    </label>
                </div>
                <span class="btn_center">
                    <input type="submit" class="btn btn-primary" name="send" id="sub" value="Envoyer">
                    <input type="reset" class="btn btn-primary" id="res2" value="Effacer">
                </span>

            </form>
        </div>

        <?php


        //echo '<script>alert("Inscription réussie !")</script>';

        ?>

        <!--Boutons de navigation-->
        <div class="container2">
            <div class="btn-group">
                <button type="button" class="btn btn-primary"><a href="index.php" class="navlink">Accueil</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?page=pageconnexion" class="navlink">Connexion</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?page=pagefaq" class="navlink">FAQ</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?page=pagecontact" class="navlink">Contact</a></button>
            </div>
        </div>

        <!--Mentions légales,etc-->
        <div id="conteneur_mentions">
            <p id="mentions">Mentions légales et autres en petits caractères.</p>
        </div>
    </body>

</html>