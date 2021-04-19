<?php
// Déconnexion
if (isset($_POST['deco'])) {
	deco();
	header("location: " . basename($_SERVER['PHP_SELF'] . "?page=" . $page));
}
?>
<header>
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col">
				<a href="index.php"><img class="logo" src="<?php echo LOGO_SITE; ?>" alt="logo" />
					<span class="h2 text-uppercase font-weight-normal"><?php echo NOM_SITE; ?></span>
				</a>
			</div>

			<div class="col text-center">
				<input type="text" class="recherche" id="recherche" size="50" dir="auto" placeholder="Rechercher un produit..." />
			</div>

			<div class="col text-right menudroit">
				<div class="row float-right align-items-center text-center">
					<div class="">
						<a href="index.php?page=pageguide">GUIDE</a> |
					</div>
					<?php
					if (isset($_SESSION['authOk'])) {
						echo '<div class="login">Bonjour, <a href="index.php?page=pageespaceclient"><b>' . securite($_SESSION['connecte']->getPrenom()) . ' ' . securite($_SESSION['connecte']->getNom()) . '</b></a>';
					?>
						<form method="POST" action="">
							<input type="submit" name="deco" value="Déconnexion" class="btn btn-primary">
						</form>
				</div>|
			<?php
					} else {
			?>
				<div class="login">
					<a href="index.php?page=pageconnexion">CONNEXION</a> ou <a href="pageinscription.php">INSCRIPTION</a>
				</div>|
			<?php
					}
			?>
			<div class="panier">
				<div class="panier_count">
					<?php
					if (isset($_SESSION['panier'])) {
						if (!isset($_SESSION['panier'])) {
							echo "0";
						} else {
							echo array_sum($_SESSION['panier']['qteProduit']);
						}
					} ?>
				</div>
				<a href="index.php?page=pagepanier_new"><img class="panier-logo" src="images/panier.png" alt="panier"></a>
			</div>
			</div>
		</div>
	</div>
	</div>


	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<!-- Brand 
		<a class="navbar-brand" href="index.php">Accueil</a>-->

		<!-- Toggler/collapsibe Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Navbar links -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">

					<!-- 
					CAT : 1 = Jouets , 4 = Vêtements , 7 = Livres , 8 = DVD/Blu-ray
				 	SOUS CAT : 1 = bébé , 2 = fille , 3 = garçon -->
					<a class="navbar-brand <?php if ($page == "pagecategorieproduits") {
												echo "active";
											} ?>" href="index.php?page=pagecategorie_v2">Toutes les catégories</a>
				</li>

				<li class="nav-item dropdown">
					<a class="navbar-brand dropdown-toggle <?php if ($page . "&cat=" . @$_GET['cat'] == "pagecategorie_v2&cat=1") {
																echo "active";
															} ?>" href="" data-toggle="dropdown">
						Jouets
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="index.php?page=pagecategorie_v2&cat=1">Tous les jouets</a>
						<a class="dropdown-item" href="index.php?page=pagecategorie_v2&cat=1&souscat=1">Bébé</a>
						<a class="dropdown-item" href="index.php?page=pagecategorie_v2&cat=1&souscat=2">Fille</a>
						<a class="dropdown-item" href="index.php?page=pagecategorie_v2&cat=1&souscat=3">Garçon</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="navbar-brand dropdown-toggle <?php if ($page . "&cat=" . @$_GET['cat'] == "pagecategorie_v2&cat=4") {
																echo "active";
															} ?>" href="#" data-toggle="dropdown">
						Vêtements
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="index.php?page=pagecategorie_v2&cat=4">Tous les vêtements</a>
						<a class="dropdown-item" href="index.php?page=pagecategorie_v2&cat=4&souscat=1">Bébé</a>
						<a class="dropdown-item" href="index.php?page=pagecategorie_v2&cat=4&souscat=2">Fille</a>
						<a class="dropdown-item" href="index.php?page=pagecategorie_v2&cat=4&souscat=3">Garçon</a>
					</div>
				</li>

				<li class="nav-item">
					<a class="navbar-brand <?php if ($page . "&cat=" . @$_GET['cat'] == "pagecategorie_v2&cat=7") {
												echo "active";
											} ?>" href="index.php?page=pagecategorie_v2&cat=7">Livres</a>
				</li>

				<li class="nav-item">
					<a class="navbar-brand <?php if ($page . "&cat=" . @$_GET['cat'] == "pagecategorie_v2&cat=8") {
												echo "active";
											} ?>" href="index.php?page=pagecategorie_v2&cat=8">DVD/Blu-ray</a>
				</li>

				<li class="nav-item">
					<a class="navbar-brand" href="index.php?page=pagearticle_v2&id=1">[WIP (Article v2)]</a>
				</li>

				<li class="nav-item">
					<a class="navbar-brand" href="index.php?page=pagearticle&id=2"><del>[OLD (Article v1)]</del></a>
				</li>
			</ul>
		</div>
	</nav>
	<!-- Fin Navbar -->
</header>