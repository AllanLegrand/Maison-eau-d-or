function openModal(productId) {
	selectedProductId = productId;
	fetch(`/boutique/getProduit/${productId}`)
		.then(response => response.json())
		.then(data => {
			console.log(data);

			if (data.error) {
				console.error(data.error);
				return;
			}

			if (data.nom && data.prix) {
				document.getElementById('modalProductName').innerText = data.nom;
				document.getElementById('modalProductDescription').innerText = data.description || "Aucune description disponible.";
				document.getElementById('modalProductPrice').innerText = data.prix + " €";

				let imageUrl = "/assets/img/default.png";
				document.getElementById('modalProductImage').src = imageUrl;

				document.getElementById('productModal').style.display = "flex";
			} else {
				console.error('Données du produit non valides');
			}
		})
		.catch(error => {
			console.error('Erreur:', error);
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

function addToCart() {
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
			qt: 1
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