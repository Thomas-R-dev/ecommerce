<?php
// Fichiers requis : les classes , début des sessions , fonctions de base (MySQL , etc)
require_once("functions/classes.php");
session_start();
require_once("functions/variables.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Paiement - <?php echo NOM_SITE; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/paiement.css">
    <script>
        /* FORMULAIRE CARTE DE CREDIT EN JQUERY */
        function cc_format(value) {
            var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
            var matches = v.match(/\d{4,16}/g);
            var match = matches && matches[0] || ''
            var parts = []
            for (i = 0, len = match.length; i < len; i += 4) {
                parts.push(match.substring(i, i + 4))
            }
            if (parts.length) {
                return parts.join(' ')
            } else {
                return value
            }
        }

        onload = function() {
            document.getElementById('card').oninput = function() {
                this.value = cc_format(this.value)
            }
        }
        /* FIN */
    </script>
</head>

<body>
    <div class="conteneur-global">
        <div class="conteneur-paiement">
            <h2 class="paiement-titre">Paiement</h2>

            <!--Logo du site-->
            <div id="conteneur_logo">
                <img src="images/logo.png" alt="logo du site" id="logo">
            </div>

            <!--Choix carte bancaire-->
            <div class="paiement-methode">
                <label for="carte" class="methode carte">
                    <div class="carte-logos">
                        <img src="images/visa_logo.png" />
                        <img src="images/mastercard_logo.png" />
                    </div>
                    <div class="radio-input">
                        <input id="carte" type="radio" name="paiement">
                        Réglez <?php echo MontantGlobal(); ?> € par carte bancaire
                    </div>
                </label>

                <!--Choix Paypal-->
                <label for="paypal" class="methode paypal">
                    <img src="images/paypal_logo.png" />
                    <div class="radio-input">
                        <input id="paypal" type="radio" name="paiement">
                        Réglez <?php echo MontantGlobal(); ?> € avec Paypal
                    </div>
                </label>
            </div>

            <!--Formulaire carte bancaire-->
            <div class="input-fields">
                <div class="column-1">
                    <label for="titulaire">Titulaire de la carte</label>
                    <input type="text" id="titulaire" placeholder="Prénom Nom" />

                    <div class="small-inputs">
                        <div>
                            <label for="date">Date de validité</label>
                            <input type="text" id="date" placeholder="Mois/Année" />
                        </div>

                        <div>
                            <label for="verification">Cryptogramme visuel*</label>
                            <input type="text" id="verification" placeholder="123" />
                        </div>
                    </div>

                </div>
                <div class="column-2">
                    <label for="numero">Numéro de carte</label>
                    <input type="text" id="card" placeholder="1234 5678 9012 3456" />

                    <span class="info">*Le cryptogramme visuel est composé de trois chiffres situés au verso de votre carte bancaire</span>
                </div>
            </div>
        </div>

        <!--Bouton Retour/Finaliser-->
        <div class="conteneur-footer">
            <button class="btn back-btn" onclick="window.location.href='index.php?page=pagepanier_new'">Retour au panier</button>
            <button class="btn next-btn" onclick="alert('Paiement effectué ! \nMerci');">Finaliser</button>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js "></script>
    <script src="js/paiement.js "></script>
</body>

</html>