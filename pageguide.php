<style>
    .funct:before{
        counter-increment: li;
        direction: rtl;
        display: inline-block;
    }
</style>

<h1>Fonctionnement du site</h1>

Étape 1 :<br>
Commencez par vous créer un compte <a href="pageinscription.php">Client</a> ou <a href="pageinscription.php">Commerçant</a>.
<br><br>
Étape 2 :<br>
Ensuite <a href="pageconnexion.php">connectez-vous</a>.
<br><br>
Étape 3 :<br>
Allez dans votre <a href="index.php?page=pageespaceclient">Espace utilisateur</a>.
<br><br>
Étape 4 :<br>
<ul>
    <li>Si vous êtes un <b>Client</b> : vous pouvez modifier votre compte (Prénom , nom , mot de passe , etc...) , passer des commandes , etc...</li>
    <li>Si vous êtes un <b>Commerçant</b> : vous pouvez ajouter des produits , suivre les commandes , etc...</li>
    <li>Si vous êtes un <b>Admin</b> : vous pouvez gérer les comptes (clients et commerçants), faire la maintenance du site , etc...</li>
</ul>
<br>
Fonctions disponibles :
<ol class="funct">
    <li>Inscription</li>
    <li>Connexion</li>
    <li>Ajout des articles au panier</li>
    <li>Modifier / Supprimer articles du panier</li>
    <li>Liste des catégories et sous catégories</li>
    <li>Barre de recherche par le titre d'article</li>
    <li>Profil Client</li>
    <li>Profil Commerçant</li>
    <li>Profil Admin</li>
</ol>

<hr>
<center>
    <h4>Chargez les tables / Évitez les erreurs</h4>

    1) Vérifiez d'avoir la base de données "toys4us" dans MySQL !
    <br>
    2) Supprimez les tables de votre base de données "toys4us" puis chargez les ici !
    <br>

    <?php
    if (isset($_POST['loadTable']) and $_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST) and !empty($_POST)) {

            $sql = implode(array_map(function ($v) {
                return file_get_contents($v);
            }, glob("toys4us.sql")));
            $qr = $pdo->exec($sql);

            echo "Tables chargées !";
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

    3) N'oubliez pas de générer les catégories dans la page <a href="index.php?page=pageespaceclient&rank=2">Admin</a>.
    <br><br>
</center>

<?php
