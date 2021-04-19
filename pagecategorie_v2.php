<?php

// CAT : 1 = Jouets , 4 = Vêtements , 7 = Livres , 8 = DVD/Blu-ray
// SOUS CAT : 1 = bébé , 2 = fille , 3 = garçon

if (isset($_GET)) {

    switch (@$_GET['cat']) {
        case 1:
            $nom = "Jouets";
            $style_border = "2px solid blueviolet";
            $style_bg = "lightgreen";
            break;

        case 4:
            $nom = "Vêtements";
            $style_border = "2px solid blueviolet";
            $style_bg = "darkturquoise";
            break;

        case 7:
            $nom = "Livres";
            $style_border = "2px solid blueviolet";
            $style_bg = "lightgoldenrodyellow";
            break;

        case 8:
            $nom = "DVD/Blu-ray";
            $style_border = "2px solid blueviolet";
            $style_bg = "lightblue";
            break;

        default:
            $nom = 0;
            // BackUp Couleur
            $style_border = "2px solid blueviolet";
            $style_bg = "rgba(243, 57, 181, 0.568)";
    }

    switch (@$_GET['souscat']) {
        case 1:
            $souscat = "Bébé";
            break;

        case 2:
            $souscat = "Fille";
            break;

        case 3:
            $souscat = "Garçon";
            break;

        default:
            $souscat = 0;
    }
}
?>

<style>
    .wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(15em, 1fr));
        grid-auto-rows: auto;
        grid-gap: 10px;
    }

    .wrapper div {
        border: <?php echo $style_border; ?>;
        background-color: <?php echo $style_bg; ?>;
        padding-bottom: 15px;
    }

    .responsive {
        max-width: 100%;
        height: auto;
    }

    .btnadd {
        display: block;
        width: 200px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    .checked {
        color: gold;
    }
</style>

<?php
if (isset($_GET['cat']) and !isset($_GET['souscat'])) {

    if (!is_numeric($nom)) {
        $req1 = $pdo->prepare("SELECT * FROM produits , categories WHERE categories.nom = :nom AND produits.idcategorie = categories.id") or die(print_r($pdo->errorInfo()));
        $req1->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req1->execute();
?>
        <h1 class="text-center"><?php echo "Liste de " . $nom; ?></h1>
        <div class="wrapper">
            <?php
            $i = 0;
            while ($data = $req1->fetch()) {
                //var_dump($data);
                if (isset($_POST['add' . $i])) {
                    ajouterArticle($data['titre'], 1, $data['prix']);
            ?>
                    <script>
                        window.location.href = "index.php?page=<?php echo $page . "&cat=" . $_GET['cat']; ?>";
                    </script>
                <?php
                }
                ?>

                <div class="form-group">
                    <a href="index.php?page=pagearticle_v2&id=<?php echo $data['reference']; ?>"><img src="images/coco.jpg" class="responsive" alt="coco"></a>

                    <ul class="">
                        <li>Titre : <?php echo $data['titre'] ?></li>
                        <li>Support : <?php echo $data['nom']; ?></li>
                        <li>Sous Cat : <?php echo $data['souscat']; ?></li>
                        <li>Avis clients<br>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span></li>
                        <li>Prix : <?php echo $data['prix']; ?> €</li>
                    </ul>

                    <form method="POST">
                        <button class="btnadd btn btn-primary text-center" name="add<?php echo $i; ?>">Ajouter au panier</button>
                    </form>
                </div>

            <?php
                $i++;
            }
            ?>
        </div>
    <?php
    } else {
        // Mauvaise catégorie
        echo "Erreur 1 ! Mauvaise catégorie sélectionnée !";
    }
}

if (isset($_GET['cat']) and isset($_GET['souscat'])) {

    if (!is_numeric($souscat)) {
        $req1 = $pdo->prepare("SELECT * FROM produits , categories WHERE categories.nom = :nom AND categories.souscat = :souscat AND produits.idcategorie = categories.id") or die(print_r($pdo->errorInfo()));
        $req1->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req1->bindValue(':souscat', $souscat, PDO::PARAM_STR);
        $req1->execute();

    ?>
        <h1 class="text-center"><?php echo "Liste de " . $nom . " pour " . $souscat; ?></h1>
        <div class="wrapper">
            <?php
            $i = 0;
            while ($data = $req1->fetch()) {
                //var_dump($data);
                if (isset($_POST['add' . $i])) {
                    ajouterArticle($data['titre'], 1, $data['prix']);
            ?>
                    <script>
                        window.location.href = "index.php?page=<?php echo $page . "&cat=" . $_GET['cat'] . "&souscat=" . $_GET['souscat']; ?>";
                    </script>
                <?php
                }
                ?>

                <div class="form-group">
                    <a href="index.php?page=pagearticle_v2&id=<?php echo $data['reference']; ?>"><img src="images/coco.jpg" class="responsive" alt="coco"></a>

                    <ul class="">
                        <li>Titre : <?php echo $data['titre'] ?></li>
                        <li>Support : <?php echo $data['nom']; ?></li>
                        <li>Sous Cat : <?php echo $data['souscat']; ?></li>
                        <li>Avis clients<br>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span></li>
                        <li>Prix : <?php echo $data['prix']; ?> €</li>
                    </ul>

                    <form method="POST">
                        <button class="btnadd btn btn-primary text-center" name="add<?php echo $i; ?>">Ajouter au panier</button>
                    </form>
                </div>

            <?php
                $i++;
            }
            ?>
        </div>
    <?php
    } else {
        // Mauvaise Sous catégorie
        echo "Erreur 2 ! Mauvaise sous catégorie sélectionnée !";
    }
}

// Affichage Catégories
if (!isset($_GET['cat'])) {

    $sql2 = $pdo->prepare("SELECT max(id) as last_cat FROM categories");
    $sql2->execute();
    $data = $sql2->fetch(PDO::FETCH_ASSOC);
    $last_cat = $data['last_cat'];

    // Vérification que les catégories existent
    if ($last_cat !== 8) {
        echo '<h5 class="container_h5 text-center">Contactez un <b>Admin</b> pour générer des catégories !</h5>';
    } else {

    ?>
        <div class="touteslescat text-center">
            <ul class="ulcat">
                <?php
                $req1 = $pdo->prepare("SELECT id, nom FROM categories GROUP BY nom") or die(print_r($pdo->errorInfo()));
                $req1->execute();
                while ($data = $req1->fetch()) {
                    $link = "index.php?page=pagecategorie_v2&cat=" . $data['id'];
                ?>
                    <li>
                        <span class="cat">
                            <?php
                            echo '<a href=" ' . $link . ' ">' . securite($data['nom']) . "</a>";
                            ?>
                        </span>
                    </li>
                <?php
                    echo "<br>";
                }

                ?>
            </ul>
        </div>
<?php
    }
}
?>