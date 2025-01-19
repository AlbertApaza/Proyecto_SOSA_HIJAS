<html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Modelo 3D</title>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
    
    <style>
        model-viewer {
            width: 100vw;
            height: 100vh;
            margin: 0;
        }
    </style>
    
</head>
<body>
    <model-viewer src="IMAGENES/MODELOS3D/zil_130_body__lowpoly.glb" ar camera-controls auto-rotate></model-viewer>

    <model-viewer src="IMAGENES/MODELOS3D/zil_130_body__lowpoly.glb" ar ar-modes="webxr scene-viewer quick-look" camera-controls auto-rotate poster="poster.png">
    </model-viewer>


</body>
</html>