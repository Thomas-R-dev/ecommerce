<div class="container">
    <h2 class="container_h2 text-center">Votre Panier</h2>
</div>

<style>
    .wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(15em, 1fr));
        grid-auto-rows: auto;
        grid-gap: 10px;
    }

    .wrapper div {
        border: 2px solid blueviolet;
        background-color: rgba(243, 57, 181, 0.568);
    }

    .responsive {
        max-width: 100%;
        height: auto;
    }

    .btnadd {
        display: block;
        width: 200px;
        text-align: center;
    }

    .checked {
        color: gold;
    }

    .croix {
        font-size: 40px;
    }
</style>


<?php
$erreur = false;

$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null));
if ($action !== null) {
    if (!in_array($action, array('ajout', 'suppression', 'refresh')))
        $erreur = true;

    //récupération des variables en POST ou GET
    $l = (isset($_POST['l']) ? $_POST['l'] : (isset($_GET['l']) ? $_GET['l'] : null));
    $p = (isset($_POST['p']) ? $_POST['p'] : (isset($_GET['p']) ? $_GET['p'] : null));
    $q = (isset($_POST['q']) ? $_POST['q'] : (isset($_GET['q']) ? $_GET['q'] : null));

    //Suppression des espaces verticaux
    $l = preg_replace('#\v#', '', $l);
    //On vérifie que $p est un float
    $p = floatval($p);

    //On traite $q qui peut être un entier simple ou un tableau d'entiers

    if (is_array($q)) {
        $QteArticle = array();
        $i = 0;
        foreach ($q as $contenu) {
            $QteArticle[$i++] = intval($contenu);
        }
    } else
        $q = intval($q);
}

if (!$erreur) {
    switch ($action) {
        case "ajout":
            ajouterArticle($l, $q, $p);
            break;

        case "suppression":
            supprimerArticle($l);
            break;

        case "refresh":
            for ($i = 0; $i < count($QteArticle); $i++) {
                modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i], round($QteArticle[$i]));
            }
            break;

        default:
            break;
    }
}
?>

<form method="post" action="">
    <table class="table">
        <tr>
            <th>Libellé</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Action</th>
        </tr>

        <?php
        if (creationPanier()) {
            $nbArticles = count($_SESSION['panier']['libelleProduit']);
            if ($nbArticles <= 0)
                echo "<tr><td>Votre panier est vide </ td></tr>";
            else {
                for ($i = 0; $i < $nbArticles; $i++) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]) . "</ td>";
                    echo "<td><input type=\"number\" size=\"4\" min='0' name=\"q[]\" value=\"" . htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) . "\"/></td>";
                    echo "<td>" . htmlspecialchars($_SESSION['panier']['prixProduit'][$i]) . " €</td>";
                    echo "<td><a class='croix' title='Supprimer' href=\"" . htmlspecialchars("index.php?page=pagepanier_new&action=suppression&l=" . rawurlencode($_SESSION['panier']['libelleProduit'][$i])) . "\">×</a></td>";
                    //echo "<td><a href=\"" . htmlspecialchars("panier.php?action=suppression&l=" . rawurlencode($_SESSION['panier']['libelleProduit'][$i])) . "\">XX</a></td>";
                    echo "</tr>";
                }

                echo "<tr><td colspan=\"2\"> </td>";
                echo "<td colspan=\"2\">";
                echo "Total : " . MontantGlobal() . " €";
                echo "</td></tr>";

                echo "<tr><td colspan=\"2\">";
                echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/></td>";
                echo "<td></td>";
                echo "<td><input type=\"submit\" name='commander' value=\"Passer la commande\"/></td>";
                echo "</tr>";
            }
        }

        if (isset($_POST['commander'])) {
        ?>
            <script>
                window.location.href = "pagepaiement.php";
            </script>
            <?php
        }

        if (isset($_POST['send'])) {
            if (isset($_SESSION['authOk'])) {
                if ($nbArticles !== 0) {
                    // Insertion dans la table factures
                    $dateFacture = date("Y-m-d");
                    $sql1 = $pdo->prepare("INSERT INTO factures(total,statut,date,id_compte) VALUES (?,?,?,?)") or die(print_r($pdo->errorInfo()));
                    $sql1->execute(array(
                        MontantGlobal(),
                        "En cours",
                        $dateFacture,
                        $_SESSION['connecte']->getLogin()
                    ));

                    // Dernier ID des factures
                    $sql2 = $pdo->prepare("SELECT max(numfacture) as last_id FROM factures") or die(print_r($pdo->errorInfo()));
                    $sql2->execute();
                    $data = $sql2->fetch(PDO::FETCH_ASSOC);
                    $last_facture = $data['last_id'];

                    // Insertion de la table commandes
                    $nbArticles = count($_SESSION['panier']['libelleProduit']);
                    for ($i = 0; $i < $nbArticles; $i++) {
                        $sql3 = $pdo->prepare("INSERT INTO commandes(nomproduit,qteproduit,prixproduit,n_facture) VALUES (?,?,?,?)") or die(print_r($pdo->errorInfo()));
                        $sql3->execute(array(
                            htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]),
                            htmlspecialchars($_SESSION['panier']['qteProduit'][$i]),
                            htmlspecialchars($_SESSION['panier']['prixProduit'][$i]),
                            $last_facture
                        ));
                    }
                    echo "Upload OK !";
                    $_SESSION['panier'] = null;
                    creationPanier();
            ?>
                    <script>
                        window.location.href = "index.php?page=pagepanier_new";
                    </script>
        <?php
                } else {
                    echo "Votre panier est vide !";
                }
            } else {
                echo "Erreur ! Vous n'êtes pas connecté !";
            }
        }

        ?>
    </table>
</form>

<form method="post" action="">
    <input type="submit" name="send" value="UPLOAD" disabled>
</form>