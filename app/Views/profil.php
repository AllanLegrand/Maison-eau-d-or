<div class="container my-5">
    <h1 class="my-4 text-center bordergold">Mon profil</h1>

    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <button class="tab-button active" data-tab="historiqueTab">Historique</button>
        <button class="tab-button" data-tab="profilTab">Modifier le Profil</button>
    </div>

    <div class="tab-content active" id="historiqueTab">
        <h1 class="my-4 text-center bordergold">Historique des Commandes</h1>

        <div class="flex-center">
            <?php foreach ($historiqueCommandes as $commande): ?>
                <div class="commande-header d-flex justify-content-between align-items-center">
                    <span>Commande #<?= $commande['id_com'] ?> - <?= date('d/m/Y', strtotime($commande['date'])) ?> | Total : <strong class="doree"><?= number_format($commande['total'], 2, ',', ' ') ?> €</strong></span>
                    <!-- Bouton pour ouvrir le modal -->
                    <button class="btn-modal" data-command-id="<?= $commande['id_com'] ?>">
                        <img src="/assets/img/eye.png" alt="Détails" class="icon" />
                    </button>
                </div>

                <table class="table">
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
        </div>

        <div class="pagination">
            <?= $pager ?>
        </div>
    </div>

    <div class="tab-content my-4" id="profilTab">
        <div class="flex-center">
            <h1>Modifier le profil</h1>
            <form action="/modifier-profil" method="post">
                <label for="nom">Nom :</label>
                <input class="saisie" type="text" name="nom" id="nom" value="<?= old('nom', $utilisateur['nom']) ?>" required>
                
                <label for="prenom">Prénom :</label>
                <input class="saisie" type="text" name="prenom" id="prenom" value="<?= old('prenom', $utilisateur['prenom']) ?>" required>
                
                <label for="adresse">Adresse :</label>
                <input class="saisie" type="text" name="adresse" id="adresse" value="<?= old('adresse', $utilisateur['adresse']) ?>" required>
                
                <div class="newsletter-container">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="news" id="flexSwitchCheckDefault">
                        <label class="newsletter" for="flexSwitchCheckDefault">S'inscrire à la newsletter</label>
                    </div>
                </div>
                
                <button type="submit">Enregistrer</button>
                <button type="button" id="deleteAccountBtn" class="btn-dark">Supprimer mon compte</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.tab-button');
            const tabs = document.querySelectorAll('.tab-content');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    buttons.forEach(btn => btn.classList.remove('active'));
                    tabs.forEach(tab => tab.classList.remove('active'));

                    this.classList.add('active');
                    const tabId = this.dataset.tab;
                    document.getElementById(tabId).classList.add('active');
                });
            });

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

    <div id="confirmDialog" class="dialog-overlay" style="display: none;">
        <div class="dialog-box">
            <h3>Confirmer la suppression</h3>
            <p>Êtes-vous sûr de vouloir supprimer votre compte ? <br>
                Cette action est irréversible et entraînera la perte de toutes vos données associées.</p>
            <button id="confirmDelete" class="btn btn-danger">Confirmer</button>
            <button id="cancelDelete" class="btn btn-secondary">Annuler</button>
        </div>
    </div>

    <div id="pdfModal" class="modal-overlay" style="display: none;">
        <div class="modal-box">
            <span class="close-cross" onclick="closeModal()">&times;</span>
            <h1 id="modalTitle">Commande #</h1>
            <iframe id="pdfFrame" src="" frameborder="0" style="width: 100%; height: 500px;"></iframe>
        </div>
    </div>
</div>
