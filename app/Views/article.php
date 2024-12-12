<link rel="stylesheet" href="/assets/css/article.css">
<script src="https://cdn.tiny.cloud/1/ykhnn1uuwtja98fn7bo25quckri41i762dvrv8bg3ui23ump/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<?php if (!$admin): ?>
	<style>
		.article {
			height: 425px;
		}
	</style>
<?php endif; ?>

<h1>Liste des Articles</h1>
	<div class="articles-container">
		<?php if (!empty($articles) && is_array($articles)): ?>
			<?php foreach ($articles as $article): ?>
				<div class="article" onclick="openArticle(<?= htmlspecialchars(json_encode($article), ENT_QUOTES, 'UTF-8') ?>)">
					<img src="/assets/img/<?= esc($article['img_path']) ?>" alt=" "
						class="article-image">
					<h2><?= esc($article['titre']) ?></h2>
					<p>Date de publication : <?= esc($article['date']) ?></p>

					<?php if ($admin): ?>
							<button class="btn btn-sm btn-outline-secondary edit-btn"
								onclick="openEditArticleModal(event, <?= htmlspecialchars(json_encode($article), ENT_QUOTES, 'UTF-8') ?>)">
								<i class="fa fa-pencil" aria-hidden="true"></i> Modifier
							</button>
							<button class="btn btn-sm btn-outline-secondary supp-btn"
								onclick="if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) location.href='/suppArticle/<?= esc($article['id_art']) ?>';">
								<i class="fa fa-pencil" aria-hidden="true"></i> Supprimer
							</button>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>Aucun article disponible pour le moment.</p>
		<?php endif; ?>

		<?php if ($admin): ?>
			<div class="article admin-add">
				<h2>Ajouter un nouvel article</h2>
				<p>Cliquez sur le bouton ci-dessous pour créer un nouvel article.</p>
				<button id="openModalAddArticle" onclick="openAddArticleModal()" class="btn-add-article">+ Ajouter un article</button>
			</div>


			<div id="articleAddModal" style="display: none;">
				<div class="modal-content">
					<span id="closeAddArticleModal" onclick="closeAddArticleModal()" style="cursor: pointer;">&times;</span>
					<h2>Ajouter un article</h2>
					<form id="addArticle" method="POST" action="/addArticle" enctype="multipart/form-data">
						<hr>
						<div>
							<label for="addTitre">Titre</label>
							<br>
							<input type="text" id="addTitre" name="titre" required>
						</div>
						<hr>
						<div>
							<input type="file" id="file" name="image" accept="image/*">
						</div>
						<hr>
						<div>
							<textarea id="addDescription" name="description"></textarea>
						</div>

						<hr>
						<button type="submit" class="btn btn-sm btn-outline-secondary edit-btn">Créer</button>
						<button type="button" onclick="openVisuArticleModal(true)" class="btn btn-sm btn-outline-secondary edit-btn">Aperçu</button>
					</form>
				</div>
			</div>

			<div id="articleEditModal" style="display: none;">
				<div class="modal-content">
					<span id="closeEditArticleModal" onclick="closeEditArticleModal()" style="cursor: pointer;">&times;</span>
					<h2>Ajouter un article</h2>
					<form id="addArticle" method="POST" action="/editArticle" enctype="multipart/form-data">
						<input type="text" id="artId" name="id_art" class="form-control" placeholder="ID de l'article"
						style="display:none;">
						<hr>
						<img id="editImg" src="/assets/img/" alt="" id="articleImg" class="article-image" style="display: none;">
						<div>
							<label for="editTitre">Titre</label>
							<br>
							<input type="text" id="editTitre" name="titre" required>
						</div>
						<hr>
						<div>
							<input type="file" id="file" name="image" accept="image/*">
						</div>
						<hr>
						<div>
							<textarea id="editDescription" name="description"></textarea>
						</div>

						<hr>
						<button type="submit" class="btn btn-sm btn-outline-secondary edit-btn">Modifier</button>
						<button type="button" onclick="openVisuArticleModal(false)" class="btn btn-sm btn-outline-secondary edit-btn">Aperçu</button>
					</form>
				</div>
			</div>
		<?php endif; ?>

		<div id="articleModal" style="display: none;">
				<div class="modal-content modalArticle">
					<span id="closeArticleModal" onclick="closeArticleModal()" style="cursor: pointer;">&times;</span>
					<img src="/assets/img/" alt="" id="articleImg" class="article-image">
					<div class="suite">
						<h1 id="titreArticle"></h1>
						
						<hr>
						<div id="contenuArticle">
						</div>
					</div>
				</div>
			</div>
	</div>

	<script src="/assets/js/article.js"></script>

	<div class="pagination">
		<?= $pager->links() ?>
	</div>