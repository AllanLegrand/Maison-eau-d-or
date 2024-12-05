// Fonction pour afficher les résultats de la recherche
function searchProduits(query) {
    const resultsContainer = document.getElementById("searchResults");

    if (query.length === 0) {
        resultsContainer.style.display = 'none';
        return;
    }

    // Sinon, afficher la div des résultats
    resultsContainer.style.display = 'block';
    // Effectuer la requête AJAX pour récupérer les résultats du serveur
    fetch(`/rechercheProduit?query=${query}`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                resultsContainer.innerHTML = '<div class="no-results">Aucun projet correspondant trouvé.</div>';
                return;
            }

            let resultsHtml = '';
            data.forEach(produit => {
                resultsHtml += `
                    <div class="result-item" onclick="selectProduit(${produit.id_prod})">
                        ${produit.nom}
                    </div>
                `;
            });

            resultsContainer.innerHTML = resultsHtml;
        })
        .catch(error => {
            console.error('Erreur de recherche:', error);
        });
}

// Fonction pour sélectionner un projet dans la liste (à personnaliser)
function selectProduit(id_prod) {
    
}