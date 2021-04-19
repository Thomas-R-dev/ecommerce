<?php

if (isset($_SESSION['authOk'])) {

    // 0 = client , 1 = commerçant , 2 = admin
    switch ($_SESSION['connecte']->getRang()) {
        case "Client":
            $rank = 0;
            break;
        case "Commerçant":
            $rank = 1;
            break;
        case "Admin":
            $rank = 2;
            break;
    }

    if (isset($rank)) {
        if ($rank === 1) {
            echo "<a href='index.php?page=pageespaceclient'>Client</a> | <a href='index.php?page=pageespaceclient&rank=1'>Commerçant</a><br>";
        }
        if ($rank === 2) {
            echo "<a href='index.php?page=pageespaceclient'>Client</a> | <a href='index.php?page=pageespaceclient&rank=1'>Commerçant</a> | <a href='index.php?page=pageespaceclient&rank=2'>Admin</a><br>";
        }
    }


    if (isset($_GET['rank'])) {
        /////////////////////
        //                 //
        // PAGE COMMERCANT //
        //                 //
        /////////////////////
        if ($rank === 1 or $rank === 2 && $_GET['rank'] == 1) {
?>
            <!--Formulaire Commerçant-->
            <div class="container">

                <!--Coordonnées Commerçant-->
                <h1 class="container_h2">Espace Commerçant</h1>
                <br>

                <?php
                // Modifier Profil
                if (isset($_POST['modif1'])) {
                    $societe = $_POST['societe'];
                    $siret = $_POST['siret'];

                    if (is_numeric($siret)) {
                        $req = $pdo->prepare('UPDATE utilisateurs 
                                        SET societe = :societe,
                                            siret = :siret
                                        WHERE id = :id');
                        $req->execute(array(
                            'societe' => $societe,
                            'siret' => $siret,
                            'id' => $_SESSION['id']
                        ));

                        $_SESSION['connecte']->setSociete($societe);
                        $_SESSION['connecte']->setSiret($siret);
                    } else {
                        echo "Votre SIRET n'est pas valide !";
                    }

                ?>
                    <script>
                        window.location.href = "index.php?page=pageespaceclient&rank=1";
                    </script>
                <?php
                }
                ?>

                <form method="POST" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <p><em>Si vous êtes un commerçant, veuillez indiquer l'adresse de votre siège social dans les champs "Adresse" , "Code postal" et "Ville" dans l'<a href="index.php?page=pageespaceclient">Espace Client</a>.</em></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="societe">* Société:</label>
                            <input type="text" class="form-control" id="societe" placeholder="Indiquez le nom de votre société" name="societe" value="<?php echo $_SESSION['connecte']->getSociete(); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="siret">* N° Siret:</label>
                            <input type="text" class="form-control" id="siret" placeholder="Indiquez votre n° de SIRET" name="siret" step="1" minlength="11" pattern=".{11,14}" value="<?php echo $_SESSION['connecte']->getSiret(); ?>" required>
                        </div>
                    </div>
                    <span class="btn_center">
                        <button type="submit" class="btn btn-primary" name="modif1">Modifier</button>
                    </span>
                </form>

                <hr>
                <h4 class="container_h4 text-center">Ajouter un article à vendre</h4>

                <?php
                $sql2 = $pdo->prepare("SELECT max(id) as last_cat FROM categories");
                $sql2->execute();
                $data = $sql2->fetch(PDO::FETCH_ASSOC);
                $last_cat = $data['last_cat'];

                // Vérification que les catégories existent
                if ($last_cat !== 8) {
                    echo '<h5 class="container_h5 text-center">Contactez un <b>Admin</b> pour générer des catégories<br> avant de vendre un article !</h5>';
                } else {

                    if (isset($_POST['send']) and $_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST) and !empty($_POST)) {
                            $titre = $_POST['titre'];
                            $description = $_POST['description'];
                            $prix = $_POST['prix'];
                            $nbre = $_POST['nbre'];
                            $categorie = $_POST['categorie'];

                            if ($categorie !== "Erreur !") { // Validation
                                $sql1 = $pdo->prepare("INSERT INTO produits (titre, description, prix, quantite, disponible, idcategorie, idcommercant) VALUES (?,?,?,?,?,?,?)") or die(print_r($pdo->errorInfo()));
                                $sql1->execute(array($titre, $description, $prix, $nbre, "En stock", $categorie, $_SESSION['id']));
                                echo "Produit ajouté !";
                            } else { // Erreur
                                echo $categorie;
                            }
                        }
                    }
                ?>

                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="designation"><span class="error">* </span>Titre:</label>
                                <input type="text" class="form-control" id="designation" placeholder="Indiquez le titre/intitulé du produit" name="titre" value="Article <?php echo rand(0, 1000); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="reference"><span class="error">* </span>Description:</label>
                                <input type="text" class="form-control" id="reference" placeholder="Décrivez votre produit" name="description" value="test" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="prix"><span class="error">* </span>Prix:</label>
                                    <input type="number" class="form-control" id="prix" name="prix" placeholder="Votre prix" value="<?php echo rand(1, 100) . "." . rand(0, 99); ?>" required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="quantite"><span class="error">* </span>Quantité:</label>
                                <input type="number" class="form-control" id="quantite" name="nbre" placeholder="La quantité" step="1" value="<?php echo rand(1, 50); ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="categorie"><span class="error">* </span>Catégorie:</label>
                                    <select name="categorie" class="form-control" required>
                                        <optgroup label="Jouets">
                                            <option value="1">Jouets Bébé</option>
                                            <option value="2">Jouets Fille</option>
                                            <option value="3">Jouets Garçon</option>
                                        </optgroup>
                                        <optgroup label="Vêtements">
                                            <option value="4">Vêtements Bébé</option>
                                            <option value="5">Vêtements Fille</option>
                                            <option value="6">Vêtements Garçon</option>
                                        </optgroup>
                                        <optgroup label="Livres">
                                            <option value="7">Livres</option>
                                        </optgroup>
                                        <optgroup label="DVD/Blu-ray">
                                            <option value="8">DVD/Blu-ray</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="photo1">Photo 1:</label>
                                <input type="file" class="form-control" id="photo1" name="photo1">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="photo2">Photo 2:</label>
                                <input type="file" class="form-control" id="photo2" name="photo2">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="photo3">Photo 3:</label>
                                <input type="file" class="form-control" id="photo3" name="photo3">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="photo4">Photo 4:</label>
                                <input type="file" class="form-control" id="photo4" name="photo4">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="photo5">Photo 5:</label>
                                <input type="file" class="form-control" id="photo5" name="photo5">
                            </div>
                        </div>
                        <p id="oblig">Tous les champs marqués d'une " <span class="error">*</span> " sont obligatoires.</p>
                        <div class="btn_center">
                            <button type="submit" class="btn btn-primary" name="send">Ajouter</button>
                            <button type="reset" class="btn btn-primary" id="res">Effacer</button>
                        </div>
                    </form>
                <?php
                }
                ?>
                <br>
                <hr>

                <h4 class="container_h4 text-center">Liste de vos Articles</h4>
                Nombre total de produits :
                <?php
                $req1 = $pdo->prepare("SELECT count(reference) as total FROM produits WHERE idcommercant = :id") or die(print_r($pdo->errorInfo()));
                $req1->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
                $req1->execute();
                $data = $req1->fetch();
                echo $data['total'];
                ?>

                <table class="table">
                    <tr>
                        <th>Référence</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Catégorie</th>
                    </tr>

                    <?php
                    $req1 = $pdo->prepare("SELECT * FROM produits WHERE idcommercant = :id") or die(print_r($pdo->errorInfo()));
                    $req1->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
                    $req1->execute();

                    while ($data = $req1->fetch()) {

                        switch ($data['idcategorie']) {
                            case 1:
                                $categorie = "Jouets Bébé";
                                break;

                            case 2:
                                $categorie = "Jouets Fille";
                                break;

                            case 3:
                                $categorie = "Jouets Garçon";
                                break;

                            case 4:
                                $categorie = "Vêtements Bébé";
                                break;

                            case 5:
                                $categorie = "Vêtements Fille";
                                break;

                            case 6:
                                $categorie = "Vêtements Garçon";
                                break;

                            case 7:
                                $categorie = "Livres";
                                break;

                            case 8:
                                $categorie = "DVD/Blu-ray";
                                break;

                            default:
                                $categorie = "Erreur !";
                        }

                        if (isset($_POST['delete'])) {
                            $pdo->query('DELETE FROM produits WHERE reference = ' . $data['reference']);
                    ?>
                            <script>
                                window.location = "index.php?page=pageespaceclient&rank=1"
                            </script>
                        <?php
                            die;
                        }

                        if (isset($_POST['modifier'])) {
                        ?>
                            <script>
                                window.location = "index.php?page=pageespaceclient&rank=1"
                            </script>
                        <?php
                            die;
                        }
                        ?>

                        <tr>
                            <td><?php echo securite($data['reference']); ?></td>
                            <td><a href="index.php?page=pagearticle_v2&id=<?php echo securite($data['reference']); ?>"><?php echo securite($data['titre']); ?></a></td>
                            <td><?php echo securite($data['description']); ?></td>
                            <td><?php echo securite($data['prix']); ?> €</td>
                            <td><?php echo securite($data['quantite']); ?></td>
                            <td><?php echo securite($categorie); ?></td>
                            <td>

                                <form method="post" action="">
                                    <input type="submit" value="Supprimer" name="delete">
                                    <input1 type="submit" value="" name="modifier">
                                </form>
                            </td>
                        </tr>
                    <?php
                        // var_dump($data); // Debug
                    }
                    ?>
                </table>

            </div>
        <?php
        } elseif ($rank === 0) {
        ?>
            <script>
                window.location = "index.php?page=pageespaceclient"
            </script>
        <?php
        }

        ////////////////
        //            //
        // PAGE ADMIN //
        //            //
        ////////////////
        if ($rank == 2 && $_GET['rank'] == 2) {
        ?>
            <!--Formulaire Admin-->
            <div class="container">

                <!-- Coordonnées Admin -->
                <h1 class="container_h2">Espace Admin</h1>
                Maintenance du site : <input id="toggle-trigger" type="checkbox" data-toggle="toggle" data-onstyle="primary">
                <!-- JS lié au bouton , ne pas supprimer -->
                <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

                <hr>
                <h4>Liste des Clients</h4>
                <?php
                echo '<table border="2">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Actions</th>
                    <th>Statut</th>
                </tr>';


                $tab = array(
                    "ID" => array(0, 1, 2, 3, 4, 5),
                    "Nom" => array("Ab", "De", "xy", "cd", "mw", "bla"),
                    "Prenom" => array("Paul", "Pierre", "Mark", "Frank", "Eric", "ça marche"),
                    "Statut" => array("Activé", "Désactivé", "Désactivé", "Activé", "Activé", "Désactivé")
                );

                for ($i = 0; $i < count($tab['ID']); $i++) {
                    echo "<tr>" . "\n";
                    echo "<td>" . $tab['ID'][$i] . "</td>" . "\n";
                    echo "<td>" . $tab['Nom'][$i] . "</td>" . "\n";
                    echo "<td>" . $tab['Prenom'][$i] . "</td>" . "\n";
                    echo "<td> <input type='button' value='Modifier'> <input type='button' value='Supprimer'></td>" . "\n";
                    echo "<td>" . $tab['Statut'][$i] . "</td>" . "\n";
                    echo "</tr>" . "\n";
                }
                echo '</table>';
                ?>

                <hr><br>
                <h4>Liste des Commerçants</h4>
                <?php
                echo '<table border="2">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Actions</th>
                    <th>Statut</th>
                </tr>';

                for ($i = 0; $i < count($tab['ID']); $i++) {
                }
                echo '</table>';
                ?>

                <hr>
                <h5>Nombre total d'Utilisateurs : 16</h5>
                <h5>Nombre total de Produits : 16</h5>
                <br>

                <hr>
                <h4>Générer les Catégories</h4>
                <?php
                if (isset($_POST['send1']) and $_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST) and !empty($_POST)) {

                        $cat1 = "Jouets";      // $_POST['cat1'];
                        $cat2 = "Vêtements";   // $_POST['cat2'];
                        $cat3 = "Livres";      // $_POST['cat3'];
                        $cat4 = "DVD/Blu-ray"; // $_POST['cat4'];

                        $sql1 = $pdo->prepare("INSERT INTO categories (nom,souscat) VALUES (?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($cat1, "Bébé"));

                        $sql1 = $pdo->prepare("INSERT INTO categories (nom,souscat) VALUES (?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($cat1, "Fille"));

                        $sql1 = $pdo->prepare("INSERT INTO categories (nom,souscat) VALUES (?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($cat1, "Garçon"));

                        $sql1 = $pdo->prepare("INSERT INTO categories (nom,souscat) VALUES (?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($cat2, "Bébé"));

                        $sql1 = $pdo->prepare("INSERT INTO categories (nom,souscat) VALUES (?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($cat2, "Fille"));

                        $sql1 = $pdo->prepare("INSERT INTO categories (nom,souscat) VALUES (?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($cat2, "Garçon"));

                        $sql1 = $pdo->prepare("INSERT INTO categories (nom,souscat) VALUES (?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($cat3, ""));

                        $sql1 = $pdo->prepare("INSERT INTO categories (nom,souscat) VALUES (?,?)") or die(print_r($pdo->errorInfo()));
                        $sql1->execute(array($cat4, ""));
                    }
                }

                $sql2 = $pdo->prepare("SELECT max(id) as last_cat FROM categories");
                $sql2->execute();
                $data = $sql2->fetch(PDO::FETCH_ASSOC);
                $last_cat = $data['last_cat'];

                if ($last_cat !== 8) {
                ?>
                    <form method="post" action="">
                        <table>
                            <tr>
                                <td><input type="text" name="cat1" value="Jouets" disabled></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="cat2" value="Vêtements" disabled></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="cat3" value="Livres" disabled></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="cat4" value="DVD/Blu-ray" disabled></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="send1" value="Envoyer"></td>
                            </tr>
                        </table>
                    </form>
                <?php
                } else {
                    echo "<center>Catégories déjà générées !</center>";
                }
                ?>

                <hr>
                <h4>Chargez les tables</h4>
                Vérifier d'avoir la base de données "toys4us" dans MySQL !
                <br>
                Supprimez les tables de votre base de données "toys4us" puis chargez les ici !
                <br><br>
                <?php
                if (isset($_POST['loadTable']) and $_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST) and !empty($_POST)) {

                        $sql = implode(array_map(function ($v) {
                            return file_get_contents($v);
                        }, glob("toys4us.sql")));
                        $qr = $pdo->exec($sql);

                        echo "<b>Tables chargées !</b>";
                    }
                }
                ?>
                <form method="post" action="">
                    <table>
                        <tr>
                            <td><input type="submit" name="loadTable" value="Chargez les tables !"></td>
                        </tr>
                    </table>
                </form>
            </div>
        <?php
        } elseif ($rank === 0) {
        ?>
            <script>
                window.location = "index.php?page=pageespaceclient"
            </script>
        <?php
        }
    }

    /////////////////
    //             //
    // PAGE CLIENT //
    //             //
    /////////////////
    if (!isset($_GET['rank'])) {
        //var_dump($_SESSION['connecte']); // DEBUG
    ?>

        <!--Formulaire Client-->
        <div class="container">

            <!--Coordonnées Client-->
            <h1 class="container_h1">Espace Client</h1>

            <?php
            // Modifier Profil
            if (isset($_POST['modif1']) and $_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST) and !empty($_POST)) {
                    $adresse = $_POST['adresse'];
                    $adressesup = $_POST['adressesup'];
                    $codepostal = $_POST['codepostal'];
                    $ville = $_POST['ville'];
                    $telmobile = $_POST['mobile'];
                    $telfixe = $_POST['fixe'];

                    $req = $pdo->prepare('UPDATE utilisateurs 
                                        SET adresse = :adresse,
                                            adressesup = :adressesup,
                                            codepostal = :codepostal,
                                            ville = :ville,
                                            telephonemobile = :telmobile,
                                            telephonefixe = :telfixe
                                        WHERE id = :id');
                    $req->execute(array(
                        'adresse' => $adresse,
                        'adressesup' => $adressesup,
                        'codepostal' => $codepostal,
                        'ville' => $ville,
                        'telmobile' => $telmobile,
                        'telfixe' => $telfixe,
                        'id' => $_SESSION['id']
                    ));

                    $_SESSION['connecte']->setAdresse($adresse);
                    $_SESSION['connecte']->setAdressesup($adressesup);
                    $_SESSION['connecte']->setCodePostal($codepostal);
                    $_SESSION['connecte']->setVille($ville);
                    $_SESSION['connecte']->setTelMobile($telmobile);
                    $_SESSION['connecte']->setTelFixe($telfixe);
            ?>
                    <script>
                        window.location.href = "index.php?page=pageespaceclient";
                    </script>
            <?php
                }
            }

            // Modifier Compte
            if (isset($_POST['modif2']) and $_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST) and !empty($_POST)) {
                    $oldMdp = $_POST['oldmdp'];
                    $newMdp1 = $_POST['newmdp1'];
                    $newMdp2 = $_POST['newmdp2'];

                    if ($oldMdp === $_SESSION['mdpconnect']) {
                        if ($newMdp1 === $newMdp2) {
                            $req = $pdo->prepare('UPDATE comptes 
                                        SET password = :newmdp2
                                        WHERE idutilisateur = :id');
                            $req->execute(array(
                                'newmdp2' => cryptMdp($newMdp2),
                                'id' => $_SESSION['id']
                            ));
                            $_SESSION['mdpconnect'] = $_POST['newmdp2'];
                        } else {
                            echo "Les 2 mots de passe ne correspondent pas !";
                        }
                    } else {
                        echo "Votre ancien mot de passe est incorrect !";
                    }
                }
            }
            ?>

            <form method="POST" action="">
                <div class="form-group">

                    <label for="genre">Civilité:</label>
                    <select id="genre" class="form-control" required disabled>
                        <option <?php if ($_SESSION['connecte']->getGenre() === "M.") {
                                    echo "selected";
                                } ?>>Monsieur</option>
                        <option <?php if ($_SESSION['connecte']->getGenre() === "Mme.") {
                                    echo "selected";
                                } ?>>Madame</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" placeholder="Votre nom" name="nom" value="<?php echo securite($_SESSION['connecte']->getNom()); ?>" disabled required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" placeholder="Votre prenom" name="prenom" value="<?php echo securite($_SESSION['connecte']->getPrenom()); ?>" disabled required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="naissance">Date de naissance:</label>
                    <input type="date" class="form-control" id="naissance" name="naissance" value="<?php echo securite($_SESSION['connecte']->getDateNaissance()); ?>" disabled required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="adresse">* Adresse:</label>
                        <input type="text" class="form-control" id="adresse" placeholder="Votre adresse" name="adresse" value="<?php echo securite($_SESSION['connecte']->getAdresse()); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="adresse_sup">Supplément d'adresse:</label>
                        <input type="text" class="form-control" id="adresse_sup" placeholder="N°d'immeuble, lieu-dit, etc" name="adressesup" value="<?php echo securite($_SESSION['connecte']->getAdressesup()); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cp">* Code postal:</label>
                        <input type="number" class="form-control" id="cp" placeholder="Votre code postal" name="codepostal" min="0" maxlength="5" onKeyPress="if(this.value.length==5) return false;" value="<?php echo securite($_SESSION['connecte']->getCodePostal()); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ville">* Ville:</label>
                        <input type="text" class="form-control" id="ville" placeholder="Votre ville" name="ville" value="<?php echo securite($_SESSION['connecte']->getVille()); ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mobile">* Téléphone mobile:</label>
                        <input type="text" class="form-control" id="mobile" placeholder="Votre n° de Téléphone mobile" name="mobile" value="<?php echo securite($_SESSION['connecte']->getTelMobile()); ?>" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="fixe">Téléphone fixe:</label>
                        <input type="text" class="form-control" id="fixe" placeholder="Votre n° de Téléphone fixe" name="fixe" value="<?php echo securite($_SESSION['connecte']->getTelFixe()); ?>">
                    </div>
                </div>
                <span class="btn_center">
                    <button type="submit" class="btn btn-primary" name="modif1">Modifier</button>
                </span>
            </form>
            <hr class="container_hr">


            <!--Coordonnées Connexion-->
            <form method="POST" action="">
                <h1 class="container_h1">Modifier son compte</h1>
                <div class="form-group">
                    <label for="login">E-mail:</label>
                    <input type="email" class="form-control" id="login" placeholder="Votre adresse e-mail" name="login" value="<?php echo securite($_SESSION['connecte']->getLogin()); ?>" disabled required>
                </div>
                <div class="form-group">
                    <label for="motdepasse">* Ancien Mot de passe:</label>
                    <input type="password" class="form-control" id="motdepasse" placeholder="Votre ancien mot de passe" name="oldmdp" required>
                </div>
                <div class="form-group">
                    <label for="motdepasse">* Nouveau Mot de passe:</label>
                    <input type="password" class="form-control" id="motdepasse" placeholder="Votre nouveau mot de passe" name="newmdp1" required>
                </div>
                <div class="form-group">
                    <label for="motdepassebis">* Confirmation nouveau mot de passe:</label>
                    <input type="password" class="form-control" id="motdepassebis" placeholder="Confirmez votre nouveau mot de passe" name="newmdp2" required>
                </div>
                <p id="oblig">Tous les champs marqués d'une ' * ' sont obligatoires.</p>
                <span class="btn_center">
                    <button type="submit" class="btn btn-primary" name="modif2">Modifier</button>
                </span>
            </form>

            <hr>
            <h1 class="container_h1 text-center">Historique des commandes</h1>
            <br><br>

            <?php
            if (true) {
            ?>
                <table class="table">
                    <tr>
                        <th>N° Facture</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Total</th>
                        <th>Détails</th>
                    </tr>
                    <?php
                    $req1 = $pdo->prepare("SELECT * FROM factures WHERE id_compte = :login") or die(print_r($pdo->errorInfo()));
                    $req1->execute(array(':login' => $_SESSION['connecte']->getLogin()));
                    $i = 0;
                    while ($data = $req1->fetch()) {
                        echo "<tr>" . "\n";
                        echo "<td>" . $data['numfacture'] . "</td>" . "\n";
                        echo "<td>" . $data['date'] . "</td>" . "\n";
                        echo "<td>" . $data['statut'] . "</td>" . "\n";
                        echo "<td>" . $data['total'] . " €</td>" . "\n";
                        echo '<td><a href="" data-toggle="collapse" data-target="#accordion' . $i . '" class="clickable">+ Détails</a></td>' . "\n";
                        echo "</tr>" . "\n" . "\n";

                        echo "<tr>" . "\n";
                        echo '<td colspan="5"><div id="accordion' . $i . '" class="collapse">';
                        $req2 = $pdo->prepare("SELECT * FROM commandes WHERE n_facture = :numfacture") or die(print_r($pdo->errorInfo()));
                        $req2->execute(array(':numfacture' => $data['numfacture']));
                    ?>
                        <table border="0">
                            <?php
                            while ($data = $req2->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $data['nomproduit'] . "</td>";
                                echo "<td>Quantité : " . $data['qteproduit'] . "</td>";
                                echo "<td>" . $data['prixproduit'] . " € </td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    <?php
                        echo '</div></td>' . "\n";
                        echo "</tr>" . "\n";
                        $i++;
                    }
                    ?>
                </table>
            <?php
            }
            ?>
        </div>
<?php
    }
} else {
    echo "<center>Vous n'êtes pas connecté ! <a href='index.php?page=pageconnexion'>Connectez-vous</a> !</center>";
}
