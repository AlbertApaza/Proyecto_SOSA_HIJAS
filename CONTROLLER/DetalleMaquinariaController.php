<?php
require_once("MODEL/detallemaquinaria_model.php");

class clsDetalleMaquinariaController {
    public function listarDetalleMaquinariaAdmin() {
        $detalleMaquinariaModel = new clsDetalleMaquinariaModel();
        $datos = $detalleMaquinariaModel->listarDetalleMaquinaria();
        require_once("VIEW/MODELO_3D/index.php");
    }

    public function mostrarFormularioEdicion($id) {
        $detalleMaquinariaModel = new clsDetalleMaquinariaModel();
        $detalle = $detalleMaquinariaModel->obtenerDetallePorId($id);
        require_once("VIEW/MODELO_3D/editar.php");
    }

    public function actualizarDetalle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'idmaquinaria' => $_POST['idmaquinaria'],
                'descripcion' => $_POST['descripcion']
            ];
            
            $detalleMaquinariaModel = new clsDetalleMaquinariaModel();
            $detalleMaquinariaModel->actualizarDetalle($data);
            
            header('Location: admin.php?action=MenuModelo3D');
            exit;
        }
    }
    

}

?>
