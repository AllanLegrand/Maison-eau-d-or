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
    document.getElementById("cartSidebar").style.right = "-500px";
}

function loadCartItems() {
    fetch('/panier/getCartItems')
        .then(response => response.json())
        .then(data => {
            const cartItemsContainer = document.getElementById("cartItems");
            cartItemsContainer.innerHTML = '';
            let total = 0;
            data.forEach(item => {
                total += item.prix * item.quantite;
                const itemElement = document.createElement("div");
                itemElement.classList.add("cart-item");
            
                itemElement.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <img src="${item.image}" alt="${item.nom}" style="width: 80px;">
                        <div>
                            <div>${item.nom}</div>
                            <div>${item.prix} €</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-secondary" onclick="updateQuantity(${item.id_prod}, ${parseInt(item.quantite) - 1})">-</button>
                            <input type="number" value="${item.quantite}" min="1" max="100" onchange="updateQuantity(${item.id_prod}, this.value)" class="form-control">
                            <button class="btn btn-outline-secondary" onclick="updateQuantity(${item.id_prod}, ${parseInt(item.quantite) + 1})">+</button>
                        </div>
                        <button class="btn" onclick="removeFromCart(${item.id_prod})">
                            🗑️
                        </button>
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

function updateQuantity(productId, newQuantity) {
    if (newQuantity < 1) {
        alert("La quantité doit être d'au moins 1.");
        return;
    }
    
    fetch(`/panier/updateQuantity`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id_prod: productId, quantite: newQuantity }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadCartItems(); // Recharge les éléments du panier après mise à jour
            } else {
                alert("Erreur lors de la mise à jour de la quantité.");
            }
        })
        .catch(error => console.error("Error updating quantity:", error));
}


function removeFromCart(productId) {
    fetch(`/panier/removeItem`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id_prod: productId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadCartItems();
            } else {
                alert("Erreur lors de la suppression de l'article.");
            }
        })
        .catch(error => console.error("Error removing item:", error));
}

function openUserSidebar() {
    document.getElementById("userSidebar").style.right = "0";
    loadUserDetails(); // Charge les informations utilisateur
}

function closeUserSidebar() {
    document.getElementById("userSidebar").style.right = "-500px";
}

function loadUserDetails() {
    fetch('/utilisateur/getUserDetails') // Endpoint à créer côté serveur
        .then(response => response.json())
        .then(data => {
            const userDetailsContainer = document.getElementById("userDetails");
            userDetailsContainer.innerHTML = `
                <div class="user-details">
                    <p><strong>Nom :</strong> ${data.nom}</p>
                    <p><strong>Prénom :</strong> ${data.prenom}</p>
                    <p><strong>Email :</strong> ${data.email}</p>
                    <p><strong>Adresse :</strong> ${data.adresse}</p>
                </div>
            `;
        })
        .catch(error => console.error("Erreur lors du chargement des informations utilisateur :", error));
}

function handleUserIconClick() {
    fetch('/utilisateur/checkAuth') // Endpoint pour vérifier la connexion
        .then(response => response.json())
        .then(data => {
            if (data.isLoggedIn) {
                openUserSidebar(); // Ouvre le bandeau profil
            } else {
                window.location.href = '/signin'; // Redirige vers la page de connexion
            }
        })
        .catch(error => console.error("Erreur lors de la vérification de l'authentification :", error));
}