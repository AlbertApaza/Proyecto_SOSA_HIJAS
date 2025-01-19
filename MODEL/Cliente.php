<?php
class Cliente {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    public function listarClientes() {
        $clientes = array();
        $consulta = $this->db->query("SELECT * FROM tbcliente");
        while ($fila = $consulta->fetch_assoc()) {
            $clientes[] = $fila;
        }
        return $clientes;
    }

    public function agregarCliente($nombre, $apellido, $correo, $iddocumento, $documento, $telefono) {
        try {
            $sql = "INSERT INTO tbcliente (nombre, apellido, correo, iddocumento, documento, telefono) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssiss", $nombre, $apellido, $correo, $iddocumento, $documento, $telefono);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo "Error al agregar el cliente: " . $e->getMessage();
            return false;
        }
    }

    public function editarCliente($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono) {
        try {
            $sql = "UPDATE tbcliente SET nombre = ?, apellido = ?, correo = ?, iddocumento = ?, documento = ?, telefono = ? WHERE idcliente = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssissi", $nombre, $apellido, $correo, $iddocumento, $documento, $telefono, $idcliente);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo "Error al editar el cliente: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarCliente($idcliente) {
        try {
            $sql = "DELETE FROM tbcliente WHERE idcliente = ?";
            $stmt = $this->db->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->db->error);
            }
            $stmt->bind_param("i", $idcliente);
            $stmt->execute();
            
            $resultado = $stmt->affected_rows > 0;
            $stmt->close();
            return $resultado;
        } catch (Exception $e) {
            echo "Error al eliminar el cliente: " . $e->getMessage();
            return false;
        }
    }

    public function buscarCliente($termino) {
        $clientes = array();
        $termino = "%" . $termino . "%";
        $sql = "SELECT * FROM tbcliente WHERE nombre LIKE ? OR apellido LIKE ? OR correo LIKE ? OR documento LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $termino, $termino, $termino, $termino);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($fila = $result->fetch_assoc()) {
            $clientes[] = $fila;
        }
        $stmt->close();
        return $clientes;
    }
    public function agregarClienteForm($nombre, $apellido, $correo, $iddocumento, $documento, $telefono, $valido) {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "INSERT INTO tbcliente (nombre, apellido, correo, iddocumento, documento, telefono, valido) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("ssssiss", $nombre, $apellido, $correo, $iddocumento, $documento, $telefono, $valido);
            
            $stmt->execute();
            
            $stmt->close();
            $conexion->close();
            return true;
        } catch (Exception $e) {
            echo "Error al agregar el cliente: " . $e->getMessage();
            return false;
        }
    }
    public function obtenerUltimoIdCliente() {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "SELECT MAX(idcliente) AS ultimo_id FROM tbcliente";
            
            $resultado = $conexion->query($sql);
            
            if ($resultado && $resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $ultimoId = $fila['ultimo_id'];
                $resultado->close();
                $conexion->close();
                return $ultimoId;
            } else {
                $conexion->close();
                return null;
            }
        } catch (Exception $e) {
            echo "Error al obtener el último ID de cliente: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerClientePorId($idcliente) {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "SELECT * FROM tbcliente WHERE idcliente = ?";
            
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("i", $idcliente);
            
            $stmt->execute();
            
            $resultado = $stmt->get_result();
            
            $cliente = $resultado->fetch_assoc();
            
            $stmt->close();
            $conexion->close();
            return $cliente;
        } catch (Exception $e) {
            echo "Error al obtener cliente por ID: " . $e->getMessage();
            return false;
        }
    }
    
}
?>