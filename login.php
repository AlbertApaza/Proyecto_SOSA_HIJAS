<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
    require_once("DB/db.php");

    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    switch ($action) {
        case 'login':
            require_once("CONTROLLER/LoginController.php");
            $controller = new LoginController();
            $controller->login();
            break;
        case 'panelAdmin':
            require_once("seguridad.php");
            require_once("admin.php");
            break;
        case 'logout':
            require_once("CONTROLLER/LoginController.php");
            $controller = new LoginController();
            $controller->logout();
            break;
        default:
            require_once("VIEW/login.php");
            break;
    }
    ?>
</body>
</html>
