document.addEventListener("DOMContentLoaded", () => {
    const burgerIcon = document.getElementById("burger-icon");
    const menuOverlay = document.getElementById("menu-overlay");
    const closeMenu = document.getElementById("close-menu");

    burgerIcon.addEventListener("click", () => {
        menuOverlay.style.display = "flex";
    });

    closeMenu.addEventListener("click", () => {
        menuOverlay.style.display = "none";
    });

    menuOverlay.addEventListener("click", (event) => {
        if (event.target === menuOverlay) {
            menuOverlay.style.display = "none";
        }
    });
});
