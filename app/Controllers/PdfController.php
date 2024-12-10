<?php

namespace App\Controllers;

use Mpdf\Mpdf;

class PdfController extends BaseController
{
    public function generatePdf()
    {
        // Charger la bibliothèque mPDF
        $mpdf = new Mpdf();

        // Contenu HTML que vous souhaitez convertir en PDF
        $html = '
            <h1>Facture Maison Eau D\'or</h1>
            <p><strong>Produit :</strong> Parfum d\'exception</p>
            <p><strong>Prix :</strong> 120 EUR</p>
            <p><strong>Quantité :</strong> 2</p>
            <p><strong>Total :</strong> 240 EUR</p>
        ';

        // Écrire le contenu HTML dans le PDF
        $mpdf->WriteHTML($html);

        // Générer et afficher le PDF dans le navigateur
        $mpdf->Output('Facture.pdf', 'I');
    }
}
