<?php
// Fichiers requis : les classes , début des sessions , fonctions de base (MySQL , etc)
if(file_exists("functions/classes.php")) {
	require_once("functions/classes.php");
	session_start();
	require_once("functions/variables.php");
	creationPanier(); // Pour créer la SESSION panier
} else {
	echo "<h1><center>Fichiers de configuration manquants !</center></h1>";
}

// Gestion page
$replace = array('../', '..\\', '/', '\\', './',  '.\\');
$page = str_replace($replace, '', $_GET['page']);
if (empty($page) or (!file_exists($page . '.php'))) header('location: index.php?page=accueil');

// Affichage du titre pour les articles
if ($page == "pagearticle_v2" and isset($_GET['id'])) {
	$id = $_GET['id'];

	if (isset($id) and is_numeric($id)) {
		$req1 = $pdo->prepare("SELECT titre FROM produits WHERE reference = :id") or die(print_r($pdo->errorInfo()));
		$req1->bindValue(':id', $id, PDO::PARAM_STR);
		$req1->execute();

		while ($data = $req1->fetch()) {
			$titlepage = $data['titre'];
		}
	}
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<title><?php if ($page . "&id=" == "pagearticle_v2&id=") {
				echo $titlepage . " - " . NOM_SITE;
			} else {
				titreDesPages($page);
			} ?></title>
	<meta charset="utf-8">
	<link rel="icon" href="<?php echo LOGO_SITE; ?>" type="images/png" sizes="16x16">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<?php
	// Gestion des CSS pour chaque page affichée
	switch ($page) {

		case "accueil":
			echo '<link rel="stylesheet" href="css/accueil.css">' . "\n";
			break;

		case "pagecategorie_v2":
			echo '<link rel="stylesheet" href="css/pagecategorie_v2.css">' . "\n";
			break;

		case "pagearticle_v2":
			echo '<link rel="stylesheet" href="css/article.css">' . "\n";
			break;

		case "pagearticle":
			echo '<link rel="stylesheet" href="css/article.css">' . "\n";
			break;

		case "pageespaceclient":
			echo '<link rel="stylesheet" href="css/espaceclient.css">' . "\n";
			break;

		case "pagefaq":
			echo '<link rel="stylesheet" href="css/faq.css">' . "\n";
			break;

		case "pagecontact":
			echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">' . "\n";
			echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">' . "\n";
			echo '<link rel="stylesheet" href="css/contact.css">' . "\n";
			break;

		default:
			echo "\n";
	}
	?>

	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="js/fonctions.js"></script>
</head>

<body>

	<?php
	// Header
	require_once("functions/header.php");

	//Fil d'Ariane
	require_once("functions/ariane.php");

	// Carrousel de page
	include_once($page . '.php');

	// Footer
	require_once("functions/footer.php");

	// Fermeture connexion PDO
	Database::disconnect();
	?>

</body>

</html>