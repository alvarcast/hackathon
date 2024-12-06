document.querySelectorAll(".accordion").forEach(button => {
    button.addEventListener("click", () => {
        const panel = button.nextElementSibling;
        const isActive = panel.style.display === "block";

        // Cierra todos los paneles abiertos
        document.querySelectorAll(".panel").forEach(p => (p.style.display = "none"));

        // Abre o cierra el panel seleccionado
        if (!isActive) {
            panel.style.display = "block";
        }
    });
});
