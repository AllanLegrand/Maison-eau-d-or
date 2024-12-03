<main class="container my-5">
    <!-- Carrousel -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1 avec texte d'accueil -->
            <div class="carousel-item active">
                <img src="/assets/img/imgbandeau1.jpg" class="d-block w-100" alt="Image d'accueil">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-4">Bienvenue</h1>
                    <p class="lead">Découvrez la parfumerie Maison Eau d'Or, votre destination pour des parfums uniques et élégants.</p>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="/assets/img/imgbandeau2.webp" class="d-block w-100" alt="Produit 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Qualité Premium</h5>
                    <p>Une expérience unique et mémorable.</p>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="/assets/img/imgbandeau3.jpg" class="d-block w-100" alt="Produit 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Parfums Élégants</h5>
                    <p>Pour accompagner chaque moment de votre vie.</p>
                </div>
            </div>
        </div>
        <!-- Contrôles du carrousel -->
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
            <?php foreach($produitsBestsellers as $produitBestsellers): ?>
                <div class="col-md-3 text-center">
                    <img src="/assets/img/<?= esc($produitBestsellers['img_path'])?>" class="img-fluid" alt="<?=esc($produitBestsellers['nom'])?>">
                    <p><?=esc($produitBestsellers['nom'])?><br><strong class="doree"><?=esc($produitBestsellers['prix'])?> €</strong></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Contenu Coffrets (caché par défaut) -->
        <div id="coffretsContent" class="row justify-content-center mt-4 d-none">
            <?php foreach($produitsCoffret as $produitCoffret): ?>
                <div class="col-md-3 text-center">
                    <img src="/assets/img/<?= esc($produitCoffret['img_path'])?>" class="img-fluid" alt="<?=esc($produitCoffret['nom'])?>">
                    <p><?=esc($produitCoffret['nom'])?><br><strong class="doree"><?=esc($produitCoffret['prix'])?> €</strong></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center">
            <a href="/boutique" class="btn btn-outline-dark"><strong>Voir tous les produits</strong></a>
        </div>
    </section>

    <!-- Section Produit vedette -->
    <section class="my-5">
        <h2 class="text-center text-gradient">Notre produit vedette</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-center mt-4">
            <?php if($produitVedette): ?>
                <img src="/assets/img/<?=esc($produitVedette['img_path']) ?>" class="img-fluid" alt="<?=esc($produitVedette['nom'])?>">
                <div class="col-md-6">
                    <h3><?=esc($produitVedette['nom'])?></h3>
                    <p><?=esc($produitVedette['description'])?></p>
                    <p>Prix : <strong class="doree"><?=esc($produitVedette['prix'])?> €</strong></p>
                    <div class="c-flex">
                        <label for="quantity" class="me-2">Quantité</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" class="form-control w-25 me-3">
                        <button class="btn btn-dark btn-img">Ajouter au panier <img src="/assets/img/ajouter-panier.svg" class="img-btn"></button>
                    </div>
                </div>
            <?php else: ?>
                <p>Produit vedette non disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<!-- Section newsletter -->
<?php /*if($afficheNews):*/ ?>
    <!-- Bandeau Newsletter -->
    <section class="newsletter">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="newsletter-title">
                <h4 style="text-align: center;">Newsletter<br>Maison eau d'or</h4>
            </div>
            <div class="newsletter-text">
                <p>Inscrivez-vous à notre newsletter pour recevoir nos dernières actualités</p>
            </div>
            <div class="newsletter-btn">
                <a href="#" class="btn btn-dark">Inscrivez-vous !</a>
            </div>
        </div>
    </section>
<?php /* endif; */?>

<script src="/assets/js/accueil.js"></script>
