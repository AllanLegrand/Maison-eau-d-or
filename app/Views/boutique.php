<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Boutique</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/boutique.css') ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<div class="contenu">
		<h1>Boutique</h1>
		<form method="GET" action="<?= base_url('boutique') ?>">
			<label for="categories">Filtre :</label>
			<select name="cat" id="categories" onchange="this.form.submit()">
				<option value="" <?= (is_null($currentCategory) ? 'selected' : '') ?>>Toutes les catégories</option>
				<?php foreach ($categories as $categorie): ?>
					<option value="<?= $categorie['id_cat'] ?>" <?= ($currentCategory == $categorie['id_cat']) ? 'selected' : '' ?>>
						<?= esc($categorie['nom']) ?>
					</option>
				<?php endforeach; ?>
			</select>
		</form>
		<div class="row">
			<?php if (!empty($produits)) : ?>
				<?php foreach ($produits as $produit) : ?>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="produit" onclick="openModal(<?= $produit['id_prod'] ?>)">
							<?php 
								$imagePath = base_url('assets/img/' . $produit['img_path']);
								$defaultImage = base_url('assets/img/default.png');
							?>
							<img 
								src="<?= file_exists('./assets/img/' . $produit['img_path']) ? $imagePath : $defaultImage ?>" 
								class="produit-img-top" 
								alt="<?= esc($produit['nom']) ?>" 
								style="max-height: 420px; object-fit: cover;">
							<h5 class="produit-title"><?= esc($produit['nom']) ?></h5>
							<p class="produit-prix"><?= esc($produit['prix']) ?> €</p>
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

	<script src="<?= base_url('assets/js/boutique.js') ?>"></script>

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
