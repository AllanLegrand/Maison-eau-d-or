<link rel="stylesheet" href="/assets/css/article.css">
<script src="https://cdn.tiny.cloud/1/ykhnn1uuwtja98fn7bo25quckri41i762dvrv8bg3ui23ump/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<h1>Liste des Articles</h1>
	<div class="articles-container">
		<?php if (!empty($articles) && is_array($articles)): ?>
			<?php foreach ($articles as $article): ?>
				<div class="article">
					<img src="/assets/img/<?= esc($article['img_path']) ?>" alt=" "
						class="article-image">
					<h2><?= esc($article['titre']) ?></h2>
					<p>Date de publication : <?= esc($article['date']) ?></p>

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
						<button type="submit" class="btn-add-article">Créer</button>
					</form>
				</div>
			</div>
		<?php endif; ?>
	</div>

	<script src="/assets/js/article.js"></script>

	<div class="pagination">
		<?= $pager->links() ?>
	</div>