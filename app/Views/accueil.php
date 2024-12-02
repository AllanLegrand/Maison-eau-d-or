<main class="container my-5">
    <!-- Carrousel -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/assets/img/imgbandeau1.jpg" class="d-block w-100" alt="Produit 1">
            </div>
            <div class="carousel-item">
                <img src="/assets/img/imgbandeau2.webp" class="d-block w-100" alt="Produit 2">
            </div>
            <div class="carousel-item">
                <img src="/assets/img/imgbandeau3.jpg" class="d-block w-100" alt="Produit 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>

     <!-- Section choix Bestsellers ou Coffrets -->
     <section class="my-5">
        <div class="text-center bordergold">
            <!-- Titres cliquables pour Bestsellers ou Coffrets -->
            <h2 class="section-title active" id="bestsellersTitle">Bestsellers</h2>
            <h2 class="section-title" id="coffretsTitle">Nos Coffrets</h2>
        </div>

        <!-- Contenu Bestsellers (par défaut affiché) -->
        <div id="bestsellersContent" class="row justify-content-center mt-4">
            <div class="col-md-3 text-center">
                <img src="/assets/img/bestseller1.webp" class="img-fluid" alt="Produit 1">
                <p>California Love - <strong>35,00€</strong></p>
            </div>
            <div class="col-md-3 text-center">
                <img src="/assets/img/bestseller2.webp" class="img-fluid" alt="Produit 2">
                <p>Exotic Sweet - <strong>35,00€</strong></p>
            </div>
            <div class="col-md-3 text-center">
                <img src="/assets/img/bestseller3.webp" class="img-fluid" alt="Produit 3">
                <p>Ahlam - <strong>35,00€</strong></p>
            </div>
        </div>

        <!-- Contenu Coffrets (caché par défaut) -->
        <div id="coffretsContent" class="row justify-content-center mt-4 d-none">
            <div class="col-md-3 text-center">
                <img src="/assets/img/coffret1.webp" class="img-fluid" alt="Coffret 1">
                <p>Coffret Noël - <strong>45,00€</strong></p>
            </div>
            <div class="col-md-3 text-center">
                <img src="/assets/img/coffret2.webp" class="img-fluid" alt="Coffret 2">
                <p>Coffret Fête - <strong>50,00€</strong></p>
            </div>
            <div class="col-md-3 text-center">
                <img src="/assets/img/coffret3.webp" class="img-fluid" alt="Coffret 3">
                <p>Coffret Luxe - <strong>70,00€</strong></p>
            </div>
        </div>
    </section>

    <!-- Section Produit vedette -->
    <section class="my-5">
        <h2 class="text-center text-gradient">Notre produit vedette</h2>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="/assets/img/produit-vedette.webp" class="img-fluid" alt="Produit vedette">
            </div>
            <div class="col-md-6">
                <h3>Exotic Sweet</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Cras a augue non ante mattis dictum.</p>
                <p><strong>Prix : 35,00€</strong></p>
                <div class="d-flex align-items-center">
                    <label for="quantity" class="me-2">Quantité :</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" class="form-control w-25 me-3">
                    <button class="btn btn-dark">Ajouter au panier</button>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="/assets/js/accueil.js"></script>
