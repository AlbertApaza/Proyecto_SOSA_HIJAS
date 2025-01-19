<?php
require_once 'CONTROLLER/NotificationController.php';

$not = new NotificationController();
$notifications = $not->listarNotificaciones();
// $not->marcarNotificacionesLeidas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <style>
        
        .notification {
            background-color: #fff;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
        }
        .notification h3 {
            margin-top: 0;
        }
        .notification p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h2>Notificaciones de nuevas Cotizaciones: <h2>
        <br>
    <?php if (!empty($notifications)): ?>
        <?php foreach ($notifications as $notif): ?>
            <div class="notification">
                <h3><?php echo htmlspecialchars($notif['user_ide']); ?></h3>
                <p><?php echo htmlspecialchars($notif['message']); ?></p>
                <small>Fecha: <?php echo htmlspecialchars($notif['created_at']); ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay nuevas disponibles.</p>
    <?php endif; ?>
    <?php $not->marcarNotificacionesLeidas(); ?>
</body>
</html>
