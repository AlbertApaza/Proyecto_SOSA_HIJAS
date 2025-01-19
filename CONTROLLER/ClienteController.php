<?php
class clsCliente {
    public function listarClienteAdmin() {
        require_once("MODEL/Cliente.php");
        $cliente = new Cliente();
        $clientes = $cliente->listarClientes();
        require_once("VIEW/CLIENTE/index.php");
    }

    public function agregarClienteAdmin($nombre, $apellido, $correo, $iddocumento, $documento, $telefono) {
        require_once("MODEL/Cliente.php");
        $cliente = new Cliente();
        $cliente->agregarCliente($nombre, $apellido, $correo, $iddocumento, $documento, $telefono);
    }

    public function editarClienteAdmin($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono) {
        require_once("MODEL/Cliente.php");
        $cliente = new Cliente();
        $cliente->editarCliente($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono);
    }

    public function eliminarClienteAdmin($idcliente) {
        require_once("MODEL/Cliente.php");
        $cliente = new Cliente();
        $resultado = $cliente->eliminarCliente($idcliente);

        if ($resultado) {
            header("Location: admin.php?action=listarCliente");
        } else {
            echo "Error al eliminar el cliente.";
        }
        exit();
    }

    public function buscarClienteAdmin($termino) {
        require_once("MODEL/Cliente.php");
        $cliente = new Cliente();
        $clientes = $cliente->buscarCliente($termino);
        require_once("VIEW/CLIENTE/buscar.php");
    }

    public function mostrarFormularioEditar($idcliente) {
        require_once("MODEL/Cliente.php");
        $cliente = new Cliente();
        $cliente = $cliente->obtenerClientePorId($idcliente);
        require_once("VIEW/CLIENTE/editar.php");
    }
}
?>
