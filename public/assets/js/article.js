function openAddArticleModal() {
	document.getElementById('articleAddModal').style.display = 'flex';
}

// Fonction pour fermer le modal
function closeAddArticleModal() {
	document.getElementById('articleAddModal').style.display = 'none';
}

tinymce.init({
	selector: '#addDescription',
	plugins: 'lists link image preview',
	toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
	menubar: false,
	height: 300
});

function toggleContent(index) {
    const content = document.getElementById(`msg-${index}`);
    const button = content.nextElementSibling;

    if (content.classList.contains('visible')) {
        content.classList.remove('visible');
        button.textContent = 'Lire la suite';
    } else {
        content.classList.add('visible');
        button.textContent = 'Réduire';
    }
}
