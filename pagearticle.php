<?php
include 'functions/DBController.php';
$db_handle = new DBController();

$objet = $_GET['id'];
$productResult = $db_handle->runQuery("SELECT * FROM tbl_products WHERE id = $objet");
if (!empty($productResult)) {
?>

    <div class="d-flex flex-row bd-highlight mb-3">
        <div class="qanda p-3 cadre" id="product-view">
            <?php
            $productImageResult = $db_handle->runQuery("SELECT * FROM tbl_product_image WHERE product_id = $objet");
            if (!empty($productImageResult)) {
            ?>
                <div class="preview-image">
                    <div id="preview-enlarged">
                        <img src="<?php echo $productImageResult[0]["preview_source"]; ?>" />
                    </div>

                    <div id="thumbnail-container">
                        <?php foreach ($productImageResult as $key => $value) {
                            $focused = "";
                            if ($key == 0) {
                                $focused = "focused";
                            }
                        ?>
                            <img class="thumbnail <?php echo $focused; ?>" src="<?php echo $productImageResult[$key]["preview_source"]; ?>" />
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="product-info">
                <div class="product-title"><?php echo $productResult[0]["name"]; ?></div>
                <ul>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        $selected = "";
                        if (!empty($productResult[0]["average_rating"]) && $i <= $productResult[0]["average_rating"]) {
                            $selected = "selected";
                        }
                    ?>
                        <li class='<?php echo $selected; ?>'>&#9733;</li>
                    <?php
                    }
                    ?>
                </ul>
                <div class="product-category"><?php echo $productResult[0]["category"]; ?>

                </div>
                <div><?php echo $productResult[0]["price"]; ?> € | En Stock | Quantité <input type="number" value="1" min="1" max="100" size="4"></div>
                <div><button class="btn-info">Ajouter au<br>panier</button></div>
            </div>

        <?php
    }
        ?>
        </div>

        <div class="qanda p-3 cadre">
            <div class="doubleul">
                <ul class="puces">
                    <li>Question 1</li>
                    <li>Question 2</li>
                    <li>Question 3</li>
                    <li>Question 4</li>
                </ul>

                <ul class="puces">
                    <li>Réponse 1</li>
                    <li>Réponse 2</li>
                    <li>Réponse 3</li>
                    <li>Réponse 4</li>
                </ul>
            </div>
        </div>

    </div>

    <div class="d-flex flex-row bd-highlight mb-3">
        <div class="p-3 cadre avis">
            <div class="doubleul">
                <ul class="puces">
                    <li class="etoile"><span class="colori">☆ ☆ ☆</span> ☆ ☆</li>
                    <li class="etoile"><span class="colori">☆ ☆ ☆</span> ☆ ☆</li>
                    <li class="etoile"><span class="colori">☆ ☆</span> ☆ ☆ ☆</li>
                    <li class="etoile"><span class="colori">☆ ☆ ☆ ☆ ☆</span></li>
                </ul>

                <ul class="puces">
                    <li class="element2"><span title="21/01/2019 à 21:12:01">Polo Marco</span> : Commentaire 1</li>
                    <li class="element2">Commentaire 2</li>
                    <li class="element2">Commentaire 3</li>
                    <li class="element2">Commentaire 4</li>
                </ul>
            </div>
        </div>

        <div class="p-3 cadre envoi-avis">
            <div class="bloc2">
                <h4>Donnez votre avis</h4>
                <?php
                $connect = 1;
                if ($connect == true) {
                ?>
                    <div class="rating">
                        <a href="#" title="Donner 5 étoiles">☆</a>
                        <a href="#" title="Donner 4 étoiles">☆</a>
                        <a href="#" title="Donner 3 étoiles">☆</a>
                        <a href="#" title="Donner 2 étoiles">☆</a>
                        <a href="#" title="Donner 1 étoile">☆</a>
                    </div>

                    <div class="form-group">
                        <input type="text" id="nom" class="form-control" value="<?php if(isset($_SESSION['connecte'])) { echo securite($_SESSION['connecte']->getPrenom()) . ' ' . securite($_SESSION['connecte']->getNom());}?>" <?php if(isset($_SESSION['connecte'])) {echo "disabled";} else { echo 'placeholder="Votre nom ou pseudo"';} ?>>
                    </div>

                    <div class="form-group">
                        <textarea id="objet" class="form-control" rows="1" placeholder="Objet"></textarea>
                    </div>

                    <div class="form-group">
                        <textarea id="messa" class="form-control" rows="4" placeholder="Message"></textarea>
                    </div>
                    <button type="submit" id="envoi" class="btn btn-primary form-control" disabled>Envoyer</button>
                <?php
                } else {
                    echo "Veuillez vous connectez";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        $("#thumbnail-container img").click(function() {
            $("#thumbnail-container img").css("border", "1px solid #ccc");
            var src = $(this).attr("src");
            $("#preview-enlarged img").attr("src", src);
            $(this).css("border", "#fbb20f 2px solid");
        });
    </script>