<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Réinitialisation du mot de passe</title>
</head>

<body>
	<form action="/reset-password/updatePassword" method="post">
		<label>Réinitialisation du mot de passe</label>
		<input type="hidden" name="token" value="<?= $token ?>">
		<label for="password">Nouveau mot de passe :</label>
		<input type="password" name="password" id="password" required>
		<br>
		<label for="confirm_password">Confirmer le mot de passe :</label>
		<input type="password" name="confirm_password" id="confirm_password" required>
		<br>
		<button type="submit">Réinitialiser</button>
	</form>
</body>

</html>