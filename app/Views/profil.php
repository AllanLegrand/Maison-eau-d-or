<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="/modifier-profil" method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?= $utilisateur['nom'] ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="<?= $utilisateur['prenom'] ?>" required>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?= $utilisateur['email'] ?>" required>

        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" value="<?= $utilisateur['adresse'] ?>" required>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>