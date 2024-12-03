// Fonction pour gérer la bascule entre Bestsellers et Coffrets
document.getElementById('bestsellersTitle').addEventListener('click', function() {
    document.getElementById('bestsellersContent').classList.remove('d-none');
    document.getElementById('coffretsContent').classList.add('d-none');
    // Mettre à jour la classe active pour le style
    document.getElementById('bestsellersTitle').classList.add('active');
    document.getElementById('coffretsTitle').classList.remove('active');
});

document.getElementById('coffretsTitle').addEventListener('click', function() {
    document.getElementById('coffretsContent').classList.remove('d-none');
    document.getElementById('bestsellersContent').classList.add('d-none');
    // Mettre à jour la classe active pour le style
    document.getElementById('coffretsTitle').classList.add('active');
    document.getElementById('bestsellersTitle').classList.remove('active');
});
