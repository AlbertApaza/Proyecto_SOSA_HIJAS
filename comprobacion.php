<?php
// Iniciar la sesión solo si no ha sido iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Comprobar si el usuario está autenticado
if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] !== "SI") {
    header("Location: VIEW/nocorrectdata.php");
    exit();
}
?>
