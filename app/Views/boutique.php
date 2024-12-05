<div class="container my-5">
	<h1 class="text-center bordergold">Boutique</h1>

	<!-- Filtre des catégories -->
	<form method="GET" action="<?= base_url('boutique') ?>" class="mb-4">
		<div class="d-flex justify-content-center gap-3 flex-wrap">
		<button type="submit" name="cat" value="" class="category-btn <?= (is_null($currentCategory)) ? 'active' : '' ?>">
            Tous
        </button>
		<?php foreach ($categories as $categorie): ?>
			<button type="submit" name="cat" value="<?= $categorie['id_cat'] ?>" class="category-btn <?= ($currentCategory == $categorie['id_cat']) ? 'active' : '' ?>">
				<?= esc($categorie['nom']) ?>
			</button>
		<?php endforeach; ?>
		</div>
	</form>


    <!-- Produits -->
    <div class="row gx-4 gy-5">
        <?php if (!empty($produits)) : ?>
            <?php foreach ($produits as $produit) : ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="product-item" onclick="openModal(<?= $produit['id_prod'] ?>)">
                        <?php 
                            $imagePath = base_url('assets/img/' . $produit['img_path']);
                            $defaultImage = base_url('assets/img/default.png');
                        ?>
                        <img 
                            src="<?= file_exists('./assets/img/' . $produit['img_path']) ? $imagePath : $defaultImage ?>" 
                            alt="<?= esc($produit['nom']) ?>" 
                            class="product-img">
                        <div class="product-info text-center">
                            <h5 class="product-title"><?= esc($produit['nom']) ?></h5>
                            <p class="product-prix doree"><?= esc($produit['prix']) ?> €</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">Aucun produit disponible pour le moment.</p>
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
                    <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" class="form-control w-25 me-3">
                    <button onclick="addToCart()" class="btn btn-dark btn-img">Ajouter au panier 
                        <img src="/assets/img/ajouter-panier.svg" class="img-btn">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="/assets/js/boutique.js"></script>


