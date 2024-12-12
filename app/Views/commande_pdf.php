<div class="container my-5">
    <h1 class="text-center bordergold">Prévisualisation de la commande</h1>

    <iframe src="data:application/pdf;base64,<?= base64_encode($pdfContent) ?>" frameborder="0"></iframe>

    <div class="section-info">
        <p>Commande finalisée, vous pouvez ici visualiser et télécharger le bon de commande.</p>
        <button onclick="window.location.href='/Accueil'" class="btn btn-dark">Retourner a l'Accueil</button>
    </div>
</div>