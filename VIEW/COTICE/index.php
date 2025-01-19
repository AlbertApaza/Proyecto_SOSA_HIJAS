<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Cotizaciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
        }

        table td {
            color: #555;
        }

        .detalles-cotizacion {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .detalles-cotizacion:hover {
            background-color: #0056b3;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
    </style>
</head>
<body>
    <h1>Listado de Cotizaciones</h1>
    <table>
        <thead>
            <tr>
                <th>ID Cotización</th>
                <th>ID Cliente</th>
                <th>ID Maquinaria</th>
                <th>Ciudad</th>
                <th>Total (días)</th>
                <th>Tiempo (horas)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cotizaciones as $cotizacion): ?>
                <tr>
                    <td><?php echo $cotizacion['idcotizacion']; ?></td>
                    <td><?php echo $cotizacion['idcliente']; ?></td>
                    <td><?php echo $cotizacion['idmaquinaria']; ?></td>
                    <td><?php echo $cotizacion['ciudad_nombre']; ?></td>
                    <td><?php echo $cotizacion['total']; ?></td>
                    <td><?php echo $cotizacion['tiempo']; ?></td>
                    <td><button class="detalles-cotizacion" data-id="<?php echo $cotizacion['idcotizacion']; ?>"><i class="fas fa-info-circle"></i> Detalles</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="detalle-cotizacion" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-header">
                <h2>Detalles de la Cotización</h2>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.detalles-cotizacion').on('click', function() {
                var idcotizacion = $(this).data('id');
                var detalle = {
                    nombre: "Juan",
                    apellido: "Pérez",
                    maquinaria: "Excavadora",
                    ciudad: "Ciudad de México",
                    total: "2000",
                    tiempo: "5 días"
                };

                $('#detalle-cotizacion .modal-body').html(`
                    <p><strong>Cliente:</strong> ${detalle.nombre} ${detalle.apellido}</p>
                    <p><strong>Maquinaria:</strong> ${detalle.maquinaria}</p>
                    <p><strong>Ciudad:</strong> ${detalle.ciudad}</p>
                    <p><strong>Total:</strong> ${detalle.total}</p>
                    <p><strong>Tiempo:</strong> ${detalle.tiempo}</p>
                `);
                $('#detalle-cotizacion').fadeIn();
            });

            $('#detalle-cotizacion .close').on('click', function() {
                $('#detalle-cotizacion').fadeOut();
            });
        });
    </script>
</body>
</html>
