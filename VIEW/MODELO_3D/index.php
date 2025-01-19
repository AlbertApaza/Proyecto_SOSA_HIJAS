<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Modelos 3D</title>
    <link rel="stylesheet" href="CSS/estilo-Modelo3D-index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<h1>Modelos 3D</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Maquinaria</th>
            <th>Nombre</th>
            <th>Imagen 1</th>
            <th>Imagen 2</th>
            <th>Imagen 3</th>
            <th>Modelo 3D</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $detalle) { ?>
            <tr>
                <td><?php echo $detalle['iddetalle']; ?></td>
                <td><?php echo $detalle['idmaquinaria']; ?></td>
                <td><?php echo $detalle['nombre']; ?></td>
                <td><img src="IMAGENES/<?php echo $detalle['imagen1'] ?? 'default.jpg'; ?>" alt="Imagen 1"></td>
                <td><img src="IMAGENES/<?php echo $detalle['imagen2'] ?? 'default.jpg'; ?>" alt="Imagen 2"></td>
                <td><img src="IMAGENES/<?php echo $detalle['imagen3'] ?? 'default.jpg'; ?>" alt="Imagen 3"></td>
                <td>
                    <?php if (!empty($detalle['modelo3d'])): ?>
                        <img src="IMAGENES/3d.png" alt="Modelo 3D">
                    <?php else: ?>
                        <img src="IMAGENES/default.jpg" alt="Modelo 3D">
                    <?php endif; ?>
                </td>
                <td class="text-justify"><?php echo $detalle['descripcion']; ?></td>
                <td>
                    <a href="admin.php?action=editarDetalleMaquinaria&id=<?php echo $detalle['iddetalle']; ?>" class="btn-editar">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>
