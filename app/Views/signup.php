<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inscription</title>
	<link href="/assets/css/inscription.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		/* Correction de l'alignement entre la case à cocher et le texte */
		.newsletter-container {
			display: flex;
			align-items: center;
			gap: 0.5em;
			margin: 1em 0;
		}
	</style>
</head>

<body>
	<div class="signin-container">
		<div class="left-side">
			<form action="/signup/store" method="post">
				<h3>Inscription</h3>

				<label for="email">E-mail <span class="required">*</span> :</label>
				<input type="email" name="email" id="email" placeholder="Entrez votre adresse e-mail"
					class="<?= isset($validation) && $validation->hasError('email') ? 'error-input' : '' ?>"
					value="<?= old('email') ?>"
					required>
				<?php if (isset($validation) && $validation->hasError('email')) : ?>
					<span class="error-message"><?= $validation->getError('email') ?></span>
				<?php endif; ?>

				<label for="nom">Nom <span class="required">*</span> :</label>
				<input type="text" name="nom" id="nom" placeholder="Entrez votre nom"
					class="<?= isset($validation) && $validation->hasError('nom') ? 'error-input' : '' ?>"
					value="<?= old('nom') ?>"
					required>
				<?php if (isset($validation) && $validation->hasError('nom')) : ?>
					<span class="error-message"><?= $validation->getError('nom') ?></span>
				<?php endif; ?>

				<label for="prenom">Prénom <span class="required">*</span> :</label>
				<input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom"
					class="<?= isset($validation) && $validation->hasError('prenom') ? 'error-input' : '' ?>"
					value="<?= old('prenom') ?>"
					required>
				<?php if (isset($validation) && $validation->hasError('prenom')) : ?>
					<span class="error-message"><?= $validation->getError('prenom') ?></span>
				<?php endif; ?>

				<label for="adresse">Adresse <span class="required">*</span> :</label>
				<input type="text" name="adresse" id="adresse" placeholder="Entrez votre adresse physique"
					class="<?= isset($validation) && $validation->hasError('adresse') ? 'error-input' : '' ?>"
					value="<?= old('adresse') ?>"
					required>
				<?php if (isset($validation) && $validation->hasError('adresse')) : ?>
					<span class="error-message"><?= $validation->getError('adresse') ?></span>
				<?php endif; ?>

				<label for="password">Mot de passe <span class="required">*</span> :</label>
				<input type="password" name="password" id="password" placeholder="Entrez votre mot de passe"
					class="<?= isset($validation) && $validation->hasError('password') ? 'error-input' : '' ?>"
					required>
				<?php if (isset($validation) && $validation->hasError('password')) : ?>
					<span class="error-message"><?= $validation->getError('password') ?></span>
				<?php endif; ?>

				<label for="confirmpassword">Confirmer le mot de passe <span class="required">*</span> :</label>
				<input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirmez votre mot de passe"
					class="<?= isset($validation) && $validation->hasError('confirmpassword') ? 'error-input' : '' ?>"
					required>
				<?php if (isset($validation) && $validation->hasError('confirmpassword')) : ?>
					<span class="error-message"><?= $validation->getError('confirmpassword') ?></span>
				<?php endif; ?>

				<div class="newsletter-container">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" role="switch" name="news" id="flexSwitchCheckDefault"
							<?= old('news') ? 'checked' : '' ?>>
						<label class="newsletter" for="flexSwitchCheckDefault">S'inscrire à la newsletter</label>
					</div>
				</div>

				<button type="submit">S'inscrire</button>
				<a href="/signin">
					<button type="button" class="signin">Déjà un compte ?</button>
				</a>
			</form>
		</div>
		<div class="right-side">
			<a href="<?= base_url('Accueil') ?>">
				<img src="/assets/img/maisoneaudeur.webp" alt="Maison Eau d'Or" height="50">
			</a>
		</div>
	</div>
	<script src="/assets/js/signup.js"></script>
</body>


</html>
