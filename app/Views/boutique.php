<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Boutique</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/boutique.css') ?>">
</head>
<body>
	<div class="container mt-5">
		<h1 class="text-center">Boutique</h1>
		<div class="row mt-4">
			<?php if (!empty($produits)) : ?>
				<?php foreach ($produits as $produit) : ?>
					<div class="col-md-4 mb-4">
						<div class="card text-center produit" onclick="openModal(<?= $produit['id_prod'] ?>)">
							<img src="<?= base_url('assets/img/default.png') ?>" 
								class="card-img-top img-fluid mx-auto" 
								alt="<?= esc($produit['nom']) ?>" 
								style="max-height: 420px; object-fit: cover;">
							<h5 class="card-title mt-3"><?= esc($produit['nom']) ?></h5>
							<div class="card-body">
								<p class="card-text doree"><strong><?= esc($produit['prix']) ?> €</strong></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<p class="text-center">Aucun produit disponible pour le moment.</p>
			<?php endif; ?>
		</div>
		<div class="pagination">
			<?= $pager ?>
		</div>
	</div>

	<script src='assets/js/boutique.js'></script>

	<!-- Modal Pop-up -->
	<div id="productModal" class="modal">
		<div class="modal-content">
			<span class="close" onclick="closeModal()">&times;</span>
			<img id="modalProductImage" src="/assets/img/default.png" alt="Image du produit" class="img-fluid mb-3">
			<h2 id="modalProductName"></h2>
			<p id="modalProductDescription"></p>
			<p id="modalProductPrice"></p>
			<button onclick="closeModal()" class="btn btn-danger">Fermer</button>
		</div>
	</div>
