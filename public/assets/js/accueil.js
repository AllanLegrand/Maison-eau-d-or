// Gestion du basculement entre "Bestsellers" et "Coffrets"
document.getElementById('bestsellersTitle').addEventListener('click', function () {
    document.getElementById('bestsellersContent').classList.remove('d-none');
    document.getElementById('coffretsContent').classList.add('d-none');
    document.getElementById('bestsellersTitle').classList.add('active');
    document.getElementById('coffretsTitle').classList.remove('active');
});

document.getElementById('coffretsTitle').addEventListener('click', function () {
    document.getElementById('coffretsContent').classList.remove('d-none');
    document.getElementById('bestsellersContent').classList.add('d-none');
    document.getElementById('coffretsTitle').classList.add('active');
    document.getElementById('bestsellersTitle').classList.remove('active');
});

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


function addToCart2(selectedProductId) {
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
            document.getElementById('quantity').value = 1;
        } else {
            alert(data.error || "Une erreur s'est produite.");
        }
    })
    .catch(error => {
        alert("Une erreur s'est produite : " + error.message);
    });
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

function subscribeToNewsletter() {
    fetch('/subscribeToNewsletter', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Vous êtes maintenant inscrit à la newsletter.');
            location.reload();
        } else {
            alert(data.message || 'Une erreur est survenue.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Impossible de s’inscrire à la newsletter.');
    });
}