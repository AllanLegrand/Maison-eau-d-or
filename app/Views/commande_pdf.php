<div class="container my-5">
    <h1 class="text-center bordergold">Prévisualisation de la commande</h1>

    <!-- Affichage du PDF dans un iframe -->
    <iframe src="data:application/pdf;base64,<?= base64_encode($pdfContent) ?>" frameborder="0"></iframe>

    <!-- Optionnel : Informations ou bouton supplémentaires -->
    <div class="section-info">
        <p>Vous pouvez consulter la prévisualisation ci-dessus avant de finaliser votre commande.</p>
        <button onclick="window.location.href='/Accueil'" class="btn btn-dark">Finaliser la commande</button>
    </div>
</div>