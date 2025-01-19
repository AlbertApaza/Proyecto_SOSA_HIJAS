<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header</title>
    <link rel="stylesheet" href="CSS/estilos-head.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <span class="contact-info">📞 +51 999 999 999</span>
        <span class="shop-info" onclick="window.open('https://www.google.com/maps', '_blank');">🛒 UBICACION</span>
    </div>
    <!-- Header -->
    <header class="header">
        <button id="menu-button" class="menu-button" aria-label="Toggle navigation menu">
            <svg class="icon menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="4" y1="12" x2="20" y2="12"></line>
                <line x1="4" y1="6" x2="20" y2="6"></line>
                <line x1="4" y1="18" x2="20" y2="18"></line>
            </svg>
        </button>
        <nav id="mobile-nav" class="mobile-nav hidden">
            <a href="index.php?action=home">Inicio</a>
            <a href="index.php?action=catalogo">Maquinarias</a>
            <a href="index.php?action=nosotros">Nosotros</a>
            <a href="index.php?action=cotice">Cotice</a>
            <a href="index.php?action=login">Login</a>
            <a href="admin.php">PANEL (accede por login)</a>
        </nav>
        <div class="logo">
            <a href="#" class="logo-link">
                <svg class="icon logo-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 3L12 11L17 6L22 21H2L8 3z"></path>
                </svg>
                <span class="sr-only">Sosa e Hijas SAC</span>
            </a>
        </div>
        <nav class="desktop-nav">
            <a href="index.php?action=home">Inicio</a>
            <a href="index.php?action=catalogo">Maquinarias</a>
            <a href="index.php?action=nosotros">Nosotros</a>
            <a href="index.php?action=cotice">Cotice</a>
            <a href="index.php?action=login">Login</a>
            <a href="admin.php">PANEL (accede por login)</a>
        </nav>
    </header>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.getElementById('menu-button');
    const mobileNav = document.getElementById('mobile-nav');

    menuButton.addEventListener('click', function () {
        mobileNav.classList.toggle('active');
        menuButton.classList.toggle('active');
    });

    document.addEventListener('click', function (event) {
        const isClickInsideMenuButton = menuButton.contains(event.target);
        const isClickInsideMobileNav = mobileNav.contains(event.target);

        if (!isClickInsideMenuButton && !isClickInsideMobileNav) {
            mobileNav.classList.remove('active');
        }
    });
});

    </script>
</body>
</html>

