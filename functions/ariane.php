<?php
switch ($page . ".php") {
	case "accueil.php":
?>
		<ul class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
		</ul>
	<?php
		break;

	case "sitemap.php":
	?>
		<ul class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
			<li>Plan du site</li>
		</ul>
	<?php
		break;

	case "pagearticle.php":
	?>
		<ul class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
			<li><a href="">Jeux enfants 8 ans</a></li>
			<li>Article</li>
		</ul>
	<?php
		break;

	default:
	?>
		<ul class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
			<li><a href="">Site en</a></li>
			<li><a href="">cours de </a></li>
			<li>Construction</li>
		</ul>
<?php
}
?>