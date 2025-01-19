<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Maquinaria</title>
</head>
<body>
    <h2>Resultados de la Búsqueda</h2>
    <form action="admin.php?action=buscarMaquinaria" method="POST">
        <input type="text" name="termino" placeholder="Buscar maquinaria">
        <button type="submit">Buscar</button>
    </form>
    <?php if (!empty($resultados)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número de Serie</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Costo por Hora</th>
                    <th>Imagen Principal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $maquinaria): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($maquinaria['idmaquinaria']); ?></td>
                        <td><?php echo htmlspecialchars($maquinaria['numserie']); ?></td>
                        <td><?php echo htmlspecialchars($maquinaria['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($maquinaria['marca']); ?></td>
                        <td><?php echo htmlspecialchars($maquinaria['modelo']); ?></td>
                        <td><?php echo htmlspecialchars($maquinaria['costoh']); ?></td>
                        <td><img src="IMAGENES/<?php echo htmlspecialchars($maquinaria['imagenprincipal']); ?>"width="30"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>
</body>
</html>
