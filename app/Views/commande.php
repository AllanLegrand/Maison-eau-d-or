    <div class="commande">
        <h1>Résumé de la commande</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Produit</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix Unitaire</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails as $detail): ?>
                <tr>
                    <td><?= esc($detail['nom']) ?></td>
                    <td><?= esc($detail['quantite']) ?></td>
                    <td><?= esc($detail['prix']) ?> €</td>
                    <td><?= esc($detail['total']) ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <h3>Total: <?= $total ?> €</h3>
        </div>

        <div class="mt-4">
			<button class="btn btn-primary" onclick="submitFinalizeOrder()">Finaliser la commande</button>
		</div>
    </div>
	<script src="/assets/js/commande.js"></script>