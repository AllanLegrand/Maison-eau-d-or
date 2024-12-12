<div class="container my-5">
    <h1 class="my-4 text-center bordergold">Confirmation de commande</h1>

    <!-- Informations Utilisateur -->
    <div class="mb-4 contenut">
        <h3>1. Contact</h3>
        <p><strong>Nom et prénom :</strong> <?= esc($utilisateur['nom']) ?> <?= esc($utilisateur['prenom']) ?></p>
        <p><strong>Email :</strong> <?= esc($utilisateur['email']) ?></p>
    </div>

    <!-- Méthode de livraison -->
    <form action="/commande/valider" method="POST">
        <div class="mb-4 contenut">
            <h3>2. Méthode de livraison</h3>
                <label for="livraison" class="form-label">Choisir une méthode de livraison</label>
                <select id="livraison" name="livraison" class="form-select" onchange="toggleAddressField()">
                    <option value="retrait" selected>Retrait en magasin (123 avenue René Coty, LE HAVRE 76600)</option>
                    <option value="livraison">Livraison à domicile</option>
                </select>
                
                <!-- Champ d'adresse, affiché uniquement si la livraison est sélectionnée -->
                <div id="adresse" class="mt-3" style="display: none;">
                    <label for="adresseLivraison" class="form-label">Adresse de livraison :</label>
                    <input type="text" class="form-control" id="adresseLivraison" name="adresseLivraison" value="<?= esc($utilisateur['adresse']) ?>">
                </div>
        </div>
        <div class="mb-4 contenut">
                <!-- Message optionnel -->
                <h3 class="mt-4 ">3. Résumé de la commande</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= esc($item['nom']) ?></td>
                            <td><?= esc($item['quantite']) ?></td>
                            <td><?= number_format($item['prix'], 2) ?> €</td>
                            <td><?= number_format($item['total'], 2) ?> €</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <h4>Total : <?= number_format(array_sum(array_column($cartItems, 'total')), 2) ?> €</h4>
                    <button type="submit" class="btn btn-dark">Confirmer la commande</button>
                </div>
        </div>
    </form>
</div>

<script>
    function toggleAddressField() {
        const livraisonSelect = document.getElementById('livraison');
        const adresseDiv = document.getElementById('adresse');

        // Si la méthode choisie est "livraison", on affiche le champ adresse
        if (livraisonSelect.value === 'livraison') {
            adresseDiv.style.display = 'block';
        } else {
            adresseDiv.style.display = 'none';
        }
    }

    window.onload = function() {
        toggleAddressField();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
