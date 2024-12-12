<script src="https://cdn.tiny.cloud/1/ykhnn1uuwtja98fn7bo25quckri41i762dvrv8bg3ui23ump/tinymce/6/tinymce.min.js"
	referrerpolicy="origin"></script>
<link rel="stylesheet" href="/assets/css/faq.css">
<div class="container my-5">
	<div class="faq-header">Foire aux questions</div>
	<div class="faq-content">
		<?php if (!empty($faq) && is_array($faq)): ?>
			<?php foreach ($faq as $questionReponse): ?>
				<div class="faq-question">
					<input id="q<?= esc($faq['id_faq']) ?>" type="checkbox" class="panel">
					<div class="plus">+</div>
					<label for="q1" class="panel-title"><?= esc($faq['question']) ?></label>
					<div class="panel-content"><?= esc($faq['reponse']) ?></div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>Aucune question n'est disponible pour le moment.</p>
		<?php endif; ?>

		<?php if ($admin): ?>
			<button type="button" onclick="ajouterQuest()">Ajouter</button>

			<form id="editFAQ" action="<?= base_url('editFAQ') ?>" method="post" style="display:none;">
				<label for="question" class="form-label">Question</label>
				<textarea id="questionAdd" name="question"></textarea>
				<label for="question" class="form-label">Réponse</label>
				<textarea id="reponseAdd" name="reponse"></textarea>
				
				<button type="submit">Enregistrer</button>
			</form>

			<div id="faqAddModal" style="display: none;">
				<div class="modal-content">
					<span id="closeAddFAQModal" onclick="closeAddFAQModal()" style="cursor: pointer;">&times;</span>
					<h2>Ajouter une question-réponse</h2>
					<form id="addFAQ" method="POST" action="/addFAQ">
						<hr>
						<div>
							<label for="email" class="form-label">Votre email :</label>
							<textarea id="addDescription" name="description"></textarea>
						</div>

						<hr>
						<button type="submit" class="btn btn-sm btn-outline-secondary edit-btn">Créer</button>
						<button type="button" onclick="openVisuArticleModal(true)" class="btn btn-sm btn-outline-secondary edit-btn">Aperçu</button>
					</form>
				</div>
			</div>
		<?php endif; ?>
	</div>


	<div class="mt-5">
		<h3>Contactez-nous</h3>
		<form action="/faq/contact" method="post">
			<div class="mb-3">
				<label for="name" class="form-label">Votre nom :</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Votre email :</label>
				<input type="email" class="form-control" id="email" name="email" required>
			</div>
			<div class="mb-3">
				<label for="message" class="form-label">Votre message :</label>
				<textarea class="form-control" id="message" name="message" rows="7" required></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Envoyer</button>
		</form>
	</div>

</div>

<script>
	tinymce.init({
		selector: '#questionAdd',
		plugins: 'lists link image preview',
		toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
		menubar: false,
		height: 200
	});

	tinymce.init({
		selector: '#reponseAdd',
		plugins: 'lists link image preview',
		toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
		menubar: false,
		height: 200
	});

	tinymce.init({
		selector: '#message',
		plugins: 'lists link image preview',
		toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
		menubar: false,
		height: 300
	});

	function modifierContenu() {
		document.getElementById("rendu").innerHTML = tinymce.get('contenu').getContent();
	}

	function ajouterQuest() {
		document.getElementById("faqAddModal").style.display = 'flex';
	}

</script>