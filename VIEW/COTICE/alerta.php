<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimiento</title>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        .mensaje {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="mensaje">
            <h2>Gracias por su preferencia.</h2>
            <p>En breve nos comunicaremos con usted</p>
            <p>mediante el correo electronico brindado.</p>
            <button id="cerrarMensaje">Cerrar</button>
        </div>
    </div>

    <script>
        document.getElementById("cerrarMensaje").addEventListener("click", function() {
            window.location.href = '../index.php';
        });

        setTimeout(function() {
            window.location.href = '../index.php';
        }, 5000);
    </script>
</body>
</html>
