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

document.querySelectorAll('.carousel-container').forEach(carousel => {
    const wrapper = carousel.querySelector('.carousel-wrapper');
    const items = wrapper.querySelectorAll('.carousel-item');
    const prev = carousel.querySelector('.carousel-prev img');
    const next = carousel.querySelector('.carousel-next img');

    let currentIndex = 0;
    
    function getItemWidth() {
        if (window.innerWidth < 768) {
            return items[0].offsetWidth;
        } else {
            return items[0].offsetWidth + 20;
        }
    }

    function updateCarousel() {
        const itemWidth = getItemWidth();
        const offset = -currentIndex * itemWidth;
        wrapper.style.transform = `translateX(${offset}px)`;
    }

    prev.addEventListener('click', () => {
        currentIndex = Math.max(0, currentIndex - 1);
        updateCarousel();
    });

    next.addEventListener('click', () => {
        currentIndex = Math.min(items.length - 1, currentIndex + 1);
        updateCarousel();
    });

    window.addEventListener('resize', updateCarousel);
});

function addToCart(selectedProductId) {
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
        } else {
            alert(data.error || "Une erreur s'est produite.");
        }
    })
    .catch(error => {
        alert("Une erreur s'est produite : " + error.message);
    });
}