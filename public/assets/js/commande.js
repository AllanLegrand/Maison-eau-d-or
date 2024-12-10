function submitFinalizeOrder() {
    fetch('/commande/finalizeOrder', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.href = '/Accueil';
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
        alert('Une erreur s\'est produite. Veuillez réessayer.');
    });
}