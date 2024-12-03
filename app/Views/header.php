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
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="<?= base_url('Accueil') ?>">
                    <img src="/assets/img/maisoneaudor.webp" alt="Maison Eau d'Or" height="50">
                </a>
                
                <!-- Toggler for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navbar Links -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="/boutique">Boutique</a>
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
                        <input type="text" class="form-control search-bar me-2" placeholder="Rechercher un produit ..." oninput="searchProjects(this.value)">
                        <div id="searchResults" class="search-results"></div>
                    </div>
                    <!-- User Account Icon -->
                    <a href="/signin" class="btn btn-link">
                        <img src="/assets/img/user.png" alt="Compte" height="30">
                    </a>
                    <!-- Cart Icon -->
                    <a href="/panier" class="btn btn-link">
                        <img src="/assets/img/panier.png" alt="Panier" height="30">
                    </a>
                </div>
            </div>
        </nav>
    <!-- Bootstrap JavaScript (optional for interactive elements) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </header>