tinymce.init({
	selector: '#questionAdd',
	plugins: 'lists link image preview',
	toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
	menubar: false,
	height: 200
});

tinymce.init({
	selector: '#reponseAdd',
	plugins: 'lists link image preview',
	toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
	menubar: false,
	height: 200
});

tinymce.init({
	selector: '#message',
	plugins: 'lists link image preview',
	toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
	menubar: false,
	height: 300
});

function modifierContenu() {
	document.getElementById("rendu").innerHTML = tinymce.get('contenu').getContent();
}

function ajouterQuest() {
	document.getElementById("faqAddModal").style.display = 'flex';
	document.getElementById("messageFAQ").style.display = 'none';
	document.querySelector("#faqAddModal h2").innerHTML = "Ajouter une question-réponse";
	tinymce.get('questionAdd').setContent("");
	tinymce.get('reponseAdd').setContent("");
	document.getElementById("formFaq").setAttribute("action","/faq/addFAQ");
	document.querySelector("#faqAddModal .edit-btn").innerHTML = "Créer";
}

function closeAddFAQModal() {
	document.getElementById("faqAddModal").style.display = 'none';
}

function modifierQuest(faq) {
	document.getElementById("faqAddModal").style.display = 'flex';
	document.getElementById("messageFAQ").style.display = 'none';
	document.getElementById("faqID").value = faq.id_faq;
	tinymce.get('questionAdd').setContent(faq.question);
	tinymce.get('reponseAdd').setContent(faq.reponse);
	document.querySelector("#faqAddModal h2").innerHTML = "Modifier une question-réponse";
	document.getElementById("formFaq").setAttribute("action","/faq/modifier");
	document.querySelector("#faqAddModal .edit-btn").innerHTML = "Modifier";
}