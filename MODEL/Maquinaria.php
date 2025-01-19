<?php
class Maquinaria {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    //CLIENTE
    // Funcionar para listar maquinarias en Catalogo
    public function listar_Maquinarias(){
        $consulta = $this->db->query("SELECT * FROM tbmaquinaria WHERE estado = 1;");
        while ($filas = $consulta->fetch_assoc()) {
            $this->maquinaria[] = $filas;
        }
        return $this->maquinaria;
    }

    public function mostrar_Maquinaria($idmaquinaria) {
        echo "EN MODEL: id: ";
        echo $idmaquinaria;
    
        $consulta = $this->db->query("
            SELECT 
                tbmaquinaria.*, 
                tbdetallemaquinaria.* 
            FROM tbmaquinaria 
            LEFT JOIN tbdetallemaquinaria 
            ON tbmaquinaria.idmaquinaria = tbdetallemaquinaria.idmaquinaria 
            WHERE tbmaquinaria.idmaquinaria = $idmaquinaria
        ");
    
        return $consulta->fetch_assoc();
    }

    //ADMINISTRADOR
    // Listar maquinarias activas
    public function listarMaquinarias() {
        $maquinarias = array();
        $consulta = $this->db->query("SELECT * FROM tbmaquinaria WHERE estado = 1");
        while ($fila = $consulta->fetch_assoc()) {
            $maquinarias[] = $fila;
        }
        return $maquinarias;
    }

    // Agregar
    public function agregarMaquinaria($numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal) {
        try {
            $sql = "INSERT INTO tbmaquinaria (numserie, nombre, marca, modelo, costoh, imagenprincipal) VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            $stmt->bind_param("ssssds", $numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal);
            $stmt->execute();
            $stmt->close();


            $idmaquinaria = $this->db->insert_id;
            $sqlDetalle = "INSERT INTO tbdetallemaquinaria (idmaquinaria) VALUES (?)";
            $stmtDetalle = $this->db->prepare($sqlDetalle);
            $stmtDetalle->bind_param("i", $idmaquinaria);
            $stmtDetalle->execute();
            $stmtDetalle->close();

            $this->db->close();
            return true;
        } catch (Exception $e) {
            echo "Error al agregar la maquinaria: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarMaquinaria($id) {
        try {
            $this->db->begin_transaction();

            $sql1 = "UPDATE tbmaquinaria SET estado = 0 WHERE idmaquinaria = ?";
            $stmt1 = $this->db->prepare($sql1);
            if (!$stmt1) {
                throw new Exception("Error en la preparación de la consulta: " . $this->db->error);
            }
            $stmt1->bind_param("i", $id);
            $stmt1->execute();

            $sql2 = "UPDATE tbdetallemaquinaria SET estado = 0 WHERE idmaquinaria = ?";
            $stmt2 = $this->db->prepare($sql2);
            if (!$stmt2) {
                throw new Exception("Error en la preparación de la consulta: " . $this->db->error);
            }
            $stmt2->bind_param("i", $id);
            $stmt2->execute();

            if ($stmt1->affected_rows > 0 && $stmt2->affected_rows > 0) {
                $this->db->commit();
                $stmt1->close();
                $stmt2->close();
                return true;
            } else {
                $this->db->rollback();
                $stmt1->close();
                $stmt2->close();
                return false;
            }
        } catch (Exception $e) {
            $this->db->rollback();
            throw new Exception("Error al actualizar el estado de las maquinarias: " . $e->getMessage());
        }
    }
    
    public function editarMaquinaria($id, $numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal) {
        try {
            $sql = "UPDATE tbmaquinaria SET numserie = ?, nombre = ?, marca = ?, modelo = ?, costoh = ?, imagenprincipal = ? WHERE idmaquinaria = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssdsi", $numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal, $id);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo "Error al editar la maquinaria: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarMaquinaria($termino) {
        $maquinarias = array();
        $termino = "%" . $termino . "%";
        $sql = "SELECT * FROM tbmaquinaria WHERE numserie LIKE ? OR nombre LIKE ? OR marca LIKE ? OR modelo LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $termino, $termino, $termino, $termino);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($fila = $result->fetch_assoc()) {
            $maquinarias[] = $fila;
        }
        $stmt->close();
        return $maquinarias;
    }

    public function buscarMaquinariaPorId($id) {
        $sql = "SELECT * FROM tbmaquinaria WHERE idmaquinaria = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $maquinaria = $result->fetch_assoc();
        $stmt->close();
        return $maquinaria;
    }
}
?>