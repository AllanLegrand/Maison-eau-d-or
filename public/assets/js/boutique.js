let selectedProductId = null;

function openModal(productId) {
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
                document.getElementById('modalProductImage').src = data.image_url || "/assets/img/default.png";
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

    fetch(`/boutique/addToCart`, {
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

window.onclick = function(event) {
    if (event.target === document.getElementById('productModal')) {
        closeModal();
    }
}

function openAddArticleModal() {
    document.getElementById('addProductModal').style.display = 'flex';
}

function closeAddProductModal() {
    document.getElementById('addProductModal').style.display = 'none';
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function openEditArticleModal(event, prod, dicProdCat) {
    event.stopPropagation();
    document.getElementById('editProductModal').style.display = 'flex';
    document.getElementById('productId').value = prod.id_prod;
    document.getElementById('productName').value = prod.nom;
    document.getElementById('productPrice').value = prod.prix;
    document.getElementById('productDescription').value = prod.description;
    document.getElementById('productStatus').value = prod.actif === "t" ? 1 : 0;

    dicProdCat.forEach(cat => {
        document.getElementById("categoryCheckbox" +cat).checked = true;
    })
}



function closeEditProductModal() {
    document.getElementById('editProductModal').style.display = 'none';
}