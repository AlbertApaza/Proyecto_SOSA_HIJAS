<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Contratos - Admin</title>
    <style>
        .btn-edit {
            background-color: #FFD700;
            color: white;
            padding: 7px 12px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .btn-edit:hover {
            background-color: #FFC107;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            padding: 7px 12px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .container {
            margin-left: 20px;
        }
        .btn-agregar {
            background-color: #000;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .btn-agregar:hover {
            background-color: #333;
        }
        .form-inline .form-group {
            margin-bottom: 10px;
        }
        .form-control {
            width: 280px;
            padding: 3px;
            font-size: 14px;
            border-radius: 5px;
        }
        .btn-buscar {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin-left: 10px;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }
        .btn-buscar:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
            color: #333;
        }
        td img {
            width: 60px;
            height: auto;
            border-radius: 5px;
            transition: transform 0.2s ease;
        }
        td img:hover {
            transform: scale(1.2);
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Listar Contratos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nro Contrato</th>
                <th>ID Reserva</th>
                <th>Nombre Cliente</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $contrato) { ?>
                <tr>
                    <td><?php echo $contrato['idcontrato']; ?></td>
                    <td><?php echo $contrato['idreserva']; ?></td>
                    <td><?php echo $contrato['nombre'] . ' ' . $contrato['apellido']; ?></td>
                    <td><?php echo $contrato['fechainicio']; ?></td>
                    <td><?php echo $contrato['fechafin']; ?></td>
                    <td>
                        <a href="VIEW/CONTRATO/generar.php?idreserva=<?php echo $contrato['idreserva']; ?>" class="btn-edit">Generar Contrato</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
