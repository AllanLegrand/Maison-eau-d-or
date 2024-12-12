<script src="https://cdn.tiny.cloud/1/ykhnn1uuwtja98fn7bo25quckri41i762dvrv8bg3ui23ump/tinymce/6/tinymce.min.js"
	referrerpolicy="origin"></script>
<script src="/assets/js/apropos.js"></script>
<main class="container py-4 pagestyle">
	<h1>A propos</h1>
	<?php if ($admin): ?>
		<form action="/faq/contact" method="post">
			<textarea id="modifiableApropos"></textarea>
			<button type="submit" class="btn btn-sm btn-outline-secondary ajout-btn"
				onclick="">Modifier</button>
		</form>
	<?php endif; ?>
	<section class="privacy-section">
		<?php if (!empty($apropos)): ?>

			<div id="content-a-propos"><?= $apropos['msg'] ?></div>
		<?php else: ?>
			Rien a voir pour le moment. Passez votre chemin.
		<?php endif; ?>
	</section>
</main>

<script>
		tinymce.get('modifiableApropos').setContent(document.getElementById("content-a-propos").innerHTML);
</script>
