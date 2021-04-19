<div class="row test">
	<div class="col">
		<div class="menu-middle">
			<h1 class="display-4">NOUVEAUTÉS</h1>
			<hr>
			<div class="text-center">
				<iframe width="700" height="500" src="https://youtube.com/embed/XIMLoLxmTDw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
				</iframe>
			</div>
		</div>

		<div class="row">

			<div class="col ventes">
				<h1 class="display-4">MEILLEURES VENTES</h1>
				<hr>

				<div class="promo">
					<a href="index.php?page=pagearticle_v2&id=1"><img src="images/coco.jpg" class="responsive1" alt="coco"></a>

					<ul class="">
						<li>Titre : COCO</li>
						<li>Support : DVD</li>
						<li>Sortie : 6 avril 2018</li>
						<li>Avis clients<br>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span></li>
						<li>Prix : 11,99€</li>
					</ul>
					<p class="text-center">
						<button class="btnadd btn btn-primary">Ajouter au panier</button>
					</p>

				</div>
			</div>

			<div class="col ventes">
				<h1 class="display-4">MEILLEURES VENTES</h1>
				<hr>

				<div class="promo">
					<a href="index.php?page=pagearticle_v2&id=1"><img src="images/coco.jpg" class="responsive1" alt="coco"></a>

					<ul class="">
						<li>Titre : COCO</li>
						<li>Support : DVD</li>
						<li>Sortie : 6 avril 2018</li>
						<li>Avis clients<br>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span></li>
						<li>Prix : 11,99€</li>
					</ul>
					<p class="text-center">
						<button class="btnadd btn btn-primary">Ajouter au panier</button>
					</p>

				</div>
			</div>

			<div class="col ventes">
				<h1 class="display-4">MEILLEURES VENTES</h1>
				<hr>

				<div class="promo">
					<a href="index.php?page=pagearticle_v2&id=1"><img src="images/coco.jpg" class="responsive1" alt="coco"></a>

					<ul class="">
						<li>Titre : COCO</li>
						<li>Support : DVD</li>
						<li>Sortie : 6 avril 2018</li>
						<li>Avis clients<br>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span></li>
						<li>Prix : 11,99€</li>
					</ul>
					<p class="text-center">
						<button class="btnadd btn btn-primary">Ajouter au panier</button>
					</p>

				</div>
			</div>

		</div>

		<div class="menu-middle">
			<h1 class="display-4">PROMOTIONS</h1>
			<hr>
			<div class="wrapper">

				<?php
				for ($i = 0; $i < 6; $i++) {
				?>
					<div class="form-group">
						<a href="index.php?page=pagearticle_v2&id=1"><img src="images/coco.jpg" class="responsive" alt="coco"></a>

						<ul class="">
							<li>Titre : COCO</li>
							<li>Support : DVD</li>
							<li>Sortie : 6 avril 2018</li>
							<li>Avis clients<br>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span></li>
							<li>Prix : <s>11,99€</s> - 7,99€</li>
						</ul>
						<p class="col-6">
							<button class="btnadd btn btn-primary">Ajouter au panier</button>
						</p>

					</div>
				<?php
				}
				?>
			</div>
		</div>

	</div>

</div>