<script src="https://cdn.tiny.cloud/1/ykhnn1uuwtja98fn7bo25quckri41i762dvrv8bg3ui23ump/tinymce/6/tinymce.min.js"
	referrerpolicy="origin"></script>
<link rel="stylesheet" href="/assets/css/faq.css">
<div class="container my-5">
	<h1 class="faq-header">Foire aux questions</h1>
	<div class="faq-content">
		<?php if (!empty($faq) && is_array($faq)): ?>
			<?php foreach ($faq as $questionReponse): ?>
				<div class="faq-question">
					<input id="q<?= esc($questionReponse['id_faq']) ?>" type="checkbox" class="panel">
					<div class="plus">+</div>
					<label for="q<?= esc($questionReponse['id_faq']) ?>" class="panel-title">
						<?= $questionReponse['question'] ?>
						
					</label>
					<div class="panel-content"><hr><?= $questionReponse['reponse'] ?></div>
					<?php if ($admin): ?>
					<button type="submit" onclick="modifierQuest(<?= htmlspecialchars(json_encode($questionReponse), ENT_QUOTES, 'UTF-8') ?>)" class="btn btn-sm btn-outline-secondary edit-btn">Modifier</button>
					<button type="submit" onclick="if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) location.href='/faq/suppFAQ/<?= esc($questionReponse['id_faq']) ?>';" class="btn btn-sm btn-outline-secondary supp-btn">Supprimer</button>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>Aucune question n'est disponible pour le moment.</p>
		<?php endif; ?>

		<?php if ($admin): ?>
			<button type="button" class="btn btn-sm btn-outline-secondary ajout-btn" onclick="ajouterQuest()">Ajouter</button>

			<form id="editFAQ" action="<?= base_url('editFAQ') ?>" method="post" style="display:none;">
				
				
				
				<button type="submit">Enregistrer</button>
			</form>

			<div id="faqAddModal" style="display: none;">
				<div class="modal-content">
					<span id="closeAddFAQModal" onclick="closeAddFAQModal()" style="cursor: pointer;">&times;</span>
					<h2>Ajouter une question-réponse</h2>
					<form id="formFaq" method="POST" action="/faq/addFAQ">
						<input type="text" id="faqID" name="id_faq" class="form-control" placeholder="ID de la faq"
						style="display:none;">
						<hr>
						<div>
							<label for="question" class="form-label">Question</label>
							<textarea id="questionAdd" name="question"></textarea>
						</div>
						<hr>
						<div>
							<label for="reponse" class="form-label">Réponse</label>
							<textarea id="reponseAdd" name="reponse"></textarea>
						</div>

						<hr>
						<button type="submit" class="btn btn-sm btn-outline-secondary edit-btn">Créer</button>
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
			<div class="mb-3" id="messageFAQ">
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
		document.getElementById("messageFAQ").style.display = 'none';
		document.querySelector("#faqAddModal h2").innerHTML = "Ajouter une question-réponse";
		tinymce.get('questionAdd').setContent("");
		tinymce.get('reponseAdd').setContent("");
		document.getElementById("formFaq").setAttribute("action","/faq/addFAQ");
		document.querySelector("#faqAddModal .edit-btn").innerHTML = "Créer";
	}

	function closeAddFAQModal() {
		document.getElementById("faqAddModal").style.display = 'none';
	}

	function modifierQuest(faq) {
		document.getElementById("faqAddModal").style.display = 'flex';
		document.getElementById("messageFAQ").style.display = 'none';
		document.getElementById("faqID").value = faq.id_faq;
		tinymce.get('questionAdd').setContent(faq.question);
		tinymce.get('reponseAdd').setContent(faq.reponse);
		document.querySelector("#faqAddModal h2").innerHTML = "Modifier une question-réponse";
		document.getElementById("formFaq").setAttribute("action","/faq/modifier");
		document.querySelector("#faqAddModal .edit-btn").innerHTML = "Modifier";
	}

</script>