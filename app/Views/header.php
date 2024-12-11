<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Eau d'Or</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/<?= strtolower($title) ?>.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>
<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <!-- Logo -->
                <div>
                    <a class="navbar-brand" href="<?= base_url('Accueil') ?>">
                        <img src="/assets/img/maisoneaudor.webp" alt="Maison Eau d'Or" height="50">
                    </a>
                </div>
                
                <!-- Toggler for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navbar Links -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown" id="menu-boutique">
                            <a class="nav-link fw-bold" href="/boutique" id="boutiqueDropdown" role="button" aria-expanded="false">
                                Boutique
                            </a>
                            <div class="dropdown-menu" id="categories-menu"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="/about">À propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="/blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="/faq">FAQ</a>
                        </li>
                    </ul>
                </div>

                <!-- Right-side icons -->
                <div class="d-flex align-items-center">
                    <!-- Search Icon -->
                    <div class="ms-auto d-flex align-items-center position-relative">
                        <input type="text" class="form-control search-bar me-2" placeholder="Rechercher un produit ..." oninput="searchProduits(this.value)">
                        <div id="searchResults" class="search-results"></div>
                    </div>
                    <!-- User Account Icon -->
                    <a href="javascript:void(0)" class="btn btn-link" onclick="handleUserIconClick()">
                        <img src="/assets/img/user.png" alt="Compte" height="30">
                    </a>
                    <!-- Cart Icon -->
                    <a href="javascript:void(0)" class="btn btn-link" onclick="openCart()">
                        <img src="/assets/img/panier.png" alt="Panier" height="30">
                    </a>
                </div>
            </div>
        </nav>
        <!-- Bootstrap JavaScript (optional for interactive elements) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JavaScript -->
        <script src="/assets/js/header.js"></script>
    </header>

    <div id="cartSidebar" class="cart-sidebar">
        <div class="cart-header">
            <h5>Votre Panier</h5>
            <span class="close-cross" onclick="closeCart()">×</span>
        </div>
        <div id="cartItems"></div>
        <div id="cartTotal"></div>
        <button class="finalize-button">Finaliser la commande</button>
    </div>

    <div id="userSidebar" class="user-sidebar">
        <div class="user-header">
            <h5>Vos Informations</h5>
            <span class="close-cross" onclick="closeUserSidebar()">×</span>
        </div>
        <div id="userDetails"></div>
        <button class="editProfil" onClick="test()">Plus d'informations</button>
        <button class="deconnexion" onClick="disconnect()">Se déconnecter</button>
    </div>

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