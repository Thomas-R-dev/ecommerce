<!--
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/mdb.min.css">
<link rel="stylesheet" href="css/contact.css">
-->

<section class="mb-4 #90a4ae blue-grey lighten-2">

    <!--Titre et paragraphe intro-->

    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact</h2>
    <p class="text-center w-responsive mx-auto mb-5">Pour nous contacter, veuillez remplir le formulaire,
        nos conseillers reviendront vers vous dés que possible.</p>

    <div class="row">
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" method="POST">

                <!--Champ nom-->

                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Votre nom:</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>

                    <!--Champ e-mail-->

                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="">Votre adresse e-mail:</label>
                            <input type="text" id="email" name="email" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!--Sélection du sujet-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="name" class="">Titre de votre message:</label>
                            <input type="text" id="titre" name="titre" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!--Message client-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="message">Votre message:</label>
                            <textarea id="message" name="message" rows="2" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>

                <!--Bouton d'envoi-->
                <br>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="md-form">
                            <button type="submit" class="btn btn-primary">Envoyer <i class='far fa-paper-plane'></i></button>
                        </div>
                    </div>
                </div>
                <br>
            </form>
        </div>

        <!--Coordonnées KidsOdyssey-->

        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li>
                    <i class="fas fa-map-marker-alt fa-2x"></i>
                    <p class="coord">1 rue machin truc 75000 PARIS</p>
                </li>
                <li>
                    <i class="fas fa-phone mt-4 fa-2x"></i>
                    <p class="coord">03.44.22.22.22</p>
                </li>
                <li>
                    <i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p class="coord">Toys4Us@gmail.com</p>
                </li>
            </ul>
        </div>

    </div>

</section>

<!--
<script src="js/jquery-3.4.1.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/mdb.min.js"></script>