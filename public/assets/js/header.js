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
    openProduitModal(id_prod);
}

function openProduitModal(productId) {
    selectedProductId = productId;
    fetch(`/boutique/getProduit/${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            if (data.nom && data.prix) {
                document.getElementById('modalProductName').innerText = data.nom;
                document.getElementById('modalProductDescription').innerText = data.description || "Aucune description disponible.";
                document.getElementById('modalProductPrice').innerText = data.prix + " €";
                document.getElementById('modalProductImage').src = "/assets/img/" + data.img_path || "/assets/img/default.png";
                document.getElementById('productModal').style.display = "flex";
            } else {
                console.error('Données du produit non valides');
            }
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
}

function closeModal() {
    document.getElementById('productModal').style.display = "none";
}

function addToCart() {
    const quantity = document.getElementById('quantity').value;
    if (!selectedProductId) {
        alert("Produit invalide.");
        return;
    }

    fetch(`/Accueil/addToCart`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id_prod: selectedProductId,
            qt: parseInt(quantity)
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message || "Produit ajouté au panier !");
            closeModal();
        } else {
            alert(data.error || "Une erreur s'est produite.");
        }
    })
    .catch(error => {
        alert("Une erreur s'est produite : " + error.message);
    });
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
            const totalElement = document.getElementById("cartTotal");
            const finalizeButton = document.querySelector(".finalize-button");

            // Nettoyer les conteneurs avant de les remplir
            cartItemsContainer.innerHTML = '';
            totalElement.innerHTML = '';

            if (data.length === 0) {
                // Afficher le message si le panier est vide
                cartItemsContainer.innerHTML = `
                    <div class="text-center my-5">
                        <p class="text-muted">Votre panier est vide</p>
                    </div>
                `;
                finalizeButton.style.display = 'none'; // Masquer le bouton "Finaliser la commande"
            } else {
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
                                <input type="number" value="${item.quantite}" min="1" max="100" onchange="updateQuantity(${item.id_prod}, this.value)" class="form-control mx-1">
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

                totalElement.innerHTML = `Total: ${total.toFixed(2)} €`;
                finalizeButton.style.display = 'block'; // Afficher le bouton si des produits sont dans le panier
                finalizeButton.onclick = () => window.location.href = '/commande';
            }
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
                loadCartItems();
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
    loadUserDetails();
}

function closeUserSidebar() {
    document.getElementById("userSidebar").style.right = "-500px";
}

function loadUserDetails() {
    fetch('/utilisateur/getUserDetails')
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
    fetch('/utilisateur/checkAuth')
        .then(response => response.json())
        .then(data => {
            if (data.isLoggedIn) {
                openUserSidebar();
            } else {
                window.location.href = '/signin';
            }
        })
        .catch(error => console.error("Erreur lors de la vérification de l'authentification :", error));
}

function disconnect() {
    fetch('/utilisateur/deconnexion')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/';
            } else {
                alert("Erreur lors de la déconnexion");
            }
        })
        .catch(error => {
            console.error("Erreur lors de la déconnexion :", error);
            alert("Erreur de connexion au serveur");
        });
}

function test() {
    window.location.href = "/profil";
}