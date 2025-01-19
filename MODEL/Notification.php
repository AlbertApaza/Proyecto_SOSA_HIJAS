<?php

require_once 'DB/db.php';

class Notification {

    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    public function countUnreadNotifications() {
        $sql = "SELECT COUNT(*) AS count FROM notifications WHERE is_read = 0";
        $result = $this->db->query($sql);
        $data = $result->fetch_assoc();
        return $data['count'];
    }

    public function markAllNotificationsAsRead() {
        $sql = "UPDATE notifications SET is_read = 1";
        $this->db->query($sql);
    }
    public function getAllNotifications() {
        $sql = "SELECT * FROM notifications where is_read=0;";
        $result = $this->db->query($sql);
        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
        return $notifications;
    }
}

?>
