<?php
require_once("MODEL/Usuario.php");

class LoginController {
    private $model;

    public function __construct() {
        $this->model = new Usuario();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->model->login($username, $password);

            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['autenticado'] = 'SI';
                header("Location: login.php?action=panelAdmin");
                exit();
            } else {
                $error = "Nombre de usuario o contraseña incorrectos";
                require_once("index.php");
            }
        } else {
            require_once("VIEW/login.php");
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>
