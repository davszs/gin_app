document.addEventListener("DOMContentLoaded", function () {
    const okBtn = document.getElementById("okBtn");
    const overlay = document.getElementById("overlayMessage");
    if (okBtn && overlay) {
        okBtn.addEventListener("click", () => overlay.style.display = "none");
    }

    const logoutLink = document.getElementById("logoutTrigger");
    const logoutModal = document.getElementById("logoutModal");
    const cancelBtn = document.getElementById("cancelLogout");

    logoutLink?.addEventListener("click", e => {
        e.preventDefault();
        logoutModal.style.display = "flex";
    });

    cancelBtn?.addEventListener("click", () => {
        logoutModal.style.display = "none";
    });

    // Botão de menu para telas móveis
    if (window.innerWidth <= 768) {
        const topBar = document.querySelector('.top-bar');
        const sidebar = document.querySelector('.sidebar');

        if (!document.querySelector('.menu-toggle')) {
            const menuToggle = document.createElement('button');
            menuToggle.className = 'menu-toggle';
            menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
            topBar.insertBefore(menuToggle, topBar.firstChild);

            menuToggle.addEventListener('click', function () {
                sidebar.classList.toggle('active');
            });
        }
    }
});
