

<main class="container my-5">
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <!-- Indicateurs du carrousel -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <!-- Carrousel interne -->
    <div class="carousel-inner">
        <!-- Première diapositive -->
        <div class="carousel-item active">
            <img src="/assets/img/imgbandeau1.jpg" class="d-block w-100" alt="Image d'accueil">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-4">Bienvenue</h1>
                <p class="lead">Découvrez la parfumerie Maison Eau d'Or, votre destination pour des parfums uniques et élégants.</p>
            </div>
        </div>

        <!-- Deuxième diapositive -->
        <div class="carousel-item">
            <img src="/assets/img/imgbandeau2.webp" class="d-block w-100" alt="Produit 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Qualité Premium</h5>
                <p>Une expérience unique et mémorable.</p>
            </div>
        </div>

        <!-- Troisième diapositive -->
        <div class="carousel-item">
            <img src="/assets/img/imgbandeau3.jpg" class="d-block w-100" alt="Produit 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Parfums Élégants</h5>
                <p>Pour accompagner chaque moment de votre vie.</p>
            </div>
        </div>
    </div>

    <!-- Contrôles du carrousel -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>
    <!-- Section choix Bestsellers ou Coffrets -->
    <section class="my-5">
        <div class="text-center bordergold">
            <!-- Titres cliquables pour Bestsellers ou Coffrets -->
            <h2 class="section-title active" id="bestsellersTitle" onclick="toggleContent('bestsellers')">Bestsellers</h2>
            <h2 class="section-title" id="coffretsTitle" onclick="toggleContent('coffrets')">Nos Coffrets</h2>
        </div>

        <!-- Contenu Bestsellers -->
        <div id="bestsellersContent" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                // Divisez les produits en groupes de 3 pour afficher sur plusieurs lignes
                $chunks = array_chunk($produitsBestsellers, 3);
                foreach ($chunks as $index => $row):
                ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="carousel-container d-flex justify-content-center">
                            <?php foreach ($row as $produitBestseller): ?>
                                <div class="product-item col-12 col-sm-6 col-md-4 col-xl-3 mx-3" onclick="openModal(<?= $produitBestseller['id_prod'] ?>)">
                                    <?php 
                                        $imagePath = base_url('assets/img/' . $produitBestseller['img_path']);
                                        $defaultImage = base_url('assets/img/default.png');
                                    ?>
                                    <img 
                                        src="<?= file_exists('./assets/img/' . $produitBestseller['img_path']) ? $imagePath : $defaultImage ?>" 
                                        alt="<?= esc($produitBestseller['nom']) ?>" 
                                        class="product-img">
                                    
                                    <div class="product-info text-center">
                                        <h5 class="product-title"><?= esc($produitBestseller['nom']) ?></h5>
                                        <p class="product-prix doree"><?= esc($produitBestseller['prix']) ?> €</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Contrôles pour le carrousel avec flèches -->
            <button class="carousel-control-prev custom-prev" type="button" data-bs-target="#bestsellersContent" data-bs-slide="prev">
                <img src="/assets/img/back.png" alt="Previous" class="custom-arrow">
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next custom-next" type="button" data-bs-target="#bestsellersContent" data-bs-slide="next">
                <img src="/assets/img/next.png" alt="Next" class="custom-arrow">
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Contenu Coffrets -->
        <div id="coffretsContent" class="carousel slide mt-4 d-none" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                // Divisez les produits en groupes de 3 pour afficher sur plusieurs lignes
                $chunks = array_chunk($produitsCoffret, 3);
                foreach ($chunks as $index => $row):
                ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="carousel-container d-flex justify-content-center">
                            <?php foreach ($row as $produitCoffret): ?>
                                <div class="product-item col-12 col-sm-6 col-md-4 col-xl-3 mx-3" onclick="openModal(<?= $produitCoffret['id_prod'] ?>)">
                                    <?php 
                                        $imagePath = base_url('assets/img/' . $produitCoffret['img_path']);
                                        $defaultImage = base_url('assets/img/default.png');
                                    ?>
                                    <img 
                                        src="<?= file_exists('./assets/img/' . $produitCoffret['img_path']) ? $imagePath : $defaultImage ?>" 
                                        alt="<?= esc($produitCoffret['nom']) ?>" 
                                        class="product-img">
                                    
                                    <div class="product-info text-center">
                                        <h5 class="product-title"><?= esc($produitCoffret['nom']) ?></h5>
                                        <p class="product-prix doree"><?= esc($produitCoffret['prix']) ?> €</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Contrôles pour le carrousel avec flèches -->
            <button class="carousel-control-prev custom-prev" type="button" data-bs-target="#coffretsContent" data-bs-slide="prev">
                <img src="/assets/img/back.png" alt="Previous" class="custom-arrow">
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next custom-next" type="button" data-bs-target="#coffretsContent" data-bs-slide="next">
                <img src="/assets/img/next.png" alt="Next" class="custom-arrow">
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Voir tous les produits -->
        <div class="text-center mt-4">
            <a href="/boutique" class="btn btn-outline-dark"><strong>Voir tous les produits</strong></a>
        </div>
    </section>


    <!-- Section Produit vedette -->
    <section class="my-5">
        <h2 class="text-center text-gradient">Notre produit vedette</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-center mt-4">
            <?php if($produitVedette): ?>
                <?php 
                    $imagePath = base_url('assets/img/' . $produitVedette['img_path']);
                    $defaultImage = base_url('assets/img/default.png');
                ?>
                <img 
                    src="<?= file_exists('./assets/img/' . $produitVedette['img_path']) ? $imagePath : $defaultImage ?>" 
                    alt="<?= esc($produitVedette['nom']) ?>" 
                    class="img-fluid">
                <div class="col-md-6">
                    <h3><?=esc($produitVedette['nom'])?></h3>
                    <p><?=esc($produitVedette['description'])?></p>
                    <p>Prix : <strong class="doree"><?=esc($produitVedette['prix'])?> €</strong></p>
                    <div class="c-flex">
                        <label for="quantity" class="me-2">Quantité</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" class="form-control w-25 me-3">
                        <button class="btn btn-dark btn-img button-margin" onclick="addToCart2(<?= $produitVedette['id_prod'] ?>)">Ajouter au panier <img src="/assets/img/ajouter-panier.svg" class="img-btn"></button>
                    </div>
                </div>
            <?php else: ?>
                <p>Produit vedette non disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="my-5">
        <h2 class="text-center text-gradient">Ils nous ont fait confiance</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-center mt-4">
            <script src="https://static.elfsight.com/platform/platform.js" async></script>
            <div class="elfsight-app-040cfbac-8c36-4a30-a547-6d03ffe2f3d1" data-elfsight-app-lazy></div>
        </div>
    </section>
