    <div class="tabs">
        <a href="#" class="active" data-tab="historiqueTab">Historique des Commandes</a>
        <a href="#" data-tab="profilTab">Modifier le Profil</a>
    </div>

    <div class="tab-content active" id="historiqueTab">
        <h3>Historique des Commandes</h3>

        <?php foreach ($historiqueCommandes as $commande): ?>
            <div class="commande-header">
                Commande #<?= $commande['id_com'] ?> - <?= date('d/m/Y', strtotime($commande['date'])) ?> | Total : <?= number_format($commande['total'], 2, ',', ' ') ?> €
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom du Produit</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commande['produits'] as $produit): ?>
                    <tr>
                        <td><img class="produit-image" src="<?= $produit['image'] ?>" alt="Image de produit"></td>
                        <td><?= $produit['nom'] ?></td>
                        <td><?= $produit['quantite'] ?></td>
                        <td><?= number_format($produit['prix'], 2, ',', ' ') ?> €</td>
                        <td><?= number_format($produit['prix'] * $produit['quantite'], 2, ',', ' ') ?> €</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>

        <div class="pagination">
            <?= $pager ?>
        </div>
    </div>

    <div class="tab-content" id="profilTab">
        <form action="/modifier-profil" method="post">
            
            <label for="nom">Nom :</label>
            <input class="saisie" type="text" name="nom" id="nom" value="<?= old('nom', $utilisateur['nom']) ?>" required>
            
            <label for="prenom">Prénom :</label>
            <input class="saisie" type="text" name="prenom" id="prenom" value="<?= old('prenom', $utilisateur['prenom']) ?>" required>
            
            <label for="adresse">Adresse :</label>
            <input class="saisie" type="text" name="adresse" id="adresse" value="<?= old('adresse', $utilisateur['adresse']) ?>" required>
            
            <label class="newsletter" for="flexSwitchCheckDefault">S'inscrire à la newsletter</label>
            <input class="form-check-input" type="checkbox" role="switch" name="news" id="flexSwitchCheckDefault">
            
            <button type="submit">Enregistrer</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isSubscribed = <?= $utilisateur['news'] ? 'true' : 'false' ?>;

            const newsSwitch = document.getElementById('flexSwitchCheckDefault');

            if (newsSwitch) {
                newsSwitch.checked = isSubscribed;
            } else {
                console.error("Élément 'flexSwitchCheckDefault' introuvable.");
            }
        });
    </script>

    <script src="/assets/js/profil.js"></script>