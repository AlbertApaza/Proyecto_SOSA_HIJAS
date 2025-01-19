<?php
require_once("DB/db.php");

class Usuario {
    private $db;

    public function __construct(){
        $this->db = Conectar::conexion();
    }

    public function login($username, $password){
        $stmt = $this->db->prepare("SELECT * FROM tbadmin WHERE usuario = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
