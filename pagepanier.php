<?php
session_start();
require_once("functions/variables.php");
?>

<head>
    <title>Panier - <?php echo NOM_SITE; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="css/panier.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>

<body>
    <main>
        <div class="panier">

            <!--Logo du site-->
            <div id="conteneur_logo">
                <img src="<?php echo LOGO_SITE; ?>" alt="logo du site" id="logo">
            </div>

            <!--Nom du site-->
            <div id="conteneur_titre">
                <h1 id="titre"><?php echo NOM_SITE; ?></h1>
            </div>

            <!--Image panier-->
            <div id="conteneur_img-panier">
                <img src="images/panier.png" alt="img panier" id="img-panier">
                <p id="p-panier">Mon Panier</p>
            </div>

            <!--Code de réduction-->
            <div class="conteneur_codereduc">
                <label for="codereduc">Entrez un code de réduction (10off)</label>
                <input id="codereduc" type="text" name="codereduc" maxlength="5" class="codereduc-champ">
                <button class="codereduc-btn">Appliquer</button>
            </div>

            <!--Désignations du panier-->
            <div class="conteneur_labels">
                <ul>
                    <li class="article article-label">Article</li>
                    <li class="prix">Prix</li>
                    <li class="quantite">Quantité</li>
                    <li class="soustotal">Sous-total</li>
                </ul>
            </div>

            <!--Article 1-->
            <div class="conteneur_article">
                <div class="article">
                    <div class="article-visuel">
                        <img src="images/coco.jpg" alt="Visuel du produit" class="article-image">
                    </div>
                    <div class="article-details">
                        <h2><strong><span class="article-quantite">4*</span> Mulan</strong> Edition DVD Simple</h2>
                        <p><strong>Disney</strong></p>
                        <p>Référence</p>
                    </div>
                </div>
                <div class="prix">15.00
                </div>
                <div class="quantite">
                    <input type="number" value="4" min="1" class="quantite-champ">
                </div>
                <div class="soustotal">60.00
                </div>
                <div class="suppr">
                    <button>Supprimer</button>
                </div>
            </div>

            <!--Article 2-->
            <div class="conteneur_article">
                <div class="article">
                    <div class="article-visuel">
                        <img src="images/coco.jpg" alt="Visuel du produit" class="article-image">
                    </div>
                    <div class="article-details">
                        <h2><strong><span class="article-quantite">2*</span> Zootopie</strong> Edition DVD Simple</h2>
                        <p><strong>Disney</strong></p>
                        <p>Référence</p>
                    </div>
                </div>
                <div class="prix">15.00
                </div>
                <div class="quantite">
                    <input type="number" value="2" min="1" class="quantite-champ">
                </div>
                <div class="soustotal">30.00
                </div>
                <div class="suppr">
                    <button>Supprimer</button>
                </div>
            </div>

            <!--Article 3-->
            <div class="conteneur_article">
                <div class="article">
                    <div class="article-visuel">
                        <img src="images/coco.jpg" alt="Visuel du produit" class="article-image">
                    </div>
                    <div class="article-details">
                        <h2><strong><span class="article-quantite">2*</span> Dinosaure</strong> Jouet en plastique</h2>
                        <p><strong>Dino Industries</strong></p>
                        <p>Référence</p>
                    </div>
                </div>
                <div class="prix">25.00
                </div>
                <div class="quantite">
                    <input type="number" value="2" min="1" class="quantite-champ">
                </div>
                <div class="soustotal">50.00
                </div>
                <div class="suppr">
                    <button>Supprimer</button>
                </div>
            </div>

        </div>

        <aside>

            <!--Récapitulatif-->
            <div class="recap">

                <!--Total articles nbr & valeur-->
                <div class="recap-total-articles">
                    <span class="total-articles"></span> articles dans votre panier
                </div>
                <div class="recap-soustotal">
                    <div class="soustotal-titre">Sous-total
                    </div>
                    <div class="soustotal-valeur valeur-final" id="panier-soustotal">90.00
                    </div>

                    <!--Total reduction-->
                    <div class="recap-reduc cache">
                        <div class="reduc-titre">Réduction
                        </div>
                        <div class="reduc-valeur valeur-final" id="panier-reduc">
                        </div>
                    </div>
                </div>

                <!--Livraison-->
                <div class="recap-livraison">
                    <select name="livraison-choix" class="recap-livraison-choix">
                        <option value="0" selected="selected">Sélectionnez votre mode de livraison</option>
                        <option value="normal">Normal</option>
                        <option value="suivi">Suivi</option>
                        <option value="recommande">Recommandé</option>
                        <option value="express">Express</option>
                    </select>
                </div>

                <!--Total-->
                <div class="recap-total">
                    <div class="total-titre">Total</div>
                    <div class="total-valeur valeur-final" id="panier-total">90.00</div>
                </div>

                <!--Direction paiement-->
                <div class="recap-paiement">
                    <button class="paiement-go" onclick="window.location.href='pagepaiement.php'">Procédez au paiement</button>
                </div>

                <div class="recap-accueil">
                    <button class="accueil-go" onclick="window.location.href='index.php'">Continuez mes achats</button>
                </div>
            </div>

        </aside>

    </main>

    <script src="js/panier.js"></script>
</body>

</html>