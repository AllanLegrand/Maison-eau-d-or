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


function openCart() {
    document.getElementById("cartSidebar").style.right = "0";
    loadCartItems();
}

function closeCart() {
    document.getElementById("cartSidebar").style.right = "-400px";
}

function loadCartItems() {
    fetch('/panier/getCartItems')
        .then(response => response.json())
        .then(data => {
            const cartItemsContainer = document.getElementById("cartItems");
            cartItemsContainer.innerHTML = '';  // Clear previous items
            let total = 0;
            data.forEach(item => {
                total += item.prix * item.quantite;
                const itemElement = document.createElement("div");
                itemElement.classList.add("cart-item");
                itemElement.innerHTML = `
                    <div class="d-flex justify-content-between">
                        <img src="${item.image}" alt="${item.nom}" style="width: 50px;">
                        <div>
                            <div>${item.nom}</div>
                            <div>${item.quantite} x ${item.prix} €</div>
                        </div>
                    </div>
                    <hr>
                `;
                cartItemsContainer.appendChild(itemElement);
            });
            const totalElement = document.getElementById("cartTotal");
            totalElement.innerHTML = `Total: ${total} €`;
        })
        .catch(error => console.error("Error loading cart items:", error));
}