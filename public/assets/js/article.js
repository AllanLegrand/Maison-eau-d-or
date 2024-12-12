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

tinymce.init({
	selector: '#editDescription',
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

function openEditArticleModal(event, article) {
	event.stopPropagation();
	document.getElementById('articleEditModal').style.display = 'flex';
	document.getElementById('artId').value = article.id_art;
	document.getElementById('editTitre').value = article.titre;
	document.getElementById("editImg").setAttribute("src", "/assets/img/" + article.img_path);
	tinymce.get('editDescription').setContent(article.msg);

}

function closeEditArticleModal() {
	document.getElementById('articleEditModal').style.display = 'none';
}

function openArticle(article) {
	document.getElementById('articleModal').style.display = 'flex';
	document.getElementById('titreArticle').innerHTML = article.titre;
	document.getElementById('contenuArticle').innerHTML = article.msg;
	document.getElementById("articleImg").setAttribute("src", "/assets/img/" + article.img_path);

}

function closeArticleModal() {
	document.getElementById('articleModal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
	// Attendre que TinyMCE soit initialisé
	tinymce.init({
		selector: '#editDescription',
		plugins: 'lists link image preview',
		toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
		menubar: false,
		height: 300,
		setup: (editor) => {
			// Événement appelé une fois l'éditeur initialisé
			editor.on('init', () => {
				const resultDiv = document.getElementById('result');
				if (resultDiv) {
					// Met à jour le contenu du résultat à chaque modification
					editor.on('input', () => {
						const textareaContent = editor.getContent();
						resultDiv.innerHTML = textareaContent;
					});
				}
			});
		}
	});
});

function openVisuArticleModal(creation) {
	document.getElementById('articleModal').style.display = 'flex';
	if (creation) {
		document.getElementById('titreArticle').innerHTML = document.getElementById('addTitre').value;
		document.getElementById('contenuArticle').innerHTML = tinymce.get('addDescription').getContent();
		const fileInput = document.getElementById('file');
		if (fileInput.files && fileInput.files[0]) {
			document.getElementById("articleImg").setAttribute("src", URL.createObjectURL(fileInput.files[0]));
		}
		else {
			document.getElementById("articleImg").setAttribute("src", "/assets/img/default.png");
		}
	}
	else {
		document.getElementById('titreArticle').innerHTML = document.getElementById('editTitre').value;
		document.getElementById('contenuArticle').innerHTML = tinymce.get('editDescription').getContent();
		const fileInput = document.getElementById('file');
		if (fileInput.files && fileInput.files[0]) {
			document.getElementById("articleImg").setAttribute("src", URL.createObjectURL(file));
		}
		else {
			document.getElementById("articleImg").setAttribute("src", document.getElementById('editImg').src);
		}
	}

}
