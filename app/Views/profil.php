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
            <input type="text" name="nom" id="nom" value="<?= $utilisateur['nom'] ?>" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="<?= $utilisateur['prenom'] ?>" required>

            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" value="<?= $utilisateur['adresse'] ?>" required>

            <button type="submit">Enregistrer</button>
        </form>
    </div>

    <script src="/assets/js/profil.js"></script>