    <div class="container my-5">
        <h1>Questions Fréquemment Posées</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if ($isAdmin): ?>
            <!-- Formulaire pour ajouter une FAQ (visible uniquement pour les admins) -->
            <form action="/faq/ajouter" method="post" class="mb-5">
                <div class="mb-3">
                    <label for="txt" class="form-label">Ajouter une question/réponse :</label>
                    <textarea name="txt" id="txt" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        <?php endif; ?>

        <!-- Liste des FAQ -->
		<div class="list-group">
			<?php foreach ($faqs as $faq): ?>
				<div class="list-group-item d-flex justify-content-between align-items-center">
					<!-- Utilisation de nl2br pour gérer les sauts de ligne -->
					<span><?= nl2br(esc($faq['txt'])) ?></span>
					<?php if ($isAdmin): ?>
						<div>
							<button class="btn btn-sm btn-warning" onclick="editFAQ(<?= $faq['id_faq'] ?>, '<?= esc($faq['txt']) ?>')">Modifier</button>
							<a href="/faq/supprimer/<?= $faq['id_faq'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
    </div>

    <?php if ($isAdmin): ?>
        <script>
            function editFAQ(id, text) {
                const form = document.querySelector('form');
                form.action = `/faq/modifier/${id}`;
                document.getElementById('txt').value = text;
                form.querySelector('button').textContent = 'Modifier';
            }
        </script>
    <?php endif; ?>