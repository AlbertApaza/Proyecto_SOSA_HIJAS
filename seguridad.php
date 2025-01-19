<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] !== "SI") {
    header("Location: /sosa/VIEW/nologin.php");
    exit();
}
?>
