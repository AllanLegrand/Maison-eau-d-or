
<div class="container my-5">
	<h1 class="text-center bordergold">Boutique</h1>

	<!-- Filtre des catégories -->
	<form method="GET" action="<?= base_url('boutique') ?>" class="mb-4">
		<div class="d-flex justify-content-center gap-3 flex-wrap">
			<button type="submit" name="cat" value=""
				class="category-btn <?= (is_null($currentCategory)) ? 'active' : '' ?>">
				Tous
			</button>
			<?php foreach ($categories as $categorie): ?>
				<button type="submit" name="cat" value="<?= $categorie['id_cat'] ?>"
					class="category-btn <?= ($currentCategory == $categorie['id_cat']) ? 'active' : '' ?>">
					<?= esc($categorie['nom']) ?>
				</button>
			<?php endforeach; ?>
		</div>
	</form>


	<!-- Produits -->
	<div class="row gx-4 gy-5">
		<?php if (!empty($produits)): ?>
			<?php foreach ($produits as $produit): ?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="product-item" onclick="openModal(<?= $produit['id_prod'] ?>)">
						<?php
						$imagePath = base_url('assets/img/' . $produit['img_path']);
						$defaultImage = base_url('assets/img/default.png');
						?>
						<img src="<?= file_exists('./assets/img/' . $produit['img_path']) ? $imagePath : $defaultImage ?>"
							alt="<?= esc($produit['nom']) ?>" class="product-img">
						<div class="product-info text-center">
							<h5 class="product-title"><?= esc($produit['nom']) ?></h5>
							<p class="product-prix doree"><?= esc($produit['prix']) ?> €</p>

							<?php if ($admin): ?>
								<button class="btn btn-sm btn-outline-secondary edit-btn"
									onclick="openEditArticleModal(event, <?= htmlspecialchars(json_encode($produit), ENT_QUOTES, 'UTF-8') ?>,<?= htmlspecialchars(json_encode(isset($dicProdCat[$produit['id_prod']]) ? $dicProdCat[$produit['id_prod']] : [] ), ENT_QUOTES, 'UTF-8') ?>)">
									<i class="fa fa-pencil" aria-hidden="true"></i> Modifier
								</button>
								<button class="btn btn-sm btn-outline-secondary supp-btn"
									onclick="if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) location.href='/suppProduit/<?= esc($produit['id_prod']) ?>';">
									<i class="fa fa-pencil" aria-hidden="true"></i> Supprimer
								</button>
							<?php endif; ?>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		<?php else: ?>
			<p class="text-center">Aucun produit disponible pour le moment.</p>
		<?php endif; ?>

		<?php if ($admin): ?>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="admin-add">
					<h2>Ajouter un nouveau produit</h>
						<p>Cliquez sur le bouton ci-dessous pour créer un nouveau produit.</p>
						<button id="openModalAddArticle" onclick="openAddArticleModal()" class="btn-add-article">+ Ajouter
							un produit</button>
				</div>
			</div>

			<div id="editProductModal" class="modal-overlay" style="display: none;">
				<div class="modal-content">
					<!-- Bouton pour fermer -->
					<span class="close-cross" onclick="closeEditProductModal()">&times;</span>
					<h3 class="text-center mb-4">Modifier un Produit</h3>
					<form id="editProductForm" action="<?= base_url('editProduit') ?>" method="post"
						enctype="multipart/form-data">
						<input type="text" id="productId" name="id_prod" class="form-control" placeholder="ID du produit" style="display:none;">
						<div class="mb-3">
							<label for="productName" class="form-label">Nom du produit</label>
							<input type="text" id="productName" name="nom" class="form-control" placeholder="Nom du produit"
								required>
						</div>
						<div class="mb-3">
							<label for="productPrice" class="form-label">Prix (€)</label>
							<input type="number" id="productPrice" name="prix" class="form-control"
								placeholder="Prix du produit" required step="0.01">
						</div>
						<div class="mb-3">
							<label for="productDescription" class="form-label">Description</label>
							<textarea id="productDescription" name="description" class="form-control" rows="4"
								placeholder="Description du produit"></textarea>
						</div>
						<div class="mb-3">
							<label for="productImage" class="form-label">Image du produit</label>
							<input type="file" id="productImage" name="image" class="form-control" accept="image/*">
						</div>
						<div class="mb-3">
							<label for="productStatus" class="form-label">Statut</label>
							<select id="productStatus" name="actif" class="form-select" required>
								<option value="1">Actif</option>
								<option value="0">Inactif</option>
							</select>
						</div>

						<div class="mb-3">
							<label for="productCategories" class="form-label">Catégories</label>
							<ul class="list-group" id="productCategories" style="max-height: 120px; overflow-y: auto;">
								<?php foreach ($categories as $categorie): ?>
									<li class="list-group-item">
										<input class="form-check-input me-1" type="checkbox" name="categories[]"
											value="<?= esc($categorie['id_cat']) ?>"
											id="categoryCheckbox<?= esc($categorie['id_cat']) ?>">
										<label class="form-check-label stretched-link"
											for="categoryCheckbox<?= esc($categorie['id_cat']) ?>">
											<?= esc($categorie['nom']) ?>
										</label>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<button type="submit" class="btn btn-dark w-100">Modifier le produit</button>
					</form>
				</div>
			</div>

			<!-- Modal Ajouter Produit -->
			<div id="addProductModal" class="modal-overlay" style="display: none;">
				<div class="modal-content">
					<!-- Bouton pour fermer -->
					<span class="close-cross" onclick="closeAddProductModal()">&times;</span>
					<h3 class="text-center mb-4">Ajouter un Nouveau Produit</h3>
					<form id="addProductForm" action="<?= base_url('addProduit') ?>" method="post"
						enctype="multipart/form-data">
						<div class="mb-3">
							<label for="productName" class="form-label">Nom du produit</label>
							<input type="text" id="productName" name="nom" class="form-control" placeholder="Nom du produit"
								required>
						</div>
						<div class="mb-3">
							<label for="productPrice" class="form-label">Prix (€)</label>
							<input type="number" id="productPrice" name="prix" class="form-control"
								placeholder="Prix du produit" required>
						</div>
						<div class="mb-3">
							<label for="productDescription" class="form-label">Description</label>
							<textarea id="productDescription" name="description" class="form-control" rows="4"
								placeholder="Description du produit"></textarea>
						</div>
						<div class="mb-3">
							<label for="productImage" class="form-label">Image du produit</label>
							<input type="file" id="productImage" name="image" class="form-control" accept="image/*">
						</div>
						<div class="mb-3">
							<label for="productStatus" class="form-label">Statut</label>
							<select id="productStatus" name="actif" class="form-select" required>
								<option value="1">Actif</option>
								<option value="0">Inactif</option>
							</select>
						</div>

						<div class="mb-3">
							<label for="productCategories" class="form-label">Catégories</label>
							<ul class="list-group" id="productCategories" style="max-height: 120px; overflow-y: auto;">
								<?php foreach ($categories as $categorie): ?>
									<li class="list-group-item">
										<input class="form-check-input me-1" type="checkbox" name="categories[]"
											value="<?= esc($categorie['id_cat']) ?>"
											id="categoryCheckbox<?= esc($categorie['id_cat']) ?>">
										<label class="form-check-label stretched-link"
											for="categoryCheckbox<?= esc($categorie['id_cat']) ?>">
											<?= esc($categorie['nom']) ?>
										</label>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<button type="submit" class="btn btn-dark w-100">Ajouter le produit</button>
					</form>
				</div>
			</div>

		<?php endif; ?>
	</div>

	<!-- Pagination -->
	<div class="pagination d-flex justify-content-center mt-4">
		<?= $pager ?>
	</div>
</div>


<!-- Modal -->
<div id="productModal" class="modal-overlay" style="display: none;">
	<div class="modal-content">
		<!-- Croix pour fermer -->
		<span class="close-cross" onclick="closeModal()">&times;</span>

		<div class="d-flex flex-wrap justify-content-center align-items-center modal-border">
			<img id="modalProductImage" src="/assets/img/default.png" class="img-fluid" alt="Image produit">
			<div class="col-md-6">
				<h3 id="modalProductName"></h3>
				<p id="modalProductDescription"></p>
				<p>Prix : <strong class="doree" id="modalProductPrice"></strong></p>
				<div class="c-flex">
					<label for="quantity" class="me-2">Quantité</label>
					<input type="number" id="quantity" name="quantity" min="1" max="10" value="1"
						class="form-control w-25 me-3">
					<button onclick="addToCart()" class="btn btn-dark btn-img">Ajouter au panier
						<img src="/assets/img/ajouter-panier.svg" class="img-btn">
					</button>
				</div>
			</div>
		</div>
	</div>
</div>



<script src="/assets/js/boutique.js"></script>