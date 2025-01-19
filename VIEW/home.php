<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sosa e Hijas SAC</title>
    <link rel="stylesheet" href="CSS/estilos-home.css">
</head>
<body>
    <header>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Bienvenido a Sosa e Hijas SAC</h1>
                <p>Expertos en Maquinaria Pesada</p>
                <a href="#contact" class="btn">Contáctanos</a>
            </div>
        </section>

        <section class="services">
            <h2>Nuestros Servicios</h2>
            <div class="service-cards">
                <div class="card">
                    <h3>Alquiler de Maquinaria</h3>
                    <p>Ofrecemos una amplia gama de maquinaria pesada para todo tipo de proyectos.</p>
                </div>
                <div class="card">
                    <h3>Venta de Maquinaria</h3>
                    <p>Maquinaria pesada nueva y usada a precios competitivos.</p>
                </div>
                <div class="card">
                    <h3>Mantenimiento</h3>
                    <p>Servicio de mantenimiento para asegurar el óptimo funcionamiento de su maquinaria.</p>
                </div>
            </div>
        </section>

        <section class="about" id="about">
            <h2>Sobre Nosotros</h2>
            <p>Con más de 20 años de experiencia, Sosa e Hijas SAC se ha convertido en un líder en la industria de maquinaria pesada, ofreciendo soluciones innovadoras y servicios de alta calidad.</p>
        </section>

        <section class="contact" id="contact">
            <h2>Contacto</h2>
            <form action="submit_form.php" method="post">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" required></textarea>
                
                <button type="submit" class="btn">Enviar</button>
            </form>
        </section>
    </main>

    <?php include("VIEW/footer.php"); ?>
</body>
</html>
