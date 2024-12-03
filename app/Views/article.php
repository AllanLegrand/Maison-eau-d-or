<link rel="stylesheet" href="/assets/css/article.css">

	<h1>Liste des Articles</h1>
	<div class="articles-container">
		<?php if (!empty($articles) && is_array($articles)): ?>
			<?php foreach ($articles as $article): ?>
				<div class="article">
					<h2><?= esc($article['titre']) ?></h2>
					<p>Date de publication : <?= esc($article['date']) ?></p>
					<img src="/assets/img/<?= esc($article['img_path']) ?>" alt="<?= esc($article['titre']) ?>"
						class="article-image">
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>Aucun article disponible pour le moment.</p>
		<?php endif; ?>
	</div>

	<div class="pagination">
		<?= $pager->links() ?>
	</div>

