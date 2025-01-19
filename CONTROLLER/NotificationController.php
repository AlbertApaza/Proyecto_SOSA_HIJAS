<?php

require_once 'MODEL/Notification.php';

class NotificationController {

    public function getNumeroNotificacionesNoLeidas() {
        $notificationModel = new Notification();
        return $notificationModel->countUnreadNotifications();
    }

    public function marcarNotificacionesLeidas() {
        $notificationModel = new Notification();
        $notificationModel->markAllNotificationsAsRead();
    }

    public function listarNotificaciones() {
        $notificationModel = new Notification();
        $notifications = $notificationModel->getAllNotifications();
        return $notifications;
    }
}

?>
