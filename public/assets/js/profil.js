function changeTab(tabIndex) {
    var tabs = document.querySelectorAll('.tab');
    var contents = document.querySelectorAll('.tab-content');

    tabs.forEach((tab, index) => {
        if (index === tabIndex) {
            tab.classList.add('active');
            contents[index].classList.add('active');
        } else {
            tab.classList.remove('active');
            contents[index].classList.remove('active');
        }
    });
}

document.querySelectorAll('.tabs a').forEach(tab => {
    tab.addEventListener('click', function (e) {
        e.preventDefault();

        // Retirer la classe active de tous les onglets et contenus
        document.querySelectorAll('.tabs a').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

        // Activer l'onglet et son contenu associé
        this.classList.add('active');
        const tabContent = document.getElementById(this.getAttribute('data-tab'));
        tabContent.classList.add('active');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const deleteAccountBtn = document.getElementById("deleteAccountBtn");
    const confirmDialog = document.getElementById("confirmDialog");
    const confirmDelete = document.getElementById("confirmDelete");
    const cancelDelete = document.getElementById("cancelDelete");

    // Gestion de la confirmation de suppression
    deleteAccountBtn.addEventListener("click", () => {
        confirmDialog.style.display = "flex";
    });

    cancelDelete.addEventListener("click", () => {
        confirmDialog.style.display = "none";
    });

    confirmDelete.addEventListener("click", () => {
        window.location.href = "/profil/suppr";
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('pdfModal');
    const iframe = document.getElementById('pdfFrame');

    document.querySelectorAll('.btn-modal').forEach(button => {
        button.addEventListener('click', function () {
            const commandId = this.dataset.commandId;

			modalTitle.textContent = `Commande #${commandId}`;

            const pdfUrl = `/assets/pdf/commande_${commandId}.pdf`; 

            iframe.src = pdfUrl;

            modal.style.display = 'flex';
        });
    });


    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            iframe.src = '';
        }
    });
});

function closeModal() {
    document.getElementById('pdfModal').style.display = "none";
}