</main>

<!-- Section newsletter -->
<?php if($afficheNews): ?>
    <section class="newsletter">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="newsletter-title">
                <h4 style="text-align: center;">Newsletter<br>Maison eau d'or</h4>
            </div>
            <div class="newsletter-text">
                <p>Inscrivez-vous à notre newsletter pour recevoir nos dernières actualités</p>
            </div>
            <div class="newsletter-btn">
                <form action="/accueil/subscribeToNewsletter" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-dark">Inscrivez-vous !</button>
                </form>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Modal -->
<div id="productModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <!-- Croix pour fermer -->
        <span class="close-cross" onclick="closeModal()">&times;</span>

        <div class="d-flex flex-wrap justify-content-center align-items-center modal-border modal-row">
            <img id="modalProductImage" src="/assets/img/default.png" class="img-fluid" alt="Image produit">
            <div class="col-md-6">
                <h3 id="modalProductName"></h3>
                <p id="modalProductDescription"></p>
                <p>Prix : <strong class="doree" id="modalProductPrice"></strong></p>
                <div class="c-flex">
                    <label for="quantity" class="me-2">Quantité</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" class="form-control w-25 me-3">
                    <button onclick="addToCart()" class="btn btn-dark btn-img">Ajouter au panier 
                        <img src="/assets/img/ajouter-panier.svg" class="img-btn">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/accueil.js"></script>
