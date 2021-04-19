<?php
$verifComplete = 0;
$login = $motdepasse = "";
$loginErr = $motdepasseErr = "";

$ip = $_SERVER['REMOTE_ADDR'];
$dateConnexion = date("Y-m-d");
$timeConnexion = date('H:i:s', strtotime('+2 hour'));

if (isset($_POST['send']) and $_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST) and !empty($_POST)) {

        $mail = $_POST['login'];
        $motdepasse = $_POST['motdepasse'];

        if (empty($mail)) {
            $loginErr = "Votre e-mail est vide !";
            $verifComplete = 0;
        } elseif (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
            $loginErr = "Votre e-mail n'est pas valide !";
            $verifComplete = 0;
        } else {
            $login = securite($mail);
            $verifComplete += 1;
        }

        if (empty($motdepasse)) {
            $motdepasseErr = "Votre mot de passe est vide !";
            $verifComplete = 0;
        } else {
            $motdepasse = securite($motdepasse);
            $verifComplete += 1;
        }

        if ($verifComplete === 2) {
            /* MISE A JOUR A FAIRE SUR LA CONNEXION
            $sel = $pdo->prepare("select * from utilisateurs where login=? and pass=? limit 1");
            $sel->execute(array($login, $pass));
            $tab = $sel->fetchAll();
            if (count($tab) > 0) {
                echo "Connexion Ok !";
            } else {
                echo "Erreur !";
            }*/
            $req1 = $pdo->prepare("SELECT * FROM comptes cpt , utilisateurs u WHERE u.id = cpt.idutilisateur and cpt.login = :login") or die(print_r($pdo->errorInfo()));
            $req1->bindValue(':login', $login, PDO::PARAM_STR);
            $req1->execute();

            if ($data = $req1->fetch()) {
                $id = $data['id'];
                $mdpExist = $data['password'];
                $login = $data['login'];
                $rang = $data['rang'];
                $genre = $data['genre'];
                $nom = $data['nom'];
                $prenom = $data['prenom'];
                $datenaissance = $data['datenaissance'];
                $adresse = $data['adresse'];
                $adressesup = $data['adressesup'];
                $codepostal = $data['codepostal'];
                $ville = $data['ville'];
                $telmobile = $data['telephonemobile'];
                $telfixe = $data['telephonefixe'];
                $societe = $data['societe'];
                $siret = $data['siret'];

                if (cryptMdp($motdepasse) === $mdpExist) {
                    $sql1 = $pdo->prepare("INSERT INTO connexion (ip , dateConnexion , timeConnexion , idCompte ) VALUES (?,?,?,?)") or die(print_r($pdo->errorInfo()));
                    $sql1->execute(array($ip, $dateConnexion, $timeConnexion, $login));

                    $_SESSION['authOk'] = true;

                    $connecte = new Utilisateur(
                        $genre,
                        $nom,
                        $prenom,
                        $datenaissance,
                        $adresse,
                        $adressesup,
                        $codepostal,
                        $ville,
                        $telmobile,
                        $telfixe,
                        $rang,
                        $societe,
                        $siret,
                        $login,
                    );

                    // Tableau SESSION 
                    $_SESSION['connecte'] = $connecte;
                    $_SESSION['id'] = $id;
                    $_SESSION['mdpconnect'] = $_POST['motdepasse'];
                    //echo "<script>alert('Vous êtes connecté !');</script>";
                } else {
                    //echo "<script>alert('Erreur !');</script>";
                    echo "Erreur !";
                }
            }
        }
    }
}
?>

<!--Formulaire de login-->
<div class="container">
    <h1 class="container_h1 text-center">Connexion</h1>
    <?php
    if (!isset($_SESSION['authOk'])) {
    ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="login">E-mail:</label>
                <input type="email" class="form-control" id="login" placeholder="Votre adresse e-mail" name="login" value="test@admin.com" required>
                <span class="error"><?php echo $loginErr; ?></span>
            </div>

            <div class="form-group">
                <label for="motdepasse">Mot de passe:</label>
                <input type="password" class="form-control" id="motdepasse" placeholder="Votre mot de passe" name="motdepasse" value="123456" required>
                <span class="error"><?php echo $motdepasseErr; ?></span>
            </div>

            <div class="form-group form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="stayConnect">Se souvenir de moi
                </label>
            </div>
            <input type="submit" name="send" value="Connexion" class="btn btn-primary">
            <input type="reset" class="btn btn-primary">
            <a class="text-right float-right" href="pagemdpoublie.php">Mot de passe oublié ?</a>
        </form>
        <?php
    } else {
        switch ($_SESSION['connecte']->getRang()) {
            case "Client":
        ?>
                <script>
                    window.location.href = "index.php?page=pageespaceclient";
                </script>
            <?php
                break;
            case "Commerçant":
            ?>
                <script>
                    window.location.href = "index.php?page=pageespaceclient&rank=1";
                </script>
            <?php
                break;
            case "Admin":
            ?>
                <script>
                    window.location.href = "index.php?page=pageespaceclient&rank=2";
                </script>
        <?php
                break;
        }
        echo "Vous êtes déjà connecté !";
    }
    ?>
</div>