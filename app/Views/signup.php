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

				<label for="email">E-mail :</label>
				<input type="email" name="email" id="email" placeholder="Entrez votre adresse e-mail"
					class="<?= isset($validation) && $validation->hasError('mail') ? 'error-input' : '' ?>"
					data-error="<?= isset($validation) && $validation->hasError('mail') ? $validation->getError('mail') : '' ?>"
					required>

				<label for="nom">Nom :</label>
				<input type="text" name="nom" id="nom" placeholder="Entrez votre nom"
					class="<?= isset($validation) && $validation->hasError('nom') ? 'error-input' : '' ?>"
					data-error="<?= isset($validation) && $validation->hasError('nom') ? $validation->getError('nom') : '' ?>"
					required>

				<label for="prenom">Prénom :</label>
				<input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom"
					class="<?= isset($validation) && $validation->hasError('prenom') ? 'error-input' : '' ?>"
					data-error="<?= isset($validation) && $validation->hasError('prenom') ? $validation->getError('prenom') : '' ?>"
					required>

				<label for="adresse">Adresse :</label>
				<input type="text" name="adresse" id="adresse" placeholder="Entrez votre adresse physique"
					class="<?= isset($validation) && $validation->hasError('adresse') ? 'error-input' : '' ?>"
					data-error="<?= isset($validation) && $validation->hasError('adresse') ? $validation->getError('adresse') : '' ?>"
					required>

				<label for="password">Mot de passe :</label>
				<input type="password" name="password" id="password" placeholder="Entrez votre mot de passe"
					class="<?= isset($validation) && $validation->hasError('password') ? 'error-input' : '' ?>"
					data-error="<?= isset($validation) && $validation->hasError('password') ? $validation->getError('password') : '' ?>"
					required>

				<label for="confirmpassword">Confirmer le mot de passe :</label>
				<input type="password" name="confirmpassword" id="confirmpassword"
					placeholder="Confirmez votre mot de passe"
					class="<?= isset($validation) && $validation->hasError('confirmpassword') ? 'error-input' : '' ?>"
					data-error="<?= isset($validation) && $validation->hasError('confirmpassword') ? $validation->getError('confirmpassword') : '' ?>"
					required>

				<div class="newsletter-container">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" role="switch" name="news" id="flexSwitchCheckDefault">
						<label class="newsletter" for="flexSwitchCheckDefault"> S'inscrire à la newsletter</label>
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
