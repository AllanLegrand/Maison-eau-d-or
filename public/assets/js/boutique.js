function openModal(productId) {
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

				document.getElementById('productModal').style.display = "block";
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
