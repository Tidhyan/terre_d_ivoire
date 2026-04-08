<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        // Si le menu est caché, on l'affiche, sinon on le cache
        if (menu.style.display === "none") {
            menu.style.display = "flex";
        } else {
            menu.style.display = "none";
        }
    });
</script>