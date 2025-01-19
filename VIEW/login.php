<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/estilos_login.css">
</head>
<body>
    <div class="video-container">
        <video autoplay muted loop id="video-background">
            <source src="IMAGENES/2073129-uhd_3840_2160_30fps.mp4" type="video/mp4">
            Tu navegador no soporta la reproducción de video.
        </video>
    </div>
    <div class="container">
        <div class="login-box">
            <div class="text-center">
                <h1 class="login-title">Login</h1>
            </div>
            <form action="login.php?action=login" method="POST" class="login-form">
                <div class="input-group">
                    <label for="username">Nombre de Usuario</label>
                    <input type="text" id="username" name="username" placeholder="usuario">
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="••••••••">
                </div>
                <button type="submit" class="login-button">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>
