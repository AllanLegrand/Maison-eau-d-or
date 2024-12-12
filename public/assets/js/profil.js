function changeTab(tabIndex) {
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');

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

        document.querySelectorAll('.tabs a').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

        this.classList.add('active');
        const tabContent = document.getElementById(this.getAttribute('data-tab'));
        if (tabContent) {
            tabContent.classList.add('active');
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const deleteAccountBtn = document.getElementById("deleteAccountBtn");
    const confirmDialog = document.getElementById("confirmDialog");
    const confirmDelete = document.getElementById("confirmDelete");
    const cancelDelete = document.getElementById("cancelDelete");

    if (deleteAccountBtn && confirmDialog && confirmDelete && cancelDelete) {
        deleteAccountBtn.addEventListener("click", () => {
            confirmDialog.style.display = "flex";
        });

        cancelDelete.addEventListener("click", () => {
            confirmDialog.style.display = "none";
        });

        confirmDelete.addEventListener("click", () => {
            window.location.href = "/profil/suppr";
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('pdfModal');
    const iframe = document.getElementById('pdfFrame');
    const modalTitle = document.getElementById('modalTitle');

    if (modal && iframe && modalTitle) {
        document.querySelectorAll('.btn-modal').forEach(button => {
            button.addEventListener('click', function () {
                const commandId = this.dataset.commandId;

                modalTitle.textContent = `Commande #${commandId}`;
                iframe.src = `/assets/pdf/commande_${commandId}.pdf`;

                modal.style.display = 'flex';
            });
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }
});

function closeModal() {
    const modal = document.getElementById('pdfModal');
    const iframe = document.getElementById('pdfFrame');
    if (modal && iframe) {
        modal.style.display = "none";
        iframe.src = ""; 
    }
}
