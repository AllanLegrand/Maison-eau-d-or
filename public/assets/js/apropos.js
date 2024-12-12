tinymce.init({
	selector: '#modifiableApropos',
	plugins: 'lists link image preview',
	toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
	menubar: false,
	height: 400,
	setup: function (editor) {
        editor.on('init', function () {
            const content = document.getElementById("content-a-propos").innerHTML;
            editor.setContent(content); // Charge le contenu après l'initialisation
        });
    }
});
