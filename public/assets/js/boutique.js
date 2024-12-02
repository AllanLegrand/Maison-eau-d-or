function openModal(productId) {
    fetch(`/boutique/getProduit/${productId}`)
        .then(response => response.json())  // Convertir la réponse en JSON
        .then(data => {
            console.log(data);  // Cela permet de vérifier exactement ce que vous recevez

            if (data.error) {
                console.error(data.error);  // Affiche l'erreur si elle existe
                return;
            }

            // Vérifier si les données du produit sont valides
            if (data.nom && data.prix) {
                // Mettre à jour les éléments de la pop-up avec les données du produit
                document.getElementById('modalProductName').innerText = data.nom;
                document.getElementById('modalProductDescription').innerText = data.description || "Aucune description disponible.";
                document.getElementById('modalProductPrice').innerText = data.prix + " €";

                // Utiliser une image par défaut ou l'image du produit si elle existe
                let imageUrl = "/assets/img/default.png";
                document.getElementById('modalProductImage').src = imageUrl;

                // Afficher la pop-up
                document.getElementById('productModal').style.display = "block";
            } else {
                console.error('Données du produit non valides');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);  // Affiche l'erreur si la requête échoue
        });
}

function closeModal() {
    document.getElementById('productModal').style.display = "none";
}

window.onclick = function(event) {
    if (event.target == document.getElementById('productModal')) {
        closeModal();
    }
}
