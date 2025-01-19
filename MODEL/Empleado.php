<?php
class Empleado {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    public function listarEmpleados() {
        $empleados = array();
        $consulta = $this->db->query("SELECT * FROM tbempleado");
        while ($fila = $consulta->fetch_assoc()) {
            $empleados[] = $fila;
        }
        return $empleados;
    }

    public function agregarEmpleado($idcargo, $nombre, $apellido, $dni) {
        $stmt = $this->db->prepare("INSERT INTO tbempleado (idcargo, nombre, apellido, dni) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $idcargo, $nombre, $apellido, $dni);
        $stmt->execute();
        $stmt->close();
    }

    public function editarEmpleado($idempleado, $idcargo, $nombre, $apellido, $dni) {
        $stmt = $this->db->prepare("UPDATE tbempleado SET idcargo = ?, nombre = ?, apellido = ?, dni = ? WHERE idempleado = ?");
        $stmt->bind_param("isssi", $idcargo, $nombre, $apellido, $dni, $idempleado);
        $stmt->execute();
        $stmt->close();
    }

    public function buscarEmpleadoPorId($idempleado) {
        $stmt = $this->db->prepare("SELECT * FROM tbempleado WHERE idempleado = ?");
        $stmt->bind_param("i", $idempleado);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $empleado = $resultado->fetch_assoc();
        $stmt->close();
        return $empleado;
    }

    public function eliminarEmpleado($idempleado) {
        $stmt = $this->db->prepare("DELETE FROM tbempleado WHERE idempleado = ?");
        $stmt->bind_param("i", $idempleado);
        $stmt->execute();
        $stmt->close();
    }
}
?>
