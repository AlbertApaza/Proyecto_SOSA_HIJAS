<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Detalle de Maquinaria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <style>

        .container {
            max-width: 1200px;
            margin: 30px 20px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            justify-content: space-between;
        }
        .form-row > div {
            flex: 1;
            min-width: 280px;
            padding: 10px;
            box-sizing: border-box;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="file"] {
            margin-top: 10px;
        }
        img {
            display: block;
            margin-top: 10px;
            max-width: 100px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        img:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        button {
            display: block;
            width: 100%;
            background-color: #28a745;
            color: #fff;
            padding: 12px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
        }
        button:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        .dropzone {
            border: 2px dashed #007bff;
            border-radius: 5px;
            background-color: #e9ecef;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            margin-top: 10px;
            max-width: 100%;
            height: 80px;
        }
        textarea {
            height: 150px;
            resize: none;
            overflow: auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Detalle de Maquinaria</h1>
        <form action="admin.php?action=actualizarDetalleMaquinaria" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div>
                    <label>ID Detalle:</label>
                    <span><?php echo $detalle['iddetalle']; ?></span>
                    <input type="hidden" name="id" value="<?php echo $detalle['iddetalle']; ?>">
                </div>
                <div>
                    <label>ID Maquinaria:</label>
                    <span><?php echo $detalle['idmaquinaria']; ?></span>
                    <input type="hidden" name="idmaquinaria" value="<?php echo $detalle['idmaquinaria']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="imagen1">Imagen 1:</label>
                    <input type="file" id="imagen1" name="imagen1" class="dropzone">
                    <img src="IMAGENES/<?php echo $detalle['imagen1'] ?? 'default.png'; ?>" alt="Imagen 1">
                </div>
                <div>
                    <label for="imagen2">Imagen 2:</label>
                    <input type="file" id="imagen2" name="imagen2" class="dropzone">
                    <img src="IMAGENES/<?php echo $detalle['imagen2'] ?? 'default.png'; ?>" alt="Imagen 2">
                </div>
                <div>
                    <label for="imagen3">Imagen 3:</label>
                    <input type="file" id="imagen3" name="imagen3" class="dropzone">
                    <img src="IMAGENES/<?php echo $detalle['imagen3'] ?? 'default.png'; ?>" alt="Imagen 3">
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion"><?php echo $detalle['descripcion']; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="modelo3d">Modelo 3D (.glb):</label>
                    <input type="file" id="modelo3d" name="modelo3d" accept=".glb" class="dropzone">
                </div>
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textareas = document.querySelectorAll("textarea");
            textareas.forEach(textarea => {
                textarea.addEventListener("input", function() {
                    this.style.height = "auto";
                    this.style.height = (this.scrollHeight) + "px";
                });
                textarea.style.height = textarea.scrollHeight + "px";
            });
        });
    </script>
</body>
</html>
